git fetch --all && git reset --hard 'origin/master'
composer install
php artisan migrate
php artisan cache:clear
php artisan config:cache