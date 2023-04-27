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
		<div class="hdpa-filter-col hdpa-col-one">
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_keyword"><?php esc_html_e('Keyword', 'hdpa'); ?></label>
				<input type="text" id="hdpa_filter_keyword" name="hdpa_filter_keyword">
			</div>
		</div>
		<div class="hdpa-filter-col hdpa-col-two">
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_skills"><?php esc_html_e('Skills', 'hdpa'); ?></label>
				<select class="hdpa-select" id="hdpa_filter_skills" name="hdpa_filter_skills" multiple>
					<?php foreach ($skills as $skill_id => $skill) { ?>
						<option value="<?php echo esc_attr( $skill_id ); ?>"><?php echo $skill; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_education"><?php esc_html_e('Education', 'hdpa'); ?></label>
				<select class="hdpa-select" id="hdpa_filter_education" name="hdpa_filter_education" multiple>
					<?php foreach ($education as $education_id => $education) { ?>
						<option value="<?php echo esc_attr( $education_id ); ?>"><?php echo $education; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="hdpa-filter-col hdpa-col-two">
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_age"><?php esc_html_e('Age', 'hdpa'); ?></label>
				<input type="range" id="hdpa_filter_age" name="hdpa_filter_age" value="30">
			</div>
			<div class="hdpa-filter-field">
				<label><?php esc_html_e('Ratings', 'hdpa'); ?></label>
				<div id="full-stars-example-two">
				    <div class="rating-group">
				    	<?php for ( $i = 0; $i < 5; $i++ ) { ?>
							<?php $rat_num = $i + 1; ?>
							<label for="hdpa_filter_ratings_<?php echo $rat_num; ?>" aria-label="<?php echo $rat_num; ?> star" class="rating__label" for="rating3-<?php echo $rat_num; ?>"><i class="rating__icon rating__icon--star dashicons dashicons-star-filled"></i></label>
				        	<input class="rating__input" id="hdpa_filter_ratings_<?php echo $rat_num; ?>" name="hdpa_filter_ratings" id="rating3-<?php echo $rat_num; ?>" value="<?php echo $rat_num; ?>" type="radio">
						<?php } ?>
				    </div>
				</div>
			</div>
		</div>
		<div class="hdpa-filter-col hdpa-col-two">
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_completed_jobs"><?php esc_html_e('No of jobs competed', 'hdpa'); ?></label>
				<input type="number" id="hdpa_filter_completed_jobs" name="hdpa_filter_completed_jobs">
			</div>
			<div class="hdpa-filter-field">
				<label for="hdpa_filter_experience"><?php esc_html_e('Years of experience', 'hdpa'); ?></label>
				<input type="number" id="hdpa_filter_experience" name="hdpa_filter_experience">
			</div>
		</div>
		<div class="hdpa-filter-col hdpa-col-one">
			<div class="hdpa-filter-field">
				<button type="button" class="hdpa-filter-submit"><?php esc_html_e('Search', 'hdpa'); ?></button>
			</div>
		</div>
	</form>
</div>