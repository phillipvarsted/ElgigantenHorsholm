require('./bootstrap');

"use strict";
var KTDatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#egKundeopgaver');

		// begin first table
		table.DataTable({
            responsive: true,
            order: [[3, "desc"]],
			columnDefs: [
                {
                    targets: [0, 1, 2, 3],
                    orderable: false
                },
				{
					targets: -1,
					title: 'Actions',
                    orderable: false,
                    width: '30px',
				},
				{
					width: '120px',
					targets: 3,
				},
				{
                    width: '180px',
                    order: 'desc',
					targets: 4,
                },
			],
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceHtml.init();
});

var KTBootstrapMarkdown = function () {
// Private functions
var demos = function () {

}

return {
	// public functions
	init: function() {
	demos();
	}
};
}();

// Initialization
jQuery(document).ready(function() {
KTBootstrapMarkdown.init();
});