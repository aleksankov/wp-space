<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'partner-block';
$class = isset($block['className']) ? $block['className'] : 'default';
$anim_enabled = get_field_block('video-gide-anim-enabled', $block);
$anim_delay = get_field_block('video-gide-anim-delay', $block);
$partners_query = new WP_Query([
    'post_type' => 'partner',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
]);

$unique_statuses = ['Все'];
$collected_statuses = [];

if ($partners_query->have_posts()) {
    $temp_posts = $partners_query->posts;
    foreach ($temp_posts as $post) {
        setup_postdata($post);
        $status = get_field('status', $post->ID);
        if ($status && !in_array($status, $collected_statuses)) {
            $collected_statuses[] = $status;
        }
    }
    wp_reset_postdata();
}

sort($collected_statuses);
$unique_statuses = array_merge(['Все'], $collected_statuses);
?>

<section
        id="<?= esc_attr($id); ?>"
        class="partner-block <?= esc_attr($class); ?> section aos-init aos-animate" data-aos="fade-up" data-aos-delay="200"
    <?= $anim_enabled ? 'data-aos="fade-up"' : ''; ?>
    <?= ($anim_enabled && !empty($anim_delay)) ? 'data-aos-delay="' . esc_attr($anim_delay) . '"' : ''; ?>
>
    <div class="container">
        <div class="partner-block-filter">
            <ul class="partner-block-filter__list">
                <?php foreach ($unique_statuses as $status): ?>
                    <li>
                        <?php if ($status === 'Все'): ?>
                            <button class="partner-block-filter__btn active" data-filter="all">
                                <?= esc_html($status); ?>
                            </button>
                        <?php else: ?>
                            <button class="partner-block-filter__btn" data-filter="<?= esc_attr(sanitize_title($status)); ?>">
                                <?= esc_html($status); ?>
                            </button>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="partner-block-list">
            <?php if ($partners_query->have_posts()): ?>
                <?php while ($partners_query->have_posts()):
                    $partners_query->the_post();
                    $card_id = get_the_ID();
                    $card_organization = get_the_title();
                    $card_status = get_field('status', $card_id);
                    $card_description = get_field('description', $card_id);
                    $card_website = get_field('website', $card_id);
                    $card_phone = get_field('phone', $card_id);
                    $card_logo = get_field('logo', $card_id);

                    if ($card_logo && is_array($card_logo)) {
                        $card_logo_url = $card_logo['url'];
                    } elseif ($card_logo) {
                        $card_logo_url = $card_logo;
                    } else {
                        $card_logo_url = get_template_directory_uri() . '/assets/img/def-logo.svg';
                    }

                    $has_website = !empty($card_website);
                    $status_slug = $card_status ? sanitize_title($card_status) : 'other';
                    ?>

                    <?php get_template_part( 'templates/parts/partners-card' ); ?>
        <?php endwhile;?>
        <?php else: ?>
            <p>Партнёры не найдены.</p>
        <?php endif; ?>
        </div>
    </div>
</section>
