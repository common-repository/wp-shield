=== WP Shield ===
Contributors: drupalmatts
Donate link: N/A
Tags: development, environments, security
Requires at least: 4.6
Tested up to: 6.4
Stable tag: 1.6
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin will allow you to secure your development, staging and UAT environments
with an http authentication block that can be controlled in admin but also turned
off via a declared variable in your config file.

== Description ==

This plugin will allow you to secure your development, staging and UAT environments
with an http authentication block that can be controlled in admin but also turned
off via a declared variable in your config file.  It allows you to bring your Database
back to non-production environments without having to physically turn off the plugin each time.

Variable:  `define('WP_SHIELD_UN', '');`

This simple line of code (recommended to add to a file ignored by your code management
software and required into your wp_config.php file) will override the enabled flag
if the plugin's settings.  Enable in production and add the above code.  If that
require file doesn't exist in your other environments, it will prompt users for the
set username and password.

== Installation ==

1.  Download WP Shield from the WordPress plugin directory
2.  Activate the plugin through the 'Plugins' screen in WordPress
3.  Use the Settings->'WP Shield' screen to configure the plugin
4.  Enter the username and password you want use for the shield
5.  Check the enabled checkbox and Submit
6.  Add the following code to your wp_config.php file:
<pre><code>
    if(file_exists('shield-settings.php')) {
      include('shield-settings.php');
    }
</code></pre>

For production environments:
7.  Add the above snippet of code to the shield_settings.php file in the root of
    your WordPress installation.

NOTE:  Depending on your setup you may need to add one of the following to your .htaccess
or apache conf file:

<strong>.htaccess</strong>
<pre><code>
RewriteRule .* index.php [QSA,E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
</code></strong>

<strong>Apache conf</strong>
<pre><code>
SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
</code></strong>

== Changelog ==

= 1.0 =
* Initial release of the Plugin

= 1.2 =
* Add code to bypass shield on WP-CLI calls

= 1.3 =
* Update readme for authorization setup

= 1.4 =
* Fix for caching of credentials

= 1.5 =
* Tested and confirmed for WordPress 6.1

= 1.6 =
* Tested and confirmed for WordPress 6.4

== Frequently Asked Questions ==
TBD
== Upgrade Notice ==
No Update available
== Screenshots ==
TBD
