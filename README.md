# Contact Management Web application
### Techs

- Laravel v8
- Bootstrap v5
- MySQL

## Installation


Clone the project in your computer and run the command:
```sh
composer install
```

After that, create a new copy of file ```.env.example``` and rename to ```.env```
Inside the file, change the lines about database config:
```sh
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
``` 

You need generate a new key inside ```.env``` file.
Run the command:
```sh 
php artisan key:generate
```

After the changes, run the next command:
```sh
php artisan migrate
```

After running the above command, run the next
```sh
php artisan db:seed
```

If everything performed as expected, run the command:
```sh
php artisan serve
```
This command will create a local server to run your Laravel application.

By default, a default user, login and password is created below:
```sh
E-mail: admin@mail.com
Password: password
```

Congrats and enjoy!!
