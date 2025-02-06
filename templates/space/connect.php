<?php
    get_header();
?>

<?php
    $connect_hero_title = get_field('connect_hero_title');
    $connect_hero_desc = get_field('connect_hero_desc');
    $connect_hero_btn_label = get_field('connect_hero_btn_label');
    $connect_hero_img = get_field('connect_hero_img');

    if( $connect_hero_title ):
?>
    <section class="connect-hero" data-aos="fade-up">
        <div class="container">
            <div class="connect-hero__wrap">
                <div class="connect-hero__img">
                    <img src="<?= kama_thumb_src( 'wh=882:826', $connect_hero_img ); ?>" alt="<?php the_title(); ?>">
                </div>
                <div class="connect-hero__content">
                    <h1 class="connect-hero__title"><?= $connect_hero_title; ?></h1>
                    <?php if( $connect_hero_desc ): ?>
                        <div class="connect-hero__desc"><?= $connect_hero_desc; ?></div>
                    <?php endif; ?>
                    <?php if( $connect_hero_btn_label ): ?>
                        <div class="connect-hero__btn">
                            <a class="btn" href="#tech-partner-popup" data-fancybox="" data-touch="false"><?= $connect_hero_btn_label; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    $connect_matrix_title = get_field('connect_matrix_title');
?>
<section class="matrix section">
    <div class="container">
        <?php if( $connect_matrix_title ): ?>
            <h2 class="matrix__title" data-aos="fade-up"><?= $connect_matrix_title; ?></h2>
        <?php endif; ?>
        <div class="matrix__wrap ajax-wrap">
            <div class="matrix__filters js-matrix-filter" data-aos="fade-up">
                <div class="matrix__filters-row">
                    <div class="matrix__filter-col">
                        <div class="matrix__filter-item">
                            <div class="filter-select">
                                <select class="js-select">
                                    <option value="0">&nbsp;</option>
                                    <option value="1">Направление 1</option>
                                    <option value="2">Направление 2</option>
                                    <option value="3">Направление 3</option>
                                </select>
                                <span class="js-select-toggle">Направления</span>
                            </div>
                        </div>
                    </div>
                    <div class="matrix__filter-col">
                        <div class="matrix__filter-item">
                            <div class="filter-select">
                                <select class="js-select">
                                    <option value="0">&nbsp;</option>
                                    <option value="1">SpaceVM</option>
                                    <option value="2">Space VDI</option>
                                    <option value="3">Space Client</option>
                                </select>
                                <span class="js-select-toggle">Совместимость</span>
                            </div>
                        </div>
                    </div>
                    <div class="matrix__filter-col">
                        <div class="matrix__filter-item">
                            <div class="filter-select">
                                <select class="js-select">
                                    <option value="0">&nbsp;</option>
                                    <option value="1">SPACE VM 6.5.1</option>
                                    <option value="2">SPACE VM 6.5.2</option>
                                    <option value="3">SPACE VM 6.5.3</option>
                                </select>
                                <span class="js-select-toggle">Версии</span>
                            </div>
                        </div>
                    </div>
                    <div class="matrix__filter-col">
                        <div class="matrix__filter-item">
                            <div class="filter-select">
                                <select class="js-select">
                                    <option value="0">&nbsp;</option>
                                    <option value="1">Вендор 1</option>
                                    <option value="2">Вендор 2</option>
                                    <option value="3">Вендор 3</option>
                                </select>
                                <span class="js-select-toggle">Вендор</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="matrix__filters-apply">
                    <button class="btn js-matrix-filter-apply" type="button">Применить</button>
                </div>
            </div>
            <div class="matrix__filters-btn">
                <button class="filter-btn js-matrix-filter-open" type="button">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/filter-icon.svg" alt="Filter">
                    <span>Фильтры</span>
                </button>
            </div>
            <div class="matrix__content">
                <div class="matrix__row row-lg">
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                    <div class="matrix__col col-lg" data-aos="fade-up">
                        <a class="matrix-card" href="#matrix-popup" data-fancybox="" data-touch="false">
                            <div class="matrix-card__img">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-card-img.jpg" alt="#">
                            </div>
                            <div class="matrix-card__info">
                                <div class="matrix-card__sub">Сервер Delta Tioga Pass</div>
                                <div class="matrix-card__desc">Серверные решения</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="matrix__more">
                    <button class="btn" type="button">Показать ещё</button>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="matrix-popup" id="matrix-popup">
    <button class="matrix-popup__close" type="button" data-fancybox-close>
        <img src="<?= get_template_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close">
    </button>
    <div class="matrix-popup__wrap">
        <div class="matrix-popup__info">
            <div class="matrix-popup__title h5">Сервер Delta Tioga Pass</div>
            <div class="matrix-popup__desc">Серверные решения</div>
            <div class="matrix-popup__img">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/matrix-popup-img.jpg" alt="#">
            </div>
            <div class="matrix-popup__select">
                <div class="filter-select main-scroll">
                    <select class="js-select js-select-scroll">
                        <option value="0">&nbsp;</option>
                        <option value="1" selected>SPACE VM 6.5.1</option>
                        <option value="2">SPACE VM 6.5.2</option>
                        <option value="3">SPACE VM 6.5.3</option>
                        <option value="4">SPACE VM 6.5.4</option>
                        <option value="5">SPACE VM 6.5.5</option>
                        <option value="6">SPACE VM 6.5.6</option>
                        <option value="7">SPACE VM 6.5.7</option>
                        <option value="8">SPACE VM 6.5.8</option>
                        <option value="9">SPACE VM 6.5.9</option>
                        <option value="10">SPACE VM 6.6.1</option>
                        <option value="11">SPACE VM 6.6.2</option>
                        <option value="12">SPACE VM 6.6.3</option>
                        <option value="13">SPACE VM 6.6.4</option>
                        <option value="14">SPACE VM 6.6.5</option>
                        <option value="15">SPACE VM 6.6.6</option>
                    </select>
                    <span class="js-select-toggle">Версия</span>
                </div>
            </div>
            <div class="matrix-popup__models">
                <div class="matrix-popup__models-sub">Список моделей оборудования</div>
                <div class="matrix-popup__models-list">
                    <ul>
                        <li>Модель 1</li>
                        <li>Модель 2</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>