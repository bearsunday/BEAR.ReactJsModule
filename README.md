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

### JavaScript code

You need three js bundled file.
 
 * react.bundle.js React library bundled code
 * {app-name}.bundle.js Application bundled code for client side
 * {ssr-app-name}.bundle.js Application bundled code for server side 
 
You can include JavaScript client code (CSS, DOM ..) for `{app}.bundle.js` only. See more detail at the [example](https://github.com/bearsunday/BEAR.ReactJsModule/tree/1.x/docs/demo/ui/webpack.config.js#L7-L9).


### Module Install

```php
$distDir = dirname(__DIR__, 2) . '/var/www/dist';
$this->install(new ReduxModule($distDir, 'ssr_app');
```

In this canse, you need to place `ssr-app.bundle.js` at `$baseDir` directory.

### ResourceOjbect

To inject SSR renderer, Annotate `@Inject` with `@Named` annotation to `setRenderer` setter method
with `{ssr-app-name}` application name.


```php

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class Greeting extends ResourceObject
{
    /**
     * @Inject
     * @Named("ssr_app")
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

/* @var $ssr \BEAR\ReactJsModule\Ssr */
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
<script src="build/app.bundle.js"></script>
<script>{$script}</script>
</body>
</html>
EOT;

```
Note: `app.bundle.js` is client javascript code. The page is rendered fully even {$markup} is removed by client JS code.
