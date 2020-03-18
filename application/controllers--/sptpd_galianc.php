<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptpd_galianc extends MY_Controller {
	
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	var $ctl_carahitung;
	var $ctl_petugasinput;

	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		$ctl_param01="'txt_thn_masa_pajak','txt_bln_masa_pajak1','txt_bln_masa_pajak2','txt_tgl_masa_pajak3', 'txt_tgl_masa_pajak4'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak1", $this->input->post("txt_bln_masa_pajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak2", $this->input->post("txt_bln_masa_pajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txt_thn_masa_pajak", $this->input->post("txt_thn_masa_pajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txt_cara_hitung",$this->input->post("txt_cara_hitung"), " style='width:300px'");
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		$ctl_jenisgalian = $this->zieGenCombo("JENIS_GALIAN", "txt_jenis_galian",$this->input->post("txt_jenis_galian"),"");
		$tarif = $this->db->query("select tarif_pajak from master_rekening where jns_pajak ='06'")->row();
		
		$data['dop'] = $this->db->get('tb_galianc_objek_pajak');
		//$data['dop'] = $this->db->query('SELECT * FROM tb_galianc_objek_pajak');
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_jenisgalian']=$ctl_jenisgalian;
		$data['tarif'] = $tarif->tarif_pajak;
		$data['kec'] = $this->db->query("SELECT * FROM kecamatan");
		//$data['defNoSptpd']="/GAL/".date('y');
		$this->load->view('data/sptpd_view_galianc',$data);
	}
	
	function bank(){
		$ctl_param01="'txt_thn_masa_pajak','txt_bln_masa_pajak1','txt_bln_masa_pajak2','txt_tgl_masa_pajak3', 'txt_tgl_masa_pajak4'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak1", $this->input->post("txt_bln_masa_pajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak2", $this->input->post("txt_bln_masa_pajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txt_thn_masa_pajak", $this->input->post("txt_thn_masa_pajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txt_cara_hitung",$this->input->post("txt_cara_hitung"), " style='width:300px'");
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		$ctl_jenisgalian = $this->zieGenCombo("JENIS_GALIAN", "txt_jenis_galian",$this->input->post("txt_jenis_galian"),"");

		$data['dop'] = $this->db->get('tb_galianc_objek_pajak');
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_jenisgalian']=$ctl_jenisgalian;
		//$data['defNoSptpd']="/GAL/".date('y');
		$this->load->view('data/galianc_bank',$data);
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
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where LEFT(a.npwpd_perusahaan,2)='11' AND $cu");
		
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
	
	function detail(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("sptpd_galianc_d1","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, id_galianc, sptpd");
	}
	
	function d_data(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['sptpd'])) {
			$grid->render_sql("select kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, id_galianc, sptpd from sptpd_galianc_d1 where sptpd = '".$_GET['sptpd']."'","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, id_galianc, sptpd");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, id_galianc, sptpd from sptpd_galianc_d1","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, id_galianc, sptpd");
		}
	}
	
	public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.keperluan, a.jenis_galian, a.omset, a.petugas_input, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.tarif, a.id_galianc from sptpd_galianc a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd c on c.no_sptpd = a.no_sptpd ","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, keperluan, jenis_galian, omset, petugas_input, masa_pajak1, masa_pajak2, jml_bayar,tarif,id_galianc");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.keperluan, a.jenis_galian, a.omset, a.petugas_input, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.tarif from sptpd_galianc a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd c on c.no_sptpd = a.no_sptpd
where a.author = '".$this->session->userdata('username')."'","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, keperluan, jenis_galian, omset, petugas_input, masa_pajak1, masa_pajak2, jml_bayar,tarif");	
	}
	
	public function data_sptpd_d1() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kd_rek, a.volume, a.harga_pasar, a.dp from sptpd_galianc_d1 a ","id","id, kode_galian, volume, harga_pasar, dp");	
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal=$this->input->post('awal');
		$akhir=$this->input->post('akhir');
		$tahun=$this->input->post('tahun');
 	    //$JnsGalian = $this->input->post('jnsSPT');
        $JnsGalian = $this->input->post("txt_jenis_galian");
        //$JnsGalian = $ctl_jenisgalian;
        if($JnsGalian == 'Rutin'){
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
				
		//$query = $this->db->query("select npwpd from sptpd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
//		if($query!=NULL){
//			$text = "Maaf pendataan SPTPD sudah dilakukan";
//		} else {
//			$text = 0;
//		}
//		echo $text;
	}		
	
	function buatid(){
		$cek =  $this->input->post('cek_baru');
		
		if($cek=="baru"){
					
		$id = "1";
		$sql = $this->db->query("select max_rek from sptpd_galianc_max where id='".$id."'")->row();		
		$maxx = $sql->max_rek;
		if($maxx=="000000000") {
					$noid = "GAL."."000000001";						
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
					
					$noid = "GAL.".$no_urut;		
				}
		echo $noid;	
		}
		
		$this->db->query("update sptpd_galianc_max set max_rek='".$no_urut."' where id='".$id."'");	
	}

	public function simpan_sptpd() {
		$username = strtoupper($this->session->userdata('username'));
				
		if($this->input->post('txt_tgl_masa_pajak1')!=""){
			$arrMPjk1=explode("/",$this->input->post('txt_tgl_masa_pajak1'));
			$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
			$arrMPjk2=explode("/",$this->input->post('txt_tgl_masa_pajak2'));
			$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];

		}

		$arrTglDiterima=explode("/",$this->input->post('tgl_diterima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
		
		$jml = $this->input->post('jumlah');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$setoran = $this->input->post('setoran');
		if(strpos($setoran, '.')){
			$setoran = str_replace('.', '', $setoran);
		} else {
			$setoran;
		}
		$iddd = $this->input->post('buatidf');
		$data = array (
			'npwpd' => $this->input->post('npwpd'),
			'cara_hitung' => $this->input->post('cara_hitung'),
			'jenis_galian' => $this->input->post('jenis_galian'),
			'petugas_input' => $this->input->post('petugas_input'),
			'keperluan' => $this->input->post('keperluan'),
			'tgl_diterima' 	=> $tglditerima,
			'rekening' => '4.1.1.11',
			'masa_pajak1'	=> $masapajak1,
			'masa_pajak2'	=> $masapajak2,
			'omset'	=> $jml,
			'tarif' => $this->input->post('tarif'),
			'jml_bayar'	=> $setoran,
			'author' 	=> $username,
			'kecamatan' 	=> $this->input->post('kec'),
			'id_galianc' => $iddd
		);
		
		$awal = explode('-',$masapajak1);
		$akhir = explode('-',$masapajak2);
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('npwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
			'masa_pajak_1'	=> $masapajak1,
			'masa_pajak_2'	=> $masapajak2,
			'tahun' 			=> $akhir[0],
			'jumlah' 	=> $setoran,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '4.1.1.11'")->row();
		
		$data_child = array (
			'kd_rek' => '4.1.1.11',
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $jml,
			'tarif' => $this->input->post('tarif'),
			'jumlah' => $setoran
		);
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd_galianc', $dataUpd, array('id' => $this->input->post('id')));
			$this->db->delete('sptpd_galianc_d1', array('sptpd' => $this->input->post('sptpd')));
			$result = $this->input->post('sptpd');
		
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $result,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $this->input->post('sptpd')));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $result));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $this->input->post('sptpd')));
			
		} else {
			$thn = date('Y');
			$no_sptpd=$this->generateNo(date("Y",strtotime($tglditerima)));
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$this->db->insert('sptpd_galianc',$dataIns);
			$result = $no_sptpd;
			
			$this->db->query("update sptpd_galianc_d1 set sptpd='".$no_sptpd."' where id_galianc='".$iddd."'");
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);						
		}
		
		echo $result;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_sptpd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/GAL/'.substr($thn,2,2);
	}

	public function get_npwpd(){
		$query = $this->db->query("select nama_pemilik, alamat_pemilik from view_perusahaan where npwpd_pemilik like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			$result="document.frmData.txt_nama_perusahaan.value='".$query->result()->nama_pemilik."'; ";
			$result.="document.frmData.txt_alamat.value='".$query->result()->alamat_pemilik."'; ";
		}else{
			$query = $this->db->query("select nama_perusahaan, alamat_perusahaan from identitas_perusahaan where npwpd_perusahaan like '".$this->input->post('id')."' ");
			if($query->num_rows() > 0){
				$result="document.frmData.txt_nama_perusahaan.value='".$query->result()->nama_pemilik."'; ";
				$result.="document.frmData.txt_alamat.value='".$query->result()->alamat_pemilik."'; ";
				//$result=" document.frmData.txtnpwpd_nama.value='".$query->result()->nama_perusahaan."'; ";
				//$result.=" document.frmData.txtnpwpd_alamat.value='".$query->result()->alamat_perusahaan."'; ";
			}else{
				$result="alert('Data tidak ditemukan!!!');";
			}
		}
		$result="alert('".$query->result()->nama_perusahaan."');";
		echo $result;
	}
	
	public function get_gal_objek_pajak(){
		$query = $this->db->query("select id, keterangan from tb_galianc_objek_pajak ");
		$result="";
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$result.=" combo.put('".$row->id."','".$row->keterangan."');";
			}
		}else{
			$result="alert('Data tidak ditemukan....');";
		}
		echo $result;
	}

	public function get_data_by_id(){
		$query = $this->db->query("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.keperluan, a.jenis_galian, a.masa_pajak1, a.masa_pajak2, a.author, a.created, a.modified, a.petugas_input from sptpd_galianc a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.id like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$gabung = explode('/',$row->no_sptpd);
				
				$result=" document.frmData.id.value='".$row->id."'; ";
				$result.=" document.frmData.txtnosptpd_a.value='".$gabung[0]."'; ";
				$result.=" document.frmData.txtnosptpd_b.value='".$gabung[1]."/".$gabung[2]."'; ";
				$result.=" document.frmData.txt_npwpd.value='".$row->npwpd."'; ";
				$result.=" document.frmData.txt_nama_perusahaan.value='".$row->nama_perusahaan."'; ";
				$result.=" document.frmData.txt_alamat.value='".$row->alamat_perusahaan."'; ";
				$result.=" document.frmData.txt_cara_hitung.value='".$row->cara_hitung."'; ";
				$result.=" document.frmData.txt_tgl_diterima.value='".$this->rotateTgl($row->tgl_diterima)."'; ";
				$result.=" document.frmData.txt_keperluan.value='".$row->keperluan."'; ";
				$result.=" document.frmData.txt_jenis_galian.value='".$row->jenis_galian."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak3.value='".$this->rotateTgl($row->masa_pajak1)."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak4.value='".$this->rotateTgl($row->masa_pajak2)."'; ";
				
			}
		}else{
			$result="alert('Data tidak ditemukan....');";
		}
		//$result="alert('".$query->result()->nama_perusahaan."');";
		echo $result;
	}
	
	public function rotateTgl($iTgl){
		if($iTgl!=""){
			$arr_tgl = explode("-",$iTgl);
		}else{
			$arr_tgl = "";
		}
		if(is_array($arr_tgl)){
			return $arr_tgl[2]."/".$arr_tgl[1]."/".$arr_tgl[0];
		}else{
			return "";
		}
	}

	public function delete_sptpd() {
	   	$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		///$s = explode('/',$this->input->post('sptpd_1'));
		//$sq = $s[0]."".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from sspd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_galianc',array('no_sptpd' => $sq));
			$this->db->delete('sptpd',array('no_sptpd' => $sq));
			$this->db->delete('sptpd_child',array('no_sptpd' => $sq));
			$this->db->delete('sptpd_galianc_d1',array('sptpd' => $sq));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "Data tidak bisa dihapus No.SPTPD ini sudah ditransaksikan di SSPD, Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		$arr_data=array();
		if($ctlType=="BULAN"){
			$arr_data=array("00"=>"", "01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			$arr_data=array(""=>"","2016"=>"2016", "2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021");
		}elseif($ctlType=="CARA_HITUNG"){
			$arr_data=array("1"=>"Official Assesment (Dihitung dan ditetapkan oleh Bapenda ",
							"2"=>"Self Assesment (Menghitung dan Menetapkan Pajak Sendiri)");
		}elseif($ctlType=="PETUGAS_INPUT"){
			//Karena belum ada table petugas inputor, maka digunakan array data
			// jika sudah ada, maka akan di link kan ke function zieGetPetugasInput
			$arr_data=array("ESRARS"=>"ESRA R. SIMATUPANG", 
							"ZAHRAHAM"=>"ZAHRATUL HAMIDAH");
		}elseif($ctlType=="GOLONGAN_TARIF"){
			$query = $this->db->query("select id, golongan_tarif from tb_golongan_tarif");
			foreach ($query->result() as $row){
			   $arr_data[$row->id]=$row->golongan_tarif;
			}
		}else{
			$query = $this->db->query("select id, keterangan from tb_".strtolower($ctlType));
			foreach ($query->result() as $row){
			   $arr_data[$row->id]=$row->keterangan;
			}
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

	function get_harga(){
		$op = $this->input->post('objek');
		$kec = $this->input->post('kec');

		$query = $this->db->query("SELECT a.*,b.nama_kecamatan FROM tb_harga_dasar_minerba a INNER JOIN kecamatan b ON a.kode_kecamatan=b.kode_kecamatan WHERE a.kode_kecamatan ='".$kec."'")->row();
		$harga = $query->harga1;
		$harga2 = $query->harga2;
		$harga3 = $query->harga3;
		$harga4 = $query->harga4;
		$harga5 = $query->harga5;
		$harga6 = $query->harga6;
		$harga7 = $query->harga7;
		$harga8 = $query->harga8;
		$harga9 = $query->harga9;
		$harga10 = $query->harga10;
		$harga11 = $query->harga11;
		$harga12 = $query->harga12;
		$harga13 = $query->harga13;
		$harga14 = $query->harga14;
		$harga15 = $query->harga15;
		$harga16 = $query->harga16;
		$harga17 = $query->harga17;
		$harga18 = $query->harga18;

		$query2 = $this->db->query("SELECT * FROM tb_galianc_objek_pajak WHERE auto ='".$op."'")->row();
		$jns_minerba = $query2->auto;
		$hrg_psr = $query2->harga_pasar;
		
		if($jns_minerba=='1'){
			$nilai_sat = $harga;
		}else if($jns_minerba=='2'){
			$nilai_sat = $harga2;
		}else if($jns_minerba=='3'){
			$nilai_sat = $harga3;
		}else if($jns_minerba=='4'){
			$nilai_sat = $harga4;
		}else if($jns_minerba=='5'){
			$nilai_sat = $harga5;
		}else if($jns_minerba=='6'){
			$nilai_sat = $harga6;
		}else if($jns_minerba=='7'){
			$nilai_sat = $harga7;
		}else if($jns_minerba=='8'){
			$nilai_sat = $harga8;
		}else if($jns_minerba=='9'){
			$nilai_sat = $harga9;
		}else if($jns_minerba=='10'){
			$nilai_sat = $harga10;
		}else if($jns_minerba=='11'){
			$nilai_sat = $harga11;
		}else if($jns_minerba=='12'){
			$nilai_sat = $harga12;
		}else if($jns_minerba=='13'){
			$nilai_sat = $harga13;
		}else if($jns_minerba=='14'){
			$nilai_sat = $harga14;
		}else if($jns_minerba=='15'){
			$nilai_sat = $harga15;
		}else if($jns_minerba=='16'){
			$nilai_sat = $harga16;
		}else if($jns_minerba=='17'){
			$nilai_sat = $harga17;
		}else if($jns_minerba=='18'){
			$nilai_sat = $harga18;
		}
		
		echo $hrg_psr;
	}
	
	function cetak(){
		$sql = $this->db->query("SELECT sptpd_galianc.id, sptpd_galianc.npwpd, view_perusahaan.npwpd_lama, sptpd_galianc.no_sptpd, view_perusahaan.nama_perusahaan, 
view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, sptpd_galianc.jenis_galian, sptpd_galianc.keperluan, 
sptpd_galianc.cara_hitung, DATE_FORMAT(sptpd_galianc.tgl_diterima,'%d/%m/%Y') AS tgl_diterima, sptpd_galianc.petugas_input,
 DATE_FORMAT(sptpd_galianc.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, DATE_FORMAT(sptpd_galianc.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, 
 sptpd_galianc.omset, sptpd_galianc.jml_bayar FROM sptpd_galianc 
LEFT JOIN view_perusahaan ON sptpd_galianc.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_galianc.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$npwpd_lama			= $sql->npwpd_lama;
		
		//$jml				  = $sql->jml_bayar;
		$total				= number_format($sql->omset,2,",",".");
		//$pajaks				= ($jml*$tarif)/100;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal = $days.' '.$m.' '.date('Y');
		
		$c			= $sql->tgl_diterima;
		$arr = explode("/",$c);
		$s = $arr[1];
		$bln = $this->msistem->v_bln($s);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
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
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="50" align="center" valign="middle">&nbsp;</td>
					<td width="205" align="center">
						PEMERINTAH KABUPATEN  MELAWI<br />
						<b>BADAN PENDAPATAN DAERAH</b><br />
						
					</td>
					<td width="227" align="center">
						<b>SURAT PEMBERITAHUAN PAJAK DAERAH</b><br />
						<b>PAJAK MINERAL BUKAN LOGAM DAN BATUAN</b><br /><br/>
						Masa Pajak&nbsp; : &nbsp;'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'
					</td>
					<td width="90" align="center">
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;2. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;3. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
							<tr>
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
						<strong>DATA OBJEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$child = $this->db->query('select * from sptpd_galianc_d1 where sptpd = "'.$sql->no_sptpd.'"');
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="10">&nbsp;&nbsp;</td>
								<td colspan="3"><br/><br/>
								<table border="1">
									<tr>
										<th width="60" align="center"><strong>Rekening</strong></th>
										<th width="130" align="center"><strong>Nama Objek</strong></th>
										<th width="230" align="center" colspan="3"><strong>Uraian</strong></th>										
										<th width="35" align="center"><strong>Tarif</strong></th>										
										<th width="100" align="center"><strong>Jumlah</strong></th>
									</tr>';
								
								//$tvol = 0;
								//$thd = 0;
								//$tdp = 0;
								//$tar = 0;
								$jm = 0;
								foreach($child->result() as $rs){
									$hp	= number_format($rs->harga_pasar,2,",",".");
									$dp	= number_format($rs->dp,2,",",".");
									$tarif	= $rs->tarif;
									$jumlah	= number_format($rs->jumlah,2,",",".");
									$report .=
										'<tr>
											<td width="60" align="center">'.$rs->kd_rek.'</td>
											<td width="130" align="left">&nbsp;'.$rs->nm_rek.'</td>
											<td width="230" align="center">&nbsp;Rp. '.$hp.' x '.number_format($rs->volume,3,",",".").'&nbsp;m<sup>3</sup></td>											
											<td width="35" align="center">&nbsp;'.$tarif.' %&nbsp;</td>
											<td width="100" align="right">&nbsp;Rp. '.$jumlah.'&nbsp;</td>
										</tr>';
										//$tvol = $tvol + $rs->volume;
										//$thd = $thd + $rs->harga_pasar;
										//$tdp = $tdp + $rs->dp;
										//$tar = $tar + $rs->tarif;
										$jm = $jm + $rs->jumlah;
								}
		$report .=
								'
								<tr>
									<td width="455" align="center" colspan="6"><strong>Jumlah</strong></td>									
									<td width="100" align="right"><strong>&nbsp;Rp. '.number_format($jm,2,",",".").'&nbsp;</strong></td>
								</tr>
								</table><br/>
								</td>
								<td width="10">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
				
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK MINERAL BUKAN LOGAM DAN BATUAN</strong>
					</td>
				</tr>
			</table>';
		
		if($a1=='01'){
			$a1 = 12;
			$tahun = $tahun-1;
		} else {
			$a1 = $a1-1;
		}
		
		if(strlen($a1)==1) {
			$a1 = '0'.$a1;
		}
		
		//$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2, 
//        c.tarif from sspd a left join sptpd_galianc b on a.nomor=b.no_sptpd left join sptpd_child c 
//        on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();
        
         $set = $this->db->query("SELECT a.ketetapan, a.setoran, f.masa_pajak1, f.masa_pajak2,
         e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_galianc f ON b.no_sptpd=f.no_sptpd 
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
		
		$get_child = $this->db->query('select * from sptpd_galianc_d1 where sptpd = "'.$sql->no_sptpd.'"')->row();
		$get_tarif = $get_child->tarif;
		
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
								<td width="232">Pajak Terhutang </td>
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
								<td width="282">'.$get_tarif.'%</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$pajak.'</td>
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
							<td>
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
									<td width="200" align="center">'.$sql->nama_perusahaan.'</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center"></td>
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
                            <td width="61%">'.$sql->tgl_diterima.'</td>
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