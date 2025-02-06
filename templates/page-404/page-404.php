<?php
    get_header();

    $img = get_field('site_404_img', 'option');
    $title = get_field('site_404_title', 'option');
    $desc = get_field('site_404_desc', 'option');
    $btn = get_field('site_404_btn', 'option');
?>

<section class="not-found">
    <div class="container">
        <div class="not-found__wrap">
            <?php if( $img ): ?>
                <div class="not-found__img"><?= get_retina_img($img, $title); ?></div>
            <?php endif; ?>
            <?php if( $title ): ?>
                <h1 class="not-found__title h4"><?= $title; ?></h1>
            <?php endif; ?>
            <?php if( $desc ): ?>
                <div class="not-found__desc"><?= $desc; ?></div>
            <?php endif; ?>
            <?php if( $btn ): ?>
                <div class="not-found__btn">
                    <a class="btn" href="<?= get_home_url(); ?>"><?= $btn; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>