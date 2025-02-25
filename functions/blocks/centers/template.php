<?php
    $education_centers_color = get_field('education_centers_color');
    $education_centers_title = get_field('education_centers_title');
    $education_centers_items = get_field('education_centers_items');

    if( $education_centers_items ):
?>
    <?php if( $education_centers_color ): ?>
        <style>
            .learning-contacts .learning-contacts__title span{
                color: <?= $education_centers_color; ?>;
            }
        </style>
    <?php endif; ?>

    <section class="learning-contacts section">
        <div class="container">
            <?php if( $education_centers_title ): ?>
                <h2 class="learning-contacts__title" data-aos="fade-up"><?= $education_centers_title; ?></h2>
            <?php endif; ?>
            <div class="learning-contacts__row">
                <?php $counter = 0; foreach( $education_centers_items as $education_centers_item ): if($counter == 2) $counter = 0; ?>
                    <div class="learning-contacts__col" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="partners-distributors__item">
                            <div class="partners-distributors__item-top">
                                <div class="partners-distributors__item-logo"><?= get_retina_img($education_centers_item['logo'], $education_centers_item['label']); ?></div>
                                <div class="partners-distributors__item-sub h4"><?= $education_centers_item['label']; ?></div>
                                <?php if( $education_centers_item['desc'] ): ?>
                                    <div class="partners-distributors__item-desc"><?= $education_centers_item['desc']; ?></div>
                                <?php endif; ?>
                            </div>
                            <?php if( $education_centers_item['phone'] || $education_centers_item['email'] ): ?>
                                <div class="partners-distributors__item-info">
                                    <?php if( $education_centers_item['phone'] ): ?>
                                        <div class="partners-distributors__item-link">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-1.svg" alt="Phone">
                                            <span><?= $education_centers_item['phone']; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( $education_centers_item['email'] ): ?>
                                        <a class="partners-distributors__item-link" href="mailto:<?= $education_centers_item['email']; ?>">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/partners-distributors-icon-2.svg" alt="Email">
                                            <span><?= $education_centers_item['email']; ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
