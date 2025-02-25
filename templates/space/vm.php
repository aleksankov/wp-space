<?php
    get_header();
?>

<section class="product-hero product-hero--top product-hero--vm" data-aos="fade-up">
    <div class="container">
        <div class="product-hero__wrap">
            <div class="product-hero__img">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-img-1.jpg" alt="#">
            </div>
            <div class="product-hero__content">
                <div class="product-hero__register">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-register-icon.svg" alt="Минцифры">
                    <a href="https://reestr.digital.gov.ru/reestr/1296490/" target="_blank">Запись в реестре российского ПО №16383</a>
                </div>
                <h1 class="product-hero__title">Облачная <br>платформа <span>SpaceVM</span></h1>
                <div class="product-hero__desc">Эффективная виртуализация IT-инфраструктуры предприятия</div>
                <div class="product-hero__bottom">
                    <div class="product-hero__btn">
                        <a class="btn" href="#buy-vm" data-fancybox="" data-touch="false">Купить</a>
                    </div>
                    <div class="product-hero__btn">
                        <a class="btn btn-transparent" href="#demo-vm" data-fancybox="" data-touch="false">Протестировать</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-advantages product-advantages--vm section">
    <div class="container">
        <div class="product-advantages__header">
            <h2 class="product-advantages__title" data-aos="fade-up">Преимущества продукта</h2>
            <div class="product-advantages__desc" data-aos="fade-up" data-aos-delay="200">Комплексная платформа для развертывания полноценного частного облака в корпоративной среде</div>
        </div>
        <div class="product-advantages__row row">
            <div class="product-advantages__col col" data-aos="fade-up">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-1.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Масштабность</h3>
                        <div class="product-advantages__item-desc">Комплексная платформа для развертывания полноценного <br>частного облака в корпоративной среде</div>
                    </div>
                </div>
            </div>
            <div class="product-advantages__col col" data-aos="fade-up" data-aos-delay="200">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-2.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Гибкость</h3>
                        <div class="product-advantages__item-desc">Позволяет перенести в облако: веб-сайты, <br>порталы  и бизнес-приложения</div>
                    </div>
                </div>
            </div>
            <div class="product-advantages__col col" data-aos="fade-up">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-3.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Широкий инструментарий</h3>
                        <div class="product-advantages__item-desc">Полный набор необходимых инструментов для автоматизации и <br>оркестрации работы облачных сервисов</div>
                    </div>
                </div>
            </div>
            <div class="product-advantages__col col" data-aos="fade-up" data-aos-delay="200">
                <div class="product-advantages__item">
                    <div class="product-advantages__item-bg">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-advantages-bg-4.jpg" alt="#">
                    </div>
                    <div class="product-advantages__item-content">
                        <h3 class="product-advantages__item-sub">Консолидация ресурсов</h3>
                        <div class="product-advantages__item-desc">Обеспечивает работу телекоммуникационных <br>сервисов, виртуальных маршрутизаторов, <br>межсетевых экранов, почтовых и прокси- серверов</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-capabilities section">
    <div class="container">
        <h2 class="product-capabilities__title" data-aos="fade-up">Возможности платформы виртуализации <span>SpaceVM</span></h2>
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
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Единый интерфейс управления, мониторинга и журналирования</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Централизованное управление несколькими локациями</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на базе серверов стандартной архитектуры x86-64</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">High Availability, <br>DRS и Live migration</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Визуализация загрузки ресурсов кластера, серверов и ВМ</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция со сторонними решениями по СРК и СХД</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-7.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на базе аппаратных платформ с&nbsp;процессором «Эльбрус»</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-8.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Моментальные снимки (снэпшоты ВМ)</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-9.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Встроенная система резервного копирования</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__slide swiper-slide">
                    <div class="product-capabilities__row row-lg">
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-10.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Подключение внешних хранилищ данных: NFS, iSCSI, FC</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-11.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция с LDAP, SSO</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-12.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Живая миграция между узлами кластера</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-13.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Встроенный межсетевой экран</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-14.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Журналирование событий</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-15.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Автоматическое добавление новых узлов в&nbsp;кластер</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-16.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Мониторинг по SNMP</div>
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
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Единый интерфейс управления, мониторинга и журналирования</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Централизованное управление несколькими локациями</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на базе серверов стандартной архитектуры x86-64</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">High Availability, <br>DRS и Live migration</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Визуализация загрузки ресурсов кластера, серверов и ВМ</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция со сторонними решениями по СРК и СХД</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-7.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Работа на базе аппаратных платформ с&nbsp;процессором «Эльбрус»</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-8.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Моментальные снимки (снэпшоты ВМ)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-9.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Встроенная система резервного копирования</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-10.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Подключение внешних хранилищ данных: NFS, iSCSI, FC</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-11.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция с LDAP, SSO</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-12.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Живая миграция между узлами кластера</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-13.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Встроенный межсетевой экран</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-14.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Журналирование событий</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-15.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Автоматическое добавление новых узлов в кластер</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-16.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Мониторинг по SNMP</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-tech section">
    <div class="container">
        <div class="product-tech__tags" data-aos="fade-up">
            <div class="main-tags main-tags--violet">
                <div class="main-tags__row">
                    <button class="main-tags__item js-product-tech-tag active" type="button">Технология FreeGRID</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Протокол доступа GLINT</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Space Gateway</button>
                    <button class="main-tags__item js-product-tech-tag" type="button">Space Agent PC</button>
                </div>
            </div>
        </div>
        <div class="product-tech__variations">
            <div class="product-tech__variation js-product-tech-variation" style="display: block;">
                <div class="product-tech__wrap row-lg">
                    <div class="product-tech__left col-lg" data-aos="fade-up">
                        <h2 class="product-tech__title">Технология <span>FreeGRID</span></h2>
                        <div class="product-tech__desc">Проприетарная технология работы с&nbsp;видеокартами</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block" data-aos="fade-up" data-aos-delay="200">
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
                            <div class="product-tech__block" data-aos="fade-up" data-aos-delay="400">
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
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-1.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Работает на ВМ <br>с Windows и Linux</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Поддерживает видеокарты <br>линеек TESLA и QUADRO RTX</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col" data-aos="fade-up">
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
                        <h2 class="product-tech__title">Протокол доступа <span>GLINT</span></h2>
                        <div class="product-tech__desc">Проприетарный протокол подключения пользователя к&nbsp;удаленному рабочему столу</div>
                        <div class="product-tech__btn">
                            <a class="btn" href="#" target="_blank">Подробнее</a>
                        </div>
                    </div>
                    <div class="product-tech__right col-lg">
                        <div class="product-tech__blocks">
                            <div class="product-tech__block">
                                <div class="product-t-block product-t-block--3">
                                    <div class="product-t-block__bg">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/product-block-bg-3.jpg" alt="#">
                                    </div>
                                    <div class="product-t-block__sub h4">Минимальная задержка при работе из любой точки мира</div>
                                </div>
                            </div>
                            <div class="product-tech__block">
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
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-1.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Оптимизации <br>алгоритмов сжатия</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-2.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Работа на каналах с пропускной способностью от 1 Мбит/c</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
                            <div class="product-tech__card">
                                <div class="product-tech__card-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-tech-card-icon-2-3.svg" alt="#">
                                </div>
                                <div class="product-tech__card-sub">Надежное подключение <br>в любой момент</div>
                            </div>
                        </div>
                        <div class="product-tech__cards-col">
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
                        <div class="product-tech__cards-col">
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
                    <a class="btn" href="#" target="_blank">Подробнее </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="platform-video section">
    <div class="container" id="video">
        <h2 class="platform-video__title" data-aos="fade-up">Видео по работе с&nbsp;платформой</h2>
        <div class="platform-video__tags" data-aos="fade-up">
            <div class="main-tags">
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                            <div class="platform-video-card">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-1.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Установка облачной платформы SpaceVM</h3>
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
                    <div class="product-overview__tag js-product-overview-tag" style="display: block;">Список виртуальных машин</div>
                    <div class="product-overview__tag js-product-overview-tag">Список виртуальных машин 2</div>
                    <div class="product-overview__tag js-product-overview-tag">Список виртуальных машин 3</div>
                    <div class="product-overview__tag js-product-overview-tag">Список виртуальных машин 4</div>
                    <div class="product-overview__tag js-product-overview-tag">Список виртуальных машин 5</div>
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
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" alt="#">
                        </a>
                    </div>
                    <div class="product-overview__slide swiper-slide">
                        <a class="product-overview__item" href="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" data-fancybox="overview-gallery">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/product-overview-img.jpg" alt="#">
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