<?php
require VENDORPATH . 'autoload' . EXT;
use Slim\Views\PhpRenderer;
$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);
$container = $app->getContainer();
$container['view'] = new PhpRenderer(APPPATH . 'Views');
require APPPATH . 'HTTP/route' . EXT;
