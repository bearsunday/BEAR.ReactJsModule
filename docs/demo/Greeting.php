<?php

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class Greeting extends ResourceObject
{
    /**
     * @Inject
     * @Named("ssr_app")
     */
    public function setRenderer(RenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public $body = [
        'title' => 'Greeting',
        'hello' => ['message' => 'konichiwa']
    ];

    public function onGet()
    {
        return $this;
    }
}
