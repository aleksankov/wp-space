<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$synonyms = (string) get_field( 'glossary_term_data_synonyms' );
$short_description = (string) get_field( 'glossary_term_data_short_description' );
$full_definition = (string) get_field( 'glossary_term_data_full_definition' );
?>

<div class="glossary-term-data">
    <?php if ( $synonyms !== '' ): ?>
        <p class="glossary-term-data__synonyms"><?= esc_html( $synonyms ); ?></p>
    <?php endif; ?>

    <?php if ( $short_description !== '' ): ?>
        <div class="glossary-term-data__excerpt"><?= wp_kses_post( wpautop( $short_description ) ); ?></div>
    <?php endif; ?>

    <?php if ( $full_definition !== '' ): ?>
        <div class="glossary-term-data__definition"><?= wp_kses_post( wpautop( $full_definition ) ); ?></div>
    <?php endif; ?>
</div>
