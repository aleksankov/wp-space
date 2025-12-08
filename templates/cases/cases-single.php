<?php
get_header();
$content = get_the_content();
$post_id = get_the_ID();
$case_labels = get_field('labels', $post_id);
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
        <?php if ($case_labels && is_array($case_labels)): ?>
            <div class="case-labels">
                <div class="case-labels__wrapper">
                    <?php foreach ($case_labels as $label): ?>
                        <?php
                        if (!empty($label['label'])):
                            ?>
                            <span class="case-label"><?php echo esc_html($label['label']); ?></span>
                        <?php
                        elseif (!empty($label) && is_string($label)):
                            ?>
                            <span class="case-label"><?php echo esc_html($label); ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <a href="<?= $case_product->guid ?>" class="case-url">
            ПОДРОБНЕЕ О ПРОДУКТЕ <?= $case_product->post_title ?>
            <svg class="case-url__icon" width="16" height="16" viewBox="0 0 16 16" fill="black">
                <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z"/>
            </svg>
        </a>

        <div class="cases__content">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
