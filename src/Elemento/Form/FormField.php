<?php

namespace Elemento\Form;

use Elemento\Element;
use Elemento\Elements\{Input, Label, Textarea, Select};
use Elemento\Elemento;

class FormField
{
    private Element $fieldElement;
    private ?Element $label = null;
    private array $errors = [];
    private string $name;
    private string $type;
    private array $attributes;

    /**
     * @param string $type
     * @param string $name
     * @param array $attributes
     */
    public function __construct(string $type, string $name, array $attributes = [])
    {
        $this->type = $type;
        $this->name = $name;
        $this->attributes = array_merge(['name' => $name], $attributes);

        $this->createFieldElement();
    }

    /**
     * Create a field element
     *
     * @return void
     */
    private function createFieldElement(): void
    {
        $this->fieldElement = match ($this->type) {
            'textarea' => new Textarea($this->attributes),
            'select' => new Select($this->attributes),
            default => new Input($this->type, $this->attributes),
        };
    }

    /**
     * Set field label
     *
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function label(string $text, array $attributes = []): self
    {
        $labelAttrs = array_merge($attributes, ['for' => $this->name]);
        $this->label = new Label($text, $labelAttrs);

        return $this;
    }

    /**
     * Add validation error
     *
     * @param string $error
     * @return self
     */
    public function addError(string $error): self
    {
        $this->errors[] = $error;
        $this->fieldElement->addClass('is-invalid');

        return $this;
    }

    /**
     * Add multiple validation errors
     *
     * @param array $errors
     * @return self
     */
    public function addErrors(array $errors): self
    {
        foreach ($errors as $error) {
            $this->addError($error);
        }

        return $this;
    }

    /**
     * Set field value
     *
     * @param string|int|float|bool|null $value
     * @return self
     */
    public function value(string|int|float|bool|null $value = null): self
    {
        if ($this->type === 'select') {
            // For select, find and mark matching option
            $this->fieldElement->attr('data-selected', $value);
        } elseif ($this->type === 'textarea') {
            $this->fieldElement->text((string) $value);
        } elseif ($this->type === 'checkbox' || $this->type === 'radio') {
            if ($value) {
                $this->fieldElement->attr('checked', true);
            } else {
                $this->fieldElement->removeAttribute('checked');
            }
        } else {
            $this->fieldElement->attr('value', $value);
        }

        return $this;
    }

    /**
     * Mark as required
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required): self
    {
        $this->fieldElement->attr('required', $required);

        return $this;
    }

    /**
     * Add a placeholder
     *
     * @param string $placeholder
     * @return self
     */
    public function placeholder(string $placeholder): self
    {
        $this->fieldElement->attr('placeholder', $placeholder);

        return $this;
    }

    /**
     * Add help text
     *
     * @param string $text
     * @return self
     */
    public function help(string $text): self
    {
        $this->fieldElement->attr('data-help', $text);

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function attr(string $key, mixed $value): self
    {
        $this->fieldElement->attr($key, $value);

        return $this;
    }

    /**
     * Add CSS classes
     *
     * @param string ...$classes
     * @return $this
     */
    public function addClass(string ...$classes): self
    {
        foreach ($classes as $class) {
            $this->fieldElement->addClass($class);
        }

        return $this;
    }

    /**
     * Set options (for select fields)
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options): self
    {
        if ($this->type === 'select' && $this->fieldElement instanceof Select) {
            $this->fieldElement->options($options);
        }

        return $this;
    }

    /**
     * Check if a field has errors
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Get field errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get the form field element
     *
     * @return Element
     */
    public function getElement(): Element
    {
        return $this->fieldElement;
    }

    /**
     * Get the form field label element
     *
     * @return Element|null
     */
    public function getLabel(): ?Element
    {
        return $this->label;
    }

    /**
     * Render the complete field with label, input, and errors
     *
     * @param array $options
     * @return Element
     */
    public function render(array $options = []): Element
    {
        $wrapperClass = $options['wrapper_class'] ?? 'form-group';
        $errorClass = $options['error_class'] ?? 'invalid-feedback';
        $helpClass = $options['help_class'] ?? 'form-text text-muted';

        $wrapper = Elemento::div(['class' => $wrapperClass]);

        // Add label
        if ($this->label) {
            $wrapper->add($this->label);
        }

        // Add field
        $wrapper->add($this->fieldElement);

        // Add errors
        if ($this->hasErrors()) {
            $errorDiv = Elemento::div(['class' => $errorClass]);

            foreach ($this->errors as $error) {
                $errorDiv->add(Elemento::element('div')->text($error));
            }

            $wrapper->add($errorDiv);
        }

        // Add help text

        if ($this->fieldElement->hasAttribute('data-help')) {
            $wrapper->add(
                Elemento::div(['class' => $helpClass])
                    ->text(
                        $this->fieldElement->getAttribute('data-help')
                    )
            );
        }

        return $wrapper;
    }

    /**
     * Magic render
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render()->render();
    }
}
