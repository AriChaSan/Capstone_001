<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Manage Employee</li>
</ol>

<div class="panel panel-default">
  <div class="panel-heading"> Add Student </div>
  <div class="panel-body">
  	 <div id="messages"></div>
        <form action="employee/create" method="post" id="createEmployeeForm" enctype="multipart/form-data">  
          <div class="col-md-12">
          <fieldset>
            <legend>Employee Info</legend>

            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="mname">Middle Name</label>
              <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name (Optional)" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
            </div>

          </fieldset>     
          </div>          

          <div class="col-md-12">

            <br /> <br />
            <center>  
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <button type="button" class="btn btn-default">Reset</button>      
            </center>       
          </div>
        </form>
  </div><!-- /panle-bdy -->
</div><!-- /.panel -->

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editFBSModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit FBS Result</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-employee-messages"></div>
        <form class="form-horizontal" method="post" action="patient/updateFBS" id="updateFBS">
          <div class="row">
            <div class="col-md-12">
              <div id="edit-personal-student-message"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="editFBS" class="col-sm-4 control-label">FBS : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="editFname" name="editFname" placeholder="First Name" />
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

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Employee Information</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-employee-messages"></div>
        <form class="form-horizontal" method="post" action="student/updateInfo" id="updateStudentInfoForm">
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeEmployeeModal">
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

<script type="text/javascript" src="../custom/js/student.js"></script>
