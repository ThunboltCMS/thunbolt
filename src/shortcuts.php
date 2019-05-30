<?php declare(strict_types=1);

use Tracy\Debugger;
use Tracy\Dumper;

if (!function_exists('bb')) {
	/**
	 * Tracy\Debugger::barDump() shortcut.
	 *
	 * @tracySkipLocation
	 * @param mixed $var
	 * @param int $length
	 * @param int $depth
	 */
	function bb($var, int $depth = NULL): void {
		$backtrace = debug_backtrace();
		if (isset($backtrace[1]['class'])) {
			$source = $backtrace[1]['class'] . '::' . $backtrace[1]['function'];
		} else {
			$source = basename($backtrace[0]['file']);
		}
		$line = $backtrace[0]['line'];

		bdump($var, $source . ' (' . $line . ')', [
			'truncate' => 9999,
			'depth' => $depth ?: Debugger::$maxDepth,
		]);
	}
}

if (!function_exists('timer')) {
	/**
	 * @param string $name
	 */
	function timer(string $name = NULL): void {
		Debugger::timer($name);
	}
}

if (!function_exists('endTimer')) {
	/**
	 * @param string $name
	 * @param bool $pretty
	 */
	function endTimer(string $name = NULL, bool $pretty = TRUE): void {
		$time = Debugger::timer($name);
		if ($time === 0) {
			trigger_error('You have not started timer.');
			return;
		}
		if (!$pretty) {
			bb($time);
			return;
		}
		$sec = floor($time);
		$ms = floor(($time - $sec) * 1e3);
		$us = NULL;
		if ($sec == 0 && $ms < 10) {
			$us = " µs: " . floor((($time * 1e3) - $ms) * 1e3);
		}
		bb("sec: $sec ms: $ms$us");
	}
}
