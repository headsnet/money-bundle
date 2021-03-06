<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2021
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Twig\Extension;

use Money\Currency;
use Money\Money;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Filters to display a Money/Money value object as a string
 */
class MoneyUtilsExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return array(
            new TwigFunction('money', [$this, 'createMoney'])
        );
    }

    /**
     * Create Money/Money objects directly from Twig.
     *
     * @param int    $amount
     * @param string $currency
     *
     * @return Money
     */
    public function createMoney(int $amount, string $currency): Money
    {
        return new Money($amount, new Currency($currency));
    }
}
