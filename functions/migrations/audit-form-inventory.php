<?php

/**
 * Read-only inventory of application forms stored in Gutenberg content.
 *
 * Usage:
 *   wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/audit-form-inventory.php
 *
 * The command never prints submitted values, recipient addresses or secrets.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('WP_CLI') || !WP_CLI) {
    return;
}

$target_blocks = [
    'acf/form',
    'acf/form-custom',
    'acf/form-custom-popup',
];

$inventory = [];
$references = [];
$visited_reusable = [];

$value_from_data = static function (array $data, array $keys, $default = '') {
    foreach ($keys as $key) {
        if (array_key_exists($key, $data) && $data[$key] !== '' && $data[$key] !== null) {
            return $data[$key];
        }
    }

    return $default;
};

$summarize_fields = static function (array $data, string $block_name) use ($value_from_data): array {
    $prefix = $block_name === 'acf/form-custom-popup'
        ? 'form-custom-popup-fields'
        : 'form-custom-fields';
    $count = absint($data[$prefix] ?? 0);
    $fields = [];

    for ($index = 0; $index < $count; $index++) {
        $row_prefix = $prefix . '_' . $index . '_';
        $type = sanitize_key((string) $value_from_data($data, [
            $row_prefix . ($block_name === 'acf/form-custom-popup'
                ? 'form-custom-popup-fields-type'
                : 'form-custom-fields-type'),
        ]));
        $name = sanitize_key((string) $value_from_data($data, [
            $row_prefix . ($block_name === 'acf/form-custom-popup'
                ? 'form-custom-popup-fields-name'
                : 'form-custom-fields-name'),
        ]));

        $fields[] = trim($type . ($name !== '' ? ':' . $name : ''), ':');
    }

    if ($block_name === 'acf/form') {
        foreach (['name', 'company', 'phone', 'email', 'msg'] as $legacy_name) {
            $enabled = $value_from_data($data, ['form-' . $legacy_name], true);
            if ($enabled) {
                $fields[] = $legacy_name;
            }
        }
    }

    return array_values(array_filter($fields));
};

$add_inventory_row = static function (WP_Post $post, array $block, string $source) use (
    &$inventory,
    $summarize_fields,
    $value_from_data
): void {
    $block_name = (string) ($block['blockName'] ?? '');
    $data = isset($block['attrs']['data']) && is_array($block['attrs']['data'])
        ? $block['attrs']['data']
        : [];
    $popup_id = sanitize_title((string) $value_from_data($data, [
        'form-custom-popup-id',
        'form-custom-id',
    ]));
    $recipient = sanitize_key((string) $value_from_data($data, [
        'form-custom-popup-recipient',
        'form-custom-recipient',
    ], $block_name === 'acf/form' ? 'client_to_legacy' : 'main'));
    $service_name = (string) $value_from_data($data, [
        'form-custom-popup-title-form',
        'form-custom-title-form',
        'form-title-form',
        'form-title',
    ]);
    $fields = $summarize_fields($data, $block_name);

    $inventory[] = [
        'post_type' => $post->post_type,
        'status' => $post->post_status,
        'slug' => $post->post_name !== '' ? $post->post_name : '(без-slug)',
        'title' => wp_strip_all_tags(get_the_title($post)),
        'source' => $source,
        'block' => $block_name,
        'mode' => $block_name === 'acf/form-custom-popup' ? 'popup' : 'inline',
        'popup_id' => $popup_id !== '' ? $popup_id : '—',
        'fields' => $fields ? implode(', ', $fields) : '—',
        'recipient' => $recipient !== '' ? $recipient : 'main',
        'service_name' => $service_name !== '' ? 'configured' : 'fallback/empty',
    ];
};

$walk_blocks = null;
$walk_blocks = static function (array $blocks, WP_Post $post, string $source) use (
    &$walk_blocks,
    &$references,
    &$visited_reusable,
    $target_blocks,
    $add_inventory_row
): void {
    foreach ($blocks as $block) {
        if (!is_array($block)) {
            continue;
        }

        $block_name = (string) ($block['blockName'] ?? '');
        if (in_array($block_name, $target_blocks, true)) {
            $add_inventory_row($post, $block, $source);
        }

        if ($block_name === 'core/block') {
            $reference_id = absint($block['attrs']['ref'] ?? 0);
            if ($reference_id > 0) {
                $references[] = [
                    'owner' => $post->post_type . ':' . $post->post_name,
                    'ref' => $reference_id,
                ];

                if (!isset($visited_reusable[$reference_id])) {
                    $visited_reusable[$reference_id] = true;
                    $reusable = get_post($reference_id);
                    if ($reusable instanceof WP_Post && $reusable->post_type === 'wp_block') {
                        $walk_blocks(
                            parse_blocks($reusable->post_content),
                            $post,
                            'wp_block:' . $reusable->post_name
                        );
                    }
                }
            }
        }

        if (!empty($block['innerBlocks']) && is_array($block['innerBlocks'])) {
            $walk_blocks($block['innerBlocks'], $post, $source);
        }
    }
};

global $wpdb;

$post_ids = $wpdb->get_col(
    "SELECT ID FROM {$wpdb->posts}
     WHERE post_content <> ''
       AND post_type NOT IN ('attachment', 'nav_menu_item', 'custom_css', 'customize_changeset')
     ORDER BY post_type, post_status, post_name, ID"
);

foreach ($post_ids as $post_id) {
    $post = get_post((int) $post_id);
    if (!$post instanceof WP_Post || !has_blocks($post->post_content)) {
        continue;
    }

    $walk_blocks(parse_blocks($post->post_content), $post, 'post_content');
}

$hardcoded_forms = [
    ['/', 'templates/homepage/homepage.php', 'inline', 'main', 'name, company, phone, email, msg'],
    ['/vacancies/', 'templates/vacancies/vacancies-archive.php', 'inline', 'hr', 'name, phone, specialization, msg'],
    ['/vacancies/{slug}/', 'templates/vacancies/vacancies-single.php', 'inline', 'hr', 'name, phone, email, msg, file'],
    ['global', 'footer.php#demo-popup', 'popup', 'main', 'product, name, company, phone, email, msg'],
];

$theme_directory = get_stylesheet_directory();
$trigger_rows = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($theme_directory, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if (!$file->isFile() || !in_array(strtolower($file->getExtension()), ['php', 'js'], true)) {
        continue;
    }

    $contents = file_get_contents($file->getPathname());
    if ($contents === false) {
        continue;
    }

    if (preg_match_all('/href=["\']#([a-zA-Z0-9_-]+)["\']/', $contents, $matches)) {
        foreach (array_unique($matches[1]) as $popup_id) {
            $trigger_rows[] = [
                'popup_id' => sanitize_title($popup_id),
                'file' => ltrim(str_replace($theme_directory, '', $file->getPathname()), '/'),
            ];
        }
    }
}

usort($inventory, static function (array $left, array $right): int {
    return [$left['post_type'], $left['slug'], $left['block'], $left['popup_id']]
        <=> [$right['post_type'], $right['slug'], $right['block'], $right['popup_id']];
});

WP_CLI::line('Gutenberg forms');
if ($inventory) {
    WP_CLI\Utils\format_items('table', $inventory, [
        'post_type',
        'status',
        'slug',
        'title',
        'source',
        'block',
        'mode',
        'popup_id',
        'fields',
        'recipient',
        'service_name',
    ]);
} else {
    WP_CLI::line('No target Gutenberg forms found.');
}

WP_CLI::line('');
WP_CLI::line('Hardcoded runtime forms');
WP_CLI\Utils\format_items(
    'table',
    array_map(static function (array $row): array {
        return array_combine(['route', 'source', 'mode', 'recipient', 'fields'], $row);
    }, $hardcoded_forms),
    ['route', 'source', 'mode', 'recipient', 'fields']
);

WP_CLI::line('');
WP_CLI::line('Popup triggers in theme files');
if ($trigger_rows) {
    WP_CLI\Utils\format_items('table', $trigger_rows, ['popup_id', 'file']);
} else {
    WP_CLI::line('No static popup triggers found.');
}

$block_counts = array_fill_keys($target_blocks, 0);
foreach ($inventory as $row) {
    $block_counts[$row['block']]++;
}

WP_CLI::line('');
WP_CLI::line('Legacy removal gates');
WP_CLI\Utils\format_items('table', [
    ['gate' => 'acf/form instances', 'current' => $block_counts['acf/form'], 'required' => 0],
    ['gate' => 'legacy hardcoded forms', 'current' => count($hardcoded_forms), 'required' => 0],
    ['gate' => 'feedback_form PHP/JS references', 'current' => 'verify by code audit', 'required' => 0],
    ['gate' => 'unresolved popup triggers', 'current' => 'verify after migration', 'required' => 0],
], ['gate', 'current', 'required']);

WP_CLI::success(sprintf(
    'Inventory complete: %d Gutenberg forms, %d reusable references, %d static popup triggers.',
    count($inventory),
    count($references),
    count($trigger_rows)
));
