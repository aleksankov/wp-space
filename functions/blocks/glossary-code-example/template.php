<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title = trim( (string) get_field( 'glossary_code_example_title' ) );
$code = (string) get_field( 'glossary_code_example_code' );

if ( $title === '' && trim( $code ) === '' ) {
    return;
}
?>

<div class="glossary-code">
    <?php if ( $title !== '' ): ?>
        <div class="glossary-code__title"><?= esc_html( $title ); ?></div>
    <?php endif; ?>
    <?php if ( trim( $code ) !== '' ): ?>
        <pre><?= esc_html( $code ); ?></pre>
    <?php endif; ?>
</div>
