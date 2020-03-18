<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class data_potensi extends CI_Controller {
	
	function __construct() {
            parent::__construct();
            //$this->load->model('msistem');
    }
	
	public function index() {		
		$this->load->view('analisa_hitung/index');
	}
	
	function data($pajak){
	$data['kecamatan']=$this->db->query("select id,kode_kecamatan, nama_kecamatan from kecamatan");
	$data['kelurahan']=$this->db->query("select id,kode_kelurahan,nama_kelurahan from kelurahan");
		if($pajak=='P1'){
			$this->load->view('data_potensi/hotel',$data);
		}
		else if($pajak=='P2'){
			$this->load->view('data_potensi/restoran',$data);
		}
		else if($pajak=='P3'){
			$this->load->view('data_potensi/reklame',$data);
		}
		else if($pajak=='P4'){
			$this->load->view('data_potensi/hiburan',$data);
		}
		 else if($pajak=='P5'){
			$this->load->view('data_potensi/mineral',$data);
		} 
		 else if($pajak=='P6'){
			$this->load->view('data_potensi/penerangan',$data);
		}
		 else if($pajak=='P7'){
			$this->load->view('data_potensi/walet',$data);
		}  
		else if($pajak=='P8'){
			$this->load->view('data_potensi/parkir',$data);
		} 
		else if($pajak=='P9'){
			$this->load->view('data_potensi/air',$data);
		}
	}
	
	function potensi($pajak, $kec="", $kel=""){		
		$data['kec'] = $kec;
		$data['kel'] = $kel;
		$data['type'] = "";
		if($pajak=="hotel"){
			$this->load->view('data_potensi/hotel_view', $data);
		} else if($pajak=="restoran"){
			$this->load->view('data_potensi/restoran_view', $data);
		} 
		else if($pajak=="reklame"){
			$this->load->view('data_potensi/reklame_view', $data);
		}
		else if($pajak=="hiburan"){
			$this->load->view('data_potensi/hiburan_view', $data);
		}
		else if($pajak=="mineral"){
			$this->load->view('data_potensi/mineral_view', $data);
		}
		 else if($pajak=="penerangan"){
			$this->load->view('data_potensi/penerangan_view', $data);
		}
		 else if($pajak=="walet"){
			$this->load->view('data_potensi/walet_view', $data);
		}
		 else if($pajak=="parkir"){
			$this->load->view('data_potensi/parkir_view', $data);
		}
		else if($pajak=="air"){
			$this->load->view('data_potensi/air_view', $data);
		}
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
	
    public function loadSkpd()
    {
        $sql = "SELECT * FROM master_skpd2";
        $qr = $this->db->query($sql)->result();
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $row) {
            $s .= "<option value=\"$row->kd_skpd\"><![CDATA[" . $row->nama_skpd . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
    
	function toexcel($pajak="", $kec="", $kel=""){
	$data['kec'] = $kec;
	$data['kel'] = $kel;
	$data['type'] = "excel";
		if($pajak=="hotel"){
			$this->load->view('data_potensi/hotel_view',$data);
		} else if($pajak=="restoran"){
			$this->load->view('data_potensi/restoran_view',$data);
		}
		else if($pajak=="reklame"){
			$data['type'] = "excel";
			$this->load->view('data_potensi/reklame_view',$data);
		}
		else if($pajak=="hiburan"){
			$data['type'] = "excel";
			$this->load->view('data_potensi/hiburan_view',$data);
		}
		else if($pajak=="mineral"){
			$this->load->view('data_potensi/mineral_view',$data);
		}
		else if($pajak=="penerangan"){
			$this->load->view('data_potensi/penerangan_view',$data);
		} 
		else if($pajak=="walet"){
			$this->load->view('data_potensi/walet_view',$data);
		}
		else if($pajak=="parkir"){
			$this->load->view('data_potensi/parkir_view',$data);
		}
		else if($pajak=="air"){
			$this->load->view('data_potensi/air_view',$data);
		}
	}
	
}
?>