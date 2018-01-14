<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

		function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('model_calendar');
    }


	/*Home page Calendar view  */
	Public function index()
	{
		$this->load->view('home');
	}

	/*Get all Events */

	Public function getEvents()
	{
		$result=$this->model_calendar->getEvents();
		echo json_encode($result);
	}
	/*Add new event */
	Public function addEvent()
	{
		$result=$this->model_calendar->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
		$result=$this->model_calendar->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->model_calendar->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{	

		$result=$this->model_calendar->dragUpdateEvent();
		echo $result;
	}



}
