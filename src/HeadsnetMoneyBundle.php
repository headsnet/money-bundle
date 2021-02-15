<?php
/*
 * This file is part of the Symfony HeadsnetMoneyBundle.
 *
 * (c) Headstrong Internet Services Ltd 2021
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Headsnet\MoneyBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle configuration
 */
class HeadsnetMoneyBundle extends Bundle
{

	/**
	 * Here we add a compiler pass to add a Doctrine Mapping for the Money embeddable model
	 *
	 * @param ContainerBuilder $container
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$modelDir = realpath(__DIR__.'/Doctrine/Mapping');
		$mappings = [
			$modelDir => 'Money',
		];

		if (class_exists(DoctrineOrmMappingsPass::class))
		{
			$container->addCompilerPass(
				DoctrineOrmMappingsPass::createXmlMappingDriver(
					$mappings,
					['doctrine.orm.entity_manager'],
					false
				));
		}
	}

}
