<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Headsnet\MoneyBundle\Test\Validator\Constraints;

use Headsnet\MoneyBundle\Validator\Constraints\MoneyGreaterThan;
use Headsnet\MoneyBundle\Validator\Constraints\MoneyGreaterThanValidator;
use Money\Money;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 * @coversDefaultClass \Headsnet\MoneyBundle\Validator\Constraints\MoneyGreaterThanValidator
 */
class MoneyGreaterThanTest extends ConstraintValidatorTestCase
{
    /**
     * @covers ::validate
     */
    public function test_no_violation_when_value_is_blank(): void
    {
        $constraint = new MoneyGreaterThan(1000);

        $this->validator->validate('', $constraint);

        $this->assertNoViolation();
    }

    /**
     * @covers ::validate
     */
    public function test_no_violation_when_value_is_null(): void
    {
        $constraint = new MoneyGreaterThan(1000);

        $this->validator->validate(null, $constraint);

        $this->assertNoViolation();
    }

    /**
     * @covers ::validate
     * @dataProvider validValuesDataProvider
     * @testdox No violation when $value is greater than 1000
     */
    public function test_no_violation_when_value_is_greater_than(int $value): void
    {
        $constraint = new MoneyGreaterThan(1000);

        $this->validator->validate(Money::EUR($value), $constraint);

        $this->assertNoViolation();
    }

    /**
     * @return iterable<array<int>>
     */
    public function validValuesDataProvider(): iterable
    {
        yield [1001];
        yield [1002];
        yield [9999];
    }

    /**
     * @covers ::validate
     * @dataProvider invalidValuesDataProvider
     * @testdox Violation thrown when $value is less than or equal to 1000
     */
    public function test_violation_when_value_is_less_than_or_equal_to(int $value): void
    {
        $constraint = new MoneyGreaterThan(1000);

        $this->validator->validate(Money::EUR($value), $constraint);

        $this->buildViolation('This value must be greater than {{ compareWith }}!')
            ->setParameter('{{ compareWith }}', '1000')
            ->assertRaised();
    }

    /**
     * @return iterable<array<int>>
     */
    public function invalidValuesDataProvider(): iterable
    {
        yield [1000];
        yield [999];
        yield [1];
    }

    protected function createValidator(): MoneyGreaterThanValidator
    {
        return new MoneyGreaterThanValidator();
    }
}
