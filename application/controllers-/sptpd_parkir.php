<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptpd_parkir extends MY_Controller {
	
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	var $ctl_carahitung;
	var $ctl_petugasinput;

	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";

		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txtcarahitung",$this->input->post("txtcarahitung"));
		
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		$sql = $this->db->query("select kd_rek from master_rekening where jns_pajak ='07'")->row();
		$data['kd_rek'] = $kd_rek = $sql->kd_rek;
		$tarif = $this->db->query("select tarif_pajak from master_rekening where kd_rek = '".$kd_rek."'")->row();
		//$data['tarif'] = $tarif->tarif_pajak;
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		//$data['defNoSptpd']="/PRK/".date('y');
		$this->load->view('data/sptpd_view_parkir',$data);
	}
	
	public function bank(){
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";

		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txtcarahitung",$this->input->post("txtcarahitung"));
		
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		$sql = $this->db->query("select kd_rek from master_rekening where jns_pajak ='07'")->row();
		$data['kd_rek'] = $kd_rek = $sql->kd_rek;
		$tarif = $this->db->query("select tarif_pajak from master_rekening where kd_rek = '".$kd_rek."'")->row();
		$data['tarif'] = $tarif->tarif_pajak;
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		//$data['defNoSptpd']="/PRK/".date('y');
		$this->load->view('data/parkir_bank',$data);
	}
	
	public function load_perusahaan($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$cu = "a.npwpd_perusahaan like '%".$nilai."%'";
		} else if($op==2){
			$cu = "a.nama_perusahaan like '%".$nilai."%'";
		} else if($op==3){
			$cu = "b.nama_pemilik like '%".$nilai."%'";
		}
		
		//$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where  $cu");
		$qr =$this->db->query("SELECT a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.telp, a.kodepos,
 b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, 
 a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar FROM identitas_perusahaan a INNER JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik  where a.status_aktip='Y' AND a.npwpd_perusahaan LIKE '%P2%' AND $cu");
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					//echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					//echo("<cell><![CDATA[".$rs->email."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					//echo("<cell><![CDATA[".$rs->jalan_p."]]></cell>");
					//echo("<cell><![CDATA[".$rs->rt_p."]]></cell>");
					//echo("<cell><![CDATA[".$rs->rw_p."]]></cell>");
					//echo("<cell><![CDATA[".$rs->email_p."]]></cell>");
					//echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					//echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kecamatan_p."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kabupaten_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					//echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					//echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					//echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					//echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					//echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak_detail."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kecamatan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kelurahan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT 
sptpd_parkir.id AS id,
sptpd_parkir.npwpd AS npwpd,
sptpd_parkir.no_sptpd AS no_sptpd,
sptpd_parkir.cara_hitung AS cara_hitung,
sptpd_parkir.golongan AS golongan,
sptpd_parkir.masa_pajak1 AS masa_pajak1,
sptpd_parkir.masa_pajak2 AS masa_pajak2,
sptpd_parkir.tgl_diterima AS tgl_diterima,
sptpd_parkir.omset AS omset,
sptpd_parkir.jml_bayar AS jml_bayar,
sptpd_parkir.petugas_input AS petugas_input,
identitas_perusahaan.nama_perusahaan AS nama_perusahaan,
identitas_perusahaan.alamat_perusahaan AS alamat_perusahaan,
sptpd_child.tarif AS tarif,
sptpd_parkir.jenis_parkir AS jenis_parkir,
sptpd_parkir.hrg_mobil AS hrg_mobil,
sptpd_parkir.hrg_motor AS hrg_motor,
sptpd_parkir.hrg_garasi AS hrg_garasi,
sptpd_parkir.jum_hr_biasa AS jum_hr_biasa,
sptpd_parkir.jum_hr_minggu AS jum_hr_minggu,
sptpd_parkir.luas_area AS luas_area,
sptpd_parkir.jum_garasi AS jum_garasi
FROM
sptpd_parkir
INNER JOIN identitas_perusahaan ON sptpd_parkir.npwpd = identitas_perusahaan.npwpd_perusahaan
INNER JOIN sptpd_child ON sptpd_parkir.no_sptpd = sptpd_child.no_sptpd ORDER BY no_sptpd DESC","id","id,npwpd, no_sptpd, nama_perusahaan, alamat_perusahaan, cara_hitung, golongan, masa_pajak1, masa_pajak2, tgl_diterima,jml_bayar, petugas_input,omset,tarif,jenis_parkir,hrg_mobil,hrg_motor,hrg_garasi,jum_hr_biasa,jum_hr_minggu,luas_area,jum_garasi");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select 
sptpd_parkir.id as id,
sptpd_parkir.npwpd as npwpd,
sptpd_parkir.no_sptpd as no_sptpd,
sptpd_parkir.cara_hitung as cara_hitung,
sptpd_parkir.golongan as golongan,
sptpd_parkir.masa_pajak1 as masa_pajak1,
sptpd_parkir.masa_pajak2 as masa_pajak2,
sptpd_parkir.tgl_diterima as tgl_diterima,
sptpd_parkir.omset as omset,
sptpd_parkir.jml_bayar as jml_bayar,
sptpd_parkir.petugas_input as petugas_input,
identitas_perusahaan.nama_perusahaan as nama_perusahaan,
identitas_perusahaan.alamat_perusahaan as alamat_perusahaan,
sptpd_child.tarif as tarif
from
sptpd_parkir
inner join identitas_perusahaan on sptpd_parkir.npwpd = identitas_perusahaan.npwpd_perusahaan
inner join sptpd_child on sptpd_parkir.no_sptpd = sptpd_child.no_sptpd where sptpd_parkir.author_session = '".$this->session->userdata('username')."'","id","id,npwpd, no_sptpd, nama_perusahaan, alamat_perusahaan, cara_hitung, golongan, masa_pajak1, masa_pajak2, tgl_diterima,jml_bayar, petugas_input,omset,tarif");	
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal=$this->input->post('awal');
		$akhir=$this->input->post('akhir');
		$tahun=$this->input->post('tahun');
				
		$query = $this->db->query("select npwpd from sptpd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		if($query!=NULL){
			$text = "Maaf pendataan SPTPD sudah dilakukan";
		} else {
			$text = 0;
		}
		echo $text;
	}
	
	public function simpan_sptpd() {
		$username = strtoupper($this->session->userdata('username'));
		
		//$no_sptpd=$this->input->post('txtnosptpd_a').$this->input->post('txtnosptpd_b');
		
		$arrMPjk1=explode("/",$this->input->post('txttglmasapajak1'));
		$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
		$arrMPjk2=explode("/",$this->input->post('txttglmasapajak2'));
		$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];

		$arrTglDiterima=explode("/",$this->input->post('txttglditerima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
		
		$txtpajakditerima = $this->input->post('txtpajakditerima');
		if(strpos($txtpajakditerima, '.')){
			$txtpajakditerima = str_replace('.', '', $txtpajakditerima);
		} else {
			$txtpajakditerima;
		}
		
		$txtpajakterutang = $this->input->post('txtpajakterutang');
		if(strpos($txtpajakterutang, '.')){
			$txtpajakterutang = str_replace('.', '', $txtpajakterutang);
		} else {
			$txtpajakterutang;
		}
		
		$data = array (
			'npwpd' 		=> $this->input->post('txtnpwpd'),
			/*'nama_perusahaan' => $this->input->post('txtnpwpd_nama'),
			'alamat' => $this->input->post('txtnpwpd_alamat'),
			*/'cara_hitung' => $this->input->post('txtcarahitung'),
			'golongan' => $this->input->post('txtgolhotel'),
			'masa_pajak1' 	=> $masapajak1,
			'masa_pajak2' 	=> $masapajak2,
			'tgl_diterima' 	=> $tglditerima,
			'omset' 	=> $txtpajakditerima,
			'jml_bayar' 	=> $txtpajakterutang,
			'petugas_input' 	=> $this->input->post('txtpetugasinput'),
			'jenis_parkir' 	=> $this->input->post('jenis_parkir'),
			'hrg_mobil' 	=> $this->input->post('hrg_mobil'),
			'hrg_motor' 	=> $this->input->post('hrg_motor'),
			'hrg_garasi' 	=> $this->input->post('hrg_garasi'),
			'jum_hr_biasa' 	=> $this->input->post('jum_hr_biasa'),
			'jum_hr_minggu' 	=> $this->input->post('jum_hr_minggu'),
			'luas_area' 	=> $this->input->post('luas_area'),
			'jum_garasi' 	=> $this->input->post('jum_garasi'),
			'author_session' 		=> $username
		);
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('txtnpwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $arrMPjk1[1],
			'masa_pajak2'	=> $arrMPjk2[1],
			'masa_pajak_1' 	=> $masapajak1,
			'masa_pajak_2'	=> $masapajak2,
			'tahun' 			=> $arrMPjk2[2],
			'jumlah' 	=> $txtpajakterutang,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek, tarif_pajak from master_rekening where kd_rek = '".$this->input->post('txtgolhotel')."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($this->input->post('txtgolhotel')),
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $txtpajakditerima,
			'tarif' => $rekening->tarif_pajak,
			'jumlah' => $txtpajakterutang
		);
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd_parkir', $dataUpd, array('id' => $this->input->post('id')));
			$result = $this->input->post('no_sptpd');
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $result,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $this->input->post('no_sptpd')));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $result));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $this->input->post('no_sptpd')));
			
		} else {
			$thn = date('Y');
			$no_sptpd=$this->generateNo(date("Y",strtotime($tglditerima)));
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$this->db->insert('sptpd_parkir',$dataIns);
			$result = $no_sptpd;
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);
		}
		
		//$result="true";
		echo $result;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_sptpd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/PKR/'.substr($thn,2,2);
	}

	public function delete_sptpd() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from sspd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_parkir',array('no_sptpd' => $sq));
			$this->db->delete('sptpd',array('no_sptpd' => $sq));
			$this->db->delete('sptpd_child',array('no_sptpd' => $sq));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "Data tidak bisa dihapus No.SPTPD ini sudah ditransaksikan di SSPD Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}

	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		if($ctlType=="BULAN"){
			$arr_data=array("0"=>"", "01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			$arr_data=array(""=>"","2016"=>"2016", "2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021");
		}elseif($ctlType=="CARA_HITUNG"){
			$arr_data=array(/*"1"=>"Official Assesment (Dihitung dan ditetapkan oleh Pejabat Dispenda) ",*/ 
							"2"=>"Self Assesment (Menghitung dan Menetapkan Pajak Sendiri)");
		}elseif($ctlType=="PETUGAS_INPUT"){
			//Karena belum ada table petugas inputor, maka digunakan array data
			// jika sudah ada, maka akan di link kan ke function zieGetPetugasInput
			$arr_data=array("ESRARS"=>"ESRA R. SIMATUPANG", 
							"ZAHRAHAM"=>"ZAHRATUL HAMIDAH");
		}	

		$ret="<select name=\"$ctlId\" id=\"$ctlId\" $iEvent disabled>";
		foreach($arr_data as $key=>$value){
			if($key==$iSelValue){
				$ret.="<option selected value=\"$key\">$value</option>";
			}else{
				$ret.="<option value=\"$key\">$value</option>";
			}
		}
		$ret.="</select>";
		return $ret;
	}
	
	public function zieGetPetugasInput(){

		$this->db->select('petugas.id, petugas.name');
		$this->db->from('tb_petugas');
		
		return $this->db->get()->result_array();
	}  
	
	public function cetak(){
		$sql = $this->db->query("SELECT 
sptpd_parkir.id AS id,
sptpd_parkir.npwpd AS npwpd,
sptpd_parkir.no_sptpd AS no_sptpd,
sptpd_parkir.cara_hitung AS cara_hitung,
sptpd_parkir.golongan AS golongan,
DATE_FORMAT(sptpd_parkir.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,
DATE_FORMAT(sptpd_parkir.masa_pajak2,'%d/%m/%Y') AS masa_pajak2,
DATE_FORMAT(sptpd_parkir.tgl_diterima,'%d/%m/%Y') AS tgl_terima,
sptpd_parkir.omset AS omset,
sptpd_parkir.jml_bayar AS jml_bayar,
sptpd_parkir.petugas_input AS petugas_input,
view_perusahaan.nama_perusahaan AS nama_perusahaan,
view_perusahaan.nama_perusahaan AS nama_pemilik,
view_perusahaan.alamat_perusahaan AS alamat_perusahaan,
sptpd_child.tarif,
sptpd_parkir.jenis_parkir,
sptpd_parkir.hrg_mobil,
sptpd_parkir.hrg_motor,
sptpd_parkir.hrg_garasi,
sptpd_parkir.jum_hr_biasa,
sptpd_parkir.jum_hr_minggu,
sptpd_parkir.luas_area,
sptpd_parkir.jum_garasi,
view_perusahaan.npwpd_lama
FROM
sptpd_parkir
INNER JOIN view_perusahaan ON sptpd_parkir.npwpd = view_perusahaan.npwpd_perusahaan INNER JOIN sptpd_child ON sptpd_parkir.no_sptpd = sptpd_child.no_sptpd WHERE sptpd_parkir.no_sptpd = '".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a[1]);
		$b = explode("/",$sql->masa_pajak2);
		$akhir 				= $this->msistem->v_bln($b[1]);
		$tahun				= $b[2];
		$total				= number_format($sql->omset,2,",",".");
		$m	= $this->msistem->v_bln(date('m'));
		$days = date('d');
		$t1 = $sql->tarif.'%';
		$tanggal			= $days.' '.$m.' '.date('Y');
		$petugas			= $sql->petugas_input;
		$jns_parkir			= $sql->jenis_parkir;
		$mobil				= $sql->hrg_mobil;
		$motor				= $sql->hrg_motor;
		$garasi				= $sql->hrg_garasi;
		$jum_biasa			= $sql->jum_hr_biasa;
		$jum_libur			= $sql->jum_hr_minggu;
		$luas				= $sql->luas_area;
		$jum_grs			= $sql->jum_garasi;
		$npwpd_lama			= $sql->npwpd_lama;
		
		$cara = $sql->cara_hitung;
		//$nm = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->gol_hotel."'")->row();
		$nilai_tarif1 = number_format($sql->jml_bayar,2,",",".");
		$c			= $sql->tgl_terima;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];

		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KOTA JAMBI<br />
						<b>DINAS PENDAPATAN</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="210" align="center">
						<b>SURAT PEMBERITAHUAN PAJAK DAERAH</b><br />
						<b>PAJAK PARKIR</b><br /><br/>
						Masa Pajak&nbsp; :  '.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SPTPD<br />
						'.$sql->no_sptpd.'
					</td>
				</tr>
			</table>';
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get=" ".$npwpd_lama." ";
			}
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
								<td width="120">&nbsp;&nbsp;3. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="250">'.$sql->npwpd.'</td>
							</tr>
						
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;4. Nama Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_pemilik.'</td>
							</tr>		
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
						</table>
					</td>
				</tr>
			</table>';	
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA OBYEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$sq = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->golongan."'")->row();	
		if($jns_parkir=='1'){
			$jns_parkir='Gedung Parkir';
		}else if($jns_parkir=='2'){
			$jns_parkir='Lingkungan Parkir';
		} else if($jns_parkir=='3'){
			$jns_parkir='Pelataran Parkir';
		} else{
			$jns_parkir='Garasi yang disewakan';
				}  
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="380">'.$sql->golongan.'</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="380">'.$sq->nm_rek.'</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;3. Jenis Parkir</td>
								<td width="10" align="center">:</td>
								<td width="380">'.$jns_parkir.'</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;4. Harga tanda masuk yang berlaku</td>
								<td width="10" align="center">:</td>
								<td width="380">
									<table border="0" width="360">
										<tr>
											<td width="120">Mobil&nbsp; : Rp.'.$mobil.' </td>
											<td width="120">Motor&nbsp; : Rp.'.$motor.' </td>
											<td width="120">Garasi&nbsp; : Rp.'.$garasi.' </td>
										</tr>
									</table>
								</td>
							</tr>							
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;5. Jumlah Kendaraan</td>
								<td width="10" align="center">:</td>
								<td width="380">
									<table border="0" width="300">
										<tr>
											<td width="180">Rata-rata hari biasa&nbsp; : '.$jum_biasa.' Unit</td>											
											<td width="180">Rata-rata hari minggu&nbsp; : '.$jum_libur.' Unit</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="180">&nbsp;&nbsp;6. Luas Area Parkir</td>
								<td width="10" align="center">:</td>
								<td width="380">
									<table border="0" width="300">
										<tr>
											<td>'.$luas.' M2</td>
											<td width="180">Jumlah garasi &nbsp; : '.$jum_grs.' Buah</td>											
											
										</tr>
									</table>
								</td>
							</tr>	
							
							
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK PARKIR</strong>
					</td>
				</tr>
			</table>';
			
		if($a1=='01'){
			$a1 = 12;
			$tahun = $tahun-1;
		} else {
			$a1 = $a1-1;
		}
		
		//if(strlen($a1)==1) {
		//	$a1 = '0'.$a1;
		//}
		
		$qw = $this->db->query("select tarif_pajak from master_rekening where jns_pajak = '08'")->row();
		
//		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2, c.tarif from sspd a 
//        left join sptpd_burung_walet b on a.nomor=b.no_sptpd left join sptpd_child c 
//        on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();
        
        $set = $this->db->query("SELECT a.ketetapan, a.setoran, f.masa_pajak1, f.masa_pajak2,
         e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_parkir f ON b.no_sptpd=f.no_sptpd 
          LEFT JOIN sptpd_child e ON f.no_sptpd=e.no_sptpd
          WHERE a.npwpd = '".$sql->npwpd."' AND a.masa_pajak1 = '".$a1."' AND a.tahun_pajak = '".$tahun."'")->row();
        
        
		if($set==NULL){
			$tgl = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0%";
			$h = "Rp. 0,00";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl = $l1.' s/d '.$l2;
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = $set->tarif.'%';
			$h = 'Rp. '.number_format($set->setoran,2,",",".");
		}
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$tgl.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">'.$dp.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$t.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">'.$h.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$total.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$t1.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$nilai_tarif1.'</td>
							</tr>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
						</table>	
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PERNYATAAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table border="1">
			<tr><td width="572">
			<table border=0>
<tr>
	<td height="10">&nbsp;</td>
</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="5">&nbsp;</td>
					<td width="562">
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan diatas beserta lampiran-lampirannya adalah benar, lengkap dan jelas.					    				
					  </div>
					  </td>
					 <td width="5">&nbsp;</td>
				</tr>
				<tr>
					<td width="572" colspan="3">
						<table border="0">
							<tr>
							<td width="572">
							<table border="0">
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Jambi, '.$created.'</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Wajib Pajak</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_perusahaan.'</td>
								</tr>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
						</table>
						</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td></tr>
			</table>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
			
	$op = $this->db->query("select * from admin where username = '".$sql->petugas_input."'")->row();
	if($op==NULL){
		$petugas = "";
		$nip = "";
	} else {
		$petugas = strtoupper($op->nama);
		$nip = $op->nip;
	}
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$c.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Jambi, '.$created.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$petugas.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">'.$nip.'</td>
                          </tr>
                        </table></td>
						<td width="200" height="50" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$petugas.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
}
?>