<?php

namespace Elemento\Elements;

use Elemento\Element;

class Button extends Element
{
    /**
     * @param string $text
     * @param array $attributes
     */
    public function __construct(string $text = '', array $attributes = [])
    {
        parent::__construct('button', $attributes);

        if ($text !== '') {
            $this->text($text);
        }
    }

    /**
     * Set the button type
     *
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        return $this->attr('type', $type);
    }

    /**
     * Get the button type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->getAttribute('type') ?? 'button';
    }

    /**
     * Set the button type to submit
     *
     * @return self
     */
    public function submit(): self
    {
        return $this->type('submit');
    }

    /**
     * Set the button type to reset
     *
     * @return self
     */
    public function reset(): self
    {
        return $this->type('reset');
    }

    /**
     * Set the button type to button
     *
     * @return self
     */
    public function button(): self
    {
        return $this->type('button');
    }

    /**
     * Set the button disabled state
     *
     * @param bool $disabled
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }

    /**
     * Set the button name
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Set the button value
     *
     * @param mixed $value
     * @return self
     */
    public function value(mixed $value): self
    {
        return $this->attr('value', $value);
    }

    /**
     * Set the button form attribute
     *
     * @param string $formId
     * @return self
     */
    public function form(string $formId): self
    {
        return $this->attr('form', $formId);
    }

    /**
     * Set the button formaction attribute
     *
     * @param string $action
     * @return self
     */
    public function formaction(string $action): self
    {
        return $this->attr('formaction', $action);
    }

    /**
     * Set the button formmethod attribute
     *
     * @param string $method
     * @return self
     */
    public function formmethod(string $method): self
    {
        return $this->attr('formmethod', $method);
    }

    /**
     * Set the button formnovalidate attribute
     *
     * @param bool $novalidate
     * @return self
     */
    public function formnovalidate(bool $novalidate = true): self
    {
        return $this->attr('formnovalidate', $novalidate);
    }
}
