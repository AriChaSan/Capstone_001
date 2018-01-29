<?php

class Model_Inventory extends CI_Model
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
	public function create($user_id = null)
	{
		if($user_id){
			$insert_data = array(
			'item_type_id' 		=> $this->input->post('itemtype'),
			'item_name' 		=> trim(ucwords($this->input->post('itemname'))),
			'created_At'		=> strtotime("now"),
			'lastupdated_date'	=> strtotime("now"),
			'lastupdated_by'	=> $user_id,
		);

		$status = $this->db->insert('items', $insert_data);

			if($status === true){
				//update inventory_history
				$item_id = $this->db->insert_id();
				if($item_id != 0){
					$update_data = array(
						'history_type' 		=> "Create",
						'items_id'			=> $item_id,
						'quantity_old'		=> "0",
						'quantity_new'		=> "0",
						'quantity_summary'	=> "Create",
						'old_update_date'	=>strtotime("now"),
						'old_updateby'		=>$user_id,
						'new_update_date'	=>strtotime("now"),
						'new_updateby'		=>$user_id,
					);

					$query = $this->db->insert('inventory_history', $update_data);

					return ($query === true ? true : false);
				}
			return false;
			} return false;
		}
	}

	public function updateInventoryHistory($test_id = null, $items_id = null, $amount_used = null, $quantity = null, $user_id = null){
		if($test_id){
			$update_data = array(
				'history_type' 		=> "Transaction Consumption",
				'items_id'			=> $items_id,
				'quantity_old'		=> $quantity,
				'quantity_new'		=> $quantity - $amount_used,
				'quantity_summary'	=> "-".$amount_used,
				'old_update_date'	=>strtotime("now"),
				'old_updateby'		=>$user_id,
				'new_update_date'	=>strtotime("now"),
				'new_updateby'		=>$user_id,
			);

			$query = $this->db->insert('inventory_history', $update_data);

			return ($query === true ? true : false);
		}return false;
	}

	public function updateInventory($test_id = null, $items_id = null, $amount_used = null, $quantity = null, $user_id = null){
		if($test_id){
			$update_data = array(
				'quantity'			=> $quantity-$amount_used,
				'lastupdated_date'	=> strtotime("now"),
				'lastupdated_by'	=> $user_id,
			);

			$query = $this->db->update('items', $update_data);

			return ($query === true ? true : false);
		}return false;
	}

	public function activateTransaction($queue_id, $patient_id, $test_id, $user_id){
		if($test_id > 0){
			$update_data = array(
				'trans_id'			=> $queue_id,
				'trans_key'			=> 'P0R9C-D4I3G',
				'user_activate_id'	=> $user_id,
				'created_At'		=> strtotime("now"),
				'patient_id'		=> $patient_id,
				'queue_id'			=> $queue_id,
				'test_content_id'	=> $test_id,
			);

			$this->db->where('queue_id', $queue_id);
			$delete = $this->db->delete('queue');
			if($delete == true){
				//var_dump($delete);
				$query = $this->db->insert('active_transaction', $update_data);
				return ($query === true ? true : false);
			}
			return false;
		}return false;
	}

	public function activateResult($queue_id, $patient_id, $test_id, $user_id){
		if($test_id){
			$this->db->select('test_result.test_id, test_result.test_result_name, test_result.gender,
				test_result.test_result_normal_value, test.test_name');
			$this->db->from('active_transaction');
			$this->db->join('test_result ', 'active_transaction.test_content_id = test_result.test_id');
			$this->db->join('test ', 'test.id = active_transaction.test_content_id');
			$this->db->group_by('test_result`.`test_result_name`');
			$this->db->where('active_transaction.test_content_id', $test_id);

			$query = $this->db->get();

		 $resultQuery = $query->result_array();

		 if($resultQuery != null){
       foreach ($resultQuery as $key => $value) {

         $gender ="";
         if($value['gender'] == 0){
           $gender = "M";
         }elseif($value['gender'] == 1){
           $gender = "F";
         }elseif($value['gender'] == 0){
           $gender = "N";
         }

         $update_data = array(
           'trans_id'			=> $queue_id,
           'test_id'			=> $test_id,
           'test_result_name'	=> $value['test_result_name'],
           'result'			=> '',
           'gender'			=> $gender,
           'normal_value'		=> $value['test_result_normal_value']
         );
         $query = $this->db->insert('result', $update_data);
				 echo "<script>console.log(".$this->db->last_query().")</script>";
       }
       return ($query === true ? true : false);
     }
   }
   return false;
}

	public function passiveTransaction($queue_id = null, $patient_id = null, $test_id = null, $user_id = null){
		if($test_id){
			$update_data = array(
				'trans_id'			=> $queue_id,
				'trans_key'			=> 'P0R9C-D4I3G',
				'user_activate_id'	=> $user_id,
				'created_At'		=> strtotime("now"),
				'patient_id'		=> $patient_id,
				'queue_id'			=> $queue_id,
				'test_content_id'	=> $test_id,
			);

			$query = $this->db->insert('passive_transaction', $update_data);

			return ($query === true ? true : false);
		}return false;
	}

	public function getItems()
	{
		$this->db->select('items.id, items.item_type_id, items.item_name, items.quantity, items.created_At, items.lastupdated_date, items.lastupdated_by,
			item_type.id as `ItemTypeID`, item_type.item_type_name');
		$this->db->from('items');
		$this->db->join('item_type', 'items.item_type_id = item_type.id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getInventoryCount($items_id)
	{
		$this->db->select('quantity');
		$this->db->from('items');
		$this->db->where('id =', $items_id);
		return $this->db->get()->row('quantity');
	}

	public function generateReceipt($test_id = null)
	{
		if(($test_id != null) && ($test_id != 0)){
			$this->db->select('inventory_prerequisite.test_id, inventory_prerequisite.test_title, inventory_prerequisite.items_id, items.item_name, test.test_name, test.test_price');
			$this->db->from('inventory_prerequisite');
			$this->db->join('items', 'inventory_prerequisite.items_id = items.id');
			$this->db->join('test', 'test.id = inventory_prerequisite.test_id');
			$this->db->where('test.id', $test_id);
			$query = $this->db->get();

			return $query->result_array();
		}else return false;
	}

	public function checkInventory($test_id = null)
	{
		if(($test_id != null) && ($test_id != 0)){
			$this->db->select('inventory_prerequisite.test_id, inventory_prerequisite.test_title, inventory_prerequisite.items_id, items.item_name, inventory_prerequisite.amount_used, items.quantity, test.test_name, test.test_price');
			$this->db->from('inventory_prerequisite');
			$this->db->join('items', 'inventory_prerequisite.items_id = items.id');
			$this->db->join('test', 'test.id = inventory_prerequisite.test_id');
			$this->db->where('test.id', $test_id);
			$query = $this->db->get();

			return $query->result_array();
		}else return false;
	}

	public function minusInventory($test_id = null)
	{
		if(($test_id != null) && ($test_id != 0)){
			$this->db->select('inventory_prerequisite.test_id, inventory_prerequisite.items_id, inventory_prerequisite.amount_used, items.quantity');
			$this->db->from('inventory_prerequisite');
			$this->db->join('items', 'inventory_prerequisite.items_id = items.id');
			$this->db->join('test', 'test.id = inventory_prerequisite.test_id');
			$this->db->where('test.id', $test_id);
			$query = $this->db->get();

			return $query->result_array();
		}else return false;
	}

	public function salesLog($trans_id, $total_price, $user_id)
	{
	    $insert_data = array(
	    'trans_id' =>  $trans_id,
	    'created_At' 	=> strtotime("now"),
	    'amount'		=>	$total_price,
	    'user_id'		=> $user_id
	    );

	  $status = $this->db->insert('sales', $insert_data);
		return ($status == true ? true : false);
	}

	public function getInventoryHistory()
	{
		$this->db->select('inventory_history.*, employee.fname, employee.lname');
		$this->db->from('inventory_history');
		$this->db->join('employee', 'employee.user_id = inventory_history.new_updateby');
		$query = $this->db->get();

		return $query->result_array();
	}


	public function getItemInformation($item_id = null)
	{
		if($item_id){
			$this->db->select('*');
			$this->db->from('inventory_history');
			$query = $this->db->get();

			return $query->result_array();
		}
	}

	/*
	*-----------------------------------
	* update the student's inform
	*-----------------------------------
	*/
	public function updateInfo($user_id = null)
	{
		if($user_id){
			$item_id = $this->input->post('itemid');
			if($item_id){
				if($item_id != 0){
					//if there is an item id ->find the information of that item
					//if found, get all the old information first then insert to history
					$item_old_information = $this->getInventoryCount($item_id);
					$item_summary = $this->input->post('itemq') - $item_old_information;
					$insert_history_data = array(
						'history_type' 		=> "Update",
						'items_id'			=> $item_id,
						'quantity_old'		=> $item_old_information,
						'quantity_new'		=> $this->input->post('itemq'),
						'quantity_summary'	=> $item_summary,
						'old_update_date'	=>strtotime("now"),
						'old_updateby'		=>$user_id,
						'new_update_date'	=>strtotime("now"),
						'new_updateby'		=>$user_id,
					);

					$query = $this->db->insert('inventory_history', $insert_history_data);
					//after updating the history->update the inventory
					if($query === true){
						$update_data = array(
							'quantity' 			=> $this->input->post('itemq'),
							'item_name'			=> trim(ucwords($this->input->post('itemname'))),
							'lastupdated_date'	=> strtotime('now'),
							'lastupdated_by'	=> $user_id,
						);

						$this->db->where('id', $item_id);
						$status = $this->db->update('items', $update_data);

						return ($status === true ? true : false);
					}
				}return false;

			}return false;
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
	public function countTotalItems()
	{
		$sql = "SELECT * FROM items";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
