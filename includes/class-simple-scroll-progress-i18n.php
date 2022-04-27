<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://gideonidoko.com/about
 * @since      1.0.0
 *
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/includes
 * @author     Gideon Idoko <iamgideonidoko@gmail.com>
 */
class Simple_Scroll_Progress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'simple-scroll-progress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
