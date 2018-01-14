var manageInventoryTable;
var viewInventoryHistoryTable;

var InventoryTable = {};

function getInventoryHistory()
{
    if ($.fn.DataTable.isDataTable("#viewInventoryHistoryTable")) {
      $('#viewInventoryHistoryTable').DataTable().clear().destroy();
    }
 
   // $("#view-group-messages").html(''); 
    $("#viewInventoryHistoryTable").DataTable({
        'ajax' : 'inventory/getInventoryHistory/', 
        'order': [],

    });
}

$(document).ready(function(){
	$("#navInventory").addClass('active');

		manageInventoryTable = $("#manageInventoryTable").DataTable({
			'ajax' : 'inventory/getItems/', 
			'order': []
		});

    // code to read selected table row cell data (values).
    $("#manageInventoryTable").on('click','.btnSelect',function(){
         // get the current row
        var currentRow=$(this).closest("tr"); 
         
        document.getElementById('itemid').value=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
        document.getElementById('itemname').value=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
        document.getElementById('itemtype').value=currentRow.find("td:eq(2)").text(); 
        document.getElementById('itemq').value=currentRow.find("td:eq(3)").text(); // get current row 3rd TD
        document.getElementById('lastupdate').value=currentRow.find("td:eq(4)").text(); 
        document.getElementById('updatedby').value=currentRow.find("td:eq(5)").text(); 
    });

    // submit the teacher information form
    $("#updatePatientForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url + '/',
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {
                    

                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                      response.messages + 
                    '</div>');                                      

                        
                    manageInventoryTable.ajax.reload(null, false);
                
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
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');                      
                    }                           
                } // /else
            } // /success
        }); // /ajax
        return false;
    });  // /submit the teacher information form

        // submit the teacher information form
    $("#addItemForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url + '/',
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {
                    

                    $("#add-item-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                      response.messages + 
                    '</div>');                                      

                        
                    manageInventoryTable.ajax.reload(null, false);
                
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
                        $("#add-item-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');                      
                    }                           
                } // /else
            } // /success
        }); // /ajax
        return false;
    });  // /submit the teacher information form
});
