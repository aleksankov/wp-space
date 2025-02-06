<?php
    get_header();
?>

<?php
    $support_hero_title = get_field('support_hero_title');
    $support_hero_desc = get_field('support_hero_desc');
    $support_hero_items = get_field('support_hero_items');
    $support_hero_img = get_field('support_hero_img');

    if( $support_hero_title ):
?>
    <section class="product-hero product-hero--service" data-aos="fade-up">
        <div class="container">
            <div class="product-hero__wrap">
                <?php if( $support_hero_img ): ?>
                    <div class="product-hero__img">
                        <img src="<?= kama_thumb_src( 'wh=882:826', $support_hero_img ); ?>" alt="<?php the_title(); ?>">
                    </div>
                <?php endif; ?>
                <div class="product-hero__content">
                    <h1 class="product-hero__title product-hero__title--small"><?= $support_hero_title; ?></h1>
                    <?php if( $support_hero_desc ): ?>
                        <div class="product-hero__desc"><?= $support_hero_desc; ?></div>
                    <?php endif; ?>
                    <div class="product-hero__advantages">
                        <?php foreach( $support_hero_items as $support_hero_item ): ?>
                            <div class="product-hero__advantages-col">
                                <div class="advantages-item">
                                    <?php if( $support_hero_item['icon'] ): ?>
                                        <div class="advantages-item__icon">
                                            <img src="<?= $support_hero_item['icon']; ?>" alt="<?= $support_hero_item['label']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="advantages-item__info">
                                        <div class="advantages-item__sub h7"><?= $support_hero_item['label']; ?></div>
                                        <div class="advantages-item__desc"><?= $support_hero_item['desc']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $support_centers_items = get_field('support_centers_items');

    if( $support_centers_items ):
?>
    <section class="partners-distributors section">
        <div class="container">
            <div class="partners-distributors__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $support_centers_items as $support_centers_item ): ?>
                        <div class="partners-distributors__slide swiper-slide" data-aos="fade-up" data-aos-delay="<?= ($counter - 1) * 200; ?>">
                            <div class="partners-distributors__item partners-distributors__item--file">
                                <div class="partners-distributors__item-logo"><?= get_retina_img($support_centers_item['logo'], 'Support - Logo ' . $counter); ?></div>
                                <div class="partners-distributors__item-info">
                                    <?php if( $support_centers_item['phone'] ): ?>
                                        <a class="partners-distributors__item-link" href="<?= get_tel_href($support_centers_item['phone']); ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-1.svg" alt="Phone">
                                            <span><?= $support_centers_item['phone']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $support_centers_item['email'] ): ?>
                                        <a class="partners-distributors__item-link" href="mailto:<?= $support_centers_item['email']; ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-2.svg" alt="Email">
                                            <span><?= $support_centers_item['email']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $support_centers_item['file'] && $support_centers_item['file_name'] ): ?>
                                        <a class="partners-distributors__item-link partners-distributors__item-link--file" href="<?= $support_centers_item['file']; ?>" target="_blank">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-4.svg" alt="File">
                                            <span><?= $support_centers_item['file_name']; ?></span>
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
    $support_banner_bg = get_field('support_banner_bg');
    $support_banner_title = get_field('support_banner_title');
    $support_banner_desc = get_field('support_banner_desc');
    $support_banner_btn_label = get_field('support_banner_btn_label');
    $support_banner_btn_url = get_field('support_banner_btn_url');
    
    $support_advantages_items = get_field('support_advantages_items');

    if( ($support_banner_bg && $support_banner_title) || $support_advantages_items ):
?>
    <section class="space-bugzilla section">
        <div class="container">
            <?php if( $support_banner_bg && $support_banner_title ): ?>
                <div class="space-bugzilla__block" data-aos="fade-up">
                    <div class="space-bugzilla__block-bg">
                        <img src="<?= $support_banner_bg; ?>" alt="<?= $support_banner_title; ?>">
                    </div>
                    <div class="space-bugzilla__content">
                        <h2 class="space-bugzilla__title"><?= $support_banner_title; ?></h2>
                        <?php if( $support_banner_desc ): ?>
                            <div class="space-bugzilla__desc"><?= $support_banner_desc; ?></div>
                        <?php endif; ?>
                        <?php if( $support_banner_btn_label && $support_banner_btn_url ): ?>
                            <div class="space-bugzilla__btn">
                                <a class="btn btn-white" href="<?= $support_banner_btn_url; ?>" target="_blank"><?= $support_banner_btn_label; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( $support_advantages_items ): ?>
                <div class="space-bugzilla__bottom">
                    <div class="advantages__row row-lg">
                        <?php $counter = 0; foreach( $support_advantages_items as $support_advantages_item ): if($counter == 3) $counter = 0; ?>
                            <div class="advantages__col col-lg" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                                <div class="advantages-card">
                                    <div class="advantages-card__icon">
                                        <img src="<?= $support_advantages_item['icon']; ?>" alt="<?= $support_advantages_item['label']; ?>">
                                    </div>
                                    <div class="advantages-card__content">
                                        <h3 class="advantages-card__sub h5"><?= $support_advantages_item['label']; ?></h3>
                                        <?php if( $support_advantages_item['desc'] ): ?>
                                            <div class="advantages-card__desc"><?= $support_advantages_item['desc']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
    $support_docs_title = get_field('support_docs_title');
    $support_docs_desc = get_field('support_docs_desc');
    $support_docs_bg = get_field('support_docs_bg');
    $support_docs_items = get_field('support_docs_items');

    if( $support_docs_items ):
?>
    <section class="faq faq--media section">
        <div class="container">
            <div class="faq__wrap">
                <?php if( $support_docs_title && $support_docs_bg ): ?>
                    <div class="faq__left" data-aos="fade-up">
                        <div class="faq__block faq__block--reverse">
                            <div class="faq__block-bg">
                                <img src="<?= $support_docs_bg; ?>" alt="<?= $support_docs_title; ?>">
                            </div>
                            <h2 class="faq__block-title h3"><?= $support_docs_title; ?></h2>
                            <?php if( $support_docs_desc ): ?>
                                <div class="faq__block-desc"><?= $support_docs_desc; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="faq__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="faq__list">
                        <?php foreach( $support_docs_items as $support_docs_item ): ?>
                            <div class="faq__col">
                                <div class="faq__item faq__item--media">
                                    <div class="faq__toggle h5 js-faq-toggle">
                                        <span><?= $support_docs_item['sub']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/faq-arrow-lg.svg" alt="Arrow">
                                    </div>
                                    <div class="faq__dropdown js-faq-dropdown">
                                        <div class="faq__content">
                                            <div class="faq__files">
                                                <?php foreach( $support_docs_item['items'] as $support_docs_li ): ?>
                                                    <?php if( $support_docs_li['type'] == 'link' ): ?>
                                                        <div class="faq__files-col">
                                                            <a class="media-file" href="<?= $support_docs_li['url']; ?>" target="_blank">
                                                                <?php if( $support_docs_li['icon'] ): ?>
                                                                    <div class="media-file__file-icon js-svg-replace">
                                                                        <img src="<?= $support_docs_li['icon']; ?>" alt="#">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="media-file__file-name"><?= $support_docs_li['label']; ?></div>
                                                                <div class="media-file__icon">
                                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/media-file-icon-2.svg" alt="Arrow">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php elseif( $support_docs_li['type'] == 'file' ): ?>
                                                        <div class="faq__files-col">
                                                            <a class="media-file" href="<?= $support_docs_li['file']; ?>" target="_blank">
                                                                <?php if( $support_docs_li['icon'] ): ?>
                                                                    <div class="media-file__file-icon js-svg-replace">
                                                                        <img src="<?= $support_docs_li['icon']; ?>" alt="#">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="media-file__file-name"><?= $support_docs_li['label']; ?></div>
                                                                <div class="media-file__icon">
                                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/media-file-icon.svg" alt="Download">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>