<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'comments';
$class = isset($block['className']) ? $block['className'] : 'default';

$cases = get_field_block('slider', $block);
//var_dump($cases);
if (empty($cases)) {
    return;
}
?>

<section id="<?= esc_attr($id) ?>" class="product-slider <?= esc_attr($class) ?> section aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
    <div class="container">
        <div class="product-slider__header">
            <h2 class="product-slider__title">Кейсы</h2>
            <div class="slider-controls__nav">
                <button class="video-gide__prev slider-controls__prev slider-controls__btn swiper-button-disabled"
                        type="button" disabled="" tabindex="-1" aria-label="Previous slide"
                        aria-controls="swiper-wrapper-123cd2b6c8d39e9f" aria-disabled="true">
                    <img decoding="async"
                         src="<?= get_template_directory_uri(); ?>/assets/img/slider-prev.svg"
                         alt="Prev">
                </button>
                <button class="video-gide__next slider-controls__next slider-controls__btn" type="button"
                        tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-123cd2b6c8d39e9f"
                        aria-disabled="false">
                    <img decoding="async"
                         src="<?= get_template_directory_uri(); ?>/assets/img/slider-next.svg"
                         alt="Next">
                </button>
            </div>
        </div>

        <div class="product-slider__slider swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($cases as $case): ?>
                    <a href="<?= get_permalink($case->ID) ?>" class="swiper-slide product-slider__slider-slide">
                        <div class="">
                            <h3 class="product-slider__slider-title"><?= esc_html($case->post_title) ?></h3>
                            <div class="product-slider__slider-content">
                                <?= apply_filters('the_content', $case->text) ?>
                            </div>
                        </div>
                        <span class="product-slider__slider-link">Подробнее</span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
