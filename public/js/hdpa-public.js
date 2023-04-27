(function ( $ ) {
	'use strict';

	var ajaxurl = hdpa_public_obj.ajaxurl;

	// Initialize the datatable
	var profile_dataTable = $('.hdpa-profile-table').DataTable({
		processing: true,
		serverSide: true,
		serverMethod: 'post',
		searching: false,
		lengthChange: false,
		pageLength: 5,
		ajax: {
		   	url: ajaxurl,
		  	data: function(data){
		  		data.action = 'hdpa_filter_profile';
		  		data.filter = hdpa_get_filter_data();
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
		order: [[1, 'asc']],
	});

	// Initialize the select2
	$('.hdpa-select').select2();

	/**
	* Get filter data
	*
	* @since 1.0.0
	*
	* @return object The filter data.
	*/
	function hdpa_get_filter_data(){

		var filter = {};

		filter.skills = $('#hdpa_filter_skills').val();
		filter.education = $('#hdpa_filter_education').val();
		var form_data = $('#hdpa-filter-form').serializeArray();
		
		$(form_data).each(function(i, field){
			var key = field.name.replace('hdpa_filter_', '');
			if ( ! filter.hasOwnProperty(key) ) {
				filter[key] = field.value;
			}
		});

		return filter;
	}

	$('.hdpa-filter-submit').click(function(e){
		profile_dataTable.draw();
	});

})( jQuery );
