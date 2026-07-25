# Forms and CSRF

`FormBuilder` renders labels, fields, help text, validation errors, and CSRF or method-override hidden fields.

```php
use Elemento\Elemento;

$form = Elemento::postForm('/register')
    ->withCSRFToken(Elemento::csrf());

$form->field('email', 'email', [
        'label' => 'Email address',
        'placeholder' => 'you@example.test',
        'required' => true,
        'help' => 'We never share your address.',
]);

$form->field('plan', 'select', [
    'label' => 'Plan',
    'options' => ['free' => 'Free', 'pro' => 'Pro'],
    'value' => 'pro',
]);

echo $form;
```

Create builders with `createForm()`, `postForm()`, `getForm()`, `putForm()`, or `deleteForm()`. A `FormBuilder` also supports `schema()`, `field()`, `add()`, `bindData()`, `setErrors()`, `setRenderOptions()`, `getField()`, `getFields()`, `hasField()`, `removeField()`, `hasErrors()`, `getErrors()`, `getForm()`, and `render()`.

`field()` accepts `attributes`, `label`, `placeholder`, `required`, `help`, `options` (for selects), and `value`. Defining a name again replaces that field without moving or duplicating its render position.

Start the PHP session before any output when using `Elemento::csrf()`, `csrfField()`, or `CSRFToken` directly. Elemento never starts a session for an application.

```php
session_start();

$token = Elemento::csrf();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Elemento::verifyCsrf($_POST['_token'] ?? '')) {
    // Process the form.
}
```

Use `putForm()` and `deleteForm()` for HTTP method spoofing. They render a POST form and add the conventional `_method` field.

```php
echo Elemento::deleteForm('/articles/42')
    ->withCSRFToken(Elemento::csrf())
    ->add(Elemento::button('Delete')->attr('type', 'submit'));
```

`bindData()` accepts string, integer, float, and boolean values for fields. Array and object values are rejected to avoid accidentally serialising complex request data into HTML fields. Apply errors after defining fields:

```php
$form->bindData(['email' => 'ada@example.test'])
    ->setErrors(['email' => ['This address is already registered.']]);
```

For direct field control, `FormField` provides `label()`, `value()`, `required()`, `placeholder()`, `help()`, `attr()`, `addClass()`, `options()`, `addError()`, `addErrors()`, and accessors for its field, label, and errors. Checkboxes and radio fields clear `checked` when their value becomes false.

`Select::option()`, `options()`, `optgroup()`, and `selected()` build select controls. Selection compares canonical string values and recurses into optgroups. `textarea` values become escaped text content rather than an HTML attribute.
