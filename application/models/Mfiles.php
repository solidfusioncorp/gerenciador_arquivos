<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mfiles extends CI_Model{

    public function getRows($id,$id2){
       // $this->db->select('id,file_name,created,modified,status');
        $this->db->select('*');
        $this->db->from('files');
        $this->db->join('usuarios', 'files.id_user = usuarios.Id');
        $this->db->where('files.id_user = '.$id2);
        if($id != null){
            //$this->db->where('id',$id);
            
            $this->db->where('files.id',$id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('created','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }

    public function listar(){
       // $this->db->select('id,file_name,created,modified,status');
        $this->db->select('*');
        $this->db->from('usuarios');
     
            $this->db->order_by('id','desc');
            $query = $this->db->get();
            $result = $query->result_array();
       
        return !empty($result)?$result:false;
    }
    
    public function insert($data = array()){
        $insert = $this->db->insert_batch('files',$data);
        return $insert?true:false;
    }
    
}