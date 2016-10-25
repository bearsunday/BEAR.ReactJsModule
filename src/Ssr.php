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

final class Ssr
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

    public function __construct(ResourceObject $ro, ReduxReactJs $reduxReactJs, string $name)
    {
        $this->ro = $ro;
        $this->reduxReactJs = $reduxReactJs;
        $this->name = $name;
    }

    public function escape($name)
    {
        $body = $this->ro->body;
        if (! isset($body[$name])) {
            throw new BodyKeyNotExistsException($name);
        }
        return htmlspecialchars($body[$name], ENT_QUOTES, 'UTF-8');
    }

    public function raw($name)
    {
        $body = $this->ro->body;
        if (!isset($body[$name])) {
            throw new BodyKeyNotExistsException($name);
        }

        return $body[$name];
    }

    public function render(array $storeNames, $rootContainer = 'App', $domId = 'root')
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

}
