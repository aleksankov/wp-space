<?php
get_header();
$content = get_the_content();
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
        <div class="cases__content">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
