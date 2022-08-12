<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://racmanuel.dev/
 * @since      1.0.0
 *
 * @package    Check_In_With_Qr
 * @subpackage Check_In_With_Qr/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h3><?php _e("QR Code", "blank");?></h3>
<table class="form-table">
    <tr>
        <td>
            <img src="<?php echo $qrcode->render($encrypted_string) ?>" alt="QR Code" />
        </td>
    </tr>
</table>