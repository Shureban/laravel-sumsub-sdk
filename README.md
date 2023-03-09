# laravel-sumsub-sdk

Laravel middleware for automatically setting application locale based
on [HTTP "Accept-Language"](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Accept-Language) header

## Installation

Require this package with composer using the following command:

```bash
composer require shureban/laravel-sumsub-sdk
```

Add the following class to the `providers` array in `config/app.php`:

```php
Shureban\LaravelLocalization\LocalizationServiceProvider::class,
```

You can also publish the config file to change implementations (i.e. interface to specific class).

```shell
php artisan vendor:publish --provider="Shureban\LaravelLocalization\LocalizationServiceProvider"
```

## Usage

Register `\Shureban\LaravelLocalization\Localization::class` middleware in application's HTTP Kernel.

You can install it as global middleware in Kernel's `$middleware` property:

``` php
protected $middleware = [
    ...
    \Shureban\LaravelLocalization\Localization::class
];
```

You can install it to specific middleware groups in Kernel's `$middlewareGroups` property:

``` php
protected $middlewareGroups = [
    'web' => [
        ...
        \Shureban\LaravelLocalization\Localization::class
    ]
];
```

Or you can install is as route middleware in Kernel's `$routeMiddleware` and use it manually in routes:

Kernel:

``` php
protected $routeMiddleware = [
    ...
    'localization' => \Shureban\LaravelLocalization\Localization::class
];
```

Route file

``` php
Route::middleware(['localization'])->get('/', [AnyController::class, 'method']);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.