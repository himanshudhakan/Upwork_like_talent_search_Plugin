<?php
/**
 * The shortcodes class file to define all shortcodes.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public
 */

/**
 * The shortcodes class to define all shortcodes.
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Hdpa_Shortcodes {


	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Display the data to the front side.
	 *
	 * @since 1.0.0
	 */
	public function hdap_display_data_shortcode() {

		ob_start();

		include HDPA_PUBLIC_TEMPLATE_PATH . 'hdpa-profiles-list.php';

		return ob_get_clean();

	}

	/**
	 * Add all hooks
	 *
	 * @since 1.0.0
	 */
	public function add_hooks() {

		add_shortcode( 'hdpa_profiles_list', array( $this, 'hdap_display_data_shortcode' ) );

	}

}
