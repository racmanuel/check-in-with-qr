<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://racmanuel.dev/
 * @since      1.0.0
 *
 * @package    Check_In_With_Qr
 * @subpackage Check_In_With_Qr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the admin-facing stylesheet and JavaScript.
 * As you add hooks and methods, update this description.
 *
 * @package    Check_In_With_Qr
 * @subpackage Check_In_With_Qr/admin
 * @author     Manuel Ramirez Coronel <ra_cm@outlook.com>
 */

use chillerlan\QRCode\QRCode;

class Check_In_With_Qr_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The unique prefix of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_prefix    The string used to uniquely prefix technical functions of this plugin.
     */
    private $plugin_prefix;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name       The name of this plugin.
     * @param      string $plugin_prefix    The unique prefix of this plugin.
     * @param      string $version    The version of this plugin.
     */
    public function __construct($plugin_name, $plugin_prefix, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->plugin_prefix = $plugin_prefix;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     * @param string $hook_suffix The current admin page.
     */
    public function enqueue_styles($hook_suffix)
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/check-in-with-qr-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     * @param string $hook_suffix The current admin page.
     */
    public function enqueue_scripts($hook_suffix)
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/check-in-with-qr-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Create new section in Users profile
     **/
    public function check_in_with_qr_custom_profile($user_id)
    {
        /** New Object for the QRCode - Library */
        $qrcode = new QRCode();

        /** For see the $user_id contains */
		echo '<pre>';
		print_r($user_id);
		echo '</pre>';

        /** Not used */
		$name_user = get_user_meta($user_id->ID, 'first_name', true);
        $last_name_user = get_user_meta($user_id->ID, 'last_name', true);
        /** Not used */

        /** This info is inserted in the Database of WP */
        $data = $user_id->ID;
        /** But first we encrypt the information to prevent the content of the QR from being read */
        $string_to_encrypt= $data;
        /** We use the secret word to encrypt this can be changed */
        $password="check-in-with-qr";
        /** Encript the varialbe $string_to_encrypt */
        $encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);


        //$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
        
        include_once 'partials/check-in-with-qr-admin-display.php';
    }

     /**
     * Create new menu in WP Admin for Reports
     **/
    public function check_in_with_qr_menu_page(){
        add_menu_page(
            'Check In and Out',
            'Check In and Out',
            'manage_options',
            'check-in-with-qr',
            array(__CLASS__,'check_in_with_qr_view'),
            'dashicons-analytics'
        );
    }

    /**
     * Include the page of Check in and Out
     */
    public static function check_in_with_qr_view(){
        include "partials/check-in-with-qr-admin-page.php";
    }
}
