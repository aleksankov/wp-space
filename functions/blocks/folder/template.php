<?php
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'folder';
$class = isset($block['className']) ? $block['className'] : 'default';

$anim_enabled = get_field_block('folder-anim-enabled', $block);
$anim_delay = get_field_block('folder-anim-delay', $block);
$title = get_field_block('folder-title', $block);
$folders = get_field_block('folder-folders', $block);
//if (!empty($title)) : ?>

    <section
            class="folder <?= $class ?> " <?= ($anim_enabled) ? (' data-aos="fade-up" ') : ' ' ?>  <?= ($anim_enabled && !empty($anim_delay)) ? (' data-aos-delay="' . $anim_delay . '"') : '' ?>>
        <div class="container">

            <h2 class="folder__title">
              <?=$title?>
            </h2>
            <div class="folder__wrapper">

                <?php foreach($folders as $key => $folder) :
                    $img = wp_get_attachment_image( $folder['folder-folders-thumb'], 'medium', false, array('class' => 'folder-item__img') );
                    ?>



                <div class="folder-item" data-aos="fade-up" data-aos-delay="<?= $key * 100 ?>">
                    <div class="folder-item__header">
                        <?= $img?>
                        <div class="folder-item__title">
                            <div class="folder-item__angle folder-item__angle--top">
                            </div>
                            <span><?= $folder['folder-folders-title-small']?></span>
                            <div class="folder-item__angle folder-item__angle--right">
                            </div>
                        </div>
                    </div>
                    <div class="folder-item__content">
                        <h4>
                            <?= $folder['folder-folders-title']?>
                        </h4>
                        <p>
                            <?= $folder['folder-folders-content']?>

                        </p>


                    </div>

                </div>
                <?php endforeach; ?>
            </div>


        </div>
    </section>
<?php //endif; ?>