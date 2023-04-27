<?php
/**
 * General core functions available on both the front-end and admin.
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/includes
 */

/**
 * Get sanitized value.
 *
 * @since  1.0.0
 * @param  mixed $value The value to sanitize.
 * @return mixed $value The sanitized value.
 */
function hdpa_sanitize_text_field( $value ) {

	if ( empty( $value ) ) {
		return false;
	}

	if ( is_array( $value ) ) {
		$sanitize_arr = array();
		foreach ( $value as $skey => $svalue ) {
			$sanitize_arr[ $skey ] = hdpa_sanitize_text_field( $svalue );
		}
		$value = $sanitize_arr;
	} else {
		$unslash_value = wp_unslash( $value );
		$value         = sanitize_text_field( $unslash_value );
	}

	return $value;
}

/**
 * Get profile meta kies.
 *
 * @since  1.0.0
 * @return array $data_kies The profile meta kies.
 */
function hdpa_get_profile_meta_kies() {

	$data_kies = array(
		'dob',
		'hobbies',
		'interests',
		'experience',
		'ratings',
		'completed_jobs',
	);

	return $data_kies;
}

/**
 * Get profile meta data.
 *
 * @since  1.0.0
 * @param  int $id The id of profile.
 * @return array $data The profile meta data.
 */
function hdpa_get_profile_meta_data( $id ) {

	$data_kyes = hdpa_get_profile_meta_kies();
	$data      = array();

	foreach ( $data_kyes as $dkey => $key ) {
		$meta_key     = sprintf( 'profile_%s', $key );
		$data[ $key ] = get_post_meta( $id, $meta_key, true );
	}

	return $data;
}

/**
 * Get age of profile.
 *
 * @since  1.0.0
 * @param  string $dob The dob of profile.
 * @return int $age The age of profile.
 */
function hdpa_get_age_of_profile( $dob ){

	$from = new DateTime($dob);
	$to   = new DateTime('today');
	$age  = $from->diff($to)->y;

	return $age;
}