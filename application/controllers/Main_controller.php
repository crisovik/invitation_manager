<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Data_model');
    }

	public function index()
	{
    $variables['title'] = 'Hola';

		$this->load->view('layout/head', $variables);
    $this->load->view('layout/footer');
	}

	public function content()
	{
    $variables['title'] = 'Hola';

		$this->load->view('layout/head', $variables);
		$this->load->view('content/content');
    $this->load->view('layout/footer');
	}

	public function insert_guest(){
		$data['name'] = $_POST['name'];
		echo json_encode($data);
		//$this->Data_model->insert_guest();
	}

	public function get_guest(){
		echo json_encode($this->Data_model->get_guest());
	}
}
