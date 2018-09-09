<?php

class Login_model extends CI_Model{

	function ValidaLogin()
	{
		
		
		
		$this->db->select('id,usuario,senha,status,nivel');
		$this->db->from('usuarios');
		$this->db->where('usuario', $this->input->post('usuario'));
		$this->db->where('senha', hash('sha512', $this->input->post('senha')));
		$this->db->where('status', '1');
		
		$query = $this->db->get();
		//$num = $query->row(1);
		$results = $query->row(1);
		//$result = $results->result();
		//var_dump($results);
		if($results)
		{
			return $results;
			
		}
		
	}

}

?>