<?php

namespace tests;

use Elemento\Elemento;
use Elemento\Elements\Form;
use Elemento\Form\FormBuilder;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FormBuilderTest extends TestCase
{
    public function testSelectOptionsAreAddedAndSelected(): void
    {
        $select = Elemento::select()
            ->option('first', 'First')
            ->option('second', 'Second')
            ->selected('second');

        self::assertSame(
            '<select><option value="first">First</option><option value="second" selected>Second</option></select>',
            $select->render()
        );
        self::assertSame($select->render(), $select->render());
    }

    public function testSelectComparisonUsesCanonicalStringValues(): void
    {
        $select = Elemento::select()
            ->option('', 'Empty')
            ->option(0, 'Zero')
            ->selected(0);

        self::assertSame(
            '<select><option value="">Empty</option><option value="0" selected>Zero</option></select>',
            $select->render()
        );
    }

    public function testSelectsOptionsInsideOptgroups(): void
    {
        $select = Elemento::select()
            ->optgroup('Numbers', ['one' => 'One', 'two' => 'Two'])
            ->selected('two');

        self::assertStringContainsString('<option value="two" selected>Two</option>', $select->render());
    }

    public function testFormBuilderRenderIsIdempotent(): void
    {
        $form = Elemento::postForm('/save')->field('count', 'number', ['value' => '0']);
        $builder = Elemento::postForm('/save')->field('name');

        self::assertSame((string) $builder, (string) $builder);
        self::assertSame('0', $form->getElement()->getAttribute('value'));
    }

    public function testPutAndDeleteFormsIncludeMethodOverrides(): void
    {
        self::assertStringContainsString('name="_method" value="PUT"', (string) Elemento::putForm('/items/1'));
        self::assertStringContainsString('name="_method" value="DELETE"', (string) Elemento::deleteForm('/items/1'));
    }

    public function testReplacingAFieldDoesNotDuplicateItsRenderedOutput(): void
    {
        $form = Elemento::postForm('/save');
        $form->field('email', 'text', ['label' => 'Old label']);
        $form->field('email', 'email', ['label' => 'New label']);

        $rendered = $form->render();

        self::assertSame(1, substr_count($rendered, 'name="email"'));
        self::assertStringContainsString('New label', $rendered);
        self::assertStringNotContainsString('Old label', $rendered);
    }

    public function testFieldOptionsPreserveZeroStrings(): void
    {
        $form = Elemento::postForm('/save');
        $form->field('count', 'text', [
            'label' => '0',
            'placeholder' => '0',
            'help' => '0',
        ]);

        $rendered = $form->render();

        self::assertStringContainsString('<label for="count">0</label>', $rendered);
        self::assertStringContainsString('placeholder="0"', $rendered);
        self::assertStringContainsString('>0</div>', $rendered);
    }

    public function testBindingAnArrayValueThrowsAClearException(): void
    {
        $form = Elemento::postForm('/save');
        $form->field('tags');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The value bound to form field "tags" must be a string, int, float, bool, or null; array given.');

        $form->bindData(['tags' => ['php']]);
    }

    public function testCsrfTokenFieldPreservesZeroStringValues(): void
    {
        $form = Elemento::postForm('/save')->withCSRFToken('0');

        self::assertStringContainsString('name="_token" value="0"', $form->render());
    }

    public function testSchemaAccessorsRemovalAndCustomElements(): void
    {
        $form = Elemento::createForm(['id' => 'profile'])
            ->schema([
                'name' => ['type' => 'text', 'label' => 'Name'],
                'bio' => ['type' => 'textarea', 'value' => 'Hello'],
            ])
            ->setRenderOptions(['wrapper_class' => 'field'])
            ->add(Elemento::p('Fields marked required are mandatory.'));

        self::assertTrue($form->hasField('name'));
        self::assertNotNull($form->getField('bio'));
        self::assertCount(2, $form->getFields());
        self::assertSame([], $form->getErrors());
        self::assertFalse($form->hasErrors());
        self::assertStringContainsString('class="field"', $form->render());

        $form->removeField('bio');

        self::assertFalse($form->hasField('bio'));
        self::assertStringNotContainsString('name="bio"', $form->render());
    }

    public function testGetCreatesFormWithGetMethod(): void
    {
        $form = FormBuilder::get('/search', ['id' => 'search-form']);

        $html = $form->render();

        self::assertStringContainsString('method="GET"', $html);
        self::assertStringContainsString('action="/search"', $html);
        self::assertStringContainsString('id="search-form"', $html);
    }

    public function testSetErrorsStoresAndAppliesFieldErrors(): void
    {
        $form = Elemento::postForm('/save');
        $form->field('email');
        $form->field('name');

        $form->setErrors([
            'email' => ['Email is required', 'Email is invalid'],
            'name' => 'Name is required',
            'unknown' => 'Unknown field error',
        ]);

        self::assertTrue($form->hasErrors());
        self::assertSame([
            'email' => ['Email is required', 'Email is invalid'],
            'name' => 'Name is required',
            'unknown' => 'Unknown field error',
        ], $form->getErrors());

        $html = $form->render();

        self::assertStringContainsString('Email is required', $html);
        self::assertStringContainsString('Email is invalid', $html);
        self::assertStringContainsString('Name is required', $html);
        self::assertStringNotContainsString('Unknown field error', $html);
        self::assertStringContainsString('is-invalid', $html);
    }

    public function testGetFormReturnsUnderlyingFormElement(): void
    {
        $form = FormBuilder::post('/save', ['id' => 'profile-form']);

        $element = $form->getForm();

        self::assertInstanceOf(Form::class, $element);
        self::assertSame('profile-form', $element->getAttribute('id'));
    }

    public function testBindDataPopulatesFieldValues(): void
    {
        $form = Elemento::postForm('/save');

        $form->field('name');
        $form->field('age');

        $result = $form->bindData([
            'name' => 'Alice',
            'age' => 30,
        ]);

        self::assertSame($form, $result);
        self::assertStringContainsString('value="Alice"', $form->render());
        self::assertStringContainsString('value="30"', $form->render());
    }

    public function testFieldRequiredOptionIsApplied(): void
    {
        $form = Elemento::postForm('/save');

        $form->field('email', 'email', [
            'required' => true,
        ]);

        self::assertStringContainsString('required', $form->render());
    }

    public function testFieldSelectOptionsAreApplied(): void
    {
        $form = Elemento::postForm('/save');

        $form->field('country', 'select', [
            'label' => 'Country',
            'options' => [
                'uk' => 'United Kingdom',
                'us' => 'United States',
            ],
        ]);

        $html = $form->render();

        self::assertStringContainsString('United Kingdom', $html);
        self::assertStringContainsString('United States', $html);
    }
}
