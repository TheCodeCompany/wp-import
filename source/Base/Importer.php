<?php
/**
 * Importer.php
 *
 * @package WPImport\Base
 */

namespace WPImport\Base;

use WPImport\Core\ImporterInterface;

/**
 * Imports data into a destination dataset.
 * Base foundation for importers.
 *
 * @package WPImport\Base
 */
abstract class Importer implements ImporterInterface {

	/**
	 * Imports a collection of models or items of data.
	 *
	 * @param mixed $data The collection of models or items to import, ideally iterable.
	 *
	 * @return mixed Combined results of importing the collection of data.
	 */
	abstract public function import_collection( mixed $data): mixed;
}