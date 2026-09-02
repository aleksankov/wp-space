<?php

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Encode binary-safe data for a form schema token.
 */
function space_form_base64url_encode(string $value): string
{
    return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
}

/**
 * Decode a form schema token segment.
 */
function space_form_base64url_decode(string $value)
{
    $remainder = strlen($value) % 4;
    if ($remainder > 0) {
        $value .= str_repeat('=', 4 - $remainder);
    }

    return base64_decode(strtr($value, '-_', '+/'), true);
}

/**
 * Build a signed public token. The signing secret never leaves the server.
 */
function space_form_create_schema_token(array $config): string
{
    $schema = space_form_normalize_config($config);
    $payload = wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if (!is_string($payload)) {
        return '';
    }

    $encoded_payload = space_form_base64url_encode($payload);
    $signature = hash_hmac('sha256', $encoded_payload, wp_salt('auth'));

    return $encoded_payload . '.' . $signature;
}

/**
 * Verify a schema token and return the normalized trusted configuration.
 *
 * @return array|WP_Error
 */
function space_form_verify_schema_token($token)
{
    if (!is_string($token) || substr_count($token, '.') !== 1) {
        return new WP_Error('invalid_form_schema', 'Некорректная конфигурация формы.');
    }

    [$encoded_payload, $provided_signature] = explode('.', $token, 2);
    $expected_signature = hash_hmac('sha256', $encoded_payload, wp_salt('auth'));

    if ($provided_signature === '' || !hash_equals($expected_signature, $provided_signature)) {
        return new WP_Error('invalid_form_schema', 'Некорректная конфигурация формы.');
    }

    $payload = space_form_base64url_decode($encoded_payload);
    if (!is_string($payload)) {
        return new WP_Error('invalid_form_schema', 'Некорректная конфигурация формы.');
    }

    $schema = json_decode($payload, true);
    if (!is_array($schema) || (int) ($schema['version'] ?? 0) !== 1) {
        return new WP_Error('invalid_form_schema', 'Некорректная конфигурация формы.');
    }

    return space_form_normalize_config($schema);
}

/**
 * Return the nonce action shared by inline and popup forms.
 */
function space_form_nonce_action(): string
{
    return 'space_unified_form_submit';
}

/**
 * Validate the public request nonce without terminating the AJAX request.
 */
function space_form_verify_nonce($nonce): bool
{
    return is_string($nonce)
        && $nonce !== ''
        && (bool) wp_verify_nonce($nonce, space_form_nonce_action());
}
