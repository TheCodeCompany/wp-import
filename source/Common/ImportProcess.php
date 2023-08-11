<?php
/**
 * ImportProcess.php
 *
 * @package WPImport\Common
 */

namespace WPImport\Common;

use WPImport\Core\ImportProcessInterface;

/**
 * General structure for an import process.
 * This is more specific than what may be required for a given project but this
 * is useful for complex imports.
 *
 * @package WPImport\Base
 */
abstract class ImportProcess implements ImportProcessInterface {
}