<?php

if (!defined('ABSPATH')) {
    exit;
}

$block = $args['block'] ?? null;
$config = space_form_config_from_block($block, 'inline');
$block_id = is_array($block) && !empty($block['anchor'])
    ? sanitize_title($block['anchor'])
    : sanitize_html_class((string) ($block['id'] ?? wp_unique_id('form-custom-')));
$custom_class = is_array($block) ? sanitize_html_class((string) ($block['className'] ?? '')) : '';
$animation_enabled = (bool) get_field_block('form-custom-anim-enabled', $block);
$animation_delay = absint(get_field_block('form-custom-anim-delay', $block));
$agreement_text = space_form_get_agreement_text($config);
$mobile_popup_id = 'popup-' . $block_id;
$form_dom_id = $block_id . '-form';
$section_classes = array_filter([
    'product-feedback',
    'section',
    'product-feedback--' . $config['variant'],
    $custom_class,
]);
?>

<section
    id="<?= esc_attr($block_id); ?>"
    class="<?= esc_attr(implode(' ', $section_classes)); ?>"
    <?= $animation_enabled ? 'data-aos="fade-up"' : ''; ?>
    <?= $animation_enabled && $animation_delay ? 'data-aos-delay="' . esc_attr((string) $animation_delay) . '"' : ''; ?>>
    <div class="container">
        <div class="product-feedback__wrap">
            <div class="product-feedback__bg" aria-hidden="true">
                <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/product-feedback-bg-1.jpg'); ?>" alt="">
            </div>
            <?php if ($config['title'] !== ''): ?>
                <h2 class="product-feedback__title"><?= wp_kses_post($config['title']); ?></h2>
            <?php endif; ?>
            <div class="product-feedback__form-mount" data-inline-form-home>
            <form id="<?= esc_attr($form_dom_id); ?>" class="product-feedback__form ajax-wrap js-form-custom" enctype="multipart/form-data" novalidate>
                <?php if ($config['title'] !== ''): ?>
                    <div class="product-feedback__mobile-title"><?= wp_kses_post($config['title']); ?></div>
                <?php endif; ?>
                <div class="product-feedback__row ajax-wrap__item">
                    <?php space_form_render_fields($config, 'inline'); ?>
                </div>
                <div class="product-feedback__bottom ajax-wrap__item">
                    <?php space_form_render_agreement($config, 'product-feedback__agree'); ?>
                    <div class="product-feedback__btn">
                        <button class="btn btn-white" type="submit"><?= esc_html($config['submit_label']); ?></button>
                    </div>
                </div>
                <?php space_form_render_security_fields($config); ?>
                <input type="hidden" name="form_name" value="<?= esc_attr($config['service_name']); ?>">
                <input type="hidden" name="recipient_type" value="<?= esc_attr($config['recipient']); ?>">
            </form>
            </div>
            <div class="product-feedback__mob-btn">
                <a
                    class="btn btn-white js-inline-form-mobile-trigger"
                    href="#<?= esc_attr($mobile_popup_id); ?>"
                    data-form-id="<?= esc_attr($form_dom_id); ?>">Продолжить</a>
            </div>
        </div>
    </div>

    <div class="main-popup main-popup--simple" id="<?= esc_attr($mobile_popup_id); ?>">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/close-icon.svg'); ?>" alt="Закрыть">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <div data-inline-form-mobile-mount></div>
            </div>
        </div>
    </div>
</section>
