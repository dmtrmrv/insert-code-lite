<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://dmitrymayorov.com
 * @since      0.1.0
 *
 * @package    Insert_Code_Lite
 * @subpackage Insert_Code_Lite/admin/partials
 */
?>

<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e( 'Insert Code', 'insert-code-lite' ); ?></h2>
	<form method="post" action="options.php">
		<?php
			settings_fields( 'iclp_code' );
			do_settings_sections( 'iclp_code' );
			submit_button();
		?>
	</form>
</div>
