FROM php:5.6-cli


RUN apt-get update -qq \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    && apt-get install -qy --force-yes \
    git

RUN apt-get -y install php5-mcrypt php5-gd unzip && \
rm -fr /var/cache/*

# own gui
RUN mkdir /app
COPY ./app /app

# where to install shop
RUN mkdir /www

# copy git auth (otherwise api rate limit during some installations!)
COPY ./config/git.auth.json /root/.composer/auth.json

WORKDIR /app

EXPOSE 80

COPY ./entrypoint.sh /
ENTRYPOINT ["/entrypoint.sh"]