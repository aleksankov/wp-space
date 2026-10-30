<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$term_post = isset( $args['term_post'] ) && $args['term_post'] instanceof WP_Post
    ? $args['term_post']
    : null;

if ( ! $term_post ) {
    return;
}

$term_title = get_the_title( $term_post );
$term_url = get_permalink( $term_post );
$term_excerpt = get_the_excerpt( $term_post );
$term_synonyms = function_exists( 'get_field' ) ? (string) get_field( 'glossary_synonyms', $term_post->ID ) : '';

if ( $term_excerpt === '' && $term_post->post_content !== '' ) {
    $term_excerpt = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $term_post->post_content ) ), 30 );
}

$term_categories = get_the_terms( $term_post, 'glossary_category' );
$term_categories = is_array( $term_categories ) ? $term_categories : [];
?>

<article class="glossary-card">
    <h2 class="glossary-card__title">
        <a href="<?= esc_url( $term_url ); ?>"><?= esc_html( $term_title ); ?></a>
    </h2>

    <?php if ( $term_synonyms !== '' ): ?>
        <p class="glossary-card__synonyms"><?= esc_html( $term_synonyms ); ?></p>
    <?php endif; ?>

    <?php if ( $term_excerpt !== '' ): ?>
        <div class="glossary-card__excerpt"><?= wp_kses_post( wpautop( $term_excerpt ) ); ?></div>
    <?php endif; ?>

    <?php if ( $term_categories ): ?>
        <ul class="glossary-card__categories" aria-label="Категории термина">
            <?php foreach ( $term_categories as $term_category ): ?>
                <li class="glossary-card__category"><?= esc_html( $term_category->name ); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</article>
