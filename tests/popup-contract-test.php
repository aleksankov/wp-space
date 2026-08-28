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
$template = $read('functions/blocks/form-custom-popup/template.php');
$ajax = $read('functions/ajax/feedback-form.php');
$javascript = $read('assets/js/main.js');
$connect = $read('templates/space/connect.php');
$global_group = json_decode($read('acf-json/group_space_popup_settings.json'), true);
$block_group = json_decode($read('acf-json/group_68e777907b682.json'), true);

$assert(is_array($global_group), 'JSON глобальных настроек ACF должен быть валидным.');
$assert(is_array($block_group), 'JSON блока поп-апа ACF должен быть валидным.');

foreach (['demo-popup', 'feedback-success', 'feedback-error'] as $popup_id) {
    $assert(substr_count($footer, 'id="' . $popup_id . '"') === 1, "Глобальный {$popup_id} должен быть в footer.php ровно один раз.");
}

foreach (['demo-vm', 'buy-vm', 'demo-vdi', 'buy-vdi', 'partner-popup'] as $popup_id) {
    $assert(strpos($footer, 'id="' . $popup_id . '"') === false, "Страничный {$popup_id} не должен оставаться в footer.php.");
}
$assert(strpos($connect, 'id="tech-partner-popup"') === false, 'tech-partner-popup не должен оставаться в шаблоне Space Connect.');
$assert(strpos($footer, 'space_render_page_popup_blocks()') !== false, 'Footer должен рендерить popup-блоки текущей страницы.');

foreach (['Заявка на демо-версию', 'Заявка успешно отправлена!', 'При отправке произошла ошибка.'] as $fallback) {
    $assert(strpos($footer, $fallback) !== false, "Глобальный fallback «{$fallback}» должен быть сохранён.");
}

foreach (['text', 'tel', 'email', 'select', 'partners', 'products', 'production', 'textarea'] as $field_type) {
    $assert(strpos($template, "'{$field_type}'") !== false, "Шаблон должен поддерживать поле {$field_type}.");
}

foreach (['main', 'partner', 'tech_partner'] as $recipient) {
    $assert(strpos($template, "'{$recipient}'") !== false, "Шаблон должен поддерживать получателя {$recipient}.");
    $assert(strpos($ajax, "'{$recipient}' => 'site_feedback_") !== false, "AJAX должен сопоставлять получателя {$recipient} с настройкой сайта.");
}

$custom_handler_position = strpos($ajax, 'function ajax_feedback_form_custom()');
$assert($custom_handler_position !== false, 'Custom AJAX handler должен быть зарегистрирован.');
$custom_handler = $custom_handler_position === false ? '' : substr($ajax, $custom_handler_position);
$assert(strpos($custom_handler, "\$_POST['to']") === false, 'Custom AJAX не должен принимать произвольный адресат из POST.');
$assert(strpos($custom_handler, "array_unique(array_filter(\$recipients, 'is_email'))") !== false, 'Адресаты должны валидироваться и дедуплицироваться.');
$assert(strpos($custom_handler, "wp_send_json(['status' =>") !== false, 'Custom AJAX должен возвращать совместимый status boolean.');
$assert(strpos($custom_handler, "'post_type' => 'mail'") !== false, 'Custom AJAX должен сохранять заявку в mail CPT.');

$assert(strpos($template, "\$GLOBALS['space_rendered_popup_ids']") !== false, 'Шаблон должен предотвращать повторный вывод popup ID.');
$assert(strpos($template, 'form-custom-popup-show-image') !== false, 'Шаблон должен учитывать переключатель изображения.');
$assert(strpos($template, 'wp_get_attachment_image') !== false, 'Шаблон должен поддерживать загруженное изображение.');
$assert(strpos($template, 'form-custom-popup-legacy-image') !== false, 'Шаблон должен сохранять fallback изображения темы.');
$assert(strpos($template, "agreement_mode === 'global'") !== false, 'Шаблон должен поддерживать глобальный текст согласия.');

$assert(strpos($javascript, "$(document).on('submit', '.js-form-custom'") !== false, 'Отправка custom-формы должна быть делегированной.');
$assert(strpos($javascript, "formData.append('action', 'feedback_form_custom')") !== false, 'JS должен отправлять custom AJAX action.');
$assert(strpos($javascript, "openFeedbackPopup('#feedback-success')") !== false, 'JS должен открывать окно успешной отправки.');
$assert(strpos($javascript, "openFeedbackPopup('#feedback-error')") !== false, 'JS должен открывать окно ошибки.');
$assert(strpos($javascript, 'if (!field.hasAttribute(\'data-required\'))') !== false, 'JS должен пропускать необязательные поля при валидации.');

if ($failures) {
    fwrite(STDERR, "Проверки поп-апов не пройдены:\n- " . implode("\n- ", $failures) . "\n");
    exit(1);
}

echo "Проверки поп-апов пройдены: {$checks}.\n";
