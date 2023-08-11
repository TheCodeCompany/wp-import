<?php
/**
 * ImporterObserverInterface.php
 *
 * @package WPImport\Common
 */

namespace WPImport\Common;

use WPImport\Core\ImporterInterface;

/**
 * Interface for observing an importer.
 */
interface ImporterObserverInterface {

	/**
	 * After a model has been imported by the importer.
	 *
	 * @param ImporterInterface $importer Importer.
	 *
	 * @return void
	 */
	public function after_model_imported( ImporterInterface $importer ): void;
}
