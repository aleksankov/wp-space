<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'banner-min';
$class = isset($block['className']) ? $block['className'] : 'default';

$anim_enabled = get_field_block('banner-min-anim-enabled', $block);
$anim_delay = get_field_block('banner-min-anim-delay', $block);
$background = get_field_block('banner-min-background', $block);
$title = get_field_block('banner-min-title', $block);
$text = get_field_block('banner-min-text', $block);
$link = get_field_block('banner-min-link', $block);
$background_src = kama_thumb_src('wh=1920:1080', $background);
if (!empty($background)&&!empty($title)&&!empty($text)) : ?>
<section class="banner-min <?= $class ?> " <?= ($anim_enabled)?(' data-aos="fade-up" '):' '?>  <?= ($anim_enabled&&!empty($anim_delay))?(' data-aos-delay="' . $anim_delay . '"'):'' ?>>
    <div class="container">
        <div class="banner-min__wrapper" style="background-image: url('<?= $background_src ?>')">
            <h2 class="banner-min__title"><?= $title ?></h2>
            <div class="banner-min__text"><?= $text ?></div>
            <?php if (!empty($link)):?>
            <a class="banner-min__link"  target="_blank" href="<?=$link?>">
                <svg width="84" height="84" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="56" height="56" rx="28" fill="#FBFAFD"/>
                    <path d="M23 33L33 23M33 23H23M33 23V33" stroke="#946AD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
              <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
