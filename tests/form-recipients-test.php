<?php

// Isolated recipient regression: no WordPress database, requests, or real email.
define('ABSPATH', __DIR__ . '/');

$test_options = [];

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

function sanitize_email(string $email): string
{
    // WordPress removes commas and spaces, which caused the original address glue.
    return preg_replace('/[^a-zA-Z0-9@._+\-]/', '', $email);
}

function is_email(string $email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
}

require dirname(__DIR__) . '/functions/forms/recipients.php';

$config = ['recipient' => 'main', 'fields' => []];
$check = static function (array $expected, array $actual, string $scenario): void {
    if ($expected !== $actual) {
        throw new RuntimeException('FAIL: ' . $scenario . ' (recipient sequence differs)');
    }
    echo 'PASS: ' . $scenario . "\n";
};

$test_options = [
    'site_feedback_main_email' => 'first@example.test, second@example.test',
    'admin_email' => 'fallback@example.test',
];
$check(['first@example.test', 'second@example.test'], space_form_resolve_recipients($config, []), 'main comma');

$test_options['site_feedback_main_email'] = "first@example.test; second@example.test\nfirst@example.test invalid@@example.test";
$check(['first@example.test', 'second@example.test'], space_form_resolve_recipients($config, []), 'separators duplicates and invalid');

$config['fields'] = [['dynamic_source' => 'partners', 'name' => 'distributor']];
$test_options['site_feedback_main_email'] = 'first@example.test';
$test_options['site_forms_partners'] = [
    ['item' => 'chosen', 'email' => 'second@example.test, third@example.test; first@example.test'],
];
$check(
    ['first@example.test', 'second@example.test', 'third@example.test'],
    space_form_resolve_recipients($config, ['distributor' => 'chosen']),
    'partner multiple addresses and cross-source duplicate'
);

$test_options['site_forms_partners'][0]['email'] = 'invalid@@example.test';
$check([], space_form_resolve_recipients($config, ['distributor' => 'chosen']), 'partner without valid address');

$test_options['site_forms_partners'] = [];
$check([], space_form_resolve_recipients($config, ['distributor' => 'missing']), 'partner missing');

$config['fields'] = [];
$test_options['site_feedback_main_email'] = '';
$test_options['admin_email'] = 'fallback@example.test; second@example.test';
$check(['fallback@example.test', 'second@example.test'], space_form_resolve_recipients($config, []), 'admin fallback');
