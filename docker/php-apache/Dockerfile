From php:8-apache

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Setup bare-minimum extra extensions for Laravel & others
RUN DEBIAN_FRONTEND=noninteractive apt-get update \
	&& apt-get install -y --no-install-recommends \
		libicu-dev \
        unzip \
        libpng-dev \
        libjpeg-dev \
        zlib1g-dev \
        libwebp-dev \
		zip \
		bzip2 \
		nano \
		apt-utils \
        libfreetype6-dev \
        libldap2-dev \
        libcurl4-gnutls-dev \
        libc-client-dev \
        libkrb5-dev \
        libxslt-dev \
        libzip-dev \
        g++ \
    && phpModules=" \
                xsl \
                zip \
                imap \
            " \
	&& docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
	&& docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
	&& docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
	&& docker-php-ext-install -j$(nproc) $phpModules \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install composer and update path
ENV COMPOSER_HOME /composer
ENV PATH /composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install code quality tools
RUN composer global require "squizlabs/php_codesniffer=*"
RUN composer global require "pheromone/phpcs-security-audit=*"
RUN composer global require "phpcompatibility/php-compatibility=*"
RUN composer global require "dealerdirect/phpcodesniffer-composer-installer=*"
RUN composer global require "friendsofphp/php-cs-fixer=*"
RUN composer global require "phpmd/phpmd=*"
RUN composer global require "phpstan/phpstan=*"
RUN composer global require "vimeo/psalm=*"
RUN composer global require "sensiolabs/security-checker=*"
RUN composer global require "phpunit/phpunit=*"

# Enable Apache mod_rewrite.
RUN a2enmod rewrite ssl headers proxy proxy_http

# Change uid and gid of apache to docker user uid/gid 
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data

RUN apt-get update && apt-get install -y ssh-client

WORKDIR "/var/www"

EXPOSE 80
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
