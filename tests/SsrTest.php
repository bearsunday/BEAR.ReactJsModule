<?php

namespace BEAR\ReactJsModule;

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
                file_get_contents(__DIR__ . '/Fake/app.bundle.js')
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
}
