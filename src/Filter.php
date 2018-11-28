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
     * Intended to be used by a Twig filter.
     * 
     * @return string|null If Kint exists and debug display is enabled, returns Kint's HTML output. Otherwise, returns null.
     * @param mixed $input Any data that Kint can dump, usually an object or array
     * 
     * @example
     * $twig->addFilter(new \Twig_SimpleFilter('kint', array($this,'safe_kint')));
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
     * Adds a `|kint` filter, and an alias of `|d`, to the Twig environment.
     * This would normally be private, but Wordpress needs it to be public since
     * it's assigned as a Wordpress filter via a hook and is thus technically called
     * from outside its own class.
     * 
     * @param object $twig The current twig environment
     * @return object $twig The current twig environment with new filters added
     * 
     * @package TimberKint
     */
    function add_timber_kint_filters($twig) {
        $twig->addFilter(new \Twig_SimpleFilter('kint', array($this,'safe_kint')));
        $twig->addFilter(new \Twig_SimpleFilter('d', array($this,'safe_kint')));
        return $twig;
    }
}
