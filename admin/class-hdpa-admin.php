<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/admin
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Hdpa_Admin {

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
	 * The array of post types to enqueue scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array    $allowed_post_types    The array of post types.
	 */
	public $allowed_post_types;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name        = $plugin_name;
		$this->version            = $version;
		$this->allowed_post_types = array(
			'profile',
		);

	}

	/**
	 * Add scripts for admin.
	 *
	 * @since 1.0.0
	 * @param string $hook_suffix The current page/screen id.
	 */
	public function hdpa_enqueue_scripts( $hook_suffix ) {

		$post_type = get_post_type();
		wp_register_script( 'hdpa-admin-script', HDPA_ADMIN_DIR_URL . 'js/hdpa-admin.js', array( 'jquery' ), HDPA_VERSION, true );
		wp_register_style( 'hdpa-jquery-ui', HDPA_ASSE_DIR_URL . 'libs/css/jquery-ui.css', array(), HDPA_VERSION );

		if ( in_array( $post_type, $this->allowed_post_types, true ) ) {

			$hdpa_admin_obj = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			);

			wp_enqueue_style( 'hdpa-jquery-ui' );

			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'hdpa-admin-script' );
			wp_localize_script( 'hdpa-admin-script', 'hdpa_admin_obj', $hdpa_admin_obj );
		}

	}

	/**
	 * Add meta boxes to custom post type.
	 *
	 * @since 1.0.0
	 * @param string $post_type The current post type.
	 */
	public function hdpa_add_meta_boxes( $post_type ) {

		if ( 'profile' === $post_type ) {
			add_meta_box(
				'hdpa_add_info',
				__( 'Additional information', 'hdpa' ),
				array( $this, 'hdpa_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
		}

	}

	/**
	 * Render additional information meta box content.
	 *
	 * @since 1.0.0
	 * @param WP_Post $post The post object.
	 */
	public function hdpa_meta_box_content( $post ) {

		global $profile_id;
		$profile_id = $post->ID;

		include HDPA_ADMIN_TEMPLATE_PATH . 'metaboxes/hdpa-metabox-profile.php';

	}

	/**
	 * Save profile post meta data
	 *
	 * @since 1.0.0
	 * @param int     $profile_id The post id.
	 * @param WP_Post $download The post object.
	 */
	public function hdpa_save_metadata( $profile_id, $download ) {

		if ( ! isset( $_POST['hdpa_profile_meta_nonce'] ) ) {
			return;
		}

		$nonce = hdpa_sanitize_text_field( $_POST['hdpa_profile_meta_nonce'] );
		if ( ! wp_verify_nonce( $nonce, 'hdpa_profile_meta' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $profile_id ) ) {
			return;
		}

		if ( isset( $_POST['profile_additional_data'] ) ) {

			$data = hdpa_sanitize_text_field( $_POST['profile_additional_data'] );

			foreach ( $data as $dkey => $value ) {
				$meta_key = sprintf( 'profile_%s', $dkey );
				update_post_meta( $profile_id, $meta_key, $value );
			}
		}

	}

	/**
	 * Add all hooks
	 *
	 * @since 1.0.0
	 */
	public function add_hooks() {

		add_action( 'add_meta_boxes', array( $this, 'hdpa_add_meta_boxes' ) );
		add_action( 'save_post_profile', array( $this, 'hdpa_save_metadata' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'hdpa_enqueue_scripts' ) );

	}

}
