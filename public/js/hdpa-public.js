(function ( $ ) {
	'use strict';

	var ajaxurl = hdpa_public_obj.ajaxurl;

	var dataTable = $('.hdpa-profile-table').DataTable({
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

	$('.hdpa-select').select2();

})( jQuery );
