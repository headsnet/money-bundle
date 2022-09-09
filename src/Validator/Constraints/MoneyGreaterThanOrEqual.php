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

/**
 * @Annotation
 */
class MoneyGreaterThanOrEqual extends Constraint
{
    public string $message = 'This value must be greater than or equal to {{ compareWith }}!';

    public Money $compareWith;

    public function getDefaultOption(): string
    {
        return 'compareWith';
    }
}
