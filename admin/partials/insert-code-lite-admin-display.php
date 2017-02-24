<?php
/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://dmtrmrv.com
 * @since      0.1.0
 *
 * @package    Insert Code Lite
 * @subpackage Insert Code Lite/admin/partials
 */

?>

<div class="wrap">
	<h2><?php esc_html_e( 'Insert Code', 'insert-code-lite' ); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'iclp_code' );?>
		<?php do_settings_sections( 'iclp_code' );?>
		<?php submit_button(); ?>
	</form>
</div>
