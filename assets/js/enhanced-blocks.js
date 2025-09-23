const { createHigherOrderComponent } = wp.compose;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, RangeControl, ToggleControl, TextControl } = wp.components;
const { createElement } = wp.element;

// === СПИСОК БЛОКОВ, К КОТОРЫМ ПРИМЕНЯЕМ УЛУЧШЕНИЯ ===
const TARGET_BLOCKS = [
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/quote',
    'core/image',
    'core/media-text'
];

// 1. Добавляем атрибуты к каждому целевому блоку
function addCustomAttributes(settings, name) {
    if (!TARGET_BLOCKS.includes(name)) {
        return settings;
    }

    return {
        ...settings,
        attributes: {
            ...settings.attributes,
            customPadding: {
                type: 'number',
                default: 0,
            },
            enableAOS: {
                type: 'boolean',
                default: false,
            },
            aosDelay: {
                type: 'number',
                default: 0,
            },
        },
    };
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'my-plugin/add-custom-attributes',
    addCustomAttributes
);

// 2. Добавляем контролы в инспектор для целевых блоков
const withInspectorControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { name, attributes, setAttributes } = props;

        if (!TARGET_BLOCKS.includes(name)) {
            return createElement(BlockEdit, props);
        }

        const { customPadding, enableAOS, aosDelay } = attributes;

        return createElement(
            wp.element.Fragment,
            null,
            createElement(BlockEdit, props),
            createElement(
                InspectorControls,
                null,
                createElement(
                    PanelBody,
                    { title: "Дополнительные настройки", initialOpen: true },
                    createElement(
                        RangeControl,
                        {
                            label: "Верхний отступ (px)",
                            value: customPadding || 0,
                            onChange: (value) => setAttributes({ customPadding: value }),
                            min: 0,
                            max: 200,
                            step: 5,
                        }
                    ),
                    createElement(
                        ToggleControl,
                        {
                            label: "Анимация при скролле (AOS)",
                            checked: enableAOS,
                            onChange: () => setAttributes({ enableAOS: !enableAOS }),
                            help: enableAOS ? 'Анимация включена' : 'Анимация выключена',
                        }
                    ),
                    // Показываем поле задержки ТОЛЬКО если AOS включён
                    enableAOS && createElement(
                        TextControl,
                        {
                            label: "Задержка анимации (мс)",
                            type: "number",
                            value: aosDelay || 0,
                            onChange: (value) => setAttributes({ aosDelay: parseInt(value) || 0 }),
                            help: "Например: 100, 300, 600. Задержка в миллисекундах.",
                        }
                    )
                )
            )
        );
    };
}, 'withInspectorControl');

wp.hooks.addFilter(
    'editor.BlockEdit',
    'my-plugin/with-inspector-control',
    withInspectorControl
);

// 3. Фронтенд: добавляем data-aos, data-aos-delay и отступ для целевых блоков
// function addFrontendStyle(element, block) {
//     if (!TARGET_BLOCKS.includes(block.name)) {
//         return element;
//     }
//
//     const { customPadding, enableAOS, aosDelay } = block.attributes;
//
//     // Если ничего не задано — возвращаем как есть
//     if (!customPadding && !enableAOS) {
//         return element;
//     }
//
//     // Собираем атрибуты для обёртки
//     const wrapperProps = {};
//
//     if (customPadding) {
//         wrapperProps.style = { paddingTop: `${customPadding}px` };
//     }
//
//     if (enableAOS) {
//         wrapperProps['data-aos'] = 'fade-up';
//         if (aosDelay && aosDelay > 0) {
//             wrapperProps['data-aos-delay'] = aosDelay;
//         }
//     }
//
//     // Оборачиваем блок в div с нужными атрибутами
//     return createElement(
//         'div',
//         wrapperProps,
//         element
//     );
// }

wp.hooks.addFilter(
    'render_block',
    'my-plugin/add-frontend-padding',
    addFrontendStyle
);