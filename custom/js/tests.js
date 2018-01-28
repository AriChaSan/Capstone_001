var manageQueueAllTable;
var manageTransactionAllTable;
var viewResult;
var QueueTable = {};

$(document).ready(function() {
	$("#navTests").addClass('active');
	$("#navQueue").addClass('active');
	$("#navManageQueue").addClass('active');

		getAciveTrans();
		getQueue();
});

function getAciveTrans(){
	manageTransactionAllTable = $("#manageTransactionAllTable").DataTable({
		'ajax' : 'patient/getAciveTrans/',
		'order': []
	});
}

function view(trans_id, name, time){
	var s = ""+name+"";
		s = s.substring(1, s.length - 1);
		var t = ""+time+"";
			t = t.substring(1, t.length - 1);
	$("input[id=patient_names]").val(s);
	$("input[id=trans_date]").val(t);
	$("input[id=transno]").val(trans_id);

	viewResult = $("#viewResult").DataTable({
		'ajax' : 'patient/getResult/'+trans_id,
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
	for (i = 0; i < test_id.length; i++) {
		var current_test =  $("input[id=current_test_123]").val(test_id[i]);
		if(test_id){
			var queue_id = $("input[id=hiddenqueue_id]").val();
			var patient_id = $("input[id=patient_number]").val();
			var total_price = $("input[id=hiddentotalsales]").val();

			$.ajax({//queue log
				url: 'patient/updateQueueLog/'+queue_id+'/'+patient_id,
				type: 'post',
				success:function(response) {
					$.ajax({//sales log
						url: 'inventory/minusInventory/'+current_test,
						type: 'post',
						success:function(response) {
							$.ajax({
								url: 'inventory/activateTransaction/'+queue_id+'/'+patient_id+'/'+current_test,
								type: 'post',
								success:function(response) {
									$.ajax({//add result on result
										url: 'inventory/activateResult/'+queue_id+'/'+patient_id+'/'+current_test,
										type: 'post',
										success:function(response) {
											$(".receiptResults").html(response);
										} // /success
									}); // /ajax
									$(".receiptResults").html(response);
								} // /success
							}); // /ajax
						} // /success
					}); // /ajax
				} // /success
			}); // /ajax
			if(i == test_id.length-1){//lst element
			  $.ajax({//sales log
			    url: 'inventory/salesLog/'+total_price+ '/' + queue_id,
			    type: 'post',
			    success:function(response) {
			      alert('Activation Success!');
			    } // /success
			  }); // /ajax
			}
		}
	}
}
