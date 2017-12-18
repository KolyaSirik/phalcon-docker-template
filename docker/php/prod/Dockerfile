FROM php:7.1.9-fpm
WORKDIR /www
ARG USER_ID=0
ENV PARENT_USER ${USER_ID}
ENV PHALCON_VERSION 3.2.1

# Install developer dependencies
RUN set -xe \
    && apt-get update -yqq \
    && DEBIAN_FRONTEND=noninteractive apt-get install -yqq \
                            git \
                            libsqlite3-dev \
                            libxml2-dev \
                            libicu-dev \
                            libfreetype6-dev \
                            libmcrypt-dev \
                            libjpeg62-turbo-dev \
                            libpng12-dev \
                            libcurl4-gnutls-dev \
                            libbz2-dev \
                            libssl-dev \
                            mariadb-client \
   && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
   && docker-php-ext-install \
                             pdo_mysql \
                             opcache \
                             json \
                             calendar \
                             bcmath \
                             xml \
                             zip \
                             bz2 \
                             mbstring \
                             mcrypt \
                             curl \
                             gd \
                             phar \
                             intl \
   && apt-get -y install \
            libmagickwand-dev \
        --no-install-recommends \
   && pecl install imagick \
   && docker-php-ext-enable imagick \
   && rm -r /var/lib/apt/lists/* \
   && usermod -u 1000 www-data

RUN cd /tmp \
	&& curl -sSLO https://codeload.github.com/phalcon/cphalcon/tar.gz/v$PHALCON_VERSION \
	&& tar xvzf v$PHALCON_VERSION  \
	&& cd cphalcon-$PHALCON_VERSION/build \
	&& ./install \
	&& echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini \
	&& apt-get autoremove -y \
	&& apt-get autoclean -y \
	&& apt-get clean -y \
    && rm -rf \
    	/var/lib/apt/lists/* \
    	/tmp/* \
    	/var/tmp/* \
    	/etc/php5 \
    	/etc/php/5* \
    	/usr/lib/php/20121212 \
    	/usr/lib/php/20131226 \
    	/var/log \
    	/var/cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN touch /usr/local/var/log/php-fpm.log && chown $PARENT_USER:$PARENT_USER /usr/local/var/log/php-fpm.log
USER $PARENT_USER

CMD ["bash", "/deploy.sh"]