FROM trafex/alpine-nginx-php7:1.8.0

COPY src /var/www

EXPOSE 8080