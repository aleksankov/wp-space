<?php

/**
 * Explicit, idempotent migration of legacy acf/form blocks.
 *
 * Usage:
 *   wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php dry-run
 *   wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php apply
 *   wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php verify
 *   wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php rollback /absolute/backup.json
 */

if (!defined('ABSPATH') || !defined('WP_CLI') || !WP_CLI) {
    exit;
}

$mode = sanitize_key($args[0] ?? 'dry-run');
$allowed_modes = ['dry-run', 'apply', 'verify', 'rollback'];
if (!in_array($mode, $allowed_modes, true)) {
    WP_CLI::error('Mode must be dry-run, apply, verify or rollback.');
}

$backup_directory = dirname(ABSPATH) . '/.ai-factory/backups/forms';
$inline_keys = [
    'title' => 'field_68d0edea9a4c7',
    'service_name' => 'field_68d0fc5740267',
    'fields' => 'field_68cbcaac4f107',
    'type' => 'field_68cbcae24f108',
    'required' => 'field_68d11461c5771',
    'name' => 'field_68d114aac5772',
    'label' => 'field_68cbcb444f109',
    'submit' => 'field_space_inline_submit_label',
    'recipient' => 'field_space_inline_recipient',
    'agreement_mode' => 'field_space_inline_agreement_mode',
    'agreement_text' => 'field_space_inline_agreement_text',
    'variant' => 'field_space_inline_variant',
];

$legacy_field_map = [
    ['toggle' => 'oc-form-product-field-active', 'type' => 'products', 'name' => 'product', 'label' => 'Выберите продукт', 'required' => true],
    ['toggle' => 'oc-form-partner-field-active', 'type' => 'partners', 'name' => 'partner', 'label' => 'Выберите дистрибьютора', 'required' => true],
    ['toggle' => 'oc-form-name-field-active', 'type' => 'text', 'name' => 'name', 'label' => 'Имя и фамилия', 'required' => true],
    ['toggle' => 'oc-form-organization-field-active', 'type' => 'text', 'name' => 'company', 'label' => 'Организация', 'required' => true],
    ['toggle' => null, 'type' => 'tel', 'name' => 'phone', 'label' => 'Номер телефона', 'required' => true],
    ['toggle' => 'oc-form-email-field-active', 'type' => 'email', 'name' => 'email', 'label' => 'E-mail', 'required' => true],
    ['toggle' => 'oc-form-comment-field-active', 'type' => 'textarea', 'name' => 'msg', 'label' => 'Комментарий', 'required' => false],
];

$make_inline_block = static function (array $legacy_block) use ($inline_keys, $legacy_field_map): array {
    $legacy_data = is_array($legacy_block['attrs']['data'] ?? null) ? $legacy_block['attrs']['data'] : [];
    $data = [
        'form-custom-title' => $legacy_data['title'] ?? 'Оставьте заявку на демо-версию',
        '_form-custom-title' => $inline_keys['title'],
        'form-custom-title-form' => 'Заявка на демо-версию',
        '_form-custom-title-form' => $inline_keys['service_name'],
        'form-custom-submit-label' => 'Отправить',
        '_form-custom-submit-label' => $inline_keys['submit'],
        'form-custom-recipient' => 'main',
        '_form-custom-recipient' => $inline_keys['recipient'],
        'form-custom-agreement-mode' => 'global',
        '_form-custom-agreement-mode' => $inline_keys['agreement_mode'],
        'form-custom-agreement-text' => '',
        '_form-custom-agreement-text' => $inline_keys['agreement_text'],
        'form-custom-variant' => 'default',
        '_form-custom-variant' => $inline_keys['variant'],
    ];
    $field_index = 0;

    foreach ($legacy_field_map as $field) {
        if ($field['toggle'] !== null && empty($legacy_data[$field['toggle']])) {
            continue;
        }

        $prefix = 'form-custom-fields_' . $field_index . '_';
        $data[$prefix . 'form-custom-fields-type'] = $field['type'];
        $data['_' . $prefix . 'form-custom-fields-type'] = $inline_keys['type'];
        $data[$prefix . 'form-custom-fields-required'] = $field['required'] ? '1' : '0';
        $data['_' . $prefix . 'form-custom-fields-required'] = $inline_keys['required'];
        $data[$prefix . 'form-custom-fields-name'] = $field['name'];
        $data['_' . $prefix . 'form-custom-fields-name'] = $inline_keys['name'];
        $data[$prefix . 'form-custom-fields-placeholder'] = $field['label'];
        $data['_' . $prefix . 'form-custom-fields-placeholder'] = $inline_keys['label'];
        $field_index++;
    }

    $data['form-custom-fields'] = $field_index;
    $data['_form-custom-fields'] = $inline_keys['fields'];

    $legacy_block['blockName'] = 'acf/form-custom';
    $legacy_block['attrs']['name'] = 'acf/form-custom';
    $legacy_block['attrs']['data'] = $data;
    $legacy_block['attrs']['mode'] = 'edit';

    return $legacy_block;
};

$transform_blocks = null;
$transform_blocks = static function (array $blocks, int &$changes) use (&$transform_blocks, $make_inline_block): array {
    foreach ($blocks as &$block) {
        if (($block['blockName'] ?? '') === 'acf/form') {
            $block = $make_inline_block($block);
            $changes++;
        }

        if (!empty($block['innerBlocks'])) {
            $block['innerBlocks'] = $transform_blocks($block['innerBlocks'], $changes);
            $inner_index = 0;
            foreach ($block['innerContent'] ?? [] as &$content) {
                if ($content === null && isset($block['innerBlocks'][$inner_index])) {
                    $content = serialize_block($block['innerBlocks'][$inner_index]);
                    $inner_index++;
                }
            }
            unset($content);
        }
    }
    unset($block);

    return $blocks;
};

if ($mode === 'rollback') {
    $backup_file = $args[1] ?? '';
    $real_backup = $backup_file !== '' ? realpath($backup_file) : false;
    $real_directory = is_dir($backup_directory) ? realpath($backup_directory) : false;

    if (!$real_backup || !$real_directory || strpos($real_backup, $real_directory . DIRECTORY_SEPARATOR) !== 0) {
        WP_CLI::error('Rollback file must be an existing backup from .ai-factory/backups/forms.');
    }

    $backup = json_decode((string) file_get_contents($real_backup), true);
    if (!is_array($backup) || empty($backup['posts'])) {
        WP_CLI::error('Invalid or empty backup.');
    }

    $restored = 0;
    foreach ($backup['posts'] as $row) {
        $post = get_post(absint($row['id'] ?? 0));
        $content = base64_decode((string) ($row['content_base64'] ?? ''), true);
        if (!$post instanceof WP_Post || !is_string($content) || get_post_type($post) !== ($row['post_type'] ?? '')) {
            continue;
        }

        $result = wp_update_post(['ID' => $post->ID, 'post_content' => wp_slash($content)], true);
        if (!is_wp_error($result)) {
            $restored++;
        }
    }

    WP_CLI::success('Rollback complete. Restored posts: ' . $restored . '.');
    return;
}

global $wpdb;
$post_ids = $wpdb->get_col(
    "SELECT ID FROM {$wpdb->posts}
     WHERE post_content LIKE '%wp:acf/form %'
       AND post_status NOT IN ('trash', 'auto-draft')
     ORDER BY ID"
);
$candidates = [];

foreach ($post_ids as $post_id) {
    $post = get_post((int) $post_id);
    if (!$post instanceof WP_Post) {
        continue;
    }

    $changes = 0;
    $content = serialize_blocks($transform_blocks(parse_blocks($post->post_content), $changes));
    if ($changes < 1 || $content === $post->post_content) {
        continue;
    }

    $candidates[] = [
        'post' => $post,
        'content' => $content,
        'changes' => $changes,
    ];
}

if ($mode === 'verify') {
    if ($candidates) {
        foreach ($candidates as $candidate) {
            WP_CLI::warning($candidate['post']->post_type . ':' . $candidate['post']->post_name . ' still contains legacy blocks.');
        }
        WP_CLI::error('Verification failed. Active legacy posts: ' . count($candidates) . '.');
    }

    WP_CLI::success('Verification passed: no active acf/form blocks.');
    return;
}

foreach ($candidates as $candidate) {
    WP_CLI::line(sprintf(
        '%s %s:%s (%d block%s)',
        $mode === 'apply' ? 'MIGRATE' : 'WOULD MIGRATE',
        $candidate['post']->post_type,
        $candidate['post']->post_name,
        $candidate['changes'],
        $candidate['changes'] === 1 ? '' : 's'
    ));
}

if ($mode === 'dry-run' || !$candidates) {
    WP_CLI::success(($mode === 'dry-run' ? 'Dry-run' : 'Apply') . ' complete. Candidates: ' . count($candidates) . '.');
    return;
}

if (!wp_mkdir_p($backup_directory)) {
    WP_CLI::error('Could not create the backup directory.');
}

$backup = [
    'version' => 1,
    'created_at' => gmdate('c'),
    'posts' => [],
];

foreach ($candidates as $candidate) {
    $post = $candidate['post'];
    $backup['posts'][] = [
        'id' => $post->ID,
        'post_type' => $post->post_type,
        'slug' => $post->post_name,
        'checksum' => hash('sha256', $post->post_content),
        'content_base64' => base64_encode($post->post_content),
    ];
}

$backup_file = $backup_directory . '/unified-forms-' . gmdate('Ymd-His') . '.json';
if (file_put_contents($backup_file, wp_json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) === false) {
    WP_CLI::error('Could not write the migration backup.');
}

$updated = 0;
$snapshots = [];
foreach ($candidates as $candidate) {
    $snapshots[] = [
        'id' => $candidate['post']->ID,
        'post_type' => $candidate['post']->post_type,
        'slug' => $candidate['post']->post_name,
        'content' => $candidate['post']->post_content,
    ];
}

$rollback_apply = static function (string $reason) use ($snapshots): void {
    WP_CLI::warning('[FIX:migration-atomicity] Apply failed; restoring all candidate snapshots. Reason: ' . $reason);
    $rollback_failures = [];
    foreach (array_reverse($snapshots) as $snapshot) {
        $restored = wp_update_post([
            'ID' => $snapshot['id'],
            'post_content' => wp_slash($snapshot['content']),
        ], true);
        $current = get_post($snapshot['id']);
        if (
            is_wp_error($restored)
            || !$current instanceof WP_Post
            || $current->post_type !== $snapshot['post_type']
            || $current->post_content !== $snapshot['content']
        ) {
            $rollback_failures[] = $snapshot['post_type'] . ':' . $snapshot['slug'];
        }
    }

    $message = $reason . ' Restored: ' . (count($snapshots) - count($rollback_failures)) . '/' . count($snapshots) . '.';
    if ($rollback_failures) {
        $message .= ' Rollback failed for: ' . implode(', ', $rollback_failures) . '.';
    }
    WP_CLI::error($message, (bool) apply_filters('space_form_migration_exit_on_error', true));
};

WP_CLI::log('[FIX:migration-atomicity] Apply started. Candidate snapshots: ' . count($snapshots) . '.');
try {
    foreach ($candidates as $candidate) {
        $filtered_result = apply_filters('space_form_migration_update_result', null, $candidate['post'], $candidate['content']);
        $result = $filtered_result === null
            ? wp_update_post([
                'ID' => $candidate['post']->ID,
                'post_content' => wp_slash($candidate['content']),
            ], true)
            : $filtered_result;

        $current = get_post($candidate['post']->ID);
        if (
            is_wp_error($result)
            || !is_numeric($result)
            || absint($result) !== $candidate['post']->ID
            || !$current instanceof WP_Post
            || $current->post_content !== $candidate['content']
        ) {
            $rollback_apply('Apply failed at ' . $candidate['post']->post_type . ':' . $candidate['post']->post_name . '.');
            return;
        }
        $updated++;
    }
} catch (Throwable $error) {
    $rollback_apply('Apply threw ' . get_class($error) . ': ' . $error->getMessage() . '.');
    return;
}

WP_CLI::log('[FIX:migration-atomicity] Apply verified. Updated: ' . $updated . '.');
WP_CLI::success('Apply complete. Updated: ' . $updated . '. Backup: ' . $backup_file . '.');
