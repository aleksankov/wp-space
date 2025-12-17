<?php
get_header();

$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
$args = array(
    'post_type' => 'cases',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

if($current_filter !== 'all') {
    $args['tax_query'] = array(array('taxonomy' => 'case_tags', 'field' => 'term_id', 'terms' => $current_filter));
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

$product_ids = array();

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $product_id = get_field('product', get_the_ID()); // Получаем ID продукта из ACF

        if ($product_id && !in_array($product_id, $product_ids)) {
            $product_ids[] = $product_id;
        }
    }
    wp_reset_postdata();
}

// Теперь получаем объекты продуктов
$product_posts = array();
if (!empty($product_ids)) {
    $product_posts = get_posts(array(
        'post_type' => 'page', // или какой у вас тип записи для продуктов
        'post__in' => $product_ids,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'post__in', // сохраняем порядок как в массиве product_ids
    ));
}

var_dump($product_posts);

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