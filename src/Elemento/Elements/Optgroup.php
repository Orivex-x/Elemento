<?php

namespace Elemento\Elements;

use Elemento\Element;

class Optgroup extends Element
{
    protected const TAG = 'optgroup';

    /**
     * Create a optgroup element.
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
     * @param string $label
     *
     * @return self
     */
    public function label(string $label): self
    {
        return $this->attr('label', $label);
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
}
