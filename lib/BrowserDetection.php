<?php

/**
 * Browser detection class file.
 * This file contains everything required to use the BrowserDetection class.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU Lesser General
 * Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any
 * later version (if any).
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License for more
 * details at: http://www.gnu.org/licenses/lgpl.html
 *
 * @package Browser_Detection
 * @version 2.3.0
 * @last-modified February 11, 2016
 * @author Alexandre Valiquette
 * @copyright Copyright (c) 2016, Wolfcast
 * @link http://wolfcast.com/
 */


/**
 * The BrowserDetection class facilitates the identification of the user's environment such as Web browser, version,
 * platform or if it's a mobile device.
 *
 * Typical usage:
 *
 * $browser = new BrowserDetection();
 * if ($browser->getName() == BrowserDetection::BROWSER_FIREFOX &&
 *     $browser->compareVersions($browser->getVersion(), '5.0') >= 0) {
 *     echo 'You are using FireFox version 5 or greater.';
 * }
 *
 * The class is an updated version of Chris Schuld's Browser class version 1.9 which is unmaintained since August 20th,
 * 2010. Chris' class was based on the original work from Gary White.
 *
 * Updates:
 *
 * 2016-02-11: Version 2.3.0
 *  + WARNING! Breaking change: public method getBrowser() is renamed to getName().
 *  + WARNING! Breaking change: changed the compareVersions() return values to be more in line with other libraries.
 *  + You can now get the exact platform version (name or version numbers) on which the browser is run on with
 *    getPlatformVersion(). Only working with Windows operating systems at the moment.
 *  + You can now determine if the browser is executed from a 64-bit platform with is64bitPlatform().
 *  + Better detection of mobile platform for Googlebot.
 *
 * 2016-01-04: Version 2.2.0
 *  + Added support for Microsoft Edge.
 *
 * 2014-12-30: Version 2.1.2
 *  + Better detection of Opera.
 *
 * 2014-07-11: Version 2.1.1
 *  + Better detection of mobile devices and platforms.
 *
 * 2014-06-04: Version 2.1
 *  + Added support for IE 11+.
 *
 * 2013-05-27: Version 2.0 which is (almost) a complete rewrite based on Chris Schuld's Browser class version 1.9 plus
 * changes below.
 *  + Added support for Opera Mobile
 *  + Added support for the Windows Phone (formerly Windows Mobile) platform
 *  + Added support for BlackBerry Tablet OS and BlackBerry 10
 *  + Added support for the Symbian platform
 *  + Added support for Bingbot
 *  + Added support for the Yahoo! Multimedia crawler
 *  + Removed iPhone/iPad/iPod browsers since there are not browsers but platforms - test them with getPlatform()
 *  + Removed support for Shiretoko (Firefox 3.5 alpha/beta) and MSN Browser
 *  + Merged Nokia and Nokia S60
 *  + Updated some deprecated browser names
 *  + Many public methods are now protected
 *  + Documentation updated
 *
 * 2010-07-04:
 *  + Added detection of IE compatibility view - test with getIECompatibilityView()
 *  + Added support for all (deprecated) Netscape versions
 *  + Added support for Safari < 3.0
 *  + Better Firefox version parsing
 *  + Better Opera version parsing
 *  + Better Mozilla detection
 *
 * @package Browser_Detection
 * @version 2.3.0
 * @last-modified February 11, 2016
 * @author Alexandre Valiquette, Chris Schuld, Gary White
 * @copyright Copyright (c) 2016, Wolfcast
 * @license http://www.gnu.org/licenses/lgpl.html
 * @link http://wolfcast.com/
 * @link http://wolfcast.com/open-source/browser-detection/tutorial.php
 * @link http://chrisschuld.com/
 * @link http://www.apptools.com/phptools/browser/
 */
class BrowserDetection
{

    /**#@+
     * Constant for the name of the Web browser.
     */
    const BROWSER_AMAYA = 'Amaya';
    const BROWSER_ANDROID = 'Android';
    const BROWSER_BINGBOT = 'Bingbot';
    const BROWSER_BLACKBERRY = 'BlackBerry';
    const BROWSER_CHROME = 'Chrome';
    const BROWSER_EDGE = 'Edge';
    const BROWSER_FIREBIRD = 'Firebird';
    const BROWSER_FIREFOX = 'Firefox';
    const BROWSER_GALEON = 'Galeon';
    const BROWSER_GOOGLEBOT = 'Googlebot';
    const BROWSER_ICAB = 'iCab';
    const BROWSER_ICECAT = 'GNU IceCat';
    const BROWSER_ICEWEASEL = 'GNU IceWeasel';
    const BROWSER_IE = 'Internet Explorer';
    const BROWSER_IE_MOBILE = 'Internet Explorer Mobile';
    const BROWSER_KONQUEROR = 'Konqueror';
    const BROWSER_LYNX = 'Lynx';
    const BROWSER_MOZILLA = 'Mozilla';
    const BROWSER_MSNBOT = 'MSNBot';
    const BROWSER_MSNTV = 'MSN TV';
    const BROWSER_NETPOSITIVE = 'NetPositive';
    const BROWSER_NETSCAPE = 'Netscape';
    const BROWSER_NOKIA = 'Nokia Browser';
    const BROWSER_OMNIWEB = 'OmniWeb';
    const BROWSER_OPERA = 'Opera';
    const BROWSER_OPERA_MINI = 'Opera Mini';
    const BROWSER_OPERA_MOBILE = 'Opera Mobile';
    const BROWSER_PHOENIX = 'Phoenix';
    const BROWSER_SAFARI = 'Safari';
    const BROWSER_SLURP = 'Yahoo! Slurp';
    const BROWSER_TABLET_OS = 'BlackBerry Tablet OS';
    const BROWSER_UNKNOWN = 'unknown';
    const BROWSER_W3CVALIDATOR = 'W3C Validator';
    const BROWSER_YAHOO_MM = 'Yahoo! Multimedia';
    /**#@-*/

    /**#@+
     * Constant for the name of the platform of the Web browser.
     */
    const PLATFORM_ANDROID = 'Android';
    const PLATFORM_BEOS = 'BeOS';
    const PLATFORM_BLACKBERRY = 'BlackBerry';
    const PLATFORM_FREEBSD = 'FreeBSD';
    const PLATFORM_IPAD = 'iPad';
    const PLATFORM_IPHONE = 'iPhone';
    const PLATFORM_IPOD = 'iPod';
    const PLATFORM_LINUX = 'Linux';
    const PLATFORM_MACINTOSH = 'Macintosh';
    const PLATFORM_NETBSD = 'NetBSD';
    const PLATFORM_NOKIA = 'Nokia';
    const PLATFORM_OPENBSD = 'OpenBSD';
    const PLATFORM_OPENSOLARIS = 'OpenSolaris';
    const PLATFORM_OS2 = 'OS/2';
    const PLATFORM_SUNOS = 'SunOS';
    const PLATFORM_SYMBIAN = 'Symbian';
    const PLATFORM_UNKNOWN = 'unknown';
    const PLATFORM_VERSION_UNKNOWN = 'unknown';
    const PLATFORM_WINDOWS = 'Windows';
    const PLATFORM_WINDOWS_CE = 'Windows CE';
    const PLATFORM_WINDOWS_PHONE = 'Windows Phone';
    /**#@-*/

    /**
     * Version unknown constant.
     */
    const VERSION_UNKNOWN = 'unknown';


    /**
     * @var string
     * @access private
     */
    private $_agent = '';

    /**
     * @var string
     * @access private
     */
    private $_aolVersion = '';

    /**
     * @var string
     * @access private
     */
    private $_browserName = '';

    /**
     * @var string
     * @access private
     */
    private $_compatibilityViewName = '';

    /**
     * @var string
     * @access private
     */
    private $_compatibilityViewVer = '';

    /**
     * @var boolean
     * @access private
     */
    private $_is64bit = false;

    /**
     * @var boolean
     * @access private
     */
    private $_isAol = false;

    /**
     * @var boolean
     * @access private
     */
    private $_isMobile = false;

    /**
     * @var boolean
     * @access private
     */
    private $_isRobot = false;

    /**
     * @var string
     * @access private
     */
    private $_platform = '';

    /**
     * @var string
     * @access private
     */
    private $_platformVersion = '';

    /**
     * @var string
     * @access private
     */
    private $_version = '';


    //--- MAGIC METHODS ------------------------------------------------------------------------------------------------


    /**
     * BrowserDetection class constructor.
     * @param string $useragent The user agent to work with. Leave empty for the current user agent (contained in
     * $_SERVER['HTTP_USER_AGENT']).
     */
    public function __construct($useragent = '')
    {
        $this->setUserAgent($useragent);
    }

    /**
     * Determine how the class will react when it is treated like a string.
     * @return string Returns an HTML formatted string with a summary of the browser informations.
     */
    public function __toString()
    {
        $result = '';

        $values = array();
        $values[] = array('label' => 'User agent', 'value' => $this->getUserAgent());
        $values[] = array('label' => 'Browser name', 'value' => $this->getName());
        $values[] = array('label' => 'Browser version', 'value' => $this->getVersion());
        $values[] = array('label' => 'Platform family', 'value' => $this->getPlatform());
        $values[] = array('label' => 'Platform version', 'value' => $this->getPlatformVersion(true));
        $values[] = array('label' => 'Platform version name', 'value' => $this->getPlatformVersion());
        $values[] = array('label' => 'Platform is 64-bit', 'value' => $this->is64bitPlatform() ? 'true' : 'false');
        $values[] = array('label' => 'Is mobile', 'value' => $this->isMobile() ? 'true' : 'false');
        $values[] = array('label' => 'Is robot', 'value' => $this->isRobot() ? 'true' : 'false');
        $values[] = array('label' => 'IE is in compatibility view', 'value' => $this->isInIECompatibilityView() ? 'true' : 'false');
        $values[] = array('label' => 'Emulated IE version', 'value' => $this->isInIECompatibilityView() ? $this->getIECompatibilityView() : 'Not applicable');
        $values[] = array('label' => 'Is Chrome Frame', 'value' => $this->isChromeFrame() ? 'true' : 'false');
        $values[] = array('label' => 'Is AOL optimized', 'value' => $this->isAol() ? 'true' : 'false');
        $values[] = array('label' => 'AOL version', 'value' => $this->isAol() ? $this->getAolVersion() : 'Not applicable');

        foreach ($values as $currVal) {
            $result .= '<strong>' . htmlspecialchars($currVal['label'], ENT_NOQUOTES) . ':</strong> ' . $currVal['value'] . '<br />' . PHP_EOL;
        }

        return $result;
    }


    //--- PUBLIC MEMBERS -----------------------------------------------------------------------------------------------


    /**
     * Compare two version number strings.
     * @param string $sourceVer The source version number.
     * @param string $compareVer The version number to compare with the source version number.
     * @return int Returns -1 if $sourceVer < $compareVer, 0 if $sourceVer == $compareVer or 1 if $sourceVer >
     * $compareVer.
     */
    public function compareVersions($sourceVer, $compareVer)
    {
        $sourceVer = explode('.', $sourceVer);
        foreach ($sourceVer as $k => $v) {
            $sourceVer[$k] = $this->parseInt($v);
        }

        $compareVer = explode('.', $compareVer);
        foreach ($compareVer as $k => $v) {
            $compareVer[$k] = $this->parseInt($v);
        }

        if (count($sourceVer) != count($compareVer)) {
            if (count($sourceVer) > count($compareVer)) {
                for ($i = count($compareVer); $i < count($sourceVer); $i++) {
                    $compareVer[$i] = 0;
                }
            } else {
                for ($i = count($sourceVer); $i < count($compareVer); $i++) {
                    $sourceVer[$i] = 0;
                }
            }
        }

        foreach ($sourceVer as $i => $srcVerPart) {
            if ($srcVerPart > $compareVer[$i]) {
                return 1;
            } else {
                if ($srcVerPart < $compareVer[$i]) {
                    return -1;
                }
            }
        }

        return 0;
    }

    /**
     * Get the version of AOL (if any). AOL releases "optimized" Internet Explorer and Firefox versions. In the making
     * they add their version number in the user agent string of these browsers.
     * @return string Returns the version of AOL or an empty string if no AOL version was found.
     */
    public function getAolVersion()
    {
        return $this->_aolVersion;
    }

    /**
     * Get the name of the browser. All of the return values are class constants. You can compare them like this:
     * $myBrowserInstance->getName() == BrowserDetection::BROWSER_FIREFOX.
     * @return string Returns the name of the browser.
     */
    public function getName()
    {
        return $this->_browserName;
    }

    /**
     * Get the name and version of the browser emulated in the compatibility view mode (if any). Since Internet
     * Explorer 8, IE can be put in compatibility mode to make websites that were created for older browsers, especially
     * IE 6 and 7, look better in IE 8+ which renders web pages closer to the standards and thus differently from those
     * older versions of IE.
     * @param boolean $asArray Determines if the return value must be an array (true) or a string (false).
     * @return mixed If a string was requested, the function returns the name and version of the browser emulated in the
     * compatibility view mode or an empty string if the browser is not in compatibility view mode. If an array was
     * requested, an array with the keys 'browser' and 'version' is returned.
     */
    public function getIECompatibilityView($asArray = false)
    {
        if ($asArray) {
            return array('browser' => $this->_compatibilityViewName, 'version' => $this->_compatibilityViewVer);
        } else {
            return trim($this->_compatibilityViewName . ' ' . $this->_compatibilityViewVer);
        }
    }

    /**
     * Get the name of the platform family on which the browser is run on (such as Windows, Apple, iPhone, etc.). All of
     * the return values are class constants. You can compare them like this:
     * $myBrowserInstance->getPlatform() == BrowserDetection::PLATFORM_ANDROID.
     * @return string Returns the name of the platform or BrowserDetection::PLATFORM_UNKNOWN if unknown.
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * Get the platform version on which the browser is run on. It can be returned as a string number like 'NT 6.3' or
     * as a name like 'Windows 8.1'. When returning version string numbers for Windows NT OS families the number is
     * prefixed by 'NT ' to differentiate from older Windows 3.x & 9x release. At the moment only the Windows operating
     * systems is supported.
     * @param boolean $returnVersionNumbers Determines if the return value must be versions numbers as a string (true)
     * or the version name (false).
     * @param boolean $returnServerFlavor Since some Windows NT versions have the same values, this flag determines if
     * the Server flavor is returned or not. For instance Windows 8.1 and Windows Server 2012 R2 both use version 6.3.
     * @return string Returns the version name/version numbers of the platform or the constant PLATFORM_VERSION_UNKNOWN
     * if unknown.
     */
    public function getPlatformVersion($returnVersionNumbers = false, $returnServerFlavor = false)
    {
        if ($this->_platformVersion == self::PLATFORM_VERSION_UNKNOWN || $this->_platformVersion == '') {
            return self::PLATFORM_VERSION_UNKNOWN;
        }

        if ($returnVersionNumbers) {
            return $this->_platformVersion;
        } else {
            switch ($this->getPlatform()) {
                case self::PLATFORM_WINDOWS:
                    if (substr($this->_platformVersion, 0, 3) == 'NT ') {
                        return $this->windowsNTVerToStr(substr($this->_platformVersion, 3), $returnServerFlavor);
                    } else {
                        return $this->windowsVerToStr($this->_platformVersion);
                    }
                break;

                default: return self::PLATFORM_VERSION_UNKNOWN;
            }
        }
    }

    /**
     * Get the user agent value used by the class to determine the browser details.
     * @return string The user agent string.
     */
    public function getUserAgent()
    {
        return $this->_agent;
    }

    /**
     * Get the version of the browser.
     * @return string Returns the version of the browser or BrowserDetection::VERSION_UNKNOWN if unknown.
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Determine if the browser is executed from a 64-bit platform. Keep in mind that not all platforms/browsers report
     * this and the result may not always be accurate.
     * @return boolean Returns true if the browser is executed from a 64-bit platform.
     */
    public function is64bitPlatform()
    {
        return $this->_is64bit;
    }

    /**
     * Determine if the browser is from AOL. AOL releases "optimized" Internet Explorer and Firefox versions. In the
     * making they add their details in the user agent string of these browsers.
     * @return boolean Returns true if the browser is from AOL, false otherwise.
     */
    public function isAol()
    {
        return $this->_isAol;
    }

    /**
     * Determine if the browser runs Google Chrome Frame (it's a plug-in designed for Internet Explorer 6+ based on the
     * open-source Chromium project - it's like a Chrome browser within IE).
     * @return boolean Returns true if the browser is using Google Chrome Frame, false otherwise.
     */
    public function isChromeFrame()
    {
        return stripos($this->_agent, 'chromeframe') !== false;
    }

    /**
     * Determine if the browser is in compatibility view or not. Since Internet Explorer 8, IE can be put in
     * compatibility mode to make websites that were created for older browsers, especially IE 6 and 7, look better in
     * IE 8+ which renders web pages closer to the standards and thus differently from those older versions of IE.
     * @return boolean Returns true if the browser is in compatibility view, false otherwise.
     */
    public function isInIECompatibilityView()
    {
        return ($this->_compatibilityViewName != '') || ($this->_compatibilityViewVer != '');
    }

    /**
     * Determine if the browser is from a mobile device or not.
     * @return boolean Returns true if the browser is from a mobile device, false otherwise.
     */
    public function isMobile()
    {
        return $this->_isMobile;
    }

    /**
     * Determine if the browser is a robot (Googlebot, Bingbot, Yahoo! Slurp...) or not.
     * @return boolean Returns true if the browser is a robot, false otherwise.
     */
    public function isRobot()
    {
        return $this->_isRobot;
    }

    /**
     * Set the user agent to use with the class.
     * @param string $agentString The value of the user agent. If an empty string is sent (default),
     * $_SERVER['HTTP_USER_AGENT'] will be used.
     */
    public function setUserAgent($agentString = '')
    {
        if (!is_string($agentString) || trim($agentString) == '') {
            if (array_key_exists('HTTP_USER_AGENT', $_SERVER) && is_string($_SERVER['HTTP_USER_AGENT'])) {
                $agentString = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $agentString = '';
            }
        }

        $this->reset();
        $this->_agent = $agentString;
        $this->detect();
    }


    //--- PROTECTED MEMBERS --------------------------------------------------------------------------------------------


    /**
     * Determine if the browser is the Amaya Web editor or not.
     * @access protected
     * @link http://www.w3.org/Amaya/
     * @return boolean Returns true if the browser is Amaya, false otherwise.
     */
    protected function checkBrowserAmaya()
    {
        return $this->checkSimpleBrowserUA('amaya', $this->_agent, self::BROWSER_AMAYA);
    }

    /**
     * Determine if the browser is the Android browser (based on the WebKit layout engine and coupled with Chrome's
     * JavaScript engine) or not.
     * @access protected
     * @return boolean Returns true if the browser is the Android browser, false otherwise.
     */
    protected function checkBrowserAndroid()
    {
        //Android don't use the standard "Android/1.0", it uses "Android 1.0;" instead
        return $this->checkSimpleBrowserUA('Android', $this->_agent, self::BROWSER_ANDROID, true);
    }

    /**
     * Determine if the browser is the Bingbot crawler or not.
     * @access protected
     * @link http://www.bing.com/webmaster/help/which-crawlers-does-bing-use-8c184ec0
     * @return boolean Returns true if the browser is Bingbot, false otherwise.
     */
    protected function checkBrowserBingbot()
    {
        return $this->checkSimpleBrowserUA('bingbot', $this->_agent, self::BROWSER_BINGBOT, false, true);
    }

    /**
     * Determine if the browser is the BlackBerry browser or not.
     * @access protected
     * @link http://supportforums.blackberry.com/t5/Web-and-WebWorks-Development/How-to-detect-the-BlackBerry-Browser/ta-p/559862
     * @return boolean Returns true if the browser is the BlackBerry browser, false otherwise.
     */
    protected function checkBrowserBlackBerry()
    {
        $found = false;

        //Tablet OS check
        if ($this->checkSimpleBrowserUA('RIM Tablet OS', $this->_agent, self::BROWSER_TABLET_OS, true)) {
            return true;
        }

        //Version 6, 7 & 10 check (versions 8 & 9 does not exists)
        if ($this->checkBrowserUAWithVersion(array('BlackBerry', 'BB10'), $this->_agent, self::BROWSER_BLACKBERRY, true)) {
            if ($this->getVersion() == self::VERSION_UNKNOWN) {
                $found = true;
            } else {
                return true;
            }
        }

        //Version 4.2 to 5.0 check
        if ($this->checkSimpleBrowserUA('BlackBerry', $this->_agent, self::BROWSER_BLACKBERRY, true)) {
            if ($this->getVersion() == self::VERSION_UNKNOWN) {
                $found = true;
            } else {
                return true;
            }
        }

        return $found;
    }

    /**
     * Determine if the browser is Chrome or not.
     * @access protected
     * @link http://www.google.com/chrome/
     * @return boolean Returns true if the browser is Chrome, false otherwise.
     */
    protected function checkBrowserChrome()
    {
        return $this->checkSimpleBrowserUA('Chrome', $this->_agent, self::BROWSER_CHROME);
    }

    /**
     * Determine if the browser is Edge or not.
     * @access protected
     * @return boolean Returns true if the browser is Edge, false otherwise.
     */
    protected function checkBrowserEdge()
    {
        return $this->checkSimpleBrowserUA('Edge', $this->_agent, self::BROWSER_EDGE);
    }

    /**
     * Determine if the browser is Firebird or not. Firebird was the name of Firefox from version 0.6 to 0.7.1.
     * @access protected
     * @return boolean Returns true if the browser is Firebird, false otherwise.
     */
    protected function checkBrowserFirebird()
    {
        return $this->checkSimpleBrowserUA('Firebird', $this->_agent, self::BROWSER_FIREBIRD);
    }

    /**
     * Determine if the browser is Firefox or not.
     * @access protected
     * @link http://www.mozilla.org/en-US/firefox/new/
     * @return boolean Returns true if the browser is Firefox, false otherwise.
     */
    protected function checkBrowserFirefox()
    {
        //Safari heavily matches with Firefox, ensure that Safari is filtered out...
        if (preg_match('/.*Firefox[ (\/]*([a-z0-9.-]*)/i', $this->_agent, $matches) &&
                stripos($this->_agent, 'Safari') === false) {
            $this->setBrowser(self::BROWSER_FIREFOX);
            $this->setVersion($matches[1]);
            $this->setMobile(false);
            $this->setRobot(false);

            return true;
        }

        return false;
    }

    /**
     * Determine if the browser is Galeon or not. The browser was discontinued on September 27, 2008.
     * @access protected
     * @link http://en.wikipedia.org/wiki/Galeon
     * @return boolean Returns true if the browser is Galeon, false otherwise.
     */
    protected function checkBrowserGaleon()
    {
        return $this->checkSimpleBrowserUA('Galeon', $this->_agent, self::BROWSER_GALEON);
    }

    /**
     * Determine if the browser is the Googlebot crawler or not.
     * @access protected
     * @return boolean Returns true if the browser is Googlebot, false otherwise.
     */
    protected function checkBrowserGooglebot()
    {
        if ($this->checkSimpleBrowserUA('Googlebot', $this->_agent, self::BROWSER_GOOGLEBOT, false, true)) {
            if (strpos(strtolower($this->_agent), 'googlebot-mobile') !== false) {
                $this->setMobile(true);
            }

            return true;
        }

        return false;
    }

    /**
     * Determine if the browser is iCab or not.
     * @access protected
     * @link http://www.icab.de/
     * @return boolean Returns true if the browser is iCab, false otherwise.
     */
    protected function checkBrowserIcab()
    {
        //Some (early) iCab versions don't use the standard "iCab/1.0", they uses "iCab 1.0;" instead
        return $this->checkSimpleBrowserUA('iCab', $this->_agent, self::BROWSER_ICAB);
    }

    /**
     * Determine if the browser is GNU IceCat (formerly known as GNU IceWeasel) or not.
     * @access protected
     * @link http://www.gnu.org/software/gnuzilla/
     * @return boolean Returns true if the browser is GNU IceCat, false otherwise.
     */
    protected function checkBrowserIceCat()
    {
        return $this->checkSimpleBrowserUA('IceCat', $this->_agent, self::BROWSER_ICECAT);
    }

    /**
     * Determine if the browser is GNU IceWeasel (now know as GNU IceCat) or not.
     * @access protected
     * @see checkBrowserIceCat()
     * @return boolean Returns true if the browser is GNU IceWeasel, false otherwise.
     */
    protected function checkBrowserIceWeasel()
    {
        return $this->checkSimpleBrowserUA('Iceweasel', $this->_agent, self::BROWSER_ICEWEASEL);
    }

    /**
     * Determine if the browser is Internet Explorer or not.
     * @access protected
     * @link http://www.microsoft.com/ie/
     * @link http://en.wikipedia.org/wiki/Internet_Explorer_Mobile
     * @return boolean Returns true if the browser is Internet Explorer, false otherwise.
     */
    protected function checkBrowserInternetExplorer()
    {
        //Test for Internet Explorer Mobile (formerly Pocket Internet Explorer)
        if ($this->checkSimpleBrowserUA(array('IEMobile', 'MSPIE'), $this->_agent, self::BROWSER_IE_MOBILE, true)) {
            return true;
        }

        //Several browsers uses IE compatibility UAs filter these browsers out (but after testing for IE Mobile)
        if (stripos($this->_agent, 'Opera') !== false ||
                stripos($this->_agent, 'BlackBerry') !== false ||
                stripos($this->_agent, 'Nokia') !== false) {
            return false;
        }

        //Test for Internet Explorer 1
        if ($this->checkSimpleBrowserUA('Microsoft Internet Explorer', $this->_agent, self::BROWSER_IE)) {
            if ($this->getVersion() == self::VERSION_UNKNOWN) {
                if (preg_match('/308|425|426|474|0b1/i', $this->_agent)) {
                    $this->setVersion('1.5');
                } else {
                    $this->setVersion('1.0');
                }
            }
            return true;
        }

        //Test for Internet Explorer 2+
        if (stripos($this->_agent, 'MSIE') !== false || stripos($this->_agent, 'Trident') !== false) {
            $version = '';

            if (stripos($this->_agent, 'Trident') !== false) {
                //Test for Internet Explorer 11+ (check the rv: string)
                if (stripos($this->_agent, 'rv:') !== false) {
                    if ($this->checkSimpleBrowserUA('Trident', $this->_agent, self::BROWSER_IE, false, false, 'rv:')) {
                        return true;
                    }
                } else {
                    //Test for Internet Explorer 8, 9 & 10 (check the Trident string)
                    if (preg_match('/Trident\/([\d]+)/i', $this->_agent, $foundVersion)) {
                        //Trident started with version 4.0 on IE 8
                        $verFromTrident = $this->parseInt($foundVersion[1]) + 4;
                        if ($verFromTrident >= 8) {
                            $version = $verFromTrident . '.0';
                        }
                    }
                }

                //If we have the IE version from Trident, we can check for the compatibility view mode
                if ($version != '') {
                    $emulatedVer = '';
                    preg_match_all('/MSIE\s*([^\s;$]+)/i', $this->_agent, $foundVersions);
                    foreach ($foundVersions[1] as $currVer) {
                        //Keep the lowest MSIE version for the emulated version (in compatibility view mode)
                        if ($emulatedVer == '' || $this->compareVersions($emulatedVer, $currVer) == 1) {
                            $emulatedVer = $currVer;
                        }
                    }
                    //Set the compatibility view mode if $version != $emulatedVer
                    if ($this->compareVersions($version, $emulatedVer) != 0) {
                        $this->_compatibilityViewName = self::BROWSER_IE;
                        $this->_compatibilityViewVer = $this->cleanVersion($emulatedVer);
                    }
                }
            }

            //Test for Internet Explorer 2-7 versions if needed
            if ($version == '') {
                preg_match_all('/MSIE\s+([^\s;$]+)/i', $this->_agent, $foundVersions);
                foreach ($foundVersions[1] as $currVer) {
                    //Keep the highest MSIE version
                    if ($version == '' || $this->compareVersions($version, $currVer) == -1) {
                        $version = $currVer;
                    }
                }
            }

            $this->setBrowser(self::BROWSER_IE);
            $this->setVersion($version);
            $this->setMobile(false);
            $this->setRobot(false);

            return true;
        }

        return false;
    }

    /**
     * Determine if the browser is Konqueror or not.
     * @access protected
     * @link http://www.konqueror.org/
     * @return boolean Returns true if the browser is Konqueror, false otherwise.
     */
    protected function checkBrowserKonqueror()
    {
        return $this->checkSimpleBrowserUA('Konqueror', $this->_agent, self::BROWSER_KONQUEROR);
    }

    /**
     * Determine if the browser is Lynx or not. It is the oldest web browser currently in general use and development.
     * It is a text-based only Web browser.
     * @access protected
     * @link http://en.wikipedia.org/wiki/Lynx
     * @return boolean Returns true if the browser is Lynx, false otherwise.
     */
    protected function checkBrowserLynx()
    {
        return $this->checkSimpleBrowserUA('Lynx', $this->_agent, self::BROWSER_LYNX);
    }

    /**
     * Determine if the browser is Mozilla or not.
     * @access protected
     * @return boolean Returns true if the browser is Mozilla, false otherwise.
     */
    protected function checkBrowserMozilla()
    {
        return $this->checkSimpleBrowserUA('Mozilla', $this->_agent, self::BROWSER_MOZILLA, false, false, 'rv:');
    }

    /**
     * Determine if the browser is the MSNBot crawler or not. In October 2010 it was replaced by the Bingbot robot.
     * @access protected
     * @see checkBrowserBingbot()
     * @return boolean Returns true if the browser is MSNBot, false otherwise.
     */
    protected function checkBrowserMsnBot()
    {
        return $this->checkSimpleBrowserUA('msnbot', $this->_agent, self::BROWSER_MSNBOT, false, true);
    }

    /**
     * Determine if the browser is MSN TV (formerly WebTV) or not.
     * @access protected
     * @link http://en.wikipedia.org/wiki/MSN_TV
     * @return boolean Returns true if the browser is WebTv, false otherwise.
     */
    protected function checkBrowserMsnTv()
    {
        return $this->checkSimpleBrowserUA('webtv', $this->_agent, self::BROWSER_MSNTV);
    }

    /**
     * Determine if the browser is NetPositive or not. The browser is discontinued since November 2001.
     * @access protected
     * @link http://en.wikipedia.org/wiki/NetPositive
     * @return boolean Returns true if the browser is NetPositive, false otherwise.
     */
    protected function checkBrowserNetPositive()
    {
        return $this->checkSimpleBrowserUA('NetPositive', $this->_agent, self::BROWSER_NETPOSITIVE);
    }

    /**
     * Determine if the browser is Netscape or not. Official support for this browser ended on March 1st, 2008.
     * @access protected
     * @link http://en.wikipedia.org/wiki/Netscape
     * @return boolean Returns true if the browser is Netscape, false otherwise.
     */
    protected function checkBrowserNetscape()
    {
        //BlackBerry & Nokia UAs can conflict with Netscape UAs
        if (stripos($this->_agent, 'BlackBerry') !== false || stripos($this->_agent, 'Nokia') !== false) {
            return false;
        }

        //Netscape v6 to v9 check
        if ($this->checkSimpleBrowserUA(array('Netscape', 'Navigator', 'Netscape6'), $this->_agent, self::BROWSER_NETSCAPE)) {
            return true;
        }

        //Netscape v1-4 (v5 don't exists)
        $found = false;
        if (stripos($this->_agent, 'Mozilla') !== false && stripos($this->_agent, 'rv:') === false) {
            $version = '';
            $verParts = explode('/', stristr($this->_agent, 'Mozilla'));
            if (count($verParts) > 1) {
                $verParts = explode(' ', $verParts[1]);
                $verParts = explode('.', $verParts[0]);

                $majorVer = $this->parseInt($verParts[0]);
                if ($majorVer > 0 && $majorVer < 5) {
                    $version = implode('.', $verParts);
                    $found = true;

                    if (strtolower(substr($version, -4)) == '-sgi') {
                        $version = substr($version, 0, -4);
                    } else {
                        if (strtolower(substr($version, -4)) == 'gold') {
                            $version = substr($version, 0, -4) . ' Gold'; //Doubles spaces (if any) will be normalized by setVersion()
                        }
                    }
                }
            }
        }

        if ($found) {
            $this->setBrowser(self::BROWSER_NETSCAPE);
            $this->setVersion($version);
            $this->setMobile(false);
            $this->setRobot(false);
        }

        return $found;
    }

    /**
     * Determine if the browser is a Nokia browser or not.
     * @access protected
     * @link http://www.developer.nokia.com/Community/Wiki/User-Agent_headers_for_Nokia_devices
     * @return boolean Returns true if the browser is a Nokia browser, false otherwise.
     */
    protected function checkBrowserNokia()
    {
        if (stripos($this->_agent, 'Nokia5800') !== false || stripos($this->_agent, 'Nokia5530') !== false || stripos($this->_agent, 'Nokia5230') !== false) {
            $this->setBrowser(self::BROWSER_NOKIA);
            $this->setVersion('7.0');
            $this->setMobile(true);
            $this->setRobot(false);

            return true;
        }

        if ($this->checkSimpleBrowserUA(array('NokiaBrowser', 'BrowserNG', 'Series60', 'S60', 'S40OviBrowser'), $this->_agent, self::BROWSER_NOKIA, true)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the browser is OmniWeb or not.
     * @access protected
     * @link http://www.omnigroup.com/products/omniweb/
     * @return boolean Returns true if the browser is OmniWeb, false otherwise.
     */
    protected function checkBrowserOmniWeb()
    {
        if ($this->checkSimpleBrowserUA('OmniWeb', $this->_agent, self::BROWSER_OMNIWEB)) {
            //Some versions of OmniWeb prefix the version number with "v"
            if ($this->getVersion() != self::VERSION_UNKNOWN && strtolower(substr($this->getVersion(), 0, 1)) == 'v') {
                $this->setVersion(substr($this->getVersion(), 1));
            }
            return true;
        }

        return false;
    }

    /**
     * Determine if the browser is Opera or not.
     * @access protected
     * @link http://www.opera.com/
     * @link http://www.opera.com/mini/
     * @link http://www.opera.com/mobile/
     * @link http://my.opera.com/community/openweb/idopera/
     * @return boolean Returns true if the browser is Opera, false otherwise.
     */
    protected function checkBrowserOpera()
    {
        if ($this->checkBrowserUAWithVersion('Opera Mobi', $this->_agent, self::BROWSER_OPERA_MOBILE, true)) {
            return true;
        }

        if ($this->checkSimpleBrowserUA('Opera Mini', $this->_agent, self::BROWSER_OPERA_MINI, true)) {
            return true;
        }

        $version = '';
        $found = $this->checkBrowserUAWithVersion('Opera', $this->_agent, self::BROWSER_OPERA);
        if ($found && $this->getVersion() != self::VERSION_UNKNOWN) {
            $version = $this->getVersion();
        }

        if (!$found || $version == '') {
            if ($this->checkSimpleBrowserUA('Opera', $this->_agent, self::BROWSER_OPERA)) {
                return true;
            }
        }

        if (!$found && $this->checkSimpleBrowserUA('Chrome', $this->_agent, self::BROWSER_CHROME) ) {
            if ($this->checkSimpleBrowserUA('OPR/', $this->_agent, self::BROWSER_OPERA)) {
                return true;
            }
        }

        return $found;
    }

    /**
     * Determine if the browser is Phoenix or not. Phoenix was the name of Firefox from version 0.1 to 0.5.
     * @access protected
     * @return boolean Returns true if the browser is Phoenix, false otherwise.
     */
    protected function checkBrowserPhoenix()
    {
        return $this->checkSimpleBrowserUA('Phoenix', $this->_agent, self::BROWSER_PHOENIX);
    }

    /**
     * Determine what is the browser used by the user.
     * @access protected
     * @return boolean Returns true if the browser has been identified, false otherwise.
     */
    protected function checkBrowsers()
    {
        //Changing the check order can break the class detection results!
        return
               /* Major browsers and browsers that need to be detected in a special order */
               $this->checkBrowserMsnTv() ||            /* MSN TV is based on IE so we must check for MSN TV before IE */
               $this->checkBrowserInternetExplorer() ||
               $this->checkBrowserOpera() ||            /* Opera must be checked before Firefox, Netscape and Chrome to avoid conflicts */
               $this->checkBrowserEdge() ||             /* Edge must be checked before Firefox, Safari and Chrome to avoid conflicts */
               $this->checkBrowserChrome() ||           /* Chrome must be checked before Netscaoe and Mozilla to avoid conflicts */
               $this->checkBrowserOmniWeb() ||          /* OmniWeb must be checked before Safari (on which it's based on) and Netscape (since it have Mozilla UAs) */
               $this->checkBrowserIcab() ||             /* Check iCab before Netscape since iCab have Mozilla UAs */
               $this->checkBrowserNetPositive() ||      /* Check NetPositive before Netscape since NetPositive have Mozilla UAs */
               $this->checkBrowserNetscape() ||         /* Must be checked before Firefox since Netscape 8-9 are based on Firefox */
               $this->checkBrowserIceCat() ||           /* Check IceCat and IceWeasel before Firefox since they are GNU builds of Firefox */
               $this->checkBrowserIceWeasel() ||
               $this->checkBrowserGaleon() ||           /* Galeon is based on Firefox and needs to be tested before Firefox is tested */
               $this->checkBrowserFirefox() ||
               /* Current browsers that don't need to be detected in any special order */
               $this->checkBrowserKonqueror() ||
               $this->checkBrowserLynx() ||
               $this->checkBrowserAmaya() ||
               /* Mobile */
               $this->checkBrowserAndroid() ||
               $this->checkBrowserBlackBerry() ||
               $this->checkBrowserNokia() ||
               /* Bots */
               $this->checkBrowserGooglebot() ||
               $this->checkBrowserBingbot() ||
               $this->checkBrowserMsnBot() ||
               $this->checkBrowserSlurp() ||
               $this->checkBrowserYahooMultimedia() ||
               $this->checkBrowserW3CValidator() ||
               /* WebKit base check (after most other checks) */
               $this->checkBrowserSafari() ||
               /* Deprecated browsers that don't need to be detected in any special order */
               $this->checkBrowserFirebird() ||
               $this->checkBrowserPhoenix() ||
               /* Mozilla is such an open standard that it must be checked last */
               $this->checkBrowserMozilla();
    }

    /**
     * Determine if the browser is Safari or not.
     * @access protected
     * @link http://www.apple.com/safari/
     * @link http://web.archive.org/web/20080514173941/http://developer.apple.com/internet/safari/uamatrix.html
     * @link http://en.wikipedia.org/wiki/Safari_version_history#Release_history
     * @return boolean Returns true if the browser is Safari, false otherwise.
     */
    protected function checkBrowserSafari()
    {
        $version = '';

        //Check for current versions of Safari
        $found = $this->checkBrowserUAWithVersion(array('Safari', 'AppleWebKit'), $this->_agent, self::BROWSER_SAFARI);
        if ($found && $this->getVersion() != self::VERSION_UNKNOWN) {
            $version = $this->getVersion();
        }

        //Safari 1-2 didn't had a "Version" string in the UA, only a WebKit build and/or Safari build, extract version from these...
        if (!$found || $version == '') {
            if (preg_match('/.*Safari[ (\/]*([a-z0-9.-]*)/i', $this->_agent, $matches)) {
                $version = $this->safariBuildToSafariVer($matches[1]);
                $found = true;
            }
        }
        if (!$found || $version == '') {
            if (preg_match('/.*AppleWebKit[ (\/]*([a-z0-9.-]*)/i', $this->_agent, $matches)) {
                $version = $this->webKitBuildToSafariVer($matches[1]);
                $found = true;
            }
        }

        if ($found) {
            $this->setBrowser(self::BROWSER_SAFARI);
            $this->setVersion($version);
            $this->setMobile(false);
            $this->setRobot(false);
        }

        return $found;
    }

    /**
     * Determine if the browser is the Yahoo! Slurp crawler or not.
     * @access protected
     * @return boolean Returns true if the browser is Yahoo! Slurp, false otherwise.
     */
    protected function checkBrowserSlurp()
    {
        return $this->checkSimpleBrowserUA('Yahoo! Slurp', $this->_agent, self::BROWSER_SLURP, false, true);
    }

    /**
     * Test the user agent for a specific browser that use a "Version" string (like Safari and Opera). The user agent
     * should look like: "Version/1.0 Browser name/123.456" or "Browser name/123.456 Version/1.0".
     * @access protected
     * @param mixed $uaNameToLookFor The string (or array of strings) representing the browser name to find in the user
     * agent.
     * @param string $userAgent The user agent string to work with.
     * @param string $browserName The literal browser name. Always use a class constant!
     * @param boolean $isMobile Determines if the browser is from a mobile device.
     * @param boolean $isRobot Determines if the browser is a robot or not.
     * @return boolean Returns true if we found the browser we were looking for, false otherwise.
     */
    protected function checkBrowserUAWithVersion($uaNameToLookFor, $userAgent, $browserName, $isMobile = false, $isRobot = false)
    {
        if (!is_array($uaNameToLookFor)) {
            $uaNameToLookFor = array($uaNameToLookFor);
        }

        foreach ($uaNameToLookFor as $currUANameToLookFor) {
            if (stripos($userAgent, $currUANameToLookFor) !== false) {
                $version = '';
                $verParts = explode('/', stristr($this->_agent, 'Version'));
                if (count($verParts) > 1) {
                    $verParts = explode(' ', $verParts[1]);
                    $version = $verParts[0];
                }

                $this->setBrowser($browserName);
                $this->setVersion($version);

                $this->setMobile($isMobile);
                $this->setRobot($isRobot);

                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the browser is the W3C Validator or not.
     * @access protected
     * @link http://validator.w3.org/
     * @return boolean Returns true if the browser is the W3C Validator, false otherwise.
     */
    protected function checkBrowserW3CValidator()
    {
        //Since the W3C validates pages with different robots we will prefix our versions with the part validated on the page...

        //W3C Link Checker (prefixed with "Link-")
        if ($this->checkSimpleBrowserUA('W3C-checklink', $this->_agent, self::BROWSER_W3CVALIDATOR, false, true)) {
            if ($this->getVersion() != self::VERSION_UNKNOWN) {
                $this->setVersion('Link-' . $this->getVersion());
            }
            return true;
        }

        //W3C CSS Validation Service (prefixed with "CSS-")
        if ($this->checkSimpleBrowserUA('Jigsaw', $this->_agent, self::BROWSER_W3CVALIDATOR, false, true)) {
            if ($this->getVersion() != self::VERSION_UNKNOWN) {
                $this->setVersion('CSS-' . $this->getVersion());
            }
            return true;
        }

        //W3C mobileOK Checker (prefixed with "mobileOK-")
        if ($this->checkSimpleBrowserUA('W3C-mobileOK', $this->_agent, self::BROWSER_W3CVALIDATOR, false, true)) {
            if ($this->getVersion() != self::VERSION_UNKNOWN) {
                $this->setVersion('mobileOK-' . $this->getVersion());
            }
            return true;
        }

        //W3C Markup Validation Service (no prefix)
        return $this->checkSimpleBrowserUA('W3C_Validator', $this->_agent, self::BROWSER_W3CVALIDATOR, false, true);
    }

    /**
     * Determine if the browser is the Yahoo! multimedia crawler or not.
     * @access protected
     * @return boolean Returns true if the browser is the Yahoo! multimedia crawler, false otherwise.
     */
    protected function checkBrowserYahooMultimedia()
    {
        return $this->checkSimpleBrowserUA('Yahoo-MMCrawler', $this->_agent, self::BROWSER_YAHOO_MM, false, true);
    }

    /**
     * Determine if the user is using an AOL "optimized" browser or not.
     * @access protected
     * @return boolean Returns true if the browser is AOL optimized, false otherwise.
     */
    protected function checkForAol()
    {
        //AOL UAs don't use the "AOL/1.0" format, they uses "AOL 1.0; AOLBuild 100.00;"
        if (stripos($this->_agent, 'AOL ') !== false) {
            $version = '';
            $verParts = explode('AOL ', stristr($this->_agent, 'AOL '));
            if (count($verParts) > 1) {
                $verParts = explode(' ', $verParts[1]);
                $version = $verParts[0];
            }

            $this->setAol(true);
            $this->setAolVersion($version);

            return true;
        } else {
            $this->setAol(false);
            $this->setAolVersion('');

            return false;
        }
    }

    /**
     * Determine the user's platform.
     * @access protected
     */
    protected function checkPlatform()
    {
        /* Mobile platforms */
        if (stripos($this->_agent, 'Windows Phone') !== false ||     /* Check Windows Phone (formerly Windows Mobile) before Windows */
                stripos($this->_agent, 'IEMobile') !== false) {
            $this->setPlatform(self::PLATFORM_WINDOWS_PHONE);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'Windows CE') !== false) { /* Check Windows CE before Windows */
            $this->setPlatform(self::PLATFORM_WINDOWS_CE);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'iPhone') !== false) {     /* Check iPad/iPod/iPhone before Macintosh */
            $this->setPlatform(self::PLATFORM_IPHONE);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'iPad') !== false) {
            $this->setPlatform(self::PLATFORM_IPAD);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'iPod') !== false) {
            $this->setPlatform(self::PLATFORM_IPOD);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'Android') !== false) {
            $this->setPlatform(self::PLATFORM_ANDROID);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'Symbian') !== false) {
            $this->setPlatform(self::PLATFORM_SYMBIAN);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'BlackBerry') !== false ||
                stripos($this->_agent, 'BB10') !== false ||
                stripos($this->_agent, 'RIM Tablet OS') !== false) {
            $this->setPlatform(self::PLATFORM_BLACKBERRY);
            $this->setMobile(true);
        } else if (stripos($this->_agent, 'Nokia') !== false) {
            $this->setPlatform(self::PLATFORM_NOKIA);
            $this->setMobile(true);

        /* Desktop platforms */
        } else if (stripos($this->_agent, 'Windows') !== false) {
            $this->setPlatform(self::PLATFORM_WINDOWS);
        } else if (stripos($this->_agent, 'Macintosh') !== false) {
            $this->setPlatform(self::PLATFORM_MACINTOSH);
        } else if (stripos($this->_agent, 'Linux') !== false) {
            $this->setPlatform(self::PLATFORM_LINUX);
        } else if (stripos($this->_agent, 'FreeBSD') !== false) {
            $this->setPlatform(self::PLATFORM_FREEBSD);
        } else if (stripos($this->_agent, 'OpenBSD') !== false) {
            $this->setPlatform(self::PLATFORM_OPENBSD);
        } else if (stripos($this->_agent, 'NetBSD') !== false) {
            $this->setPlatform(self::PLATFORM_NETBSD);

        /* Discontinued */
        } else if (stripos($this->_agent, 'OpenSolaris') !== false) {
            $this->setPlatform(self::PLATFORM_OPENSOLARIS);
        } else if (stripos($this->_agent, 'OS/2') !== false) {
            $this->setPlatform(self::PLATFORM_OS2);
        } else if (stripos($this->_agent, 'BeOS') !== false) {
            $this->setPlatform(self::PLATFORM_BEOS);
        } else if (stripos($this->_agent, 'SunOS') !== false) {
            $this->setPlatform(self::PLATFORM_SUNOS);

        /* Generic */
        } else if (stripos($this->_agent, 'Win') !== false) {
            $this->setPlatform(self::PLATFORM_WINDOWS);
        } else if (stripos($this->_agent, 'Mac') !== false) {
            $this->setPlatform(self::PLATFORM_MACINTOSH);
        }

        //Check if it's a 64-bit platform
        if (stripos($this->_agent, 'WOW64') !== false || stripos($this->_agent, 'Win64') !== false) {
            $this->set64bit(true);
        }

        $this->checkPlatformVersion();
    }

    /**
     * Determine the user's platform version.
     * @access protected
     */
    protected function checkPlatformVersion()
    {
        //https://support.microsoft.com/en-us/kb/158238

        $result = '';

        switch ($this->getPlatform()) {
            case self::PLATFORM_WINDOWS:
                if (preg_match('/Windows NT\s*([^\s;\)$]+)/i', $this->_agent, $foundVersion)) {
                    //Windows NT family
                    $result = 'NT ' . $foundVersion[1];
                } else {
                    //Windows 3.x / 9x family
                    if (stripos($this->_agent, 'Windows ME') !== false) {
                        $result = '4.90.3000'; //Windows Me version range from 4.90.3000 to 4.90.3000A
                    } else if (stripos($this->_agent, 'Windows 98') !== false) {
                        $result = '4.10'; //Windows 98 version range from 4.10.1998 to 4.10.2222B
                    } else if (stripos($this->_agent, 'Windows 95') !== false) {
                        $result = '4.00'; //Windows 95 version range from 4.00.950 to 4.03.1214
                    } else if (preg_match('/Windows 3\.([^\s;\)$]+)/i', $this->_agent, $foundVersion)) {
                        $result = '3.' . $foundVersion[1];
                    }
                }

            break;
        }

        if (trim($result) == '') {
            $result = self::PLATFORM_VERSION_UNKNOWN;
        }
        $this->setPlatformVersion($result);
    }

    /**
     * Test the user agent for a specific browser where the browser name is immediately followed by the version number.
     * The user agent should look like: "Browser name/1.0" or "Browser 1.0;".
     * @access protected
     * @param mixed $uaNameToLookFor The string (or array of strings) representing the browser name to find in the user
     * agent.
     * @param string $userAgent The user agent string to work with.
     * @param string $browserName The literal browser name. Always use a class constant!
     * @param boolean $isMobile Determines if the browser is from a mobile device.
     * @param boolean $isRobot Determines if the browser is a robot or not.
     * @param string $separator The separator string used to split the browser name and the version number in the user
     * agent.
     * @return boolean Returns true if we found the browser we were looking for, false otherwise.
     */
    protected function checkSimpleBrowserUA($uaNameToLookFor, $userAgent, $browserName, $isMobile = false, $isRobot = false, $separator = '/')
    {
        if (!is_array($uaNameToLookFor)) {
            $uaNameToLookFor = array($uaNameToLookFor);
        }

        foreach ($uaNameToLookFor as $currUANameToLookFor) {
            if (stripos($userAgent, $currUANameToLookFor) !== false) {
                //Many browsers don't use the standard "Browser/1.0" format, they uses "Browser 1.0;" instead
                if (stripos($userAgent, $currUANameToLookFor . $separator) === false) {
                    $userAgent = str_ireplace($currUANameToLookFor . ' ', $currUANameToLookFor . $separator, $this->_agent);
                }

                $version = '';
                $verParts = explode($separator, stristr($userAgent, $currUANameToLookFor));
                if (count($verParts) > 1) {
                    $verParts = explode(' ', $verParts[1]);
                    $version = $verParts[0];
                }

                $this->setBrowser($browserName);
                $this->setVersion($version);

                $this->setMobile($isMobile);
                $this->setRobot($isRobot);

                return true;
            }
        }

        return false;
    }

    /**
     * Detect the user environment from the details in the user agent string.
     * @access protected
     */
    protected function detect()
    {
        $this->checkBrowsers();
        $this->checkPlatform(); //Check the platform after the browser since some platforms can change the mobile value
        $this->checkForAol();
    }

    /**
     * Clean a version string from unwanted characters.
     * @access protected
     * @param string $version The version string to clean.
     * @return string Returns the cleaned version number string.
     */
    protected function cleanVersion($version)
    {
        //Clear anything that is in parentheses (and the parentheses themselves) - will clear started but unclosed ones too
        $cleanVer = preg_replace('/\([^)]+\)?/', '', $version);
        //Replace with a space any character which is NOT an alphanumeric, dot (.), hyphen (-), underscore (_) or space
        $cleanVer = preg_replace('/[^0-9.a-zA-Z_ -]/', ' ', $cleanVer);
        //Remove trailing and leading spaces
        $cleanVer = trim($cleanVer);
        //Remove double spaces if any
        while (strpos($cleanVer, '  ') !== false) {
            $cleanVer = str_replace('  ', ' ', $cleanVer);
        }

        return $cleanVer;
    }

    /**
     * Get the integer value of a string variable.
     * @access protected
     * @param string $intStr The scalar value being converted to an integer.
     * @return int The integer value of $intStr on success, or 0 on failure.
     */
    protected function parseInt($intStr)
    {
        return intval($intStr, 10);
    }

    /**
     * Reset all the properties of the class.
     * @access protected
     */
    protected function reset()
    {
        $this->_agent = '';
        $this->_aolVersion = '';
        $this->_browserName = self::BROWSER_UNKNOWN;
        $this->_compatibilityViewName = '';
        $this->_compatibilityViewVer = '';
        $this->_is64bit = false;
        $this->_isAol = false;
        $this->_isMobile = false;
        $this->_isRobot = false;
        $this->_platform = self::PLATFORM_UNKNOWN;
        $this->_platformVersion = self::PLATFORM_VERSION_UNKNOWN;
        $this->_version = self::VERSION_UNKNOWN;
    }

    /**
     * Convert a Safari build number to a Safari version number.
     * @access protected
     * @param string $version A string representing the version number.
     * @link http://web.archive.org/web/20080514173941/http://developer.apple.com/internet/safari/uamatrix.html
     * @return string Returns the Safari version string. If the version can't be determined, an empty string is
     * returned.
     */
    protected function safariBuildToSafariVer($version)
    {
        $verParts = explode('.', $version);

        //We need a 3 parts version (version 2 will becomes 2.0.0)
        while (count($verParts) < 3) {
            $verParts[] = 0;
        }
        foreach ($verParts as $i => $currPart) {
            $verParts[$i] = $this->parseInt($currPart);
        }

        switch ($verParts[0]) {
            case 419: $result = '2.0.4';
                break;
            case 417: $result = '2.0.3';
                break;
            case 416: $result = '2.0.2';
                break;

            case 412:
                if ($verParts[1] >= 5) {
                    $result = '2.0.1';
                } else {
                    $result = '2.0';
                }
                break;

            case 312:
                if ($verParts[1] >= 5) {
                    $result = '1.3.2';
                } else {
                    if ($verParts[1] >= 3) {
                        $result = '1.3.1';
                    } else {
                        $result = '1.3';
                    }
                }
                break;

            case 125:
                if ($verParts[1] >= 11) {
                    $result = '1.2.4';
                } else {
                    if ($verParts[1] >= 9) {
                        $result = '1.2.3';
                    } else {
                        if ($verParts[1] >= 7) {
                            $result = '1.2.2';
                        } else {
                            $result = '1.2';
                        }
                    }
                }
                break;

            case 100:
                if ($verParts[1] >= 1) {
                    $result = '1.1.1';
                } else {
                    $result = '1.1';
                }
                break;

            case 85:
                if ($verParts[1] >= 8) {
                    $result = '1.0.3';
                } else {
                    if ($verParts[1] >= 7) {
                        $result = '1.0.2';
                    } else {
                        $result = '1.0';
                    }
                }
                break;

            case 73: $result = '0.9';
                break;
            case 51: $result = '0.8.1';
                break;
            case 48: $result = '0.8';
                break;

            default: $result = '';
        }

        return $result;
    }

    /**
     * Set if the browser is executed from a 64-bit platform.
     * @access protected
     * @param boolean $is64bit Value that tells if the browser is executed from a 64-bit platform.
     */
    protected function set64bit($is64bit)
    {
        $this->_is64bit = $is64bit == true;
    }

    /**
     * Set the browser to be from AOL or not.
     * @access protected
     * @param boolean $isAol Value that tells if the browser is AOL or not.
     */
    protected function setAol($isAol)
    {
        $this->_isAol = $isAol == true;
    }

    /**
     * Set the version of AOL.
     * @access protected
     * @param string $version The version of AOL (will be cleaned).
     */
    protected function setAolVersion($version)
    {
        $cleanVer = $this->cleanVersion($version);

        $this->_aolVersion = $cleanVer;
    }

    /**
     * Set the name of the browser.
     * @access protected
     * @param string $browserName The name of the browser.
     */
    protected function setBrowser($browserName)
    {
        $this->_browserName = $browserName;
    }

    /**
     * Set the browser to be from a mobile device or not.
     * @access protected
     * @param boolean $isMobile Value that tells if the browser is on a mobile device or not.
     */
    protected function setMobile($isMobile = true)
    {
        $this->_isMobile = $isMobile == true;
    }

    /**
     * Set the platform on which the browser is on.
     * @access protected
     * @param string $platform The name of the platform.
     */
    protected function setPlatform($platform)
    {
        $this->_platform = $platform;
    }

    /**
     * Set the platform version on which the browser is on.
     * @access protected
     * @param string $platformVer The version numbers of the platform.
     */
    protected function setPlatformVersion($platformVer)
    {
        $this->_platformVersion = $platformVer;
    }

    /**
     * Set the browser to be a robot (crawler) or not.
     * @access protected
     * @param boolean $isRobot Value that tells if the browser is a robot or not.
     */
    protected function setRobot($isRobot = true)
    {
        $this->_isRobot = $isRobot == true;
    }

    /**
     * Set the version of the browser.
     * @access protected
     * @param string $version The version of the browser.
     */
    protected function setVersion($version)
    {
        $cleanVer = $this->cleanVersion($version);

        if ($cleanVer == '') {
            $this->_version = self::VERSION_UNKNOWN;
        } else {
            $this->_version = $cleanVer;
        }
    }

    /**
     * Convert a WebKit build number to a Safari version number.
     * @access protected
     * @param string $version A string representing the version number.
     * @link http://web.archive.org/web/20080514173941/http://developer.apple.com/internet/safari/uamatrix.html
     * @return string Returns the Safari version string. If the version can't be determined, an empty string is
     * returned.
     */
    protected function webKitBuildToSafariVer($version)
    {
        $verParts = explode('.', $version);

        //We need a 3 parts version (version 2 will becomes 2.0.0)
        while (count($verParts) < 3) {
            $verParts[] = 0;
        }
        foreach ($verParts as $i => $currPart) {
            $verParts[$i] = $this->parseInt($currPart);
        }

        switch ($verParts[0]) {
            case 419: $result = '2.0.4';
                break;

            case 418:
                if ($verParts[1] >= 8) {
                    $result = '2.0.4';
                } else {
                    $result = '2.0.3';
                }
                break;

            case 417: $result = '2.0.3';
                break;

            case 416: $result = '2.0.2';
                break;

            case 412:
                if ($verParts[1] >= 7) {
                    $result = '2.0.1';
                } else {
                    $result = '2.0';
                }
                break;

            case 312:
                if ($verParts[1] >= 8) {
                    $result = '1.3.2';
                } else {
                    if ($verParts[1] >= 5) {
                        $result = '1.3.1';
                    } else {
                        $result = '1.3';
                    }
                }
                break;

            case 125:
                if ($this->compareVersions('5.4', $verParts[1] . '.' . $verParts[2]) == -1) {
                    $result = '1.2.4'; //125.5.5+
                } else {
                    if ($verParts[1] >= 4) {
                        $result = '1.2.3';
                    } else {
                        if ($verParts[1] >= 2) {
                            $result = '1.2.2';
                        } else {
                            $result = '1.2';
                        }
                    }
                }
                break;

            //WebKit 100 can be either Safari 1.1 (Safari build 100) or 1.1.1 (Safari build 100.1)
            //for this reason, check the Safari build before the WebKit build.
            case 100: $result = '1.1.1';
                break;

            case 85:
                if ($verParts[1] >= 8) {
                    $result = '1.0.3';
                } else {
                    if ($verParts[1] >= 7) {
                        //WebKit 85.7 can be either Safari 1.0 (Safari build 85.5) or 1.0.2 (Safari build 85.7)
                        //for this reason, check the Safari build before the WebKit build.
                        $result = '1.0.2';
                    } else {
                        $result = '1.0';
                    }
                }
                break;

            case 73: $result = '0.9';
                break;
            case 51: $result = '0.8.1';
                break;
            case 48: $result = '0.8';
                break;

            default: $result = '';
        }

        return $result;
    }

    /**
     * Convert the Windows NT family version numbers to the operating system name. For instance '5.1' returns
     * 'Windows XP'.
     * @access protected
     * @param string $winVer The Windows NT family version numbers as a string.
     * @param boolean $returnServerFlavor Since some Windows NT versions have the same values, this flag determines if
     * the Server flavor is returned or not. For instance Windows 8.1 and Windows Server 2012 R2 both use version 6.3.
     * @return string The operating system name or the constant PLATFORM_VERSION_UNKNOWN if nothing match the version
     * numbers.
     */
    protected function windowsNTVerToStr($winVer, $returnServerFlavor = false)
    {
        //https://en.wikipedia.org/wiki/List_of_Microsoft_Windows_versions

        $cleanWinVer = explode('.', $winVer);
        while (count($cleanWinVer) > 2) {
            array_pop($cleanWinVer);
        }
        $cleanWinVer = implode('.', $cleanWinVer);

        if ($this->compareVersions($cleanWinVer, '11') >= 0) {
            //Future versions of Windows
            return self::PLATFORM_WINDOWS . ' ' . $winVer;
        } else if ($this->compareVersions($cleanWinVer, '10') >= 0) {
            //Current version of Windows
            return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2016') : (self::PLATFORM_WINDOWS . ' 10');
        } else if ($this->compareVersions($cleanWinVer, '7') < 0) {
            if ($this->compareVersions($cleanWinVer, '6.3') == 0) {
                return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2012 R2') : (self::PLATFORM_WINDOWS . ' 8.1');
            } else if ($this->compareVersions($cleanWinVer, '6.2') == 0) {
                return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2012') : (self::PLATFORM_WINDOWS . ' 8');
            } else if ($this->compareVersions($cleanWinVer, '6.1') == 0) {
                return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2008 R2') : (self::PLATFORM_WINDOWS . ' 7');
            } else if ($this->compareVersions($cleanWinVer, '6') == 0) {
                return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2008') : (self::PLATFORM_WINDOWS . ' Vista');
            } else if ($this->compareVersions($cleanWinVer, '5.2') == 0) {
                return $returnServerFlavor ? (self::PLATFORM_WINDOWS . ' Server 2003 / ' . self::PLATFORM_WINDOWS . ' Server 2003 R2') : (self::PLATFORM_WINDOWS . ' XP x64 Edition');
            } else if ($this->compareVersions($cleanWinVer, '5.1') == 0) {
                return self::PLATFORM_WINDOWS . ' XP';
            } else if ($this->compareVersions($cleanWinVer, '5') == 0) {
                return self::PLATFORM_WINDOWS . ' 2000';
            } else if ($this->compareVersions($cleanWinVer, '5') < 0 && $this->compareVersions($cleanWinVer, '3') >= 0) {
                return self::PLATFORM_WINDOWS . ' NT ' . $winVer;
            }
        }

        return self::PLATFORM_VERSION_UNKNOWN; //Invalid Windows NT version
    }

    /**
     * Convert the Windows 3.x & 9x family version numbers to the operating system name. For instance '4.10.1998'
     * returns 'Windows 98'.
     * @access protected
     * @param string $winVer The Windows 3.x or 9x family version numbers as a string.
     * @return string The operating system name or the constant PLATFORM_VERSION_UNKNOWN if nothing match the version
     * numbers.
     */
    protected function windowsVerToStr($winVer)
    {
        //https://support.microsoft.com/en-us/kb/158238

        if ($this->compareVersions($winVer, '4.90') >= 0 && $this->compareVersions($winVer, '4.91') < 0) {
            return self::PLATFORM_WINDOWS . ' Me'; //Normally range from 4.90.3000 to 4.90.3000A
        } else if ($this->compareVersions($winVer, '4.10') >= 0 && $this->compareVersions($winVer, '4.11') < 0) {
            return self::PLATFORM_WINDOWS . ' 98'; //Normally range from 4.10.1998 to 4.10.2222B
        } else if ($this->compareVersions($winVer, '4') >= 0 && $this->compareVersions($winVer, '4.04') < 0) {
            return self::PLATFORM_WINDOWS . ' 95'; //Normally range from 4.00.950 to 4.03.1214
        } else if ($this->compareVersions($winVer, '3.1') == 0 || $this->compareVersions($winVer, '3.11') == 0) {
            return self::PLATFORM_WINDOWS . ' ' . $winVer;
        } else {
            return self::PLATFORM_VERSION_UNKNOWN; //Invalid Windows version
        }
    }
}