<?php 

class Model_Employee extends CI_Model 
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
		$str=$this->input->post('fname').$this->input->post('lname');
		$str=preg_replace('/\s+/', '', $str);
		$str=strtolower($str);
		$insert_data_user = array(
			'username'			=> $str,
			'password'			=> md5('password'),
			'account_type_id'	=> $this->input->post('account_type'),
		);

		$user_status = $this->db->insert('users', $insert_data_user);

		if($user_status === TRUE){

			$account_id = $this->db->insert_id();

			if($this->input->post('mname') != ''){
				$mname = trim(ucwords($this->input->post('mname')));
			}else{
				$mname = null;
			}

			$insert_data = array(
				'user_id'			=> $account_id,
				'register_date' 	=> strtotime('now'),
				'lastupdate_date' 	=> strtotime('now'),
				'fname'				=> trim(ucwords($this->input->post('fname'))),
				'mname'				=> $mname,
				'lname' 			=> trim(ucwords($this->input->post('lname'))),
				'contact'			=> trim($this->input->post('contact')),
				'email'				=> trim($this->input->post('email')),
				'account_type_id'	=> $this->input->post('account_type'),
			);

			$insert_status = $this->db->insert('employee', $insert_data);	

			if($insert_status === true){
				//7.ariannesantos
				$str = $account_id.$str;
				$update_username = array(
					'username' => $str,
				);

				$this->db->where('user_id', $account_id);
				$status = $this->db->update('users', $update_username);

				return ($status == true ? true : false);
				}				
		}
		return false;
	}

	/*
	*-----------------------------------
	* fetches all account type from accout type table
	*-----------------------------------
	*/
	public function getAllAccount()
	{
		$sql = "SELECT * FROM account_type;";
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	/*
	*-----------------------------------
	* lists all employee 
	*-----------------------------------
	*/
	public function getEmployee($user_id = null)
	{
		if($user_id){
			$this->db->select('employee.user_id, employee.register_date, employee.fname, employee.mname, 
				employee.lname, employee.email, employee.contact, employee.account_type_id, account_type.account_type_name as `AccountName`');   
			$this->db->from('employee'); 
			$this->db->join('account_type', 'employee.account_type_id = account_type.account_type_id');
			$this->db->where('employee.account_type_id = 7 OR employee.account_type_id = 8');
			$this->db->where('employee.user_id', $user_id);
			//$this->db->where('employee.account_type_id != 9 AND employee.account_type_id != 0');
			$this->db->order_by("employee.account_type_id", "desc");
			$query = $this->db->get();

			return $query->row_array();

		}else{
			$this->db->select('employee.user_id, employee.register_date, employee.fname, employee.mname, 
				employee.lname, employee.email, employee.contact, employee.account_type_id, account_type.account_type_name as `AccountName`');   
			$this->db->from('employee'); 
			$this->db->join('account_type', 'employee.account_type_id = account_type.account_type_id');
			$this->db->where('employee.account_type_id = 7 OR employee.account_type_id = 8');
			$this->db->order_by("employee.account_type_id", "desc");

			$query = $this->db->get();

			return $query->result_array();	
		}
		
	}

	/*
	*--------------------------------------------------
	*fetches the student information via class id 
	*--------------------------------------------------
	*/
	public function fetchStudentDataByClass($classId = null)
	{
		if($classId) {
			$sql = "SELECT * FROM student WHERE class_id = ?";
			$query = $this->db->query($sql, array($classId));
			return $query->result_array();
		} // /if
	} 

	/*
	*--------------------------------------------------
	* fetches the student infro via class and section id
	*--------------------------------------------------
	*/
	public function fetchStudentByClassAndSection($classId = null, $sectionId = null)
	{
		if($classId && $sectionId) {
			$sql = "SELECT * FROM student WHERE class_id = ? AND section_id = ?";
			$query = $this->db->query($sql, array($classId, $sectionId));
			return $query->result_array();
		} // /if
	}

	/*
	*-----------------------------------
	* update the student's inform
	*-----------------------------------
	*/	
	public function updateInfo($user_id = null)
	{
		if($this->input->post('editMname') != ''){
			$mname = trim(ucwords($this->input->post('editMname')));
		}else{
			$mname = null;
		}

		if($user_id) {
			$update_data = array(
				'lastupdate_date' => strtotime('now'),
				'fname'			=> trim(ucwords($this->input->post('editFname'))),
				'mname'			=> $mname,
				'lname' 		=> trim(ucwords($this->input->post('editLname'))),				
				'contact'		=> $this->input->post('editContact'),
				'email'			=> $this->input->post('editEmail'),
				'account_type_id'	=> $this->input->post('edit_account_type'),
			);

			$this->db->where('user_id', $user_id);
			$query = $this->db->update('employee', $update_data);
			
			return ($query === true ? true : false);
		}			
	}

	/*
	*-----------------------------------
	* update the student's photo
	*-----------------------------------
	*/
	public function updatePhoto($studentId = null, $imageUrl = null)
	{
		if($studentId && $imageUrl) {
			$update_data = array(
				'image' 	=> $imageUrl
			);

			$this->db->where('user_id', $studentId);
			$query = $this->db->update('student', $update_data);
			
			return ($query === true ? true : false);
		}			
	}

	/*
	*-----------------------------------
	* remove the student's info
	*-----------------------------------
	*/
	public function remove($user_id = null) 
	{
		if($user_id) {
			$this->db->where('user_id', $user_id);
			$this->db->delete('employee');
			
			$this->db->where('user_id', $user_id);
			$result = $this->db->delete('users');
			return ($result === true ? true: false); 
		} // /if
	}

	/*
	*-----------------------------------
	* insert bulk student
	*-----------------------------------
	*/
	public function createBulk()
	{				
		for($x = 1; $x <= count($this->input->post('bulkstfname')); $x++) {						
			$insert_data = array(				
				'class_id' 		=> $this->input->post('bulkstclassName')[$x],
				'section_id'	=> $this->input->post('bulkstsectionName')[$x],
				'image'			=> 'assets/images/default/default_avatar.png',
				'fname'			=> $this->input->post('bulkstfname')[$x],
				'mname'			=> $this->input->post('bulkstmname')[$x],
				'lname' 		=> $this->input->post('bulkstlname')[$x],			
			);

			$status = $this->db->insert('student', $insert_data);						
		} // /for

		return ($status == true ? true : false);	
	}

	/*
	*-------------------------------------------
	* count total student
	*-------------------------------------------
	*/
	public function countTotalEmployee()
	{
		$sql = "SELECT * FROM employee";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
