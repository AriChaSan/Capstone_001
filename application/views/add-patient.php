<ol class="breadcrumb">
  <li>Home</li> 
  <li class="active">Add Patient</li>
</ol>

<div class="panel panel-default">
  <div class="panel-body">
     <div id="messages"></div>
        <form action="patient/create" method="post" id="createPatientForm" enctype="multipart/form-data">  
          <div class="col-md-12">
            <fieldset>
              <legend>Patient Info</legend>

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
                <label for="gender">Gender</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="" disabled="true">Select Gender</option>
                    <option value="0" >Male</option>
                    <option value="1" >Female</option>
                  </select>
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

            <fieldset>
              <legend>Emergency Contact-Info</legend>
              <div class="form-group">
                <label for="efname">First Name</label>
                <input type="text" class="form-control" id="efname" name="efname" placeholder="First Name" autocomplete="off" >
              </div>
              <div class="form-group">
                <label for="emname">Middle Name</label>
                <input type="text" class="form-control" id="emname" name="emname" placeholder="Middle Name (Optional)" autocomplete="off" >
              </div>
              <div class="form-group">
                <label for="elname">Last Name</label>
                  <input type="text" class="form-control" id="elname" name="elname" placeholder="Last Name" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="erelation">Relation</label>
                  <input type="text" class="form-control" id="erelation" name="erelation" placeholder="Relation" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="econtact">Contact</label>
                  <input type="text" class="form-control" id="econtact" name="econtact" placeholder="Contact" autocomplete="off">
              </div>
            </fieldset>   
          </div>  

        </div>          

          <div class="col-md-12">

            <br /> <br />
            <center>  
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <button type="button" class="btn btn-default">Reset</button>      
            </center>   
             <br /> <br />    
          </div>        
        </form>
  </div><!-- /panle-bdy -->
</div><!-- /.panel -->

<script type="text/javascript" src="../custom/js/add-patient.js"></script>
