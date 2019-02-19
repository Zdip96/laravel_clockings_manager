# Instructions

1. `composer install`

2. `cp .env.example .env`

The next step assumes that you have xampp installed, started and created an empty db table named _laravel_clockings_manager_ in phpmyadmin.

3. In the .env file changes:
   1. `DB_DATABASE=homestead` to `DB_DATABASE=laravel_clockings_manager`
   2. `DB_USERNAME=homestead` to `DB_USERNAME=root`
   3. `DB_PASSWORD=secret` to `DB_PASSWORD=`
   
4. `php artisan key:generate`

5. `php artisan migrate`

6. `php artisan db:seed`

7. `php artisan serve`

8. And finally, in order to use the app you must first register and then you will be redirected to the dashboard.
