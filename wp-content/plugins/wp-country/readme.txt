=== WP Country ===

Contributors: andreyk
Tags: country, countries list, dropdown, select
Plugin URI: http://andrey.eto-ya.com/wp-country-plugin
Requires at least: 3.6
Tested up to: 4.5
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides WP_Country PHP class to get countries list as an array and dropdown country select for use in other plugins and themes.

== Description ==

To use the WP Country plugin in your theme or plugin add `global $wp_country;` into your theme or plugin PHP file,
then:

* `$wp_country->countries_list()` is an array of country names 

* `$wp_country->dropdown()` prints or returns countries as dropdown HTML <select> tag.

* `$wp_country->name($alpha2)` returns the name of a country by it's 2-character code.

Russian translation is available now.

== Frequently Asked Questions ==

Advanced usage: `dropdown($blank, $echo, $args)`

= Parameters Description =

* *blank*: if not empty then `<option value=''>` will be added into dropdown list. Default: ''.

* *echo*: prints the list if true else returns. Default: true.

* *args*: an array of extra parameters. Default: `array('include' => array(), 'exclude' => array(), 'name' => 'country', 'id' => '', 'selected' => array(), 'multiple' => false)`.

= Description of `args` components =

* *include*, *exclude*: an array of country codes (alpha2) should be included into dropdown list or excluded from it.

* *name*: `name` attribute of the SELECT tag.

* *id*: `id` attribute (not displayed by default).

* *class*: `class` attribute of the SELECT tag (empty by default).

* *multiple*: enables multiple select.

* *selected*: adds the `selected` attribute.

== Installation ==

1. Upload the `wp-country` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin.

== Changelog ==

* 0.2 Add `class` parameter for dropdown list.
* 0.1 Initial version.
