<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Validator\Constraints;

use Money\Money;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MoneyGreaterThanOrEqualValidator extends ConstraintValidator
{
    /**
     * @param Money|string|null $value
     * @param MoneyGreaterThanOrEqual $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof Money) {
            throw new UnexpectedTypeException($value, Money::class);
        }

        if (false === $value->greaterThanOrEqual(new Money($constraint->compareWith, $value->getCurrency()))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ compareWith }}', $constraint->compareWith)
                ->addViolation();
        }
    }
}
