# Laravel Keyword Linker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/the-3labs-team/laravel-keyword-linker.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-keyword-linker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Github PHPStan](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3Aphpstan+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Maintainability](https://api.codeclimate.com/v1/badges/6ad969baa15a372e264e/maintainability)](https://codeclimate.com/github/The-3Labs-Team/laravel-keyword-linker/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/6ad969baa15a372e264e/test_coverage)](https://codeclimate.com/github/The-3Labs-Team/laravel-keyword-linker/test_coverage)
![License Mit](https://img.shields.io/github/license/murdercode/laravel-shortcode-plus)
[![Total Downloads](https://img.shields.io/packagist/dt/the-3labs-team/laravel-keyword-linker.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-keyword-linker)

This is a package that converts keywords into links.


## Installation

You can install the package via composer:

```bash
composer install the-3labs-team/keyword-linker
```

You can publish the config file with:

```bash
 php artisan vendor:publish --tag=keyword-linker-config    
```

This is the contents of the published config file:

```php

return [
    'limit-auto-keywords' => 5, // limit auto keywords to be linked
    'whitelist' => [
        'p',
        'blockquote',
    ],
];

```


## Usage

```php
use The3LabsTeam\KeywordLinker\Facades\KeywordLinker;

$content = "This is a test content";

$keywords = [
    'test' => 'https://example.com/test',
    // Usage: 'keyword' => 'link'
];

echo KeywordLinker::parse($content, $keywords);

# output: This is a <a href="http://example.com/test">test</a> content
```

### Common usage

Use rel attribute to add nofollow to the link

```php
$keywords = [
    'test' => [
        'link' => 'https://example.com/test',
        'rel' => 'nofollow'
    ],
    // Usage: 'keyword' => ['link' => 'link', 'rel' => 'nofollow']
];
```

Use target attribute to open the link in a new tab

```php
$keywords = [
    'test' => [
        'link' => 'https://example.com/test',
        'target' => '_blank'
    ],
    // Usage: 'keyword' => ['link' => 'link', 'target' => '_blank']
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [The-3Labs-Team](https://github.com/the-3labs-team)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
