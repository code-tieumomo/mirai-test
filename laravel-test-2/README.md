# LARAVEL TEST 2

## Installation

```shell
composer install

cp .env.example .env

# Update DATABASE_* variables in .env

php artisan key:generate

php artisan serve
```

## Usage

### API

#### Get seal info

```shell
curl --location --request GET 'http://localhost:8000/api/showSerialpaso' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "file": "42!6RbyELiwiGKBeNjWNfIGKoGsjFocc9EmnX!35fPA-k53mSW41TdHLDor0XR5fE7E7naXJoMOJ4Ky60V37Ff8",
    "app_env": "0",
    "contract_app": "0",
    "contract_server": "0"
}'
```

##### Success response

```json
{
    "success": true,
    "filename": "42!6RbyELiwiGKBeNjWNfIGKoGsjFocc9EmnX!35fPA-k53mSW41TdHLDor0XR5fE7E7naXJoMOJ4Ky60V37Ff8.html",
    "content": "<!doctype html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\"\n          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">\n    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">\n    <title>Document</title>\n</head>\n<body>\n    \n</body>\n</html>\n",
    "message": "Seal info response successfully"
}
```

##### Failed response

```json
{
    "success": false,
    "filename": "",
    "message": "Seal info response fail"
}
```
