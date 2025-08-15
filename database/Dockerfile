# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto (excepto los excluidos en .dockerignore)
COPY . .

# Instala dependencias de Composer (sin scripts para evitar problemas)
RUN composer install --no-scripts --no-autoloader

# Copia el archivo .env.docker a .env
COPY .env.docker .env

# Genera el autoloader y ejecuta los scripts de post-instalación
RUN composer dump-autoload --optimize && composer run-script post-install-cmd

# Establece permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80