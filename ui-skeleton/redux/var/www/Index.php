<?php

use BEAR\ReactJsModule\ReduxModule;
use Ray\Di\Injector;
use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

require dirname(__DIR__, 4) . '/vendor/autoload.php';

class Index extends ResourceObject
{
    /**
     * @Inject
     * @Named("ssr_example")
     */
    public function setRenderer(RenderInterface $renderer)
    {
        parent::setRenderer($renderer);
    }

    public $body = [
        'title' => 'Greeting',
        'hello' => ['message' => 'Hello BEAR.Sunday']
    ];

    public function onGet()
    {
        return $this;
    }
}


$injector = new Injector(new ReduxModule(__DIR__ . '/dist', 'ssr_example'));
$index = $injector->getInstance(Index::class);
/* @var $index Index */

echo $index;
