<?php declare(strict_types = 1);

namespace Thunbolt;

class ProjectDirectories {

	/** @var string */
	protected $wwwDir;

	/** @var string */
	protected $appDir;

	/** @var string */
	protected $bundlesDir;

	/** @var string */
	protected $layoutsDir;

	/** @var string */
	protected $templatesDir;

	public function __construct(string $wwwDir, string $appDir, string $bundlesDir, string $layoutsDir, string $templatesDir) {
		$this->wwwDir = $wwwDir;
		$this->appDir = $appDir;
		$this->bundlesDir = $bundlesDir;
		$this->layoutsDir = $layoutsDir;
		$this->templatesDir = $templatesDir;
	}

	public function getWwwDir(): string {
		return $this->wwwDir;
	}

	public function getAppDir(): string {
		return $this->appDir;
	}

	public function getBundlesDir(): string {
		return $this->bundlesDir;
	}

	public function getLayoutsDir(): string {
		return $this->layoutsDir;
	}

	public function getTemplatesDir(): string {
		return $this->templatesDir;
	}

}
