<?php declare(strict_types = 1);

namespace Thunbolt\DI;

use Nette\DI\CompilerExtension;
use Thunbolt\ProjectDirectories;

/**
 * @internal
 */
class ThunboltExtension extends CompilerExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();
		$appDir = $builder->parameters['appDir'];

		$this->compiler->addConfig([
			'parameters' => [
				'bundlesDir' => $appDir . '/bundles',
				'layoutsDir' => $appDir . '/layouts',
				'templatesDir' => $appDir . '/templates',
			],
		]);

		$builder->parameters['bundlesDir'] = $appDir . '/bundles';
		$builder->parameters['layoutsDir'] = $appDir . '/layouts';
		$builder->parameters['templatesDir'] = $appDir . '/templates';

		$builder->addDefinition($this->prefix('directories'))
			->setFactory(ProjectDirectories::class, [
				$builder->parameters['appDir'], $builder->parameters['wwwDir'], $builder->parameters['bundlesDir'],
				$builder->parameters['layoutsDir'], $builder->parameters['templatesDir']
			]);
	}

}
