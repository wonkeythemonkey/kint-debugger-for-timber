## Timber Extension for Wordpress Kint Debugger

Adds Timber support to the [Kint Debugger](https://wordpress.org/plugins/kint-debugger/) plugin for Wordpress.

Requires a theme with [Timber](https://timber.github.io/docs/getting-started/setup/) installed, either as a plugin (prior to version 2.0) or via composer (recommended).

It also works best when combined with [Debug Bar](https://wordpress.org/plugins/debug-bar/). See the main Kint Debugger plugin page for details.

### Basic Usage

`{{ variable_name|kint($inline) }}`

Apply the filter to variable (usually a Twig object or array) within a `.twig` file that is being rendered by Timber.

**Example:**

`{{ variable_name|kint }}`

This will put a variable dump inline in the rendered HTML wherever you inserted the filter.

### With Debug Bar

By default, when [Debug Bar](https://wordpress.org/plugins/debug-bar/) is installed and active, Kint Debugger (and by extension this plugin) will send output to the "Kint Debugger" Debug Bar panel.

If you would like to override this behavior and instead dump the variable inline, pass `true` to the `$inline` argument:

**Example:**

`{{ post|kint(true) }}`

### Alternative Syntax

If you regularly use kint directly in PHP, you are probably used to calling the `d()` function to generate dumps.
If it is easier for you to remember, you can also use `|d()` in Kint for Timber as an alias for `|kint()`
