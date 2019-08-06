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
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Money validator.
 */
class MoneyGreaterThanValidator extends ConstraintValidator
{
    /**
     * @param $value Money
     */
    public function validate($value, Constraint $constraint)
    {
        /*if (!$constraint instanceof Money) {
            throw new UnexpectedTypeException($constraint, Money::class);
        }*/

        if (null === $value || '' === $value)
        {
            return;
        }

        if ($value->lessThanOrEqual(new Money($constraint->getComparedValue(), $value->getCurrency())))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ compared_value }}', $constraint->getComparedValue())
                ->addViolation();
        }
    }
}
