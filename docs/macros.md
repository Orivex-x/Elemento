# Macros

Macros add application-specific factories to the `Elemento` facade. Register a callable, then call it statically as if it were a built-in facade method.

```php
use Elemento\Elemento;

Elemento::macro('statusPill', static function (string $text, string $kind = 'neutral') {
    return Elemento::span($text)
        ->addClass('status-pill', "status-pill--{$kind}");
});

echo Elemento::statusPill('Active', 'success');
```

You can also call a macro explicitly when the name is dynamic:

```php
echo Elemento::callMacro('statusPill', ['Archived', 'muted']);
```

Macros are process-global. In long-running workers, register them during application bootstrap and avoid replacing macros at request time. Calling an unknown macro throws an exception.
