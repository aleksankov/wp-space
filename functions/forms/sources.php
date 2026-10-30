<?php

if (!defined('ABSPATH')) {
    exit;
}

/** Find the first form block inside a reusable source, including nested blocks. */
function space_form_find_block(array $blocks, string $block_name): ?array
{
    foreach ($blocks as $block) {
        if (($block['blockName'] ?? '') === $block_name) {
            return $block;
        }

        if (!empty($block['innerBlocks'])) {
            $found = space_form_find_block($block['innerBlocks'], $block_name);
            if ($found) {
                return $found;
            }
        }
    }

    return null;
}

/** Load one canonical form configuration selected in ACF Options. */
function space_form_get_option_source_config(string $option_name, array $fallback): array
{
    if (empty($fallback['context'])) {
        $queried_id = get_queried_object_id();
        $fallback['context'] = [
            'type' => $queried_id > 0 && get_post_type($queried_id) === 'vacancies' ? 'vacancy' : 'post',
            'post_id' => $queried_id,
        ];
    }

    $source = function_exists('get_field') ? get_field($option_name, 'option') : null;
    $source_id = $source instanceof WP_Post ? $source->ID : absint($source);
    $source_post = $source_id > 0 ? get_post($source_id) : null;

    if (!$source_post instanceof WP_Post || $source_post->post_type !== 'wp_block') {
        return space_form_normalize_config($fallback);
    }

    $block = space_form_find_block(parse_blocks($source_post->post_content), 'acf/form-custom');
    if (!$block) {
        return space_form_normalize_config($fallback);
    }

    return space_form_config_from_block($block, 'inline');
}
