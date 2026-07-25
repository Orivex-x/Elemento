<?php

namespace Elemento\Elements;

use Elemento\Element;

class Output extends Element
{
    protected const TAG = 'output';

    /**
     * Create a output element.
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
     * @param string $ids
     *
     * @return self
     */
    public function for(string $ids): self
    {
        return $this->attr('for', $ids);
    }
    /**
     * Configure the element.
     *
     * @param string $name
     *
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }
}
