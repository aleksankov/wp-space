<?php
get_header();

$args = array(
    'post_type' => 'cases',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

$query = new WP_Query( $args );

$post_found = $query->found_posts;

//var_dump($post_found);
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

<section class="cases">
    <div class="container">
        <?php if( $query->have_posts() ): ?>
            <div class="cases__item">
                <h1 class="cases__title h2" data-aos="fade-up"><span><?= num_word($post_found, ['кейс', 'кейса', 'кейсов']); ?></span> в Space</h1>
            </div>
        <?php endif; ?>
        <div class="cases__table" data-aos="fade-up" data-aos-delay="400">
            <?php while( $query->have_posts() ): $query->the_post(); ?>
                <?php get_template_part( 'templates/parts/case-card' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
</section>

<?php get_footer(); ?>