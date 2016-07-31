<?php

namespace Thunbolt;

use Nette\Configurator;
use Thunbolt\Errors\ErrorTemplate;
use Tracy\Debugger;

class Bootstrap {

	/** @var string */
	private $baseDir;

	/**
	 * @param string $baseDir
	 */
	public function __construct($baseDir) {
		$this->baseDir = $baseDir;
	}

	/**
	 * @param Configurator $configurator
	 */
	public function loadComposerConfig(Configurator $configurator) {
		$configFile = $this->baseDir . '/../mod/composer.json';
		if (file_exists($configFile)) {
			$configs = json_decode(file_get_contents($configFile), TRUE);
			if (isset($configs['configs']) && is_array($configs['configs'])) {
				foreach ($configs['configs'] as $config) {
					$configurator->addConfig($this->baseDir . '/../' . $config);
				}
			}
		}
	}

	public function initialize() {
		// Own error template
		if (!Debugger::$errorTemplate && class_exists('Thunbolt\Errors\ErrorTemplate')) {
			Debugger::$errorTemplate =  ErrorTemplate::getErrorTemplate();
		}
	}

}
