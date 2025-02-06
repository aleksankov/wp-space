<?php
    get_header();
?>
<section class="product-hero product-hero--top product-hero--client" data-aos="fade-up">
    <div class="container">
        <div class="product-hero__wrap">
            <div class="product-hero__img">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-hero-img-3.jpg" alt="#">
            </div>
            <div class="product-hero__content">
                <h1 class="product-hero__title"><span>Space Client</span></h1>
                <div class="product-hero__desc">Клиент для подключения к виртуальной инфраструктуре. Обеспечивает плавный переход на VDI благодаря одновременному использованию имеющегося ПК и виртуального рабочего стола</div>
                <div class="product-hero__bottom">
                    <div class="product-hero__btn">
                        <a class="btn js-anchor" href="#download">Скачать</a>
                    </div>
                </div>
                <div class="product-hero__app">
                    <div class="product-hero__app-label">Доступна версия для ПК</div>
                    <div class="product-hero__app-icons">
                        <a href="https://www.apple.com/app-store/" target="_blank" class="product-hero__app-icon">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/app-icon.svg" alt="App Store">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-capabilities product-capabilities--client section">
    <div class="container">
        <h2 class="product-capabilities__title" data-aos="fade-up">Возможности <span>Space Client</span></h2>
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
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Видео в разрешении до Full HD</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Воспроизведение звука без&nbsp;прерываний</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Комфортная работа с САПР Autocad и&nbsp;3D графикой</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция c LDAP или AD</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка 2FA</div>
                            </div>
                        </div>
                        <div class="product-capabilities__col col-lg" data-aos="fade-up" data-aos-delay="400">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Широкие возможности подключения периферийных устройств</div>
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
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-1.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Видео в разрешении до Full HD</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-2.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Воспроизведение звука без&nbsp;прерываний</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-3.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Комфортная работа с САПР Autocad и&nbsp;3D графикой</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-4.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Интеграция c LDAP или AD</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-capabilities__mob-slide swiper-slide">
                    <div class="product-capabilities__mob-row">
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-5.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Поддержка 2FA</div>
                            </div>
                        </div>
                        <div class="product-capabilities__mob-col">
                            <div class="product-capabilities__item">
                                <div class="product-capabilities__item-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/product-capabilities-icon-3-6.svg" alt="#">
                                </div>
                                <div class="product-capabilities__item-sub h7">Широкие возможности подключения периферийных устройств</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="platform-video section">
    <div class="container">
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
                            <div class="platform-video-card platform-video-card--orange">
                                <div class="platform-video-card__bg">
                                    <div class="platform-video-card__bg-item">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/platform-video-card-bg-3.jpg" alt="#">
                                    </div>
                                </div>
                                <div class="platform-video-card__content">
                                    <h3 class="platform-video-card__sub h2">Обзорный ролик <br>по Space Client</h3>
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
<section class="product-download section" id="download">
    <div class="container">
        <h2 class="product-download__title" data-aos="fade-up">Скачать <span>Space Client</span></h2>
        <div class="product-download__row row-lg">
            <div class="product-download__col col-lg" data-aos="fade-up">
                <div class="product-download__card">
                    <div class="product-download__card-top">
                        <div class="product-download__card-header">
                            <div class="product-download__card-oc">Windows</div>
                            <div class="product-download__card-icon">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-download-icon-1.svg" alt="Windows">
                            </div>
                        </div>
                        <div class="product-download__tags">
                            <div class="product-download__tag">Версия: 8/10/11</div>
                            <div class="product-download__tag">Server: 2016/2019/2022</div>
                        </div>
                    </div>
                    <div class="product-download__btn">
                        <a class="btn" href="https://update.spacevm.ru/space-client/windows/2.5.0/" target="_blank">Скачать</a>
                    </div>
                </div>
            </div>
            <div class="product-download__col col-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="product-download__card">
                    <div class="product-download__card-top">
                        <div class="product-download__card-header">
                            <div class="product-download__card-oc">Linux</div>
                            <div class="product-download__card-icon">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-download-icon-2.svg" alt="Linux">
                            </div>
                        </div>
                        <div class="product-download__tags">
                            <div class="product-download__tag">Astra Linux</div>
                            <div class="product-download__tag">Alt Linux</div>
                            <div class="product-download__tag">AlterOS</div>
                            <div class="product-download__tag">РедОС</div>
                            <div class="product-download__tag">Debian</div>
                            <div class="product-download__tag">Ubuntu</div>
                            <div class="product-download__tag">Centos</div>
                        </div>
                    </div>
                    <div class="product-download__btn">
                        <a class="btn" href="https://update.spacevm.ru/space-client/linux/space-client-linux-installer.sh" target="_blank">Скачать</a>
                    </div>
                </div>
            </div>
            <div class="product-download__col col-lg" data-aos="fade-up" data-aos-delay="400">
                <div class="product-download__card">
                    <div class="product-download__card-top">
                        <div class="product-download__card-header">
                            <div class="product-download__card-oc">MacOS</div>
                            <div class="product-download__card-icon">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/product-download-icon-3.svg" alt="MacOS">
                            </div>
                        </div>
                        <div class="product-download__tags">
                            <div class="product-download__tag">Monterey</div>
                            <div class="product-download__tag">Ventura</div>
                            <div class="product-download__tag">Sonoma</div>
                        </div>
                    </div>
                    <div class="product-download__btn">
                        <a class="btn" href="https://update.spacevm.ru/space-client/macos/latest/" target="_blank">Скачать</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>