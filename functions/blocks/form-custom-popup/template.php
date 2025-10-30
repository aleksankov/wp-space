<?php
global $site_feedback_main_email;
$site_forms_agree = get_field('site_forms_agree', 'option');
$block = $args['block'] ?? null;
$id = isset($block) ? (array_key_exists('anchor', $block) && $block['anchor'] ? $block['anchor'] : $block['id']) : 'form-custom';
$class = isset($block['className']) ? $block['className'] : 'default';
$anim_enabled = get_field_block('form-custom-popup-anim-enabled', $block);
$anim_delay = get_field_block('form-custom-popup-anim-delay', $block);
$anim_delay = get_field_block('form-custom-popup-anim-delay', $block);
$title = get_field_block('form-custom-popup-title', $block);
$title_form = get_field_block('form-custom-popup-title-form', $block);
$fields = get_field_block('form-custom-popup-fields', $block);

$form_id = get_field_block('form-custom-popup-id', $block)
?>


    <div class="main-popup main-popup--simple" id="<?=$form_id?>">
        <button class="main-popup__close" type="button" data-fancybox-close>
            <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
        </button>
        <div class="main-popup__wrap">
            <div class="main-popup__right">
                <form class="main-popup__form ajax-wrap js-form-custom">
                    <div class="main-popup__form-title"><?=$title?></div>
                    <div class="main-popup__form-list ajax-wrap__item">
                        <?php foreach ($fields as $field): ?>

                            <?php switch ($field['form-custom-popup-fields-type']) {
                                case 'text':
                                case 'tel':
                                case 'email': ?>

                                    <div class="main-popup__form-col">
                                        <div class="main-input">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-popup-fields-name'] ?>][title]" value="<?= $field['form-custom-popup-fields-placeholder'] ?>">

                                                <input
                                                    <?= $field['form-custom-fields-popup-required']?"data-required" : "" ?>
                                                        data-validate="empty"
                                                        class="js-form-input <?=$field['form-custom-popup-fields-type']==='tel'?'js-tel-input':' '?>  js-feedback-input"
                                                        type="<?= $field['form-custom-popup-fields-type'] ?>"
                                                        name="custom_field[<?= $field['form-custom-popup-fields-name'] ?>][value]">
                                                <span><?=$field['form-custom-popup-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>

                                    <?php break; ?>
                                <?php case 'textarea': ?>
                                    <div class="main-popup__form-col main-popup__form-col--lg">
                                        <div class="main-input">
                                            <label>
                                                <input type="hidden" name="custom_field[<?= $field['form-custom-popup-fields-name'] ?>][title]" value="<?= $field['form-custom-popup-fields-placeholder'] ?>">

                                                <textarea
                                                        class="js-form-input js-feedback-input"
                                                        <?= $field['form-custom-fields-popup-required']?"data-required" : "" ?>
                                                        name="custom_field[<?= $field['form-custom-popup-fields-name'] ?>]['value]"></textarea>
                                                <span><?= $field['form-custom-popup-fields-placeholder'] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php case 'select': ?>
                                    <div class="main-popup__form-col">
                                        <div class="main-select">
                                            <input type="hidden"  name="custom_field[<?= $field['form-custom-popup-fields-name'] ?>][title]" value="<?= $field['form-custom-popup-fields-placeholder'] ?>">
                                            <select
                                                    data-validate="select"
                                                    class="js-select js-select-custom-field"
                                                <?= $field['form-custom-fields-popup-required']?"data-required" : "" ?>
                                                    name=" [<?= $field['form-custom-popup-fields-name'] ?>][value]">
                                                <option value="0">&nbsp;</option>
                                                <?php foreach ($field['form-custom-popup-fields-variants'] as $variant): ?>
                                                    <option <?= !empty($variant['form-custom-popup-fields-variants-email'])? ('data-email="'. $variant['form-custom-popup-fields-variants-email'].'"'):''?> value="<?= $variant['form-custom-popup-fields-variants-text'] ?>"><?= $variant['form-custom-popup-fields-variants-text'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="js-select-toggle"><?= $field['form-custom-popup-fields-placeholder'] ?> </span>
                                            <?php if(!empty($variant['form-custom-popup-fields-variants-email'])):?>
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

