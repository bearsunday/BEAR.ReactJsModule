<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;
use Ray\Di\AbstractModule;

class ReduxModule extends AbstractModule
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reactBundleSrc;

    /**
     * @var string
     */
    private $appBundleSrc;

    /**
     * @param string $buildPath
     * @param string $name
     */
    public function __construct(string $buildPath, string $name, AbstractModule $module = null)
    {
        $this->name = $name;
        $this->buildPath = $buildPath;
        $this->reactBundleSrc = file_get_contents("{$buildPath}/react.bundle.js");
        $this->appBundleSrc = file_get_contents("{$buildPath}/{$name}.bundle.js");
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind()->annotatedWith('react_bundle_src')->toInstance($this->reactBundleSrc);
        $this->bind()->annotatedWith('app_bundle_src_' . $this->name)->toInstance($this->appBundleSrc);
        $this->bind()->annotatedWith('redux_app_name_' . $this->name)->toInstance($this->name);
        $name = "appName=redux_app_name_{$this->name},reactBundleSrc=react_bundle_src,appBundleSrc=app_bundle_src_{$this->name}";
        $this->bind(RenderInterface::class)->annotatedWith('redux_' . $this->name)->toConstructor(ReduxRenderer::class, $name);
    }
}
