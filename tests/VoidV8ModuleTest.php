<?php

namespace BEAR\ReactJsModule;

use Ray\Di\Injector;

class VoidV8ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testModule()
    {
        $uiPath = __DIR__ . '/Fake';
        $injector = new Injector(new VoidV8Module(new ReduxModule($uiPath, 'ssr_app')));
        $ro = $injector->getInstance(FakeReduxRo::class);
        $body = (string) $ro;
        $this->assertContains('<div id="root"></div>', $body);
    }
}
