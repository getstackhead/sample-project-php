FROM alpine:latest

WORKDIR /var/www
VOLUME /var/www
COPY src .

CMD tail -f /dev/null
