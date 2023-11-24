# LARAVEL TEST 1

## Installation

```shell
composer install

cp .env.example .env

# Update DATABASE_* variables in .env

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan serve
```

## Usage

### API

#### Get all accounts

```shell
curl --location --request GET 'http://127.0.0.1:8000/api/v1/accounts'
```

> Filter and sort using [Laravel Purity](https://abbasudo.github.io/laravel-purity/)
> Example: `http://127.0.0.1:8000/api/v1/accounts?filters[login][$eq]=john&sort=id:desc`

#### Get account by id

```shell
curl --location --request GET 'http://127.0.0.1:8000/api/v1/accounts/1'
```

#### Create account

```shell
curl --location 'http://localhost:8000/api/v1/accounts' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "login": "test",
    "password": "test",
    "phone": "0000"
}'
```

#### Update account

```shell
curl --location --request PUT 'http://localhost:8000/api/v1/accounts/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "login": "test2",
    "password": "test2",
    "phone": "0001"
}'
```

#### Delete account

```shell
curl --location --request DELETE 'http://localhost:8000/api/v1/accounts/1'
```
