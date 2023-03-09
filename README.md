# laravel-sumsub-sdk

Laravel SDK which implement API routes for work with [Sumsub](https://sumsub.com)

## Installation

Require this package with composer using the following command:

```bash
composer require shureban/laravel-sumsub-sdk
```

Add the following class to the `providers` array in `config/app.php`:

```php
Shureban\LaravelSumsubSdk\SumsubServiceProvider::class,
```

You can also publish the config file to change implementations (i.e. interface to specific class).

```shell
php artisan vendor:publish --provider="Shureban\LaravelSumsubSdk\SumsubServiceProvider"
```

## Usage

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.