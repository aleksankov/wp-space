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
}
