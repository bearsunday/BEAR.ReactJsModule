<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\ReactJsModule\Annotation\ReduxSsrInject;
use BEAR\Resource\RenderInterface;
use Koriym\ReduxReactSsr\ReduxReactSsr;
use Koriym\ReduxReactSsr\ReduxSsrInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class ReactJsModule extends AbstractModule
{
    /**
     * @var string
     */
    private $reactAppSrc;

    /**
     * @var string
     */
    private $reactLibsrc;

    /**
     * @param string $reactLibsrc
     * @param string $reactAppSrc
     */
    public function __construct($reactLibsrc, $reactAppSrc)
    {
        $this->reactLibsrc = $reactLibsrc;
        $this->reactAppSrc = $reactAppSrc;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind()->annotatedWith('reactBundleSrc')->toInstance(file_get_contents($this->reactAppSrc));
        $this->bind()->annotatedWith('appBundleSrc')->toInstance(file_get_contents($this->reactLibsrc));
        $this->bind(ReduxSsrInterface::class)->toConstructor(ReduxReactSsr::class, 'reactBundleSrc=reactBundleSrc,appBundleSrc=appBundleSrc');
        $this->bind(RenderInterface::class)->annotatedWith(ReduxSsrInject::class)->to(ReduxServerSideRenderer::class)->in(Scope::SINGLETON);
    }
}
