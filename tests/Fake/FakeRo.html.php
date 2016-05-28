<?php
/** @var $ssr ReduxSsrInterface */

use Koriym\ReduxReactSsr\ReduxSsrInterface;

/** @var $ro  \BEAR\Resource\ResourceObject*/

list($html, $js) = $ssr('App', $ro->body);

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
<div id="root">{$html}></div>
{$js}
<script src="/build/restx.bundle.js"></script>
</body>
</html>
EOD;
