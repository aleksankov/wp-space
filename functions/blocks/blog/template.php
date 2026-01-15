<?php
get_header();

$taxonomy = 'blog_category';
$is_tax = is_tax();
$post_found_count = 15;
$paged = get_query_var('paged', 1);

$terms = get_terms( array(
    'taxonomy' => $taxonomy,
    'hide_empty' => true,
    'orderby' => 'term_taxonomy_id',
    'order' => 'ASC'
) );

if( $is_tax ){
    $term_slug = get_query_var( 'term' );
    $cur_term = get_term_by( 'slug', $term_slug, $taxonomy );
}else{
    $cur_term = false;
}

$sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';

$args = array(
    'post_type' => 'blog',
    'post_status' => 'publish',
    'posts_per_page' => $post_found_count,
    'paged' => $paged
);

switch ($sort) {
    case 'popularity':
        $args['meta_key'] = '_post_views_count';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;

    case 'alphabet':
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
        break;

    default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
}

// Получаем ID категории 'news'
$news_term = get_term_by('slug', 'news', $taxonomy);
$news_term_id = $news_term ? $news_term->term_id : 0;

// Функция для получения постов, привязанных ТОЛЬКО к news
function get_posts_only_in_news($taxonomy, $news_term_id) {
    global $wpdb;

    $query = $wpdb->prepare(
        "SELECT DISTINCT tr.object_id 
        FROM {$wpdb->term_relationships} tr
        INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        WHERE tt.taxonomy = %s 
        AND tt.term_id = %d
        AND NOT EXISTS (
            SELECT 1 
            FROM {$wpdb->term_relationships} tr2
            INNER JOIN {$wpdb->term_taxonomy} tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
            WHERE tr2.object_id = tr.object_id 
            AND tt2.taxonomy = %s
            AND tt2.term_id != %d
        )",
        $taxonomy,
        $news_term_id,
        $taxonomy,
        $news_term_id
    );

    $results = $wpdb->get_col($query);
    return $results ?: array();
}

if( $cur_term ){
    // Если есть текущий термин
    if ($news_term_id) {
        // Получаем посты, которые привязаны ТОЛЬКО к news
        $posts_only_news = get_posts_only_in_news($taxonomy, $news_term_id);

        // Исключаем эти посты из результатов
        if (!empty($posts_only_news)) {
            $args['post__not_in'] = $posts_only_news;
        }

        // Основной tax_query для текущего термина
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $cur_term->term_id,
            )
        );
    } else {
        // Если нет категории news, просто фильтруем по текущему термину
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $cur_term->term_id,
            )
        );
    }
} else {
    // Если нет текущего термина (общий архив)
    if ($news_term_id) {
        // Получаем посты, которые привязаны ТОЛЬКО к news
        $posts_only_news = get_posts_only_in_news($taxonomy, $news_term_id);

        // Исключаем эти посты из результатов
        if (!empty($posts_only_news)) {
            $args['post__not_in'] = $posts_only_news;
        }
    }
}

$query = new WP_Query( $args );

// Статистика
$from = 1;
$to = $post_found_count;
$post_found = $query->found_posts;

if ($paged > 1) {
    $from = ($paged * $post_found_count) - $post_found_count + 1;
    $to = $paged * $post_found_count;
}

if ($to > $post_found) {
    $to = $post_found;
}
?>

<section class="news">
    <div class="container">
        <div class="news__header">
            <h1 class="news__title" data-aos="fade-up"><?= $cur_term ? $cur_term->name : get_the_title(); ?></h1>
            <div class="news__desc" data-aos="fade-up" data-aos-delay="200"><?= $cur_term->description; ?></div>
        </div>
        <div class="news__wrap">
            <?php if( $terms ): ?>
                <div class="news__left" data-aos="fade-up" data-aos-delay="400">
                    <div class="news__tabs">
                        <?php foreach( $terms as $term ): ?>
                            <?php if($term->slug == 'news') continue; ?>
                            <a href="<?= get_term_link( $term->term_id ); ?>" class="news__tabs-item<?= $term->term_id == $cur_term->term_id ? ' active' : ''; ?>"><?= $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="news__right" data-aos="fade-up" data-aos-delay="600">
                <?php if( $post_found ): ?>
                    <?php
                    if( $post_found < $post_found_count){
                        $post_found_count = $post_found;
                    }
                    ?>
                    <div class="news__controls">
                        <div class="news__count"><?= $from ?>-<?= $to; ?> из <?= $post_found; ?></div>
                        <div class="news__sort">
                            <div class="sort-select">
                                <select class="js-select" onchange="location.href=this.value;">
                                    <option value="<?= add_query_arg('sort', '', remove_query_arg('sort')); ?>" <?= empty($sort) ? "selected" : ""; ?>>По дате</option>
                                    <option value="<?= add_query_arg('sort', 'popularity', remove_query_arg('paged')); ?>" <?= ($sort === "popularity") ? "selected" : ""; ?>>По популярности</option>
                                    <option value="<?= add_query_arg('sort', 'alphabet', remove_query_arg('paged')); ?>" <?= ($sort === "alphabet") ? "selected" : ""; ?>>По алфавиту</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="news__row row-lg">
                        <?php while( $query->have_posts() ): $query->the_post(); ?>
                            <div class="news__col-blog col-lg">
                                <?php get_template_part( 'templates/parts/blog-card' ); ?>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>

                    <?php if ($query->max_num_pages > 1) : ?>
                        <div class="news__pagination main-pagination">
                            <?php
                            echo paginate_links( array(
                                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'total'        => $query->max_num_pages,
                                'current'      => $paged,
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1,
                                'prev_next'    => false,
                                'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
                                'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
                                'add_args'     => false,
                                'add_fragment' => '',
                            ) );
                            ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p>По данному запросу ничего не найдено...</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
