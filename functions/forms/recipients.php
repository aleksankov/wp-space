<?php

if (!defined('ABSPATH')) {
    exit;
}

/** Split a trusted setting before sanitizing individual addresses. */
function space_form_parse_recipients($configured, string $source): array
{
    $parts = is_string($configured) ? preg_split('/[,;\s]+/', trim($configured), -1, PREG_SPLIT_NO_EMPTY) : [];
    $recipients = [];
    $rejected = 0;

    foreach ($parts as $part) {
        // Validate the original token so sanitization cannot turn an invalid input into a different address.
        if (!is_email($part)) {
            $rejected++;
            continue;
        }

        $recipient = sanitize_email($part);
        if ($recipient !== $part || !is_email($recipient)) {
            $rejected++;
            continue;
        }

        $recipients[] = $recipient;
    }

    if (defined('WP_DEBUG') && WP_DEBUG
        && function_exists('wp_get_environment_type') && wp_get_environment_type() !== 'production') {
        error_log(sprintf('[forms:recipients] source=%s accepted=%d rejected=%d', $source, count($recipients), $rejected));
    }

    return $recipients;
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
    $source = $configured ? 'primary' : 'fallback';
    $configured = $configured ?: get_option('admin_email');
    $recipients = space_form_parse_recipients($configured, $source);

    foreach ($config['fields'] as $field) {
        if ($field['dynamic_source'] !== 'partners') {
            continue;
        }

        $selected_partner = $values[$field['name']] ?? '';
        $partners = function_exists('get_field') ? get_field('site_forms_partners', 'option') : [];

        $partner_recipients = [];
        foreach (is_array($partners) ? $partners : [] as $partner) {
            if ((string) ($partner['item'] ?? '') === $selected_partner) {
                $partner_recipients = space_form_parse_recipients($partner['email'] ?? '', 'partner');
                break;
            }
        }

        if (!$partner_recipients) {
            error_log('[forms:recipients] selected partner has no valid delivery address');
            return [];
        }
        $recipients = array_merge($recipients, $partner_recipients);
    }

    $recipients = array_values(array_unique($recipients));
    if (!$recipients) {
        error_log('[forms:recipients] no valid delivery address');
    }
    return $recipients;
}
