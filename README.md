# PHP SDK for kontor's API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/artistfy/kontor-php-sdk.svg?style=flat-square)](https://packagist.org/packages/artistfy/kontor-php-sdk)
[![Tests](https://img.shields.io/github/actions/workflow/status/artistfy/kontor-php-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/artistfy/kontor-php-sdk/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/artistfy/kontor-php-sdk.svg?style=flat-square)](https://packagist.org/packages/artistfy/kontor-php-sdk)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require artistfy/kontor-php-sdk
```

## Usage

```php
$kontor = new Kontor($username, $password);

$response = $konter
    ->send(new SearchAlbumRequest(productCode: 'XXXXXXXXXXXXXX')->sole());

$album = $response->dto();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Krishan Koenig](https://github.com/Artistfy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
