<?php
/*
    Plugin Name: Kint Debugger for Timber
    Plugin URI: https://github.com/wonkeythemonkey/kint-debugger-for-timber
    Description: Adds a |kint filter to Timber
    Author: jajanowiak
    Version: 0.1.0
    Author URI: https://github.com/wonkeythemonkey
    */

    // If this file is called directly, abort.
    // If debugging is disabled, abort.

    $timber_kint_utilities = new TimberKint\Utilities();

    if ( ! defined( 'WPINC' ) || ! $timber_kint_utilities->debug_enabled() ) {
        die;
    }

    add_action('admin_init', function(){ 
        global $pagenow;

        if ( $pagenow === 'plugins.php' ) {
            if ( ! class_exists('Timber') ) {
                $class = 'warning';
                
                $text = 'Timber has not been installed — the Kint Debugger for Timber plugin has no purpose without it.';
                
                add_action( 'admin_notices', function() use ( $text, $class ) {
                        echo '<div class="notice notice-'.$class.'"><p>'.$text.'</p></div>';
                    }, 1 );
            }
    
            if ( ! class_exists('Kint') ) {
                $class = 'error';
                
                $url = '/wp-admin/network/plugin-install.php?tab=plugin-information&plugin=kint-debugger&TB_iframe=true&width=772&height=607';
                $text = "In order to use the Kint Debugger for Timber, you need to install and activate the <a href='$url' class='thickbox'>Kint Debugger</a> Plugin";
                
                add_action( 'admin_notices', function() use ( $text, $class ) {
                        echo '<div class="notice notice-'.$class.'"><p>'.$text.'</p></div>';
                    }, 1 );
            }
        }
        
    });

    require_once( dirname( __FILE__ ) . '/vendor/autoload.php');

    add_action( 'plugins_loaded', 'kint_debugger_for_timber' );
    function kint_debugger_for_timber() {
        $timber_kint_instance = new TimberKint\Filter();
    }

    