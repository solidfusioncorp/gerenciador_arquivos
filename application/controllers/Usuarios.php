<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function __CONSTRUCT(){
		parent::__CONSTRUCT();
		
		$this->load->model('crud_model');
		$this->load->model('usuario_model');
		
	}
	
	public function index()	{
date_default_timezone_set("Brazil/East");
		
		$dados = array (
			'usuario' 		=> $this->input->post('usuario'),
			'senha' 		=> hash('sha512', $this->input->post('senha')),
			'status' 		=> $this->input->post('status'),
			'nivel' 		=> $this->input->post('nivel'),			
			
		);
		
		
		if($this->input->post('action') == 'cadastrar'){
			$tabela = 'usuarios';			
			$this->crud_model->inserir($tabela, $dados);
						
			redirect('upload');
			
		} elseif($this->input->post('action') == 'editar'){			
			$tabela = 'usuarios';
			$where = $this->db->where('id', $this->input->post('id'));
			$id = $this->input->post('id');
			$this->crud_model->atualizar($tabela, $dados, $id);
			
			redirect('usuarios/visualizar/'.$this->input->post('id'));
		}	
	}
	
	public function cadastrar()	{
		
		$dados['pagina'] = 'Cadastrar Usu&aacute;rio';
		$dados['pdv'] = $this->usuario_model->verificaPDV();
		$dados['user'] = $this->usuario_model->verificaEmail($this->session->userdata('login'));
		
		$config 			= $this->crud_model->listar('config WHERE id = 1');
		$dados['config'] 	= $config[0];
		$dados['caixa']	= $this->crud_model->listar_caixa_aberto();
		
		$this->load->view('header', $dados);				
		$this->load->view('usuarios/cadastrar');
		$this->load->view('footer');
		
	}
	
	public function visualizar()	{
		
		$dados['pagina'] = 'Visualizar Usu&aacute;rio';
		$dados['pdv'] = $this->usuario_model->verificaPDV();
		$dados['user'] = $this->usuario_model->verificaEmail($this->session->userdata('login'));
		
		$config 			= $this->crud_model->listar('config WHERE id = 1');
		$dados['config'] 	= $config[0];
		$dados['caixa']	= $this->crud_model->listar_caixa_aberto();
		
		$this->load->view('header', $dados);
		$dados = array();	
        $dados['lista'] = $this->crud_model->listar('usuarios WHERE id='.$this->uri->segment(3));				
		$this->load->view('usuarios/visualizar', $dados);
		$this->load->view('footer');
		
	}
	
	public function editar()	{
		
		$dados['pagina'] = 'Editar Usu&aacute;rio';
		$dados['pdv'] = $this->usuario_model->verificaPDV();
		$dados['user'] = $this->usuario_model->verificaEmail($this->session->userdata('login'));
		
		$config 			= $this->crud_model->listar('config WHERE id = 1');
		$dados['config'] 	= $config[0];
		$dados['caixa']	= $this->crud_model->listar_caixa_aberto();
		
		$this->load->view('header', $dados);
		$dados = array();	
        $dados['lista'] = $this->crud_model->listar('usuarios WHERE id='.$this->uri->segment(3));				
		$this->load->view('usuarios/editar', $dados);
		$this->load->view('footer');
		
	}
	
	public function salvar(){
		
		date_default_timezone_set("Brazil/East");
		
		$dados = array (
			'nome' 			=> $this->input->post('nome'),
			'usuario' 		=> $this->input->post('usuario'),
			'telefone' 		=> $this->input->post('telefone'),
			'celular' 		=> $this->input->post('celular'),
			'senha' 		=> hash('sha512', $this->input->post('senha')),
			'status' 		=> $this->input->post('status'),
			'notas' 		=> $this->input->post('notas'),			
			'data_registro'	=> date('d/m/Y h:i:s')
		);
		
		
		if($this->input->post('action') == 'cadastrar'){
			$tabela = 'usuarios';			
			$this->crud_model->inserir($tabela, $dados);
						
			redirect('usuarios/index');
			
		} elseif($this->input->post('action') == 'editar'){			
			$tabela = 'usuarios';
			$where = $this->db->where('id', $this->input->post('id'));
			$id = $this->input->post('id');
			$this->crud_model->atualizar($tabela, $dados, $id);
			
			redirect('usuarios/visualizar/'.$this->input->post('id'));
		}
	
	}
	
	public function remover(){
		
		$id	= $this->uri->segment(3);	
		
		$this->crud_model->remover($id,'usuarios');
		
		redirect('usuarios/index');
	}
	
	public function registro()
	{		
		$this->load->view('usuario/registro_view');
	}
		
	function gera_pass(){
		$CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyz0123456789'; 
		$max = strlen($CaracteresAceitos)-1;
		$password = null;
		for($i=0; $i < 6; $i++) { 
			$password .= $CaracteresAceitos{mt_rand(0, $max)}; 
		}
		return $password;
	}
	
	function check_user_logged(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('login');
		}
	}

}

?>