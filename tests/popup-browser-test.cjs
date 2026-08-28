const { chromium } = require('playwright');

const baseUrl = process.env.SPACE_TEST_URL || 'https://178.141.246.84:16048';
const cases = [
    { path: '/space-vm/', ids: ['buy-vm'] },
    { path: '/space-vdi/', ids: ['demo-vdi', 'buy-vdi'] },
    { path: '/space-cloud/', ids: ['demo-vm', 'buy-vm'] },
    { path: '/spacevm-essentials-plus-kit/', ids: ['demo-vm', 'buy-vm'] },
    { path: '/partners/', ids: ['partner-popup'] },
    { path: '/space-connect/', ids: ['tech-partner-popup'] },
    { path: '/space-client/', ids: ['download_custom1'] },
];
const pageSpecificIds = ['demo-vm', 'buy-vm', 'demo-vdi', 'buy-vdi', 'partner-popup', 'tech-partner-popup'];
const globalIds = ['demo-popup', 'feedback-success', 'feedback-error'];

function assert(condition, message) {
    if (!condition) {
        throw new Error(message);
    }
}

async function openPopup(page, id, closeAfterCheck = true) {
    await page.evaluate((popupId) => {
        window.jQuery.fancybox.open({ src: `#${popupId}`, type: 'inline' });
    }, id);
    await page.locator(`#${id}`).waitFor({ state: 'visible' });

    const box = await page.locator(`#${id}`).boundingBox();
    const viewport = page.viewportSize();
    assert(box && viewport, `${id}: не удалось получить размеры окна.`);
    assert(box.width <= viewport.width + 1, `${id}: поп-ап шире viewport.`);

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

    await page.goto(baseUrl + '/', { waitUntil: 'domcontentloaded' });
    for (const id of globalIds) {
        assert(await page.locator(`#${id}`).count() === 1, `${label}: глобальный ${id} отсутствует или дублируется.`);
        await openPopup(page, id);
    }
    for (const id of pageSpecificIds) {
        assert(await page.locator(`#${id}`).count() === 0, `${label}: ${id} попал на главную страницу.`);
    }

    for (const testCase of cases) {
        await page.goto(baseUrl + testCase.path, { waitUntil: 'domcontentloaded' });
        for (const id of globalIds) {
            assert(await page.locator(`#${id}`).count() === 1, `${label} ${testCase.path}: глобальный ${id} отсутствует или дублируется.`);
        }
        for (const id of testCase.ids) {
            assert(await page.locator(`#${id}`).count() === 1, `${label} ${testCase.path}: ${id} отсутствует или дублируется.`);
            await openPopup(page, id);
        }
    }

    await context.close();
}

async function testAjaxStates(browser) {
    const context = await browser.newContext({
        viewport: { width: 1440, height: 1000 },
        ignoreHTTPSErrors: true,
    });
    const page = await context.newPage();
    await page.goto(baseUrl + '/space-vm/', { waitUntil: 'domcontentloaded' });

    const form = page.locator('#buy-vm form.js-form-custom');
    await openPopup(page, 'buy-vm', false);
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
    assert(await form.locator('[name="custom_field[name][value]"]').inputValue() === fields.name, 'При ошибке данные формы должны сохраняться.');

    await page.unroute('**/admin-ajax.php');
    await page.route('**/admin-ajax.php', (route) => route.fulfill({
        status: 200,
        contentType: 'application/json',
        body: JSON.stringify({ status: true }),
    }));
    await openPopup(page, 'buy-vm', false);
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-success').waitFor({ state: 'visible' });
    assert(await form.locator('[name="custom_field[name][value]"]').inputValue() === '', 'После успеха форма должна очищаться.');

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
