const { chromium } = require('playwright');

const baseUrl = process.env.SPACE_TEST_URL || 'https://178.141.246.84:16048';
const inlineRoutes = [
    '/', '/space-vm/', '/space-vdi/', '/space-client/', '/space-cloud/',
    '/spacevm-essentials-plus-kit/', '/space-test/', '/cases/vnedrenie/',
    '/vacancies/', '/vacancies/testovaya-vakansiya-1/',
];

function assert(condition, message) {
    if (!condition) throw new Error(message);
}

async function checkPages(browser, viewport, label) {
    const context = await browser.newContext({ viewport, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    const errors = [];
    page.on('pageerror', (error) => errors.push(error.message));

    for (const route of inlineRoutes) {
        const response = await page.goto(baseUrl + route, { waitUntil: 'domcontentloaded' });
        assert(response && response.ok(), `${label} ${route}: HTTP ${response ? response.status() : 'error'}.`);
        assert(await page.locator('form.js-form-custom').count() > 0, `${label} ${route}: гибкая форма не найдена.`);
        assert(await page.locator('form.js-form').count() === 0, `${label} ${route}: найдена старая .js-form.`);
        assert(await page.locator('form.js-form-custom input[name="form_schema"]').count() > 0, `${label} ${route}: нет подписанной схемы.`);
        const visibleForms = page.locator('form.js-form-custom:visible');
        if (await visibleForms.count() > 0) {
            const formBox = await visibleForms.first().boundingBox();
            assert(formBox && formBox.width <= viewport.width + 1, `${label} ${route}: форма шире viewport.`);
        }
    }

    assert(errors.length === 0, `${label}: JavaScript errors: ${errors.join('; ')}`);
    await context.close();
}

async function checkVacancySubmission(browser) {
    const context = await browser.newContext({ viewport: { width: 1440, height: 1000 }, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    let requests = 0;
    await page.route('**/admin-ajax.php', (route) => {
        requests++;
        return route.fulfill({ status: 200, contentType: 'application/json', body: '{"status":true}' });
    });
    await page.goto(baseUrl + '/vacancies/', { waitUntil: 'domcontentloaded' });
    const form = page.locator('form.vacancy-feedback__form');
    const file = form.locator('input[type="file"]');

    await file.setInputFiles({ name: 'unsafe.php', mimeType: 'application/x-httpd-php', buffer: Buffer.from('<?php') });
    assert(requests === 0, 'Опасный файл не должен отправлять AJAX.');
    assert((await form.locator('[data-form-field="resume"] [data-form-error]').textContent()).trim() !== '', 'Для опасного файла нужна ошибка поля.');

    const requiredValues = { name: 'QA', specialization: 'QA', phone: '+7 (912) 345-67-89', email: 'qa@example.test' };
    for (const [name, value] of Object.entries(requiredValues)) {
        await form.locator(`[name="custom_field[${name}][value]"]`).fill(value);
    }
    await form.locator('[name="form_agreement"]').evaluate((input) => {
        input.checked = true;
        input.dispatchEvent(new Event('change', { bubbles: true }));
    });
    await file.setInputFiles({ name: 'resume.pdf', mimeType: 'application/pdf', buffer: Buffer.from('%PDF-1.4\n%%EOF') });
    await form.locator('button[type="submit"]').click();
    await page.locator('#feedback-success').waitFor({ state: 'visible' });
    assert(requests === 1, 'Валидная HR-форма должна выполнить один перехваченный AJAX-запрос.');
    await context.close();
}

(async () => {
    const browser = await chromium.launch({ headless: true });
    try {
        await checkPages(browser, { width: 1440, height: 1000 }, 'desktop');
        await checkPages(browser, { width: 390, height: 844 }, 'mobile');
        await checkVacancySubmission(browser);
        console.log('PASS: browser form checks.');
    } finally {
        await browser.close();
    }
})().catch((error) => {
    console.error(`FAIL: ${error.message}`);
    process.exit(1);
});
