<?php

if (!defined('ABSPATH')) {
    exit;
}

/** Validate and store files defined by the signed form schema. */
function space_form_handle_uploads(array $config, $uploaded_files): array
{
    $uploaded_files = space_form_normalize_uploaded_files($uploaded_files);
    $uploads = [];
    $errors = [];
    $mime_types = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    foreach ($config['fields'] as $field) {
        if ($field['type'] !== 'file') {
            continue;
        }

        $file = is_array($uploaded_files[$field['name']] ?? null) ? $uploaded_files[$field['name']] : [];
        $upload_error = absint($file['error'] ?? UPLOAD_ERR_NO_FILE);

        if ($upload_error === UPLOAD_ERR_NO_FILE) {
            if ($field['required']) {
                $errors[$field['name']] = 'required';
            }
            continue;
        }

        if ($upload_error !== UPLOAD_ERR_OK || empty($file['tmp_name']) || empty($file['name'])) {
            $errors[$field['name']] = 'upload_failed';
            continue;
        }

        if (absint($file['size'] ?? 0) > $field['max_file_size']) {
            $errors[$field['name']] = 'file_too_large';
            continue;
        }

        $allowed_mimes = [];
        foreach ($field['allowed_extensions'] as $extension) {
            if (isset($mime_types[$extension])) {
                $allowed_mimes[$extension] = $mime_types[$extension];
            }
        }

        $checked = wp_check_filetype_and_ext($file['tmp_name'], $file['name'], $allowed_mimes);
        if (empty($checked['ext']) || empty($checked['type']) || !isset($allowed_mimes[$checked['ext']])) {
            $errors[$field['name']] = 'invalid_file_type';
            continue;
        }

        add_filter('upload_dir', 'custom_upload_directory');
        $moved = wp_handle_upload($file, ['test_form' => false, 'mimes' => $allowed_mimes]);
        remove_filter('upload_dir', 'custom_upload_directory');

        if (!is_array($moved) || isset($moved['error']) || empty($moved['file'])) {
            $errors[$field['name']] = 'upload_failed';
            continue;
        }

        $attachment_id = wp_insert_attachment([
            'post_mime_type' => $moved['type'],
            'post_title' => sanitize_file_name(pathinfo($file['name'], PATHINFO_FILENAME)),
            'post_status' => 'inherit',
        ], $moved['file'], 0, true);

        if (is_wp_error($attachment_id)) {
            wp_delete_file($moved['file']);
            $errors[$field['name']] = 'upload_failed';
            continue;
        }

        wp_update_attachment_metadata($attachment_id, wp_generate_attachment_metadata($attachment_id, $moved['file']));
        $uploads[$field['name']] = [
            'attachment_id' => (int) $attachment_id,
            'url' => esc_url_raw($moved['url']),
            'name' => sanitize_file_name($file['name']),
        ];
    }

    return ['uploads' => $uploads, 'errors' => $errors];
}

/** Convert PHP's nested file-array shape to one file array per field name. */
function space_form_normalize_uploaded_files($bucket): array
{
    if (!is_array($bucket) || !isset($bucket['name']) || !is_array($bucket['name'])) {
        return is_array($bucket) ? $bucket : [];
    }

    $normalized = [];
    foreach (array_keys($bucket['name']) as $name) {
        $normalized[sanitize_key((string) $name)] = [
            'name' => $bucket['name'][$name] ?? '',
            'full_path' => $bucket['full_path'][$name] ?? '',
            'type' => $bucket['type'][$name] ?? '',
            'tmp_name' => $bucket['tmp_name'][$name] ?? '',
            'error' => $bucket['error'][$name] ?? UPLOAD_ERR_NO_FILE,
            'size' => $bucket['size'][$name] ?? 0,
        ];
    }

    return $normalized;
}

/** Remove uploaded attachments after a failed request insertion. */
function space_form_delete_uploads(array $uploads): void
{
    foreach ($uploads as $upload) {
        $attachment_id = absint($upload['attachment_id'] ?? 0);
        if ($attachment_id > 0) {
            wp_delete_attachment($attachment_id, true);
        }
    }
}
