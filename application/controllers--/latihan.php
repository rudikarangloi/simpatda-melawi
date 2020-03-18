<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class latihan extends MY_Controller {
	
	public function index() {
	}
	
	public function coba() {
		$this->load->view('latihan/view_latihan');
	}
}