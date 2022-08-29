Criar nome de classe em namespace com uma string
```php
        $controller =  "App\\Controllers\\{$controller}";
        $controller = new $controller;
        $controller->$action();
```
