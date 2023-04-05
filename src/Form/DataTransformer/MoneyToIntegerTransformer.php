<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Form\DataTransformer;

use Money\Currency;
use Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transforms between a Money/Money value objects and integer value
 */
class MoneyToIntegerTransformer implements DataTransformerInterface
{
    private Currency $currency;

    public function __construct(string $currency)
    {
        $this->currency = new Currency($currency);
    }

    /**
     * Transforms a Money object to a numeric string.
     *
     * @param Money|null $value
     */
    public function transform($value): string
    {
        if (null === $value) {
            return '0';
        }

        return $value->getAmount();
    }

    /**
     * Transforms a numeric string to a Money object.
     *
     * @param string|null $value
     *
     * @throws TransformationFailedException If Money object is not found.
     */
    public function reverseTransform($value): Money
    {
        if (null === $value) {
            return new Money(
                0,
                $this->currency
            );
        }

        return new Money(
            sprintf('%.0F', $value),
            $this->currency
        );
    }
}
