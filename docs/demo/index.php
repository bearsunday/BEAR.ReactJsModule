<?php

require __DIR__ . '/vendor/autoload.php';
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use BEAR\ReactJsModule\ReduxModule;
use BEAR\Resource\ResourceObject;
use Ray\Di\Injector;

$injector = new Injector(new ReduxModule(__DIR__ . '/build', 'app'));
$index = $injector->getInstance(Greeting::class);
/* @var $index ResourceObject */

echo $index;
