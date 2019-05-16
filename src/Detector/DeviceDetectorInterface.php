<?php

namespace Drupal\universal_device_detection\Detector;

/**
 * Defines the interface for country resolvers.
 */
interface DeviceDetectorInterface {

  /**
   * Detect device information.
   *
   * @param bool $bot
   *   If bot are to be included in parsing.
   *
   * @return array
   *   Device information array.
   */
  public function detect($bot);

}
