<?php

namespace Elemento\Theme;

use Elemento\Elemento;
use Elemento\Element;

class TailwindTheme implements ThemeInterface
{
    private array $colors = [
        'primary' => 'bg-blue-500 hover:bg-blue-600',
        'secondary' => 'bg-gray-500 hover:bg-gray-600',
        'success' => 'bg-green-500 hover:bg-green-600',
        'danger' => 'bg-red-500 hover:bg-red-600',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600',
        'info' => 'bg-cyan-500 hover:bg-cyan-600',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Tailwind';
    }

    /**
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function button(string $text, string $type = 'primary'): Element
    {
        $colorClass = $this->colors[$type] ?? $this->colors['primary'];

        return Elemento::button($text)
            ->addClass('px-4 py-2 rounded text-white font-semibold transition', $colorClass);
    }

    /**
     * @param string $title
     * @param string $content
     * @return Element
     */
    public function card(string $title, string $content): Element
    {
        return Elemento::div(['class' => 'bg-white rounded-lg shadow-md p-6 mb-4'])
            ->add(
                Elemento::h3($title)->addClass('text-lg font-semibold mb-4')
            )
            ->add($content);
    }

    /**
     * @param string $message
     * @param string $type
     * @return Element
     */
    public function alert(string $message, string $type = 'info'): Element
    {
        $colors = [
            'info' => 'bg-blue-100 border-l-4 border-blue-500 text-blue-700',
            'success' => 'bg-green-100 border-l-4 border-green-500 text-green-700',
            'warning' => 'bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700',
            'danger' => 'bg-red-100 border-l-4 border-red-500 text-red-700',
        ];

        $colorClass = $colors[$type] ?? $colors['info'];

        return Elemento::div(['class' => "p-4 $colorClass"])
            ->text($message);
    }

    /**
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function badge(string $text, string $type = 'primary'): Element
    {
        $colors = [
            'primary' => 'bg-blue-500 text-white',
            'secondary' => 'bg-gray-500 text-white',
            'success' => 'bg-green-500 text-white',
            'danger' => 'bg-red-500 text-white',
            'warning' => 'bg-yellow-500 text-black',
            'info' => 'bg-cyan-500 text-white'
        ];

        $colorClass = $colors[$type] ?? $colors['primary'];

        return Elemento::element('span', ['class' => "px-3 py-1 rounded-full text-sm $colorClass"])
            ->text($text);
    }

    /**
     * @param string $label
     * @param Element $field
     * @return Element
     */
    public function formGroup(string $label, Element $field): Element
    {
        return Elemento::div(['class' => 'mb-4'])
            ->add(
                Elemento::label($label)
                    ->addClass('block text-gray-700 text-sm font-bold mb-2')
            )
            ->add(
                $field->addClass('w-full px-3 py-2 border border-gray-300 rounded-lg font-semibold')
            );
    }

    /**
     * @return Element
     */
    public function table(): Element
    {
        return Elemento::table(['class' => 'min-w-full bg-white shadow rounded-lg']);
    }
}
