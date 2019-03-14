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

use Money\Currency;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalize a Money object in to a decimal value
 */
class MoneyNormalizer implements NormalizerInterface, DenormalizerInterface
{

	/**
	 * @param Money $object
	 * @param null  $format
	 * @param array $context
	 *
	 * @return string
	 */
	public function normalize($object, $format = null, array $context = [])
	{
		return [
			'amount' => $object->getAmount(),
			'currency' => $object->getCurrency(),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function supportsNormalization($data, $format = null)
	{
		return $data instanceof Money;
	}

	/**
	 * @param array  $object
	 * @param string $class
	 * @param null   $format
	 * @param array  $context
	 *
	 * @return TourOperator|object
	 */
	public function denormalize($object, $class, $format = null, array $context = [])
	{
		return new Money($object['amount'], new Currency($object['currency']));
	}

	/**
	 * @inheritdoc
	 */
	public function supportsDenormalization($object, $type, $format = null)
	{
		if ($type !== Money::class)
		{
			return false;
		}

		return true;
	}

}
