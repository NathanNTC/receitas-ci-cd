#!/bin/bash

echo "🚀 Atualizando sistema..."
sudo apt update && sudo apt upgrade -y

echo "📦 Instalando dependências básicas..."
sudo apt install git curl unzip zip -y

echo "🐘 Instalando PHP e extensões..."
sudo apt install php php-cli php-mbstring php-xml php-bcmath php-mysql php-curl php-zip -y

echo "📦 Instalando Apache (opcional para produção web)..."
sudo apt install apache2 -y

echo "📦 Instalando Composer..."
if ! command -v composer &> /dev/null
then
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

echo "📁 Criando diretório do projeto..."
sudo mkdir -p /var/www/receitas
sudo chown -R $USER:$USER /var/www/receitas

echo "📥 Clonando projeto..."
cd /var/www/receitas

if [ ! -d "receitas-ci-cd" ]; then
    git clone https://github.com/NathanNTC/receitas-ci-cd.git
fi

cd receitas-ci-cd

echo "🌿 Ajustando branches..."
git fetch --all

echo "📦 Instalando dependências do Laravel..."
composer install

echo "🔐 Criando .env se não existir..."
if [ ! -f .env ]; then
    cp .env.example .env
fi

echo "🔑 Gerando key do Laravel..."
php artisan key:generate

echo "🧱 Rodando migrations..."
php artisan migrate --force || true

echo "⚡ Cache do Laravel..."
php artisan config:cache
php artisan route:cache

echo "🚀 Iniciando servidor..."
echo "Use: php artisan serve --host=0.0.0.0 --port=8000"

echo "✅ Setup concluído!"