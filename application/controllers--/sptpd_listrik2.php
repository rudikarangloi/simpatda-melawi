<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptpd_listrik extends MY_Controller {
	
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
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txt_petugas_input",$this->input->post("txt_petugas_input"));
		$ctl_petugasinput = $this->session->userdata('username');
		$ctl_golongantarif = $this->db->query("select kd_rek, nm_rek from master_rekening where jns_pajak ='05' and status_aktif='1'");
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_golongantarif']=$ctl_golongantarif;
		//$data['defNoSptpd']="LIS/".date('y');
		$this->load->view('data/sptpd_view_listrik',$data);
	}
	
	function bank(){
		$ctl_param01="'txt_thn_masa_pajak','txt_bln_masa_pajak1','txt_bln_masa_pajak2','txt_tgl_masa_pajak3', 'txt_tgl_masa_pajak4'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak1", $this->input->post("txt_bln_masa_pajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txt_bln_masa_pajak2", $this->input->post("txt_bln_masa_pajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txt_thn_masa_pajak", $this->input->post("txt_thn_masa_pajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_carahitung = $this->zieGenCombo("CARA_HITUNG", "txt_cara_hitung",$this->input->post("txt_cara_hitung"), " style='width:300px'");
		//$ctl_petugasinput = $this->zieGenCombo("PETUGAS_INPUT", "txt_petugas_input",$this->input->post("txt_petugas_input"));
		$ctl_petugasinput = $this->session->userdata('username');
		$ctl_golongantarif = $this->db->query("select kd_rek, nm_rek from master_rekening where jns_pajak ='05' and status_aktif='1'");

		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		$data['ctl_golongantarif']=$ctl_golongantarif;
		//$data['defNoSptpd']="LIS/".date('y');
		$this->load->view('data/listrik_bank',$data);
	}
	
	function tarif(){
		$kd_rek = $this->input->post('gol');
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
	
	public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.asal_listrik, a.gol_tarif, a.daya_listrik, a.tarif_kwh, a.pemakaian, a.jml_bayar, a.masa_pajak11, a.masa_pajak21, a.jml_bayar1, a.tarif_pajak1, a.pajak_terutang1, a.masa_pajak12, a.masa_pajak22, a.omset, a.tarif_pajak2, a.pajak_terutang2, a.author, a.created, a.modified, a.petugas_input from sptpd_listrik a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan ","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, asal_listrik, gol_tarif, daya_listrik, tarif_kwh, pemakaian, jml_bayar, masa_pajak11, masa_pajak21, jml_bayar1, tarif_pajak1, pajak_terutang1, masa_pajak12, masa_pajak22, omset, tarif_pajak2, pajak_terutang2, author, created, modified, petugas_input");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.asal_listrik, a.gol_tarif, a.daya_listrik, a.tarif_kwh, a.pemakaian, a.jml_bayar, a.masa_pajak11, a.masa_pajak21, a.jml_bayar1, a.tarif_pajak1, a.pajak_terutang1, a.masa_pajak12, a.masa_pajak22, a.omset, a.tarif_pajak2, a.pajak_terutang2, a.author, a.created, a.modified, a.petugas_input from sptpd_listrik a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.author = '".$this->session->userdata('username')."'","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, asal_listrik, gol_tarif, daya_listrik, tarif_kwh, pemakaian, jml_bayar, masa_pajak11, masa_pajak21, jml_bayar1, tarif_pajak1, pajak_terutang1, masa_pajak12, masa_pajak22, omset, tarif_pajak2, pajak_terutang2, author, created, modified, petugas_input");	
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$arrMPjk1=explode("/",$this->input->post('awal'));
		$awal=$arrMPjk1[1];
		
		$arrMPjk2=explode("/",$this->input->post('akhir'));
		$akhir=$arrMPjk2[1];
		$tahun=$arrMPjk2[2];
				
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
		
		$arrMPjk1=explode("/",$this->input->post('txt_tgl_masa_pajak3'));
		$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
		$arrMPjk2=explode("/",$this->input->post('txt_tgl_masa_pajak4'));
		$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];
		
		$arrTglDiterima=explode("/",$this->input->post('txt_tgl_diterima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
		
		$txtpajakterutang = $this->input->post('txt_pajak_terutang2');
		if(strpos($txtpajakterutang, '.')){
			$txtpajakterutang = str_replace('.', '', $txtpajakterutang);
		} else {
			$txtpajakterutang;
		}
		
		$txt_jml_bayar = $this->input->post('txt_jml_bayar2');
		if(strpos($txt_jml_bayar, '.')){
			$txt_jml_bayar = str_replace('.', '', $txt_jml_bayar);
		} else {
			$txt_jml_bayar;
		}
		
		$data = array (
			'npwpd'			=> $this->input->post('txt_npwpd'),
			'tarif_pajak2'	=> $this->input->post('txt_tarif_pajak2'),
			'cara_hitung'	=> $this->input->post('txt_cara_hitung'),
			'asal_listrik'	=> $this->input->post('txt_asal_listrik'),
			'gol_tarif'	=> $this->input->post('txt_gol_tarif'),
			'daya_listrik'	=> $this->input->post('txt_daya_listrik'),
			'tarif_kwh'	=> $this->input->post('txt_tarif_kwh'),
			'pemakaian'	=> $this->input->post('txt_pemakaian'),
			'masa_pajak1'		=> $masapajak1,
			'masa_pajak2'		=> $masapajak2,
			'tgl_diterima'		=> $tglditerima,
			'omset'		=> $txt_jml_bayar,
			'pajak_terutang2'	=> $txtpajakterutang,
			'author' 	=> $username
		);
		
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('txt_npwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $arrMPjk1[1],
			'masa_pajak2'	=> $arrMPjk2[1],
			'tahun' 			=> $arrMPjk2[2],
			'jumlah' 	=> $txtpajakterutang,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '".$this->input->post('txt_gol_tarif')."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($this->input->post('txt_gol_tarif')),
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $txt_jml_bayar,
			'tarif' => $this->input->post('txt_tarif_pajak2'),
			'jumlah' => $txtpajakterutang
		);
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd_listrik', $dataUpd, array('id' => $this->input->post('id')));
			$no_sptpd = $this->input->post('no_sptpd');
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $this->input->post('no_sptpd')));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $this->input->post('no_sptpd')));
			
		} else {
			$thn = date('Y');
			$no_sptpd=$this->generateNo(substr($masapajak1,0,4));

			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptpd'=>$no_sptpd));
			$this->db->insert('sptpd_listrik',$dataIns);
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);
		}
		
		if($this->db->_error_message()!=""){
			$result=$this->db->_error_message();
		}

		#$result="true";
		echo $no_sptpd;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_sptpd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/LIS/'.substr($thn,2,2);
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
	
	public function get_data_by_id(){
		$query = $this->db->query("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.asal_listrik, a.gol_tarif, a.daya_listrik, a.tarif_kwh, a.pemakaian, a.jml_bayar, a.masa_pajak1, a.masa_pajak2, a.jml_bayar1, a.tarif_pajak1, a.pajak_terutang1, a.masa_pajak12, a.masa_pajak22, a.omset, a.tarif_pajak2, a.pajak_terutang2, a.author, a.created, a.modified, a.petugas_input from sptpd_listrik a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_sptpd ='".$this->input->post('no_sptpd')."' ");
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
				$result.=" document.frmData.txt_gol_tarif.value='".$row->asal_listrik."'; ";
				$result.=" document.frmData.txt_asal_listrik_pln.value='".$row->gol_tarif."'; ";
				$result.=" document.frmData.txt_daya_listrik.value='".$row->daya_listrik."'; ";
				$result.=" document.frmData.txt_tarif_kwh.value='".$row->tarif_kwh."'; ";
				$result.=" document.frmData.txt_pemakaian.value='".$row->pemakaian."'; ";
				//$result.=" document.frmData.txt_jml_bayar.value='".$row->jml_bayar."'; ";
				
				
					$result.=" document.frmData.txt_tgl_masa_pajak3.value='".$this->rotateTgl($row->masa_pajak1)."'; ";
					$result.=" document.frmData.txt_tgl_masa_pajak4.value='".$this->rotateTgl($row->masa_pajak2)."'; ";
					$result.=" document.frmData.txt_thn_masa_pajak.value='".substr($row->masa_pajak1,0,4)."'; ";
					$result.=" document.frmData.txt_bln_masa_pajak1.value='".substr($row->masa_pajak1,5,2)."'; ";
					$result.=" document.frmData.txt_bln_masa_pajak2.value='".substr($row->masa_pajak2,5,2)."'; ";
				
				//$result.=" document.frmData.txt_jml_bayar1.value='".$row->jml_bayar1."'; ";
				//$result.=" document.frmData.txt_jml_bayar2.value='".number_format($row->jml_bayar2)."'; ";
				//$result.=" document.frmData.txt_tarif_pajak1.value='".$row->tarif_pajak1."'; ";
				//$result.=" document.frmData.txt_pajak_terutang1.value='".$row->pajak_terutang1."'; ";
				//$result.=" document.frmData.txt_tarif_pajak2.value='".$row->tarif_pajak2."'; ";
				//$result.=" document.frmData.txt_pajak_terutang2.value='".number_format($row->pajak_terutang2)."'; ";
				
			}
		}else{
			$result="alert('Data tidak ditemukan....');";
		}
		//$result="alert('".$query->result()->nama_perusahaan."');";
		echo $result;
	}
	
	public function rotateTgl($iTgl){
		$arr_tgl = explode("-",$iTgl);
		return $arr_tgl[2]."/".$arr_tgl[1]."/".$arr_tgl[0];
	}
	
	public function delete_sptpd() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from sspd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_listrik',array('no_sptpd' => $sq));
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
			$arr_data=array(""=>"", "2010"=>"2010", "2011"=>"2011", "2012"=>"2012", "2013"=>"2013", "2014"=>"2014", "2015"=>"2015");
		}elseif($ctlType=="CARA_HITUNG"){
			$arr_data=array(/*"1"=>"Official Assesment (Dihitung dan ditetapkan oleh Pejabat Dispenda)",*/ 
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
	
	public function zieGenGolonganTarif(){
		$arr_data=array();
		$query = $this->db->query("select id, golongan_tarif from tb_golongan_tarif where pln_non_pln like '".$this->input->post('id')."' ");
		foreach ($query->result() as $row){
		   $arr_data[$row->id]=$row->golongan_tarif;
		}
		
		$ret="<select name='".$this->input->post('ctlid')."' id='".$this->input->post('ctlid')."' onchange='genGolTarif2(this.value)'>";
		foreach($arr_data as $key=>$value){
			$ret.="<option value='$key'>$value</option>";
		}
		$ret.="</select>";
		$result="document.getElementById('dv_gol_tarif').innerHTML=\"$ret\";";
		echo $result;
	}
	
	public function zieGenGolonganTarif2(){
		$arr_data=array();
		$query = $this->db->query("select id, daya_listrik, tarif_per_kwh, pln_non_pln from tb_golongan_tarif where id like '".$this->input->post('id')."' ");
		$ret="";
		foreach ($query->result() as $row){
			if($row->pln_non_pln==0){
				$set = 15;
			} else {
				$set = 10;
			}
		   $ret.="document.getElementById('txt_daya_listrik').value='".$row->daya_listrik."'; ";
		   $ret.="document.getElementById('txt_tarif_kwh').value='".$row->tarif_per_kwh."'; ";
		   $ret.="document.getElementById('set').value='".$set."'; ";
		}
		echo $ret;
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
		/*$spt = explode("=",$bray);
		$sptpd = $spt[0]+"/"+$spt[1]+"/"+$spt[2];
		echo $sptpd;*/
		
		$sql = $this->db->query("select sptpd_listrik.id, sptpd_listrik.npwpd, sptpd_listrik.no_sptpd, sptpd_listrik.cara_hitung, sptpd_listrik.pemakaian, sptpd_listrik.daya_listrik, sptpd_listrik.tarif_kwh, sptpd_listrik.asal_listrik, sptpd_listrik.gol_tarif, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, sptpd_listrik.asal_listrik, sptpd_listrik.cara_hitung, DATE_FORMAT(sptpd_listrik.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_listrik.author, sptpd_listrik.gol_tarif, DATE_FORMAT(sptpd_listrik.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_listrik.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_listrik.tarif_pajak2, sptpd_listrik.pajak_terutang2, sptpd_listrik.omset from sptpd_listrik left join view_perusahaan on sptpd_listrik.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_listrik.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a1				= $a[1];
		$awal				= $this->msistem->v_bln($a[1]);
		$b = explode("/",$sql->masa_pajak2);
		$akhir 				= $this->msistem->v_bln($b[1]);
		$tahun				= $b[2];
		$total				= number_format($sql->omset,2,",",".");
		$m	= $this->msistem->v_bln(date('m'));
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
		$cara = $sql->cara_hitung;
		//$nm = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->gol_hotel."'")->row();
		
		$nilai_tarif1	= number_format($sql->pajak_terutang2,2,",",".");
		
		$c			= $sql->tgl_diterima;
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
						PAJAK LISTRIK<br />
						Masa Pajak&nbsp;&nbsp;: '.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;: '.$tahun.'
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
						<strong>DATA OBYEK PAJAK PENERANGAN JALAN</strong>
					</td>
				</tr>
			</table>';
			
		if($sql->asal_listrik==0){
			$asal = 'Non PLN';
		} else {
			$asal = 'PLN';
		}
		
		$que = $this->db->query('select nm_rek from master_rekening where kd_rek ="'.$sql->asal_listrik.'"')->row();
		$tarif_kwh	= number_format($sql->tarif_kwh,2,",",".");	
		
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;1. Kode Rekening</td>
					<td width="10" align="center">:</td>
					<td width="317">'.$sql->gol_tarif.'</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;2. Jenis Kategori Tarif</td>
					<td width="10" align="center">:</td>
					<td width="317">'.$que->nm_rek.'</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;3. Daya Listrik</td>
					<td width="10" align="center">:</td>
					<td width="317">'.$sql->daya_listrik.'</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;4. Tarif Per KWH Rp.</td>
					<td width="10" align="center">:</td>
					<td width="317">Rp. '.$tarif_kwh.'</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;5. Penggunaan Listrik</td>
					<td width="10" align="center">:</td>
					<td width="317">'.$sql->pemakaian.'</td>
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
						<strong>DATA PAJAK PENERANGAN JALAN</strong>
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
		
		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2, c.tarif from sspd a left join sptpd_listrik b on a.nomor=b.no_sptpd left join sptpd_child c on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();
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
	<td colspan="3" height="10">&nbsp;</td>
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
								<td width="282">'.$tgl.'</td>
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
								<td width="282">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
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
								<td width="282">'.$sql->tarif_pajak2.'%</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$nilai_tarif1.'</td>
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
	<td colspan="3" height="10">&nbsp;</td>
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
									<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
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
			
	$op = $this->db->query("select * from admin where username = '".$sql->author."'")->row();
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
	<td colspan="3" height="10">&nbsp;</td>
</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
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
						<td width="200" height="50" align="center">&nbsp;</td>
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