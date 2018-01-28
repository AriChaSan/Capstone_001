<?php

class Transaction extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();
		$this->load->library('form_validation');
     	$this->load->helper('form');

		// <!! IMPORTANT!! >
		$this->load->model('model_transaction');
		$this->load->model('model_inventory');

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
			),
			array(
				'field' => 'contact',
				'label' => 'Contact',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
			),
			array(
				'field' => 'efname',
				'label' => 'First Name',
				'rules' => 'required'
			),
			array(
				'field' => 'elname',
				'label' => 'Last Name',
				'rules' => 'required'
			),
			array(
				'field' => 'erelation',
				'label' => 'Contact',
				'rules' => 'required'
			),
			array(
				'field' => 'econtact',
				'label' => 'Email',
				'rules' => 'required',
			),

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

				$button = '<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Action <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  	<li><a type="button" data-toggle="modal" data-target="#choosePackageModal" > <i class="glyphicon glyphicon-check"></i> Accept</a></li>
				  	<li><a type="button" data-toggle="modal" onclick="decline('.$value['patient_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
				  </ul>
				</div>';

				$mname = "";
					if($value['mname']){
						$mname = $value['mname'][0] .'. ';
					}else{
						$mname = ' ';
					}
				$name = $value['fname'] . ' ' . $mname . $value['lname'];

				$status=$value['code'] . " - " . $value['StatusName'];

				$result['data'][$key] = array(
					$value['patient_id'],
					$name,
					$value['created_At'],
					$status,
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

	/*
	*------------------------------------
	* edit the student's information
	*------------------------------------
	*/
	public function addQueue($patient_id = null)
	{
		if($patient_id) {
				$addQueue = $this->model_patient->addQueue($patient_id);
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

		var_dump($patient_id);
		//echo json_encode($validator);
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
