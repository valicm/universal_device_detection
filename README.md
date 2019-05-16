CONTENTS OF THIS FILE
---------------------

* Introduction
* Requirements
* Installation
* Configuration
* Usage
* Maintainers


INTRODUCTION
------------

Drupal 8 module providing service for device detection using
device detector library.
https://github.com/matomo-org/device-detector

The Universal Device Detection library that parses User Agents and detects
devices (desktop, tablet, mobile, tv, cars, console, etc.),
clients (browsers, feed readers, media players, PIMs, ...),
operating systems, brands and models.



REQUIREMENTS
------------

Device detector PHP library https://github.com/matomo-org/device-detector


INSTALLATION
------------

Install the Universal Device Detection module as you would normally install
any Drupal contrib module.
Visit https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
--------------

None


USAGE
--------------

This module does not do anything out of the box, just provide service which you
can use in your code.

`\Drupal::service('universal_device_detection.default')->detect();`

If you want process bots as normal devices:
`\Drupal::service('universal_device_detection.default')->detect(FALSE);`

Example of response

```array (
  'type' => 'desktop',
  'info' => 
  array (
    'client' => 
    array (
      'type' => 'browser',
      'name' => 'Chromium',
      'short_name' => 'CR',
      'version' => '73.0',
      'engine' => 'Blink',
      'engine_version' => '',
    ),
    'os' => 
    array (
      'name' => 'Ubuntu',
      'short_name' => 'UBT',
      'version' => '',
      'platform' => 'x64',
    ),
    'brand' => '',
    'model' => '',
  ),
)
```


MAINTAINERS
-----------

The 8.x-1.x branch was created by:

 * Valentino Medimorec (valic) - https://www.drupal.org/u/valic

This module was created and sponsored by Foreo,
Swedish multi-national beauty brand.

 * Foreo - https://www.foreo.com/
