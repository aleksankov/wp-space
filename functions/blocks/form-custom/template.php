<?php
global $site_feedback_main_email;
$site_forms_agree = get_field('site_forms_agree', 'option');
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'form-custom';
$class = isset($block['className']) ? $block['className'] : 'default';
$anim_enabled = get_field_block('form-custom-anim-enabled', $block);
$anim_delay = get_field_block('form-custom-anim-delay', $block);
$title = get_field_block('form-custom-title', $block);
$title_form = get_field_block('form-custom-title-form', $block);
$fields = get_field_block('form-custom-fields', $block);

$form_id = md5(json_encode([$anim_enabled,$anim_delay,$title,$title_form,$fields]))
?>

<section class="product-feedback section <?= $class ?> " <?= ($anim_enabled) ? (' data-aos="fade-up" ') : ' ' ?>  <?= ($anim_enabled && !empty($anim_delay)) ? (' data-aos-delay="' . $anim_delay . '"') : '' ?>>
    <div class="container">
        <div class="product-feedback__wrap" data-aos="fade-up">
            <div class="product-feedback__bg">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-feedback-bg-1.jpg" alt="#">
            </div>

            <?php if ($title): ?>
                <h2 class="product-feedback__title"><?= $title; ?></h2>
            <?php endif; ?>
            <form class="product-feedback__form ajax-wrap js-form-custom">
                <div class="product-feedback__row ajax-wrap__item">
                    <?php foreach ($fields as $field): ?>

                        <?php switch ($field['form-custom-fields-type']) {
                                      case 'text':
                                      case 'tel':
                                      case 'email': ?>
                                    <div class="product-feedback__col">
                                        <div class="main-input main-input--transparent">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">
                                                <input
                                                        class="js-form-input <?=$field['form-custom-fields-type']==='tel'?'js-tel-input':' '?>  js-feedback-input"
                                                       <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                       type="<?= $field['form-custom-fields-type'] ?>" data-validate="empty"
                                                       name="custom_field[<?= $field['form-custom-fields-name'] ?>][value]">
                                                <span><?= $field['form-custom-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php break; ?>
                                <?php case 'textarea': ?>
                                    <div class="product-feedback__col product-feedback__col--lg">
                                        <div class="main-input main-input--transparent">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">
                                                <textarea
                                                        class="js-form-input"
                                                        <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                        name="custom_field[<?= $field['form-custom-fields-name'] ?>][value]"></textarea>
                                                <span><?= $field['form-custom-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php break; ?>
                            <?php case 'select': ?>
                                <div class="product-feedback__col">
                                    <div class="main-select main-select--transparent">
                                        <input type="hidden" name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">
                                        <select
                                                class="js-select js-select-custom-field"
                                            <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                name="custom_field[<?= $field['form-custom-fields-name'] ?>][value]">
                                            <option value="0">&nbsp;</option>
                                            <?php foreach ($field['form-custom-fields-variants'] as $variant): ?>
                                                <option <?= !empty($variant['form-custom-fields-variants-email'])? ('data-email="'. $variant['form-custom-fields-variants-email'].'"'):''?> value="<?= $variant['form-custom-fields-variants-text'] ?>"><?= $variant['form-custom-fields-variants-text'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="js-select-toggle"><?= $field['form-custom-fields-placeholder'] ?> </span>
                                        <?php if(!empty($variant['form-custom-fields-variants-email'])):?>
                                            <input type="hidden" name="custom_field[to][value]">
                                        <?php endif;?>
                                    </div>
                                </div>
                               
                                <?php break; ?>

                            <?php } ?>

                    <?php endforeach; ?>

                </div>
                <div class="product-feedback__bottom ajax-wrap__item">
                    <div class="product-feedback__agree">* Отправляя заявку, вы соглашаетесь с условиями <br><a
                                href="/privacy-policy" target="_blank">политики обработки персональных данных</a></div>
                    <div class="product-feedback__btn">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="<?=$title_form?>">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </div>
            </form>
            <div class="product-feedback__mob-btn">
                <a class="btn btn-white" href="#popup-<?=$form_id?>" data-fancybox="" data-touch="false">Продолжить</a>
            </div>
        </div>
    </div>

    <div class="main-popup main-popup--simple" id="popup-<?=$form_id?>">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form-custom">
                    <div class="main-popup__form-title"><?=$title?></div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php foreach ($fields as $field): ?>

                            <?php switch ($field['form-custom-fields-type']) {
                                case 'text':
                                case 'tel':
                                case 'email': ?>

                                    <div class="main-popup__form-col">
                                        <div class="main-input">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">

                                                <input
                                                       <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                       class="js-form-input <?=$field['form-custom-fields-type']==='tel'?'js-tel-input':' '?>  js-feedback-input"
                                                       type="<?= $field['form-custom-fields-type'] ?>"
                                                       name="custom_field[<?= $field['form-custom-fields-name'] ?>][value]">
                                                <span><?=$field['form-custom-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>

                                    <?php break; ?>
                                <?php case 'textarea': ?>
                                    <div class="main-popup__form-col main-popup__form-col--lg">
                                        <div class="main-input">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">

                                                <textarea
                                                        class="js-form-input js-feedback-input"
                                                        <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                        name="custom_field[<?= $field['form-custom-fields-name'] ?>]['value]"></textarea>
                                                <span><?= $field['form-custom-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php case 'select': ?>
                                    <div class="main-popup__form-col">
                                        <div class="main-select">
                                            <input type="hidden"  name="custom_field[<?= $field['form-custom-fields-name'] ?>][title]" value="<?= $field['form-custom-fields-placeholder'] ?>">
                                            <select
                                                    class="js-select js-select-custom-field"
                                                    <?= $field['form-custom-fields-required']?"data-required" : "" ?>
                                                    name="custom_field[<?= $field['form-custom-fields-name'] ?>][value]">
                                                <option value="0">&nbsp;</option>
                                                <?php foreach ($field['form-custom-fields-variants'] as $variant): ?>
                                                    <option <?= !empty($variant['form-custom-fields-variants-email'])? ('data-email="'. $variant['form-custom-fields-variants-email'].'"'):''?> value="<?= $variant['form-custom-fields-variants-text'] ?>"><?= $variant['form-custom-fields-variants-text'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="js-select-toggle"><?= $field['form-custom-fields-placeholder'] ?> </span>
                                            <?php if(!empty($variant['form-custom-fields-variants-email'])):?>
                                                <input type="hidden" name="custom_field[to][value]">
                                            <?php endif;?>
                                        </div>
                                    </div>


                                    <?php break; ?>

                                <?php } ?>

                        <?php endforeach; ?>



                    </div>
                    <?php if( $site_forms_agree ): ?>
                        <div class="main-popup__form-agree ajax-wrap__item"><?= $site_forms_agree; ?></div>
                    <?php endif; ?>
                    <div class="main-popup__form-btn ajax-wrap__item">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="<?=$title_form?>">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </form>
            </div>
        </div>
    </div>

</section>
