(function () {
    'use strict';

    const rootSelector = '[data-glossary-root]';
    const formSelector = '[data-glossary-form]';
    const searchSelector = '[data-glossary-search]';
    let requestController = null;
    let searchTimer = null;
    let resizeTimer = null;

    function getRoot() {
        return document.querySelector(rootSelector);
    }

    function initializeRoot(root, preserveExpanded = false) {
        if (!root) {
            return;
        }

        const categories = root.querySelector('.glossary__categories');
        const toggle = root.querySelector('[data-glossary-categories-toggle]');

        if (!categories || !toggle) {
            return;
        }

        const wasExpanded = preserveExpanded || root.classList.contains('glossary--categories-expanded');
        root.classList.add('glossary--categories-enhanced');
        root.classList.remove('glossary--categories-expanded');
        toggle.hidden = false;

        const hasOverflow = categories.scrollHeight > categories.clientHeight + 1;
        const firstChip = categories.querySelector('.glossary__chip');
        const checkedChip = categories.querySelector('.glossary__chip:has(input:checked)');
        const activeChipIsOutsideFirstRow = firstChip && checkedChip
            ? checkedChip.offsetTop > firstChip.offsetTop + 1
            : false;
        const shouldExpand = hasOverflow && (wasExpanded || activeChipIsOutsideFirstRow);

        toggle.hidden = !hasOverflow;
        root.classList.toggle('glossary--categories-expanded', shouldExpand);
        toggle.setAttribute('aria-expanded', String(shouldExpand));
        toggle.textContent = shouldExpand ? toggle.dataset.hideLabel : toggle.dataset.showLabel;
    }

    function buildFormUrl(form) {
        const url = new URL(form.action, window.location.href);
        const formData = new FormData(form);

        for (const [name, value] of formData.entries()) {
            if (String(value).trim() !== '') {
                url.searchParams.append(name, value);
            }
        }

        return url;
    }

    async function navigate(url, historyMode, shouldFocusSearch) {
        const currentRoot = getRoot();

        if (!currentRoot) {
            window.location.assign(url.href);
            return;
        }

        if (requestController) {
            requestController.abort();
        }

        const controller = new AbortController();
        requestController = controller;
        currentRoot.setAttribute('aria-busy', 'true');

        try {
            const response = await fetch(url.href, {
                credentials: 'same-origin',
                headers: { Accept: 'text/html' },
                signal: controller.signal,
            });

            if (!response.ok) {
                throw new Error('Glossary request failed');
            }

            const html = await response.text();
            const documentFragment = new DOMParser().parseFromString(html, 'text/html');
            const nextRoot = documentFragment.querySelector(rootSelector);

            if (!nextRoot) {
                throw new Error('Glossary response is incomplete');
            }

            const preserveExpanded = currentRoot.classList.contains('glossary--categories-expanded');
            currentRoot.replaceWith(nextRoot);
            initializeRoot(nextRoot, preserveExpanded);
            document.title = documentFragment.title || document.title;

            if (historyMode === 'push') {
                window.history.pushState(null, '', url.href);
            } else if (historyMode === 'replace') {
                window.history.replaceState(null, '', url.href);
            }

            if (shouldFocusSearch) {
                const searchInput = nextRoot.querySelector(searchSelector);

                if (searchInput) {
                    const valueLength = searchInput.value.length;
                    searchInput.focus();
                    searchInput.setSelectionRange(valueLength, valueLength);
                }
            }
        } catch (error) {
            if (error.name === 'AbortError') {
                return;
            }

            window.location.assign(url.href);
        } finally {
            if (requestController !== controller) {
                return;
            }

            requestController = null;
            const activeRoot = getRoot();

            if (activeRoot) {
                activeRoot.removeAttribute('aria-busy');
            }
        }
    }

    document.addEventListener('submit', function (event) {
        const form = event.target.closest(formSelector);

        if (!form) {
            return;
        }

        event.preventDefault();
        navigate(buildFormUrl(form), 'push', false);
    });

    document.addEventListener('change', function (event) {
        if (!event.target.matches(`${formSelector} input[type="checkbox"]`)) {
            return;
        }

        const form = event.target.closest(formSelector);
        navigate(buildFormUrl(form), 'push', false);
    });

    document.addEventListener('input', function (event) {
        if (!event.target.matches(searchSelector)) {
            return;
        }

        window.clearTimeout(searchTimer);
        searchTimer = window.setTimeout(function () {
            const form = event.target.closest(formSelector);

            if (form) {
                navigate(buildFormUrl(form), 'replace', true);
            }
        }, 350);
    });

    document.addEventListener('click', function (event) {
        const categoriesToggle = event.target.closest('[data-glossary-categories-toggle]');

        if (categoriesToggle) {
            const root = categoriesToggle.closest(rootSelector);
            const isExpanded = categoriesToggle.getAttribute('aria-expanded') === 'true';

            root.classList.toggle('glossary--categories-expanded', !isExpanded);
            categoriesToggle.setAttribute('aria-expanded', String(!isExpanded));
            categoriesToggle.textContent = isExpanded
                ? categoriesToggle.dataset.showLabel
                : categoriesToggle.dataset.hideLabel;
            return;
        }

        const link = event.target.closest('[data-glossary-root] a');

        if (!link || link.origin !== window.location.origin) {
            return;
        }

        if (!link.closest('.glossary__alphabet') && !link.matches('[data-glossary-reset]')) {
            return;
        }

        event.preventDefault();
        navigate(new URL(link.href), 'push', false);
    });

    window.addEventListener('popstate', function () {
        navigate(new URL(window.location.href), null, false);
    });

    window.addEventListener('resize', function () {
        window.clearTimeout(resizeTimer);
        resizeTimer = window.setTimeout(function () {
            initializeRoot(getRoot());
        }, 150);
    });

    initializeRoot(getRoot());
}());
