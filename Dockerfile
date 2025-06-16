FROM webdevops/php-apache:8.4

RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && \
    apt-get clean
    
RUN chown -R application:application /var/www/html