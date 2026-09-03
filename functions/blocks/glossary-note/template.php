<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$text = trim( (string) get_field( 'glossary_note_text' ) );

if ( $text === '' ) {
    return;
}
?>

<div class="glossary-note"><?= wp_kses_post( wpautop( $text ) ); ?></div>
