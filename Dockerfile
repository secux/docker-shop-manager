FROM php:5.6-cli

RUN mkdir /app;

COPY ./app /app

WORKDIR /app

VOLUME /shop-container

CMD [ "php", "-S", "localhost:80", "-t", "/app" ]