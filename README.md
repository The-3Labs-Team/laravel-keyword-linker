⚠️ Under development, please come back later

# Laravel Keyword Linker

This is a package that converts keywords into links.


## Installation

You can install the package via VCS, in your composer.json add:

```json
"the-3labs-team/laravel-keyword-linker": "dev-main"
    
"repositories": [
    
  {
    "type": "vcs",
    "url": "https://github.com/The-3Labs-Team/laravel-keyword-linker.git"
  }
    
]
```

[//]: # (You can publish and run the migrations with:)

[//]: # ()
[//]: # (```bash)

[//]: # (php artisan vendor:publish --tag="laravel-keyword-linker-migrations")

[//]: # (php artisan migrate)

[//]: # (```)


You can publish the config file with:

```bash
 php artisan vendor:publish --tag=keyword-linker-config    
```

This is the contents of the published config file:

```php

return [
    'limit-auto-keywords' => 5, // limit auto keywords to be linked
];

```


## Usage

```php
use The3LabsTeam\KeywordLinker\Facades\KeywordLinker;

$content = "This is a test content";

$keywords = [
    'test' => 'https://example.com/test',
    // 'keyword' => 'link'
];

echo KeywordLinker::parse($content, $keywords);

# output: This is a <a href="http://example.com/test">test</a> content
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
