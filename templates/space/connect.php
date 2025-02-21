<?php
    get_header();
?>

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

    if( $selected_type ){
        $args['meta_query'][] = array(
            'key' => 'matrix_type',
            'value' => $selected_type,
            'compare' => '='
        );
    }

    if( $selected_product ){
        $args['meta_query'][] = array(
            'key' => 'matrix_product',
            'value' => $selected_product,
            'compare' => '='
        );
    }

    if( $selected_version ){
        $args['meta_query'][] = array(
            'key' => 'matrix_product_version',
            'value' => $selected_version,
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

    $filter_types = array_unique($filter_types);
    $filter_vendors = array_unique($filter_vendors);
?>
<section class="matrix section">
    <div class="container">
        <?php if( $connect_matrix_title ): ?>
            <h2 class="matrix__title" data-aos="fade-up"><?= $connect_matrix_title; ?></h2>
        <?php endif; ?>
        <div class="matrix__wrap ajax-wrap">
            <div class="matrix__filters js-matrix-filter" data-aos="fade-up">
                <div class="matrix__filters-row">
                    <?php if( $filter_types ): ?>
                        <div class="matrix__filter-col">
                            <div class="matrix__filter-item">
                                <div class="filter-select">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="type">
                                        <option value="0">&nbsp;</option>
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
                                <div class="filter-select">
                                    <select class="js-select js-select-scroll js-matrix-filter-select" name="vendor">
                                        <option value="0">&nbsp;</option>
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
            ?>
                <div class="matrix__content">
                    <div class="matrix__row row-lg">
                        <?php
                            while( $query->have_posts() ){
                                $query->the_post();

                                get_template_part( 'templates/parts/matrix-card' );
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>