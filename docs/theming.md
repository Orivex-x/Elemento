# Theming

Elemento includes Bootstrap and Tailwind theme implementations. The default is Bootstrap. Themes create elements; include the relevant CSS framework yourself.

```php
use Elemento\Elemento;
use Elemento\Theme\BootstrapTheme;

Elemento::setTheme(new BootstrapTheme());

echo Elemento::card('Account', 'Your profile is complete.');
echo Elemento::buttonThemed('Save', 'success');
echo Elemento::alert('Changes saved.', 'success');
```

Switch to Tailwind when your application supplies Tailwind’s generated CSS:

```php
use Elemento\Theme\TailwindTheme;

Elemento::setTheme(new TailwindTheme());

echo Elemento::badge('New', 'info');
echo Elemento::alert('Review required.', 'warning');
```

Implement `ThemeInterface` to provide an application-specific theme. Implement `button()`, `card()`, `alert()`, `badge()`, and `getName()`, then register it with `Elemento::setTheme()`.

When working directly with `BootstrapTheme`, use its `buttonGroup()`, `progress()`, and `formGroup()` helpers. `TailwindTheme` has direct `formGroup()` and `table()` helpers. `ThemeManager::reset()` restores the Bootstrap default.
