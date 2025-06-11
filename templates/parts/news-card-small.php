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
        $img = kama_thumb_src( 'wh=1054:1018', $thumbnail_id );
    }else{
        $thumbnail_id = false;
    }

    $date = get_the_date('d F Y', $card_id);
?>
<a class="h-news-card" href="<?= $permalink; ?>">
    <div class="h-news-card__tag">
        <span><?= $date; ?></span>
    </div>
    <?php //if( $thumbnail_id ): ?>
    <!--    <div class="h-news-card__img">-->
    <!--        <img src="--><?php //= $img; ?><!--" alt="--><?php //= $title; ?><!--">-->
    <!--    </div>-->
    <?php //endif; ?>
    <div class="h-news-card__sub"><?= $title; ?></div>
</a>