<?php

if (!defined('ABSPATH')) {
    exit;
}
/** Validate submitted values strictly against the signed schema. */
function space_form_validate_values(array $config, $posted_fields): array
{
    $posted_fields = is_array($posted_fields) ? $posted_fields : [];
    $values = [];
    $errors = [];

    foreach ($config['fields'] as $field) {
        if (in_array($field['type'], ['file', 'hidden'], true)) {
            continue;
        }

        $posted = is_array($posted_fields[$field['name']] ?? null)
            ? $posted_fields[$field['name']]
            : [];
        $raw_value = is_scalar($posted['value'] ?? null) ? (string) $posted['value'] : '';
        $value = $field['type'] === 'textarea'
            ? sanitize_textarea_field($raw_value)
            : sanitize_text_field($raw_value);

        if ($value === '0') {
            $value = '';
        }

        if ($field['required'] && $value === '') {
            $errors[$field['name']] = 'required';
            continue;
        }

        if ($value === '') {
            $values[$field['name']] = '';
            continue;
        }

        if (mb_strlen($value) > $field['max_length']) {
            $errors[$field['name']] = 'too_long';
            continue;
        }

        if ($field['type'] === 'email' && !is_email($value)) {
            $errors[$field['name']] = 'invalid_email';
            continue;
        }

        if ($field['type'] === 'tel' && !preg_match('/^[0-9+()\-\s]{7,30}$/u', $value)) {
            $errors[$field['name']] = 'invalid_phone';
            continue;
        }

        if ($field['type'] === 'select') {
            $allowed_values = wp_list_pluck($field['options'], 'value');
            if (!in_array($value, $allowed_values, true)) {
                $errors[$field['name']] = 'invalid_option';
                continue;
            }
        }

        if ($field['dynamic_source'] !== '') {
            $allowed_values = wp_list_pluck(space_form_get_field_options($field), 'value');
            if (!in_array($value, $allowed_values, true)) {
                $errors[$field['name']] = 'invalid_option';
                continue;
            }
        }

        $values[$field['name']] = $value;
    }

    return ['values' => $values, 'errors' => $errors];
}

/** Resolve signed page context without trusting hidden browser fields. */
function space_form_resolve_context(array $config): array
{
    $context = $config['context'];
    $post = $context['post_id'] > 0 ? get_post($context['post_id']) : null;

    if (!$post instanceof WP_Post || !in_array($post->post_status, ['publish', 'private'], true)) {
        return [];
    }

    if ($context['type'] === 'vacancy' && $post->post_type !== 'vacancies') {
        return [];
    }

    return [
        'post_title' => get_the_title($post),
        'post_url' => get_permalink($post),
        'vacancy_title' => $context['type'] === 'vacancy' ? get_the_title($post) : '',
    ];
}
