FROM php:5.6-cli

RUN mkdir /app

COPY ./app /app

WORKDIR /app

EXPOSE 80

VOLUME /data

COPY ./entrypoint.sh /
ENTRYPOINT ["/entrypoint.sh"]