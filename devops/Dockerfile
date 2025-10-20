FROM wordpress:6.7.2-php8.1-apache

RUN docker-php-ext-install opcache

ADD https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar /usr/local/bin/wp

RUN chmod 755 /usr/local/bin/wp

RUN apt update && apt install -y wget zip

USER www-data:www-data

# Delete default plugins

RUN find /usr/src/wordpress/wp-content/plugins/* -type d -prune -exec rm -rf {} \; &&  find /usr/src/wordpress/wp-content/themes/* -type d -prune -exec rm -rf {} \;

# Install plugins

RUN wget -O /tmp/tmp.zip http://space-harbor.space.team/wordpress-plugins/advanced-custom-fields-pro.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip http://space-harbor.space.team/wordpress-plugins/akismet.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/cyr2lat.6.3.0.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/duplicator.1.5.12.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/duplicate-post.4.5.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/kama-thumbnail.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/query-monitor.3.17.2.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/redirection.5.5.2.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/redis-cache.2.5.4.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/svg-support.2.5.14.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip http://space-harbor.space.team/wordpress-plugins/vj-wp-import-export.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/wp-mail-smtp.4.4.0.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip http://space-harbor.space.team/wordpress-plugins/wp-rocket.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/wpforms-lite.1.9.4.2.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip && \
    wget -O /tmp/tmp.zip https://downloads.wordpress.org/plugin/wordpress-seo.24.9.zip && cd /usr/src/wordpress/wp-content/plugins/ && unzip /tmp/tmp.zip && rm /tmp/tmp.zip

# Move to workdir

USER root:root

COPY devops/000-default.conf /etc/apache2/sites-enabled/

RUN rm -rf /var/www/html/* && mkdir -p /var/www/wp-space/ && mv /usr/src/wordpress/* /var/www/wp-space/ && mv /usr/src/wordpress/.htaccess /var/www/wp-space/.htaccess

COPY ./ /var/www/wp-space/wp-content/themes/space

# Add config

COPY ./devops/wp-config.php /var/www/wp-space/wp-config.php

# Fix permissions

RUN chown -R www-data:www-data /var/www/wp-space/ && chmod 755 /var/www/wp-space/

RUN rm -rf /var/www/wp-space/wp-content/themes/space/devops

# Add php config

COPY ./devops/wp-space.ini $PHP_INI_DIR/conf.d/

# Change entripoint script

COPY ./devops/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/wp-space/