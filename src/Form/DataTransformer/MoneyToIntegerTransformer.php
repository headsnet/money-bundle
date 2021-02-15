<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2021
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Form\DataTransformer;

use Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transforms between a Money/Money value objects and integer value
 */
class MoneyToIntegerTransformer implements DataTransformerInterface
{
    /**
     * Transforms a Money object to a numeric string.
     *
     * @param  Money|null $money
     *
     * @return string
     */
    public function transform($money)
    {
        if (null === $money) {
            return '0';
        }

        return $money->getAmount();
    }

    /**
     * Transforms a numeric string to a Money object.
     *
     * @param string $moneyNumber
     *
     * @return Money|null
     * @throws TransformationFailedException If Money object is not found.
     */
    public function reverseTransform($moneyNumber)
    {
        if (null === $moneyNumber) {
            return Money::EUR(0);
        }

        return Money::EUR($moneyNumber);
    }
}
