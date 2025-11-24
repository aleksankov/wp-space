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
        $img = kama_thumb_src( 'wh=620:400', $thumbnail_id );
    }else{
        $thumbnail_id = false;
    }

    $date = get_the_date('d F Y', $card_id);
?>
<a class="news-card news-card-blog" href="<?= $permalink; ?>">
    <div class="news-card__info">
        <div class="news-card__sub"><?= $title; ?></div>
        <div class="news-card__date"><?= $date; ?></div>
    </div>
</a>
