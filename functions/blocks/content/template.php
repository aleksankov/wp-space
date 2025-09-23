<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'content';
$class = isset($block['className']) ? $block['className'] : 'default';

?>

<section class="section section-content">
    <div class="container">
        <div class="content">
            <?= "<InnerBlocks/>"
            ?>
        </div>
    </div>
</section>
