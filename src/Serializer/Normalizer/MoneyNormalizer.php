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

use Money\Currency;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MoneyNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param Money $object
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'amount' => $object->getAmount(),
            'currency' => $object->getCurrency(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Money;
    }

    /**
     * @param array{amount: numeric-string, currency: string} $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): Money
    {
        return new Money($data['amount'], new Currency($data['currency']));
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        if ($type !== Money::class) {
            return false;
        }

        return true;
    }
}
