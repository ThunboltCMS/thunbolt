<?php

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
	function bb($var, $length = NULL, $depth = NULL) {
		$backtrace = debug_backtrace();
		if (isset($backtrace[1]['class'])) {
			$source = $backtrace[1]['class'] . '::' . $backtrace[1]['function'];
		} else {
			$source = basename($backtrace[0]['file']);
		}
		$line = $backtrace[0]['line'];
		Debugger::barDump($var, $source . ' (' . $line . ')', [
			Dumper::TRUNCATE => $length ? : Debugger::$maxLen,
			Dumper::DEPTH => $depth ? : Debugger::$maxDepth
		]);
	}
}

if (!function_exists('dd')) {
	/**
	 * Tracy\Debugger::dump() shortcut.
	 *
	 * @tracySkipLocation
	 * @param mixed $var
	 * @param int $length
	 * @param int $depth
	 */
	function dd($var, $length = NULL, $depth = NULL) {
		Debugger::dump($var, [
			Dumper::TRUNCATE => $length ? : Debugger::$maxLen,
			Dumper::DEPTH => $depth ? : Debugger::$maxDepth
		]);
	}
}

if (!function_exists('timer')) {
	/**
	 * @param string $name
	 */
	function timer($name = NULL) {
		Debugger::timer($name);
	}
}

if (!function_exists('endTimer')) {
	/**
	 * @param string $name
	 */
	function endTimer($name = NULL) {
		bb(Debugger::timer($name) * 1000);
	}
}
