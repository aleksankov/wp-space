<?php

// Isolated server contract: all persistence and mail calls are intercepted.
define('ABSPATH', __DIR__ . '/');
$test_options = [];
$test_posts = [];
$test_meta = [];
$test_mail_calls = [];
$test_mail_results = [];

function get_field(string $name, string $scope)
{
    global $test_options;
    return $test_options[$name] ?? false;
}

function get_option(string $name)
{
    global $test_options;
    return $test_options[$name] ?? false;
}

function is_email(string $email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
}

function sanitize_email(string $email): string
{
    return preg_replace('/[^a-zA-Z0-9@._+\-]/', '', $email);
}

function space_form_verify_nonce(string $nonce): bool
{
    return $nonce === 'valid';
}

function space_form_verify_schema_token(string $token): array
{
    return [
        'service_name' => 'Изолированный тест',
        'recipient' => 'main',
        'agreement_required' => false,
        'fields' => $token === 'partner' ? [[
            'type' => 'text', 'name' => 'distributor', 'label' => 'Дистрибьютор',
            'dynamic_source' => 'partners', 'context_key' => '',
        ]] : [],
    ];
}

function is_wp_error($value): bool
{
    return false;
}

function space_form_validate_values(array $config, array $posted): array
{
    return ['values' => ['distributor' => $posted['distributor']['value'] ?? ''], 'errors' => []];
}

function space_form_handle_uploads(array $config, array $files): array
{
    return ['uploads' => [], 'errors' => []];
}

function space_form_resolve_context(array $config): array
{
    return [];
}

function esc_url(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES);
}

function esc_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES);
}

function wp_insert_post(array $post, bool $return_error): int
{
    global $test_posts;
    $id = count($test_posts) + 1;
    $test_posts[$id] = $post;
    return $id;
}

function wp_update_post(array $post): int
{
    return (int) $post['ID'];
}

function update_post_meta(int $post_id, string $key, $value): void
{
    global $test_meta;
    $test_meta[$post_id][$key] = $value;
}

function wp_mail(string $to, string $subject, string $message, array $headers): bool
{
    global $test_mail_calls, $test_mail_results;
    $test_mail_calls[] = $to;
    return array_shift($test_mail_results) ?? true;
}

require dirname(__DIR__) . '/functions/forms/recipients.php';
require dirname(__DIR__) . '/functions/forms/submission.php';

$check = static function ($condition, string $scenario): void {
    if (!$condition) {
        throw new RuntimeException('FAIL: ' . $scenario);
    }
    echo 'PASS: ' . $scenario . "\n";
};
$request = ['form_nonce' => 'valid', 'form_schema' => 'main'];
$test_options = [
    'site_feedback_main_email' => 'first@example.test, second@example.test',
    'admin_email' => 'fallback@example.test',
];

$result = space_form_process_submission($request, []);
$check($result === ['status' => true], 'all mail calls succeed');
$check($test_mail_calls === ['first@example.test', 'second@example.test'], 'main exact recipient sequence');
$check($test_meta[1]['_space_form_delivery_status'] === 'sent'
    && $test_meta[1]['_space_form_delivery_sent_count'] === 2
    && $test_meta[1]['_space_form_delivery_failed_count'] === 0, 'sent status and counts');

$test_mail_calls = [];
$test_mail_results = [true, false, true];
$test_options['site_feedback_main_email'] = 'first@example.test';
$test_options['site_forms_partners'] = [[
    'item' => 'chosen', 'email' => 'second@example.test, third@example.test',
]];
$partner_request = ['form_nonce' => 'valid', 'form_schema' => 'partner',
    'custom_field' => ['distributor' => ['value' => 'chosen']]];
$result = space_form_process_submission($partner_request, []);
$check($result === ['status' => false, 'error' => 'mail_failed', 'request_saved' => true], 'partial failure public response');
$check($test_mail_calls === ['first@example.test', 'second@example.test', 'third@example.test'], 'partner exact recipient sequence');
$check($test_meta[2]['_space_form_delivery_status'] === 'partial_failed'
    && $test_meta[2]['_space_form_delivery_sent_count'] === 2
    && $test_meta[2]['_space_form_delivery_failed_count'] === 1, 'partial failure status and counts');

$test_mail_calls = [];
$test_mail_results = [false, false];
$test_options['site_feedback_main_email'] = 'first@example.test, second@example.test';
$result = space_form_process_submission($request, []);
$check($result === ['status' => false, 'error' => 'mail_failed', 'request_saved' => true], 'all failed public response');
$check($test_meta[3]['_space_form_delivery_status'] === 'all_failed'
    && $test_meta[3]['_space_form_delivery_sent_count'] === 0
    && $test_meta[3]['_space_form_delivery_failed_count'] === 2, 'all failed status and counts');

$before_posts = count($test_posts);
$test_mail_calls = [];
$test_options['site_forms_partners'][0]['email'] = 'invalid@@example.test';
$result = space_form_process_submission($partner_request, []);
$check($result === ['status' => false, 'error' => 'recipient_unavailable']
    && count($test_posts) === $before_posts && $test_mail_calls === [], 'invalid partner rejected before save');

$result = space_form_process_submission(['form_nonce' => 'invalid', 'form_schema' => 'main'], []);
$check($result === ['status' => false, 'error' => 'invalid_nonce']
    && count($test_posts) === $before_posts, 'invalid nonce rejected before save');
