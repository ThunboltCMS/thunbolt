<?php declare(strict_types = 1);

namespace Thunbolt;

use Nette\Configurator;
use Thunbolt\DI\ThunboltExtension;

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
		$this->configurator->enableDebugger($this->baseDir . '/../var/log');
		$this->configurator->setTempDirectory($this->baseDir . '/../var/tmp');
	}

}
