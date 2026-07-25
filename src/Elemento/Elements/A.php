<?php

namespace Elemento\Elements;

use Elemento\Element;

class A extends Element
{
    protected const TAG = 'a';

    /**
     * Create an anchor element.
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
     * Set the destination URL for the anchor.
     *
     * @param string $href Destination URL.
     *
     * @return self
     */
    public function href(string $href): self
    {
        return $this->attr('href', $href);
    }

    /**
     * Set the browsing context in which to open the link.
     *
     * @param string $target Target browsing context.
     *
     * @return self
     */
    public function target(string $target): self
    {
        return $this->attr('target', $target);
    }

    /**
     * Mark the linked resource for download, optionally with a filename.
     *
     * @param string $filename Suggested download filename.
     *
     * @return self
     */
    public function download(string $filename = ''): self
    {
        return $this->attr('download', $filename === '' ? true : $filename);
    }

    /**
     * Set the relationship between the current and linked documents.
     *
     * @param string $rel Space-separated link relationship values.
     *
     * @return self
     */
    public function rel(string $rel): self
    {
        return $this->attr('rel', $rel);
    }

    /**
     * Set the language of the linked resource.
     *
     * @param string $language BCP 47 language tag.
     *
     * @return self
     */
    public function hreflang(string $language): self
    {
        return $this->attr('hreflang', $language);
    }

    /**
     * Set the MIME type of the linked resource.
     *
     * @param string $type MIME type.
     *
     * @return self
     */
    public function type(string $type): self
    {
        return $this->attr('type', $type);
    }
}
