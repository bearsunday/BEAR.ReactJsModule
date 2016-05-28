<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\Resource\RenderInterface;

trait ReduxSsr
{
    /**
     * Renderer
     *
     * @var \BEAR\Resource\RenderInterface
     */
    protected $renderer;

    /**
     * @param RenderInterface $renderer
     *
     * @\BEAR\ReactJsModule\Annotation\ReduxSsrInject
     */
    public function setRenderer(RenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }
}
