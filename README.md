### Proceed

Create a empty DB as `loop_it` and then run

```shell
cp .env.example .env && composer install && php artisan key:generate && php artisan jwt:secret && php artisan migrate
```
> Change && if you are not using bash to something appropriate 

This will seed 5 random users and 51 cars
You can log in by  

```json
{
    "email":"admin@gmail.com",
    "password":"123Qaw@!!9Io09ZZ"
}
```

All random users should have same email. 
You can also generate more using 

```shell
php artisan db:seed
```

### Remarks
- I have used JWT token for authentication.
- I have torn down MVC given by laravel and built up HMVC. It's custom, didn't use any packages. 
- Used Pipeline for filtering through car list.
- Every request is validated.
- Api rate limited for DDOS protection.
- Followed SOLID principle.
