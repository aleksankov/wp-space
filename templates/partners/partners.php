<?php
    get_header();
?>

<?php
    $partners_hero_img = get_field('partners_hero_img');
    $partners_hero_title = get_field('partners_hero_title');
    $partners_hero_sub_1 = get_field('partners_hero_sub_1');
    $partners_hero_sub_2 = get_field('partners_hero_sub_2');
    $partners_hero_btn = get_field('partners_hero_btn');

    if( $partners_hero_title ):
?>
    <section class="product-hero product-hero--partners" data-aos="fade-up">
        <div class="container">
            <div class="product-hero__wrap">
                <?php if( $partners_hero_img ): ?>
                    <div class="product-hero__img">
                        <img src="<?= kama_thumb_src( 'wh=882:826', $partners_hero_img ); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="product-hero__content">
                    <h1 class="product-hero__title"><?= $partners_hero_title; ?></h1>
                    <?php if( $partners_hero_sub_1 || $partners_hero_sub_2 ): ?>
                        <div class="product-hero__sub-list h4">
                            <?php if( $partners_hero_sub_1 ): ?>
                                <div class="product-hero__sub"><?= $partners_hero_sub_1; ?></div>
                            <?php endif; ?>
                            <?php if( $partners_hero_sub_2 ): ?>
                                <div class="product-hero__sub"><?= $partners_hero_sub_2; ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $partners_hero_btn ): ?>
                        <div class="product-hero__bottom">
                            <div class="product-hero__btn">
                                <a class="btn" href="#partner-popup" data-fancybox="" data-touch="false"><?= $partners_hero_btn; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $partners_distributors_title = get_field('partners_distributors_title');
    $partners_distributors_cards = get_field('partners_distributors_cards');

    if( $partners_distributors_cards ):
?>
    <section class="partners-distributors section">
        <div class="container">
            <?php if( $partners_distributors_title ): ?>
                <h2 class="partners-distributors__title" data-aos="fade-up"><?= $partners_distributors_title; ?></h2>
            <?php endif; ?>
            <div class="partners-distributors__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $partners_distributors_cards as $partners_distributors_card ): ?>
                        <div class="partners-distributors__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= ($counter - 1) * 200; ?>">
                            <div class="partners-distributors__item">
                                <div class="partners-distributors__item-logo">
                                    <img src="<?= $partners_distributors_card['logo']; ?>" alt="Distributor - Logo <?= $counter; ?>">
                                </div>
                                <div class="partners-distributors__item-info">
                                    <?php if( $partners_distributors_card['tel'] ): ?>
                                        <a class="partners-distributors__item-link" href="<?= get_tel_href($partners_distributors_card['tel']); ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-1.svg" alt="Phone">
                                            <span><?= $partners_distributors_card['tel']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $partners_distributors_card['email'] ): ?>
                                        <a class="partners-distributors__item-link" href="mailto:<?= $partners_distributors_card['email']; ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-2.svg" alt="Email">
                                            <span><?= $partners_distributors_card['email']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $partners_distributors_card['site_label'] && $partners_distributors_card['site_url'] ): ?>
                                        <a class="partners-distributors__item-link" href="<?= $partners_distributors_card['site_url']; ?>" target="_blank">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-3.svg" alt="Website">
                                            <span><?= $partners_distributors_card['site_label']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
                <div class="partners-distributors__pagination gallery-pagination"></div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $partners_model_title = get_field('partners_model_title');
    $partners_model_desc = get_field('partners_model_desc');
    $partners_model_items = get_field('partners_model_items');

    if( $partners_model_items ):
?>
    <section class="partners-model section">
        <div class="container">
            <div class="partners-model__header">
                <?php if( $partners_model_title ): ?>
                    <h2 class="partners-model__title" data-aos="fade-up"><?= $partners_model_title; ?></h2>
                <?php endif; ?>
                <?php if( $partners_model_desc ): ?>
                    <div class="partners-model__desc" data-aos="fade-up" data-aos-delay="200"><?= $partners_model_desc; ?></div>
                <?php endif; ?>
            </div>
            <div class="partners-model__row row">
                <?php $counter = 0; foreach( $partners_model_items as $partners_model_item ): ?>
                    <div class="partners-model__col col" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="partners-model__card">
                            <?php if( $partners_model_item['title'] ): ?>
                                <h3 class="partners-model__card-sub"><?= $partners_model_item['title']; ?></h3>
                            <?php endif; ?>
                            <div class="partners-model__card-list">
                                <?php $li_counter = 1; foreach( $partners_model_item['items'] as $partners_model_li ): ?>
                                    <div class="partners-model__card-item">
                                        <?php if( $partners_model_li['icon'] ): ?>
                                            <img src="<?= $partners_model_li['icon']; ?>" alt="<?= $partners_model_item['title']; ?> - Icon <?= $li_counter; ?>">
                                        <?php endif; ?>
                                        <span><?= $partners_model_li['label']; ?></span>
                                    </div>
                                <?php $li_counter++; endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $partners_list_title = get_field('partners_list_title');
    $partners_list_items = get_field('partners_list_items');

    if( $partners_list_items ):
?>
    <section class="partners-list section">
        <div class="container">
            <?php if( $partners_list_title ): ?>
                <h2 class="partners-list__title" data-aos="fade-up"><?= $partners_list_title; ?></h2>
            <?php endif; ?>
            <div class="partners-list__slider swiper-container js-partners-list-toggle">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $partners_list_items as $partners_list_item ): ?>
                        <div class="partners-list__slide swiper-slide" data-aos="fade-up">
                            <?php if( $partners_list_item['url'] ): ?>
                                <a class="partners-list__item" href="<?= $partners_list_item['url']; ?>" target="_blank"><?= get_retina_img($partners_list_item['logo'], $partners_list_title . '- Logo ' . $counter); ?></a>
                            <?php else: ?>
                                <div class="partners-list__item"><?= get_retina_img($partners_list_item['logo'], $partners_list_title . '- Logo ' . $counter); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php $counter++; endforeach; ?>
                </div>
                <div class="partners-list__btn">
                    <button class="btn btn-toggle js-partners-list-toggle" type="button">
                        <span>Показать полный список</span>
                        <span>Скрыть полный список</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>