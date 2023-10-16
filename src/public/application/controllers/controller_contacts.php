<?php

class Controller_contacts extends Controller
{

	function __construct()
	{
		$this->model = new Model_contacts();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->get_data();		
		$this->view->generate('contacts_view.php', 'template_view.php', $data);
	}
}