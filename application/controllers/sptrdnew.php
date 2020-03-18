<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class sptrdnew extends MY_Controller {
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		/* $ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;*/
		$ctl_param01="'txtthnmasapajak'";
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tanggal'] = date("d/m/Y");
		$tarif = $this->db->query("select tarif_pajak from master_rekening where jns_pajak ='01'")->row();
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		//$data['gresto'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='01' and status_aktif ='1'");
		$data['gresto'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where kd_rek LIKE '%4.1.2.%' AND jns_pajak !='0' and status_aktif ='1'");
		$data['userPetugas'] = $this->session->userdata('username');
		$data['tarif'] = $tarif->tarif_pajak;
		$data['skpd'] = $this->db->query("SELECT kd_skpd,CONCAT(kd_skpd, ' | ',nama_skpd) AS nama_skpd FROM master_skpd");
		//$data['skpd'] = $this->db->query("SELECT nama_skpd AS nama_skpd FROM master_skpd");
		$s = $this->db->query("select nama from admin where username='".$this->session->userdata('username')."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['tahun'] = $this->msistem->tahun();
		$tgl = "";
		$register = "";
		$pemilik = "";
		$perusahaan = "";
		$this->load->view('data/sptrdnew',$data);
	}
	
	public function crek_skpd() {
		$kd = $this->input->post('skpd');
		$e = $this->db->query("SELECT kd_skpd,nama_skpd FROM master_skpd WHERE kd_skpd='".$kd."'")->row();
		$kirim = $e->kd_skpd.'|'.$e->nama_skpd;
		
		echo $kirim;
	}
	
	function bank(){
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='01' and status_aktif ='1'");
		$data['userPetugas'] = $this->session->userdata('username');
		$s = $this->db->query("select nama from admin where username='".$this->session->userdata('username')."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['tahun'] = $this->msistem->tahun();
		$tgl = "";
		$register = "";
		$pemilik = "";
		$perusahaan = "";
		$this->load->view('data/hotel_bank',$data);
	}
	
	function tarif(){
		$kd_rek = $this->input->post('gol');
		$query = $this->db->query("select tarif_pajak from master_rekening where kd_rek = '".$kd_rek."'")->row();
		$tarif = $query->tarif_pajak;
		//$tarif = 10;
		echo $tarif;
	}
	
		
	function load_subjenis(){
		$rek  = $this->input->post('kode');
		if($rek!=""){
			$where = "WHERE header='$rek'";
		}else{
			$where = "";
		}
		$sql = "select kd_rek,nm_rek from master_rekening_rincian $where ORDER BY kd_rek ASC";
		$query1 = $this->db->query($sql);  
        $ii = 0;
        foreach($query1->result_array() as $resulte){ 
            $coba[] = array(
                        'id' => $ii,        
                        'kd_rek' => $resulte['kd_rek'],
                        'nm_rek' => $resulte['nm_rek'],
                        );
                        $ii++;
        }
		 $result["rows"] = $coba;   
        echo json_encode($result);
	}
	
	public function load_perusahaan($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$cu = "a.jenis_usaha like '%".$nilai."%'";
		} else if($op==2){
			$cu = "a.nama_perusahaan like '%".$nilai."%'";
		} else if($op==3){
			$cu = "b.nama_pemilik like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, a.kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kode_kecamatan, a.kode_kelurahan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik where $cu");
		
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
	
	public function load_perusahaan4($op="",$nilai="") {
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
		
		$qr = $this->db->query("SELECT a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, 
c.nm_rek , a.telp, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, 
b.hp FROM identitas_perusahaan a 
LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik
LEFT JOIN master_rekening c ON c.pajak = LEFT(a.npwpd_perusahaan,1) AND c.pajak_det = SUBSTRING(a.npwpd_perusahaan,9,2) WHERE a.status_aktip='Y' AND LEFT(a.npwpd_perusahaan,2)!='61' AND $cu");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");				
					echo("<cell><![CDATA[".$rs->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");				
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");				
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");					
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
            $ret="<select name=\"$ctlId\" id=\"$ctlId\" $iEvent disabled >";
            if($ctlType=="BULAN"){
		$arr_data=array(""=>"","01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
            }elseif($ctlType=="TAHUN"){
                $arr_data=array(""=>"","2016"=>"2016", "2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021", "2022"=>"2022");
            }
		
		
		
                
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
	
	public function load_hotel($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='0'){
			$qr = $this->db->query("select sptpd_hotel.id, sptpd_hotel.npwpd, sptpd_hotel.no_sptpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_hotel.petugas, sptpd_hotel.gol_hotel, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hotel.jml_bayar from sptpd_hotel left join identitas_perusahaan on sptpd_hotel.npwpd=identitas_perusahaan.id_perusahaan");
		} else if($op=='1'){
			$qr = $this->db->query("select sptpd_hotel.id, sptpd_hotel.npwpd, sptpd_hotel.no_sptpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_hotel.petugas, sptpd_hotel.gol_hotel, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hotel.jml_bayar from sptpd_hotel left join identitas_perusahaan on sptpd_hotel.npwpd=identitas_perusahaan.id_perusahaan where sptpd_hotel.no_sptpd like '%".$nilai."%'");
		} else if($op=='2'){
			$qr = $this->db->query("select sptpd_hotel.id, sptpd_hotel.npwpd, sptpd_hotel.no_sptpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_hotel.petugas, sptpd_hotel.gol_hotel, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hotel.jml_bayar from sptpd_hotel left join identitas_perusahaan on sptpd_hotel.npwpd=identitas_perusahaan.id_perusahaan where sptpd_hotel.npwpd like '%".$nilai."%'");
		} else if($op=='3'){
			$qr = $this->db->query("select sptpd_hotel.id, sptpd_hotel.npwpd, sptpd_hotel.no_sptpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_hotel.petugas, sptpd_hotel.gol_hotel, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hotel.jml_bayar from sptpd_hotel left join identitas_perusahaan on sptpd_hotel.npwpd=identitas_perusahaan.id_perusahaan where identitas_perusahaan.nama_perusahaan like '%".$nilai."%'");
		} else if($op=='4'){
			$qr = $this->db->query("select sptpd_hotel.id, sptpd_hotel.npwpd, sptpd_hotel.no_sptpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_hotel.petugas, sptpd_hotel.gol_hotel, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_hotel.jml_bayar from sptpd_hotel left join identitas_perusahaan on sptpd_hotel.npwpd=identitas_perusahaan.id_perusahaan where identitas_perusahaan.alamat like '%".$nilai."%'");
		}
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
					//echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");--->ori
					echo("<cell><![CDATA[".$rs->nama_skpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->jns."]]></cell>");
					echo("<cell><![CDATA[".$rs->ket_insidentil."]]></cell>");
					echo("<cell><![CDATA[".$rs->cara_hitung."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_diterima."]]></cell>");
					echo("<cell><![CDATA[".$rs->petugas."]]></cell>");
					echo("<cell><![CDATA[".$rs->gol_hotel."]]></cell>");
					echo("<cell><![CDATA[".$rs->masa_pajak1."]]></cell>");
					echo("<cell><![CDATA[".$rs->masa_pajak2."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_bayar."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT id, no_sptrd, tahun, kriteria_htg, jml_karcis, skpd_pengelola, 
		tgl_diterima, no_karcis1, no_karcis2, jns_retribusi, sub_jns_retribusi, jml_bayar, author, petugas_penagih,jml_buku,kd_skpd FROM sptrd order by no_sptrd DESC","id","id, no_sptrd, tahun, kriteria_htg, 
		jml_karcis, skpd_pengelola, tgl_diterima, no_karcis1, no_karcis2, jns_retribusi, sub_jns_retribusi, jml_bayar, author, petugas_penagih,jml_buku,kd_skpd");	
	}
	
	public function data_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("sptpd_hotel.id, 
sptpd_hotel.npwpd,
sptpd_hotel.no_sptpd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
sptpd_hotel.jns,
sptpd_hotel.ket_insidentil,
sptpd_hotel.cara_hitung,
DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') as tgl_diterima,
sptpd_hotel.thn,
sptpd_hotel.petugas,
sptpd_hotel.gol_hotel,
DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') as masa_pajak1,
DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') as masa_pajak2,
sptpd_hotel.omset,
sptpd_hotel.jml_bayar,
sptpd_child.tarif
FROM
identitas_perusahaan
INNER JOIN sptpd_hotel ON sptpd_hotel.npwpd = identitas_perusahaan.npwpd_perusahaan INNER JOIN sptpd_child ON sptpd_hotel.no_sptpd = sptpd_child.no_sptpd where sptpd_hotel.author = '".$this->session->userdata('username')."'","id","id, npwpd, no_sptpd, nama_perusahaan, alamat_perusahaan, jns, ket_insidentil, cara_hitung, tgl_diterima, petugas, gol_hotel, masa_pajak1, masa_pajak2, omset, jml_bayar,tarif");	
	}
	
	public function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$tahun = $this->input->post('tahun');
		$spt = $this->input->post('jns');
        
        $spt = $this->input->post('jns');
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
	
	public function simpan() {
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
			//'npwpd' 		=> strtoupper($this->input->post('npwpd')),
			'skpd_pengelola' => strtoupper($this->input->post('nama')),  
			'kd_skpd' => strtoupper($this->input->post('kd_skpd')),
			//'alamat' 		=> strtoupper($this->input->post('alamat')),
			/* 'jns' 			=> strtoupper($this->input->post('jns')),
			'ket_insidentil'=> strtoupper($this->input->post('ket')),
			'ket_pajak' => $_POST['ket_pajak'],
			'ket_inap' => $_POST['ket_inap'],*/
			'kriteria_htg' 	=> strtoupper($this->input->post('perhitungan')), 
			'tgl_diterima' 	=> $this->input->post('tgl'),
			'jml_buku' 	=> $this->input->post('buku'),
			'no_karcis1' 	=> $this->input->post('karcis1'),
			'no_karcis2' 	=> $this->input->post('karcis2'),
			'tahun' 			=> $this->input->post('tahun'),
			'petugas_penagih' 		=> strtoupper($this->input->post('penagih')),
			'jns_retribusi' 	=> strtoupper($this->input->post('gol')),
			'sub_jns_retribusi' 	=> strtoupper($this->input->post('subjenis')),
			//'masa_pajak1' 	=> $this->input->post('tgl1'),
			//'masa_pajak2'	=> $this->input->post('tgl2'),
			'jml_karcis' 		=> $jml,
			'jml_bayar' 	=> $setoran,
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		
		/* $awal = explode('-',$this->input->post('tgl1'));
		$akhir = explode('-',$this->input->post('tgl2'));
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($this->input->post('npwpd')),
			'tanggal'		=> $this->input->post('tgl'),
			'masa_pajak1' 	=> $awal[1],
			'masa_pajak2'	=> $akhir[1],
			'masa_pajak_1' 	=> $this->input->post('tgl1'),
			'masa_pajak_2'	=> $this->input->post('tgl2'),
			'tahun' 			=> $this->input->post('tahun'),
			'jumlah' 	=> $setoran,
			'author' 		=> strtoupper($this->session->userdata('username'))
		); */
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek, tarif_pajak from master_rekening where kd_rek = '".$this->input->post('gol')."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($this->input->post('gol')),
			'nm_rek' => $rekening->nm_rek,
			'dp' => $jml,
			'tarif' => $this->input->post('tarif'),
			'jumlah' => $setoran
		);
		
		if($this->input->post('id')==0){
			$thn = date('Y');
			$sptpd = $this->generateNo(date("Y",strtotime($this->input->post('tgl'))));
			$dataIns = array_merge($data,array('no_sptrd' => $sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptrd',$dataIns);
			
			//table sptpd
			/* $dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2); */
			
			//table sptrd child
			$dataIns3 = array_merge($data_child,array('no_sptrd' => $sptpd));
			$this->db->insert('sptrd_child',$dataIns3);
			
		} else {
			$sptpd = $this->input->post('sptpd');
			$dataUpd = array_merge($data,array('no_sptrd' => $sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptrd', $dataUpd, array('id' => $this->input->post('id')));
			
			//table sptpd
			/* $dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $this->input->post('sptpd'))); */
			
			//table sptrd child
			$dataUpd3 = array_merge($data_child,array('no_sptrd' => $sptpd));
			$this->db->update('sptrd_child',$dataUpd3, array('no_sptrd' => $this->input->post('sptpd')));
		}	
			
		echo $sptpd;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select max_sptrd from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max_sptrd + 1;
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
		
		$dtUpd = array('max_sptrd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/RET/'.substr($thn,2,2);
	}
	
	public function delete() {
		$sq = $this->input->post('sptpd');
		$r = $this->db->query("SELECT COUNT(no_sptrd) AS jml FROM skrd where no_sptrd = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptrd',array('no_sptrd' => $this->input->post('sptpd')));
			$this->db->delete('sptrd_child',array('no_sptrd' => $this->input->post('sptpd')));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "data tidak bisa dihapus No.SPTPD ini sudah ditransaksikan di SKRD, Silakan Menghapus Data SKRD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cetak(){
		/*$spt = explode("=",$bray);
		$sptpd = $spt[0]+"/"+$spt[1]+"/"+$spt[2];
		echo $sptpd;*/
		
		$sql = $this->db->query("SELECT sptpd_hotel.id, sptpd_hotel.npwpd,view_perusahaan.npwpd_lama, sptpd_hotel.no_sptpd, 
        view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, 
        sptpd_hotel.jns, sptpd_hotel.ket_insidentil, sptpd_hotel.cara_hitung, DATE_FORMAT(sptpd_hotel.tgl_diterima,'%d/%m/%Y') AS tgl_diterima,
         sptpd_hotel.petugas, sptpd_hotel.gol_hotel,sptpd_hotel.ket_inap, DATE_FORMAT(sptpd_hotel.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,
          DATE_FORMAT(sptpd_hotel.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, sptpd_hotel.omset, sptpd_hotel.jml_bayar,
           sptpd_child.tarif FROM sptpd_hotel LEFT JOIN view_perusahaan ON sptpd_hotel.npwpd=view_perusahaan.npwpd_perusahaan LEFT JOIN
            sptpd_child ON sptpd_hotel.no_sptpd=sptpd_child.no_sptpd where sptpd_hotel.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				  = $sql->omset;
		$total				= number_format($jml,2,",",".");
		$tarif				= $sql->tarif;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
		$tgl_dit 			= $sql->tgl_diterima;
		$npwpd_lama			= $sql->npwpd_lama;
		
		$d1 = explode("/",$tgl_dit);
		$dd1 = $d1[0];
		$db1 = $d1[1];
		$dt1 = $d1[2];
		$db11= $this->msistem->v_bln($db1);
		
		$tgl_tr 	= $dd1." ".$db11." ".$dt1;
		
		$nm = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->gol_hotel."'")->row();
		
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
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
						PEMERINTAH KABUPATEN MELAWI<br />					
						<b>BADAN PENDAPATAN DAERAH</b><br />
						
					</td>
					<td width="220" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<b>SURAT PEMBERITAHUAN PAJAK DAERAH<br />
						PAJAK HOTEL</b><br /><br/>
						Masa Pajak&nbsp; : &nbsp;'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'
					</td>
					<td width="102" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
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
								<td width="120">&nbsp;&nbsp;2. Alamat</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->alamat_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;3. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;4. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;5. Nama Pemilik</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>DATA OBJEK PAJAK</strong>
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
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->gol_hotel.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$nm->nm_rek.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';	
		
		/*$jns = $sql->cara_hitung;
		if($jns!='1'){*/
		
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>DATA PAJAK HOTEL</strong>
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
//         c.tarif from sspd a left join sptpd_hotel b on a.nomor=b.no_sptpd left join sptpd_child c on
//          a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();

          $set= $this->db->query("select a.ketetapan, a.setoran, f.masa_pajak1, f.ket_inap ,f.masa_pajak2,e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_hotel f ON b.no_sptpd=f.no_sptpd 
          LEFT JOIN sptpd_child e ON f.no_sptpd=e.no_sptpd
          WHERE a.npwpd = '".$sql->npwpd."' AND a.masa_pajak1 = '".$a1."' AND a.tahun_pajak = '".$tahun."'")->row();
                     
		if($set==NULL){
			$tgl = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0%";
			$h = "Rp. 0,00";
			$inap = "";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl = $l1.' s/d '.$l2;
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = $set->tarif.'%';
			$h = 'Rp. '.number_format($set->setoran,2,",",".");
			
			$inap = $set->ket_inap;
		}
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="5" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="282">Masa Pajak</td>
								<td width="8">:</td>
								<td width="232">'.$tgl.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="282">Keterangan Jumlah Hunian /Bulan</td>
								<td width="8">:</td>
								<td width="232">'.$inap.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="282">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="232">'.$dp.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="282">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="232">'.$t.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">e.</td>
								<td width="282">Pajak Terhutang (c x d)</td>
								<td width="8">:</td>
								<td width="232">'.$h.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="282">Masa Pajak</td>
								<td width="8">:</td>
								<td width="232">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="282">Keterangan Jumlah Hunian /Bulan</td>
								<td width="8">:</td>
								<td width="232">'.$sql->ket_inap.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="282">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="232">Rp.'.$total.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="282">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="232">'.$tarif.'%</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">e.</td>
								<td width="282">Pajak Terhutang (c x d)</td>
								<td width="8">:</td>
								<td width="232">Rp. '.$pajak.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
						</table>	
					</td>
				</tr>
			</table>';
			
		/*} else if($jns=='2'){
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK HOTEL</strong>
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
					<td width="340">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;b.</td>
					<td width="200">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="340">Rp.'.$total.'</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		}*/
			
			$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
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
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan tersebut diatas beserta lampiran-lampirannya adalah benar, lengkap dan jelas.					    				
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
									<td width="200" align="center">Nanga Pinoh, '.$tgl_tr.'</td>
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
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
		//	$petugas=$this->session->userdata('username');
	$op = $this->db->query("select * from admin where username = '".$sql->petugas."'")->row();
	if($op==NULL){
		$petugas = "" ;
		$nip = "";
	} else {
		$petugas =strtoupper ($op -> nama);
		$nip = $op -> nip;
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
                            <td width="61%">'.$tgl_dit.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Nanga Pinoh, '.$tgl_tr.'</td>
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
						<td width="200" height="40" align="center">&nbsp;</td>
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
	
	public function test(){
		phpinfo();
	}
        public function get_bayar_terakhir($npwpd){
            
        }
}
?>