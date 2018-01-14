<?php 

class Pages extends MY_Controller
{
	public function view($page = 'login')
	{
        if (!file_exists(APPPATH.'views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //print_r($page) ;

        if($page == 'setting') {
            $data['title'] = "Settings";
            $this->load->model('model_users');
            $this->load->library('session');
            $userId = $this->session->userdata('id');
            $data['userData'] = $this->model_users->fetchUserData($userId);
        }

        if($page == 'rcdash') {
            $data['title'] = "Dashboard";
        }

        if($page == 'coactivities') {
            $data['title'] = "Calendar of Activities";
        }

        if($page == 'mtdash') {
            $data['title'] = "Dashboard";
            $this->load->model('model_employee');
            $data['accountTypeData'] = $this->model_employee->getAllAccount();
        }

        if($page == 'add-employee') {
            $data['title'] = "Create";
            $this->load->model('model_employee');
            $data['accountTypeData'] = $this->model_employee->getAllAccount();
        }

        if($page == 'manage-employee') {
            $data['title'] = "Manage";
            $this->load->model('model_employee');
            $data['accountTypeData'] = $this->model_employee->getAllAccount();
        }

        if($page == 'tests') {
            $data['title'] = "Tests";
            $this->load->model('model_patient');
            $data['pensdingqueuesData'] = $this->model_patient->countTotalQueue();
            $data['activetransData'] = $this->model_patient->countTotalTransaction();
            $data['alltest'] = $this->model_patient->getAlltests();
        }

        if($page == 'sudashboard') {
            $data['title'] = "Dashboard";
            $this->load->model('model_patient');
            $this->load->model('model_employee');
            $this->load->model('model_inventory');
            $this->load->model('model_sales');

            $data['countTotalPatient'] = $this->model_patient->countTotalPatient();
            $data['countTotalEmployee'] = $this->model_employee->countTotalEmployee();  
            $data['countTotalItems'] = $this->model_inventory->countTotalItems();
            $data['countTotalSalesToday'] = $this->model_sales->countTotalSalesToday();              
            $data['countTotalSales'] = $this->model_sales->TotalSales();        
            $data['countTotalPatientToday'] = $this->model_sales->countTotalPatientToday();           
        }  

        if($page == 'sales') {
            $data['title'] = "Sales";
            $this->load->model('model_sales');
            $data['countTotalSales'] = $this->model_sales->TotalSales();                       
        }  

        if($page == 'login') {
            $data['title'] = "Login";
            $this->isLoggedIn();
            $this->load->view($page, $data);
        } 
        else{
            $this->isNotLoggedIn();

            $this->load->view('templates/header', $data);
            $this->load->view($page, $data);    
            $this->load->view('templates/footer', $data);    
        }
	}
    
}