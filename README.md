BrowserDetection
================

The [Wolfcast](https://wolfcast.com/) BrowserDetection PHP class facilitates the identification of the user's environment such as Web browser, version, platform family, platform version or if it's a mobile device or not.

This class will try to detect what the user is using from the `HTTP_USER_AGENT` string sent by the Web browser. A good way to use the class would be to gather user statistics or to report the browser and version used for informational purposes. A bad way to use the class would be to serve content based on the browser and version used. **Sites that rely on the user-agent string should be updated to modern techniques, such as feature detection, adaptive layout, and other modern practices.**

Always keep in mind that `HTTP_USER_AGENT` can be easily spoofed by the user.

Features
--------

The [Wolfcast](https://wolfcast.com/) BrowserDetection PHP class is the most accurate detection class. **It has been tested with 14000+ different user agent strings and it have a 99.95% accuracy ratio!**

Natively detects the following browsers:

  * Android
  * BlackBerry
  * BlackBerry Tablet OS
  * Chrome
  * Edge
  * Firebird
  * Firefox
  * GNU IceCat
  * GNU IceWeasel
  * iCab
  * Internet Explorer
  * Internet Explorer Mobile
  * Konqueror
  * Lynx
  * Mozilla
  * MSN TV
  * Netscape
  * Nokia Browser
  * Opera
  * Opera Mini
  * Opera Mobile
  * Phoenix
  * Safari
  * Samsung Internet
  * UC Browser

You can also easily add custom rules to support other browsers not natively supported!

Natively detects the following robots:

  * Bingbot
  * Googlebot
  * MSNBot
  * W3C Validator
  * Yahoo! Multimedia
  * Yahoo! Slurp

You can also easily add custom rules to support other robots not natively supported!

Natively detects the following platforms:
  * Android
  * BlackBerry
  * Chrome OS
  * FreeBSD
  * iOS
  * Linux
  * Macintosh
  * NetBSD
  * Nokia
  * OpenBSD
  * OpenSolaris
  * Symbian
  * Windows
  * Windows CE
  * Windows Phone

You can also easily add custom rules to support other platforms not natively supported!

Requirements
------------

Requires PHP 5.3 or newer (tested with PHP 8.4.5, 7.4.33 and 5.6.40).

Demo and full documentation
---------------------------

You can try the [live demo](https://wolfcast.com/open-source/browser-detection/tutorial.php) of the class and you can read the [documentation](https://wolfcast.com/open-source/browser-detection/doc/classes/Wolfcast-BrowserDetection.html).

Installation
------------

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/) ([Packagist link](https://packagist.org/packages/wolfcast/browser-detection)):

    composer require wolfcast/browser-detection

You can also manually install this library by adding `BrowserDetection.php` (found in the `lib` directory) to your project and then `require_once` the library where needed.

Usage
-----

```
require_once('BrowserDetection.php');

$browser = new Wolfcast\BrowserDetection();
if ($browser->getName() == Wolfcast\BrowserDetection::BROWSER_FIREFOX &&
    $browser->compareVersions($browser->getVersion(), '5.0') >= 0) {
    echo 'You are using FireFox version 5 or greater.';
}
```

History
-------

Correctly identifying what Web browser your users are using is an incredibly complex task. If you ever tried to implement something like this you quickly saw how this can become a code mess. Only a few libraries exist and they often get deprecated and becomes abandonware. This is why we created our own detection engine. We didn't start from scratch. The class is a heavily updated version of Chris Schuld's Browser class version 1.9 (which was unmaintained for a couple of years). Chris' class was based on the original work from Gary White.

License
-------

SPDX-License-Identifier: MIT OR LGPL-3.0-only