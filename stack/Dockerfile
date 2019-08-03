FROM debian

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y apache2 \
       php7.3 \
       php7.3-cli \
       php7.3-xdebug \
       php7.3-xml \
       php7.3-bcmath \
       php7.3-common \
       php7.3-gd \
       php7.3-mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y wget git bzip2 zip gcc libtool patch autoconf make gnupg2 apt-utils



RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer


ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www

CMD /usr/sbin/apache2ctl -D FOREGROUND