<?php

if (!defined('ABSPATH')) {
    exit;
}
/** Resolve recipient addresses exclusively from trusted site settings. */
function space_form_resolve_recipients(array $config, array $values): array
{
    $option_fields = [
        'main' => 'site_feedback_main_email',
        'partner' => 'site_feedback_partner_email',
        'tech_partner' => 'site_feedback_tech_partner_email',
        'hr' => 'site_feedback_hr_email',
    ];
    $option_name = $option_fields[$config['recipient']] ?? $option_fields['main'];
    $configured = function_exists('get_field') ? get_field($option_name, 'option') : '';
    $configured = $configured ?: get_option('admin_email');
    $recipients = preg_split('/[,;\s]+/', (string) $configured, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($config['fields'] as $field) {
        if ($field['dynamic_source'] !== 'partners') {
            continue;
        }

        $selected_partner = $values[$field['name']] ?? '';
        $partners = function_exists('get_field') ? get_field('site_forms_partners', 'option') : [];

        foreach (is_array($partners) ? $partners : [] as $partner) {
            if ((string) ($partner['item'] ?? '') === $selected_partner) {
                $recipients[] = (string) ($partner['email'] ?? '');
                break;
            }
        }
    }

    return array_values(array_unique(array_filter(array_map('sanitize_email', $recipients), 'is_email')));
}
