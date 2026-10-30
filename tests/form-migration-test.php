<?php

if (!defined('ABSPATH') || !defined('WP_CLI') || !WP_CLI) {
    fwrite(STDERR, "Run with wp eval-file.\n");
    exit(1);
}

$legacy_block = '<!-- wp:acf/form {"name":"acf/form","data":{"title":"Migration fixture"},"mode":"edit"} /-->';
$fixture_ids = [];
$backup_directory = dirname(ABSPATH) . '/.ai-factory/backups/forms';
$backups_before = glob($backup_directory . '/unified-forms-*.json') ?: [];

try {
    foreach (['a', 'b'] as $suffix) {
        $fixture_ids[] = wp_insert_post([
            'post_type' => 'page',
            'post_status' => 'draft',
            'post_title' => 'Migration fixture ' . $suffix,
            'post_name' => 'space-migration-fixture-' . $suffix,
            'post_content' => wp_slash($legacy_block),
        ]);
    }

    if (count(array_filter($fixture_ids)) !== 2) {
        throw new RuntimeException('Не удалось создать fixtures миграции.');
    }

    add_filter('space_form_migration_update_result', static function ($result, WP_Post $post, string $content) {
        if ($post->post_name !== 'space-migration-fixture-b') {
            return $result;
        }

        // Имитируем hook, который успел изменить текущую запись, но сообщил об ошибке.
        wp_update_post(['ID' => $post->ID, 'post_content' => wp_slash($content)]);
        return new WP_Error('forced_migration_failure_after_write');
    }, 10, 3);
    add_filter('space_form_migration_exit_on_error', '__return_false');

    $args = ['apply'];
    ob_start();
    include get_template_directory() . '/functions/migrations/migrate-unified-forms.php';
    ob_end_clean();

    remove_all_filters('space_form_migration_update_result');
    remove_filter('space_form_migration_exit_on_error', '__return_false');

    foreach ($fixture_ids as $fixture_id) {
        $content = (string) get_post_field('post_content', $fixture_id);
        if ($content !== $legacy_block) {
            throw new RuntimeException('После искусственной ошибки fixture не была восстановлена.');
        }
    }

    echo "PASS: migration failure restored all changed fixtures.\n";
} finally {
    remove_all_filters('space_form_migration_update_result');
    remove_filter('space_form_migration_exit_on_error', '__return_false');
    foreach ($fixture_ids as $fixture_id) {
        if ($fixture_id) {
            wp_delete_post($fixture_id, true);
        }
    }
    $backups_after = glob($backup_directory . '/unified-forms-*.json') ?: [];
    foreach (array_diff($backups_after, $backups_before) as $backup_file) {
        wp_delete_file($backup_file);
    }
}
