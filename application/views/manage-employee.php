<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Manage Employee</li>
</ol>

<div class="col-md-12"> 
  <div class="panel panel-default">
    <div class="panel-heading">
      All Employee 
    </div>
    <div class="panel-body" style="display:block">        
        <div id="messages"></div>

        <div class="pull pull-right">
          <a href="<?php echo base_url('add-employee'); ?>" type="button" class="btn btn-default"> 
            <i class="glyphicon glyphicon-plus-sign"></i> Add Employee
          </a>
        </div>

        <br /> <br /> <br />
        
        <table id="manageEmployeeAllTable" class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Account Type</th>
              <th>Action</th> <!--Action: View, update, Remove-->
            </tr>
          </thead>
          <tbody><!--tbody content-->  
          </tbody>
        </table><!--table end-->  
    
      </div><!--panel-body end-->
    </div><!--panel-default end-->
  </div><!--md 12 end-->

<!-- view student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewEmployeeInfoModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Employee Information</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-employee-messages"></div>
        <form class="form-horizontal" method="post" action="student/updateInfo" id="viewStudentInfoForm">
          <div class="row">
            <div class="col-md-12">
              <div id="view-employee-message"></div>
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="viewFname" class="col-sm-4 control-label">First Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewFname" name="viewFname" readonly placeholder="First Name" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="viewMname" class="col-sm-4 control-label">Middle Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="eviewMname" name="viewMname" readonly placeholder="Middle Name (Optional)" />
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="viewLname" class="col-sm-4 control-label">Last Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewLname" name="eviewLname" readonly placeholder="Last Name"/>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="viewContact" class="col-sm-4 control-label">Contact: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewContact" name="viewContact" readonly placeholder="Contact" />
                    </div>
                  </div>  

                  <div class="form-group">
                    <label for="viewEmail" class="col-sm-4 control-label">Email: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewEmail" name="viewEmail" readonly placeholder="Email" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="viewRegisterDate" class="col-sm-4 control-label">Register Date : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewRegisterDate" name="viewRegisterDate" readonly placeholder="Register Date" />
                      </div>
                  </div>   

                  <div class="form-group">
                    <label for="viewAccountType" class="col-sm-4 control-label">Account Type : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewAccountType" name="viewAccountType" readonly placeholder="Register Date" />
                      </div>
                  </div>   

                </div> <!-- /col-md-12 -->   
            </div><!-- /col-md-12 -->
          </div><!-- /row -->           
        </form>

      </div> <!-- /tab-panel of teacher information -->

    </div>
  </div><!-- /modal-body -->            
</div><!-- /.modal-content -->

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editEmployeeInfoModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Employee Information</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-employee-messages"></div>
        <form class="form-horizontal" method="post" action="employee/updateInfo" id="updateEmployeeInfoForm">
          <div class="row">
            <div class="col-md-12">
              <div id="edit-personal-student-message"></div>
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="editFname" class="col-sm-4 control-label">First Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="editFname" name="editFname" placeholder="First Name" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="editMname" class="col-sm-4 control-label">Middle Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="editMname" name="editMname" placeholder="Middle Name (Optional)" />
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="editLname" class="col-sm-4 control-label">Last Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="editLname" name="editLname" placeholder="Last Name"/>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="editContact" class="col-sm-4 control-label">Contact: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Contact" />
                    </div>
                  </div>  

                  <div class="form-group">
                    <label for="editEmail" class="col-sm-4 control-label">Email: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="editEmail" name="editEmail" placeholder="Email" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="editRegisterDate" class="col-sm-4 control-label">Register Date : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="editRegisterDate" name="editRegisterDate" readonly placeholder="Register Date" />
                      </div>
                  </div>   

                  <div class="form-group">
                    <label for="edit_account_type" class="col-sm-4 control-label">Account Type: </label>
                    <div class="col-sm-8">
                      <select class="form-control" name="edit_account_type" id="edit_account_type">
                        <option value="" disabled="true">Select an Account Type</option>
                          <?php 
                          if($accountTypeData) { 
                            foreach ($accountTypeData as $key => $value):
                              if(($value['account_type_name'] != "") && ($value['account_type_id'] != "0") && ($value['account_type_id'] != "9")){
                          ?>
                              <option value="<?php echo $value['account_type_id'] ?>"><?php echo $value['account_type_name']; ?></option>
                            <?php }
                            endforeach 
                            ?>
                          <?php
                          } 
                          else { ?>
                            <option value="">No Data Available</option>
                          <?php 
                          }
                          ?>
                        </select>
                      </div>
                  </div>

                </div> <!-- /col-md-12 -->

                <div class="form-group">
                  <div class="col-sm-12">
                    <center>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </center>
                  </div>
                </div>   
            </div><!-- /col-md-12 -->
          </div><!-- /row -->           
        </form>

      </div> <!-- /tab-panel of teacher information -->

    </div>
  </div><!-- /modal-body -->            
</div><!-- /.modal-content -->

<!-- remove studet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeEmployeeInfoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Employee</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="removeStudentBtn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="../custom/js/manage-employee.js"></script>
