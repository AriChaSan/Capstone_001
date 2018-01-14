var manageQueueAllTable;
var manageTransactionAllTable;
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
    	s = s.substring(1, s.length - 1)
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
	$item_type=$('#alltest').val()+"";
	//alert($item_type);
	if($item_type == 95){
		console.log($item_type);
		//document.getElementById("customPackage").style.data-target = "block";
		$( "#inventoryCheckBtn" ).attr( "data-target", "#customPackage" );
		document.getElementById("customPackage").style.display = "block";
	}else{
		$.ajax({
			url: 'inventory/checkInventory/'+ $item_type,
			type: 'post',		
			success:function(response) {
				$( "#inventoryCheckBtn" ).attr( "data-target", "#inventoryCheckPackage1Modal" );
				$(".result").html(response);
				document.getElementById("inventoryCheckPackage1Modal").style.display = "block";
				//$("#inventoryCheckPackage1Modal").show();
			} // /success
		}); // /ajax 

	}

}

function generateReceipt(test_id = null){
	if(test_id){
		//alert($('#itemtype').val());
		$.ajax({
			url: 'inventory/generateReceipt/'+test_id,
			type: 'post',		
			success:function(response) {
				$(".receiptResults").html(response);
			} // /success
		}); // /ajax 
	}	
}

function activateTransaction(test_id = null){
	if(test_id){
		var queue_id = $("input[id=hiddenqueue_id]").val();
		var patient_id = $("input[id=patient_number]").val();
		$.ajax({//queue log
			url: 'patient/updateQueueLog/'+queue_id+'/'+patient_id,
			type: 'post',		
			success:function(response) {
				//
			} // /success
		}); // /ajax 
		$.ajax({//sales log
			url: 'inventory/salesLog/'+test_id,
			type: 'post',		
			success:function(response) {
				//
			} // /success
		}); // /ajax 
		$.ajax({//sales log
			url: 'inventory/minusInventory/'+test_id,
			type: 'post',		
			success:function(response) {
				//
			} // /success
		}); // /ajax 

		$.ajax({
			url: 'inventory/activateTransaction/'+queue_id+'/'+patient_id+'/'+test_id,
			type: 'post',		
			success:function(response) {
				$(".receiptResults").html(response);
			} // /success
		}); // /ajax 

		$.ajax({//add result on result
			url: 'inventory/activateResult/'+queue_id+'/'+patient_id+'/'+test_id,
			type: 'post',		
			success:function(response) {
				$(".receiptResults").html(response);
			} // /success
		}); // /ajax 


	}	
}