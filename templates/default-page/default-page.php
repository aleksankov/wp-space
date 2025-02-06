<?php
    get_header();
?>

<div class="header-post">
    <div class="container">
        <div class="header-post__wrap">
            <div class="header-post__title-wrap">
                <h1 class="header-post__title header-post__title--lg header-post__title--show header-post__title--text"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="post-text main-text section--last">
    <div class="container">
        <div class="post-text__wrap lg-wrap"><?php the_content(); ?></div>
    </div>
</div>

<?php get_footer(); ?>