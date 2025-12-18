<?php
get_header();

$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
$current_product = isset($_GET['product']) ? sanitize_text_field($_GET['product']) : 'all';

$args = array(
    'post_type' => 'cases',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

if($current_filter !== 'all') {
    $args['tax_query'] = array(array('taxonomy' => 'case_tags', 'field' => 'term_id', 'terms' => $current_filter));
}

if ($current_product !== 'all') {
    $args['meta_query'] = array(
        array(
            'key' => 'product',
            'value' => $current_product,
            'compare' => '=',
        )
    );
}
if ($current_filter !== 'all' && $current_product !== 'all') {
    $args['tax_query']['relation'] = 'AND';
}

$query = new WP_Query($args);
$post_found = $query->found_posts;

// Получаем все теги таксономии case_tags
$all_tags = get_terms([
    'taxonomy' => 'case_tags',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC',
]);

// Функция для подсчета кейсов с учетом обоих фильтров
function get_case_count_with_filters($filter = 'all', $product = 'all') {
    $count_args = array(
        'post_type' => 'cases',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
    );

    if ($filter !== 'all') {
        $count_args['tax_query'] = array(array(
            'taxonomy' => 'case_tags',
            'field' => 'term_id',
            'terms' => $filter,
        ));
    }

    if ($product !== 'all') {
        $count_args['meta_query'] = array(array(
            'key' => 'product',
            'value' => $product,
            'compare' => '=',
        ));
    }

    $count_query = new WP_Query($count_args);
    $count = $count_query->found_posts;
    wp_reset_postdata();

    return $count;
}

// Получаем все продукты из ВСЕХ кейсов (не только отфильтрованных)
$all_product_ids = array();
$all_cases_query = new WP_Query(array(
    'post_type' => 'cases',
    'post_status' => 'publish',
    'posts_per_page' => -1,
));

if ($all_cases_query->have_posts()) {
    while ($all_cases_query->have_posts()) {
        $all_cases_query->the_post();
        $product_id = get_field('product', get_the_ID());
        if ($product_id && !in_array($product_id, $all_product_ids)) {
            $all_product_ids[] = $product_id;
        }
    }
    wp_reset_postdata();
}

// Получаем объекты продуктов
$product_posts = array();
if (!empty($all_product_ids)) {
    $product_posts = get_posts(array(
        'post_type' => 'page',
        'post__in' => $all_product_ids,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
}

// Считаем количество кейсов для каждого продукта с учетом текущего фильтра по тегам
$product_counts = array();
foreach ($product_posts as $product_post) {
    $product_counts[$product_post->ID] = get_case_count_with_filters($current_filter, $product_post->ID);
}

// Считаем количество кейсов для каждого тега с учетом текущего фильтра по продукту
$tag_counts = array();
foreach ($all_tags as $tag) {
    $tag_counts[$tag->term_id] = get_case_count_with_filters($tag->term_id, $current_product);
}
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

<?php if (!empty($all_tags)) : ?>
    <section class="cases-filters">
        <div class="container">
            <div class="cases-filters__title-filters h5">Фильтр по тегам</div>
            <div class="cases-filters__wrapper">
                <!-- Кнопка "Все кейсы" -->
                <a href="?filter=all" class="cases-filter <?php echo $current_filter === 'all' ? 'cases-filter--active' : ''; ?>">
                    <span class="cases-filter__text">Все кейсы</span>
<!--                    <span class="cases-filter__count">--><?php //echo esc_html($post_found); ?><!--</span>-->
                </a>
                <!-- Кнопки для каждого лейбла -->
                <?php foreach ($all_tags as $key => $tag) : ?>
                    <a href="<?= get_the_permalink(); ?>?filter=<?php echo esc_attr($tag->term_id); ?>"
                       class="cases-filter <?= $current_filter == $tag->term_id ? 'cases-filter--active' : ''; ?>">
                        <span class="cases-filter__text"><?= esc_html($tag->name); ?></span>
                        <span class="cases-filter__count"><?= esc_html($tag->count); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="cases-filters__title-filters h5">Фильтр по продуктам</div>
            <div class="cases-filters__wrapper">
                <?php if (!empty($product_posts)) : ?>

                    <?php foreach ($product_posts as $product_post) :
                        $product_id = $product_post->ID;
                        $product_title = get_the_title($product_post);
                        $product_count = isset($product_counts[$product_id]) ? $product_counts[$product_id] : 0;
                        ?>
                        <?php if ($product_count > 0): ?>
                        <a href="<?= get_the_permalink(); ?>?filter=<?php echo esc_attr($current_filter); ?>&product=<?php echo esc_attr($product_id); ?>"
                           class="cases-filter cases-filter--product <?= ($current_product == $product_id) ? 'cases-filter--active' : ''; ?>">
                            <span class="cases-filter__text"><?= esc_html($product_title); ?></span>
                            <span class="cases-filter__count"><?= esc_html($product_count); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <section class="cases">
        <div class="container">
            <?php if( $query->have_posts() ): ?>
                <div class="cases__item">
                    <h1 class="cases__title h2" data-aos="fade-up">
                        <span><?= num_word($post_found, ['кейс', 'кейса', 'кейсов']); ?></span> в Space
                    </h1>
                </div>
            <?php endif; ?>

            <div class="cases__table" data-aos="fade-up" data-aos-delay="400">
                <?php if( $query->have_posts() ): ?>
                    <?php while( $query->have_posts() ): $query->the_post(); ?>
                        <div class="cases__col">
                            <?php get_template_part('templates/parts/case-card'); ?>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <div class="no-results">
                        <p>По выбранному фильтру кейсы не найдены.</p>
                        <a href="?filter=all" class="button">Показать все кейсы</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>