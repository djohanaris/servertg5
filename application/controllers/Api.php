<?php

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	function __construct($config = 'rest'){
		parent::__construct($config);
	}

function aktif_studis_get(){
	$id = $this->get('id');
	if ($id){
		$aktif_studi = $this->db->get_where('aktif_studi',
			array('Id' => $id))->result();
	} else {
		$aktif_studi = $this->db->get('aktif_studi')->result();
	}
	if($aktif_studi){
		$this->response($aktif_studi,200);
	} else {
		$this->response(array('status'=>'not found'),404);
	}
}

function aktif_studis_post(){
	$params = array(
		'Nama' => $this->post('nama'),
		'Nim' => $this->post('nim'),
		'Fakultas' => $this->post('fakultas'),
		'Progdi' => $this->post('progdi'));
	$process = $this->db->insert('aktif_studi', $params);
	if($process){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function aktif_studis_put(){
	$params = array(
		'Nama' => $this->put('nama'),
		'Nim' => $this->put('nim'),
		'Fakultas' => $this->put('fakultas'),
		'Progdi' => $this->put('progdi'));
	$this->db->where('Id', $this->put('id'));
	$execute = $this->db->update('aktif_studi', $params);
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function aktif_studis_delete(){
	$this->db->where('Id', $this->delete('id'));
	$execute = $this->db->delete('aktif_studi');
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}
}
?>