# BEAR.ReactJsModule

**BEAR.ReactJsModule** is a `redux-react-ssr` which renders Redux React UI on the server-side support module for BEAR.Sunday.


## Prerequisites

 * php7
 * [V8Js](http://php.net/v8js)

## Install

### Composer Install

```
composer require bear/reactjs-module
```

### Redux React Application

You need two js bundled file. The one is an application bundled file `{app_name}.bundle.js` and react bundled js file `react.bundle.js`. 
For instance, you named application simply 'app'. You need `ssr_app.bundle.js` and `react.bundle.js`

### Module Install

```php
$baseDir = dirname(__DIR__, 2);
$this->install(new ReduxModule($baseDir, 'app');
```


### ResourceOjbect

Set `Redux Server Side Renderer` with named binding. The biding name format is `redux_{app_name}`.

```php

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class Greeting extends ResourceObject
{
    /**
     * @Inject
     * @Named("redux_app")
     */
    public function setRenderer(RenderInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function onGet()
    {
        $this->body = [
            'title' => 'Greeting',
            'hello' => ['message' => 'konichiwa']
        ];

        return $this;
    }
}

    
```

### Template

We need php template code. For exapmle, `Index.php` page resource needs `Index.html.php` template file.
You can get the value of body by `escape()` or `raw()`.

```php
<?php
use BEAR\ReactJsModule\Ssr;

/* @var $ssr Ssr */
list($markup, $script) = $ssr->render(['hello']);

return <<<"EOT"
<!doctype>
<html>
<head>
    <title>{$ssr->escape('title')}</title>
</head>
<body>
<div id="root">{$markup}</div>
<script src="build/react.bundle.js"></script>
<script src="build/ssr_app.bundle.js"></script>
<script>{$script}</script>
</body>
</html>
EOT;

```
