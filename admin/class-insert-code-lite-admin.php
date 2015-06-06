<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://dmitrymayorov.com
 * @since      0.1.0
 *
 * @package    Insert_Code_Lite
 * @subpackage Insert_Code_Lite/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Insert_Code_Lite
 * @subpackage Insert_Code_Lite/admin
 * @author     Dmitry Mayorov
 */
class Insert_Code_Lite_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since 0.1.0
	 * @access private
	 * @var    string  $name The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since  0.1.0
	 * @access private
	 * @var    string  $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 0.1.0
	 * @var   string $name    The name of this plugin.
	 * @var   string $version The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}

	/**
	 * Create menu item.
	 *
	 * @since 0.1.0
	 */
	public function add_menu_page() {
		add_submenu_page(
			'options-general.php',
			_x( 'Insert Code', 'Plugin name in a browser page title.', 'insert-code-lite' ),
			_x( 'Insert Code', 'Plugin name in a dashboard menu.', 'insert-code-lite' ),
			'activate_plugins',
			'iclp_code',
			array( $this, 'render_plugin_admin_page' )
		);
	}
	
	/**
	 * Render admin page.
	 * 
	 * @since 0.1.0
	 */
	public function render_plugin_admin_page() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/insert-code-lite-admin-display.php';
	}

	/**
	 * Initialize admin page.
	 * 
	 * @since 0.1.0
	 */
	public function admin_init() {
		register_setting(
			'iclp_code',
			'iclp_code',
			array( $this, 'sanitize' )
		);
		
		add_settings_section(
			'iclp_code',
			'',
			'__return_false',
			'iclp_code'
		);
		
		add_settings_field(
			'header_scripts',
			_x( 'Header', 'Meaning \'head\' section of the site.', 'insert-code-lite' ),
			array( $this, 'display_field' ), 
			'iclp_code', 
			'iclp_code',
			array(
				'name' => 'header_scripts',
				'desc' => sprintf( _x( 'Will be printed within the %s section.', '\'head\'', 'insert-code-lite' ), '<code>' . esc_html( '<head></head>' ) . '</code>' ),
			)
		);

		add_settings_field(
			'footer_scripts',
			_x( 'Footer', 'Meaning the section of the site before closing \'body\' tag.', 'insert-code-lite' ),
			array( $this, 'display_field' ), 
			'iclp_code',
			'iclp_code',
			array(
				'name' => 'footer_scripts',
				'desc' => sprintf( _x( 'Will be printed before closing %s tag.', '\'body\'', 'insert-code-lite' ), '<code>' . esc_html( '</body>' ) . '</code>' ),
			)
		);
	}

	/**
	 * Sanitize option value.
	 * 
	 * @since 0.1.0
	 */
	public function sanitize( $input ) {
		if ( isset( $input ) && is_array( $input ) ) {
			foreach ( $input as $k => $v ) {
				if ( current_user_can( 'unfiltered_html' ) )
					$output[ $k ] = $v;
				else
					$output[ $k ] = wp_kses_post( $v );
			}
		}

		return $output;
	}

	/**
	 * Display field with description.
	 * 
	 * @since 0.1.0
	 */
	public function display_field( $args = array() ) {
		$value = get_option( 'iclp_code' );

		// Display textarea.
		printf( '<textarea name="iclp_code[%s]" class="large-text code" rows="10" cols="50">', $args['name'] );
			echo esc_textarea( $value[ $args['name'] ]  );
		echo "</textarea>";

		// Display description.
		printf( '<p class="description">%s</p>', $args['desc'] );
	}
}
