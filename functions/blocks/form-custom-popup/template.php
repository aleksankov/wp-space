<?php

if (!defined('ABSPATH')) {
    exit;
}

$block = $args['block'] ?? null;
$config = space_form_config_from_block($block, 'popup');
$block_id = is_array($block) && !empty($block['id']) ? $block['id'] : wp_unique_id('form-custom-popup-');
$form_id = sanitize_title($config['id'] ?: $block_id);
$rendered_popup_ids = $GLOBALS['space_rendered_popup_ids'] ?? [];

if ($form_id === '' || isset($rendered_popup_ids[$form_id])) {
    return;
}

$rendered_popup_ids[$form_id] = true;
$GLOBALS['space_rendered_popup_ids'] = $rendered_popup_ids;

$agreement_text = space_form_get_agreement_text($config);
$show_image = (bool) get_field_block('form-custom-popup-show-image', $block);
$image_id = absint(get_field_block('form-custom-popup-image', $block));
$legacy_image = sanitize_key((string) get_field_block('form-custom-popup-legacy-image', $block));
$image_caption = (string) get_field_block('form-custom-popup-image-caption', $block);
$animation_enabled = (bool) get_field_block('form-custom-popup-anim-enabled', $block);
$animation_delay = absint(get_field_block('form-custom-popup-anim-delay', $block));
$legacy_images = [
    'vm' => ['file' => 'main-popup-img-1.png', 'alt' => 'SpaceVM'],
    'vdi' => ['file' => 'main-popup-img-2.png', 'alt' => 'Space VDI'],
    'space' => ['file' => 'main-popup-img-3.png', 'alt' => 'Space'],
];
$has_image = $show_image && ($image_id > 0 || isset($legacy_images[$legacy_image]));
$wrapper_classes = ['main-popup'];
$form_classes = ['main-popup__form', 'ajax-wrap', 'js-form-custom'];

if ($config['variant'] === 'simple') {
    $wrapper_classes[] = 'main-popup--simple';
} elseif ($config['variant'] === 'aqua') {
    $form_classes[] = 'main-popup__form--aqua';
}
?>

<div
    class="<?= esc_attr(implode(' ', $wrapper_classes)); ?>"
    id="<?= esc_attr($form_id); ?>"
    <?= $animation_enabled ? 'data-aos="fade-up"' : ''; ?>
    <?= $animation_enabled && $animation_delay ? 'data-aos-delay="' . esc_attr((string) $animation_delay) . '"' : ''; ?>>
    <button class="main-popup__close" type="button" data-fancybox-close>
        <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/close-icon.svg'); ?>" alt="Закрыть">
    </button>
    <div class="main-popup__wrap">
        <?php if ($has_image): ?>
            <div class="main-popup__left">
                <div class="main-popup__img">
                    <?php if ($image_id > 0): ?>
                        <?= wp_get_attachment_image($image_id, 'full', false, [
                            'alt' => wp_strip_all_tags($image_caption ?: $config['service_name']),
                        ]); ?>
                    <?php else: ?>
                        <img
                            src="<?= esc_url(get_template_directory_uri() . '/assets/img/' . $legacy_images[$legacy_image]['file']); ?>"
                            alt="<?= esc_attr($legacy_images[$legacy_image]['alt']); ?>">
                    <?php endif; ?>
                    <?php if ($image_caption !== ''): ?>
                        <div class="main-popup__sub"><?= wp_kses_post($image_caption); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="main-popup__right">
            <form class="<?= esc_attr(implode(' ', $form_classes)); ?>" enctype="multipart/form-data" novalidate>
                <?php if ($config['title'] !== ''): ?>
                    <div class="main-popup__form-title"><?= wp_kses_post($config['title']); ?></div>
                <?php endif; ?>
                <div class="main-popup__form-list ajax-wrap__item">
                    <?php space_form_render_fields($config, 'popup'); ?>
                </div>
                <?php space_form_render_agreement($config, 'main-popup__form-agree'); ?>
                <div class="main-popup__form-btn ajax-wrap__item">
                    <button class="btn btn-white" type="submit"><?= esc_html($config['submit_label']); ?></button>
                </div>
                <?php space_form_render_security_fields($config); ?>
                <input type="hidden" name="form_name" value="<?= esc_attr($config['service_name']); ?>">
                <input type="hidden" name="recipient_type" value="<?= esc_attr($config['recipient']); ?>">
            </form>
        </div>
    </div>
</div>
