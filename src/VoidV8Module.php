<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\VoidV8Js;
use Ray\Di\AbstractModule;

class VoidV8Module extends AbstractModule
{
    public function __construct($module = null)
    {
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(\V8Js::class)->to(VoidV8Js::class);
    }
}
