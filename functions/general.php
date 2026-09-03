<?php
//shutdown
// remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

//debug
function debug($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

//main theme settings
add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
} );

//custom upload directory
function custom_upload_directory($dirs) {
    $custom_dir = 'form_upload';
    $dirs['path'] = str_replace($dirs['subdir'], '/' . $custom_dir, $dirs['path']);
    $dirs['url'] = str_replace($dirs['subdir'], '/' . $custom_dir, $dirs['url']);
    $dirs['subdir'] = '/' . $custom_dir;
    return $dirs;
}

//retina img
function get_retina_img($img = false, $alt = ''){
    if( $img ){
        $url = $img['url'];
        $width = $img['width'] / 2;

        return '<img src="' . $url . '" alt="' . $alt . '" width="' . $width . '">';
    }else{
        return;
    }
}

//tel href
function get_tel_href($tel = false){
    if( $tel ){
        return 'tel:' . str_replace(array(' ', '-', '(', ')'), '', $tel);
    }else{
        return;
    }
}

//get options
function get_production_values(){
    $productions = [];

    $args = array(
        'post_type' => 'matrix',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $query = new WP_Query( $args );

    while( $query->have_posts() ){
        $query->the_post();

        $type = get_field('matrix_type');
        $productions[] = $type;
    }
    wp_reset_postdata();

    return array_values(array_unique(array_filter($productions)));
}

function num_word($value, $words, $show = true){
	$num = $value % 100;
	if ($num > 19) {
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}

//popular blog
function set_post_views($post_id) {
    $count_key = '_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '1');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

function track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

function initialize_post_views_on_creation($post_id) {
    if (get_post_type($post_id) !== 'blog' || wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }

    set_post_views($post_id);
}
add_action('save_post', 'initialize_post_views_on_creation');

//sort
function extractVersion($string) {
    preg_match('/\d+(\.\d+)+/', $string, $matches);
    return $matches[0] ?? '';
}

//href
function isAnchorLink($url) {
    $url = trim($url);

    if (strpos($url, '#') === 0) {
        return true;
    }

    return false;
}

function modifyProductVersion($version)
{
    // Если версия состоит из двух частей, дописываем X
    $version_parts = explode('.', $version);

    if (count($version_parts) == 2) {
        return $version_parts[0] . '.' . $version_parts[1] . '.X';
    }

    return $version;
}

/**
 * Return an ACF option value while preserving the current frontend copy until
 * the newly introduced option has been saved in the admin area.
 */
function space_get_option_with_fallback($field_name, $fallback)
{
    if (!function_exists('get_field')) {
        return $fallback;
    }

    $value = get_field($field_name, 'option');

    return $value === null || $value === false || $value === '' ? $fallback : $value;
}

/**
 * Render page-level popup blocks even in legacy page templates that do not
 * print the regular Gutenberg content.
 */
function space_render_page_popup_blocks()
{
    if (!is_singular() || !function_exists('parse_blocks')) {
        return;
    }

    $content = get_post_field('post_content', get_queried_object_id());

    if (!$content) {
        return;
    }

    $visited_references = [];
    $render_popup_blocks = static function ($blocks, $depth = 0) use (&$render_popup_blocks, &$visited_references) {
        if ($depth > 20) {
            return;
        }

        foreach ($blocks as $block) {
            $block_name = $block['blockName'] ?? '';

            if ($block_name === 'acf/form-custom-popup') {
                echo render_block($block);
                continue;
            }

            if ($block_name === 'core/block') {
                $reference_id = absint($block['attrs']['ref'] ?? 0);
                if ($reference_id > 0 && !isset($visited_references[$reference_id])) {
                    $visited_references[$reference_id] = true;
                    $reference = get_post($reference_id);

                    if ($reference instanceof WP_Post && $reference->post_type === 'wp_block') {
                        $render_popup_blocks(parse_blocks($reference->post_content), $depth + 1);
                    }
                }

                continue;
            }

            if (!empty($block['innerBlocks'])) {
                $render_popup_blocks($block['innerBlocks'], $depth + 1);
            }
        }
    };

    $render_popup_blocks(parse_blocks($content));
}

#region Скрыть панель админа
show_admin_bar(false);
#endregion
