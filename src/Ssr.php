<?php
declare(strict_types=1);

/**
 * This file is part of the BEAR\ReactJsModule package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\ReactJsModule;

use BEAR\ReactJsModule\Exception\BodyKeyNotExistsException;
use BEAR\Resource\ResourceObject;
use Koriym\ReduxReactSsr\ReduxReactJs;

final class Ssr implements SsrInterface
{
    /**
     * @var array
     */
    public $body;

    /**
     * @var ResourceObject
     */
    private $ro;

    /**
     * @var ReduxReactJs
     */
    private $reduxReactJs;

    /**
     * @var string
     */
    private $name;

    /**
     * @param ResourceObject $ro           Resource object to render
     * @param ReduxReactJs   $reduxReactJs Server side Rnderer
     * @param string         $name         Redux ReactJs application name
     */
    public function __construct(ResourceObject $ro, ReduxReactJs $reduxReactJs, string $name)
    {
        $this->ro = $ro;
        $this->reduxReactJs = $reduxReactJs;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $storeNames, string $rootContainer = 'App', string $domId = 'root') : array
    {
        $body = $this->ro->body;
        $store = [];
        foreach ($storeNames as $storeName) {
            if (! isset($body[$storeName])) {
                throw new BodyKeyNotExistsException($storeName);
            }
            $store[$storeName] = $body[$storeName];
        }
        list($markup, $script) = $this->reduxReactJs->__invoke($rootContainer, $store, $domId);

        return [$markup, $script];
    }

    /**
     * {@inheritdoc}
     */
    public function escape(string $name) : string
    {
        $body = $this->ro->body;
        if (! isset($body[$name])) {
            throw new BodyKeyNotExistsException($name);
        }
        return htmlspecialchars($body[$name], ENT_QUOTES, 'UTF-8');
    }

    /**
     * {@inheritdoc}
     */
    public function raw(string $name) : string
    {
        $body = $this->ro->body;
        if (!isset($body[$name])) {
            throw new BodyKeyNotExistsException($name);
        }

        return $body[$name];
    }
}
