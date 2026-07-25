# Elemento

[![CI](https://github.com/orivex-x/Elemento/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/orivex-x/Elemento/actions/workflows/ci.yml)
[![Coverage snapshot](https://img.shields.io/badge/coverage%20snapshot-84.55%25-brightgreen)](#development)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.3-777BB4?logo=php&logoColor=white)](composer.json)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Elemento is a PHP 8.3+ HTML builder with typed element classes, fluent attributes, forms, themes, and macros.

## Who it’s for

Elemento is for PHP developers who prefer composing HTML in PHP over maintaining separate template files. It is especially useful for reusable UI components, server-rendered forms, emails, admin interfaces, and libraries that need to return safe, renderable HTML fragments.

It suits projects that want a small fluent API with automatic escaping and explicit trusted-HTML boundaries. It is not a full framework or client-side rendering solution; use it alongside your router, validation layer, CSS framework, and application templates.

## Where Elemento wins over hand-written HTML

Hand-written HTML is excellent - until it becomes a growing tangle of interpolated values, conditional attributes, repeated components, validation errors, and escaping decisions. Elemento lets PHP describe the structure of the page directly, while keeping the final output ordinary, portable HTML.

The same approach powers the polished `examples/login-form.php` demo: a server-rendered form is an object you can configure, bind, validate, render, and test - not a long string split between a controller and template:

```php
use Elemento\Elemento;

session_start();

$form = Elemento::postForm('/login')
    ->withCSRFToken(Elemento::csrf())
    ->setRenderOptions([
        'wrapper_class' => 'field',
        'error_class' => 'field-error',
    ]);

$form->field('email', 'email', [
    'label' => 'Email address',
    'placeholder' => 'you@example.test',
    'required' => true,
]);

$form->field('password', 'password', [
    'label' => 'Password',
    'required' => true,
]);

$form->bindData(['email' => 'ada@example.test'])
    ->setErrors(['password' => ['Your email or password is incorrect.']])
    ->add(Elemento::button('Sign in securely')->submit()->addClass('submit-button'));

echo $form;
```

| When your HTML needs...       | Elemento gives you...                                                                                               |
|-------------------------------|---------------------------------------------------------------------------------------------------------------------|
| Runtime text and attributes   | Escaping by default, including malformed UTF-8 handling, so safe output is the normal path.                         |
| Repeated UI patterns          | Composable `Element` objects you can return from methods, pass into components, clone, and reuse.                   |
| Optional state                | Fluent classes, boolean attributes, `data-*` values, and child manipulation instead of error-prone string branches. |
| Serious server-rendered forms | Consistent labels, values, errors, select matching, CSRF fields, and PUT/DELETE method spoofing.                    |
| Confidence during refactors   | Deterministic rendered HTML that PHPUnit can assert without a browser or DOM snapshot tool.                         |

The result is not a proprietary runtime or a client-side framework. It is clean HTML that works in an email, a traditional PHP page, a CMS integration, or a response from your own library - just produced with the same clarity and discipline as the rest of your PHP.

For a mostly static page with little dynamic content, plain HTML or an existing template engine may still be the simpler choice. Elemento shines when PHP is already responsible for assembling the interface.

```bash
composer require orivex-x/elemento
```

```php
use Elemento\Elemento;
use Elemento\Theme\BootstrapTheme;

Elemento::setTheme(new BootstrapTheme());

$overview = Elemento::div(['class' => 'row g-4'])->add([
    Elemento::div(['class' => 'col-md-4'])->add(
        Elemento::card('Monthly revenue', '£12,480 · ↑ 18.2%')
    ),
    Elemento::div(['class' => 'col-md-4'])->add(
        Elemento::card('Active teams', '284 · ↑ 12 this week')
    ),
    Elemento::div(['class' => 'col-md-4'])->add(
        Elemento::card('Uptime', '99.99% · All systems normal')
    ),
]);

echo $overview;
```

## Safety

Text and attribute values are escaped with `ENT_QUOTES | ENT_SUBSTITUTE`. Child text added with `add()` is escaped too. To deliberately render a known-safe fragment, create a `SafeHtml` value explicitly:

```php
use Elemento\SafeHtml;

echo Elemento::div()->trustedHtml(new SafeHtml('<strong>Verified markup</strong>'));
```

`SafeHtml` is a trust marker, not a sanitizer. Never construct it from request data or other untrusted input.

## Guides

- [Getting started](docs/getting-started.md)
- [Element and attribute reference](docs/elements.md)
- [Form builder and CSRF](docs/form-builder.md)
- [Themes](docs/theming.md)
- [Macros](docs/macros.md)
- [Complete API reference](docs/api-reference.md)

## Examples

The runnable examples in [examples/](examples) cover login forms, a dashboard, an admin panel, reusable components, and an email-friendly layout. Run one from the project root after installing dependencies:

```bash
php -S localhost:8000 -t examples
```

Then visit the corresponding example file, such as `http://localhost:8000/login-form.php`.

Elemento is released under the [MIT license](LICENSE).
