FROM php:8.2-apache

RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql intl \
    && a2enmod rewrite

COPY . /var/www/html

# Apuntar el DocumentRoot a /public, que es donde vive index.php y el
# .htaccess con las reglas de rewrite de CodeIgniter. Reemplazamos la
# directiva DocumentRoot completa en vez de depender de un sed que
# matchee texto exacto (eso fue lo que fallo antes).
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
