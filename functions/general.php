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
function get_product_options(){
    $site_forms_products = get_field('site_forms_products', 'option');

    if( $site_forms_products ){
        $options = '<option value="0">&nbsp;</option>';
        foreach( $site_forms_products as $site_forms_product ){
            $options .= '<option value="' . $site_forms_product['item'] . '">' . $site_forms_product['item'] . '</option>';
        }

        return $options;
    }else{
        return;
    }
}
function get_partner_options(){
    $site_forms_partners = get_field('site_forms_partners', 'option');

    if( $site_forms_partners ){
        $options = '<option value="0">&nbsp;</option>';
        foreach( $site_forms_partners as $site_forms_partner ){
            $options .= '<option value="' . $site_forms_partner['item'] . '">' . $site_forms_partner['item'] . '</option>';
        }

        return $options;
    }else{
        return;
    }
}
function get_production_options(){
    $site_forms_productions = get_field('site_forms_production', 'option');

    if( $site_forms_productions ){
        $options = '<option value="0">&nbsp;</option>';
        foreach( $site_forms_productions as $site_forms_production ){
            $options .= '<option value="' . $site_forms_production['item'] . '">' . $site_forms_production['item'] . '</option>';
        }

        return $options;
    }else{
        return;
    }
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
