<?php

namespace Elemento\Form;

use Elemento\DataBinding\DataBinder;
use Elemento\Elemento;
use Elemento\Elements\Form;
use InvalidArgumentException;

class FormBuilder
{
    private Form $form;
    private array $fields = [];
    private array $fieldOrder = [];
    private ?object $data = null;
    private array $errors = [];
    private ?string $csrfToken = null;
    private ?string $csrfTokenField = null;
    private ?string $methodOverride = null;
    private array $renderOptions;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->form = new Form($attributes);
        $this->renderOptions = [
            'wrapper_class' => 'form-group',
            'error_class' => 'invalid-feedback',
            'help_class' => 'form-text text-muted',
        ];
    }

    /**
     * Create FormBuilder using the POST method
     *
     * @param string $action
     * @param array $attributes
     * @return self
     */
    public static function post(string $action, array $attributes = []): self
    {
        $attributes['method'] = 'POST';
        $attributes['action'] = $action;

        return new self($attributes);
    }

    /**
     * Create FormBuilder using the GET method
     *
     * @param string $action
     * @param array $attributes
     * @return self
     */
    public static function get(string $action, array $attributes = []): self
    {
        $attributes['method'] = 'GET';
        $attributes['action'] = $action;

        return new self($attributes);
    }

    /**
     * Create FormBuilder using the PUT method
     *
     * @param string $action
     * @param array $attributes
     * @return self
     */
    public static function put(string $action, array $attributes = []): self
    {
        $attributes['method'] = 'POST';
        $attributes['action'] = $action;

        $builder = new self($attributes);
        $builder->methodOverride = 'PUT';

        return $builder;
    }

    /**
     * Create FormBuilder using the DELETE method
     *
     * @param string $action
     * @param array $attributes
     * @return self
     */
    public static function delete(string $action, array $attributes = []): self
    {
        $attributes['method'] = 'POST';
        $attributes['action'] = $action;

        $builder = new self($attributes);
        $builder->methodOverride = 'DELETE';

        return $builder;
    }

    /**
     * Perform the element operation.
     *
     * @param string $name
     * @param string $type
     * @param array $options
     * @return FormField
     */
    public function field(string $name, string $type = 'text', array $options = []): FormField
    {
        $field = new FormField($type, $name, $options['attributes'] ?? []);

        // Apply common options
        if (array_key_exists('label', $options)) {
            $field->label((string) $options['label']);
        }

        if (array_key_exists('placeholder', $options)) {
            $field->placeholder((string) $options['placeholder']);
        }

        if (array_key_exists('required', $options)) {
            $field->required((bool) $options['required']);
        }

        if (array_key_exists('help', $options)) {
            $field->help((string) $options['help']);
        }

        if ($type === 'select' && array_key_exists('options', $options)) {
            $field->options($options['options']);
        }

        if (array_key_exists('value', $options)) {
            $field->value($options['value']);
        }

        // Store field
        if (!isset($this->fields[$name])) {
            $this->fieldOrder[] = $name;
        }

        $this->fields[$name] = $field;

        return $field;
    }

    /**
     * Add multiple fields from a schema
     *
     * @param array $schema
     * @return $this
     */
    public function schema(array $schema): self
    {
        foreach ($schema as $name => $config) {
            $type = $config['type'] ?? 'text';
            unset($config['type']);

            $this->field($name, $type, $config);
        }

        return $this;
    }

    /**
     * Bind data to the form (populates values)
     *
     * @param mixed $data
     * @return $this
     */
    public function bindData(mixed $data): self
    {
        $this->data = DataBinder::bind($data);

        foreach ($this->fields as $name => $field) {
            $value = DataBinder::getValue($this->data, $name);

            if ($value !== null) {
                if (!is_string($value) && !is_int($value) && !is_float($value) && !is_bool($value)) {
                    throw new InvalidArgumentException(sprintf(
                        'The value bound to form field "%s" must be a string, int, float, bool, or null; %s given.',
                        $name,
                        get_debug_type($value)
                    ));
                }

                $field->value($value);
            }
        }

        return $this;
    }

    /**
     * Set form validation errors
     *
     * @param array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        foreach ($errors as $fieldName => $fieldErrors) {
            if (isset($this->fields[$fieldName])) {
                if (is_array($fieldErrors)) {
                    $this->fields[$fieldName]->addErrors($fieldErrors);
                } else {
                    $this->fields[$fieldName]->addError((string) $fieldErrors);
                }
            }
        }

        return $this;
    }

    /**
     * Add CSRF Token field
     *
     * @param string $token
     * @param string $fieldName
     * @return self
     */
    public function withCSRFToken(string $token, string $fieldName = '_token'): self
    {
        $this->csrfToken = $token;
        $this->csrfTokenField = $fieldName;

        return $this;
    }

    /**
     * Get form field by name
     *
     * @param string $name
     * @return FormField|null
     */
    public function getField(string $name): ?FormField
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * Get all form fields
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Check if a form field exists
     *
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool
    {
        return isset($this->fields[$name]);
    }

    /**
     * Remove a form field
     *
     * @param string $name
     * @return $this
     */
    public function removeField(string $name): self
    {
        unset($this->fields[$name]);
        $this->fieldOrder = array_filter($this->fieldOrder, fn ($field) => $field !== $name);

        return $this;
    }

    /**
     * Set render options
     *
     * @param array $options
     * @return $this
     */
    public function setRenderOptions(array $options): self
    {
        $this->renderOptions = array_merge($this->renderOptions, $options);

        return $this;
    }

    /**
     * Check if the form has errors
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Get all form errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Render the form
     *
     * @return string
     */
    public function render(): string
    {
        $form = clone $this->form;

        if ($this->methodOverride !== null) {
            $form->add(
                Elemento::input('hidden')
                    ->name('_method')
                    ->value($this->methodOverride)
            );
        }

        // Add CSRF token if provided
        if ($this->csrfToken !== null && $this->csrfTokenField !== null) {
            $form->add(
                Elemento::input('hidden')
                    ->name($this->csrfTokenField)
                    ->value($this->csrfToken)
            );
        }

        // Add fields in order
        foreach ($this->fieldOrder as $fieldName) {
            if (isset($this->fields[$fieldName])) {
                $field = $this->fields[$fieldName];
                $form->add($field->render($this->renderOptions));
            }
        }

        return $form->render();
    }

    /**
     * Magic render
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Get underlying form element
     *
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * Add a custom element to the form
     *
     * @param mixed $element
     * @return $this
     */
    public function add(mixed $element): self
    {
        $this->form->add($element);

        return $this;
    }
}
