<?php
/**
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2019
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Serializer\Normalizer;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalize a Money object in to a decimal value
 */
class MoneyAsDecimalNormalizer implements NormalizerInterface
{
	/**
	 * @var IntlMoneyFormatter
	 */
	private $moneyFormatter;

	/**
	 * Initialise the formatters just once, here in the constructor
	 */
	public function __construct()
	{
		$currencies = new ISOCurrencies();

		$numberFormatter = new \NumberFormatter('fr_FR', \NumberFormatter::DECIMAL);
		$this->moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
	}

	/**
	 * @param Money $object
	 * @param null  $format
	 * @param array $context
	 *
	 * @return string
	 */
	public function normalize($object, $format = null, array $context = [])
	{
		return $this->moneyFormatter->format($object);
	}

	/**
	 * {@inheritdoc}
	 */
	public function supportsNormalization($data, $format = null)
	{
		return $data instanceof Money;
	}

}
