<?php
if (!defined('ABSPATH')) {
    exit;
}

$block = $args['block'] ?? null;
$block_id = is_array($block) && !empty($block['id']) ? $block['id'] : 'form-custom';
$configured_id = get_field_block('form-custom-popup-id', $block);
$form_id = sanitize_title($configured_id ?: $block_id);
$space_rendered_popup_ids = $GLOBALS['space_rendered_popup_ids'] ?? [];

if (isset($space_rendered_popup_ids[$form_id])) {
    return;
}

$space_rendered_popup_ids[$form_id] = true;
$GLOBALS['space_rendered_popup_ids'] = $space_rendered_popup_ids;
$title = get_field_block('form-custom-popup-title', $block);
$title_form = get_field_block('form-custom-popup-title-form', $block) ?: 'Заявка';
$fields = get_field_block('form-custom-popup-fields', $block);
$fields = is_array($fields) ? $fields : [];
$submit_label = get_field_block('form-custom-popup-submit-label', $block) ?: 'Отправить';
$variant = get_field_block('form-custom-popup-variant', $block) ?: 'simple';
$recipient_type = get_field_block('form-custom-popup-recipient', $block) ?: 'main';
$agreement_mode = get_field_block('form-custom-popup-agreement-mode', $block) ?: 'global';
$agreement_text = get_field_block('form-custom-popup-agreement-text', $block);
$show_image = (bool) get_field_block('form-custom-popup-show-image', $block);
$image_id = (int) get_field_block('form-custom-popup-image', $block);
$legacy_image = get_field_block('form-custom-popup-legacy-image', $block) ?: 'none';
$image_caption = get_field_block('form-custom-popup-image-caption', $block);

$allowed_variants = ['default', 'simple', 'aqua'];
$variant = in_array($variant, $allowed_variants, true) ? $variant : 'simple';
$allowed_recipients = ['main', 'partner', 'tech_partner'];
$recipient_type = in_array($recipient_type, $allowed_recipients, true) ? $recipient_type : 'main';

if ($agreement_mode === 'global') {
    $agreement_text = get_field('site_forms_agree', 'option');
} elseif ($agreement_mode === 'hidden') {
    $agreement_text = '';
}

$legacy_images = [
    'vm' => ['file' => 'main-popup-img-1.png', 'alt' => 'SpaceVM'],
    'vdi' => ['file' => 'main-popup-img-2.png', 'alt' => 'SpaceVDI'],
    'space' => ['file' => 'main-popup-img-3.png', 'alt' => 'Space'],
];
$wrapper_classes = ['main-popup'];
$form_classes = ['main-popup__form', 'ajax-wrap', 'js-form-custom'];

if ($variant === 'simple') {
    $wrapper_classes[] = 'main-popup--simple';
} elseif ($variant === 'aqua') {
    $form_classes[] = 'main-popup__form--aqua';
}
?>

<div class="<?= esc_attr(implode(' ', $wrapper_classes)); ?>" id="<?= esc_attr($form_id); ?>">
    <button class="main-popup__close" type="button" data-fancybox-close>
        <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/close-icon.svg'); ?>" alt="Close">
    </button>
    <div class="main-popup__wrap">
        <?php if ($show_image && ($image_id || isset($legacy_images[$legacy_image]))): ?>
            <div class="main-popup__left">
                <div class="main-popup__img">
                    <?php if ($image_id): ?>
                        <?= wp_get_attachment_image($image_id, 'full', false, ['alt' => wp_strip_all_tags($image_caption ?: $title_form)]); ?>
                    <?php else: ?>
                        <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/' . $legacy_images[$legacy_image]['file']); ?>" alt="<?= esc_attr($legacy_images[$legacy_image]['alt']); ?>">
                    <?php endif; ?>
                    <?php if ($image_caption): ?>
                        <div class="main-popup__sub"><?= wp_kses_post($image_caption); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="main-popup__right">
            <form class="<?= esc_attr(implode(' ', $form_classes)); ?>">
                <?php if ($title): ?>
                    <div class="main-popup__form-title"><?= wp_kses_post($title); ?></div>
                <?php endif; ?>
                <div class="main-popup__form-list ajax-wrap__item">
                    <?php foreach ($fields as $field): ?>
                        <?php
                        $field_type = $field['form-custom-popup-fields-type'] ?? '';
                        $field_name = sanitize_key($field['form-custom-popup-fields-name'] ?? '');
                        $field_label = $field['form-custom-popup-fields-placeholder'] ?? '';
                        $required = !empty($field['form-custom-fields-popup-required']);

                        if (!$field_name || !in_array($field_type, ['text', 'tel', 'email', 'select', 'partners', 'products', 'production', 'textarea'], true)) {
                            continue;
                        }
                        ?>
                        <?php if (in_array($field_type, ['text', 'tel', 'email'], true)): ?>
                            <div class="main-popup__form-col">
                                <div class="main-input">
                                    <label>
                                        <input type="hidden" name="custom_field[<?= esc_attr($field_name); ?>][title]" value="<?= esc_attr($field_label); ?>">
                                        <input
                                            <?= $required ? 'data-required' : ''; ?>
                                            class="js-form-input <?= $field_type === 'tel' ? 'js-tel-input ' : ''; ?>js-feedback-input"
                                            type="<?= esc_attr($field_type); ?>"
                                            name="custom_field[<?= esc_attr($field_name); ?>][value]">
                                        <span><?= esc_html($field_label); ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php elseif ($field_type === 'textarea'): ?>
                            <div class="main-popup__form-col main-popup__form-col--lg">
                                <div class="main-input">
                                    <label>
                                        <input type="hidden" name="custom_field[<?= esc_attr($field_name); ?>][title]" value="<?= esc_attr($field_label); ?>">
                                        <textarea
                                            class="js-form-input js-feedback-input"
                                            <?= $required ? 'data-required' : ''; ?>
                                            name="custom_field[<?= esc_attr($field_name); ?>][value]"></textarea>
                                        <span><?= esc_html($field_label); ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php
                            $variants = $field['form-custom-popup-fields-variants'] ?? [];
                            $variants = is_array($variants) ? $variants : [];

                            if ($field_type === 'partners') {
                                $partners = get_field('site_forms_partners', 'option');
                                $variants = [];
                                foreach (is_array($partners) ? $partners : [] as $partner) {
                                    $variants[] = [
                                        'form-custom-popup-fields-variants-text' => $partner['item'] ?? '',
                                        'form-custom-popup-fields-variants-email' => $partner['email'] ?? '',
                                    ];
                                }
                            } elseif ($field_type === 'products') {
                                $products = get_field('site_forms_products', 'option');
                                $variants = [];
                                foreach (is_array($products) ? $products : [] as $product) {
                                    $variants[] = ['form-custom-popup-fields-variants-text' => $product['item'] ?? ''];
                                }
                            } elseif ($field_type === 'production') {
                                $variants = array_map(static function ($production) {
                                    return ['form-custom-popup-fields-variants-text' => $production];
                                }, get_production_values());
                            }
                            ?>
                            <div class="main-popup__form-col">
                                <div class="main-select">
                                    <input type="hidden" name="custom_field[<?= esc_attr($field_name); ?>][title]" value="<?= esc_attr($field_label); ?>">
                                    <select
                                        class="js-select js-select-custom-field js-feedback-input"
                                        <?= $required ? 'data-required' : ''; ?>
                                        name="custom_field[<?= esc_attr($field_name); ?>][value]">
                                        <option value="0">&nbsp;</option>
                                        <?php foreach ($variants as $field_variant): ?>
                                            <?php
                                            $option_text = $field_variant['form-custom-popup-fields-variants-text'] ?? '';
                                            $option_email = sanitize_email($field_variant['form-custom-popup-fields-variants-email'] ?? '');
                                            $signature = $option_email ? hash_hmac('sha256', $option_email, wp_salt('auth')) : '';
                                            ?>
                                            <option
                                                value="<?= esc_attr($option_text); ?>"
                                                <?= $option_email ? 'data-route-email="' . esc_attr($option_email) . '" data-route-signature="' . esc_attr($signature) . '"' : ''; ?>><?= esc_html($option_text); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="js-select-toggle"><?= esc_html($field_label); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if ($agreement_text): ?>
                    <div class="main-popup__form-agree ajax-wrap__item"><?= wp_kses_post($agreement_text); ?></div>
                <?php endif; ?>
                <div class="main-popup__form-btn ajax-wrap__item">
                    <button class="btn btn-white" type="submit"><?= esc_html($submit_label); ?></button>
                </div>
                <input type="hidden" name="form_name" value="<?= esc_attr($title_form); ?>">
                <input type="hidden" name="recipient_type" value="<?= esc_attr($recipient_type); ?>">
                <input type="hidden" name="route_email" value="">
                <input type="hidden" name="route_signature" value="">
            </form>
        </div>
    </div>
</div>
