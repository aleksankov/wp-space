const { chromium } = require('playwright');

const baseUrl = process.env.SPACE_TEST_URL || 'https://178.141.246.84:16048';
const inlineRoutes = [
    '/', '/space-vm/', '/space-vdi/', '/space-client/', '/space-cloud/',
    '/spacevm-essentials-plus-kit/', '/space-test/', '/cases/vnedrenie/',
    '/vacancies/', '/vacancies/testovaya-vakansiya-1/', '/partners/', '/space-connect/',
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
        const selects = page.locator('form.js-form-custom select.js-select-custom-field');
        for (let index = 0; index < await selects.count(); index++) {
            const select = selects.nth(index);
            const diagnostic = await select.evaluate((node) => {
                const wrapper = node.closest('.jq-selectbox');
                const mainSelect = wrapper && wrapper.closest('.main-select');
                return {
                    wrapperCount: mainSelect ? mainSelect.querySelectorAll('.jq-selectbox').length : 0,
                    selectedValue: node.value,
                    styledText: wrapper?.querySelector('.jq-selectbox__select-text')?.textContent.trim() || '',
                    floatingText: mainSelect?.querySelector(':scope > .js-select-toggle')?.textContent.trim() || '',
                    controlHeight: parseFloat(getComputedStyle(wrapper?.querySelector('.jq-selectbox__select-text')).height) || 0,
                };
            });
            assert(diagnostic.wrapperCount === 1, `${label} ${route}: select должен иметь ровно одну styled-обёртку.`);
            assert(diagnostic.controlHeight === 56, `${label} ${route}: высота select ${diagnostic.controlHeight}px вместо 56px.`);
            assert(!(diagnostic.selectedValue === '' && diagnostic.styledText === diagnostic.floatingText && diagnostic.styledText !== ''), `${label} ${route}: текст select продублирован: ${diagnostic.styledText}.`);
            assert(await select.evaluate((node) => getComputedStyle(node).opacity === '0'), `${label} ${route}: native select должен быть визуально скрыт formstyler.`);

            const values = await select.locator('option').evaluateAll((options) => options.map((option) => ({
                value: option.value,
                text: option.textContent.trim(),
            })).filter((option) => option.value !== ''));
            if (values.length > 0) {
                await select.selectOption(values[0].value, { force: true });
                const selectedState = await select.evaluate((node) => {
                    const wrapper = node.closest('.jq-selectbox');
                    const selectedText = wrapper?.querySelector('.jq-selectbox__select-text')?.textContent.trim() || '';
                    const visibleMatches = [...wrapper.closest('.main-select').querySelectorAll('.jq-selectbox__select-text')]
                        .filter((element) => getComputedStyle(element).display !== 'none' && element.textContent.trim() === selectedText);
                    return { selectedText, visibleMatches: visibleMatches.length, changed: wrapper.classList.contains('changed') };
                });
                assert(selectedState.selectedText === values[0].text, `${label} ${route}: formstyler не показал выбранный текст ${values[0].text}.`);
                assert(selectedState.visibleMatches === 1, `${label} ${route}: выбранный текст select отображается ${selectedState.visibleMatches} раз.`);
                assert(selectedState.changed, `${label} ${route}: floating label не перешёл в состояние выбранного значения.`);
                await select.selectOption('', { force: true });
            }
        }
        const inlineSections = page.locator('.product-feedback');
        for (let index = 0; index < await inlineSections.count(); index++) {
            assert(await inlineSections.nth(index).locator('form.js-form-custom').count() === 1, `${label} ${route}: inline-блок должен содержать одну форму.`);
        }
        const visibleForms = page.locator('form.js-form-custom:visible');
        if (await visibleForms.count() > 0) {
            const formBox = await visibleForms.first().boundingBox();
            assert(formBox && formBox.width <= viewport.width + 1, `${label} ${route}: форма шире viewport.`);
        }
    }

    assert(errors.length === 0, `${label}: JavaScript errors: ${errors.join('; ')}`);
    await context.close();
}

async function checkSingleMobileForm(browser) {
    const context = await browser.newContext({ viewport: { width: 390, height: 844 }, ignoreHTTPSErrors: true });
    const page = await context.newPage();
    await page.goto(baseUrl + '/space-vm/', { waitUntil: 'domcontentloaded' });
    const section = page.locator('.product-feedback').first();
    const formId = await section.locator('form.js-form-custom').getAttribute('id');
    const form = page.locator(`#${formId}`);
    assert(await form.count() === 1, 'Мобильный inline-блок должен иметь одну форму до открытия.');
    const originalForm = await form.elementHandle();
    assert(await form.evaluate((node) => node.parentElement.hasAttribute('data-inline-form-home')), 'До открытия форма должна находиться в desktop mount.');
    const name = form.locator('[name="custom_field[name][value]"]');
    await name.evaluate((input) => {
        input.value = 'Состояние одной формы';
        input.dispatchEvent(new Event('input', { bubbles: true }));
    });
    await section.locator('.js-inline-form-mobile-trigger').click();
    await form.waitFor({ state: 'visible' });
    assert(await form.evaluate((node) => node.parentElement.hasAttribute('data-inline-form-mobile-mount')), 'После открытия та же форма должна находиться в mobile mount.');
    assert(await form.evaluate((node, original) => node === original, originalForm), 'Mobile popup не должен создавать вторую HTML-форму.');
    assert(await name.inputValue() === 'Состояние одной формы', 'Перенос в popup не должен терять введённое значение.');
    await page.locator(`#popup-${formId.replace(/-form$/, '')} .main-popup__close`).click();
    await page.waitForFunction((id) => {
        const node = document.getElementById(id);
        return node && node.parentElement && node.parentElement.hasAttribute('data-inline-form-home');
    }, formId);
    assert(await section.locator('form.js-form-custom').count() === 1, 'После закрытия мобильного окна форма должна вернуться в блок.');
    assert(await form.evaluate((node) => node.parentElement.hasAttribute('data-inline-form-home')), 'После закрытия форма должна вернуться именно в desktop mount.');
    assert(!await form.evaluate((node) => node.classList.contains('product-feedback__form--mobile-active')), 'После закрытия mobile-класс должен быть снят.');
    assert(await name.inputValue() === 'Состояние одной формы', 'Перемещение формы не должно терять введённое значение.');
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

    await file.setInputFiles({ name: 'oversize.pdf', mimeType: 'application/pdf', buffer: Buffer.alloc(4 * 1024 * 1024) });
    assert(requests === 0, 'Слишком большой файл не должен отправлять AJAX.');
    assert((await form.locator('[data-form-field="resume"] [data-form-error]').textContent()).trim() !== '', 'Для слишком большого файла нужна ошибка поля.');

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
        await checkSingleMobileForm(browser);
        await checkVacancySubmission(browser);
        console.log('PASS: browser form checks.');
    } finally {
        await browser.close();
    }
})().catch((error) => {
    console.error(`FAIL: ${error.message}`);
    process.exit(1);
});
