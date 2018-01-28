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

	public function salesLog($total_price, $trans_id){
		$user_id = $_SESSION['id'];
		$this->model_inventory->salesLog($trans_id, $total_price, $user_id);
	}

	public function generateReceipt()
	{
		$data = $this->input->post();
		$test_id = $data["test_id"];
		//print_r($test_id);
		$total_price = 0;
		$counter91 = 6;
		$counter92 = 11;
		$counter93 = 0;
		$counter94 = 0;
		$w = 0;
		$y = 0; //y = determiner if all are clear in inventory
		$x = 0; //z
		$z = 0;
		$current_test_id = 0;
		$modal="";
		$table='
		<div style="border: 3; border-color: black; text-align: center; overflow: hidden;">
			<table id ="receiptResults123" class="table table-bordered">
				<thead>
					<tr style="text-align: center;">
						<th>Test</th>
						<th>Content</th>
						<th style="text-align: right">Price</th>
					</tr>
				</thead>
				<tbody>
					';
		for ($i=0; $i < sizeOf($test_id) ; $i++) {
			$current_price_12 = $this->model_patient->getAllPrice($test_id[$i]);

			$total_price = $total_price + $current_price_12['price'];
			//var_dump($current_price_12);
			//var_dump($total_price);
			$inventoryCheckData = $this->model_inventory->generateReceipt($test_id[$i]);
			if(!empty($inventoryCheckData)){
				foreach ($inventoryCheckData as $key => $value) {
					$current_test_id = $value['test_id'];
					if($value['test_id'] < 91){//if 91 is greater than the test_id meaning its normal and not package :)
						$table .= '<tr>
							<td style="text-align: left;">'.$value['test_id'].'</td>
												<td>'.$value['test_name'].'</td>';
										$table .= '
											<td style="text-align: right">P'. $value['test_price'].'</td></tr>
										';
					} elseif($value['test_id'] > 90){// if id is greater than 90 and loading the first time (header of the package)
						if($value['test_id'] == 91 && $counter91 == 6){
							$table .= '<tr>
								<td rowspan=6 style="text-align: left;">'.$value['test_id'].' - '.$value['test_name'].'</td>
									 <td>'.$value['test_title'].'</td>';
											$table .= '<td rowspan="6" style="text-align: right">P'.$value['test_price'].'</td></tr>';
											$counter91--;
						}elseif($value['test_id'] == 92 && $counter92 === 11){
							$table .= '<tr>
								<td rowspan=11 style="text-align: left;">'.$value['test_id'].' - '.$value['test_name'].'</td>
													<td>'.$value['test_title'].'</td>';
											$table .= '<td rowspan="11" style="text-align: right">P'.$value['test_price'].'</td></tr>';
											$counter92--;
						}elseif (($value['test_id'] == 92 && $counter92 != 11) || ($value['test_id'] == 91 && $counter91 != 6)){
							$table .='
								<tr>
													<td>'.$value['test_title'].'</td>';
												$table .= '</tr>';
						}

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
													if($value['quantity'] < $value['amount_used']){
										$table .= '</tr>';
						$z++;
					}
				}
			}

		}//foreach
		}
		echo "<script>document.getElementById('hiddentotalsales').value = $total_price;</script>";

		$table .= '
			<tr>
				<td colspan=3 style="text-align: right;"><b>Total '.'₱ '.$total_price.'.00</b></td>
			</tr>
					</tbody>
				</table>
			</div>
		';

		$modal .= '
			<div class="modal-body add-modal" style="width:100%; height:100%; overflow:hidden;">
					<div class="row">
						<div class="col-md-12">
								<div id="add-package-message"></div>
									<div class="form-group">'.$table.'</div>
								</div><!-- /col-md-12 -->
					</div><!-- /row -->
			</div>
		';

		$modal .= '
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
					<button type="submit" onclick="activateTransaction()" class="btn btn-primary">Print and Activate</button>
				</div>
		';

		echo ($modal);
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
	public function activateTransaction($queue_id, $patient_id , $test_id) {
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

	public function getAllPrice(){
		$data = $this->input->post();
		$test_id = $data["test_id"];
		$checkPrice = $this->model_patient->getAllPrice($test_id);
		return $checkPrice;
	}

	public function checkInventory()
	{
		$data = $this->input->post();
		$test_id = $data["test_id"];
		//print_r($test_id);
		$total_price = 0;
		$counter91 = 6;
		$counter92 = 11;
		$counter93 = 0;
		$counter94 = 0;
		$w = 0;
		$y = 0; //y = determiner if all are clear in inventory
		$x = 0; //z
		$z = 0;
		$current_test_id = 0;
		$modal="";
		$table='
		<div style="border: 3; border-color: black; text-align: center; overflow:hidden;">
			<table id ="inventorycheck123" class="table table-bordered">
				<thead>
					<tr style="text-align: center;">
						<th>Test # - Title</th>
						<th>Tests</th>
						<th style="text-align: center">Inventory Status</th>
						<th style="text-align: right">Price</th>
					</tr>
				</thead>
				<tbody>
					';
		for ($i=0; $i < sizeOf($test_id) ; $i++) {
			$current_price_12 = $this->model_patient->getAllPrice($test_id[$i]);

			$total_price = $total_price + $current_price_12['price'];
			//var_dump($current_price_12);
			//var_dump($total_price);
			$inventoryCheckData = $this->model_inventory->checkInventory($test_id[$i]);
			if(!empty($inventoryCheckData)){
				foreach ($inventoryCheckData as $key => $value) {
					$current_test_id = $value['test_id'];
					if($value['test_id'] < 91){//if 91 is greater than the test_id meaning its normal and not package :)
						$table .= '<tr>
							<td style="text-align: left;">'.$value['test_id'].'</td>
		                    <td>'.$value['test_name'].'</td>';
		                if($value['quantity'] < $value['amount_used']){
		                	$table .= '
		                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
		                	$y = 1; $z = 1;
		                }else{
		                	$table .= '<td style="color:green;">Clear</td>';
		                }

		                $table .= '
		                	<td style="text-align: right">P'. $value['test_price'].'</td></tr>
		                ';
					} elseif($value['test_id'] > 90){// if id is greater than 90 and loading the first time (header of the package)
						if($value['test_id'] == 91 && $counter91 == 6){
							$table .= '<tr>
								<td rowspan=6 style="text-align: left;">'.$value['test_id'].' - '.$value['test_name'].'</td>
			             <td>'.$value['test_title'].'</td>';
				            if($value['quantity'] < $value['amount_used']){
			                	$table .= '
			                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
			                	$y = 1;
			                }else{
			                	$table .= '<td style="color:green;">Clear</td>';
			                }
			                $table .= '<td rowspan="6" style="text-align: right">P'.$value['test_price'].'</td></tr>';
											$counter91--;
						}elseif($value['test_id'] == 92 && $counter92 === 11){
							$table .= '<tr>
								<td rowspan=11 style="text-align: left;">'.$value['test_id'].' - '.$value['test_name'].'</td>
			                    <td>'.$value['test_title'].'</td>';
				            if($value['quantity'] < $value['amount_used']){
			                	$table .= '
			                		<td style="color:red;">Item ID# '.$value['items_id'].'.'.$value['item_name'].' is insufficient! </td>';
			                	$y = 1;
			                }else{
			                	$table .= '<td style="color:green;">Clear</td>';
			                }
			                $table .= '<td rowspan="11" style="text-align: right">P'.$value['test_price'].'</td></tr>';
											$counter92--;
						}elseif (($value['test_id'] == 92 && $counter92 != 11) || ($value['test_id'] == 91 && $counter91 != 6)){
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
												$table .= '</tr>';
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
				}
			}

		}//foreach
		$table .= '</tbody>
							</table><hr>
							<h3><input type="text" style="width:100%; border: none; outline: none; background-color: transparent; text-align: right; font-weight: bold" readonly="true" id="total_price" value="Total: ₱ '.$total_price.'.00"/></h3>
					</div>
		';

		$modal .= '
			<div class="modal-body">
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
						<button type="button" class="btn btn-primary" data-toggle="modal" onclick="generateReceipt()" data-target="#viewRecPackage1Modal" id="viewRecPackageBtn">
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

		echo ($modal);
	}

	public function getInventoryHistory()
	{
		$result = array('data' => array());
		$inventoryHistoryData = $this->model_inventory->getInventoryHistory();

		if($inventoryHistoryData != null){

			foreach ($inventoryHistoryData as $key => $value) {
				date_default_timezone_set("Asia/Manila");
				$time=date('Y-m-d H:i:s',$value['new_update_date']);
				$new_updateby = $value['new_updateby'] . ' - ' . $value['fname'] . ' ' . $value['lname'];
				$result['data'][$key] = array(
					$value['items_id'],
					$value['quantity_old'],
					$value['quantity_new'],
					$value['quantity_summary'],
					$time,
					$new_updateby,
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
