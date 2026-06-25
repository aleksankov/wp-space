<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'banner-min';
$class = isset($block['className']) ? $block['className'] : 'default';
$fields = isset($args['fields']) && is_array($args['fields']) ? $args['fields'] : [];
$get_banner_min_field = static function ($field_name) use ($fields, $block) {
    if (array_key_exists($field_name, $fields)) {
        return $fields[$field_name];
    }

    return get_field_block($field_name, $block);
};

$anim_enabled = $get_banner_min_field('banner-min-anim-enabled');
$anim_delay = $get_banner_min_field('banner-min-anim-delay');
$background = $get_banner_min_field('banner-min-background');
$title = $get_banner_min_field('banner-min-title');
$text = $get_banner_min_field('banner-min-text');
$link = $get_banner_min_field('banner-min-link');
$background_src = is_numeric($background) ? wp_get_attachment_image_src((int) $background, 'full') : [ $background ];

if (!empty($background_src[0])&&!empty($title)) : ?>
<section class="banner-min <?= $class ?> " <?= ($anim_enabled)?(' data-aos="fade-up" '):' '?>  <?= ($anim_enabled&&!empty($anim_delay))?(' data-aos-delay="' . $anim_delay . '"'):'' ?>>
    <div class="container">
        <div class="banner-min__wrapper" style="background-image: url('<?= $background_src[0] ?>')">
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
