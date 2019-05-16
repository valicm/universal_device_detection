<?php

namespace Drupal\universal_device_detection\Detector;

use DeviceDetector\DeviceDetector;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class DefaultDetector.
 *
 * @package Drupal\universal_device_detection\Detector
 */
class DefaultDetector implements DeviceDetectorInterface {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Static cache of device information. One per request.
   *
   * @var \SplObjectStorage
   */
  protected $detection;

  /**
   * Constructs a new DefaultDetector object.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   */
  public function __construct(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
    $this->detection = new \SplObjectStorage();
  }

  /**
   * {@inheritdoc}
   */
  public function detect($bot = TRUE) {
    $request = $this->requestStack->getCurrentRequest();

    // Get user agent.
    $userAgent = $request->headers->get('User-Agent');

    if (!$this->detection->contains($request)) {
      // Initialize device detector.
      $detect = new DeviceDetector($userAgent);

      // Skip detection of bot, process as normal devices.
      if (!$bot) {
        $detect->skipBotDetection();
      }

      $detect->parse();

      // Separate bot.
      if ($bot && $detect->isBot()) {
        $device['info'] = $detect->getBot();
        // Add generic type for bot.
        $device['type'] = 'bot';
      }
      else {
        // Get device type.
        // @see \DeviceDetector\Parser\Device\DeviceParserAbstract::$deviceTypes
        $device['type'] = $detect->getDeviceName();

        // Get device info.
        $device['info'] = [
          'client' => $detect->getClient(),
          'os' => $detect->getOs(),
          'brand' => $detect->getBrandName(),
          'model' => $detect->getModel(),
        ];
      }

      $this->detection[$request] = $device;
    }

    return $this->detection[$request];
  }

}
