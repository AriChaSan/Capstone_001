<?php

class Model_Patient extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
	*------------------------------------
	* inserts the student's information
	* into the database
	*------------------------------------
	*/
	public function create()
	{
		if($this->input->post('mname') != ''){
			$mname = trim(ucwords($this->input->post('mname')));
		}else{
			$mname = null;
		}

		if($this->input->post('emname') != ''){
			$emname = trim(ucwords($this->input->post('emname')));
		}else{
			$emname = null;
		}

		$insert_data = array(
			'register_date' 		=> strtotime('now'),
			'lastupdate_date' 		=> strtotime('now'),
			'p-fname'				=> trim(ucwords($this->input->post('fname'))),
			'p-mname'				=> $mname,
			'p-lname'				=> trim(ucwords($this->input->post('lname'))),
			'p-gender'				=> $this->input->post('gender'),
			'p-contact'				=> $this->input->post('contact'),
			'p-email'				=> $this->input->post('email'),
			'e-fname' 				=> trim(ucwords($this->input->post('efname'))),
			'e-mname' 				=> $emname,
			'e-lname' 				=> trim(ucwords($this->input->post('elname'))),
			'e-relation'				=> trim($this->input->post('erelation')),
			'e-contact'				=> trim($this->input->post('econtact')),
		);

		$status = $this->db->insert('patient', $insert_data);

		return ($status == true ? true : false);
	}

	public function findQueue($patient_id = null)
	{
		if($patient_id){
			$this->db->select('*');
			$this->db->from('queue');
			$this->db->where('queue.patient_id', $patient_id);
			$query = $this->db->get();

			return $query->num_rows();
		}
		return false;
	}



	public function addQueueLog($queue_id = null, $patient_id = null, $user_id = null)
	{
		if(($patient_id) && ($user_id)){
			$insert_data = array(
				'queue_id'		=> strtotime("now"),
				'patient_id'	=> $patient_id,
				'user_id'		=> $user_id,
				'queue_status'	=> 'CREATE',
				'comments_At' 	=> 'user logged in creates a queue',
				'created_At' 	=> strtotime("now"),
			);
		}elseif(($patient_id) && ($user_id) && ($queue_id)){
			$insert_data = array(
				'queue_id'		=> $queue_id,
				'patient_id'	=> $patient_id,
				'user_id'		=> $user_id,
				'queue_status'	=> 'ACTIVATE',
				'comments_At' 	=> 'user logged in activated a queue',
				'created_At' => strtotime("now"),
			);
		}

		$status = $this->db->insert('queue_log', $insert_data);

		return ($status == true ? true : false);
	}

	public function addQueue($patient_id = null)
	{
		if($patient_id){
			$insert_data = array(
				'queue_id'	=> strtotime("now"),
				'patient_id' => $patient_id,
				'created_At' => strtotime("now")
			);
		}

		$status = $this->db->insert('queue', $insert_data);

		return ($status == true ? true : false);
	}

	public function getQueue()
	{
		$this->db->select('patient.patient_id, patient.p-fname as `fname`, patient.p-mname as `mname`, patient.p-lname as `lname`, queue.created_At, status.code, status.id, status.name as `StatusName, queue.queue_id`
			');
			$this->db->from('patient');
			$this->db->join('queue', 'patient.patient_id = queue.patient_id');
			$this->db->join('status', 'status.id = queue.status_id');
			//$this->db->where('teacher.account_type_id >= 5');
		//$this->db->order_by("teacher.account_type_id", "desc");
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getAciveTrans()
	{
		$this->db->select('patient.patient_id, patient.p-fname as `fname`, patient.p-mname as `mname`, patient.p-lname as `lname`, active_transaction.created_At, active_transaction.trans_id, result.test_id
			');
		$this->db->from('patient');
		$this->db->join('active_transaction', 'patient.patient_id = active_transaction.patient_id');
		$this->db->join('result', 'active_transaction.trans_id = result.trans_id');
		$this->db->group_by('result.trans_id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function viewResult($trans_id)
	{
		$this->db->select('*');
		$this->db->from('result');
		$this->db->where('trans_id = ', $trans_id);
		$query = $this->db->get();

		return $query->result_array();
	}

	/*
	*-----------------------------------
	* lists all employee
	*-----------------------------------
	*/
	public function getPatient($patient_id = null)
	{
		if($patient_id){
			$this->db->select('patient.patient_id, patient.p-fname as `fname`, patient.p-mname as `mname`, p-contact as `contact`, patient.p-lname as `lname`, patient.p-email as `email`, patient.register_date, patient.p-gender as `gender`');
			$this->db->from('patient');
			$this->db->where('patient.patient_id', $patient_id);
			$query = $this->db->get();

			return $query->row_array();

		}else{
			$this->db->select('patient.patient_id, patient.p-fname as `fname`, patient.p-mname as `mname`, p-contact as `contact`, patient.p-lname as `lname`, patient.p-email as `email`, patient.register_date, patient.p-gender as `gender`');
			$this->db->from('patient');

			$query = $this->db->get();

			return $query->result_array();
		}

	}

	/*
	*-----------------------------------
	* lists all test
	*-----------------------------------
	*/
	public function getAlltests()
	{
		$this->db->select('test.id, test.test_name, test.test_price, test_type.test_type_name');
		$this->db->from('test');
		$this->db->join('test_type', 'test.test_type_id = test_type.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getAllPrice($test_id)
	{
		//var_dump($test_id);
		$this->db->select("SUM(test_price) as `price` FROM `test` WHERE id = $test_id");
		$query = $this->db->get();
		//var_dump($this->db->last_query());
		 return $query->row_array();
	}

	/*
	*-----------------------------------
	* update the student's inform
	*-----------------------------------
	*/
	public function updateInfo($patient_id = null)
	{
		if($this->input->post('editMname') != ''){
			$mname = trim(ucwords($this->input->post('editMname')));
		}else{
			$mname = null;
		}

		if($patient_id) {
			$update_data = array(
				'lastupdate_date' 	=> strtotime('now'),
				'p-fname'			=> trim(ucwords($this->input->post('editFname'))),
				'p-mname'			=> $mname,
				'p-lname' 			=> trim(ucwords($this->input->post('editLname'))),
				'p-gender'			=> $this->input->post('editGender'),
				'p-contact'			=> $this->input->post('editContact'),
				'p-email'			=> $this->input->post('editEmail'),

			);

			$this->db->where('patient_id', $patient_id);
			$query = $this->db->update('patient', $update_data);

			return ($query === true ? true : false);
		}
	}

	/*
	*-----------------------------------
	* remove the student's info
	*-----------------------------------
	*/
	public function remove($patient_id = null)
	{
		if($patient_id) {
			$this->db->where('patient_id', $patient_id);
			$query = $this->db->delete('patient');

			return ($query === true ? true: false);
		} // /if
	}

	/*
	*-------------------------------------------
	* count total patient
	*-------------------------------------------
	*/
	public function countTotalPatient()
	{
		$sql = "SELECT * FROM patient";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	/*
	*-------------------------------------------
	* count total queue
	*-------------------------------------------
	*/
	public function countTotalQueue()
	{
		$sql = "SELECT * FROM queue where id > 0 Group By queue_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	/*
	*-------------------------------------------
	* count total transaction
	*-------------------------------------------
	*/
	public function countTotalTransaction()
	{
		$sql = "SELECT * FROM active_transaction where id > 0 Group By queue_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
