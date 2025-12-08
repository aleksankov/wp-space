<?php
$card_id = get_the_ID();
$cart_short_text = get_field('text', $card_id);
$cart_logo = get_field('logo', $card_id);
$cart_labels = wp_get_post_terms($card_id, 'case_tags');
?>
<a class="cases-card" href="<?php the_permalink(); ?>">
    <?php if ($cart_logo) : ?>
        <div class="cases-card__logo">
            <img src="<?php echo esc_url($cart_logo['url']); ?>"
                 alt="<?php echo esc_attr($cart_logo['alt']); ?>">
        </div>
    <?php endif; ?>

    <div class="cases-card__content">
        <div class="cases-card__sub h3"><?php the_title(); ?></div>
        <div class="cases-card__sub h7"><?= $cart_short_text; ?></div>

        <?php if (!empty($cart_labels) && !is_wp_error($cart_labels)) : ?>
            <div class="cases-card__labels">
                <?php foreach ($cart_labels as $label) : ?>
                    <span class="cases-card__label"><?php echo esc_html($label->name); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</a>
