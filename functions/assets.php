<?php

function my_jquery_script() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js', array(), null);
    wp_enqueue_script( 'jquery' );
}    

add_action( 'wp_enqueue_scripts', 'my_jquery_script' );

add_action( 'wp_enqueue_scripts', 'space_scripts' );

function space_scripts() {
    $version = '17';

    wp_enqueue_style( 'space-aos', get_template_directory_uri() . '/assets/css/aos.css', array(), null);
    wp_enqueue_style( 'space-formstyler', get_template_directory_uri() . '/assets/css/formstyler.css', array(), null);
    wp_enqueue_style( 'space-swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), null);
    wp_enqueue_style( 'space-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), null);
    wp_enqueue_style( 'space-scrollbar', get_template_directory_uri() . '/assets/css/perfect-scrollbar.css', array(), null);
    wp_enqueue_style( 'space-style', get_template_directory_uri() . '/assets/css/style.css', array(), $version);
    wp_enqueue_style( 'themes-style', get_stylesheet_uri(), array(), $version);
    
    wp_enqueue_script( 'space-smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.js', array(), null, false );
    wp_enqueue_script( 'space-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), null, false );
    wp_enqueue_script( 'space-gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array(), null, true );
    wp_enqueue_script( 'space-scrolltrigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array(), null, true );
    wp_enqueue_script( 'space-formstyler', get_template_directory_uri() . '/assets/js/formstyler.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'space-inputmask', get_template_directory_uri() . '/assets/js/jquery.inputmask.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'space-swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), null, true );
    wp_enqueue_script( 'space-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'space-scrollbar', get_template_directory_uri() . '/assets/js/perfect-scrollbar.min.js', array(), null, true );
    if ( is_page_template( 'templates/about/about.php' ) ) {
        wp_enqueue_script( 'space-map', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', array(), null, false );
    }
    wp_register_script( 'space-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $version, true );
    wp_localize_script( 'space-main', 'space_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'theme_path' => get_template_directory_uri() ) );
    wp_enqueue_script( 'space-main' );

    if ( is_post_type_archive( 'glossary_term' ) || is_singular( 'glossary_term' ) ) {
        $glossary_style_path = get_template_directory() . '/assets/css/glossary.css';
        wp_enqueue_style(
            'space-glossary',
            get_template_directory_uri() . '/assets/css/glossary.css',
            array( 'space-style' ),
            file_exists( $glossary_style_path ) ? filemtime( $glossary_style_path ) : $version
        );
    }

    if ( is_post_type_archive( 'glossary_term' ) ) {
        $glossary_script_path = get_template_directory() . '/assets/js/glossary.js';
        wp_enqueue_script(
            'space-glossary',
            get_template_directory_uri() . '/assets/js/glossary.js',
            array(),
            file_exists( $glossary_script_path ) ? filemtime( $glossary_script_path ) : $version,
            true
        );
    }
}
