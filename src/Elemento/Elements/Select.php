<?php

namespace Elemento\Elements;

use Elemento\Element;

class Select extends Element
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('select', $attributes);
    }

    /**
     * Set the select elements name attribute
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }

    /**
     * Get the select elements name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    /**
     * Add an option to the select element
     *
     * @param mixed $value
     * @param string $text
     * @param bool $selected
     * @return $this
     */
    public function option(mixed $value, string $text, bool $selected = false): self
    {
        $option = new Option(['value' => $value]);

        if ($selected) {
            $option->attr('selected', true);
        }

        $option->text($text);

        return $this->add($option);
    }

    /**
     * Add multiple options to the select element
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options): self
    {
        foreach ($options as $value => $text) {
            $this->option($value, $text);
        }

        return $this;
    }

    /**
     * Add optgroup to the select element
     *
     * @param string $label
     * @param array $options
     * @return self
     */
    public function optgroup(string $label, array $options): self
    {
        $optgroup = new Optgroup(['label' => $label]);

        foreach ($options as $value => $text) {
            $optgroup->add(
                (new Option(['value' => $value]))->text($text)
            );
        }

        return $this->add($optgroup);
    }

    /**
     * Set the select elements multiple attribute
     *
     * @param bool $multiple
     * @return self
     */
    public function multiple(bool $multiple = true): self
    {
        return $this->attr('multiple', $multiple);
    }

    /**
     * Set the select elements required attribute
     *
     * @param bool $required
     * @return self
     */
    public function required(bool $required = true): self
    {
        return $this->attr('required', $required);
    }

    /**
     * Set the select elements disabled attribute
     *
     * @param bool $disabled
     * @return self
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->attr('disabled', $disabled);
    }

    /**
     * Set the select elements size attribute
     *
     * @param int $size
     * @return self
     */
    public function size(int $size): self
    {
        return $this->attr('size', $size);
    }

    /**
     * Set the select elements selected attribute
     *
     * @param mixed $value
     * @return self
     */
    public function selected(mixed $value): self
    {
        return $this->attr('data-selected', $value);
    }

    /**
     * Get the select elements selected value
     *
     * @return mixed
     */
    public function getSelected(): mixed
    {
        return $this->getAttribute('data-selected');
    }

    /**
     * Override render to handle the select elements selected state
     *
     * @return string
     */
    public function render(): string
    {
        $selectedValue = $this->getAttribute('data-selected');

        if ($selectedValue !== null) {
            $select = clone $this;
            $select->removeAttribute('data-selected');

            $select->applySelectedValue($select, (string) $selectedValue);

            return $select->render();
        }

        return parent::render();
    }

    /**
     * Apply the selected state to options, including options nested in optgroups.
     *
     * @param Element $element
     * @param string $selectedValue
     *
     * @return void
     */
    private function applySelectedValue(Element $element, string $selectedValue): void
    {
        foreach ($element->getChildren() as $child) {
            if (!$child instanceof Element) {
                continue;
            }

            if ($child->getTag() === 'option') {
                if ((string) $child->getAttribute('value') === $selectedValue) {
                    $child->attr('selected', true);
                } else {
                    $child->removeAttribute('selected');
                }
            }

            $this->applySelectedValue($child, $selectedValue);
        }
    }
}
