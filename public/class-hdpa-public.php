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
	 * The wp query args.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array    $args    The query args.
	 */
	public $args;

	/**
	 * The table filter args.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array    $tb_args    The filter args.
	 */
	public $tb_args;

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

		// enqueue the dashicons style
		wp_enqueue_style('dashicons');

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

		$tb_args = hdpa_sanitize_text_field( $_POST );
		$this->tb_args = $tb_args;
		$draw = intval( $tb_args['draw'] );
		
		$all_data = $this->hdpa_filter_profile_get_data();

		$response['draw'] = $draw;
		$response = array_merge($response, $all_data);

		wp_send_json( $response );

	}

	/**
	 * Get profile data for list
	 *
	 * @since 1.0.0
	 * @return array $all_data The profile data.
	 */
	public function hdpa_filter_profile_get_data() {

		$all_data = $profiles = array();
		$this->hdpa_filter_profile_prepare_query();
		$args = $this->args;
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
				
				$ratings = str_repeat('<span class="rating__icon rating__icon--star hdpa-rating__icon--star-filled dashicons dashicons-star-filled"></span>', $meta_data['ratings']);
				$ratings_html = sprintf('<div class="rating">%s</div>', $ratings);

				$data = array(
					'no' => $counter,
					'name' => $name,
					'age' => $age,
					'experience' => $meta_data['experience'],
					'completed_jobs' => $meta_data['completed_jobs'],
					'ratings' => $ratings_html,
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
	 */
	public function hdpa_filter_profile_prepare_query() {

		$tb_args = $this->tb_args;
		$posts_per_page = intval( $tb_args['length'] );
		$offset = intval( $tb_args['start'] );
		$order = ( 'asc' === $tb_args['order'][0]['dir'] ) ? 'ASC' : 'DESC';

		$args = array(
			'post_type' => 'profile',
			'posts_per_page' => $posts_per_page,
    		'offset' => $offset,
			'order' => $order,
			'orderby' => 'title',
		);

		if ( isset( $tb_args['filter']['keyword'] ) && ! empty( $tb_args['filter']['keyword'] ) ) {
			
			$args['s'] = $tb_args['filter']['keyword'];

		}

		$this->args = $args;
		$this->hdpa_filter_profile_prepare_meta_args();
		$this->hdpa_filter_profile_prepare_taxonomy_args();

	}

	/**
	 * Prepare meta query args for filter
	 *
	 * @since 1.0.0
	 */
	public function hdpa_filter_profile_prepare_meta_args() {

		$tb_args = $this->tb_args;
		$meta_args = array();

		if ( isset( $tb_args['filter']['age'] ) && ! empty( $tb_args['filter']['age'] ) ) {
			
			$meta_args[] = array(
				'key' => '_profile_age',
				'value' => $tb_args['filter']['age'],
				'compare' => '<=',
				'type' => 'numeric',
			);

		}

		if ( isset( $tb_args['filter']['ratings'] ) && ! empty( $tb_args['filter']['ratings'] ) ) {
			
			$meta_args[] = array(
				'key' => '_profile_ratings',
				'value' => $tb_args['filter']['ratings'],
				'compare' => '>=',
				'type' => 'numeric',
			);

		}

		if ( isset( $tb_args['filter']['completed_jobs'] ) && ! empty( $tb_args['filter']['completed_jobs'] ) ) {
			
			$meta_args[] = array(
				'key' => '_profile_completed_jobs',
				'value' => $tb_args['filter']['completed_jobs'],
				'compare' => '>=',
				'type' => 'numeric',
			);

		}

		if ( isset( $tb_args['filter']['experience'] ) && ! empty( $tb_args['filter']['experience'] ) ) {
			
			$meta_args[] = array(
				'key' => '_profile_experience',
				'value' => $tb_args['filter']['experience'],
				'compare' => '>=',
				'type' => 'numeric',
			);

		}

		if ( ! empty( $meta_args ) ) {
			$this->args['meta_query'] = $meta_args;
		}

	}

	/**
	 * Prepare taxonomy query args for filter
	 *
	 * @since 1.0.0
	 */
	public function hdpa_filter_profile_prepare_taxonomy_args() {

		$tb_args = $this->tb_args;
		$tax_args = array();

		if ( isset( $tb_args['filter']['skills'] ) && ! empty( $tb_args['filter']['skills'] ) ) {
			
			$tax_args[] = array(
				'taxonomy' => 'skills',
				'field' => 'term_id',
				'terms' => $tb_args['filter']['skills'],
				'operator' => 'IN',
			);

		}

		if ( isset( $tb_args['filter']['education'] ) && ! empty( $tb_args['filter']['education'] ) ) {
			
			$tax_args[] = array(
				'taxonomy' => 'education',
				'field' => 'term_id',
				'terms' => $tb_args['filter']['education'],
				'operator' => 'IN',
			);

		}

		if ( ! empty( $tax_args ) ) {
			$this->args['tax_query'] = $tax_args;
		}

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
