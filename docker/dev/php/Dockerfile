FROM php:fpm

ENV TZ Europe/Moscow

RUN chown www-data.www-data /var/www
RUN ln -snf /usr/share/zoneinfo/Europe/Moscow /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

# php extentions
RUN apt update \
    && apt install -y --no-install-recommends \
        systemd git vim zlib1g-dev libicu57 libicu-dev \
        libpng16-16 libpng-dev libfreetype6-dev \
        libjpeg-dev libjpeg62 libjpeg62-turbo-dev libmcrypt4 libmcrypt-dev \
        libfreetype6-dev freetype2-demos \
        gnupg2 apt-transport-https \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install intl zip exif pdo pdo_mysql opcache \
    && docker-php-ext-install bcmath \
    && pecl install apcu && docker-php-ext-enable apcu \
    && apt purge -y zlib1g-dev libicu-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev \
    && apt autoremove -y

# base PHP configuration
COPY base-config.ini /usr/local/etc/php/conf.d/base-config.ini
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Speedup composer
USER www-data
RUN composer --version \
    && composer global require hirak/prestissimo

USER root
# Install xdebug for only dev
RUN apt-get update \
    && apt-get install -y git \
    && mkdir /src && cd /src && git clone https://github.com/xdebug/xdebug.git \
    && cd xdebug \
    && git checkout XDEBUG_2_6_0alpha1 \
    && sh ./rebuild.sh \
    && echo "[xdebug]" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# xdebug conf
RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.profiler_output_dir=/var/www/bamboo/profile" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

EXPOSE 9001
WORKDIR /var/www/android-academy
CMD ["php-fpm"]