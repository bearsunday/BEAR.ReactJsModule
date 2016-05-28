<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(E_ALL);

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);
