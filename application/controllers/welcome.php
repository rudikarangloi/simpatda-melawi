<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		
		//Tambah baris
	}
	
	public function test() {
		$id = '37';
		// load library PDF   
		$this->load->library('header/header_output');
		$pdf = new header_output('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Preview_'.$id);
	
		// set informasi dokumen
		$pdf->SetSubject('Inprase');
		$pdf->SetKeywords('inprase');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(20);
		$pdf->SetMargins(50,110,50);
		// set font yang digunakan
		$pdf->SetFont('times', '', 12);
	
		$pdf->AddPage('P','LEGAL',false);
		// data
		$query = $this->db->query("select isi from master_template where id='".$id."'");
		$rs = $query->row();
			
		$html = $rs->isi;
		$pdf->writeHTML($html, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('preview_'.$id.'.pdf', 'I');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */