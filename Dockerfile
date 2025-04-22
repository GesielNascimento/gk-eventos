# Imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala dependências do sistema e extensões do PHP necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    zip unzip libpq-dev git curl libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala o Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copia os arquivos do projeto para o container
COPY . /var/www/html

# Define o diretório raiz do Apache
WORKDIR /var/www/html

# Corrige permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Copia o arquivo de configuração personalizada do Apache
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Gera key e migra banco (opcional, melhor deixar em comando separado se quiser controle)
# RUN php artisan key:generate && php artisan migrate --force
