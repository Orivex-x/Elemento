<?php

namespace Elemento;

use Elemento\Attributes\AttributeManager;
use Elemento\Attributes\ClassManager;
use InvalidArgumentException;
use Stringable;

abstract class Element implements Stringable
{
    private const int ESCAPE_FLAGS = ENT_QUOTES | ENT_SUBSTITUTE;
    protected string $tag;
    protected AttributeManager $attributes;
    protected ClassManager $classes;
    protected array $children = [];
    protected string $content = '';
    protected ?string $textContent = null;
    protected array $selfClosingTags = [
        'img', 'input', 'br', 'hr', 'meta', 'link', 'area', 'base', 'col', 'embed', 'source', 'track', 'wbr'
    ];

    /**
     * @param string $tag
     * @param array $attributes
     */
    public function __construct(string $tag, array $attributes = [])
    {
        if (!preg_match('/^[A-Za-z][A-Za-z0-9:-]*$/', $tag)) {
            throw new InvalidArgumentException("Invalid HTML tag: $tag");
        }

        $this->tag = $tag;
        $this->attributes = new AttributeManager($attributes);
        $classes = $attributes['class'] ?? '';
        $this->classes = new ClassManager(is_array($classes) ? implode(' ', $classes) : (string) $classes);
    }

    /**
     * Set a single attribute
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function attr(string $key, mixed $value): self
    {
        $this->attributes->set($key, $value);

        if ($key === 'class') {
            $this->classes = new ClassManager(is_array($value) ? implode(' ', $value) : (string) $value);
        }

        return $this;
    }

    /**
     * Set multiple attributes at once
     *
     * @param array $attributes
     * @return $this
     */
    public function attrs(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->attr($key, $value);
        }

        return $this;
    }

    /**
     * Get an attribute value
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute(string $key): mixed
    {
        return $this->attributes->get($key);
    }

    /**
     * Check if an attribute exists
     *
     * @param string $key
     * @return bool
     */
    public function hasAttribute(string $key): bool
    {
        return $this->attributes->has($key);
    }

    /**
     * Remove an attribute
     *
     * @param string $key
     * @return $this
     */
    public function removeAttribute(string $key): self
    {
        $this->attributes->remove($key);

        if ($key === 'class') {
            $this->classes = new ClassManager();
        }

        return $this;
    }

    /**
     * Set element ID
     *
     * @param string $id
     * @return self
     */
    public function id(string $id): self
    {
        return $this->attr('id', $id);
    }

    /**
     * Add CSS classes
     *
     * @param string ...$classes
     * @return $this
     */
    public function addClass(string ...$classes): self
    {
        foreach ($classes as $class) {
            $this->classes->add($class);
        }

        $this->attributes->set('class', (string) $this->classes);

        return $this;
    }

    /**
     * Remove CSS classes
     *
     * @param string ...$classes
     * @return $this
     */
    public function removeClass(string ...$classes): self
    {
        foreach ($classes as $class) {
            $this->classes->remove($class);
        }

        $this->attributes->set('class', (string) $this->classes);

        return $this;
    }

    /**
     * Toggle CSS classes
     *
     * @param string $class
     * @return $this
     */
    public function toggleClass(string $class): self
    {
        $this->classes->toggle($class);
        $this->attributes->set('class', (string) $this->classes);

        return $this;
    }

    /**
     * Check if an element has a CSS class
     *
     * @param string $class
     * @return bool
     */
    public function hasClass(string $class): bool
    {
        return $this->classes->has($class);
    }

    /**
     * Get all CSS classes
     *
     * @return array
     */
    public function getClasses(): array
    {
        return $this->classes->all();
    }

    /**
     * Add data attribute
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function data(string $key, mixed $value): self
    {
        return $this->attr("data-$key", $value);
    }

    /**
     * Get data attribute value
     *
     * @param string $key
     * @return mixed
     */
    public function getData(string $key): mixed
    {
        return $this->getAttribute("data-$key");
    }

    /**
     * Add child element or text
     *
     * @param mixed $child
     * @return $this
     */
    public function add(mixed $child): self
    {
        if (is_array($child)) {
            foreach ($child as $item) {
                $this->add($item);
            }
        } else {
            $this->children[] = $this->normaliseChild($child);
        }

        return $this;
    }

    /**
     * Add a child element at a specific position
     *
     * @param int $position
     * @param $child
     * @return $this
     */
    public function addAt(int $position, $child): self
    {
        array_splice($this->children, $position, 0, [$this->normaliseChild($child)]);

        return $this;
    }

    /**
     * Replace a child element at position
     *
     * @param int $position
     * @param $child
     * @return $this
     */
    public function replaceChild(int $position, $child): self
    {
        if (isset($this->children[$position])) {
            $this->children[$position] = $this->normaliseChild($child);
        }

        return $this;
    }

    /**
     * Remove a child element at position
     *
     * @param int $position
     * @return $this
     */
    public function removeChild(int $position): self
    {
        unset($this->children[$position]);

        $this->children = array_values($this->children);

        return $this;
    }

    /**
     * Get all children elements
     *
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Clear all children elements
     *
     * @return $this
     */
    public function clearChildren(): self
    {
        $this->children = [];
        $this->content = '';
        $this->textContent = null;

        return $this;
    }

    /**
     * Convert an allowed child value to its safe rendered representation.
     *
     * @param mixed $child
     *
     * @return Element|SafeHtml|string
     */
    private function normaliseChild(mixed $child): Element|SafeHtml|string
    {
        if (is_string($child)) {
            return htmlspecialchars($child, self::ESCAPE_FLAGS, 'UTF-8');
        }

        if ($child instanceof Element || $child instanceof SafeHtml) {
            return $child;
        }

        throw new InvalidArgumentException('Children must be strings, Element instances, or SafeHtml instances.');
    }

    /**
     * Set text content (HTML-escaped, replaces children)
     *
     * @param string $text
     * @return $this
     */
    public function text(string $text): self
    {
        $this->content = htmlspecialchars($text, self::ESCAPE_FLAGS, 'UTF-8');
        $this->textContent = $text;
        $this->children = [];

        return $this;
    }

    /**
     * Get text content
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->textContent ?? '';
    }

    /**
     * Get the escaped text content used during rendering.
     *
     * @return string
     */
    public function getEscapedText(): string
    {
        return $this->content;
    }

    /**
     * Set explicitly trusted HTML content (not escaped, replaces children).
     *
     * Never pass unescaped user input to this method.
     *
     * @param SafeHtml $html
     * @return $this
     */
    public function trustedHtml(SafeHtml $html): self
    {
        $this->content = (string) $html;
        $this->textContent = null;
        $this->children = [];

        return $this;
    }

    /**
     * Append text to content (HTML-escaped)
     *
     * @param string $text
     * @return $this
     */
    public function appendText(string $text): self
    {
        $this->content .= htmlspecialchars($text, self::ESCAPE_FLAGS, 'UTF-8');

        if ($this->textContent !== null) {
            $this->textContent .= $text;
        }

        return $this;
    }

    /**
     * Get tag name
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Check if an element tag is self-closing
     *
     * @return bool
     */
    public function isSelfClosing(): bool
    {
        return in_array($this->tag, $this->selfClosingTags);
    }

    /**
     * Render the element to HTML string
     *
     * @return string
     */
    public function render(): string
    {
        $html = '<' . $this->tag;

        // Add attributes
        $html .= $this->attributes;

        // Self-closing tags
        if ($this->isSelfClosing()) {
            $html .= ' />';

            return $html;
        }

        // Add content
        $html .= '>';
        $html .= $this->content;
        $html .= implode('', $this->children);

        $html .= '</' . $this->tag . '>';

        return $html;
    }

    /**
     * Magic string conversion
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Clone an element with deep copy
     *
     * @return void
     */
    public function __clone()
    {
        $this->attributes = clone $this->attributes;
        $this->classes = clone $this->classes;

        // Deep clone children
        foreach ($this->children as $key => $child) {
            if ($child instanceof Element) {
                $this->children[$key] = clone $child;
            }
        }
    }
}
