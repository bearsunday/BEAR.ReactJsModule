<?php

namespace BEAR\ReactJsModule;

use BEAR\Resource\ResourceObject;

class FakeRo extends ResourceObject
{
    use ReduxSsr;
    
    public $body = ['hello' => ['message' => 'konichiwa']];
}