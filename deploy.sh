#!/bin/bash

# Clonación del repositorio
# git clone https://github.com//ecommerce.git

# Navegación al directorio del proyecto
# cd /home/fernand1/ecommerce

# Renombrado del archivo .env
mv .env.example .env

# Instalación de dependencias de Composer
composer install --prefer-dist --no-dev -o

# Ejecución de migraciones y seeds de Laravel
php artisan migrate && php artisan db:seed

# Optimización de la aplicación
php artisan optimize

# Mensaje de finalización
echo "Despliegue realizado con éxito!"
