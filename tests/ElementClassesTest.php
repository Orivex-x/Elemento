<?php

namespace tests;

use Elemento\Element;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ElementClassesTest extends TestCase
{
    /**
     * @return iterable<string, array{class-string<Element>, string}>
     */
    public static function concreteElementClasses(): iterable
    {
        $files = glob(dirname(__DIR__) . '/src/Elemento/Elements/*.php');

        foreach ($files as $file) {
            $shortName = basename($file, '.php');
            $tag = strtolower($shortName === 'ObjectElement' ? 'object' : $shortName);

            yield $shortName => ["Elemento\\Elements\\{$shortName}", $tag];
        }
    }

    /**
     * @param class-string<Element> $class
     */
    #[DataProvider('concreteElementClasses')]
    public function testEveryConcreteElementCanBeConstructedAndRendered(string $class, string $tag): void
    {
        $element = new $class();

        self::assertSame($tag, $element->getTag());
        self::assertStringStartsWith("<{$tag}", $element->render());
    }
}
