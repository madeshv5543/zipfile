<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeforest.net/user/blendpixels
 * @since             1.0.0
 * @package           Cryptronick-core
 *
 * @wordpress-plugin
 * Plugin Name:       Cryptronick Core
 * Plugin URI:        https://themeforest.net/user/blendpixels
 * Description:       Core plugin for Cryptronick Theme.
 * Version:           1.0.0
 * Author:            BPThemes
 * Author URI:        https://themeforest.net/user/blendpixels
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cryptronick-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bpt_core-activator.php
 */
function activate_bpt_cryptronick_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bpt_core-activator.php';
	bpt_cryptronick_core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bpt_core-deactivator.php
 */
function deactivate_bpt_cryptronick_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bpt_core-deactivator.php';
	bpt_cryptronick_core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bpt_cryptronick_core' );
register_deactivation_hook( __FILE__, 'deactivate_bpt_cryptronick_core' );


function add_defaults_preset(){

	$name = wp_get_theme()->get( 'TextDomain' );
	$presets =  call_user_func($name.'_default_preset');
	$options_presets = array();
	if(is_array($presets)){              
		foreach ($presets as $key => $value) {
			$options_presets[$key] = json_decode($presets[$key],true);
		}                  
	}
    
    $default_option = get_option( $name . '_preset');
    $default_option['default'] = $options_presets;

    update_option( $name . '_preset', $default_option );
}

register_activation_hook(__FILE__,'add_defaults_preset'  );

add_action('after_setup_theme','bpt_role_preset');

function bpt_role_preset(){
	$name = wp_get_theme()->get( 'TextDomain' );

    $default_option = get_option( $name . '_preset');
    if(!$default_option){
    	add_defaults_preset();
    }

}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bpt_core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bpt_cryptronick_core() {

	$plugin = new bpt_cryptronick_core();
	$plugin->run();

}
run_bpt_cryptronick_core();
