FROM richarvey/nginx-php-fpm:php8.3

COPY . .

# Composer install
RUN composer install --no-dev --optimize-autoloader

## Node
RUN apk add --no-cache nodejs npm \
    && npm install \
    && npm run build

# Image config
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV APP_LOCALE ja
ENV APP_FALLBACK_LOCALE ja
ENV APP_FAKER_LOCALE ja_JP

# Session
ENV SESSION_LIFETIME 2440

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Grant execution to script
RUN chmod +x /var/www/html/scripts/00-laravel-deploy.sh

CMD ["/start.sh"]