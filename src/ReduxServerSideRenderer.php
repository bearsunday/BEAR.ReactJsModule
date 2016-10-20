<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Koriym\ReduxReactSsr\ReduxSsrInterface;
use Ray\Aop\WeavedInterface;

/**
 * @deprecated
 */
final class ReduxServerSideRenderer implements RenderInterface
{
    /**
     * @var ReduxSsrInterface
     */
    private $ssr;

    public function __construct(ReduxSsrInterface $ssr)
    {
        $this->ssr = $ssr;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function render(ResourceObject $ro)
    {
        $file = $ro instanceof WeavedInterface ? (new \ReflectionClass($ro))->getParentClass()->getFileName() : (new \ReflectionClass($ro))->getFileName();
        $template = substr($file, 0, -4) . '.html.php';
        $ssr = $this->ssr;
        $ro->view = require $template;

        return $ro->view;
    }
}
