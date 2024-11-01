<?php
/**
 * Tipalink WP Plugin Admin.
 *
 * @class 		Tipalink_Admin
 * @package 	Tipalink WP Plugin (tipalink)
 * @author 		Igor B.
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Tipalink_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Include required files
		$this->includes();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles_and_scripts' ) );
		add_action( 'in_admin_footer', array( $this, 'inline_script' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		
		if (file_exists(dirname(__FILE__).'/framework/admin-init.php')) {
		    include_once( dirname(__FILE__).'/framework/admin-init.php' );
		}

		// Classes

		// Meta Boxes

		// Functions
		include_once( 'tipalink-admin-functions.php' );
	}

	/**
	 * Register and enqueue admin-specific style sheets and scripts.
	 */
	public function enqueue_admin_styles_and_scripts() {

		// TODO
	}

	/**
	 * Include inline script.
	 */
	public function inline_script() {

		// TODO
	}

}

return new Tipalink_Admin();