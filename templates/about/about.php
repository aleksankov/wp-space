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
    $about_hero_img = get_field('about_hero_img');
    $about_hero_title = get_field('about_hero_title');
    $about_hero_desc = get_field('about_hero_desc');
    $about_hero_items = get_field('about_hero_items');

    if( $about_hero_title ):
?>
    <section class="product-hero product-hero--about" data-aos="fade-up">
        <div class="container">
            <div class="product-hero__wrap">
                <?php if( $about_hero_img ): ?>
                    <div class="product-hero__img">
                        <img src="<?= kama_thumb_src( 'wh=882:826', $about_hero_img ); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="product-hero__content">
                    <h1 class="product-hero__title"><?= $about_hero_title; ?></h1>
                    <?php if( $about_hero_desc ): ?>
                        <div class="product-hero__desc"><?= $about_hero_desc; ?></div>
                    <?php endif; ?>
                    <?php if( $about_hero_items ): ?>
                        <div class="product-hero__documents">
                            <?php foreach( $about_hero_items as $about_hero_item ): ?>
                                <?php if( $about_hero_item['type'] == 'link' ): ?>
                                    <div class="product-hero__documents-col">
                                        <a class="product-hero__documents-item" href="<?= $about_hero_item['url']; ?>" target="_blank">
                                            <span><?= $about_hero_item['label']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-doc-icon-1.svg" alt="Arrow">
                                        </a>
                                    </div>
                                <?php elseif( $about_hero_item['type'] == 'file' ): ?>
                                    <div class="product-hero__documents-col">
                                        <a class="product-hero__documents-item" href="<?= $about_hero_item['file']; ?>" target="_blank">
                                            <span><?= $about_hero_item['label']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-doc-icon-2.svg" alt="Download">
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $about_achievements_card = get_field('about_achievements_card');
    //var_dump($about_achievements_card);
    if( $about_achievements_card ):
?>
    <section class="about-achievements" data-aos="fade-up">
        <div class="container">
            <div class="about-achievements__wrap">
                <div class="about-achievements__items">
                    <?php foreach( $about_achievements_card as $item ): ?>
                        <div class="about-achievements__item" data-aos="fade-up">
                            <span class="about-achievements__title h2"><?= $item['about_achievements_title']; ?></span>
                            <p class="about-achievements__text"><?= $item['about_achievements_text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$about_products_title = get_field('about_products_title');
$about_products_card = get_field('about_products_card');
//var_dump($about_products_card);
if( $about_products_title ):
    ?>
    <section class="about-products section" data-aos="fade-up">
        <div class="container">
            <div class="about-products__wrap">
                <h2 class="about-products__main-title h2"><?= $about_products_title ?></h2>
                <div class="about-products__items">
                    <?php foreach( $about_products_card as $index => $item ): ?>
                        <a href="<?= $item['link']; ?>" class="about-products__item" data-aos="fade-up">
                            <div class="about-products__icon">
                                <img src="<?= $item['icon']; ?>" alt="Icon-<?= $index ?>">
                            </div>
                            <span class="about-products__title h5"><?= $item['title']; ?></span>
                            <p class="about-products__text"><?= $item['text']; ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$about_regions_title = get_field('about_regions_title');
$about_regions_card = get_field('about_regions_cards');

if( $about_regions_title ):
    ?>
    <section class="about-regions section" data-aos="fade-up">
        <div class="container">
            <div class="about-regions__wrap">
                <h2 class="about-regions__main-title h2"><?= $about_regions_title ?></h2>
                <div class="about-regions__items">
                    <?php foreach( $about_regions_card as $index => $item ): ?>
                        <div class="about-regions__item" data-aos="fade-up">
                            <div class="about-regions__image">
                                <img src="<?= $item['image']; ?>" alt="Icon-<?= $index ?>">
                            </div>
                            <span class="about-regions__title h5"><?= $item['name']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $about_gallery_title = get_field('about_gallery_title');
    $about_gallery_items = get_field('about_gallery_items');

    $about_gallery_items_size = ceil(count($about_gallery_items) / 2);
    $about_gallery_items_cols = [
        array_slice($about_gallery_items, 0, $about_gallery_items_size),
        array_slice($about_gallery_items, $about_gallery_items_size)
    ];

    if( $about_gallery_items && $about_gallery_items_cols ):
?>
    <section class="about-gallery section">
        <div class="container">
            <div class="about-gallery__row">
                <?php $counter = 1; $img_counter = 1; foreach( $about_gallery_items_cols as $about_gallery_items_col ): ?>
                    <div class="about-gallery__col">
                        <?php if( $counter == 1 && $about_gallery_title ): ?>
                            <h2 class="about-gallery__title" data-aos="fade-up"><?= $about_gallery_title; ?></h2>
                        <?php endif; ?>
                        <div class="about-gallery__list">
                            <?php foreach( $about_gallery_items_col as $about_gallery_item ): ?>
                                <a class="about-gallery__list-item" href="<?= kama_thumb_src( 'w=1920&rise_small=false', $about_gallery_item ); ?>" data-fancybox="about-gallery" data-aos="fade-up">
                                    <img src="<?= kama_thumb_src( 'wh=1168:600', $about_gallery_item ); ?>" alt="Gallery - Image <?= $img_counter; ?>">
                                </a>
                            <?php $img_counter++; endforeach; ?>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
        <div class="about-gallery__slider swiper-container">
            <div class="swiper-wrapper">
                <?php $img_counter = 1; foreach( $about_gallery_items as $about_gallery_item ): ?>
                    <div class="about-gallery__slide swiper-slide">
                        <div class="about-gallery__item">
                            <a href="<?= kama_thumb_src( 'w=1920&rise_small=false', $about_gallery_item ); ?>" data-fancybox="about-mob-gallery">
                                <img src="<?= kama_thumb_src( 'wh=1168:600', $about_gallery_item ); ?>" alt="Gallery - Image <?= $img_counter; ?>">
                            </a>
                        </div>
                    </div>
                <?php $img_counter++; endforeach; ?>
            </div>
            <div class="about-gallery__pagination gallery-pagination"></div>
        </div>
    </section>
<?php endif; ?>

<?php
$about_clients_title = get_field('about_clients_title');
$about_clients_logo = get_field('about_clients_logo');
//var_dump($about_clients_logo);
if( $about_clients_title ):
    ?>
    <section class="about-clients section" data-aos="fade-up">
        <div class="container">
            <div class="about_clients__wrap">
                <h2 class="about-clients__main-title h2"><?= $about_clients_title ?></h2>
                <div class="about-clients__items about-clients__slider">
                    <div class="swiper-wrapper">
                        <?php foreach( $about_clients_logo as $index => $item ): ?>
                            <div class="about-clients__item swiper-slide" data-aos="fade-up">
                                <div class="about-clients__image">
                                    <img src="<?= $item; ?>" alt="Icon-<?= $index ?>">
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
    $about_team_title = get_field('about_team_title');
    $about_team_desc = get_field('about_team_desc');
    $about_team_items = get_field('about_team_items');

    if( $about_team_items ):
?>
    <section class="about-team section">
        <div class="container">
            <div class="about-team__header">
                <?php if( $about_team_title ): ?>
                    <h2 class="about-team__title" data-aos="fade-up"><?= $about_team_title; ?></h2>
                <?php endif; ?>
                <?php if( $about_team_desc ): ?>
                    <div class="about-team__desc" data-aos="fade-up"><?= $about_team_desc; ?></div>
                <?php endif; ?>
            </div>
            <div class="about-team__wrap">
                <div class="about-team__slider swiper-container">
                    <div class="swiper-wrapper">
                        <?php $counter = 0; $block_counter = 1; foreach( $about_team_items as $about_team_item ): if($counter == 3) $counter = 0; ?>
                            <div class="about-team__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                                <div class="about-team__item">
                                    <div class="about-team__item-img">
                                        <?php if( $about_team_item['img'] ): ?>
                                            <img src="<?= kama_thumb_src( 'wh=652:652', $about_team_item['img'] ); ?>" alt="<?= $about_team_item['name']; ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="about-team__item-info">
                                        <div class="about-team__item-top">
                                            <div class="about-team__item-name h7"><?= $about_team_item['name']; ?></div>
                                            <div class="about-team__item-desc"><?= $about_team_item['position']; ?></div>
                                        </div>
                                        <?php if( $about_team_item['desc'] ): ?>
                                            <div class="about-team__item-btn-wrap">
                                                <a class="about-team__btn js-about-team-btn" href="#team-popup-<?= $block_counter; ?>">Краткая биография</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; $block_counter++; endforeach; ?>
                    </div>
                    <div class="about-team__pagination gallery-pagination"></div>
                </div>
                <?php $counter = 1; foreach( $about_team_items as $about_team_item ): if($about_team_item['desc']): ?>
                    <div class="about-team-popup js-about-team-popup" id="team-popup-<?= $counter; ?>">
                        <button class="about-team-popup__mob-close js-about-team-btn-close" type="button">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/about-team-mob-close.svg" alt="Close">
                        </button>
                        <div class="about-team-popup__header">
                            <div class="about-team-popup__info">
                                <div class="about-team-popup__img">
                                    <?php if( $about_team_item['img'] ): ?>
                                        <img src="<?= kama_thumb_src( 'wh=652:652', $about_team_item['img'] ); ?>" alt="<?= $about_team_item['name']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="about-team-popup__col">
                                    <div class="about-team-popup__name">
                                        <span class="h7"><?= $about_team_item['full_name']; ?></span>
                                        <?php if( $about_team_item['date'] ): ?>
                                            <i><?= $about_team_item['date']; ?></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="about-team-popup__position"><?= $about_team_item['position']; ?></div>
                                </div>
                            </div>
                            <button class="about-team-popup__close js-about-team-btn-close" type="button">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/team-popup-close.svg" alt="Close">
                            </button>
                        </div>
                        <div class="about-team-popup__content"><?= $about_team_item['desc']; ?></div>
                    </div>
                <?php endif; $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $about_vacancies_title = get_field('about_vacancies_title');
    $about_vacancies_desc = get_field('about_vacancies_desc');
    $about_vacancies_email = get_field('about_vacancies_email');
    $about_vacancies_bottom_desc = get_field('about_vacancies_bottom_desc');
    $about_vacancies_btn_label = get_field('about_vacancies_btn_label');
    $about_vacancies_btn_url = get_field('about_vacancies_btn_url');
    $about_vacancies_link_label = get_field('about_vacancies_link_label');
    $about_vacancies_link_url = get_field('about_vacancies_link_url');
    $about_vacancies_img = get_field('about_vacancies_img');

    if( $about_vacancies_title ):
?>
    <section class="about-vacancies section">
        <div class="container">
            <div class="about-vacancies__row">
                <div class="about-vacancies__img" data-aos="fade-up" data-aos-delay="200">
                    <img src="<?= kama_thumb_src( 'wh=968:754', $about_vacancies_img ); ?>" alt="<?= $about_vacancies_title; ?>">
                </div>
                <div class="about-vacancies__content" data-aos="fade-up">
                    <div class="about-vacancies__top">
                        <h2 class="about-vacancies__title"><?= $about_vacancies_title; ?></h2>
                        <?php if( $about_vacancies_desc ): ?>
                            <div class="about-vacancies__desc"><?= $about_vacancies_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $about_vacancies_email ): ?>
                            <div class="about-vacancies__copy">
                                <div class="about-vacancies__copy-btn">
                                    <span><?= $about_vacancies_email; ?></span>
                                    <button class="js-copy-btn" type="button" data-text="<?= $about_vacancies_email; ?>">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/copy-icon.svg" alt="Copy">
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="about-vacancies__bottom">
                        <?php if( $about_vacancies_bottom_desc ): ?>
                            <div class="about-vacancies__sub"><?= $about_vacancies_bottom_desc; ?></div>
                        <?php endif; ?>
                        <div class="about-vacancies__bottom-wrap">
                            <?php if( $about_vacancies_btn_label && $about_vacancies_btn_url ): ?>
                                <div class="about-vacancies__btn">
                                    <a class="btn" href="<?= $about_vacancies_btn_url; ?>"><?= $about_vacancies_btn_label; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if( $about_vacancies_link_label && $about_vacancies_link_url ): ?>
                                <div class="about-vacancies__hh">
                                    <a class="btn btn-transparent btn-icon" href="<?= $about_vacancies_link_url; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hh-icon.svg" alt="HH">
                                        <span><?= $about_vacancies_link_label; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $about_contacts_title = get_field('about_contacts_title');

    if( $about_contacts_title && $site_contacts_addresses ):
?>
    <section class="about-contacts section">
        <div class="container">
            <h2 class="about-contacts__title" data-aos="fade-up"><?= $about_contacts_title; ?></h2>
            <div class="about-contacts__row">
                <div class="about-contacts__mob" data-aos="fade-up">
                    <div class="about-contacts__select">
                        <div class="filter-select">
                            <select class="js-select js-about-map-select">
                                <option value="0">&nbsp;</option>
                                <?php $counter = 1; foreach( $site_contacts_addresses as $site_contacts_address ): ?>
                                    <option value="<?= $counter; ?>"<?= $counter == 1 ? ' selected' : ''; ?>><?= $site_contacts_address['city']; ?></option>
                                <?php $counter++; endforeach; ?>
                            </select>
                            <span class="js-select-toggle">Город</span>
                        </div>
                    </div>
                    <div class="about-contacts__addresses">
                        <?php $counter = 1; foreach( $site_contacts_addresses as $site_contacts_address ): ?>
                            <div class="about-contacts__addresses-item js-about-map-address"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>><?= $site_contacts_address['address']; ?></div>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
                <div class="about-contacts__left" data-aos="fade-up">
                    <div class="about-contacts__tabs">
                        <?php $counter = 1; foreach( $site_contacts_addresses as $site_contacts_address ): ?>
                            <button class="about-contacts__tab js-about-map-tab<?= $counter == 1 ? ' active' : ''; ?>" type="button">
                                <div class="about-contacts__tab-sub h5">Офис в г. <span><?= $site_contacts_address['city']; ?></span></div>
                                <div class="about-contacts__tab-desc"><?= $site_contacts_address['address']; ?></div>
                            </button>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
                <div class="about-contacts__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="about-contacts__map">
                        <div class="about-contacts__map-item" id="about-map"></div>
                        <div class="about-contacts__map-controls">
                            <button class="about-contacts__map-btn js-about-map-zoom-in" type="button">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/map-zoom-in-icon.svg" alt="Zoom In">
                            </button>
                            <button class="about-contacts__map-btn js-about-map-zoom-out" type="button">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/map-zoom-out-icon.svg" alt="Zoom Out">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const siteContactsAddresses = <?= json_encode($site_contacts_addresses); ?>;

        ymaps.ready(mapInit);

        function mapInit() {
            var aboutMap = new ymaps.Map('about-map', {
                center: [parseFloat(siteContactsAddresses[0].position_x), parseFloat(siteContactsAddresses[0].position_y)],
                zoom: 11,
                controls: []
            });

            aboutMap.behaviors.disable('scrollZoom');

            siteContactsAddresses.forEach((address) => {
                const placemark = new ymaps.Placemark(
                    [parseFloat(address.position_x), parseFloat(address.position_y)], 
                    {}, 
                    { preset: 'islands#violetIcon' }
                );
                aboutMap.geoObjects.add(placemark);
            });
        
            $(document).on('click', '.js-about-map-tab', function(){
                if( !$(this).hasClass('active') ){
                    const index = $(this).index();
                    const select = $('select.js-about-map-select');
                    
                    $(this).addClass('active').siblings().removeClass('active');
                    select.val(index + 1).trigger('refresh').trigger('change');
                }
            });
        
            $(document).on('change', 'select.js-about-map-select', function(){
                const tabs = $('.js-about-map-tab');
                const value = $(this).val();
                const index = value - 1;
                const addresses = $('.js-about-map-address');
        
                tabs.removeClass('active').eq(index).addClass('active');
                addresses.hide().eq(index).stop().fadeIn(300);
                aboutMap.setCenter([
                    parseFloat(siteContactsAddresses[index].position_x),
                    parseFloat(siteContactsAddresses[index].position_y)
                ], 11);
            });

            $(document).on('click', '.js-about-map-zoom-in', function(){
                const currentZoom = aboutMap.getZoom();
                aboutMap.setZoom(currentZoom + 1);
            })
            $(document).on('click', '.js-about-map-zoom-out', function(){
                const currentZoom = aboutMap.getZoom();
                aboutMap.setZoom(currentZoom - 1);
            })
        }
    </script>
<?php endif; ?>

<?php get_footer(); ?>