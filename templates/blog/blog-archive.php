<?php
    get_header();

    $taxonomy = 'blog_category';
    $is_tax = is_tax();

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
        'posts_per_page' => -1
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

    if( $cur_term ){
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $cur_term->term_id,
            ),
        );
    }

    $query = new WP_Query( $args );

    $post_found = $query->found_posts;
?>

<section class="news">
    <div class="container">
        <?php if( $cur_term ): ?>
            <div class="news__header">
                <h1 class="news__title" data-aos="fade-up"><?= $cur_term->name; ?></h1>
                <div class="news__desc" data-aos="fade-up" data-aos-delay="200"><?= $cur_term->description; ?></div>
            </div>
        <?php endif; ?>
        <div class="news__wrap">
            <?php if( $terms ): ?>
                <div class="news__left" data-aos="fade-up" data-aos-delay="400">
                    <div class="news__tabs">
                        <?php foreach( $terms as $term ): ?>
                            <a href="<?= get_term_link( $term->term_id ); ?>" class="news__tabs-item<?= $term->term_id == $cur_term->term_id ? ' active' : ''; ?>"><?= $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="news__right" data-aos="fade-up" data-aos-delay="600">
                <?php if( $post_found ): ?>
                    <?php
                        $post_found_count = 15;
                        
                        if( $post_found < $post_found_count){
                            $post_found_count = $post_found;
                        }
                    ?>
                    <div class="news__controls">
                        <div class="news__count">1-<?= $post_found_count; ?> из <?= $post_found; ?></div>
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
                            <div class="news__col col-lg">
                                <?php get_template_part( 'templates/parts/news-card' ); ?>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php if( false ): ?>
                        <div class="news__pagination main-pagination">
                            <span>1</span>
                            <a href="news.html">2</a>
                            <a href="news.html">3</a>
                            <a href="news.html">4</a>
                            <a href="news.html">5</a>
                            <a class="main-pagination__btn" href="news.html">Дальше</a>
                        </div>
                        <div class="news__pagination main-pagination-mob">
                            <span>1</span>
                            <a href="news.html">2</a>
                            <a href="news.html">3</a>
                            <a href="news.html">4</a><i>...</i>
                            <a href="news.html">124</a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p>По данному запросу ничего не найдено...</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>