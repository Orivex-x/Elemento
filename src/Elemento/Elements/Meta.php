<?php

namespace Elemento\Elements;

use Elemento\Element;

class Meta extends Element
{
    protected const TAG = 'meta';

    /**
     * Create a meta element.
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
     * @param string $name
     *
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }
    /**
     * Configure the element.
     *
     * @param string $content
     *
     * @return self
     */
    public function content(string $content): self
    {
        return $this->attr('content', $content);
    }
    /**
     * Configure the element.
     *
     * @param string $charset
     *
     * @return self
     */
    public function charset(string $charset): self
    {
        return $this->attr('charset', $charset);
    }
    /**
     * Configure the element.
     *
     * @param string $value
     *
     * @return self
     */
    public function httpEquiv(string $value): self
    {
        return $this->attr('http-equiv', $value);
    }
}
