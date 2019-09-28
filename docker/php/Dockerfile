FROM matiux/php:7.3.6-fpm-alpine3.10-dev

USER root

RUN apk add --no-cache \
    openssh

COPY conf/xdebug-starter.sh /usr/local/bin/xdebug-starter
RUN chmod +x /usr/local/bin/xdebug-starter
RUN /usr/local/bin/xdebug-starter

COPY --chown=utente:utente ssh/* /home/utente/.ssh/
COPY --chown=utente:utente git/.gitconfig /home/utente/.gitconfig
RUN  chmod 600 /home/utente/.ssh/id_rsa

USER utente

RUN echo 'alias test="./vendor/bin/simple-phpunit"' >> /home/utente/.bashrc \
    && echo 'alias sfcc="rm -Rf var/cache/*"' >> /home/utente/.bashrc
