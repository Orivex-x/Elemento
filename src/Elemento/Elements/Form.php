<?php

namespace Elemento\Elements;

use Elemento\Element;

class Form extends Element
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('form', $attributes);
    }

    /**
     * Set form method
     *
     * @param string $method
     * @return self
     */
    public function method(string $method): self
    {
        return $this->attr('method', strtoupper($method));
    }

    /**
     * Get form method
     *
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->getAttribute('method');
    }

    /**
     * Set form action
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): self
    {
        return $this->attr('action', $action);
    }

    /**
     * Get form action
     *
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->getAttribute('action');
    }

    /**
     * Set form enctype
     *
     * @param string $enctype
     * @return self
     */
    public function enctype(string $enctype): self
    {
        return $this->attr('enctype', $enctype);
    }

    /**
     * Get form enctype
     *
     * @return string|null
     */
    public function getEnctype(): ?string
    {
        return $this->getAttribute('enctype');
    }

    /**
     * Set multipart form data (for file uploads)
     *
     * @return self
     */
    public function multipart(): self
    {
        return $this->enctype('multipart/form-data');
    }

    /**
     * Set accept-charset
     *
     * @param string $charset
     * @return self
     */
    public function acceptCharset(string $charset): self
    {
        return $this->attr('accept-charset', $charset);
    }

    /**
     * Set novalidate attribute
     *
     * @param bool $novalidate
     * @return self
     */
    public function novalidate(bool $novalidate = true): self
    {
        return $this->attr('novalidate', $novalidate);
    }

    /**
     * Set autocomplete
     *
     * @param string $autocomplete
     * @return self
     */
    public function autocomplete(string $autocomplete): self
    {
        return $this->attr('autocomplete', $autocomplete);
    }

    /**
     * Set the name attribute
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Set the target attribute
     *
     * @param string $target
     * @return self
     */
    public function target(string $target): self
    {
        return $this->attr('target', $target);
    }
}
