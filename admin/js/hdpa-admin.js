/**
 * Script for admin side
 *
 * @since      1.0.0
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/admin/js
 */

(function ( $ ) {
	'use strict';

	// Initialize the dob.
	$( "#hdpa-dob" ).datepicker(
		{
			changeMonth: true,
			changeYear: true,
			yearRange: "-80:-00"
		}
	);

})( jQuery );
