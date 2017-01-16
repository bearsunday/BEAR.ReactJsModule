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
<script src="build/react.bundle.js"></script>
<script src="build/app.bundle.js"></script>
<script>{$view->js}</script>
</body>
</html>
EOT;
