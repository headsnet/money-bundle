<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Headsnet\MoneyBundle\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;
use Money\Currency;

class CurrencyType extends Type
{
    public const NAME = 'currency';

    /**
     * @param string[] $column
     */
    public function getSqlDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL([
            'length' => 3,
            'fixed' => true,
        ]);
    }

    /**
     * @param Currency|string|null $value
     *
     * @throws ConversionException
     */
    public function convertToPhpValue($value, AbstractPlatform $platform): ?Currency
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof Currency) {
            return $value;
        }
        try {
            $currency = new Currency($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }

        return $currency;
    }

    /**
     * @param Currency|string $value
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof Currency) {
            return $value->getCode();
        }
        try {
            $currency = new Currency($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }

        return $currency->getCode();
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSqlCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
