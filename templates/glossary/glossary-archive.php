<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$filters = space_glossary_get_filter_state();
$glossary_posts = space_glossary_get_posts( $filters );
$categories = space_glossary_get_categories();
$available_letters = space_glossary_get_available_letters();
$cyrillic_letters = [];
$latin_letters = [];
$other_letters = [];

foreach ( $available_letters as $available_letter ) {
    if ( preg_match( '/^[А-Я]$/u', $available_letter ) ) {
        $cyrillic_letters[] = $available_letter;
    } elseif ( preg_match( '/^[A-Z]$/', $available_letter ) ) {
        $latin_letters[] = $available_letter;
    } else {
        $other_letters[] = $available_letter;
    }
}

$has_alphabet = $latin_letters || $cyrillic_letters || $other_letters;
$result_count = count( $glossary_posts );
?>

<section class="glossary" data-glossary-root>
    <div class="container">
        <header class="glossary__header">
            <h1 class="glossary__title">Глоссарий</h1>
        </header>

        <form
            class="glossary__filters"
            method="get"
            action="<?= esc_url( get_post_type_archive_link( 'glossary_term' ) ); ?>"
            data-glossary-form>
            <div class="glossary__search">
                <label class="glossary__visually-hidden" for="glossary-search">Поиск по терминам</label>
                <input
                    id="glossary-search"
                    type="search"
                    name="q"
                    value="<?= esc_attr( $filters['q'] ); ?>"
                    placeholder="Найти по названию, синониму или определению..."
                    autocomplete="off"
                    data-glossary-search>
            </div>

            <?php if ( $categories ): ?>
                <fieldset class="glossary__categories" id="glossary-categories">
                    <legend class="glossary__visually-hidden">Категории</legend>
                    <a
                        class="glossary__chip glossary__chip--all<?= $filters['categories'] ? '' : ' glossary__chip--active'; ?>"
                        href="<?= esc_url( space_glossary_get_filter_url( [
                            'q'          => $filters['q'],
                            'categories' => [],
                            'letter'     => $filters['letter'],
                        ] ) ); ?>">Все</a>
                    <?php foreach ( array_values( $categories ) as $category ): ?>
                        <?php
                        $is_category_active = in_array( $category->slug, $filters['categories'], true );
                        ?>
                        <label class="glossary__chip">
                            <input
                                type="checkbox"
                                name="category[]"
                                value="<?= esc_attr( $category->slug ); ?>"
                                <?= checked( $is_category_active, true, false ); ?>>
                            <span><?= esc_html( $category->name ); ?></span>
                        </label>
                    <?php endforeach; ?>
                    <?php if ( count( $categories ) > 1 ): ?>
                        <button
                            class="glossary__categories-toggle"
                            type="button"
                            aria-controls="glossary-categories"
                            aria-expanded="false"
                            data-glossary-categories-toggle
                            data-show-label="Показать ещё"
                            data-hide-label="Скрыть">Показать ещё</button>
                    <?php endif; ?>
                </fieldset>
            <?php endif; ?>

            <?php if ( $filters['letter'] !== '' ): ?>
                <input type="hidden" name="letter" value="<?= esc_attr( $filters['letter'] ); ?>">
            <?php endif; ?>

            <button class="glossary__visually-hidden" type="submit">Применить</button>
        </form>

        <?php if ( $has_alphabet ): ?>
            <nav class="glossary__alphabet" aria-label="Навигация по алфавиту">
                <div class="glossary__alphabet-row">
                    <a class="glossary__alphabet-link glossary__alphabet-link--all"
                        href="<?= esc_url( space_glossary_get_filter_url( [
                            'q'          => $filters['q'],
                            'categories' => $filters['categories'],
                            'letter'     => '',
                        ] ) ); ?>"
                        <?= $filters['letter'] === '' ? 'aria-current="page"' : ''; ?>>Все</a>

                    <?php foreach ( $latin_letters as $letter ): ?>
                        <a class="glossary__alphabet-link"
                            href="<?= esc_url( space_glossary_get_filter_url( [
                                'q'          => $filters['q'],
                                'categories' => $filters['categories'],
                                'letter'     => $letter,
                            ] ) ); ?>"
                            <?= $filters['letter'] === $letter ? 'aria-current="page"' : ''; ?>><?= esc_html( $letter ); ?></a>
                    <?php endforeach; ?>
                </div>

                <?php foreach ( [ $cyrillic_letters, $other_letters ] as $alphabet_row ): ?>
                    <?php if ( $alphabet_row ): ?>
                        <div class="glossary__alphabet-row">
                            <?php foreach ( $alphabet_row as $letter ): ?>
                                <a class="glossary__alphabet-link"
                                    href="<?= esc_url( space_glossary_get_filter_url( [
                                        'q'          => $filters['q'],
                                        'categories' => $filters['categories'],
                                        'letter'     => $letter,
                                    ] ) ); ?>"
                                    <?= $filters['letter'] === $letter ? 'aria-current="page"' : ''; ?>><?= esc_html( $letter ); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <div class="glossary__results" data-glossary-results>
            <p class="glossary__count" aria-live="polite"><?= esc_html( space_glossary_format_result_count( $result_count ) ); ?></p>

            <?php if ( $glossary_posts ): ?>
                <div class="glossary__list">
                    <?php foreach ( $glossary_posts as $glossary_post ): ?>
                        <?php get_template_part( 'templates/parts/glossary-term-card', null, [ 'term_post' => $glossary_post ] ); ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="glossary__empty">
                    <p class="glossary__empty-text">Ничего не найдено. Попробуйте изменить запрос или сбросить фильтры.</p>
                    <a
                        class="btn glossary__reset"
                        href="<?= esc_url( get_post_type_archive_link( 'glossary_term' ) ); ?>"
                        data-glossary-reset>Сбросить фильтры</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
