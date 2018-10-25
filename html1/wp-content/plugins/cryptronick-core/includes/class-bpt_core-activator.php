<?php

/**
 * Fired during plugin activation
 *
 * @link       https://themeforest.net/user/blendpixels
 * @since      1.0.0
 *
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 * @author     bpthemes <blendpixels@gmail.com>
 */
class bpt_cryptronick_core_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		bptPostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}

}
