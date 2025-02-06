<?php

function add_page_templates_to_dropdown( $templates ) {
    $templates['templates/homepage/homepage.php'] = 'Главная страница';
    $templates['templates/space/vm.php'] = 'Space VM';
    $templates['templates/space/vdi.php'] = 'Space VDI';
    $templates['templates/space/client.php'] = 'Space Client';
    $templates['templates/about/about.php'] = 'О компании';
    $templates['templates/partners/partners.php'] = 'Партнеры';
    $templates['templates/support/support.php'] = 'Сервисные центры';
    $templates['templates/education/education.php'] = 'Обучение';
    $templates['templates/career/career.php'] = 'Карьера';
    $templates['templates/documents/documents.php'] = 'Документация';
    $templates['templates/press-center/press-center.php'] = 'Пресс-Центр';
    $templates['templates/space/connect.php'] = 'Space Connect';

	return $templates;
}

add_filter( 'theme_page_templates', 'add_page_templates_to_dropdown' );