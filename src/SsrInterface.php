<?php
declare(strict_types=1);

/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

interface SsrInterface
{
    /**
     * Server side Redux ReactJs rendering
     *
     * @param array $storeNames　　　name of keys `store`
     * @param string $rootContainer name of root container
     * @param string $domId         dom ID
     *
     * @return array [$markup, $script]
     */
    public function render(array $storeNames, string $rootContainer = 'App', string $domId = 'root') : array;

    /**
     * Get escaped resource body item
     *
     * @param string $name body key name
     *
     * @return string
     */
    public function escape(string $name) : string;

    /**
     * Get raw resource body item
     *
     * @param string $name body key name
     *
     * @return string
     */
    public function raw(string $name) : string;
}