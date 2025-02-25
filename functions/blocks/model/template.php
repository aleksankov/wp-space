<?php
    $title = get_field('title');
    $desc = get_field('desc');
    $items = get_field('items');

    if( $items ):
?>
    <section class="partners-model section">
        <div class="container">
            <div class="partners-model__header">
                <?php if( $title ): ?>
                    <h2 class="partners-model__title" data-aos="fade-up"><?= $title; ?></h2>
                <?php endif; ?>
                <?php if( $desc ): ?>
                    <div class="partners-model__desc" data-aos="fade-up" data-aos-delay="200"><?= $desc; ?></div>
                <?php endif; ?>
            </div>
            <div class="partners-model__row row">
                <?php $counter = 0; foreach( $items as $item ): ?>
                    <div class="partners-model__col col" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="partners-model__card">
                            <?php if( $item['title'] ): ?>
                                <h3 class="partners-model__card-sub"><?= $item['title']; ?></h3>
                            <?php endif; ?>
                            <div class="partners-model__card-list">
                                <?php $li_counter = 1; foreach( $item['items'] as $partners_model_li ): ?>
                                    <div class="partners-model__card-item">
                                        <?php if( $partners_model_li['icon'] ): ?>
                                            <img src="<?= $partners_model_li['icon']; ?>" alt="<?= $item['title']; ?> - Icon <?= $li_counter; ?>">
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
