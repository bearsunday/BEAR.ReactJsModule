<?php

use BEAR\ReactJsModule\Ssr;

/* @var $ssr Ssr */
$view = $ssr->render(['hello']);

return <<<"EOT"
<!doctype>
<html>
<head>
    <title>{$ssr->escape('title')}</title>
</head>
<body>
<div id="root">{$view->markup}</div>
<script>{$view->js}</script>
<script src="dist/react.bundle.js"></script>
<script src="dist/example.bundle.js"></script>
</body>
</html>
EOT;
