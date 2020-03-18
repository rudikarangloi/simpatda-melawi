<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class surat_paksa extends MY_Controller {
	
	function __construct() {
            parent::__construct();
    }
	
	public function index() {
		$this->load->view('paksa/surat_paksa');
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " where surat_tegur.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
surat_tegur.id_surat_tegur,
surat_tegur.no_teguran,
DATE_FORMAT(surat_tegur.tgl_surat,'%d/%m/%Y') as tgl_surat,
surat_tegur.no_skpd,
DATE_FORMAT(surat_tegur.tgl_sk,'%d/%m/%Y') as tgl_sk,
surat_tegur.dasar_setoran,
surat_tegur.npwpd,
surat_tegur.tahun,
DATE_FORMAT(surat_tegur.tgl_jatuh_tempo,'%d/%m/%Y') as tgl_jatuh_tempo,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
surat_tegur.jumlah,
surat_tegur.denda,
surat_tegur.total
FROM
view_perusahaan
INNER JOIN surat_tegur ON surat_tegur.npwpd = view_perusahaan.npwpd_perusahaan $qr","id_surat_tegur","no_teguran, tgl_surat, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik");
	}
	
	function simpan(){
		$data = array(
			'tanggal' => strtoupper($this->input->post('tgl')),
			'no_surat_tegur' => strtoupper($this->input->post('no_teguran')),
			'tanggal_st' => strtoupper($this->input->post('tgl_st')),
			'no_sk' => strtoupper($this->input->post('no_sk')),
			'npwpd' => strtoupper($this->input->post('npwpd')),
			'penerima' => strtoupper($this->input->post('penerima')),
			'alamat_penerima' => strtoupper($this->input->post('alamat2')),
			'biaya_harian' => strtoupper($this->input->post('biaya')),
			'biaya_perjalanan' => strtoupper($this->input->post('cost')),
			'tahun' => date('Y'),
			'keterangan' => strtoupper($this->input->post('ket'))		
		);
		if($this->input->post('id')==0){
			$paksa = $this->generateNo(date('Y'));
			$dataIns = array_merge($data,array('nomor' => $paksa, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('surat_paksa',$dataIns);
			
		} else {
			$paksa = $this->input->post('nomor');
			$dataUpd = array_merge($data,array('nomor' => $paksa, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('surat_paksa', $dataUpd, array('id_surat_paksa' => $this->input->post('id')));
		}
		echo $paksa;
	}
	
	public function generateNo($thn=""){
		$sql = $this->db->query("select MAX(nomor) as max from surat_paksa where tahun = '".$thn."'")->row();
		$r = $sql->max;
		if($r==NULL){
			$no = '000000001';
		} else {
			$jml = $r + 1;
			if(strlen($jml)==1) {
				$jml = '00000000'.$jml;
			} else if(strlen($jml)==2) {
				$jml = '0000000'.$jml;
			} else if(strlen($jml)==3) {
				$jml = '000000'.$jml;
			} else if(strlen($jml)==4) {
				$jml = '00000'.$jml;
			} else if(strlen($jml)==5) {
				$jml = '0000'.$jml;
			} else if(strlen($jml)==6) {
				$jml = '000'.$jml;
			} else if(strlen($jml)==7) {
				$jml = '00'.$jml;
			} else if(strlen($jml)==8) {
				$jml = '0'.$jml;
			}
			$no = $jml;
		}
		return $no;
	}
	
	function loadData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
surat_paksa.id_surat_paksa,
surat_paksa.nomor,
surat_paksa.tanggal,
surat_paksa.no_surat_tegur,
surat_paksa.tanggal_st,
surat_paksa.no_sk,
surat_paksa.penerima,
surat_paksa.alamat_penerima,
surat_paksa.biaya_harian,
surat_paksa.biaya_perjalanan,
surat_paksa.keterangan,
surat_paksa.npwpd,
view_perusahaan.nama_perusahaan,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
view_perusahaan.alamat_perusahaan
FROM
view_perusahaan
INNER JOIN surat_paksa ON surat_paksa.npwpd = view_perusahaan.npwpd_perusahaan","id_surat_paksa","id_surat_paksa, nomor, tanggal, no_surat_tegur, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, tanggal_st, no_sk, penerima, alamat_penerima,biaya_harian,biaya_perjalanan,keterangan");
	}

}
?>