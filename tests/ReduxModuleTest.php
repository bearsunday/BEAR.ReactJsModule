<?php

namespace BEAR\ReactJsModule;

use Ray\Di\Injector;

class ReduxModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testModule()
    {
        $uiPath = __DIR__ . '/Fake';
        $injector = new Injector(new ReduxModule($uiPath, 'ssr_app'));
        $ro = $injector->getInstance(FakeReduxRo::class);
        $this->assertInstanceOf(ReduxRenderer::class, $ro->renderer);
    }
}
