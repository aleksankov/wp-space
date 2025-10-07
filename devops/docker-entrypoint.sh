#!/usr/bin/env bash
# Fix permissions
set -Eeuo pipefail

rm -rf /var/www/html/ && mv /usr/src/wordpress/* /var/www/html && mv /usr/src/wordpress/.htaccess /var/www/html/.htaccess
chown -R www-data:www-data /var/www/html/ && chmod 755 /var/www/html/

exec "$@"
