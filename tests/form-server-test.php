<?php

if (!defined('ABSPATH')) {
    fwrite(STDERR, "Run with wp eval-file.\n");
    exit(1);
}

$checks = 0;
$created_posts = [];

$assert = static function ($condition, string $message) use (&$checks): void {
    $checks++;
    if (!$condition) {
        throw new RuntimeException($message);
    }
};

$base_config = [
    'mode' => 'inline',
    'service_name' => 'Автотест единой формы',
    'recipient' => 'main',
    'agreement_mode' => 'custom',
    'agreement_text' => 'Согласие для теста',
    'agreement_required' => true,
    'fields' => [
        ['type' => 'text', 'name' => 'name', 'label' => 'Имя', 'required' => true],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'required' => true],
        ['type' => 'select', 'name' => 'topic', 'label' => 'Тема', 'required' => false, 'options' => [
            ['value' => 'demo', 'label' => 'Демо'],
        ]],
        ['type' => 'file', 'name' => 'resume', 'label' => 'Резюме', 'required' => false, 'allowed_extensions' => ['pdf'], 'max_file_size' => 2],
    ],
];

$normalized = space_form_normalize_config($base_config);
$assert($normalized['fields'][3]['max_file_size'] === 2 * MB_IN_BYTES, 'Лимит файла должен переводиться из МБ в байты.');
$assert($normalized['recipient'] === 'main', 'Допустимый тип получателя должен сохраняться.');
$assert(space_form_normalize_config(['recipient' => 'attacker@example.test'])['recipient'] === 'main', 'Произвольный получатель должен заменяться на main.');

$token = space_form_create_schema_token($base_config);
$assert($token !== '', 'Подписанная схема должна создаваться.');
$assert(!is_wp_error(space_form_verify_schema_token($token)), 'Корректная схема должна проходить проверку.');
$tampered = substr($token, 0, -1) . (substr($token, -1) === 'a' ? 'b' : 'a');
$assert(is_wp_error(space_form_verify_schema_token($tampered)), 'Изменённая схема должна отклоняться.');

$nonce = wp_create_nonce(space_form_nonce_action());
$valid_request = [
    'form_nonce' => $nonce,
    'form_schema' => $token,
    'form_agreement' => '1',
    'custom_field' => [
        'name' => ['value' => 'Серверный тест'],
        'email' => ['value' => 'qa@example.test'],
        'topic' => ['value' => 'demo'],
    ],
];

$result = space_form_process_submission(array_merge($valid_request, ['form_nonce' => 'invalid']), []);
$assert(($result['error'] ?? '') === 'invalid_nonce', 'Некорректный nonce должен отклоняться.');

$without_agreement = $valid_request;
unset($without_agreement['form_agreement']);
$result = space_form_process_submission($without_agreement, []);
$assert(($result['errors']['form_agreement'] ?? '') === 'required', 'Обязательное согласие должно проверяться на сервере.');

$invalid_email = $valid_request;
$invalid_email['custom_field']['email']['value'] = 'not-an-email';
$result = space_form_process_submission($invalid_email, []);
$assert(($result['errors']['email'] ?? '') === 'invalid_email', 'Email должен валидироваться на сервере.');

$invalid_option = $valid_request;
$invalid_option['custom_field']['topic']['value'] = 'unknown';
$result = space_form_process_submission($invalid_option, []);
$assert(($result['errors']['topic'] ?? '') === 'invalid_option', 'Значение select вне подписанного списка должно отклоняться.');

$dangerous_file = tempnam(sys_get_temp_dir(), 'space-form-');
file_put_contents($dangerous_file, '<?php echo "unsafe";');
$file_result = space_form_handle_uploads($normalized, [
    'name' => ['resume' => 'resume.php'],
    'type' => ['resume' => 'application/x-httpd-php'],
    'tmp_name' => ['resume' => $dangerous_file],
    'error' => ['resume' => UPLOAD_ERR_OK],
    'size' => ['resume' => filesize($dangerous_file)],
]);
unlink($dangerous_file);
$assert(($file_result['errors']['resume'] ?? '') === 'invalid_file_type', 'Опасное расширение файла должно отклоняться.');

$mail_calls = [];
$mail_filter = static function ($return, array $atts) use (&$mail_calls) {
    $mail_calls[] = $atts;
    return true;
};
add_filter('pre_wp_mail', $mail_filter, 10, 2);

try {
    $before = get_posts([
        'post_type' => 'mail',
        'post_status' => 'any',
        'title' => $base_config['service_name'],
        'fields' => 'ids',
        'numberposts' => -1,
    ]);
    $result = space_form_process_submission($valid_request, []);
    $assert(($result['status'] ?? false) === true, 'Валидная заявка должна завершаться успехом.');
    $assert(count($mail_calls) >= 1, 'Почтовое уведомление должно вызываться через wp_mail.');
    foreach ($mail_calls as $mail_call) {
        $recipients = (array) ($mail_call['to'] ?? []);
        foreach ($recipients as $recipient) {
            $assert((bool) is_email($recipient), 'Получатель должен быть доверенным валидным email из настроек.');
            $assert($recipient !== 'qa@example.test', 'Email посетителя не должен становиться получателем.');
        }
    }
    $after = get_posts([
        'post_type' => 'mail',
        'post_status' => 'any',
        'title' => $base_config['service_name'],
        'fields' => 'ids',
        'numberposts' => -1,
    ]);
    $created_posts = array_values(array_diff($after, $before));
    $assert(count($created_posts) === 1, 'Успешная отправка должна создать одну заявку mail.');
    $content = (string) get_post_field('post_content', $created_posts[0]);
    $assert(strpos($content, 'Серверный тест') !== false, 'Заявка должна содержать очищенные значения формы.');
} finally {
    remove_filter('pre_wp_mail', $mail_filter, 10);
    foreach ($created_posts as $post_id) {
        wp_delete_post($post_id, true);
    }
}

echo "PASS: {$checks} server form checks; wp_mail intercepted.\n";
