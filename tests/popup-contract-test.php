<?php

$theme_dir = dirname(__DIR__);
$failures = [];
$checks = 0;
$assert = static function (bool $condition, string $message) use (&$failures, &$checks): void {
    $checks++;
    if (!$condition) {
        $failures[] = $message;
    }
};
$read = static function (string $path) use ($theme_dir): string {
    $contents = file_get_contents($theme_dir . '/' . $path);
    if ($contents === false) {
        throw new RuntimeException('Не удалось прочитать ' . $path);
    }
    return $contents;
};

$footer = $read('footer.php');
$inline_template = $read('functions/blocks/form-custom/template.php');
$popup_template = $read('functions/blocks/form-custom-popup/template.php');
$ajax = $read('functions/ajax/feedback-form.php');
$submission = $read('functions/forms/submission.php');
$security = $read('functions/forms/security.php');
$validation = $read('functions/forms/validation.php');
$recipients = $read('functions/forms/recipients.php');
$uploads = $read('functions/forms/uploads.php');
$javascript = $read('assets/js/main.js');
$source_migrator_path = $theme_dir . '/functions/migrations/migrate-form-sources.php';
$source_migrator = file_get_contents($source_migrator_path);
$assert($source_migrator !== false, 'Не удалось прочитать мигратор источников форм.');

foreach (glob($theme_dir . '/acf-json/*.json') as $json_file) {
    $assert(is_array(json_decode((string) file_get_contents($json_file), true)), basename($json_file) . ' должен быть валидным JSON.');
}

$assert(substr_count($footer, 'id="feedback-success"') === 1, 'feedback-success должен оставаться в footer ровно один раз.');
$assert(substr_count($footer, 'id="feedback-error"') === 1, 'feedback-error должен оставаться в footer ровно один раз.');
$assert(strpos($footer, 'id="demo-popup"') === false, 'demo-popup не должен оставаться жёстко заданным в footer.');
$assert(strpos($footer, 'space_render_page_popup_blocks()') !== false, 'Footer должен собирать popup-блоки текущей страницы.');

$assert(!is_dir($theme_dir . '/functions/blocks/form'), 'Каталог старого acf/form должен быть удалён.');
$assert(!file_exists($theme_dir . '/acf-json/group_67bd538ef2657.json'), 'ACF-группа старого acf/form должна быть удалена.');
$assert(strpos($javascript, "$(document).on('submit', '.js-form',") === false, 'Старая JS-ветка .js-form должна быть удалена.');
$assert(strpos($ajax, "wp_ajax_nopriv_feedback_form'") === false, 'Старый AJAX action feedback_form должен быть удалён.');

foreach (['config.php', 'security.php', 'render.php', 'validation.php', 'recipients.php', 'uploads.php', 'submission.php', 'sources.php'] as $module) {
    $assert(file_exists($theme_dir . '/functions/forms/' . $module), 'Отсутствует общий модуль forms/' . $module . '.');
}

foreach (['file', 'products', 'partners', 'production', 'hidden'] as $type) {
    $assert(strpos($read('functions/forms/config.php'), "'{$type}'") !== false, 'Общая схема должна поддерживать ' . $type . '.');
}
foreach (['main', 'partner', 'tech_partner', 'hr'] as $recipient) {
    $assert(strpos($recipients, "'{$recipient}' => 'site_feedback_") !== false, 'Нет server-side маршрута ' . $recipient . '.');
}

$assert(strpos($security, "hash_hmac('sha256'") !== false, 'Схема формы должна иметь HMAC-подпись.');
$assert(strpos($security, 'wp_verify_nonce') !== false, 'AJAX должен проверять nonce.');
$assert(strpos($validation, 'invalid_email') !== false && strpos($validation, 'invalid_phone') !== false, 'Нужна серверная type validation.');
$assert(strpos($uploads, 'wp_check_filetype_and_ext') !== false, 'Файл должен проверяться по расширению и MIME.');
$assert(strpos($uploads, 'wp_handle_upload') !== false, 'Файл должен загружаться средствами WordPress.');
$assert(strpos($submission, 'wp_insert_post') < strpos($submission, 'wp_mail'), 'Заявка должна создаваться до отправки письма.');
$assert(strpos($submission, "'errors' =>") !== false, 'Ответ должен поддерживать field errors.');
$assert(strpos($ajax, 'space_form_process_submission') !== false, 'Оба режима должны использовать общий submission service.');

$assert(strpos($inline_template, 'space_form_render_fields') !== false, 'Inline-блок должен использовать общий renderer.');
$assert(strpos($popup_template, 'space_form_render_fields') !== false, 'Popup-блок должен использовать общий renderer.');
$assert(strpos($popup_template, "\$GLOBALS['space_rendered_popup_ids']") !== false, 'Popup ID должен дедуплицироваться.');
$assert(strpos($popup_template, 'wp_get_attachment_image') !== false, 'Popup должен поддерживать изображение из медиатеки.');
$assert(strpos($javascript, "formData.append('action', 'feedback_form_custom')") !== false, 'Frontend должен использовать единый action.');
$assert(strpos($javascript, 'await request.text()') !== false, 'Frontend должен безопасно обрабатывать некорректный JSON.');
$assert(strpos($javascript, 'if (form.classList.contains(\'loading\'))') !== false, 'Frontend должен блокировать двойную отправку.');

if (is_string($source_migrator)) {
    foreach (['demo-popup', 'demo-vm', 'buy-vm', 'demo-vdi', 'buy-vdi', 'partner-popup', 'tech-partner-popup', 'download_custom1'] as $popup_id) {
        $assert(strpos($source_migrator, "'id' => '{$popup_id}'") !== false, 'Мигратор должен создавать popup ID ' . $popup_id . '.');
    }
    foreach (['space-vm', 'space-vdi', 'partners', 'space-connect'] as $page_slug) {
        $assert(strpos($source_migrator, "'{$page_slug}' =>") !== false, 'В миграторе нет привязки для страницы ' . $page_slug . '.');
    }
    foreach (['templates/space/vm.php', 'templates/space/vdi.php', 'templates/partners/partners.php', 'templates/space/connect.php'] as $page_template) {
        $assert(strpos($source_migrator, "'{$page_template}' =>") !== false, 'В миграторе нет привязки по шаблону ' . $page_template . '.');
    }
    $assert(strpos($source_migrator, "strpos(\$page->post_content, '#' . \$popup_id)") !== false, 'Мигратор должен находить Popup ID в редакторском контенте.');
    $assert(strpos($source_migrator, "\$config['id'] !== \$source['config']['id']") !== false, 'Мигратор должен проверять ID каждого источника.');
}

if ($failures) {
    fwrite(STDERR, "FAIL\n- " . implode("\n- ", $failures) . "\n");
    exit(1);
}

echo "PASS: {$checks} contract checks.\n";
