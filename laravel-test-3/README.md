# LARAVEL TEST 3

## Installation

```shell
composer install

cp .env.example .env

# Update DATABASE_* variables in .env

php artisan key:generate

php artisan serve
```

## Usage

Get all same files in 2 directories by using `FileService::getSameFiles($dir1, $dir2)`

```php
$dir1 = '/path/to/dir1';
$dir2 = '/path/to/dir2';

// If dir path is relative, it will be relative to base path of the project
$files = FileService::getSameFiles($dir1, $dir2);
dd($files);
```
