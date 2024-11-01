<?php
/**
 * Installation related functions and actions.
 *
 * @package 	Tipalink WP Plugin (tipalink)
 * @author 		Igor B.
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Tipalink_Install' ) ) :

/**
 * Tipalink_Install Class
 */
class Tipalink_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'install' ), 5 );
	}

	/**
	 * Install Tipalink
	 */
	public static function install() {

		if ( ! is_blog_installed() ) {
			return;
		}

	}

}

endif;


Tipalink_Install::init();
