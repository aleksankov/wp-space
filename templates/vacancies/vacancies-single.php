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

<section class="breadcrumbs-wrap">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <div class="breadcrumbs-wrapper">
                <?php yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

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
                            <?php
                            $vacancy_form_config = space_form_get_option_source_config('site_vacancy_form_block', [
                                'mode' => 'inline',
                                'service_name' => 'Отклик на вакансию',
                                'recipient' => 'hr',
                                'agreement_mode' => 'custom',
                                'agreement_text' => $site_forms_vacancies_agree,
                                'agreement_required' => true,
                                'fields' => [
                                    ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
                                    ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
                                    ['type' => 'email', 'name' => 'email', 'label' => 'Электронный адрес', 'required' => true],
                                    ['type' => 'file', 'name' => 'resume', 'label' => 'Резюме', 'required' => false],
                                    ['type' => 'textarea', 'name' => 'msg', 'label' => 'Напишите о себе', 'required' => false, 'max_length' => 300],
                                    ['type' => 'hidden', 'name' => 'vacancy', 'label' => 'Вакансия', 'context_key' => 'vacancy_title'],
                                ],
                            ]);
                            $vacancy_form_config['service_name'] = 'Отклик на вакансию: ' . $title;
                            $vacancy_form_config['context'] = ['type' => 'vacancy', 'post_id' => $card_id];
                            foreach ($vacancy_form_config['fields'] as &$vacancy_field) {
                                if ($vacancy_field['name'] === 'specialization') {
                                    $vacancy_field['type'] = 'hidden';
                                    $vacancy_field['context_key'] = 'vacancy_title';
                                }
                            }
                            unset($vacancy_field);
                            ?>
                            <form class="vacancy-feedback__form ajax-wrap js-form-custom" enctype="multipart/form-data" novalidate>
                                <div class="vacancy-feedback__form-row ajax-wrap__item">
                                    <?php space_form_render_fields($vacancy_form_config, 'vacancy'); ?>
                                </div>
                                <?php space_form_render_agreement($vacancy_form_config, 'vacancy-feedback__agree'); ?>
                                <div class="vacancy-feedback__btn ajax-wrap__item">
                                    <button class="btn" type="submit"><?= esc_html($vacancy_form_config['submit_label']); ?></button>
                                </div>
                                <?php space_form_render_security_fields($vacancy_form_config); ?>
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
