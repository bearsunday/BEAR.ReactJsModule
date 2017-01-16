<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;
use Koriym\ReduxReactSsr\ExceptionHandler;
use Koriym\ReduxReactSsr\ExceptionHandlerInterface;
use Koriym\ReduxReactSsr\ReduxReactJs;
use Koriym\ReduxReactSsr\ReduxReactJsInterface;
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
        $reduxReactJsname = "reactBundleSrc=react_bundle_src,appBundleSrc=app_bundle_src_{$this->name}";
        $this->bind(ReduxReactJsInterface::class)->annotatedWith($this->name)->toConstructor(ReduxReactJs::class, $reduxReactJsname);
        $reduxRendererName = "appName=redux_app_name_{$this->name},redux={$this->name}";
        $this->bind(RenderInterface::class)->annotatedWith($this->name)->toConstructor(ReduxRenderer::class, $reduxRendererName);
        $this->bind(ExceptionHandlerInterface::class)->to(ExceptionHandler::class);
        $this->bind(\V8Js::class)->toConstructor(\V8Js::class, 'object_name=v8js_object_name,variables=v8js_variables,extensions=v8js_extensions,snapshot_blob=v8js_snapshot_blob');
        $this->bind()->annotatedWith('v8js_object_name')->toInstance('');
        $this->bind()->annotatedWith('v8js_variables')->toInstance([]);
        $this->bind()->annotatedWith('v8js_extensions')->toInstance([]);
        $this->bind()->annotatedWith('v8js_snapshot_blob')->toInstance('');
    }
}
