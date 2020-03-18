<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class analisa extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['thn'] = date('Y');
		$this->load->view('analisa/index',$data);
	}
	
	public function editData($idpajak="",$npwpd="") {
		$data['npwpd'] = $npwpd;
		if($idpajak=='C1'):
			$this->load->view('analisa/hotel',$data);
		endif;
		if($idpajak=='C2'):
			$this->load->view('analisa/restoran',$data);
		endif;
		if($idpajak=='C3'):
			$this->load->view('analisa/reklame',$data);
		endif;
		if($idpajak=='C4'):
			$this->load->view('analisa/hiburan',$data);
		endif;
		if($idpajak=='C5'):
			$this->load->view('analisa/penerangan',$data);
		endif;
		if($idpajak=='C6'):
			$this->load->view('analisa/mineral',$data);
		endif;
		if($idpajak=='C7'):
			$this->load->view('analisa/burung_walet',$data);
		endif;
		if($idpajak=='C8'):
			$this->load->view('analisa/parkir',$data);
		endif;
		if($idpajak=='C9'):
			$this->load->view('analisa/airtanah',$data);
		endif;
	}
	
	public function openData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.npwpd,b.nama_perusahaan,b.alamat_perusahaan,a.hotel,a.restoran,a.reklame,a.hiburan,a.penerangan_jalan,a.mineral,a.bwalet,a.parkir,a.airtanah,a.tahun from mp_header a inner join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan","id","npwpd,nama_perusahaan,alamat_perusahaan,hotel,restoran,reklame,hiburan,penerangan_jalan,mineral,bwalet,parkir,airtanah,tahun");	
	}
	
	public function dataPerusahaan($op="",$nilai="") {
		if($op==1){
			$cu = "where npwpd_perusahaan like '%".$nilai."%'";
		} else if($op==2){
			$cu = "where nama_perusahaan like '%".$nilai."%'";
		} else if($op==3){
			$cu = "where nama_pemilik like '%".$nilai."%'";
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.npwpd_perusahaan,a.nama_perusahaan,a.nama_pemilik,a.alamat_perusahaan,b.hotel,b.restoran,b.reklame,b.hiburan,b.penerangan_jalan,b.mineral,b.bwalet,b.parkir,b.airtanah,b.tahun from identitas_perusahaan a left join mp_header b on a.npwpd_perusahaan=b.npwpd $cu","id","npwpd_perusahaan,nama_perusahaan,alamat_perusahaan,nama_pemilik,hotel,restoran,reklame,hiburan,penerangan_jalan,mineral,bwalet,parkir,airtanah,tahun");	
	}
	
	// hotel - kode:F 
	public function C1() {
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/hotel', $data);
	}
	
	//restoran - kode:C
	public function C2() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/restoran',$data);
	}
	
	//reklame - kode:E
	public function C3() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/reklame',$data);
	}
	
	//hiburan - kode:G
	public function C4() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/hiburan',$data);
	}
	
	//penerangan - kode:H
	public function C5() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/penerangan',$data);
	}
	
	//mineral kode:I
	public function C6() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/mineral',$data);
	}
	
	//B.Walet - kode:D
	public function C7() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/burung_walet',$data);
	}
	
	//parkir - kode:A
	public function C8() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/parkir',$data);
	}
	
	//parkir - kode:B
	public function C9() { 
		$data['dtTgl'] = date('Y-m-d h:i:s');
		$data['strNoUrut'] = '';
		$data['username'] = strtoupper($this->session->userdata('username'));
		$this->load->view('analisa/airtanah',$data);
	}
	
	
	function generateNo($kode_pajak='',$table='') {
		$bln = date('m');
		$thn = date('y');
		$no_urut = '';
		
		$sql = $this->db->query("select MAX(CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(koderec,'.',2), '.', -1),UNSIGNED INTEGER)) as jml from $table where DATE_FORMAT(created,'%Y') = '".date('Y')."' and DATE_FORMAT(created,'%m') = '".date('m')."' ");
		$rs = $sql->row();
		$jml = $rs->jml + 1;
		
		if(strlen($jml)==1) {
			$no_urut = '000'.$jml;	
		} else if(strlen($jml)==2) {
			$no_urut = '00'.$jml;
		} else if(strlen($jml)==3) {
			$no_urut = '0'.$jml;	
		} else if(strlen($jml)==4) {
			$no_urut = $jml;	
		}
		$no_trx = $kode_pajak.'.'.$no_urut.'.'.$bln.$thn;
		return $no_trx;
	}
	
	
	function simpan_retoran(){
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'rata2omset' => $this->input->post('txtrata2_resto'),
				'ket' => $this->input->post('txtket_resto'),
				'jml_meja' => $this->input->post('txtjml_meja_resto'),
				'jml_kursi' => $this->input->post('txtjml_kursi_resto'),
				'jml_pegawai' => $this->input->post('txtjml_pegawai_resto')
		);
		if($this->input->post('no_trx_resto')=="") {
			$no_trans = $this->generateNo('C','mp_restoran');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_restoran",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trx_resto');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_restoran",$dataUpd,array('koderec' => $no_trans));
		}
		echo '<script language="javascript">window.parent.document.frmAns.no_trx_resto.value="'.$no_trans.'"</script>';
	}
	
	function simpan_hiburan(){
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'rata2omset' => $this->input->post('txtrata2_hiburan'),
				'ket' => $this->input->post('txtket_hiburan'),
				'jml_kamar' => $this->input->post('txtjml_kamar_hiburan'),
				'jml_meja' => $this->input->post('txtjml_meja_hiburan'),
				'jml_mesin' => $this->input->post('txtjml_mesin_hiburan'),
				'jml_studio' => $this->input->post('txtjml_studio_hiburan'),
				'jml_kursi' => $this->input->post('txtjml_kursi_hiburan'),
				'jml_pegawai' => $this->input->post('txtjml_mesin_hiburan'),
				'tarif' => $this->input->post('txttarif_hiburan')
		);
		if($this->input->post('no_trx_hiburan')=="") {
			$no_trans = $this->generateNo('G','mp_hiburan');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_hiburan",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trx_hiburan');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_hiburan",$dataUpd,array('koderec' => $no_trans));
		}
		
		echo '<script language="javascript">window.parent.document.frmAns.no_trx_hiburan.value="'.$no_trans.'"</script>';
	}
	
	function simpan_walet(){
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'rata2omset' => $this->input->post('txtrata2_walet'),
				'ket' => $this->input->post('txtket_walet'),
				'jml_wilayah' => $this->input->post('txtjml_wilayah_walet'),
				'jml_sarang' => $this->input->post('txtjml_sarang_walet'),
				'tarif' => $this->input->post('txttarif_walet')
		);
		if($this->input->post('no_trx_walet')=="") {
			$no_trans = $this->generateNo('D','mp_walet');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_walet",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trx_walet');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_walet",$dataUpd,array('koderec' => $no_trans));
		}
		
		echo '<script language="javascript">window.parent.document.frmAns.no_trx_walet.value="'.$no_trans.'"</script>';
	}
	
	function simpan_mineral(){
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'rata2omset' => $this->input->post('txtrata2_mineral'),
				'ket' => $this->input->post('txtket_mineral'),
				'volume' => $this->input->post('txtvolume_mineral'),
				'tarif' => $this->input->post('txttarif_mineral')
		);
		if($this->input->post('no_trx_mineral')=="") {
			$no_trans = $this->generateNo('I','mp_mineral');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_mineral",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trx_mineral');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_mineral",$dataUpd,array('koderec' => $no_trans));
		}
		
		echo '<script language="javascript">window.parent.document.frmAns.no_trx_mineral.value="'.$no_trans.'"</script>';
	}
	
	function simpan() {
		$aC1 = explode("|",$this->input->post('C1'));
		$aC2 = explode("|",$this->input->post('C2'));
		$aC3 = explode("|",$this->input->post('C3'));
		$aC4 = explode("|",$this->input->post('C4'));
		$aC5 = explode("|",$this->input->post('C5'));
		$aC6 = explode("|",$this->input->post('C6'));
		$aC7 = explode("|",$this->input->post('C7'));
		$aC8 = explode("|",$this->input->post('C8'));
		$aC9 = explode("|",$this->input->post('C9'));
		$dataMaster = array (
				'npwpd' => $this->input->post('npwpd'),
				'tahun' => $this->input->post('tahun'),
				'hotel' => $aC1[0],
				'restoran' => $aC2[0],
				'reklame' => $aC3[0],
				'hiburan' => $aC4[0], 
				'penerangan_jalan' => $aC5[0],
				'mineral' => $aC6[0],
				'bwalet' => $aC7[0],
				'parkir' => $aC8[0],
				'airtanah' => $aC9[0]
		);
		$sql = $this->db->query("select npwpd from mp_header where npwpd = '".$this->input->post('npwpd')."' AND tahun = '".$this->input->post('tahun')."' ");
		if(count($sql->result())==0) {
			$this->db->insert("mp_header",$dataMaster);
		} else {
			$this->db->update("mp_header",$dataMaster,array('npwpd'=>$this->input->post('npwpd'),'tahun'=>$this->input->post('tahun')));
		}
		if($this->input->post('C1') != "") {
			$this->simpanHotel();
		} else {
			$this->deleteHotel();
		}
		if($this->input->post('C2') != "") {
			$this->simpan_retoran();
		} else {
			$this->deleteRestoran();
		}
		if($this->input->post('C3') != "") {
			$this->simpanReklame();
		} else {
			$this->deleteReklame();
		}
		if($this->input->post('C4') != "") {
			$this->simpan_hiburan();
		} else {
			$this->deleteHiburan();
		}
		
		if($this->input->post('C6') != "") {
			$this->simpan_mineral();
		} else {
			$this->deleteMineral();
		}
		if($this->input->post('C7') != "") {
			$this->simpan_walet();			
		} else {
			$this->deleteWalet();
		}
		
		if($this->input->post('C5') != "") {
			$this->simpanPenerangan();
		} else {
			$this->deletePenerangan();
		}
		
		
		
		if($this->input->post('C8') != "") {
			$this->simpanParkir();
		} else {
			$this->deleteParkir();
		}
		if($this->input->post('C9') != "") {
			$this->simpanAirTanah();
		} else {
			$this->deleteAirTanah();
		}
		echo '<script language="javascript">
		parent.statusEnding();
		alert("selesai");
		</script>';
	}
	
	// Parkir
	function simpanParkir() {
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'luas_area_p' => $this->input->post('luas_p'),
				'luas_area_l' => $this->input->post('luas_l'),
				'vol_mobil' => $this->input->post('vol_mobil'),
				'vol_motor' => $this->input->post('vol_motor'), 
				'tarif' => $this->input->post('tarif'),
				'tingkat_kunjungan' => $this->input->post('tingkat_kunjungan'),
				'jml_pegawai' => $this->input->post('jml_pegawai'),
				'rata2omzet' => $this->input->post('rata2omzet'),
				'ket' => $this->input->post('ket')
		);
		if($this->input->post('no_trxParkir')=="") {
			$no_trans = $this->generateNo('A','mp_parkir');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_parkir",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trxParkir');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_parkir",$dataUpd,array('koderec' => $no_trans));
		}
		echo '<script language="javascript">window.parent.document.frmAns.no_trxParkir.value="'.$no_trans.'"</script>';
	}
	
	function deleteParkir() {
		if($this->input->post('no_trxParkir') != ""):
			$this->db->delete("mp_parkir",array('koderec' => $this->input->post('no_trxParkir')));
		endif;
	}
	
	// Air Tanah
	function simpanAirTanah() {
		$data = array (
				'npwpd' => $this->input->post('npwpd'),
				'jml_titik_sumur' => $this->input->post('titik_sumur'),
				'meteran' => $this->input->post('meteran'),
				'tarif_air' => $this->input->post('tarif_air'),
				'rata2pemakaian' => $this->input->post('rata2pemakaianAir'), 
				'jns_air' => $this->input->post('jns_sumur'),
				'ket' => $this->input->post('ket')
		);
		if($this->input->post('no_trxAirTanah')=="") {
			$no_trans = $this->generateNo('A','mp_parkir');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_airtanah",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trxAirTanah');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_airtanah",$dataUpd,array('koderec' => $no_trans));
		}
		echo '<script language="javascript">window.parent.document.frmAns.no_trxAirTanah.value="'.$no_trans.'"</script>';
	}
	
	function deleteAirTanah() {
		if($this->input->post('no_trxAirTanah') != ""):
			$this->db->delete("mp_airtanah",array('koderec' => $this->input->post('no_trxAirTanah')));
		endif;
	}
	
	function deleteRestoran() {
		if($this->input->post('no_trx_resto') != ""):
			$this->db->delete("mp_restoran",array('koderec' => $this->input->post('no_trx_resto')));
		endif;
	}
	
	function deleteHiburan() {
		if($this->input->post('no_trx_hiburan') != ""):
			$this->db->delete("mp_hiburan",array('koderec' => $this->input->post('no_trx_hiburan')));
		endif;
	}
	
	function deleteWalet() {
		if($this->input->post('no_trx_walet') != ""):
			$this->db->delete("mp_walet",array('koderec' => $this->input->post('no_trx_walet')));
		endif;
	}
	
	function deleteMineral() {
		if($this->input->post('no_trx_mineral') != ""):
			$this->db->delete("mp_mineral",array('koderec' => $this->input->post('no_trx_mineral')));
		endif;
	}
	
	// Hotel
	function simpanHotel() {
		$data = array (
				'npwpd' => $this->input->post('npwpd'),				
				'ket' => $this->input->post('ket')
		);
		if($this->input->post('no_trxhtl')=="") {
			$no_trans = $this->generateNo('F','mp_hotel');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_hotel",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trxhtl');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_hotel",$dataUpd,array('koderec' => $no_trans));
			$this->db->delete("mp_hotel_detail",array('koderec' => $this->input->post('no_trxhtl')));
		}
		echo '<script language="javascript">
				window.parent.document.frmAns.no_trxhtl.value="'.$no_trans.'"	
				parent.tmpRows();			
			</script>';		
	}
	
	function deleteHotel() {
		if($this->input->post('no_trxhtl') != ""):
			$this->db->delete("mp_hotel",array('koderec' => $this->input->post('no_trxhtl')));
			$this->db->delete("mp_hotel_detail",array('koderec' => $this->input->post('no_trxhtl')));
		endif;
	}
	
function hotelDetail(){
	$grid = new GridConnector($this->db->conn_id);
	$grid->render_table("mp_hotel_detail","id","koderec,npwpd,jenis_kamar,jumlah_kamar,tarif,potensi,persentase,total_potensi,asumsi_pajak_bulan,asumsi_pajak_tahun");
}

function LoadHotelDetail($rec=""){
	$grid = new GridConnector($this->db->conn_id);
	$grid->render_sql("SELECT * FROM mp_hotel_detail WHERE koderec='$rec'","id","koderec,npwpd,jenis_kamar,jumlah_kamar,tarif,potensi,persentase,total_potensi,asumsi_pajak_bulan,asumsi_pajak_tahun");
}

// Reklame
	function simpanReklame() {
		$data = array (
				'npwpd' => $this->input->post('npwpd'),				
				'jenis_reklame' => $this->input->post('jenis_reklame'),
				'jumlah_reklame' => $this->input->post('jumlah_reklame'),								
				'panjang' => $this->input->post('panjang'),
				'lebar' => $this->input->post('lebar'),		
				'tinggi' => $this->input->post('tinggi'),										
				'rata2_omset' => $this->input->post('rata2_omset'),
				'ket' => $this->input->post('ket')
		);
		if($this->input->post('no_trxreklame')=="") {
			$no_trans = $this->generateNo('E','mp_reklame');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_reklame",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trxreklame');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_reklame",$dataUpd,array('koderec' => $no_trans));
		}
		echo '<script language="javascript">
				window.parent.document.frmAns.no_trxreklame.value="'.$no_trans.'"			
			</script>';		
	}
	
	function deleteReklame() {
		if($this->input->post('no_trxreklame') != ""):
			$this->db->delete("mp_reklame",array('koderec' => $this->input->post('no_trxreklame')));
		endif;
	}
	
	
	// Penerangan
	function simpanPenerangan() {
		$data = array (
				'npwpd' => $this->input->post('npwpd'),				
				'daya' => $this->input->post('daya'),
				'jenis_penerangan' => $this->input->post('jenis_penerangan'),								
				'rata2_pakai' => $this->input->post('rata2_pakai'),														
				'rata2_omset' => $this->input->post('rata2_omset'),
				'ket' => $this->input->post('ket')
		);
		if($this->input->post('no_trxpenerangan')=="") {
			$no_trans = $this->generateNo('H','mp_penerangan');
			$dataIns = array_merge($data,array(
						'koderec' => $no_trans,
						'created' => date('Y-m-d H:i:s'),
						'createdby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->insert("mp_penerangan",$dataIns);
		} else {
			$no_trans = $this->input->post('no_trxpenerangan');
			$dataUpd = array_merge($data,array(
						'modified' => date('Y-m-d H:i:s'),
						'modifiedby' => strtoupper($this->session->userdata('username'))
						)
					);
			$this->db->update("mp_penerangan",$dataUpd,array('koderec' => $no_trans));
		}
		echo '<script language="javascript">
				window.parent.document.frmAns.no_trxpenerangan.value="'.$no_trans.'"			
			</script>';		
	}
	
	function deletePenerangan() {
		if($this->input->post('no_trxpenerangan') != ""):
			$this->db->delete("mp_penerangan",array('koderec' => $this->input->post('no_trxpenerangan')));
		endif;
	}
}
?>