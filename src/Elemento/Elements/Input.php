<?php

namespace Elemento\Elements;

use Elemento\Element;

class Input extends Element
{
    /**
     * @param string $type
     * @param array $attributes
     */
    public function __construct(string $type = 'text', array $attributes = [])
    {
        $attributes['type'] = $type;

        parent::__construct('input', $attributes);
    }

    /**
     * Set input name
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Get input name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    /**
     * Set the input placeholder
     *
     * @param string $placeholder
     * @return self
     */
    public function placeholder(string $placeholder): self
    {
        return $this->attr('placeholder', $placeholder);
    }

    /**
     * Set input value
     *
     * @param mixed $value
     * @return self
     */
    public function value(mixed $value): self
    {
        return $this->attr('value', $value);
    }

    /**
     * Get the input value
     *
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->getAttribute('value');
    }

    /**
     * Set the inputs required attribute
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true): self
    {
        return $this->attr('required', $required);
    }

    /**
     * Set the inputs disabled attribute
     *
     * @param bool $disabled
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }

    /**
     * Set the inputs readonly attribute
     *
     * @param bool $readonly
     * @return self
     */
    public function readonly(bool $readonly = true): self
    {
        return $this->attr('readonly', $readonly);
    }

    /**
     * Set the input min attribute
     *
     * @param int|float $min
     * @return self
     */
    public function min(int|float $min): self
    {
        return $this->attr('min', (string) $min);
    }

    /**
     * Set the input max attribute
     *
     * @param int|float $max
     * @return self
     */
    public function max(int|float $max): self
    {
        return $this->attr('max', (string) $max);
    }

    /**
     * Set the input step attribute
     *
     * @param int|float $step
     * @return self
     */
    public function step(int|float $step): self
    {
        return $this->attr('step', (string) $step);
    }

    /**
     * Set the input pattern attribute
     *
     * @param string $pattern
     * @return self
     */
    public function pattern(string $pattern): self
    {
        return $this->attr('pattern', $pattern);
    }

    /**
     * Set the input autocomplete attribute
     *
     * @param string $autocomplete
     * @return self
     */
    public function autocomplete(string $autocomplete): self
    {
        return $this->attr('autocomplete', $autocomplete);
    }

    /**
     * Set the input minlength attribute
     *
     * @param int $minlength
     * @return self
     */
    public function minlength(int $minlength): self
    {
        return $this->attr('minlength', $minlength);
    }

    /**
     * Set the input maxlength attribute
     *
     * @param int $maxlength
     * @return self
     */
    public function maxlength(int $maxlength): self
    {
        return $this->attr('maxlength', $maxlength);
    }

    /**
     * Set the input checked attribute (for checkbox/radio)
     *
     * @param bool $checked
     * @return self
     */
    public function checked(bool $checked = true): self
    {
        return $this->attr('checked', $checked);
    }

    /**
     * Set the input accept attribute (for file input)
     *
     * @param string $accept
     * @return self
     */
    public function accept(string $accept): self
    {
        return $this->attr('accept', $accept);
    }

    /**
     * Set the input multiple attribute (for file input)
     *
     * @param bool $multiple
     * @return self
     */
    public function multiple(bool $multiple = true): self
    {
        return $this->attr('multiple', $multiple);
    }

    /**
     * Set the input title
     *
     * @param string $title
     * @return self
     */
    public function title(string $title): self
    {
        return $this->attr('title', $title);
    }

    /**
     * Get the input type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->getAttribute('type') ?? 'text';
    }
}
