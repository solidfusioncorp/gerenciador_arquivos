<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('mfiles');
    }

    function index(){
        $id = null;
        $id1 = $this->input->post('user');
        $data = array();
        if($this->input->post('mysubmit') && !empty($_FILES['myfiles']['name'])){

            $filesCount = count($_FILES['myfiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['myfile']['name'] = $_FILES['myfiles']['name'][$i];
                $_FILES['myfile']['type'] = $_FILES['myfiles']['type'][$i];
                $_FILES['myfile']['tmp_name'] = $_FILES['myfiles']['tmp_name'][$i];
                $_FILES['myfile']['error'] = $_FILES['myfiles']['error'][$i];
                $_FILES['myfile']['size'] = $_FILES['myfiles']['size'][$i];

                $upload_path = './upload/';
                if ( ! is_dir($upload_path)) {
        mkdir($upload_path, 0777, $recursive = true);
    }
                $config['upload_path'] = $upload_path;
               // $config['allowed_types'] = 'gif|jpg|png|webp|pdf|zip|xps|oxps|txt';
                //$config['allowed_types'] = '*';
                
                $ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['myfile']['name']);
                $fileType=$_FILES['myfile']['type'];
                $config['allowed_types'] = $ext.'|'.$fileType;


                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('myfile')){
                    $fileData = $this->upload->data();
                    $upload_data[$i]['file_name'] = $fileData['file_name'];
                    $upload_data[$i]['created'] = date("Y-m-d H:i:s");
                    $upload_data[$i]['modified'] = date("Y-m-d H:i:s");
                    $upload_data[$i]['id_user'] = $id1;
                }
            }
            
            if(!empty($upload_data)){
                $insert = $this->mfiles->insert($upload_data);
                $msg_info = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('msg_info',$msg_info);
            }
        }
        $id2 = $this->session->userdata('id');
        $data['files'] = $this->mfiles->getRows($id,$id2);
        $data['users'] = $this->mfiles->listar();
        $this->load->view('view_files', $data);
    }

}