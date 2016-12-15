<?php

require dirname(__DIR__, 3) . '/vendor/autoload.php';
require dirname(__DIR__, 1) . '/vendor/autoload.php';

use BEAR\ReactJsModule\ReduxModule;
use Ray\Di\Injector;

$injector = new Injector(new ReduxModule(__DIR__ . '/build', 'ssr_app'));
$index = $injector->getInstance(Greeting::class);
/* @var $index Greeting */

echo $index;
