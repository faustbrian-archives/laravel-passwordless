# Laravel Passwordless

<p align="center"><img src="./banner.png" /></p>

[![Latest Version](https://badgen.net/packagist/v/konceiver/laravel-passwordless)](https://packagist.org/packages/konceiver/laravel-passwordless)
[![Software License](https://badgen.net/packagist/license/konceiver/laravel-passwordless)](https://packagist.org/packages/konceiver/laravel-passwordless)
[![Build Status](https://img.shields.io/github/workflow/status/konceiver/laravel-passwordless/run-tests?label=tests)](https://github.com/konceiver/laravel-passwordless/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Coverage Status](https://badgen.net/codeclimate/coverage/konceiver/laravel-passwordless)](https://codeclimate.com/github/konceiver/laravel-passwordless)
[![Quality Score](https://badgen.net/codeclimate/maintainability/konceiver/laravel-passwordless)](https://codeclimate.com/github/konceiver/laravel-passwordless)
[![Total Downloads](https://badgen.net/packagist/dt/konceiver/laravel-passwordless)](https://packagist.org/packages/konceiver/laravel-passwordless)

This package was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and provides an easy way of using passwordless logins like [Notion](https://notion.so).

## Installation

```bash
composer require konceiver/laravel-passwordless
```

### Register Service Provider

> The manual registration is currently required because `pushMiddlewareToGroup` seems to be ignored if autoloading is used. Register the service provider manually avoids the issue and removes the need for other manual registrations.

Open your `config/app.php` and add `PasswordlessServiceProvider::class` to the `providers` array like in the below example.

```php
<?php

return [

    'providers' => [

        // ...

        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

         \Konceiver\Passwordless\Providers\PasswordlessServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,

        // ...

    ],

];
```

## Usage

See our [extensive test suite](./tests/Unit) for usage example.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to security@konceiver.dev. All security vulnerabilities will be promptly addressed.

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## Support Us

We invest a lot of resources into creating and maintaining our packages. You can support us and the development through [GitHub Sponsors](https://github.com/sponsors/faustbrian).

## License

Passphrase is an open-sourced software licensed under the [MIT](LICENSE.md).
