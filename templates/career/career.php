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
    $career_hero_title = get_field('career_hero_title');
    $career_hero_desc = get_field('career_hero_desc');
    $career_hero_btn_label = get_field('career_hero_btn_label');
    $career_hero_btn_url = get_field('career_hero_btn_url');
    $career_hero_img = get_field('career_hero_img');

    if( $career_hero_title ):
?>
    <section class="career-hero" data-aos="fade-up">
        <div class="container">
            <div class="career-hero__block">
                <div class="career-hero__bg">
                    <div class="career-hero__bg-pl"></div>
                    <?php if( $career_hero_img ): ?>
                        <img src="<?= kama_thumb_src( 'wh=1216:948', $career_hero_img ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </div>
                <div class="career-hero__content">
                    <div class="career-hero__content-wrap">
                        <h1 class="career-hero__title h2"><?= $career_hero_title; ?></h1>
                        <?php if( $career_hero_desc ): ?>
                            <div class="career-hero__desc"><?= $career_hero_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $career_hero_btn_label && $career_hero_btn_url ): ?>
                            <div class="career-hero__btn">
                                <a class="btn" href="<?= $career_hero_btn_url; ?>"><?= $career_hero_btn_label; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $career_about_title = get_field('career_about_title');
    $career_about_items = get_field('career_about_items');

    if( $career_about_items ):
?>
    <section class="career-about section">
        <div class="container">
            <?php if( $career_about_title ): ?>
                <h2 class="career-about__title" data-aos="fade-up"><?= $career_about_title; ?></h2>
            <?php endif; ?>
            <div class="career-about__row row-lg">
                <?php $counter = 0; foreach( $career_about_items as $career_about_item ): if($counter == 3) $counter = 0; ?>
                    <div class="career-about__col col-lg" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="career-about__item" style="background-color: <?= $career_about_item['bg_color']; ?>">
                            <?php if( $career_about_item['title'] ): ?>
                                <div class="career-about__item-sub" style="color: <?= $career_about_item['color']; ?>"><?= $career_about_item['title']; ?></div>
                            <?php endif; ?>
                            <?php if( $career_about_item['desc'] ): ?>
                                <div class="career-about__item-desc"><?= $career_about_item['desc']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $career_partners_title = get_field('career_partners_title');
    $career_partners_items = get_field('career_partners_items');

    if( $career_partners_items ):
?>
    <section class="partners-list section">
        <div class="container">
            <?php if( $career_partners_title ): ?>
                <h2 class="partners-list__title h3" data-aos="fade-up"><?= $career_partners_title; ?></h2>
            <?php endif; ?>
            <div class="partners-list__slider swiper-container js-partners-list-toggle">
                <div class="swiper-wrapper">
                    <?php $counter = 0; foreach( $career_partners_items as $career_partners_item ): if($counter == 4) $counter = 0; ?>
                        <div class="partners-list__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                            <?php if( $career_partners_item['url'] ): ?>
                                <a class="partners-list__item" href="<?= $career_partners_item['url']; ?>" target="_blank"><?= get_retina_img($career_partners_item['logo'], 'Partners - Logo ' . ($counter + 1)); ?></a>
                            <?php else: ?>
                                <?= get_retina_img($career_partners_item['logo'], 'Partners - Logo ' . ($counter + 1)); ?>
                            <?php endif; ?>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $career_bonuses_title = get_field('career_bonuses_title');
    $career_bonuses_items = get_field('career_bonuses_items');
    $career_bonuses_items_chunks = array_chunk($career_bonuses_items, 2);

    if( $career_bonuses_items_chunks ):
?>
    <section class="career-bonuses section">
        <div class="container">
            <?php if( $career_bonuses_title ): ?>
                <h2 class="career-bonuses__title h3" data-aos="fade-up"><?= $career_bonuses_title; ?></h2>
            <?php endif; ?>
            <div class="career-bonuses__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $career_bonuses_items_chunks as $career_bonuses_items ): ?>
                        <div class="career-bonuses__slide swiper-slide">
                            <?php foreach( $career_bonuses_items as $career_bonuses_item ): ?>
                                <div class="career-bonuses__item" data-aos="fade-up">
                                    <div class="advantages-card">
                                        <div class="advantages-card__icon">
                                            <img src="<?= $career_bonuses_item['icon']; ?>" alt="Bonuses - Icon <?= $counter; ?>">
                                        </div>
                                        <div class="advantages-card__content">
                                            <h3 class="advantages-card__sub h5"><?= $career_bonuses_item['label']; ?></h3>
                                            <div class="advantages-card__desc"><?= $career_bonuses_item['desc']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php $counter++; endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

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

<?php
    $career_vacancies_title = get_field('career_vacancies_title');
    $career_vacancies_items = get_field('career_vacancies_items');

    $vacancies_args = array(
        'post_type' => 'vacancies',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $vacancies_query = new WP_Query( $vacancies_args );
    $vacancies_post_found = $vacancies_query->found_posts;

    if( $career_vacancies_items ):
?>
    <section class="career-vacancies section">
        <div class="container">
            <?php if( $career_vacancies_title ): ?>
                <h2 class="career-vacancies__title h3" data-aos="fade-up"><?= $career_vacancies_title; ?></h2>
            <?php endif; ?>
            <div class="career-vacancies__row row-lg">
                <?php foreach( $career_vacancies_items as $career_vacancies_item ): ?>
                    <?php
                        $cities = get_the_terms( $career_vacancies_item, 'vacancies_city' );

                        $cities_arr = [];
                        $cities_html = false;
                        if( $cities ){
                            foreach( $cities as $city ){
                                $cities_arr[] = $city->name;
                            }
                            $cities_html = implode(', ', $cities_arr);
                        }
                    ?>
                    <div class="career-vacancies__col col-lg" data-aos="fade-up">
                        <a class="vacancy-card" href="<?= get_the_permalink( $career_vacancies_item ); ?>">
                            <div class="vacancy-card__sub"><?= get_the_title( $career_vacancies_item ); ?></div>
                            <?php if( $cities_html ): ?>
                                <div class="vacancy-card__location"><?= $cities_html; ?></div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
                <div class="career-vacancies__col col-lg" data-aos="fade-up" data-aos-delay="400">
                    <a class="career-vacancies__more" href="<?= get_home_url(); ?>/vacancies/">
                        <div class="career-vacancies__more-bg">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/career-vacancies-more-bg.svg" alt="#">
                        </div>
                        <div class="career-vacancies__more-sub">Все вакансии <br><?= $vacancies_post_found; ?></div>
                        <div class="career-vacancies__more-icon">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/career-vacancies-more-icon.svg" alt="Arrow">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>