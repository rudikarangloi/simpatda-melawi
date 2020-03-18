<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class reklame extends MY_Controller {
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	
	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		//$data['tanggal']=date("d/m/Y");
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['dReklame'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='04'");
		$data['jnsReklame'] = $this->db->query("SELECT * FROM ms_jenis_reklame");
		$data['jlnReklame'] = $this->db->query("SELECT * FROM master_kawasan_zona_jalan ORDER BY kawasan ASC");
		$data['tinggiReklame'] = $this->db->query("SELECT * FROM ms_ketinggian");
		$data['lbrjln'] = $this->db->query("SELECT * FROM ms_lebar_jalan");
		$data['sudut'] = $this->db->query("SELECT * FROM ms_sudut_pandang");
		$data['tgl'] = date('d/m/Y');
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('data/reklame',$data);
	}
	
	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		if($ctlType=="BULAN"){
			$arr_data=array("00"=>"","01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			$arr_data=array(""=>"","2016"=>"2016","2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021");
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
	
	public function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$tahun = $this->input->post('tahun');
		
		$spt = $this->input->post('sifat_reklame');
		 if($spt == 'Permanen'){
		      $query = $this->db->query("select npwpd from sptpd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		      if($query!=NULL){
			     $text = "Maaf pendataan SPTPD sudah dilakukan";
		      } else {
			$text = 0;
		      }
        } else {
			$text = 0;
		}
		echo $text;
	}
	//fadil
	function kawasan(){
		$nm_jln = $this->input->post('lokasi_pasang1');
		$query = $this->db->query("SELECT a.*,b.lebar FROM master_kawasan_zona_jalan a INNER JOIN ms_lebar_jalan b ON a.id_lbr_jln=b.id WHERE a.no ='".$nm_jln."'")->row();
		$kawasan = $query->kawasan;
		$lbr_jln= $query->lebar;

		$kirim = $kawasan.'/'.$lbr_jln;
		echo $kirim;
	}
	
	function pokok(){
		$jns_rek = $this->input->post('gjenisrek');
		$kawasan = $this->input->post('kawasan');
		$luas = $this->input->post('luas');
		$sisi = $this->input->post('sisi');
		$tinggi = $this->input->post('tinggi');
		$lebar = $this->input->post('lebar');
		$sudut = $this->input->post('sudut');
		$unit = $this->input->post('unt');
		$sifat = $this->input->post('sifatp');
		$lama_psg = $this->input->post('selama');
		$waktu_psg = $this->input->post('waktu_pasang'); 

		$q1 = $this->db->query("SELECT lokasi,skor,bobot FROM ms_lokasi_reklame WHERE lokasi ='".$kawasan."'")->row();
		$query2 = $this->db->query("SELECT jenis,luas_bidang FROM ms_jenis_reklame WHERE id ='".$jns_rek."'")->row();
		$query3 = $this->db->query("SELECT sudut_pandang,skor,bobot FROM ms_sudut_pandang WHERE id ='".$sudut."'")->row();
		$query4 = $this->db->query("SELECT ketinggian,skor,bobot FROM ms_ketinggian WHERE id ='".$tinggi."'")->row();
		$query5 = $this->db->query("SELECT lebar,skor FROM ms_lebar_jalan WHERE lebar ='".$lebar."'")->row();
		
		if($luas>=0&&$luas<=5.99){
			$nilai_sat = 500000;
		}else if($luas>=6&&$luas<=14.99){
			$nilai_sat = 1000000;
		}else if($luas>=15&&$luas<=24.99){
			$nilai_sat = 1500000;
		}else if($luas>=25&&$luas<=35){
			$nilai_sat = 2000000;
		}else if($luas>35 ){
			$nilai_sat=3500000;
		}
		
		/* if($waktu_psg=='bulan'){
			$selama=$lama_psg/12;
		}else{
			$selama=$lama_psg;
		} */
		//------kawasan
		$bot_k = $q1->bobot;
		$k_skor = $q1->skor;
		//------sudut pandang
		$bot_sp = $query3->bobot;
		$sp_skor = $query3->skor;
		//------ketinggian
		$bot_ket = $query4->bobot;
		$ket_skor = $query4->skor;
		//------lebar jalan
		$bot_leb = 0.25;
		$leb_skor = $query5->skor;
		//-------jenis
		$luas_bid = $query2->luas_bidang;
		//--------nilai objek pajak
		$njop = $luas*$luas_bid;
		//-----nilai strategis
		$nsk = $k_skor*$bot_k;
		$nsp = $sp_skor*$bot_sp;
		$nske = $ket_skor*$bot_ket;
		$nsl= $leb_skor*$bot_leb;
		$nilai_titik = $nsk+$nsp+$nske+$nsl;
		$ns = $nilai_sat*$nilai_titik;
		//-----nilai pajak
		$np = (0.1*($njop+$ns))*$sisi;
		//$jnp = $np*$selama;
		//----insidentil
		$injop = 10000;
		$ins = 10000;
		$inilasewa = $injop+$ins;
		$inilasewa2 = $inilasewa*$luas; 
		$inp = 0.1*$inilasewa2;
		
		if($waktu_psg=='bulan'){
			$nilaip = $np*$lama_psg/12;
		}else{
			$nilaip = $np;
		}
		
		echo $nilaip;
	}
	
	public function hitung(){
		$jenis = $this->input->post('jenis');
		$posisi = $this->input->post('posisi');
		$kawasan = $this->input->post('kawasan');
		$waktu = $this->input->post('waktu');
		$panjang = $this->input->post('panjang');
		$lebar = $this->input->post('lebar');
		$jari = $this->input->post('jari');
		$muka = $this->input->post('muka');
		$jumlah = $this->input->post('jumlah');
				
		if($waktu>0 && $waktu<7){
			$time = 'Sehari';
		} else if($waktu>6 || $waktu<90){
			$time = 'Sebulan';
		} else if($waktu>89){
			$time = 'Setahun';
		}
		
		if($kawasan=='1'){
			$daerah = 'Sangat Strategis (A)';
		} else if($kawasan=='2'){
			$daerah = 'Strategis (B)';
		} else if($kawasan=='3'){
			$daerah = 'Kurang Strategis (C)';
		}
		$sql = $this->db->query("select tarif from tarif_reklame where kd_rek_reklame='".$jenis."' and waktu='".$time."' and lokasi='".$daerah."'")->row();
		$tarif = $sql->tarif;
		
		if($jari==NULL){
			$luas = $panjang*$lebar*$muka*$jumlah;
			$hitung = $tarif*$luas;
		} else {
			$luas_jari = $jari*3.14;
			$luas = $luas_jari*$jumlah;
			$hitung = $tarif*$luas;
		}
		
		$data = $tarif.'|'.$hitung.'|'.$luas;
		echo $data;
	}
	
	public function lihat() {
		$s = $this->input->post('npwpd');
		
		$w = $this->db->query("select nama_perusahaan,alamat_perusahaan from identitas_perusahaan where id_perusahaan='".$s."'")->row();
		if($w==NULL){
			$q = 0;
		} else {	
			$nama = $w->nama_perusahaan;
			$alamat = $w->alamat_perusahaan;
				
			$q = $nama."|".$alamat;
		}
		echo $q;
	}
        
public function cariDataWP($kata_kunci="",$parameter=""	) {	
		if(!empty($kata_kunci)){
			if($parameter == '1'){
				$qr = "a.npwpd_perusahaan like '%".$kata_kunci."%'";
			} else if ($parameter == '2'){
				$qr = "a.nama_perusahaan like '%".$kata_kunci."%'";
			}
		} else {
			$qr = "";	
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT a.npwpd_perusahaan,b.npwpd_lama ,a.nama_pemilik, a.nama_perusahaan, a.alamat_perusahaan FROM view_perusahaan a LEFT JOIN identitas_perusahaan b 
							ON a.npwpd_perusahaan=b.npwpd_perusahaan WHERE b.status_aktip='Y' AND LEFT(b.npwpd_perusahaan,2)='04' AND $qr","npwpd_perusahaan","npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, nama_pemilik");
	}
     
        function simpan(){            
            date_default_timezone_set('Asia/Jakarta'); 
//			$tarif = $_POST['tarif'];
//		if(strpos($tarif, '.')){
//			$tarif = str_replace('.', '', $tarif);
//		} else {
//			$tarif;
//		}
//		
		/*$sub_jumlah = $_POST['sub_jumlah'];
		if(strpos($sub_jumlah, '.')){
			$sub_jumlah = str_replace('.', '', $sub_jumlah);
		} else {
			$sub_jumlah;
		}
		
		$denda = $_POST['denda'];
		if(strpos($denda, '.')){
			$denda = str_replace('.', '', $denda);
		} else {
			$denda;
		}
		
		$sewa_tanah = $_POST['sewa_tanah'];
		if(strpos($sewa_tanah, '.')){
			$sewa_tanah = str_replace('.', '', $sewa_tanah);
		} else {
			$sewa_tanah;
		}
				
		/*if(strpos($jml_dibayar, '.')){
			$jml_dibayar = str_replace('.', '', $jml_dibayar);
		} else {
			$jml_dibayar;
		}*/
		
		$jml_dibayar = $_POST['jml_dibayar'];
		$iddd = $_POST['buatidd'];	
		
            $data = array(			
						'npwpd' => $_POST['npwpd'],
						'perusahaan' => $_POST['nama_perusahaan'],
						'alamat' => $_POST['alamat_perusahaan'],
						'author' => $_POST['petugas'],
						'tgl_diterima' => $_POST['tgl_terima'],
						'cara_hitung' => $_POST['cara'],
						'tgl_permohonan' => $_POST['tgl_permohonan'],
						'tgl_diperiksa' => $_POST['tgl_diperiksa'],
						'id_reklame' => $iddd,
						'sifat_reklame' => $_POST['sifat_reklame'],
						'waktu_pasang' => $_POST['waktu_pasang'],
						'selama' => $_POST['selama'],
						//'posisi_pasang' => $_POST['posisi'],jenis
						
//						'masa_pajak1' => strftime("%Y-%m-%d", strtotime($_POST['txttglmasapajak1'])),
//						'masa_pajak2' => strftime("%Y-%m-%d", strtotime($_POST['txttglmasapajak2'])),
                        'masa_pajak1' => $_POST['tgl_ms_pajak1'],
                        'masa_pajak2' => $_POST['tgl_ms_pajak2'],
                        
						'tahun_pajak' => $_POST['txtthnmasapajak'],
						'bulan1' => $_POST['txtblnmasapajak1'],
						'bulan2' => $_POST['txtblnmasapajak2'],	
																	
						'jml_dipasang' => $_POST['jml_dipasang'],
						//'tarif_kawasan' => $_POST['tarif_reklame'],
						//'sub_jumlah' => $sub_jumlah,
						//'denda' => $denda,
						//'sewa_tanah' => $sewa_tanah,
						'jml_dibayar' => $jml_dibayar,		
						'jml_bayar' => $jml_dibayar,				
						
						//'lokasi1' =>  $_POST['lokasi_pasang1'],
						//'lokasi2' =>  $_POST['lokasi_pasang2'],
						//'lokasi3' =>  $_POST['lokasi_pasang3'],
						//'lokasi4' =>  $_POST['lokasi_pasang4'],
						//'lokasi5' =>  $_POST['lokasi_pasang5'],
						//'lokasi6' =>  $_POST['lokasi_pasang6'],
						//'lokasi7' =>  $_POST['lokasi_pasang7'],
						//'lokasi8' =>  $_POST['lokasi_pasang8'],
						//'lokasi9' =>  $_POST['lokasi_pasang9'],
						//'lokasi10' =>  $_POST['lokasi_pasang10']
            );
                
                $user = $this->session->userdata('username');       				
                
                $this->db->trans_begin();
			$data_sptpd = array (
			'npwpd' 		=> strtoupper($_POST['npwpd']),
            'masa_pajak1'   => $_POST['txtblnmasapajak1'],
            'masa_pajak2'   => $_POST['txtblnmasapajak2'],	
			'masa_pajak_1'   => $_POST['tgl_ms_pajak1'],
            'masa_pajak_2'   => $_POST['tgl_ms_pajak2'],	
			'tahun' 		=> $_POST['txtthnmasapajak'],
			'jumlah' 	    => $jml_dibayar,
			'author' 		=> strtoupper($user)
			);
		
			//kode_rekening
			//$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '".$_POST['jenis']."'")->row();
			
			$data_child = array (
				'kd_rek' => $_POST['kd_rek'],
				'nm_rek' => $_POST['nm_rek'],
				'dp' => $jml_dibayar,
				//'tarif' => $_POST['trf'],
				'jumlah' => $jml_dibayar
			);

		if(empty($_POST['edit'])){
			$thn = date('Y');
            $no_sptpd = $this->generateNo(strftime("%Y", strtotime($_POST['tgl_terima'])));
			$dataIns = array_merge($data,array('no_sptpd' =>  $no_sptpd, 'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('sptpd_reklame', $dataIns);
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);
		} else {
            $no_sptpd = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
			$dataUpdate = array_merge($data,array('author_updated' => $user,'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('sptpd_reklame',$dataUpdate,array('no_sptpd' => $no_sptpd));
			//$this->db->delete('sptpd_reklame_detail',array('no_sptpd' => $no_sptpd));
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $no_sptpd));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $no_sptpd));
		}
		
		$this->db->query("update sptpd_reklame_detail set no_sptpd='".$no_sptpd."' where id_reklame='".$iddd."'");
               
        if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        } else {
        	$this->db->trans_commit();
            echo $no_sptpd;
        }
      }
        
        public function generateNo($thn) {
		$sql = $this->db->query("select max_sptpd from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max_sptpd + 1;
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
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/REK/'.substr($thn,2,2);
	}
	
	function reklame_detail(){
		$grid = new GridConnector($this->db->conn_id);
//		$grid->set_options("kawasan",array("1" => "AKTIF", "0"=>"TIDAK AKTIF"));
		$grid->render_table("sptpd_reklame_detail","id","id_reklame,kawasan_id,kd_rek,nm_rek,tema,kawasan,lokasi,panjang,lebar,jari,sisi,luas,unit,ketinggian,lebar_jalan,sudut_pandang,ketetapan,no_sptpd"); //17
	}
	
	function load_detail_edit($nos=""){
		$no = str_replace(".","/",$nos);
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT id_reklame,kawasan_id,kd_rek,nm_rek,tema,kawasan,lokasi,panjang,lebar,jari,sisi,luas,unit,ketinggian,lebar_jalan,sudut_pandang,ketetapan,no_sptpd FROM sptpd_reklame_detail WHERE no_sptpd='".$no."'","id","id_reklame,kawasan_id,kd_rek,nm_rek,tema,kawasan,lokasi,panjang,lebar,jari,sisi,luas,unit,ketinggian,lebar_jalan,sudut_pandang,ketetapan,no_sptpd");
	}
        
        function load_data() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->dynamic_loading(100); 
$grid->render_sql("SELECT
sptpd_reklame.id,
sptpd_reklame.npwpd,
sptpd_reklame.no_sptpd,
DATE_FORMAT(sptpd_reklame.tgl_diterima,'%d/%m/%Y') AS tgl_diterima,
sptpd_reklame.cara_hitung,
sptpd_reklame.jml_bayar,
DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,
DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') AS masa_pajak2,
sptpd_reklame.tahun_pajak,
sptpd_reklame.bulan1,
sptpd_reklame.bulan2,
sptpd_reklame.author,
DATE_FORMAT(sptpd_reklame.tgl_permohonan,'%d/%m/%Y') AS tgl_permohonan,
DATE_FORMAT(sptpd_reklame.tgl_diperiksa,'%d/%m/%Y') AS tgl_diperiksa,
sptpd_reklame.jml_dipasang,
sptpd_reklame.jml_dibayar,
sptpd_reklame.id_reklame,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sptpd_reklame_detail.tema
FROM
sptpd_reklame
INNER JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sptpd_reklame.npwpd 
INNER JOIN sptpd_reklame_detail ON sptpd_reklame.no_sptpd=sptpd_reklame_detail.no_sptpd
WHERE sptpd_reklame.sifat_reklame='permanen' ORDER BY no_sptpd DESC LIMIT 50","id","no_sptpd,npwpd,nama_perusahaan,alamat_perusahaan,tema,tgl_diterima,cara_hitung,masa_pajak1,masa_pajak2,tahun_pajak,bulan1,bulan2,author,tgl_permohonan,tgl_diperiksa,jml_dipasang,jml_dibayar,id_reklame");}
	
	public function hapus() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(sptpd) as jml from nota_hitung where sptpd = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_reklame',array('no_sptpd' => $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2')));
			$this->db->delete('sptpd_reklame_detail',array('no_sptpd' => $sq));
            $this->db->delete('sptpd',array('no_sptpd' => $sq));
            $this->db->delete('sptpd_child',array('no_sptpd' => $sq));
			$result = "Data SPTPD berhasil dihapus.";
			
			//update
			
		$idc = "1";
		$sql = $this->db->query("select max_rek from sptpd_reklame_max where id='".$idc."'")->row();		
		$maxx = $sql->max_rek;
		if($maxx=="000000000") {
					$no_urut = "000000000";						
				} else {					
					$no = $maxx - 1;
					
					if(strlen($no)==1) {
						$no_urut = '00000000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '0000000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '000000'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '00000'.$no;
					} else if(strlen($no)==5) {
						$no_urut = '0000'.$no;
					} else if(strlen($no)==6) {
						$no_urut = '000'.$no;
					} else if(strlen($no)==7) {
						$no_urut = '00'.$no;
					} else if(strlen($no)==8) {
						$no_urut = '0'.$no;
					}
									
				}		
		
		$this->db->query("update sptpd_reklame_max set max_rek='".$no_urut."' where id='".$idc."'");		
			
		} else {
			$result = "Silakan Menghapus Data Nota Hitung Terlebih Dahulu";
		}
		echo $result;
	}
	
	function stiker(){
		$sql = $this->db->query("SELECT sptpd_reklame.no_sptpd,sptpd_reklame.npwpd, identitas_perusahaan.nama_perusahaan, sptpd_reklame.author, DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, 
DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, sptpd_reklame.tahun_pajak FROM sptpd_reklame
LEFT JOIN identitas_perusahaan ON identitas_perusahaan.npwpd_perusahaan = sptpd_reklame.npwpd where sptpd_reklame.no_sptpd='".$_GET['sptpd']."'")->row();
		
		$no = substr($sql->no_sptpd,0,9);
		$no2 = $sql->npwpd;
		$no3 = $sql->nama_perusahaan;
		$tahun = $sql->tahun_pajak;
		$awal = $sql->masa_pajak1;
		$akhir = $sql->masa_pajak2;
		$nomor = $sql->no_sptpd;
		
		$arr = "REKLAME";
		//setting pdf
		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = $rs->isi;
		
		$searchArray = array("[no2]","[no3]","[nomor]","[tahun]","[awal]","[akhir]");
		$replaceArray = array($no2,$no2,$nomor,$tahun,$awal,$akhir);
		$intoString = $html;
		//now let's replace
		$report = str_replace($searchArray, $replaceArray, $intoString);
		
		//setting pdf
		$this->load->library('header/header_reklame');
		$pdf = new header_reklame('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(32);
		$pdf->SetMargins(50,110,50);
		// set font yang digunakan
		$pdf->SetFont('times', '', 12);
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('Report_'.$arr.'.pdf', 'I');

	}

	function buatid(){
		$cek =  $this->input->post('cek_baru');
		
		if($cek=="baru"){
					
		$id = "1";
		$sql = $this->db->query("select max_rek from sptpd_reklame_max where id='".$id."'")->row();		
		$maxx = $sql->max_rek;
		if($maxx=="000000000") {
					$noid = "RK."."000000001";						
				} else {					
					$no = $maxx + 1;
					
					if(strlen($no)==1) {
						$no_urut = '00000000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '0000000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '000000'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '00000'.$no;
					} else if(strlen($no)==5) {
						$no_urut = '0000'.$no;
					} else if(strlen($no)==6) {
						$no_urut = '000'.$no;
					} else if(strlen($no)==7) {
						$no_urut = '00'.$no;
					} else if(strlen($no)==8) {
						$no_urut = '0'.$no;
					}
					
					$noid = "RK.".$no_urut;		
				}
		echo $noid;	
		}
		
		$this->db->query("update sptpd_reklame_max set max_rek='".$no_urut."' where id='".$id."'");	
	}		
	
	function cetak(){
		$sql = $this->db->query("SELECT sptpd_reklame.id, sptpd_reklame.npwpd,  view_perusahaan.npwpd_lama, sptpd_reklame.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan,
 view_perusahaan.nama_pemilik, sptpd_reklame.cara_hitung, DATE_FORMAT(sptpd_reklame.tgl_diterima,'%d/%m/%Y') AS tgl_diterima, 
 sptpd_reklame.author, sptpd_reklame.sifat_reklame, DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,
  DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, 
 sptpd_reklame.jml_bayar, sptpd_reklame.waktu_pasang, sptpd_reklame.kawasan_pasang, 
 sptpd_reklame.panjang, sptpd_reklame.lebar, sptpd_reklame.jari2,sptpd_reklame.jml_bayar FROM sptpd_reklame LEFT JOIN 
view_perusahaan ON sptpd_reklame.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_reklame.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a0 = $a[0];
		$a1 = $a[1];
		$a2 = $a[2];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b0 = $b[0];
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				  = $sql->jml_bayar;
		$total				= number_format($jml,2,",",".");	
		$huruf				= '';
		$ttd				= '____________';
		$jabatan			= '................';
		$nip				= '................';
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
		$petugas			= '................';
		$npwpd_lama         = $sql->npwpd_lama;
		
		$waktu = $sql->waktu_pasang;
		if($waktu>0 && $waktu<7){
			$time = 'Sehari';
		} else if($waktu>6 || $waktu<90){
			$time = 'Sebulan';
		} else if($waktu>89 || $waktu<330){
			$time = 'Setahun';
		}
				
		$b4 = explode("/",$sql->tgl_diterima);
		$b40 = $b4[0];
		$b41 = $this->msistem->v_bln($b4[1]);
		$b42 = $b4[2];
		$tgl_b4 = $b40." ".$b41." ".$b42;
		
		//$nxa = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->rek_reklame."'")->row();
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD');
		$pdf->SetKeywords('SOPD');
	
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
					<td width="210" align="center">
						PEMERINTAH KABUPATEN  MELAWI<br />
						<b>BADAN PENDAPATAN DAERAH</b><br />
						
					</td>
					<td width="210" align="center">
						<b>DASAR PERHITUNGAN</b><br />
						<b>PAJAK REKLAME</b><br /><br/>
						Masa Pajak&nbsp;:&nbsp;'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'
					</td>
					<td width="102" align="center">
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
						<!--<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>-->
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
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
						<strong>DATA OBJEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						
						<table border="1" align="center">
						<tr>
						<td colspan="5"><br/></td>
						</tr>
						<tr align="center">							
							<td width="60" height="10">Kode</td>
							<td width="121" height="10">Nama Rekening</td>
							<td width="115" height="10">Lokasi</td>
							<td width="200" height="10">Uraian</td>
							<td width="75" height="10">Ketetapan</td>
							
						</tr>';
					$sjum = 0;
					$query = $this->db->query("SELECT kd_rek,nm_rek,tema,lokasi,kawasan,luas,unit,ketetapan FROM sptpd_reklame_detail where no_sptpd='".$sql->no_sptpd."'");
			foreach ($query->result() as $row){														
						$trf=10;
						$tarif=0;
				$report .='							
						<tr>
							<td align="center" width="60" height="10">'.$row->kd_rek.'</td>
							<td align="left" width="121" height="10">&nbsp; '.$row->nm_rek.'</td>
							<td align="left" width="115" height="10">&nbsp; '.$row->lokasi.'</td>
							<td align="left" width="200" height="10">&nbsp; '.$row->kawasan.' x '.$row->luas.'m<sup>3</sup> x '.$row->unit.'bh x '.number_format($tarif,2).' x '.$trf.'% <br/>&nbsp; Tema : '.$row->tema.'</td>
							<td align="right" width="75" height="10">'.number_format($row->ketetapan,2).' &nbsp;</td>
						</tr>';
						$sjum = $sjum + $row->ketetapan;
			}
			$report .='	
						<tr>
							<td align="center" width="496" height="10">JUMLAH</td>
							<td align="right" width="75" height="10">'.number_format($sjum,2).' &nbsp;</td>
						</tr>
						<tr>
						<td colspan="5"><br/></td>
						</tr>
						</table>						
					</td>
				</tr>
			</table>';	
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK REKLAME</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td width="572">
				<table>
<tr>
	<td colspan="4" height="10">&nbsp;</td>
</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;a.</td>
					<td width="232">Masa Pajak</td>
					<td width="10">:</td>
					<td width="300">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;b.</td>
					<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="300">Rp. '.$total.'</td>
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
				<tr>
					<td width="572" colspan="3">
						<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$tgl_b4.'</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_pemilik.'</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
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
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Jambi, '.$tgl_b4.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->author.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">'.$sql->author.'</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">&nbsp;</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$sql->author.'</td>
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
	
	function cetak2(){
		$sql = $this->db->query("SELECT sptpd_reklame.id, sptpd_reklame.npwpd,view_perusahaan.npwpd_lama, sptpd_reklame.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan,
 view_perusahaan.nama_pemilik, sptpd_reklame.cara_hitung, DATE_FORMAT(sptpd_reklame.tgl_diterima,'%d/%m/%Y') AS tgl_diterima, 
 sptpd_reklame.author, sptpd_reklame.sifat_reklame, DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,
  DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, 
 sptpd_reklame.jml_bayar, sptpd_reklame.waktu_pasang, sptpd_reklame.kawasan_pasang, 
 sptpd_reklame.panjang, sptpd_reklame.lebar, sptpd_reklame.jari2,sptpd_reklame.jml_bayar FROM sptpd_reklame LEFT JOIN 
view_perusahaan ON sptpd_reklame.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_reklame.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a0 = $a[0];
		$a1 = $a[1];
		$a2 = $a[2];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b0 = $b[0];
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				  = $sql->jml_bayar;
		$total				= number_format($jml,2,",",".");	
		$huruf				= '';
		$ttd				= '____________';
		$jabatan			= '................';
		$nip				= '................';
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
		$petugas			= '................';
		$npwpd_lama         = $sql->npwpd_lama;
		
		$waktu = $sql->waktu_pasang;
		//$lama  = $sql->selama;
		if($waktu>0 && $waktu<7){
			$time = 'Sehari';
		} else if($waktu>6 || $waktu<90){
			$time = 'Sebulan';
		} else if($waktu>89 || $waktu<330){
			$time = 'Setahun';
		}
				
		$b4 = explode("/",$sql->tgl_diterima);
		$b40 = $b4[0];
		$b41 = $this->msistem->v_bln($b4[1]);
		$b42 = $b4[2];
		$tgl_b4 = $b40." ".$b41." ".$b42;
		
		//$nxa = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->rek_reklame."'")->row();
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'FOLIO', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD');
		$pdf->SetKeywords('SOPD');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','FOLIO',false);
		//set data
		$report = '';
		
			$rek_detail = $this->db->query("SELECT a.*,b.selama,b.sifat_reklame FROM sptpd_reklame_detail a INNER JOIN sptpd_reklame b ON a.no_sptpd=b.no_sptpd where a.no_sptpd='".$_GET['sptpd']."'")->row();
			
			if($rek_detail->nm_rek=='Bilboard - Tiang dengan penerangan'){
				$penerangan = 'Ya';
			}else if($rek_detail->nm_rek=='Papan Nempel dengan penerangan'){
				$penerangan = 'Ya';
			}else if($rek_detail->nm_rek=='Papan Nempel tanpa penerangan'){
				$penerangan = 'Tidak';
			}else if($rek_detail->nm_rek=='Bilboard - Tiang tanpa penerangan'){
				$penerangan = 'Tidak';
			}else if($rek_detail->nm_rek=='Megatron/Videotron/LED'){
				$penerangan = 'Tidak';
			}
			$lama_psg = $rek_detail->selama;
			
			if($rek_detail->sudut_pandang=='lebih dari 4'){
				$sudut='> 4';
			}else{
				$sudut = $rek_detail->sudut_pandang;
			}
			
			if($rek_detail->ketinggian=='lebih dari 15 M'){
				$tinggi='> 15 M';
			}else{
				$tinggi = $rek_detail->ketinggian;
			}
			
			if($rek_detail->lebar_jalan=='lebih dari 10 M'){
				$lebar='> 10 M';
			}elseif($rek_detail->lebar_jalan=='kurang dari 2 M'){
				$lebar='< 2 M';
			}else{
				$lebar = $rek_detail->lebar_jalan;
			}
			
		$q1 = $this->db->query("SELECT lokasi,skor,bobot FROM ms_lokasi_reklame WHERE lokasi ='".$rek_detail->kawasan."'")->row();
		$query3 = $this->db->query("SELECT sudut_pandang,skor,bobot FROM ms_sudut_pandang WHERE sudut_pandang ='".$rek_detail->sudut_pandang."'")->row();
		$query2 = $this->db->query("SELECT jenis,luas_bidang FROM ms_jenis_reklame WHERE jenis ='".$rek_detail->nm_rek."'")->row();
		$query4 = $this->db->query("SELECT ketinggian,skor,bobot FROM ms_ketinggian WHERE ketinggian ='".$rek_detail->ketinggian."'")->row();
		$query5 = $this->db->query("SELECT lebar,skor FROM ms_lebar_jalan WHERE lebar ='".$rek_detail->lebar_jalan."'")->row();
		//------kawasan
			$bot_k = $q1->bobot*100;
			$k_skor = $q1->skor;
			$k_total = $k_skor*$q1->bobot;
		//-------jenis
			$luas_bid = number_format($query2->luas_bidang,2,",",".");
			$njop = $rek_detail->luas*$query2->luas_bidang;
			$njop2 =number_format($njop,2,",",".");
		//------sudut pandang
			$bot_sp = $query3->bobot*100;
			$sp_skor = $query3->skor;
			$s_total = $sp_skor*$query3->bobot;
		//------ketinggian
			$bot_ket = $query4->bobot*100;
			$ket_skor = $query4->skor;
			$ket_total = $ket_skor*$query4->bobot;
		//------lebar jalan
			$bot_leb = 0.25*100;
			$leb_skor = $query5->skor;
			$leb_total = $leb_skor*0.25; 
		
		
		
		
		if($rek_detail->luas>=0&&$rek_detail->luas<=5.99){
			$nilai_sat = 500000;
		}else if($rek_detail->luas>=6&&$rek_detail->luas<=14.99){
			$nilai_sat = 1000000;
		}else if($rek_detail->luas>=15&&$rek_detail->luas<=24.99){
			$nilai_sat = 1500000;
		}else if($rek_detail->luas>=25&&$rek_detail->luas<=35){
			$nilai_sat = 2000000;
		}else if($rek_detail->luas>35 ){
			$nilai_sat=3500000;
		}
		$jns_rek = $rek_detail->sifat_reklame;
		$nilai_titik = $k_total+$s_total+$ket_total+$leb_total;
		$nilai_sat2= number_format($nilai_sat,0,",",".");
		$ns = $nilai_sat*$nilai_titik;
		$ns2 = number_format($ns,0,",",".");
		$np = 0.1*($njop+$ns);
		$np2 = number_format($np,0,",",".");
		$total = (0.1*($njop+$ns))*$rek_detail->sisi; 
		$total2 = number_format($total,0,",",".");
			
		$report .=
			'<table border=0>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="30" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="300" align="center">
									<b><u>PERHITUNGAN PAJAK REKLAME '.strtoupper($jns_rek).'</u></b>						
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>A. DATA WAJIB PAJAK REKLAME</b>						
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;1. NO. SPTPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->no_sptpd.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;2. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;3. Nama Lembaga</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;4. Nama Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_pemilik.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;5. Jenis Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;6. SITU/SIUP</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;7. Alamat</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->alamat_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220" height="25">&nbsp;&nbsp;8. Telpon</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>B. DATA OBJEK PAJAK REKLAME</b>						
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;1. Judul Reklame</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->tema.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;2. Jenis Reklame</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->nm_rek.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;3. Luas Reklame</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->luas.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;4. Jumlah Sisi</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->sisi.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;5. Tempat Pemasagan Reklame</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->lokasi.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;6. Sudut Pandang</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sudut.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;7. Ketinggian</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$tinggi.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;8. Lebar Jalan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$lebar.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;9. Dengan Penerangan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$penerangan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;10. Lama Pemasangan/Jangka waktu</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$lama_psg.' '.$waktu.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220" height="25">&nbsp;&nbsp;11. Kawasan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$rek_detail->kawasan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="15" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="260" align="center">
									<b>C. PERHITUNGAN NILAI	SEWA PAJAK REKLAME</b>						
								</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;1. Nilai Jual Objek Pajak</td>
								<td width="10" align="center">:</td>
								<td width="340">Luas Reklame x Luas Bidang Reklame</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;</td>
								<td width="10" align="center"></td>
								<td width="340">
									<table border=1>
										<tr>
											<td width="100" align="left">
												<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$rek_detail->luas.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M<sup>2</sup></b>
											</td>
											<td width="30" align="center">
												<b>x</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="190" align="right">
												<b>'.$luas_bid.'</b>
											</td>
										</tr>
										<tr>
											<td width="130" align="center">
												<b>NJOP</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="190" align="right">
												<b>'.$njop2.'</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
								<br/>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;2. Nilai Strategis</td>
								<td width="10" align="center">:</td>
								<td width="340">
									<table border=1>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Kawasan</b>
											</td>
											<td width="55" align="center">
												<b>'.$k_skor.'</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="75" align="center">
												<b>'.$bot_k.' %</b>
											</td>
											<td width="15" align="center">
												<b>=</b>
											</td>
											<td width="34" align="center">
												<b>'.$k_total.'</b>
											</td>
										</tr>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Sudut Pandang</b>
											</td>
											<td width="55" align="center">
												<b>'.$sp_skor.'</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="75" align="center">
												<b>'.$bot_sp.' %</b>
											</td>
											<td width="15" align="center">
												<b>=</b>
											</td>
											<td width="34" align="center">
												<b>'.$s_total.'</b>
											</td>
										</tr>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Ketinggian</b>
											</td>
											<td width="55" align="center">
												<b>'.$ket_skor.'</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="75" align="center">
												<b>'.$bot_ket.' %</b>
											</td>
											<td width="15" align="center">
												<b>=</b>
											</td>
											<td width="34" align="center">
												<b>'.$ket_total.'</b>
											</td>
										</tr>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Lebar Jalan</b>
											</td>
											<td width="55" align="center">
												<b>'.$leb_skor.'</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="75" align="center">
												<b>'.$bot_leb.' %</b>
											</td>
											<td width="15" align="center">
												<b>=</b>
											</td>
											<td width="34" align="center">
												<b>'.$leb_total.'</b>
											</td>
										</tr>
										<tr>
											<td width="292" align="left">
												<b>&nbsp;&nbsp;Nilai Titik</b>
											</td>
											<td width="15" align="center">
												<b>=</b>
											</td>
											<td width="34" align="center">
												<b>'.$nilai_titik.'</b>
											</td>
										</tr>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Nilai Satuan x Nilai Titik</b>
											</td>
											<td width="55" align="center">
												<b>=</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="75" align="center">
												<b>'.$nilai_sat2.'</b>
											</td>
											<td width="15" align="center">
												<b>x</b>
											</td>
											<td width="34" align="center">
												<b>'.$nilai_titik.'</b>
											</td>
										</tr>
										<tr>
											<td width="142" align="left">
												<b>&nbsp;&nbsp;Nilai Satuan x Nilai Titik</b>
											</td>
											<td width="55" align="center">
												<b>=</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="124" align="center">
												<b>'.$ns2.'</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
								<br/>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="220">&nbsp;&nbsp;3. Nilai Pajak</td>
								<td width="10" align="center">:</td>
								<td width="340">
									<table border=1>
										<tr>
											<td width="340" align="left">
												<b>&nbsp;&nbsp;10 % x (NJOP + Nilai Strategis)</b>
											</td>
										</tr>
										<tr>
											<td width="75" align="center">
												<b>10 %</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="225" align="center">
												<b>'.number_format($njop,0,",",".").' + '.$ns2.'</b>
											</td>
										</tr>
										<tr>
											<td width="75" align="right">
												<b>Rp.</b>
											</td>
											<td width="265" align="center">
												<b>'.$np2.'</b>
											</td>
										</tr>
										<tr>
											<td width="75" align="center">
												<b>'.$rek_detail->sisi.' Sisi</b>
											</td>
											<td width="20" align="center">
												<b>x</b>
											</td>
											<td width="20" align="center">
												<b>Rp.</b>
											</td>
											<td width="225" align="center">
												<b>'.$np2.'</b>
											</td>
										</tr>
										<tr>
											<td width="75" align="right">
												<b>Rp.</b>
											</td>
											<td width="265" align="center">
												<b>'.$total2.'</b>
											</td>
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
			$us = $this->db->query("SELECT nama,nip FROM admin where username = '".$this->session->userdata('username')."'")->row();
			$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
			$s11 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '0' ")->row();
			/* if($sql->tgl_diterima>='2018-01-19'){
				$nama1 = strtoupper($s11->nama_ttd);
				$nip1 = $s11->nip_ttd;
				$jab1 = $s11->jabatan_ttd;
				$muncul = '202';
				$muncul1 = '220';
			} else {
				$nama1 = strtoupper($s1->nama_ttd);
				$nip1 = $s1->nip_ttd;
				$jab1 = $s1->jabatan_ttd;
				$muncul = '232';
				$muncul1 = '140';
			}  */
			 if($s11==NULL){
				$nama1 = '';
				$nip1 = '';
				$jab1 = '';
				$muncul = '202';
				$muncul1 = '220';
			}else{
				$nama1 = strtoupper($s11->nama_ttd);;
				$nip1 = $s11->nip_ttd;
				$jab1 = $s11->jabatan_ttd;
				$muncul = '202';
				$muncul1 = '220';
			}
				
			$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '3' ")->row();
			if($s2==NULL){
				$nama2 = '';
				$nip2 = '';
			} else {
				$nama2 = strtoupper($s2->nama_ttd);
				$nip2 = $s2->nip_ttd;
				$jab2 = $s2->jabatan_ttd;
			}
			
			
			if($us->nip=='-'){
				$nip_us = "";
			}else{
				$nip_us = 'NIP. '.$us->nip;
			}
		$report .=
			'<table border="0">
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="285">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$tgl_b4.'</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="90">&nbsp;</td>
									<td width="120" align="center">&nbsp; Petugas SIMPADA</td>
									<td width="120"></td>
									<td width="200" align="center">'.$jab2.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
									<td width="86">&nbsp;</td>
									<td width="130" align="center">&nbsp; <u>'.strtoupper($us->nama).'</u></td>
									<td width="114"></td>
									<td width="200" align="center"><u>'.$nama2.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
									<td width="75">&nbsp;</td>
									<td width="150">&nbsp;'.$nip_us.'</td>
									<td width="105"></td>
									<td width="200" align="center">NIP. '.$nip2.'</td>
								</tr>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
									<td width="250">&nbsp;</td>
									<td width="130" font-size:10px>&nbsp;Mengetahui,</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
									<td width="195">&nbsp;</td>
									<td width="170" font-size:10px>&nbsp;An. Kepala BAPENDA Kab. Melawi</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
									<td width="175">&nbsp;</td>
									<td width="210" font-size:10px>&nbsp;'.$jab1.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
									<td width="'.$muncul.'">&nbsp;</td>
									<td width="'.$muncul1.'"><u>'.$nama1.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
									<td width="202">&nbsp;</td>
									<td width="160">&nbsp;NIP. '.$nip1.'</td>
								</tr>
								
			</table>';
			
		 /*$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						
						<table border="1" align="center">
						<tr>
						<td colspan="5"><br/></td>
						</tr>
						<tr align="center">							
							<td width="60" height="10">Kode</td>
							<td width="121" height="10">Nama Rekening</td>
							<td width="115" height="10">Lokasi</td>
							<td width="200" height="10">Uraian</td>
							<td width="75" height="10">Ketetapan</td>
							
						</tr>';
					$sjum = 0;
					$query = $this->db->query("SELECT kd_rek,nm_rek,tema,lokasi,kawasan,luas,unit,ketetapan FROM sptpd_reklame_detail where no_sptpd='".$sql->no_sptpd."'");
			foreach ($query->result() as $row){														
						$trf=10;
						$tarif=0;
				$report .='							
						<tr>
							<td align="center" width="60" height="10">'.$row->kd_rek.'</td>
							<td align="left" width="121" height="10">&nbsp; '.$row->nm_rek.'</td>
							<td align="left" width="115" height="10">&nbsp; '.$row->lokasi.'</td>
							<td align="left" width="200" height="10">&nbsp; '.$row->kawasan.' x '.$row->luas.'m<sup>3</sup> x '.$row->unit.'bh x '.number_format($tarif,2).' x '.$trf.'% <br/>&nbsp; Tema : '.$row->tema.'</td>
							<td align="right" width="75" height="10">'.number_format($row->ketetapan,2).' &nbsp;</td>
						</tr>';
						$sjum = $sjum + $row->ketetapan;
			}
			$report .='	
						<tr>
							<td align="center" width="496" height="10">JUMLAH</td>
							<td align="right" width="75" height="10">'.number_format($sjum,2).' &nbsp;</td>
						</tr>
						<tr>
						<td colspan="5"><br/></td>
						</tr>
						</table>						
					</td>
				</tr>
			</table>'; */	
		
		/* $report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK REKLAME</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td width="572">
				<table>
<tr>
	<td colspan="4" height="10">&nbsp;</td>
</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;a.</td>
					<td width="232">Masa Pajak</td>
					<td width="10">:</td>
					<td width="300">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="16">&nbsp;&nbsp;b.</td>
					<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="300">Rp. '.$total.'</td>
				</tr>
<tr>
	<td colspan="4" height="10">&nbsp;</td>
</tr>
				</table>
				</td>
				</tr>
			</table>'; */
			
			/* $report .=
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
				<tr>
					<td width="572" colspan="3">
						<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$tgl_b4.'</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_pemilik.'</td>
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
			<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<br>'; */
			
			/* $report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
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
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Jambi, '.$tgl_b4.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->author.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">'.$sql->author.'</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">&nbsp;</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$sql->author.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';*/
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
	
	function getTarif(){
		$kawasan = $_POST['kawasan'];
		$jenis = $_POST['jenis'];
		$waktu_pasang = $_POST['waktu_pasang'];	
		
		//$q = $this->db->query("SELECT tarif FROM tarif_reklame WHERE kd_rek_reklame='".$jenis."' AND lokasi='".$kawasan."' AND waktu='".$waktu_pasang."'");	
		//$r = $q->row();
		$q = $this->db->query("SELECT nsl FROM tarif_reklame WHERE kd_rek_reklame='".$jenis."' AND lokasi='".$kawasan."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			//$result = $r->tarif;
			$result = $r->nsl;
			echo $result;
            
		} else {
			$result = 0;
			echo $result;
            
		}
	}
}
?>