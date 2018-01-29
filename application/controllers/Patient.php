<?php

class Patient extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();
		$this->load->library('form_validation');
     	$this->load->helper('form');

		// <!! IMPORTANT!! >
		$this->load->model('model_patient');

	}

	/*
	*------------------------------------
	* validates the student's information
	* form and inserts into the database
	*------------------------------------
	*/
	public function create()
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'fname',
				'label' => 'First Name',
				'rules' => 'required'
			),
			array(
				'field' => 'lname',
				'label' => 'Last Name',
				'rules' => 'required'
			)
		);

		//print_r($validate_data);
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			//$imgUrl = $this->uploadImage();
			$create = $this->model_patient->create();

			if($create == true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Error while inserting the information into the database";
			}
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}
		} // /else

		echo json_encode($validator);
	}

	/*
	*------------------------------------
	* returns the uploaded image url
	*------------------------------------
	*/
	public function uploadImage()
	{
		$type = explode('.', $_FILES['photo']['name']);
		$type = $type[count($type)-1];
		$url = 'assets/images/students/'.uniqid(rand()).'.'.$type;
		if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
			if(is_uploaded_file($_FILES['photo']['tmp_name'])) {
				if(move_uploaded_file($_FILES['photo']['tmp_name'], $url)) {
					return $url;
				}	else {
					return false;
				}
			}
		}
	}

	public function getQueue()
	{
		$result = array('data' => array());
		$patientData = $this->model_patient->getQueue();

		if($patientData != null){

			foreach ($patientData as $key => $value) {

				$mname = "";
					if($value['mname']){
						$mname = $value['mname'][0] .'. ';
					}else{
						$mname = ' ';
					}
				$name = $value['fname'] . ' ' . $mname . $value['lname'];

				$user_type = $_SESSION['account_type'];
				if($user_type == 8){ //medtech
					//$button = '-';
				}
				if($user_type == 7){ //recept
					$button = '<!-- Single button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	<li><a type="button" data-toggle="modal" onclick="patientNumber(/'.$name.'/, '.$value['queue_id'].', '.$value['patient_id'].')" data-target="#choosePackageModal" > <i class="glyphicon glyphicon-check"></i> Accept</a></li>
					  	<li><a type="button" data-toggle="modal" onclick="decline('.$value['patient_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
					  </ul>
					</div>';
				}
				if($user_type == 9){ //owner
					$button = '-';
				}


				$status=$value['code'] . " - " . $value['StatusName'];
				date_default_timezone_set("Asia/Manila");
				$time=date('Y-m-d H:i:s',$value['created_At']);

				if($user_type == 8){ //medtech
					$result['data'][$key] = array(
						$value['queue_id'],
						$name,
						$time,
						$status,
					);
				}else { //recept and others
					$result['data'][$key] = array(
						$value['queue_id'],
						$name,
						$time,
						$status,
						$button
					);
				}

			} // /froeach
		}
		//var_dump($result);
		echo json_encode($result);
	}

	public function viewResult($trans_id)
	{
		$result = array('data' => array());
		$transData = $this->model_patient->viewResult($trans_id);

		if($transData != null){

			foreach ($transData as $key => $value) {
				$result['data'][$key] = array(
					$value['trans_id'],
					($value['test_id'] > 90 ? $value['test_id'] . ': ' .'Package ' . ($value['test_id']-90) : ($value['test_id'])) ,
					$value['test_result_name'],
					($value['gender'] == '' ? $value['normal_value'] : $value['gender'] . ': ' . $value['normal_value']) ,
					($value['result'] == '' ? 'No Saved Result' : $value['result']),
					($value['comment'] == '' ? '-' : $value['comment']),
				);
			} // /froeach
		}
		//var_dump($result);
		echo json_encode($result);
	}

	public function load_updateResult($trans_id)//where you load the table when updating it
	{
		$result = array('data' => array());
		$transData = $this->model_patient->viewResult($trans_id);

		if($transData != null){

			foreach ($transData as $key => $value) {
				$name = str_replace(" ", "" ,$value['trans_id'].'_'.$value['test_id'].'_'.$value['test_result_name']);
				//var_dump($name);
				$result['data'][$key] = array(
					$value['trans_id'],
					($value['test_id'] > 90 ? $value['test_id'] . ': ' .'Package ' . ($value['test_id']-90) : ($value['test_id'])) ,
					$value['test_result_name'],
					($value['gender'] == '' ? $value['normal_value'] : $value['gender'] . ': ' . $value['normal_value']) ,
					"<input type='text' style='border: none; outline: none; background-color: transparent; text-align: left;' placeholder='Enter value...' name='result_".$name."' value='".$value['result']."'/>",
					"<input type='text' style='border: none; outline: none; background-color: transparent; text-align: left;' name='comment_".$name."' value='".$value['comment']."'/>",
				);
			} // /froeach
		}
		//var_dump($result);
		echo json_encode($result);
	}

	public function getAciveTrans()
	{
		$result = array('data' => array());
		$transData = $this->model_patient->getAciveTrans();

		if($transData != null){

			foreach ($transData as $key => $value) {
				date_default_timezone_set("Asia/Manila");
				$time=date('Y-m-d H:i:s',$value['created_At']);

				$mname = "";
					if($value['mname']){
						$mname = $value['mname'][0] .'. ';
					}else{
						$mname = ' ';
					}
				$name = $value['fname'] . ' ' . $mname . $value['lname'];

				$user_type = $_SESSION['account_type'];
				if($user_type == 8){ //medtech
					$button = '<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" onclick="view('.$value['trans_id'].', /'.$name.'/, /'.$time.'/)" data-target="#viewResultModal"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
							<li><a type="button" data-toggle="modal" onclick="load_Update_Result('.$value['trans_id'].', /'.$name.'/, /'.$time.'/)" data-target="#UpdateResultModal" > <i class="glyphicon glyphicon-edit"></i> Update</a></li>
							<li><a type="button" data-toggle="modal" onclick="finalize('.$value['trans_id'].')"> <i class="glyphicon glyphicon-list-alt"></i> Finalize</a></li>
						</ul>
					</div>';
				}
				if($user_type == 7){//recept
					$button = '<!-- Single button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
							<li><a type="button" data-toggle="modal" onclick="view('.$value['trans_id'].', /'.$name.'/, /'.$time.'/)" data-target="#viewResultModal"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
					</div>';
				}
				if($user_type == 9){//owner
					$button = 'No Action Found';
				}


				$result['data'][$key] = array(
					$value['trans_id'],
					$name,
					$time,
					$button
				);
			} // /froeach
		}
		//var_dump($result);
		echo json_encode($result);
	}

	/*
	*------------------------------------
	* fetches the employee list
	*------------------------------------
	*/
	public function getPatient($patient_id = null)
	{
		$result = array('data' => array());
		if($patient_id){

			$result = $this->model_patient->getPatient($patient_id);
		}else{
			$patientData = $this->model_patient->getPatient();

			if($patientData != null){

				foreach ($patientData as $key => $value) {

					$button = '<!-- Single button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	<li><a type="button" data-toggle="modal" onclick="addQueue('.$value['patient_id'].')"> <i class="glyphicon glyphicon-plus"></i> Add Queue</a></li>
					  	<li><a type="button" data-toggle="modal" data-target="#viewPatientInfoModal" onclick="viewPatient('.$value['patient_id'].')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
					  	<li><a type="button" data-toggle="modal" data-target="#editPatientInfoModal" onclick="editPatient('.$value['patient_id'].')"> <i class="glyphicon glyphicon-edit"></i> Update</a></li>
					   <!-- <li><a type="button" data-toggle="modal" data-target="#removePatientInfoModal" onclick="removePatient('.$value['patient_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>		-->
					  </ul>
					</div>';

					$mname = "";
						if($value['mname']){
							$mname = $value['mname'][0] .'. ';
						}else{
							$mname = ' ';
						}
					$name = $value['fname'] . ' ' . $mname . $value['lname'];


					$result['data'][$key] = array(
						$value['patient_id'],
						$name,
						$value['contact'],
						$value['email'],
						$button
					);
				} // /froeach
			}
		}
		echo json_encode($result);
	}

	public function updateTestResult()
	{
		$data = $this->input->post();
		$trans_info = $data["trans_info"];
		if($trans_info) {
			$status = $this->model_patient->updateTestResult($trans_info);
			return ($status ? true : false);
		}
		return false;
	}

	public function finalizeTestResult($trans_id)
	{
		$user_id = $_SESSION['id'];
		$trans_id = $this->model_patient->finalizeTestResult($user_id, $trans_id);
		return $trans_id;
	}

	public function checkResultStatus($trans_id)
	{
		$status = $this->model_patient->checkResultStatus($trans_id);
		$validator;
		if($status == 0){
			$validator['status'] = 'true';
			$validator['amount'] = 0;
		}else{
			$validator['status'] = 'false';
			$validator['amount'] = $status;
		}
		echo json_encode($validator);
	}



	/*
	*------------------------------------
	* edit the student's information
	*------------------------------------
	*/
	public function updateInfo($patient_id = null)
	{
		if($patient_id) {

			$validator = array('success' => false, 'messages' => array(), 'sectionData' => array());
			$validate_data = array(
				array(
					'field' => 'editFname',
					'label' => 'First Name',
					'rules' => 'required'
				),
				array(
					'field' => 'editLname',
					'label' => 'Last Name',
					'rules' => 'required'
				),
				array(
					'field' => 'editContact',
					'label' => 'Contact',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {
				$updateInfo = $this->model_patient->updateInfo($patient_id);
				//var_dump($updateInfo);
				if($updateInfo == true) {
					$validator['success'] = true;
					$validator['messages'] = "Successfully added";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "Error while inserting the information into the database";
				}
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);
				}
			} // /else


			echo json_encode($validator);
		}
	}

	public function findQueue($patient_id = null)
	{
		if($patient_id) {
			$findQueue = $this->model_patient->findQueue($patient_id);
			//var_dump($updateInfo);
			if($findQueue == true) {
				$validator['success'] = true;
				$validator['messages'] = "Queue Present";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "No Queue with Patient ID";
			}
		}
		echo json_encode($validator);

	}

	public function updateQueueLog($queue_id = null, $patient_id = null){
		$user_id = $_SESSION['id'];
		$this->model_patient->addQueueLog($queue_id, $patient_id, $user_id);
	}

	/*
	*------------------------------------
	* edit the student's information
	*------------------------------------
	*/
	public function addQueue($patient_id = null)
	{
		if($patient_id) {
				$addQueue = $this->model_patient->addQueue($patient_id);
				$user_id = $_SESSION['id'];
				$addQueueLog = $this->model_patient->addQueueLog('',$patient_id, $user_id);
				//var_dump($updateInfo);
				if($addQueue == true) {
					$validator['success'] = true;
					$validator['messages'] = "Successfully added";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "Error while inserting the information into the database";
				}
		} else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}
		} // /else

		//var_dump($patient_id);
		echo json_encode($validator);
	}


	/*
	*------------------------------------
	* edit the student's photo
	*------------------------------------
	*/
	public function updatePhoto($studentId = null)
	{
		if($studentId) {
			$validator = array('success' => false, 'messages' => array());

			if(empty($_FILES['editPhoto']['tmp_name'])) {
				$validator['success'] = false;
				$validator['messages'] = "The Photo Field is required";
			}
			else {
				$imgUrl = $this->editUploadImage();
				$update = $this->model_student->updatePhoto($studentId, $imgUrl);

				if($update == true) {
					$validator['success'] = true;
					$validator['messages'] = "Successfully Updated";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "Error while inserting the information into the database";
				}
			} // /else
			echo json_encode($validator);
		} // /if
	}
	public function updateFBS(){
		$updateInfo = $this->model_patient->updateFBS($patient_id);
	}
	public function updatecrea(){

	}
	public function updateBUA() {

	}
	public function update91() {

	}

	/*
	*------------------------------------
	* returns the edited image url
	*------------------------------------
	*/
	public function editUploadImage()
	{
		$type = explode('.', $_FILES['editPhoto']['name']);
		$type = $type[count($type)-1];
		$url = 'assets/images/students/'.uniqid(rand()).'.'.$type;
		if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
			if(is_uploaded_file($_FILES['editPhoto']['tmp_name'])) {
				if(move_uploaded_file($_FILES['editPhoto']['tmp_name'], $url)) {
					return $url;
				}	else {
					return false;
				}
			}
		}
	}

	/*
	*------------------------------------
	* removes the student's information
	*------------------------------------
	*/
	public function remove($patient_id = null)
	{
		$validator = array('success' => false, 'messages' => array());

		if($patient_id) {
			$remove = $this->model_patient->remove($patient_id);
			if($remove) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully Removed";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Error while removing the information";
			} // /else
		} // /if

		echo json_encode($validator);
	}

}
