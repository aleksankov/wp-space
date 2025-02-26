<?php
    get_header();

    $taxonomy = 'vacancies_city';
    $is_tax = is_tax();

    $terms = get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
        'orderby' => 'description',
        'order' => 'ASC'
    ) );

    if( $is_tax ){
        $term_slug = get_query_var( 'term' );
        $cur_term = get_term_by( 'slug', $term_slug, $taxonomy );
    }else{
        $cur_term = false;
    }

    $args = array(
        'post_type' => 'vacancies',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    if( $cur_term ){
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $cur_term->term_id,
            ),
        );
    }

    $query = new WP_Query( $args );

    $post_found = $query->found_posts;
?>

<section class="vacancies">
    <div class="container">
        <?php if( $query->have_posts() ): ?>
            <div class="vacancies__header">
                <h1 class="vacancies__title h2" data-aos="fade-up"><span><?= num_word($post_found, ['вакансия', 'вакансии', 'вакансий']); ?></span> в Space</h1>
                <div class="vacancies__filter" data-aos="fade-up" data-aos-delay="200">
                    <div class="filter-select filter-select--full">
                        <select class="js-select js-vacancies-city">
                            <option value="<?= get_home_url(); ?>/vacancies/"<?= !$cur_term ? ' selected' : ''; ?>>Все города</option>
                            <?php if( $terms ): ?>
                                <?php foreach( $terms as $term ): ?>
                                    <option value="<?= get_term_link( $term->term_id ); ?>"<?= $cur_term && $term->term_id == $cur_term->term_id ? ' selected' : ''; ?>><?= $term->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span class="js-select-toggle">Город</span>
                    </div>
                </div>
            </div>
            <div class="vacancies__row row-lg" data-aos="fade-up" data-aos-delay="400">
                <?php while( $query->have_posts() ): $query->the_post(); ?>
                    <?php get_template_part( 'templates/parts/vacancy-card' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php if( false ): ?>
                <div class="vacancies__more">
                    <button class="more-btn" type="button">Показать ещё</button>
                </div>
                <div class="vacancies__pagination main-pagination">
                    <span>1</span>
                    <a href="news.html">2</a>
                    <a href="news.html">3</a>
                    <a href="news.html">4</a>
                    <a href="news.html">5</a>
                    <a class="main-pagination__btn" href="news.html">Дальше</a>
                </div>
                <div class="vacancies__pagination main-pagination-mob">
                    <span>1</span>
                    <a href="news.html">2</a>
                    <a href="news.html">3</a>
                    <a href="news.html">4</a><i>...</i>
                    <a href="news.html">124</a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h1 class="h2">Вакансий пока нет.</h1>
        <?php endif; ?>
    </div>
</section>

<?php
    $site_vacancies_form_title = get_field('site_vacancies_form_title', 'option');
    $site_vacancies_form_desc = get_field('site_vacancies_form_desc', 'option');
    $site_forms_vacancies_agree = get_field('site_forms_vacancies_agree', 'option');

    if( $site_vacancies_form_title ):
?>
    <section class="vacancy-feedback section">
        <div class="container">
            <div class="vacancy-feedback__wrap" data-aos="fade-up">
                <div class="vacancy-feedback__header">
                    <h2 class="vacancy-feedback__title"><?= $site_vacancies_form_title; ?></h2>
                    <?php if( $site_vacancies_form_desc ): ?>
                        <div class="vacancy-feedback__desc"><?= $site_vacancies_form_desc; ?></div>
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
                        <div class="vacancy-feedback__form-col vacancy-feedback__form-col--full">
                            <div class="form-input">
                                <label>
                                    <input class="js-form-input js-feedback-input" type="text" name="specialization">
                                    <span>Специализация</span>
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
                                    <button class="js-form-file-remove" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M18 6L6 18M6 6L18 18" stroke="#946AD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
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
                    <input type="hidden" name="form_name" value="Отклик на вакансию: Общая">
                    <input type="hidden" name="to" value="<?= $site_feedback_hr_email; ?>">
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>