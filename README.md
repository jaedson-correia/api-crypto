## Api
Url: https://api-cryptoj.herokuapp.com/api

/coin/list
```md
Return name and id of coins
```
/coin/{id}/last-price
```md
{id} = coin id (you can get it with the above route
    
Return coin info(name,image,symbol), last price and price date time
```

/coin/{id}/price-by-datetime?dateTime={dateTime}
```md
{id} = coin id (you can get it with the above route
{dateTime} = date time
    
Return coin info(name,image,symbol) and the last price and price date time
```

## About the code

To make things more "realtime" I have opted to make use of broadcasting to pass updates on the price.
And to update the prices constantly, I've made a job, that is called in a laravel scheduler, also made a route for manual update to local tests.

## Local installation
Requirements:
- Git
- Composer
- PostgreSQL
- Pusher account

1. To clone the repository, just execute the following in a folder of your preference 
```md
git clone https://github.com/jaedson-correia/api-crypto
cd api-crypto
composer install
```
2. Configure your .env with your database and pusher settings
3. Run migration and seeder
```md
php artisan migrate --seed
```
4. In local, you can use a command to execute the laravel scheduler
```md
php artisan schedule:work
```
5. Done
