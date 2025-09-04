<?php
get_header();
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

    <section class="policy" data-aos="fade-up">
        <div class="container">
            <div class="policy__wrap">
                <div class="policy__content">
                    <h1 class="policy__title"><?= the_title(); ?></h1>
                    <div class="policy__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>