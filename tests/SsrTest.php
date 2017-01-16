<?php

namespace BEAR\ReactJsModule;

use BEAR\ReactJsModule\Exception\BodyKeyNotExistsException;
use Koriym\ReduxReactSsr\ExceptionHandler;
use Koriym\ReduxReactSsr\ReduxReactJs;

class SsrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ssr
     */
    private $ssr;

    public function setUp()
    {
        $this->ssr = new Ssr(
            new FakeReduxRo,
            new ReduxReactJs(
                file_get_contents(__DIR__ . '/Fake/react.bundle.js'),
                file_get_contents(__DIR__ . '/Fake/app.bundle.js'),
                new ExceptionHandler(),
                new \V8Js()
            ),
            'app'
        );
        parent::setUp();
    }

    public function testEscape()
    {
        $title = $this->ssr->escape('title');
        $this->assertSame('&quot;this_is_title&quot;', $title);
    }

    public function testEscapeNoKey()
    {
        $this->expectException(BodyKeyNotExistsException::class);
        $this->ssr->escape('__INVALID_KEY__');
    }

    public function testRaw()
    {
        $title = $this->ssr->raw('title');
        $this->assertSame('"this_is_title"', $title);
    }

    public function testRawNoKey()
    {
        $this->expectException(BodyKeyNotExistsException::class);
        $this->ssr->raw('__INVALID_KEY__');
    }
}
