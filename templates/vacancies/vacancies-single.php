<?php
    get_header();

    $card_id = get_the_ID();

    $title = get_the_title();
    $cities = get_the_terms( $card_id, 'vacancies_city' );

    $cities_html = false;
    if( $cities ){
        foreach( $cities as $city ){
            $cities_arr[] = $city->name;
        }
        $cities_html = implode(', ', $cities_arr);
    }

    $content = get_the_content();

    $vacancy_salary = get_field('vacancy_salary');
    $vacancy_grade = get_field('vacancy_grade');
    $vacancy_format = get_field('vacancy_format');
    $vacancy_work_time = get_field('vacancy_work_time');
    $vacancy_hh = get_field('vacancy_hh');
?>

<section class="vacancy">
    <div class="container">
        <div class="vacancy__back">
            <a class="back-btn" href="<?= get_home_url(); ?>/vacancies/">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/back-btn-icon.svg" alt="Back">
                <span>Назад</span>
            </a>
        </div>
        <div class="vacancy__wrap">
            <div class="vacancy__row row-lg">
                <div class="vacancy__left col-lg">
                    <h1 class="vacancy__title h3"><?= $title; ?></h1>
                    <div class="vacancy__info js-vacancy-mob-top">
                        <div class="vacancy__info-block">
                            <h2 class="vacancy__info-title h4">Условия</h2>
                            <div class="vacancy__info-list">
                                <?php if( $cities_html ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-1.svg" alt="City">
                                            <span>Город</span>
                                        </span>
                                        <b><?= $cities_html; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_salary ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-2.svg" alt="Pay">
                                            <span>Зарплата</span>
                                        </span>
                                        <b><?= $vacancy_salary; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_grade ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-3.svg" alt="Grade">
                                            <span>Грейд</span>
                                        </span>
                                        <b><?= $vacancy_grade; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_format ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-4.svg" alt="Format">
                                            <span>Формат работы</span>
                                        </span>
                                        <b><?= $vacancy_format; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_work_time ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-5.svg" alt="Calendar">
                                            <span>График</span>
                                        </span>
                                        <b><?= $vacancy_work_time; ?></b>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="vacancy__info-btn">
                                <a class="btn js-anchor" href="#feedback">Откликнуться</a>
                            </div>
                        </div>
                    </div>
                    <?php if( $content ): ?>
                        <div class="vacancy__content main-text main-text--small"><?= $content; ?></div>
                    <?php endif; ?>
                    <?php
                        $site_vacancy_form_title = get_field('site_vacancy_form_title', 'option');
                        $site_vacancy_form_desc = get_field('site_vacancy_form_desc', 'option');
                        $site_forms_vacancies_agree = get_field('site_forms_vacancies_agree', 'option');

                        if( $vacancy_hh ){
                            $site_vacancy_form_desc = str_replace('{{hh}}', $vacancy_hh, $site_vacancy_form_desc);
                        }else{
                            $site_vacancy_form_desc = false;
                        }

                        if( $site_vacancy_form_title ):
                    ?>
                        <div class="vacancy__form section">
                            <div class="vacancy__form-header js-vacancy-mob-bottom" id="feedback">
                                <h2 class="vacancy__form-title"><?= $site_vacancy_form_title; ?></h2>
                                <?php if( $site_vacancy_form_desc ): ?>
                                    <div class="vacancy__form-desc"><?= $site_vacancy_form_desc; ?></div>
                                <?php endif; ?>
                            </div>
                            <form class="vacancy-feedback__form ajax-wrap js-form">
                                <div class="vacancy-feedback__form-row ajax-wrap__item">
                                    <div class="vacancy-feedback__form-col vacancy-feedback__form-col--full">
                                        <div class="form-input">
                                            <label>
                                                <input class="js-form-input js-feedback-input" type="text" name="name">
                                                <span>Имя и фамилия</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="vacancy-feedback__form-col">
                                        <div class="form-input">
                                            <label>
                                                <input class="js-form-input js-tel-input js-feedback-input" type="text" name="phone">
                                                <span>Номер телефона</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="vacancy-feedback__form-col">
                                        <div class="form-input">
                                            <label>
                                                <input class="js-form-input js-feedback-input" type="text" name="email">
                                                <span>Электронный адрес</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="vacancy-feedback__form-col vacancy-feedback__form-col--full vacancy-feedback__form-col--lg">
                                        <div class="form-file js-form-file">
                                            <input class="js-form-file-input js-feedback-input" type="file" accept=".pdf, .doc, .docx" id="formFile" name="file">
                                            <label class="form-file__block js-form-file-block" for="formFile">
                                                <div class="form-file__icon">
                                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/form-file-icon.svg" alt="File">
                                                </div>
                                                <div class="form-file__sub">Перетащите файл сюда</div>
                                                <div class="form-file__desc">Или <span>нажмите для загрузки файла</span></div>
                                                <div class="form-file__accept">Форматы: docx, doc, pdf. До 3 Мб.</div>
                                            </label>
                                            <div class="form-file__name js-form-file-name-wrap">
                                                <span class="js-form-file-name"></span>
                                                <button class="js-form-file-remove" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M18 6L6 18M6 6L18 18" stroke="#946AD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vacancy-feedback__form-col vacancy-feedback__form-col--full vacancy-feedback__form-col--lg">
                                        <div class="form-input">
                                            <label>
                                                <textarea class="js-form-input js-textarea js-feedback-input" maxlength="300" name="msg"></textarea>
                                                <span>Напишите о себе</span>
                                                <div class="form-input__counter js-textarea-counter">0/300</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="vacancy-feedback__agree ajax-wrap__item">
                                    <div class="main-checkbox">
                                        <label>
                                            <input type="checkbox" class="js-feedback-input" name="agree">
                                            <span><?= $site_forms_vacancies_agree; ?></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="vacancy-feedback__btn ajax-wrap__item">
                                    <button class="btn" type="submit">Отправить</button>
                                </div>
                                <input type="hidden" name="specialization" value="<?= $title; ?>">
                                <input type="hidden" name="form_name" value="Отклик на вакансию: <?= $title; ?>">
                                <input type="hidden" name="to" value="<?= $site_feedback_hr_email; ?>">
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="vacancy__right col-lg js-vacancy-info-wrap">
                    <div class="vacancy__info js-vacancy-info">
                        <div class="vacancy__info-block">
                            <h2 class="vacancy__info-title h4">Условия</h2>
                            <div class="vacancy__info-list">
                                <?php if( $cities_html ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-1.svg" alt="City">
                                            <span>Город</span>
                                        </span>
                                        <b><?= $cities_html; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_salary ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-2.svg" alt="Pay">
                                            <span>Зарплата</span>
                                        </span>
                                        <b><?= $vacancy_salary; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_grade ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-3.svg" alt="Grade">
                                            <span>Грейд</span>
                                        </span>
                                        <b><?= $vacancy_grade; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_format ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-4.svg" alt="Format">
                                            <span>Формат работы</span>
                                        </span>
                                        <b><?= $vacancy_format; ?></b>
                                    </div>
                                <?php endif; ?>
                                <?php if( $vacancy_work_time ): ?>
                                    <div class="vacancy__info-item">
                                        <span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/vacancy-info-icon-5.svg" alt="Calendar">
                                            <span>График</span>
                                        </span>
                                        <b><?= $vacancy_work_time; ?></b>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="vacancy__info-btn">
                                <a class="btn js-anchor" href="#feedback">Откликнуться</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vacancy__mob-btn js-vacancy-mob-btn">
                <a class="btn js-anchor" href="#feedback">Откликнуться</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>