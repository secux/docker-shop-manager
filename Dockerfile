FROM php:5.6-cli

RUN mkdir /app;

COPY ./app /app

WORKDIR /app

EXPOSE 80

VOLUME /data

ENTRYPOINT [ "php", "-S", "0.0.0.0:80", "-t", "/app" ]
#ENTRYPOINT ["sleep", "infinity"]