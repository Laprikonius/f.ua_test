FROM php:8.2-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    zlib1g-dev && \
    docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg \
    --with-xpm --with-freetype && \
    docker-php-ext-install -j$(nproc) gd && \
    rm -rf /var/lib/apt/lists/*

# RUN set eux; \
# 	rabbitmq-plugins enable --offline rabbitmq_management; \
#     # make sure the metrics collector is re-enabled (disabled in the base image for Prometheus-style metrics by default)
# 	rm -f /etc/rabbitmq/conf.d/20-management_agent.disable_metrics_collector.conf; \
#     # grab "rabbitmqadmin" from inside the "rabbitmq_management-X.Y.Z" plugin folder
#     # see https://github.com/docker-library/rabbitmq/issues/207
# 	cp /plugins/rabbitmq_management-*/priv/www/cli/rabbitmqadmin /usr/local/bin/rabbitmqadmin; \
# 	[ -s /usr/local/bin/rabbitmqadmin ]; \
# 	chmod +x /usr/local/bin/rabbitmqadmin; \
# 	apt-get update; \
# 	apt-get install -y --no-install-recommends python3; \
# 	rm -rf /var/lib/apt/lists/*; \
# 	rabbitmqadmin --version

# EXPOSE 15671 15672

WORKDIR /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN mv composer.phar /usr/local/bin

RUN curl -sS https://get.symfony.com/cli/installer | bash

#RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony