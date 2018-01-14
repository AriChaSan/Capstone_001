<?php 

class Model_Sales extends CI_Model 
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

	//if will be updated in the future.. put all sales function here -agcs

	public function countTotalSales()
	{
		$sql = "SELECT * FROM sales";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function TotalSales()
	{
		$sql = "SELECT SUM(amount) as totalsales FROM sales";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function countTotalSalesToday()
	{
		$today = strtotime(date("M d Y 08:00:01"));
		$sql = "SELECT SUM(amount) as salestoday FROM sales WHERE created_At >= ?";
		$query = $this->db->query($sql, array($today));
		return $query->result_array();
	}

	public function countTotalPatientToday()
	{
		$today = strtotime(date("M d Y 08:00:01"));
		$sql = "SELECT * FROM sales WHERE created_At >= ?";
		$query = $this->db->query($sql, array($today));
		//var_dump($query->num_rows());
		return $query->num_rows();
	}
}
