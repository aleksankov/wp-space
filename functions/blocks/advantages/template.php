<?php
    $title = get_field('title');
    $desc = get_field('desc');
    $card_count = get_field('card_count');
    $cards = get_field('cards');
?>

<section class="product-advantages<?= $card_count == 2 ? ' product-advantages--vm' : ' product-advantages--vdi'; ?> section">
    <div class="container">
        <div class="product-advantages__header">
            <?php if( $title ): ?>
                <h2 class="product-advantages__title" data-aos="fade-up"><?= $title; ?></h2>
            <?php endif; ?>
            <?php if( $desc ): ?>
                <div class="product-advantages__desc" data-aos="fade-up" data-aos-delay="200"><?= $desc; ?></div>
            <?php endif; ?>
        </div>
        <div class="product-advantages__row row">
            <?php $bg_counter = 1; $counter = 0; foreach( $cards as $card ): if( $counter == $card_count ) $counter = 0; ?>
                <div class="product-advantages__col col" data-aos="fade-up" data-aos-delay="<?= $counter * 200; ?>">
                    <div class="product-advantages__item">
                        <?php if( $card['bg'] ): ?>
                            <div class="product-advantages__item-bg">
                                <?php if( $card_count == 2 ): ?>
                                    <img src="<?= kama_thumb_src( 'wh=1184:738', $card['bg'] ); ?>" alt="Advantages - BG <?= $bg_counter; ?>">
                                <?php else: ?>
                                    <img src="<?= kama_thumb_src( 'wh=778:890', $card['bg'] ); ?>" alt="Advantages - BG <?= $bg_counter; ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="product-advantages__item-content">
                            <?php if( $card['title'] ): ?>
                                <h3 class="product-advantages__item-sub"><?= $card['title']; ?></h3>
                            <?php endif; ?>
                            <?php if( $card['desc'] ): ?>
                                <div class="product-advantages__item-desc"><?= $card['desc']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php $bg_counter++; $counter++; endforeach; ?>
        </div>
    </div>
</section>
