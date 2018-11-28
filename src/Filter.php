<?php

namespace TimberKint;

class Filter {

	function __construct() {
		add_filter('timber/twig', array($this, 'add_timber_kint_filters'));
    }
    
    /**
     * Wrapper around Kint's `dump_this()` method. Checks to make sure that Kint exists.
     * This prevents fatal PHP errors when the Twig filter is used but the Kint library is not enabled.
     * It also suppresses the output if debugging display is disabled in the current Wordpress environment.
     * Intended to be used by a Twig filter and not called directly.
     * 
     * @see https://wordpress.org/plugins/kint-debugger/ Kint Debugger plugin documentation
     * @see https://github.com/kint-php/kint Original Kint library source
     * 
     * @internal
     * 
     * @return string|null    If Kint exists and debug display is enabled, returns Kint's HTML output.
     *                          Otherwise, returns null.
     * @param mixed $input    Any data that Kint can dump, usually an object or array
     * @param bool $inline    (optional) Whether or not this dump output should be placed in a Debug Bar panel.
     *                          If Debug Bar is not active, this parameter does nothing.
     *                          Defaults to `false` (output is placed in Debug Bar panel)
     * 
     * @example Filter.php 57 2 Assigning `safe_kint` to a Twig filter
     * 
     * @package TimberKint
     */
    function safe_kint( $input, $inline = false ) {
        $debug_status = Utilities::debug_enabled();
        if (function_exists('dump_this') && $debug_status) {
            return dump_this($input, $inline);
        }
        return null;
    }
    
    /**
     * Adds a `|kint` filter, and an alias `|d`, to the Twig environment.
     * This would normally be private, but Wordpress needs it to be public since
     * it's assigned as a Wordpress filter via a hook and is thus technically called
     * from outside its own class.
     * 
     * @internal
     * 
     * @param object $twig The current twig environment
     * @return object $twig The current twig environment with new filters added
     * 
     * @example ../docs/twig-example.twig 6 1 Dumping a simple associative array
     * 
     * @package TimberKint
     */
    function add_timber_kint_filters($twig) {
        $twig->addFilter(new \Twig_SimpleFilter('kint', array($this,'safe_kint')));
        $twig->addFilter(new \Twig_SimpleFilter('d', array($this,'safe_kint')));
        return $twig;
    }
}
