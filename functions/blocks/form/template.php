<?php
    global $site_feedback_main_email;
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
            <form class="product-feedback__form ajax-wrap js-form">
                <div class="product-feedback__row ajax-wrap__item">
                    <?php if( $form_product_options ): ?>
                        <div class="product-feedback__col">
                            <div class="main-select main-select--transparent">
                                <select class="js-select js-feedback-input" name="product"><?= $form_product_options; ?></select>
                                <span class="js-select-toggle">Выберите продукт</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $form_partner_options ): ?>
                        <div class="product-feedback__col">
                            <div class="main-select main-select--transparent">
                                <select class="js-select js-feedback-input js-partner-select" name="partner"><?= $form_partner_options; ?></select>
                                <span class="js-select-toggle">Выберите партнёра</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product-feedback__col">
                        <div class="main-input">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="name">
                                <span>Имя и фамилия</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="company">
                                <span>Организация</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                <span>Номер телефона</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col">
                        <div class="main-input main-input--transparent">
                            <label>
                                <input class="js-form-input js-feedback-input" type="text" name="email">
                                <span>E-mail</span>
                            </label>
                        </div>
                    </div>
                    <div class="product-feedback__col product-feedback__col--lg">
                        <div class="main-input main-input--transparent">
                            <label>
                                <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                <span>Комментарий</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="product-feedback__bottom ajax-wrap__item">
                    <div class="product-feedback__agree">* Отправляя заявку, вы соглашаетесь с условиями <br><a href="privacy-policy.html" target="_blank">политики обработки персональных данных</a></div>
                    <div class="product-feedback__btn">
                        <button class="btn btn-white" type="submit">Отправить</button>
                    </div>
                    <input type="hidden" name="form_name" value="Заявка на демо-версию">
                    <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                </div>
            </form>
            <div class="product-feedback__mob-btn">
                <a class="btn btn-white" href="#demo-popup" data-fancybox="" data-touch="false">Продолжить</a>
            </div>
        </div>
    </div>
</section>
