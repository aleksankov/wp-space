<?php
    $title = get_field('title');
    $items = get_field('items');
?>

<?php if( $items ): ?>
    <section class="product-overview section">
        <div class="container">
            <div class="product-overview__wrap">
                <?php if( $title ): ?>
                    <h2 class="product-overview__title" data-aos="fade-up"><?= $title; ?></h2>
                <?php endif; ?>
                <div class="product-overview__top">
                    <div class="product-overview__tags" data-aos="fade-up">
                        <?php $counter = 1; foreach( $items as $item ): ?>
                            <div class="product-overview__tag js-product-overview-tag"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>><?= $item['label']; ?></div>
                        <?php $counter++; endforeach; ?>
                    </div>
                    <div class="product-overview__controls slider-controls">
                        <div class="slider-controls__pagination">
                            <div class="product-overview__pagination gallery-pagination"></div>
                        </div>
                        <div class="slider-controls__nav js-slider-hide-controls">
                            <button class="product-overview__prev slider-controls__prev slider-controls__btn" type="button">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-prev.svg" alt="Prev">
                            </button>
                            <button class="product-overview__next slider-controls__next slider-controls__btn" type="button">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-next.svg" alt="Next">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-overview__slider swiper-container" data-aos="fade-up">
                    <div class="swiper-wrapper">
                        <?php foreach( $items as $item ): ?>
                            <div class="product-overview__slide swiper-slide">
                                <a class="product-overview__item" href="<?= kama_thumb_src( 'wh=2272:1104', $item['img'] ); ?>" data-fancybox="overview-gallery">
                                    <img src="<?= kama_thumb_src( 'wh=2272:1104', $item['img'] ); ?>" alt="<?= $item['label']; ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
