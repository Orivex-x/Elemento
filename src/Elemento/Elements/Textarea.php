<?php

namespace Elemento\Elements;

use Elemento\Element;

class Textarea extends Element
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('textarea', $attributes);
    }

    /**
     * Set the textarea elements name
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Get the textarea elements name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    /**
     * Set the textarea elements placeholder
     *
     * @param string $placeholder
     * @return self
     */
    public function placeholder(string $placeholder): self
    {
        return $this->attr('placeholder', $placeholder);
    }

    /**
     * Set the textarea elements value (alias for text)
     *
     * @param string $value
     * @return self
     */
    public function value(string $value): self
    {
        return $this->text($value);
    }

    /**
     * Get the textarea elements value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->getText();
    }

    /**
     * Set the textarea elements rows
     *
     * @param int $rows
     * @return self
     */
    public function rows(int $rows): self
    {
        return $this->attr('rows', $rows);
    }

    /**
     * Set the textarea elements cols
     *
     * @param int $cols
     * @return self
     */
    public function cols(int $cols): self
    {
        return $this->attr('cols', $cols);
    }

    /**
     * Set the textarea elements required attribute
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true): self
    {
        return $this->attr('required', $required);
    }

    /**
     * Set the textarea elements disabled attribute
     *
     * @param bool $disabled
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }

    /**
     * Set the textarea elements readonly attribute
     *
     * @param bool $readonly
     * @return self
     */
    public function readonly(bool $readonly = true): self
    {
        return $this->attr('readonly', $readonly);
    }

    /**
     * Set the textarea elements minlength attribute
     *
     * @param int $minlength
     * @return self
     */
    public function minlength(int $minlength): self
    {
        return $this->attr('minlength', $minlength);
    }

    /**
     * Set the textarea elements maxlength attribute
     *
     * @param int $maxlength
     * @return self
     */
    public function maxlength(int $maxlength): self
    {
        return $this->attr('maxlength', $maxlength);
    }

    /**
     * Set the textarea elements wrap attribute
     *
     * @param string $wrap
     * @return self
     */
    public function wrap(string $wrap): self
    {
        return $this->attr('wrap', $wrap);
    }

    /**
     * Set the textarea elements spellcheck attribute
     *
     * @param bool $spellcheck
     * @return self
     */
    public function spellcheck(bool $spellcheck = false): self
    {
        return $this->attr('spellcheck', $spellcheck ? 'true' : 'false');
    }
}
