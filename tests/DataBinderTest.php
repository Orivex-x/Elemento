<?php

namespace tests;

use Elemento\DataBinding\DataBinder;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class DataBinderTest extends TestCase
{
    public function testReadsAndWritesNestedArrayValues(): void
    {
        $data = ['profile' => ['name' => 'Ada']];

        self::assertSame('Ada', DataBinder::getValue($data, 'profile.name'));

        DataBinder::setValue($data, 'profile.name', 'Grace');

        self::assertSame('Grace', DataBinder::getValue($data, 'profile.name'));
    }

    public function testHydratesStdClassInstances(): void
    {
        $data = DataBinder::hydrate(new stdClass(), ['name' => 'Ada']);

        self::assertSame('Ada', $data->name);
    }

    public function testRejectsMutationOfArbitraryObjects(): void
    {
        $data = new class () {};

        $this->expectException(InvalidArgumentException::class);
        DataBinder::setValue($data, 'name', 'Ada');
    }

    public function testCoversObjectReadsDefaultsBindingAndExistenceChecks(): void
    {
        $object = (object) ['profile' => (object) ['name' => 'Ada']];

        self::assertSame('Ada', DataBinder::getValue($object, 'profile.name'));
        self::assertSame('Guest', DataBinder::getValue($object, 'profile.missing', 'Guest'));
        self::assertTrue(DataBinder::has($object, 'profile.name'));
        self::assertFalse(DataBinder::has($object, 'profile.missing'));
        self::assertInstanceOf(stdClass::class, DataBinder::bind(null));
        self::assertSame([], (array) DataBinder::bind('invalid'));
    }

    public function testCreatesNestedStdClassValuesWhenWritingToNull(): void
    {
        $data = null;

        DataBinder::setValue($data, 'profile.name', 'Ada');

        self::assertSame('Ada', DataBinder::getValue($data, 'profile.name'));
    }

    public function testGetValueReadsNestedArrayValuesAndReturnsDefaultForMissingKeys(): void
    {
        $data = [
            'profile' => [
                'name' => 'Ada',
            ],
        ];

        // Covers reading through an array
        self::assertSame('Ada', DataBinder::getValue($data, 'profile.name'));

        // Covers the missing-key branch for arrays
        self::assertSame(
            'Guest',
            DataBinder::getValue($data, 'profile.missing', 'Guest')
        );

        // Covers the branch where traversal reaches a scalar
        self::assertSame(
            'Fallback',
            DataBinder::getValue($data, 'profile.name.first', 'Fallback')
        );
    }

    public function testHasChecksNestedArrayValuesAndHandlesMissingKeys(): void
    {
        $data = [
            'profile' => [
                'name' => 'Ada',
            ],
        ];

        // Covers successful traversal through arrays
        self::assertTrue(DataBinder::has($data, 'profile.name'));

        // Covers the missing-key branch for arrays
        self::assertFalse(DataBinder::has($data, 'profile.missing'));

        // Covers the branch where traversal reaches a scalar
        self::assertFalse(DataBinder::has($data, 'profile.name.first'));
    }
}
