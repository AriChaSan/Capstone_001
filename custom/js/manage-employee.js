var manageEmployeeAllTable;
var EmployeeTable = {};

$(document).ready(function() {
	$("#navEmployee").addClass('active');

		$("#navManageEmployee").addClass('active');

		manageEmployeeAllTable = $("#manageEmployeeAllTable").DataTable({
			'ajax' : 'employee/getEmployee/', 
			'order': []
		});
});

/*
*-------------------------------
* update student's info function
*-------------------------------
*/
function viewEmployee(user_id = null)
{
	if(user_id) {
		$('#editRegisterDate').calendarsPicker({
			dateFormat: 'yyyy-mm-dd'
		});

		$.ajax({
			url: 'employee/getEmployee/'+user_id,
			type: 'post',
			dataType: 'json',
			success:function(response){
				$("#viewFname").val(response.fname);
				$("#viewMname").val(response.mname);
				$("#viewLname").val(response.lname);
				$("#viewContact").val(response.contact);
				$("#viewEmail").val(response.email);
				$("#viewRegisterDate").val(response.register_date);
				$("#viewAccountType").val(response.AccountName);

			} // /success
		}); // /ajax

	} // /if 
}

/*
*-------------------------------
* update student's info function
*-------------------------------
*/
function editEmployee(user_id = null)
{
	if(user_id) {
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
			url: 'employee/getEmployee/'+user_id,
			type: 'post',
			dataType: 'json',
			success:function(response){
				$("#editFname").val(response.fname);
				$("#editMname").val(response.mname);
				$("#editLname").val(response.lname);
				$("#editContact").val(response.contact);
				$("#editEmail").val(response.email);
				$("#editRegisterDate").val(response.register_date);
				$("#edit_account_type").val(response.account_type_id);
			} // /success
		}); // /ajax

		// submit the teacher information form
		$("#updateEmployeeInfoForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

			$.ajax({
				url: url + '/' + user_id,
				type: type,
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						

						$("#edit-employee-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');										

							
						manageEmployeeAllTable.ajax.reload(null, false);

						$("#editEmployeeInfoModal").modal('hide');
					
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
function removeEmployee(user_id = null)
{
	if(user_id) {
		$("#removeStudentBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'employee/remove/'+user_id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						//alert(response.success);
						$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  	response.messages + 
						'</div>');

						manageEmployeeAllTable.ajax.reload(null, false);

						$("#removeEmployeeInfoModal").modal('hide');
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