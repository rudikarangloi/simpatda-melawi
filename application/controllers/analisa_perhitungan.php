<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class analisa_perhitungan extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {		
		$this->load->view('analisa_hitung/index');
	}
	
	
}
?>
	
	