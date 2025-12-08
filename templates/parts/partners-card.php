<?php

$card_id = get_the_ID();
$card_organization = get_field('organization', $card_id);
$card_status = get_field('status', $card_id);
$card_description = get_field('description', $card_id);
$card_website = get_field('website', $card_id);
$card_phone = get_field('phone', $card_id);
$card_logo = get_field('logo', $card_id);

if( false && $card_logo ){
    $card_logo_url = wp_get_upload_dir()['baseurl'] . '/vendors_logo/' . $card_logo;
}elseif( $card_logo ){
    $card_logo_url = $card_logo;
}else{
    $card_logo_url = get_template_directory_uri() . '/assets/img/def-logo.svg';
}

$status_slug = $card_status ? sanitize_title($card_status) : 'other';
?>

<div class="partner-card" data-status="<?= esc_attr($status_slug); ?>">
    <a href="<?= $card_website; ?>" class="partner-card__link"></a>

    <div class="partner-card__content">
        <div class="partner-card__content-title">
            <?php if ($card_organization): ?>
                <h4 class="partner-card__title"><?= esc_html($card_organization); ?></h4>
            <?php endif; ?>

            <div class="partner-card__logo">
                <img src="<?= esc_url($card_logo_url); ?>" alt="<?= esc_attr($card_organization ?: 'Партнёр'); ?>" loading="lazy">
            </div>
        </div>

        <?php if ($card_description): ?>
            <div class="partner-card__desc"><?= $card_description; ?></div>
        <?php endif; ?>
    </div>

    <div class="partner-card__contacts">
        <?php if ($card_phone): ?>
            <div class="partner-card__phone">
                Телефон: <?= esc_html($card_phone); ?>
            </div>
        <?php endif; ?>

        <?php if ($card_phone): ?>
            <div class="partner-card__site">
                Сайт партнера: <?= esc_html($card_website); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

