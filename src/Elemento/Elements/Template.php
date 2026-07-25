<?php

namespace Elemento\Elements;

use Elemento\Element;

class Template extends Element
{
    protected const TAG = 'template';

    /**
     * Create a template element.
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
     * @param string $mode
     *
     * @return self
     */
    public function shadowRootMode(string $mode): self
    {
        return $this->attr('shadowrootmode', $mode);
    }
}
