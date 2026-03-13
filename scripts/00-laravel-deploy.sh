echo "Running deployment scripts..."

# Grant execution
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# clear cache
php artisan config:clear

# migration & seeder
php artisan migrate:fresh --seed --force

# cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment scripts finished."