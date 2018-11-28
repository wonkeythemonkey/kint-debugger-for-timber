<?php

namespace TimberKint;

class Utilities {
    var $_debug_enabled;
    
    /**
     * Check to see if the debugging is enabled and set to display in the
     * current Wordpress environment.
     * @internal
     * @return bool
     * 
     * @package TimberKint
     */
    public function debug_enabled() {
        if ( ! isset($this->_debug_enabled) ) {
            if (defined('WP_DEBUG') && true === WP_DEBUG) {
                if (defined('WP_DEBUG_DISPLAY' && false === WP_DEBUG_DISPLAY)) {
                    $this->_debug_enabled = false;
                }
                $this->_debug_enabled = true;
            }
            $this->_debug_enabled = false;
        }
        return $this->_debug_enabled;
    }
}
