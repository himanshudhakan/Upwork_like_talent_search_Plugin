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
	<div class="hdpa-filter-col hdpa-col-one">
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Keyword', 'hdpa'); ?></label>
			<input type="text" name="hdpa_filter[keyword]">
		</div>
	</div>
	<div class="hdpa-filter-col hdpa-col-two">
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Skills', 'hdpa'); ?></label>
			<select class="hdpa-select" name="hdpa_filter[skills][]" multiple>
				<?php foreach ($skills as $skill_id => $skill) { ?>
					<option value="<?php echo esc_attr( $skill_id ); ?>"><?php echo $skill; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Education', 'hdpa'); ?></label>
			<select class="hdpa-select" name="hdpa_filter[education][]" multiple>
				<?php foreach ($education as $education_id => $education) { ?>
					<option value="<?php echo esc_attr( $education_id ); ?>"><?php echo $education; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="hdpa-filter-col hdpa-col-two">
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Age', 'hdpa'); ?></label>
			<input type="range" name="hdpa_filter[age]" value="30">
		</div>
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Ratings', 'hdpa'); ?></label>
			<div id="full-stars-example-two">
			    <div class="rating-group">
			    	<?php for ( $i = 0; $i < 5; $i++ ) { ?>
						<?php $rat_num = $i + 1; ?>
						<label aria-label="<?php echo $rat_num; ?> star" class="rating__label" for="rating3-<?php echo $rat_num; ?>"><i class="rating__icon rating__icon--star dashicons dashicons-star-filled"></i></label>
			        	<input class="rating__input" name="hdpa_filter[ratings]" id="rating3-<?php echo $rat_num; ?>" value="<?php echo $rat_num; ?>" type="radio">
					<?php } ?>
			    </div>
			</div>
		</div>
	</div>
	<div class="hdpa-filter-col hdpa-col-two">
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('No of jobs competed', 'hdpa'); ?></label>
			<input type="number" name="hdpa_filter[completed_jobs]">
		</div>
		<div class="hdpa-filter-field">
			<label><?php esc_html_e('Years of experience', 'hdpa'); ?></label>
			<input type="number" name="hdpa_filter[experience]">
		</div>
	</div>
	<div class="hdpa-filter-col hdpa-col-one">
		<div class="hdpa-filter-field">
			<button class="hdpa-filter-submit"><?php esc_html_e('Search', 'hdpa'); ?></button>
		</div>
	</div>
</div>