<?php
/**
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2019
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
	 * Transforms an object (money) to a string (number).
	 *
	 * @param  Money|null $money
	 *
	 * @return string
	 */
	public function transform($money)
	{
		if (null === $money)
		{
			return '';
		}

		return $money->getAmount();
	}

	/**
	 * Transforms a string (number) to an object (money).
	 *
	 * @param string $moneyNumber
	 *
	 * @return Money|null
	 * @throws TransformationFailedException if object (money) is not found.
	 */
	public function reverseTransform($moneyNumber)
	{
		if (!$moneyNumber)
		{
			return null;
		}

		$money = Money::EUR($moneyNumber);

		return $money;
	}

}
