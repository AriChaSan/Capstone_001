<?php 

class Sales extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();
		$this->load->library('form_validation');
     	$this->load->helper('form');

		// <!! IMPORTANT!! >
		$this->load->model('model_sales');
		
	}

	public function getTotalSales()
	{
		$sales = $this->model_sales->countTotalSales();
		$result = array('data' => array());
		//var_dump($sales);
		if($sales != null){
				foreach ($sales as $key => $value) {
					
					date_default_timezone_set("Asia/Manila");
					$time=date('Y-m-d H:i:s',$value['created_At']); 
					$amount = $value['amount'];
					//var_dump(is_float($amount));
					if(is_float($amount) === false){
						$amount = $amount . '.00';
					}
					$result['data'][$key] = array(
						$value['id'],
						$time,
						$amount,
					);
				} // /froeach
			}
			//var_dump($result);
		echo json_encode($result);	
	}
}