<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$term_post = get_queried_object();

if ( ! $term_post instanceof WP_Post ) {
    get_footer();
    return;
}

$parsed_term_content = space_glossary_parse_term_content( $term_post->post_content );
$has_term_data_block = $parsed_term_content['found'];
$term_title = get_the_title( $term_post );
$term_excerpt = $has_term_data_block
    ? $parsed_term_content['data']['short_description']
    : get_the_excerpt( $term_post );
$term_synonyms = $has_term_data_block
    ? $parsed_term_content['data']['synonyms']
    : ( function_exists( 'get_field' ) ? (string) get_field( 'glossary_synonyms', $term_post->ID ) : '' );
$term_definition = $has_term_data_block
    ? $parsed_term_content['data']['full_definition']
    : ( function_exists( 'get_field' ) ? (string) get_field( 'glossary_full_definition', $term_post->ID ) : '' );
$related_terms = function_exists( 'get_field' ) ? get_field( 'glossary_related_terms', $term_post->ID ) : [];
$related_terms = is_array( $related_terms ) ? $related_terms : [];
$remaining_term_content = $parsed_term_content['content'];
$term_content = trim( $remaining_term_content ) !== ''
    ? apply_filters( 'the_content', $remaining_term_content )
    : '';

if ( $term_content !== '' ) {
    $term_content = str_replace(
        '<figure class="wp-block-table"',
        '<figure class="wp-block-table" tabindex="0" role="region" aria-label="Таблица данных термина"',
        $term_content
    );
}
$term_categories = get_the_terms( $term_post, 'glossary_category' );
$term_categories = is_array( $term_categories ) ? $term_categories : [];
$archive_url = get_post_type_archive_link( 'glossary_term' );
$term_allowed_html = wp_kses_allowed_html( 'post' );
$term_allowed_html['figure']['tabindex'] = true;
$term_allowed_html['figure']['role'] = true;
$term_allowed_html['figure']['aria-label'] = true;
$has_custom_content = false;
$custom_html_pattern = '/<(?:table|figure|pre|code|ul|ol|h[1-6]|blockquote|div|section|aside|img|video|audio|iframe)\b/i';

if ( trim( $remaining_term_content ) !== '' && has_blocks( $remaining_term_content ) ) {
    foreach ( parse_blocks( $remaining_term_content ) as $term_block ) {
        if ( ! empty( $term_block['blockName'] ) && $term_block['blockName'] !== 'core/paragraph' ) {
            $has_custom_content = true;
            break;
        }
    }
} elseif ( trim( $remaining_term_content ) !== '' && preg_match( $custom_html_pattern, $remaining_term_content ) ) {
    $has_custom_content = true;
}

$is_simple_term = ! $related_terms && ! $has_custom_content;
?>

<article class="glossary-term<?= $is_simple_term ? ' glossary-term--simple' : ''; ?>">
    <div class="container">
        <a class="glossary-term__back" href="<?= esc_url( $archive_url ); ?>">
            <img src="<?= esc_url( get_template_directory_uri() . '/assets/img/glossary/chevron-left.svg' ); ?>" alt="" aria-hidden="true">
            Назад
        </a>

        <div class="glossary-term__layout">
            <header class="glossary-term__header">
                <?php if ( $term_categories ): ?>
                    <ul class="glossary-term__categories" aria-label="Категории термина">
                        <?php foreach ( $term_categories as $term_category ): ?>
                            <li class="glossary-term__category"><?= esc_html( $term_category->name ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h1 class="glossary-term__title"><?= esc_html( $term_title ); ?></h1>

                <?php if ( $term_synonyms !== '' ): ?>
                    <p class="glossary-term__synonyms"><?= esc_html( $term_synonyms ); ?></p>
                <?php endif; ?>
            </header>

            <?php if ( $term_excerpt !== '' || $term_definition !== '' ): ?>
                <div class="glossary-term__intro">
                    <?php if ( $term_excerpt !== '' ): ?>
                        <div class="glossary-term__excerpt"><?= wp_kses_post( wpautop( $term_excerpt ) ); ?></div>
                    <?php endif; ?>

                    <?php if ( $term_definition !== '' ): ?>
                        <div class="glossary-term__definition"><?= wp_kses_post( wpautop( $term_definition ) ); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $related_terms ): ?>
                <aside class="glossary-term__related" aria-labelledby="glossary-related-title">
                    <h2 class="glossary-term__related-title" id="glossary-related-title">
                        <img src="<?= esc_url( get_template_directory_uri() . '/assets/img/glossary/related-link.svg' ); ?>" alt="" aria-hidden="true">
                        Связанные термины
                    </h2>
                    <ul class="glossary-term__related-list">
                        <?php foreach ( $related_terms as $related_term ): ?>
                            <?php $related_post = get_post( $related_term ); ?>
                            <?php if ( $related_post instanceof WP_Post && $related_post->post_status === 'publish' ): ?>
                                <li><a href="<?= esc_url( get_permalink( $related_post ) ); ?>"><?= esc_html( get_the_title( $related_post ) ); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>

            <?php if ( $term_content !== '' ): ?>
                <div class="glossary-term__content"><?= wp_kses( $term_content, $term_allowed_html ); ?></div>
            <?php endif; ?>
        </div>
    </div>
</article>

<?php get_footer(); ?>
