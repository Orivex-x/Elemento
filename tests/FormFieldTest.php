<?php

namespace tests;

use Elemento\Form\FormField;
use Elemento\Elements\Select;
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

    public function testGetLabelReturnsNullWhenNoLabelIsSet(): void
    {
        $field = new FormField('text', 'email');

        self::assertNull($field->getLabel());
    }

    public function testGetLabelReturnsConfiguredLabel(): void
    {
        $field = (new FormField('text', 'email'))->label('Email');

        self::assertNotNull($field->getLabel());
        self::assertSame('<label for="email">Email</label>', $field->getLabel()->render());
    }

    public function testGetErrorsReturnsEmptyArrayInitially(): void
    {
        $field = new FormField('text', 'name');

        self::assertSame([], $field->getErrors());
    }

    public function testAddErrorsStoresAllErrors(): void
    {
        $errors = [
            'Name is required',
            'Name must be at least 3 characters',
        ];

        $field = (new FormField('text', 'name'))->addErrors($errors);

        self::assertSame($errors, $field->getErrors());
        self::assertTrue($field->hasErrors());
        self::assertStringContainsString('is-invalid', $field->getElement()->render());

        $rendered = $field->render()->render();

        self::assertStringContainsString('Name is required', $rendered);
        self::assertStringContainsString('Name must be at least 3 characters', $rendered);
    }

    public function testAddClassAddsClassesToField(): void
    {
        $field = (new FormField('text', 'email'))
            ->addClass('form-control', 'custom-input');

        $html = $field->getElement()->render();

        self::assertStringContainsString('form-control', $html);
        self::assertStringContainsString('custom-input', $html);
    }

    public function testAttrAddsAttributeToField(): void
    {
        $field = (new FormField('text', 'email'))
            ->attr('data-test', 'email-field');

        self::assertStringContainsString(
            'data-test="email-field"',
            $field->getElement()->render()
        );
    }

    public function testRequiredSetsRequiredAttribute(): void
    {
        $field = (new FormField('text', 'email'))->required(true);

        self::assertStringContainsString(
            'required',
            $field->getElement()->render()
        );
    }

    public function testRequiredCanBeDisabled(): void
    {
        $field = (new FormField('text', 'email'))
            ->required(true)
            ->required(false);

        self::assertStringNotContainsString(
            'required',
            $field->getElement()->render()
        );
    }

    public function testSelectFieldCreatesSelectElement(): void
    {
        $field = new FormField('select', 'country');

        self::assertInstanceOf(Select::class, $field->getElement());
        self::assertStringContainsString(
            'name="country"',
            $field->getElement()->render()
        );
    }

    public function testSelectFieldAcceptsOptions(): void
    {
        $field = (new FormField('select', 'country'))
            ->options([
                'uk' => 'United Kingdom',
                'us' => 'United States',
            ]);

        $html = $field->getElement()->render();

        self::assertStringContainsString('United Kingdom', $html);
        self::assertStringContainsString('United States', $html);
    }

    public function testOptionsDoesNothingForNonSelectField(): void
    {
        $field = (new FormField('text', 'name'))
            ->options([
                'first' => 'First',
                'second' => 'Second',
            ]);

        self::assertStringNotContainsString(
            'First',
            $field->getElement()->render()
        );

        self::assertStringNotContainsString(
            'Second',
            $field->getElement()->render()
        );
    }

    public function testSelectFieldValueSetsDataSelectedAttribute(): void
    {
        $field = (new FormField('select', 'country'))
            ->value('uk');

        self::assertSame(
            'uk',
            $field->getElement()->getAttribute('data-selected')
        );
    }
}
