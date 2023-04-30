<?php
/**
 * The plugin bootstrap file
 *
 * @link    https://github.com/himanshudhakan
 * @since   1.0.0
 * @package Himanshu_Dhakan_Practical_Assignment
 *
 * @wordpress-plugin
 * Plugin Name:       Himanshu Dhakan Practical Assignment
 * Plugin URI:        https://github.com/himanshudhakan/himanshu-dhakan-practical-assignment
 * Description:       The plugin allows users who are looking for profile to search and filter through the available profiles based on various criteria such as skills, education, age, No of jobs competed, and ratings. This plugin makes it easier for users to find the right profile for their project.
 * Version:           1.0.0
 * Author:            Himanshu Dhakan
 * Author URI:        https://github.com/himanshudhakan
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       hdpa
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'HDPA_VERSION', '1.0.0' );

/**
 * Plugin dir path.
 */
define( 'HDPA_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin dir url.
 */
define( 'HDPA_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * Includes dir path.
 */
define( 'HDPA_INC_DIR_PATH', HDPA_PLUGIN_DIR_PATH . 'includes/' );

/**
 * Admin dir path.
 */
define( 'HDPA_ADMIN_DIR_PATH', HDPA_PLUGIN_DIR_PATH . 'admin/' );

/**
 * Admin dir url.
 */
define( 'HDPA_ADMIN_DIR_URL', HDPA_PLUGIN_DIR_URL . 'admin/' );

/**
 * Admin template dir path.
 */
define( 'HDPA_ADMIN_TEMPLATE_PATH', HDPA_ADMIN_DIR_PATH . 'partials/' );

/**
 * Public dir path.
 */
define( 'HDPA_PUBLIC_DIR_PATH', HDPA_PLUGIN_DIR_PATH . 'public/' );

/**
 * Public dir url.
 */
define( 'HDPA_PUBLIC_DIR_URL', HDPA_PLUGIN_DIR_URL . 'public/' );

/**
 * Public template dir path.
 */
define( 'HDPA_PUBLIC_TEMPLATE_PATH', HDPA_PUBLIC_DIR_PATH . 'partials/' );

/**
 * Assets dir path.
 */
define( 'HDPA_ASSE_DIR_PATH', HDPA_PLUGIN_DIR_PATH . 'assets/' );

/**
 * Assets dir url.
 */
define( 'HDPA_ASSE_DIR_URL', HDPA_PLUGIN_DIR_URL . 'assets/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hdpa-activator.php
 */
function activate_hdpa() {
	include_once HDPA_INC_DIR_PATH . 'class-hdpa-activator.php';
	Hdpa_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hdpa-deactivator.php
 */
function deactivate_hdpa() {
	include_once HDPA_INC_DIR_PATH . 'class-hdpa-deactivator.php';
	Hdpa_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hdpa' );
register_deactivation_hook( __FILE__, 'deactivate_hdpa' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require HDPA_INC_DIR_PATH . 'class-himanshu-dhakan-practical-assignment.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_hdpa() {
	$plugin = new Himanshu_Dhakan_Practical_Assignment();
	$plugin->run();
}

// Run the plugin.
run_hdpa();
