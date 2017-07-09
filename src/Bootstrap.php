<?php

declare(strict_types=1);

namespace Thunbolt;

use Nette\Configurator;
use Thunbolt\Bundles\DI\BundlesExtension;
use Thunbolt\Composer\ComposerDirectories;
use Thunbolt\DI\ThunboltExtension;
use Thunbolt\SoftExtensions\DI\SoftExtensionsExtension;

class Bootstrap {

	/** @var Configurator */
	private $configurator;

	/** @var string */
	private $baseDir;

	public function __construct(string $baseDir, Configurator $configurator) {
		$this->configurator = $configurator;
		$this->baseDir = $baseDir;

		$this->configurator->defaultExtensions['thunbolt'] = ThunboltExtension::class;
	}

	public function initialize(): void {
		BundlesExtension::register($this->configurator);

		$this->configurator->enableDebugger($this->baseDir . '/../var/log');
		$this->configurator->setTempDirectory($this->baseDir . '/../var/tmp');
	}

}
