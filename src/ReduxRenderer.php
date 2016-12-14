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
use Koriym\ReduxReactSsr\ReduxReactJsInterface;
use Ray\Aop\WeavedInterface;

final class ReduxRenderer implements RenderInterface
{
    /**
     * @var ReduxReactJsInterface
     */
    private $redux;

    /**
     * @var string
     */
    private $appName;

    /**
     * @param string       $appName
     * @param ReduxReactJs $redux
     */
    public function __construct(string $appName, ReduxReactJsInterface $redux)
    {
        $this->appName = $appName;
        $this->redux = $redux;
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
