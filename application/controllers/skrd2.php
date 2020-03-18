<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skrd extends MY_Controller {
    var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['tahun'] = $this->msistem->tahun();        
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
        
		//$this->load->view('penetapan/skrd_mbo',$data);
        $this->load->view('penetapan/skrd_bak',$data);
	}
	
	public function frmskrd($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();        
        $data['dop'] = $this->db->query("SELECT id_izin,nm_izin FROM master_izin");
        $data['lok_kawa'] = $this->db->query('SELECT id_kawasan,nm_kawasan FROM lokasi_kawasan');
       	$data['lokasi_pasar'] =$this->db->query("SELECT kode,concat(kode, ' | ',nm_lokasi) as nm_lokasi FROM lokasi_pasar  ORDER BY kode ");
        $data['nama_sptpd'] = $p->nama_sptpd;
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skrd_bak',$data);
	}
    
   	public function frmskpd_reklame($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd_reklame',$data);
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
	
	public function cariData($kata_kunci="",$parameter="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and $parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
	//	$grid->render_sql("select nota_hitung_ret.no_nota, nota_hitung_ret.sptrd, nota_hitung_ret.npwpd,
//         view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik,
//          view_perusahaan.alamat_pemilik, nota_hitung_ret.masa_pajak1, nota_hitung_ret.masa_pajak2,
//           nota_hitung_ret.tahun, nota_hitung_ret.jumlah from nota_hitung_ret left join view_perusahaan on
//            nota_hitung_ret.npwpd=view_perusahaan.npwpd_perusahaan where nota_hitung_ret.nama_sptpd = '".$kode_sptpd."'
//             and nota_hitung_ret.status ='0' $qr","id","no_nota, sptrd, npwpd, nama_perusahaan ,alamat_perusahaan,
//              nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, jumlah");
         $grid->render_sql("SELECT sptrd.no_sptrd, sptrd.npwpd,
         view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik,
          view_perusahaan.alamat_pemilik, sptrd.masa_pajak1, sptrd.masa_pajak2,
           sptrd.tahun, sptrd.jumlah FROM sptrd LEFT JOIN view_perusahaan ON
            sptrd.npwpd=view_perusahaan.npwpd_perusahaan WHERE sptrd.status ='0' $qr","id","no_sptrd,no_sptrd, npwpd, nama_perusahaan ,alamat_perusahaan,
              nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	public function cData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung_ret.no_nota, nota_hitung_ret.sptrd,
         nota_hitung_ret.npwpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan,
          view_perusahaan.nama, view_perusahaan.alamat, nota_hitung_ret.masa_pajak1, nota_hitung_ret.masa_pajak2, 
          nota_hitung_ret.tahun, nota_hitung_ret.jumlah from nota_hitung_ret left join
           view_perusahaan on nota_hitung_ret.npwpd=view_perusahaan.id_perusahaan
            where nota_hitung_ret.nama_sptpd = '".$_GET['kode']."'","id","no_nota,sptrd,npwpd,nama_perusahaan,alamat_perusahaan,nama,alamat,masa_pajak1,masa_pajak2,tahun,jumlah");
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
		
		$data = array (
			'npwpd' => $this->input->post('npwpd'),
			//'cara_hitung' => $this->input->post('cara_hitung'),
			//'jenis_galian' => $this->input->post('jenis_galian'),
			'petugas_input' => $this->input->post('petugas_input'),
			'keperluan' => $this->input->post('keperluan'),
			'tgl_diterima' 	=> $tglditerima,
			'rekening' => '',
			'masa_pajak1'	=> $masapajak1,
			'masa_pajak2'	=> $masapajak2,
			'omset'	=> $jml,
            'lokasi_pasar' =>$this->input->post('lokasi'), 
			'tarif' => $this->input->post('tarif'),
			'jml_bayar'	=> $setoran,
			'author' 	=> $username
		);
		
		$awal = explode('-',$masapajak1);
		$akhir = explode('-',$masapajak2);
		
		$data_sptrd = array (
			'npwpd' 		=> strtoupper($this->input->post('npwpd')),
			'tanggal'		=> $tglditerima,
			'masa_pajak1' 	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
			'tahun' 		=> $akhir[0],
			'jumlah' 	    => $setoran,
			'author' 		=> strtoupper($username)
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek from master_rekening where kd_rek = '4.1.1.11.06'")->row();
		
		$data_child = array (
			'kd_rek' => '4.1.1.11.06',
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $jml,
			'tarif' => $this->input->post('tarif'),
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
			$dataUpd3 = array_merge($data_child,array('no_sptrd' => $result));
			$this->db->update('sptrd_child',$dataUpd3, array('no_sptrd' => $this->input->post('sptrd')));
			
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
			$dataIns3 = array_merge($data_child,array('no_sptrd' => $no_sptrd));
			$this->db->insert('sptrd_child',$dataIns3);
		}
		
		echo $result;
	}		
	
	public function cektempo(){
		if($_POST['tempo']==NULL){
			$d = date('d/m/Y');
			
			//bulan+1
			$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
			$t = date('d/m/Y',$s);
			
			$result = $d.'|'.$t;
		}
		echo $result;
	}
	
	public function simpan() {
	//	$upd = array (
//				'status' => 1
//		);
//		$this->db->update('sptrd', $upd, array('no_sptrd' => $_POST['no_sptrd']));
			
		$jml = $this->input->post('jml');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}		        
        
		$data = array(
            //'nota_hitung' => $_POST['nota_hitung'],
            'npwpd' => $this->input->post('npwpd'),
            'nama' => strtoupper($this->input->post('nama')),
            'alamat' => $this->input->post('alamat'),
            'nm_pemilik' =>  strtoupper($this->input->post('nm_pemilik')),
            'alamat_pemilik' => $this->input->post('alamat_pemilik'),
            'masa_pajak1' => $this->input->post('awal'),
            'masa_pajak2' => $this->input->post('akhir'),
            'tahun' => $this->input->post('tahun'),
            'tahun2' => $this->input->post('tahun2'),
            'lokasi_pasar' => $this->input->post('lokasi'),
            'indeks_kawasan' => $this->input->post('kawasan'),
            'indeks_gangguan' => $this->input->post('gangguan'),
            'volume' => $this->input->post('vol'),
            'tgl_jth_tempo' => $this->input->post('tgl_jth_tempo'),
            'tgl' => $this->input->post('tgl'),                        
            'no_sptrd' => $this->input->post('no_sptrd'),
            'jumlah' =>  $this->input->post('jmlh'),
			'kode_sptpd' => $this->input->post('kode_sptpd'),
			'tahun_transaksi' => date('Y'),
            'author' => $this->session->userdata('username')
        );
                 
        $data2 = array(
            'kd_rek' => '4.1.2.03.03',
            'nm_rek' => 'Retribusi Izin Gangguan',            
            'tarif' => $this->input->post('jmlh'),            
            'jumlah' => $this->input->post('jmlh')            
        );                	
        
		if($this->input->post('skrd_1')=="") {
			$thn = date('Y');
			$no_skrd = $this->generateNo($thn,$_POST['kode_sptpd']).'/'.$_POST['kode_sptpd'].'/'.substr($thn,2,2);
			$no_kohir = $this->generateNo($thn,$_POST['kode_sptpd']);
			$dataIns = array_merge($data,array('no_skrd' => $no_skrd,'no_kohir' => $no_kohir,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('skrd', $dataIns);
            
            $dataIns2 = array_merge($data2,array('skrd' => $no_skrd));
			$result = $this->db->insert('skrd_child',$dataIns2);
		} else {
			$no_skrd = $this->input->post('skrd_1')."/".$this->input->post('skrd_2');
			$this->db->delete('skrd_child',array('skrd' => $no_skrd));
			$dataUpdate = array_merge($data,array('author' => $this->session->userdata('username'),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skrd',$dataUpdate,array('no_skrd' => $no_skrd));
		}
		echo $no_skrd;
	}
	
	public function generateNo($thn="",$kode="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skrd,'/',1)) as max from skrd where tahun_transaksi = '".$thn."' and kode_sptpd = '".$kode."'");
		$r = $sql->row();
		$jml = $r->max + 1;
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
		return $jml;
	}
	
	function mainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT skrd.no_skrd, DATE_FORMAT(skrd.tgl,'%d/%m/%Y') AS tgl,
          view_perusahaan.nama_perusahaan,
          view_perusahaan.alamat_perusahaan , view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik,
           skrd.npwpd, skrd.jumlah AS total, skrd.masa_pajak1, skrd.masa_pajak2, skrd.tahun,DATE_FORMAT(skrd.tgl_jth_tempo,'%d/%m/%Y') AS tgl_jth_tempo, 
           skrd.lokasi_pasar,skrd.indeks_kawasan,skrd.indeks_gangguan,skrd.volume FROM skrd 
           LEFT JOIN view_perusahaan ON skrd.npwpd=view_perusahaan.npwpd_perusahaan
             where skrd.kode_sptpd = '".$_GET['kode']."'","id","no_skrd, tgl, nama_perusahaan,
              alamat_perusahaan, nama_pemilik, alamat_pemilik, npwpd, total, masa_pajak1, masa_pajak2,
               tahun, tgl_jth_tempo, lokasi_pasar, indeks_kawasan, indeks_gangguan, volume");
	}
	
	function hapus() {
		$no_skrd = $this->input->post('skrd_1')."/".$this->input->post('skrd_2');
		$s = $this->db->query("select count(id) as jml from ssrd where nomor='".$no_skrd."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('skrd',array('no_skrd' => $no_skrd));
            $this->db->delete('skrd_child',array('skrd' => $no_skrd));
            $upd = array(
					'status' => 0
				);
				$this->db->update('sptrd',$upd,array('no_sptrd' => $this->input->post('no_sptrd')));
			
            $result = "Data SKRD berhasil dihapus.";
           

                
		} else {
			$result = "Data tidak Bisa dihapus No.SKRD ini sudah ditransaksikan di SSPD,Silakan Menghapus Data SSRD Terlebih Dahulu";
		}
		echo $result;
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
		} else if($op==4){
			$cu = "c.no_nota like '%".$nilai."%'";
		}
		
		/*$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan,
         a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos,
          b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p,
           b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p,
            b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin,
             a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail,
              DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a
               inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where left(a.npwpd_perusahaan,1)='2' and $cu");*/
               
        /*$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, 
        a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, 
        b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, 
        b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, 
        a.jenis_pajak, a.jenis_pajak_detail,DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, 
        a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where $cu");*/
        
        $qr = $this->db->query("SELECT a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, 
        a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p, 
        b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp, 
        b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, 
        IF(a.jenis_pajak=1,'Pajak','Retribusi') AS jenis_pajak, a.jenis_pajak_detail, e.nm_rek, f.nm_lokasi, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar, a.kode_kecamatan, 
        a.kode_kelurahan,d.masa_pajak1,d.masa_pajak2,d.lokasi_pasar,d.indeks_lokasi,d.indeks_gangguan,e.volume,d.jml_bayar,d.no_sptrd 
        FROM nota_hitung_ret c
LEFT JOIN identitas_perusahaan a ON c.npwpd = a.npwpd_perusahaan        
LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik  
LEFT JOIN sptrd_pba d ON c.sptrd = d.no_sptrd
LEFT JOIN sptrd_d1 e ON d.no_sptrd = e.sptrd
LEFT JOIN lokasi_pasar f ON d.lokasi_pasar = f.kode where $cu");      
        
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
                    echo("<cell><![CDATA[".$rs->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$rs->nm_lokasi."]]></cell>");                                        
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
                    echo("<cell><![CDATA[".$rs->masa_pajak1."]]></cell>");                                        
					echo("<cell><![CDATA[".$rs->masa_pajak2."]]></cell>");
                    echo("<cell><![CDATA[".$rs->lokasi_pasar."]]></cell>");
					echo("<cell><![CDATA[".$rs->indeks_lokasi."]]></cell>");                                        
					echo("<cell><![CDATA[".$rs->indeks_gangguan."]]></cell>");
                    echo("<cell><![CDATA[".$rs->volume."]]></cell>");                                        
					echo("<cell><![CDATA[".$rs->jml_bayar."]]></cell>");                                        
                    echo("<cell><![CDATA[".$rs->no_sptrd."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kecamatan."]]></cell>");
					//echo("<cell><![CDATA[".$rs->kode_kelurahan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}


    
    public function data_skrd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT a.id, a.no_sptrd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan,
         a.tgl,  a.masa_pajak1,
          a.masa_pajak2, a.jumlah, a.lokasi_pasar FROM skrd a LEFT JOIN identitas_perusahaan b 
          ON a.npwpd=b.npwpd_perusahaan LEFT JOIN sptrd c ON c.no_sptrd = a.no_sptrd ","id","id, no_skrd,
           npwpd, nama_perusahaan, alamat_perusahaan, tgl,
             masa_pajak1, masa_pajak2, jumlah,lokasi_pasar");	
	}
    
   	public function get_data_by_id(){
		$query = $this->db->query("SELECT a.id, a.no_skrd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan,
         a.tgl, a.masa_pajak1, a.masa_pajak2,a.ms_tgl_pajak1,a.ms_tgl_pajak2,a.tgl_jth_tempo FROM skrd a LEFT JOIN identitas_perusahaan b
           ON a.npwpd=b.npwpd_perusahaan where a.id like '".$this->input->post('id')."' ");
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$gabung = explode('/',$row->no_skrd);
				
				$result=" document.frmData.id.value='".$row->id."'; ";
				$result.=" document.frmData.txtnosptpd_a.value='".$gabung[0]."'; ";
				$result.=" document.frmData.txtnosptpd_b.value='".$gabung[1]."/".$gabung[2]."'; ";
				$result.=" document.frmData.txt_npwpd.value='".$row->npwpd."'; ";
				$result.=" document.frmData.txt_nama_perusahaan.value='".$row->nama_perusahaan."'; ";
				$result.=" document.frmData.txt_alamat.value='".$row->alamat_perusahaan."'; ";
				//$result.=" document.frmData.txt_cara_hitung.value='".$row->cara_hitung."'; ";
				$result.=" document.frmData.txt_tgl_diterima.value='".$this->rotateTgl($row->tgl)."'; ";
                $result.=" document.frmData.txt_tgl_diterima.value='".$this->rotateTgl($row->tgl)."'; ";
				//$result.=" document.frmData.txt_keperluan.value='".$row->keperluan."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak3.value='".$this->rotateTgl($row->masa_pajak1)."'; ";
				$result.=" document.frmData.txt_tgl_masa_pajak4.value='".$this->rotateTgl($row->masa_pajak2)."'; ";
				
			}
		}else{
			$result="alert('Data tidak ditemukan....');";
		}
		//$result="alert('".$query->result()->nama_perusahaan."');";
		echo $result;
	}


	
	function dataItemPajak() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skrd'])) {
			//$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skrd from skrd_child where skrd = '".$_GET['skrd']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skrd");
            $grid->render_sql("select kd_rek, nm_rek, tarif,jumlah, skrd from skrd_child where skrd = '".$_GET['skrd']."'","id","kd_rek, nm_rek,tarif,jumlah, skrd");
		} else {
			//$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skrd from skrd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skrd");
            $grid->render_sql("select kd_rek, nm_rek,tarif,jumlah, skrd from skrd_child","id","kd_rek, nm_rek,tarif,  jumlah, skrd");
		}
	}
	
	function dataItemPajak1($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		//$wo = $this->db->query("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,bunga,kompensasi,jumlah from nhp_ret_child where no_nota='".$spt."'");
		$wo = $this->db->query("select kd_rek,nm_rek,tarif,jumlah from sptrd_d1 where sptrd='".$spt."'");
        
		$i=1;
		foreach($wo->result() as $w) {
			// cair
			$spt = '';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$w->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->nm_rek."]]></cell>");
					//echo("<cell><![CDATA[".$w->dp."]]></cell>");
					echo("<cell><![CDATA[".$w->tarif."]]></cell>");
					//echo("<cell><![CDATA[".$w->kenaikan."]]></cell>");
					//echo("<cell><![CDATA[".$w->denda."]]></cell>");
					//echo("<cell><![CDATA[".$w->bunga."]]></cell>");
					//echo("<cell><![CDATA[".$w->kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$w->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$spt."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function dt_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->render_table("skrd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skrd");
        $grid->render_table("skrd_child","id","kd_rek, nm_rek, tarif, jumlah, skrd");
											//No Nota, Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, SPTPD
	}
    
    
    	
	function skrd_detail(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("skrd_child","id","kd_rek, nm_rek, tarif, jumlah, skrd");
	}
	
	public function cetak() {		
		$data = $this->db->query("select a.no_skrd, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, 
        DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') as tgl_jth_tempo, b.nama_perusahaan, b.alamat_perusahaan,
         b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, '0' as denda, a.jumlah as total, 
        a.masa_pajak1, a.masa_pajak2, a.tahun, a.tahun2, a.no_sptrd, a.nota_hitung, a.no_kohir from skrd a
         left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_skrd='".$_GET['skrd']."'")->row();
		$no 				= $data->no_skrd;
		$npwpd 				= $data->npwpd_perusahaan;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
        $tahun2             = $data->tahun2;
		$ket				= '';
		$total				= number_format($data->total,2,",",".");
		
		$s = explode('/',$no);
		$sptpd = $s[1];
		if($sptpd=='HTL'){
			$nama_sptpd = 'HOTEL';
		} else if($sptpd=='RES'){
			$nama_sptpd = 'RESTORAN';
		} else if($sptpd=='REK'){
			$nama_sptpd = 'REKLAME';
		} else if($sptpd=='HIB'){
			$nama_sptpd = 'HIBURAN';
		} else if($sptpd=='GAL'){
			$nama_sptpd = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		} else if($sptpd=='RET'){
			$nama_sptpd = 'RETRIBUSI';
		}
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
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
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN RETRIBUSI DAERAH<br />
						'.$nama_sptpd.'<br />
						Masa Retribusi&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.' - '.$tahun2.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SKR<br />
						'.$no.'
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$tempo.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;KETERANGAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$ket.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="25" height="25" align="center">No</td>
					<td width="115" height="25" align="center">Kode Rekening</td>
					<td width="302" height="25" align="center">Nama Rekening</td>
					
					<td width="130" height="25" align="center">Jumlah</td>
				</tr>';
			
			$child = $this->db->query("select * from skrd_child where skrd ='".$no."'");
			$i = 1;
			foreach($child->result() as $ch) {
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center">'.$i.'</td>
					  <td width="115" height="25" align="center">'.$ch->kd_rek.'</td>
					  <td width="302" height="25" align="left">&nbsp;'.$ch->nm_rek.'</td>
					  
					  <td width="130" height="25" align="right">Rp. '.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
			}            
		    
            $d1 = $this->db->query("SELECT * FROM skrd
LEFT JOIN lokasi_pasar ON lokasi_pasar.kode = skrd.lokasi_pasar
LEFT JOIN lokasi_kawasan ON lokasi_kawasan.id_kawasan = skrd.indeks_kawasan
LEFT JOIN master_izin ON master_izin.id_izin = skrd.indeks_gangguan where skrd.no_skrd ='".$no."'");			
			foreach($d1->result() as $ck) {			 			 
			   		$report .= '<tr>										
					<td colspan="4" width="572" height="15" align="left">&nbsp;RINCIAN RETRIBUSI : <br/><br/> 
                    <table width="50%" border="0">
                        <tr>
                            <td width="30"></td>
                            <td width="104">a. Indeks Izin Usaha</td>
                            <td width="10">:</td>
                            <td width="300">'.$ck->nm_lokasi.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">b. Indeks Kawasan</td>
                            <td width="10">:</td>
                            <td width="300">'.$ck->nm_kawasan.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">c. Indeks Gangguan</td>
                            <td width="10">:</td>
                            <td width="300">'.$ck->nm_izin.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">d. Luas Tempat Usaha</td>
                            <td width="10">:</td>
                            <td width="300">'.$ck->volume.'&nbsp;m<sup>2</sup></td>
                        </tr>
                    </table>    
                    </td>
				</tr>';}
               
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="442" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
				</tr>
				</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
			$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'RUPIAH</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
				
			$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Palolo, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KEPALA BIDANG PENDAPATAN</td>
					</tr>
					<tr>
						<td width="572" height="50">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$nama1.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">NIP. '.$nip1.'</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
    
    	public function cetak_reklame() {		
		$data = $this->db->query("select a.no_skpd, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') as tgl_jth_tempo, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, '0' as denda, a.jumlah as total, a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_sptpd, a.nota_hitung, a.no_kohir from skpd a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_skpd='".$_GET['skpd']."'")->row();
		$no 				= $data->no_skpd;
		$npwpd 				= $data->npwpd_perusahaan;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
		$ket				= '';
		$total				= number_format($data->total,2,",",".");
		
		$s = explode('/',$no);
		$sptpd = $s[1];
		if($sptpd=='HTL'){
			$nama_sptpd = 'HOTEL';
		} else if($sptpd=='RES'){
			$nama_sptpd = 'RESTORAN';
		} else if($sptpd=='REK'){
			$nama_sptpd = 'REKLAME';
		} else if($sptpd=='HIB'){
			$nama_sptpd = 'HIBURAN';
		} else if($sptpd=='GAL'){
			$nama_sptpd = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		}
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
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
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN PAJAK DAERAH<br />
						PAJAK '.$nama_sptpd.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SKP<br />
						'.$no.'
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$tempo.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;KETERANGAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$ket.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="25" height="25" align="center">No</td>
					<td width="115" height="25" align="center">Ayat</td>
					<td width="302" height="25" align="center">Uraian</td>
					<td width="130" height="25" align="center">Jumlah</td>
				</tr>';
			
			///$child = $this->db->query("select * from skpd_child where skpd ='".$no."'");
            $child = $this->db->query("SELECT a.*,b.nota_hitung,c.sptpd,d.lokasi1,d.teks_reklame,e.panjang,e.lebar,e.jari,e.sisi,e.luas,e.unit,DATE_FORMAT(d.masa_pajak1,'%d/%m/%Y') as masa_pajak1,DATE_FORMAT(d.masa_pajak2,'%d/%m/%Y') as masa_pajak2 FROM skpd_child a LEFT JOIN skpd b ON a.skpd=b.no_skpd 
                    LEFT JOIN nota_hitung c ON b.nota_hitung=c.no_nota LEFT JOIN sptpd_reklame d ON c.sptpd=d.no_sptpd LEFT JOIN sptpd_reklame_detail e ON d.no_sptpd=e.no_sptpd
                    WHERE a.skpd='".$no."'");
			$i = 1;
			foreach($child->result() as $ch) {
			        
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center">'.$i.'</td>
					  <td width="115" height="25" align="center">'.$ch->kd_rek.' '.$ch->nm_rek.'</td>
					  <td width="302" height="25" align="left">Judul Reklame :'.$ch->teks_reklame.', Lokasi:'.$ch->lokasi1.', Ukuran : panjang:'.$ch->panjang.', Lebar:'.$ch->lebar.', sisi:'.$ch->sisi.', luas:'.$ch->luas.', Unit:'.$ch->unit.', periode:'.$ch->masa_pajak1.' s/d '.$ch->masa_pajak2.'</td>
					  <td width="130" height="25" align="right">Rp. '.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="442" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
				</tr>
				</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
			$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'RUPIAH</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
				
			$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KEPALA BIDANG PENDAPATAN</td>
					</tr>
					<tr>
						<td width="572" height="50">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$nama1.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">NIP. '.$nip1.'</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
}
?>