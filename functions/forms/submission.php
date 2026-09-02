<?php

if (!defined('ABSPATH')) {
    exit;
}

/** Build safe HTML shared by the administrative request and email. */
function space_form_build_message(array $config, array $values, array $uploads, array $context): string
{
    $rows = [];

    foreach ($config['fields'] as $field) {
        $value = '';
        $is_link = false;

        if ($field['type'] === 'file' && isset($uploads[$field['name']])) {
            $value = $uploads[$field['name']]['url'];
            $is_link = true;
        } elseif ($field['type'] === 'hidden' && $field['context_key'] !== '') {
            $value = $context[$field['context_key']] ?? '';
            $is_link = $field['context_key'] === 'post_url';
        } else {
            $value = $values[$field['name']] ?? '';
        }

        if ($value === '') {
            continue;
        }

        $safe_value = $is_link
            ? '<a href="' . esc_url($value) . '" target="_blank" rel="noopener">' . esc_html($value) . '</a>'
            : nl2br(esc_html($value));
        $rows[] = '<tr><td><b>' . esc_html($field['label']) . '</b></td><td>' . $safe_value . '</td></tr>';
    }

    $rows[] = '<tr><td><b>Название формы</b></td><td>' . esc_html($config['service_name']) . '</td></tr>';
    if (!empty($context['post_url'])) {
        $rows[] = '<tr><td><b>Страница отправки</b></td><td><a href="'
            . esc_url($context['post_url']) . '" target="_blank" rel="noopener">'
            . esc_html($context['post_url']) . '</a></td></tr>';
    }

    return '<p style="font-size:22px;text-align:center;padding-bottom:30px;margin:0"><b>Детали заявки:</b></p>'
        . '<table style="width:100%;border-collapse:collapse">'
        . implode('', $rows)
        . '</table>';
}

/** Process one authenticated submission and return the public JSON contract. */
function space_form_process_submission(array $request, array $files): array
{
    if (!space_form_verify_nonce((string) ($request['form_nonce'] ?? ''))) {
        return ['status' => false, 'error' => 'invalid_nonce'];
    }

    $config = space_form_verify_schema_token((string) ($request['form_schema'] ?? ''));
    if (is_wp_error($config)) {
        return ['status' => false, 'error' => $config->get_error_code()];
    }

    if ($config['agreement_required'] && empty($request['form_agreement'])) {
        return ['status' => false, 'error' => 'validation_failed', 'errors' => ['form_agreement' => 'required']];
    }

    $posted_fields = is_array($request['custom_field'] ?? null) ? $request['custom_field'] : [];
    $validation = space_form_validate_values($config, $posted_fields);
    if ($validation['errors']) {
        return ['status' => false, 'error' => 'validation_failed', 'errors' => $validation['errors']];
    }

    $recipients = space_form_resolve_recipients($config, $validation['values']);
    if (!$recipients) {
        return ['status' => false, 'error' => 'recipient_unavailable'];
    }

    $upload_result = space_form_handle_uploads($config, $files['custom_file'] ?? []);
    if ($upload_result['errors']) {
        space_form_delete_uploads($upload_result['uploads']);
        return ['status' => false, 'error' => 'upload_failed', 'errors' => $upload_result['errors']];
    }

    $context = space_form_resolve_context($config);
    $message = space_form_build_message($config, $validation['values'], $upload_result['uploads'], $context);
    $post_id = wp_insert_post([
        'post_title' => $config['service_name'],
        'post_status' => 'publish',
        'post_type' => 'mail',
        'post_content' => $message,
    ], true);

    if (is_wp_error($post_id) || !$post_id) {
        space_form_delete_uploads($upload_result['uploads']);
        return ['status' => false, 'error' => 'request_creation_failed'];
    }

    foreach ($upload_result['uploads'] as $upload) {
        wp_update_post([
            'ID' => $upload['attachment_id'],
            'post_parent' => $post_id,
        ]);
    }

    $subject = $config['service_name'] . ' с сайта Space';
    $headers = ['Content-Type: text/html; charset=UTF-8', 'From: Space <info@spacevm.ru>'];
    $mail_sent = true;

    foreach ($recipients as $recipient) {
        if (!wp_mail($recipient, $subject, $message, $headers)) {
            $mail_sent = false;
        }
    }

    if (!$mail_sent) {
        return ['status' => false, 'error' => 'mail_failed'];
    }

    return ['status' => true];
}
