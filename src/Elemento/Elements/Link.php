<?php

namespace Elemento\Elements;

use Elemento\Element;

class Link extends Element
{
    protected const TAG = 'link';

    /**
     * Create a link element.
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
     * @param string $href
     *
     * @return self
     */
    public function href(string $href): self
    {
        return $this->attr('href', $href);
    }
    /**
     * Configure the element.
     *
     * @param string $rel
     *
     * @return self
     */
    public function rel(string $rel): self
    {
        return $this->attr('rel', $rel);
    }
    /**
     * Configure the element.
     *
     * @param string $media
     *
     * @return self
     */
    public function media(string $media): self
    {
        return $this->attr('media', $media);
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
    /**
     * Configure the element.
     *
     * @param string $sizes
     *
     * @return self
     */
    public function sizes(string $sizes): self
    {
        return $this->attr('sizes', $sizes);
    }
}
