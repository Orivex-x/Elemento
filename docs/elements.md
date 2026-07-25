# Elements and attributes

Every concrete class in `Elemento\Elements` extends `Elemento\Element` directly. Use the `Elemento` facade for its common helpers, or instantiate a specialised class when a helper is not present.

```php
use Elemento\Elemento;
use Elemento\Elements\Audio;
use Elemento\Elements\Details;
use Elemento\Elements\Summary;

$media = (new Audio())->src('/media/intro.mp3')->controls();
$details = (new Details())->open()->add([
    new Summary('More information'),
    Elemento::p('This uses a typed element class directly.'),
]);
```

## Common element operations

All elements support these fluent operations:

| Operation                                                                                 | Purpose                                                                |
|-------------------------------------------------------------------------------------------|------------------------------------------------------------------------|
| `attr()` / `attrs()`                                                                      | Set one or many attributes. `false` and `null` attributes are omitted. |
| `getAttribute()`, `hasAttribute()`, `removeAttribute()`                                   | Inspect or remove attributes.                                          |
| `id()`, `data()`, `getData()`                                                             | Work with `id` and `data-*` attributes.                                |
| `addClass()`, `removeClass()`, `toggleClass()`, `hasClass()`, `getClasses()`              | Manage classes without manual string concatenation.                    |
| `text()`, `appendText()`, `getText()`, `getEscapedText()`                                 | Safely set and inspect text.                                           |
| `trustedHtml()`                                                                           | Set deliberately trusted `SafeHtml`; never pass user input.            |
| `add()`, `addAt()`, `replaceChild()`, `removeChild()`, `clearChildren()`, `getChildren()` | Manage child elements and escaped string children.                     |
| `render()` / `(string) $element`                                                          | Produce HTML.                                                          |

Attribute names and generic tag names are validated. Attribute values and ordinary text are escaped. Boolean attributes render only when their value is `true`; array attribute values are space-separated.

```php
$message = Elemento::div(['class' => ['notice', 'notice--info']])
    ->id('welcome')
    ->data('dismissible', true)
    ->addClass('is-visible')
    ->add('Hello <Ada>');

// <div class="notice notice--info is-visible" id="welcome" data-dismissible="true">Hello &lt;Ada&gt;</div>
```

## Facade factories

The facade provides factories for forms (`form`, `input`, `button`, `select`, `textarea`, `fieldset`, `legend`, `label`), content (`div`, `p`, `span`, `h1`–`h6`, `a`, `img`), lists (`ul`, `ol`, `li`), tables (`table`, `thead`, `tbody`, `tfoot`, `tr`, `th`, `td`), and layout (`nav`, `section`, `article`, `header`, `footer`, `main`, `aside`, `br`, `hr`).

Use `Elemento::element('tag')` for valid custom or less-common tags, or instantiate the dedicated class below when it has convenience methods.

## Typed element catalogue

| Group                       | Classes                                                                                                                                         |
|-----------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------|
| Document and metadata       | `Html`, `Head`, `Body`, `Title`, `Base`, `Link`, `Meta`, `Style`, `Script`, `Noscript`                                                          |
| Structural content          | `Address`, `Article`, `Aside`, `Blockquote`, `Div`, `Footer`, `Header`, `Hgroup`, `Main`, `Nav`, `Search`, `Section`                            |
| Text and annotations        | `Abbr`, `Bdi`, `Bdo`, `Code`, `Data`, `Dfn`, `Ins`, `Del`, `P`, `Span`, `Time`                                                                  |
| Lists and disclosure        | `Dl`, `Dt`, `Dd`, `Menu`, `Ol`, `Ul`, `Li`, `Details`, `Summary`                                                                                |
| Images and embedded content | `Area`, `Audio`, `Canvas`, `Embed`, `Figure`, `Figcaption`, `Iframe`, `Img`, `Map`, `ObjectElement`, `Picture`, `Source`, `Track`, `Video`      |
| Tables                      | `Caption`, `Col`, `Colgroup`, `Table`, `Thead`, `Tbody`, `Tfoot`, `Tr`, `Th`, `Td`                                                              |
| Forms                       | `Button`, `Datalist`, `Fieldset`, `Form`, `Input`, `Label`, `Legend`, `Meter`, `Optgroup`, `Option`, `Output`, `Progress`, `Select`, `Textarea` |
| Web components and other    | `Dialog`, `Slot`, `Template`, `Wbr`, `Ruby`, `Rp`, `Rt`                                                                                         |

The specialised classes expose their corresponding HTML attributes - for example, `Img::alt()`, `A::href()`, `Input::min()`, `Select::option()`, `Video::controls()`, `Details::open()`, `Progress::value()`, and `Template::shadowRootMode()`.
