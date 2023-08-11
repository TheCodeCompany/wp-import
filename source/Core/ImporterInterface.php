<?php
/**
 * ImporterInterface.php
 *
 * @package WPImport\Core
 */

namespace WPImport\Core;

/**
 * Interface for importing data from an external source into a destination
 * dataset.
 */
interface ImporterInterface {

	/**
	 * Imports a single model, object or item of data.
	 *
	 * @param mixed $data The data to be used for importing the model.
	 *
	 * @return mixed The imported model or a relevant response if an error occurs.
	 */
	public function import_single( mixed $data ): mixed;
}