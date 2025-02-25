<?php
    $education_info_color = get_field('education_info_color');
    $education_info_title = get_field('education_info_title');
    $education_info_items = get_field('education_info_items');

    if( $education_info_items ):
?>

    <?php if( $education_info_color ): ?>
        <style>
            .learning-info .learning-info__title span{
                color: <?= $education_info_color; ?>;
            }
        </style>
    <?php endif; ?>
    <section class="learning-info section">
        <div class="container">
            <?php if( $education_info_title ): ?>
                <h2 class="learning-info__title" data-aos="fade-up"><?= $education_info_title; ?></h2>
            <?php endif; ?>
            <div class="learning-info__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach( $education_info_items as $education_info_item ): ?>
                        <div class="learning-info__slide swiper-slide">
                            <div class="learning-info__item" data-aos="fade-up">
                                <div class="learning-info__item-img">
                                    <img src="<?= kama_thumb_src( 'wh=876:680', $education_info_item['img'] ); ?>" alt="<?= $education_info_item['label']; ?>">
                                </div>
                                <div class="learning-info__item-content">
                                    <div class="learning-info__item-sub"><?= $education_info_item['label']; ?></div>
                                    <div class="learning-info__item-desc"><?= $education_info_item['desc']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
