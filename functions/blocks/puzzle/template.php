<?php
    $color = get_field('color');
    $title = get_field('title');
    $card_sub_1 = get_field('card_sub_1');
    $card_sub_2 = get_field('card_sub_2');
    $card_sub_3 = get_field('card_sub_3');
    $card_desc_1 = get_field('card_desc_1');
    $card_desc_2 = get_field('card_desc_2');
    $card_desc_3 = get_field('card_desc_3');
?>

<?php if( $color ): ?>
    <style>
        .product-puzzle .product-puzzle__title span{
            color: <?= $color; ?>;
        }
    </style>
<?php endif; ?>

<section class="product-puzzle section">
    <div class="container">
        <?php if( $title ): ?>
            <h2 class="product-puzzle__title" data-aos="fade-up"><?= $title; ?></h2>
        <?php endif; ?>
        <div class="product-puzzle__wrap" data-aos="fade-up">
            <div class="product-puzzle__bg">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-puzzle-bg.png" alt="Puzzle">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-puzzle-bg-mob.png" alt="Puzzle">
            </div>
            <div class="product-puzzle__row">
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <?php if( $card_sub_1 ): ?>
                                <h3 class="product-puzzle__item-sub"><?= $card_sub_1; ?></h3>
                            <?php endif; ?>
                            <?php if( $card_desc_1 ): ?>
                                <div class="product-puzzle__item-desc"><?= $card_desc_1; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <?php if( $card_sub_2 ): ?>
                                <h3 class="product-puzzle__item-sub"><?= $card_sub_2; ?></h3>
                            <?php endif; ?>
                            <?php if( $card_desc_2 ): ?>
                                <div class="product-puzzle__item-desc"><?= $card_desc_2; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <?php if( $card_sub_3 ): ?>
                                <h3 class="product-puzzle__item-sub"><?= $card_sub_3; ?></h3>
                            <?php endif; ?>
                            <?php if( $card_desc_3 ): ?>
                                <div class="product-puzzle__item-desc"><?= $card_desc_3; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
