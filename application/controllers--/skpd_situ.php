<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpd_situ extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd',$data);
	}
	
	public function frmskpd($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['nama_ttd'] = $this->db->query("select * from master_tanda_tangan");		
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd',$data);
	}
    
   	public function frmskpd_reklame($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['nama_ttd'] = $this->db->query("select * from master_tanda_tangan");		
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd_reklame_situ',$data);
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
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			if($parameter="3"){
				$qr = " and view_perusahaan.nama_perusahaan like '%$kata_kunci%'";	
			}else if($parameter="4"){
				$qr = " and view_perusahaan.alamat_perusahaan like '%$kata_kunci%'";	
			}else{
			$qr = " and $parameter like '%$kata_kunci%'";
			}
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, view_perusahaan.nama_perusahaan, 
view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik, 
nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah,
sptpd.masa_pajak_1,sptpd.masa_pajak_2,nota_hitung.tgl_tempo,nota_hitung.tgl,nota_hitung.ket_nhp,nota_hitung.kep_proyek 
FROM nota_hitung 
LEFT JOIN view_perusahaan ON nota_hitung.npwpd=view_perusahaan.npwpd_perusahaan
LEFT JOIN sptpd ON sptpd.no_sptpd = nota_hitung.sptpd 
where nota_hitung.nama_sptpd = '".$kode_sptpd."' and nota_hitung.status ='0' $qr","id","no_nota, sptpd, npwpd, nama_perusahaan ,alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, jumlah, masa_pajak_1, masa_pajak_2, tgl_tempo, tgl, ket_nhp, kep_proyek");
	}
	
	public function cData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama, view_perusahaan.alamat, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join view_perusahaan on nota_hitung.npwpd=view_perusahaan.id_perusahaan where nota_hitung.nama_sptpd = '".$_GET['kode']."'","id","no_nota,sptpd,npwpd,nama_perusahaan,alamat_perusahaan,nama,alamat,masa_pajak1,masa_pajak2,tahun,jumlah");
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
		$upd = array (
				'status' => 1
		);
		$this->db->update('nota_hitung', $upd, array('no_nota' => $_POST['nota_hitung']));
			
		$jml = $_POST['jml'];
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$data = array(
            'nota_hitung' => $_POST['nota_hitung'],
            'npwpd' => $_POST['npwpd'],
            /*'nama' => $_POST['nama'],
            'alamat' => strtoupper($_POST['alamat']),
            'nm_pemilik' =>  strtoupper($_POST['nm_pemilik']),
            'alamat_pemilik' => $_POST['alamat_pemilik'],*/
            'masa_pajak1' => $_POST['awal'],
            'masa_pajak2' => $_POST['akhir'],
            'tahun' => $_POST['tahun'],
            'tgl_jth_tempo' => $_POST['tgl_jth_tempo'],
            'tgl' => $_POST['tgl'],                        
            'no_sptpd' => $_POST['no_sptpd'],
			'id_ttd' => $_POST['ttdid'],
            'jumlah' =>  $jml,
			'kode_sptpd' =>  $_POST['kode_sptpd'],
			'ket_skpd' =>  $_POST['ket_skpd'],
			'tahun_transaksi' => date('Y'),
			'nama' 	=>  $_POST['nama'],
			'alamat' 	=>  $_POST['alamat'],
			'nm_pemilik' 	=>  $_POST['nm_pemilik'],
			'alamat_pemilik' 	=>  $_POST['alamat_pemilik'],
			'masa_pajak_1' 	=>  $_POST['tg_masa1'],
			'masa_pajak_2' 	=>  $_POST['tg_masa2'],
            'author' => $this->session->userdata('username')
        );
		if($this->input->post('skpd_1')=="") {
                    
			$thn = date('Y',strtotime($_POST['tgl']));
			$no_skpd = $this->generateNo($thn,$_POST['kode_sptpd']).'/'.$_POST['kode_sptpd'].'/'.substr($thn,2,2);
                        
                        //cek insidentil
                        $insidentil = $this->db->query("SELECT insidentil FROM identitas_perusahaan WHERE npwpd_perusahaan = '".$_POST['npwpd']."'")->row();
                        $insidentil = $insidentil->insidentil;
                        //cek kost
                        if(substr($_POST['npwpd'],0,1) == "1" && substr($_POST['npwpd'],8,2) == "12"){                   
                            //cari nomor skpd lewat
                            $wo = $this->db->query("SELECT no_skpd FROM skpd WHERE no_skpd LIKE '%HTL/".date("y")."%' ORDER BY no_skpd");
                            $no_skpd_temp = 1;
                            foreach($wo->result() as $ch) {
                                $no_skpd_htl = $ch->no_skpd;
                                $no_skpd_htl = explode("/",$no_skpd_htl);
                                $no_skpd_htl = (int)$no_skpd_htl[0];
                                if($no_skpd_temp == $no_skpd_htl){
                                    $no_skpd_temp++;
                                }else{
                                    break;
                                }
                            }
                            $no_skpd = sprintf("%09d", $no_skpd_temp)."/HTL/".date("y");
                            
                            //cek rekening katering
                        }elseif(substr($_POST['npwpd'],0,1) == "2" && substr($_POST['npwpd'],8,2) == "04"){
                            //cari nomor skpd lewat
                            $wo = $this->db->query("SELECT no_skpd FROM skpd WHERE no_skpd LIKE '%RES/".date("y")."%' ORDER BY no_skpd");
                            $no_skpd_temp = 1;
                            foreach($wo->result() as $ch) {
                                $no_skpd_htl = $ch->no_skpd;
                                $no_skpd_htl = explode("/",$no_skpd_htl);
                                $no_skpd_htl = (int)$no_skpd_htl[0];
                                if($no_skpd_temp == $no_skpd_htl){
                                    $no_skpd_temp++;
                                }else{
                                    break;
                                }
                            }
                            $no_skpd = sprintf("%09d", $no_skpd_temp)."/RES/".date("y");
                        }elseif($_POST['kode_sptpd'] == "REK" && $insidentil == "1"){
                            //cari nomor skpd lewat
                            $wo = $this->db->query("SELECT no_skpd FROM skpd WHERE no_skpd LIKE '%REK/".date("y")."%' ORDER BY no_skpd");
                            $no_skpd_temp = 1;
                            foreach($wo->result() as $ch) {
                                $no_skpd_htl = $ch->no_skpd;
                                $no_skpd_htl = explode("/",$no_skpd_htl);
                                $no_skpd_htl = (int)$no_skpd_htl[0];
                                if($no_skpd_temp == $no_skpd_htl){
                                    $no_skpd_temp++;
                                }else{
                                    break;
                                }
                            }
                            $no_skpd = sprintf("%09d", $no_skpd_temp)."/REK/".date("y");
                        }
                        
			$no_kohir = $this->generateNo($thn,$_POST['kode_sptpd']);
			$dataIns = array_merge($data,array('no_skpd' => $no_skpd,'no_kohir' => $no_kohir,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('skpd', $dataIns);
		} else {
			$no_skpd = $this->input->post('skpd_1')."/".$this->input->post('skpd_2');
			$this->db->delete('skpd_child',array('skpd' => $no_skpd));
			$dataUpdate = array_merge($data,array('author' => $this->session->userdata('username'),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skpd',$dataUpdate,array('no_skpd' => $no_skpd));
		}
		echo $no_skpd;
	}
	
	public function generateNo($thn="",$kode="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpd,'/',1)) as max from skpd where LEFT(tgl,4) = '".$thn."' and kode_sptpd = '".$kode."'");
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
			/* ini_set('memory_limit', '10000M'); 
			ini_set('max_execution_time', '700');  */
			
		$grid = new GridConnector($this->db->conn_id);
		/* $grid->dynamic_loading(100);  */
		$grid->render_sql("SELECT skpd.no_skpd, DATE_FORMAT(skpd.tgl,'%d/%m/%Y') AS tgl,
         DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') AS tgl_jth_tempo, view_perusahaan.nama_perusahaan,
          view_perusahaan.alamat_perusahaan , view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik, 
          skpd.npwpd, skpd.jumlah AS total, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun, skpd.no_sptpd, skpd.nota_hitung, 
          skpd.no_kohir,skpd.id_ttd,skpd.masa_pajak_1,skpd.masa_pajak_2,skpd.ket_skpd 
          FROM skpd 
          LEFT JOIN view_perusahaan ON skpd.npwpd=view_perusahaan.npwpd_perusahaan
          where skpd.kode_sptpd = '".$_GET['kode']."' ORDER BY skpd.no_skpd DESC LIMIT 50","id","no_skpd, tgl, nama_perusahaan, alamat_perusahaan,
          nama_pemilik, alamat_pemilik, npwpd, total, masa_pajak1, masa_pajak2, tahun, tgl_jth_tempo, no_sptpd, nota_hitung, no_kohir, id_ttd, masa_pajak_1, masa_pajak_2,ket_skpd");
	}
	
	function hapus() {
		$no_skpd = $this->input->post('skpd_1')."/".$this->input->post('skpd_2');
		$s = $this->db->query("select count(id) as jml from sspd where nomor='".$no_skpd."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('skpd',array('no_skpd' => $no_skpd));
			$this->db->delete('skpd_child',array('skpd' => $no_skpd));
			$result = "Data SKPD berhasil dihapus.";
		} else {
			$result = "Data tidak Bisa dihapus No.SKPD ini sudah ditransaksikan di SSPD,Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	function dataItemPajak() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpd'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd from skpd_child where skpd = '".$_GET['skpd']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd from skpd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
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
		
		if($so[1]=="REK"){
			$wo = $this->db->query("SELECT  b.kd_rek,b.nm_rek,a.dp,b.trf AS tarif,a.kenaikan,a.denda,a.bunga,a.kompensasi,b.ketetapan AS jumlah FROM nhp_child a
			LEFT JOIN sptpd_reklame_detail b ON b.no_sptpd = a.sptpd where a.no_nota='".$spt."'");
		
		}else{
			$wo = $this->db->query("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,bunga,kompensasi,jumlah from nhp_child where no_nota='".$spt."'");		
		}
				
		$i=1;
		foreach($wo->result() as $w) {
			// cair
			$spt = '';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$w->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->dp."]]></cell>");
					echo("<cell><![CDATA[".$w->tarif."]]></cell>");
					echo("<cell><![CDATA[".$w->kenaikan."]]></cell>");
					echo("<cell><![CDATA[".$w->denda."]]></cell>");
					echo("<cell><![CDATA[".$w->bunga."]]></cell>");
					echo("<cell><![CDATA[".$w->kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$w->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$spt."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function dt_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("skpd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
											//No Nota, Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, SPTPD
	}
	
	public function cetak() {		
			$data = $this->db->query("SELECT a.no_skpd, DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tgl, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') AS tgl_jth_tempo, b.nama_perusahaan, 
			b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, b.npwpd_lama, '0' AS denda, a.jumlah AS total, 
			a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_sptpd, 
			a.nota_hitung, a.no_kohir, a.id_ttd, a.masa_pajak_1,a.masa_pajak_2,a.ket_skpd, c.nama_kelurahan, b.no_urut FROM skpd a 
			LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan LEFT JOIN view_kelurahan c ON SUBSTR(b.npwpd_perusahaan,19,2)=c.kode_kelurahan AND SUBSTR(b.npwpd_perusahaan,16,2)=c.kode_kecamatan where a.no_skpd='".$_GET['skpd']."'")->row();
		$no 				= $data->no_skpd;
		$npwpd 				= $data->npwpd_perusahaan;
		$npwpd_lama 				= $data->npwpd_lama;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$kelurahan 			= $data->nama_kelurahan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
		$ket_skpd			= $data->ket_skpd;
		//if($ket_skpd!="")$ket_skpd="$ket_skpd, ";
		$total				= number_format($data->total,2,",",".");
		$idd_ttd			= $data->id_ttd;
		$idd_tgl			= explode("/",$data->tgl);
		$dd1				= $idd_tgl[0];
		$dd2				= $this->msistem->v_bln($idd_tgl[1]);
		$dd3				= $idd_tgl[2];
		$noUrut				= $data->no_urut;
		
		$tgl_terbit			= $dd1." ".$dd2." ".$dd3;
		
		$s = explode('/',$no);
		$sptpd = $s[1];
		$ketNoUrut = "";
		$ketTambahan = "";
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
			$dataGalian = $this->db->query("SELECT sptpd_galianc_d1.volume, sptpd_galianc_d1.harga_pasar, sptpd_galianc_d1.dp FROM sptpd_galianc_d1 WHERE sptpd = '".$data->no_sptpd."'")->row();
			$volumeGalian = $dataGalian->volume;
			$hargaDasarGalian = $dataGalian->harga_pasar;
			$ketTambahan = "DP = ".$volumeGalian. " m<sup>3</sup> x Rp. ".$hargaDasarGalian." = Rp. ".number_format($dataGalian->dp,0,',','.');
			if($ket_skpd=="") $ket_skpd=$ketTambahan;
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
			$dataAir = $this->db->query("SELECT sptpd_air_bawah_tanah.volume, tb_lokasi_indeks.indeks, tb_lokasi_indeks.harga, sptpd_air_bawah_tanah.harga_dasar FROM sptpd_air_bawah_tanah, tb_lokasi_indeks WHERE no_sptpd = '".$data->no_sptpd."' AND tb_lokasi_indeks.id = sptpd_air_bawah_tanah.lokasi_sumber_air")->row();
			$volumeAir = $dataAir->volume;
			$indeksAir = $dataAir->indeks;
			$hargaDasarAir = $dataAir->harga;
			$hargaDasarHasil = $dataAir->harga_dasar;
			$ketTambahan = "DP = ".str_replace(".",",",$volumeAir). " m<sup>3</sup> x ".str_replace(".",",",$indeksAir)." x Rp. ".$hargaDasarAir." = Rp. ".number_format($hargaDasarHasil,0,',','.');
			$ketNoUrut = "<tr style='font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;font-size:larger;'>
						<td width='80'>&nbsp;&nbsp;    No Urut</td>
						<td width='10' align='center'>:</td>
						<td width='170'>&nbsp;&nbsp;$noUrut</td>																			 
					</tr>";
					if($ket_skpd=="") $ket_skpd=$ketTambahan;
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		}
		
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='".$idd_ttd."'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		}
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'LETTER', true, 'UTF-8', false); 
		
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
		//$pdf->SetAutoPageBreak(true,110);
		$pdf->AddPage('P','LETTER',false);
		//set data
		
		$dday = explode("-",$data->masa_pajak_1);
		$ddthn1 = $dday[0];
		$ddbln2 = $this->msistem->v_bln($dday[1]);
		$ddtgl3 = $dday[2];
		
		$dday2 = explode("-",$data->masa_pajak_2);
		$ddthn = $dday2[0];
		$ddbln = $this->msistem->v_bln($dday2[1]);
		$ddtgl = $dday2[2];
		
		$report = '';
		$report .=
			'<table border=1>
				<tr>
					<td width="50" height="54" align="center" valign="middle"><img src="./images/Logo Daerah Jambi2.png" width="48" height="49" /></td>					
					<td width="220" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; ">
						<b>PEMERINTAH KOTA JAMBI<br />
						DINAS PENDAPATAN<br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284</b>
					</td>
					<td width="210" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; ">
						<b>SURAT KETETAPAN PAJAK DAERAH<br />
						PAJAK '.$nama_sptpd.'<br/>
						Masa Pajak: &nbsp;'.$ddbln2.' - '.$ddbln.'	<br/>
						Tahun Pajak : &nbsp;'.$ddthn1.' - '.$ddthn.' 	</b>										
					</td>
					<td width="92" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; ">
						<br /><br />
						<b>No. SKP<br />
						'.$no.'</b>
					</td>
				</tr>
			</table>';
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get="$npwpd_lama" ;
			}
			if(substr($npwpd,15,2)==00){
				$kelurahan= "";
			}else{
				$kelurahan= " KEL. ".$kelurahan;
			}
			
			
			if($tempo=='00 00 0000'){
				$tempo="-";
			}
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140" >&nbsp;&nbsp;   NAMA USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140">&nbsp;&nbsp;   ALAMAT USAHA</td>
					<td width="10" align="center">:</td>
					<td width="350">&nbsp;&nbsp;'.$alamat.$kelurahan.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140">&nbsp;&nbsp;   NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140">&nbsp;&nbsp;   NPWPD LAMA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;'.$get.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140">&nbsp;&nbsp;   NPWPD BARU</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="140">&nbsp;&nbsp;   TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;'.$tempo.'</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="25" height="25" align="center">No</td>
					<td width="80" height="25" align="center">Kode Rekening</td>
					<td width="155" height="25" align="center">Nama Rekening</td>
					<td width="182" height="25" align="center">Uraian Pajak</td>
					<td width="130" height="25" align="center">Jumlah (Rp.)</td>
				</tr>';
			
			$child = $this->db->query("select * from skpd_child where skpd ='".$no."'");
			$i = 1;
			foreach($child->result() as $ch) {
				$varke = ($ch->tarif * $ch->dp)/100;
				/* if($ch->kd_rek=='4.1.1.03.15'){
					$ch->nm_rek = 'Permainan Ketangkasan';
				} */
				
			if($ch->kd_rek=='4.1.1.03.16'){
				if($ch->tarif=='15'){
					$ch->nm_rek = 'Refleksi';
				}else{
					$ch->nm_rek = 'Panti Pijat';
				}
			}
				
					$report .= '<tr id='.$i.' >
					  <td width="25" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$i.'</td>
					  <td width="80" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$ch->kd_rek.'</td>
					  <td width="155" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$ch->nm_rek.'</td>
					  <td width="182" height="25" align="center" style="font-family: Times new roman; font-size:12px; font-weight:bold;">'.number_format($ch->dp,2,',','.').' x '.$ch->tarif.'%</td>
					  <td width="130" height="25" align="right" style="font-family: Times new roman; font-size:12px; font-weight:bold;">Rp. '.number_format(round($varke),2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="442" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.number_format(round($varke),2,',','.').'&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="442" align="right">Jumlah Sanksi/Denda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.number_format($ch->denda,2,',','.').'&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="442" align="right">Jumlah Keseluruhan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
				</tr>
				</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
			$report .=
				'<table border="1">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="572">
						<table border="0">
							<tr>
								<td width="5" height="20">&nbsp;</td>
								<td width="74" height="20">&nbsp;Dengan huruf</td>
								<td width="15" height="20" align="center">:</td>
								<td width="420" height="20"><i>'.$terbilang.'RUPIAH</i></td>
							</tr>							
						</table>
						</td>
					</tr>
				</table>';
				
			$report .=			
			'			
			<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">					
						<td width="5" height="20">&nbsp;</td>
						<td width="74" height="20">&nbsp;K E T</td>
						<td width="15" height="20" align="center">:</td>
						<td width="420" height="20">'.$ket_skpd.'</td>
					</tr>					
				</table>
				</td>
				</tr>
			</table>';
			
			//ganti kepala tanda tangan
			if($idd_ttd==2){
				$kepalaNya = "Kepala Dinas Pendapatan Kota Jambi";
			}else{
				$kepalaNya = "Kabid Pendataan, Penetapan dan Penagihan";
			}
			
			$report .=
			'<table border="1">
				<tr>
				<td width="300">									
					<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="250" cosplan="3">&nbsp; <u>P E R H A T I A N</u></td>						
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="10">&nbsp;</td>						
						<td width="20">1.</td>						
						<td width="230" align="justify">Harap penyetoran dilakukan pada Bank / Bendahara Penerima Dinas Pendapatan Kota Jambi.</td>						
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="10">&nbsp;</td>						
						<td width="20">2.</td>						
						<td width="230" align="justify">Apabila SKPD ini tidak atau kurang dibayar lewat tanggal jatuh tempo dikenakan sanksi administrasi berupa denda sebesar 2 % per bulan.</td>						
					</tr>
					</table>					
				</td>
				<td width="272">									
					<table border="0">
					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center">Jambi, '.$tgl_terbit.'</td>
					</tr>					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">	
						<td width="272" align="center">a.n '.$kepalaNya.' <br/>'.$jab1.'</td>
					</tr>					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="272" height="40">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center"><u>'.$nama1.'</u></td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center">NIP. '.$nip1.'</td>
					</tr>					
				</table>	
				</td>
				</tr>
			</table>';
			$report .=
			'<table border="0">
				<tr>
				<td width="582">
				---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				</td>
				</tr>
			</table>	
			<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td colspan="2">&nbsp;    TANDA TERIMA SKP '.$nama_sptpd.'</td>     <td width="250" align="center">
						<br /><br />
						No. SKP<br />
						'.$no.'
					</td>
					</tr><br/>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    NAMA</td>
						<td width="10" align="center">:</td>
						<td width="170">&nbsp;&nbsp;'.$nama.'</td>                                                                            
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    ALAMAT</td>
						<td width="10" align="center">:</td>
						<td width="250">&nbsp;&nbsp;'.$alamat.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    NPWPD</td>
						<td width="10" align="center">:</td>
						<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>																			 
					</tr>'.$ketNoUrut.'					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td colspan="2">&nbsp;</td>																		<td width="250" align="center">Jambi, '.$tgl_terbit.'
																													<br />Yang Menerima
																													<br /><br /><br />....................................</td>
					<br /><br />
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
		$data = $this->db->query("SELECT a.no_skpd, d.no_sptpd,DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tgl, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') AS tgl_jth_tempo,
d.masa_pajak_1 AS msp1,d.masa_pajak_2 AS msp2,b.nama_perusahaan, 
b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, b.npwpd_lama,c.denda,c.kompensasi,c.jumlah, a.jumlah AS total, a.masa_pajak1, 
a.masa_pajak2, a.tahun, a.no_sptpd, a.nota_hitung,a.ket_skpd,
a.no_kohir,a.id_ttd, e.nama_kelurahan FROM skpd a 
LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan
LEFT JOIN sptpd d ON d.no_sptpd = a.no_sptpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN view_kelurahan e ON SUBSTR(b.npwpd_perusahaan,19,2)=e.kode_kelurahan AND SUBSTR(b.npwpd_perusahaan,16,2)=e.kode_kecamatan
where a.no_skpd='".$_GET['skpd']."'")->row();
		$no 				= $data->no_skpd;
		$npwpd 				= $data->npwpd_perusahaan;
		$npwpd_lama 		= $data->npwpd_lama;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$kelurahan 			= $data->nama_kelurahan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
		$tms_pajak1			= explode('-',$data->msp1);	
		$tms_pajak1_thn		= $tms_pajak1[0];	
		$tms_pajak1_bln		= $this->msistem->v_bln($tms_pajak1[1]);
		$tms_pajak1_tgl		= $tms_pajak1[2];
		$tms_pajak2			= explode('-',$data->msp2);	
		$tms_pajak2_thn		= $tms_pajak2[0];	
		$tms_pajak2_bln		= $this->msistem->v_bln($tms_pajak2[1]);
		$tms_pajak2_tgl		= $tms_pajak2[2];	
		//$ket				= ;
		$jml				= number_format($data->jumlah,2,",",".");
		$denda2				= number_format($data->denda,2,",",".");
		$total				= number_format($data->total,2,",",".");
		$idd_ttd			= $data->id_ttd;
		$badan				= "Badan Pengelola Pajak dan Retribusi Daerah";
				
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
		
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='".$idd_ttd."'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		}
		
		$t2 				 = explode('/',$data->tgl);
		$b2                  = $this->msistem->v_bln($t2[1]);
		$tgl_terima          = $t2[0].' '.$b2.' '.$t2[2];
		
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'LETTER', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		if($_GET['cetakHalaman']=='false')$cekCetakReklame=false;
		else $cekCetakReklame=true;
		$pdf->setPrintFooter($cekCetakReklame);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
		//$pdf->SetAutoPageBreak(true,20);
		$pdf->SetAutoPageBreak(true,70);
		$pdf->AddPage('P','LETTER',false);
		
		if($tms_pajak1_thn==$tms_pajak2_thn){
			$kopMasaPajak = $tms_pajak1_thn;
		}else{
			$kopMasaPajak = $tms_pajak1_thn.' - '.$tms_pajak2_thn;
		}
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="50" height="54" align="center" valign="middle"><img src="./images/Logo Daerah Jambi2.png" width="48" height="49" /></td>
					<td width="200" align="center" >
						PEMERINTAH KOTA JAMBI<br />
						'.strtoupper($badan).'<br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN RETRIBUSI DAERAH<br />
						( SKR - DAERAH)<br />
						Masa Pajak&nbsp;:<br/>'.$kopMasaPajak.'						
					</td>
					<td width="122" align="center">
						<br /><br />
						No. SKP<br />
						'.$no.'
					</td>
				</tr>
			</table>';
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get="".$npwpd_lama."";
			}
				
			if(substr($npwpd,15,2)==00){
				$kelurahan= "";
			}else{
				$kelurahan= " KEL. ".$kelurahan;
			}
			
			
			if($tempo=='00 00 0000'){
				$tempo="-";
			}
			
		$report .=
			'<table border="1">
				<tr>
				<td width="582">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;NAMA USAHA</td>
					<td width="10" align="center">:</td>
					<td width="310">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;ALAMAT USAHA</td>
					<td width="10" align="center">:</td>
					<td width="350">&nbsp;&nbsp;'.$alamat.$kelurahan.'</td>
				</tr >
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;NPWPD LAMA</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;'.$get.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="160">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;'.$tempo.'</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">
					<td width="25" height="20" align="center">No</td>
					<td width="145" height="20" align="center">Rekening</td>
					<td width="302" height="20" align="center">Uraian</td>
					<td width="110" height="20" align="center">Jumlah</td>
				</tr>';
			
			///$child = $this->db->query("select * from skpd_child where skpd ='".$no."'");
            $child = $this->db->query("SELECT a.*,e.kd_rek AS kd_rek_sptpd, e.nm_rek AS nm_rek_sptpd, b.nota_hitung,c.sptpd,e.lokasi AS lokasi1,d.teks_reklame,e.tema,e.kawasan,e.panjang,e.lebar,e.jari,e.sisi,e.luas,e.unit,e.ketetapan AS jumlahh ,e.tarif,e.nsl,d.masa_pajak1 as ms_pajak1,d.masa_pajak2 as ms_pajak2,e.ms_pajak1 AS pajak1,e.ms_pajak2 AS pajak2,e.trf,date_format(d.masa_pajak1,'%d/%m/%Y') as masa_pajak1, date_format(d.masa_pajak2,'%d/%m/%Y') as masa_pajak2, c.kep_proyek FROM skpd_child a LEFT JOIN skpd b ON a.skpd=b.no_skpd 
                    LEFT JOIN nota_hitung c ON b.nota_hitung=c.no_nota LEFT JOIN sptpd_reklame d ON c.sptpd=d.no_sptpd LEFT JOIN sptpd_reklame_detail e ON d.no_sptpd=e.no_sptpd
                    WHERE a.skpd='".$no."' GROUP BY e.id");
			$i = 1;
			$JumlahKetetapan = 0;			
			foreach($child->result() as $ch) {
                                        $pajak1 = date('d-m-Y', strtotime($ch->pajak1));
                                        $pajak2 = date('d-m-Y', strtotime($ch->pajak2));
                                        $selisihHari = round(((abs(strtotime ($pajak2) - strtotime ($pajak1)))/(60*60*24))+1);
                                        if($ch->kd_rek_sptpd=='4.1.1.04.02'){
                                            $cetakHari = "x ".$selisihHari."Hr";  
											$cetakBulan = "";
											//if($selisihHari>360) $cetakHari = "";
											                                              
                                        }else{
                                            $cetakHari = "";
											/*
											// TMT DARI SPTPD REKLAME DETAIL
											$pajak1 = date('d-m-Y', strtotime($ch->pajak1));
                                        	$pajak2 = date('d-m-Y', strtotime($ch->pajak2));
											*/
                                            
											// TMT DARI SPTPD
											$pajak1 = date('d-m-Y', strtotime($ch->ms_pajak1));
                                            $pajak2 = date('d-m-Y', strtotime($ch->ms_pajak2));  
											
											$selisihBulan = round(((abs(strtotime ($pajak2) - strtotime ($pajak1)))/(60*60*24*30.42)));
											//jika selisih bulan habis dibagi duabelas (1 tahun) maka
											//selisih bulan dibagi 12 dapat berapa tahun
											//jika 1 tahun tidak ditulis
											// jika lebih 1 tahun tulis
											if($selisihBulan%12==0){
												$selisihTahun = $selisihBulan/12;
												if($selisihTahun>1){
													$cetakBulan = "x ".$selisihTahun."Thn";
												}else{
													$cetakBulan = "";
												}
											}else{
												$cetakBulan = ": 12Bln x ".$selisihBulan."Bln";
											}
																						
                                        }
										$masaPajak = "";
										if($pajak1==$pajak2){
											$masaPajak = $pajak1;
										}else{
											$masaPajak = $pajak1.' s/d '.$pajak2;
										}
										
										
										
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">'.$i.'</td>
					  <td width="145" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">'.$ch->kd_rek_sptpd.'</td>
					  <td width="302" height="25" align="left" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px; font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;'.$ch->nm_rek_sptpd.'</td>
					  <td width="110" height="25" align="right" style="font-family: Times new roman; font-size:12px; font-weight:bold;">Rp. '.number_format($ch->jumlahh,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
					$JumlahKetetapan+=$ch->jumlahh;
			}
			//$jml2 = $total-$denda2;
			/* if($ch->denda == 0 ){
					$jml2 = $total;
				}else{
					$jml2 = $jml;
					} */
			
			
			/* $report .=
				'<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="472" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="110" height="25" align="right">Rp. '.number_format($JumlahKetetapan,2,',','.').'&nbsp;&nbsp;</td>
				</tr>
				
				<tr style="font-family:Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="472" align="right">Jumlah Sanksi/Denda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="110" height="25" align="right">Rp. '.number_format($ch->denda,2,',','.').'&nbsp;&nbsp;</td>
				</tr>'; */
			
			if($ch->kompensasi != 0){
			
			$report .=
				'<tr style="font-family:Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="25" width="472" align="right">Jumlah Yang Sudah Dibayarkan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="110" height="25" align="right">(Rp. '.number_format($ch->kompensasi,2,',','.').')&nbsp;&nbsp;</td>
				</tr>';
			}
				
			$report .=
			'<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
				  <td width="25"></td>
				  <td width="145"></td>
				  <td colspan="3" height="25" width="302" align="left">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah</td>
				  <td width="110" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
			</tr>
			</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
			$report .=
				'<table border="1">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="582">
						<table border="0">
							<tr>
								<td width="5" height="15">&nbsp;</td>
								<td width="74" height="15">&nbsp;Dengan huruf</td>
								<td width="15" height="15" align="center">:</td>
								<td width="450" height="15"><i>'.$terbilang.'RUPIAH</i></td>
							</tr>							
						</table>
						</td>
					</tr>
				</table>';
				
					
				$kenaikan= $ch->denda / $JumlahKetetapan * 100 ;
				//keterangan
				if($ch->denda == 0){
					$ket_denda = $data->ket_skpd ;
				}
				else{
					if($ch->kep_proyek!=""){
						$ket_denda = $data->ket_skpd ;
					}else{
					$ket_denda = 'Denda : Rp. '.number_format($JumlahKetetapan,2,",",".").' x '.$kenaikan.'% = '.number_format($ch->denda,2,",",".");
					//$ket_denda = 'Denda : Rp. 27.864.000 x 6% = Rp. 1.671.840';
					//$ket_denda = $ch->kep_proyek ;
					}
				}
			$report .=			
			'			
			<table border="1">
				<tr>
				<td width="582">
				<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td height="15" width="5">&nbsp;</td>
						<td height="15" width="500">&nbsp;K E T : '.$ket_denda.' </td>
					</tr>					
				</table>
				</td>
				</tr>
			</table>';
				
				if($idd_ttd==2){
					$kepalaNya = "Kepala ".$badan;
				}else{
					$kepalaNya = "Kabid Pendaftaran, Pendataan dan Penetapan";
				}
				
			$report .=
			'<table border="1">
				<tr>
				<td width="300">									
					<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="250" cosplan="3">&nbsp; <u>P E R H A T I A N</u></td>						
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="10">&nbsp;</td>						
						<td width="20">1.</td>						
						<td width="230" align="justify">Harap penyetoran dilakukan pada Bank / Bendahara Penerimaan '.$badan.' Kota Jambi.</td>						
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="10">&nbsp;</td>						
						<td width="20">2.</td>						
						<td width="230" align="justify">Apabila SKPD ini tidak atau kurang dibayar lewat tanggal jatuh tempo dikenakan sanksi administrasi berupa denda sebesar 2 % per bulan.</td>						
					</tr>
					</table>					
				</td>
				<td width="282">									
					<table border="0">
					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center">Jambi, '.$tgl_terima.'</td>
					</tr>					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">	
						<td width="272" align="center">an. '.$kepalaNya.' <br/>'.$jab1.'</td>
					</tr>					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="272" height="40">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center"><u>'.$nama1.'</u></td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">						
						<td width="272" align="center">NIP. '.$nip1.'</td>
					</tr>					
				</table>	
				</td>
				</tr>
			</table>';
			$report .=
			'<table border="0">
				<tr>
				<td width="582">
				------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				</td>
				</tr>
			</table>	
			<table border="1">
				<tr>
				<td width="582">
				<table border="0">
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td colspan="2">&nbsp;    TANDA TERIMA SKP '.$nama_sptpd.'</td>     <td width="250" align="center">
						<br /><br />
						No. SKP<br />
						'.$no.'
					</td>
					</tr><br/>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    NAMA</td>
						<td width="10" align="center">:</td>
						<td width="170">&nbsp;&nbsp;'.$nama.'</td>                                                                            
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    ALAMAT</td>
						<td width="10" align="center">:</td>
						<td width="250">&nbsp;&nbsp;'.$alamat.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="80">&nbsp;&nbsp;    NPWPD</td>
						<td width="10" align="center">:</td>
						<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>																			 
					</tr>					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td colspan="2">&nbsp;</td>																		<td width="250" align="center">Jambi, '.$tgl_terima.'
																													<br />Yang Menerima
																													<br /><br /><br />....................................</td>
					<br /><br />
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
