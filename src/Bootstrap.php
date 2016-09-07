<?php

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

	/**
	 * @param string $baseDir
	 * @param Configurator $configurator
	 * @param bool $initDirs
	 */
	public function __construct($baseDir, Configurator $configurator, $initDirs = TRUE) {
		$this->baseDir = $baseDir;
		$this->configurator = $configurator;
		if ($initDirs) {
			$this->configurator->addParameters([
				'bundlesDir' => $baseDir . '/bundles',
				'layoutsDir' => $baseDir . '/layouts',
				'transDir' => $baseDir . '/translations',
				'plgDir' => $baseDir . '/../' . ComposerDirectories::PLG_DIR,
				'plgResDir' => $baseDir . '/../' . ComposerDirectories::PLG_RES_DIR,
			]);
		}
	}

	public function initialize() {
		if (class_exists(SoftExtensionsExtension::class)) {
			SoftExtensionsExtension::register($this->configurator);
		}
		BundlesExtension::register($this->configurator);

		$this->configurator->enableDebugger($this->baseDir . '/../var/log');
		$this->configurator->setTempDirectory($this->baseDir . '/../var/tmp');
	}

}
