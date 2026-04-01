# wp-space

## Запуск в контейнере

```bash
cd devops 
docker compose build
docker compose up -d 
```

## Выключение в контейнере

```bash
cd devops 
docker compose down
```

## Доступ через WEB

[](http://localhost)

## Смена адреса

```bash
docker compose exec web bash
su -s /bin/bash www-data
wp option update home http://localhost/
wp option update siteurl http://localhost/
wp search-replace https://spacevm.ru http://localhost --all-tables
```

## Импорт дампа БД

```bash
mysql -u ${MARIADB_USER} --password=${MARIADB_PASSWORD} ${MARIADB_DATABASE} 
source /docker-entrypoint-initdb.d/space-db.sql
```

## Права на wp-content

```bash
docker compose exec web bash
chown -R www-data:www-data /var/www/wp-space
chmod -R +x /var/www/wp-space
```