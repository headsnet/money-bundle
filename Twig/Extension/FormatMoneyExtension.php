<?php
/**
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2019
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Twig\Extension;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Filters to display a Money/Money value object as a string
 */
class FormatMoneyExtension extends AbstractExtension
{

	/**
	 * @return array
	 */
	public function getFilters()
	{
		return [new TwigFilter('money', [$this, 'moneyFilter'])];
	}

	/**
	 * @param Money $money
	 *
	 * @return string
	 */
	public function moneyFilter(Money $money)
	{
		$currencies = new ISOCurrencies();

		$numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
		$moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

		return $moneyFormatter->format($money);
	}

}
