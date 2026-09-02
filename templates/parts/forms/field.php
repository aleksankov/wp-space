<?php

if (!defined('ABSPATH')) {
    exit;
}

$field = is_array($args['field'] ?? null) ? $args['field'] : [];
$field_id = sanitize_html_class((string) ($args['field_id'] ?? ''));
$layout = in_array($args['layout'] ?? '', ['inline', 'popup', 'home', 'vacancy'], true)
    ? $args['layout']
    : 'inline';
$type = $field['type'] ?? '';
$name = sanitize_key((string) ($field['name'] ?? ''));
$label = (string) ($field['label'] ?? '');
$required = !empty($field['required']);
$column_classes = [
    'popup' => 'main-popup__form-col',
    'inline' => 'product-feedback__col',
    'home' => 'demo__form-col',
    'vacancy' => 'vacancy-feedback__form-col',
];
$column_class = $column_classes[$layout];
$control_modifier = $layout === 'inline' ? ' main-input--transparent' : '';

if ($name === '' || !in_array($type, space_form_allowed_field_types(), true)) {
    return;
}

if ($type === 'textarea' || $type === 'file') {
    $large_classes = [
        'popup' => ' main-popup__form-col--lg',
        'inline' => ' product-feedback__col--lg',
        'home' => ' demo__form-col--lg',
        'vacancy' => ' vacancy-feedback__form-col--full vacancy-feedback__form-col--lg',
    ];
    $column_class .= $large_classes[$layout];
} elseif ($layout === 'vacancy' && $name === 'name') {
    $column_class .= ' vacancy-feedback__form-col--full';
}

if ($type === 'hidden') {
    return;
}
?>
<div class="<?= esc_attr($column_class); ?>" data-form-field="<?= esc_attr($name); ?>">
    <?php if (in_array($type, ['select', 'products', 'partners', 'production'], true)): ?>
        <div class="main-select<?= $layout === 'inline' ? ' main-select--transparent' : ''; ?>">
            <label class="screen-reader-text" for="<?= esc_attr($field_id); ?>"><?= esc_html($label); ?></label>
            <select
                id="<?= esc_attr($field_id); ?>"
                class="js-select js-select-custom-field js-feedback-input"
                name="custom_field[<?= esc_attr($name); ?>][value]"
                <?= $required ? 'required data-required' : ''; ?>>
                <option value=""><?= esc_html($label); ?></option>
                <?php foreach ((array) ($field['options'] ?? []) as $option): ?>
                    <option value="<?= esc_attr($option['value'] ?? ''); ?>"><?= esc_html($option['label'] ?? ''); ?></option>
                <?php endforeach; ?>
            </select>
            <span class="js-select-toggle" aria-hidden="true"><?= esc_html($label); ?></span>
        </div>
    <?php elseif ($type === 'file'): ?>
        <div class="<?= $layout === 'vacancy' ? 'form-file js-form-file' : 'main-file'; ?> js-form-file-block">
            <input
                id="<?= esc_attr($field_id); ?>"
                class="js-form-file-input js-feedback-input"
                type="file"
                name="custom_file[<?= esc_attr($name); ?>]"
                accept="<?= esc_attr(implode(',', array_map(static function ($extension): string {
                    return '.' . $extension;
                }, $field['allowed_extensions']))); ?>"
                data-max-size="<?= esc_attr((string) $field['max_file_size']); ?>"
                <?= $required ? 'required data-required' : ''; ?>>
            <?php if ($layout === 'vacancy'): ?>
                <label class="form-file__block" for="<?= esc_attr($field_id); ?>">
                    <div class="form-file__icon">
                        <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/form-file-icon.svg'); ?>" alt="">
                    </div>
                    <div class="form-file__sub">Перетащите файл сюда</div>
                    <div class="form-file__desc">Или <span>нажмите для загрузки файла</span></div>
                    <div class="form-file__accept">
                        Форматы: <?= esc_html(implode(', ', $field['allowed_extensions'])); ?>.
                        До <?= esc_html((string) round($field['max_file_size'] / MB_IN_BYTES)); ?> Мб.
                    </div>
                </label>
                <div class="form-file__name js-form-file-name-wrap">
                    <span class="js-form-file-name"></span>
                    <button class="js-form-file-remove" type="button" aria-label="Удалить выбранный файл">×</button>
                </div>
            <?php else: ?>
                <label for="<?= esc_attr($field_id); ?>"><?= esc_html($label); ?></label>
                <span class="js-form-file-name-wrap">
                    <span class="js-form-file-name"></span>
                    <button class="js-form-file-remove" type="button" aria-label="Удалить выбранный файл">×</button>
                </span>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="<?= $layout === 'vacancy' ? 'form-input' : 'main-input'; ?><?= esc_attr($control_modifier); ?>">
            <label for="<?= esc_attr($field_id); ?>">
                <?php if ($type === 'textarea'): ?>
                    <textarea
                        id="<?= esc_attr($field_id); ?>"
                        class="js-form-input js-feedback-input<?= $layout === 'vacancy' ? ' js-textarea' : ''; ?>"
                        name="custom_field[<?= esc_attr($name); ?>][value]"
                        maxlength="<?= esc_attr((string) $field['max_length']); ?>"
                        <?= $required ? 'required data-required' : ''; ?>></textarea>
                <?php else: ?>
                    <input
                        id="<?= esc_attr($field_id); ?>"
                        class="js-form-input <?= $type === 'tel' ? 'js-tel-input ' : ''; ?>js-feedback-input"
                        type="<?= esc_attr($type); ?>"
                        name="custom_field[<?= esc_attr($name); ?>][value]"
                        maxlength="<?= esc_attr((string) $field['max_length']); ?>"
                        <?= $required ? 'required data-required' : ''; ?>>
                <?php endif; ?>
                <span><?= esc_html($label); ?></span>
                <?php if ($type === 'textarea' && $layout === 'vacancy'): ?>
                    <div class="form-input__counter js-textarea-counter">0/<?= esc_html((string) $field['max_length']); ?></div>
                <?php endif; ?>
            </label>
        </div>
    <?php endif; ?>
    <input type="hidden" name="custom_field[<?= esc_attr($name); ?>][title]" value="<?= esc_attr($label); ?>">
    <div class="form-field-error" data-form-error aria-live="polite"></div>
</div>
