<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/includes
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Himanshu_Dhakan_Practical_Assignment {


	/**
	 * The instances of classes.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array    $classes    The instances of all classes.
	 */
	protected $classes;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		if ( defined( 'HDPA_VERSION' ) ) {
			$this->version = HDPA_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'himanshu-dhakan-practical-assignment';

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Defines core functions available on both the front-end and admin.
	 * - Hdpa_i18n. Defines internationalization functionality.
	 * - Hdpa_Init. Defines hooks for WP initialization.
	 * - Hdpa_Admin. Defines all hooks for the admin area.
	 * - Hdpa_Public. Defines all hooks for the public side of the site.
	 * - Hdpa_Shortcodes. Defines all hooks for the shortcodes of the site.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_dependencies() {

		/**
		 * The core functions available on both the front-end and admin of the plugin.
		 */
		include_once HDPA_INC_DIR_PATH . 'hdpa-functions.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		include_once HDPA_INC_DIR_PATH . 'class-hdpa-i18n.php';

		/**
		 * The class responsible for defining all actions for WP initialization of the plugin.
		 */
		include_once HDPA_INC_DIR_PATH . 'class-hdpa-init.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the plugin.
		 */
		include_once HDPA_PUBLIC_DIR_PATH . 'class-hdpa-public.php';

		/**
		 * The class responsible for defining all shortcodes of the plugin.
		 */
		include_once HDPA_PUBLIC_DIR_PATH . 'class-hdpa-shortcodes.php';

		if ( is_admin() ) {

			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			include_once HDPA_ADMIN_DIR_PATH . 'class-hdpa-admin.php';

			$hdpa_admin             = new Hdpa_Admin( $this->plugin_name, $this->version );
			$this->classes['admin'] = $hdpa_admin;

		}

		$hdpa_i18n       = new Hdpa_I18n();
		$hdpa_init       = new Hdpa_Init();
		$hdpa_public     = new Hdpa_Public( $this->plugin_name, $this->version );
		$hdpa_shortcodes = new Hdpa_Shortcodes( $this->plugin_name, $this->version );

		$this->classes['i18n']       = $hdpa_i18n;
		$this->classes['init']       = $hdpa_init;
		$this->classes['public']     = $hdpa_public;
		$this->classes['shortcodes'] = $hdpa_shortcodes;

	}

	/**
	 * Register all of the hooks of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_hooks() {

		if ( ! empty( $this->classes ) ) {
			foreach ( $this->classes as $key => $object ) {
				if ( method_exists( $object, 'add_hooks' ) ) {
					$object->add_hooks();
				}
			}
		}

	}

	/**
	 * Execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {

		$this->load_dependencies();
		$this->define_hooks();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since  1.0.0
	 * @return string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
