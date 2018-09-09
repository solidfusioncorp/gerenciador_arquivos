<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Valida extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
       }
	   
	
	public function index(){	
		$this->load->model('login_model');
		$query = $this->login_model->ValidaLogin();
		$usuario = $this->input->post('usuario');
		//$senha = hash('sha512', $this->input->post('senha'));

		//var_dump($senha);
		
		if($query != null){
			$data = array(
				'login' => $this->input->post('usuario'),
				'nivel' => $query->nivel,
				'id' => $query->id,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			
			redirect('upload');
		} else {
			redirect('login');
			//var_dump($data);
		}
	
	}
	
	}

?>