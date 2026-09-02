<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_ajax_nopriv_feedback_form_custom', 'ajax_feedback_form_custom');
add_action('wp_ajax_feedback_form_custom', 'ajax_feedback_form_custom');

/** Handle all public inline and popup application forms. */
function ajax_feedback_form_custom(): void
{
    $request = wp_unslash($_POST);
    $files = $_FILES;

    wp_send_json(space_form_process_submission($request, $files));
}
