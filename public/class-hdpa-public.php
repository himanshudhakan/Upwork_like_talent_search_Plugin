<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Hdpa_Public {


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
	 * Add scripts for front.
	 *
	 * @since 1.0.0
	 */
	public function hdpa_enqueue_scripts() {

		// enqueue the datatables scripts
		wp_enqueue_script( 'hdpa-datatables-script', HDPA_ASSE_DIR_URL . 'js/DataTables/jquery.dataTables.min.js', array( 'jquery' ), HDPA_VERSION, true );
		wp_enqueue_style( 'hdpa-datatables-style', HDPA_ASSE_DIR_URL . 'css/DataTables/jquery.dataTables.min.css', array(), HDPA_VERSION );

		// enqueue the datatables scripts
		wp_enqueue_script( 'hdpa-select2-script', HDPA_ASSE_DIR_URL . 'js/select2/select2.min.js', array( 'jquery' ), HDPA_VERSION, true );
		wp_enqueue_style( 'hdpa-select2-style', HDPA_ASSE_DIR_URL . 'css/select2/select2.min.css', array(), HDPA_VERSION );

		// enqueue the plugin public script
		wp_enqueue_script( 'hdpa-public-script', HDPA_PUBLIC_DIR_URL . 'js/hdpa-public.js', array( 'jquery' ), HDPA_VERSION, true );
		wp_enqueue_style( 'hdpa-public-style', HDPA_PUBLIC_DIR_URL . 'css/hdpa-public.css', array(), HDPA_VERSION );

		// localize the plugin public object
		$hdpa_public_obj = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'hdpa-public-script', 'hdpa_public_obj', $hdpa_public_obj );

	}

	/**
	 * Filter the profile data ajax callback.
	 *
	 * @since 1.0.0
	 */
	public function hdpa_filter_profile_callback() {

		$response = array();

		$tb_data = hdpa_sanitize_text_field( $_POST );
		$draw = intval( $tb_data['draw'] );
		
		$all_data = $this->hdpa_filter_profile_get_data( $tb_data );

		$response['draw'] = $draw;
		$response = array_merge($response, $all_data);

		wp_send_json( $response );

	}

	/**
	 * Get profile data for list
	 *
	 * @since 1.0.0
	 * @param array $tb_data The data of table.
	 * @return array $all_data The profile data.
	 */
	public function hdpa_filter_profile_get_data( $tb_data ) {

		$all_data = $profiles = array();
		$args = $this->hdpa_filter_profile_prepare_query( $tb_data );
		$get_profiles = new WP_Query( $args );

		$totalRecords = $get_profiles->found_posts;
		$counter = 1;

		if ( $get_profiles->have_posts() ) {
			while ( $get_profiles->have_posts() ) {
				
				$get_profiles->the_post();
				$profile_id = get_the_ID();
				$meta_data = hdpa_get_profile_meta_data( $profile_id );
				$name = get_the_title();
				$age = hdpa_get_age_of_profile( $meta_data['dob'] );
				
				$ratings = str_repeat('<span class="rating__icon rating__icon--star dashicons dashicons-star-filled"></span>', $meta_data['ratings']);

				$data = array(
					'no' => $counter,
					'name' => $name,
					'age' => $age,
					'experience' => $meta_data['experience'],
					'completed_jobs' => $meta_data['completed_jobs'],
					'ratings' => $ratings,
				);
				$profiles[] = $data;
				$counter++;

			}
		}

		$all_data['iTotalRecords'] = $totalRecords;
		$all_data['iTotalDisplayRecords'] = $totalRecords;
		$all_data['data'] = $profiles;

		return $all_data;

	}

	/**
	 * Prepare query args for filter and sorting
	 *
	 * @since 1.0.0
	 * @param array $tb_data The data of table.
	 * @return array $args The query args.
	 */
	public function hdpa_filter_profile_prepare_query( $tb_data ) {

		$posts_per_page = intval( $tb_data['length'] );
		$offset = intval( $tb_data['start'] );
		$order = ( 'asc' === $tb_data['order'][0]['dir'] ) ? 'ASC' : 'DESC';

		$args = array(
			'post_type' => 'profile',
			'posts_per_page' => $posts_per_page,
    		'offset' => $offset,
			'order' => $order,
			'orderby' => 'title',
		);

		return $args;

	}

	/**
	 * Add all hooks
	 *
	 * @since 1.0.0
	 */
	public function add_hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'hdpa_enqueue_scripts' ) );
		add_action( 'wp_ajax_hdpa_filter_profile', array( $this, 'hdpa_filter_profile_callback' ) );
		add_action( 'wp_ajax_nopriv_hdpa_filter_profile', array( $this, 'hdpa_filter_profile_callback' ) );

	}


}
