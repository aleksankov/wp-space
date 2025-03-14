<?php
    $card_id = get_the_ID();
    $card_logo = get_field('matrix_logo');
    $card_solution = get_field('matrix_solution');
    $card_type = get_field('matrix_type');
    $card_vendor = get_field('matrix_vendor');
    $card_product = get_field('matrix_product');
    $card_product_version = get_field('matrix_product_version');

    if( false && $card_logo ){
        $card_logo_url = wp_get_upload_dir()['baseurl'] . '/vendors_logo/' . $card_logo;
    }elseif( $card_logo ){
        $card_logo_url = $card_logo;
    }else{
        $card_logo_url = get_template_directory_uri() . '/assets/img/def-logo.svg';
    }

    $versions = [];
    $versions_args = array(
        'post_type' => 'matrix',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => [[
            'key' => 'matrix_solution',
            'value' => $card_solution,
            'compare' => '='
        ],
        [
            'key' => 'matrix_product',
            'value' => $card_product,
            'compare' => '='
        ]]
    );

    $versions_query = new WP_Query( $versions_args );
    $versions_arr = [];

    if( $versions_query->have_posts() ){
        while( $versions_query->have_posts() ){
            $versions_query->the_post();

            if( $matrix_product_version = get_field('matrix_product_version') ){
                $versions_arr[] = $matrix_product_version;
            }
        }
        $versions_arr = array_unique($versions_arr);
    }

    usort($versions_arr, function ($a, $b) {
        $versionA = extractVersion($a);
        $versionB = extractVersion($b);
        return version_compare($versionB, $versionA);
    });

    $models_arr = [];

    if( $versions_arr ){
        foreach( $versions_arr as $versions_item ){
            $models_args = array(
                'post_type' => 'matrix',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'meta_query' => [[
                    'key' => 'matrix_solution',
                    'value' => $card_solution,
                    'compare' => '='
                ],
                [
                    'key' => 'matrix_product_version',
                    'value' => $versions_item,
                    'compare' => '='
                ]]
            );
        
            $models_query = new WP_Query( $models_args );
        
            if( $models_query->have_posts() ){
                while( $models_query->have_posts() ){
                    $models_query->the_post();
        
                    if( $matrix_solution_version = get_field('matrix_solution_version') ){
                        $models_arr[$versions_item][] = $card_solution . ' ' . $matrix_solution_version;
                    }
                }
                $models_arr[$versions_item] = array_unique($models_arr[$versions_item]);

                usort($models_arr[$versions_item], function ($a, $b) {
                    $versionA = extractVersion($a);
                    $versionB = extractVersion($b);
                    return version_compare($versionB, $versionA);
                });
            }
        }
    }
?>
<div class="matrix__col col-lg">
    <a class="matrix-card" href="#matrix-popup-<?= $card_id; ?>" data-fancybox="" data-touch="false">
        <div class="matrix-card__img">
            <img src="<?= $card_logo_url; ?>" alt="<?= $card_vendor; ?>">
        </div>
        <div class="matrix-card__info">
            <?php if( $card_solution ): ?>
                <div class="matrix-card__sub"><?= $card_solution; ?></div>
            <?php endif; ?>
            <?php if( $card_type ): ?>
                <div class="matrix-card__desc"><?= $card_type; ?></div>
            <?php endif; ?>
        </div>
    </a>
</div>

<div class="matrix-popup js-matrix-popup" id="matrix-popup-<?= $card_id; ?>">
    <button class="matrix-popup__close" type="button" data-fancybox-close>
        <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
    </button>
    <div class="matrix-popup__wrap">
        <div class="matrix-popup__info">
            <?php if( $card_solution ): ?>
                <div class="matrix-popup__title h5"><?= $card_solution; ?></div>
            <?php endif; ?>
            <?php if( $card_type ): ?>
                <div class="matrix-popup__desc"><?= $card_type; ?></div>
            <?php endif; ?>
            <div class="matrix-popup__img">
                <img src="<?= $card_logo_url; ?>" alt="<?= $card_solution; ?>">
            </div>
            <?php if( $versions_arr ): ?>
                <div class="matrix-popup__select">
                    <div class="filter-select main-scroll">
                        <select class="js-select js-select-scroll js-matrix-version">
                            <option value="0">&nbsp;</option>
                            <?php $counter = 1; foreach( $versions_arr as $versions_item ): ?>
                                <option value="<?= $counter; ?>"<?= $card_product_version == $versions_item ? ' selected' : ''; ?>><?= $card_product; ?> <?= $versions_item; ?></option>
                            <?php $counter++; endforeach; ?>
                        </select>
                        <span class="js-select-toggle">Версия</span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( $models_arr ): ?>
                <div class="matrix-popup__models">
                    <div class="matrix-popup__models-sub">Список моделей оборудования</div>
                    <div class="matrix-popup__models-wrap">
                        <?php foreach( $models_arr as $key => $models_list ): ?>
                            <div class="matrix-popup__models-list js-matrix-list<?= $key == $card_product_version ? ' active' : ''; ?>">
                                <ul>
                                    <?php foreach( $models_list as $models_item ): ?>
                                        <li><?= $models_item; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>