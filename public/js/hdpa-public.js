/**
 * Script for public side
 *
 * @since      1.0.0
 * @package    Himanshu_Dhakan_Practical_Assignment
 * @subpackage Himanshu_Dhakan_Practical_Assignment/public/js
 */

(function ( $ ) {
	'use strict';

	var ajaxurl   = hdpa_public_obj.ajaxurl,
		nonce     = hdpa_public_obj.nonce,
		is_filter = false;

	// Initialize the datatable.
	var profile_dataTable = $( '.hdpa-profile-table' ).DataTable(
		{
			processing: true,
			serverSide: true,
			serverMethod: 'post',
			searching: false,
			lengthChange: false,
			pageLength: 5,
			dom: 'lr<"hdpa-prfile-table-wrap"t>ip',
			ajax: {
				url: ajaxurl,
				data: function(data){

					data.action = 'hdpa_filter_profile';
					data.nonce  = nonce;
					if ( true === is_filter ) {
						data.filter = hdpa_get_filter_data();
					}

				}
			},
			columns: [
				{ data: 'no', orderable: false },
				{ data: 'name', orderable: true },
				{ data: 'age', orderable: false },
				{ data: 'experience', orderable: false },
				{ data: 'completed_jobs', orderable: false },
				{ data: 'ratings', orderable: false },
			],
			columnDefs: [
				{ "width": "28px", "targets": 0 },
				{ "width": "40px", "targets": 2 },
				{ "width": "60px", "targets": 3 },
				{ "width": "60px", "targets": 4 },
			],
			order: [[1, 'asc']],
		}
	);

	// Initialize the select2.
	$( '.hdpa-select' ).select2(
		{
			width: 'resolve',
		}
	);

	/**
	 * Get filter data.
	 *
	 * @since 1.0.0
	 *
	 * @return object The filter data.
	 */
	function hdpa_get_filter_data(){

		var filter = {};

		filter.skills    = $( '#hdpa_filter_skills' ).val();
		filter.education = $( '#hdpa_filter_education' ).val();
		var form_data    = $( '#hdpa-filter-form' ).serializeArray();

		$( form_data ).each(
			function(i, field){
				var key = field.name.replace( 'hdpa_filter_', '' );
				if ( ! filter.hasOwnProperty( key ) ) {
					filter[key] = field.value;
				}
			}
		);

		return filter;
	}

	// Filter profile data on click search button.
	$( '.hdpa-filter-submit' ).click(
		function(e){
			is_filter = true;
			$( '.hdpa-filter-content' ).slideToggle();
			profile_dataTable.draw();
		}
	);

	$( document ).on(
		'input',
		'#hdpa_filter_age',
		function() {

			var val = $( this ).val();

			if ( parseInt( val ) < 1 ) {
				$( '.hdpa-filter-age-text' ).hide();
			} else {
				$( '.hdpa-filter-age-text' ).show();
				$( '.hdpa_filter_age_to_text' ).html( val );
			}

		}
	);

	$( '.hdpa-btn-filter' ).click(
		function(e){
			$( '.hdpa-filter-content' ).slideToggle();
		}
	);

})( jQuery );
