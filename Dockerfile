FROM firmaprofesional/code-challenge

RUN echo "ServerName challenge.firmaprofesional.com" >> /etc/apache2/apache2.conf

RUN apt-get update && apt-get install -y php-pgsql

COPY . /app/web/

WORKDIR /app/web/app

RUN composer install

WORKDIR /app/web

RUN ln -sf /dev/stdout /app/apache.access.log

RUN ln -sf /dev/stderr /app/apache.error.log

CMD apachectl -D FOREGROUND