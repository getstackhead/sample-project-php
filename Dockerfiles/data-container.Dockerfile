FROM alpine:3.12

WORKDIR /var/www
VOLUME /var/www
COPY src .

CMD tail -f /dev/null
