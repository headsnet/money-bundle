<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2022
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ManagerRegistry;
use Headsnet\MoneyBundle\Doctrine\DBAL\Types\CurrencyType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HeadsnetMoneyBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $this->addDoctrineMapping($container);
    }

    public function boot(): void
    {
        $this->addCurrencyColumnType();
    }

    private function addDoctrineMapping(ContainerBuilder $container): void
    {
        $modelDir = realpath(__DIR__ . '/Doctrine/Mapping');
        $mappings = [
            $modelDir => 'Money',
        ];

        if (class_exists(DoctrineOrmMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    ['doctrine.orm.entity_manager'],
                    false
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    private function addCurrencyColumnType(): void
    {
        if (!Type::hasType('currency')) {
            Type::addType('currency', CurrencyType::class);
        }

        /** @var ManagerRegistry $registry */
        $registry = $this->container->get('doctrine');

        /** @var Connection $connection */
        foreach ($registry->getConnections() as $connection) {
            $connection->getDatabasePlatform()->registerDoctrineTypeMapping('currency', 'currency');
        }
    }
}
