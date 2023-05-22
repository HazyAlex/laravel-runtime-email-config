
# Laravel 10 - runtime email settings

- Run the default laravel bootstrap commands
- .env -> Set DB credentials / or the thing that will provide you with runtime values
- .env -> Set Mailtrap credentials / or set $config\["transport"\] to 'log' and look at laravel.log
- php artisan migrate (if you're using a DB)
- app/Jobs/SendEmailJob.php -> change the query to match your 'email_settings' table or any other config provider
- php artisan optimize (will cache the config, not necessary, it's just to show that it works with cache)
- Run: php artisan send:email (to look at the code: app/Console/Commands/SendEmailCommand)
- You should now change the DB entries and see that new emails have different origin names and addresses
