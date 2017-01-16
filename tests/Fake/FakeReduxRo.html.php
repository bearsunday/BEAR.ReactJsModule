<?php
/** @var $ssr ReduxSsrInterface */
use BEAR\ReactJsModule\Ssr;
use Koriym\ReduxReactSsr\ReduxSsrInterface;

/* @var $ssr Ssr */
$view = $ssr->render(['hello']);

return <<<"EOD"
<!doctype>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
    <link rel="stylesheet" href="/build/style.css">
</head>
<body>
<div id="root">{$view->markup}></div>
<script src="build/react.bundle.js"></script>
<script src="build/app.bundle.js"></script>
<script>{$view->js}</script>
</body>
</html>
EOD;
