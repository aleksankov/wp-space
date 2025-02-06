<?php

function replace_path( $template ) {
    if ( is_page_template() ) {
        $page_template = get_page_template_slug( get_queried_object_id() );
        $page_template = locate_template( $page_template );

        if ( $page_template && file_exists( $page_template ) ) {
            return $template;
        }
    }

    if ( is_404() ) {
        return locate_template_path( 'page-404/page-404.php' );
    }

    if ( is_singular( [ 'page' ] ) ) {
        return locate_template_path( 'default-page/default-page.php' );
    }

    return $template;
}

add_filter( 'template_include', 'replace_path', 99 );

function locate_template_path( $path ) {
    global $template;

    $path = "templates/{$path}";

    if ( $new_template = locate_template( [ $path ] ) ) {
        $template = $new_template;
    }

    return $template;
}