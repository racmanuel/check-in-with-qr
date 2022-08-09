<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://racmanuel.dev/
 * @since      1.0.0
 *
 * @package    Check_In_With_Qr
 * @subpackage Check_In_With_Qr/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @todo Justify why we need this or remove it. AFAIK nothing can be done with textdomains else than loading it.
 *       This, if true, makes this class a total waste of code.
 *
 * @since      1.0.0
 * @package    Check_In_With_Qr
 * @subpackage Check_In_With_Qr/includes
 * @author     Manuel Ramirez Coronel <ra_cm@outlook.com>
 */
class Check_In_With_Qr_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'check-in-with-qr',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
