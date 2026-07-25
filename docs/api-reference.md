# Complete API reference

This page covers the package subsystems that sit outside the standard element factories.

## `SafeHtml`

`SafeHtml` marks already trusted markup. It is intentionally explicit:

```php
use Elemento\Elemento;
use Elemento\SafeHtml;

$fragment = new SafeHtml('<svg aria-hidden="true"></svg>');
echo Elemento::span()->trustedHtml($fragment);
```

It performs no validation or sanitisation. Never wrap request data, database content, or third-party HTML unless it has been independently sanitised.

## `DataBinder`

`DataBinder` reads nested array/object data with dot notation and safely mutates arrays or `stdClass` instances. Mutation of arbitrary objects is rejected because it could create PHP dynamic properties.

```php
use Elemento\DataBinding\DataBinder;

$data = ['profile' => ['name' => 'Ada']];
$name = DataBinder::getValue($data, 'profile.name', 'Guest');
$exists = DataBinder::has($data, 'profile.name');

DataBinder::setValue($data, 'profile.name', 'Grace');
$object = DataBinder::hydrate(new stdClass(), ['name' => 'Ada']);
```

`bind()` converts arrays to an object for read access and returns an empty `stdClass` for scalar or null input.

## CSRF tokens

`CSRFToken` has `generate()`, `getToken()`, `hasToken()`, `verify()`, `refresh()`, `destroy()`, `setSessionKey()`, and `setTokenLength()` methods. Every token operation requires an already active PHP session:

```php
session_start();

use Elemento\Security\CSRFToken;

CSRFToken::setSessionKey('_app_csrf');
$token = CSRFToken::generate();
$isValid = CSRFToken::verify($_POST['_token'] ?? '');

if ($isValid) {
    CSRFToken::refresh();
}
```

The facade equivalents are `Elemento::csrf()`, `csrfField()`, and `verifyCsrf()`.

## Themes

`ThemeManager` stores the current `ThemeInterface`. The facade exposes `setTheme()`, `getTheme()`, `buttonThemed()`, `card()`, `alert()`, and `badge()`. `BootstrapTheme` additionally provides `buttonGroup()`, `progress()`, and `formGroup()`; `TailwindTheme` additionally provides `formGroup()` and `table()` when used directly.

## Macros

`MacroRegistry` provides `register()`, `call()`, `exists()`, `all()`, `remove()`, `clear()`, and `count()`. `Elemento::macro()` and dynamic facade calls are convenience wrappers. See the [macro guide](macros.md) for a complete example.

## Exceptions

`ElementoException` is an exception factory with helpers for `invalidTag()`, `missingField()`, `macroNotFound()`, `invalidTheme()`, `csrfVerificationFailed()`, and `invalidFormData()`. Applications may use these to produce consistent domain exceptions:

```php
use Elemento\Exceptions\ElementoException;

throw ElementoException::invalidFormData('The account number is required.');
```

Public APIs also use PHP standard exceptions where appropriate: `InvalidArgumentException` for invalid children, attributes, and unsupported bound form values; `RuntimeException` for CSRF calls without an active session; and `BadMethodCallException` for unknown facade macros.
