<?php
add_action('enqueue_block_editor_assets', 'enqueue_enhanced_blocks_script');
function enqueue_enhanced_blocks_script() {
    wp_enqueue_script(
        'enhanced-blocks',
        get_template_directory_uri() . '/assets/js/enhanced-blocks.js',
        ['wp-blocks', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-compose'],
        '1.0.0',
        true
    );
}
add_filter('render_block', 'my_render_custom_block_wrapper', 10, 2);
function my_render_custom_block_wrapper($block_content, $block) {
    // Список блоков, к которым применяем обёртку
    $target_blocks = [
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/quote',
        'core/image',
        'core/media-text'
    ];

    // Если блок не в списке — возвращаем как есть
    if (!in_array($block['blockName'] ?? '', $target_blocks)) {
        return $block_content;
    }

    // Получаем атрибуты
    $attrs = $block['attrs'] ?? [];
    $customPadding = $attrs['customPadding'] ?? 0;
    $enableAOS = !empty($attrs['enableAOS']);
    $aosDelay = $attrs['aosDelay'] ?? 0;

    // Если ничего не задано — не оборачиваем
    if (!$customPadding && !$enableAOS) {
        return $block_content;
    }

    // Собираем атрибуты обёртки
    $wrapper_attrs = [];

    // Стиль отступа
    $style = [];
    if ($customPadding) {
        $style[] = "padding-top: {$customPadding}px";
    }

    if (!empty($style)) {
        $wrapper_attrs[] = 'style="' . esc_attr(implode('; ', $style)) . '"';
    }

    // AOS атрибуты
    if ($enableAOS) {
        $wrapper_attrs[] = 'data-aos="fade-up"';
        if ($aosDelay > 0) {
            $wrapper_attrs[] = 'data-aos-delay="' . (int)$aosDelay . '"';
        }
    }

    // Формируем открывающий тег
    $wrapper_start = '<div ' . implode(' ', $wrapper_attrs) . '>';
    $wrapper_end = '</div>';

    // Оборачиваем контент
    return $wrapper_start . $block_content . $wrapper_end;
}