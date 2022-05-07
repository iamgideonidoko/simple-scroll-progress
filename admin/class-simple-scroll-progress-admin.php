<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://gideonidoko.com/about
 * @since      1.0.0
 *
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Scroll_Progress
 * @subpackage Simple_Scroll_Progress/admin
 * @author     Gideon Idoko <iamgideonidoko@gmail.com>
 */
class Simple_Scroll_Progress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $actual_name    The actual name of this plugin.
	 */
	private $actual_name;

	/**
	 * The name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_prefix    The name prefix of this plugin.
	 */
	private $plugin_prefix;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $actual_name, $plugin_prefix ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->actual_name = $actual_name;
		$this->plugin_prefix = $plugin_prefix;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-scroll-progress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-scroll-progress-admin.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Display settings page in admin
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page() {

		 // check if user is allowed access
		if ( ! current_user_can( 'manage_options' ) ) return;
		// settings_errors();
		?>
		<div class="wrap">
			<!-- Page -->
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
			<?php
			// output security fields
			settings_fields( $this->plugin_prefix.'_options' );
			// output setting sections
			do_settings_sections( $this->plugin_name );
			// submit button
			submit_button();
			?>
			</form>
		</div>
		<?php

		
	}

	/**
	 * Register a sublevel menu for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function add_sublevel_menu() {

		add_submenu_page(
			'options-general.php', /* parent page file name */
			$this->actual_name.' Settings', /* plugin page name */
			$this->actual_name, /* Menu title */
			'manage_options', /* capability */
			$this->plugin_name, /* plug slug (id) */
			array( $this, 'display_settings_page' ) /* pass display_settings_page as callback */
		);

		
	}

	/**
	 * Register a settings for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function validate_options($input) {

		// validate color
		if ( isset($input['color']) ) {
			$input['color'] = sanitize_hex_color($input['color']);
		} else {
			$input['color'] = $this->options_default()['color'];
		}

		// validate height
		if ( isset($input['height']) ) {
			$input['height'] = absint(sanitize_text_field($input['height']));
		} else {
			$input['height'] = $this->options_default()['height'];
		}

		// validate height
		if ( isset($input['zindex']) ) {
			$input['zindex'] = absint(sanitize_text_field($input['zindex']));
		} else {
			$input['zindex'] = $this->options_default()['zindex'];
		}

		// validate height
		if ( isset($input['cap']) ) {
			if ( ! array_key_exists( $input['cap'], $this->cap_list() ) ) {
				$input['cap'] = $this->options_default()['cap'];
			} 
		} else {
			$input['cap'] = $this->options_default()['cap'];
		}

		return $input;
		
	}


	/**
	 * Register a settings for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		register_setting(
			$this->plugin_prefix.'_options',
			$this->plugin_prefix.'_options',
			array(
				'sanitize_callback' => array( $this, 'validate_options' )
			)			 
		);
		
		add_settings_section(
			'default',
			'Customize Scroll Progress Bar',
			array($this, 'default_section_callback'),
			$this->plugin_name
		);

		add_settings_field(
			'color',
			'Color',
			array($this, 'color_callback'),
			$this->plugin_name,
			'default',
			[ 'id' => 'color', 'label' => 'Default: '. $this->options_default()['color'] ]
		);

		add_settings_field(
			'height',
			'Height',
			array($this, 'height_callback'),
			$this->plugin_name,
			'default',
			[ 'id' => 'height', 'label' => 'Default: '. $this->options_default()['height'] . ' (px)' ]
		);

		add_settings_field(
			'zindex',
			'Z Index',
			array($this, 'zindex_callback'),
			$this->plugin_name,
			'default',
			[ 'id' => 'zindex', 'label' => 'Default: '. $this->options_default()['zindex'] ]
		);

		add_settings_field(
			'cap',
			'Cap',
			array($this, 'cap_callback'),
			$this->plugin_name,
			'default',
			[ 'id' => 'cap', 'label' => 'Default: '. $this->cap_list()[$this->options_default()['cap']] ]
		);
		
	}

	/**
	 * add settings section callback
	 *
	 * @since    1.0.0
	 */
	public function default_section_callback() {

	}

	/**
	 * Add color option callback
	 *
	 * @since    1.0.0
	 */
	public function color_callback($args) {

		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';

		$options = get_option( $this->plugin_prefix.'_options', $this->options_default() );
		$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : $this->options_default()[$id];

		echo '<input type="color" required id="'. $this->plugin_prefix.'_options_'.$id .'" name="'. $this->plugin_prefix.'_options['.$id .']"
		value="'. $value .'">';
		echo '<br>';
		echo '<label style="margin-top: 0.4rem; display: inline-block;" for="'. $this->plugin_prefix.'_options_'.$id .'">'. $label .'</label>';
		
	}

	/**
	 * Add height option callback
	 *
	 * @since    1.0.0
	 */
	public function height_callback($args) {

		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';

		$options = get_option( $this->plugin_prefix.'_options', $this->options_default() );
		$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : $this->options_default()[$id];

		echo '<input type="number" required min="0" id="'. $this->plugin_prefix.'_options_'.$id .'" name="'. $this->plugin_prefix.'_options['.$id .']"
		value="'. $value .'">';
		echo '<br>';
		echo '<label style="margin-top: 0.4rem; display: inline-block;" for="'. $this->plugin_prefix.'_options_'.$id .'">'. $label .'</label>';
		
	}

	/**
	 * Add zindex option callback
	 *
	 * @since    1.0.0
	 */
	public function zindex_callback($args) {

		
		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$options = get_option( $this->plugin_prefix.'_options', $this->options_default() );
		$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : $this->options_default()[$id];
		
		echo '<input type="number" required min="0" id="'. $this->plugin_prefix.'_options_'.$id .'" name="'. $this->plugin_prefix.'_options['.$id .']"
		value="'. $value .'">';
		echo '<br>';
		echo '<label style="margin-top: 0.4rem; display: inline-block;" for="'. $this->plugin_prefix.'_options_'.$id .'">'. $label .'</label>';
	}

	/**
	 * add settings section callback
	 *
	 * @since    1.0.0
	 */
	public function cap_callback($args) {

		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$options = get_option( $this->plugin_prefix.'_options', $this->options_default() );
		$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : $this->options_default()[$id];

		$select_options = $this->cap_list();

		echo '<select required type="number" min="0" id="'. $this->plugin_prefix.'_options_'.$id .'" name="'. $this->plugin_prefix.'_options['.$id .']"
		value="'. $value .'">';
		foreach ($select_options as $val => $option) {
			echo '<option value="'. $val .'"'. ($val == $value ? 'selected' : '') .'>'. $option .'</option>';
		}
		echo '</select>';
		echo '<br>';
		echo '<label style="margin-top: 0.4rem; display: inline-block;" for="'. $this->plugin_prefix.'_options_'.$id .'">'. $label .'</label>';
		
	}

	/**
	 * get default options
	 *
	 * @since    1.0.0
	*/
	public function options_default() {
		return array(
			'color' => '#22c1c3',
			'height' => 10,
			'zindex' => 9999999,
			'cap' => 'curve'
		);
	}

	public function cap_list() {
		return array(
			'square' => 'Square',
			'curve' => 'Curve'
		);
	}

}
