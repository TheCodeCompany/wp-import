<?php
/**
 * WPCLILogger.php
 *
 * @package WPImport\Utility\Logger
 */

namespace WPImport\Utility\Logger;

use cli\progress\Bar;
use WP_CLI\ExitException;
use WP_CLI\NoOp;
use function WP_CLI\Utils\make_progress_bar;

/**
 * Logger for WP CLI.
 * Supports use of progress bars.
 * Requires WP CLI to be loaded.
 *
 * @package WPImport\Utility\Logger
 */
class WPCLILogger extends Logger {

	/**
	 * WP CLI progress bars.
	 *
	 * @var array|Bar[]|NoOp[]
	 */
	protected array $progress_bars = [];

	/**
	 * Adds a progress bar to track internally.
	 *
	 * @param string|int $id           Unique identifier for the bar.
	 * @param Bar|NoOp   $progress_bar Progress bar.
	 *
	 * @return void
	 */
	protected function add_progress_bar( string|int $id, Bar|NoOp $progress_bar ): void {
		$this->progress_bars[ $id ] = $progress_bar;
	}

	/**
	 * Gets a progress bar.
	 *
	 * @param string|int $id Unique identifier for the bar.
	 *
	 * @return null|Bar|NoOp
	 */
	protected function get_progress_bar( string|int $id ): null|Bar|NoOp {
		return $this->progress_bars[ $id ] ?? null;
	}

	/**
	 * Unsets a progress bar.
	 *
	 * @param string|int $id Unique identifier for the bar.
	 *
	 * @return void
	 */
	protected function unset_progress_bar( string|int $id ): void {
		unset( $this->progress_bars[ $id ] );
	}

	/**
	 * @inheritDoc
	 */
	public function log( string $log_level, string $message, array $context = [] ): void {
		\WP_CLI::log( $message );
	}

	/**
	 * @inheritDoc
	 */
	public function log_emergency( string $message, array $context = [] ): void {
		$this->wp_cli_error( $message );
	}

	/**
	 * @inheritDoc
	 */
	public function log_alert( string $message, array $context = [] ): void {
		$this->wp_cli_error_multiline( [ $message ] );
	}

	/**
	 * @inheritDoc
	 */
	public function log_critical( string $message, array $context = [] ): void {
		$this->wp_cli_error_multiline( [ $message ] );
	}

	/**
	 * @inheritDoc
	 */
	public function log_error( string $message, array $context = [] ): void {
		$this->wp_cli_error_multiline( [ $message ] );
	}

	/**
	 * @inheritDoc
	 */
	public function log_warning( string $message, array $context = [] ): void {
		$this->wp_cli_warning( $message );
	}

	/**
	 * @inheritDoc
	 */
	public function log_notice( string $message, array $context = [] ): void {
		$this->wp_cli_log( $message );
	}

	/**
	 * @inheritDoc
	 */
	public function log_info( string $message, array $context = [] ): void {
		$this->wp_cli_log( $message );
	}

	/**
	 * @inheritDoc
	 */
	public function log_debug( string $message, array $context = [] ): void {
		// Log debug messages using normal log as debug messages are disabled
		// on WP VIP environments.
		$this->wp_cli_log( $message );
	}

	/**
	 * Logs an error to WP CLI.
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_error( string $message ): void {
		try {
			\WP_CLI::error( $message );
		} catch ( ExitException $exception ) {

			// Notify that an exception occurred.
			$this->wp_cli_error_multiline( [ $exception->getMessage() ] );

			// Attempt to log the original message.
			$this->wp_cli_error_multiline( [ $message ] );
		}
	}

	/**
	 * Logs multiple error messages to WP CLI.
	 *
	 * @param array $message_lines Message lines.
	 *
	 * @return void
	 */
	public function wp_cli_error_multiline( array $message_lines ): void {
		\WP_CLI::error_multi_line( $message_lines );
	}

	/**
	 * Logs a warning to WP CLI.
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_warning( string $message ): void {
		\WP_CLI::warning( $message );
	}

	/**
	 * Logs a debug message to WP CLI.
	 *
	 * @param string      $message The message.
	 * @param bool|string $group   Debug group.
	 *
	 * @return void
	 */
	public function wp_cli_debug( string $message, bool|string $group = false ): void {
		\WP_CLI::debug( $message, $group );
	}

	/**
	 * Logs a message to WP CLI.
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_log( string $message ): void {
		\WP_CLI::log( $message );
	}

	/**
	 * Logs a line to WP CLI.
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_line( string $message ): void {
		\WP_CLI::line( $message );
	}

	/**
	 * Colourise a string for output.
	 * https://make.wordpress.org/cli/handbook/references/internal-api/wp-cli-colorize/
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_colorize( string $message ): void {
		\WP_CLI::colorize( $message );
	}

	/**
	 * Logs a success message to WP CLI.
	 * Ends process execution.
	 *
	 * @param string $message The message.
	 *
	 * @return void
	 */
	public function wp_cli_success( string $message ): void {
		\WP_CLI::success( $message );
	}

	/**
	 * Makes a progress bar.
	 *
	 * @param string|int $id       Unique identifier for the bar.
	 * @param string     $message  The message or label for the bar.
	 * @param int        $count    The number of items being tracked by the bar.
	 * @param int        $interval Optional. The interval in milliseconds between updates. Default 100.
	 *
	 * @return Bar|NoOp
	 */
	public function make_progress_bar( string|int $id, string $message, int $count, int $interval = 100 ) {
		$progress_bar = make_progress_bar( $message, $count, $interval );
		$this->add_progress_bar( $id, $progress_bar );

		return $progress_bar;
	}

	/**
	 * Ticks a progress bar.
	 *
	 * @param string|int  $id        Unique identifier for the bar.
	 * @param int         $increment The amount to increment by.
	 * @param null|string $msg       The text to display next to the Notifier. (optional).
	 *
	 * @return void
	 */
	public function tick_progress_bar( string|int $id, int $increment = 1, ?string $msg = null ): void {
		$this->get_progress_bar( $id )?->tick( $increment, $msg );
	}

	/**
	 * Finishes a progress bar.
	 *
	 * @param string|int $id Unique identifier for the bar.
	 *
	 * @return void
	 */
	public function finish_progress_bar( string|int $id ): void {
		$this->get_progress_bar( $id )?->finish();
		$this->unset_progress_bar( $id );
	}
}