<?php
declare(strict_types=1);

/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Koriym\ReduxReactSsr\ReduxReactJs;
use Ray\Aop\WeavedInterface;

final class ReduxRenderer implements RenderInterface
{
    /**
     * @var ReduxReactJs
     */
    private $redux;

    /**
     * @var string
     */
    private $appName;

    /**
     * ReduxRenderer constructor.
     *
     * @param string $appName        redux application name
     * @param string $reactBundleSrc redux-lib bundled source
     * @param string $appBundleSrc   redux-app bundled source
     */
    public function __construct(string $appName, string $reactBundleSrc, string $appBundleSrc)
    {
        $this->appName = $appName;
        $this->reactLibsrc = $reactBundleSrc;
        $this->reactAppSrc = $appBundleSrc;
        $this->redux = new ReduxReactJs($reactBundleSrc, $appBundleSrc);
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResourceObject $ro)
    {
        $ssr = new Ssr($ro, $this->redux, $this->appName);
        $file = $ro instanceof WeavedInterface ? (new \ReflectionClass($ro))->getParentClass()->getFileName() : (new \ReflectionClass($ro))->getFileName();
        $template = substr($file, 0, -4) . '.html.php';
        $ro->view = require $template;

        return $ro->view;
    }
}
