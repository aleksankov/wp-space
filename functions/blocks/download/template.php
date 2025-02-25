<?php
    $color = get_field('color');
    $title = get_field('title');
    $cards = get_field('cards');
?>

<?php if( $color ): ?>
    <style>
        .product-download .product-download__title span{
            color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>

<?php if( $cards ): ?>
    <section class="product-download section" id="download">
        <div class="container">
            <?php if( $title ): ?>
                <h2 class="product-download__title" data-aos="fade-up"><?= $title; ?></h2>
            <?php endif; ?>
            <div class="product-download__row row-lg">
                <?php $counter = 0; foreach( $cards as $card ): if($counter == 3) $counter = 0; ?>
                    <div class="product-download__col col-lg" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                        <div class="product-download__card">
                            <div class="product-download__card-top">
                                <div class="product-download__card-header">
                                    <?php if( $card['sub'] ): ?>
                                        <div class="product-download__card-oc"><?= $card['sub']; ?></div>
                                    <?php endif; ?>
                                    <?php if( $card['logo'] ): ?>
                                        <div class="product-download__card-icon">
                                            <img src="<?= $card['logo']; ?>" alt="<?= $card['sub']; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if( $card['items'] ): ?>
                                    <div class="product-download__tags">
                                        <?php foreach( $card['items'] as $item ): ?>
                                            <div class="product-download__tag"><?= $item['item']; ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if( $card['link'] ): ?>
                                <div class="product-download__btn">
                                    <a class="btn" href="<?= $card['link']; ?>" target="_blank">Скачать</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
