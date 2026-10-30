const { chromium } = require('playwright');

const baseUrl = process.env.SPACE_TEST_URL || 'https://178.141.246.84:16048';

function assert(condition, message) {
    if (!condition) {
        throw new Error(message);
    }
}

async function testViewport(browser, viewport, label) {
    const context = await browser.newContext({ viewport, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    const runtimeErrors = [];

    page.on('pageerror', (error) => runtimeErrors.push(error.stack || error.message));
    const response = await page.goto(`${baseUrl}/glossary/`, { waitUntil: 'networkidle' });

    assert(response && response.status() === 200, `${label}: хаб не вернул HTTP 200.`);
    assert(await page.locator('[data-glossary-root]').count() === 1, `${label}: корневой контейнер отсутствует или дублируется.`);
    assert(await page.locator('h1').textContent() === 'Глоссарий', `${label}: неверный H1.`);
    assert(await page.locator('link[href*="assets/css/glossary.css"]').count() === 1, `${label}: glossary.css не подключён ровно один раз.`);
    assert(await page.locator('script[src*="assets/js/glossary.js"]').count() === 1, `${label}: glossary.js не подключён ровно один раз.`);
    assert(await page.locator('.glossary-card').count() === 12, `${label}: ожидалось 12 демонстрационных карточек.`);

    const categoryToggle = page.locator('[data-glossary-categories-toggle]');
    assert(await categoryToggle.count() === 1, `${label}: кнопка «Показать ещё» не появилась при большом количестве категорий.`);
    const collapsedCategoriesHeight = await page.locator('.glossary__categories').evaluate((categories) => categories.getBoundingClientRect().height);
    assert(collapsedCategoriesHeight === 36, `${label}: категории должны занимать ровно одну строку до раскрытия.`);

    await categoryToggle.click();
    assert(await categoryToggle.textContent() === 'Скрыть', `${label}: после раскрытия должна отображаться кнопка «Скрыть».`);
    assert(await categoryToggle.getAttribute('aria-expanded') === 'true', `${label}: aria-expanded не отражает раскрытое состояние.`);
    const expandedCategoriesHeight = await page.locator('.glossary__categories').evaluate((categories) => categories.getBoundingClientRect().height);
    assert(expandedCategoriesHeight > 36, `${label}: категории не раскрылись на несколько строк.`);

    await categoryToggle.click();
    assert(await categoryToggle.textContent() === 'Показать ещё', `${label}: после сворачивания должна отображаться кнопка «Показать ещё».`);
    assert(await categoryToggle.getAttribute('aria-expanded') === 'false', `${label}: aria-expanded не отражает свёрнутое состояние.`);
    const recollapsedCategoriesHeight = await page.locator('.glossary__categories').evaluate((categories) => categories.getBoundingClientRect().height);
    assert(recollapsedCategoriesHeight === 36, `${label}: категории не свернулись обратно в одну строку.`);

    for (const allButton of [page.locator('.glossary__chip--all'), page.locator('.glossary__alphabet-link--all')]) {
        if (label === 'desktop') {
            await allButton.hover();
        } else {
            await allButton.focus();
        }
        const allButtonState = await allButton.evaluate((button) => {
            const style = getComputedStyle(button);
            const box = button.getBoundingClientRect();
            return {
                width: box.width,
                height: box.height,
                background: style.backgroundColor,
                color: style.color,
                border: style.borderColor,
                fontWeight: style.fontWeight,
            };
        });
        assert(allButtonState.width === 57 && allButtonState.height === 36, `${label}: кнопка «Все» должна быть 57×36px.`);
        assert(allButtonState.background === 'rgb(148, 106, 210)', `${label}: активная кнопка «Все» должна быть фиолетовой.`);
        assert(allButtonState.color === 'rgb(255, 255, 255)', `${label}: текст активной кнопки «Все» должен быть белым.`);
        assert(allButtonState.border === 'rgba(0, 0, 0, 0)', `${label}: активная кнопка «Все» не должна иметь видимой рамки.`);
        assert(allButtonState.fontWeight === '600', `${label}: кнопка «Все» должна иметь насыщенность 600.`);
    }

    const metrics = await page.locator('[data-glossary-root]').evaluate((root) => {
        const title = root.querySelector('.glossary__title');
        const search = root.querySelector('[data-glossary-search]');
        return {
            documentWidth: document.documentElement.scrollWidth,
            viewportWidth: document.documentElement.clientWidth,
            titleSize: parseFloat(getComputedStyle(title).fontSize),
            searchHeight: search.getBoundingClientRect().height,
        };
    });

    assert(metrics.documentWidth <= metrics.viewportWidth + 1, `${label}: обнаружен горизонтальный скролл.`);
    assert(metrics.searchHeight === 56, `${label}: высота поиска должна быть 56px.`);
    assert(metrics.titleSize === (label === 'desktop' ? 40 : 32), `${label}: неверный размер заголовка.`);

    const firstCard = page.locator('.glossary-card').first();
    const firstCardLink = firstCard.locator('.glossary-card__title a');
    if (label === 'desktop') {
        await firstCard.hover();
    } else {
        await firstCardLink.focus();
    }
    await page.waitForTimeout(250);
    const cardState = await firstCard.evaluate((card) => ({
        border: getComputedStyle(card).borderColor,
        title: getComputedStyle(card.querySelector('.glossary-card__title')).color,
    }));
    assert(cardState.border === 'rgb(148, 106, 210)', `${label}: активная карточка должна иметь фиолетовую рамку.`);
    assert(cardState.title === 'rgb(148, 106, 210)', `${label}: заголовок активной карточки должен быть фиолетовым.`);

    await page.mouse.move(viewport.width - 1, viewport.height - 1);
    await page.keyboard.press('Escape');
    await page.screenshot({ path: `/tmp/glossary-${label}.png`, fullPage: true });

    const search = page.locator('[data-glossary-search]');
    await search.fill('пукекуцен');
    await page.waitForTimeout(500);
    await page.waitForFunction(() => new URL(window.location.href).searchParams.get('q') === 'пукекуцен');
    assert(await page.locator('.glossary-card').count() === 0, `${label}: пустой запрос не должен возвращать карточки.`);
    assert(await page.locator('.glossary__empty-text').textContent() === 'Ничего не найдено. Попробуйте изменить запрос или сбросить фильтры.', `${label}: неверный текст пустого состояния.`);

    const emptyState = await page.locator('.glossary__empty').evaluate((empty) => {
        const emptyBox = empty.getBoundingClientRect();
        const resetBox = empty.querySelector('.glossary__reset').getBoundingClientRect();
        return {
            width: emptyBox.width,
            height: emptyBox.height,
            resetWidth: resetBox.width,
            resetHeight: resetBox.height,
        };
    });
    assert(emptyState.width === (label === 'desktop' ? 520 : 327), `${label}: неверная ширина пустого состояния.`);
    assert(emptyState.height === (label === 'desktop' ? 176 : 200), `${label}: неверная высота пустого состояния.`);
    assert(emptyState.resetWidth === 190 && emptyState.resetHeight === 56, `${label}: кнопка сброса должна быть 190×56px.`);

    await page.locator('[data-glossary-reset]').click();
    await page.waitForFunction(() => !new URL(window.location.href).searchParams.has('q'));
    assert(await page.locator('.glossary-card').count() === 12, `${label}: сброс пустого состояния должен возвращать все карточки.`);

    await search.fill('вайрфрейм');
    await page.waitForTimeout(500);
    await page.waitForFunction(() => new URL(window.location.href).searchParams.get('q') === 'вайрфрейм');
    assert(await page.locator('.glossary-card').count() === 1, `${label}: поиск по синониму должен находить Wireframe.`);

    await page.locator('[data-glossary-search]').fill('');
    await page.waitForFunction(() => !new URL(window.location.href).searchParams.has('q'));
    await page.locator('.glossary-card').nth(11).waitFor();
    assert(await page.locator('.glossary-card').count() === 12, `${label}: очистка поиска должна возвращать все карточки.`);

    const storageCategory = page.locator('.glossary__chip').filter({ hasText: 'Хранилище' });
    const storageIsOutsideCollapsedRow = await storageCategory.evaluate((category) => {
        const categoryBox = category.getBoundingClientRect();
        const categoriesBox = category.closest('.glossary__categories').getBoundingClientRect();
        return categoryBox.bottom > categoriesBox.bottom + 1;
    });
    if (storageIsOutsideCollapsedRow) {
        await page.locator('[data-glossary-categories-toggle]').click();
    }
    await storageCategory.click();
    await page.waitForFunction(() => new URL(window.location.href).searchParams.getAll('category[]').includes('storage'));
    assert(await page.locator('.glossary-card').count() === 3, `${label}: фильтр «Хранилище» должен возвращать три карточки.`);

    await storageCategory.click();
    await page.waitForFunction(() => !new URL(window.location.href).searchParams.has('category[]'));
    await page.locator('.glossary__alphabet-link', { hasText: /^R$/ }).click();
    await page.waitForFunction(() => new URL(window.location.href).searchParams.get('letter') === 'R');
    assert(await page.locator('.glossary-card').count() === 1, `${label}: буква R должна находить Robots.txt.`);
    assert(await page.locator('[data-glossary-root]').getAttribute('aria-busy') === null, `${label}: фильтрация осталась в состоянии загрузки.`);
    const unexpectedErrors = runtimeErrors.filter((error) => !error.includes("Cannot set properties of null (setting 'muted')"));
    assert(unexpectedErrors.length === 0, `${label}: JS-ошибки: ${unexpectedErrors.join('; ')}`);

    await context.close();
}

async function testSingleViewport(browser, viewport, label) {
    const context = await browser.newContext({ viewport, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    const response = await page.goto(`${baseUrl}/glossary/hypervisor/`, { waitUntil: 'networkidle' });

    assert(response && response.status() === 200, `${label} single: страница не вернула HTTP 200.`);
    assert(await page.locator('.glossary-term').count() === 1, `${label} single: корневой контейнер отсутствует.`);
    assert(await page.locator('.glossary-term__title').textContent() === 'Гипервизор', `${label} single: неверный H1.`);
    assert(await page.locator('.glossary-term__related-list a').count() === 3, `${label} single: ожидалось три связанных термина.`);
    assert(await page.locator('.glossary-code').count() === 1, `${label} single: блок кода отсутствует.`);
    assert(await page.locator('.wp-block-table').count() === 1, `${label} single: таблица отсутствует.`);
    assert(await page.locator('.glossary-note').count() === 1, `${label} single: информационный блок отсутствует.`);
    assert(await page.locator('.wp-block-table').getAttribute('tabindex') === '0', `${label} single: таблица должна быть доступна с клавиатуры.`);
    assert(await page.locator('link[href*="assets/css/glossary.css"]').count() === 1, `${label} single: glossary.css не подключён.`);
    assert(await page.locator('script[src*="assets/js/glossary.js"]').count() === 0, `${label} single: скрипт фильтрации не должен подключаться.`);

    const layout = await page.locator('.glossary-term').evaluate((root) => ({
        documentWidth: document.documentElement.scrollWidth,
        viewportWidth: document.documentElement.clientWidth,
        titleSize: parseFloat(getComputedStyle(root.querySelector('.glossary-term__title')).fontSize),
        backDisplay: getComputedStyle(root.querySelector('.glossary-term__back')).display,
    }));
    assert(layout.documentWidth <= layout.viewportWidth + 1, `${label} single: обнаружен горизонтальный скролл.`);
    assert(layout.titleSize === (label === 'desktop' ? 40 : 32), `${label} single: неверный размер H1.`);
    assert(label === 'desktop' ? layout.backDisplay !== 'none' : layout.backDisplay === 'none', `${label} single: неверная видимость кнопки «Назад».`);

    const expectedPositions = label === 'desktop'
        ? {
            '.glossary-term__back': [120, 162],
            '.glossary-term__header': [120, 242],
            '.glossary-term__related': [941, 242],
            '.glossary-term__content': [120, 636],
            '.glossary-note': [120, 1407],
            'footer': [0, 1619],
        }
        : {
            '.glossary-term__header': [24, 96],
            '.glossary-term__intro': [24, 226],
            '.glossary-term__related': [24, 576],
            '.glossary-term__content': [24, 748],
            '.glossary-note': [24, 1719],
            'footer': [0, 1967],
        };

    for (const [selector, [expectedX, expectedY]] of Object.entries(expectedPositions)) {
        const box = await page.locator(selector).boundingBox();
        assert(box && Math.abs(box.x - expectedX) <= 1 && Math.abs(box.y - expectedY) <= 1, `${label} single: позиция ${selector} не соответствует Figma.`);
    }

    await page.screenshot({ path: `/tmp/glossary-single-${label}.png`, fullPage: true });
    await context.close();
}

async function testSimpleSingleViewport(browser, viewport, label) {
    const context = await browser.newContext({ viewport, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    const response = await page.goto(`${baseUrl}/glossary/wireframe/`, { waitUntil: 'networkidle' });

    assert(response && response.status() === 200, `${label} simple single: страница не вернула HTTP 200.`);
    assert(await page.locator('.glossary-term--simple').count() === 1, `${label} simple single: компактная модификация не включилась.`);
    assert(await page.locator('.glossary-term__related').count() === 0, `${label} simple single: не должен выводиться блок связанных терминов.`);

    const contentState = await page.locator('.glossary-term__content').evaluate((content) => {
        const style = getComputedStyle(content);
        return {
            borderTopWidth: style.borderTopWidth,
            paddingTop: style.paddingTop,
            marginTop: style.marginTop,
        };
    });

    assert(contentState.borderTopWidth === '0px', `${label} simple single: перед основным текстом остался разделитель.`);
    assert(contentState.paddingTop === '0px', `${label} simple single: перед текстом остался внутренний отступ.`);
    assert(contentState.marginTop === '24px', `${label} simple single: расстояние между описанием и текстом должно быть 24px.`);

    await context.close();
}

(async () => {
    const browser = await chromium.launch({ headless: true });
    try {
        await testViewport(browser, { width: 1440, height: 1000 }, 'desktop');
        await testViewport(browser, { width: 375, height: 812 }, 'mobile');
        await testSingleViewport(browser, { width: 1440, height: 1000 }, 'desktop');
        await testSingleViewport(browser, { width: 375, height: 812 }, 'mobile');
        await testSimpleSingleViewport(browser, { width: 1440, height: 1000 }, 'desktop');
        await testSimpleSingleViewport(browser, { width: 375, height: 812 }, 'mobile');

        const context = await browser.newContext({ ignoreHTTPSErrors: true });
        const page = await context.newPage();
        await page.goto(`${baseUrl}/`, { waitUntil: 'domcontentloaded' });
        assert(await page.locator('link[href*="assets/css/glossary.css"], script[src*="assets/js/glossary.js"]').count() === 0, 'Ассеты глоссария попали на главную страницу.');
        await context.close();

        console.log('Браузерные проверки хаба глоссария пройдены.');
    } finally {
        await browser.close();
    }
})().catch((error) => {
    console.error(error.message);
    process.exit(1);
});
