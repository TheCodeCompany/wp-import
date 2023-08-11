<?php
/**
 * ImportProcessInterface.php
 *
 * @package WPImport\Core
 */

namespace WPImport\Core;

/**
 * Interface for handling a process that imports data from an external source
 * into a destination.
 * Likely used in conjunction with an object that implements the
 * ImporterInterface and an external data source such as an API, database
 * connection or CSV/XML file.
 */
interface ImportProcessInterface {

	/**
	 * Runs a process that imports data from an external data source into a
	 * destination dataset.
	 *
	 * @return void
	 */
	public function import(): void;
}