<?php

namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class FakeReduxRo extends ResourceObject
{
    public $renderer;

    /**
     * @Inject
     * @Named("redux_app")
     */
    public function setRenderer(RenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public $body = [
        'hello' => ['message' => 'konichiwa'],
        'title' => '"this_is_title"'
    ];
}
