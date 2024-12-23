<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Serializer\Normalizer;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MoneyAsDecimalNormalizer implements NormalizerInterface
{
    private IntlMoneyFormatter $moneyFormatter;

    public function __construct()
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('en_GB', \NumberFormatter::DECIMAL);
        $this->moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
    }

    /**
     * @param Money $data
     * @param array<string, string> $context
     */
    public function normalize($data, string|null $format = null, array $context = []): string
    {
        return $this->moneyFormatter->format($data);
    }

    /**
     * @param array<string, string> $context
     */
    public function supportsNormalization($data, string|null $format = null, array $context = []): bool
    {
        return $data instanceof Money;
    }

    /**
     * @return array<string, bool>
     */
    public function getSupportedTypes(string|null $format): array
    {
        return [
            Money::class => true,
        ];
    }
}
