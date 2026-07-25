# Getting started

Install Elemento in a PHP 8.3 or newer project:

```bash
composer require orivex-x/elemento
```

Build elements through the `Elemento` facade. All element instances can be echoed or rendered explicitly.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Elemento\Elemento;

$navigation = Elemento::nav(['aria-label' => 'Primary navigation'])
    ->add(
        Elemento::ul()->add([
            Elemento::li()->add(Elemento::a('Home', '/')),
            Elemento::li()->add(Elemento::a('Account', '/account')),
        ])
    );

echo Elemento::main(['class' => 'container'])
    ->add($navigation)
    ->add(Elemento::h1('Hello, Elemento'))
    ->add(Elemento::p('Text content is escaped automatically.'));
```

Use typed helpers such as `input()`, `select()`, `table()`, `a()`, and `img()` where available. Use `element()` for a valid HTML element not exposed by the facade:

```php
echo Elemento::element('dialog', ['open' => true])
    ->add(Elemento::p('A dialog built with a generic element.'));
```

## Text, children, and attributes

`text()` replaces an element’s current content. `add()` appends an escaped string, an `Element`, or a `SafeHtml` instance. Invalid children throw `InvalidArgumentException` rather than being ignored.

```php
$card = Elemento::div(['class' => ['card', 'shadow']])
    ->id('profile')
    ->data('user-id', 42)
    ->addClass('is-active')
    ->add(Elemento::h2('Ada'))
    ->add('This text is escaped.');
```

`trustedHtml()` deliberately requires `SafeHtml`. It does not sanitize markup; only use it for an internally generated or independently sanitized fragment.
