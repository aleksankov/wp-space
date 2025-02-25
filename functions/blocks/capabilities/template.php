<?php
    $color = get_field('color');
    $title = get_field('title');
    $items = get_field('items');

    $desc_arr = array_chunk($items, 9);
    $mob_arr = array_chunk($items, 2);
?>

<?php if( $color ): ?>
    <style>
        .product-capabilities .product-capabilities__title span{
            color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>

<?php if( $items ): ?>
    <section class="product-capabilities section">
        <div class="container">
            <?php if( $title ): ?>
                <h2 class="product-capabilities__title" data-aos="fade-up"><?= $title; ?></h2>
            <?php endif; ?>
            <div class="product-capabilities__slider swiper-container">
                <div class="product-capabilities__controls slider-controls js-slider-hide-controls">
                    <div class="slider-controls__nav">
                        <button class="product-capabilities__prev slider-controls__prev slider-controls__btn" type="button">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-prev.svg" alt="Prev">
                        </button>
                        <button class="product-capabilities__next slider-controls__next slider-controls__btn" type="button">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-next.svg" alt="Next">
                        </button>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    <?php $icon_counter = 1; foreach( $desc_arr as $items ): ?>
                        <div class="product-capabilities__slide swiper-slide">
                            <div class="product-capabilities__row row-lg">
                                <?php $counter = 0; foreach( $items as $item ): if($counter == 3) $counter = 0; ?>
                                    <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                                        <div class="product-capabilities__item">
                                            <?php if( $item['icon'] ): ?>
                                                <div class="product-capabilities__item-icon">
                                                    <img src="<?= $item['icon']; ?>" alt="Capabilities - Icon <?= $icon_counter; ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if( $item['desc'] ): ?>
                                                <div class="product-capabilities__item-sub h7"><?= $item['desc']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php $icon_counter++; $counter++; endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="product-capabilities__mob-slider swiper-container" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <?php $icon_counter = 1; foreach( $mob_arr as $items ): ?>
                        <div class="product-capabilities__mob-slide swiper-slide">
                            <div class="product-capabilities__mob-row">
                                <?php foreach( $items as $item ): if($counter == 3) $counter = 0; ?>
                                    <div class="product-capabilities__mob-col">
                                        <div class="product-capabilities__item">
                                            <?php if( $item['icon'] ): ?>
                                                <div class="product-capabilities__item-icon">
                                                    <img src="<?= $item['icon']; ?>" alt="Capabilities - Icon <?= $icon_counter; ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if( $item['desc'] ): ?>
                                                <div class="product-capabilities__item-sub h7"><?= $item['desc']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php $icon_counter++; endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
