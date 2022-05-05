<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://gideonidoko.com/about
 * @since             1.0.0
 * @package           Simple_Scroll_Progress
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Scroll Progress
 * Plugin URI:        https://gideonidoko.com/blog/build-a-customizable-scroll-progress-wordpress-plugin
 * Description:       Simple Scroll Progress adds a highly customizable scroll progress plugin to your WordPress site.
 * Version:           1.0.0
 * Author:            Gideon Idoko
 * Author URI:        https://gideonidoko.com/about
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-scroll-progress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SIMPLE_SCROLL_PROGRESS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-scroll-progress-activator.php
 */
function activate_simple_scroll_progress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-scroll-progress-activator.php';
	Simple_Scroll_Progress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-scroll-progress-deactivator.php
 */
function deactivate_simple_scroll_progress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-scroll-progress-deactivator.php';
	Simple_Scroll_Progress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_scroll_progress' );
register_deactivation_hook( __FILE__, 'deactivate_simple_scroll_progress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-scroll-progress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_scroll_progress() {

	$plugin = new Simple_Scroll_Progress();
	$plugin->run();

}
run_simple_scroll_progress();
