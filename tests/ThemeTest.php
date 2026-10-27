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

    public function testBootstrapThemeCard(): void
    {
        $theme = new BootstrapTheme();

        $html = $theme->card('Card Title', 'Card content')->render();

        self::assertStringContainsString('class="card"', $html);
        self::assertStringContainsString('class="card-header"', $html);
        self::assertStringContainsString('<h5>Card Title</h5>', $html);
        self::assertStringContainsString('class="card-body"', $html);
        self::assertStringContainsString('Card content', $html);
    }

    public function testBootstrapThemeAlertUsesDefaultPrimaryType(): void
    {
        $theme = new BootstrapTheme();

        $html = $theme->alert('Alert message')->render();

        self::assertStringContainsString('class="alert alert-primary"', $html);
        self::assertStringContainsString('role="alert"', $html);
        self::assertStringContainsString('Alert message', $html);
    }

    public function testBootstrapThemeAlertSupportsCustomType(): void
    {
        $theme = new BootstrapTheme();

        $html = $theme->alert('Success message', 'success')->render();

        self::assertStringContainsString('class="alert alert-success"', $html);
        self::assertStringContainsString('role="alert"', $html);
        self::assertStringContainsString('Success message', $html);
    }

    public function testBootstrapThemeBadgeUsesDefaultPrimaryType(): void
    {
        $theme = new BootstrapTheme();

        $html = $theme->badge('New')->render();

        self::assertStringContainsString('<span', $html);
        self::assertStringContainsString('class="badge bg-primary"', $html);
        self::assertStringContainsString('New', $html);
    }

    public function testBootstrapThemeBadgeSupportsCustomType(): void
    {
        $theme = new BootstrapTheme();

        $html = $theme->badge('Success', 'success')->render();

        self::assertStringContainsString('class="badge bg-success"', $html);
        self::assertStringContainsString('Success', $html);
    }

    public function testTailwindThemeGetName(): void
    {
        $theme = new TailwindTheme();

        self::assertSame('Tailwind', $theme->getName());
    }

    public function testTailwindThemeBuildsCardAndAlert(): void
    {
        Elemento::setTheme(new TailwindTheme());

        self::assertStringContainsString('rounded-lg', Elemento::card('Title', 'Body')->render());
        self::assertStringContainsString('border-l-4', Elemento::alert('Danger', 'danger')->render());
    }

    public function testTailwindThemeButtonUsesDefaultPrimaryStyle(): void
    {
        $theme = new TailwindTheme();

        $html = $theme->button('Save')->render();

        self::assertStringContainsString('Save', $html);
        self::assertStringContainsString('px-4 py-2 rounded text-white font-semibold transition', $html);
        self::assertStringContainsString('bg-blue-500 hover:bg-blue-600', $html);
    }

    public function testTailwindThemeButtonSupportsAllColourVariants(): void
    {
        $theme = new TailwindTheme();

        $colours = [
            'primary' => 'bg-blue-500 hover:bg-blue-600',
            'secondary' => 'bg-gray-500 hover:bg-gray-600',
            'success' => 'bg-green-500 hover:bg-green-600',
            'danger' => 'bg-red-500 hover:bg-red-600',
            'warning' => 'bg-yellow-500 hover:bg-yellow-600',
            'info' => 'bg-cyan-500 hover:bg-cyan-600',
        ];

        foreach ($colours as $type => $expectedClass) {
            $html = $theme->button('Save', $type)->render();

            self::assertStringContainsString($expectedClass, $html, "Failed for button type: {$type}");
        }
    }

    public function testTailwindThemeButtonFallsBackToPrimaryForUnknownType(): void
    {
        $theme = new TailwindTheme();

        $html = $theme->button('Save', 'unknown')->render();

        self::assertStringContainsString('bg-blue-500 hover:bg-blue-600', $html);
    }

    public function testTailwindThemeBadgeUsesDefaultPrimaryStyle(): void
    {
        $theme = new TailwindTheme();

        $html = $theme->badge('New')->render();

        self::assertStringContainsString('New', $html);
        self::assertStringContainsString('px-3 py-1 rounded-full text-sm', $html);
        self::assertStringContainsString('bg-blue-500 text-white', $html);
    }

    public function testTailwindThemeBadgeSupportsAllColourVariants(): void
    {
        $theme = new TailwindTheme();

        $colours = [
            'primary' => 'bg-blue-500 text-white',
            'secondary' => 'bg-gray-500 text-white',
            'success' => 'bg-green-500 text-white',
            'danger' => 'bg-red-500 text-white',
            'warning' => 'bg-yellow-500 text-black',
            'info' => 'bg-cyan-500 text-white',
        ];

        foreach ($colours as $type => $expectedClass) {
            $html = $theme->badge('Status', $type)->render();

            self::assertStringContainsString($expectedClass, $html, "Failed for badge type: {$type}");
        }
    }

    public function testTailwindThemeBadgeFallsBackToPrimaryForUnknownType(): void
    {
        $theme = new TailwindTheme();

        $html = $theme->badge('Status', 'unknown')->render();

        self::assertStringContainsString('bg-blue-500 text-white', $html);
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

    public function testThemeManagerGetThemeName(): void
    {
        ThemeManager::setTheme(new BootstrapTheme());

        self::assertSame('Bootstrap', ThemeManager::getThemeName());

        ThemeManager::setTheme(new TailwindTheme());

        self::assertSame('Tailwind', ThemeManager::getThemeName());
    }

    public function testThemeManagerBadgeUsesCurrentTheme(): void
    {
        ThemeManager::setTheme(new BootstrapTheme());

        $html = ThemeManager::badge('New')->render();

        self::assertStringContainsString('class="badge bg-primary"', $html);
        self::assertStringContainsString('New', $html);

        ThemeManager::setTheme(new TailwindTheme());

        $html = ThemeManager::badge('Success', 'success')->render();

        self::assertStringContainsString('bg-green-500 text-white', $html);
        self::assertStringContainsString('Success', $html);
    }

    public function testThemeManagerGetThemeInitializesDefaultBootstrapTheme(): void
    {
        // Reset initializes BootstrapTheme, so first clear the current theme
        // by using reflection to simulate the initial null state.
        $property = new \ReflectionProperty(ThemeManager::class, 'currentTheme');
        $property->setAccessible(true);
        $property->setValue(null, null);

        $theme = ThemeManager::getTheme();

        self::assertInstanceOf(BootstrapTheme::class, $theme);
        self::assertSame('Bootstrap', $theme->getName());
    }

}
