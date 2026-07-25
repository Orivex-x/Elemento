<?php

namespace Elemento\Elements;

use Elemento\Element;

class Fieldset extends Element
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('fieldset', $attributes);
    }

    /**
     * Set the fieldset disabled attribute
     *
     * @param bool $disabled
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }

    /**
     * Set the fieldset name attribute
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Set the fieldset form attribute
     *
     * @param string $formId
     * @return self
     */
    public function form(string $formId): self
    {
        return $this->attr('form', $formId);
    }
}
