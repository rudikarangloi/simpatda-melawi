<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sptrd extends MY_Controller {
	
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
        $data['dop'] = $this->db->query("SELECT id_izin,nm_izin FROM master_izin");        
        $data['lok_kawa'] = $this->db->query('SELECT id_kawasan,nm_kawasan FROM lokasi_kawasan');
		$data['lokasi_pasar'] =$this->db->query("SELECT kode,concat(kode, ' | ',nm_lokasi) as nm_lokasi FROM lokasi_pasar ORDER BY kode ");
        $data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['ctl_carahitung']=$ctl_carahitung;
		$data['ctl_petugasinput']=$ctl_petugasinput;
		//$data['ctl_jenisgalian']=$ctl_jenisgalian;
		$data['tarif'] = $tarif->tarif_pajak;
		//$data['defNoSptpd']="/GAL/".date('y');
		$this->load->view('data/sptrd',$data);
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
    
    
    function getPasar(){
		$kode = $_POST['pasar'];
		
		$q = $this->db->query("SELECT kode,nm_lokasi FROM lokasi_pasar WHERE kode='".$kode."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			$result = $r->kode;
			echo $result;
            
		} else {
			$result = 0;
			echo $result;
            
		}
	}
    
    function getLokasi(){
		$kode = $_POST['lokasi'];
		
		$q = $this->db->query("SELECT indeks FROM lokasi_kawasan WHERE id_kawasan='".$kode."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			$result = $r->indeks;
			echo $result;
            
		} else {
			$result = 0;
			echo $result;
            
		}
	}
    
    function getGangguan(){
        $kode = $_POST['gangguan'];
        
		$q = $this->db->query("SELECT index_izin FROM master_izin WHERE id_izin='".$kode."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			$result = $r->index_izin;
			echo $result;
            
		} else {
			$result = 0;
			echo $result;            
		}
    }
            
    
    function getHitungan_ret(){
        $nilai = $_POST['nilai_ret'];
		
		$q = $this->db->query("SELECT tarif FROM tarif_retribusi WHERE luas1 <= '".$nilai."' AND luas2 >= '".$nilai."'");	
		$r = $q->row();
		
		if($q->num_rows() == 1){
			$result = $r->tarif;
			echo $result;
            
		} else {
			$result = $r->tarif;
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
		
		/*$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan,
         a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos,
          b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p,
           b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p,
            b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin,
             a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail,
              DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a
               inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where left(a.npwpd_perusahaan,1)='2' and $cu");
		      */
           
        $qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, 
        a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, 
        b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, 
        b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, 
        IF(a.jenis_pajak='1','Pajak','Retribusi') AS jenis_pajak, a.jenis_pajak_detail,DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, 
        a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where $cu");      
              
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
					//echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					//echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					//echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					//echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					//echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak_detail."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kecamatan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kelurahan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function detail(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("sptrd_d1","id","kd_rek, nm_rek, volume, harga_pasar, dp, tarif, jumlah, sptrd");
	}
	
	function d_data(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['sptrd'])) {
			$grid->render_sql("SELECT sptrd_d1.kd_rek, sptrd_d1.nm_rek, lokasi_pasar.nm_lokasi, sptrd_d1.volume, sptrd_d1.harga_pasar, sptrd_d1.dp, sptrd_d1.tarif, sptrd_d1.jumlah, sptrd_d1.sptrd FROM sptrd_d1
LEFT JOIN sptrd_pba ON sptrd_pba.no_sptrd = sptrd_d1.sptrd
LEFT JOIN lokasi_pasar ON sptrd_pba.lokasi_pasar = lokasi_pasar.kode where sptrd = '".$_GET['sptrd']."'","id","kd_rek, nm_rek, nm_lokasi, volume, harga_pasar, dp, tarif, jumlah, sptrd");
		} else {
			$grid->render_sql("SELECT sptrd_d1.kd_rek, sptrd_d1.nm_rek, lokasi_pasar.nm_lokasi, sptrd_d1.volume, sptrd_d1.harga_pasar, sptrd_d1.dp, sptrd_d1.tarif, sptrd_d1.jumlah, sptrd_d1.sptrd FROM sptrd_d1
LEFT JOIN sptrd_pba ON sptrd_pba.no_sptrd = sptrd_d1.sptrd
LEFT JOIN lokasi_pasar ON sptrd_pba.lokasi_pasar = lokasi_pasar.kode","id","kd_rek, nm_rek, nm_lokasi, volume, harga_pasar, dp, tarif, jumlah, sptrd");
		}
	}
	
	public function data_sptrd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT a.id, a.no_sptrd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan,
         a.cara_hitung, a.tgl_diterima, a.indeks_lokasi, a.omset, a.petugas_input, a.masa_pajak1,
          a.masa_pajak2, a.jml_bayar, a.tarif,a.lokasi_pasar,a.indeks_gangguan,d.volume FROM sptrd_pba a LEFT JOIN identitas_perusahaan b 
          ON a.npwpd=b.npwpd_perusahaan 
          LEFT JOIN sptrd c ON c.no_sptrd = a.no_sptrd           
          LEFT JOIN sptrd_d1 d ON d.sptrd = a.no_sptrd","id","id, no_sptrd,
           npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, indeks_lokasi, omset,
            petugas_input, masa_pajak1, masa_pajak2, jml_bayar,tarif,lokasi_pasar,indeks_gangguan,volume");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.cara_hitung, a.tgl_diterima, a.indeks_lokasi, a.jenis_galian, a.omset, a.petugas_input, a.masa_pajak1, a.masa_pajak2, a.jml_bayar, a.tarif from sptpd_galianc a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd c on c.no_sptpd = a.no_sptpd
where a.author = '".$this->session->userdata('username')."'","id","id, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, cara_hitung, tgl_diterima, indeks_lokasi, jenis_galian, omset, petugas_input, masa_pajak1, masa_pajak2, jml_bayar,tarif");	
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
 	    
				
		$query = $this->db->query("select npwpd from sptrd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		if($query!=NULL){
			$text = "Maaf pendataan SPTPD sudah dilakukan";
		} else {
			$text = 0;
		}
		echo $text;
	}		

	public function simpan_sptrd() {
		$username = strtoupper($this->session->userdata('username'));
				
		if($this->input->post('txt_tgl_masa_pajak1')!=""){
			$arrMPjk1=explode("/",$this->input->post('txt_tgl_masa_pajak1'));
			$masapajak1=$arrMPjk1[2]."-".$arrMPjk1[1]."-".$arrMPjk1[0];
		
			$arrMPjk2=explode("/",$this->input->post('txt_tgl_masa_pajak2'));
			$masapajak2=$arrMPjk2[2]."-".$arrMPjk2[1]."-".$arrMPjk2[0];

		}

		$arrTglDiterima=explode("/",$this->input->post('tgl_diterima'));
		$tglditerima=$arrTglDiterima[2]."-".$arrTglDiterima[1]."-".$arrTglDiterima[0];
				
		$setoran = $this->input->post('setoran');
		if(strpos($setoran, '.')){
			$setoran = str_replace('.', '', $setoran);
		} else {
			$setoran;
		}
		
		$data = array (
			'npwpd' => $this->input->post('npwpd'),
			//'cara_hitung' => $this->input->post('cara_hitung'),
			//'jenis_galian' => $this->input->post('jenis_galian'),
            'nama_perusahaan' => $this->input->post('txt_nama_perusahaan'),
            'alamat' => $this->input->post('txt_alamat'),
			'petugas_input' => $this->input->post('petugas_input'),
			'indeks_lokasi' => $this->input->post('lokasi'),
            'indeks_gangguan' => $this->input->post('gangguan'),
			'tgl_diterima' 	=> $tglditerima,
			'rekening' => '4.1.2.03.03',
			'masa_pajak1'	=> $masapajak1,
			'masa_pajak2'	=> $masapajak2,
			'omset'	=> $setoran,
            'lokasi_pasar' =>$this->input->post('usaha'), 
			'tarif' => $setoran,
			'jml_bayar'	=> $setoran,
			'author' 	=> $username
		);
		
        $tahun = $this->input->post('txt_thn_masa_pajak');
		$awal = explode('-',$masapajak1);
		$akhir = explode('-',$masapajak2);
        $tahun2 = floatval($tahun) + 3;
		
		$data_sptrd = array (
			'npwpd' 		=> strtoupper($this->input->post('npwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
			'tahun' 		=> $tahun,
            'tahun2'        => $tahun2,
			'jumlah' 	    => $setoran,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening WHERE kd_rek = '4.1.2.03.03'")->row();
		
		/*$data_child = array (
			'kd_rek' => '4.1.1.11.06',
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $jml,
			'tarif' => $this->input->post('tarif'),
			'jumlah' => $setoran
		);*/
        
        $data_d1 = array (
            'kd_rek' => $rekening->kd_rek,
            'volume' => $this->input->post('qty'),
            'harga_pasar' => $setoran,
            'dp' => $this->input->post('0'),
            'nm_rek' => $rekening->nm_rek,
            'tarif' => $setoran,
            'jumlah' => $setoran
        
        );
			
		if($this->input->post('id')!=0){
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptrd_pba', $dataUpd, array('id' => $this->input->post('id')));
			$this->db->delete('sptrd_d1', array('sptrd' => $this->input->post('sptrd')));
			$result = $this->input->post('sptrd');
		
			//table sptrd
			$dataUpd2 = array_merge($data_sptrd,array('no_sptrd' => $result,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptrd',$dataUpd2, array('no_sptrd' => $this->input->post('sptrd')));
			
			//table sptrd child
			//$dataUpd3 = array_merge($data_child,array('no_sptrd' => $result));
			//$this->db->update('sptrd_child',$dataUpd3, array('no_sptrd' => $this->input->post('sptrd')));
			
		} else {
			$thn = date('Y');
			$no_sptrd=$this->generateNo(substr($masapajak1,0,4));
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s'),'no_sptrd'=>$no_sptrd));
			$this->db->insert('sptrd_pba',$dataIns);
			$result = $no_sptrd;
			
			//table sptpd
			$dataIns2 = array_merge($data_sptrd,array('no_sptrd' => $no_sptrd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptrd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_d1,array('sptrd' => $no_sptrd));
			$this->db->insert('sptrd_d1',$dataIns3);
		}
		
		echo $result;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(max_sptrd,'/',1)) as max from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max + 1;
		$jml = str_pad($jml, 9, "0", STR_PAD_LEFT);
		
		$dtUpd = array('max_sptrd' => $jml);
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
		$query = $this->db->query("SELECT a.id, a.no_sptrd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan,
         a.cara_hitung, a.tgl_diterima, c.volume,d.kode,d.nm_lokasi,e.id_kawasan,e.nm_kawasan,f.id_izin, f.nm_izin, a.masa_pajak1, a.masa_pajak2, a.author, a.created,
          a.modified, a.petugas_input,a.jml_bayar FROM sptrd_pba a 
          LEFT JOIN identitas_perusahaan b ON a.npwpd=b.npwpd_perusahaan
          LEFT JOIN sptrd_d1 c ON a.no_sptrd=c.sptrd
	 LEFT JOIN lokasi_pasar d ON a.lokasi_pasar = d.kode
         LEFT JOIN lokasi_kawasan e ON a.indeks_lokasi = e.id_kawasan
         LEFT JOIN master_izin f ON a.indeks_gangguan = f.id_izin
          where a.id like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$gabung = explode('/',$row->no_sptrd);
				
				$result=" document.frmData.id.value='".$row->id."'; ";
				$result.=" document.frmData.txtnosptpd_a.value='".$gabung[0]."'; ";
				$result.=" document.frmData.txtnosptpd_b.value='".$gabung[1]."/".$gabung[2]."'; ";
				$result.=" document.frmData.txt_npwpd.value='".$row->npwpd."'; ";
				$result.=" document.frmData.txt_nama_perusahaan.value='".$row->nama_perusahaan."'; ";
				$result.=" document.frmData.txt_alamat.value='".$row->alamat_perusahaan."'; ";
				$result.=" document.frmData.txt_cara_hitung.value='".$row->cara_hitung."'; ";
				$result.=" document.frmData.txt_tgl_diterima.value='".$this->rotateTgl($row->tgl_diterima)."'; ";
				$result.=" document.frmData.lokasi.value='".$row->kode."'; ";
                $result.=" document.frmData.txt_keperluan.value='".$row->id_kawasan."'; ";
                $result.=" document.frmData.op.value='".$row->id_izin."'; ";
                $result.=" document.frmData.qty.value='".$row->volume."'; ";
                $result.=" document.frmData.harga.value='".$row->jml_bayar."'; ";
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

	public function delete_sptrd() {
	   	$sq = $this->input->post('sptrd_1')."/".$this->input->post('sptrd_2');
		///$s = explode('/',$this->input->post('sptpd_1'));
		//$sq = $s[0]."".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(nomor) as jml from ssrd where nomor = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptrd_pba',array('no_sptrd' => $sq));
			$this->db->delete('sptrd',array('no_sptrd' => $sq));
			$this->db->delete('sptrd_child',array('no_sptrd' => $sq));
            $this->db->delete('sptrd_d1',array('sptrd' => $sq));
            
			$result = "Data SPTRD berhasil dihapus.";
		} else {
			$result = "Data tidak bisa dihapus No.SPTRD ini sudah ditransaksikan di SSRD, Silakan Menghapus Data SSRD Terlebih Dahulu";
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
		$sql = $this->db->query("SELECT sptrd_pba.id, sptrd_pba.npwpd, sptrd_pba.no_sptrd,
         view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, 
         sptrd_d1.volume,lokasi_pasar.nm_lokasi,lokasi_kawasan.nm_kawasan,master_izin.nm_izin,sptrd_pba.indeks_lokasi,sptrd_pba.indeks_gangguan,DATE_FORMAT(sptrd_pba.tgl_diterima,'%d/%m/%Y') AS tgl_diterima,sptrd_pba.tgl_diterima AS tgl, sptrd_pba.petugas_input,
         DATE_FORMAT(sptrd_pba.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, DATE_FORMAT(sptrd_pba.masa_pajak2,'%d/%m/%Y') AS masa_pajak2,
         sptrd_pba.omset, sptrd_pba.jml_bayar,sptrd_d1.kd_rek,sptrd_d1.nm_rek,sptrd_d1.tarif FROM sptrd_pba
         LEFT JOIN view_perusahaan ON sptrd_pba.npwpd=view_perusahaan.npwpd_perusahaan 
         LEFT JOIN sptrd_d1 ON sptrd_pba.no_sptrd=sptrd_d1.sptrd
         LEFT JOIN lokasi_pasar ON sptrd_pba.lokasi_pasar = lokasi_pasar.kode
         LEFT JOIN lokasi_kawasan ON sptrd_pba.indeks_lokasi = lokasi_kawasan.id_kawasan
         LEFT JOIN master_izin ON sptrd_pba.indeks_gangguan = master_izin.id_izin
         WHERE sptrd_pba.no_sptrd='".$_GET['sptrd']."'")->row();
         
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
        $tahun				= $a[2];
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);		
		//$jml				  = $sql->jml_bayar;
		$total				= number_format($sql->omset,2,",",".");
        $tarif				= number_format($sql->tarif,2,",",".");
		//$pajak				= ($jml*$tarif)/100;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal = $days.' '.$m.' '.date('Y');
        $tgl = $sql->tgl;
		
		$c	= $sql->tgl_diterima;
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
		$pdf->SetSubject('SOPD_SIGI');
		$pdf->SetKeywords('SOPD_SIGI');
	
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
						SURAT PEMBERITAHUAN TERHUTANG RETRIBUSI DAERAH<br />
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
								<td width="130">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr>
								<td width="130">&nbsp;&nbsp;2. N.P.W.P.D</td>
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
								<td width="130">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">1.20.05.01.'.$sql->kd_rek.'</td>
							</tr>
							<tr>
								<td width="130">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nm_rek.'</td>
							</tr>
                            <tr> 
								<td width="130">&nbsp;&nbsp;3. Indeks Izin Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nm_lokasi.'</td>
							</tr>
                            <tr>
								<td width="130">&nbsp;&nbsp;4. Indeks Lokasi</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nm_kawasan.'</td>
							</tr>
                            <tr>
								<td width="130">&nbsp;&nbsp;5. Indeks Gangguan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nm_izin.'</td>
							</tr>
                            <tr>
								<td width="130">&nbsp;&nbsp;6. Luas Ruang Tempat Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->volume.' m<sup>2</sup></td>
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
        
        $thn_lalu = $tahun-3;
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
			//$l = explode('-',$set->masa_pajak1);
			//$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
            		
			//$lo = explode('-',$set->masa_pajak2);
			//$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			
            //$tgl = $l1.' s/d '.$l2;
            $tgl = '';
            
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = number_format($set->setoran,2,",",".");
			$h = 'Rp.'.number_format($set->setoran,2,",",".");
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
								<td width="282">'.$ret_terhutang.'</td>
                                
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
								<td width="232">Jumlah Retribusi Terhutang (c + d)</td>
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
									<td width="200" align="center">Palolo, '.$tanggal.'</td>
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
						<td width="200" align="center">Palolo, '.$tanggal.'</td>
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