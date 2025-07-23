<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    global $site_soc_tg;
    global $site_soc_yt;
    global $site_soc_vk;
    global $site_soc_habr;
    global $site_soc_rutube;

    $site_soc_tg = get_field('site_soc_tg', 'option');
    $site_soc_yt = get_field('site_soc_yt', 'option');
    $site_soc_vk = get_field('site_soc_vk', 'option');
    $site_soc_habr = get_field('site_soc_habr', 'option');
    $site_soc_rutube = get_field('site_soc_rutube', 'option');

    global $site_contacts_email;
    global $site_contacts_phone;
    global $site_contacts_addresses;

    $site_contacts_email = get_field('site_contacts_email', 'option');
    $site_contacts_phone = get_field('site_contacts_phone', 'option');
    $site_contacts_addresses = get_field('site_contacts_addresses', 'option');
    
    $site_header_menu = get_field('site_header_menu', 'option');
    $page_submenu = get_field('page_submenu');

    global $site_forms_agree;
    global $form_product_options;
    global $form_partner_options;
    global $form_production_options;

    $site_forms_agree = get_field('site_forms_agree', 'option');
    $form_product_options = get_product_options();
    $form_partner_options = get_partner_options();
    $form_production_options = get_production_options();
    
    global $site_feedback_main_email;
    global $site_feedback_partner_email;
    global $site_feedback_tech_partner_email;
    global $site_feedback_hr_email;

    $site_feedback_main_email = get_field('site_feedback_main_email', 'option');
    $site_feedback_partner_email = get_field('site_feedback_partner_email', 'option');
    $site_feedback_tech_partner_email = get_field('site_feedback_tech_partner_email', 'option');
    $site_feedback_hr_email = get_field('site_feedback_hr_email', 'option');

    // Только для шапки
    $header_contacts_email = get_field('header_contacts_email', 'option');
    $header_contacts_phone = get_field('header_contacts_telephone', 'option');
    $header_contacts_messengers = get_field('header_contacts_messengers', 'option');
    //$header_contacts_telegram = get_field('header_contacts_telegram', 'option');
    //$header_contacts_youtube = get_field('header_contacts_youtube', 'option');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KCHTT9K7');</script>
	<!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/css/fonts/Manrope/manrope-v15-cyrillic_cyrillic-ext_latin_latin-ext-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/css/fonts/Manrope/manrope-v15-cyrillic_cyrillic-ext_latin_latin-ext-500.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/css/fonts/Manrope/manrope-v15-cyrillic_cyrillic-ext_latin_latin-ext-600.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/css/fonts/Manrope/manrope-v15-cyrillic_cyrillic-ext_latin_latin-ext-700.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <?php wp_head(); ?>
    <title><?= wp_get_document_title()?></title>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCHTT9K7"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
    <header class="header<?= $page_submenu ? ' header--submenu' : ''; ?> compensate-for-scrollbar js-header">
        <div class="header__wrap">
            <div class="container">
                <div class="header__top">
                    <div class="header__logo">
                        <?php if( !is_front_page() ): ?>
                            <a href="<?= get_home_url(); ?>">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?= get_bloginfo( 'name' ); ?>">
                            </a>
                        <?php else: ?>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?= get_bloginfo( 'name' ); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="header__top-col">
                        <?php if ( $header_contacts_messengers ) : ?>
                            <div class="header__soc">
                                <?php foreach ($header_contacts_messengers as $messenger) : ?>
                                    <a class="header__soc-item" href="<?= $messenger['link']; ?>" target="_blank">
                                        <img src="<?= $messenger['icon'] ?>" alt="">
                                    </a>
                                <?php endforeach; ?>

                                <?php if (false) : ?>
                                    <?php if( $header_contacts_youtube ): ?>
                                        <a class="header__soc-item" href="<?= $header_contacts_youtube; ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="24" viewBox="0 0 35 24" fill="none">
                                                <path d="M18.2331 23.9903L11.0691 23.8599C8.74953 23.8146 6.42423 23.9053 4.15022 23.4349C0.690765 22.7321 0.445696 19.2863 0.189229 16.3958C-0.164125 12.3323 -0.0273428 8.19499 0.639471 4.16541C1.01562 1.90408 2.49743 0.555214 4.78854 0.407859C12.5224 -0.124885 20.3076 -0.0625424 28.0244 0.186827C28.8394 0.209497 29.6601 0.334182 30.4637 0.475869C34.4304 1.1673 34.5273 5.0722 34.7838 8.35935C35.0402 11.6805 34.932 15.0187 34.4418 18.3171C34.0486 21.0489 33.2963 23.3385 30.1218 23.5596C26.1437 23.8486 22.2568 24.081 18.2673 24.0073C18.2673 23.9903 18.2445 23.9903 18.2331 23.9903ZM14.0213 17.0759C17.0192 15.3644 19.96 13.6811 22.9407 11.9809C19.9372 10.2693 17.0021 8.58605 14.0213 6.8858V17.0759Z" fill="#10041B" />
                                            </svg>
                                        </a>
                                    <?php elseif($site_soc_yt) : ?>
                                        <a class="header__soc-item" href="<?= $site_soc_yt; ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="24" viewBox="0 0 35 24" fill="none">
                                                <path d="M18.2331 23.9903L11.0691 23.8599C8.74953 23.8146 6.42423 23.9053 4.15022 23.4349C0.690765 22.7321 0.445696 19.2863 0.189229 16.3958C-0.164125 12.3323 -0.0273428 8.19499 0.639471 4.16541C1.01562 1.90408 2.49743 0.555214 4.78854 0.407859C12.5224 -0.124885 20.3076 -0.0625424 28.0244 0.186827C28.8394 0.209497 29.6601 0.334182 30.4637 0.475869C34.4304 1.1673 34.5273 5.0722 34.7838 8.35935C35.0402 11.6805 34.932 15.0187 34.4418 18.3171C34.0486 21.0489 33.2963 23.3385 30.1218 23.5596C26.1437 23.8486 22.2568 24.081 18.2673 24.0073C18.2673 23.9903 18.2445 23.9903 18.2331 23.9903ZM14.0213 17.0759C17.0192 15.3644 19.96 13.6811 22.9407 11.9809C19.9372 10.2693 17.0021 8.58605 14.0213 6.8858V17.0759Z" fill="#10041B" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $header_contacts_telegram ): ?>
                                        <a class="header__soc-item" href="<?= $header_contacts_telegram; ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z" fill="#10041B" />
                                                <path d="M8.11914 12.8778L9.54284 16.8184C9.54284 16.8184 9.72084 17.1871 9.91144 17.1871C10.102 17.1871 12.9369 14.2379 12.9369 14.2379L16.0894 8.14893L8.16994 11.8606L8.11914 12.8778Z" fill="#10041B" />
                                                <path d="M10.0086 13.8882L9.73525 16.7928C9.73525 16.7928 9.62085 17.6828 10.5107 16.7928C11.4005 15.9028 12.2522 15.2165 12.2522 15.2165" fill="white" />
                                                <path d="M8.15115 13.0178L5.22255 12.0636C5.22255 12.0636 4.87255 11.9216 4.98525 11.5996C5.00845 11.5332 5.05525 11.4767 5.19525 11.3796C5.84415 10.9273 17.2058 6.84359 17.2058 6.84359C17.2058 6.84359 17.5266 6.73549 17.7158 6.80739C17.7627 6.82188 17.8048 6.84854 17.8379 6.88465C17.871 6.92076 17.8939 6.96501 17.9043 7.01289C17.9248 7.09746 17.9333 7.18446 17.9297 7.27139C17.9288 7.34659 17.9197 7.41629 17.9128 7.52559C17.8436 8.64209 15.7728 16.9749 15.7728 16.9749C15.7728 16.9749 15.6489 17.4625 15.205 17.4792C15.096 17.4827 14.9873 17.4642 14.8855 17.4249C14.7837 17.3855 14.6909 17.326 14.6125 17.25C13.7414 16.5007 10.7306 14.4773 10.0653 14.0323C10.0503 14.0221 10.0377 14.0087 10.0283 13.9932C10.0189 13.9777 10.0129 13.9603 10.0107 13.9423C10.0014 13.8954 10.0524 13.8373 10.0524 13.8373C10.0524 13.8373 15.295 9.17729 15.4345 8.68809C15.4453 8.65019 15.4045 8.63149 15.3497 8.64809C15.0015 8.77619 8.96535 12.5881 8.29915 13.0088C8.25119 13.0233 8.20051 13.0264 8.15115 13.0178Z" fill="white" />
                                            </svg>
                                        </a>
                                    <?php elseif($site_soc_tg) : ?>
                                        <a class="header__soc-item" href="<?= $site_soc_tg; ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z" fill="#10041B" />
                                                <path d="M8.11914 12.8778L9.54284 16.8184C9.54284 16.8184 9.72084 17.1871 9.91144 17.1871C10.102 17.1871 12.9369 14.2379 12.9369 14.2379L16.0894 8.14893L8.16994 11.8606L8.11914 12.8778Z" fill="#10041B" />
                                                <path d="M10.0086 13.8882L9.73525 16.7928C9.73525 16.7928 9.62085 17.6828 10.5107 16.7928C11.4005 15.9028 12.2522 15.2165 12.2522 15.2165" fill="white" />
                                                <path d="M8.15115 13.0178L5.22255 12.0636C5.22255 12.0636 4.87255 11.9216 4.98525 11.5996C5.00845 11.5332 5.05525 11.4767 5.19525 11.3796C5.84415 10.9273 17.2058 6.84359 17.2058 6.84359C17.2058 6.84359 17.5266 6.73549 17.7158 6.80739C17.7627 6.82188 17.8048 6.84854 17.8379 6.88465C17.871 6.92076 17.8939 6.96501 17.9043 7.01289C17.9248 7.09746 17.9333 7.18446 17.9297 7.27139C17.9288 7.34659 17.9197 7.41629 17.9128 7.52559C17.8436 8.64209 15.7728 16.9749 15.7728 16.9749C15.7728 16.9749 15.6489 17.4625 15.205 17.4792C15.096 17.4827 14.9873 17.4642 14.8855 17.4249C14.7837 17.3855 14.6909 17.326 14.6125 17.25C13.7414 16.5007 10.7306 14.4773 10.0653 14.0323C10.0503 14.0221 10.0377 14.0087 10.0283 13.9932C10.0189 13.9777 10.0129 13.9603 10.0107 13.9423C10.0014 13.8954 10.0524 13.8373 10.0524 13.8373C10.0524 13.8373 15.295 9.17729 15.4345 8.68809C15.4453 8.65019 15.4045 8.63149 15.3497 8.64809C15.0015 8.77619 8.96535 12.5881 8.29915 13.0088C8.25119 13.0233 8.20051 13.0264 8.15115 13.0178Z" fill="white" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>

                        <?php if( $header_contacts_email || $header_contacts_phone ): ?>
                            <div class="header__links">
                                <ul>
                                    <?php if( $header_contacts_email ): ?>
                                        <li>
                                            <a href="mailto:<?= $header_contacts_email; ?>"><?= $header_contacts_email; ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if( $header_contacts_phone ): ?>
                                        <li>
                                            <a href="<?= get_tel_href($header_contacts_phone); ?>"><?= $header_contacts_phone; ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="header__top-mob">
                        <?php if( $header_contacts_email || $header_contacts_phone ): ?>
                            <div class="header__top-mob-links">
                                <?php if( $header_contacts_email ): ?>
                                    <a class="header__top-mob-link" href="mailto:<?= $header_contacts_email; ?>">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/header-top-mob-icon-1.svg" alt="E-mail">
                                    </a>
                                <?php endif; ?>
                                <?php if( $header_contacts_phone ): ?>
                                    <a class="header__top-mob-link" href="<?= get_tel_href($header_contacts_phone); ?>">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/header-top-mob-icon-2.svg" alt="Phone">
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <button class="header__menu-icon js-menu-btn" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
                <?php if( $site_header_menu ): ?>
                    <nav class="header__menu js-heder-menu">
                        <ul>
                            <?php foreach( $site_header_menu as $site_header_menu_li ): ?>
                                <?php 
                                    $current_url = home_url(add_query_arg(array(), $wp->request));
                                    $is_current_page = false;

                                    if (isset($site_header_menu_li['url']) && $current_url === rtrim($site_header_menu_li['url'], '/')) {
                                        $is_current_page = true;
                                    }

                                    if (!$is_current_page && $site_header_menu_li['cards']) {
                                        foreach ($site_header_menu_li['cards'] as $card) {
                                            if ($current_url === rtrim($card['url'], '/')) {
                                                $is_current_page = true;
                                                break;
                                            }
                                        }
                                    }

                                    if (!$is_current_page && $site_header_menu_li['items']) {
                                        foreach ($site_header_menu_li['items'] as $item) {
                                            if ($current_url === rtrim($item['url'], '/')) {
                                                $is_current_page = true;
                                                break;
                                            }
                                        }
                                    }
                                ?>
                                <?php if( $site_header_menu_li['url'] && ! $site_header_menu_li['type']): ?>
                                    <li class="<?= $is_current_page ? 'cur-page' : ''; ?>">
                                        <a href="<?= $site_header_menu_li['url']; ?>"><?= $site_header_menu_li['label']; ?></a>
                                    </li>
                                <?php else: ?>
                                    <li class="dropdown js-menu-item-toggle<?= $is_current_page ? ' cur-page' : ''; ?>">
                                        <?php if ($site_header_menu_li['url']) : ?>
                                            <a href="<?= $site_header_menu_li['url']; ?>"><?= $site_header_menu_li['label']; ?></a>
                                        <?php else : ?>
                                            <span><?= $site_header_menu_li['label']; ?></span>
                                        <?php endif ?>

                                        <?php if( $site_header_menu_li['type'] == '1' && $site_header_menu_li['cards'] ): ?>
                                            <div class="header__menu-dropdown js-menu-item-dropdown">
                                                <div class="h-dropdown">
                                                    <button class="h-dropdown__back js-menu-item-back" type="button">
                                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-dropdown-back-icon.svg" alt="Back">
                                                        <span><?= $site_header_menu_li['label']; ?></span>
                                                    </button>
                                                    <div class="h-dropdown__row">
                                                        <?php foreach( $site_header_menu_li['cards'] as $site_header_menu_card ): ?>
                                                            <div class="h-dropdown__col">
                                                                <a class="product-card product-card--small" href="<?= $site_header_menu_card['url']; ?>">
                                                                    <div class="product-card__bg">
                                                                        <img src="<?= $site_header_menu_card['bg']; ?>" alt="<?= $site_header_menu_card['label']; ?>">
                                                                    </div>
                                                                    <div class="product-card__sub"><?= $site_header_menu_card['desc']; ?></div>
                                                                    <div class="product-card__title h7">
                                                                        <span><?= $site_header_menu_card['label']; ?></span>
                                                                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <rect width="56" height="56" rx="28" fill="#FBFAFD"/>
                                                                            <path d="M23 33L33 23M33 23H23M33 23V33" stroke="<?= $site_header_menu_card['color']; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        </svg>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if( $site_header_menu_li['type'] == '2' && $site_header_menu_li['items'] ): ?>
                                            <div class="header__menu-dropdown js-menu-item-dropdown">
                                                <div class="h-dropdown">
                                                    <button class="h-dropdown__back js-menu-item-back" type="button">
                                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-dropdown-back-icon.svg" alt="Back">
                                                        <span><?= $site_header_menu_li['label']; ?></span>
                                                    </button>
                                                    <div class="h-dropdown__list">
                                                        <?php foreach( $site_header_menu_li['items'] as $site_header_menu_item ): ?>
                                                            <a class="h-dropdown__item<?= $current_url === rtrim($site_header_menu_item['url'], '/') ? ' cur-page' : ''; ?>" href="<?= $site_header_menu_item['url']; ?>">
                                                                <?php if( $site_header_menu_item['icon'] ): ?>
                                                                    <div class="h-dropdown__item-icon js-svg-replace">
                                                                        <img src="<?= $site_header_menu_item['icon']; ?>" alt="<?= $site_header_menu_item['label']; ?>">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="h-dropdown__item-sub"><?= $site_header_menu_item['label']; ?></div>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="header__menu-bottom">
                            <div class="header__menu-soc-items">
                                <?php if( $site_soc_tg ): ?>
                                    <a class="header__menu-soc-item" href="<?= $site_soc_tg; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-menu-soc-item-1.svg" alt="Telegram">
                                    </a>
                                <?php endif; ?>
                                <?php if( $site_soc_yt ): ?>
                                    <a class="header__menu-soc-item" href="<?= $site_soc_yt; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-menu-soc-item-2.svg" alt="YouTube">
                                    </a>
                                <?php endif; ?>
                                <?php if( $site_soc_vk ): ?>
                                    <a class="header__menu-soc-item" href="<?= $site_soc_vk; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-menu-soc-item-3.svg" alt="VK">
                                    </a>
                                <?php endif; ?>
                                <?php if( $site_soc_habr ): ?>
                                    <a class="header__menu-soc-item" href="<?= $site_soc_habr; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-menu-soc-item-4.svg" alt="Habr">
                                    </a>
                                <?php endif; ?>
                                <?php if( $site_soc_rutube ): ?>
                                    <a class="header__menu-soc-item" href="<?= $site_soc_rutube; ?>" target="_blank">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/h-menu-soc-item-5.svg" alt="Rutube">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php if( $site_contacts_email || $site_contacts_phone ): ?>
                                <div class="header__menu-contacts">
                                    <?php if( $site_contacts_email ): ?>
                                        <a class="header__menu-contacts-item" href="mailto:<?= $site_contacts_email; ?>"><?= $site_contacts_email; ?></a>
                                    <?php endif; ?>
                                    <?php if( $site_contacts_phone ): ?>
                                        <a class="header__menu-contacts-item" href="<?= get_tel_href($site_contacts_phone); ?>"><?= $site_contacts_phone; ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </nav>
                <?php endif; ?>
                <?php if( $page_submenu ): ?>
                    <nav class="header-submenu js-svg-replace">
                        <ul>
                            <?php foreach( $page_submenu as $page_submenu_item ): ?>
                                <li class="<?= $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ? ' js-submenu-toggle' : ''; ?>">
                                    <?php if( $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ): ?>
                                        <span>
                                            <?php if( $page_submenu_item['icon'] ): ?>
                                                <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                            <?php endif; ?>
                                            <span><?= $page_submenu_item['label']; ?></span>
                                        </span>
                                    <?php elseif( $page_submenu_item['type'] == 'url' && $page_submenu_item['url'] ): ?>
                                        <a href="<?= $page_submenu_item['url']; ?>" target="_blank">
                                            <?php if( $page_submenu_item['icon'] ): ?>
                                                <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                            <?php endif; ?>
                                            <span><?= $page_submenu_item['label']; ?></span>
                                        </a>
                                    <?php elseif( $page_submenu_item['type'] == 'anchor' && $page_submenu_item['url'] ): ?>
                                        <a href="<?= $page_submenu_item['url']; ?>" class="js-anchor">
                                            <?php if( $page_submenu_item['icon'] ): ?>
                                                <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                            <?php endif; ?>
                                            <span><?= $page_submenu_item['label']; ?></span>
                                        </a>
                                    <?php elseif( $page_submenu_item['type'] == 'file' && $page_submenu_item['file'] ): ?>
                                        <a href="<?= $page_submenu_item['file']; ?>" target="_blank">
                                            <?php if( $page_submenu_item['icon'] ): ?>
                                                <img src="<?= $page_submenu_item['icon']; ?>" alt="<?= $page_submenu_item['label']; ?>">
                                            <?php endif; ?>
                                            <span><?= $page_submenu_item['label']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $page_submenu_item['type'] == 'dropdown' && $page_submenu_item['items'] ): ?>
                                        <div class="header-submenu__dropdown">
                                            <div class="header-submenu__dropdown-list<?= $page_submenu_item['is_lg'] ? ' header-submenu__dropdown-list--lg' : ''; ?>">
                                                <?php foreach( $page_submenu_item['items'] as $page_submenu_li ): ?>
                                                    <div class="header-submenu__dropdown-col">
                                                        <?php if( $page_submenu_li['type'] == 'url' && $page_submenu_li['url'] ): ?>
                                                            <a class="header-submenu__item" href="<?= $page_submenu_li['url']; ?>" target="_blank">
                                                        <?php elseif( $page_submenu_li['type'] == 'anchor' && $page_submenu_li['url'] ): ?>
                                                            <a class="header-submenu__item js-anchor" href="<?= $page_submenu_li['url']; ?>">
                                                        <?php elseif( $page_submenu_li['type'] == 'file' && $page_submenu_li['file'] ): ?>
                                                            <a class="header-submenu__item" href="<?= $page_submenu_li['file']; ?>" target="_blank">
                                                        <?php endif; ?>
                                                            <?php if( $page_submenu_li['icon'] ): ?>
                                                                <div class="header-submenu__item-img">
                                                                    <img src="<?= $page_submenu_li['icon']; ?>" alt="<?= $page_submenu_li['label']; ?>">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="header-submenu__item-content">
                                                                <?php if( $page_submenu_li['label'] ): ?>
                                                                    <div class="header-submenu__item-sub"><?= $page_submenu_li['label']; ?></div>
                                                                <?php endif; ?>
                                                                <?php if( $page_submenu_li['desc'] ): ?>
                                                                    <div class="header-submenu__item-desc"><?= $page_submenu_li['desc']; ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="header-submenu__item-icon">
                                                                <?php if( $page_submenu_li['type'] == 'file' ): ?>
                                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/header-submenu-download-icon.svg" alt="Download">
                                                                <?php else: ?>
                                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/header-submenu-link-icon.svg" alt="Link">
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="body-bg js-body-bg"></div>
    <main class="main<?= !is_front_page() ? ' post' : ''; ?>">