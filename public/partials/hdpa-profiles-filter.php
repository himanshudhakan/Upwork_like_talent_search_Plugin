<?php
/**
 * Provide a view of the profile list filter
 *
 * @link  https://github.com/himanshudhakan
 * @since 1.0.0
 *
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$skills = get_terms( array(
    'taxonomy'   => 'skills',
    'hide_empty' => false,
    'fields'     => 'id=>name',
) );

$education = get_terms( array(
    'taxonomy'   => 'education',
    'hide_empty' => false,
    'fields'     => 'id=>name',
) );

?>
<button class="hdpa-btn-filter">
	<span class="filter-text">Filter</span>
	<img class="hdpa-filter-icon" src="<?php echo esc_url( HDPA_ASSE_DIR_URL . 'images/filter.png' ); ?>">
</button>
<div class="hdpa-filter-content">
	<form id="hdpa-filter-form" method="post">
		<div class="row">
			<div class="hdpa-filter-col hdpa-col-one">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_keyword"><?php esc_html_e('Keyword', 'hdpa'); ?></label>
					<input type="text" id="hdpa_filter_keyword" name="hdpa_filter_keyword">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_skills"><?php esc_html_e('Skills', 'hdpa'); ?></label>
					<select class="hdpa-select" id="hdpa_filter_skills" name="hdpa_filter_skills" multiple>
						<?php foreach ($skills as $skill_id => $skill) { ?>
							<option value="<?php echo esc_attr( $skill_id ); ?>"><?php echo $skill; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_education"><?php esc_html_e('Education', 'hdpa'); ?></label>
					<select class="hdpa-select" id="hdpa_filter_education" name="hdpa_filter_education" multiple>
						<?php foreach ($education as $education_id => $education) { ?>
							<option value="<?php echo esc_attr( $education_id ); ?>"><?php echo $education; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_age"><?php esc_html_e('Age', 'hdpa'); ?></label>
					<div class="hdpa-filter-age-wrap">
						<input type="range" id="hdpa_filter_age" name="hdpa_filter_age" value="0">
						<p class="hdpa-filter-age-text"><span class="hdpa_filter_age_from_text">0</span> <?php esc_html_e('To', 'hdpa'); ?> <span class="hdpa_filter_age_to_text"></span></p>
					</div>
				</div>
			</div>
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field hdpa-filter-field-ratings">
					<label><?php esc_html_e('Ratings', 'hdpa'); ?></label>
					<div class="hdpa-filter-field-content">
						<div class="hdpa-rating">
					    	<?php for ( $i = 5; $i > 0; $i-- ) { ?>
								<?php $rat_num = $i; ?>
								<input type="radio" id="star<?php echo $rat_num; ?>" name="hdpa_filter_ratings" value="<?php echo $rat_num; ?>" /><label for="star<?php echo $rat_num; ?>"><i class="rating__icon rating__icon--star dashicons dashicons-star-filled"></i></label>
							<?php } ?>
					    </div>
					   </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_completed_jobs"><?php esc_html_e('No of jobs competed', 'hdpa'); ?></label>
					<input type="number" id="hdpa_filter_completed_jobs" name="hdpa_filter_completed_jobs">
				</div>
			</div>
			<div class="hdpa-filter-col hdpa-col-two">
				<div class="hdpa-filter-field">
					<label for="hdpa_filter_experience"><?php esc_html_e('Years of experience', 'hdpa'); ?></label>
					<input type="number" id="hdpa_filter_experience" name="hdpa_filter_experience">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hdpa-filter-col hdpa-col-one">
				<div class="hdpa-filter-field hdpa-filter-field-submit">
					<button type="button" class="hdpa-filter-submit"><?php esc_html_e('Search', 'hdpa'); ?></button>
				</div>
			</div>
		</div>
	</form>
</div>