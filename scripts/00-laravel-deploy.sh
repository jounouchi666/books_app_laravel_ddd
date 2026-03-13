echo "Running deployment scripts..."

# migration & seeder
php artisan migrate::fresh --seed --force

# cache
php artisan config:cache
php artisan route:cache
php artisan view:cache