<?php

namespace tests;

use Elemento\Elemento;
use Elemento\SafeHtml;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    public function testRendersOpeningTagAttributesAndEscapedText(): void
    {
        $element = Elemento::p('Hello <world>', ['id' => 'message']);

        self::assertSame('<p id="message">Hello &lt;world&gt;</p>', $element->render());
    }

    public function testPreservesInitialClassesWhenAddingClasses(): void
    {
        $element = Elemento::div(['class' => 'initial'])->addClass('extra');

        self::assertSame('<div class="initial extra"></div>', $element->render());
    }

    public function testRemovingClassAttributeClearsManagedClasses(): void
    {
        $element = Elemento::div(['class' => 'initial'])
            ->removeAttribute('class')
            ->addClass('replacement');

        self::assertSame('<div class="replacement"></div>', $element->render());
    }

    public function testAcceptsZeroAsTextContent(): void
    {
        self::assertSame('<p>0</p>', Elemento::p('0')->render());
    }

    public function testRejectsInvalidAttributeAndTagNames(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Elemento::element('p', ['onload bad' => 'alert(1)']);
    }

    public function testRendersArrayAndBooleanAttributes(): void
    {
        $element = Elemento::input('checkbox', [
            'class' => ['form-control', 'large'],
            'checked' => true,
            'disabled' => false,
        ]);

        self::assertSame('<input class="form-control large" checked type="checkbox" />', $element->render());
    }

    public function testTrustedHtmlContentIsExplicitlyUnescaped(): void
    {
        self::assertSame('<div><strong>trusted</strong></div>', Elemento::div()->trustedHtml(new SafeHtml('<strong>trusted</strong>'))->render());
    }

    public function testReturnsRawAndEscapedTextSeparately(): void
    {
        $element = Elemento::p('Fish & Chips');

        self::assertSame('Fish & Chips', $element->getText());
        self::assertSame('Fish &amp; Chips', $element->getEscapedText());
    }

    public function testReplacesMalformedUtf8WhenEscapingText(): void
    {
        self::assertSame('<p>�</p>', Elemento::p("\xB1")->render());
    }

    public function testReplacesMalformedUtf8WhenEscapingAttributes(): void
    {
        self::assertSame('<div title="�"></div>', Elemento::div(['title' => "\xB1"])->render());
    }

    public function testRejectsUnsupportedChildren(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Elemento::div()->add(42);
    }

    public function testRejectsUnsupportedChildrenAtSpecificPositions(): void
    {
        $element = Elemento::div()->add('first');

        try {
            $element->addAt(0, 42);
            self::fail('Expected addAt() to reject an invalid child.');
        } catch (InvalidArgumentException) {
            self::assertSame(['first'], $element->getChildren());
        }

        $this->expectException(InvalidArgumentException::class);
        $element->replaceChild(0, 42);
    }

    public function testFacadeReturnsTypedElements(): void
    {
        self::assertInstanceOf(\Elemento\Elements\A::class, Elemento::a('Docs', '/docs'));
        self::assertInstanceOf(\Elemento\Elements\H1::class, Elemento::h1('Heading'));
    }

    public function testSupportsCompleteChildAndAttributeLifecycle(): void
    {
        $element = Elemento::div()
            ->attrs(['title' => 'Initial', 'hidden' => true])
            ->id('panel')
            ->data('state', 'open')
            ->add('first')
            ->addAt(0, 'zero')
            ->replaceChild(1, 'one');

        self::assertSame('open', $element->getData('state'));
        self::assertTrue($element->hasAttribute('hidden'));
        self::assertSame(['zero', 'one'], $element->getChildren());

        $clone = clone $element;
        $clone->removeChild(0)->removeAttribute('hidden')->clearChildren();

        self::assertStringContainsString('hidden', $element->render());
        self::assertSame('<div title="Initial" id="panel" data-state="open"></div>', $clone->render());
    }

    public function testConstructorRejectsInvalidTagName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid HTML tag: invalid tag');

        Elemento::element('invalid tag');
    }

    public function testAttrReinitializesClassManagerForArrayAndStringValues(): void
    {
        $element = Elemento::div()
            ->attr('class', ['one', 'two']);

        self::assertSame(['one', 'two'], $element->getClasses());
        self::assertSame('<div class="one two"></div>', $element->render());

        $element->attr('class', 'three four');

        self::assertSame(['three', 'four'], $element->getClasses());
        self::assertSame('<div class="three four"></div>', $element->render());
    }

    public function testAddAcceptsAnArrayOfChildren(): void
    {
        $element = Elemento::div()->add([
            'First',
            Elemento::span('Second'),
            'Third',
        ]);

        self::assertSame(
            '<div>First<span>Second</span>Third</div>',
            $element->render()
        );

        self::assertCount(3, $element->getChildren());
    }

    public function testAppendTextUpdatesExistingTextContent(): void
    {
        $element = Elemento::p('Hello')->appendText(' <world>');

        self::assertSame('Hello <world>', $element->getText());
        self::assertSame('Hello &lt;world&gt;', $element->getEscapedText());
        self::assertSame('<p>Hello &lt;world&gt;</p>', $element->render());
    }

    public function testAppendTextDoesNotSetTextContentWhenInitiallyUnset(): void
    {
        $element = Elemento::p()->appendText('Hello');

        self::assertSame('', $element->getText());
        self::assertSame('Hello', $element->getEscapedText());
        self::assertSame('<p>Hello</p>', $element->render());
    }
}
