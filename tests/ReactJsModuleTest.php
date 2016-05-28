<?php

namespace BEAR\ReactJsModule;

use BEAR\ReactJsModule\Annotation\ReduxSsrInject;
use BEAR\Resource\RenderInterface;
use Koriym\ReduxReactSsr\ReduxReactSsr;
use Ray\Di\Injector;

class ReactJsModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testModule()
    {
        $reactBundleJs = __DIR__ . '/Fake/react.bundle.js';
        $appBundleJs = __DIR__ . '/Fake/app.bundle.js';

        $injector = new Injector(new ReactJsModule($reactBundleJs, $appBundleJs));
        $renderer = $injector->getInstance(RenderInterface::class, ReduxSsrInject::class);
        $this->assertInstanceOf(ReduxServerSideRenderer::class, $renderer);
    }
}
