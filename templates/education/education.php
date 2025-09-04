<?php
    get_header();
?>
<section class="breadcrumbs-wrap">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <div class="breadcrumbs-wrapper">
                <?php yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
    $education_hero_title = get_field('education_hero_title');
    $education_hero_sub = get_field('education_hero_sub');
    $education_hero_desc = get_field('education_hero_desc');
    $education_hero_img = get_field('education_hero_img');

    if( $education_hero_title ):
?>
    <section class="product-hero product-hero--learning" data-aos="fade-up">
        <div class="container">
            <div class="product-hero__wrap">
                <?php if( $education_hero_img ): ?>
                    <div class="product-hero__img">
                        <img src="<?= kama_thumb_src( 'wh=882:826', $education_hero_img ); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="product-hero__content">
                    <h1 class="product-hero__title product-hero__title--small"><?= $education_hero_title; ?></h1>
                    <?php if( $education_hero_sub ): ?>
                        <div class="product-hero__label h7"><?= $education_hero_sub; ?></div>
                    <?php endif; ?>
                    <?php if( $education_hero_desc ): ?>
                        <div class="product-hero__desc"><?= $education_hero_desc; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $education_centers_items = get_field('education_centers_items');

    if( $education_centers_items ):
?>
    <section class="learning-contacts section">
        <div class="container">
            <div class="learning-contacts__row">
                <?php $counter = 0; foreach( $education_centers_items as $education_centers_item ): if($counter == 2) $counter = 0; ?>
                    <div class="learning-contacts__col" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="partners-distributors__item">
                            <div class="partners-distributors__item-top">
                                <div class="partners-distributors__item-logo"><?= get_retina_img($education_centers_item['logo'], $education_centers_item['label']); ?></div>
                                <div class="partners-distributors__item-sub h4"><?= $education_centers_item['label']; ?></div>
                                <?php if( $education_centers_item['desc'] ): ?>
                                    <div class="partners-distributors__item-desc"><?= $education_centers_item['desc']; ?></div>
                                <?php endif; ?>

                                <?php if( $education_centers_item['url'] ): ?>
                                    <a href="<?= $education_centers_item['url']; ?>" class="partners-distributors__item-url btn">Записаться на курс</a>
                                <?php endif; ?>
                            </div>
                            <?php if( $education_centers_item['phone'] || $education_centers_item['email'] ): ?>
                                <div class="partners-distributors__item-info">
                                    <?php if( $education_centers_item['phone'] ): ?>
                                        <div class="partners-distributors__item-link">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-1.svg" alt="Phone">
                                            <span><?= $education_centers_item['phone']; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( $education_centers_item['email'] ): ?>
                                        <a class="partners-distributors__item-link" href="mailto:<?= $education_centers_item['email']; ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-2.svg" alt="Email">
                                            <span><?= $education_centers_item['email']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $education_info_title = get_field('education_info_title');
    $education_info_items = get_field('education_info_items');

    if( $education_info_items ):
?>
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

<?php
    $education_video_title = get_field('education_video_title');
    $education_video_img = get_field('education_video_img');
    $education_video_sub = get_field('education_video_sub');
    $education_video_desc = get_field('education_video_desc');
    $education_video_btn_label = get_field('education_video_btn_label');
    $education_video_btn_url = get_field('education_video_btn_url');

    if( $education_video_img && $education_video_sub ):
?>
    <section class="platform-video section">
        <div class="container">
            <?php if( $education_video_title ): ?>
                <h2 class="platform-video__title" data-aos="fade-up"><?= $education_video_title; ?></h2>
            <?php endif; ?>
            <div class="platform-video-card platform-video-card--violet" data-aos="fade-up">
                <div class="platform-video-card__bg">
                    <div class="platform-video-card__bg-item">
                        <img src="<?= kama_thumb_src( 'wh=1136:1136', $education_video_img ); ?>" alt="<?= $education_video_title; ?>">
                    </div>
                </div>
                <div class="platform-video-card__content">
                    <h3 class="platform-video-card__sub h2"><?= $education_video_sub; ?></h3>
                    <div class="platform-video-card__bottom">
                        <?php if( $education_video_desc ): ?>
                            <div class="platform-video-card__desc"><?= $education_video_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $education_video_btn_label && $education_video_btn_url ): ?>
                            <div class="platform-video-card__btn">
                                <a class="play-btn" href="<?= $education_video_btn_url; ?>" target="_blank">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                    <span><?= $education_video_btn_label; ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>