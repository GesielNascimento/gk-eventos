#!/usr/bin/env bash

echo "🔧 Instalando dependências..."
composer install --no-dev --working-dir=/var/www/html

echo "🔑 Gerando chave da aplicação..."
php artisan key:generate --show

echo "⚙️ Cacheando configurações..."
php artisan config:cache

echo "🚦 Cacheando rotas..."
php artisan route:cache

echo "📦 Rodando migrações..."
php artisan migrate --force
