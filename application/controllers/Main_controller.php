<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Data_model');
    }

	public function index() {
    $variables['title'] = 'Hola';

		$this->load->view('layout/head', $variables);
    	$this->load->view('layout/footer');
	}

	public function content() {
    $variables['title'] = 'Hola';

		$this->load->view('layout/head', $variables);
		$this->load->view('content/content');
    	$this->load->view('layout/footer');
	}

	public function add_guest() {
    $variables['title'] = 'Agregar invitados';

		$this->load->view('layout/head', $variables);
		$this->load->view('content/addGuest');
    	$this->load->view('layout/footer');
	}

	public function insert_guest() {
		$data = $_POST;
		$link = word_limiter($data['guest'], 1, '').random_string('alnum', 8);

		$guest = array(
			'name' => $data['guest'],
			'confirmed' => false,
			'link' => $link
		);
		$id_guest = $this->Data_model->insert_guest($guest);

		if (count($data) > 1) {
			foreach ($data['companion'] as $comp) {
				$companion = array(
					'name' => $comp,
					'confirmed' => false
				);
				$this->Data_model->insert_companion($companion, $id_guest);
			}
		}
	}

	public function view_guests() {
		$variables['title'] = 'Lista de invitados';

		$guests['total'] = $this->Data_model->get_total_guests()[0]->total_guests;
		$guests['confirmed'] = $this->Data_model->get_total_confirmed()[0]->total_confirmed;

		$guests['guests'] = array();

		foreach ($this->Data_model->get_guests() as $guest) {
			$total = 1;
			$confirmed = 0;
			$class = '';
			if ($guest->confirmed == 1) {
				$confirmed++;
				$class = 'confirmed';
			}

			$companions = array();
			foreach ($this->Data_model->get_companion($guest->id_g) as $companion) {
				$class_comp = '';

				$total++;
				if($companion->confirmed == 1) {
					$confirmed++;
					$class_comp = 'confirmed';
				}

				array_push($companions, array(
					'name' => $companion->name,
					'confirmed' => $class_comp
				));
			}

			array_push($guests['guests'], array(
				'id_g' => $guest->id_g,
				'name' => $guest->name,
				'confirmed' => $class,
				'total' => $total,
				'total_confirmed' => $confirmed,
				'companion' => $companions
			));
		}

		$this->load->view('layout/head', $variables);
		$this->load->view('content/viewGuests', $guests);
    	$this->load->view('layout/footer');
	}

	public function confirm_guests() {
		$variables['title'] = 'Confirmar invitados';

		//Get from cookies
		$id_g = 1;
		$data['guest'] = $this->Data_model->get_guest($id_g);
		$data['companions'] = $this->Data_model->get_guest_companion($id_g);
		$data['total_confirmed'] = $this->Data_model->get_guest_confirmed($id_g)[0]->total_confirmed;
		$data['total'] = count($data['companions']) + 1;
		
		$this->load->view('layout/head', $variables);
		$this->load->view('content/confirmGuests', $data);
    	$this->load->view('layout/footer');
	}

	public function set_confirmations() {
		$data = $_POST['confirmations'];

		$this->Data_model->set_guest_confirmation($data[0][0], $data[0][1]);

		if(count($data) > 1){
			for ($i=1; $i < count($data); $i++) { 
				$this->Data_model->set_companion_confirmation($data[$i][0], $data[$i][1]);
			}		
		}
	}
}
