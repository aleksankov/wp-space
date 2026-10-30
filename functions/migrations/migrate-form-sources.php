<?php

/** Create reusable form sources and attach editable popup references to target pages. */

if (!defined('ABSPATH') || !defined('WP_CLI') || !WP_CLI) {
    exit;
}

$mode = sanitize_key($args[0] ?? 'dry-run');
if (!in_array($mode, ['dry-run', 'apply', 'verify', 'rollback'], true)) {
    WP_CLI::error('Mode must be dry-run, apply, verify or rollback.');
}

$backup_directory = dirname(ABSPATH) . '/.ai-factory/backups/forms';

if ($mode === 'rollback') {
    $backup_file = $args[1] ?? '';
    $real_backup = $backup_file !== '' ? realpath($backup_file) : false;
    $real_directory = is_dir($backup_directory) ? realpath($backup_directory) : false;
    if (!$real_backup || !$real_directory || strpos($real_backup, $real_directory . DIRECTORY_SEPARATOR) !== 0) {
        WP_CLI::error('Rollback file must be an existing source backup from .ai-factory/backups/forms.');
    }

    $backup = json_decode((string) file_get_contents($real_backup), true);
    if (!is_array($backup) || ($backup['kind'] ?? '') !== 'form-sources') {
        WP_CLI::error('Invalid form source backup.');
    }

    foreach ((array) ($backup['pages'] ?? []) as $row) {
        $post = get_post(absint($row['id'] ?? 0));
        $content = base64_decode((string) ($row['content_base64'] ?? ''), true);
        if (!$post instanceof WP_Post || !is_string($content) || $post->post_type !== ($row['post_type'] ?? '')) {
            WP_CLI::error('Rollback target is missing or changed: ' . sanitize_key((string) ($row['slug'] ?? 'unknown')) . '.');
        }
        $result = wp_update_post(['ID' => $post->ID, 'post_content' => wp_slash($content)], true);
        if (is_wp_error($result)) {
            WP_CLI::error('Could not restore page:' . $post->post_name . '.');
        }
    }

    foreach ((array) ($backup['options'] ?? []) as $option_name => $value) {
        if ($value === null) {
            delete_field(sanitize_key((string) $option_name), 'option');
        } else {
            update_field(sanitize_key((string) $option_name), absint($value), 'option');
        }
    }

    foreach ((array) ($backup['created_sources'] ?? []) as $source_id) {
        $source = get_post(absint($source_id));
        if ($source instanceof WP_Post && $source->post_type === 'wp_block') {
            wp_delete_post($source->ID, true);
        }
    }

    WP_CLI::success('Form source rollback complete.');
    return;
}

$inline_keys = [
    'title' => 'field_68d0edea9a4c7', 'service' => 'field_68d0fc5740267',
    'fields' => 'field_68cbcaac4f107', 'type' => 'field_68cbcae24f108',
    'required' => 'field_68d11461c5771', 'name' => 'field_68d114aac5772',
    'label' => 'field_68cbcb444f109', 'submit' => 'field_space_inline_submit_label',
    'recipient' => 'field_space_inline_recipient', 'agreement_mode' => 'field_space_inline_agreement_mode',
    'agreement_text' => 'field_space_inline_agreement_text', 'agreement_required' => 'field_space_inline_agreement_required',
    'variant' => 'field_space_inline_variant', 'max_length' => 'field_space_inline_max_length',
    'extensions' => 'field_space_inline_file_extensions', 'file_size' => 'field_space_inline_file_size',
    'context' => 'field_space_inline_context_key',
];
$popup_keys = [
    'id' => 'field_68e778bbfce0a', 'title' => 'field_68e777908bab5',
    'service' => 'field_68e777908baf2', 'fields' => 'field_68e777908bb2c',
    'type' => 'field_68e77790a5ffd', 'required' => 'field_68e77790a6045',
    'name' => 'field_68e77790a608d', 'label' => 'field_68e77790a60d3',
    'submit' => 'field_space_popup_submit_label', 'recipient' => 'field_space_popup_recipient',
    'agreement_mode' => 'field_space_popup_agreement_mode', 'agreement_text' => 'field_space_popup_agreement_text',
    'agreement_required' => 'field_space_popup_agreement_required', 'variant' => 'field_space_popup_variant',
    'max_length' => 'field_space_popup_max_length', 'extensions' => 'field_space_popup_file_extensions',
    'file_size' => 'field_space_popup_file_size', 'context' => 'field_space_popup_context_key',
    'show_image' => 'field_space_popup_show_image', 'image' => 'field_space_popup_image',
    'legacy_image' => 'field_space_popup_legacy_image', 'image_caption' => 'field_space_popup_image_caption',
];

$make_block = static function (string $block_name, array $config) use ($inline_keys, $popup_keys): string {
    $popup = $block_name === 'acf/form-custom-popup';
    $keys = $popup ? $popup_keys : $inline_keys;
    $prefix = $popup ? 'form-custom-popup' : 'form-custom';
    $row_prefix = $popup ? 'form-custom-popup-fields' : 'form-custom-fields';
    $data = [];

    if ($popup) {
        $data[$prefix . '-id'] = $config['id'] ?? '';
        $data['_' . $prefix . '-id'] = $keys['id'];
    }

    foreach (['title' => 'title', 'title-form' => 'service'] as $suffix => $config_key) {
        $data[$prefix . '-' . $suffix] = $config[$config_key] ?? '';
        $data['_' . $prefix . '-' . $suffix] = $keys[$config_key];
    }

    foreach ($config['fields'] as $index => $field) {
        $base = $prefix . '-fields_' . $index . '_';
        $data[$base . $row_prefix . '-type'] = $field['type'];
        $data['_' . $base . $row_prefix . '-type'] = $keys['type'];
        $required_name = $popup ? 'form-custom-fields-popup-required' : 'form-custom-fields-required';
        $data[$base . $required_name] = !empty($field['required']) ? '1' : '0';
        $data['_' . $base . $required_name] = $keys['required'];
        $data[$base . $row_prefix . '-name'] = $field['name'];
        $data['_' . $base . $row_prefix . '-name'] = $keys['name'];
        $data[$base . $row_prefix . '-placeholder'] = $field['label'];
        $data['_' . $base . $row_prefix . '-placeholder'] = $keys['label'];

        $data[$base . $row_prefix . '-max-length'] = $field['max_length'] ?? '';
        $data['_' . $base . $row_prefix . '-max-length'] = $keys['max_length'];
        $data[$base . $row_prefix . '-file-extensions'] = $field['extensions'] ?? [];
        $data['_' . $base . $row_prefix . '-file-extensions'] = $keys['extensions'];
        $data[$base . $row_prefix . '-file-size'] = $field['file_size'] ?? 3;
        $data['_' . $base . $row_prefix . '-file-size'] = $keys['file_size'];
        $data[$base . $row_prefix . '-context-key'] = $field['context'] ?? '';
        $data['_' . $base . $row_prefix . '-context-key'] = $keys['context'];
    }

    $data[$prefix . '-fields'] = count($config['fields']);
    $data['_' . $prefix . '-fields'] = $keys['fields'];
    foreach (['submit-label' => 'submit', 'recipient' => 'recipient', 'agreement-mode' => 'agreement_mode', 'agreement-text' => 'agreement_text', 'agreement-required' => 'agreement_required', 'variant' => 'variant'] as $suffix => $config_key) {
        $data[$prefix . '-' . $suffix] = $config[$config_key] ?? '';
        $data['_' . $prefix . '-' . $suffix] = $keys[$config_key];
    }

    if ($popup) {
        foreach (['show-image' => 'show_image', 'image' => 'image', 'legacy-image' => 'legacy_image', 'image-caption' => 'image_caption'] as $suffix => $config_key) {
            $data[$prefix . '-' . $suffix] = $config[$config_key] ?? '';
            $data['_' . $prefix . '-' . $suffix] = $keys[$config_key];
        }
    }

    return serialize_block([
        'blockName' => $block_name,
        'attrs' => ['name' => $block_name, 'data' => $data, 'mode' => 'edit'],
        'innerBlocks' => [], 'innerHTML' => '', 'innerContent' => [],
    ]);
};

$vacancy_agreement = function_exists('get_field') ? get_field('site_forms_vacancies_agree', 'option') : '';
$product_popup_fields = [
    ['type' => 'production', 'name' => 'production', 'label' => 'Выберите выпускаемую продукцию', 'required' => true],
    ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
    ['type' => 'text', 'name' => 'company', 'label' => 'Организация', 'required' => true],
    ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
    ['type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
    ['type' => 'textarea', 'name' => 'msg', 'label' => 'Комментарий', 'required' => false],
];
$contact_popup_fields = [
    ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
    ['type' => 'text', 'name' => 'company', 'label' => 'Организация', 'required' => true],
    ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
    ['type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
    ['type' => 'textarea', 'name' => 'msg', 'label' => 'Комментарий', 'required' => false],
];
$sources = [
    'space-home-form' => [
        'title' => 'Форма на главной странице', 'block' => 'acf/form-custom', 'option' => 'field_space_home_form_block',
        'config' => ['title' => 'Оставьте заявку на демо-версию', 'service' => 'Заявка на демо-версию', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'default', 'fields' => [
            ['type' => 'products', 'name' => 'product', 'label' => 'Выберите продукт', 'required' => true],
            ['type' => 'partners', 'name' => 'partner', 'label' => 'Выберите дистрибьютора', 'required' => true],
            ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
            ['type' => 'text', 'name' => 'company', 'label' => 'Организация', 'required' => true],
            ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
            ['type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
            ['type' => 'textarea', 'name' => 'msg', 'label' => 'Комментарий', 'required' => false],
        ]],
    ],
    'space-vacancy-form' => [
        'title' => 'Форма отклика на вакансию', 'block' => 'acf/form-custom', 'option' => 'field_space_vacancy_form_block',
        'config' => ['title' => '', 'service' => 'Отклик на вакансию', 'submit' => 'Отправить', 'recipient' => 'hr', 'agreement_mode' => 'custom', 'agreement_text' => $vacancy_agreement, 'agreement_required' => '1', 'variant' => 'vacancy', 'fields' => [
            ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
            ['type' => 'text', 'name' => 'specialization', 'label' => 'Специализация', 'required' => true],
            ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
            ['type' => 'email', 'name' => 'email', 'label' => 'Электронный адрес', 'required' => true],
            ['type' => 'file', 'name' => 'resume', 'label' => 'Резюме', 'required' => false, 'extensions' => ['pdf', 'doc', 'docx'], 'file_size' => 3],
            ['type' => 'textarea', 'name' => 'msg', 'label' => 'Напишите о себе', 'required' => false, 'max_length' => 300],
        ]],
    ],
    'space-demo-popup' => [
        'title' => 'Общий поп-ап заявки', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'demo-popup', 'title' => 'Оставить на сайте<br>заявку на демо-версию', 'service' => 'Заявка на демо-версию', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'simple', 'fields' => [
            ['type' => 'products', 'name' => 'product', 'label' => 'Выберите продукт', 'required' => true],
            ['type' => 'partners', 'name' => 'partner', 'label' => 'Выберите дистрибьютора', 'required' => true],
            ['type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
            ['type' => 'text', 'name' => 'company', 'label' => 'Организация', 'required' => true],
            ['type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
            ['type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
            ['type' => 'textarea', 'name' => 'msg', 'label' => 'Комментарий', 'required' => false],
        ]],
    ],
    'space-demo-vm-popup' => [
        'title' => 'Space VM — демо', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'demo-vm', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на демо-версию SpaceVM', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'aqua', 'show_image' => '0', 'legacy_image' => 'vm', 'image_caption' => 'Заявка на демоверсию SpaceVM', 'fields' => $product_popup_fields],
    ],
    'space-buy-vm-popup' => [
        'title' => 'Space VM — покупка', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'buy-vm', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на покупку SpaceVM', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'aqua', 'show_image' => '0', 'legacy_image' => 'vm', 'image_caption' => 'Заявка на покупку SpaceVM', 'fields' => $product_popup_fields],
    ],
    'space-demo-vdi-popup' => [
        'title' => 'Space VDI — демо', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'demo-vdi', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на демо-версию Space VDI', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'default', 'show_image' => '1', 'legacy_image' => 'vdi', 'image_caption' => 'Заявка на демоверсию Space VDI', 'fields' => $product_popup_fields],
    ],
    'space-buy-vdi-popup' => [
        'title' => 'Space VDI — покупка', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'buy-vdi', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на покупку Space VDI', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'default', 'show_image' => '1', 'legacy_image' => 'vdi', 'image_caption' => 'Заявка на покупку Space VDI', 'fields' => $product_popup_fields],
    ],
    'space-partner-popup' => [
        'title' => 'Партнёрская заявка', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'partner-popup', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на партнёрство', 'submit' => 'Отправить', 'recipient' => 'partner', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'default', 'show_image' => '1', 'legacy_image' => 'space', 'image_caption' => 'Станьте партнёром Space', 'fields' => $contact_popup_fields],
    ],
    'space-tech-partner-popup' => [
        'title' => 'Техническое партнёрство', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'tech-partner-popup', 'title' => 'Заполните информацию ниже и мы свяжемся с вами', 'service' => 'Заявка на техническое партнёрство', 'submit' => 'Отправить', 'recipient' => 'tech_partner', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'default', 'show_image' => '0', 'fields' => $contact_popup_fields],
    ],
    'space-download-popup' => [
        'title' => 'Получение материалов', 'block' => 'acf/form-custom-popup', 'option' => '',
        'config' => ['id' => 'download_custom1', 'title' => 'Заполните информацию ниже', 'service' => 'Заявка на получение материалов', 'submit' => 'Отправить', 'recipient' => 'main', 'agreement_mode' => 'global', 'agreement_required' => '0', 'variant' => 'simple', 'show_image' => '0', 'fields' => $contact_popup_fields],
    ],
];

$popup_source_by_id = [];
foreach ($sources as $source_slug => $source) {
    if ($source['block'] === 'acf/form-custom-popup') {
        $popup_source_by_id[$source['config']['id']] = $source_slug;
    }
}

$page_sources = [];
$attach_source_to_page = static function ($page, string $source_slug) use (&$page_sources): void {
    if (!$page instanceof WP_Post || $page->post_type !== 'page') {
        return;
    }
    $page_sources[$page->ID] = $page_sources[$page->ID] ?? [];
    if (!in_array($source_slug, $page_sources[$page->ID], true)) {
        $page_sources[$page->ID][] = $source_slug;
    }
};

$front_page = get_post(absint(get_option('page_on_front')));
$attach_source_to_page($front_page, 'space-demo-popup');

$page_source_map = [
    'space-vm' => ['space-demo-popup', 'space-demo-vm-popup', 'space-buy-vm-popup'],
    'space-vdi' => ['space-demo-popup', 'space-demo-vdi-popup', 'space-buy-vdi-popup'],
    'space-client' => ['space-demo-popup'],
    'space-cloud' => ['space-demo-popup'],
    'spacevm-essentials-plus-kit' => ['space-demo-popup'],
    'partners' => ['space-partner-popup'],
    'space-connect' => ['space-tech-partner-popup'],
];
foreach ($page_source_map as $page_slug => $source_slugs) {
    $page = get_page_by_path($page_slug, OBJECT, 'page');
    foreach ($source_slugs as $source_slug) {
        $attach_source_to_page($page, $source_slug);
    }
}

$template_source_map = [
    'templates/space/vm.php' => ['space-demo-popup', 'space-demo-vm-popup', 'space-buy-vm-popup'],
    'templates/space/vdi.php' => ['space-demo-popup', 'space-demo-vdi-popup', 'space-buy-vdi-popup'],
    'templates/partners/partners.php' => ['space-partner-popup'],
    'templates/space/connect.php' => ['space-tech-partner-popup'],
];
foreach ($template_source_map as $page_template => $source_slugs) {
    $template_page_ids = get_posts([
        'post_type' => 'page', 'post_status' => ['publish', 'private', 'draft'],
        'posts_per_page' => -1, 'fields' => 'ids', 'no_found_rows' => true,
        'meta_key' => '_wp_page_template', 'meta_value' => $page_template,
        'update_post_meta_cache' => false, 'update_post_term_cache' => false,
    ]);
    foreach ($template_page_ids as $template_page_id) {
        $page = get_post($template_page_id);
        foreach ($source_slugs as $source_slug) {
            $attach_source_to_page($page, $source_slug);
        }
    }
}

// Also attach a known popup wherever an editor-created button references its public ID.
$all_page_ids = get_posts([
    'post_type' => 'page', 'post_status' => ['publish', 'private', 'draft'],
    'posts_per_page' => -1, 'fields' => 'ids', 'no_found_rows' => true,
    'update_post_meta_cache' => false, 'update_post_term_cache' => false,
]);
foreach ($all_page_ids as $page_id) {
    $page = get_post($page_id);
    if (!$page instanceof WP_Post) {
        continue;
    }
    foreach ($popup_source_by_id as $popup_id => $source_slug) {
        if (strpos($page->post_content, '#' . $popup_id) !== false) {
            $attach_source_to_page($page, $source_slug);
        }
    }
}

$page_ids = array_keys($page_sources);
$option_names = ['site_home_form_block', 'site_vacancy_form_block'];
$options_backup = [];
$page_backups = [];
$source_ids = [];
$created_source_ids = [];
$backup_file = '';

foreach ($option_names as $option_name) {
    $value = function_exists('get_field') ? get_field($option_name, 'option') : null;
    $options_backup[$option_name] = $value instanceof WP_Post ? $value->ID : ($value !== false ? absint($value) : null);
}
foreach ($page_ids as $page_id) {
    $page = get_post($page_id);
    if (!$page instanceof WP_Post) {
        WP_CLI::error('Target page is missing: ' . $page_id . '.');
    }
    $page_backups[] = [
        'id' => $page->ID,
        'post_type' => $page->post_type,
        'slug' => $page->post_name,
        'content_base64' => base64_encode($page->post_content),
    ];
}

$write_backup = static function () use (&$backup_file, $backup_directory, &$created_source_ids, $options_backup, $page_backups): bool {
    $backup = [
        'version' => 1,
        'kind' => 'form-sources',
        'created_at' => gmdate('c'),
        'options' => $options_backup,
        'pages' => $page_backups,
        'created_sources' => $created_source_ids,
    ];
    return file_put_contents($backup_file, wp_json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
};

$abort_apply = static function (string $message) use (&$created_source_ids, $options_backup, $page_backups): void {
    WP_CLI::warning('[FIX:migration-atomicity] Apply failed; restoring pages, options and created sources. Reason: ' . $message);
    $rollback_failures = [];
    foreach ($page_backups as $row) {
        $content = base64_decode($row['content_base64'], true);
        $result = is_string($content)
            ? wp_update_post(['ID' => $row['id'], 'post_content' => wp_slash($content)], true)
            : new WP_Error('invalid_backup');
        $current = get_post($row['id']);
        if (is_wp_error($result) || !$current instanceof WP_Post || $current->post_content !== $content) {
            $rollback_failures[] = 'page:' . $row['slug'];
        }
    }
    foreach ($options_backup as $option_name => $value) {
        $restored = $value === null
            ? delete_field($option_name, 'option')
            : update_field($option_name, $value, 'option');
        $current = get_field($option_name, 'option');
        $current_id = $current instanceof WP_Post ? $current->ID : absint($current);
        if (($value === null && $current !== false && $current !== null) || ($value !== null && $current_id !== absint($value))) {
            $rollback_failures[] = 'option:' . $option_name;
        }
    }
    foreach ($created_source_ids as $source_id) {
        if (!wp_delete_post($source_id, true)) {
            $rollback_failures[] = 'source:' . $source_id;
        }
    }
    if ($rollback_failures) {
        $message .= ' Rollback failed for: ' . implode(', ', $rollback_failures) . '.';
    }
    WP_CLI::log('[FIX:migration-atomicity] Rollback verified. Restored objects: ' . (count($page_backups) + count($options_backup) + count($created_source_ids) - count($rollback_failures)) . '.');
    WP_CLI::error($message);
};

if ($mode === 'apply') {
    if (!wp_mkdir_p($backup_directory)) {
        WP_CLI::error('Could not create the backup directory.');
    }
    $backup_file = $backup_directory . '/form-sources-' . gmdate('Ymd-His') . '.json';
    if (!$write_backup()) {
        WP_CLI::error('Could not write form source backup before apply.');
    }
    WP_CLI::log('[FIX:migration-atomicity] Form source apply started with a complete snapshot.');
}

foreach ($sources as $slug => $source) {
    $existing = get_page_by_path($slug, OBJECT, 'wp_block');
    if ($existing instanceof WP_Post) {
        $source_ids[$slug] = $existing->ID;
        $expected_block = space_form_find_block(parse_blocks($existing->post_content), $source['block']);
        if (!$expected_block) {
            if ($mode === 'apply') {
                $abort_apply('Reusable source has an invalid block: ' . $slug . '.');
            }
            WP_CLI::error('Reusable source has an invalid block: ' . $slug . '.');
        }
        if ($source['block'] === 'acf/form-custom-popup') {
            $config = space_form_config_from_block($expected_block, 'popup');
            if ($config['id'] !== $source['config']['id']) {
                if ($mode === 'apply') {
                    $abort_apply('Reusable source has an invalid popup ID: ' . $slug . '.');
                }
                WP_CLI::error('Reusable source has an invalid popup ID: ' . $slug . '.');
            }
        }
        continue;
    }

    if ($mode === 'verify') {
        WP_CLI::error('Missing reusable source: ' . $slug . '.');
    }
    if ($mode === 'dry-run') {
        WP_CLI::line('WOULD CREATE wp_block:' . $slug);
        continue;
    }

    $source_ids[$slug] = wp_insert_post([
        'post_type' => 'wp_block', 'post_status' => 'publish', 'post_name' => $slug,
        'post_title' => $source['title'], 'post_content' => wp_slash($make_block($source['block'], $source['config'])),
    ], true);
    if (is_wp_error($source_ids[$slug]) || !$source_ids[$slug]) {
        $abort_apply('Could not create reusable source: ' . $slug . '.');
    }
    $created_source_ids[] = (int) $source_ids[$slug];
    WP_CLI::log('[FIX:migration-atomicity] Created reusable source: ' . $slug . '.');
    if (!$write_backup()) {
        $abort_apply('Could not update form source backup.');
    }
}

if ($mode === 'apply') {
    foreach ($sources as $slug => $source) {
        if ($source['option'] === '' || empty($source_ids[$slug])) {
            continue;
        }
        update_field($source['option'], $source_ids[$slug], 'option');
        $current = get_field(str_replace('field_space_', 'site_', $source['option']), 'option');
        $current_id = $current instanceof WP_Post ? $current->ID : absint($current);
        if ($current_id !== absint($source_ids[$slug])) {
            $abort_apply('Could not update form source option for: ' . $slug . '.');
        }
        WP_CLI::log('[FIX:migration-atomicity] Verified form source option: ' . $slug . '.');
    }
}

$content_has_popup = null;
$content_has_popup = static function (string $content, string $popup_id, array &$visited = []) use (&$content_has_popup): bool {
    foreach (parse_blocks($content) as $block) {
        $block_name = $block['blockName'] ?? '';
        if ($block_name === 'acf/form-custom-popup') {
            $config = space_form_config_from_block($block, 'popup');
            if ($config['id'] === $popup_id) {
                return true;
            }
        }
        if ($block_name === 'core/block') {
            $reference_id = absint($block['attrs']['ref'] ?? 0);
            if ($reference_id > 0 && !isset($visited[$reference_id])) {
                $visited[$reference_id] = true;
                $reference = get_post($reference_id);
                if ($reference instanceof WP_Post && $reference->post_type === 'wp_block'
                    && $content_has_popup($reference->post_content, $popup_id, $visited)) {
                    return true;
                }
            }
        }
        if (!empty($block['innerBlocks']) && $content_has_popup(serialize_blocks($block['innerBlocks']), $popup_id, $visited)) {
            return true;
        }
    }
    return false;
};

foreach ($page_sources as $page_id => $source_slugs) {
    $page = get_post($page_id);
    if (!$page instanceof WP_Post) {
        if ($mode === 'apply') {
            $abort_apply('Target page is missing: ' . $page_id . '.');
        }
        WP_CLI::error('Target page is missing: ' . $page_id . '.');
    }
    foreach ($source_slugs as $source_slug) {
        $source = $sources[$source_slug] ?? null;
        $source_id = $source_ids[$source_slug] ?? 0;
        $popup_id = is_array($source) ? (string) ($source['config']['id'] ?? '') : '';
        $visited = [];
        if ($popup_id !== '' && $content_has_popup($page->post_content, $popup_id, $visited)) {
            continue;
        }
        if ($mode === 'verify') {
            WP_CLI::error('Missing popup ' . $popup_id . ' on page:' . $page->post_name . '.');
        }
        if ($mode === 'dry-run') {
            WP_CLI::line('WOULD ATTACH popup ' . $popup_id . ' to page:' . $page->post_name);
            continue;
        }
        if ($source_id < 1) {
            $abort_apply('Popup source is missing: ' . $source_slug . '.');
        }

        $reference = serialize_block(['blockName' => 'core/block', 'attrs' => ['ref' => $source_id], 'innerBlocks' => [], 'innerHTML' => '', 'innerContent' => []]);
        $content = rtrim($page->post_content) . "\n\n" . $reference;
        $result = wp_update_post(['ID' => $page_id, 'post_content' => wp_slash($content)], true);
        if (is_wp_error($result)) {
            $abort_apply('Could not attach popup ' . $popup_id . ' to page:' . $page->post_name . '.');
        }
        $page = get_post($page_id);
        $visited = [];
        if (!$page instanceof WP_Post || !$content_has_popup($page->post_content, $popup_id, $visited)) {
            $abort_apply('Could not verify popup ' . $popup_id . ' on page:' . $page_id . '.');
        }
        WP_CLI::log('[FIX:form-source-migration] Verified popup ' . $popup_id . ' on page:' . $page->post_name . '.');
    }
}

if ($mode === 'apply') {
    WP_CLI::log('[FIX:migration-atomicity] Form source apply verified successfully.');
    WP_CLI::success('Apply complete. Backup: ' . $backup_file . '.');
    return;
}

WP_CLI::success(ucfirst($mode) . ' complete.');
