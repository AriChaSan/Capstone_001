var manageAllSalesTable;

$(document).ready(function() {
	//$("#navEmployee").addClass('active');

		manageAllSalesTable = $("#manageAllSalesTable").DataTable({
			'ajax' : 'sales/getTotalSales/', 
			'order': []
		});
});