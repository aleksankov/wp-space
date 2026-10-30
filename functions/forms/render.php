<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Resolve editor and site-option values into safe select options.
 */
function space_form_get_field_options(array $field): array
{
    if ($field['dynamic_source'] === 'products') {
        $rows = function_exists('get_field') ? get_field('site_forms_products', 'option') : [];
        return space_form_normalize_options(array_map(static function ($row): array {
            return ['text' => $row['item'] ?? ''];
        }, is_array($rows) ? $rows : []));
    }

    if ($field['dynamic_source'] === 'partners') {
        $rows = function_exists('get_field') ? get_field('site_forms_partners', 'option') : [];
        return space_form_normalize_options(array_map(static function ($row): array {
            return ['text' => $row['item'] ?? ''];
        }, is_array($rows) ? $rows : []));
    }

    if ($field['dynamic_source'] === 'production') {
        $rows = function_exists('get_production_values') ? get_production_values() : [];
        return space_form_normalize_options($rows);
    }

    return $field['options'];
}

/**
 * Render all configured fields using the shared field partial.
 */
function space_form_render_fields(array $config, string $layout): void
{
    $layout = in_array($layout, ['inline', 'popup', 'home', 'vacancy'], true) ? $layout : 'inline';

    foreach ($config['fields'] as $field) {
        $field['options'] = space_form_get_field_options($field);
        $field_id = wp_unique_id('space-form-' . $field['name'] . '-');

        get_template_part('templates/parts/forms/field', null, [
            'field' => $field,
            'field_id' => $field_id,
            'layout' => $layout,
        ]);
    }
}

/**
 * Render fields required to authenticate a unified form submission.
 */
function space_form_render_security_fields(array $config): void
{
    $schema_token = space_form_create_schema_token($config);

    if ($schema_token === '') {
        return;
    }
    ?>
    <input type="hidden" name="form_schema" value="<?= esc_attr($schema_token); ?>">
    <input type="hidden" name="form_nonce" value="<?= esc_attr(wp_create_nonce(space_form_nonce_action())); ?>">
    <?php
}

/** Render agreement as plain copy or a required checkbox from the signed config. */
function space_form_render_agreement(array $config, string $class_name): void
{
    $text = space_form_get_agreement_text($config);
    if ($text === '') {
        return;
    }

    $class_name = sanitize_html_class($class_name);
    if (!$config['agreement_required']) {
        echo '<div class="' . esc_attr($class_name) . '">' . wp_kses_post($text) . '</div>';
        return;
    }
    ?>
    <div class="<?= esc_attr($class_name); ?>" data-form-field="form_agreement">
        <div class="main-checkbox">
            <label>
                <input type="checkbox" name="form_agreement" value="1" required data-required>
                <span><?= wp_kses_post($text); ?></span>
            </label>
        </div>
        <div class="form-field-error" data-form-error aria-live="polite"></div>
    </div>
    <?php
}
