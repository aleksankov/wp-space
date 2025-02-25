<?php
    $career_bonuses_title = get_field('career_bonuses_title');
    $career_bonuses_items = get_field('career_bonuses_items');
    $career_bonuses_items_chunks = array_chunk($career_bonuses_items, 1);

    if( $career_bonuses_items_chunks ):
?>
    <section class="career-bonuses career-bonuses--spec section">
        <div class="container">
            <?php if( $career_bonuses_title ): ?>
                <h2 class="career-bonuses__title h3" data-aos="fade-up"><?= $career_bonuses_title; ?></h2>
            <?php endif; ?>
            <div class="career-bonuses__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1; foreach( $career_bonuses_items_chunks as $career_bonuses_items ): ?>
                        <div class="career-bonuses__slide swiper-slide">
                            <?php foreach( $career_bonuses_items as $career_bonuses_item ): ?>
                                <div class="career-bonuses__item" data-aos="fade-up">
                                    <div class="advantages-card">
                                        <div class="advantages-card__icon">
                                            <img src="<?= $career_bonuses_item['icon']; ?>" alt="Bonuses - Icon <?= $counter; ?>">
                                        </div>
                                        <div class="advantages-card__content">
                                            <h3 class="advantages-card__sub h5"><?= $career_bonuses_item['label']; ?></h3>
                                            <div class="advantages-card__desc"><?= $career_bonuses_item['desc']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php $counter++; endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
