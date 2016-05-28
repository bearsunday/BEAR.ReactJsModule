<?php
/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule\Annotation;

use Ray\Di\Di\InjectInterface;
use Ray\Di\Di\Qualifier;

/**
 * @Annotation
 * @Target("METHOD")
 * @Qualifier
 */
final class ReduxSsrInject implements InjectInterface
{
    public $value;

    public function isOptional()
    {
        return false;
    }
}
