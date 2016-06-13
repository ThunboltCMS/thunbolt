<?php

namespace Thunbolt\DI;

use Nette\DI\CompilerExtension;

class ThunboltExtension extends CompilerExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		$builder->parameters['insDir'] = $builder->parameters['appDir'] . '/../ins';
		$builder->parameters['modDir'] = $builder->parameters['appDir'] . '/modules';
	}

}
