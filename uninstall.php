<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package 	Tipalink WP Plugin (tipalink)
 * @author 		Igor B.
 * @version     1.0.0
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb, $wp_roles;

include( 'includes/class-tipalink-install.php' );
