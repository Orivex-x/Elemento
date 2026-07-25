<?php

namespace tests;

use Elemento\Form\FormField;
use PHPUnit\Framework\TestCase;

class FormFieldTest extends TestCase
{
    public function testRendersLabelAndInput(): void
    {
        $field = (new FormField('text', 'email'))
            ->label('Email')
            ->placeholder('name@example.test');

        self::assertSame(
            '<div class="form-group"><label for="email">Email</label><input name="email" type="text" placeholder="name@example.test" /></div>',
            $field->render()->render()
        );
    }

    public function testRendersHelpAndValidationErrors(): void
    {
        $field = (new FormField('text', 'name'))
            ->help('Required field')
            ->addError('Name is required');

        $rendered = $field->render()->render();

        self::assertStringContainsString('Name is required', $rendered);
        self::assertStringContainsString('Required field', $rendered);
    }

    public function testAcceptsScalarFieldValues(): void
    {
        $field = (new FormField('number', 'count'))->value(0);

        self::assertStringContainsString('value="0"', $field->render()->render());
    }

    public function testCheckboxValueCanBeUnset(): void
    {
        $field = (new FormField('checkbox', 'terms'))
            ->value(true)
            ->value(false);

        self::assertStringNotContainsString('checked', $field->render()->render());
    }
}
