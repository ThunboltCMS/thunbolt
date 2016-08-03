<?php

namespace Thunbolt;

use Nette\Configurator;
use Thunbolt\SoftExtensions\DI\SoftExtensionsExtension;

class Bootstrap {

	/** @var string */
	private $baseDir;

	/** @var Configurator */
	private $configurator;

	/**
	 * @param string $baseDir
	 */
	public function __construct($baseDir, Configurator $configurator) {
		$this->baseDir = $baseDir;
		$this->configurator = $configurator;
	}

	public function loadComposerConfig($path = NULL) {
		$configFile = $path ? : $this->baseDir . '/../mod/composer.json';
		if (file_exists($configFile)) {
			$configs = json_decode(file_get_contents($configFile), TRUE);
			if (isset($configs['configs']) && is_array($configs['configs'])) {
				foreach ($configs['configs'] as $config) {
					$this->configurator->addConfig($this->baseDir . '/../' . $config);
				}
			}
		}
	}

	public function initialize() {
		if (class_exists(SoftExtensionsExtension::class)) {
			SoftExtensionsExtension::register($this->configurator);
		}
	}

}
