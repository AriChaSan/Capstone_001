var manageQueueAllTable;
var manageTransactionAllTable;
var viewResult;
var updateResult;
var QueueTable = {};

$(document).ready(function() {
	$("#navTests").addClass('active');
	$("#navQueue").addClass('active');
	$("#navManageQueue").addClass('active');

		getAciveTrans();
		getQueue();

		$('#viewResult').DataTable({
		    "bPaginate": false,
		    "bLengthChange": false,
		    "bFilter": true,
		    "bInfo": false,
		    "bAutoWidth": false });

		$('#updateResult').DataTable({
		    "bPaginate": false,
		    "bLengthChange": false,
		    "bFilter": true,
		    "bInfo": false,
		    "bAutoWidth": false });

});

function getAciveTrans(){
	manageTransactionAllTable = $("#manageTransactionAllTable").DataTable({
		'ajax' : 'patient/getAciveTrans/',
		'order': []
	});
}

function load_Update_Result(trans_id, name, time){
	var s = ""+name+"";
		s = s.substring(1, s.length - 1);
		var t = ""+time+"";
			t = t.substring(1, t.length - 1);
	$("input[id=patient_names1]").val(s);
	$("input[id=trans_date1]").val(t);
	$("input[id=transno1]").val(trans_id);

	if ($.fn.DataTable.isDataTable("#updateResult")) {
	  $('#updateResult').DataTable().clear().destroy();
	}

	viewResult = $("#updateResult").DataTable({
		'ajax' : 'patient/load_updateResult/'+trans_id,
		'order': []
	});
}

function finalize(trans_id){
	$.ajax({
		url: 'patient/checkResultStatus/'+trans_id,
		type: 'post',
		dataType: 'json',
		success:function(response) {
			if(response.amount === 0){
				$.ajax({
					url: 'patient/finalizeTestResult/'+trans_id,
					type: 'post',
					success:function(response) {
							alert("Test has been Finalized");
							manageTransactionAllTable.ajax.reload(null, false);
							location.reload();
					} // /success
				}); // /ajax
			}else{
				var r = confirm("There are still "+response.amount+" tests  that are not yet answered. Continue to finalize results?");
				if (r == true) {
					var r = confirm("This action cannot be undone! Confirm to finalize results? Unanswered Test: " + response.amount);
					if (r == true) {
						$.ajax({
							url: 'patient/finalizeTestResult/'+trans_id,
							type: 'post',
							success:function(response) {
									alert("Test has been Finalized");
									manageQueueAllTable.ajax.reload(null, false);
									manageTransactionAllTable.ajax.reload(null, false);
									location.reload();
							} // /success
						}); // /ajax
					}
				}
			}
		} // /success
	}); // /ajax
}

function updateTestResult(){
	var tbl = document.getElementById('updateResult');
	$('#updateResult tbody tr').each(function(row, tr){
			var result = tbl.rows.item(row).getElementsByTagName("input"),
			package_name = $(tr).find('td:eq(1)').text(), package_names;

			if(package_name.length > 2)
				package_names = package_name.split(":");

			var trans_no = $(tr).find('td:eq(0)').text();
			var row_name = trans_no + '_'+ (package_name.length > 2 ? package_names[0] : package_name) + '_' + $(tr).find('td:eq(2)').text();
			row_name = row_name.replace(/\s/g, "");
			var result1 = document.getElementsByName('result_' + row_name)[0].value;
			var result2 = document.getElementsByName('comment_' + row_name)[0].value;
			console.log('row name: ' + row_name );

	    var TableData=[
	        $(tr).find('td:eq(0)').text(),
					$(tr).find('td:eq(1)').text(),
					$(tr).find('td:eq(2)').text(),
					$(tr).find('td:eq(3)').text(),
					result1, //4
				  result2 //5
	    ];

			$.ajax({
				url: 'patient/updateTestResult/',
				data: {"trans_info" : TableData},
				type: 'post',
				success:function(response) {

				} // /success
			}); // /ajax
		});
		alert("Successfully update Results!");
		location.reload();
	}

function view(trans_id, name, time){
	var s = ""+name+"";
		s = s.substring(1, s.length - 1);
		var t = ""+time+"";
			t = t.substring(1, t.length - 1);
	$("input[id=patient_names]").val(s);
	$("input[id=trans_date]").val(t);
	$("input[id=transno]").val(trans_id);

	if ($.fn.DataTable.isDataTable("#viewResult")) {
	  $('#viewResult').DataTable().clear().destroy();
	}

	viewResult = $("#viewResult").DataTable({
		'ajax' : 'patient/viewResult/'+trans_id,
		'order': []
	});
}

function getQueue(){
	manageQueueAllTable = $("#manageQueueAllTable").DataTable({
		'ajax' : 'patient/getQueue/',
		'order': []
	});
}

function patientNumber(patient_id = null, queue_id = null, patient_number = null){
	//alert("it went here");
	if(patient_id){
		var s = ""+patient_id+"";
    	s = s.substring(1, s.length - 1);
		$("input[id=hiddenpatientname]").val(s);
		$("input[id=hiddenqueue_id]").val(queue_id);
		$("input[id=patient_names]").val(s);
		$("input[id=transno]").val(queue_id);
		$("input[id=patient_number]").val(patient_number);
	}
}

function update(trans_id = null){
	//alert("it went here");
	if(trans_id){
		$("input[id=transaction_id]").val(trans_id);
	}
}

function checkInventory(){
	var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
	var selected_test = [];
	if(checkboxes.length != 0){
		for (var i = 0; i < checkboxes.length; i++) {
			selected_test.push(checkboxes[i].value);
			//alert(checkboxes[i].value);
			//console.log(checkboxes[i].value);
		}
		checkInventory_part2(selected_test);
		$("input[id=hiddenselectedtest]").val(selected_test);
		//document.getElementById("total_price").innerHTML = "Total: P" + total_price;
	}else{
		alert("Kindly Choose a Test to Perform");
	}

}

function checkInventory_part2(test_id = array()){
	$item_type=test_id;
		$.ajax({
			url: 'inventory/checkInventory/',
			data: {"test_id" : $item_type},
			type: 'post',
			success:function(response) {
				$( "#inventoryCheckBtn" ).attr( "data-target", "#inventoryCheckPackage1Modal" );
				$(".result").html(response);
				//document.getElementById("choosePackageModal").style.display = "none";
				document.getElementById("inventoryCheckPackage1Modal").style.display = "block";
				//$("#inventoryCheckPackage1Modal").show();
			} // /success
		}); // /ajax

}

function generateReceipt(){
		var test_id = $("input[id=hiddenselectedtest]").val().split(",");
		$.ajax({
			url: 'inventory/generateReceipt/',
			data: {"test_id" : test_id},
			type: 'post',
			success:function(response) {
				$(".receiptResults").html(response);
			} // /success
		}); // /ajax

}

function activateTransaction(){
	var test_id = $("input[id=hiddenselectedtest]").val().split(",");
	var queue_id = $("input[id=hiddenqueue_id]").val();
	var patient_id = $("input[id=patient_number]").val();
	var total_price = $("input[id=hiddentotalsales]").val();

	for (i = 0; i < test_id.length; i++) {
		$("input[id=current_test_123]").val(test_id[i]);
		current_test = $("input[id=current_test_123]").val();

			$.ajax({ //queue log
				url: 'patient/updateQueueLog/'+queue_id+'/'+patient_id,
				type: 'post',
				success:function(response) {
					//alert('UPdateLog');
				} // /success
			}); // /ajax

			$.ajax({//sales log
				url: 'inventory/minusInventory/'+current_test,
				type: 'post',
				success:function(response) {
					//alert('minusInventory');

				} // /success
			}); // /ajax

			$.ajax({
				url: 'inventory/activateTransaction/'+queue_id+'/'+patient_id+'/'+current_test,
				type: 'post',
				success:function(response) {
					//alert('activateTransaction');

					$(".receiptResults").html(response);
				} // /success
			}); // /ajax

			$.ajax({//add result on result
				url: 'inventory/activateResult/'+queue_id+'/'+patient_id+'/'+current_test,
				type: 'post',
				success:function(response) {
					//alert('activateResult');
					$(".receiptResults").html(response);
				} // /success
			}); // /ajax

			if(i == test_id.length-1){//lst element
			  $.ajax({//sales log
			    url: 'inventory/salesLog/'+total_price+ '/' + queue_id,
			    type: 'post',
			    success:function(response) {
			      alert('Activation Success!');
						manageQueueAllTable.ajax.reload(null, false);
						manageTransactionAllTable.ajax.reload(null, false);
						location.reload();
			    } // /success
			  }); // /ajax
			}
	}
}
