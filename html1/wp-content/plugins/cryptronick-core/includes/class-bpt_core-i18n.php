<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeforest.net/user/blendpixels
 * @since      1.0.0
 *
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 * @author     bpthemes <blendpixels@gmail.com>
 */
class bpt_cryptronick_core_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bpt_core',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
