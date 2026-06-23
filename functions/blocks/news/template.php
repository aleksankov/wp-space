<?php
$taxonomy = SPACE_BLOG_CATEGORY_TAXONOMY;
$post_found_count = 15;
$paged = get_query_var( 'paged', 1 );
$terms = space_get_blog_category_terms( SPACE_BLOG_CATEGORY_SECTION_NEWS );
$terms = array_values( array_filter( $terms, function ( $term ) {
    return 'news' !== $term->slug;
} ) );
$cur_term = space_get_news_category_from_query();
$news_category_requested = (bool) get_query_var( 'news_category' );
$sort = isset( $_GET['sort'] ) ? sanitize_text_field( wp_unslash( $_GET['sort'] ) ) : '';
$news_term_ids = $cur_term ? [ (int) $cur_term->term_id ] : space_get_blog_category_term_ids( SPACE_BLOG_CATEGORY_SECTION_NEWS );

$args = array(
    'post_type' => 'blog',
    'post_status' => 'publish',
    'posts_per_page' => $post_found_count,
    'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'term_id',
            'terms' => $news_term_ids ?: [ 0 ],
            'operator' => 'IN',
        ),
    ),
);

if ( $news_category_requested && ! $cur_term ) {
    $args['post__in'] = [ 0 ];
}

switch ( $sort ) {
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

$query = new WP_Query( $args );

// Статистика.
$from = 1;
$to = $post_found_count;
$post_found = $query->found_posts;

if ( $paged > 1 ) {
    $from = ( $paged * $post_found_count ) - $post_found_count + 1;
    $to = $paged * $post_found_count;
}

if ( $to > $post_found ) {
    $to = $post_found;
}
?>

<section class="news">
    <div class="container">
        <div class="news__header">
            <h1 class="news__title" data-aos="fade-up"><?= esc_html( $cur_term ? $cur_term->name : 'Новости' ); ?></h1>
            <?php if ( $cur_term && $cur_term->description ): ?>
                <div class="news__desc" data-aos="fade-up" data-aos-delay="200"><?= wp_kses_post( $cur_term->description ); ?></div>
            <?php endif; ?>
        </div>
        <div class="news__wrap">
            <div class="news__left" data-aos="fade-up" data-aos-delay="400">
                <div class="news__tabs">
                    <a href="<?= esc_url( space_get_news_page_url() ); ?>" class="news__tabs-item">
                        Новости
                    </a>
                    <?php foreach ( $terms as $term ): ?>
                        <a href="<?= esc_url( space_get_news_category_url( $term ) ); ?>" class="news__tabs-item<?= $cur_term && $term->term_id === $cur_term->term_id ? ' active' : ''; ?>"><?= esc_html( $term->name ); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="news__right" data-aos="fade-up" data-aos-delay="600">
                <?php if ( $post_found ): ?>
                    <?php
                    if ( $post_found < $post_found_count ) {
                        $post_found_count = $post_found;
                    }
                    ?>
                    <div class="news__controls">
                        <div class="news__count"><?= esc_html( $from ); ?>-<?= esc_html( $to ); ?> из <?= esc_html( $post_found ); ?></div>
                        <div class="news__sort">
                            <div class="sort-select">
                                <select class="js-select" onchange="location.href=this.value;">
                                    <option value="<?= esc_url( add_query_arg( 'sort', '', remove_query_arg( 'sort' ) ) ); ?>" <?= empty( $sort ) ? 'selected' : ''; ?>>По дате</option>
                                    <option value="<?= esc_url( add_query_arg( 'sort', 'popularity', remove_query_arg( 'paged' ) ) ); ?>" <?= ( $sort === 'popularity' ) ? 'selected' : ''; ?>>По популярности</option>
                                    <option value="<?= esc_url( add_query_arg( 'sort', 'alphabet', remove_query_arg( 'paged' ) ) ); ?>" <?= ( $sort === 'alphabet' ) ? 'selected' : ''; ?>>По алфавиту</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="news__row row-lg">
                        <?php while ( $query->have_posts() ): $query->the_post(); ?>
                            <div class="news__col col-lg">
                                <?php get_template_part( 'templates/parts/news-card' ); ?>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>

                    <?php if ( $query->max_num_pages > 1 ) : ?>
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
                                'add_args'     => $sort ? [ 'sort' => $sort ] : false,
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
