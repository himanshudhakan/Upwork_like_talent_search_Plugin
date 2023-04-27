<?php
/**
 * Provide a view of the profile list
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

?>
<div class="hdpa-profile-list-wrap">
	<div class="hdpa-profile-list-filter">
		<?php require HDPA_PUBLIC_TEMPLATE_PATH . 'hdpa-profiles-filter.php'; ?>
	</div>
	<div class="hdpa-profile-list-table">
		<?php require HDPA_PUBLIC_TEMPLATE_PATH . 'hdpa-profiles-table.php'; ?>
	</div>
</div>
