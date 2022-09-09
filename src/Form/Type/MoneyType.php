<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle\Form\Type;

use Headsnet\MoneyBundle\Form\DataTransformer\MoneyToIntegerTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType as BaseMoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Custom form type to represent Money based on Money/Money value objects
 */
class MoneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new MoneyToIntegerTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'divisor' => 100,
                'currency' => 'EUR'
            ]
        );
    }

    public function getBlockPrefix(): string
    {
        return 'app_money';
    }

    public function getParent(): string
    {
        return BaseMoneyType::class;
    }
}
