<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'banner-min-v2';
$class = isset($block['className']) ? $block['className'] : 'default';

$anim_enabled = get_field_block('banner-min-v2-anim-enabled', $block);
$anim_delay = get_field_block('banner-min-v2-anim-delay', $block);
$background = get_field_block('banner-min-v2-background', $block);
$background_mobile = get_field_block('banner-min-v2-background-mobile', $block);

$img = wp_get_attachment_image_src( $background, 'full' );
$img_mobile = wp_get_attachment_image_src( $background_mobile, 'full');
$link = get_field_block('banner-min-v2-link', $block);

if (!empty($background)&&!empty($background_mobile)) : ?>
<section class="banner-min-v2 <?= $class ?> " <?= ($anim_enabled)?(' data-aos="fade-up" '):' '?>  <?= ($anim_enabled&&!empty($anim_delay))?(' data-aos-delay="' . $anim_delay . '"'):'' ?>>
    <div class="container">
        <?php  if (!empty($link)):?>
        <a target="_blank" href="<?=$link?>">
        <picture>
            <source media="(max-width: 768px)" srcset="<?=$img_mobile[0]?>">
            <img src="<?=$img[0]?>">
        </picture>
        </a>
        <?php else :?>
            <picture>
                <source media="(max-width: 768px)" srcset="<?=$img_mobile[0]?>">
                <img src="<?=$img[0]?>">
            </picture>
        <?php endif;?>

    </div>
</section>
<?php endif; ?>
