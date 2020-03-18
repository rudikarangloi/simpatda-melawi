<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class proyeksi_realisasi extends CI_Controller {
	
	function __construct() {
            parent::__construct();
            //$this->load->model('msistem');
    }
	
	public function index() {	
		$data['tahun'] = $this->msistem->tahun();	
		$this->load->view('proyeksi_realisasi/index',$data);
	}
	
	function returntahun(){
		return $_POST['tahunnya'];
	}
	
	function view(){
		$data['thn'] = $_POST['tahun'];	
		$this->load->view('proyeksi_realisasi/view',$data);
	}
	
	
}
?>