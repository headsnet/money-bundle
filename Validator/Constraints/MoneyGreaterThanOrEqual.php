<?php
/**
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2020
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
    /**
     * @var string
     */
    public $message = 'This value must be greater than or equal to {{ compareWith }}!';

    /**
     * @var Money
     */
    public $compareWith;

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'compareWith';
    }
}
