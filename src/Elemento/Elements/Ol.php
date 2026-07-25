<?php

namespace Elemento\Elements;

use Elemento\Element;

class Ol extends Element
{
    protected const TAG = 'ol';

    /**
     * Create a ol element.
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
     * @param int $start
     *
     * @return self
     */
    public function start(int $start): self
    {
        return $this->attr('start', $start);
    }
    /**
     * Configure the element.
     *
     * @param bool $reversed
     *
     * @return self
     */
    public function reversed(bool $reversed = true): self
    {
        return $this->attr('reversed', $reversed);
    }
    /**
     * Configure the element.
     *
     * @param string $type
     *
     * @return self
     */
    public function type(string $type): self
    {
        return $this->attr('type', $type);
    }
}
