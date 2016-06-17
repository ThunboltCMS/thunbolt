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
	 * @param bool $pretty
	 */
	function endTimer($name = NULL, $pretty = TRUE) {
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
