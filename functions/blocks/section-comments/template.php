<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'comments';
$class = isset($block['className']) ? $block['className'] : 'default';

$section_comments = get_field_block('section-comments', $block);
?>

<section class="cases__section-comments <?= $class ?> section aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
    <div class="container">
        <div class="cases__section-comments-title h2"><?= $section_comments['title']; ?></div>
        <div class="cases__section-comments-text"><?= $section_comments['text']; ?></div>
    </div>
</section>
