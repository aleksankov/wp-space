<?php

const SPACE_BLOG_CATEGORY_TAXONOMY = 'blog_category';
const SPACE_BLOG_CATEGORY_SECTION_FIELD = 'blog_category_section';
const SPACE_BLOG_CATEGORY_SECTION_NEWS = 'news';
const SPACE_BLOG_CATEGORY_SECTION_BLOG = 'blog';

function space_blog_category_debug_log( $message ) {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        error_log( '[space_blog_category] ' . $message );
    }
}

function space_get_blog_category_section( $term ) {
    if ( is_numeric( $term ) ) {
        $term = get_term( (int) $term, SPACE_BLOG_CATEGORY_TAXONOMY );
    }

    if ( ! $term || is_wp_error( $term ) ) {
        space_blog_category_debug_log( 'Unable to resolve category section for invalid term.' );
        return SPACE_BLOG_CATEGORY_SECTION_BLOG;
    }

    $section = '';
    if ( function_exists( 'get_field' ) ) {
        $section = get_field( SPACE_BLOG_CATEGORY_SECTION_FIELD, SPACE_BLOG_CATEGORY_TAXONOMY . '_' . $term->term_id );
    }

    if ( ! $section ) {
        $section = get_term_meta( $term->term_id, SPACE_BLOG_CATEGORY_SECTION_FIELD, true );
    }

    if ( in_array( $section, [ SPACE_BLOG_CATEGORY_SECTION_NEWS, SPACE_BLOG_CATEGORY_SECTION_BLOG ], true ) ) {
        return $section;
    }

    return 'news' === $term->slug ? SPACE_BLOG_CATEGORY_SECTION_NEWS : SPACE_BLOG_CATEGORY_SECTION_BLOG;
}

function space_is_blog_category_section( $term, $section ) {
    return space_get_blog_category_section( $term ) === $section;
}

function space_get_blog_category_terms( $section, $args = [] ) {
    $terms = get_terms( array_merge( [
        'taxonomy'   => SPACE_BLOG_CATEGORY_TAXONOMY,
        'hide_empty' => true,
        'orderby'    => 'term_taxonomy_id',
        'order'      => 'ASC',
    ], $args ) );

    if ( is_wp_error( $terms ) ) {
        space_blog_category_debug_log( 'Unable to get category terms: ' . $terms->get_error_message() );
        return [];
    }

    return array_values( array_filter( $terms, function ( $term ) use ( $section ) {
        return space_is_blog_category_section( $term, $section );
    } ) );
}

function space_get_blog_category_term_ids( $section, $args = [] ) {
    return array_map( 'intval', wp_list_pluck( space_get_blog_category_terms( $section, $args ), 'term_id' ) );
}

function space_get_post_blog_category_by_section( $post_id, $section ) {
    $terms = get_the_terms( $post_id, SPACE_BLOG_CATEGORY_TAXONOMY );

    if ( ! $terms || is_wp_error( $terms ) ) {
        space_blog_category_debug_log( 'Unable to resolve post categories for post ID ' . (int) $post_id . '.' );
        return false;
    }

    foreach ( $terms as $term ) {
        if ( space_is_blog_category_section( $term, $section ) ) {
            return $term;
        }
    }

    return false;
}

function space_get_post_blog_section( $post_id ) {
    if ( space_get_post_blog_category_by_section( $post_id, SPACE_BLOG_CATEGORY_SECTION_NEWS ) ) {
        return SPACE_BLOG_CATEGORY_SECTION_NEWS;
    }

    if ( space_get_post_blog_category_by_section( $post_id, SPACE_BLOG_CATEGORY_SECTION_BLOG ) ) {
        return SPACE_BLOG_CATEGORY_SECTION_BLOG;
    }

    space_blog_category_debug_log( 'Post ID ' . (int) $post_id . ' has no section-resolvable categories.' );
    return SPACE_BLOG_CATEGORY_SECTION_BLOG;
}

function space_get_news_page_url() {
    $page = get_page_by_path( 'news_page' );

    if ( $page ) {
        return trailingslashit( get_permalink( $page->ID ) );
    }

    return home_url( '/news_page/' );
}

function space_get_news_category_url( $term ) {
    if ( is_numeric( $term ) ) {
        $term = get_term( (int) $term, SPACE_BLOG_CATEGORY_TAXONOMY );
    }

    if ( ! $term || is_wp_error( $term ) ) {
        space_blog_category_debug_log( 'Unable to build news category URL for invalid term.' );
        return space_get_news_page_url();
    }

    return trailingslashit( space_get_news_page_url() . $term->slug );
}

function space_get_blog_page_url() {
    $page = get_page_by_path( 'blog' );

    if ( $page ) {
        return trailingslashit( get_permalink( $page->ID ) );
    }

    return home_url( '/blog/' );
}

function space_get_blog_category_url( $term ) {
    if ( is_numeric( $term ) ) {
        $term = get_term( (int) $term, SPACE_BLOG_CATEGORY_TAXONOMY );
    }

    if ( ! $term || is_wp_error( $term ) ) {
        space_blog_category_debug_log( 'Unable to build blog category URL for invalid term.' );
        return space_get_blog_page_url();
    }

    $link = get_term_link( $term, SPACE_BLOG_CATEGORY_TAXONOMY );

    if ( is_wp_error( $link ) ) {
        space_blog_category_debug_log( 'Unable to build native term URL: ' . $link->get_error_message() );
        return trailingslashit( space_get_blog_page_url() . $term->slug );
    }

    return $link;
}

function space_get_news_category_from_query() {
    $slug = get_query_var( 'news_category' );

    if ( ! $slug ) {
        return false;
    }

    $term = get_term_by( 'slug', sanitize_title( $slug ), SPACE_BLOG_CATEGORY_TAXONOMY );

    if ( ! $term || ! space_is_blog_category_section( $term, SPACE_BLOG_CATEGORY_SECTION_NEWS ) ) {
        space_blog_category_debug_log( 'Invalid news category requested: ' . sanitize_text_field( $slug ) );
        return false;
    }

    return $term;
}

function space_add_news_category_rewrite_rules() {
    add_rewrite_rule(
        '^news_page/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=news_page&news_category=$matches[1]&paged=$matches[2]',
        'top'
    );

    add_rewrite_rule(
        '^news_page/([^/]+)/?$',
        'index.php?pagename=news_page&news_category=$matches[1]',
        'top'
    );
}
add_action( 'init', 'space_add_news_category_rewrite_rules' );

function space_add_news_category_query_var( $vars ) {
    $vars[] = 'news_category';
    return $vars;
}
add_filter( 'query_vars', 'space_add_news_category_query_var' );
