<?php
/**
 * ImportProcessObserverInterface.php
 *
 * @package WPImport\Common
 */

namespace WPImport\Common;

use WPImport\Core\ImportProcessInterface;

/**
 * Interface for observing an import process.
 */
interface ImportProcessObserverInterface {

	/**
	 * Invoked before the import process starts.
	 *
	 * @param ImportProcessInterface $import_process
	 *
	 * @return void
	 */
	public function before_import_start( ImportProcessInterface $import_process ): void;

	/**
	 * Invoked after the import process finishes.
	 *
	 * @param ImportProcessInterface $import_process
	 *
	 * @return void
	 */
	public function after_import_finish( ImportProcessInterface $import_process ): void;

}