FROM wordpress:6.7.2-php8.1-apache

ADD https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar /usr/local/bin/wp

RUN chmod 755 /usr/local/bin/wp

COPY ./ /usr/src/wordpress/wp-content/themes/space

RUN rm -rf /usr/src/wordpress/wp-content/themes/space/docker

RUN chown -R www-data:www-data /usr/src/wordpress/wp-content/themes/space

COPY ./devops/wp-config.php /usr/src/wordpress/wp-config.php

COPY ./devops/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN  chmod +x /usr/local/bin/docker-entrypoint.sh

