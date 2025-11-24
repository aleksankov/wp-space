<?php
$card_id = get_the_ID();

$cart_short_text = get_field('text', $card_id);
//var_dump($cart_short_text);
?>
<div class="cases__col">
    <a class="cases-card" href="<?php the_permalink(); ?>">
        <div class="cases-card__sub h3"><?php the_title(); ?></div>
        <div class="cases-card__sub h7"><?= $cart_short_text; ?></div>
    </a>
</div>