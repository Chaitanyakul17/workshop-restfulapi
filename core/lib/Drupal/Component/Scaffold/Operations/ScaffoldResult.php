<?php

namespace Drupal\Component\Scaffold\Operations;

use Drupal\Component\Scaffold\ScaffoldFilePath;

/**
 * Record the result of a scaffold operation.
 */
class ScaffoldResult {

  /**
   * The path to the scaffold file that was processed.
   *
   * @var \Drupal\Component\Scaffold\ScaffoldFilePath
   */
  protected $destination;

  /**
   * Indicates if this scaffold file is managed by the scaffold command.
   *
   * @var bool
   */
  protected $managed;

  /**
   * ScaffoldResult constructor.
   *
   * @param \Drupal\Component\Scaffold\ScaffoldFilePath $destination
   *   The path to the scaffold file that was processed.
   * @param bool $isManaged
   *   (optional) Whether this result is managed. Defaults to FALSE.
   */
  public function __construct(ScaffoldFilePath $destination, $isManaged = FALSE) {
    $this->destination = $destination;
    $this->managed = $isManaged;
  }

  /**
   * Determines whether this scaffold file is managed.
   *
   * @return bool
   *   TRUE if this scaffold file is managed, FALSE if not.
   */
  public function isManaged() {
    return $this->managed;
  }

  /**
   * Gets the destination scaffold file that this result refers to.
   *
   * @return \Drupal\Component\Scaffold\ScaffoldFilePath
   *   The destination path for the scaffold result.
   */
  public function destination() {
    return $this->destination;
  }

}
