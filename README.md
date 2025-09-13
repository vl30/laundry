1. composer install --optimize-autoloader --no-dev
2. npm i
3. DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE= (sesuaikan)
DB_USERNAME= (sesuaikan)
DB_PASSWORD= (sesuaikan)
4. php artisan migrate --force
5. php artisan db:seed --force
6. npm run build
7. npm run dev
8. php artisan serve
