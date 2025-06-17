<?php
    if( isset($args['card_id']) && $args['card_id'] ){
        $card_id = $args['card_id'];
    }else{
        $card_id = get_the_ID();
    }

    $title = get_the_title($card_id);
    $permalink = get_the_permalink($card_id);
    
    if( has_post_thumbnail($card_id) ){
        $thumbnail_id = get_post_thumbnail_id($card_id);
        $img = kama_thumb_src( 'wh=1374:828', $thumbnail_id );
    }else{
        $thumbnail_id = false;
    }

    $date = get_the_date('d F Y', $card_id);
?>
<a class="h-news-lg-card" href="<?= $permalink; ?>">
    <div class="h-news-lg-card__img">
        <?php if( $thumbnail_id ): ?>
            <img src="<?= $img; ?>" alt="<?= $title; ?>">
        <?php endif; ?>
    </div>
    <div class="h-news-lg-card__content">
        <div class="h-news-lg-card__wrap">
            <div class="h-news-lg-card__tag">
                <div class="h-news-lg-card__tag-item">
                    <span><?= $date; ?></span>
                </div>
            </div>
            <div class="h-news-lg-card__sub h5"><?= $title; ?></div>
        </div>
    </div>
</a>