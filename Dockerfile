FROM firmaprofesional/code-challenge

RUN echo "ServerName challenge.firmaprofesional.com" >> /etc/apache2/apache2.conf

RUN apt-get update && apt-get install -y php-pgsql

WORKDIR /app/web

COPY ./app /app/web/

RUN composer install

RUN ln -sf /dev/stdout /app/apache.access.log

RUN ln -sf /dev/stderr /app/apache.error.log

CMD apachectl -D FOREGROUND