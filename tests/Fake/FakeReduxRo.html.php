<?php
/** @var $ssr ReduxSsrInterface */
use BEAR\ReactJsModule\Ssr;
use Koriym\ReduxReactSsr\ReduxSsrInterface;

/* @var $ssr Ssr */
list($markup, $script) = $ssr->render(['hello']);

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
<div id="root">{$markup}></div>
<script src="build/react.bundle.js"></script>
<script src="build/app.bundle.js"></script>
<script>{$script}</script>
</body>
</html>
EOD;
