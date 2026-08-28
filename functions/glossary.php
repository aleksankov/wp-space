<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Normalize text for glossary search and alphabet grouping.
 */
function space_glossary_normalize_text( $value ) {
    $value = html_entity_decode( wp_strip_all_tags( (string) $value ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $value = preg_replace( '/\s+/u', ' ', trim( $value ) );
    $value = function_exists( 'mb_strtolower' ) ? mb_strtolower( $value, 'UTF-8' ) : strtolower( $value );

    return str_replace( 'ё', 'е', $value );
}

/**
 * Return a normalized first-letter group for a glossary term.
 */
function space_glossary_get_initial_group( $title ) {
    $title = space_glossary_normalize_text( $title );
    $title = preg_replace( '/^[^a-zа-я0-9]+/u', '', $title );

    if ( $title === '' ) {
        return '#';
    }

    $initial = function_exists( 'mb_substr' ) ? mb_substr( $title, 0, 1, 'UTF-8' ) : substr( $title, 0, 1 );

    if ( preg_match( '/^[0-9]$/', $initial ) ) {
        return '#';
    }

    if ( ! preg_match( '/^[a-zа-я]$/u', $initial ) ) {
        return '#';
    }

    return function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $initial, 'UTF-8' ) : strtoupper( $initial );
}

/**
 * Return published glossary categories keyed by slug.
 */
function space_glossary_get_categories() {
    static $categories = null;

    if ( $categories !== null ) {
        return $categories;
    }

    $terms = get_terms( [
        'taxonomy'   => 'glossary_category',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ] );

    if ( is_wp_error( $terms ) ) {
        $categories = [];
        return $categories;
    }

    $categories = [];

    foreach ( $terms as $term ) {
        $categories[ $term->slug ] = $term;
    }

    return $categories;
}

/**
 * Return alphabet groups represented by published glossary terms.
 */
function space_glossary_get_available_letters() {
    static $letters = null;

    if ( $letters !== null ) {
        return $letters;
    }

    $post_ids = get_posts( [
        'post_type'              => 'glossary_term',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => 'title',
        'order'                  => 'ASC',
        'fields'                 => 'ids',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ] );

    $letters = [];

    foreach ( $post_ids as $post_id ) {
        $letters[] = space_glossary_get_initial_group( get_the_title( $post_id ) );
    }

    $letters = array_values( array_unique( $letters ) );
    usort( $letters, static function ( $left, $right ) {
        if ( $left === '#' ) {
            return 1;
        }

        if ( $right === '#' ) {
            return -1;
        }

        return strnatcasecmp( $left, $right );
    } );

    return $letters;
}

/**
 * Sanitize and whitelist glossary filters from a request-like array.
 */
function space_glossary_get_filter_state( $source = null ) {
    $source = is_array( $source ) ? $source : $_GET;
    $source = wp_unslash( $source );
    $query = isset( $source['q'] ) ? trim( sanitize_text_field( $source['q'] ) ) : '';
    $requested_categories = isset( $source['category'] ) ? (array) $source['category'] : [];
    $available_categories = space_glossary_get_categories();
    $categories = [];

    foreach ( $requested_categories as $category ) {
        $category = sanitize_title( $category );

        if ( $category !== '' && isset( $available_categories[ $category ] ) ) {
            $categories[] = $category;
        }
    }

    $categories = array_values( array_unique( $categories ) );
    $letter = isset( $source['letter'] ) ? trim( sanitize_text_field( $source['letter'] ) ) : '';

    if ( $letter !== '' ) {
        $letter = $letter === '#' ? '#' : space_glossary_get_initial_group( $letter );
    }

    if ( ! in_array( $letter, space_glossary_get_available_letters(), true ) ) {
        $letter = '';
    }

    return [
        'q'          => $query,
        'categories' => $categories,
        'letter'     => $letter,
    ];
}

/**
 * Query glossary posts using sanitized filter state.
 */
function space_glossary_get_posts( array $filters ) {
    $query_args = [
        'post_type'              => 'glossary_term',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => 'title',
        'order'                  => 'ASC',
        'no_found_rows'          => true,
        'ignore_sticky_posts'    => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => true,
    ];

    if ( $filters['q'] !== '' ) {
        $query_args['space_glossary_search'] = $filters['q'];
    }

    if ( $filters['categories'] ) {
        $query_args['tax_query'] = [
            [
                'taxonomy' => 'glossary_category',
                'field'    => 'slug',
                'terms'    => $filters['categories'],
                'operator' => 'IN',
            ],
        ];
    }

    $query = new WP_Query( $query_args );
    $posts = $query->posts;

    if ( $filters['letter'] !== '' ) {
        $posts = array_values( array_filter( $posts, static function ( $post ) use ( $filters ) {
            return space_glossary_get_initial_group( get_the_title( $post ) ) === $filters['letter'];
        } ) );
    }

    return $posts;
}

/**
 * Extend glossary search to the editable synonyms field.
 */
function space_glossary_filter_search_sql( $search, $query ) {
    $search_term = $query->get( 'space_glossary_search' );

    if ( ! is_string( $search_term ) || $search_term === '' ) {
        return $search;
    }

    global $wpdb;

    $like = '%' . $wpdb->esc_like( $search_term ) . '%';

    return $wpdb->prepare(
        " AND ({$wpdb->posts}.post_title LIKE %s
            OR {$wpdb->posts}.post_excerpt LIKE %s
            OR {$wpdb->posts}.post_content LIKE %s
            OR EXISTS (
                SELECT 1 FROM {$wpdb->postmeta} glossary_meta
                WHERE glossary_meta.post_id = {$wpdb->posts}.ID
                    AND glossary_meta.meta_key = 'glossary_synonyms'
                    AND glossary_meta.meta_value LIKE %s
            )) ",
        $like,
        $like,
        $like,
        $like
    );
}
add_filter( 'posts_search', 'space_glossary_filter_search_sql', 10, 2 );

/**
 * Split the required glossary data block from the remaining editor content.
 */
function space_glossary_parse_term_content( $content ) {
    $result = [
        'found'   => false,
        'data'    => [
            'synonyms'         => '',
            'short_description' => '',
            'full_definition'   => '',
        ],
        'content' => (string) $content,
    ];

    if ( trim( (string) $content ) === '' || ! function_exists( 'parse_blocks' ) ) {
        return $result;
    }

    $content_blocks = parse_blocks( $content );
    $remaining_blocks = [];

    foreach ( $content_blocks as $content_block ) {
        if ( ( $content_block['blockName'] ?? '' ) !== 'acf/glossary-term-data' ) {
            $remaining_blocks[] = $content_block;
            continue;
        }

        if ( $result['found'] ) {
            continue;
        }

        $block_data = isset( $content_block['attrs']['data'] ) && is_array( $content_block['attrs']['data'] )
            ? $content_block['attrs']['data']
            : [];
        $result['found'] = true;
        $result['data'] = [
            'synonyms'          => (string) ( $block_data['glossary_term_data_synonyms'] ?? '' ),
            'short_description' => (string) ( $block_data['glossary_term_data_short_description'] ?? '' ),
            'full_definition'   => (string) ( $block_data['glossary_term_data_full_definition'] ?? '' ),
        ];
    }

    if ( $result['found'] ) {
        $result['content'] = serialize_blocks( $remaining_blocks );
    }

    return $result;
}

/**
 * Serialize the locked, single-instance term data block.
 */
function space_glossary_serialize_term_data_block( array $data ) {
    return serialize_block( [
        'blockName'    => 'acf/glossary-term-data',
        'attrs'        => [
            'name' => 'acf/glossary-term-data',
            'data' => [
                'glossary_term_data_synonyms'               => (string) ( $data['synonyms'] ?? '' ),
                '_glossary_term_data_synonyms'              => 'field_glossary_term_data_synonyms',
                'glossary_term_data_short_description'      => (string) ( $data['short_description'] ?? '' ),
                '_glossary_term_data_short_description'     => 'field_glossary_term_data_short_description',
                'glossary_term_data_full_definition'        => (string) ( $data['full_definition'] ?? '' ),
                '_glossary_term_data_full_definition'       => 'field_glossary_term_data_full_definition',
            ],
            'mode' => 'edit',
            'lock' => [
                'move'   => true,
                'remove' => true,
            ],
        ],
        'innerBlocks'  => [],
        'innerHTML'    => '',
        'innerContent' => [],
    ] );
}

/**
 * Serialize an editor-friendly glossary code example block.
 */
function space_glossary_serialize_code_example_block( $title, $code ) {
    return serialize_block( [
        'blockName'    => 'acf/glossary-code-example',
        'attrs'        => [
            'name' => 'acf/glossary-code-example',
            'data' => [
                'glossary_code_example_title'  => (string) $title,
                '_glossary_code_example_title' => 'field_glossary_code_example_title',
                'glossary_code_example_code'   => (string) $code,
                '_glossary_code_example_code'  => 'field_glossary_code_example_code',
            ],
            'mode' => 'edit',
        ],
        'innerBlocks'  => [],
        'innerHTML'    => '',
        'innerContent' => [],
    ] );
}

/**
 * Serialize an editor-friendly glossary note block.
 */
function space_glossary_serialize_note_block( $text ) {
    return serialize_block( [
        'blockName'    => 'acf/glossary-note',
        'attrs'        => [
            'name' => 'acf/glossary-note',
            'data' => [
                'glossary_note_text'  => (string) $text,
                '_glossary_note_text' => 'field_glossary_note_text',
            ],
            'mode' => 'edit',
        ],
        'innerBlocks'  => [],
        'innerHTML'    => '',
        'innerContent' => [],
    ] );
}

/**
 * Replace legacy HTML code examples and note groups with editable ACF blocks.
 */
function space_glossary_convert_legacy_custom_blocks( $content, &$changed = false ) {
    $changed = false;

    if ( trim( (string) $content ) === '' ) {
        return (string) $content;
    }

    $converted_blocks = [];

    foreach ( parse_blocks( $content ) as $content_block ) {
        $block_name = $content_block['blockName'] ?? '';

        if ( $block_name === 'core/html' && str_contains( $content_block['innerHTML'] ?? '', 'glossary-code' ) ) {
            $html = (string) ( $content_block['innerHTML'] ?? '' );
            $title = '';
            $code = '';

            if ( preg_match( '/<div[^>]*class=["\'][^"\']*glossary-code__title[^"\']*["\'][^>]*>(.*?)<\/div>/is', $html, $title_match ) ) {
                $title = html_entity_decode( wp_strip_all_tags( $title_match[1] ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
            }

            if ( preg_match( '/<pre[^>]*>(.*?)<\/pre>/is', $html, $code_match ) ) {
                $code = html_entity_decode( wp_strip_all_tags( $code_match[1] ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
            }

            if ( trim( $title ) !== '' || trim( $code ) !== '' ) {
                $converted_blocks[] = parse_blocks( space_glossary_serialize_code_example_block( trim( $title ), trim( $code ) ) )[0];
                $changed = true;
                continue;
            }
        }

        $class_name = (string) ( $content_block['attrs']['className'] ?? '' );

        if ( $block_name === 'core/group' && preg_match( '/(?:^|\s)glossary-note(?:\s|$)/', $class_name ) ) {
            $note_text = html_entity_decode( wp_strip_all_tags( render_block( $content_block ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
            $note_text = trim( preg_replace( '/\s+/u', ' ', $note_text ) );

            if ( $note_text !== '' ) {
                $converted_blocks[] = parse_blocks( space_glossary_serialize_note_block( $note_text ) )[0];
                $changed = true;
                continue;
            }
        }

        $converted_blocks[] = $content_block;
    }

    return $changed ? serialize_blocks( $converted_blocks ) : (string) $content;
}

/**
 * Keep legacy excerpt/meta consumers synchronized with the Gutenberg block.
 */
function space_glossary_sync_term_data_block( $post_id, $post ) {
    static $syncing = false;

    if ( $syncing || ! $post instanceof WP_Post || $post->post_type !== 'glossary_term' ) {
        return;
    }

    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }

    $parsed_content = space_glossary_parse_term_content( $post->post_content );

    if ( ! $parsed_content['found'] ) {
        return;
    }

    $synonyms = sanitize_text_field( $parsed_content['data']['synonyms'] );
    $short_description = sanitize_textarea_field( $parsed_content['data']['short_description'] );
    $full_definition = sanitize_textarea_field( $parsed_content['data']['full_definition'] );

    update_post_meta( $post_id, 'glossary_synonyms', $synonyms );
    update_post_meta( $post_id, '_glossary_synonyms', 'field_glossary_synonyms' );
    update_post_meta( $post_id, 'glossary_full_definition', $full_definition );
    update_post_meta( $post_id, '_glossary_full_definition', 'field_glossary_full_definition' );

    if ( $post->post_excerpt !== $short_description ) {
        $syncing = true;
        wp_update_post( [
            'ID'           => $post_id,
            'post_excerpt' => $short_description,
        ] );
        $syncing = false;
    }
}
add_action( 'save_post_glossary_term', 'space_glossary_sync_term_data_block', 20, 2 );

/**
 * Format the result counter with the correct Russian plural form.
 */
function space_glossary_format_result_count( $count ) {
    $count = absint( $count );
    $last_two = $count % 100;
    $last = $count % 10;

    if ( $last_two >= 11 && $last_two <= 14 ) {
        $noun = 'терминов';
    } elseif ( $last === 1 ) {
        $noun = 'термин';
    } elseif ( $last >= 2 && $last <= 4 ) {
        $noun = 'термина';
    } else {
        $noun = 'терминов';
    }

    return sprintf( 'Найдено %s %s', number_format_i18n( $count ), $noun );
}

/**
 * Build a glossary archive URL while preserving selected filters.
 */
function space_glossary_get_filter_url( array $filters ) {
    $query_args = [];

    if ( ! empty( $filters['q'] ) ) {
        $query_args['q'] = $filters['q'];
    }

    if ( ! empty( $filters['categories'] ) ) {
        $query_args['category'] = array_values( $filters['categories'] );
    }

    if ( ! empty( $filters['letter'] ) ) {
        $query_args['letter'] = $filters['letter'];
    }

    $archive_url = get_post_type_archive_link( 'glossary_term' );

    return $query_args ? add_query_arg( $query_args, $archive_url ) : $archive_url;
}

/**
 * Check whether the glossary archive request contains active filters.
 */
function space_glossary_is_filtered_archive() {
    if ( ! is_post_type_archive( 'glossary_term' ) ) {
        return false;
    }

    foreach ( [ 'q', 'category', 'letter' ] as $parameter ) {
        if ( isset( $_GET[ $parameter ] ) ) {
            return true;
        }
    }

    return false;
}

/**
 * Keep filtered archive variants out of the search index.
 */
function space_glossary_filter_wp_robots( array $robots ) {
    if ( ! space_glossary_is_filtered_archive() ) {
        return $robots;
    }

    unset( $robots['index'], $robots['nofollow'] );
    $robots['noindex'] = true;
    $robots['follow'] = true;

    return $robots;
}
add_filter( 'wp_robots', 'space_glossary_filter_wp_robots' );

/**
 * Return the clean glossary archive as canonical for filtered variants.
 */
function space_glossary_filter_canonical( $canonical ) {
    if ( ! space_glossary_is_filtered_archive() ) {
        return $canonical;
    }

    return get_post_type_archive_link( 'glossary_term' );
}
add_filter( 'wpseo_canonical', 'space_glossary_filter_canonical' );
add_filter( 'wpseo_opengraph_url', 'space_glossary_filter_canonical' );

/**
 * Support Yoast versions that expose robots as a string filter.
 */
function space_glossary_filter_yoast_robots( $robots ) {
    return space_glossary_is_filtered_archive() ? 'noindex, follow' : $robots;
}
add_filter( 'wpseo_robots', 'space_glossary_filter_yoast_robots' );

/**
 * Exclude the non-public glossary taxonomy from Yoast sitemaps explicitly.
 */
function space_glossary_exclude_taxonomy_from_sitemap( $excluded, $taxonomy ) {
    return $taxonomy === 'glossary_category' ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'space_glossary_exclude_taxonomy_from_sitemap', 10, 2 );

/**
 * Keep the glossary relationship field bidirectional even when an older field
 * definition is still stored in the database and Local JSON has not been synced.
 */
function space_glossary_enable_bidirectional_related_terms( $field ) {
    $field['bidirectional'] = 1;
    $field['bidirectional_target'] = [ 'field_glossary_related_terms' ];

    return $field;
}
add_filter( 'acf/load_field/key=field_glossary_related_terms', 'space_glossary_enable_bidirectional_related_terms' );

/**
 * Backfill reverse links for relationships created before bidirectional mode.
 *
 * The migration is versioned and runs once on an authenticated admin request.
 */
function space_glossary_migrate_bidirectional_related_terms() {
    $migration_version = 1;

    if ( ! is_admin() || ! current_user_can( 'edit_posts' ) ) {
        return;
    }

    if ( (int) get_option( 'space_glossary_related_terms_bidirectional_version', 0 ) >= $migration_version ) {
        return;
    }

    $term_ids = get_posts( [
        'post_type'              => 'glossary_term',
        'post_status'            => 'any',
        'posts_per_page'         => -1,
        'fields'                 => 'ids',
        'no_found_rows'          => true,
        'update_post_meta_cache' => true,
        'update_post_term_cache' => false,
    ] );
    $term_ids = array_map( 'absint', $term_ids );
    $term_lookup = array_fill_keys( $term_ids, true );
    $relationships = [];

    foreach ( $term_ids as $term_id ) {
        $related_ids = get_field( 'field_glossary_related_terms', $term_id, false );
        $related_ids = is_array( $related_ids ) ? array_map( 'absint', $related_ids ) : [];
        $relationships[ $term_id ] = array_values( array_filter(
            array_unique( $related_ids ),
            static function ( $related_id ) use ( $term_id, $term_lookup ) {
                return $related_id !== $term_id && isset( $term_lookup[ $related_id ] );
            }
        ) );
    }

    foreach ( $relationships as $term_id => $related_ids ) {
        foreach ( $related_ids as $related_id ) {
            if ( ! in_array( $term_id, $relationships[ $related_id ], true ) ) {
                $relationships[ $related_id ][] = $term_id;
            }
        }
    }

    foreach ( $relationships as $term_id => $related_ids ) {
        update_field( 'field_glossary_related_terms', $related_ids, $term_id );
    }

    update_option( 'space_glossary_related_terms_bidirectional_version', $migration_version, false );
}
add_action( 'acf/init', 'space_glossary_migrate_bidirectional_related_terms', 20 );

/**
 * Add the required data block to glossary terms created before the block model.
 */
function space_glossary_migrate_term_data_blocks() {
    $migration_version = 1;

    if ( ! is_admin() || ! current_user_can( 'edit_posts' ) ) {
        return;
    }

    if ( (int) get_option( 'space_glossary_term_data_block_version', 0 ) >= $migration_version ) {
        return;
    }

    $term_ids = get_posts( [
        'post_type'              => 'glossary_term',
        'post_status'            => 'any',
        'posts_per_page'         => -1,
        'fields'                 => 'ids',
        'no_found_rows'          => true,
        'update_post_meta_cache' => true,
        'update_post_term_cache' => false,
    ] );

    foreach ( $term_ids as $term_id ) {
        $term_post = get_post( $term_id );

        if ( ! $term_post instanceof WP_Post ) {
            continue;
        }

        $parsed_content = space_glossary_parse_term_content( $term_post->post_content );

        if ( $parsed_content['found'] ) {
            continue;
        }

        $data_block = space_glossary_serialize_term_data_block( [
            'synonyms'          => (string) get_post_meta( $term_id, 'glossary_synonyms', true ),
            'short_description' => (string) $term_post->post_excerpt,
            'full_definition'   => (string) get_post_meta( $term_id, 'glossary_full_definition', true ),
        ] );
        $remaining_content = trim( $term_post->post_content );
        $new_content = $remaining_content === '' ? $data_block : $data_block . "\n\n" . $term_post->post_content;

        wp_update_post( wp_slash( [
            'ID'           => $term_id,
            'post_content' => $new_content,
        ] ) );
    }

    update_option( 'space_glossary_term_data_block_version', $migration_version, false );
}
add_action( 'acf/init', 'space_glossary_migrate_term_data_blocks', 30 );

/**
 * Convert legacy glossary HTML helpers into editor-friendly Gutenberg blocks.
 */
function space_glossary_migrate_custom_content_blocks() {
    $migration_version = 1;

    if ( ! is_admin() || ! current_user_can( 'edit_posts' ) ) {
        return;
    }

    if ( (int) get_option( 'space_glossary_custom_blocks_version', 0 ) >= $migration_version ) {
        return;
    }

    $term_ids = get_posts( [
        'post_type'              => 'glossary_term',
        'post_status'            => 'any',
        'posts_per_page'         => -1,
        'fields'                 => 'ids',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ] );

    foreach ( $term_ids as $term_id ) {
        $legacy_content = (string) get_post_field( 'post_content', $term_id );
        $changed = false;
        $converted_content = space_glossary_convert_legacy_custom_blocks( $legacy_content, $changed );

        if ( ! $changed ) {
            continue;
        }

        wp_update_post( wp_slash( [
            'ID'           => $term_id,
            'post_content' => $converted_content,
        ] ) );
    }

    update_option( 'space_glossary_custom_blocks_version', $migration_version, false );
}
add_action( 'acf/init', 'space_glossary_migrate_custom_content_blocks', 40 );
