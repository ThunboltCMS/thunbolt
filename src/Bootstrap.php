<?php

declare(strict_types=1);

namespace Thunbolt;

use Nette\Configurator;
use Thunbolt\Bundles\DI\BundlesExtension;
use Thunbolt\Composer\ComposerDirectories;
use Thunbolt\SoftExtensions\DI\SoftExtensionsExtension;

class Bootstrap {

	/** @var string */
	private $baseDir;

	/** @var Configurator */
	private $configurator;

	public function __construct(string $baseDir, Configurator $configurator, bool $initDirs = TRUE) {
		$this->baseDir = $baseDir;
		$this->configurator = $configurator;
		if ($initDirs) {
			$this->configurator->addParameters([
				'bundlesDir' => $baseDir . '/bundles',
				'layoutsDir' => $baseDir . '/layouts',
				'plgDir' => $baseDir . '/../' . ComposerDirectories::PLG_DIR,
				'plgResDir' => $baseDir . '/../' . ComposerDirectories::PLG_RES_DIR,
			]);
		}
	}

	public function initialize(): void {
		BundlesExtension::register($this->configurator);

		$this->configurator->enableDebugger($this->baseDir . '/../var/log');
		$this->configurator->setTempDirectory($this->baseDir . '/../var/tmp');
	}

}
