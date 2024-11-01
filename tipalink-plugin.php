<?php

/**
 * Plugin Name: Tipalink
 * Plugin URI: https://www.tipalink.com/
 * Description: Adds the Tipalink App so site visitors can leave tips on your site's web pages.
 * Version: 1.0.0
 * Author: Igor B.
 * Author URI: http://igor-b.com
 * Text Domain: tipalink-plugin
 * Domain Path: /languages
 * Copyright: 2019 Igor Bondarenko
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package Tipalink WP Plugin (tipalink)
 * @author Igor B.
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TipalinkWP' ) ) :

/**
 * Main TipalinkWP Class
 *
 * @version	1.0.0
 */
final class TipalinkWP {

	/**
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * @var TipalinkWP the single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main TipalinkWP Instance
	 *
	 * Ensures only one instance of TipalinkWP is loaded or can be loaded.
	 *
	 * @static
	 * @see Tipalink()
	 * @return TipalinkWP - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Wow! Take the cake.', 'tipalink' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Wow! Take the cake.', 'tipalink' ), '1.0.0' );
	}

	/**
	 * TipalinkWP Constructor.
	 *
	 */
	public function __construct() {
		// Auto-load classes on demand
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		// Define constants
		$this->define_constants();

		// Include required files
		$this->includes();

		// Hooks
		add_action( 'init', array( $this, 'init' ), 0 );
		add_filter( 'plugin_action_links', array( $this, 'add_plugin_options_link' ), 10, 2 );

	}

	/**
	 * Auto-load Tipalink classes on demand to reduce memory consumption.
	 *
	 * @param mixed $class
	 */
	public function autoload( $class ) {
		$path  = null;
		$class = strtolower( $class );
		$file = 'class-' . str_replace( '_', '-', $class ) . '.php';

		if ( strpos( $class, 'tipalink_admin' ) === 0 ) {
			$path = $this->plugin_path() . '/includes/admin/';
		}

		if ( $path && is_readable( $path . $file ) ) {
			include_once( $path . $file );
			return;
		}

		// Fallback
		if ( strpos( $class, 'tipalink_' ) === 0 ) {
			$path = $this->plugin_path() . '/includes/';
		}

		if ( $path && is_readable( $path . $file ) ) {
			include_once( $path . $file );
			return;
		}
	}

	/**
	 * Define Tipalink Constants
	 */
	private function define_constants() {
		define( 'TIPALINK_PLUGIN_FILE', __FILE__ );
		define( 'TIPALINK_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'TIPALINK_VERSION', $this->version );
		define( 'TIPALINK_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
		define( 'TIPALINK_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {

		include_once( 'includes/class-tipalink-install.php' );

		if ( is_admin() ) {
			include_once( 'includes/admin/class-tipalink-admin.php' );
		} else {
			$this->frontend_includes();
		}

	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {

		// Include functions

		// Classes (used on all pages)
		include_once( 'includes/class-tipalink-head-embed.php' );

		if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/includes/admin/framework/redux-framework/ReduxCore/framework.php' ) ) {
		    require_once( dirname( __FILE__ ) . '/includes/admin/framework/redux-framework/ReduxCore/framework.php' );
		}

		if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/includes/admin/framework/tipalink-config.php' ) ) {
		    require_once( dirname( __FILE__ ) . '/includes/admin/framework/tipalink-config.php' );
		}

	}

	/**
	 * Init TipalinkWP when WordPress Initialises.
	 */
	public function init() {

		// Init action
		do_action( 'tipalink_init' );

	}

	/**
	 * Add plugin options page link.
	 *
	 */
	public function add_plugin_options_link( $actions, $plugin_file ){
		if( false === strpos( $plugin_file, basename(__FILE__) ) )
			return $actions;

		$settings_link = '<a href="options-general.php?page=tipalink_plugin">Settings</a>';

		array_unshift( $actions, $settings_link );

		return $actions;

	}

	/**
	 * Get the plugin url.
	 *
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}

endif;

/**
 * Returns the main instance of Tipalink to prevent the need to use globals.
 *
 * @return TipalinkWP
 */
function Tipalink() {
	return TipalinkWP::instance();
}

$GLOBALS['tipalink'] = Tipalink();
