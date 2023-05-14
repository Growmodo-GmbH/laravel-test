#!/bin/sh
echo Running Initial Setup;

# PHP Composer
composer install;
composer dump-autoload;
php artisan migrate;
# php artisan websockets:serve;
php artisan queue:work;
php artisan optimize:clear;

# NODE NPM
npm install;
npm rebuild node-sass;
npm run dev;

echo Post Setup Complete;