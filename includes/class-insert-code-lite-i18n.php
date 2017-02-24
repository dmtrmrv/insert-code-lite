<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @link       https://dmtrmrv.com
 * @since      0.1.0
 *
 * @package    Insert Code Lite
 * @subpackage Insert Code Lite/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that its ready for translation.
 *
 * @since      0.1.0
 * @package    Insert Code Lite
 * @subpackage Insert Code Lite/includes
 * @author     Dmitry Mayorov
 */
class Insert_Code_Lite_I18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'insert-code-lite',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);

	}
}
