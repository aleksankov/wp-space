<?php
    get_header();
?>
<section class="product-hero product-hero--top product-hero--vdi" data-aos="fade-up">
    <div class="container">
        <div class="product-hero__wrap">
            <div class="product-hero__img">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-img-2.jpg" alt="#">
            </div>
            <div class="product-hero__content">
                <div class="product-hero__register">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-register-icon.svg" alt="Минцифры">
                    <a href="https://reestr.digital.gov.ru/reestr/1296490/" target="_blank">Запись в реестре российского ПО №16383</a>
                </div>
                <h1 class="product-hero__title">Виртуальные рабочие места <span>Space VDI</span></h1>
                <div class="product-hero__desc">Инструмент для создания и администрирования инфраструктуры виртуальных рабочих столов (VDI)</div>
                <div class="product-hero__bottom">
                    <div class="product-hero__btn">
                        <a class="btn" href="#buy-vdi" data-fancybox="" data-touch="false">Купить</a>
                    </div>
                    <div class="product-hero__btn">
                        <a class="btn btn-transparent" href="#demo-vdi" data-fancybox="" data-touch="false">Протестировать</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-puzzle section">
    <div class="container">
        <h2 class="product-puzzle__title" data-aos="fade-up">Состав продукта <span>Space VDI</span></h2>
        <div class="product-puzzle__wrap" data-aos="fade-up">
            <div class="product-puzzle__bg">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-puzzle-bg.png" alt="Puzzle">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-puzzle-bg-mob.png" alt="Puzzle">
            </div>
            <div class="product-puzzle__row">
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <h3 class="product-puzzle__item-sub">Платформа <br>виртуализации <br>SpaceVM</h3>
                            <div class="product-puzzle__item-desc">Гипервизор, вычислительная мощность, создание и управление виртуальными машинами</div>
                        </div>
                    </div>
                </div>
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <h3 class="product-puzzle__item-sub">Диспетчер <br>подключений <br>Space Dispatcher</h3>
                            <div class="product-puzzle__item-desc">Управляет подключениями, ограничивает доступ, синхронизирует между сторонними сервисами</div>
                        </div>
                    </div>
                </div>
                <div class="product-puzzle__col">
                    <div class="product-puzzle__item">
                        <div class="product-puzzle__item-content">
                            <h3 class="product-puzzle__item-sub">Клиентское ПО <br>Space Client</h3>
                            <div class="product-puzzle__item-desc">Позволяет видеть Space VM через призму Space Dispatcher, предоставляет доступ к&nbsp;виртуальным рабочим столам</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-advantages product-advantages--vdi section">
    <div class="container">
        <div class="product-advantages__header">
            <h2 class="product-advantages__title" data-aos="fade-up">Преимущества продукта</h2>
            <div class="product-advantages__desc" data-aos="fade-up" data-aos-delay="200">Осуществляет централизованный и&nbsp;безопасный доступ к&nbsp;виртуальным или размещенным в&nbsp;удаленной среде компьютерам, приложениям и&nbsp;веб-службам</div>
        </div>
        <div class="product-advantages__row row">
            <div class="product-advantages__col col" data-aos="fade-up">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-5.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Централизация</h3>
                        <div class="product-advantages__item-desc">Доступа к виртуальным рабочим столам, приложениям и веб-службам из любой точки мира, с любого устройства, независимо от операционной системы</div>
                    </div>
                </div>
            </div>
            <div class="product-advantages__col col" data-aos="fade-up" data-aos-delay="200">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-6.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Единое пространство</h3>
                        <div class="product-advantages__item-desc">Для всех корпоративных приложений, чтобы обеспечить гибкость виртуальных рабочих мест сотрудников</div>
                    </div>
                </div>
            </div>
            <div class="product-advantages__col col" data-aos="fade-up" data-aos-delay="400">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-7.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Безопасность</h3>
                        <div class="product-advantages__item-desc">Корпоративных данных благодаря наличию уровней доступа, ролей пользователей и групп, а также изоляции рабочего пространства</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-capabilities product-capabilities--vdi section">
    <div class="container">
        <h2 class="product-capabilities__title" data-aos="fade-up">Инфраструктура виртуальных рабочих мест <span>Space VDI</span></h2>
        <div class="product-capabilities__slider swiper-container">
            <div class="product-capabilities__controls slider-controls js-slider-hide-controls">
                <div class="slider-controls__nav">
                    <button class="product-capabilities__prev slider-controls__prev slider-controls__btn" type="button">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-prev.svg" alt="Prev">
                    </button>
                    <button class="product-capabilities__next slider-controls__next slider-controls__btn" type="button">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-next.svg" alt="Next">
                    </button>
                </div>
            </div>
            <div class="swiper-wrapper">
                <div class="product-capabilities__slide swiper-slide">
                    <div class="product-capabilities__row row-lg">
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Удаленный доступ к физическим машинам</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка <br>служб каталогов</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Перемещаемые профили</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка протоколов доступа: “Loudplay, GLINT”</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Аудит действий пользователя</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на каналах связи с высокой девиацией</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-7.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка динамических и&nbsp;статических пулов рабочих столов</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-8.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Создание виртуальных рабочих столов на базе тонких клонов</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-9.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Возможность подключения клиентских устройств через туннели (в том числе защищенные)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-capabilities__mob-slider swiper-container" data-aos="fade-up">
            <div class="swiper-wrapper">
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Удаленный доступ к физическим машинам</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка служб каталогов</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Перемещаемые профили</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка протоколов доступа: “Loudplay, GLINT”</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Аудит действий пользователя</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на каналах связи с высокой девиацией</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-7.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка динамических и&nbsp;статических пулов рабочих столов</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-8.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Создание виртуальных рабочих столов на базе тонких клонов</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2-9.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Возможность подключения клиентских устройств через туннели (в том числе защищенные)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-tech product-tech--vdi section">
    <div class="container">
        <div class="product-tech__tags" data-aos="fade-up">
            <div class="main-tags main-tags--violet">
                <div class="main-tags__row">
                    <button class="main-tags__item js-product-tech-tag active" type="button">Протокол доступа GLINT</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Технология FreeGRID</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Space Gateway</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Space Agent PC</button>
                </div>
            </div>
        </div>
        <div class="product-tech__variations">
            <div class="product-tech__variation js-product-tech-variation" style="display: block;">
                <div class="product-tech__wrap row-lg">
                    <div class="product-tech__left col-lg" data-aos="fade-up">
                        <h2 class="product-tech__title">Протокол доступа <span>GLINT</span></h2>
                        <div class="product-tech__desc">Проприетарный протокол подключения пользователя к&nbsp;удаленному рабочему столу</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block" data-aos="fade-up" data-aos-delay="200">
                                <div class="product-t-block product-t-block--3">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-3.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Минимальная задержка при работе из любой точки мира</div>
                                </div>
                            </div>
                            <div class="product-tech__block" data-aos="fade-up" data-aos-delay="400">
                                <div class="product-t-block product-t-block--4">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-4-n.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__img">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-img-2.png" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Высокое качество трансляции для&nbsp;работы с&nbsp;графикой и&nbsp;видео</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__cards">
                    <div class="product-tech__card-row">
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-1.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Оптимизации <br>алгоритмов сжатия</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-2.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Работа на каналах с пропускной способностью от 1 Мбит/c</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-3.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Надежное подключение <br>в любой момент</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-4.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Поддержка клиентских ОС</div>
                                    <div class="product-tech__card-desc">Windows, Linux, Debian, Ubuntu, Astra Linux, RedOS , AlterOS</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-5.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Использование кодека h264</div>
                                    <div class="product-tech__card-desc">Максимально высокая степень сжатия видео при сохранении высокого качества</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__mob-btn">
                    <a class="btn" href="#" target="_blank">Подробнее</a>
                </div>
            </div>
            <div class="product-tech__variation js-product-tech-variation">
                <div class="product-tech__wrap row-lg">
                    <div class="product-tech__left col-lg">
                        <h2 class="product-tech__title">Технология <span>FreeGRID</span></h2>
                        <div class="product-tech__desc">Проприетарная технология работы с&nbsp;видеокартами</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--1">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-1-n.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__img">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-img-1.png" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Поддержка аппаратного ускорения видеокарт NVIDIA</div>
                                </div>
                            </div>
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--2">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-2.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Экономия затрат на&nbsp;эксплуатацию технологии GRID</div>
                                    <div class="product-t-block__num">60%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__cards">
                    <div class="product-tech__card-row">
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-1.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Работает на ВМ <br>с Windows и Linux</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Поддерживает видеокарты <br>линеек TESLA и QUADRO RTX</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-3.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Механизм работы карт <br>Nvidia без лицензий</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__mob-btn">
                    <a class="btn" href="#" target="_blank">Подробнее</a>
                </div>
            </div>
            <div class="product-tech__variation js-product-tech-variation">
                <div class="product-tech__wrap row-lg">
                    <div class="product-tech__left col-lg">
                        <h2 class="product-tech__title">Шлюз внешних подключений <span>Space Gateway</span></h2>
                        <div class="product-tech__desc">Доступ к внутренним ресурсам через единую точку входа при подключении к удаленным рабочим столам</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--5">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-5.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Безопасное подключение благодаря подмене портов</div>
                                </div>
                            </div>
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--6">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-6-n.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__img">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-img-3.png" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Доступ пользователей из&nbsp;внешних сетей</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__cards">
                    <div class="product-tech__card-row">
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-3-1-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Round-robin</div>
                                    <div class="product-tech__card-desc">Балансировка с тонко настроенным балансировщиком</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-3-2-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Доступность из NAT</div>
                                    <div class="product-tech__card-desc">Перенаправление трафика между локальной и глобальной сетями</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-3-3-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Мгновенное перенаправление трафика</div>
                                    <div class="product-tech__card-desc">Без потерь на обработку построения маршрутов</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__mob-btn">
                    <a class="btn" href="#" target="_blank">Подробнее</a>
                </div>
            </div>
            <div class="product-tech__variation js-product-tech-variation">
                <div class="product-tech__wrap row-lg">
                    <div class="product-tech__left col-lg">
                        <h2 class="product-tech__title">Space Agent PC</h2>
                        <div class="product-tech__desc">Эффективный и безопасный доступ удаленных пользователей к физическим машинам, расположенным в корпоративной локальной сети</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--7">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-7-n.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__img">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-img-4.png" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Подключение физических машин к Space VDI</div>
                                </div>
                            </div>
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--8">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-8.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Совместное использование физических и&nbsp;виртуальных машин</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__cards">
                    <div class="product-tech__card-row">
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-4-1-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Поддержка ОС Astra Linux</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-4-2-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Управление физическими машинами через Space Dispatcher</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-4-3-n.svg" alt="#">
                                </div>
                                <div class="product-tech__card-content">
                                    <div class="product-tech__card-sub">Организация удаленной работы сотрудников</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tech__mob-btn">
                    <a class="btn" href="#" target="_blank">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="platform-video section">
    <div class="container" id="video">
        <h2 class="platform-video__title" data-aos="fade-up">Видео по работе с&nbsp;платформой</h2>
        <div class="platform-video__tags" data-aos="fade-up">
            <div class="main-tags main-tags--violet">
                <div class="main-tags__row">
                    <button class="main-tags__item js-platform-video-tag active" type="button">Обучающие ролики</button>
                    <button class="main-tags__item js-platform-video-tag" type="button">Вебинары и выступления</button>
                </div>
            </div>
        </div>
        <div class="platform-video__variations">
            <div class="platform-video__variation js-platform-video-variation" style="display: block;" data-aos="fade-up">
                <div class="platform-video__slider swiper-container">
                    <div class="swiper-wrapper">
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="platform-video__variation js-platform-video-variation">
                <div class="platform-video__slider swiper-container">
                    <div class="swiper-wrapper">
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="platform-video__slide swiper-slide">
                            <div class="platform-video-card platform-video-card--violet">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-2.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик по&nbsp;Space VDI</h3>
                                    <div class="platform-video-card__bottom">
                                        <div class="platform-video-card__desc">В этом видео мы покажем пошаговый процесс настройки, включая основные функции и преимущества платформы.</div>
                                        <div class="platform-video-card__btn">
                                            <a class="play-btn" href="https://rutube.ru/" target="_blank">
                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play-btn-icon.svg" alt="Play">
                                                <span>Смотреть</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-overview section">
    <div class="container">
        <div class="product-overview__wrap">
            <h2 class="product-overview__title" data-aos="fade-up">Обзор интерфейса</h2>
            <div class="product-overview__top">
                <div class="product-overview__tags" data-aos="fade-up">
                    <div class="product-overview__tag js-product-overview-tag" style="display: block;">Виртуальные пулы</div>
                    <div class="product-overview__tag js-product-overview-tag">Виртуальные пулы 2</div>
                    <div class="product-overview__tag js-product-overview-tag">Виртуальные пулы 3</div>
                    <div class="product-overview__tag js-product-overview-tag">Виртуальные пулы 4</div>
                    <div class="product-overview__tag js-product-overview-tag">Виртуальные пулы 5</div>
                </div>
                <div class="product-overview__controls slider-controls">
                    <div class="slider-controls__pagination">
                        <div class="product-overview__pagination gallery-pagination"></div>
                    </div>
                    <div class="slider-controls__nav js-slider-hide-controls">
                        <button class="product-overview__prev slider-controls__prev slider-controls__btn" type="button">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-prev.svg" alt="Prev">
                        </button>
                        <button class="product-overview__next slider-controls__next slider-controls__btn" type="button">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/slider-next.svg" alt="Next">
                        </button>
                    </div>
                </div>
            </div>
            <div class="product-overview__slider swiper-container" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img-2.jpg" alt="#">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-feedback section">
    <div class="container">
        <div class="product-feedback__wrap" data-aos="fade-up">
            <div class="product-feedback__bg">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-feedback-bg-1.jpg" alt="#">
            </div>
            <h2 class="product-feedback__title">Оставить на сайте заявку на демо-версию</h2>
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
<?php get_footer(); ?>