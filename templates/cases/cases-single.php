<?php
get_header();
$content = get_the_content();
$post_id = get_the_ID();
$case_tags = get_the_terms($post_id, 'case_tags');
$case_product = get_field('product', $post_id);
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
        <h1 class="cases__title h1">
            <?php the_title(); ?>
        </h1>
        <?php if ($case_tags && !is_wp_error($case_tags)): ?>
            <div class="case-labels">
                <div class="case-labels__wrapper">
                    <?php foreach ($case_tags as $tag): ?>
                        <span class="case-label">
                            <?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endforeach; ?>
                    <span class="case-label">
                            <?php echo get_the_title($case_product) ?>
                        </span>
                </div>
            </div>
        <?php endif; ?>

        <a href="<?= get_permalink($case_product) ?>" class="case-url">
            Подробнее о <?= get_the_title($case_product) ?>
            <svg class="case-url__icon" width="16" height="16" viewBox="0 0 16 16" fill="black">
                <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z"/>
            </svg>
        </a>
    </div>
    <div class="cases__content">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer(); ?>
