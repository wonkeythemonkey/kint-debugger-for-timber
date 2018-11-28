=== Timber Support for Kint Debugger ===
Contributors: Jesse Janowiak
Tags: timber, debug
Requires at least: 2.5
Tested up to: 4.9.8
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds Timber support to the [Kint Debugger](https://wordpress.org/plugins/kint-debugger/) plugin for Wordpress.

== Description ==

This plugin adds a filter to Twig called **`|kint`** that mirrors the behavior of kint’s **dump_this()** function. Applying this filter to a variable in a `.twig` template file will output a formatted, collapsible dump of that variable.

= Basic Usage =

`{{ variable_name|kint($inline) }}`

Apply the filter to variable (usually a Twig object or array) within a `.twig` file that is being rendered by Timber.

**Example:**

`{{ variable_name|kint }}`

This will put a variable dump inline in the rendered HTML wherever you inserted the filter.

= With Debug Bar =

By default, when [Debug Bar](https://wordpress.org/plugins/debug-bar/) is installed and active, Kint Debugger (and by extension this plugin) will send output to the "Kint Debugger" Debug Bar panel.

If you would like to override this behavior and instead dump the variable inline, pass `true` to the `$inline` argument:

**Example:**

`{{ post|kint(true) }}

== Installation ==

1. Upload `kint-debugger-for-timber` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What's Kint? =

Kint is a replacement for PHP debugging functions like `var_dump()` and `print_r()`.

The plugin that enables it for Wordpress lets you use Kint functions in PHP for theme and plugin development.

= What's Timber? =

Timber is a plugin that lets you use the Twig Template Language in your themes. [Download it](http://wordpress.org/plugins/timber-library/) from WordPress.org

= Why is nothing happening when I use the filter? =

There are a few reasons you may not be seeing any output from the `|kint` Twig filter:

1. You have not activated this plugin
1. The [Kint Debugger](https://wordpress.org/plugins/kint-debugger/) plugin may not be installed or activated
1. You have Debug Bar installed and activated, and your output is hidden in the Debug Bar interface. Check the Debug Bar interface for a "Kint Debugger" section.
