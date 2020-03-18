<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptpd_hiburan extends MY_Controller {
	
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
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txtcarahitung",$this->input->post("txtcarahitung"), " style='width:300px'");
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		
		$ctl_jenispajakhiburan = $this->zieGenRadio("JENIS_PAJAK_HIBURAN", "txtjenispajakhiburan",$this->input->post("txtjenispajakhiburan"));
		$ctl_jenishiburan = $this->db->query("select kd_rek, nm_rek from master_rekening where jns_pajak ='03' and status_aktif='1'");

		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_jenispajakhiburan']=$ctl_jenispajakhiburan;
		$data['ctl_jenishiburan']=$ctl_jenishiburan;
		//$data['defNoSptpd']="/HIB/".date('y');
		$this->load->view('data/sptpd_view_hiburan',$data);
	}
	
	public function bank(){
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txtcarahitung",$this->input->post("txtcarahitung"), " style='width:300px'");
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txtpetugasinput",$this->input->post("txtpetugasinput"));
		$ctl_petugasinput = $this->session->userdata('username');
		
		$ctl_jenispajakhiburan = $this->zieGenRadio("JENIS_PAJAK_HIBURAN", "txtjenispajakhiburan",$this->input->post("txtjenispajakhiburan"));
		$ctl_jenishiburan = $this->db->query("select kd_rek, nm_rek from master_rekening where jns_pajak ='03' and status_aktif='1'");

		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_jenispajakhiburan']=$ctl_jenispajakhiburan;
		$data['ctl_jenishiburan']=$ctl_jenishiburan;
		//$data['defNoSptpd']="/HIB/".date('y');
		$this->load->view('data/hiburan_bank',$data);	
	}
	
	public function tarif(){
		$kd_rek = $this->input->post('jns');
		$query = $this->db->query("select tarif_pajak from master_rekening where kd_rek = '".$kd_rek."'")->row();
		$tarif = $query->tarif_pajak;
		echo $tarif;
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
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where  $cu");
		
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
		$grid->render_table("sptpd_hiburan_d1","id","kelas, nominal, sptpd, id");
	}
	
	function de_data(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['sptpd'])) {
			$grid->render_sql("select kelas, nominal, sptpd, id from sptpd_hiburan_d1 where sptpd = '".$_GET['sptpd']."'","id","kelas, nominal, sptpd, id");
		} else {
			$grid->render_sql("select kelas, nominal, sptpd, id from sptpd_hiburan_d1","id","kelas, nominal, sptpd, id");
		}
	}
	
	public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.jenis_pajak, a.ket_insidentil, a.cara_hitung, a.tgl_diterima, a.jenis_hiburan, a.jml_biasa, a.jml_libur, a.rata2_biasa, a.rata2_libur, a.jml_meja_mesin, a.jml_ruangan, a.karcis_bebas, a.jml_karcis, a.mesin_tiket, a.pembukuan, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.author, a.created, a.modified, a.petugas_input, a.omset, a.tarif from sptpd_hiburan a left join identitas_perusahaan b on b.npwpd_perusahaan=a.npwpd","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, jenis_pajak, ket_insidentil, cara_hitung, tgl_diterima, jenis_hiburan, jml_biasa, jml_libur, rata2_biasa, rata2_libur, jml_meja_mesin, jml_ruangan, karcis_bebas, jml_karcis, mesin_tiket, pembukuan, masa_pajak1, masa_pajak2, jml_bayar, author, created, modified, petugas_input, omset,tarif");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.jenis_pajak, a.ket_insidentil, a.cara_hitung, a.tgl_diterima, a.jenis_hiburan, a.jml_biasa, a.jml_libur, a.rata2_biasa, a.rata2_libur, a.jml_meja_mesin, a.jml_ruangan, a.karcis_bebas, a.jml_karcis, a.mesin_tiket, a.pembukuan, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.author, a.created, a.modified, a.petugas_input, a.omset, a.tarif from sptpd_hiburan a left join identitas_perusahaan b on b.npwpd_perusahaan=a.npwpd where a.author = '".$this->session->userdata('username')."'","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, jenis_pajak, ket_insidentil, cara_hitung, tgl_diterima, jenis_hiburan, jml_biasa, jml_libur, rata2_biasa, rata2_libur, jml_meja_mesin, jml_ruangan, karcis_bebas, jml_karcis, mesin_tiket, pembukuan, masa_pajak1, masa_pajak2, jml_bayar, author, created, modified, petugas_input, omset,tarif");	
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$arrMPjk1=explode("/",$this->input->post('awal'));
		$awal=$arrMPjk1[1];
		
		$arrMPjk2=explode("/",$this->input->post('akhir'));
		$akhir=$arrMPjk2[1];

		$tahun=$arrMPjk2[2];
		$spt = $this->input->post('jnsSPT');
		
		if($spt == 'REGULAR'){
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
	
	public function simpan_sptpd() {
		$username = strtoupper($this->session->userdata('username'));
		//$username = 'ADMIN';
		
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
			'npwpd' 			=> $this->input->post('txtnpwpd'),
			'nama_perusahaan'	=> $this->input->post('txtnpwpd_nama'),
			'alamat'			=> $this->input->post('txtnpwpd_alamat'),
			'jenis_pajak'		=> $this->input->post('txtjenispajakhiburan'),
			'ket_insidentil'	=> $this->input->post('txtketinsidentil'),
			'cara_hitung'		=> $this->input->post('txtcarahitung'),
			'tgl_diterima' 		=> $tglditerima,
			'jenis_hiburan' 	=> $this->input->post('txtjenishiburan'),
			'jml_biasa' 		=> $this->input->post('txtjmlbiasa'),
			'jml_libur' 		=> $this->input->post('txtjmllibur'),
			'rata2_biasa' 		=> $this->input->post('txtrata2biasa'),
			'rata2_libur' 		=> $this->input->post('txtrata2libur'),
			'jml_meja_mesin' 	=> $this->input->post('txtjmlmejamesin'),
			'jml_ruangan' 		=> $this->input->post('txtjmlruangan'),
			'karcis_bebas' 		=> $this->input->post('txtkarcisbebas'),
			'jml_karcis' 		=> $this->input->post('txtjmlkarcis'),
			'mesin_tiket' 		=> $this->input->post('txtmesintiket'),
			'pembukuan' 		=> $this->input->post('txtpembukuan'),
			'masa_pajak1' 		=> $masapajak1,
			'masa_pajak2' 		=> $masapajak2,
			'omset' 		=> $txtpajakditerima,
			'tarif' 		=> $this->input->post('tarif'),
			'jml_bayar' 		=> $txtpajakterutang,
			'petugas_input' 	=> $this->input->post('txtpetugasinput'),
			'author' 	=> $username
		);
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('txtnpwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $arrMPjk1[1],
			'masa_pajak2'	=> $arrMPjk2[1],
			'tahun' 			=> $arrMPjk2[2],
			'jumlah' 	=> $txtpajakterutang,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '".$this->input->post('txtjenishiburan')."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($this->input->post('txtjenishiburan')),
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp'	=> $txtpajakditerima,
			'tarif' => $this->input->post('tarif'),
			'jumlah' => $txtpajakterutang
		);		
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd_hiburan', $dataUpd, array('id' => $this->input->post('id')));
			$this->db->delete('sptpd_hiburan_d1', array('sptpd' => $this->input->post('sptpd')));
			$no_sptpd = $this->input->post('sptpd');
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $this->input->post('sptpd')));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $this->input->post('sptpd')));
			
		} else {
			$thn = date('Y');
			$no_sptpd=$this->generateNo($arrMPjk2[2]);
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$this->db->insert('sptpd_hiburan',$dataIns);
			
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
		
		return $jml.'/HIB/'.substr($thn,2,2);
	}


	public function get_npwpd(){
		$query = $this->db->query("select nama_pemilik, alamat_pemilik from view_perusahaan where npwpd_pemilik like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			$result="document.frmData.txtnpwpd_nama.value='".$query->result()->nama_pemilik."'; ";
			$result.="document.frmData.txtnpwpd_alamat.value='".$query->result()->alamat_pemilik."'; ";
		}else{
			$query = $this->db->query("select nama_perusahaan, alamat_perusahaan from identitas_perusahaan where npwpd_perusahaan like '".$this->input->post('id')."' ");
			if($query->num_rows() > 0){
				//$result=" document.frmData.txtnpwpd_nama.value='".$query->result()->nama_perusahaan."'; ";
				//$result.=" document.frmData.txtnpwpd_alamat.value='".$query->result()->alamat_perusahaan."'; ";
			}else{
				$result="alert('Data tidak ditemukan!!!');";
			}
		}
		$result="alert('".$query->result()->nama_perusahaan."');";
		echo $result;
	}
	
	public function get_kelas(){
		$query = $this->db->query("select kelas, nominal from sptpd_hiburan_d1 where npwpd like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			$arr_kelas=array(0=>"a",1=>"b",2=>"c");
			$i=0;
			$result="";
			foreach($query->result() as $row){
				$result.="document.frmData.txtkelas_".$arr_kelas[$i].".value='".$row->kelas."';";
				$result.="document.frmData.txtrpkelas_".$arr_kelas[$i].".value='".$row->nominal."';";
				$i++;
			}
			
		}else{
			$result="alert('Data Kosong...');";
		}
		echo $result;
	}

	public function delete_sptpd() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from sspd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_hiburan_d1',array('sptpd' => $sq));
			$this->db->delete('sptpd_hiburan',array('no_sptpd' => $sq));
			$this->db->delete('sptpd',array('no_sptpd' => $sq));
			$this->db->delete('sptpd_child',array('no_sptpd' => $sq));
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
			$arr_data=array(""=>"","2010"=>"2010", "2011"=>"2011", "2012"=>"2012", "2013"=>"2013", "2014"=>"2014", "2015"=>"2015");
		}elseif($ctlType=="CARA_HITUNG"){
			$arr_data=array(/*"1"=>"Official Assesment (Dihitung dan ditetapkan oleh Pejabat Dispenda) ", */
							"2"=>"Self Assesment (Menghitung dan Menetapkan Pajak Sendiri)");
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
	
	public function zieGenRadio($ctlType, $ctlId, $iSelValue, $iEvent=""){
		$arr_data=array();$ret="";
		if($ctlType=="JENIS_PAJAK_HIBURAN"){
			$query = $this->db->query("select id, keterangan from tb_".strtolower($ctlType));
			foreach ($query->result() as $row){
			   $arr_data[$row->id]=$row->keterangan;
			}
		}

		foreach($arr_data as $key=>$value){
			if($key==$iSelValue){
				$ret.="<input checked type=\"radio\" name=\"$ctlId\" id=\"$ctlId\" value=\"$key\"> $value &nbsp;&nbsp;";
			}else{
				$ret.="<input type=\"radio\" name=\"$ctlId\" id=\"$ctlId\" value=\"$key\"> $value &nbsp;&nbsp;";
			}
		}
		return $ret;
	}

	public function zieGetPetugasInput(){

		$this->db->select('petugas.id, petugas.name');
		$this->db->from('tb_petugas');
		
		return $this->db->get()->result_array();
	}  
	
	public function cetak(){
		$sql = $this->db->query("select sptpd_hiburan.id, sptpd_hiburan.jml_meja_mesin, sptpd_hiburan.cara_hitung, sptpd_hiburan.jml_ruangan, sptpd_hiburan.jenis_hiburan, sptpd_hiburan.npwpd, sptpd_hiburan.no_sptpd, sptpd_hiburan.jml_biasa, sptpd_hiburan.jml_libur, sptpd_hiburan.rata2_biasa, sptpd_hiburan.rata2_libur, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, sptpd_hiburan.cara_hitung, DATE_FORMAT(sptpd_hiburan.tgl_diterima,'%d/%m/%Y') as tgl_terima, sptpd_hiburan.petugas_input, DATE_FORMAT(sptpd_hiburan.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hiburan.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hiburan.omset, sptpd_hiburan.tarif, sptpd_hiburan.jml_bayar from sptpd_hiburan left join view_perusahaan on sptpd_hiburan.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_hiburan.no_sptpd='".$_GET['sptpd']."'")->row();
	
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a[1]);
		$b = explode("/",$sql->masa_pajak2);
		$akhir 				= $this->msistem->v_bln($b[1]);
		$tahun				= $b[2];
		$bulan1 = $a[0].' '.$awal.' '.$tahun;
		$bulan2 = $b[0].' '.$akhir.' '.$tahun;		
		$total				= number_format($sql->omset,2,",",".");
		$tarif				= $sql->tarif.'%';
		$nilai_tarif1		 = number_format($sql->jml_bayar,2,",",".");
		$m	= $this->msistem->v_bln(date('m'));
		$day = date('d');
		$tgl			= $day.' '.$m.' '.date('Y');
		$petugas			= $sql->petugas_input;
		$cara = $sql->cara_hitung;
		$jenis = $sql->jenis_hiburan;
		
		
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
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="210" align="center">
						SURAT PEMBERITAHUAN PAJAK DAERAH<br />
						PAJAK HIBURAN<br />
						Masa Pajak&nbsp;&nbsp;: '.$awal.' - '.$akhir.'<br />
						Tahun:'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SPTPD<br />
						'.$sql->no_sptpd.'
					</td>
				</tr>
			</table>';
		$report .=
			'<table border=1>
				<tr>
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
								<td width="120">&nbsp;&nbsp;2. N.P.W.P.D</td>
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
						<strong>DATA OBYEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$child = $this->db->query('select * from sptpd_hiburan_d1 where sptpd = "'.$sql->no_sptpd.'"');	
		$que = $this->db->query('select keterangan from tb_jenis_hiburan where id ="'.$sql->jenis_hiburan.'"')->row();
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="3" height="10" width="572">&nbsp;</td>
</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;1. Hiburan yang Diselenggarakan</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$que->keterangan.'</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;2. Harga Tiket yang Berlaku</td>
					<td width="10" align="center"></td>
					<td width="273"></td>
				</tr>';
				
			foreach($child->result() as $rs){
				$nominal = number_format($rs->nominal,2,",",".");
		$report .= '<tr>
					<td width="201">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;'.$rs->kelas.'</td>
					<td width="10" align="center">:</td>
					<td width="273">Rp. '.$nominal.'</td>
				</tr>';
			}
			
		$report .= '<tr>
					<td width="201">&nbsp;&nbsp;3. Jumlah Pertunjukan Pada Hari Biasa</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->jml_biasa.' Kali</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;4. Jumlah Pertunjukan Pada Hari Libur</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->jml_libur.' Kali</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;5. Jumlah Pengunjung pada Hari Biasa</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->rata2_biasa.' Kali</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;6. Jumlah Pengunjung pada Hari Libur</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->rata2_libur.' Kali</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;7. Jumlah Meja/Mesin</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->jml_meja_mesin.' Meja/Mesin</td>
				</tr>
				<tr>
					<td width="201">&nbsp;&nbsp;8. Jumlah Kamar/Ruangan</td>
					<td width="10" align="center">:</td>
					<td width="273">'.$sql->jml_ruangan.' Kamar/Ruangan</td>
				</tr>
<tr>
	<td colspan="3" height="10" width="572">&nbsp;</td>
</tr>
				</table>
				</td>
				</tr>
			</table>';
		/*if($cara!=1){*/
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK HIBURAN</strong>
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
		
//		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2,
//         c.tarif from sspd a left join sptpd_hiburan b on a.nomor=b.no_sptpd left join sptpd_child c 
//         on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();

        $set = $this->db->query("SELECT a.ketetapan, a.setoran, f.masa_pajak1, f.masa_pajak2,
         e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_hiburan f ON b.no_sptpd=f.no_sptpd 
          LEFT JOIN sptpd_child e ON f.no_sptpd=e.no_sptpd
          WHERE a.npwpd = '".$sql->npwpd."' AND a.masa_pajak1 = '".$a1."' AND a.tahun_pajak = '".$tahun."'")->row();         
         
         
		if($set==NULL){
			$tgl1 = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0%";
			$h = "Rp. 0,00";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl1 = $l1.' s/d '.$l2;
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
	<td colspan="5" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$tgl1.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">'.$dp.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$t.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">'.$h.'</td>
							</tr>
							<tr>
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$total.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$tarif.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$nilai_tarif1.'</td>
							</tr>
<tr>
	<td colspan="5" height="10">&nbsp;</td>
</tr>
						</table>	
					</td>
				</tr>
			</table>';
			/*}else{
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK HIBURAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td>
				<table>
				<tr>
					<td width="12">&nbsp;&nbsp;a.</td>
					<td width="200">Masa Pajak</td>
					<td width="10">:</td>
					<td width="340">'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'</td>
				</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;b.</td>
					<td width="200">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="340">Rp. '.$total.'</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			}*/
			
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
				<tr>
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
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Meulaboh, '.$tgl.'</td>
								</tr>
								<tr>
									<td width="572" height="40">&nbsp;</td>
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
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->tgl_terima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Meulaboh, '.$tgl.'</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$petugas.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">'.$nip.'</td>
                          </tr>
                        </table></td>
						<td width="200" height="25" align="center">&nbsp;</td>
					</tr>
					<tr>
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