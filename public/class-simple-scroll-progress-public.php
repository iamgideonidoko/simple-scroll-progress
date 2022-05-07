<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://gideonidoko.com/about
 * @since      1.0.0
 *
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/public
 * @author     Gideon Idoko <iamgideonidoko@gmail.com>
 */
class Simple_Scroll_Progress_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_prefix    The name prefix of this plugin.
	 */
	private $plugin_prefix;

	/**
	 * The options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_options_default;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_prefix, $plugin_options_default ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_prefix = $plugin_prefix;
		$this->plugin_options_default = $plugin_options_default;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Scroll_Progress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Scroll_Progress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-scroll-progress-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Scroll_Progress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Scroll_Progress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$options = get_option( $this->plugin_prefix.'_options', $this->plugin_options_default );
		
		wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-scroll-progress-public.js', array( 'jquery' ), $this->version, true );
		wp_add_inline_script($this->plugin_name, "_075a97e0_5a16_4b1f_9288_a4aa951951bfce_(". json_encode($options) .")", 'after');
	}

}
