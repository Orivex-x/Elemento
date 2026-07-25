<?php

namespace Elemento\Elements;

use Elemento\Element;

class Option extends Element
{
    protected const TAG = 'option';

    /**
     * Create a option element.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(static::TAG, $attributes);
    }
    /**
     * Configure the element.
     *
     * @param mixed $value
     *
     * @return self
     */
    public function value(mixed $value): self
    {
        return $this->attr('value', $value);
    }
    /**
     * Configure the element.
     *
     * @param bool $selected
     *
     * @return self
     */
    public function selected(bool $selected = true): self
    {
        return $this->attr('selected', $selected);
    }
    /**
     * Configure the element.
     *
     * @param bool $disabled
     *
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }
    /**
     * Configure the element.
     *
     * @param string $label
     *
     * @return self
     */
    public function label(string $label): self
    {
        return $this->attr('label', $label);
    }
}
