<?php

namespace BEAR\ReactJsModule;

use Koriym\ReduxReactSsr\ReduxReactSsr;

class ReduxServerSideRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testRender()
    {
        $reactBundleJs = file_get_contents(__DIR__ . '/Fake/react.bundle.js');
        $appBundleJs = file_get_contents(__DIR__ . '/Fake/app.bundle.js');
        $ssr = new ReduxReactSsr($reactBundleJs, $appBundleJs);
        $renderer = new ReduxServerSideRenderer($ssr);
        $ro = new FakeRo;
        $ro->setRenderer($renderer);
        $result = (string) $ro;
        $expceted = <<< 'EOT'
<!doctype>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
    <link rel="stylesheet" href="/build/style.css">
</head>
<body>
<div id="root"><div data-reactroot="" data-reactid="1" data-react-checksum="2096181691"><div data-reactid="2"><h1 data-reactid="3">konichiwa</h1><button data-reactid="4">Click</button></div></div>></div>
<script>window.__PRELOADED_STATE__ = {"hello":{"message":"konichiwa"}};</script>

<script src="/build/restx.bundle.js"></script>
</body>
</html>
EOT;
        $this->assertSame($expceted, $result);
    }
}

