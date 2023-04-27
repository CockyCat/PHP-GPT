# PHP-GPT - A PHP library base openai

## Directory structure

```
├── src
│   ├── OpenAPI
│   │   ├── Client.php
│   │  
│   ├── Exception
│   │   ├── OpenAIException.php
├── tests
│   ├── ClientTest.php
├── vendor
│   └── 
├── composer.json
└── 
```

## Dependency 

```bash
composer require guzzlehttp/guzzle:^7.0 league/oauth2-client:^2.6 phpunit/phpunit:^9.0
```


## Installation

```bash
composer require cockycat/php-gpt
```

## Usage

### Add Facade in Laravel/Lumen
Add an entry for the facade class in the aliases array in config/app.php, for example:
```php
'aliases' => [
    // ...
    'OpenAIClient' => App\\Facades\\OpenAIFacade::class,
],
```

### Call function in Laravel/Lumen
```php
use OpenAIClient;


$data = OpenAIClient::chat('/test', ['param1' => 'value1']);
```

