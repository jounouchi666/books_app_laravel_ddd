echo "Running deployment scripts..."

# Grant execution to storage
chmod -R 777 storage bootstrap/cache

# migration & seeder
php artisan migrate:fresh --seed --force

# cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment scripts finished."