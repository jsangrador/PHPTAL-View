Development of this fork has been moved to https://gitlab.com/jsangradorp/PHPTAL-View

## PHPTAL Renderer

This is a renderer for rendering PHPTAL view scripts into a PSR-7 Response object. It works well with Slim Framework 3.

## Installation

Install with [Composer](http://getcomposer.org):

    composer require jsangrador/PHPTAL-view

## Usage With Slim 3

```php
use Slim\Views\PhpTalRenderer;

include "vendor/autoload.php";

$app = new Slim\App();
$container = $app->getContainer();
$container['renderer'] = new PhpTalRenderer("./templates");

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->renderer->render($response, "/hello.html", $args);
});

$app->run();
```

## Usage with any PSR-7 Project
```php
//Construct the View
$phpView = new PhpTalRenderer("./path/to/templates");

//Render a Template
$response = $phpView->render(new Response(), "/path/to/template.html", $yourData);
```

## Exceptions
`\RuntimeException` - if template does not exist

`\InvalidArgumentException` - if $data contains 'template'
