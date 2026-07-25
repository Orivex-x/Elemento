<?php

namespace Elemento\Elements;

use Elemento\Element;

class Label extends Element
{
    /**
     * @param string $text
     * @param array $attributes
     */
    public function __construct(string $text = '', array $attributes = [])
    {
        parent::__construct('label', $attributes);

        if ($text !== '') {
            $this->text($text);
        }
    }

    /**
     * Set the for attribute for the label element
     *
     * @param string $for
     * @return self
     */
    public function for(string $for): self
    {
        return $this->attr('for', $for);
    }

    /**
     * Get the labels for attribute value
     *
     * @return string|null
     */
    public function getFor(): ?string
    {
        return $this->getAttribute('for');
    }
}
