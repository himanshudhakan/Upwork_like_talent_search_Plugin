<?php
/**
 * The class responsible for defining all actions for WP initialization of the plugin.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/includes
 */

/**
 * The class responsible for defining all actions for WP initialization of the plugin.
 *
 * @since      1.0.0
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/includes
 * @author     Himanshu Dhakan <himanshudhakan9@gmail.com>
 */
class Hdpa_Init {

	/**
	 * Register custom post types
	 *
	 * @since   1.0.0
	 */
	public function hdpa_register_post_type() {

		$labels = array(
			'name'               => _x( 'Profiles', 'Post type general name', 'hdpa' ),
			'singular_name'      => _x( 'Profile', 'Post type singular name', 'hdpa' ),
			'menu_name'          => _x( 'Profiles', 'Admin Menu text', 'hdpa' ),
			'name_admin_bar'     => _x( 'Profile', 'Add New on Toolbar', 'hdpa' ),
			'add_new'            => __( 'Add New', 'hdpa' ),
			'add_new_item'       => __( 'Add New Profile', 'hdpa' ),
			'new_item'           => __( 'New Profile', 'hdpa' ),
			'edit_item'          => __( 'Edit Profile', 'hdpa' ),
			'view_item'          => __( 'View Profile', 'hdpa' ),
			'all_items'          => __( 'All Profiles', 'hdpa' ),
			'search_items'       => __( 'Search Profiles', 'hdpa' ),
			'parent_item_colon'  => __( 'Parent Profiles:', 'hdpa' ),
			'not_found'          => __( 'No directories found.', 'hdpa' ),
			'not_found_in_trash' => __( 'No directories found in Trash.', 'hdpa' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'show_in_nav_menus'   => true,
			'supports'            => array( 'title' ),
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'can_export'          => true,
			'menu_position'       => null,
		);

		register_post_type( 'profile', $args );

	}

	/**
	 * Register custom taxonomies
	 *
	 * @since   1.0.0
	 */
	public function hdpa_register_taxonomy() {

		$skills_labels = array(
			'name'              => _x( 'Skills', 'taxonomy general name', 'hdpa' ),
			'singular_name'     => _x( 'Skill', 'taxonomy singular name', 'hdpa' ),
			'search_items'      => __( 'Search Skills', 'hdpa' ),
			'all_items'         => __( 'All Skills', 'hdpa' ),
			'parent_item'       => __( 'Parent Skill', 'hdpa' ),
			'parent_item_colon' => __( 'Parent Skill:', 'hdpa' ),
			'edit_item'         => __( 'Edit Skill', 'hdpa' ),
			'update_item'       => __( 'Update Skill', 'hdpa' ),
			'add_new_item'      => __( 'Add New Skill', 'hdpa' ),
			'new_item_name'     => __( 'New Skill Name', 'hdpa' ),
			'menu_name'         => __( 'Skill', 'hdpa' ),
		);

		$skills_args = array(
			'hierarchical'      => true,
			'labels'            => $skills_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'skills', array( 'profile' ), $skills_args );

		$education_labels = array(
			'name'              => _x( 'Education', 'taxonomy general name', 'hdpa' ),
			'singular_name'     => _x( 'Education', 'taxonomy singular name', 'hdpa' ),
			'search_items'      => __( 'Search Education', 'hdpa' ),
			'all_items'         => __( 'All Education', 'hdpa' ),
			'parent_item'       => __( 'Parent Education', 'hdpa' ),
			'parent_item_colon' => __( 'Parent Education:', 'hdpa' ),
			'edit_item'         => __( 'Edit Education', 'hdpa' ),
			'update_item'       => __( 'Update Education', 'hdpa' ),
			'add_new_item'      => __( 'Add New Education', 'hdpa' ),
			'new_item_name'     => __( 'New Education Name', 'hdpa' ),
			'menu_name'         => __( 'Education', 'hdpa' ),
		);

		$education_args = array(
			'hierarchical'      => true,
			'labels'            => $education_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'education', array( 'profile' ), $education_args );

	}

	/**
	 * Add all hooks
	 *
	 * @since 1.0.0
	 */
	public function add_hooks() {

		add_action( 'init', array( $this, 'hdpa_register_post_type' ) );
		add_action( 'init', array( $this, 'hdpa_register_taxonomy' ) );

	}


}
