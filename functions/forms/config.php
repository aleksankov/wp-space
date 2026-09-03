<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return field types supported by the unified form renderer and handler.
 */
function space_form_allowed_field_types(): array
{
    return [
        'text',
        'tel',
        'email',
        'textarea',
        'select',
        'file',
        'products',
        'partners',
        'production',
        'hidden',
    ];
}

/**
 * Normalize select options without accepting arbitrary nested data.
 */
function space_form_normalize_options($options): array
{
    if (!is_array($options)) {
        return [];
    }

    $normalized = [];

    foreach ($options as $option) {
        if (is_scalar($option)) {
            $value = sanitize_text_field((string) $option);
            $label = $value;
        } elseif (is_array($option)) {
            $value = sanitize_text_field((string) ($option['value'] ?? $option['text'] ?? ''));
            $label = sanitize_text_field((string) ($option['label'] ?? $option['text'] ?? $value));
        } else {
            continue;
        }

        if ($value === '') {
            continue;
        }

        $normalized[$value] = [
            'value' => $value,
            'label' => $label !== '' ? $label : $value,
        ];
    }

    return array_values($normalized);
}

/**
 * Normalize one editor-defined field into a server-verifiable schema row.
 */
function space_form_normalize_field($field, int $index): ?array
{
    if (!is_array($field)) {
        return null;
    }

    $type = sanitize_key((string) ($field['type'] ?? 'text'));
    if (!in_array($type, space_form_allowed_field_types(), true)) {
        return null;
    }

    $name = sanitize_key((string) ($field['name'] ?? ''));
    if ($name === '') {
        $name = 'field_' . ($index + 1);
    }

    $max_length = absint($field['max_length'] ?? 0);
    if ($max_length < 1) {
        $max_length = $type === 'textarea' ? 5000 : 500;
    }
    $max_length = min(max($max_length, 1), $type === 'textarea' ? 10000 : 1000);
    $dynamic_source = in_array($type, ['products', 'partners', 'production'], true) ? $type : '';
    $allowed_extensions = array_values(array_intersect(
        array_map('sanitize_key', (array) ($field['allowed_extensions'] ?? ['pdf', 'doc', 'docx'])),
        ['pdf', 'doc', 'docx']
    ));
    $configured_file_size = absint($field['max_file_size'] ?? 3);
    $max_file_size = $configured_file_size > 10
        ? min(max($configured_file_size, MB_IN_BYTES), 10 * MB_IN_BYTES)
        : min(max($configured_file_size, 1), 10) * MB_IN_BYTES;

    return [
        'type' => $type,
        'name' => $name,
        'label' => sanitize_text_field((string) ($field['label'] ?? '')),
        'required' => !empty($field['required']),
        'max_length' => $max_length,
        'options' => $type === 'select' ? space_form_normalize_options($field['options'] ?? []) : [],
        'dynamic_source' => $dynamic_source,
        'allowed_extensions' => $type === 'file' && $allowed_extensions
            ? $allowed_extensions
            : ($type === 'file' ? ['pdf', 'doc', 'docx'] : []),
        'max_file_size' => $type === 'file' ? $max_file_size : 0,
        'context_key' => $type === 'hidden' ? sanitize_key((string) ($field['context_key'] ?? '')) : '',
    ];
}

/**
 * Normalize block data into the single configuration used by both layouts.
 */
function space_form_normalize_config(array $config): array
{
    $mode = sanitize_key((string) ($config['mode'] ?? 'inline'));
    $mode = in_array($mode, ['inline', 'popup'], true) ? $mode : 'inline';
    $recipient = sanitize_key((string) ($config['recipient'] ?? 'main'));
    $recipient = in_array($recipient, ['main', 'partner', 'tech_partner', 'hr'], true)
        ? $recipient
        : 'main';
    $agreement_mode = sanitize_key((string) ($config['agreement_mode'] ?? 'global'));
    $agreement_mode = in_array($agreement_mode, ['global', 'custom', 'hidden'], true)
        ? $agreement_mode
        : 'global';
    $fields = [];
    $field_names = [];

    foreach ((array) ($config['fields'] ?? []) as $index => $field) {
        $normalized_field = space_form_normalize_field($field, (int) $index);
        if (!$normalized_field || isset($field_names[$normalized_field['name']])) {
            continue;
        }

        $field_names[$normalized_field['name']] = true;
        $fields[] = $normalized_field;
    }

    $context = is_array($config['context'] ?? null) ? $config['context'] : [];
    $context_type = sanitize_key((string) ($context['type'] ?? ''));
    if (!in_array($context_type, ['', 'post', 'vacancy'], true)) {
        $context_type = '';
    }

    return [
        'version' => 1,
        'mode' => $mode,
        'id' => sanitize_title((string) ($config['id'] ?? '')),
        'title' => wp_kses_post((string) ($config['title'] ?? '')),
        'service_name' => sanitize_text_field((string) ($config['service_name'] ?? 'Заявка')) ?: 'Заявка',
        'fields' => $fields,
        'submit_label' => sanitize_text_field((string) ($config['submit_label'] ?? 'Отправить')) ?: 'Отправить',
        'agreement_mode' => $agreement_mode,
        'agreement_text' => $agreement_mode === 'custom'
            ? wp_kses_post((string) ($config['agreement_text'] ?? ''))
            : '',
        'agreement_required' => !empty($config['agreement_required']),
        'recipient' => $recipient,
        'variant' => sanitize_html_class((string) ($config['variant'] ?? 'default')),
        'context' => [
            'type' => $context_type,
            'post_id' => $context_type !== '' ? absint($context['post_id'] ?? 0) : 0,
        ],
    ];
}

/** Convert legacy ACF names of either form block to canonical data. */
function space_form_config_from_block($block, string $mode): array
{
    $is_popup = $mode === 'popup';
    $prefix = $is_popup ? 'form-custom-popup' : 'form-custom';
    $row_prefix = $is_popup ? 'form-custom-popup-fields' : 'form-custom-fields';
    $block_data = is_array($block['attrs']['data'] ?? null) ? $block['attrs']['data'] : [];
    $rows = [];

    if ($block_data) {
        $row_count = absint($block_data[$prefix . '-fields'] ?? 0);
        for ($index = 0; $index < $row_count; $index++) {
            $base = $prefix . '-fields_' . $index . '_';
            $row = [
                $row_prefix . '-type' => $block_data[$base . $row_prefix . '-type'] ?? '',
                $row_prefix . '-name' => $block_data[$base . $row_prefix . '-name'] ?? '',
                $row_prefix . '-placeholder' => $block_data[$base . $row_prefix . '-placeholder'] ?? '',
                ($is_popup ? 'form-custom-fields-popup-required' : 'form-custom-fields-required')
                    => $block_data[$base . ($is_popup ? 'form-custom-fields-popup-required' : 'form-custom-fields-required')] ?? '0',
                $row_prefix . '-max-length' => $block_data[$base . $row_prefix . '-max-length'] ?? '',
                $row_prefix . '-file-extensions' => $block_data[$base . $row_prefix . '-file-extensions'] ?? [],
                $row_prefix . '-file-size' => $block_data[$base . $row_prefix . '-file-size'] ?? 3,
                $row_prefix . '-context-key' => $block_data[$base . $row_prefix . '-context-key'] ?? '',
                $row_prefix . '-variants' => [],
            ];
            $variant_count = absint($block_data[$base . $row_prefix . '-variants'] ?? 0);
            for ($variant_index = 0; $variant_index < $variant_count; $variant_index++) {
                $variant_base = $base . $row_prefix . '-variants_' . $variant_index . '_';
                $row[$row_prefix . '-variants'][] = [
                    $row_prefix . '-variants-text' => $block_data[$variant_base . $row_prefix . '-variants-text'] ?? '',
                ];
            }
            $rows[] = $row;
        }
    } else {
        $rows = get_field_block($prefix . '-fields', $block);
    }
    $fields = [];

    foreach (is_array($rows) ? $rows : [] as $row) {
        $options = [];
        foreach ((array) ($row[$row_prefix . '-variants'] ?? []) as $option) {
            $options[] = ['text' => $option[$row_prefix . '-variants-text'] ?? ''];
        }

        $fields[] = [
            'type' => $row[$row_prefix . '-type'] ?? 'text',
            'name' => $row[$row_prefix . '-name'] ?? '',
            'label' => $row[$row_prefix . '-placeholder'] ?? '',
            'required' => !empty($row[$is_popup ? 'form-custom-fields-popup-required' : 'form-custom-fields-required']),
            'max_length' => $row[$row_prefix . '-max-length'] ?? '',
            'options' => $options,
            'allowed_extensions' => $row[$row_prefix . '-file-extensions'] ?? [],
            'max_file_size' => $row[$row_prefix . '-file-size'] ?? 3,
            'context_key' => $row[$row_prefix . '-context-key'] ?? '',
        ];
    }

    $queried_id = get_queried_object_id();
    $context_type = $queried_id > 0 ? 'post' : '';
    if ($queried_id > 0 && get_post_type($queried_id) === 'vacancies') {
        $context_type = 'vacancy';
    }

    $block_value = static function (string $name) use ($block_data, $block) {
        return array_key_exists($name, $block_data) ? $block_data[$name] : get_field_block($name, $block);
    };

    return space_form_normalize_config([
        'mode' => $is_popup ? 'popup' : 'inline',
        'id' => $is_popup ? $block_value($prefix . '-id') : '',
        'title' => $block_value($prefix . '-title'),
        'service_name' => $block_value($prefix . '-title-form'),
        'fields' => $fields,
        'submit_label' => $block_value($prefix . '-submit-label'),
        'agreement_mode' => $block_value($prefix . '-agreement-mode'),
        'agreement_text' => $block_value($prefix . '-agreement-text'),
        'agreement_required' => (bool) $block_value($prefix . '-agreement-required'),
        'recipient' => $block_value($prefix . '-recipient'),
        'variant' => $block_value($prefix . '-variant'),
        'context' => ['type' => $context_type, 'post_id' => $queried_id],
    ]);
}

/** Resolve the visible agreement copy for a normalized form. */
function space_form_get_agreement_text(array $config): string
{
    if ($config['agreement_mode'] === 'hidden') {
        return '';
    }

    if ($config['agreement_mode'] === 'custom') {
        return (string) $config['agreement_text'];
    }

    return function_exists('get_field') ? (string) get_field('site_forms_agree', 'option') : '';
}
