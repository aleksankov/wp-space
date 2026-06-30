<?php
/**
 * One-time migration for service page fallback values into ACF post meta.
 *
 * Usage from project root:
 * php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571
 * php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571 --apply
 * php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571 --verify
 *
 * Usage with WP-CLI:
 * wp eval-file wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php -- --post-id=7571 --apply
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('CLI only.');
}

if (!defined('ABSPATH')) {
    define('WP_USE_THEMES', false);

    $wp_load = dirname(__DIR__, 5) . '/wp-load.php';

    if (!file_exists($wp_load)) {
        fwrite(STDERR, "ERROR [service-page-acf-migration] wp-load.php not found.\n");
        exit(1);
    }

    require_once $wp_load;
}

function space_service_page_migration_log($level, $message, array $context = []) {
    $line = strtoupper($level) . ' [service-page-acf-migration] ' . $message;

    if ($context) {
        $line .= ' ' . wp_json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    fwrite('ERROR' === strtoupper($level) ? STDERR : STDOUT, $line . PHP_EOL);
}

function space_service_page_migration_parse_args(array $argv) {
    $tokens = [];

    if (isset($GLOBALS['args']) && is_array($GLOBALS['args'])) {
        $tokens = $GLOBALS['args'];
    } elseif (count($argv) > 1) {
        $tokens = array_slice($argv, 1);
    }

    $options = [
        'post_id' => 7571,
        'apply'   => false,
        'verify'  => false,
        'help'    => false,
    ];

    for ($index = 0; $index < count($tokens); $index++) {
        $token = $tokens[$index];

        if ('--' === $token) {
            continue;
        }

        if ('--help' === $token || '-h' === $token) {
            $options['help'] = true;
            continue;
        }

        if ('--apply' === $token) {
            $options['apply'] = true;
            $options['verify'] = true;
            continue;
        }

        if ('--verify' === $token) {
            $options['verify'] = true;
            continue;
        }

        if (0 === strpos($token, '--post-id=')) {
            $options['post_id'] = absint(substr($token, strlen('--post-id=')));
            continue;
        }

        if ('--post-id' === $token && isset($tokens[$index + 1])) {
            $options['post_id'] = absint($tokens[++$index]);
            continue;
        }

        space_service_page_migration_log('WARN', 'Unknown argument ignored.', ['arg' => $token]);
    }

    return $options;
}

function space_service_page_migration_print_help() {
    echo "Usage:\n";
    echo "  php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571\n";
    echo "  php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571 --apply\n";
    echo "  php wp-content/themes/space/functions/migrations/service-page-fallbacks-to-acf.php --post-id=7571 --verify\n";
}

function space_service_page_migration_fields() {
    return [
        [
            'name'  => 'service_hero_show',
            'key'   => 'field_6a3d0932f001',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_hero_video',
            'key'   => 'field_6a3d0932ca231',
            'type'  => 'file',
            'value' => '/wp-content/uploads/2025/10/webm_01.webm',
        ],
        [
            'name'  => 'service_hero_image',
            'key'   => 'field_6a3d0932ca232',
            'type'  => 'image',
            'value' => '',
        ],
        [
            'name'  => 'service_hero_title',
            'key'   => 'field_6a3d0932cdcfe',
            'type'  => 'text',
            'value' => 'Экосистема виртуализации <span>Space</span>',
        ],
        [
            'name'  => 'service_hero_desc',
            'key'   => 'field_6a3d0932d1909',
            'type'  => 'textarea',
            'value' => "Строим надежную российскую <br />\nвиртуальную ИТ-инфраструктуру",
        ],
        [
            'name'  => 'service_hero_btn',
            'key'   => 'field_6a3d0932d5450',
            'type'  => 'text',
            'value' => 'Протестировать',
        ],
        [
            'name'  => 'service_hero_awards',
            'key'   => 'field_6a3d0932d8f24',
            'type'  => 'repeater',
            'value' => [
                [
                    'icon' => false,
                    'desc' => '<span>CNEWS:</span> Лидер рейтинга платформ виртуализации 2025',
                ],
                [
                    'icon' => false,
                    'desc' => '<span>TAdviser:</span> ТОП-3 по финансовым результатам на рынке виртуализации 2024',
                ],
                [
                    'icon' => false,
                    'desc' => '<span>CNEWS Awards 2025:</span> Разработчик года в области корпоративной виртуализации',
                ],
            ],
            'media_subfields' => ['icon'],
        ],
        [
            'name'  => 'service_products_show',
            'key'   => 'field_6a3d0933e1010',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_products_title',
            'key'   => 'field_6a3d0933e1020',
            'type'  => 'text',
            'value' => 'Решения для построения корпоративного облака',
        ],
        [
            'name'  => 'service_products_desc',
            'key'   => 'field_6a3d0933e1030',
            'type'  => 'textarea',
            'value' => 'Экосистема продуктов для&nbsp;виртуализации и VDI уровня&nbsp;Enterprise',
        ],
        [
            'name'  => 'service_products_items',
            'key'   => 'field_6a3d0933e1040',
            'type'  => 'repeater',
            'value' => [
                [
                    'bg'    => '/wp-content/uploads/2025/02/product-card-bg-1.svg',
                    'color' => '#41b4bf',
                    'label' => 'SpaceVM',
                    'desc'  => 'Платформа серверной виртуализации',
                    'url'   => '/space-vm/',
                ],
                [
                    'bg'    => '/wp-content/uploads/2025/09/space-vdi-card-2.svg',
                    'color' => '#946ad2',
                    'label' => 'Space VDI',
                    'desc'  => 'Управление виртуальными рабочими столами',
                    'url'   => '/space-vdi/',
                ],
                [
                    'bg'    => '/wp-content/uploads/2025/09/space-cloud-card-1.svg',
                    'color' => '#4182cc',
                    'label' => 'Space Cloud',
                    'desc'  => 'Управление облачной инфраструктурой',
                    'url'   => '/space-cloud/',
                ],
                [
                    'bg'    => '/wp-content/uploads/2025/02/product-card-bg-3.svg',
                    'color' => '#ff8c53',
                    'label' => 'Space Client',
                    'desc'  => 'Подключение клиентских устройств к VDI',
                    'url'   => '/space-client/',
                ],
            ],
            'media_subfields' => ['bg'],
        ],
        [
            'name'  => 'service_banner_min_show',
            'key'   => 'field_6a3d0932f002',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'banner-min-title',
            'key'   => 'field_6a3d0932e0332',
            'type'  => 'text',
            'value' => 'Протестируйте решения Space',
        ],
        [
            'name'  => 'banner-min-text',
            'key'   => 'field_6a3d0932e3dcd',
            'type'  => 'wysiwyg',
            'value' => '<p>Оставьте заявку, и мы поможем подобрать конфигурацию под вашу инфраструктуру.</p>',
        ],
        [
            'name'  => 'banner-min-background',
            'key'   => 'field_6a3d0932e7848',
            'type'  => 'image',
            'value' => 226,
        ],
        [
            'name'  => 'banner-min-link',
            'key'   => 'field_6a3d0933bef65',
            'type'  => 'text',
            'value' => '/contacts/',
        ],
        [
            'name'  => 'banner-min-anim-enabled',
            'key'   => 'field_6a3d0933c2b17',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'banner-min-anim-delay',
            'key'   => 'field_6a3d0933c6647',
            'type'  => 'number',
            'value' => 150,
        ],
        [
            'name'  => 'service_callout_show',
            'key'   => 'field_6a3d0933d0020',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_callout_title',
            'key'   => 'field_6a3d0933d0030',
            'type'  => 'text',
            'value' => 'Подберите решение Space под вашу инфраструктуру',
        ],
        [
            'name'  => 'service_callout_text',
            'key'   => 'field_6a3d0933d0040',
            'type'  => 'wysiwyg',
            'value' => '<p>Расскажите о задачах вашей команды, и мы предложим конфигурацию, которая подойдет по масштабу, требованиям безопасности и сценарию внедрения.</p>',
        ],
        [
            'name'  => 'service_callout_btn_label',
            'key'   => 'field_6a3d0933d0050',
            'type'  => 'text',
            'value' => 'Обсудить проект',
        ],
        [
            'name'  => 'service_callout_btn_url',
            'key'   => 'field_6a3d0933d0060',
            'type'  => 'text',
            'value' => '#demo-popup',
        ],
        [
            'name'  => 'service_callout_anim_enabled',
            'key'   => 'field_6a3d0933d0070',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_callout_anim_delay',
            'key'   => 'field_6a3d0933d0080',
            'type'  => 'number',
            'value' => 200,
        ],
        [
            'name'  => 'service_why_show',
            'key'   => 'field_6a3d0932f003',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_why_title',
            'key'   => 'field_6a3d0932eeeb5',
            'type'  => 'text',
            'value' => 'Почему выбирают решения Space',
        ],
        [
            'name'  => 'service_why_items',
            'key'   => 'field_6a3d0932f282b',
            'type'  => 'repeater',
            'value' => [
                [
                    'img'   => 4614,
                    'title' => 'Проприетарность',
                    'desc'  => 'Не опираемся на готовые решения, а разрабатываем все собственными силами',
                ],
                [
                    'img'   => 4616,
                    'title' => 'Экосистемность',
                    'desc'  => 'Создаём технологически связанную и бесшовную экосистему продуктов: от виртуализации серверов и VDI-решений до управления корпоративными облаками ',
                ],
                [
                    'img'   => 4615,
                    'title' => "Отечественная <br />\nвиртуализация",
                    'desc'  => 'Соответствуем национальным стандартам и&nbsp;требованиям&nbsp;по&nbsp;безопасности',
                ],
                [
                    'img'   => 4617,
                    'title' => 'Кастомизация',
                    'desc'  => 'Находимся в тесном контакте с заказчиками и формируем дорожную карту исходя из их запросов ',
                ],
            ],
            'media_subfields' => ['img'],
        ],
        [
            'name'  => 'service_tech_show',
            'key'   => 'field_6a3d0932f005',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_tech_title',
            'key'   => 'field_6a3d0933181f1',
            'type'  => 'text',
            'value' => 'Проприетарные технологии Space',
        ],
        [
            'name'  => 'service_tech_items',
            'key'   => 'field_6a3d09331be92',
            'type'  => 'repeater',
            'value' => [
                ['title' => 'One click', 'desc' => 'Установка из коробки', 'hint' => 'Альтернатива', 'value' => ' Мастер установки ESXi', 'url' => ''],
                ['title' => 'Space Stor', 'desc' => 'Эффективная работа c уровнем хранения данных в виртуальной ИТ-инфраструктуре', 'hint' => '', 'value' => ' ', 'url' => '/technology/space-stor/'],
                ['title' => 'SDN Flow', 'desc' => 'Управление виртуальными сетями', 'hint' => 'Альтернатива', 'value' => ' VMware NSX', 'url' => '/technology/sdn_flow/'],
                ['title' => 'Space Agent VDI', 'desc' => 'Утилиты для улучшения взаимодействия пользователей с физическими машинами', 'hint' => 'Альтернатива', 'value' => ' VM Horizon Agent', 'url' => '/vdi-docs/latest/broker/utils/agent_vdi/space_vd_utils/'],
                ['title' => 'Space Dispatcher', 'desc' => 'Система управления виртуальными рабочими столами', 'hint' => 'Альтернатива', 'value' => ' VMware Horizon', 'url' => '/vdi-docs/latest/broker/engineer_guide/install/general_settings/'],
                ['title' => 'Протокол GLINT', 'desc' => 'Протокол подключения к удаленному рабочему столу ', 'hint' => 'Альтернатива', 'value' => ' RDP/FreeRDP', 'url' => '/client-docs/latest/connect/settings/glint_setting/'],
                ['title' => 'Space Agent VM', 'desc' => 'Набор системных утилит для повышения производительности виртуальной машины', 'hint' => 'Альтернатива', 'value' => ' VMware Agent VM', 'url' => '/vdi-docs/latest/broker/utils/guest_agent/info/'],
                ['title' => 'FreeGRID', 'desc' => 'Работа видеокарт NVIDIA без риска блокировки', 'hint' => 'Альтернатива', 'value' => ' NVIDIA GRID', 'url' => '/docs/latest/how_to/freegrid/'],
                ['title' => 'Контроллер SpaceVM', 'desc' => 'Построение частного облака в корпоративной среде', 'hint' => 'Альтернатива', 'value' => ' VMware VCenter', 'url' => '/docs/latest/base/operator_guide/domains/control/controllers/'],
                ['title' => 'Space Client Getmobit', 'desc' => 'Интеграция c многофункциональной док-станцией GM-Box', 'hint' => '', 'value' => '', 'url' => ''],
                ['title' => 'Mediapipe', 'desc' => 'Сжатие и оптимизация мультимедиа трафика, GPU-ускорение, поддержка USB в виртуальных сессиях', 'hint' => 'Альтернатива', 'value' => 'Citrix HDX', 'url' => ''],
                ['title' => 'Space Gateway', 'desc' => 'Подключение внешних пользователей', 'hint' => '', 'value' => ' ', 'url' => '/vdi-docs/latest/broker/operator_guide/settings/system/gateway/'],
            ],
        ],
        [
            'name'  => 'service_demo_show',
            'key'   => 'field_6a3d0932f008',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_demo_title',
            'key'   => 'field_6a3d093348264',
            'type'  => 'text',
            'value' => 'Оставьте заявку на&nbsp;демо-версию',
        ],
        [
            'name'  => 'service_demo_desc_yt',
            'key'   => 'field_6a3d09334bd12',
            'type'  => 'text',
            'value' => 'Показываем, как построить виртуальную ИТ-инфраструктуру',
        ],
        [
            'name'  => 'service_demo_desc_rutube',
            'key'   => 'field_6a3d09334f6df',
            'type'  => 'text',
            'value' => 'Показываем, как построить виртуальную ИТ-инфраструктуру',
        ],
        [
            'name'  => 'service_demo_desc_tg',
            'key'   => 'field_6a3d09335326d',
            'type'  => 'text',
            'value' => 'Публикуем новости, полезные советы и обновления',
        ],
        [
            'name'  => 'service_demo_desc_habr',
            'key'   => 'field_6a3d093356e42',
            'type'  => 'text',
            'value' => 'Статьи и гайды по работе с&nbsp;продуктами Space',
        ],
        [
            'name'  => 'service_demo_socials',
            'key'   => 'field_6a3d09335a8ce',
            'type'  => 'repeater',
            'value' => false,
            'media_subfields' => ['icon', 'bg'],
        ],
        [
            'name'  => 'service_faq_show',
            'key'   => 'field_6a3d0932f00b',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_faq_title',
            'key'   => 'field_6a3d09337f8c3',
            'type'  => 'textarea',
            'value' => "Ответы на часто <br />\nзадаваемые <br />\nвопросы",
        ],
        [
            'name'  => 'service_faq_bg',
            'key'   => 'field_6a3d093383366',
            'type'  => 'image',
            'value' => '/wp-content/uploads/2025/02/faq-block-bg.svg',
        ],
        [
            'name'  => 'service_faq_items',
            'key'   => 'field_6a3d093386e0f',
            'type'  => 'repeater',
            'value' => [
                ['question' => 'На базе какого СПО построена SpaceVM?', 'answer' => "<p>Ядро нашего гипервизора - KVM (Kernel-based Virtual Machine).<br />\nСистема управления гипервизором SpaceVM написана нашими силами с нуля</p>\n"],
                ['question' => 'Какой функциональностью обладает SpaceVM по сравнению с VMware?', 'answer' => "<p>SpaceVM на 86% покрывает функциональность всех модулей VMware</p>\n"],
                ['question' => 'Какие лицензии NVIDIA GRID – vApps/vPC/vWs - заменяет FreeGRID?', 'answer' => "<p>FreeGRID полностью заменяет систему лицензирования со всеми функциями. Работает как профилирование так и проброс</p>\n"],
                ['question' => 'Какие есть инструменты для миграции?', 'answer' => "<p>Зависит от масштабов проекта. Для миграции небольшого количества виртуальных машин можно использовать встроенные средства миграции SpaceVM. Автоматическая миграция сотен и тысяч ВМ проводится с помощью решений Mind Migrate (если требуется живая миграция), СУПеР и КиберБэкап   </p>\n"],
                ['question' => 'Какие средства резервного копирования поддерживает SpaceVM?', 'answer' => "<p>SpaceVM поддерживает систему резервного копирования Кибер Бэкап. Чтобы ее использовать, необходимо приобрести лицензию от КиберПротект</p>\n"],
            ],
        ],
        [
            'name'  => 'service_news_show',
            'key'   => 'field_6a3d0932f00d',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_news_title',
            'key'   => 'field_6a3d09339cf0d',
            'type'  => 'text',
            'value' => 'Новости',
        ],
        [
            'name'  => 'service_news_btn_label',
            'key'   => 'field_6a3d0933a092e',
            'type'  => 'text',
            'value' => 'Смотреть все новости',
        ],
        [
            'name'  => 'service_news_btn_url',
            'key'   => 'field_6a3d0933a440f',
            'type'  => 'text',
            'value' => '/news_page',
        ],
        [
            'name'  => 'service_banner_min_after_news_show',
            'key'   => 'field_6a3d0933a9002',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_banner_min_after_news_title',
            'key'   => 'field_6a3d0933a9003',
            'type'  => 'text',
            'value' => 'Протестируйте решения Space',
        ],
        [
            'name'  => 'service_banner_min_after_news_text',
            'key'   => 'field_6a3d0933a9004',
            'type'  => 'wysiwyg',
            'value' => '<p>Оставьте заявку, и мы поможем подобрать конфигурацию под вашу инфраструктуру.</p>',
        ],
        [
            'name'  => 'service_banner_min_after_news_background',
            'key'   => 'field_6a3d0933a9005',
            'type'  => 'image',
            'value' => 226,
        ],
        [
            'name'  => 'service_banner_min_after_news_link',
            'key'   => 'field_6a3d0933a9006',
            'type'  => 'text',
            'value' => '/contacts/',
        ],
        [
            'name'  => 'service_banner_min_after_news_anim_enabled',
            'key'   => 'field_6a3d0933a9007',
            'type'  => 'true_false',
            'value' => true,
        ],
        [
            'name'  => 'service_banner_min_after_news_anim_delay',
            'key'   => 'field_6a3d0933a9008',
            'type'  => 'number',
            'value' => 150,
        ],
    ];
}

function space_service_page_migration_attachment_id_from_value($value) {
    if (!$value) {
        return $value;
    }

    if (is_numeric($value)) {
        $attachment_id = absint($value);

        return 'attachment' === get_post_type($attachment_id) ? $attachment_id : false;
    }

    if (!is_string($value)) {
        return false;
    }

    $url = 0 === strpos($value, '/') ? home_url($value) : $value;
    $attachment_id = attachment_url_to_postid($url);

    if ($attachment_id) {
        return $attachment_id;
    }

    $path = wp_parse_url($url, PHP_URL_PATH);

    if (!$path) {
        return false;
    }

    $uploads = wp_upload_dir();
    $base_path = wp_parse_url($uploads['baseurl'], PHP_URL_PATH);

    if (!$base_path || 0 !== strpos($path, $base_path)) {
        return false;
    }

    $relative_path = ltrim(substr($path, strlen($base_path)), '/');
    $relative_path = rawurldecode($relative_path);

    if (!$relative_path) {
        return false;
    }

    global $wpdb;

    $attachment_id = (int) $wpdb->get_var(
        $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value = %s LIMIT 1",
            $relative_path
        )
    );

    return $attachment_id && 'attachment' === get_post_type($attachment_id) ? $attachment_id : false;
}

function space_service_page_migration_normalize_value(array $field, array &$stats) {
    $value = $field['value'];
    $type = $field['type'];

    if ('true_false' === $type) {
        return $value ? 1 : 0;
    }

    if ('number' === $type) {
        return is_numeric($value) ? 0 + $value : $value;
    }

    if ('image' === $type || 'file' === $type) {
        $attachment_id = space_service_page_migration_attachment_id_from_value($value);

        if (false === $attachment_id && $value) {
            $stats['unresolved_media']++;
            space_service_page_migration_log('WARN', 'Media value could not be resolved to attachment ID.', [
                'field' => $field['name'],
                'value' => $value,
            ]);
        }

        return $attachment_id;
    }

    if ('repeater' === $type) {
        if (!$value || !is_array($value)) {
            return $value;
        }

        $media_subfields = isset($field['media_subfields']) ? $field['media_subfields'] : [];
        $rows = [];

        foreach ($value as $row_index => $row) {
            foreach ($media_subfields as $subfield) {
                if (!array_key_exists($subfield, $row)) {
                    continue;
                }

                $attachment_id = space_service_page_migration_attachment_id_from_value($row[$subfield]);

                if (false === $attachment_id && $row[$subfield]) {
                    $stats['unresolved_media']++;
                    space_service_page_migration_log('WARN', 'Repeater media value could not be resolved to attachment ID.', [
                        'field' => $field['name'],
                        'row' => $row_index,
                        'subfield' => $subfield,
                        'value' => $row[$subfield],
                    ]);
                }

                $row[$subfield] = $attachment_id;
            }

            $rows[] = $row;
        }

        return $rows;
    }

    return $value;
}

function space_service_page_migration_values_match($expected, $actual, $type) {
    if ('true_false' === $type) {
        return (int) (bool) $expected === (int) (bool) $actual;
    }

    if ('number' === $type) {
        return (string) $expected === (string) $actual;
    }

    if ('image' === $type || 'file' === $type) {
        if (!$expected) {
            return empty($actual);
        }

        return (int) $expected === (int) $actual;
    }

    if ('repeater' === $type) {
        if (!$expected) {
            return empty($actual);
        }

        return is_array($actual) && count($expected) === count($actual);
    }

    if (in_array($type, ['text', 'textarea', 'wysiwyg'], true)) {
        $expected_string = str_replace(["\r\n", "\r"], "\n", (string) $expected);
        $actual_string = str_replace(["\r\n", "\r"], "\n", (string) $actual);

        if ($expected_string === $actual_string) {
            return true;
        }

        return trim(wp_strip_all_tags($expected_string)) === trim(wp_strip_all_tags($actual_string));
    }

    return (string) $expected === (string) $actual;
}

function space_service_page_migration_field_verified(array $field, $post_id, $normalized_value) {
    $reference_key = get_post_meta($post_id, '_' . $field['name'], true);

    if ($reference_key !== $field['key']) {
        return false;
    }

    $raw_value = get_field($field['name'], $post_id, false);

    return space_service_page_migration_values_match($normalized_value, $raw_value, $field['type']);
}

function space_service_page_migration_validate_target($post_id) {
    if (!$post_id || 'page' !== get_post_type($post_id)) {
        space_service_page_migration_log('ERROR', 'Target post is not a valid page.', ['post_id' => $post_id]);

        return false;
    }

    $template = get_page_template_slug($post_id);

    if ('templates/service-page/service-page.php' !== $template) {
        space_service_page_migration_log('WARN', 'Target page uses a different template.', [
            'post_id' => $post_id,
            'template' => $template,
        ]);
    }

    return true;
}

function space_service_page_migration_run(array $argv) {
    $options = space_service_page_migration_parse_args($argv);

    if ($options['help']) {
        space_service_page_migration_print_help();

        return 0;
    }

    if (!function_exists('get_field') || !function_exists('update_field')) {
        space_service_page_migration_log('ERROR', 'ACF functions are unavailable.');

        return 1;
    }

    $post_id = absint($options['post_id']);

    if (!space_service_page_migration_validate_target($post_id)) {
        return 1;
    }

    $fields = space_service_page_migration_fields();
    $stats = [
        'planned' => 0,
        'updated' => 0,
        'unchanged' => 0,
        'failed' => 0,
        'verified' => 0,
        'unresolved_media' => 0,
    ];

    space_service_page_migration_log('INFO', 'Starting migration.', [
        'post_id' => $post_id,
        'mode' => $options['apply'] ? 'apply' : 'dry-run',
        'verify' => (bool) $options['verify'],
    ]);

    foreach ($fields as $field) {
        $normalized_value = space_service_page_migration_normalize_value($field, $stats);
        $stats['planned']++;

        if (!$options['apply']) {
            continue;
        }

        $result = update_field($field['key'], $normalized_value, $post_id);
        $verified = space_service_page_migration_field_verified($field, $post_id, $normalized_value);

        if ($result && $verified) {
            $stats['updated']++;
            continue;
        }

        if (!$result && $verified) {
            $stats['unchanged']++;
            continue;
        }

        $stats['failed']++;
        space_service_page_migration_log('ERROR', 'Field write verification failed.', [
            'field' => $field['name'],
            'key' => $field['key'],
        ]);
    }

    if ($options['verify']) {
        foreach ($fields as $field) {
            $verify_stats = ['unresolved_media' => 0];
            $normalized_value = space_service_page_migration_normalize_value($field, $verify_stats);

            if (space_service_page_migration_field_verified($field, $post_id, $normalized_value)) {
                $stats['verified']++;
            } else {
                $stats['failed']++;
                space_service_page_migration_log('ERROR', 'Field verification failed.', [
                    'field' => $field['name'],
                    'key' => $field['key'],
                ]);
            }
        }
    }

    space_service_page_migration_log('INFO', 'Migration finished.', $stats);

    return $stats['failed'] > 0 || $stats['unresolved_media'] > 0 ? 1 : 0;
}

exit(space_service_page_migration_run(isset($argv) ? $argv : []));
