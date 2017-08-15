<?php

declare(strict_types=1);

namespace Thunbolt;

use Nette\Http\IRequest;
use Thunbolt\Composer\ComposerDirectories;

class Directories {

	/** @var string */
	private $wwwDir;

	/** @var string */
	private $appDir;

	/** @var string */
	private $bundlesDir;

	/** @var string */
	private $layoutsDir;

	/** @var string */
	private $pluginsDir;

	/** @var string */
	private $pluginAssetsDir;

	/** @var string */
	private $pluginAssetsUrlPath;

	public function __construct(string $wwwDir, string $appDir, string $bundlesDir, string $layoutsDir,
								string $pluginsDir, string $pluginAssetsDir, IRequest $request) {
		$this->wwwDir = $wwwDir;
		$this->appDir = $appDir;
		$this->bundlesDir = $bundlesDir;
		$this->layoutsDir = $layoutsDir;
		$this->pluginsDir = $pluginsDir;
		$this->pluginAssetsDir = $pluginAssetsDir;

		$this->pluginAssetsUrlPath = $request->getUrl()->getBasePath() . ComposerDirectories::PLUGIN_ASSETS_DIR;
	}

	/**
	 * @return string
	 */
	public function getPluginAssetsUrlPath(): string {
		return $this->pluginAssetsUrlPath;
	}

	/**
	 * Returns url assets path of plugin
	 *
	 * @param string $packageName composer package name
	 * @return string
	 */
	public function getPluginAssetsUrlPathOfPlugin(string $packageName): string {
		return $this->pluginAssetsUrlPath . '/' . $packageName;
	}

	/**
	 * @return string
	 */
	public function getWwwDir(): string {
		return $this->wwwDir;
	}

	/**
	 * @return string
	 */
	public function getAppDir(): string {
		return $this->appDir;
	}

	/**
	 * @return string
	 */
	public function getBundlesDir(): string {
		return $this->bundlesDir;
	}

	/**
	 * @return string
	 */
	public function getLayoutsDir(): string {
		return $this->layoutsDir;
	}

	/**
	 * @return string
	 */
	public function getPluginsDir(): string {
		return $this->pluginsDir;
	}

	/**
	 * @return string
	 */
	public function getPluginAssetsDir(): string {
		return $this->pluginAssetsDir;
	}

}
