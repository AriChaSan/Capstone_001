<?php 

class Inventory extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();
		$this->load->library('form_validation');
     	$this->load->helper('form');

		// <!! IMPORTANT!! >
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
		$user_id = $_SESSION['id'];
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'itemname',
				'label' => 'Item Name',
				'rules' => 'required'
			)
		);
		
		//print_r($validate_data);
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {	
			//$imgUrl = $this->uploadImage();
			$create = $this->model_inventory->create($user_id);	

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

	public function getItems()
	{	
		$result = array('data' => array());
		$itemData = $this->model_inventory->getItems();

		if($itemData != null){
			
			foreach ($itemData as $key => $value) {

				$button = '<!-- Single button -->
				<button class="btnSelect">Select</button>';
				date_default_timezone_set("Asia/Manila");
				$time=date('Y-m-d H:i:s',$value['lastupdated_date']); 
				$result['data'][$key] = array(
					$value['id'],
					$value['item_name'],
					$value['item_type_name'],
					$value['quantity'],
					$time,
					$value['lastupdated_by'],
					$button
				);
			} // /froeach
		}
		echo json_encode($result);	
	}

	public function salesLog($test_id = null){
		$user_id = $_SESSION['id'];			
		$this->model_inventory->salesLog($test_id, $user_id);
	}

	public function generateReceipt($test_id = null)
	{
		if (($test_id != null) && ($test_id != 0)) {
			$table="";
			$ReceiptData = $this->model_inventory->generateReceipt($test_id);

			if($ReceiptData != null){
				$table='
				<table class="table table-bordered">
                    <thead>
                       <tr>
                        <th colspan="2" style="text-align: center;">Test No. '.$test_id.'</th>
                      </tr>
                      <tr>
                        <td style="text-align: center;">Test</td>
                        <td style="text-align: right;">Price</td>
                      </tr>
	            ';
				$x = 0;
				$y = 0;
				$z = 0;
				foreach ($ReceiptData as $key => $value){
					if($value['test_id'] < 91 && $x === 0){//if 91 is greater than the test_id meaning its normal and not package :)
						$table .= '
		                    <td>'.$value['test_name'].'</td>';
		                $table .= '
		                	<td style="text-align: right">P'. $value['test_price'].'</td>
		                ';
						$x++;
					} elseif($value['test_id'] > 90 && $x === 0){// if id is greater than 90 and loading the first time (header of the package)
						if($value['test_id'] == 91 && $x == 0){
							$x++;
							$table .= '
			                    <td>'.$value['test_title'].'</td>';
			                $table .= '<td rowspan="6" style="text-align: right">P'.$value['test_price'].'</td>';//
						}elseif($value['test_id'] == 92 && $x == 0){
							$x++;

							$table .= '
			                    <td>'.$value['test_title'].'</td>';
			                $table .= '<td rowspan="11" style="text-align: right">P'.$value['test_price'].'</td>';//
						}
						
					}elseif(($value['test_id'] < 91) && ($x > 0)){
						//wherever it wents after here means x === 1
							//normal add upto SGPT
						$table .= '
							<tr>
		                    	<td>'.$value['test_name'].'</td>';
		                $table .= '<td style="text-align: right">-</td>
		                  	</tr>
						';
					}else if(($value['test_id'] > 90) && ($x > 0) ){
						$table .='
							<tr>
	                    	<td>'.$value['test_title'].'</td>';
					}
					

					if(($value['items_id'] === 46) && ($z === 0)){
						$table .='
								<tr>
		                    	<td rowspan="4">'.$value['test_title'].'</td>';
		                $table .= '<td rowspan="4" style="text-align: right">P'.$value['test_price'].'</td>
		                  	</tr>
						';
						$z++;
					}

					if(($value['items_id'] === 46) && ($z === 0)){
						$table .='
								<tr>
		                    	<td rowspan="4">'.$value['test_title'].'</td>';
		                $table .= '<td rowspan="4" style="text-align: right">P'.$value['test_price'].'</td>
		                  	</tr>
						';
						$z++;
					}

					if(($value['items_id'] === 44) || ($value['items_id'] === 5) || ($value['items_id'] === 51)){
						$table .='<tr>';
		                $table .= '</tr>';
						$z++;
					}
				} // /froeach

				$table .= '
					<tr>
						<td><b>Total</b></td>
                        <td style="text-align: right;"><b>'.$value['test_price'].'</b></td>
					</tr>
	                </table>
				';

				//<!-- add tem modal -->

				$table .= '
				     <hr/> 
	                  <br/>
	                  <br/>
	                  <br/>
	                  <p><b>________________________________</b></p>
	                  Receptionist Stamp
	                  <br/>
	                  <hr/>
	                    <b><i>"Precision in Providing Patient Care"</i></b><br/>
	                  <hr/>
	                </div>
	              	</div>           
		          	</div><!-- /col-md-12 -->
			    	</div><!-- /row -->  
			    	</div>
		        
		        <div class="modal-footer edit-group-modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		          <button type="submit" onclick="activateTransaction('.$test_id.')" class="btn btn-primary">Print and Activate</button>
		        </div> 
				';
			}
			echo $table;
		}return false;
	}

	public function minusInventory($test_id = null)
	{
		if (($test_id != null) && ($test_id != 0)) {
			$minusInventoryData = $this->model_inventory->minusInventory($test_id);
			$user_id = $_SESSION['id'];
			if($minusInventoryData != null){
				foreach ($minusInventoryData as $key => $value) {
					 $this->model_inventory->updateInventory($value['test_id'], $value['items_id'], $value['amount_used'], $value['quantity'], $user_id);
					 $this->model_inventory->updateInventoryHistory($value['test_id'], $value['items_id'], $value['amount_used'], $value['quantity'], $user_id);
				}
			}
		}
	}
	//P0R9C-D4I3G
	public function activateTransaction($queue_id = null, $patient_id = null, $test_id = null) {
		if ($queue_id) {
			$user_id = $_SESSION['id'];
			$activateTransactionData = $this->model_inventory->activateTransaction($queue_id, $patient_id, $test_id, $user_id);
		}
	}

	public function activateResult($queue_id = null, $patient_id = null, $test_id = null) {
		if ($queue_id) {
			$user_id = $_SESSION['id'];
			$activateTransactionData = $this->model_inventory->activateResult($queue_id, $patient_id, $test_id, $user_id);
		}
	}


	public function checkInventory($test_id = null)
	{
		if (($test_id != null) && ($test_id != 0)) {
			$modal="";
			$table="";
			$inventoryCheckData = $this->model_inventory->checkInventory($test_id);
			//print_r($inventoryCheckData);
				//var_dump($inventoryCheckData);
			if($inventoryCheckData != null){
				$table='
				<div style="border: 3; border-color: black; text-align: center;"> 
	                <table class="table table-bordered">
	                   <tr style="text-align: center;">
	                    <th>Test No.</th>
	                    <th>Tests</th>
	                    <th style="text-align: center">Inventory Status</th>
	                    <th style="text-align: right">Price</th>
	                  </tr>
	            ';
				$x = 0;
				$y = 0;
				$z = 0;
				foreach ($inventoryCheckData as $key => $value) {
					if($value['test_id'] < 91 && $x === 0){//if 91 is greater than the test_id meaning its normal and not package :)
						$table .= '
							<td style="text-align: left;">'.$value['test_id'].'</td>
		                    <td>'.$value['test_name'].'</td>';
		                if($value['quantity'] < $value['amount_used']){
		                	$table .= '
		                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
		                	$y = 1;
		                }else{
		                	$table .= '<td style="color:green;">Clear</td>';
		                }
		                
		                $table .= '
		                	<td style="text-align: right">P'. $value['test_price'].'</td>
		                ';
						$x++;
					} elseif($value['test_id'] > 90 && $x === 0){// if id is greater than 90 and loading the first time (header of the package)
						if($value['test_id'] == 91 && $x == 0){
							$x++;
							$table .= '
								<td rowspan="6" style="text-align: left;">'.$value['test_id'].'</td>
			                    <td>'.$value['test_title'].'</td>';
				            if($value['quantity'] < $value['amount_used']){
			                	$table .= '
			                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
			                	$y = 1;
			                }else{
			                	$table .= '<td style="color:green;">Clear</td>';
			                }
			                $table .= '<td rowspan="6" style="text-align: right">P'.$value['test_price'].'</td>';//
						}elseif($value['test_id'] == 92 && $x == 0){
							$x++;

							$table .= '
								<td rowspan="11" style="text-align: left;">'.$value['test_id'].'</td>
			                    <td>'.$value['test_title'].'</td>';
				            if($value['quantity'] < $value['amount_used']){
			                	$table .= '
			                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
			                	$y = 1;
			                }else{
			                	$table .= '<td style="color:green;">Clear</td>';
			                }
			                $table .= '<td rowspan="11" style="text-align: right">P'.$value['test_price'].'</td>';//
						}
						
					}elseif(($value['test_id'] < 91) && ($x > 0)){
						//wherever it wents after here means x === 1
							//normal add upto SGPT
						$table .= '
							<tr>
								<td>'.$value['test_id'].'</td>	
		                    	<td>'.$value['test_name'].'</td>';
		                    	if($value['quantity'] < $value['amount_used'] ){
				                	$table .= '
				                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
				                	$y = 1;
				                }else{
				                	$table .= '<td style="color:green;">Clear</td>';
				                }
		                $table .= '<td style="text-align: right">-</td>
		                  	</tr>
						';
					}else if(($value['test_id'] > 90) && ($x > 0) ){
						$table .='
							<tr>
	                    	<td>'.$value['test_title'].'</td>';
	                    	if($value['quantity'] < $value['amount_used']){
			                	$table .= '
			                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
			                	$y = 1;
			                }else{
			                	$table .= '<td style="color:green;">Clear</td>';
			                }
					}
					

					if(($value['items_id'] === 46) && ($z === 0)){
						$table .='
								<tr>
		                    	<td rowspan="4">'.$value['test_title'].'</td>';
		                    	if($value['quantity'] < $value['amount_used']){
				                	$table .= '
				                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
				                	$y = 1;
				                }else{
				                	$table .= '<td style="color:green;">Clear</td>';
				                }
		                $table .= '<td rowspan="4" style="text-align: right">P'.$value['test_price'].'</td>
		                  	</tr>
						';
						$z++;
					}

					if(($value['items_id'] === 46) && ($z === 0)){
						$table .='
								<tr>
		                    	<td rowspan="4">'.$value['test_title'].'</td>';
		                    	if($value['quantity'] < $value['amount_used']){
				                	$table .= '
				                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
				                	$y = 1;
				                }else{
				                	$table .= '<td style="color:green;">Clear</td>';
				                }
		                $table .= '<td rowspan="4" style="text-align: right">P'.$value['test_price'].'</td>
		                  	</tr>
						';
						$z++;
					}

					if(($value['items_id'] === 44) || ($value['items_id'] === 5) || ($value['items_id'] === 51)){
						$table .='<tr>';
		                    	if($value['quantity'] < $value['amount_used']){
				                	$table .= '
				                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
				                	$y = 1;
				                }else{
				                	$table .= '<td style="color:green;">Clear</td>';
				                }
		                $table .= '</tr>';
						$z++;
					}



					
					
				} // /froeach

				$table .= '
	                </table><hr>
	                <h3 style="text-align: right;">Total: '.$value['test_price'].'</h3>
	            </div>
				';

				//<!-- add tem modal -->

				$modal .= '
			    <div class="modal-body add-modal">       
			        <div class="row">
			          <div class="col-md-12">
			            	<div id="add-package-message"></div>
			            		<div class="form-group">'.$table.'</div>           
			          		</div><!-- /col-md-12 -->
			        </div><!-- /row -->  
			    </div>        
				';

				if($y == 0){
					$modal .= '
					<div class="modal-footer edit-group-modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="generateReceipt('.
				        $test_id
				        .')"data-target="#viewRecPackage1Modal" id="viewRecPackageBtn">
				            Submit and Generate Receipt
				        </button>
				    </div>         
					';	
				}else{
					$modal .= '
					<div class="modal-footer edit-group-modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <a href="'.base_url('inventory').'" type="button" class="btn btn-primary">Go To Inventory</a>
				    </div>         
					';	
				}

				

			}
			//var_dump($table);
			echo ($modal);	
		}
		return false;
	}

	public function getInventoryHistory()
	{	
		$result = array('data' => array());
		$inventoryHistoryData = $this->model_inventory->getInventoryHistory();

		if($inventoryHistoryData != null){
			
			foreach ($inventoryHistoryData as $key => $value) {

				$result['data'][$key] = array(
					$value['items_id'],
					$value['quantity_old'],
					$value['quantity_new'],
					$value['quantity_summary'],
					$value['new_update_date'],
					$value['new_updateby'],
				);
			} // /froeach
		}
		echo json_encode($result);	
	}

	/*
	*------------------------------------
	* edit the student's information
	*------------------------------------
	*/
	public function updateInfo()
	{
		$user_id = $_SESSION['id'];
		$updateInfo = $this->model_inventory->updateInfo($user_id);	
		//var_dump($updateInfo); 					
		if($updateInfo == true) {
			$validator['success'] = true;
			$validator['messages'] = "Successfully Updated";
		}
		else {
			$validator['success'] = false;
			$validator['messages'] = "Error while inserting the information into the database";
		}

			echo json_encode($validator);
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