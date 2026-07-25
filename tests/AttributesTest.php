<?php

namespace tests;

use Elemento\Attributes\AttributeManager;
use Elemento\Attributes\ClassManager;
use PHPUnit\Framework\TestCase;

class AttributesTest extends TestCase
{
    public function testAttributeManagerMergesRemovesClearsAndRendersValues(): void
    {
        $attributes = new AttributeManager(['title' => 'A "quote"', 'required' => true]);
        $attributes->merge(['class' => ['one', 'two'], 'hidden' => false]);
        $attributes->remove('title');

        self::assertTrue($attributes->has('required'));
        self::assertSame(['one', 'two'], $attributes->get('class'));
        self::assertSame(' required class="one two"', (string) $attributes);

        $attributes->clear();
        self::assertSame([], $attributes->all());
    }

    public function testClassManagerSupportsItsCompleteLifecycle(): void
    {
        $classes = new ClassManager('one  two');
        $classes->add('three', 'three', '')->toggle('two')->toggle('four')->remove('one');

        self::assertSame(['three', 'four'], $classes->all());
        self::assertTrue($classes->has('four'));
        self::assertSame(2, $classes->count());
        self::assertSame('three four', (string) $classes);

        $clone = clone $classes;
        $clone->clear();

        self::assertSame([], $clone->all());
        self::assertSame(['three', 'four'], $classes->all());
    }
}
