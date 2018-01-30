<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "capstone";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  function getTestResult(){
    $sql = "SELECT * FROM `result` WHERE trans_id = $trans_id;";
    $result = $conn->query($sql);
    $table="";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $table .= '
						<tr>
							<td> '. $value['test_id']. ' - '. $value['test_result_name'] .' </td>
							<td> '. $value['result'] .' </td>
							<td> '. $value['normal_value'] .' </td>
							<td> '. $value['comment'] .'</td>
						</tr>
					';
        }
    } else {
        echo "<script>alert('No Results were found!');</script>";
    }
  }

  $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Result</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="custom/css/custom.css">

	<!-- jquery -->
	<script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
	<!-- boostrap js -->
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<style>
body {background-color: #08721d;}
</style>

<style>
.parallax {
    /* The image used */
    background-image: url("assets/images/hospital-background-13.jpg");

    /* Set a specific height */
   	/*height: 500px;*/

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<body class="parallax">

<div class="modal fade" tabindex="-1" role="dialog" id="viewResultModal" style="width: 100%; height: 100%; margin: 2% overflow:scroll">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body add-modal">
        <div class="row">
          <div class="col-md-12 form-group">
						<div class="col-md-12" style="text-align:center;">
							<b>Porac Perpetual Polyclinic and Diagnostics</b><br/>
							<i>Joven St., Babo Sacan, Porac Pampanga</i></br/>
							<i>0943-086-954(SUN)&0975-787-8252(TM)</i><br/><hr/>
						</div>
						<div class="col-md-6 form-group">
							<label><b>Name: </br></label>
							<input type="text" style="width: 250px; font-weight:normal; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="patient_name" value="Jericho Rosales"/>
						</div>
						<div class="col-md-6 form-group">
							<label><b>Physician: </b></label>
							<input type="text" style="width: 250px; font-weight:normal; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="doctor_name" value="Dr. Yanni Joyce Sta. Maria"/>
						</div>
						<div class="col-md-6 form-group">
							<label><b>Transaction Number: </b></label>
							<input type="text" style="width: 250px; font-weight:normal; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="transno1" value="1"/>
						</div>
						<div class="col-md-6 form-group">
							<label><b>Transaction Date</b></label>
							<input type="text" style="width: 250px; font-weight:normal; border: none; outline: none; background-color: transparent; text-align: left;" readonly="true" id="trans_date1" value="<?php echo date('Y-m-d H:i:s',strtotime("now")); ?>"/>
							</div>
						<hr/>
						<div class="col-md-12 form-group">
							<h2 style="text-align:center"><u>RESULT</u></h2>
						</div>
						<hr/><br/>
						<div class="col-md-12" style="border: 3; border-color: black; text-align: center; overflow:hidden;">
              <table id ="viewResultTable" class="table table-bordered">
								<thead>
									<tr>
										<th style="text-align:center">TEST</th>
										<th style="text-align:center">RESULT</th>
										<th style="text-align:center">REF.VALUES</th>
										<th style="text-align:center">ABN</th>
									</tr>
								</thead>
								<tbody>
									<div class="viewResult" style="width:100%"></div>
								</tbody>
							</table>
							<br>
							<br>
						</div>
						<div class="col-md-6" style="text-align:center;">
						<u><b>Jannie Hazel DM. Escoto, RMT</b></u><br/>
						License No. 0071791<br/>
						<i>Medical Technologist</i><br/>
					</div>
						<div class="col-md-6" style="text-align:center;">
						<u><b>Emil Bryan M. Garcia, MD, DPSP</b></u><br/>
						License No. 0099979<br/>
						<i>Pathologist</i><br/><br/>
					</div>
						<hr/>
						<div class="col-md-12" style="text-align:center;">
						<h3 style="text-align:center;color:#518e1b"><i>"Precision in Providing Patient Care"</i></h3>
					</div>
					<br/><br/><hr/><br/><br/>
      		</div> <!-- /tab-panel of teacher information -->
				</div>
			</div>
			<div class="modal-footer edit-group-modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Print</button>
			</div>
  	</div><!-- /modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal-fade -->

<div class="col-lg-12">
	<div class="panel panel-default" style="margin-top: 10%; width: 450px; margin-left: 35%; border:2px; border-color:#33cc33; border-style:solid;">
	  	<div class="panel-body">
		    	<fieldset>
		    		<legend>
		    			<h3><img src="../assets/images/LOGO.png" style="width: 67px"> Porac Perpetual Polyclinic</h3>
		    		</legend>

						<div class="form-group">
				    	<label for="trans-id" style="text-align: left">Transaction ID</label>
				    	<input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="trans-id" name="trans-id" placeholder="Enter trans-id..." autofocus required>
				  	</div>

				  	<div class="form-group">
				    	<label for="trans-key" style="text-align: left">Transaction Key</label>
				    	<input type="password" class="form-control" id="trans-key" name="trans-key" placeholder="Enter trans-key..." required>
				  	</div>
						<a type="button" class="col-md-12 btn btn-success" data-toggle="modal" data-target="#viewResultModal" onclick="viewResult()"> <i class="glyphicon glyphicon-edit"></i> Search Result</a>
		    	</fieldset>
				<br/>
	  	</div>
	</div>
</div>

<script type="text/javascript">
	function viewResult(){
		var trans_id = $("input[id=trans-id]").val();
		var trans_key = $("input[id=trans-key]").val();
		if(trans_id == ''){
			alert("Transaction ID cannot not be null!");
		}else{
			//document.getElementById("viewResult").display = "block";
			if(trans_key != ''){//P0R9C-D4I3G
				alert("Invalid Transaction Key!");
			}else{
				//trans_id is not null
				//trans_key is correct
				$.ajax({
					url: window.location + '/getTestResult/' + trans_id,
					type: 'post',
					success:function(response) {
						$(".viewResult").html(response);
					} // /success
				}); // /ajax
			}
		}
	}
</script>

</body>
</html>
