<?php
    $career_gallery_items = get_field('career_gallery_items');

    if( $career_gallery_items ):
?>
    <section class="home-gallery section">
        <div class="home-gallery__slider swiper-container" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php $counter = 1; foreach( $career_gallery_items as $career_gallery_item ): ?>
                    <div class="home-gallery__slide swiper-slide">
                        <div class="home-gallery__item">
                            <img src="<?= kama_thumb_src( 'wh=1168:776', $career_gallery_item ); ?>" alt="Gallery Image - <?= $counter; ?>">
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
            <div class="home-gallery__pagination gallery-pagination"></div>
        </div>
    </section>
<?php endif; ?>
