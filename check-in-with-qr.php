<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress or ClassicPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://racmanuel.dev/
 * @since             1.0.0
 * @package           Check_In_With_Qr
 *
 * @wordpress-plugin
 * Plugin Name:       Check-in with QR
 * Plugin URI:        https://plugin.com/check-in-with-qr-uri/
 * Description:       Register the exits and entrances of users, employees or someone else... using a QR code, this plugin can be used as a time clock, It has a Shortcode to select if you want to register the entrance or exit. This plugin uses the device's camera to scan the QR codes. Important! QR codes are generated when registering a new user in WordPress and that code can be saved or copied to print it on a Badge or some other, the ideal is to leave a computer to scan QR codes, the data that is registered is the time of entry and time of exit, and user.
 * Version:           1.0.0
 * Author:            Manuel Ramirez Coronel
 * Requires at least: 6.0.0
 * Requires PHP:      7.4
 * Tested up to:      6.0.1
 * Author URI:        https://racmanuel.dev//
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       check-in-with-qr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Get the Composer autoload
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CHECK_IN_WITH_QR_VERSION', '1.0.0' );

/**
 * Define the Plugin basename
 */
define( 'CHECK_IN_WITH_QR_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 *
 * This action is documented in includes/class-check-in-with-qr-activator.php
 * Full security checks are performed inside the class.
 */
function check_in_with_qr_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-check-in-with-qr-activator.php';
	Check_In_With_Qr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 *
 * This action is documented in includes/class-check-in-with-qr-deactivator.php
 * Full security checks are performed inside the class.
 */
function check_in_with_qr_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-check-in-with-qr-deactivator.php';
	Check_In_With_Qr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'check_in_with_qr_activate' );
register_deactivation_hook( __FILE__, 'check_in_with_qr_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-check-in-with-qr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Generally you will want to hook this function, instead of callign it globally.
 * However since the purpose of your plugin is not known until you write it, we include the function globally.
 *
 * @since    1.0.0
 */
function check_in_with_qr_run() {

	$plugin = new Check_In_With_Qr();
	$plugin->run();

}
check_in_with_qr_run();
