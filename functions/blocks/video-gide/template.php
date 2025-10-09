<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'video-gide';
$class = isset($block['className']) ? $block['className'] : 'default';

$anim_enabled = get_field_block('video-gide-anim-enabled', $block);
$anim_delay = get_field_block('video-gide-anim-delay', $block);
$title = get_field_block('video-gide-title', $block);
$videos = get_field_block('video-gide-videos', $block);
if (!empty($title) && !empty($videos)) : ?>

    <section
            class="video-gide <?= $class ?> " <?= ($anim_enabled) ? (' data-aos="fade-up" ') : ' ' ?>  <?= ($anim_enabled && !empty($anim_delay)) ? (' data-aos-delay="' . $anim_delay . '"') : '' ?>>
        <div class="container">
            <div class="video-gide__wrapper">
                <div class="video-gide__slider swiper-container">
                    <div class="video-gide__controls slider-controls">
                        <h2 class="video-gide__title aos-init aos-animate" data-aos="fade-up"><?= $title ?></h2>
                        <div class="slider-controls__nav">
                            <button class="video-gide__prev slider-controls__prev slider-controls__btn swiper-button-disabled"
                                    type="button" disabled="" tabindex="-1" aria-label="Previous slide"
                                    aria-controls="swiper-wrapper-123cd2b6c8d39e9f" aria-disabled="true">
                                <img decoding="async"
                                     src="/wp-content/themes/wp-space/assets/img/slider-prev.svg"
                                     alt="Prev">
                            </button>
                            <button class="video-gide__next slider-controls__next slider-controls__btn" type="button"
                                    tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-123cd2b6c8d39e9f"
                                    aria-disabled="false">
                                <img decoding="async"
                                     src="/wp-content/themes/wp-space/assets/img/slider-next.svg"
                                     alt="Next">
                            </button>
                        </div>
                    </div>
                    <div class="swiper-wrapper">
                        <?php foreach ($videos as $video) :
                            $img = wp_get_attachment_image( $video['video-gide-videos-thumb'], 'medium', false, array('class' => 'video-gide__slide-img') );
                            ?>
                            <div class="swiper-slide">
                                <a target="_blank" href="<?= $video['video-gide-videos-video']?>" class="video-gide__slide">
                                    <?php echo $img?>
                                    <div class="video-gide__play-btn">
                                        <svg  xmlns="http://www.w3.org/2000/svg" width="30" height="34" viewBox="0 0 30 34"
                                              fill="none">
                                            <path d="M29 15.2679C30.3333 16.0377 30.3333 17.9623 29 18.7321L3.5 33.4545C2.16666 34.2243 0.499998 33.262 0.499998 31.7224L0.5 2.27757C0.5 0.737966 2.16667 -0.224284 3.5 0.545516L29 15.2679Z"
                                                  fill="white"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        </div>
    </section>
<?php endif; ?>