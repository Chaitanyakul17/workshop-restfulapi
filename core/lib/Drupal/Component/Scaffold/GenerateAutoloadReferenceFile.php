<?php

namespace Drupal\Component\Scaffold;

use Composer\IO\IOInterface;
use Composer\Util\Filesystem;
use Drupal\Component\Scaffold\Operations\ScaffoldResult;

/**
 * Generates an 'autoload.php' that includes the autoloader created by Composer.
 */
final class GenerateAutoloadReferenceFile {

  /**
   * This class provides only static methods.
   */
  private function __construct() {
  }

  /**
   * Generates the autoload file at the specified location.
   *
   * This only writes a bit of PHP that includes the autoload file that
   * Composer generated. Drupal does this so that it can guarantee that there
   * will always be an `autoload.php` file in a well-known location.
   *
   * @param \Composer\IO\IOInterface $io
   *   IOInterface to write to.
   * @param string $package_name
   *   The name of the package defining the autoload file (the root package).
   * @param string $web_root
   *   The path to the web root.
   * @param string $vendor
   *   The path to the vendor directory.
   *
   * @return \Drupal\Component\Scaffold\Operations\ScaffoldResult
   *   The result of the autoload file generation.
   */
  public static function generateAutoload(IOInterface $io, $package_name, $web_root, $vendor) {
    $autoload_path = static::autoloadPath($package_name, $web_root);
    $location = dirname($autoload_path->fullPath());
    // Calculate the relative path from the webroot (location of the project
    // autoload.php) to the vendor directory.
    $fs = new Filesystem();
    $relative_vendor_path = $fs->findShortestPath(realpath($location), $vendor);
    file_put_contents($autoload_path->fullPath(), static::autoLoadContents($relative_vendor_path));
    return new ScaffoldResult($autoload_path, TRUE);
  }

  /**
   * Determines whether or not the autoload file has been committed.
   *
   * @param \Composer\IO\IOInterface $io
   *   IOInterface to write to.
   * @param string $package_name
   *   The name of the package defining the autoload file (the root package).
   * @param string $web_root
   *   The path to the web root.
   *
   * @return bool
   *   True if autoload.php file exists and has been committed to the repository
   */
  public static function autoloadFileCommitted(IOInterface $io, $package_name, $web_root) {
    $autoload_path = static::autoloadPath($package_name, $web_root);
    $autoload_file = $autoload_path->fullPath();
    $location = dirname($autoload_file);
    if (!file_exists($autoload_file)) {
      return FALSE;
    }
    return Git::checkTracked($io, $autoload_file, $location);
  }

  /**
   * Generates a scaffold file path object for the autoload file.
   *
   * @param string $package_name
   *   The name of the package defining the autoload file (the root package).
   * @param string $web_root
   *   The path to the web root.
   *
   * @return \Drupal\Component\Scaffold\ScaffoldFilePath
   *   Object wrapping the relative and absolute path to the destination file.
   */
  protected static function autoloadPath($package_name, $web_root) {
    $rel_path = 'autoload.php';
    $dest_rel_path = '[web-root]/' . $rel_path;
    $dest_full_path = $web_root . '/' . $rel_path;
    return new ScaffoldFilePath('autoload', $package_name, $dest_rel_path, $dest_full_path);
  }

  /**
   * Builds the contents of the autoload file.
   *
   * @param string $vendor_path
   *   The relative path to vendor.
   *
   * @return string
   *   Return the contents for the autoload.php.
   */
  protected static function autoLoadContents($vendor_path) {
    $vendor_path = rtrim($vendor_path, '/');
    return <<<EOF
<?php

/**
 * @file
 * Includes the autoloader created by Composer.
 *
 * This file was generated by composer-scaffold.
 *.
 * @see composer.json
 * @see index.php
 * @see core/install.php
 * @see core/rebuild.php
 * @see core/modules/statistics/statistics.php
 */

return require __DIR__ . '/{$vendor_path}/autoload.php';

EOF;
  }

}
