<?php
/**
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2019
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Validator\Constraints;

use Money\Money;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class MoneyGreaterThanValidator extends ConstraintValidator
{
    /**
     * @param Money $value
     */
    public function validate($money, Constraint $constraint)
    {
        if (!$constraint instanceof MoneyGreaterThan)
        {
            throw new UnexpectedTypeException($constraint, MoneyGreaterThan::class);
        }

        if (null === $money || '' === $money)
        {
            return;
        }


        if (!$money instanceof Money)
        {
            throw new UnexpectedValueException($money, Money::class);
        }

        if ($money->lessThanOrEqual(new Money($constraint->min, $money->getCurrency())))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $money)
                ->addViolation();
        }
    }
}
