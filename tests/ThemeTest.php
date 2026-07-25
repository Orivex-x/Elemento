<?php

namespace tests;

use Elemento\Elemento;
use Elemento\Theme\BootstrapTheme;
use Elemento\Theme\TailwindTheme;
use Elemento\Theme\ThemeManager;
use PHPUnit\Framework\TestCase;

class ThemeTest extends TestCase
{
    public function testBootstrapThemeBuildsButton(): void
    {
        Elemento::setTheme(new BootstrapTheme());

        self::assertSame('<button class="btn btn-primary">Save</button>', Elemento::buttonThemed('Save')->render());
    }

    public function testTailwindThemeBuildsCardAndAlert(): void
    {
        Elemento::setTheme(new TailwindTheme());

        self::assertStringContainsString('rounded-lg', Elemento::card('Title', 'Body')->render());
        self::assertStringContainsString('border-l-4', Elemento::alert('Danger', 'danger')->render());
    }

    public function testThemeSpecificHelpersAndManagerLifecycle(): void
    {
        $bootstrap = new BootstrapTheme();

        self::assertStringContainsString('btn-group', $bootstrap->buttonGroup(['Save' => ['type' => 'success']])->render());
        self::assertStringContainsString('width: 75%', $bootstrap->progress(75)->render());
        self::assertStringContainsString('form-group', $bootstrap->formGroup('Name', Elemento::input())->render());

        $tailwind = new TailwindTheme();
        self::assertStringContainsString('w-full', $tailwind->formGroup('Name', Elemento::input())->render());
        self::assertStringContainsString('rounded-lg', $tailwind->table()->render());

        ThemeManager::reset();
        self::assertSame('Bootstrap', Elemento::getTheme()->getName());
    }
}
