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
        ['type' => 'tel', 'name' => 'phone', 'label' => 'Телефон', 'required' => true],
        ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'required' => true],
        ['type' => 'textarea', 'name' => 'message', 'label' => 'Комментарий', 'required' => false, 'max_length' => 20],
        ['type' => 'select', 'name' => 'topic', 'label' => 'Тема', 'required' => false, 'options' => [
            ['value' => 'demo', 'label' => 'Демо'],
        ]],
        ['type' => 'file', 'name' => 'resume', 'label' => 'Резюме', 'required' => false, 'allowed_extensions' => ['pdf'], 'max_file_size' => 2],
        ['type' => 'file', 'name' => 'attachment', 'label' => 'Вложение', 'required' => false, 'allowed_extensions' => ['docx'], 'max_file_size' => 1],
    ],
];

$normalized = space_form_normalize_config($base_config);
$assert($normalized['fields'][5]['max_file_size'] === 2 * MB_IN_BYTES, 'Лимит файла должен переводиться из МБ в байты.');
$assert($normalized['fields'][6]['max_file_size'] === MB_IN_BYTES, 'Каждое file-поле должно иметь независимый лимит.');
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
        'phone' => ['value' => '+7 (912) 345-67-89'],
        'email' => ['value' => 'qa@example.test'],
        'message' => ['value' => 'Комментарий'],
        'topic' => ['value' => 'demo'],
    ],
];

$result = space_form_process_submission(array_merge($valid_request, ['form_nonce' => 'invalid']), []);
$assert(($result['error'] ?? '') === 'invalid_nonce', 'Некорректный nonce должен отклоняться.');

$without_schema = $valid_request;
unset($without_schema['form_schema']);
$result = space_form_process_submission($without_schema, []);
$assert(($result['error'] ?? '') === 'invalid_schema', 'Отсутствующая подписанная схема должна отклоняться.');

$verified_config = space_form_verify_schema_token($token);
$assert(!is_wp_error($verified_config) && $verified_config['recipient'] === 'main', 'Получатель должен извлекаться из подписанной схемы, а не из recipient_type клиента.');

$without_agreement = $valid_request;
unset($without_agreement['form_agreement']);
$result = space_form_process_submission($without_agreement, []);
$assert(($result['errors']['form_agreement'] ?? '') === 'required', 'Обязательное согласие должно проверяться на сервере.');

$without_name = $valid_request;
$without_name['custom_field']['name']['value'] = '';
$result = space_form_process_submission($without_name, []);
$assert(($result['errors']['name'] ?? '') === 'required', 'Обязательное текстовое поле должно проверяться на сервере.');

$invalid_phone = $valid_request;
$invalid_phone['custom_field']['phone']['value'] = 'abc';
$result = space_form_process_submission($invalid_phone, []);
$assert(($result['errors']['phone'] ?? '') === 'invalid_phone', 'Телефон должен валидироваться на сервере.');

$long_message = $valid_request;
$long_message['custom_field']['message']['value'] = str_repeat('я', 21);
$result = space_form_process_submission($long_message, []);
$assert(($result['errors']['message'] ?? '') === 'too_long', 'Textarea должен соблюдать подписанную максимальную длину.');

$invalid_email = $valid_request;
$invalid_email['custom_field']['email']['value'] = 'not-an-email';
$result = space_form_process_submission($invalid_email, []);
$assert(($result['errors']['email'] ?? '') === 'invalid_email', 'Email должен валидироваться на сервере.');

$invalid_option = $valid_request;
$invalid_option['custom_field']['topic']['value'] = 'unknown';
$result = space_form_process_submission($invalid_option, []);
$assert(($result['errors']['topic'] ?? '') === 'invalid_option', 'Значение select вне подписанного списка должно отклоняться.');

$optional_result = space_form_validate_values($normalized, [
    'name' => ['value' => 'QA'],
    'phone' => ['value' => '+7 (912) 345-67-89'],
    'email' => ['value' => 'qa@example.test'],
    'message' => ['value' => ''],
]);
$assert(empty($optional_result['errors']['message']) && empty($optional_result['errors']['topic']), 'Пустые optional-поля не должны создавать ошибки валидации.');

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

$oversize_file = tempnam(sys_get_temp_dir(), 'space-form-');
file_put_contents($oversize_file, '%PDF-1.4');
$file_result = space_form_handle_uploads($normalized, [
    'name' => ['resume' => 'resume.pdf'],
    'type' => ['resume' => 'application/pdf'],
    'tmp_name' => ['resume' => $oversize_file],
    'error' => ['resume' => UPLOAD_ERR_OK],
    'size' => ['resume' => 3 * MB_IN_BYTES],
]);
unlink($oversize_file);
$assert(($file_result['errors']['resume'] ?? '') === 'file_too_large', 'Превышение лимита файла должно отклоняться.');

$partial_file = space_form_handle_uploads($normalized, [
    'name' => ['resume' => 'resume.pdf'],
    'type' => ['resume' => 'application/pdf'],
    'tmp_name' => ['resume' => ''],
    'error' => ['resume' => UPLOAD_ERR_PARTIAL],
    'size' => ['resume' => 0],
]);
$assert(($partial_file['errors']['resume'] ?? '') === 'upload_failed', 'PHP upload error должен возвращать безопасную ошибку.');

$spoofed_file = tempnam(sys_get_temp_dir(), 'space-form-');
file_put_contents($spoofed_file, '<?php echo "unsafe";');
$file_result = space_form_handle_uploads($normalized, [
    'name' => ['resume' => 'resume.pdf'],
    'type' => ['resume' => 'application/pdf'],
    'tmp_name' => ['resume' => $spoofed_file],
    'error' => ['resume' => UPLOAD_ERR_OK],
    'size' => ['resume' => filesize($spoofed_file)],
]);
unlink($spoofed_file);
$assert(($file_result['errors']['resume'] ?? '') === 'invalid_file_type', 'Подмена содержимого при разрешённом расширении должна отклоняться.');

$insert_filter = static function (): bool {
    return true;
};
add_filter('wp_insert_post_empty_content', $insert_filter);
$result = space_form_process_submission($valid_request, []);
remove_filter('wp_insert_post_empty_content', $insert_filter);
$assert(($result['error'] ?? '') === 'request_creation_failed', 'Ошибка создания CPT mail должна корректно возвращаться клиенту.');

$before_failed_mail = get_posts([
    'post_type' => 'mail', 'post_status' => 'any', 'title' => $base_config['service_name'],
    'fields' => 'ids', 'numberposts' => -1,
]);
$failed_mail_filter = static function () {
    return false;
};
add_filter('pre_wp_mail', $failed_mail_filter);
$result = space_form_process_submission($valid_request, []);
remove_filter('pre_wp_mail', $failed_mail_filter);
$assert(($result['error'] ?? '') === 'mail_failed', 'Ошибка wp_mail должна возвращать mail_failed.');
$after_failed_mail = get_posts([
    'post_type' => 'mail', 'post_status' => 'any', 'title' => $base_config['service_name'],
    'fields' => 'ids', 'numberposts' => -1,
]);
foreach (array_diff($after_failed_mail, $before_failed_mail) as $post_id) {
    wp_delete_post($post_id, true);
}

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

foreach (['space-home-form', 'space-vacancy-form'] as $source_slug) {
    $source = get_page_by_path($source_slug, OBJECT, 'wp_block');
    $assert($source instanceof WP_Post, 'Gutenberg source должен существовать: ' . $source_slug . '.');
    if ($source instanceof WP_Post) {
        $rendered = do_blocks($source->post_content);
        $assert(strpos($rendered, 'form_schema') !== false, 'Gutenberg preview должен рендерить подписанную форму: ' . $source_slug . '.');
    }
}

echo "PASS: {$checks} server form checks; wp_mail intercepted.\n";
