FROM php:5.6-cli

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    &&  apt-get update -qq \
    && apt-get install -qy --force-yes \
    git


# own gui
RUN mkdir /app
COPY ./app /app

# where to install shop
RUN mkdir /www

WORKDIR /app

EXPOSE 80

COPY ./entrypoint.sh /
ENTRYPOINT ["/entrypoint.sh"]