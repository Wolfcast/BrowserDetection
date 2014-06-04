BrowserDetection
================

The [Wolfcast](http://wolfcast.com/) BrowserDetection PHP class facilitates the identification of the user's environment such as Web browser, version, platform or if it's a mobile device.

This class will try to detect what the user uses from the `HTTP_USER_AGENT` string sent by the user. A good way to use the class would be to gather user statistics or to report the browser and version used for informational purposes. A bad way to use the class would be to serve content based on the browser and or version. **Sites that rely on the user-agent string should be updated to modern techniques, such as feature detection, adaptive layout, and other modern practices.**

Always keep in mind that `HTTP_USER_AGENT` can be easily spoofed.

Installation
============

To install, simply upload `BrowserDetection.php` (found in the `lib` directory) to your web host and `require_once` it in your PHP script.

Usage
=====

```
$browser = new BrowserDetection();
if ($browser->getBrowser() == BrowserDetection::BROWSER_FIREFOX && $browser->getVersion() >= 5) {
    echo 'You have FireFox version 5 or greater.';
}
```

History
=======

Correctly identifying what Web browser your users use is an incredibly complex task. If you ever tried to implement something like this you quickly saw how this can become a code mess. Only a few libraries exists and they often get deprecated and becomes useless abandonware. This is why we created our own detection engine. We didn't started from scratch. The class is a heavily updated version of Chris Schuld's Browser class version 1.9 (which was unmaintained for a couple of years). Chris' class was based on the original work from Gary White.

License
=======

This program is free software; you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version (if any).

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details at: [http://www.gnu.org/licenses/lgpl.html](http://www.gnu.org/licenses/lgpl.html)
