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
		$value = sanitize_text_field( $value );
	}

	return $value;
}
