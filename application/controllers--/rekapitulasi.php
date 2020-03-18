<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class rekapitulasi extends CI_Controller {
	
	function __construct() {
            parent::__construct();
            //$this->load->model('msistem');
    }
	
	public function index() {		
		$this->load->view('rekapitulasi_pajak/rekapitulasi');
	}
	
	function data($pajak){
		$data['kecamatan']=$this->db->query("select id,kode_kecamatan, nama_kecamatan from kecamatan");
		$data['kelurahan']=$this->db->query("select id,kode_kelurahan,nama_kelurahan from kelurahan");
		if($pajak=='P1'){
			$this->load->view('rekapitulasi_pajak/rekapitulasi_view',$data);
		}
	}
	
	function potensi($kec="", $kel=""){		
		$data['kec'] = $kec;
		$data['kel'] = $kel;
		$data['type'] = "";
		$this->load->view('rekapitulasi_pajak/rekapitulasi_view', $data);
				
	}
		
	public function loadKec()
    {
        $sql = "SELECT * FROM kecamatan";
        $qr = $this->db->query($sql)->result();
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $row) {
            $s .= "<option value=\"$row->kode_kecamatan\"><![CDATA[" . $row->nama_kecamatan . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
	
	public function loadKel($kec="")
    {
        $sql = "SELECT * FROM kelurahan WHERE kode_kecamatan='$kec'";
        $qr = $this->db->query($sql)->result();
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $row) {
            $s .= "<option value=\"$row->kode_kelurahan\"><![CDATA[" . $row->nama_kelurahan . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
	
	function toexcel($kec="", $kel=""){
		$data['kec'] = $kec;
		$data['kel'] = $kel;
		$data['type'] = "excel";
		$this->load->view('rekapitulasi_pajak/rekapitulasi_view',$data);
				
	}
	
}
?>