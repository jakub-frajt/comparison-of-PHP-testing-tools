<?php
declare(strict_types=1);

use App\PhpUnit\PinValidator;
use PHPUnit\Framework\TestCase;

class PinValidatorTest extends TestCase
{
    /**
     * @var PinValidator
     */
    private $validator;

    public function setUp()
    {
        $this->validator = new PinValidator();
    }

    /**
     * @dataProvider validPinProvider
     */
    public function testValidPin(string $value): void
    {
       $this->assertEmpty($this->validator->validate($value));
    }

    /**
     * @dataProvider invalidPinProvider
     */
    public function testInvalidPin(string $value): void
    {
        $this->assertGreaterThan(0, $this->validator->validate($value));
    }

    /**
     * @dataProvider invalidCombinationsProvider
     */
    public function testInvalidCombinations(string $value): void
    {
        $this->assertEquals(['This combination is not allowed.'], $this->validator->validate($value));
    }

    public function testInvalidLength(): void
    {
        $this->assertEquals(['PIN must contains exactly four numbers.'], $this->validator->validate('23'));
    }

    public function testNotNumericPin(): void
    {
        $this->assertEquals(['PIN must contains only numbers'], $this->validator->validate('12a5'));
    }

    public function validPinProvider(): array
    {
        return [
            ['4479'],
            ['4513'],
            ['9761'],
            ['0036'],
        ];
    }

    public function invalidPinProvider(): array
    {
        return [
            ['abab'],
            ['12as'],
            ['AAAA'],
            ['126?'],
        ];
    }

    public function invalidCombinationsProvider(): array
    {
        return [
            ['1234'],
            ['4321'],
        ];
    }
}
