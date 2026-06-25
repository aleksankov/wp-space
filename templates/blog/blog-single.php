<?php
get_header();

$card_id = get_the_ID();
$title = get_the_title( $card_id );
$permalink = get_the_permalink( $card_id );
$thumbnail_id = false;

if ( has_post_thumbnail( $card_id ) ) {
    $thumbnail_id = get_post_thumbnail_id( $card_id );
    $img = kama_thumb_src( 'w=1560', $thumbnail_id );
}

$date = get_the_date( 'd F Y', $card_id );
$post_section = space_get_post_blog_section( $card_id );
$is_news_category = SPACE_BLOG_CATEGORY_SECTION_NEWS === $post_section;
$section_label = $is_news_category ? 'Новости' : 'Блог';
$section_link = $is_news_category ? space_get_news_page_url() : space_get_blog_page_url();
$section_term_ids = space_get_blog_category_term_ids( $post_section );
$back_text = $is_news_category ? 'Ко всем новостям' : 'Ко всем статьям';
$related_title = $is_news_category ? 'Последние новости' : 'Последние статьи';
$related_card_template = $is_news_category ? 'templates/parts/news-card' : 'templates/parts/blog-card';
$content = apply_filters( 'the_content', get_the_content( null, false, $card_id ) );
?>

<section class="breadcrumbs-wrap">
    <div class="container">
        <div class="breadcrumbs-wrapper">
            <nav class="breadcrumbs">
                <span>
                    <a href="<?= esc_url( home_url( '/' ) ); ?>">Главная</a>
                    <span> » </span>
                    <a href="<?= esc_url( $section_link ); ?>"><?= esc_html( $section_label ); ?></a>
                    <span> » </span>
                    <span><?= esc_html( $title ); ?></span>
                </span>
            </nav>
        </div>
    </div>
</section>

<article class="article">
    <div class="container">
        <div class="article__wrap">
            <div class="article__back">
                <a class="back-btn" href="<?= esc_url( $section_link ); ?>">
                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/img/back-btn-icon.svg" alt="Back">
                    <span><?= esc_html( $back_text ); ?></span>
                </a>
            </div>
            <div class="article__header">
                <div class="article__date"><?= esc_html( $date ); ?></div>
                <h1 class="article__title h3"><?= esc_html( $title ); ?></h1>
                <?php if ( $thumbnail_id ): ?>
                    <div class="article__thumbnail">
                        <img src="<?= esc_url( $img ); ?>" alt="<?= esc_attr( $title ); ?>">
                    </div>
                <?php endif; ?>

                <?php if ( false ) : ?>
                    <div class="article__share">
                        <button class="share-btn" type="button">
                            <span>Поделиться</span>
                            <img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/img/share-icon.svg" alt="Share">
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ( $content ): ?>
                <div class="article__content main-text"><?= wp_kses_post( $content ); ?></div>
            <?php endif; ?>
        </div>
    </div>
</article>

<?php
$args = array(
    'post_type' => 'blog',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'post__not_in' => [ $card_id ],
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => SPACE_BLOG_CATEGORY_TAXONOMY,
            'field' => 'term_id',
            'terms' => $section_term_ids ?: [ 0 ],
            'operator' => 'IN',
        ),
    ),
);

$query = new WP_Query( $args );

if ( $query->have_posts() ):
?>
    <section class="other-articles section">
        <div class="container">
            <h2 class="other-articles__title"><?= esc_html( $related_title ); ?></h2>
            <div class="other-articles__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php while ( $query->have_posts() ): $query->the_post(); ?>
                        <div class="other-articles__slide swiper-slide">
                            <?php get_template_part( $related_card_template ); ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
