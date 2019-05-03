FROM php:7.2-apache
LABEL maintainer="Josh Bowden (me@josh.tf)"

# install PHP extensions,  PECL modules and supervisor.
RUN buildDeps=" \
        default-libmysqlclient-dev \
        libbz2-dev \
        libmemcached-dev \
        libsasl2-dev \
    " \
    runtimeDeps=" \
        curl \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg-dev \
        libldap2-dev \
        libmemcachedutil2 \
        libpng-dev \
        libpq-dev \
        libgd-dev \
        libxml2-dev \
        memcached \
        openssl \
        supervisor \
    " \
    && apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps \
    && docker-php-ext-install bcmath bz2 calendar iconv intl mbstring mysqli opcache pdo_mysql pdo_pgsql pgsql soap zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && docker-php-ext-install exif \
    && pecl install memcached redis \
    && docker-php-ext-enable memcached.so redis.so \
    && apt-get purge -y --auto-remove $buildDeps \
    && a2enmod rewrite \
    && a2enmod headers \
    && a2enmod ext_filter \
    && a2enmod expires \
    && rm -r /var/lib/apt/lists/*

# mount our files in to the image
WORKDIR /app
COPY . /app

# set up some details and link the public dir to the apachedir
RUN echo "date.timezone = \"\${PHP_TIMEZONE}\"" > /usr/local/etc/php/conf.d/timezone.ini
RUN echo -e “$(hostname -i)\t$(hostname) $(hostname).localhost” >> /etc/hosts
RUN rm -rf /var/www/html && ln -nsf /app/public /var/www/html

# install Composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

# set up supervisord to run memcached and apache, we could use
# COPY to copy over a premade supervisord config however this method
# that file dependancy.
RUN touch  /etc/supervisor/conf.d/supervisord.conf && \
    echo "[supervisord]" >> /etc/supervisor/conf.d/supervisord.conf && \
    echo "nodaemon=true" >> /etc/supervisor/conf.d/supervisord.conf

RUN touch /etc/supervisor/conf.d/memcached.conf && \
    echo "[program:memcache]" >> /etc/supervisor/conf.d/memcached.conf && \
    echo "command=/usr/bin/memcached -m 64 -p 11211 -u memcache -l 127.0.0.1 -DFOREGROUND" >> /etc/supervisor/conf.d/memcached.conf && \
    echo "autostart=true" >> /etc/supervisor/conf.d/memcached.conf && \
    echo "autorestart=true" >> /etc/supervisor/conf.d/memcached.conf

RUN touch /etc/supervisor/conf.d/apache2.conf && \
    echo "[program:apache2]" >> /etc/supervisor/conf.d/apache2.conf && \
    echo 'command=/bin/bash -c "source /etc/apache2/envvars && exec /usr/sbin/apache2 -DFOREGROUND"' >> /etc/supervisor/conf.d/apache2.conf && \
    echo "autostart=true" >> /etc/supervisor/conf.d/apache2.conf && \
    echo "autorestart=true" >> /etc/supervisor/conf.d/apache2.conf

CMD ["/usr/bin/supervisord"]