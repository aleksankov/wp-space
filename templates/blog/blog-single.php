<?php
    get_header();

    $card_id = get_the_ID();

    $title = get_the_title($card_id);
    $permalink = get_the_permalink($card_id);
    
    if( has_post_thumbnail($card_id) ){
        $thumbnail_id = get_post_thumbnail_id($card_id);
        $img = kama_thumb_src( 'w=1560', $thumbnail_id );
    }else{
        $thumbnail_id = false;
    }

    $date = get_the_date('d F Y', $card_id);

    $category = get_the_terms( $card_id, 'blog_category' );

    if( $category ){
        $category = array_shift($category);
        $category_id = $category->term_id;
        $category_link = get_term_link($category_id);
    }else{
        $category_link = get_home_url() . '/blog/category/news/';
        $category_id = false;
    }

    $content = get_the_content($card_id);
?>

<article class="article">
    <div class="container">
        <div class="article__wrap">
            <div class="article__back">
                <a class="back-btn" href="<?= $category_link; ?>">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/back-btn-icon.svg" alt="Back">
                    <span>Ко всем новостям</span>
                </a>
            </div>
            <div class="article__header">
                <div class="article__date"><?= $date; ?></div>
                <h1 class="article__title h3"><?= $title; ?></h1>
                <?php if( $thumbnail_id ): ?>
                    <div class="article__thumbnail">
                        <img src="<?= $img; ?>" alt="<?= $title; ?>">
                    </div>
                <?php endif; ?>

                <?php if (false) : ?>
                    <div class="article__share">
                        <button class="share-btn" type="button">
                            <span>Поделиться</span>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/share-icon.svg" alt="Share">
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <?php if( $content ): ?>
                <div class="article__content main-text"><?= $content; ?></div>
            <?php endif; ?>
        </div>
    </div>
</article>

<?php
    $args = array(
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'post__not_in' => [$card_id],
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => 'news'
            )
        )
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ):
?>
    <section class="other-articles section">
        <div class="container">
            <h2 class="other-articles__title">Последние новости</h2>
            <div class="other-articles__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php while( $query->have_posts() ): $query->the_post(); ?>
                        <div class="other-articles__slide swiper-slide">
                            <?php get_template_part( 'templates/parts/news-card' ); ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>