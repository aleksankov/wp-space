<?php
$card_id = get_the_ID();
$cart_short_text = get_field('text', $card_id);
$cart_logo = get_field('logo', $card_id);
$cart_labels = wp_get_post_terms($card_id, 'case_tags');

$product_id = get_field('product', $card_id);
$product_title = $product_id ? get_the_title($product_id) : '';

$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';
$current_product = isset($_GET['product']) ? sanitize_text_field($_GET['product']) : 'all';
?>
<div class="cases-card">
    <a href="<?php the_permalink(); ?>" class="cases-card__link"></a>
    <?php if ($cart_logo) : ?>
        <div class="cases-card__logo">
            <img src="<?php echo esc_url($cart_logo['url']); ?>"
                 alt="<?php echo esc_attr($cart_logo['alt']); ?>">
        </div>
    <?php endif; ?>

    <div class="cases-card__content">
        <div class="cases-card__sub h3"><?php the_title(); ?></div>
        <div class="cases-card__sub h7"><?= $cart_short_text; ?></div>

        <div class="cases-card__labels">
            <?php if ($product_title): ?>
                <a href="?filter=<?php echo $current_filter; ?>&product=<?php echo $product_id; ?>"
                   class="cases-card__label cases-card__label--product"
                   onclick="event.stopPropagation();">
                    <?php echo esc_html($product_title); ?>
                </a>
            <?php endif; ?>

            <?php foreach ($cart_labels as $label) : ?>
                <a href="?filter=<?php echo $label->term_id; ?>&product=<?php echo $current_product; ?>"
                   class="cases-card__label"
                   onclick="event.stopPropagation();">
                    <?php echo esc_html($label->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>