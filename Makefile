u:
	php artisan migrate:fresh --seed
	php artisan optimize:clear
	php artisan serve
migrate:
	php artisan migrate:fresh --seed
optimize:
	php artisan optimize:clear
	php artisan serve