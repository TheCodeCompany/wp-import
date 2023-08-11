<?php
/**
 * LoggerInterface.php
 *
 * @package WPImport\Common
 */

namespace WPImport\Common;

/**
 * Interface for logging information.
 */
interface LoggerInterface {

	/**
	 * Logs a message with context and severity.
	 *
	 * @param string $log_level Log level, according to RFC 5424 Syslog protocol. emergency|alert|critical|error|warning|notice|info|debug.
	 * @param string $message   Message to log.
	 * @param array  $context   Context.
	 *
	 * @return void
	 */
	public function log( string $log_level, string $message, array $context = [] ): void;
}