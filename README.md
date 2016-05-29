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

### Module Install

```php
$baseDir = dirname(dirname(__DIR__));
$reactLibSrc = $baseDir . '/var/www/build/react.bundle.js';
$reactAppSrc = $baseDir . '/var/www/build/app.bundle.js';
$this->install(new ReactJsModule($reactLibSrc, $reactAppSrc));
```

### Redux React Application

You need two js code. One is a [library](https://github.com/koriym/Koriym.ReduxReactSsr/blob/master/example/webpack.config.js#L7) ([react.js](https://github.com/koriym/Koriym.ReduxReactSsr/blob/master/example/common/react.js)) and the other one is [concatenated all custom code](https://github.com/koriym/Koriym.ReduxReactSsr/blob/master/example/webpack.config.js#L8)([app.js](https://github.com/koriym/Koriym.ReduxReactSsr/blob/master/example/common/app.js)). See [example](https://github.com/koriym/Koriym.ReduxReactSsr/tree/master/example) application code and [how to install](https://github.com/koriym/Koriym.ReduxReactSsr#run-example) it.

### ResourceOjbect

Use server-side renderer with `ReduxSsr `trait.

```php
use BEAR\ReactJsModule\ReduxSsr;
use BEAR\Resource\Annotation\Embed;
use BEAR\Resource\ResourceObject;

class Restx extends ResourceObject
{
    use ReduxSsr;

    public function onGet(string $id): ResourceObject
    {
      // set initial state to $body property
      // ...
        $this->body = [
            'user' => $userState,
            'entries' => $entriesState,
            'comments' => $commentState,
            'filter' => $filterState
        ];

        return $this;
    }
}
    
```

### Template

We need php template code. For exapmle, `Index.php` page resource needs `Index.html.php` template file.


```php
/** @var $ssr \BEAR\ReactJsModule\ReduxSsrInterface */
/** @var $ro  \BEAR\Resource\ResourceObject*/

$title = htmlspecialchars($ro->body['title'], ENT_QUOTES, 'UTF-8');
$state = ['hello'=> ['message' => 'Hello SSR !']];
list($html, $js) = $ssr('App', $state);

return <<<"EOD"
<!DOCTYPE html>
<html>
  <head>
    <title>Hello BEAR SSR</title>
  </head>
  <body>
    <!-- rendered markup -- >
    <div id="root">{$html}</div>

    <!-- init client -- >
    {$js}
    <script src="build/react.bundle.js"></script>
    <script src="build/client.bundle.js"></script>
  </body>
</html>
EOD;
```
