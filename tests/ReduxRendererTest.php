<?php

namespace BEAR\ReactJsModule;

class ReduxRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testRender()
    {
        $reactBundleJs = file_get_contents(__DIR__ . '/Fake/react.bundle.js');
        $appBundleJs = file_get_contents(__DIR__ . '/Fake/app.bundle.js');
        $template = <<<EOT
<!DOCTYPE html>
<html>
  <head>
    <title>{{ title }}</title>
  </head>
  <body>
    <div id="root">{{ markup }}</div>
    <script>{{ js }}</script>
  </body>
</html>
EOT;
        $reduxRenderer = new ReduxRenderer(
            'app',
            $reactBundleJs,
            $appBundleJs
        );
        $ro = new FakeReduxRo;
        $ro->setRenderer($reduxRenderer);
        $result = (string) $ro;
        $expceted = <<<'EOT'
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
<script src="build/react.bundle.js"></script>
<script src="build/app.bundle.js"></script>
<script>ReactDOM.render(React.createElement(Provider,{store:configureStore({"hello":{"message":"konichiwa"}}) },React.createElement(App)),document.getElementById('root'));</script>
</body>
</html>
EOT;
        $this->assertSame($expceted, $result);
    }
}

