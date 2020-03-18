<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptpd_air_bawah_tanah extends MY_Controller {
	
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

		$ctl_golonganair = $this->zieGenCombo("GOLONGAN_AIR", "txtgolonganair",$this->input->post("txtgolonganair"));
		$ctl_kualitasair = $this->zieGenCombo("KUALITAS_AIR", "txtkualitasair",$this->input->post("txtkualitasair"));
		$ctl_lokasisumberair = $this->zieGenCombo("LOKASI_INDEKS", "txtlokasisumberair",$this->input->post("txtlokasisumberair"));
		$ctl_tingkatkerusakanlingkungan = $this->zieGenCombo("TINGKAT_KERUSAKAN_LINGKUNGAN", "txttingkatkerusakanlingkungan",$this->input->post("txttingkatkerusakanlingkungan"));
		$ctl_tujuanpemanfaatan = $this->zieGenCombo("TUJUAN_PEMANFAATAN", "txttujuanpemanfaatan",$this->input->post("txttujuanpemanfaatan"));
		$sql = $this->db->query("select kd_rek, tarif_pajak from master_rekening where jns_pajak ='08'")->row();
		$data['tarif_pajak'] = $sql->tarif_pajak;
		$data['kd_rek'] = $sql->kd_rek;
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['defNoSptpd']="/AIR/".date('y');
		$data['ctl_golonganair']=$ctl_golonganair;
		$data['ctl_kualitasair']=$ctl_kualitasair;
		$data['ctl_lokasisumberair']=$ctl_lokasisumberair;
		$data['ctl_tingkatkerusakanlingkungan']=$ctl_tingkatkerusakanlingkungan;
		$data['ctl_tujuanpemanfaatan']=$ctl_tujuanpemanfaatan;
		//$this->load->view('data/sptpd_view_air_bawah_tanah',$data);
		$this->load->view('data/sptpd_air',$data);		
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
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar,a.kode_kelurahan, a.kode_kecamatan  from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where a.status_aktip='Y' AND LEFT(a.npwpd_perusahaan,2)='08' AND $cu");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->email_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak_detail."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					echo("<cell><![CDATA[".$rs->kode_kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kode_kelurahan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$tahun = $this->input->post('tahun');
		
		$query = $this->db->query("select npwpd from sptpd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		if($query!=NULL){
			$text = "Maaf pendataan SPTPD sudah dilakukan";
		} else {
			$text = 0;
		}
		echo $text;
	}
	
	public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select sptpd_air_bawah_tanah.id as id,
sptpd_air_bawah_tanah.npwpd as npwpd,
sptpd_air_bawah_tanah.no_sptpd as no_sptpd,
sptpd_air_bawah_tanah.cara_hitung as cara_hitung,
sptpd_air_bawah_tanah.rek_air as rek_air,
sptpd_air_bawah_tanah.gol_air as golongan_air,
sptpd_air_bawah_tanah.lokasi_sumber_air as lokasi_sumber_air,
sptpd_air_bawah_tanah.tujuan_pemanfaatan_air as tujuan_pemanfaatan_air,
sptpd_air_bawah_tanah.kualitas_air as kualitas_air,
sptpd_air_bawah_tanah.tingkat_kerusakan_lingkungan as tingkat_kerusakan_lingkungan,
sptpd_air_bawah_tanah.masa_pajak1 as masa_pajak1,
sptpd_air_bawah_tanah.masa_pajak2 as masa_pajak2,
sptpd_air_bawah_tanah.tgl_diterima as tgl_diterima,
sptpd_air_bawah_tanah.harga_dasar as harga_dasar,
sptpd_air_bawah_tanah.volume as volume,
sptpd_air_bawah_tanah.omset as omset,
sptpd_air_bawah_tanah.jml_bayar as jml_bayar,
sptpd_air_bawah_tanah.petugas_input as petugas_input,
identitas_perusahaan.nama_perusahaan as nama_perusahaan,
identitas_perusahaan.alamat_perusahaan as alamat_perusahaan from sptpd_air_bawah_tanah inner join identitas_perusahaan on sptpd_air_bawah_tanah.npwpd = identitas_perusahaan.npwpd_perusahaan ORDER BY no_sptpd DESC","id","id,npwpd, no_sptpd,nama_perusahaan, alamat_perusahaan, cara_hitung, rek_air, golongan_air,lokasi_sumber_air, tujuan_pemanfaatan_air, kualitas_air, tingkat_kerusakan_lingkungan, masa_pajak1, masa_pajak2, tgl_diterima, harga_dasar, volume, omset, petugas_input, jml_bayar");	
	}
	
	public function simpan_sptpd() {
		$username = strtoupper($this->session->userdata('username'));
		//$username = 'ADMIN';
		
		$arrMPjk1=explode("/",$this->input->post('txttglmasapajak1'));
		$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
		$arrMPjk2=explode("/",$this->input->post('txttglmasapajak2'));
		$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];

		$arrTglDiterima=explode("/",$this->input->post('txttglditerima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
		
		$txthargadasar = $this->input->post('txthargadasar');
		if(strpos($txthargadasar, '.')){
			$txthargadasar = str_replace('.', '', $txthargadasar);
		} else {
			$txthargadasar;
		}
		
		$txtvolume = $this->input->post('txtvolume');
		if(strpos($txtvolume, '.')){
			$txtvolume = str_replace('.', '', $txtvolume);
		} else {
			$txtvolume;
		}
		
		/*$txtpajakditerima = $this->input->post('txtpajakditerima');
		if(strpos($txtpajakditerima, '.')){
			$txtpajakditerima = str_replace('.', '', $txtpajakditerima);
		} else {
			$txtpajakditerima;
		}*/
		
		$txtpajakterutang = $this->input->post('txtpajakterutang');
		if(strpos($txtpajakterutang, '.')){
			$txtpajakterutang = str_replace('.', '', $txtpajakterutang);
		} else {
			$txtpajakterutang;
		}
		
		$data = array (
			'npwpd' 		=> $this->input->post('txtnpwpd'),
			/*'nama_perusahaan' => $this->input->post('txtnpwpd_nama'),
			'alamat' => $this->input->post('txtnpwpd_alamat'),*/
			'cara_hitung' => $this->input->post('txtcarahitung'),
			'rek_air' => $this->input->post('gol'),			
			//'lokasi_sumber_air' => $this->input->post('txtlokasisumberair'),
			'tujuan_pemanfaatan_air' => $this->input->post('txttujuanpemanfaatan'),
			'kualitas_air' => $this->input->post('txtkualitasair'),
			/*'tingkat_kerusakan_lingkungan' => "",*/
			'masa_pajak1' 	=> $masapajak1,
			'masa_pajak2' 	=> $masapajak2,
			'tgl_diterima' 	=> $tglditerima,
			'harga_dasar'	=> $txthargadasar,
			'volume'	=> $txtvolume,			
			'jml_bayar' 	=> $txtpajakterutang,
			'petugas_input' 	=> $this->input->post('txtpetugasinput'),
			'author_session' 		=> strtoupper($username)
		);
		
		$awal = explode('-',$masapajak1);
		$akhir = explode('-',$masapajak2);
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('txtnpwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
			'masa_pajak_1' 	=> $masapajak1,
			'masa_pajak_2' 	=> $masapajak2,
			'tahun' 			=> $akhir[0],
			'jumlah' 	=> $txtpajakterutang,
			'status'	=> 1,
			'author' 		=> strtoupper($username)
		);
		//txtpajakditerima
		//kode_rekening
		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '".$this->input->post('gol')."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($this->input->post('gol')),
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => 0,
			'tarif' => 20,
			'jumlah' => $txtpajakterutang
		);
			
		if($this->input->post('id')!=0){
			$no_sptpd = $this->input->post('sptpd');
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$result = $this->db->update('sptpd_air_bawah_tanah', $dataUpd, array('id' => $this->input->post('id')));
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $no_sptpd));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $no_sptpd));
			
		} else {
			$thn = date('Y');
			$no_sptpd=$this->generateNo(date("Y",strtotime($tglditerima)));
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$result = $this->db->insert('sptpd_air_bawah_tanah',$dataIns);
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);
		}
				
		echo $no_sptpd;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_sptpd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/AIR/'.substr($thn,2,2);
	}
	
	function hitung_tarif(){
		$jumlah_tarif = 0;
		$t_harga = 0;
		
		$npwpd = $this->input->post('npwpd');
		//$lokasi = $this->input->post('lokasi');		
		$tujuanpemanfaatan = $this->input->post('tujuanpemanfaatan');
		$kualitasair = $this->input->post('kualitasair');
		$volume = $this->input->post('volume');
		$tarif = $this->input->post('tarif');
		/* if(strpos($volume, '.')){
			$volume = str_replace('.', '', $volume);
		} else {
			$volume;
		} */
		
		if($npwpd==''){			
			echo $kirim;
		} else {
			if($volume>0){
				//$que = $this->db->query("select id, harga from tb_lokasi_indeks where id = '".$lokasi."'")->row();
				$que2 = $this->db->query("SELECT id, komponen_sda, bobot_sda FROM tb_kualitas_air where id = '".$kualitasair."'")->row();
				$que3 = $this->db->query("SELECT id,keterangan,bobot_komponen1,bobot_komponen2,bobot_komponen3,bobot_komponen4,bobot_komponen5 FROM tb_tujuan_pemanfaatan where id = '".$tujuanpemanfaatan."'")->row();				 
				//$harga = $que->harga;
				$n_komponen = $que2->komponen_sda;
				$n_sda = $que2->bobot_sda;
				$bot1 = $que3->bobot_komponen1; 
				$bot2 = $que3->bobot_komponen2; 
				$bot3 = $que3->bobot_komponen3; 
				$bot4 = $que3->bobot_komponen4; 
				$bot5 = $que3->bobot_komponen5;
				//$id = $que->id;
				//Komponen harga dasar
				$p1 = 0.6;
				$p2 = 0.4;
				$ksda = $n_sda * $p1;
				$kk1 = $bot1 * $p2;
				$kk2 = $bot2 * $p2;
				$kk3 = $bot3 * $p2;
				$j_fna1 = $ksda + $kk1; 
				$j_fna2 = $ksda + $kk2; 
				$j_fna3 = $ksda + $kk3; 
				
				if($volume>50){
					$volume1 = 50;
				} else{
					$volume1 = $volume;
				}
				
				 if($volume>500){
					$volume2 = 450;
				} else if($volume>50){
					$volume2 = $volume - 50;
				}else{
					$volume2 = 0;
				} 
				/* if($volume>500){
					$volume2 = 450;
				} else{
					$volume2 = $volume - 50;
				} */
				
				if($volume>1000){
					$volume3 = 500;
				} else if($volume>=450){
					$volume3 = $volume - 500;
				}else{
					$volume3 = 0;
				}
				$volume4 = 0;
				$volume5 = 0;
				
				
				$n1 = $volume1 * $j_fna1 * 1000;
				$n2 = $volume2 * $j_fna2 * 1000;
				$n3 = $volume3 * $j_fna3 * 1000;
				//$fna = $n_komponen + $bobot;
				$fna = $n1 + $n2 + $n3;
				$harga1 = $fna;
				$jumlah = ($harga1*$tarif)/100;
				//$jumlah_tarif = $harga1-$jumlah;
				
				$kirim = $harga1.'-'.$jumlah;															
			}
		} echo $kirim;
	}

	public function delete_sptpd() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(sptpd) as jml from nota_hitung where sptpd = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_air_bawah_tanah',array('no_sptpd' => $sq));
			$this->db->delete('sptpd',array('no_sptpd' => $sq));
			$this->db->delete('sptpd_child',array('no_sptpd' => $sq));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data Nota Hitung Terlebih Dahulu";
		}
		echo $result;
	}

	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		if($ctlType=="BULAN"){
			$arr_data=array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			$arr_data=array("2016"=>"2016", "2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021");
		}elseif($ctlType=="CARA_HITUNG"){
			$arr_data=array("1"=>"Official Assesment (Dihitung dan ditetapkan oleh Bapenda) "/*, 
							"2"=>"Self Assesment (Menghitung dan Menetapkan Pajak Sendiri)"*/);
		}elseif($ctlType=="PETUGAS_INPUT"){
			//Karena belum ada table petugas inputor, maka digunakan array data
			// jika sudah ada, maka akan di link kan ke function zieGetPetugasInput
			$arr_data=array("ESRARS"=>"ESRA R. SIMATUPANG", 
							"ZAHRAHAM"=>"ZAHRATUL HAMIDAH");
		}else{
			$query = $this->db->query("select id, keterangan from tb_".strtolower($ctlType));
			foreach ($query->result() as $row){
			   $arr_data[$row->id]=$row->keterangan;
			}
		}

		$ret="<select name=\"$ctlId\" id=\"$ctlId\" $iEvent disabled>
		<option value=\"\"></option>";
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
		/*$spt = explode("=",$bray);
		$sptpd = $spt[0]+"/"+$spt[1]+"/"+$spt[2];
		echo $sptpd;*/
		
		$sql = $this->db->query("SELECT sptpd_air_bawah_tanah.id, sptpd_air_bawah_tanah.kualitas_air, sptpd_air_bawah_tanah.lokasi_sumber_air,
 sptpd_air_bawah_tanah.tingkat_kerusakan_lingkungan, sptpd_air_bawah_tanah.harga_dasar, 
sptpd_air_bawah_tanah.tujuan_pemanfaatan_air, sptpd_air_bawah_tanah.volume, sptpd_air_bawah_tanah.npwpd, view_perusahaan.npwpd_lama, 
sptpd_air_bawah_tanah.no_sptpd, view_perusahaan.nama_perusahaan, 
view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, 
sptpd_air_bawah_tanah.cara_hitung, DATE_FORMAT(sptpd_air_bawah_tanah.tgl_diterima,'%d/%m/%Y') AS tgl_terima, 
sptpd_air_bawah_tanah.petugas_input, sptpd_air_bawah_tanah.gol_air, DATE_FORMAT(sptpd_air_bawah_tanah.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, 
DATE_FORMAT(sptpd_air_bawah_tanah.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, sptpd_air_bawah_tanah.jml_bayar FROM sptpd_air_bawah_tanah 
LEFT JOIN view_perusahaan ON sptpd_air_bawah_tanah.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_air_bawah_tanah.no_sptpd='".$_GET['sptpd']."'")->row();
		$a 					= explode("/",$sql->masa_pajak1);
		$awal				= $this->msistem->v_bln($a[1]);
		$b					= explode("/",$sql->masa_pajak2);
		$akhir 				= $this->msistem->v_bln($b[1]);
		$tahun				= $b[2];
		$dasar				= $sql->jml_bayar;
		$dasar1				= number_format($dasar,2,",",".");
		$tarif				= '20';
		$hit				= ($dasar*$tarif)/100;
		$total				= number_format($dasar,2,",",".");
		$huruf				= '';
		$harga_dasar		= number_format($sql->harga_dasar,2,",",".");
		$volume				= number_format($sql->volume,2,",",".");	
		$m					= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$petugas			= $sql->petugas_input;
		$npwpd_lama			= $sql->npwpd_lama;
		
		//$nm = $this->db->query("select keterangan from tb_golongan_air where id='".$sql->gol_air."'")->row();
		
		$nm1 = $this->db->query("select keterangan from tb_lokasi_indeks where id='".$sql->lokasi_sumber_air."'")->row();
		
		//$nm2 = $this->db->query("select keterangan from tb_tujuan_pemanfaatan where id='".$sql->tujuan_pemanfaatan_air."'")->row();
		
		//$nm3 = $this->db->query("select keterangan from tb_kualitas_air where id='".$sql->kualitas_air."'")->row();
		
		//$nm4 = $this->db->query("select keterangan from tb_tingkat_kerusakan_lingkungan where id='".$sql->tingkat_kerusakan_lingkungan."'")->row();
		
		$c			= $sql->tgl_terima;
		$arr 		= explode("/",$c);
		$bln 		= $this->msistem->v_bln($arr[1]);
		$created 	= $arr[0].' '.$bln.' '.$arr[2];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10,10);
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
						PEMERINTAH KABUPATEN MELAWI<br />
						<b>BADAN PENDAPATAN DAERAH</b><br />
						
					</td>
					<td width="210" align="center">
						DASAR PERHITUNGAN PAJAK DAERAH<br />
						PAJAK AIR TANAH<br /><br/>
						Masa Pajak&nbsp;&nbsp; : &nbsp;&nbsp;'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'
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
								<td width="120">&nbsp;&nbsp;1. Nama Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;3. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
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
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>			
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="150">&nbsp;&nbsp;1. Jenis Sumber Air</td>
					<td width="10" align="center">:</td>
					<td width="317"> Air Bawah Tanah</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="150">&nbsp;&nbsp;2. Lokasi Sumber Air</td>
					<td width="10" align="center">:</td>
					<td width="317"></td>
				</tr>				
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="150">&nbsp;&nbsp;3. Harga Dasar</td>
					<td width="10" align="center">:</td>
					<td width="317">Rp.'.$harga_dasar.'&nbsp;&nbsp;m<sup>3</sup></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="150">&nbsp;&nbsp;4. Volume</td>
					<td width="10" align="center">:</td>
					<td width="317">'.$volume.'&nbsp;&nbsp;m<sup>3</sup></td>
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
						<strong>DATA PAJAK AIR TANAH</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="4" height="10">&nbsp;</td>
</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;a.</td>
					<td width="232">Masa Pajak</td>
					<td width="10">:</td>
					<td width="182">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>';
				/*<tr>
					<td width="14">&nbsp;&nbsp;b.</td>
					<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="182">Rp. '.$dasar1.'</td>
				</tr>*/
			$report .= 
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;b.</td>
					<td width="232">Tarif Pajak (sesuai perda)</td>
					<td width="10">:</td>
					<td width="182">'.$harga_dasar.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;b.</td>
					<td width="232">Tarif Pajak (sesuai perda)</td>
					<td width="10">:</td>
					<td width="182">'.$tarif.'%</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;c.</td>
					<td width="232">Pajak Terhutang (b x c)</td>
					<td width="10">:</td>
					<td width="182">Rp. '.$total.'</td>
				</tr>
<tr>
	<td colspan="4" height="10">&nbsp;</td>
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
			'
			<table border="1">
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" colspan="3">
						<table border="0">
							<tr>
							<td width="572">
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$tanggal.'</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_pemilik.'</td>
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
			</table>
						---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
			<br>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
			
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
						<td width="200" align="center">Nanga Pinoh, '.$tanggal.'</td>
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
                            <td width="61%">&nbsp;</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
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