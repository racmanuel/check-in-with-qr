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

        /*echo "<h1 style='color:red;'>" . $hook_suffix . "</h1>";*/

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/check-in-with-qr-admin.css', array(), $this->version, 'all');

        if ('toplevel_page_check-in-with-qr' == $hook_suffix) {
            /** Datatables */
            wp_enqueue_style($this->plugin_name . '_bulma_css', 'https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css', array(), $this->version, 'all');
            wp_enqueue_style($this->plugin_name . '_datatables', 'https://cdn.datatables.net/v/bm/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css', array(), $this->version, 'all');
        }
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

        if ('toplevel_page_check-in-with-qr' == $hook_suffix) {
            /** 
             * Note for Development: 
             * Use the the console in the admin for print the Code of made by: check this in Github Gist in print console art in console.
            */
            /** Datatables */
            wp_enqueue_script($this->plugin_name . '_pdf_make', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js', array('jquery'), $this->version, false);
            wp_enqueue_script($this->plugin_name . '_vfs_fonts', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js', array('jquery'), $this->version, false);
            wp_enqueue_script($this->plugin_name . '_datatables', 'https://cdn.datatables.net/v/bm/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js', array('jquery'), $this->version, false);
        }
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
        $string_to_encrypt = $data;
        /** We use the secret word to encrypt this can be changed */
        $password = "check-in-with-qr";
        /** Encript the varialbe $string_to_encrypt */
        $encrypted_string = openssl_encrypt($string_to_encrypt, "AES-128-ECB", $password);

        /** Maybe this is future function for decrypt the string and text for QR Codes */
        //$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);

        include_once 'partials/check-in-with-qr-admin-display.php';
    }

    /**
     * Create new menu in WP Admin for Reports
     **/
    public function check_in_with_qr_menu_page()
    {
        add_menu_page(
            'Check In and Out',
            'Check In and Out',
            'manage_options',
            'check-in-with-qr',
            array(__CLASS__, 'check_in_with_qr_view'),
            'dashicons-analytics'
        );
        /** Maybe add a another sub-menu page for Reports by User and Date */
        /** Maybe add a another sub-menu page for Reports by User only for Check in with dates */
        /** Maybe add a another sub-menu page for Reports by User only for Check Out with dates */
        /** Maybe add a another sub-menu page for Settings and Credits */
    }

    /**
     * Include the page of Check in and Out
     */
    public static function check_in_with_qr_view()
    {
        include "partials/check-in-with-qr-admin-page.php";
    }

    public function modify_user_table($column)
    {
        $column['qr-code'] = 'QR Code';
        return $column;
    }

    public function modify_user_table_row($val, $column_name, $user_id)
    {
        /** New Object for the QRCode - Library */
        $qrcode = new QRCode();

        /** This info is inserted in the Database of WP */
        $data = $user_id->ID;
        /** But first we encrypt the information to prevent the content of the QR from being read */
        $string_to_encrypt = $data;
        /** We use the secret word to encrypt this can be changed */
        $password = "check-in-with-qr";
        /** Encript the varialbe $string_to_encrypt */
        $encrypted_string = openssl_encrypt($string_to_encrypt, "AES-128-ECB", $password);

        if ($column_name == 'qr-code') {
            ob_start();

            /** Return the QR Code and Button for Download in Users List in WP Admin */
            ?>
            <p style="text-align: center;">
                <img src="<?php echo $qrcode->render($encrypted_string) ?>" alt="QR Code" width="80px"/>
            </p>
            <p style="text-align: center;">
            <a href="<?php echo $qrcode->render($encrypted_string) ?>" download="QR_Code.png">Descargar</a>
            </p>
            <?php
            $val = ob_get_clean();
        }
        return $val;
    }
}
