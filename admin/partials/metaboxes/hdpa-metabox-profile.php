<?php
/**
 * Provide a metabox area view for the profile post type
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $profile_id;
$data = hdpa_get_profile_meta_data( $profile_id );

?>
<?php wp_nonce_field( 'hdpa_profile_meta', 'hdpa_profile_meta_nonce' ); ?>
<div class="hdpa-metabox-wrap">
	<div class="hdpa-field">
		<label for="hdpa-dob"><?php esc_html_e( 'DOB', 'hdpa' ); ?></label>
		<input type="text" id="hdpa-dob" name="profile_additional_data[dob]" value="<?php echo esc_attr( $data['dob'] ); ?>">
	</div>
	<div class="hdpa-field">
		<label for="hdpa-hobbies"><?php esc_html_e( 'Hobbies', 'hdpa' ); ?></label>
		<textarea id="hdpa-hobbies" name="profile_additional_data[hobbies]"><?php echo esc_html( $data['hobbies'] ); ?></textarea>
	</div>
	<div class="hdpa-field">
		<label for="hdpa-interests"><?php esc_html_e( 'Interests', 'hdpa' ); ?></label>
		<textarea id="hdpa-interests" name="profile_additional_data[interests]"><?php echo esc_html( $data['interests'] ); ?></textarea>
	</div>
	<div class="hdpa-field">
		<label for="hdpa-experience"><?php esc_html_e( 'Years of experience', 'hdpa' ); ?></label>
		<input type="number" id="hdpa-experience" name="profile_additional_data[experience]" value="<?php echo esc_attr( $data['experience'] ); ?>">
	</div>
	<div class="hdpa-field">
		<label for="hdpa-ratings"><?php esc_html_e( 'Ratings', 'hdpa' ); ?></label>
		<select id="hdpa-ratings" name="profile_additional_data[ratings]">
			<?php for ( $i = 0; $i < 5; $i++ ) { ?>
				<?php $rat_num = $i + 1; ?>
				<option value="<?php echo esc_attr( $rat_num ); ?>" <?php selected( $rat_num, $data['ratings'] ); ?>><?php echo esc_html( $rat_num ); ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="hdpa-field">
		<label for="hdpa-completed-jobs"><?php esc_html_e( 'No jobs completed', 'hdpa' ); ?></label>
		<input type="number" id="hdpa-completed-jobs" name="profile_additional_data[completed_jobs]" value="<?php echo esc_attr( $data['completed_jobs'] ); ?>">
	</div>
</div>
