var managePatientAllTable;
var PatientTable = {};

$(document).ready(function() {
	$("#navPatient").addClass('active');

		$("#navManagePatient").addClass('active');

		managePatientAllTable = $("#managePatientAllTable").DataTable({
			'ajax' : 'patient/getPatient/', 
			'order': []
		});
});

function formatDate(dateObj)
{
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
    var curr_date = dateObj.getDate();
    var curr_month = dateObj.getMonth();
    curr_month = curr_month + 1;
    var curr_year = dateObj.getFullYear();
    var curr_min = dateObj.getMinutes();

    var curr_hr= dateObj.getHours();
    if(curr_hr < 6){
    	curr_date = curr_date - 1;
    	curr_hr = curr_hr + 24;
    	curr_hr= curr_hr - 6;
    }else{
    	curr_hr= curr_hr - 6;
    }
    //5 + 24 = -6 29 -6
    var curr_sc= dateObj.getSeconds();

    if(curr_month.toString().length == 1)
    curr_month = '0' + curr_month;      
    if(curr_date.toString().length == 1)
    curr_date = '0' + curr_date;
    if(curr_hr.toString().length == 1)
    curr_hr = '0' + curr_hr;
    if(curr_min.toString().length == 1)
    curr_min = '0' + curr_min;

	if(curr_sc.toString().length == 1){curr_sc = "0" + curr_sc;}
	return curr_year + "/" + curr_month + "/" + curr_date + " " + curr_hr + ":" + curr_min + ":" + curr_sc;
    //return curr_month+"/"+curr_date +"/"+curr_year+ " "+curr_hr+":"+curr_min+":"+curr_sc;       

}

/*
*-------------------------------
* update student's info function
*-------------------------------
*/
function viewPatient(patient_id = null)
{
	if(patient_id) {
		$('#editRegisterDate').calendarsPicker({
			dateFormat: 'yyyy-mm-dd'
		});

		$.ajax({
			url: 'patient/getPatient/'+patient_id,
			type: 'post',
			dataType: 'json',
			success:function(response){
				$("#viewFname").val(response.fname);
				$("#viewMname").val(response.mname);
				$("#viewLname").val(response.lname);
				if(response.gender === '0'){
					$("#viewGender").val("Male");
				}else if(response.gender === '1'){
					$("#viewGender").val("Female");
				}	
				$("#viewContact").val(response.contact);
				$("#viewEmail").val(response.email);
				var time = formatDate(new Date(new Date(moment.unix(response.register_date)).toUTCString()));
				$("#viewRegisterDate").val(time);
				//$("#viewAccountType").val(response.AccountName);

			} // /success
		}); // /ajax

	} // /if 
}

function addQueue(patient_id = null)
{
	if(patient_id) {
		$.ajax({
			url: 'patient/findQueue/'+patient_id,
			type: 'post',
			dataType: 'json',
			success:function(response){

				if(response.success != 0){
					//console.log(response.success);
					var r = confirm("There is an existing Queue for this Patient. Are you sure in creating a new Queue?");
					if (r == true) {
					    $.ajax({
							url: 'patient/addQueue/'+patient_id,
							type: 'post',
							dataType: 'json',
							success:function(response){
								if(response.success === true){

									alert('Queue Successfully Added!');
								}else{
									alert('Queue Creation Failed!');
								}

							} // /success
						}); // /ajax
					} else {
					    alert("Queue Creation Cancelled!");
					}
				}else{		
					$.ajax({
						url: 'patient/addQueue/'+patient_id,
						type: 'post',
						dataType: 'json',
						success:function(response){
							if(response.success === true){
								alert('Queue Successfully Added!');
							}else{
								alert('Queue Creation Failed!');
							}

						} // /success
					}); // /ajax
				}

			} // /success
		}); // /ajax


	} // /if 
}

/*
*-------------------------------
* update student's info function
*-------------------------------
*/
function editPatient(patient_id = null)
{
	if(patient_id) {
		$('#editRegisterDate').calendarsPicker({
			dateFormat: 'yyyy-mm-dd'
		});

		$(".form-group").removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		// photo
		$('#edit-upload-image-message').html('');
		$(".fileinput-remove-button").click();	

		// information
		$('#edit-employee-message').html('');
		
		$.ajax({
			url: 'patient/getPatient/'+patient_id,
			type: 'post',
			dataType: 'json',
			success:function(response){
				$("#editFname").val(response.fname);
				$("#editMname").val(response.mname);
				$("#editLname").val(response.lname);
				$("#editContact").val(response.contact);
				$("#editGender").val(response.gender);
				$("#editEmail").val(response.email);
				var time = formatDate(new Date(new Date(moment.unix(response.register_date)).toUTCString()));
				$("#editRegisterDate").val(time);
			} // /success
		}); // /ajax

		// submit the teacher information form
		$("#updatePatientInfoForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

			$.ajax({
				url: url + '/' + patient_id,
				type: type,
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						

						$("#edit-employee-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');										

							
						managePatientAllTable.ajax.reload(null, false);

						$("#editPatientInfoModal").modal('hide');
					
						$('.form-group').removeClass('has-error').removeClass('has-success');
						$('.text-danger').remove();								
					}else {									
						if(response.messages instanceof Object) {							
							$.each(response.messages, function(index, value) {
								var key = $("#" + index);

								key.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')
								.find('.text-danger').remove();							

								key.after(value);

							});
						}
						else {							
							$("#edit-employee-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  response.messages + 
							'</div>');						
						}							
					} // /else
				} // /success
			}); // /ajax
			return false;
		});  // /submit the teacher information form

	} // /if 
}


/*
*-------------------------------
* remove student's info function
*-------------------------------
*/
function removePatient(patient_id = null)
{
	if(patient_id) {
		$("#removeStudentBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'patient/remove/'+patient_id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						//alert(response.success);
						$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  	response.messages + 
						'</div>');

						managePatientAllTable.ajax.reload(null, false);

						$("#removePatientInfoModal").modal('hide');
					}
					else{
						$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  	response.messages + 
						'</div>');
					}
				} // /success
			}); // /ajax
		}); // /remove student btn clicked
	} // /if
}