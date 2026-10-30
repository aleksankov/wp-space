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

<section class="breadcrumbs-wrap">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <div class="breadcrumbs-wrapper">
                <?php yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

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
                <?php
                $vacancy_form_config = space_form_get_option_source_config('site_vacancy_form_block', [
                    'mode' => 'inline',
                    'service_name' => 'Отклик на вакансию: Общая',
                    'recipient' => 'hr',
                    'agreement_mode' => 'custom',
                    'agreement_text' => $site_forms_vacancies_agree,
                    'agreement_required' => true,
                    'fields' => [
                        ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
                        ['type' => 'text', 'name' => 'specialization', 'label' => 'Специализация', 'required' => true],
                        ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
                        ['type' => 'email', 'name' => 'email', 'label' => 'Электронный адрес', 'required' => true],
                        ['type' => 'file', 'name' => 'resume', 'label' => 'Резюме', 'required' => false],
                        ['type' => 'textarea', 'name' => 'msg', 'label' => 'Напишите о себе', 'required' => false, 'max_length' => 300],
                    ],
                ]);
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
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
