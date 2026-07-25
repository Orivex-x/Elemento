<?php

namespace Elemento\Elements;

use Elemento\Element;

class Style extends Element
{
    protected const TAG = 'style';

    /**
     * Create a style element.
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
     * @param string $nonce
     *
     * @return self
     */
    public function nonce(string $nonce): self
    {
        return $this->attr('nonce', $nonce);
    }
}
