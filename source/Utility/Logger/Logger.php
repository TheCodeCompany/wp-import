<?php
/**
 * Logger.php
 *
 * @package WPImport\Utility\Logger
 */

namespace WPImport\Utility\Logger;

use WPImport\Common\LoggerInterface;

/**
 * Abstract logger implementation.
 *
 * @package WPImport\Utility\Logger
 */
abstract class Logger implements LoggerInterface {

	/**
	 * The system is unusable, and immediate attention is required.
	 */
	public const LOG_LEVEL_EMERGENCY = 'emergency';

	/**
	 * Action must be taken immediately, often a severe event that has already impacted the system.
	 */
	public const LOG_LEVEL_ALERT = 'alert';

	/**
	 * Critical conditions, which usually indicate severe problems that may lead to system failure or other significant issues.
	 */
	public const LOG_LEVEL_CRITICAL = 'critical';

	/**
	 * Error conditions, such as runtime errors or unexpected conditions that might not immediately impact the system but should be addressed.
	 */
	public const LOG_LEVEL_ERROR = 'error';

	/**
	 * Warning messages, which indicate potential problems or issues that might not be critical but should be taken into consideration.
	 */
	public const LOG_LEVEL_WARNING = 'warning';

	/**
	 * Normal but significant events, often used to log noteworthy situations that are not errors or warnings but still deserve attention.
	 */
	public const LOG_LEVEL_NOTICE = 'notice';

	/**
	 * Informational messages, which provide general information about the normal operation of the system.
	 */
	public const LOG_LEVEL_INFO = 'info';

	/**
	 * Debug-level messages, which are primarily used during development and troubleshooting to provide detailed information about the system's internal state.
	 */
	public const LOG_LEVEL_DEBUG = 'debug';

	/**
	 * Log emergency message.
	 * The system is unusable, and immediate attention is required.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_emergency( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_EMERGENCY, $message, $context );
	}

	/**
	 * Log alert message.
	 * Action must be taken immediately, often a severe event that has already impacted the system.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_alert( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_ALERT, $message, $context );
	}

	/**
	 * Log critical message.
	 * Critical conditions, which usually indicate severe problems that may lead to system failure or other significant issues.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_critical( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_CRITICAL, $message, $context );
	}

	/**
	 * Log error message.
	 * Error conditions, such as runtime errors or unexpected conditions that might not immediately impact the system but should be addressed.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_error( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_ERROR, $message, $context );
	}

	/**
	 * Log warning message.
	 * Warning messages, which indicate potential problems or issues that might not be critical but should be taken into consideration.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_warning( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_WARNING, $message, $context );
	}

	/**
	 * Log notice message.
	 * Normal but significant events, often used to log noteworthy situations that are not errors or warnings but still deserve attention.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_notice( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_NOTICE, $message, $context );
	}

	/**
	 * Log info message.
	 * Informational messages, which provide general information about the normal operation of the system.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_info( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_INFO, $message, $context );
	}

	/**
	 * Log debug message.
	 * Debug-level messages, which are primarily used during development and troubleshooting to provide detailed information about the system's internal state.
	 *
	 * @param string $message Message to log.
	 * @param array  $context Context.
	 *
	 * @return void
	 */
	public function log_debug( string $message, array $context = [] ): void {
		$this->log( self::LOG_LEVEL_DEBUG, $message, $context );
	}
}