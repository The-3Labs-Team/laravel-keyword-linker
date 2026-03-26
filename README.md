# Laravel Keyword Linker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/the-3labs-team/laravel-keyword-linker.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-keyword-linker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Github PHPStan](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3Aphpstan+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/the-3labs-team/laravel-keyword-linker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/the-3labs-team/laravel-keyword-linker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
![License Mit](https://img.shields.io/github/license/murdercode/laravel-shortcode-plus)
[![Total Downloads](https://img.shields.io/packagist/dt/the-3labs-team/laravel-keyword-linker.svg?style=flat-square)](https://packagist.org/packages/the-3labs-team/laravel-keyword-linker)

This is a package that converts keywords into links.

## Requirements

| Package Version     | Requirement | Version             |
|---------------------|-------------|---------------------|
| 1.x.x               | PHP         | 8.1, 8.2, 8.3 or 8.4 |
| 1.x.x               | Laravel     | 10.x, 11.x or 12.x |

## Installation

You can install the package via composer:

```bash
composer require the-3labs-team/laravel-keyword-linker
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
    
    'query_tracking' => [
        'enabled' => false,
        'query_string' => 'tracking=kwlinker',
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

## Sponsor

<div>  
    <a href="https://www.tomshw.it/" target="_blank" rel="noopener noreferrer">
        <img  src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/toms.png" alt="Tom's Hardware - Notizie, recensioni, guide all'acquisto e approfondimenti per tutti gli appassionati di computer, smartphone, videogiochi, film, serie tv, gadget e non solo" />  
    </a>
    <a href="https://spaziogames.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/spazio.png" alt="Spaziogames - Tutto sul mondo dei videogiochi. Troverai tantissime anteprime, recensioni, notizie dei giochi per tutte le console, PC, iPhone e Android." />
    </a>
    <br/>
    <a href="https://cpop.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/cpop.png" alt="Cpop - News, recensioni, guide su fumetto, cinema & serie TV, gioco da tavolo e di ruolo e collezionismo. Tutto quello di cui hai bisogno per rimanere aggiornato sul mondo della cultura pop"/>
    </a>
    <a href="https://data4biz.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/d4b.png" alt="Data4Biz - Sito dedicato alla trasformazione digitale del business" />
    </a>
    <br/>
    <a href="https://soshomegarden.com/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/sos.png" alt="SOS Home & Garden - Realtà dedicata a 360 gradi ai settori della casa e del giardino." />
    </a>
    <a href="https://global.techradar.com/it-it" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/techradar.png" alt="Techradar - Le ultime notizie e recensioni dal mondo della tecnologia, su computer, sistemi per la casa, gadget e altro." />
    </a>
    <br/>
    <a href="https://aibay.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/aibay.png" alt="Aibay - Scopri AiBay, il leader delle notizie sull'intelligenza artificiale. Resta aggiornato sulle ultime innovazioni, ricerche e tendenze del mondo AI con approfondimenti, interviste esclusive e analisi dettagliate." />
    </a>
    <a href="https://coinlabs.it/" target="_blank" rel="noopener noreferrer" >
        <img src="https://3labs-assets.b-cdn.net/assets/logos/banner-github/coinlabs.png" alt="Coinlabs - Notizie, analisi approfondite, guide e opinioni aggiornate sul mondo delle criptovalute, blockchain e finanza" />
    </a>

</div>
