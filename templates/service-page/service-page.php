<?php
get_header();
?>

<?php
$service_get_field = static function ($field_name) {
    return get_field($field_name);
};

$service_get_banner_min_field = $service_get_field;
$service_get_banner_min_after_news_field = $service_get_field;
$service_get_callout_field = $service_get_field;

$service_section_is_visible = static function ($field_name) {
    $post_id = get_the_ID();

    if (!$post_id || !metadata_exists('post', $post_id, $field_name)) {
        return true;
    }

    return (bool) get_field($field_name, $post_id);
};

$service_visible_sections = [];

foreach ([
    'service_hero',
    'service_products',
    'service_banner_min',
    'service_callout',
    'service_why',
    'service_tech',
    'service_demo',
    'service_faq',
    'service_news',
    'service_banner_min_after_news',
] as $service_section_prefix) {
    $service_visible_sections[$service_section_prefix] = $service_section_is_visible($service_section_prefix . '_show');
}

if (defined('WP_DEBUG') && WP_DEBUG && isset($_GET['debug_service_sections'])) {
    error_log('[FIX:service-sections] Visibility: ' . wp_json_encode($service_visible_sections));
}

$service_hero_video = $service_get_field('service_hero_video');
$service_hero_image = $service_get_field('service_hero_image');
$service_hero_title = $service_get_field('service_hero_title');
$service_hero_desc = $service_get_field('service_hero_desc');
$service_hero_btn = $service_get_field('service_hero_btn');
$service_hero_awards = $service_get_field('service_hero_awards');

if ($service_visible_sections['service_hero'] && $service_hero_title):
    ?>
    <section class="service-page-hero">
        <div class="container">
            <div class="service-page-hero__wrap" data-hero-video
                 data-path="<?= get_template_directory_uri(); ?>/assets/hero-video-frames">
                <div class="service-page-hero__img" data-aos="zoom-in">
                    <div class="service-page-hero__video">
                        <?php if ($service_hero_image): ?>
                            <img src="<?= esc_url($service_hero_image); ?>" alt="<?= esc_attr(wp_strip_all_tags($service_hero_title)); ?>">
                        <?php elseif ($service_hero_video): ?>
                            <video autoplay muted loop playsinline src="<?= esc_url($service_hero_video); ?>" id="hero-video-canvas">
                            </video>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="service-page-hero__content">
                    <div class="service-page-hero__top" data-aos="fade-up">
                        <h1 class="service-page-hero__title"><?= $service_hero_title; ?></h1>
                        <?php if ($service_hero_desc): ?>
                            <div class="service-page-hero__desc"><?= $service_hero_desc; ?></div>
                        <?php endif; ?>
                        <?php if ($service_hero_btn): ?>
                            <div class="service-page-hero__btn">
                                <a class="btn" href="#demo-popup" data-fancybox=""
                                   data-touch="false"><?= $service_hero_btn; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($service_hero_awards): ?>
                        <div class="service-page-hero__bottom" data-aos="fade" data-aos-delay="200">
                            <div class="service-page-hero__row">
                                <?php $counter = 1;
                                foreach ($service_hero_awards as $service_hero_award): if ($service_hero_award['icon'] || $service_hero_award['desc']): ?>
                                    <div class="service-page-hero__col">
                                        <div class="service-page-hero__item">
                                            <?php if ($service_hero_award['icon']): ?>
                                                <div class="service-page-hero__item-icon"><?= get_retina_img($service_hero_award['icon'], 'Hero Award Icon -' . $counter); ?></div>
                                            <?php endif; ?>
                                            <?php if ($service_hero_award['desc']): ?>
                                                <div class="service-page-hero__item-sub"><?= $service_hero_award['desc']; ?></div>
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
if ($service_visible_sections['service_banner_min']):
    $service_banner_min_fields = [
        'banner-min-title' => $service_get_banner_min_field('banner-min-title'),
        'banner-min-text' => $service_get_banner_min_field('banner-min-text'),
        'banner-min-background' => $service_get_banner_min_field('banner-min-background'),
        'banner-min-link' => $service_get_banner_min_field('banner-min-link'),
        'banner-min-anim-enabled' => $service_get_banner_min_field('banner-min-anim-enabled'),
        'banner-min-anim-delay' => $service_get_banner_min_field('banner-min-anim-delay'),
    ];

    get_template_part('functions/blocks/banner-min/template', null, [
        'fields' => $service_banner_min_fields,
    ]);
endif;
?>

<?php
$service_callout_title = $service_get_callout_field('service_callout_title');
$service_callout_text = $service_get_callout_field('service_callout_text');
$service_callout_btn_label = $service_get_callout_field('service_callout_btn_label');
$service_callout_btn_url = $service_get_callout_field('service_callout_btn_url');
$service_callout_anim_enabled = $service_get_callout_field('service_callout_anim_enabled');
$service_callout_anim_delay = absint($service_get_callout_field('service_callout_anim_delay'));
$service_callout_has_button = $service_callout_btn_label && $service_callout_btn_url;
$service_callout_has_content = $service_callout_title || $service_callout_text || $service_callout_has_button;
$service_callout_btn_is_popup = $service_callout_btn_url && 0 === strpos($service_callout_btn_url, '#');

if ($service_visible_sections['service_callout'] && $service_callout_has_content):
    ?>
    <section class="service-page-callout section">
        <div class="container">
            <div class="service-page-callout__wrap"<?= $service_callout_anim_enabled ? ' data-aos="fade-up"' : ''; ?><?= $service_callout_anim_enabled && $service_callout_anim_delay ? ' data-aos-delay="' . esc_attr($service_callout_anim_delay) . '"' : ''; ?>>
                <?php if ($service_callout_title || $service_callout_text || $service_callout_has_button): ?>
                    <div class="service-page-callout__content">
                        <?php if ($service_callout_title): ?>
                            <h2 class="service-page-callout__title"><?= wp_kses_post($service_callout_title); ?></h2>
                        <?php endif; ?>
                        <?php if ($service_callout_text): ?>
                            <div class="service-page-callout__text"><?= wp_kses_post($service_callout_text); ?></div>
                        <?php endif; ?>
                        <?php if ($service_callout_has_button): ?>
                            <div class="service-page-callout__btn">
                                <a class="btn" href="<?= esc_url($service_callout_btn_url); ?>"<?= $service_callout_btn_is_popup ? ' data-fancybox="" data-touch="false"' : ''; ?>><?= esc_html($service_callout_btn_label); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php
$service_products_title = $service_get_field('service_products_title');
$service_products_desc = $service_get_field('service_products_desc');
$service_products_items = $service_get_field('service_products_items');

if ($service_visible_sections['service_products'] && $service_products_title && $service_products_items):
    ?>
    <section class="service-page-products section">
        <div class="container">
            <div class="service-page-products__header row-lg">
                <h2 class="service-page-products__title col-lg" data-aos="fade-up"
                    data-aos-delay="150"><?= wp_kses_post($service_products_title); ?></h2>
                <?php if ($service_products_desc): ?>
                    <div class="service-page-products__desc col-lg" data-aos="fade-up">
                        <div class="service-page-products__desc-item"><b><?= wp_kses_post($service_products_desc); ?></b></div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="service-page-products__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 0;
                    foreach ($service_products_items as $service_products_item): ?>
                        <div class="service-page-products__slide swiper-slide" data-aos="fade-up"
                             data-aos-delay="<?= esc_attr($counter * 200); ?>">
                            <a class="product-card" href="<?= esc_url($service_products_item['url']); ?>">
                                <div class="product-card__bg">
                                    <img src="<?= esc_url($service_products_item['bg']); ?>"
                                         alt="<?= esc_attr($service_products_item['label']); ?>">
                                </div>
                                <div class="product-card__sub h5"><?= wp_kses_post($service_products_item['desc']); ?></div>
                                <h3 class="product-card__title">
                                    <span><?= esc_html($service_products_item['label']); ?></span>
                                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect width="56" height="56" rx="28" fill="#FBFAFD"/>
                                        <path d="M23 33L33 23M33 23H23M33 23V33"
                                              stroke="<?= esc_attr($service_products_item['color']); ?>" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </h3>
                            </a>
                        </div>
                        <?php $counter++; endforeach; ?>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_tech_title = $service_get_field('service_tech_title');
$service_tech_items = $service_get_field('service_tech_items');

if ($service_visible_sections['service_tech'] && $service_tech_title && $service_tech_items):
    ?>
    <section class="service-page-technologies section">
        <div class="service-page-bg-path service-page-bg-path--3">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-3.svg" alt="#">
        </div>
        <div class="service-page-bg-path service-page-bg-path--4">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-4.svg" alt="#">
        </div>
        <div class="container">
            <h2 class="service-page-technologies__title" data-aos="fade-up"><?= $service_tech_title; ?></h2>
            <div class="service-page-technologies__wrap row-lg">
                <div class="service-page-technologies__left col-lg" data-aos="fade-up">
                    <div class="service-page-technologies__tabs js-h-technologies-tabs">
                        <?php $counter = 1;
                        foreach ($service_tech_items as $service_tech_item): ?>
                            <div class="service-page-technologies__tab js-h-technologies-tab"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                                <div class="service-page-technologies__tab-item">
                                    <div class="service-page-technologies__tab-toggle h5 js-h-technologies-toggle">
                                        <span><?= $service_tech_item['title']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/home-technologies-dropdown-arrow.svg"
                                             alt="#">
                                    </div>
                                    <div class="service-page-technologies__tab-dropdown js-h-technologies-dropdown">
                                        <div class="service-page-technologies__tab-content">
                                            <div class="service-page-technologies__tab-desc"><?= $service_tech_item['desc']; ?></div>
                                            <div class="service-page-technologies__tab-bottom">
                                                <?php if ($service_tech_item['hint'] || $service_tech_item['value']): ?>
                                                    <div class="service-page-technologies__tab-hint">
                                                        <?php if ($service_tech_item['hint']): ?>
                                                            <span><?= $service_tech_item['hint']; ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($service_tech_item['value']): ?>
                                                            <b><?= $service_tech_item['value']; ?></b>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($service_tech_item['url']): ?>
                                                    <a class="service-page-technologies__tab-btn"
                                                       href="<?= $service_tech_item['url']; ?>" target="_blank">
                                                        <span>Подробнее</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#946AD2"
                                                                  stroke-width="2" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
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
                    <div class="service-page-technologies__more">
                        <button class="service-page-technologies__more-btn js-h-technologies-more" type="button">
                            <span>Показать полный список</span>
                            <span>Скрыть полный список</span>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/technologies-more-icon.svg"
                                 alt="Arrow">
                        </button>
                    </div>
                </div>
                <div class="service-page-technologies__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-technologies__row">
                        <?php $counter = 1;
                        foreach ($service_tech_items as $service_tech_item): ?>
                            <div class="service-page-technologies__col">
                                <div class="service-page-technologies__item">
                                    <button class="service-page-technologies__item-tab-btn h7 js-h-technologies-tab-btn<?= $counter == 1 ? ' active' : ''; ?>"
                                            type="button"><?= $service_tech_item['title']; ?></button>
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
$service_demo_title = $service_get_field('service_demo_title');
$service_demo_desc_yt = $service_get_field('service_demo_desc_yt');
$service_demo_desc_rutube = $service_get_field('service_demo_desc_rutube');
$service_demo_desc_tg = $service_get_field('service_demo_desc_tg');
$service_demo_desc_habr = $service_get_field('service_demo_desc_habr');

$service_demo_fallback_socials = array_filter([
        [
                'url' => $site_soc_yt,
                'text' => $service_demo_desc_yt,
        ],
        [
                'url' => $site_soc_rutube,
                'text' => $service_demo_desc_rutube,
        ],
        [
                'url' => $site_soc_tg,
                'text' => $service_demo_desc_tg,
        ],
        [
                'url' => $site_soc_habr,
                'text' => $service_demo_desc_habr,
        ],
], static function ($social) {
    return !empty($social['url']) && !empty($social['text']);
});

$service_demo_social_rows = $service_get_field('service_demo_socials');
$service_demo_socials = [];

if (is_array($service_demo_social_rows)) {
    foreach ($service_demo_social_rows as $service_demo_social_row) {
        $service_demo_social_url = isset($service_demo_social_row['url']) ? trim($service_demo_social_row['url']) : '';
        $service_demo_social_text = isset($service_demo_social_row['text']) ? trim($service_demo_social_row['text']) : '';

        if (!$service_demo_social_url || !$service_demo_social_text) {
            continue;
        }

        $service_demo_social_icon = $service_demo_social_row['icon'] ?? 0;
        $service_demo_social_icon_id = is_array($service_demo_social_icon)
                ? absint($service_demo_social_icon['ID'] ?? $service_demo_social_icon['id'] ?? 0)
                : absint($service_demo_social_icon);

        $service_demo_social_bg = $service_demo_social_row['bg'] ?? 0;
        $service_demo_social_bg_id = is_array($service_demo_social_bg)
                ? absint($service_demo_social_bg['ID'] ?? $service_demo_social_bg['id'] ?? 0)
                : absint($service_demo_social_bg);

        $service_demo_socials[] = [
                'url' => $service_demo_social_url,
                'text' => $service_demo_social_text,
                'icon_id' => $service_demo_social_icon_id,
                'bg_id' => $service_demo_social_bg_id,
        ];
    }
} elseif (!empty($service_demo_social_rows) && defined('WP_DEBUG') && WP_DEBUG) {
    error_log('[service-page.demo.socials] Expected service_demo_socials to be an array.');
}

$service_demo_has_managed_socials = !empty($service_demo_socials);
$service_demo_has_socials = $service_demo_has_managed_socials || !empty($service_demo_fallback_socials);
if ($service_visible_sections['service_demo']):
    ?>
    <section class="service-page-demo section">
        <div class="service-page-bg-path service-page-bg-path--6">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-6.svg" alt="#">
        </div>
        <div class="container">
            <div class="service-page-demo__row row-lg">
                <div class="service-page-demo__left col-lg<?= !$service_demo_has_socials ? ' service-page-demo__left--wide' : ''; ?>" data-aos="fade-up">
                    <form class="service-page-demo__form ajax-wrap js-form">
                        <?php if (!empty($service_demo_title)): ?>
                            <h2 class="service-page-demo__form-sub"><?= $service_demo_title; ?></h2>
                        <?php endif; ?>
                        <div class="service-page-demo__form-row ajax-wrap__item">
                            <?php if ($form_product_options): ?>
                                <div class="service-page-demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select js-feedback-input"
                                                name="product"><?= $form_product_options; ?></select>
                                        <span class="js-select-toggle">Выберите продукт</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($form_partner_options): ?>
                                <div class="service-page-demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select js-feedback-input js-partner-select"
                                                name="partner"><?= $form_partner_options; ?></select>
                                        <span class="js-select-toggle">Выберите дистрибьютора</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="name">
                                        <span>Имя и фамилия</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="company">
                                        <span>Организация</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-tel-input js-feedback-input" type="text"
                                               name="phone">
                                        <span>Номер телефона</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="email">
                                        <span>E-mail</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col service-page-demo__form-col--lg">
                                <div class="main-input">
                                    <label>
                                        <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                        <span>Комментарий</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="service-page-demo__form-bottom ajax-wrap__item">
                            <?php if ($site_forms_agree): ?>
                                <div class="service-page-demo__form-agree"><?= $site_forms_agree; ?></div>
                            <?php endif; ?>
                            <div class="service-page-demo__form-btn">
                                <button class="btn btn-white" type="submit">Отправить</button>
                            </div>
                            <input type="hidden" name="form_name" value="Заявка на демо-версию">
                            <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                        </div>
                        <div class="service-page-demo__form-mob-btn">
                            <a class="btn btn-white" href="#demo-popup" data-fancybox=""
                               data-touch="false">Продолжить</a>
                        </div>
                    </form>
                </div>
                <?php if ($service_demo_has_socials): ?>
                    <div class="service-page-demo__right col-lg" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-page-demo__soc">
                            <?php if ($service_demo_has_managed_socials): ?>
                                <?php foreach ($service_demo_socials as $service_demo_social): ?>
                                    <div class="service-page-demo__soc-col">
                                        <a class="service-page-demo__soc-item" href="<?= esc_url($service_demo_social['url']); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php if ($service_demo_social['icon_id']): ?>
                                                <?php
                                                $service_demo_social_icon = wp_get_attachment_image($service_demo_social['icon_id'], 'full', false, [
                                                        'alt' => $service_demo_social['text'],
                                                        'class' => 'service-page-demo__soc-icon'
                                                ]);

                                                if ($service_demo_social_icon) {
                                                    echo $service_demo_social_icon;
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <span>
                                            <?php if ($service_demo_social['bg_id']): ?>
                                                <?php
                                                $service_demo_social_bg = wp_get_attachment_image($service_demo_social['bg_id'], 'full', false, [
                                                        'alt' => $service_demo_social['text'],
                                                ]);

                                                if ($service_demo_social_bg) {
                                                    echo $service_demo_social_bg;
                                                } elseif (defined('WP_DEBUG') && WP_DEBUG) {
                                                    error_log('[service-page.demo.socials] Invalid social background attachment ID.');
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <span><?= esc_html($service_demo_social['text']); ?></span>
                                            <i>
                                                <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/soc-arrow.svg'); ?>"
                                                     alt="">
                                            </i>
                                        </span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php if ($site_soc_yt && $service_demo_desc_yt): ?>
                                    <div class="service-page-demo__soc-col">
                                        <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_yt); ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="74" height="48" viewBox="0 0 74 48"
                                                 fill="none">
                                                <path d="M38.4545 47.9806L24.1265 47.7199C19.4873 47.6292 14.8367 47.8105 10.2887 46.8697C3.36981 45.4642 2.87967 38.5725 2.36674 32.7917C1.66003 24.6645 1.9336 16.39 3.26722 8.3308C4.01953 3.80814 6.98315 1.11042 11.5654 0.815707C27.0332 -0.249781 42.6036 -0.125096 58.0372 0.373643C59.6672 0.418983 61.3086 0.668352 62.9157 0.951727C70.8491 2.33459 71.0429 10.1444 71.5558 16.7187C72.0688 23.361 71.8522 30.0373 70.8719 36.6343C70.0854 42.0977 68.5808 46.677 62.2318 47.1191C54.2757 47.6972 46.5019 48.1619 38.5229 48.0146C38.5229 47.9806 38.4773 47.9806 38.4545 47.9806ZM30.031 34.1519C36.0266 30.7287 41.9082 27.3622 47.8697 23.9617C41.8627 20.5386 35.9924 17.1721 30.031 13.7716V34.1519Z"
                                                      fill="#D9D7DA"/>
                                            </svg>
                                            <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-1.svg"
                                             alt="Youtube">
                                        <span><?= esc_html($service_demo_desc_yt); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Youtube">
                                        </i>
                                    </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($site_soc_rutube && $service_demo_desc_rutube): ?>
                                    <div class="service-page-demo__soc-col">
                                        <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_rutube); ?>" target="_blank" rel="noopener noreferrer">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z"
                                                      fill="#D9D7DA"/>
                                                <path d="M29.2848 15.9023H12.3242V35.1424H17.0449V28.8829H26.0906L30.2174 35.1424H35.5035L30.9524 28.854C32.3657 28.6232 33.3834 28.075 34.0053 27.2097C34.6272 26.3444 34.9381 24.9598 34.9381 23.1136V21.6714C34.9381 20.5752 34.825 19.7099 34.6272 19.0464C34.4292 18.383 34.0901 17.806 33.6095 17.2869C33.1006 16.7965 32.5354 16.4503 31.857 16.2196C31.1786 16.0177 30.3308 15.9023 29.2848 15.9023ZM28.5216 24.6424H17.0447V20.1426H28.5218C29.172 20.1426 29.6241 20.258 29.8504 20.4598C30.0761 20.6617 30.2174 21.0368 30.2174 21.5849V23.2002C30.2174 23.7771 30.0761 24.1522 29.85 24.354C29.624 24.5559 29.1716 24.6424 28.5216 24.6424Z"
                                                      fill="white"/>
                                                <path d="M38.1605 17.5988C39.9848 17.5988 41.4637 16.0897 41.4637 14.2281C41.4637 12.3665 39.9848 10.8574 38.1605 10.8574C36.3363 10.8574 34.8574 12.3665 34.8574 14.2281C34.8574 16.0897 36.3363 17.5988 38.1605 17.5988Z"
                                                      fill="white"/>
                                            </svg>
                                            <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-2.svg"
                                             alt="Rutube">
                                        <span><?= esc_html($service_demo_desc_rutube); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Rutube">
                                        </i>
                                    </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($site_soc_tg && $service_demo_desc_tg): ?>
                                    <div class="service-page-demo__soc-col">
                                        <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_tg); ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                                 fill="none">
                                                <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z"
                                                      fill="#D9D7DA"/>
                                                <path d="M16.2344 25.7557L19.0818 33.6369C19.0818 33.6369 19.4378 34.3743 19.819 34.3743C20.2002 34.3743 25.87 28.4759 25.87 28.4759L32.175 16.2979L16.336 23.7213L16.2344 25.7557Z"
                                                      fill="#D9D7DA"/>
                                                <path d="M20.0171 27.7764L19.4705 33.5856C19.4705 33.5856 19.2417 35.3656 21.0213 33.5856C22.8009 31.8056 24.5043 30.433 24.5043 30.433"
                                                      fill="white"/>
                                                <path d="M16.2984 26.0356L10.4412 24.1272C10.4412 24.1272 9.74119 23.8432 9.96659 23.1992C10.013 23.0664 10.1066 22.9534 10.3866 22.7592C11.6844 21.8546 34.4078 13.6872 34.4078 13.6872C34.4078 13.6872 35.0494 13.471 35.4278 13.6148C35.5214 13.6438 35.6056 13.6971 35.6719 13.7693C35.7381 13.8415 35.784 13.93 35.8048 14.0258C35.8457 14.1949 35.8628 14.3689 35.8556 14.5428C35.8538 14.6932 35.8356 14.8326 35.8218 15.0512C35.6834 17.2842 31.5418 33.9498 31.5418 33.9498C31.5418 33.9498 31.294 34.925 30.4062 34.9584C30.188 34.9654 29.9707 34.9285 29.7671 34.8497C29.5635 34.771 29.3778 34.652 29.2212 34.5C27.479 33.0014 21.4574 28.9546 20.1268 28.0646C20.0968 28.0441 20.0715 28.0175 20.0527 27.9864C20.0338 27.9554 20.0219 27.9206 20.0176 27.8846C19.999 27.7908 20.101 27.6746 20.101 27.6746C20.101 27.6746 30.5862 18.3546 30.8652 17.3762C30.8868 17.3004 30.8052 17.263 30.6956 17.2962C29.9992 17.5524 17.9268 25.1762 16.5944 26.0176C16.4985 26.0466 16.3971 26.0528 16.2984 26.0356Z"
                                                      fill="white"/>
                                            </svg>
                                            <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-3.svg"
                                             alt="Telegram">
                                        <span><?= esc_html($service_demo_desc_tg); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Telegram">
                                        </i>
                                    </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($site_soc_habr && $service_demo_desc_habr): ?>
                                    <div class="service-page-demo__soc-col">
                                        <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_habr); ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="136" height="48" viewBox="0 0 136 48"
                                                 fill="none">
                                                <path d="M0 0C3.35453 0.00388381 6.70906 0 10.0598 0.00388381C10.0445 6.14419 10.1018 12.2845 10.033 18.4287C11.5842 16.347 13.8728 14.84 16.4097 14.374C20.0775 13.7759 24.2038 14.4866 26.8859 17.283C29.2967 19.5861 30.187 23.0465 30.2252 26.3128C30.2443 33.2415 30.229 40.1664 30.2328 47.0951C26.8783 47.099 23.5237 47.099 20.1692 47.0951C20.1692 41.4519 20.1692 35.8087 20.1692 30.1694C20.131 28.4373 19.9323 26.4992 18.6677 25.2137C16.7039 23.1048 12.9367 23.4349 11.2136 25.6953C10.2852 26.9808 10.0521 28.6237 10.0636 30.1811V47.0951C6.70906 47.099 3.35453 47.0951 0.00382065 47.099C0 31.4006 0 15.6984 0 0ZM75.6527 0C78.9996 0 82.3465 0 85.6972 0.00388381C85.6972 6.05097 85.7163 12.0981 85.6819 18.1452C87.3974 16.1372 89.7662 14.607 92.4062 14.3235C96.6624 13.6516 101.136 15.1896 104.151 18.3044C110.826 25.2797 110.661 37.9176 103.475 44.4619C100.273 47.5106 95.5697 48.5593 91.3288 47.6582C88.9333 47.1067 86.8204 45.6309 85.2922 43.6967C85.3151 44.8308 85.3113 45.961 85.3113 47.0951C82.0905 47.099 78.8697 47.0951 75.6527 47.099C75.645 31.4006 75.645 15.7022 75.6527 0ZM90.2858 24.4059C87.1452 25.2176 84.7993 28.4761 85.2769 31.7929C85.5023 35.2262 88.6735 38.0808 92.0624 37.8555C95.9633 38.0225 99.3102 34.0882 98.6377 30.1889C98.29 26.2274 94.0338 23.299 90.2858 24.4059ZM37.8474 21.2833C40.3384 16.9956 45.1066 14.071 50.0543 14.1914C53.5388 14.0011 56.8627 15.7916 59.0634 18.4675C59.0558 17.3296 59.0558 16.1916 59.0634 15.0536H68.722C68.722 25.738 68.7297 36.4185 68.7144 47.099C65.4974 47.0951 62.2804 47.099 59.0634 47.0951C59.0596 45.9377 59.0558 44.7803 59.0787 43.6268C57.4167 45.5726 55.2542 47.2388 52.6944 47.6582C47.4716 48.9515 41.8208 46.4659 38.7032 42.1238C34.4775 36.1427 34.2216 27.6178 37.8512 21.2833H37.8474ZM50.1881 24.5457C47.5098 25.4156 45.4734 28.111 45.5536 31.0006C45.4543 34.1659 47.781 37.1914 50.8643 37.7467C55.0212 38.8459 59.4952 35.0087 59.0099 30.6316C58.903 26.3283 54.1615 23.0116 50.1881 24.5457ZM123.953 18.7122C125.478 16.4402 127.862 14.5526 130.628 14.2924C132.298 14.0672 133.998 14.1604 135.637 14.5565C135.687 17.9976 135.637 21.4386 135.224 24.8603C133.108 24.2544 130.903 23.7767 128.699 24.0602C126.322 24.3437 124.362 26.6313 124.377 29.0548C124.412 35.0708 124.393 41.0829 124.393 47.099C121.034 47.099 117.676 47.0912 114.321 47.099C114.299 36.4146 114.321 25.7341 114.31 15.0498H123.969C123.969 16.2693 123.976 17.4888 123.953 18.7083V18.7122Z"
                                                      fill="#D9D7DA"/>
                                            </svg>
                                            <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-4.svg"
                                             alt="Habr">
                                        <span><?= esc_html($service_demo_desc_habr); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Habr">
                                        </i>
                                    </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_why_title = $service_get_field('service_why_title');
$service_why_items = $service_get_field('service_why_items');

if ($service_visible_sections['service_why'] && $service_why_title && $service_why_items):
    ?>
    <section class="service-page-why section">
        <div class="container">
            <h2 class="service-page-why__title" data-aos="fade-up"><?= $service_why_title; ?></h2>
            <div class="service-page-why__row row">
                <?php $counter = 1;
                foreach ($service_why_items as $service_why_item): ?>
                    <div class="service-page-why__col col"
                         data-aos="fade-up"<?= $counter % 2 ? '' : ' data-aos-delay="200"'; ?>>
                        <div class="service-page-why__item">
                            <div class="service-page-why__item-bg">
                                <img src="<?= kama_thumb_src('wh=1184:720', $service_why_item['img']); ?>"
                                     alt="<?= $service_why_title; ?> - BG <?= $counter; ?>">
                            </div>
                            <div class="service-page-why__item-content">
                                <h3 class="service-page-why__item-sub"><?= $service_why_item['title']; ?></h3>
                                <?php if ($service_why_item['desc']): ?>
                                    <div class="service-page-why__item-desc"><?= $service_why_item['desc']; ?></div>
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
$service_faq_title = $service_get_field('service_faq_title');
$service_faq_bg = $service_get_field('service_faq_bg');
$service_faq_items = $service_get_field('service_faq_items');

if ($service_visible_sections['service_faq'] && $service_faq_items):
    ?>
    <section class="service-page-faq section">
        <div class="container">
            <div class="service-page-faq__wrap">
                <?php if ($service_faq_title && $service_faq_bg): ?>
                    <div class="service-page-faq__left" data-aos="fade-up">
                        <div class="service-page-faq__block">
                            <div class="service-page-faq__block-bg">
                                <img src="<?= $service_faq_bg; ?>" alt="FAQ">
                            </div>
                            <h2 class="service-page-faq__block-title h3"><?= $service_faq_title; ?></h2>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="service-page-faq__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-faq__list">
                        <?php foreach ($service_faq_items as $service_faq_item): ?>
                            <div class="service-page-faq__col">
                                <div class="service-page-faq__item">
                                    <div class="service-page-faq__toggle h7 js-faq-toggle">
                                        <span><?= $service_faq_item['question']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/faq-arrow.svg"
                                             alt="Arrow">
                                    </div>
                                    <div class="service-page-faq__dropdown js-faq-dropdown">
                                        <div class="service-page-faq__content"><?= $service_faq_item['answer']; ?></div>
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
$service_news_title = $service_get_field('service_news_title');
$service_news_btn_label = $service_get_field('service_news_btn_label');
$service_news_btn_url = $service_get_field('service_news_btn_url');

$news_arr = [];
if ($service_visible_sections['service_news']) {
    $news_term_ids = space_get_blog_category_term_ids( SPACE_BLOG_CATEGORY_SECTION_NEWS );
    $args = array(
            'post_type' => 'blog',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                    array(
                            'taxonomy' => 'blog_category',
                            'field' => 'term_id',
                            'terms' => $news_term_ids ?: [0]
                    )
            )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $news_arr[] = get_the_ID();
        }
        wp_reset_postdata();
    }
}

if ($service_visible_sections['service_news'] && $news_arr && count($news_arr) == 4):
    ?>
    <section class="service-page-news section">
        <div class="service-page-bg-path service-page-bg-path--7">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-7.svg" alt="#">
        </div>
        <div class="container">
            <?php if ($service_news_title): ?>
                <h2 class="service-page-news__title" data-aos="fade-up"><?= $service_news_title; ?></h2>
            <?php endif; ?>
            <div class="service-page-news__row row-lg">
                <div class="service-page-news__left col-lg" data-aos="fade-up">
                    <?php get_template_part('templates/parts/news-card-lg', null, ['card_id' => $news_arr[0]]); ?>
                </div>
                <div class="service-page-news__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-news__list">
                        <?php foreach ($news_arr as $news_item): ?>
                            <div class="service-page-news__col">
                                <?php get_template_part('templates/parts/news-card-small', null, ['card_id' => $news_item]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if ($service_news_btn_label && $service_news_btn_url): ?>
                <div class="service-page-news__btn">
                    <a class="btn" href="<?= $service_news_btn_url; ?>"><?= $service_news_btn_label; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
if ($service_visible_sections['service_banner_min_after_news']):
    $service_banner_min_after_news_fields = [
        'banner-min-title' => $service_get_banner_min_after_news_field('service_banner_min_after_news_title'),
        'banner-min-text' => $service_get_banner_min_after_news_field('service_banner_min_after_news_text'),
        'banner-min-background' => $service_get_banner_min_after_news_field('service_banner_min_after_news_background'),
        'banner-min-link' => $service_get_banner_min_after_news_field('service_banner_min_after_news_link'),
        'banner-min-anim-enabled' => $service_get_banner_min_after_news_field('service_banner_min_after_news_anim_enabled'),
        'banner-min-anim-delay' => $service_get_banner_min_after_news_field('service_banner_min_after_news_anim_delay'),
    ];

    get_template_part('functions/blocks/banner-min/template', null, [
        'fields' => $service_banner_min_after_news_fields,
    ]);
endif;
?>

<?php get_footer(); ?>
