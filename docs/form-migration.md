[← Единая система форм](popup-forms.md) · [Назад к README](../README.md)

# Миграция, тестирование и деплой форм

Миграторы запускаются вручную через WP-CLI. Они не выполняются на runtime и не запускаются автоматически на production.

## Скрипты

Команды выполняются из корня проекта, где находится `public_html`:

```bash
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/audit-form-inventory.php
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php dry-run
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php apply
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php verify
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-form-sources.php verify
```

`migrate-unified-forms.php` заменяет `acf/form` на `acf/form-custom`, ищет блоки рекурсивно и сохраняет backup исходного `post_content`. Повторный `apply` идемпотентен: после успешного переноса кандидатов нет.

`migrate-form-sources.php` создаёт или проверяет синхронизированные источники главной, вакансий и `demo-popup`. Страницы находятся по slug, а ссылки на синхронизированные блоки — по фактическому ID текущей базы.

## Проверки разработчика

Из каталога темы:

```bash
cd public_html/wp-content/themes/wp-space
npm test
npm run test:browser
npm run test:forms-browser
npm run test:glossary-browser
npx gulp sass-compile
find . -type f -name '*.php' ! -name '._*' -print0 | xargs -0 -n1 php -l
find acf-json functions -type f -name '*.json' ! -name '._*' -print0 | xargs -0 -n1 jq empty
```

Серверный интеграционный тест запускается отдельно:

```bash
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/tests/form-server-test.php
```

Он перехватывает `wp_mail` через `pre_wp_mail`, удаляет созданную fixture-заявку и печатает только итог PASS/FAIL. Не запускайте ручную отправку формы с реальными данными для smoke-теста почты без согласования с заказчиком.

## Zero-usage gate

Перед удалением compatibility-кода поиск по коду и базе должен вернуть ноль активных использований:

- Gutenberg block `acf/form`;
- форма с классом `.js-form`;
- AJAX action `feedback_form`;
- жёсткая разметка `demo-popup` в `footer.php`;
- дубли одинаковых Popup ID.

Окна `feedback-success` и `feedback-error`, настройки получателей, глобальные списки и согласия удалять нельзя.

## Production rollout

1. Сделайте backup базы данных и `wp-content/uploads`.
2. Разверните код с общей схемой и совместимыми новыми блоками.
3. Синхронизируйте изменённые ACF Local JSON в административной панели.
4. Выполните inventory и `dry-run`; сохраните их краткий итог.
5. Запустите `migrate-unified-forms.php apply` и сохраните путь к созданному JSON backup.
6. Создайте источники форм командой `migrate-form-sources.php apply`, если `verify` сообщает об их отсутствии.
7. Запустите оба `verify` и убедитесь, что старых блоков нет.
8. Очистите WordPress/object cache и CDN-кэш, если он используется.
9. Выполните Playwright smoke-тесты desktop/mobile с перехватом AJAX.
10. Вручную проверьте редактор Gutenberg, ID модалок, получателей и загрузку изображения.
11. Только после zero-usage gate выпускайте очистку старой системы.

## Rollback

Если проблема связана с контентной миграцией, используйте только backup, созданный этим мигратором:

```bash
wp --path=public_html eval-file public_html/wp-content/themes/wp-space/functions/migrations/migrate-unified-forms.php rollback /var/www/html/space.loc/.ai-factory/backups/forms/unified-forms-YYYYMMDD-HHMMSS.json
```

Затем верните предыдущую версию кода, синхронизируйте соответствующий набор ACF JSON и очистите кэш. Если были изменены синхронизированные источники, восстановите базу из production backup: `migrate-form-sources.php` намеренно не удаляет и не откатывает пользовательский контент.

После rollback повторите проверку целевых страниц. Не удаляйте новый backup, пока заказчик не примет релиз.

## См. также

- [Единая система форм](popup-forms.md) — инструкция редактора и архитектура отправки.
- [README](../README.md) — быстрый старт и список проверок.
