<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('mfiles');
        $this->load->helper('download');
    }

    function index(){
        $id = $this->uri->segment(3);
        if (empty($id)){
            redirect(base_url());
        }
        $id2 = $this->session->userdata('id');
        $data = $this->mfiles->getRows($id,$id2);
        $filename =$data['file_name'];
        //$fileContents = file_get_contents(base_url('upload/'. $data['file_name'])); 

$url = base_url('upload/'. $data['file_name']);
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

        force_download($filename, $contents);
    }
}