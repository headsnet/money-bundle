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

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MoneyGreaterThan extends Constraint
{
    /**
     * @var string
     */
    public $message = 'This value must be greater than {{ compared_value }}!';

    /**
     * @var Carbon
     */
    public $comparedValue;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->comparedValue = $value;

        parent::__construct();
    }

    /**
     * Get class constraints and properties
     *
     * @return array
     */
    public function getTargets(): array
    {
        return [self::PROPERTY_CONSTRAINT];
    }

    /**
     * @return int
     */
    public function getComparedValue(): int
    {
        return $this->comparedValue;
    }
}
