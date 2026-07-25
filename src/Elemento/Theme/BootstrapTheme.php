<?php

namespace Elemento\Theme;

use Elemento\Elemento;
use Elemento\Element;

class BootstrapTheme implements ThemeInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Bootstrap';
    }

    /**
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function button(string $text, string $type = 'primary'): Element
    {
        return Elemento::button($text)->addClass('btn', "btn-$type");
    }

    /**
     * @param string $title
     * @param string $content
     * @return Element
     */
    public function card(string $title, string $content): Element
    {
        return (Elemento::div(['class' => 'card']))
            ->add(
                Elemento::div(['class' => 'card-header'])->add(Elemento::h5($title))
            )
            ->add(
                Elemento::div(['class' => 'card-body'])->add($content)
            );
    }

    /**
     * @param string $message
     * @param string $type
     * @return Element
     */
    public function alert(string $message, string $type = 'primary'): Element
    {
        return Elemento::div(['class' => "alert alert-$type", 'role' => 'alert'])
            ->text($message);
    }

    /**
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function badge(string $text, string $type = 'primary'): Element
    {
        return Elemento::element('span', ['class' => "badge bg-$type"])
            ->text($text);
    }

    /**
     * @param array $buttons
     * @param string $size
     * @return Element
     */
    public function buttonGroup(array $buttons, string $size = ''): Element
    {
        $group = Elemento::div(['class' => 'btn-group' . ($size ? " btn-group-$size" : '')]);

        foreach ($buttons as $text => $action) {
            if (is_array($action)) {
                $group->add(
                    $this->button($text, $action['type'] ?? 'primary')
                        ->attr('onclick', $action['onclick'] ?? '')
                );
            }
        }

        return $group;
    }

    /**
     * @param int $value
     * @param string $type
     * @return Element
     */
    public function progress(int $value, string $type = 'primary'): Element
    {
        return Elemento::div(['class' => 'progress'])
            ->add(
                Elemento::div(['class' => "progress-bar bg-$type", 'style' => 'width: ' . $value . '%'])
                    ->attr('role', 'progressbar')
                    ->attr('aria-valuenow', $value)
                    ->attr('aria-valuemin', 0)
                    ->attr('aria-valuemax', 100)
            );
    }

    /**
     * @param string $label
     * @param Element $field
     * @return Element
     */
    public function formGroup(string $label, Element $field): Element
    {
        return Elemento::div(['class' => 'form-group'])
            ->add(Elemento::label($label))
            ->add($field);
    }
}
