<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'comments';
$class = isset($block['className']) ? $block['className'] : 'default';

$comment = get_field_block('comment', $block);
$section_title = get_field_block('section_title', $block);

?>

<section class="comments <?= $class ?> section aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
    <div class="container">
        <div class="cases-content__title h2"><?= $section_title; ?></div>
        <div class="cases-content__comment">
            <?php foreach ($comment as $index => $item): ?>
                <div class="cases-content__item">
                    <div class="cases-content__comment-title h4"><?= $item['title']; ?></div>
                    <div class="cases-content__comment-subtitle h7"><?= $item['subtitle']; ?></div>
                    <p class="cases-content__comment-text main-text main-text--small"><?= $item['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
