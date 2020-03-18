<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class skrd_mbo extends MY_Controller {
	
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
		//$ctl_jenisgalian = $this->zieGenCombo("JENIS_GALIAN", "txt_jenis_galian",$this->input->post("txt_jenis_galian"),"");
		$tarif = $this->db->query("select tarif_pajak from master_rekening where jns_pajak ='06'")->row();

		//$data['dop'] = $this->db->get('tb_galianc_objek_pajak');
        $data['dop'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='11' AND  LEFT(kd_rek,5)='4.1.2' ORDER BY kd_rek ");
		$data['lokasi_pasar'] =$this->db->query("SELECT kode,concat(kode, ' | ',nm_lokasi) as nm_lokasi FROM lokasi_pasar  ORDER BY kode ");
        $data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		//$data['ctl_jenisgalian']=$ctl_jenisgalian;
		$data['tarif'] = $tarif->tarif_pajak;
		//$data['defNoSptpd']="/GAL/".date('y');
		//$this->load->view('penetapan/skrd_mbo',$data);
        $this->load->view('penetapan/skrd_bak',$data);
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
    
    
    function getLokasi(){
		$kode = $_POST['lokasi'];
		
		$q = $this->db->query("SELECT tarif FROM lokasi_pasar WHERE kode='".$kode."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			$result = $r->tarif;
			echo $result;
            
		} else {
			$result = 0;
			echo $result;
            
		}
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
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan,
         a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos,
          b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p,
           b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p,
            b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin,
             a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail,
              DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a
               inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where left(a.npwpd_perusahaan,1)='2' and $cu");
		
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
		$grid->render_table("skrd_child","id","kd_rek, nm_rek,tarif, jumlah, skrd");
	}
	
	function d_data(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['sptrd'])) {
			$grid->render_sql("select kd_rek, nm_rek, tarif, jumlah, skrd from skrd_child where skrd = '".$_GET['sptrd']."'","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, sptrd");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, sptrd from sptrd_d1","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, sptrd");
		}
	}
	
	public function data_skrd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_skrd, a.npwpd, b.nama, b.alamat,
         a.cara_hitung, a.tgl_diterima, a.keperluan,a.petugas_input, a.masa_pajak1,
          a.masa_pajak2,a.jumlah, a.tarif,a.lokasi_pasar from skrd a left join identitas_perusahaan b 
          on a.npwpd=b.npwpd_perusahaan","id","id, no_skrd,
           npwpd, nama, alamat, cara_hitung, tgl_diterima, keperluan,
            petugas_input, masa_pajak1, masa_pajak2, jumlah,tarif,lokasi_pasar");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.keperluan, a.jenis_galian, a.omset, a.petugas_input, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.tarif from sptpd_galianc a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd c on c.no_sptpd = a.no_sptpd
where a.author = '".$this->session->userdata('username')."'","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, keperluan, jenis_galian, omset, petugas_input, masa_pajak1, masa_pajak2, jml_bayar,tarif");	
	}
	
	public function data_sptpd_d1() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.npwpd, a.kd_rek, a.volume, a.harga_pasar, a.dp from sptpd_galianc_d1 a ","id","id, npwpd, kode_galian, volume, harga_pasar, dp");	
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal=$this->input->post('awal');
		$akhir=$this->input->post('akhir');
		$tahun=$this->input->post('tahun');
 	    
				
		$query = $this->db->query("select npwpd from skrd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		if($query!=NULL){
			$text = "Maaf pendataan SKRD sudah dilakukan";
		} else {
			$text = 0;
		}
		echo $text;
	}		

	public function simpan_skrd() {
		$username = strtoupper($this->session->userdata('username'));
				
		if($this->input->post('txt_tgl_masa_pajak1')!=""){
			$arrMPjk1=explode("/",$this->input->post('txt_tgl_masa_pajak1'));
			$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
			$arrMPjk2=explode("/",$this->input->post('txt_tgl_masa_pajak2'));
			$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];

		}

		$arrTglDiterima=explode("/",$this->input->post('tgl_diterima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
		
        $arrTglJatuhTempo=explode("/",$this->input->post('tgl_jatuhtempo'));
		$tglJthTempo=$arrTglJatuhTempo[2]."-".$arrTglJatuhTempo[1]."-".$arrTglJatuhTempo[0];
        
        
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
		$awal = explode('-',$masapajak1);
		$akhir = explode('-',$masapajak2);
        
		$data = array (
			'npwpd' => $this->input->post('npwpd'),
			//'cara_hitung' => $this->input->post('cara_hitung'),
			//'jenis_galian' => $this->input->post('jenis_galian'),
			'petugas_input' => $this->input->post('petugas_input'),
			'keperluan'     => $this->input->post('keperluan'),
			'tgl_diterima' 	=> $tglditerima,
			//'rekening' => '',
            'nama'          => $this->input->post('txt_nama_perusahaan'),
            'alamat'        => $this->input->post('txt_alamat'),
			'masa_pajak1'	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
            'tahun' 		=> $akhir[0],
            'tgl_jth_tempo' => $tglJthTempo,
            
            'ms_tgl_pajak1' => $masapajak1,
            'ms_tgl_pajak2' => $masapajak2,
			//'omset'	=> $jml,
            'lokasi_pasar'  => $this->input->post('lokasi'), 
			'tarif'         => $this->input->post('tarif'),
			'jumlah'	    => $setoran,
            'tahun_transaksi' => date('Y'),
            
			'author' 	=> $username
		);
		
//		$awal = explode('-',$masapajak1);
//		$akhir = explode('-',$masapajak2);
//		
//		$data_sptrd = array (
//			'npwpd' 		=> strtoupper($this->input->post('npwpd')),
//			'tanggal'		=> $tglditerima,
//			'masa_pajak1' 	=> $awal[1],
//			'masa_pajak2'	=> $akhir[1],
//			'tahun' 		=> $akhir[0],
//			'jumlah' 	    => $setoran,
//			'author' 		=> strtoupper($username)
//		);
		
		//kode_rekening
//		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '4.1.1.11.06'")->row();
//		
//		$data_child = array (
//			'kd_rek' => '4.1.1.11.06',
//			'nm_rek' => strtoupper($rekening->nm_rek),
//			'dp' => $jml,
//			'tarif' => $this->input->post('tarif'),
//			'jumlah' => $setoran
//		);
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('skrd', $dataUpd, array('id' => $this->input->post('id')));
			//$this->db->delete('sptrd_d1', array('sptrd' => $this->input->post('sptrd')));
			$result = $this->input->post('sptrd');
		
			//table sptrd
			//$dataUpd2 = array_merge($data_sptrd,array('no_sptrd' => $result,'modified' => date('Y-m-d H:i:s')));
			//$this->db->update('sptrd',$dataUpd2, array('no_sptrd' => $this->input->post('sptrd')));
			
			//table skrd child
			//$dataUpd3 = array_merge($data_child,array('no_sptrd' => $result));
			//$this->db->update('sptrd_child',$dataUpd3, array('no_sptrd' => $this->input->post('sptrd')));
			
		} else {
			$thn = date('Y');
            $kode = 'RET';
            //$no_skrd = $this->generateNo($thn,$kode).'/'.$kode.'/'.substr($thn,2,2);
			$no_skrd=$this->generateNo(substr($masapajak1,0,4));
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_skrd'=>$no_skrd));
			$this->db->insert('skrd',$dataIns);
			$result = $no_skrd;
			
			//table sptpd
			//$dataIns2 = array_merge($data_sptrd,array('no_sptrd' => $no_sptrd,'created' => date('Y-m-d H:i:s')));
			//$this->db->insert('sptrd',$dataIns2);
			
			//table sptpd child
			//$dataIns3 = array_merge($data_child,array('no_sptrd' => $no_sptrd));
			//$this->db->insert('sptrd_child',$dataIns3);
		}
		
		echo $result;
	}
    
//    	public function generateNo($thn="",$kode="") {
//		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skrd,'/',1)) as max from skrd where tahun_transaksi = '".$thn."'");
//		$r = $sql->row();
//		$jml = $r->max + 1;
//		if(strlen($jml)==1) {
//			$jml = '00000000'.$jml;
//		} else if(strlen($jml)==2) {
//			$jml = '0000000'.$jml;
//		} else if(strlen($jml)==3) {
//			$jml = '000000'.$jml;
//		} else if(strlen($jml)==4) {
//			$jml = '00000'.$jml;
//		} else if(strlen($jml)==5) {
//			$jml = '0000'.$jml;
//		} else if(strlen($jml)==6) {
//			$jml = '000'.$jml;
//		} else if(strlen($jml)==7) {
//			$jml = '00'.$jml;
//		} else if(strlen($jml)==8) {
//			$jml = '0'.$jml;
//		}
//		return $jml;
//	}

	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_skrd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_skrd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/RET/'.substr($thn,2,2);
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
		$query = $this->db->query("select a.id, a.no_sptrd, a.npwpd, b.nama, b.alamat,
          a.cara_hitung,a.tgl_diterima, a.keperluan, a.masa_pajak1, a.ms_tgl_pajak1,a.ms_tgl_pajak2,a.masa_pajak2, a.author, a.created,
          a.modified, a.petugas_input from skrd a left join identitas_perusahaan b
           on a.npwpd=b.npwpd_perusahaan where a.id like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$gabung = explode('/',$row->no_sptrd);
				
				$result=" document.frmData.id.value='".$row->id."'; ";
				$result.=" document.frmData.txtnosptpd_a.value='".$gabung[0]."'; ";
				$result.=" document.frmData.txtnosptpd_b.value='".$gabung[1]."/".$gabung[2]."'; ";
				$result.=" document.frmData.txt_npwpd.value='".$row->npwpd."'; ";
				$result.=" document.frmData.txt_nama_perusahaan.value='".$row->nama."'; ";
				$result.=" document.frmData.txt_alamat.value='".$row->alamat."'; ";
				$result.=" document.frmData.txt_cara_hitung.value='".$row->cara_hitung."'; ";
				$result.=" document.frmData.txt_tgl_diterima.value='".$this->rotateTgl($row->tgl_diterima)."'; ";
				$result.=" document.frmData.txt_keperluan.value='".$row->keperluan."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak3.value='".$this->rotateTgl($row->ms_tgl_pajak1)."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak4.value='".$this->rotateTgl($row->ms_tgl_pajak2)."'; ";
				
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

	public function delete_skrd() {
	   	$sq = $this->input->post('sptrd_1')."/".$this->input->post('sptrd_2');
		///$s = explode('/',$this->input->post('sptpd_1'));
		//$sq = $s[0]."".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from ssrd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('skrd',array('no_skrd' => $sq));
			$this->db->delete('skrd_child',array('skrd' => $sq));
 
            
			$result = "Data SKRD berhasil dihapus.";
		} else {
			$result = "Data tidak bisa dihapus No.SKRD ini sudah ditransaksikan di SSRD, Silakan Menghapus Data SSRD Terlebih Dahulu";
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
	
	function cetak(){
		$sql = $this->db->query("select sptrd_pba.id, sptrd_pba.npwpd, sptrd_pba.no_sptrd,
         view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, 
         sptrd_pba.keperluan,DATE_FORMAT(sptrd_pba.tgl_diterima,'%d/%m/%Y') as tgl_diterima,sptrd_pba.tgl_diterima as tgl, sptrd_pba.petugas_input,
         DATE_FORMAT(sptrd_pba.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptrd_pba.masa_pajak2,'%d/%m/%Y') as masa_pajak2,
         sptrd_pba.omset, sptrd_pba.jml_bayar,sptrd_d1.kd_rek,sptrd_d1.nm_rek,sptrd_d1.tarif from sptrd_pba
         left join view_perusahaan on sptrd_pba.npwpd=view_perusahaan.npwpd_perusahaan left join sptrd_d1 on sptrd_pba.no_sptrd=sptrd_d1.sptrd  where sptrd_pba.no_sptrd='".$_GET['sptrd']."'")->row();
         
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		//$jml				  = $sql->jml_bayar;
		$total				= number_format($sql->omset,2,",",".");
        $tarif				= number_format($sql->tarif,2,",",".");
		//$pajaks				= ($jml*$tarif)/100;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal = $days.' '.$m.' '.date('Y');
        $tgl = $sql->tgl;
		
		$c			= $sql->tgl_diterima;
		$arr = explode("/",$c);
		$s = $arr[1];
		$bln = $this->msistem->v_bln($s);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/galianc');
		$pdf = new galianc('P', 'pt', 'A4', true, 'UTF-8', false); 
			
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
					<td width="44" align="center" valign="middle">&nbsp;</td>
					<td width="219" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="227" align="center">
						SURAT PEMBERITAHUAN RETRIBUSI DAERAH<br />
						(SPTRD)<br />
						Jenis Retribusi&nbsp;&nbsp;:&nbsp;&nbsp;'.$sql->nm_rek.'<br />
						Tahun&nbsp;&nbsp;:'.$tahun.'
					</td>
					<td width="82" align="center">
						<br /><br />
						No. SPTRD<br />
						'.$sql->no_sptrd.'
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
						<strong>DATA OBJEK RETRIBUSI DAERAH</strong>
					</td>
				</tr>
			</table>';
			
//		$child = $this->db->query('select * from sptrd_d1 where sptrd = "'.$sql->no_sptrd.'"');
				$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">1.20.05.01.'.$sql->kd_rek.'</td>
							</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nm_rek.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';		
/**
 * 		$report .=
 * 			'<table border=1>
 * 				<tr>
 * 					<td width="572">
 * 						<table>
 * 							<tr>
 * 								<td width="10">&nbsp;&nbsp;</td>
 * 								<td colspan="3"><br/><br/>
 * 								<table border="1">
 * 									<tr>
 * 										<th width="120" align="center"><strong>Nama Objek</strong></th>
 * 										<th width="50" align="center"><strong>Volume</strong></th>
 * 										<th width="100" align="center"><strong>Harga Pasar</strong></th>
 * 										<th width="100" align="center"><strong>Dasar Pengenaan</strong></th>
 * 										<th width="50" align="center"><strong>Tarif</strong></th>
 * 										<th width="100" align="center"><strong>Jumlah</strong></th>
 * 									</tr>';
 */
/**
 * 								
 * 								$tvol = 0;
 * 								$thd = 0;
 * 								$tdp = 0;
 * 								$tar = 0;
 * 								$jm = 0;
 * 								foreach($child->result() as $rs){
 * 									$hp	= number_format($rs->harga_pasar,2,",",".");
 * 									$dp	= number_format($rs->dp,2,",",".");
 * 									$tarif	= $rs->tarif;
 * 									$jumlah	= number_format($rs->jumlah,2,",",".");
 * 									$report .=
 * 										'<tr>
 * 											<td width="120" align="center">'.$rs->nm_rek.'</td>
 * 											<td width="50" align="right">'.number_format($rs->volume,0,",",".").'&nbsp;</td>
 * 											<td width="100" align="right">&nbsp;Rp. '.$hp.'&nbsp;</td>
 * 											<td width="100" align="right">&nbsp;Rp. '.$dp.'&nbsp;</td>
 * 											<td width="50" align="right">&nbsp;'.$tarif.' %&nbsp;</td>
 * 											<td width="100" align="right">&nbsp;Rp. '.$jumlah.'&nbsp;</td>
 * 										</tr>';
 * 										$tvol = $tvol + $rs->volume;
 * 										$thd = $thd + $rs->harga_pasar;
 * 										$tdp = $tdp + $rs->dp;
 * 										$tar = $tar + $rs->tarif;
 * 										$jm = $jm + $rs->jumlah;
 * 								}
 * 		$report .=
 * 								'<tr>
 * 									<td width="120" align="center"><strong>Jumlah</strong></td>
 * 									<td width="50" align="right"><strong>&nbsp;'.number_format($tvol,0,",",".").'&nbsp;</strong></td>
 * 									<td width="100" align="right"><strong>&nbsp;Rp. '.number_format($thd,2,",",".").'&nbsp;</strong></td>
 * 									<td width="100" align="right"><strong>&nbsp;Rp. '.number_format($tdp,2,",",".").'&nbsp;</strong></td>
 * 									<td width="50" align="right"><strong>&nbsp;&nbsp;</strong></td>
 * 									<td width="100" align="right"><strong>&nbsp;Rp. '.number_format($jm,2,",",".").'&nbsp;</strong></td>
 * 								</tr>
 * 								</table><br/>
 * 								</td>
 * 								<td width="10">&nbsp;</td>
 * 							</tr>
 * 						</table>
 * 					</td>
 * 				</tr>
 * 			</table>';
 */
				
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>RINCIAN PEMBAYARAN RETRIBUSI DAERAH</strong>
					</td>
				</tr>
			</table>';
		
//		if($a1=='01'){
//			$a1 = 12;
//			$tahun = $tahun-1;
//		} else {
//			$a1 = $a1-1;
//		}
//		
//		if(strlen($a1)==1) {
//			$a1 = '0'.$a1;
//		}
        
        $thn_lalu = $tahun-1;
        $csql = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2, 
        c.tarif from ssrd a left join sptrd_pba b on a.nomor=b.no_sptrd left join sptrd_d1 c
         on a.nomor=c.sptrd where a.npwpd = '".$sql->npwpd."'  and a.tahun_pajak = '".$thn_lalu."'")->row();
		
//		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2, 
//        c.tarif from ssrd a left join sptrd_pba b on a.nomor=b.no_sptrd left join sptrd_child c
//         on a.nomor=c.no_sptrd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();

		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1, b.masa_pajak2,a.tanggal, 
        c.tarif from ssrd a left join sptrd_pba b on a.nomor=b.no_sptrd left join sptrd_child c
         on a.nomor=c.no_sptrd where a.npwpd = '".$sql->npwpd."' and a.tanggal < '".$tgl."' and a.tahun_pajak = '".$tahun."'")->row();
	
    
        
        
        if ($csql==null){
            $ms_ret_lalu = "- s/d -";
            $tarif_lalu  = "Rp. 0,00";
            $setor_lalu  = "Rp. 0,00";
            $bayar_lalu  = "Rp. 0,00";
            $ret_terhutang = "Rp. 0,00";
        } else {
            $l = explode('-',$csql->masa_pajak1);
            $l1 = $l[2].'/'.$l[1].'/'.$l[0];
            $lo = explode('-',$csql->masa_pajak2);
            $l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
            $ms_ret_lalu = $l1.' s/d '.$l2;
            
            $tarif_lalu  = 'Rp. '.number_format($csql->tarif,2,",",".");
            $setor_lalu  = 'Rp. '.number_format($csql->setoran,2,",",".");
            $bayar_lalu  = "Rp. 0,00";
            
            $bayar = $csql->setoran;
            $ret_terhutang = ($csql->$tarif)-($csql->setoran);
        }
    
    
    
    	if($set==NULL){
			$tgl = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0";
			$h = "Rp. 0,00";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl = $l1.' s/d '.$l2;
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = $set->setoran;
			$h = 'Rp. '.number_format($set->setoran,2,",",".");
		}
        
            $ret_terhut_2 = $tarif - $t - $pajak;
            $tot_terhut   = $ret_terhutang + $ret_terhut_2;
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan Retribusi terhutang untuk masa retribusi sebelumnya :</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Retribusi</td>
								<td width="8">:</td>
								<td width="282">'.$ms_ret_lalu.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Tarif Retribusi(sesuai dengan Qanun)</td>
								<td width="8">:</td>
								<td width="282">'.$tarif_lalu.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Pembayaran Terdahulu</td>
								<td width="8">:</td>
								<td width="282">'.$setor_lalu.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Jumlah Pembayaran Sekarang </td>
								<td width="8">:</td>
								<td width="282">'.$bayar_lalu.'</td>
							</tr>
                            <tr>
								<td width="20"></td>
								<td width="11">e.</td>
								<td width="232">Retribusi Terhutang (b-c) </td>
								<td width="8">:</td>
								<td width="282">Rp.'.number_format($ret_terhutang,2,",",".").'</td>
                                
							</tr>
							<tr>
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan Retribusi terhutang untuk masa retribusi sekarang:</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Retribusi</td>
								<td width="8">:</td>
								<td width="282">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
                                
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Tarif Retribusi Sesuai dengan Qanun</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$tarif.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Pembayaran Terdahulu</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$t.'</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Jumlah Pembayaran Sekarang</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$pajak.'</td>
							</tr>
                            <tr>
								<td width="20"></td>
								<td width="11">e.</td>
								<td width="232">Retribusi Terhutang</td>
								<td width="8">:</td>
								<td width="282">Rp. '.number_format($ret_terhut_2,2,",",".").'</td>
							</tr>
                             <tr>
								<td width="20"></td>
								<td width="11">f.</td>
								<td width="232">Jumlah Retribusi Terhutang (1 + 2)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.number_format($tot_terhut,2,",",".").'</td>
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