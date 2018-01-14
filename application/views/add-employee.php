<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Add Employee</li>
</ol>

<div class="panel panel-default">
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
            <div class="form-group">
              <label for="account_type">Account Type</label>
                <select class="form-control" name="account_type" id="account_type">
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

<script type="text/javascript" src="../custom/js/employee.js"></script>
