<?php

namespace tests;

use Elemento\Element;
use Elemento\Elemento;
use Elemento\SafeHtml;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use stdClass;

class ElementPublicApiTest extends TestCase
{
    public function testEveryPublicConcreteElementMethodAcceptsRepresentativeValidArguments(): void
    {
        $files = glob(dirname(__DIR__) . '/src/Elemento/Elements/*.php');
        self::assertNotFalse($files);

        foreach ($files as $file) {
            $class = 'Elemento\\Elements\\' . basename($file, '.php');
            $element = new $class();
            $element->add('existing child');

            foreach ((new \ReflectionClass($element))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->isStatic() || str_starts_with($method->getName(), '__')) {
                    continue;
                }

                $arguments = array_map($this->argumentFor(...), $method->getParameters());
                $method->invokeArgs($element, $arguments);
            }

            self::assertInstanceOf(Element::class, $element);
            self::assertNotSame('', $element->render());
        }
    }

    private function argumentFor(ReflectionParameter $parameter): mixed
    {
        $type = $parameter->getType();
        $name = $type instanceof ReflectionUnionType ? $type->getTypes()[0]->getName() : ($type instanceof ReflectionNamedType ? $type->getName() : 'mixed');

        return match ($name) {
            'string' => 'value',
            'int' => 1,
            'float' => 1.5,
            'bool' => true,
            'array' => ['value' => 'Label'],
            'callable' => static fn (): string => 'value',
            SafeHtml::class => new SafeHtml('<span>trusted</span>'),
            Element::class => Elemento::div(),
            'object' => new stdClass(),
            default => 'value',
        };
    }
}
