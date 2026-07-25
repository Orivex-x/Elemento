<?php

namespace tests;

use Elemento\Elemento;
use Elemento\Macro\MacroRegistry;
use RuntimeException;
use PHPUnit\Framework\TestCase;

class MacroTest extends TestCase
{
    protected function tearDown(): void
    {
        MacroRegistry::clear();
    }

    public function testCallsRegisteredMacro(): void
    {
        Elemento::macro('greeting', static fn (string $name): string => "Hello {$name}");

        self::assertSame('Hello Elemento', Elemento::greeting('Elemento'));
    }

    public function testThrowsForUnknownMacro(): void
    {
        $this->expectException(RuntimeException::class);

        Elemento::callMacro('missing');
    }

    public function testRegistryCanInspectRemoveAndCountMacros(): void
    {
        MacroRegistry::register('first', static fn (): string => 'one');
        MacroRegistry::register('second', static fn (): string => 'two');

        self::assertTrue(MacroRegistry::exists('first'));
        self::assertCount(2, MacroRegistry::all());
        self::assertSame(2, MacroRegistry::count());

        MacroRegistry::remove('first');

        self::assertFalse(MacroRegistry::exists('first'));
        self::assertSame('two', MacroRegistry::call('second', []));
    }
}
