<?php

declare(strict_types=1);

namespace Thunbolt\DI;

use Nette\DI\CompilerExtension;
use Thunbolt\Composer\ComposerDirectories;
use Thunbolt\Directories;

class ThunboltExtension extends CompilerExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();
		$appDir = $builder->parameters['appDir'];
		$wwwDir = $builder->parameters['wwwDir'];

		$this->compiler->addConfig([
			'parameters' => [
				'bundlesDir' => $appDir . '/bundles',
				'layoutsDir' => $appDir . '/layouts',
				'pluginsDir' => $appDir . '/../' . ComposerDirectories::PLUGIN_DIR,
				'pluginAssetsDir' => $wwwDir . '/' . ComposerDirectories::PLUGIN_ASSETS_DIR,
			],
		]);

		$builder->parameters['bundlesDir'] = $appDir . '/bundles';
		$builder->parameters['layoutsDir'] = $appDir . '/layouts';
		$builder->parameters['pluginsDir'] = $appDir . '/../' . ComposerDirectories::PLUGIN_DIR;
		$builder->parameters['pluginAssetsDir'] = $wwwDir . '/' . ComposerDirectories::PLUGIN_ASSETS_DIR;

		$builder->addDefinition($this->prefix('directories'))
			->setClass(Directories::class, [
				$builder->parameters['appDir'], $builder->parameters['wwwDir'], $builder->parameters['bundlesDir'],
				$builder->parameters['layoutsDir'], $builder->parameters['pluginsDir'], $builder->parameters['pluginAssetsDir'],
			]);
	}

}
