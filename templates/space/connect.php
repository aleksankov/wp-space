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
    $connect_hero_title = get_field('connect_hero_title');
    $connect_hero_desc = get_field('connect_hero_desc');
    $connect_hero_btn_label = get_field('connect_hero_btn_label');
    $connect_hero_img = get_field('connect_hero_img');

    if( $connect_hero_title ):
?>
    <section class="connect-hero" data-aos="fade-up">
        <div class="container">
            <div class="connect-hero__wrap">
                <div class="connect-hero__img">
                    <img src="<?= kama_thumb_src( 'wh=882:826', $connect_hero_img ); ?>" alt="<?php the_title(); ?>">
                </div>
                <div class="connect-hero__content">
                    <h1 class="connect-hero__title"><?= $connect_hero_title; ?></h1>
                    <?php if( $connect_hero_desc ): ?>
                        <div class="connect-hero__desc"><?= $connect_hero_desc; ?></div>
                    <?php endif; ?>
                    <?php if( $connect_hero_btn_label ): ?>
                        <div class="connect-hero__btn">
                            <a class="btn" href="#tech-partner-popup" data-fancybox="" data-touch="false"><?= $connect_hero_btn_label; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $connect_matrix_title = get_field('connect_matrix_title');

    $filter_products = [];
    $filter_types = [];
    $filter_vendors = [];

    $selected_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
    $selected_product = isset($_GET['product']) ? sanitize_text_field($_GET['product']) : '';
    $selected_version = isset($_GET['version']) ? sanitize_text_field($_GET['version']) : '';
    $selected_vendor = isset($_GET['vendor']) ? sanitize_text_field($_GET['vendor']) : '';

    $all_args = array(
        'post_type' => 'matrix',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $all_query = new WP_Query( $all_args );

    while( $all_query->have_posts() ){
        $all_query->the_post();

        $filter_product = get_field('matrix_product');
        $filter_product_version = get_field('matrix_product_version');
        
        if( $filter_product && $filter_product_version ){
            $filter_product_version = modifyProductVersion($filter_product_version);

            $filter_products[$filter_product][] = $filter_product_version;

            $filter_products[$filter_product] = array_unique($filter_products[$filter_product]);
        }
    }

    wp_reset_postdata();

    $filter_products_arr = array();

    if( $filter_products ){
        foreach( $filter_products as $key => &$versions ){
            usort($versions, function ($a, $b) {
                $versionA = extractVersion($a);
                $versionB = extractVersion($b);
                return version_compare($versionB, $versionA);
            });
        }
        unset($versions);

        $desiredOrder = array('SpaceVM', 'Space VDI', 'Space Client');

        foreach( $desiredOrder as $key ){
            if( isset($filter_products[$key]) ){
                $filter_products_arr[$key] = $filter_products[$key];
            }
        }
    }

    if( empty($selected_product) ){
        $selected_product = array_key_first($filter_products_arr);
    }
    
    if( empty($selected_version) && !empty($filter_products_arr[$selected_product]) ){
        $selected_version = $filter_products_arr[$selected_product][0];
    }

    $args = array(
        'post_type' => 'matrix',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    if( $selected_product ){
        $args['meta_query'][] = array(
            'key' => 'matrix_product',
            'value' => $selected_product,
            'compare' => '='
        );
    }

    if( $selected_version ){
        $parts = explode('.', $selected_version);

        if (isset($parts[2]) && $parts[2] == 'X') {
            $args['meta_query'][] = array(
                'key' => 'matrix_product_version',
                'value' => '^' . $parts[0] . '.' . $parts[1],
                'compare' => 'REGEXP'
            );
        } else {
            $args['meta_query'][] = array(
                'key' => 'matrix_product_version',
                'value' => $selected_version,
                'compare' => '='
            );
        }
    }

    $query = new WP_Query( $args );

    if( $selected_type && !$selected_vendor ){
        while( $query->have_posts() ){
            $query->the_post();
    
            $filter_type = get_field('matrix_type');
            
            if( $filter_type ){
                $filter_types[] = $filter_type;
            }
        }
        wp_reset_postdata();

        $args['meta_query'][] = array(
            'key' => 'matrix_type',
            'value' => $selected_type,
            'compare' => '='
        );

        $query = new WP_Query( $args );

        while( $query->have_posts() ){
            $query->the_post();
    
            $filter_vendor = get_field('matrix_vendor');
            
            if( $filter_vendor ){
                $filter_vendors[] = $filter_vendor;
            }
        }
        wp_reset_postdata();
    }elseif( $selected_vendor && !$selected_type ){
        while( $query->have_posts() ){
            $query->the_post();
    
            $filter_vendor = get_field('matrix_vendor');
            
            if( $filter_vendor ){
                $filter_vendors[] = $filter_vendor;
            }
        }
        wp_reset_postdata();
        
        $args['meta_query'][] = array(
            'key' => 'matrix_vendor',
            'value' => $selected_vendor,
            'compare' => '='
        );

        $query = new WP_Query( $args );

        while( $query->have_posts() ){
            $query->the_post();
    
            $filter_type = get_field('matrix_type');
            
            if( $filter_type ){
                $filter_types[] = $filter_type;
            }
        }
        wp_reset_postdata();
    }else{
        while( $query->have_posts() ){
            $query->the_post();
    
            $filter_type = get_field('matrix_type');
            $filter_vendor = get_field('matrix_vendor');
    
            if( $filter_type ){
                $filter_types[] = $filter_type;
            }
            
            if( $filter_vendor ){
                $filter_vendors[] = $filter_vendor;
            }
        }
        wp_reset_postdata();
    }

    if( $selected_type ){
        $args['meta_query'][] = array(
            'key' => 'matrix_type',
            'value' => $selected_type,
            'compare' => '='
        );
    }

    if( $selected_vendor ){
        $args['meta_query'][] = array(
            'key' => 'matrix_vendor',
            'value' => $selected_vendor,
            'compare' => '='
        );
    }

    $query = new WP_Query( $args );

    $filter_types = array_unique($filter_types);
    $filter_vendors = array_unique($filter_vendors);
?>
<section class="matrix section">
    <div class="container">
        <?php if( $connect_matrix_title ): ?>
            <h2 class="matrix__title" data-aos="fade-up"><?= $connect_matrix_title; ?></h2>
        <?php endif; ?>
        <div class="matrix__wrap js-matrix-wrap ajax-wrap ajax-wrap--single">
            <div class="matrix__filters js-matrix-filter">
                <div class="matrix__filters-row">
                    <?php if( $filter_types ): ?>
                        <div class="matrix__filter-col">
                            <div class="matrix__filter-item">
                                <div class="filter-select filter-select--full">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="type">
                                        <option value="0">Все направления</option>
                                        <?php foreach( $filter_types as $filter_type ): ?>
                                            <option value="<?= $filter_type; ?>"<?= $selected_type === $filter_type ? ' selected' : ''; ?>><?= $filter_type; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="js-select-toggle">Направления</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $filter_products_arr ): ?>
                        <div class="matrix__filter-col">
                            <div class="matrix__filter-item">
                                <div class="filter-select filter-select--full">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="product">
                                        <?php foreach( $filter_products_arr as $key => $filter_products_item ): ?>
                                            <option value="<?= $key; ?>"<?= $selected_product === $key ? ' selected' : ''; ?>><?= $key; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="js-select-toggle">Совместимость</span>
                                </div>
                            </div>
                        </div>
                        <div class="matrix__filter-col">
                            <div class="matrix__filter-item">
                                <div class="filter-select filter-select--full">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="version">

                                        
                                        <?php foreach( $filter_products_arr[$selected_product] as $filter_products_item_val ): ?>
                                            <option value="<?= $filter_products_item_val; ?>"<?= $selected_version === $filter_products_item_val ? ' selected' : ''; ?>><?= $filter_products_item_val; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="js-select-toggle">Версии</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $filter_vendors ): ?>
                        <div class="matrix__filter-col">
                            <div class="matrix__filter-item">
                                <div class="filter-select filter-select--full">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="vendor">
                                        <option value="0">Все вендоры</option>
                                        <?php foreach( $filter_vendors as $filter_vendor ): ?>
                                            <option value="<?= $filter_vendor; ?>"<?= $selected_vendor === $filter_vendor ? ' selected' : ''; ?>><?= $filter_vendor; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="js-select-toggle">Вендор</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="matrix__filters-apply">
                    <button class="btn js-matrix-filter-apply" type="button">Применить</button>
                </div>
            </div>
            <div class="matrix__filters-btn">
                <button class="filter-btn js-matrix-filter-open" type="button">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/filter-icon.svg" alt="Filter">
                    <span>Фильтры</span>
                </button>
            </div>
            <?php
                if( $query->have_posts() ):
                    $unique_cards = [];
            ?>
                <div class="matrix__content">
                    <div class="matrix__row row-lg">
                        <?php
                            while( $query->have_posts() ){
                                $query->the_post();

                                $matrix_solution = get_field('matrix_solution');
                                $matrix_product_version = get_field('matrix_product_version');

                                $unique_key = $matrix_solution . '|' . $matrix_product_version;

                                if( !array_key_exists( $unique_key, $unique_cards ) ){
                                    $unique_cards[$unique_key] = get_the_ID();

                                    get_template_part( 'templates/parts/matrix-card' );
                                }
                            }
                        ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="matrix__content">По данному запросу ничего не найдено...</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="main-popup" id="tech-partner-popup">
    <button class="main-popup__close" type="button" data-fancybox-close>
        <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
    </button>
    <div class="main-popup__wrap">
        <div class="main-popup__left">
            <div class="main-popup__img">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/main-popup-img-3.png" alt="Space">
                <div class="main-popup__sub">Станьте <br>технологическим <br>партнером — <br>Space</div>
            </div>
        </div>
        <div class="main-popup__right">
            <form class="main-popup__form ajax-wrap js-form">
                <div class="main-popup__form-title">Заполните информацию ниже и&nbsp;мы свяжемся с&nbsp;вами</div>
                <div class="main-popup__form-list ajax-wrap__item">
                    <div class="main-popup__form-col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="name">
                                <span>Имя и фамилия</span>
                            </label>
                        </div>
                    </div>
                    <div class="main-popup__form-col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="company">
                                <span>Компания</span>
                            </label>
                        </div>
                    </div>
                    <div class="main-popup__form-col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                <span>Номер телефона</span>
                            </label>
                        </div>
                    </div>
                    <div class="main-popup__form-col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="email">
                                <span>E-mail</span>
                            </label>
                        </div>
                    </div>
                    <?php if( $form_production_options ): ?>
                        <div class="main-popup__form-col main-popup__form-col--lg">
                            <div class="main-select">
                                <select class="js-select js-feedback-input" name="production"><?= $form_production_options; ?></select>
                                <span class="js-select-toggle">Выпускаемая продукция</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="main-popup__form-col main-popup__form-col--lg">
                        <div class="main-input">
                            <label>
                                <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                <span>Комментарий</span>
                            </label>
                        </div>
                    </div>
                </div>
                <?php if( $site_forms_agree ): ?>
                    <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                <?php endif; ?>
                <div class="main-popup__form-btn ajax-wrap__item">
                    <button class="btn btn-white" type="submit">Отправить</button>
                </div>
                <input type="hidden" name="form_name" value="Заявка на технологического партнера">
                <input type="hidden" name="to" value="<?= $site_feedback_tech_partner_email; ?>">
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>