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
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $name    The ID of this plugin.
	 */
	private $name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @var      string    $name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $version ) {

		$this->name = $name;
		$this->version = $version;

	}

	/**
	 * Create menu item.
	 *
	 * @since    0.1.0
	 */
	public function add_menu_page() {
		add_submenu_page(
			'options-general.php',
			__( 'Insert Code Lite', 'insert-code-lite' ),
			__( 'Insert Code', 'insert-code-lite' ),
			'activate_plugins',
			'iclp_code',
			array( $this, 'render_plugin_admin_page' )
		);
	}
	
	/**
	 * Render admin page.
	 * 
	 * @since    0.1.0
	 */
	public function render_plugin_admin_page() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/insert-code-lite-admin-display.php';
	}

	/**
	 * Initialize admin page.
	 * 
	 * @since    0.1.0
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
			__( 'Header', 'insert-code-lite' ),
			array( $this, 'display_field' ), 
			'iclp_code', 
			'iclp_code',
			array(
				'name' => 'header_scripts',
				'desc' => __( 'Will be printed within the <code>&#60;head&#62;&#60;/head&#62;</code> section.', 'insert-code-lite' )
			)
		);

		add_settings_field(
			'footer_scripts',
			__( 'Footer', 'insert-code-lite' ),
			array( $this, 'display_field' ), 
			'iclp_code', 
			'iclp_code',
			array(
				'name' => 'footer_scripts',
				'desc' => __( 'Will be printed before closing <code>&#60;/body&#62;</code> tag.', 'insert-code-lite' )
			)
		);
	}

	/**
	 * Sanitize option value.
	 * 
	 * @since    0.1.0
	 */
	public function sanitize( $input ) {
		$output = array(
			'header_scripts' => '',
			'footer_scripts' => ''
		);

		if ( isset( $input ) && is_array( $input ) ) {
			foreach ( $input as $k => $v ) {
				switch ( $k ) {
					case 'header_scripts':
					case 'footer_scripts':
						if ( current_user_can( 'unfiltered_html' ) )
							$output[ $k ] = $v;
						else
							$output[ $k ] = wp_kses_post( $v );
						break;
					
					default:
						break;
				}
			}
		}

		return $output;
	}

	/**
	 * Display field with description.
	 * 
	 * @since    0.1.0
	 */
	public function display_field( $args = array() ) {
		$name  = $args['name'];
		$desc  = $args['desc'];
		$value = get_option( 'iclp_code' );
		$value = esc_textarea( $value[ $name ] );

		echo "<textarea name='iclp_code[$name]' class='large-text code' rows='10' cols='50'>$value</textarea>";
		echo "<p class='description'>$desc</p>";
	}
}
