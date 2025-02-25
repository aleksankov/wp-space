<?php
    global $form_product_options;
    global $form_partner_options;

    $title = get_field('title');
?>

<section class="product-feedback section">
    <div class="container">
        <div class="product-feedback__wrap" data-aos="fade-up">
            <div class="product-feedback__bg">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-feedback-bg-1.jpg" alt="#">
            </div>
            <?php if( $title ): ?>
                <h2 class="product-feedback__title"><?= $title; ?></h2>
            <?php endif; ?>
            <div class="product-feedback__form">
                <div class="product-feedback__row">
                    <?php if( $form_product_options ): ?>
                        <div class="product-feedback__col">
                            <div class="main-select main-select--transparent">
                                <select class="js-select"><?= $form_product_options; ?></select>
                                <span class="js-select-toggle">Выберите продукт</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $form_partner_options ): ?>
                        <div class="product-feedback__col">
                            <div class="main-select main-select--transparent">
                                <select class="js-select"><?= $form_partner_options; ?></select>
                                <span class="js-select-toggle">Выберите партнёра</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product-feedback__col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input" type="text">
                                <span>Имя и фамилия</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input" type="text">
                                <span>Организация</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input js-tel-input" type="text">
                                <span>Номер телефона</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input" type="text">
                                <span>E-mail</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col product-feedback__col--lg">
                        <div class="main-input main-input--transparent">
                            <label>
                                <textarea class="js-form-input"></textarea>
                                <span>Комментарий</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="product-feedback__bottom">
                    <div class="product-feedback__agree">* Отправляя заявку, вы соглашаетесь с условиями <br><a href="privacy-policy.html" target="_blank">политики обработки персональных данных</a></div>
                    <div class="product-feedback__btn">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                </div>
            </div>
            <div class="product-feedback__mob-btn">
                <a class="btn btn-white" href="#demo-popup" data-fancybox="" data-touch="false">Продолжить</a>
            </div>
        </div>
    </div>
</section>
