<?php
/**
 * Include Tipalink Meta Tag and JavaScript into frontend each page
 *
 * @class       Tipalink_Head_HTML_Include
 * @version     1.0.0
 * @package     Tipalink WP Plugin (tipalink)
 * @category    Class
 * @author      Igor B.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tipalink_Head_HTML_Include Class
 */
class Tipalink_Head_HTML_Include {

	/**
	 * Init embed class.
	 */
	public static function init() {

		// Add a custom meta tag and a JavaScript "Tipalink" script to the head on each page
		add_action( 'wp_head', array( __CLASS__, 'insert_html_to_head' ) );
	}

	/**
	 * Tipalink meta tag and script.
	 */
	public static function insert_html_to_head() {

		global $tipalink_options;

		if ($tipalink_options['tip-tipalink-profile-id'] == '') {
			return;
		}

		$tipalink_script_attributes = 'data-tipalink-profile-id="'. esc_attr($tipalink_options['tip-tipalink-profile-id']) . '"';

		if ($tipalink_options['tip-tipalink-default-tip-amount']) {
			$tipalink_script_attributes .= ' data-tipalink-amount="'. esc_attr($tipalink_options['tip-tipalink-default-tip-amount']) . '"';
		}

		if ($tipalink_options['tip-tipalink-theme']) {
			$tipalink_script_attributes .= ' data-tipalink-theme="'. esc_attr($tipalink_options['tip-tipalink-theme']) . '"';
		}

		if ($tipalink_options['tip-tipalink-global-button'] && $tipalink_options['tip-tipalink-global-button'] === 'false') {
			$tipalink_script_attributes .= ' data-tipalink-hide-toggle="true"';
		}

		if ($tipalink_options['tip-tipalink-exteneral-links'] && $tipalink_options['tip-tipalink-exteneral-links'] === 'false') {
			$tipalink_script_attributes .= ' data-tipalink-hide-external-link="true"';
		}

		// Tipalink Meta Tag "tipalink-id"
		echo '<meta name="tipalink-id" content="'. esc_attr($tipalink_options['tip-tipalink-profile-id']) . '" />' . PHP_EOL;

		// Tipalink API Javascript
		echo '<script src="https://api.tipalink.com/tip.min.js" async ' . $tipalink_script_attributes . '></script>' . PHP_EOL;

	}
}

Tipalink_Head_HTML_Include::init();
