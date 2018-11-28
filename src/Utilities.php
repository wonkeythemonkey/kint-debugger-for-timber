<?php

namespace TimberKint;

class Utilities {
    /**
     * Check to see if the debugging is enabled and set to display in the
     * current Wordpress environment.
     * @internal
     * @return bool
     * 
     * @package TimberKint
     */
    public static function debug_enabled() {
        if (defined('WP_DEBUG') && true === WP_DEBUG) {
            if (defined('WP_DEBUG_DISPLAY' && false === WP_DEBUG_DISPLAY)) {
                return false;
            }
            return true;
        }
        return false;
    }
}
