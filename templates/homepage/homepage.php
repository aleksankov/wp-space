<?php
    get_header();
?>

<?php
    $home_hero_video = get_field('home_hero_video');
    $home_hero_title = get_field('home_hero_title');
    $home_hero_desc = get_field('home_hero_desc');
    $home_hero_btn = get_field('home_hero_btn');
    $home_hero_awards = get_field('home_hero_awards');

    if( $home_hero_title ):
?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-section__wrap">
                <?php if( $home_hero_video ): ?>
                    <div class="hero-section__img" data-aos="zoom-in">
                        <video class="js-autoplay-video" autoplay muted loop playsinline>
                            <source src="<?= $home_hero_video; ?>" type="video/webm">
                        </video>
                    </div>
                <?php endif; ?>
                <div class="hero-section__content">
                    <div class="hero-section__top" data-aos="fade-up">
                        <h1 class="hero-section__title"><?= $home_hero_title; ?></h1>
                        <?php if( $home_hero_desc ): ?>
                            <div class="hero-section__desc"><?= $home_hero_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $home_hero_btn ): ?>
                            <div class="hero-section__btn">
                                <a class="btn" href="#demo-popup" data-fancybox="" data-touch="false"><?= $home_hero_btn; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if( $home_hero_awards ): ?>
                        <div class="hero-section__bottom" data-aos="fade" data-aos-delay="200">
                            <div class="hero-section__row">
                                <?php $counter = 1; foreach( $home_hero_awards as $home_hero_award ): if($home_hero_award['icon'] || $home_hero_award['desc']): ?>
                                    <div class="hero-section__col">
                                        <div class="hero-section__item">
                                            <?php if( $home_hero_award['icon'] ): ?>
                                                <div class="hero-section__item-icon"><?= get_retina_img($home_hero_award['icon'], 'Hero Award Icon -' . $counter); ?></div>
                                            <?php endif; ?>
                                            <?php if( $home_hero_award['desc'] ): ?>
                                                <div class="hero-section__item-sub"><?= $home_hero_award['desc']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php $counter++; endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_products_title = get_field('home_products_title');
    $home_products_desc = get_field('home_products_desc');
    $home_products_items = get_field('home_products_items');

    if( $home_products_title && $home_products_items ):
?>
    <section class="home-products section">
        <div class="container">
            <div class="home-products__header row-lg">
                <h2 class="home-products__title col-lg" data-aos="fade-up" data-aos-delay="150"><?= $home_products_title; ?></h2>
                <?php if( $home_products_desc ): ?>
                    <div class="home-products__desc col-lg" data-aos="fade-up">
                        <div class="home-products__desc-item"><b><?= $home_products_desc; ?></b></div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="home-products__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 0; foreach( $home_products_items as $home_products_item ): ?>
                        <div class="home-products__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                            <a class="product-card" href="<?= $home_products_item['url']; ?>">
                                <div class="product-card__bg">
                                    <img src="<?= $home_products_item['bg']; ?>" alt="<?= $home_products_item['label']; ?>">
                                </div>
                                <div class="product-card__sub h5"><?= $home_products_item['desc']; ?></div>
                                <h3 class="product-card__title">
                                    <span><?= $home_products_item['label']; ?></span>
                                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="56" height="56" rx="28" fill="#FBFAFD"/>
                                        <path d="M23 33L33 23M33 23H23M33 23V33" stroke="<?= $home_products_item['color']; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </h3>
                            </a>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_why_title = get_field('home_why_title');
    $home_why_items = get_field('home_why_items');

    if( $home_why_title && $home_why_items ):
?>
    <section class="home-why section">
        <div class="container">
            <h2 class="home-why__title" data-aos="fade-up"><?= $home_why_title; ?></h2>
            <div class="home-why__row row">
                <?php $counter = 1; foreach( $home_why_items as $home_why_item ): ?>
                    <div class="home-why__col col" data-aos="fade-up"<?= $counter % 2 ? '' : ' data-aos-delay="200"'; ?>>
                        <div class="home-why__item">
                            <div class="home-why__item-bg">
                                <img src="<?= kama_thumb_src( 'wh=1184:720', $home_why_item['img'] ); ?>" alt="<?= $home_why_title; ?> - BG <?= $counter; ?>">
                            </div>
                            <div class="home-why__item-content">
                                <h3 class="home-why__item-sub"><?= $home_why_item['title']; ?></h3>
                                <?php if( $home_why_item['desc'] ): ?>
                                    <div class="home-why__item-desc"><?= $home_why_item['desc']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_gallery_title = get_field('home_gallery_title');
    $home_gallery_images = get_field('home_gallery_images');
    $home_gallery_btn_label = get_field('home_gallery_btn_label');
    $home_gallery_btn_url = get_field('home_gallery_btn_url');

    if( $home_gallery_images ):
?>
    <section class="home-gallery section">
        <div class="home-bg-path home-bg-path--1">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-1.svg" alt="#">
        </div>
        <div class="home-bg-path home-bg-path--2">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-2.svg" alt="#">
        </div>
        <?php if( $home_gallery_title ): ?>
            <div class="container">
                <h2 class="home-gallery__title h4" data-aos="fade-up"><?= $home_gallery_title; ?></h2>
            </div>
        <?php endif; ?>
        <div class="home-gallery__slider swiper-container" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php $counter = 1; foreach( $home_gallery_images as $home_gallery_image ): ?>
                    <div class="home-gallery__slide swiper-slide">
                        <div class="home-gallery__item">
                            <img src="<?= kama_thumb_src( 'wh=1168:776', $home_gallery_image ); ?>" alt="Gallery Image - <?= $counter; ?>">
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
            <div class="home-gallery__pagination gallery-pagination"></div>
        </div>
        <?php if( $home_gallery_btn_label && $home_gallery_btn_url ): ?>
            <div class="container">
                <div class="home-gallery__btn">
                    <a class="btn" href="<?= $home_gallery_btn_url; ?>"><?= $home_gallery_btn_label; ?></a>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php
    $home_tech_title = get_field('home_tech_title');
    $home_tech_items = get_field('home_tech_items');

    if( $home_tech_title && $home_tech_items ):
?>
    <section class="home-technologies section">
        <div class="home-bg-path home-bg-path--3">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-3.svg" alt="#">
        </div>
        <div class="home-bg-path home-bg-path--4">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-4.svg" alt="#">
        </div>
        <div class="container">
            <h2 class="home-technologies__title" data-aos="fade-up"><?= $home_tech_title; ?></h2>
            <div class="home-technologies__wrap row-lg">
                <div class="home-technologies__left col-lg" data-aos="fade-up">
                    <div class="home-technologies__tabs js-h-technologies-tabs">
                        <?php $counter = 1; foreach( $home_tech_items as $home_tech_item ): ?>
                            <div class="home-technologies__tab js-h-technologies-tab"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                                <div class="home-technologies__tab-item">
                                    <div class="home-technologies__tab-toggle h5 js-h-technologies-toggle">
                                        <span><?= $home_tech_item['title']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/home-technologies-dropdown-arrow.svg" alt="#">
                                    </div>
                                    <div class="home-technologies__tab-dropdown js-h-technologies-dropdown">
                                        <div class="home-technologies__tab-content">
                                            <div class="home-technologies__tab-desc"><?= $home_tech_item['desc']; ?></div>
                                            <div class="home-technologies__tab-bottom">
                                                <?php if( $home_tech_item['hint'] || $home_tech_item['value'] ): ?>
                                                    <div class="home-technologies__tab-hint">
                                                        <?php if( $home_tech_item['hint'] ): ?>
                                                            <span><?= $home_tech_item['hint']; ?></span>
                                                        <?php endif; ?>
                                                        <?php if( $home_tech_item['value'] ): ?>
                                                            <b><?= $home_tech_item['value']; ?></b>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if( $home_tech_item['url'] ): ?>
                                                    <a class="home-technologies__tab-btn" href="<?= $home_tech_item['url']; ?>" target="_blank">
                                                        <span>Подробнее</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#946AD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                    <div class="home-technologies__more">
                        <button class="home-technologies__more-btn js-h-technologies-more" type="button">
                            <span>Показать полный список</span>
                            <span>Скрыть полный список</span>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/technologies-more-icon.svg" alt="Arrow">
                        </button>
                    </div>
                </div>
                <div class="home-technologies__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="home-technologies__row">
                        <?php $counter = 1; foreach( $home_tech_items as $home_tech_item ): ?>
                            <div class="home-technologies__col">
                                <div class="home-technologies__item">
                                    <button class="home-technologies__item-tab-btn h7 js-h-technologies-tab-btn<?= $counter == 1 ? ' active' : ''; ?>" type="button"><?= $home_tech_item['title']; ?></button>
                                </div>
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_banner_bg = get_field('home_banner_bg');
    $home_banner_title = get_field('home_banner_title');
    $home_banner_desc = get_field('home_banner_desc');
    $home_banner_btn_label = get_field('home_banner_btn_label');
    $home_banner_btn_url = get_field('home_banner_btn_url');

    if( $home_banner_bg && $home_banner_title ):
?>
    <section class="home-connect section">
        <div class="home-connect__wrap" data-aos="fade-up">
            <div class="home-connect__bg">
                <img src="<?= $home_banner_bg; ?>" alt="<?= $home_banner_title; ?>">
            </div>
            <div class="container">
                <div class="home-connect__content">
                    <h2 class="home-connect__title"><?= $home_banner_title; ?></h2>
                    <div class="home-connect__info">
                        <?php if( $home_banner_desc ): ?>
                            <div class="home-connect__desc"><?= $home_banner_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $home_banner_btn_label && $home_banner_btn_url ): ?>
                            <div class="home-connect__btn">
                                <a class="btn btn-white" href="<?= $home_banner_btn_url; ?>"><?= $home_banner_btn_label; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_regions_title = get_field('home_regions_title');
    $home_regions_cards = get_field('home_regions_cards');
    $home_regions_items = get_field('home_regions_items');

    if( $home_regions_title && $home_regions_items ):
?>
    <section class="home-regions section">
        <div class="home-bg-path home-bg-path--5">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-5.svg" alt="#">
        </div>
        <div class="container">
            <div class="home-regions__wrap">
                <h2 class="home-regions__title" data-aos="fade-up"><?= $home_regions_title; ?></h2>
                <div class="home-regions__row row-lg">
                    <?php if( $home_regions_cards ): ?>
                        <div class="home-regions__left col-lg" data-aos="fade-up">
                            <div class="home-regions__items">
                                <?php $counter = 1; foreach( $home_regions_cards as $home_regions_card ): ?>
                                    <div class="home-regions__item">
                                        <?php if( $home_regions_card['icon'] ): ?>
                                            <div class="home-regions__item-icon">
                                                <img src="<?= $home_regions_card['icon']; ?>" alt="<?= $home_regions_title; ?> - Icon <?= $counter; ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="home-regions__item-sub"><?= $home_regions_card['sub']; ?></div>
                                    </div>
                                <?php $counter++; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="home-regions__map">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/map.svg" alt="Map">
                        <span>Все регионы</span>
                    </div>
                    <div class="home-regions__right col-lg" data-aos="fade-up" data-aos-delay="200">
                        <div class="home-regions__sub h7">Представительства</div>
                        <div class="home-regions__list">
                            <?php foreach( $home_regions_items as $home_regions_item ): ?>
                                <div class="home-regions__card">
                                    <div class="home-regions__card-bg">
                                        <img src="<?= kama_thumb_src( 'wh=444:258', $home_regions_item['img'] ); ?>" alt="<?= $home_regions_item['city']; ?>">
                                    </div>
                                    <div class="home-regions__card-wrap">
                                        <div class="home-regions__card-toggle h7 js-h-regions-toggle">
                                            <span><?= $home_regions_item['city']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-regions-arrow.svg" alt="Arrow">
                                        </div>
                                        <div class="home-regions__card-dropdown js-h-regions-dropdown">
                                            <div class="home-regions__card-content">
                                                <div class="home-regions__card-desc"><?= $home_regions_item['address']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_regions_title = get_field('home_demo_title');
    $home_demo_desc_yt = get_field('home_demo_desc_yt');
    $home_demo_desc_rutube = get_field('home_demo_desc_rutube');
    $home_demo_desc_tg = get_field('home_demo_desc_tg');
    $home_demo_desc_habr = get_field('home_demo_desc_habr');

    if( $home_regions_title ):
?>
    <section class="demo section">
        <div class="home-bg-path home-bg-path--6">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-6.svg" alt="#">
        </div>
        <div class="container">
            <div class="demo__row row-lg">
                <div class="demo__left col-lg" data-aos="fade-up">
                    <form class="demo__form">
                        <h2 class="demo__form-sub"><?= $home_regions_title; ?></h2>
                        <div class="demo__form-row">
                            <?php if( $form_product_options ): ?>
                                <div class="demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select"><?= $form_product_options; ?></select>
                                        <span class="js-select-toggle">Выберите продукт</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $form_partner_options ): ?>
                                <div class="demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select"><?= $form_partner_options; ?></select>
                                        <span class="js-select-toggle">Выберите партнёра</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input" type="text">
                                        <span>Имя и фамилия</span>
                                    </label>
                                </div>
                            </div>
                            <div class="demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input" type="text">
                                        <span>Организиция</span>
                                    </label>
                                </div>
                            </div>
                            <div class="demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-tel-input" type="text">
                                        <span>Номер телефона</span>
                                    </label>
                                </div>
                            </div>
                            <div class="demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input" type="text">
                                        <span>E-mail</span>
                                    </label>
                                </div>
                            </div>
                            <div class="demo__form-col demo__form-col--lg">
                                <div class="main-input">
                                    <label>
                                        <textarea class="js-form-input"></textarea>
                                        <span>Комментарий</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="demo__form-bottom">
                            <?php if( $site_forms_agree ): ?>
                                <div class="demo__form-agree"><?= $site_forms_agree; ?></div>
                            <?php endif; ?>
                            <div class="demo__form-btn">
                                <button class="btn btn-white" type="submit">Отправить</button>
                            </div>
                        </div>
                        <div class="demo__form-mob-btn">
                            <a class="btn btn-white" href="#demo-popup" data-fancybox="" data-touch="false">Продолжить</a>
                        </div>
                    </form>
                </div>
                <div class="demo__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="demo__soc">
                        <?php if( $site_soc_yt && $home_demo_desc_yt ): ?>
                            <div class="demo__soc-col">
                                <a class="demo__soc-item" href="<?= $site_soc_yt; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="74" height="48" viewBox="0 0 74 48" fill="none">
                                        <path d="M38.4545 47.9806L24.1265 47.7199C19.4873 47.6292 14.8367 47.8105 10.2887 46.8697C3.36981 45.4642 2.87967 38.5725 2.36674 32.7917C1.66003 24.6645 1.9336 16.39 3.26722 8.3308C4.01953 3.80814 6.98315 1.11042 11.5654 0.815707C27.0332 -0.249781 42.6036 -0.125096 58.0372 0.373643C59.6672 0.418983 61.3086 0.668352 62.9157 0.951727C70.8491 2.33459 71.0429 10.1444 71.5558 16.7187C72.0688 23.361 71.8522 30.0373 70.8719 36.6343C70.0854 42.0977 68.5808 46.677 62.2318 47.1191C54.2757 47.6972 46.5019 48.1619 38.5229 48.0146C38.5229 47.9806 38.4773 47.9806 38.4545 47.9806ZM30.031 34.1519C36.0266 30.7287 41.9082 27.3622 47.8697 23.9617C41.8627 20.5386 35.9924 17.1721 30.031 13.7716V34.1519Z" fill="#D9D7DA" />
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-1.svg" alt="Youtube">
                                        <span><?= $home_demo_desc_yt; ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg" alt="Youtube">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if( $site_soc_rutube && $home_demo_desc_rutube ): ?>
                            <div class="demo__soc-col">
                                <a class="demo__soc-item" href="<?= $site_soc_rutube; ?>" target="_blank">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="#D9D7DA" />
                                        <path d="M29.2848 15.9023H12.3242V35.1424H17.0449V28.8829H26.0906L30.2174 35.1424H35.5035L30.9524 28.854C32.3657 28.6232 33.3834 28.075 34.0053 27.2097C34.6272 26.3444 34.9381 24.9598 34.9381 23.1136V21.6714C34.9381 20.5752 34.825 19.7099 34.6272 19.0464C34.4292 18.383 34.0901 17.806 33.6095 17.2869C33.1006 16.7965 32.5354 16.4503 31.857 16.2196C31.1786 16.0177 30.3308 15.9023 29.2848 15.9023ZM28.5216 24.6424H17.0447V20.1426H28.5218C29.172 20.1426 29.6241 20.258 29.8504 20.4598C30.0761 20.6617 30.2174 21.0368 30.2174 21.5849V23.2002C30.2174 23.7771 30.0761 24.1522 29.85 24.354C29.624 24.5559 29.1716 24.6424 28.5216 24.6424Z" fill="white" />
                                        <path d="M38.1605 17.5988C39.9848 17.5988 41.4637 16.0897 41.4637 14.2281C41.4637 12.3665 39.9848 10.8574 38.1605 10.8574C36.3363 10.8574 34.8574 12.3665 34.8574 14.2281C34.8574 16.0897 36.3363 17.5988 38.1605 17.5988Z" fill="white" />
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-2.svg" alt="Rutube">
                                        <span><?= $home_demo_desc_rutube; ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg" alt="Rutube">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if( $site_soc_tg && $home_demo_desc_tg ): ?>
                            <div class="demo__soc-col">
                                <a class="demo__soc-item" href="<?= $site_soc_tg; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                        <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="#D9D7DA" />
                                        <path d="M16.2344 25.7557L19.0818 33.6369C19.0818 33.6369 19.4378 34.3743 19.819 34.3743C20.2002 34.3743 25.87 28.4759 25.87 28.4759L32.175 16.2979L16.336 23.7213L16.2344 25.7557Z" fill="#D9D7DA" />
                                        <path d="M20.0171 27.7764L19.4705 33.5856C19.4705 33.5856 19.2417 35.3656 21.0213 33.5856C22.8009 31.8056 24.5043 30.433 24.5043 30.433" fill="white" />
                                        <path d="M16.2984 26.0356L10.4412 24.1272C10.4412 24.1272 9.74119 23.8432 9.96659 23.1992C10.013 23.0664 10.1066 22.9534 10.3866 22.7592C11.6844 21.8546 34.4078 13.6872 34.4078 13.6872C34.4078 13.6872 35.0494 13.471 35.4278 13.6148C35.5214 13.6438 35.6056 13.6971 35.6719 13.7693C35.7381 13.8415 35.784 13.93 35.8048 14.0258C35.8457 14.1949 35.8628 14.3689 35.8556 14.5428C35.8538 14.6932 35.8356 14.8326 35.8218 15.0512C35.6834 17.2842 31.5418 33.9498 31.5418 33.9498C31.5418 33.9498 31.294 34.925 30.4062 34.9584C30.188 34.9654 29.9707 34.9285 29.7671 34.8497C29.5635 34.771 29.3778 34.652 29.2212 34.5C27.479 33.0014 21.4574 28.9546 20.1268 28.0646C20.0968 28.0441 20.0715 28.0175 20.0527 27.9864C20.0338 27.9554 20.0219 27.9206 20.0176 27.8846C19.999 27.7908 20.101 27.6746 20.101 27.6746C20.101 27.6746 30.5862 18.3546 30.8652 17.3762C30.8868 17.3004 30.8052 17.263 30.6956 17.2962C29.9992 17.5524 17.9268 25.1762 16.5944 26.0176C16.4985 26.0466 16.3971 26.0528 16.2984 26.0356Z" fill="white" />
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-3.svg" alt="Telegram">
                                        <span><?= $home_demo_desc_tg; ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg" alt="Telegram">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if( $site_soc_habr && $home_demo_desc_habr ): ?>
                            <div class="demo__soc-col">
                                <a class="demo__soc-item" href="<?= $site_soc_habr; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="136" height="48" viewBox="0 0 136 48" fill="none">
                                        <path d="M0 0C3.35453 0.00388381 6.70906 0 10.0598 0.00388381C10.0445 6.14419 10.1018 12.2845 10.033 18.4287C11.5842 16.347 13.8728 14.84 16.4097 14.374C20.0775 13.7759 24.2038 14.4866 26.8859 17.283C29.2967 19.5861 30.187 23.0465 30.2252 26.3128C30.2443 33.2415 30.229 40.1664 30.2328 47.0951C26.8783 47.099 23.5237 47.099 20.1692 47.0951C20.1692 41.4519 20.1692 35.8087 20.1692 30.1694C20.131 28.4373 19.9323 26.4992 18.6677 25.2137C16.7039 23.1048 12.9367 23.4349 11.2136 25.6953C10.2852 26.9808 10.0521 28.6237 10.0636 30.1811V47.0951C6.70906 47.099 3.35453 47.0951 0.00382065 47.099C0 31.4006 0 15.6984 0 0ZM75.6527 0C78.9996 0 82.3465 0 85.6972 0.00388381C85.6972 6.05097 85.7163 12.0981 85.6819 18.1452C87.3974 16.1372 89.7662 14.607 92.4062 14.3235C96.6624 13.6516 101.136 15.1896 104.151 18.3044C110.826 25.2797 110.661 37.9176 103.475 44.4619C100.273 47.5106 95.5697 48.5593 91.3288 47.6582C88.9333 47.1067 86.8204 45.6309 85.2922 43.6967C85.3151 44.8308 85.3113 45.961 85.3113 47.0951C82.0905 47.099 78.8697 47.0951 75.6527 47.099C75.645 31.4006 75.645 15.7022 75.6527 0ZM90.2858 24.4059C87.1452 25.2176 84.7993 28.4761 85.2769 31.7929C85.5023 35.2262 88.6735 38.0808 92.0624 37.8555C95.9633 38.0225 99.3102 34.0882 98.6377 30.1889C98.29 26.2274 94.0338 23.299 90.2858 24.4059ZM37.8474 21.2833C40.3384 16.9956 45.1066 14.071 50.0543 14.1914C53.5388 14.0011 56.8627 15.7916 59.0634 18.4675C59.0558 17.3296 59.0558 16.1916 59.0634 15.0536H68.722C68.722 25.738 68.7297 36.4185 68.7144 47.099C65.4974 47.0951 62.2804 47.099 59.0634 47.0951C59.0596 45.9377 59.0558 44.7803 59.0787 43.6268C57.4167 45.5726 55.2542 47.2388 52.6944 47.6582C47.4716 48.9515 41.8208 46.4659 38.7032 42.1238C34.4775 36.1427 34.2216 27.6178 37.8512 21.2833H37.8474ZM50.1881 24.5457C47.5098 25.4156 45.4734 28.111 45.5536 31.0006C45.4543 34.1659 47.781 37.1914 50.8643 37.7467C55.0212 38.8459 59.4952 35.0087 59.0099 30.6316C58.903 26.3283 54.1615 23.0116 50.1881 24.5457ZM123.953 18.7122C125.478 16.4402 127.862 14.5526 130.628 14.2924C132.298 14.0672 133.998 14.1604 135.637 14.5565C135.687 17.9976 135.637 21.4386 135.224 24.8603C133.108 24.2544 130.903 23.7767 128.699 24.0602C126.322 24.3437 124.362 26.6313 124.377 29.0548C124.412 35.0708 124.393 41.0829 124.393 47.099C121.034 47.099 117.676 47.0912 114.321 47.099C114.299 36.4146 114.321 25.7341 114.31 15.0498H123.969C123.969 16.2693 123.976 17.4888 123.953 18.7083V18.7122Z" fill="#D9D7DA" />
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-4.svg" alt="Habr">
                                        <span><?= $home_demo_desc_habr; ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg" alt="Habr">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_portfolio_sub = get_field('home_portfolio_sub');
    $home_portfolio_title = get_field('home_portfolio_title');
    $home_portfolio_items = get_field('home_portfolio_items');
    $home_portfolio_desc = get_field('home_portfolio_desc');
    $home_portfolio_gallery = get_field('home_portfolio_gallery');

    $home_portfolio_gallery_size = ceil(count($home_portfolio_gallery) / 2);
    $home_portfolio_gallery_cols = [
        array_slice($home_portfolio_gallery, 0, $home_portfolio_gallery_size),
        array_slice($home_portfolio_gallery, $home_portfolio_gallery_size)
    ];

    if( $home_portfolio_title && $home_portfolio_gallery ):
?>
    <section class="home-portfolio section">
        <div class="container">
            <div class="home-portfolio__wrap">
                <div class="home-portfolio__left home-portfolio__col">
                    <?php if( $home_portfolio_sub ): ?>
                        <div class="home-portfolio__sub" data-aos="fade-up"><?= $home_portfolio_sub; ?></div>
                    <?php endif; ?>
                    <h2 class="home-portfolio__title" data-aos="fade-up"><?= $home_portfolio_title; ?></h2>
                    <?php if( $home_portfolio_items ): ?>
                        <div class="home-portfolio__row" data-aos="fade-up">
                            <?php foreach( $home_portfolio_items as $home_portfolio_item ): ?>
                                <div class="home-portfolio__item">
                                    <?php if( $home_portfolio_item['icon'] ): ?>
                                        <img src="<?= $home_portfolio_item['icon']; ?>" alt="<?= $home_portfolio_item['label']; ?>">
                                    <?php endif; ?>
                                    <span><?= $home_portfolio_item['label']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $home_portfolio_desc ): ?>
                        <div class="home-portfolio__desc" data-aos="fade-up"><?= $home_portfolio_desc; ?></div>
                    <?php endif; ?>
                </div>
                <?php if( $home_portfolio_gallery_cols ): ?>
                    <div class="home-portfolio__right home-portfolio__col" data-aos="fade-up">
                        <div class="home-portfolio__lists">
                            <?php $counter = 1; foreach( $home_portfolio_gallery_cols as $home_portfolio_gallery_col ): ?>
                                <div class="home-portfolio__list js-infinity-line" data-duration="15"<?= $counter == 1 ? ' data-revers="1"' : ''; ?>>
                                    <?php $logo_counter = 1; foreach( $home_portfolio_gallery_col as $home_portfolio_gallery_item ): ?>
                                        <div class="home-portfolio__logo">
                                            <img src="<?= kama_thumb_src( 'wh=548:278', $home_portfolio_gallery_item ); ?>" alt="<?= $home_portfolio_sub; ?> - Logo <?= $logo_counter; ?>">
                                        </div>
                                    <?php $logo_counter++; endforeach; ?>
                                </div>
                            <?php $counter++; endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="home-portfolio__slider swiper-container" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <?php $logo_counter = 1; foreach( $home_portfolio_gallery as $home_portfolio_gallery_item ): ?>
                        <div class="home-portfolio__slide swiper-slide">
                            <div class="home-portfolio__logo">
                                <img src="<?= kama_thumb_src( 'wh=548:278', $home_portfolio_gallery_item ); ?>" alt="<?= $home_portfolio_sub; ?> - Logo <?= $logo_counter; ?>">
                            </div>
                        </div>
                    <?php $logo_counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_video_items = get_field('home_video_items');

    if( $home_video_items ):
?>
    <section class="home-product-video section">
        <div class="container">
            <div class="home-product-video__tabs" data-aos="fade-up">
                <?php $counter = 1; foreach( $home_video_items as $home_video_item ): ?>
                    <button class="home-product-video__tab js-h-product-video-tab<?= $counter == 1 ? ' active' : ''; ?>" type="button"><?= $home_video_item['label']; ?></button>
                <?php $counter++; endforeach; ?>
            </div>
            <div class="home-product-video__wrap" data-aos="fade-up">
                <?php $counter = 1; foreach( $home_video_items as $home_video_item ): ?>
                    <div class="home-product-video__block js-h-product-video-block"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                        <div class="home-product-video__item js-h-product-video-item">
                            <video playsinline controls>
                                <source src="<?= $home_video_item['video']; ?>" type="video/mp4">
                            </video>
                            <div class="home-product-video__item-bg">
                                <img src="<?= kama_thumb_src( 'wh=1200:648', $home_video_item['bg'] ); ?>" alt="<?= $home_video_item['label']; ?>">
                                <button class="home-product-video__item-btn" type="button">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/play-icon.svg" alt="Play">
                                </button>
                            </div>
                            <div class="home-product-video__item-header">
                                <div class="home-product-video__item-tag h7"><?= $home_video_item['label']; ?></div>
                                <div class="home-product-video__item-desc h7"><?= $home_video_item['desc']; ?></div>
                            </div>
                            <div class="home-product-video__item-footer">
                                <h2 class="home-product-video__item-title h1"><?= $home_video_item['title']; ?></h2>
                                <div class="home-product-video__item-logo">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/home-product-video-logo.svg" alt="Space">
                                </div>
                            </div>
                        </div>
                        <div class="home-product-video__mob-desc"><?= $home_video_item['desc']; ?></div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_faq_title = get_field('home_faq_title');
    $home_faq_bg = get_field('home_faq_bg');
    $home_faq_items = get_field('home_faq_items');

    if( $home_faq_items ):
?>
    <section class="faq section">
        <div class="container">
            <div class="faq__wrap">
                <?php if( $home_faq_title && $home_faq_bg ): ?>
                    <div class="faq__left" data-aos="fade-up">
                        <div class="faq__block">
                            <div class="faq__block-bg">
                                <img src="<?= $home_faq_bg; ?>" alt="FAQ">
                            </div>
                            <h2 class="faq__block-title h3"><?= $home_faq_title; ?></h2>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="faq__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="faq__list">
                        <?php foreach( $home_faq_items as $home_faq_item ): ?>
                            <div class="faq__col">
                                <div class="faq__item">
                                    <div class="faq__toggle h7 js-faq-toggle">
                                        <span><?= $home_faq_item['question']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/faq-arrow.svg" alt="Arrow">
                                    </div>
                                    <div class="faq__dropdown js-faq-dropdown">
                                        <div class="faq__content"><?= $home_faq_item['answer']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_media_title = get_field('home_media_title');
    $home_media_desc = get_field('home_media_desc');
    $home_media_items = get_field('home_media_items');

    if( $home_media_title && $home_media_items ):
?>
    <section class="home-media section">
        <div class="container">
            <h2 class="home-media__title" data-aos="fade-up"><?= $home_media_title; ?></h2>
            <?php if( $home_media_desc ): ?>
                <div class="home-media__desc" data-aos="fade-up"><?= $home_media_desc; ?></div>
            <?php endif; ?>
            <div class="home-media__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $home_media_items as $home_media_item ): ?>
                        <div class="home-media__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= ($counter - 1) * 200; ?>">
                            <a class="home-media__card" href="<?= $home_media_item['url']; ?>" target="_blank">
                                <div class="home-media__card-text"><?= $home_media_item['text']; ?></div>
                                <div class="home-media__card-logo"><?= get_retina_img($home_media_item['logo'], 'SMI - Logo ' . $counter); ?></div>
                                <div class="home-media__card-btn">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/home-media-arrow.svg" alt="Arrow">
                                </div>
                            </a>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $home_news_title = get_field('home_news_title');
    $home_news_btn_label = get_field('home_news_btn_label');
    $home_news_btn_url = get_field('home_news_btn_url');

    $news_arr = [];
    $args = array(
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => 'news'
            )
        )
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ){
        while( $query->have_posts() ){
            $query->the_post();
            
            $news_arr[] = get_the_ID();
        }
        wp_reset_postdata();
    }

    if( $news_arr && count($news_arr) == 4):
?>
    <section class="home-news section">
        <div class="home-bg-path home-bg-path--7">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-7.svg" alt="#">
        </div>
        <div class="container">
            <?php if( $home_news_title ): ?>
                <h2 class="home-news__title" data-aos="fade-up"><?= $home_news_title; ?></h2>
            <?php endif; ?>
            <div class="home-news__row row-lg">
                <div class="home-news__left col-lg" data-aos="fade-up">
                    <?php get_template_part( 'templates/parts/news-card-lg', null, ['card_id' => $news_arr[0]] ); ?>
                </div>
                <div class="home-news__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="home-news__list">
                        <?php foreach( $news_arr as $news_item ): ?>
                            <div class="home-news__col">
                                <?php get_template_part( 'templates/parts/news-card-small', null, ['card_id' => $news_item] ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if( $home_news_btn_label && $home_news_btn_url ): ?>
                <div class="home-news__btn">
                    <a class="btn" href="<?= $home_news_btn_url; ?>"><?= $home_news_btn_label; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>