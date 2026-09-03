const { chromium } = require('playwright');

const baseUrl = process.env.SPACE_TEST_URL || 'https://178.141.246.84:16048';
const cases = [
    { path: '/', ids: ['demo-popup'] },
    { path: '/space-vm/', ids: ['demo-popup', 'buy-vm'] },
    { path: '/space-vdi/', ids: ['demo-popup', 'demo-vdi', 'buy-vdi'] },
    { path: '/space-client/', ids: ['demo-popup', 'download_custom1'] },
    { path: '/space-cloud/', ids: ['demo-popup', 'demo-vm', 'buy-vm'] },
    { path: '/spacevm-essentials-plus-kit/', ids: ['demo-popup', 'demo-vm', 'buy-vm'] },
    { path: '/partners/', ids: ['partner-popup'] },
    { path: '/space-connect/', ids: ['tech-partner-popup'] },
];
const pageSpecificIds = ['demo-vm', 'buy-vm', 'demo-vdi', 'buy-vdi', 'partner-popup', 'tech-partner-popup'];
const resultIds = ['feedback-success', 'feedback-error'];

function assert(condition, message) {
    if (!condition) {
        throw new Error(message);
    }
}

async function openPopup(page, id, closeAfterCheck = true) {
    await page.evaluate(() => window.jQuery.fancybox.close(true));
    await page.waitForFunction(() => !document.querySelector('.fancybox-container'));
    await page.evaluate((popupId) => {
        window.jQuery.fancybox.open({ src: `#${popupId}`, type: 'inline' });
    }, id);
    await page.locator(`#${id}`).waitFor({ state: 'visible' });
    await page.waitForTimeout(150);

    const box = await page.locator(`#${id}`).boundingBox();
    const viewport = page.viewportSize();
    assert(box && viewport, `${id}: не удалось получить размеры окна.`);
    assert(box.width <= viewport.width + 1, `${id}: поп-ап шире viewport.`);

    const image = page.locator(`#${id} .main-popup__img img`);
    if (await image.count() > 0 && viewport.width >= 1200) {
        const media = await image.evaluate((element) => {
            const box = element.getBoundingClientRect();
            return {
                width: box.width,
                height: box.height,
                naturalWidth: element.naturalWidth,
                naturalHeight: element.naturalHeight,
                radius: parseFloat(getComputedStyle(element.parentElement).borderRadius),
            };
        });
        assert(media.height <= 558.5, `${id}: изображение растянуто выше дефолтных 558px.`);
        assert(media.radius > 0, `${id}: у изображения отсутствует скруглённая рамка.`);
        if (media.naturalWidth > 0 && media.naturalHeight > 0) {
            const renderedRatio = media.width / media.height;
            const naturalRatio = media.naturalWidth / media.naturalHeight;
            assert(Math.abs(renderedRatio - naturalRatio) < 0.02, `${id}: пропорции изображения искажены.`);
        }
    }

    if (closeAfterCheck) {
        await page.keyboard.press('Escape');
        await page.waitForTimeout(100);
    }
}

async function testViewport(browser, viewport, label) {
    const context = await browser.newContext({
        viewport,
        ignoreHTTPSErrors: true,
    });
    const page = await context.newPage();

    for (const testCase of cases) {
        await page.goto(baseUrl + testCase.path, { waitUntil: 'domcontentloaded' });
        for (const id of resultIds) {
            assert(await page.locator(`#${id}`).count() === 1, `${label} ${testCase.path}: системный ${id} отсутствует или дублируется.`);
        }
        for (const id of testCase.ids) {
            assert(await page.locator(`#${id}`).count() === 1, `${label} ${testCase.path}: ${id} отсутствует или дублируется.`);
            await openPopup(page, id);
        }
    }

    await page.goto(baseUrl + '/glossary/', { waitUntil: 'domcontentloaded' });
    assert(await page.locator('#demo-popup').count() === 0, `${label}: demo-popup попал на постороннюю страницу.`);
    for (const id of pageSpecificIds) {
        assert(await page.locator(`#${id}`).count() === 0, `${label}: ${id} попал в глоссарий.`);
    }

    await context.close();
}

async function testAjaxStates(browser) {
    const context = await browser.newContext({
        viewport: { width: 1440, height: 1000 },
        ignoreHTTPSErrors: true,
    });
    const page = await context.newPage();
    const pageErrors = [];
    page.on('pageerror', (error) => pageErrors.push(error.message));
    await page.goto(baseUrl + '/space-vm/', { waitUntil: 'domcontentloaded' });

    const form = page.locator('#buy-vm form.js-form-custom');
    await openPopup(page, 'buy-vm', false);
    const nameInput = await form.locator('[name="custom_field[name][value]"]').elementHandle();
    assert(nameInput, 'Поле имени формы buy-vm не найдено.');
    let ajaxRequests = 0;
    page.on('request', (request) => {
        if (request.url().includes('admin-ajax.php')) {
            ajaxRequests++;
        }
    });
    await form.locator('button[type="submit"]').click();
    await page.waitForTimeout(300);
    assert(ajaxRequests === 0, 'Пустая форма не должна отправлять AJAX-запрос.');

    const fields = {
        name: 'Тестовый пользователь',
        company: 'Тестовая организация',
        phone: '+7 (912) 345-67-89',
        email: 'test@example.com',
    };
    for (const [name, value] of Object.entries(fields)) {
        await form.locator(`[name="custom_field[${name}][value]"]`).fill(value);
    }
    const partner = form.locator('[name="custom_field[partner][value]"]');
    if (await partner.locator('option').count() > 1) {
        await partner.selectOption({ index: 1 });
    }

    await page.route('**/admin-ajax.php', (route) => route.fulfill({
        status: 200,
        contentType: 'application/json',
        body: JSON.stringify({ status: false }),
    }));
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-error').waitFor({ state: 'visible' });
    assert(await nameInput.inputValue() === fields.name, 'При ошибке данные формы должны сохраняться.');

    await page.unroute('**/admin-ajax.php');
    await page.route('**/admin-ajax.php', (route) => route.fulfill({
        status: 200,
        contentType: 'text/plain',
        body: 'not-json',
    }));
    await openPopup(page, 'buy-vm', false);
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-error').waitFor({ state: 'visible' });

    await page.unroute('**/admin-ajax.php');
    await page.route('**/admin-ajax.php', (route) => route.fulfill({
        status: 503,
        contentType: 'application/json',
        body: JSON.stringify({ status: false }),
    }));
    await openPopup(page, 'buy-vm', false);
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-error').waitFor({ state: 'visible' });
    assert(await nameInput.inputValue() === fields.name, 'HTTP error не должен очищать форму.');

    await page.unroute('**/admin-ajax.php');
    await page.route('**/admin-ajax.php', (route) => route.abort('connectionfailed'));
    await openPopup(page, 'buy-vm', false);
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-error').waitFor({ state: 'visible' });
    assert(await nameInput.inputValue() === fields.name, 'Network error не должен очищать форму.');

    await page.unroute('**/admin-ajax.php');
    await page.route('**/admin-ajax.php', (route) => route.fulfill({
        status: 200,
        contentType: 'application/json',
        body: JSON.stringify({ status: true }),
    }));
    await openPopup(page, 'buy-vm', false);
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-success').waitFor({ state: 'visible' });
    assert(await nameInput.inputValue() === '', 'После успеха форма должна очищаться.');
    assert(pageErrors.length === 0, `JavaScript errors: ${pageErrors.join('; ')}`);

    await context.close();
}

(async () => {
    const browser = await chromium.launch({ headless: true });
    try {
        await testViewport(browser, { width: 1440, height: 1000 }, 'desktop');
        await testViewport(browser, { width: 390, height: 844 }, 'mobile');
        await testAjaxStates(browser);
        console.log('Браузерные проверки поп-апов пройдены.');
    } finally {
        await browser.close();
    }
})().catch((error) => {
    console.error(error.message);
    process.exit(1);
});
