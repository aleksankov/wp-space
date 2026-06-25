<?php
get_header();
?>

<?php
// Snapshot fallback values copied from homepage ACF fields. Keep this independent from the live homepage page.
$service_default_fields = array (
  'service_hero_video' => '/wp-content/uploads/2025/10/webm_01.webm',
  'service_hero_title' => 'Экосистема виртуализации <span>Space</span>',
  'service_hero_desc' => 'Строим надежную российскую <br />
виртуальную ИТ-инфраструктуру',
  'service_hero_btn' => 'Протестировать',
  'service_hero_awards' => 
  array (
    0 => 
    array (
      'icon' => false,
      'desc' => '<span>CNEWS:</span> Лидер рейтинга платформ виртуализации 2025',
    ),
    1 => 
    array (
      'icon' => false,
      'desc' => '<span>TAdviser:</span> ТОП-3 по финансовым результатам на рынке виртуализации 2024',
    ),
    2 => 
    array (
      'icon' => false,
      'desc' => '<span>CNEWS Awards 2025:</span> Разработчик года в области корпоративной виртуализации',
    ),
  ),
  'banner-min-title' => 'Протестируйте решения Space',
  'banner-min-text' => '<p>Оставьте заявку, и мы поможем подобрать конфигурацию под вашу инфраструктуру.</p>',
  'banner-min-background' => 226,
  'banner-min-link' => '/contacts/',
  'banner-min-anim-enabled' => true,
  'banner-min-anim-delay' => 150,
  'service_why_title' => 'Почему выбирают решения Space',
  'service_why_items' => 
  array (
    0 => 
    array (
      'img' => 4614,
      'title' => 'Проприетарность',
      'desc' => 'Не опираемся на готовые решения, а разрабатываем все собственными силами',
    ),
    1 => 
    array (
      'img' => 4616,
      'title' => 'Экосистемность',
      'desc' => 'Создаём технологически связанную и бесшовную экосистему продуктов: от виртуализации серверов и VDI-решений до управления корпоративными облаками ',
    ),
    2 => 
    array (
      'img' => 4615,
      'title' => 'Отечественная <br />
виртуализация',
      'desc' => 'Соответствуем национальным стандартам и&nbsp;требованиям&nbsp;по&nbsp;безопасности',
    ),
    3 => 
    array (
      'img' => 4617,
      'title' => 'Кастомизация',
      'desc' => 'Находимся в тесном контакте с заказчиками и формируем дорожную карту исходя из их запросов ',
    ),
  ),
  'service_gallery_title' => '<span>Space —</span>  российский разработчик ПО и R&D-центр',
  'service_gallery_images' => 
  array (
    0 => 147,
    1 => 847,
    2 => 849,
    3 => 850,
  ),
  'service_gallery_btn_label' => 'Узнать больше о нас',
  'service_gallery_btn_url' => '/about/',
  'service_tech_title' => 'Проприетарные технологии Space',
  'service_tech_items' => 
  array (
    0 => 
    array (
      'title' => 'One click',
      'desc' => 'Установка из коробки',
      'hint' => 'Альтернатива',
      'value' => ' Мастер установки ESXi',
      'url' => '',
    ),
    1 => 
    array (
      'title' => 'Space Stor',
      'desc' => 'Эффективная работа c уровнем хранения данных в виртуальной ИТ-инфраструктуре',
      'hint' => '',
      'value' => ' ',
      'url' => '/technology/space-stor/',
    ),
    2 => 
    array (
      'title' => 'SDN Flow',
      'desc' => 'Управление виртуальными сетями',
      'hint' => 'Альтернатива',
      'value' => ' VMware NSX',
      'url' => '/technology/sdn_flow/',
    ),
    3 => 
    array (
      'title' => 'Space Agent VDI',
      'desc' => 'Утилиты для улучшения взаимодействия пользователей с физическими машинами',
      'hint' => 'Альтернатива',
      'value' => ' VM Horizon Agent',
      'url' => '/vdi-docs/latest/broker/utils/agent_vdi/space_vd_utils/',
    ),
    4 => 
    array (
      'title' => 'Space Dispatcher',
      'desc' => 'Система управления виртуальными рабочими столами',
      'hint' => 'Альтернатива',
      'value' => ' VMware Horizon',
      'url' => '/vdi-docs/latest/broker/engineer_guide/install/general_settings/',
    ),
    5 => 
    array (
      'title' => 'Протокол GLINT',
      'desc' => 'Протокол подключения к удаленному рабочему столу ',
      'hint' => 'Альтернатива',
      'value' => ' RDP/FreeRDP',
      'url' => '/client-docs/latest/connect/settings/glint_setting/',
    ),
    6 => 
    array (
      'title' => 'Space Agent VM',
      'desc' => 'Набор системных утилит для повышения производительности виртуальной машины',
      'hint' => 'Альтернатива',
      'value' => ' VMware Agent VM',
      'url' => '/vdi-docs/latest/broker/utils/guest_agent/info/',
    ),
    7 => 
    array (
      'title' => 'FreeGRID',
      'desc' => 'Работа видеокарт NVIDIA без риска блокировки',
      'hint' => 'Альтернатива',
      'value' => ' NVIDIA GRID',
      'url' => '/docs/latest/how_to/freegrid/',
    ),
    8 => 
    array (
      'title' => 'Контроллер SpaceVM',
      'desc' => 'Построение частного облака в корпоративной среде',
      'hint' => 'Альтернатива',
      'value' => ' VMware VCenter',
      'url' => '/docs/latest/base/operator_guide/domains/control/controllers/',
    ),
    9 => 
    array (
      'title' => 'Space Client Getmobit',
      'desc' => 'Интеграция c многофункциональной док-станцией GM-Box',
      'hint' => '',
      'value' => '',
      'url' => '',
    ),
    10 => 
    array (
      'title' => 'Mediapipe',
      'desc' => 'Сжатие и оптимизация мультимедиа трафика, GPU-ускорение, поддержка USB в виртуальных сессиях',
      'hint' => 'Альтернатива',
      'value' => 'Citrix HDX',
      'url' => '',
    ),
    11 => 
    array (
      'title' => 'Space Gateway',
      'desc' => 'Подключение внешних пользователей',
      'hint' => '',
      'value' => ' ',
      'url' => '/vdi-docs/latest/broker/operator_guide/settings/system/gateway/',
    ),
  ),
  'service_banner_bg' => false,
  'service_banner_title' => '',
  'service_banner_desc' => '',
  'service_banner_btn_label' => '',
  'service_banner_btn_url' => '',
  'service_regions_title' => 'Присутствуем по всей России',
  'service_regions_cards' => 
  array (
    0 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-regions-icon-1.svg',
      'sub' => 'Мы всегда на связи и готовы помочь независимо от вашего региона',
    ),
    1 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-regions-icon-2.svg',
      'sub' => 'По запросу поможем с запуском пилота на объекте заказчика',
    ),
  ),
  'service_regions_items' => 
  array (
    0 => 
    array (
      'img' => 184,
      'city' => 'Москва',
      'address' => 'Волгоградский проспект, <br />
дом 2, помещение 1/1',
    ),
    1 => 
    array (
      'img' => 185,
      'city' => 'Санкт-Петербург',
      'address' => 'Большой Сампсониевский проспект, д.61, корп.2, литер «А»',
    ),
    2 => 
    array (
      'img' => 188,
      'city' => 'Новосибирск',
      'address' => 'ул. Богдана Хмельницкого, д.56',
    ),
    3 => 
    array (
      'img' => 186,
      'city' => 'Ростов-на-Дону',
      'address' => '  <br />
<br />
',
    ),
    4 => 
    array (
      'img' => 187,
      'city' => 'Самара',
      'address' => ' <br />
<br />
',
    ),
    5 => 
    array (
      'img' => 2200,
      'city' => 'Екатеринбург',
      'address' => ' <br />
<br />
',
    ),
  ),
  'service_demo_title' => 'Оставьте заявку на&nbsp;демо-версию',
  'service_demo_desc_yt' => 'Показываем, как построить виртуальную ИТ-инфраструктуру',
  'service_demo_desc_rutube' => 'Показываем, как построить виртуальную ИТ-инфраструктуру',
  'service_demo_desc_tg' => 'Публикуем новости, полезные советы и обновления',
  'service_demo_desc_habr' => 'Статьи и гайды по работе с&nbsp;продуктами Space',
  'service_demo_socials' => false,
  'service_portfolio_sub' => 'Портфолио',
  'service_portfolio_title' => 'Нам доверяют лидеры отрасли',
  'service_portfolio_items' => 
  array (
    0 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-portfolio-icon-1.svg',
      'label' => 'Энергетика',
    ),
    1 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-portfolio-icon-4.svg',
      'label' => 'Финансовый сектор',
    ),
    2 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-portfolio-icon-2.svg',
      'label' => 'Государственное управление',
    ),
    3 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-portfolio-icon-3.svg',
      'label' => 'Судостроение',
    ),
    4 => 
    array (
      'icon' => '/wp-content/uploads/2025/02/home-portfolio-icon-5.svg',
      'label' => 'И другие отрасли',
    ),
  ),
  'service_portfolio_desc' => '',
  'service_portfolio_gallery' => 
  array (
    0 => 213,
    1 => 211,
    2 => 212,
    3 => 3076,
    4 => 3081,
    5 => 215,
    6 => 214,
    7 => 3075,
    8 => 3077,
    9 => 3074,
    10 => 217,
    11 => 218,
    12 => 3078,
  ),
  'service_video_items' => 
  array (
    0 => 
    array (
      'label' => 'SpaceVM',
      'bg' => 226,
      'video' => '/wp-content/uploads/2025/02/home-product-video.mp4',
      'title' => 'SpaceVM — <br />
Российская платформа <br />
виртуализации',
      'desc' => 'Простое и эффективное управление ИТ-инфраструктурой. ',
    ),
    1 => 
    array (
      'label' => 'Space VDI',
      'bg' => 3385,
      'video' => '/wp-content/uploads/2025/06/space-vdi_demo.mp4',
      'title' => 'Space VDI — <br />
Виртуализация рабочих столов <br />
и приложений',
      'desc' => 'Создание и администрирование инфраструктуры виртуальных рабочих мест',
    ),
  ),
  'service_faq_title' => 'Ответы на часто <br />
задаваемые <br />
вопросы',
  'service_faq_bg' => '/wp-content/uploads/2025/02/faq-block-bg.svg',
  'service_faq_items' => 
  array (
    0 => 
    array (
      'question' => 'На базе какого СПО построена SpaceVM?',
      'answer' => '<p>Ядро нашего гипервизора - KVM (Kernel-based Virtual Machine).<br />
Система управления гипервизором SpaceVM написана нашими силами с нуля</p>
',
    ),
    1 => 
    array (
      'question' => 'Какой функциональностью обладает SpaceVM по сравнению с VMware?',
      'answer' => '<p>SpaceVM на 86% покрывает функциональность всех модулей VMware</p>
',
    ),
    2 => 
    array (
      'question' => 'Какие лицензии NVIDIA GRID – vApps/vPC/vWs - заменяет FreeGRID?',
      'answer' => '<p>FreeGRID полностью заменяет систему лицензирования со всеми функциями. Работает как профилирование так и проброс</p>
',
    ),
    3 => 
    array (
      'question' => 'Какие есть инструменты для миграции?',
      'answer' => '<p>Зависит от масштабов проекта. Для миграции небольшого количества виртуальных машин можно использовать встроенные средства миграции SpaceVM. Автоматическая миграция сотен и тысяч ВМ проводится с помощью решений Mind Migrate (если требуется живая миграция), СУПеР и КиберБэкап   </p>
',
    ),
    4 => 
    array (
      'question' => 'Какие средства резервного копирования поддерживает SpaceVM?',
      'answer' => '<p>SpaceVM поддерживает систему резервного копирования Кибер Бэкап. Чтобы ее использовать, необходимо приобрести лицензию от КиберПротект</p>
',
    ),
  ),
  'service_media_title' => 'О нас пишут в СМИ',
  'service_media_desc' => 'Ведущие издания о российской экосистеме виртуализации Space',
  'service_media_items' => 
  array (
    0 => 
    array (
      'text' => '"ДАКОМ М" представит российскую альтернативу VMware NSX<br />
',
      'logo' => 
      array (
        'ID' => 252,
        'id' => 252,
        'title' => 'tass-logo',
        'filename' => 'home-media-logo-3.png',
        'filesize' => 1058,
        'url' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
        'link' => '/glavnaya-stranicza-2/home-media-logo-3/',
        'alt' => '',
        'author' => '1',
        'description' => '',
        'caption' => '',
        'name' => 'home-media-logo-3',
        'status' => 'inherit',
        'uploaded_to' => 12,
        'date' => '2025-02-05 13:34:02',
        'modified' => '2025-07-02 15:54:24',
        'menu_order' => 0,
        'mime_type' => 'image/png',
        'type' => 'image',
        'subtype' => 'png',
        'icon' => '/wp-includes/images/media/default.png',
        'width' => 94,
        'height' => 94,
        'sizes' => 
        array (
          'thumbnail' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'thumbnail-width' => 94,
          'thumbnail-height' => 94,
          'medium' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium-width' => 94,
          'medium-height' => 94,
          'medium_large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium_large-width' => 94,
          'medium_large-height' => 94,
          'large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'large-width' => 94,
          'large-height' => 94,
          '1536x1536' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '1536x1536-width' => 94,
          '1536x1536-height' => 94,
          '2048x2048' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '2048x2048-width' => 94,
          '2048x2048-height' => 94,
        ),
      ),
      'url' => 'https://tass.ru/ekonomika/22637401',
    ),
    1 => 
    array (
      'text' => 'В России разработали аналог платформы для виртуализации VMware',
      'logo' => 
      array (
        'ID' => 252,
        'id' => 252,
        'title' => 'tass-logo',
        'filename' => 'home-media-logo-3.png',
        'filesize' => 1058,
        'url' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
        'link' => '/glavnaya-stranicza-2/home-media-logo-3/',
        'alt' => '',
        'author' => '1',
        'description' => '',
        'caption' => '',
        'name' => 'home-media-logo-3',
        'status' => 'inherit',
        'uploaded_to' => 12,
        'date' => '2025-02-05 13:34:02',
        'modified' => '2025-07-02 15:54:24',
        'menu_order' => 0,
        'mime_type' => 'image/png',
        'type' => 'image',
        'subtype' => 'png',
        'icon' => '/wp-includes/images/media/default.png',
        'width' => 94,
        'height' => 94,
        'sizes' => 
        array (
          'thumbnail' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'thumbnail-width' => 94,
          'thumbnail-height' => 94,
          'medium' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium-width' => 94,
          'medium-height' => 94,
          'medium_large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium_large-width' => 94,
          'medium_large-height' => 94,
          'large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'large-width' => 94,
          'large-height' => 94,
          '1536x1536' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '1536x1536-width' => 94,
          '1536x1536-height' => 94,
          '2048x2048' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '2048x2048-width' => 94,
          '2048x2048-height' => 94,
        ),
      ),
      'url' => 'https://tass.ru/ekonomika/21997459',
    ),
    2 => 
    array (
      'text' => 'Почти треть российских компаний перешли на отечественные системы виртуализации<br />
',
      'logo' => 
      array (
        'ID' => 252,
        'id' => 252,
        'title' => 'tass-logo',
        'filename' => 'home-media-logo-3.png',
        'filesize' => 1058,
        'url' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
        'link' => '/glavnaya-stranicza-2/home-media-logo-3/',
        'alt' => '',
        'author' => '1',
        'description' => '',
        'caption' => '',
        'name' => 'home-media-logo-3',
        'status' => 'inherit',
        'uploaded_to' => 12,
        'date' => '2025-02-05 13:34:02',
        'modified' => '2025-07-02 15:54:24',
        'menu_order' => 0,
        'mime_type' => 'image/png',
        'type' => 'image',
        'subtype' => 'png',
        'icon' => '/wp-includes/images/media/default.png',
        'width' => 94,
        'height' => 94,
        'sizes' => 
        array (
          'thumbnail' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'thumbnail-width' => 94,
          'thumbnail-height' => 94,
          'medium' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium-width' => 94,
          'medium-height' => 94,
          'medium_large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'medium_large-width' => 94,
          'medium_large-height' => 94,
          'large' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          'large-width' => 94,
          'large-height' => 94,
          '1536x1536' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '1536x1536-width' => 94,
          '1536x1536-height' => 94,
          '2048x2048' => '/wp-content/uploads/2025/02/home-media-logo-3.png',
          '2048x2048-width' => 94,
          '2048x2048-height' => 94,
        ),
      ),
      'url' => 'https://tass.ru/ekonomika/20909509',
    ),
    3 => 
    array (
      'text' => 'Денис Агеев рассказал, как быстро заместят иностранное ПО',
      'logo' => 
      array (
        'ID' => 5214,
        'id' => 5214,
        'title' => 'ria',
        'filename' => 'ria-1.png',
        'filesize' => 6733,
        'url' => '/wp-content/uploads/2025/12/ria-1.png',
        'link' => '/glavnaya-stranicza-2/ria-2/',
        'alt' => '',
        'author' => '8',
        'description' => '',
        'caption' => '',
        'name' => 'ria-2',
        'status' => 'inherit',
        'uploaded_to' => 12,
        'date' => '2025-12-12 14:22:36',
        'modified' => '2025-12-12 14:22:36',
        'menu_order' => 0,
        'mime_type' => 'image/png',
        'type' => 'image',
        'subtype' => 'png',
        'icon' => '/wp-includes/images/media/default.png',
        'width' => 94,
        'height' => 89,
        'sizes' => 
        array (
          'thumbnail' => '/wp-content/uploads/2025/12/ria-1.png',
          'thumbnail-width' => 94,
          'thumbnail-height' => 89,
          'medium' => '/wp-content/uploads/2025/12/ria-1.png',
          'medium-width' => 94,
          'medium-height' => 89,
          'medium_large' => '/wp-content/uploads/2025/12/ria-1.png',
          'medium_large-width' => 94,
          'medium_large-height' => 89,
          'large' => '/wp-content/uploads/2025/12/ria-1.png',
          'large-width' => 94,
          'large-height' => 89,
          '1536x1536' => '/wp-content/uploads/2025/12/ria-1.png',
          '1536x1536-width' => 94,
          '1536x1536-height' => 89,
          '2048x2048' => '/wp-content/uploads/2025/12/ria-1.png',
          '2048x2048-width' => 94,
          '2048x2048-height' => 89,
        ),
      ),
      'url' => 'https://ria.ru/20241205/zameschenie-1987439902.html ',
    ),
  ),
  'service_news_title' => 'Новости',
  'service_news_btn_label' => 'Смотреть все новости',
  'service_news_btn_url' => '/news_page',
);

$service_debug_fallbacks = defined('WP_DEBUG') && WP_DEBUG && isset($_GET['debug_service_fallbacks']);
$service_debug_log = static function ($message, array $context = []) use ($service_debug_fallbacks) {
    if (!$service_debug_fallbacks) {
        return;
    }

    error_log('[FIX:service-static-fallbacks] ' . $message . ($context ? ' ' . wp_json_encode($context) : ''));
};

$service_field_has_value = static function ($value) {
    if (is_array($value)) {
        return !empty($value);
    }

    return !in_array($value, [null, false, ''], true);
};

$service_get_field = static function ($field_name) use ($service_default_fields, $service_field_has_value, $service_debug_log) {
    $service_value = get_field($field_name);

    if ($service_field_has_value($service_value)) {
        return $service_value;
    }

    if (array_key_exists($field_name, $service_default_fields) && $service_field_has_value($service_default_fields[$field_name])) {
        $service_debug_log('Static fallback applied.', [
            'service_field' => $field_name,
        ]);

        return $service_default_fields[$field_name];
    }

    return $service_value;
};

$service_get_banner_min_field = static function ($field_name) use ($service_default_fields, $service_field_has_value, $service_debug_log) {
    $post_id = get_the_ID();
    $service_value = get_field($field_name);

    if ('banner-min-anim-enabled' === $field_name && $post_id && metadata_exists('post', $post_id, $field_name)) {
        return (bool) $service_value;
    }

    if ($service_field_has_value($service_value)) {
        return $service_value;
    }

    if (array_key_exists($field_name, $service_default_fields) && $service_field_has_value($service_default_fields[$field_name])) {
        $service_debug_log('Static fallback applied.', [
            'service_field' => $field_name,
        ]);

        return $service_default_fields[$field_name];
    }

    return $service_value;
};

$service_section_is_visible = static function ($field_name) {
    $post_id = get_the_ID();

    if (!$post_id || !metadata_exists('post', $post_id, $field_name)) {
        return true;
    }

    return (bool) get_field($field_name, $post_id);
};

$service_visible_sections = [];

foreach ([
    'service_hero',
    'service_banner_min',
    'service_why',
    'service_gallery',
    'service_tech',
    'service_banner',
    'service_regions',
    'service_demo',
    'service_portfolio',
    'service_video',
    'service_faq',
    'service_media',
    'service_news',
] as $service_section_prefix) {
    $service_visible_sections[$service_section_prefix] = $service_section_is_visible($service_section_prefix . '_show');
}

if (defined('WP_DEBUG') && WP_DEBUG && isset($_GET['debug_service_sections'])) {
    error_log('[FIX:service-sections] Visibility: ' . wp_json_encode($service_visible_sections));
}

$service_hero_video = $service_get_field('service_hero_video');
$service_hero_title = $service_get_field('service_hero_title');
$service_hero_desc = $service_get_field('service_hero_desc');
$service_hero_btn = $service_get_field('service_hero_btn');
$service_hero_awards = $service_get_field('service_hero_awards');

if ($service_visible_sections['service_hero'] && $service_hero_title):
    ?>
    <section class="service-page-hero">
        <div class="container">
            <div class="service-page-hero__wrap" data-hero-video
                 data-path="<?= get_template_directory_uri(); ?>/assets/hero-video-frames">
                <div class="service-page-hero__img" data-aos="zoom-in">
                    <div class="service-page-hero__video">
                        <video autoplay muted loop playsinline src="<?= $service_hero_video; ?>" id="hero-video-canvas">
                        </video>
                    </div>
                </div>
                <div class="service-page-hero__content">
                    <div class="service-page-hero__top" data-aos="fade-up">
                        <h1 class="service-page-hero__title"><?= $service_hero_title; ?></h1>
                        <?php if ($service_hero_desc): ?>
                            <div class="service-page-hero__desc"><?= $service_hero_desc; ?></div>
                        <?php endif; ?>
                        <?php if ($service_hero_btn): ?>
                            <div class="service-page-hero__btn">
                                <a class="btn" href="#demo-popup" data-fancybox=""
                                   data-touch="false"><?= $service_hero_btn; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($service_hero_awards): ?>
                        <div class="service-page-hero__bottom" data-aos="fade" data-aos-delay="200">
                            <div class="service-page-hero__row">
                                <?php $counter = 1;
                                foreach ($service_hero_awards as $service_hero_award): if ($service_hero_award['icon'] || $service_hero_award['desc']): ?>
                                    <div class="service-page-hero__col">
                                        <div class="service-page-hero__item">
                                            <?php if ($service_hero_award['icon']): ?>
                                                <div class="service-page-hero__item-icon"><?= get_retina_img($service_hero_award['icon'], 'Hero Award Icon -' . $counter); ?></div>
                                            <?php endif; ?>
                                            <?php if ($service_hero_award['desc']): ?>
                                                <div class="service-page-hero__item-sub"><?= $service_hero_award['desc']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php $counter++; endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
if ($service_visible_sections['service_banner_min']):
    $service_banner_min_fields = [
        'banner-min-title' => $service_get_banner_min_field('banner-min-title'),
        'banner-min-text' => $service_get_banner_min_field('banner-min-text'),
        'banner-min-background' => $service_get_banner_min_field('banner-min-background'),
        'banner-min-link' => $service_get_banner_min_field('banner-min-link'),
        'banner-min-anim-enabled' => $service_get_banner_min_field('banner-min-anim-enabled'),
        'banner-min-anim-delay' => $service_get_banner_min_field('banner-min-anim-delay'),
    ];

    get_template_part('functions/blocks/banner-min/template', null, [
        'fields' => $service_banner_min_fields,
    ]);
endif;
?>

<?php
$service_why_title = $service_get_field('service_why_title');
$service_why_items = $service_get_field('service_why_items');

if ($service_visible_sections['service_why'] && $service_why_title && $service_why_items):
    ?>
    <section class="service-page-why section">
        <div class="container">
            <h2 class="service-page-why__title" data-aos="fade-up"><?= $service_why_title; ?></h2>
            <div class="service-page-why__row row">
                <?php $counter = 1;
                foreach ($service_why_items as $service_why_item): ?>
                    <div class="service-page-why__col col"
                         data-aos="fade-up"<?= $counter % 2 ? '' : ' data-aos-delay="200"'; ?>>
                        <div class="service-page-why__item">
                            <div class="service-page-why__item-bg">
                                <img src="<?= kama_thumb_src('wh=1184:720', $service_why_item['img']); ?>"
                                     alt="<?= $service_why_title; ?> - BG <?= $counter; ?>">
                            </div>
                            <div class="service-page-why__item-content">
                                <h3 class="service-page-why__item-sub"><?= $service_why_item['title']; ?></h3>
                                <?php if ($service_why_item['desc']): ?>
                                    <div class="service-page-why__item-desc"><?= $service_why_item['desc']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_gallery_title = $service_get_field('service_gallery_title');
$service_gallery_images = $service_get_field('service_gallery_images');
$service_gallery_btn_label = $service_get_field('service_gallery_btn_label');
$service_gallery_btn_url = $service_get_field('service_gallery_btn_url');

if ($service_visible_sections['service_gallery'] && $service_gallery_images):
    ?>
    <section class="service-page-gallery section">
        <div class="service-page-bg-path service-page-bg-path--1">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-1.svg" alt="#">
        </div>
        <div class="service-page-bg-path service-page-bg-path--2">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-2.svg" alt="#">
        </div>
        <?php if ($service_gallery_title): ?>
            <div class="container">
                <h2 class="service-page-gallery__title h4" data-aos="fade-up"><?= $service_gallery_title; ?></h2>
            </div>
        <?php endif; ?>
        <div class="service-page-gallery__slider swiper-container" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php $counter = 1;
                foreach ($service_gallery_images as $service_gallery_image): ?>
                    <div class="service-page-gallery__slide swiper-slide">
                        <div class="service-page-gallery__item">
                            <img src="<?= kama_thumb_src('wh=1168:776', $service_gallery_image); ?>"
                                 alt="Gallery Image - <?= $counter; ?>">
                        </div>
                    </div>
                    <?php $counter++; endforeach; ?>
            </div>
            <div class="service-page-gallery__pagination gallery-pagination"></div>
        </div>
        <?php if ($service_gallery_btn_label && $service_gallery_btn_url): ?>
            <div class="container">
                <div class="service-page-gallery__btn">
                    <a class="btn" href="<?= $service_gallery_btn_url; ?>"><?= $service_gallery_btn_label; ?></a>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php
$service_tech_title = $service_get_field('service_tech_title');
$service_tech_items = $service_get_field('service_tech_items');

if ($service_visible_sections['service_tech'] && $service_tech_title && $service_tech_items):
    ?>
    <section class="service-page-technologies section">
        <div class="service-page-bg-path service-page-bg-path--3">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-3.svg" alt="#">
        </div>
        <div class="service-page-bg-path service-page-bg-path--4">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-4.svg" alt="#">
        </div>
        <div class="container">
            <h2 class="service-page-technologies__title" data-aos="fade-up"><?= $service_tech_title; ?></h2>
            <div class="service-page-technologies__wrap row-lg">
                <div class="service-page-technologies__left col-lg" data-aos="fade-up">
                    <div class="service-page-technologies__tabs js-h-technologies-tabs">
                        <?php $counter = 1;
                        foreach ($service_tech_items as $service_tech_item): ?>
                            <div class="service-page-technologies__tab js-h-technologies-tab"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                                <div class="service-page-technologies__tab-item">
                                    <div class="service-page-technologies__tab-toggle h5 js-h-technologies-toggle">
                                        <span><?= $service_tech_item['title']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/home-technologies-dropdown-arrow.svg"
                                             alt="#">
                                    </div>
                                    <div class="service-page-technologies__tab-dropdown js-h-technologies-dropdown">
                                        <div class="service-page-technologies__tab-content">
                                            <div class="service-page-technologies__tab-desc"><?= $service_tech_item['desc']; ?></div>
                                            <div class="service-page-technologies__tab-bottom">
                                                <?php if ($service_tech_item['hint'] || $service_tech_item['value']): ?>
                                                    <div class="service-page-technologies__tab-hint">
                                                        <?php if ($service_tech_item['hint']): ?>
                                                            <span><?= $service_tech_item['hint']; ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($service_tech_item['value']): ?>
                                                            <b><?= $service_tech_item['value']; ?></b>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($service_tech_item['url']): ?>
                                                    <a class="service-page-technologies__tab-btn"
                                                       href="<?= $service_tech_item['url']; ?>" target="_blank">
                                                        <span>Подробнее</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke="#946AD2"
                                                                  stroke-width="2" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $counter++; endforeach; ?>
                    </div>
                    <div class="service-page-technologies__more">
                        <button class="service-page-technologies__more-btn js-h-technologies-more" type="button">
                            <span>Показать полный список</span>
                            <span>Скрыть полный список</span>
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/technologies-more-icon.svg"
                                 alt="Arrow">
                        </button>
                    </div>
                </div>
                <div class="service-page-technologies__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-technologies__row">
                        <?php $counter = 1;
                        foreach ($service_tech_items as $service_tech_item): ?>
                            <div class="service-page-technologies__col">
                                <div class="service-page-technologies__item">
                                    <button class="service-page-technologies__item-tab-btn h7 js-h-technologies-tab-btn<?= $counter == 1 ? ' active' : ''; ?>"
                                            type="button"><?= $service_tech_item['title']; ?></button>
                                </div>
                            </div>
                            <?php $counter++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_banner_bg = $service_get_field('service_banner_bg');
$service_banner_title = $service_get_field('service_banner_title');
$service_banner_desc = $service_get_field('service_banner_desc');
$service_banner_btn_label = $service_get_field('service_banner_btn_label');
$service_banner_btn_url = $service_get_field('service_banner_btn_url');

if ($service_visible_sections['service_banner'] && $service_banner_bg && $service_banner_title):
    ?>
    <section class="service-page-connect section">
        <div class="service-page-connect__wrap" data-aos="fade-up">
            <div class="service-page-connect__bg">
                <img src="<?= $service_banner_bg; ?>" alt="<?= $service_banner_title; ?>">
            </div>
            <div class="container">
                <div class="service-page-connect__content">
                    <h2 class="service-page-connect__title"><?= $service_banner_title; ?></h2>
                    <div class="service-page-connect__info">
                        <?php if ($service_banner_desc): ?>
                            <div class="service-page-connect__desc"><?= $service_banner_desc; ?></div>
                        <?php endif; ?>
                        <?php if ($service_banner_btn_label && $service_banner_btn_url): ?>
                            <div class="service-page-connect__btn">
                                <a class="btn btn-white"
                                   href="<?= $service_banner_btn_url; ?>"><?= $service_banner_btn_label; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_regions_title = $service_get_field('service_regions_title');
$service_regions_cards = $service_get_field('service_regions_cards');
$service_regions_items = $service_get_field('service_regions_items');

if ($service_visible_sections['service_regions'] && $service_regions_title && $service_regions_items):
    ?>
    <section class="service-page-regions section">
        <div class="service-page-bg-path service-page-bg-path--5">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-5.svg" alt="#">
        </div>
        <div class="container">
            <div class="service-page-regions__wrap">
                <h2 class="service-page-regions__title" data-aos="fade-up"><?= $service_regions_title; ?></h2>
                <div class="service-page-regions__row row-lg">
                    <?php if ($service_regions_cards): ?>
                        <div class="service-page-regions__left col-lg" data-aos="fade-up">
                            <div class="service-page-regions__items">
                                <?php $counter = 1;
                                foreach ($service_regions_cards as $service_regions_card): ?>
                                    <div class="service-page-regions__item">
                                        <?php if ($service_regions_card['icon']): ?>
                                            <div class="service-page-regions__item-icon">
                                                <img src="<?= $service_regions_card['icon']; ?>"
                                                     alt="<?= $service_regions_title; ?> - Icon <?= $counter; ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="service-page-regions__item-sub"><?= $service_regions_card['sub']; ?></div>
                                    </div>
                                    <?php $counter++; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="service-page-regions__map">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/map.svg" alt="Map">
                        <span>Все регионы</span>
                    </div>
                    <div class="service-page-regions__right col-lg" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-page-regions__sub h7">Представительства</div>
                        <div class="service-page-regions__list">
                            <?php foreach ($service_regions_items as $service_regions_item): ?>
                                <div class="service-page-regions__card">
                                    <div class="service-page-regions__card-bg">
                                        <img src="<?= kama_thumb_src('wh=444:258', $service_regions_item['img']); ?>"
                                             alt="<?= $service_regions_item['city']; ?>">
                                    </div>
                                    <div class="service-page-regions__card-wrap">
                                        <div class="service-page-regions__card-toggle h7 js-h-regions-toggle">
                                            <span><?= $service_regions_item['city']; ?></span>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-regions-arrow.svg"
                                                 alt="Arrow">
                                        </div>
                                        <div class="service-page-regions__card-dropdown js-h-regions-dropdown">
                                            <div class="service-page-regions__card-content">
                                                <div class="service-page-regions__card-desc"><?= $service_regions_item['address']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_demo_title = $service_get_field('service_demo_title');
$service_demo_desc_yt = $service_get_field('service_demo_desc_yt');
$service_demo_desc_rutube = $service_get_field('service_demo_desc_rutube');
$service_demo_desc_tg = $service_get_field('service_demo_desc_tg');
$service_demo_desc_habr = $service_get_field('service_demo_desc_habr');

$service_demo_fallback_socials = array_filter([
    [
        'url' => $site_soc_yt,
        'text' => $service_demo_desc_yt,
    ],
    [
        'url' => $site_soc_rutube,
        'text' => $service_demo_desc_rutube,
    ],
    [
        'url' => $site_soc_tg,
        'text' => $service_demo_desc_tg,
    ],
    [
        'url' => $site_soc_habr,
        'text' => $service_demo_desc_habr,
    ],
], static function ($social) {
    return !empty($social['url']) && !empty($social['text']);
});

$service_demo_social_rows = $service_get_field('service_demo_socials');
$service_demo_socials = [];

if (is_array($service_demo_social_rows)) {
    foreach ($service_demo_social_rows as $service_demo_social_row) {
        $service_demo_social_url = isset($service_demo_social_row['url']) ? trim($service_demo_social_row['url']) : '';
        $service_demo_social_text = isset($service_demo_social_row['text']) ? trim($service_demo_social_row['text']) : '';

        if (!$service_demo_social_url || !$service_demo_social_text) {
            continue;
        }

        $service_demo_social_icon = $service_demo_social_row['icon'] ?? 0;
        $service_demo_social_icon_id = is_array($service_demo_social_icon)
            ? absint($service_demo_social_icon['ID'] ?? $service_demo_social_icon['id'] ?? 0)
            : absint($service_demo_social_icon);

        $service_demo_social_bg = $service_demo_social_row['bg'] ?? 0;
        $service_demo_social_bg_id = is_array($service_demo_social_bg)
            ? absint($service_demo_social_bg['ID'] ?? $service_demo_social_bg['id'] ?? 0)
            : absint($service_demo_social_bg);

        $service_demo_socials[] = [
            'url' => $service_demo_social_url,
            'text' => $service_demo_social_text,
            'icon_id' => $service_demo_social_icon_id,
            'bg_id' => $service_demo_social_bg_id,
        ];
    }
} elseif (!empty($service_demo_social_rows) && defined('WP_DEBUG') && WP_DEBUG) {
    error_log('[service-page.demo.socials] Expected service_demo_socials to be an array.');
}

$service_demo_has_managed_socials = !empty($service_demo_socials);
$service_demo_has_socials = $service_demo_has_managed_socials || !empty($service_demo_fallback_socials);
if ($service_visible_sections['service_demo']):
?>
    <section class="service-page-demo section">
        <div class="service-page-bg-path service-page-bg-path--6">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-6.svg" alt="#">
        </div>
        <div class="container">
            <div class="service-page-demo__row row-lg">
                <div class="service-page-demo__left col-lg<?= !$service_demo_has_socials ? ' service-page-demo__left--wide' : ''; ?>" data-aos="fade-up">
                    <form class="service-page-demo__form ajax-wrap js-form">
                        <?php if (!empty($service_demo_title)): ?>
                            <h2 class="service-page-demo__form-sub"><?= $service_demo_title; ?></h2>
                        <?php endif; ?>
                        <div class="service-page-demo__form-row ajax-wrap__item">
                            <?php if ($form_product_options): ?>
                                <div class="service-page-demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select js-feedback-input"
                                                name="product"><?= $form_product_options; ?></select>
                                        <span class="js-select-toggle">Выберите продукт</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($form_partner_options): ?>
                                <div class="service-page-demo__form-col">
                                    <div class="main-select">
                                        <select class="js-select js-feedback-input js-partner-select"
                                                name="partner"><?= $form_partner_options; ?></select>
                                        <span class="js-select-toggle">Выберите дистрибьютора</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="name">
                                        <span>Имя и фамилия</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="company">
                                        <span>Организация</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-tel-input js-feedback-input" type="text"
                                               name="phone">
                                        <span>Номер телефона</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col">
                                <div class="main-input">
                                    <label>
                                        <input class="js-form-input js-feedback-input" type="text" name="email">
                                        <span>E-mail</span>
                                    </label>
                                </div>
                            </div>
                            <div class="service-page-demo__form-col service-page-demo__form-col--lg">
                                <div class="main-input">
                                    <label>
                                        <textarea class="js-form-input js-feedback-input" name="msg"></textarea>
                                        <span>Комментарий</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="service-page-demo__form-bottom ajax-wrap__item">
                            <?php if ($site_forms_agree): ?>
                                <div class="service-page-demo__form-agree"><?= $site_forms_agree; ?></div>
                            <?php endif; ?>
                            <div class="service-page-demo__form-btn">
                                <button class="btn btn-white" type="submit">Отправить</button>
                            </div>
                            <input type="hidden" name="form_name" value="Заявка на демо-версию">
                            <input type="hidden" name="to" value="<?= $site_feedback_main_email; ?>">
                        </div>
                        <div class="service-page-demo__form-mob-btn">
                            <a class="btn btn-white" href="#demo-popup" data-fancybox=""
                               data-touch="false">Продолжить</a>
                        </div>
                    </form>
                </div>
                <?php if ($service_demo_has_socials): ?>
                <div class="service-page-demo__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-demo__soc">
                        <?php if ($service_demo_has_managed_socials): ?>
                            <?php foreach ($service_demo_socials as $service_demo_social): ?>
                                <div class="service-page-demo__soc-col">
                                    <a class="service-page-demo__soc-item" href="<?= esc_url($service_demo_social['url']); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php if ($service_demo_social['icon_id']): ?>
                                            <?php
                                            $service_demo_social_icon = wp_get_attachment_image($service_demo_social['icon_id'], 'full', false, [
                                                'alt' => $service_demo_social['text'],
                                                'class' => 'service-page-demo__soc-icon'
                                            ]);

                                            if ($service_demo_social_icon) {
                                                echo $service_demo_social_icon;
                                            }
                                            ?>
                                        <?php endif; ?>
                                        <span>
                                            <?php if ($service_demo_social['bg_id']): ?>
                                                <?php
                                                $service_demo_social_bg = wp_get_attachment_image($service_demo_social['bg_id'], 'full', false, [
                                                    'alt' => $service_demo_social['text'],
                                                ]);

                                                if ($service_demo_social_bg) {
                                                    echo $service_demo_social_bg;
                                                } elseif (defined('WP_DEBUG') && WP_DEBUG) {
                                                    error_log('[service-page.demo.socials] Invalid social background attachment ID.');
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <span><?= esc_html($service_demo_social['text']); ?></span>
                                            <i>
                                                <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/soc-arrow.svg'); ?>"
                                                     alt="">
                                            </i>
                                        </span>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php if ($site_soc_yt && $service_demo_desc_yt): ?>
                            <div class="service-page-demo__soc-col">
                                <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_yt); ?>" target="_blank" rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="74" height="48" viewBox="0 0 74 48"
                                         fill="none">
                                        <path d="M38.4545 47.9806L24.1265 47.7199C19.4873 47.6292 14.8367 47.8105 10.2887 46.8697C3.36981 45.4642 2.87967 38.5725 2.36674 32.7917C1.66003 24.6645 1.9336 16.39 3.26722 8.3308C4.01953 3.80814 6.98315 1.11042 11.5654 0.815707C27.0332 -0.249781 42.6036 -0.125096 58.0372 0.373643C59.6672 0.418983 61.3086 0.668352 62.9157 0.951727C70.8491 2.33459 71.0429 10.1444 71.5558 16.7187C72.0688 23.361 71.8522 30.0373 70.8719 36.6343C70.0854 42.0977 68.5808 46.677 62.2318 47.1191C54.2757 47.6972 46.5019 48.1619 38.5229 48.0146C38.5229 47.9806 38.4773 47.9806 38.4545 47.9806ZM30.031 34.1519C36.0266 30.7287 41.9082 27.3622 47.8697 23.9617C41.8627 20.5386 35.9924 17.1721 30.031 13.7716V34.1519Z"
                                              fill="#D9D7DA"/>
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-1.svg"
                                             alt="Youtube">
                                        <span><?= esc_html($service_demo_desc_yt); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Youtube">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($site_soc_rutube && $service_demo_desc_rutube): ?>
                            <div class="service-page-demo__soc-col">
                                <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_rutube); ?>" target="_blank" rel="noopener noreferrer">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z"
                                              fill="#D9D7DA"/>
                                        <path d="M29.2848 15.9023H12.3242V35.1424H17.0449V28.8829H26.0906L30.2174 35.1424H35.5035L30.9524 28.854C32.3657 28.6232 33.3834 28.075 34.0053 27.2097C34.6272 26.3444 34.9381 24.9598 34.9381 23.1136V21.6714C34.9381 20.5752 34.825 19.7099 34.6272 19.0464C34.4292 18.383 34.0901 17.806 33.6095 17.2869C33.1006 16.7965 32.5354 16.4503 31.857 16.2196C31.1786 16.0177 30.3308 15.9023 29.2848 15.9023ZM28.5216 24.6424H17.0447V20.1426H28.5218C29.172 20.1426 29.6241 20.258 29.8504 20.4598C30.0761 20.6617 30.2174 21.0368 30.2174 21.5849V23.2002C30.2174 23.7771 30.0761 24.1522 29.85 24.354C29.624 24.5559 29.1716 24.6424 28.5216 24.6424Z"
                                              fill="white"/>
                                        <path d="M38.1605 17.5988C39.9848 17.5988 41.4637 16.0897 41.4637 14.2281C41.4637 12.3665 39.9848 10.8574 38.1605 10.8574C36.3363 10.8574 34.8574 12.3665 34.8574 14.2281C34.8574 16.0897 36.3363 17.5988 38.1605 17.5988Z"
                                              fill="white"/>
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-2.svg"
                                             alt="Rutube">
                                        <span><?= esc_html($service_demo_desc_rutube); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Rutube">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($site_soc_tg && $service_demo_desc_tg): ?>
                            <div class="service-page-demo__soc-col">
                                <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_tg); ?>" target="_blank" rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                         fill="none">
                                        <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z"
                                              fill="#D9D7DA"/>
                                        <path d="M16.2344 25.7557L19.0818 33.6369C19.0818 33.6369 19.4378 34.3743 19.819 34.3743C20.2002 34.3743 25.87 28.4759 25.87 28.4759L32.175 16.2979L16.336 23.7213L16.2344 25.7557Z"
                                              fill="#D9D7DA"/>
                                        <path d="M20.0171 27.7764L19.4705 33.5856C19.4705 33.5856 19.2417 35.3656 21.0213 33.5856C22.8009 31.8056 24.5043 30.433 24.5043 30.433"
                                              fill="white"/>
                                        <path d="M16.2984 26.0356L10.4412 24.1272C10.4412 24.1272 9.74119 23.8432 9.96659 23.1992C10.013 23.0664 10.1066 22.9534 10.3866 22.7592C11.6844 21.8546 34.4078 13.6872 34.4078 13.6872C34.4078 13.6872 35.0494 13.471 35.4278 13.6148C35.5214 13.6438 35.6056 13.6971 35.6719 13.7693C35.7381 13.8415 35.784 13.93 35.8048 14.0258C35.8457 14.1949 35.8628 14.3689 35.8556 14.5428C35.8538 14.6932 35.8356 14.8326 35.8218 15.0512C35.6834 17.2842 31.5418 33.9498 31.5418 33.9498C31.5418 33.9498 31.294 34.925 30.4062 34.9584C30.188 34.9654 29.9707 34.9285 29.7671 34.8497C29.5635 34.771 29.3778 34.652 29.2212 34.5C27.479 33.0014 21.4574 28.9546 20.1268 28.0646C20.0968 28.0441 20.0715 28.0175 20.0527 27.9864C20.0338 27.9554 20.0219 27.9206 20.0176 27.8846C19.999 27.7908 20.101 27.6746 20.101 27.6746C20.101 27.6746 30.5862 18.3546 30.8652 17.3762C30.8868 17.3004 30.8052 17.263 30.6956 17.2962C29.9992 17.5524 17.9268 25.1762 16.5944 26.0176C16.4985 26.0466 16.3971 26.0528 16.2984 26.0356Z"
                                              fill="white"/>
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-3.svg"
                                             alt="Telegram">
                                        <span><?= esc_html($service_demo_desc_tg); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Telegram">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($site_soc_habr && $service_demo_desc_habr): ?>
                            <div class="service-page-demo__soc-col">
                                <a class="service-page-demo__soc-item" href="<?= esc_url($site_soc_habr); ?>" target="_blank" rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="136" height="48" viewBox="0 0 136 48"
                                         fill="none">
                                        <path d="M0 0C3.35453 0.00388381 6.70906 0 10.0598 0.00388381C10.0445 6.14419 10.1018 12.2845 10.033 18.4287C11.5842 16.347 13.8728 14.84 16.4097 14.374C20.0775 13.7759 24.2038 14.4866 26.8859 17.283C29.2967 19.5861 30.187 23.0465 30.2252 26.3128C30.2443 33.2415 30.229 40.1664 30.2328 47.0951C26.8783 47.099 23.5237 47.099 20.1692 47.0951C20.1692 41.4519 20.1692 35.8087 20.1692 30.1694C20.131 28.4373 19.9323 26.4992 18.6677 25.2137C16.7039 23.1048 12.9367 23.4349 11.2136 25.6953C10.2852 26.9808 10.0521 28.6237 10.0636 30.1811V47.0951C6.70906 47.099 3.35453 47.0951 0.00382065 47.099C0 31.4006 0 15.6984 0 0ZM75.6527 0C78.9996 0 82.3465 0 85.6972 0.00388381C85.6972 6.05097 85.7163 12.0981 85.6819 18.1452C87.3974 16.1372 89.7662 14.607 92.4062 14.3235C96.6624 13.6516 101.136 15.1896 104.151 18.3044C110.826 25.2797 110.661 37.9176 103.475 44.4619C100.273 47.5106 95.5697 48.5593 91.3288 47.6582C88.9333 47.1067 86.8204 45.6309 85.2922 43.6967C85.3151 44.8308 85.3113 45.961 85.3113 47.0951C82.0905 47.099 78.8697 47.0951 75.6527 47.099C75.645 31.4006 75.645 15.7022 75.6527 0ZM90.2858 24.4059C87.1452 25.2176 84.7993 28.4761 85.2769 31.7929C85.5023 35.2262 88.6735 38.0808 92.0624 37.8555C95.9633 38.0225 99.3102 34.0882 98.6377 30.1889C98.29 26.2274 94.0338 23.299 90.2858 24.4059ZM37.8474 21.2833C40.3384 16.9956 45.1066 14.071 50.0543 14.1914C53.5388 14.0011 56.8627 15.7916 59.0634 18.4675C59.0558 17.3296 59.0558 16.1916 59.0634 15.0536H68.722C68.722 25.738 68.7297 36.4185 68.7144 47.099C65.4974 47.0951 62.2804 47.099 59.0634 47.0951C59.0596 45.9377 59.0558 44.7803 59.0787 43.6268C57.4167 45.5726 55.2542 47.2388 52.6944 47.6582C47.4716 48.9515 41.8208 46.4659 38.7032 42.1238C34.4775 36.1427 34.2216 27.6178 37.8512 21.2833H37.8474ZM50.1881 24.5457C47.5098 25.4156 45.4734 28.111 45.5536 31.0006C45.4543 34.1659 47.781 37.1914 50.8643 37.7467C55.0212 38.8459 59.4952 35.0087 59.0099 30.6316C58.903 26.3283 54.1615 23.0116 50.1881 24.5457ZM123.953 18.7122C125.478 16.4402 127.862 14.5526 130.628 14.2924C132.298 14.0672 133.998 14.1604 135.637 14.5565C135.687 17.9976 135.637 21.4386 135.224 24.8603C133.108 24.2544 130.903 23.7767 128.699 24.0602C126.322 24.3437 124.362 26.6313 124.377 29.0548C124.412 35.0708 124.393 41.0829 124.393 47.099C121.034 47.099 117.676 47.0912 114.321 47.099C114.299 36.4146 114.321 25.7341 114.31 15.0498H123.969C123.969 16.2693 123.976 17.4888 123.953 18.7083V18.7122Z"
                                              fill="#D9D7DA"/>
                                    </svg>
                                    <span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/demo-soc-icon-4.svg"
                                             alt="Habr">
                                        <span><?= esc_html($service_demo_desc_habr); ?></span>
                                        <i>
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/soc-arrow.svg"
                                                 alt="Habr">
                                        </i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_portfolio_sub = $service_get_field('service_portfolio_sub');
$service_portfolio_title = $service_get_field('service_portfolio_title');
$service_portfolio_items = $service_get_field('service_portfolio_items');
$service_portfolio_desc = $service_get_field('service_portfolio_desc');
$service_portfolio_gallery = $service_get_field('service_portfolio_gallery');
$service_portfolio_gallery_cols = [];

if (is_array($service_portfolio_gallery) && $service_portfolio_gallery) {
    $service_portfolio_gallery_size = ceil(count($service_portfolio_gallery) / 2);
    $service_portfolio_gallery_cols = [
        array_slice($service_portfolio_gallery, 0, $service_portfolio_gallery_size),
        array_slice($service_portfolio_gallery, $service_portfolio_gallery_size)
    ];
}

if ($service_visible_sections['service_portfolio'] && $service_portfolio_title && $service_portfolio_gallery):
    ?>
    <section class="service-page-portfolio section">
        <div class="container">
            <div class="service-page-portfolio__wrap">
                <div class="service-page-portfolio__left service-page-portfolio__col">
                    <?php if ($service_portfolio_sub): ?>
                        <div class="service-page-portfolio__sub" data-aos="fade-up"><?= $service_portfolio_sub; ?></div>
                    <?php endif; ?>
                    <h2 class="service-page-portfolio__title" data-aos="fade-up"><?= $service_portfolio_title; ?></h2>
                    <?php if ($service_portfolio_items): ?>
                        <div class="service-page-portfolio__row" data-aos="fade-up">
                            <?php foreach ($service_portfolio_items as $service_portfolio_item): ?>
                                <div class="service-page-portfolio__item">
                                    <?php if ($service_portfolio_item['icon']): ?>
                                        <img src="<?= $service_portfolio_item['icon']; ?>"
                                             alt="<?= $service_portfolio_item['label']; ?>">
                                    <?php endif; ?>
                                    <span><?= $service_portfolio_item['label']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($service_portfolio_desc): ?>
                        <div class="service-page-portfolio__desc" data-aos="fade-up"><?= $service_portfolio_desc; ?></div>
                    <?php endif; ?>
                </div>
                <?php if ($service_portfolio_gallery_cols): ?>
                    <div class="service-page-portfolio__right service-page-portfolio__col" data-aos="fade-up">
                        <div class="service-page-portfolio__lists">
                            <?php $counter = 1;
                            foreach ($service_portfolio_gallery_cols as $service_portfolio_gallery_col): ?>
                                <div class="service-page-portfolio__list js-infinity-line"
                                     data-duration="15"<?= $counter == 1 ? ' data-revers="1"' : ''; ?>>
                                    <?php $logo_counter = 1;
                                    foreach ($service_portfolio_gallery_col as $service_portfolio_gallery_item): ?>
                                        <div class="service-page-portfolio__logo">
                                            <img src="<?= kama_thumb_src('wh=548:278', $service_portfolio_gallery_item); ?>"
                                                 alt="<?= $service_portfolio_sub; ?> - Logo <?= $logo_counter; ?>">
                                        </div>
                                        <?php $logo_counter++; endforeach; ?>
                                </div>
                                <?php $counter++; endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="service-page-portfolio__slider swiper-container" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <?php $logo_counter = 1;
                    foreach ($service_portfolio_gallery as $service_portfolio_gallery_item): ?>
                        <div class="service-page-portfolio__slide swiper-slide">
                            <div class="service-page-portfolio__logo">
                                <img src="<?= kama_thumb_src('wh=548:278', $service_portfolio_gallery_item); ?>"
                                     alt="<?= $service_portfolio_sub; ?> - Logo <?= $logo_counter; ?>">
                            </div>
                        </div>
                        <?php $logo_counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_video_items = $service_get_field('service_video_items');

if ($service_visible_sections['service_video'] && $service_video_items):
    ?>
    <section class="service-page-product-video section">
        <div class="container">
            <div class="service-page-product-video__tabs" data-aos="fade-up">
                <?php $counter = 1;
                foreach ($service_video_items as $service_video_item): ?>
                    <button class="service-page-product-video__tab js-h-product-video-tab<?= $counter == 1 ? ' active' : ''; ?>"
                            type="button"><?= $service_video_item['label']; ?></button>
                    <?php $counter++; endforeach; ?>
            </div>
            <div class="service-page-product-video__wrap" data-aos="fade-up">
                <?php $counter = 1;
                foreach ($service_video_items as $service_video_item): ?>
                    <div class="service-page-product-video__block js-h-product-video-block"<?= $counter == 1 ? ' style="display: block;"' : ''; ?>>
                        <div class="service-page-product-video__item js-h-product-video-item">
                            <video playsinline controls>
                                <source src="<?= $service_video_item['video']; ?>" type="video/mp4">
                            </video>
                            <div class="service-page-product-video__item-bg">
                                <img src="<?= kama_thumb_src('wh=1200:648', $service_video_item['bg']); ?>"
                                     alt="<?= $service_video_item['label']; ?>">
                                <button class="service-page-product-video__item-btn" type="button">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/play-icon.svg" alt="Play">
                                </button>
                            </div>
                            <div class="service-page-product-video__item-header">
                                <div class="service-page-product-video__item-tag h7"><?= $service_video_item['label']; ?></div>
                                <div class="service-page-product-video__item-desc h7"><?= $service_video_item['desc']; ?></div>
                            </div>
                            <div class="service-page-product-video__item-footer">
                                <h2 class="service-page-product-video__item-title h1"><?= $service_video_item['title']; ?></h2>
                                <div class="service-page-product-video__item-logo">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/home-product-video-logo.svg"
                                         alt="Space">
                                </div>
                            </div>
                        </div>
                        <div class="service-page-product-video__mob-desc"><?= $service_video_item['desc']; ?></div>
                    </div>
                    <?php $counter++; endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_faq_title = $service_get_field('service_faq_title');
$service_faq_bg = $service_get_field('service_faq_bg');
$service_faq_items = $service_get_field('service_faq_items');

if ($service_visible_sections['service_faq'] && $service_faq_items):
    ?>
    <section class="service-page-faq section">
        <div class="container">
            <div class="service-page-faq__wrap">
                <?php if ($service_faq_title && $service_faq_bg): ?>
                    <div class="service-page-faq__left" data-aos="fade-up">
                        <div class="service-page-faq__block">
                            <div class="service-page-faq__block-bg">
                                <img src="<?= $service_faq_bg; ?>" alt="FAQ">
                            </div>
                            <h2 class="service-page-faq__block-title h3"><?= $service_faq_title; ?></h2>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="service-page-faq__right" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-faq__list">
                        <?php foreach ($service_faq_items as $service_faq_item): ?>
                            <div class="service-page-faq__col">
                                <div class="service-page-faq__item">
                                    <div class="service-page-faq__toggle h7 js-faq-toggle">
                                        <span><?= $service_faq_item['question']; ?></span>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/faq-arrow.svg"
                                             alt="Arrow">
                                    </div>
                                    <div class="service-page-faq__dropdown js-faq-dropdown">
                                        <div class="service-page-faq__content"><?= $service_faq_item['answer']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_media_title = $service_get_field('service_media_title');
$service_media_desc = $service_get_field('service_media_desc');
$service_media_items = $service_get_field('service_media_items');

if ($service_visible_sections['service_media'] && $service_media_title && $service_media_items):
    ?>
    <section class="service-page-media section">
        <div class="container">
            <h2 class="service-page-media__title" data-aos="fade-up"><?= $service_media_title; ?></h2>
            <?php if ($service_media_desc): ?>
                <div class="service-page-media__desc" data-aos="fade-up"><?= $service_media_desc; ?></div>
            <?php endif; ?>
            <div class="service-page-media__slider swiper-container">
                <div class="swiper-wrapper">
                    <?php $counter = 1;
                    foreach ($service_media_items as $service_media_item): ?>
                        <div class="service-page-media__slide swiper-slide" data-aos="fade-up"
                             data-aos-delay="<?= ($counter - 1) * 200; ?>">
                            <a class="service-page-media__card" href="<?= $service_media_item['url']; ?>" target="_blank">
                                <div class="service-page-media__card-text"><?= $service_media_item['text']; ?></div>
                                <div class="service-page-media__card-logo"><?= get_retina_img($service_media_item['logo'], 'SMI - Logo ' . $counter); ?></div>
                                <div class="service-page-media__card-btn">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/home-media-arrow.svg"
                                         alt="Arrow">
                                </div>
                            </a>
                        </div>
                        <?php $counter++; endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$service_news_title = $service_get_field('service_news_title');
$service_news_btn_label = $service_get_field('service_news_btn_label');
$service_news_btn_url = $service_get_field('service_news_btn_url');

$news_arr = [];
if ($service_visible_sections['service_news']) {
    $news_term_ids = space_get_blog_category_term_ids( SPACE_BLOG_CATEGORY_SECTION_NEWS );
    $args = array(
        'post_type' => 'blog',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
                array(
                        'taxonomy' => 'blog_category',
                        'field' => 'term_id',
                        'terms' => $news_term_ids ?: [0]
                )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $news_arr[] = get_the_ID();
        }
        wp_reset_postdata();
    }
}

if ($service_visible_sections['service_news'] && $news_arr && count($news_arr) == 4):
    ?>
    <section class="service-page-news section">
        <div class="service-page-bg-path service-page-bg-path--7">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/home-bg-part-7.svg" alt="#">
        </div>
        <div class="container">
            <?php if ($service_news_title): ?>
                <h2 class="service-page-news__title" data-aos="fade-up"><?= $service_news_title; ?></h2>
            <?php endif; ?>
            <div class="service-page-news__row row-lg">
                <div class="service-page-news__left col-lg" data-aos="fade-up">
                    <?php get_template_part('templates/parts/news-card-lg', null, ['card_id' => $news_arr[0]]); ?>
                </div>
                <div class="service-page-news__right col-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-page-news__list">
                        <?php foreach ($news_arr as $news_item): ?>
                            <div class="service-page-news__col">
                                <?php get_template_part('templates/parts/news-card-small', null, ['card_id' => $news_item]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if ($service_news_btn_label && $service_news_btn_url): ?>
                <div class="service-page-news__btn">
                    <a class="btn" href="<?= $service_news_btn_url; ?>"><?= $service_news_btn_label; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
