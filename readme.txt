=== Mega Ad ===
Contributors: surfstang
Donate link: http://simonwebdesign.com/donate
Tags: fullscreen, ad, expiration
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 2.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin creates a full screen ad with an expiration date without cloaking.

== Description ==

This plugin creates a full screen ad with an expiration date without cloaking. All you have to do is add a link, image and expiration and you can have a full screen ad with a cookie.

There are plugins out there that create separate full page ads or landing pages versus what Google sees. So the plugin would show the user one page while showing another page to a search engine. This can be called cloaking which is never really a good strategy to show ads or landing pages.

This plugin doesn't create landing pages. This plugin creates full page ads to promote your product or service without cloaking.

== Installation ==

Getting Started

1. Upload plugin to your plugin directory.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a Mega Ad
4. Add a link, upload an image, add an expiration
5. Profit.

== Frequently Asked Questions ==

= Does this plugin use cookies? =

This plugin drops a cookie that will dismiss the Mega Ad for the number of days you configure (default 1 day). The plugin will also drop a cookie if the user clicks on the ad.

= Can I target specific devices? =

Yes. You can choose to show the ad on all devices, mobile only, or desktop only.

= Can I delay when the ad appears? =

Yes. You can set a delay in seconds before the ad appears.

== Screenshots ==

== Changelog ==

= 2.0.0 =
* PHP 8.x compatibility fixes
* Updated CMB2 to 2.11.0
* Removed Ionicons dependency — close button now uses pure CSS
* Replaced jquery.cookie.js with vanilla JS (no extra library needed)
* Fixed overlay position (was broken on scroll)
* Fixed script enqueue hook
* New: Cookie Duration field — set how many days before ad reappears
* New: Show Delay field — delay ad appearance by X seconds
* New: Device Targeting — show on all devices, mobile only, or desktop only

= 1.1.4 =
Fix CMB2 update issues

= 1.1.3 =
Fix broken white screen issues

= 1.1.2 =
Fix broken date issue, Fix chrome issues with scrolling, Update CMB2

= 1.0.1 =
Esc variables. Center modal with CSS. Update CMB2. Tweak CSS.

= 1.0 =
Add readme.

= 0.5 =
Initial commit.
