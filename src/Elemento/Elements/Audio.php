<?php

namespace Elemento\Elements;

use Elemento\Element;

class Audio extends Element
{
    protected const TAG = 'audio';

    /**
     * Create a audio element.
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
     * @param string $src
     *
     * @return self
     */
    public function src(string $src): self
    {
        return $this->attr('src', $src);
    }
    /**
     * Configure the element.
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function controls(bool $enabled = true): self
    {
        return $this->attr('controls', $enabled);
    }
    /**
     * Configure the element.
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function autoplay(bool $enabled = true): self
    {
        return $this->attr('autoplay', $enabled);
    }
    /**
     * Configure the element.
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function loop(bool $enabled = true): self
    {
        return $this->attr('loop', $enabled);
    }
    /**
     * Configure the element.
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function muted(bool $enabled = true): self
    {
        return $this->attr('muted', $enabled);
    }
    /**
     * Configure the element.
     *
     * @param string $value
     *
     * @return self
     */
    public function preload(string $value): self
    {
        return $this->attr('preload', $value);
    }
}
