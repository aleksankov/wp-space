<?php

if( function_exists('acf_add_options_page') ) {

    //theme options
    acf_add_options_page(array(
        'page_title'    => 'Настройки сайта',
        'menu_title'    => 'Настройки сайта',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Контактная информация',
        'menu_title'    => 'Контакты',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Настройки меню',
        'menu_title'    => 'Меню',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Настройки форм',
        'menu_title'    => 'Формы',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Настройки страницы 404',
        'menu_title'    => '404',
        'parent_slug'   => 'theme-general-settings',
    ));

    //colors
    add_action(
        'admin_footer',
         function () {
           ?>
            <script>
            if (window.acf) {
                acf.addFilter('color_picker_args', function (args, $field) {
    
                args.palettes = [
                    '#10041B',
                    '#946AD2',
                    '#41B4BF',
                    '#FF8C53',
                ];
    
                return args;
                });
            }
            </script>
        <?php
      }
    );

    //blocks
    add_action( 'after_setup_theme', 'space_theme_setup' );
    
    function space_theme_setup() {
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/css/style.css' );
        add_editor_style( 'style.css' );
    }

    remove_theme_support( 'core-block-patterns' );
    add_filter(
        'block_editor_settings_all', function( $settings ) {
            $settings['enableOpenverseMediaCategory'] = false;
            return $settings;
        }, 10 );

    function space_register_acf_blocks() {
        register_block_type( __DIR__ . '/blocks/hero' );
        register_block_type( __DIR__ . '/blocks/advantages' );
        register_block_type( __DIR__ . '/blocks/capabilities' );
        register_block_type( __DIR__ . '/blocks/tech' );
        register_block_type( __DIR__ . '/blocks/video' );
        register_block_type( __DIR__ . '/blocks/overview' );
        register_block_type( __DIR__ . '/blocks/form' );
        register_block_type( __DIR__ . '/blocks/puzzle' );
        register_block_type( __DIR__ . '/blocks/download' );
        register_block_type( __DIR__ . '/blocks/model' );
        register_block_type( __DIR__ . '/blocks/bonuses' );
        register_block_type( __DIR__ . '/blocks/gallery' );
        register_block_type( __DIR__ . '/blocks/education' );
        register_block_type( __DIR__ . '/blocks/centers' );
        register_block_type( __DIR__ . '/blocks/news' );
        register_block_type( __DIR__ . '/blocks/vdi-components' );
        register_block_type( __DIR__ . '/blocks/banner-min');
        register_block_type( __DIR__ . '/blocks/banner-min-v2');
        register_block_type( __DIR__ . '/blocks/video-gide');
        register_block_type( __DIR__ . '/blocks/folder');
        register_block_type( __DIR__ . '/blocks/form-custom');
        register_block_type( __DIR__ . '/blocks/form-custom-popup');
        register_block_type( __DIR__ . '/blocks/content');
        register_block_type( __DIR__ . '/blocks/partner');
        register_block_type( __DIR__ . '/blocks/cases-comments');
        register_block_type( __DIR__ . '/blocks/section-comments');
        register_block_type( __DIR__ . '/blocks/cases-results');
        register_block_type( __DIR__ . '/blocks/product-slider');
        register_block_type( __DIR__ . '/blocks/blog');
    }
    add_action( 'init', 'space_register_acf_blocks' );

    function block_render( $block, $content, $is_preview = false ) {
        if ( $is_preview && ! empty( $block['data']['space_field'] ) ) {
            $block_folder = mb_substr($block['name'], 3);
            $block_preview_url = get_template_directory_uri() . '/functions/blocks' . $block_folder . '/preview.jpg';
            echo '<img src="' . $block_preview_url . '">';
            return;
        }else{
            if ( $block ) :
                $block_folder = mb_substr($block['name'], 3);
                $block_template = 'functions/blocks' . $block_folder . '/template';
                get_template_part( $block_template, null, [
                        "block"=>$block
                ] );
            endif;
        }
    }
    function get_field_block($field_name, $block = null)
    {
        if (isset($block)) {
            return get_field($field_name, $block['id']);
        } else {
            return get_field($field_name, get_queried_object());
        }
    }

}
