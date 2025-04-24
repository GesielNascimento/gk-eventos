FROM php:8.2-cli

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_pgsql zip

# Copia o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto para o container
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Gera chave da aplicação
RUN php artisan key:generate

# Corrige permissões de pastas obrigatórias
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Limpa e gera cache de configs, rotas e views
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:clear && \
    php artisan route:cache && \
    php artisan view:clear && \
    php artisan view:cache

# Expõe a porta que o Laravel usará
EXPOSE 10000

# Inicia o servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
