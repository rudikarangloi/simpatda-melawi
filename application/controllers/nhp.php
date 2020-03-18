<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class nhp extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
	}
	
	public function hitung($kode){
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		$cek = $kd->nama_sptpd;
		$tgl1 = $this->db->query("SELECT DATE_FORMAT(CURDATE(),'%d/%m/%Y') AS tanggal ,DATE_ADD(CURDATE(), INTERVAL 30 DAY) AS jatuh_tempo, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL 30 DAY), CURDATE()) AS selisih")->row();
		$jth_tmp = $tgl1->jatuh_tempo;
		$jth_tmp2 = date('d/m/Y', strtotime($jth_tmp ));
		//date('d-m-Y', strtotime($jth_tmp ));
		
		$data['title'] = $cek;
		$data['kode'] = $kode;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening");
		$data['tgl'] = date('d/m/Y');
		$data['tgl2'] = $jth_tmp2;
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/nhp',$data);
	}
    
    public function hitung_rek($kode){
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		$cek = $kd->nama_sptpd;
		
		$data['title'] = $cek;
		$data['kode'] = $kode;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening");
		$data['tgl'] = date('d/m/Y');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/nhp_rek',$data);
	}
	
	public function hitung_gal($kode){
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		$cek = $kd->nama_sptpd;
		
		$data['title'] = $cek;
		$data['kode'] = $kode;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening");
		$data['tgl'] = date('d/m/Y');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/nhp_gal',$data);
	}
	
	public function lihat() {
		$s = $this->input->post('sptpd');
		$kode = $this->input->post('kode');
			
		if($kode=='HTL'){
		$w = $this->db->query("SELECT no_sptpd AS sptpd, gol_hotel AS gol, omset AS jumlah FROM sptpd_hotel WHERE no_sptpd = '".$s."'")->row();
				$sptpd = $w->sptpd;
				$gol = $w->gol;
				$jml = $w->jumlah;
				$cari = $this->db->query("select nm_rek, tarif_pajak from master_rekening where kd_rek ='".$gol."'")->row();
				$tarif = $cari->tarif_pajak;
				$jumlah = ($jml * $tarif)/100;
				
				$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0%'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
				$q = $data;

		} else if($kode=='RES'){
		$w = $this->db->query("SELECT no_sptpd AS sptpd, sptpd_restoran.gol_restoran AS gol, sptpd_restoran.omset AS jumlah FROM sptpd_restoran WHERE sptpd_restoran.no_sptpd = '".$s."'")->row();
				$sptpd = $w->sptpd;
				$gol = $w->gol;
				$jml = $w->jumlah;
				$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
				$tarif = '10';
				$jumlah = ($jml * $tarif)/100;
				
				$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0%'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
				$q = $data;

		} else if($kode=='REK'){
				
			$query = $this->db->query("SELECT sptpd_reklame_detail.no_sptpd AS sptpd, sptpd_reklame_detail.kd_rek, sptpd_reklame_detail.nm_rek,  (select sum(sptpd_reklame_detail.ketetapan) from 
			sptpd_reklame_detail where sptpd_reklame_detail.no_sptpd = '".$s."') AS jumlah FROM sptpd_reklame_detail WHERE sptpd_reklame_detail.no_sptpd = '".$s."'")->row();		
				$sptpd = $query->sptpd;
				$kdrek = $query->kd_rek;
				$nmrek = $query->nm_rek;
				//$tarif = $query->tarif;
				$jml = $query->jumlah;
				
				$data = $kdrek.";".$nmrek.";".'0'.";".'0'.";".'0'.";".'0'.";".'0'.";".'0'.";".$jml.";".$sptpd;
			$q = $data;
			
		} else if($kode=='HIB'){
			$w = $this->db->query("SELECT sptpd_hiburan_bw.no_sptpd AS sptpd, sptpd_hiburan_bw.gol_hiburan AS gol, sptpd_hiburan_bw.omset AS jumlah FROM sptpd_hiburan_bw WHERE sptpd_hiburan_bw.no_sptpd = '".$s."'")->row();
				$sptpd = $w->sptpd;
				$gol = $w->gol;
				$jml = $w->jumlah;
				$cari = $this->db->query("select keterangan, tarif from tb_jenis_hiburan where id ='".$gol."'")->row();
				$tarif = $cari->tarif;
				$jumlah = ($jml * $tarif)/100;
				
				$data = $gol.";".$cari->keterangan.";".$jml.";".$tarif."%;".'0'.";".'0'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
				$q = $data;

		} else if($kode=='LIS'){
			$w = $this->db->query("SELECT sptpd_listrik.no_sptpd AS sptpd, sptpd_listrik.gol_tarif AS gol, sptpd_child.tarif AS tarif, sptpd_listrik.omset, sptpd_child.jumlah AS jumlah FROM sptpd_listrik INNER JOIN sptpd_child ON sptpd_listrik.no_sptpd=sptpd_child.no_sptpd WHERE sptpd_listrik.no_sptpd = '".$s."'")->row();				
			$sptpd = $w->sptpd;
			$gol = $w->gol;
			$tarif = $w->tarif;
			$jml = $w->omset;
			//$jumlah = $w->jumlah;
			$jumlah = ($jml * $tarif)/100;
			$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
					
			$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
			$q = $data;
				
		} else if($kode=='AIR'){
			$w = $this->db->query("SELECT no_sptpd AS sptpd, rek_air AS gol, harga_dasar, jml_bayar AS jumlah FROM sptpd_air_bawah_tanah WHERE no_sptpd = '".$s."'")->row();
			$sptpd = $w->sptpd;
			$gol = $w->gol;
			$tarif = '20';
			$jml = $w->harga_dasar;
			$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
			//$jumlah = ($jml * $tarif)/100;
			$jumlah = $w->jumlah;
			
			$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
			$q = $data;		
		
		} else if($kode=='PKR'){
			$w = $this->db->query("select no_sptpd as sptpd, golongan as gol, omset as jumlah from sptpd_parkir where no_sptpd ='".$s."'")->row();
			$sptpd = $w->sptpd;
			$gol = $w->gol;
			$tarif = '25';
			$jml = $w->jumlah;
			$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
			$jumlah = ($jml * $tarif)/100;
					
			$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
			$q = $data;
			
		} else if($kode=='WLT'){
			$w = $this->db->query("select no_sptpd as sptpd, golongan as gol, omset as jumlah from sptpd_burung_walet where no_sptpd ='".$s."'")->row();
			$sptpd = $w->sptpd;
			$gol = $w->gol;
			$tarif = '10';
			$jml = $w->jumlah;
			$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
			$jumlah = ($jml * $tarif)/100;
					
			$data = $gol.";".$cari->nm_rek.";".$jml.";".$tarif."%;".'0'.";".'0'.";".'0'.";".'0'.";".$jumlah.";".$sptpd;
			$q = $data;
		}
		echo $q;
	}
	
	public function child_rek($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sq = $this->db->query("select * from sptpd_galianc_d1 where sptpd='".$spt."'");
		
		$i=1;
		foreach($sq->result() as $qr) {
			// cair
			$kenaikan = 0;
			$denda = '0';
			$kompensasi = 0;
			$bunga = '0';
			//$jumlah = ($qr->dasar_pengenaan*$tarif)/100;
			
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$qr->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$qr->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$qr->dp."]]></cell>");
					echo("<cell><![CDATA[".$qr->tarif."]]></cell>");
					echo("<cell><![CDATA[".$kenaikan."]]></cell>");
					echo("<cell><![CDATA[".$denda."]]></cell>");
					echo("<cell><![CDATA[".$kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$bunga."]]></cell>");
					echo("<cell><![CDATA[".$qr->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$spt."]]></cell>");
					echo("<cell><![CDATA[".$bunga."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function child_galian($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sq = $this->db->query("select * from sptpd_galianc_d1 where sptpd='".$spt."'");
		
		$i=1;
		foreach($sq->result() as $qr) {
			// cair
			$kenaikan = 0;
			$denda = '0';
			$kompensasi = 0;
			$bunga = '0';
			//$jumlah = ($qr->dasar_pengenaan*$tarif)/100;
			
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$qr->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$qr->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$qr->dp."]]></cell>");
					echo("<cell><![CDATA[".$qr->tarif."]]></cell>");
					echo("<cell><![CDATA[".$kenaikan."]]></cell>");
					echo("<cell><![CDATA[".$denda."]]></cell>");
					echo("<cell><![CDATA[".$kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$bunga."]]></cell>");
					echo("<cell><![CDATA[".$qr->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$spt."]]></cell>");
					echo("<cell><![CDATA[".$bunga."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function cgol() {
		$p = $this->input->post('gol');
		$sq = $this->db->query("select nm_rek from master_rekening where kd_rek='".$p."'")->row();
		$q = $sq->nm_rek;
		echo $q;
	}
	
	public function loadjml() {
		$sptpd = $this->input->post('sptpd');
		$s = $this->db->query("select sum(jumlah) as jml from nhp_child where sptpd='".$sptpd."'")->row();
		$total = $s->jml;
		echo $total;
	}
	
	public function load_cnhp($op="",$nilai="",$nm_tbl="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($nm_tbl=='reklame'){
			if($op=='1'){
			$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.jml_bayar from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and a.no_sptpd like '%".$nilai."%'");
			} else if($op=='2'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.jml_bayar from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and a.npwpd like '%".$nilai."%'");
			} else if($op=='3'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.jml_bayar from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and b.nama_perusahaan like '%".$nilai."%'");
			} else if($op=='4'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.jml_bayar from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and b.alamat_perusahaan like '%".$nilai."%'");
			}
			
			$i=1;
			foreach($qr->result() as $rs) {
				// cair
				echo ("<row id='".$i."'>");
						echo("<cell><![CDATA[".$rs->id."]]></cell>");
						echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
						echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
						echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
						echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
						echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
						echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
						echo("<cell><![CDATA[".$rs->cara_hitung."]]></cell>");
						echo("<cell><![CDATA[".$rs->tgl_diterima."]]></cell>");
						echo("<cell><![CDATA[".$rs->masa_pajak1."]]></cell>");
						echo("<cell><![CDATA[".$rs->masa_pajak2."]]></cell>");
						echo("<cell><![CDATA[".$rs->jml_bayar."]]></cell>");
                                               // echo("<cell><![CDATA[".$rs->insidentil."]]></cell>");
				echo("</row>");
				$i++;
			}
		}else{
			
			if($nm_tbl=='hiburan'){
				$nm_tbl='hiburan_bw';
			}
			
			if($this->session->userdata('username')=='admin'){
				$muncul = "";
			}else{
				$muncul = "and c.author = '".$this->session->userdata('username')."'";
			}
			
			if($op=='1'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan LEFT JOIN sptpd c ON a.no_sptpd = c.no_sptpd where a.status='0' ".$muncul."  and a.no_sptpd like '%".$nilai."%'");
			} else if($op=='2'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan LEFT JOIN sptpd c ON a.no_sptpd = c.no_sptpd where a.status='0'  ".$muncul."  and a.npwpd like '%".$nilai."%'");
			} else if($op=='3'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan LEFT JOIN sptpd c ON a.no_sptpd = c.no_sptpd where a.status='0'  ".$muncul."  and b.nama_perusahaan like '%".$nilai."%'");
			} else if($op=='4'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan LEFT JOIN sptpd c ON a.no_sptpd = c.no_sptpd where a.status='0'  ".$muncul."  and b.alamat_perusahaan like '%".$nilai."%'");
			}

			
			$i=1;
			foreach($qr->result() as $rs) {
				// cair
				echo ("<row id='".$i."'>");
						echo("<cell><![CDATA[".$rs->id."]]></cell>");
						echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
						echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
						echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
						echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
						echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
						echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
						echo("<cell><![CDATA[".$rs->cara_hitung."]]></cell>");
						echo("<cell><![CDATA[".$rs->tgl_diterima."]]></cell>");
						echo("<cell><![CDATA[".$rs->masa_pajak1."]]></cell>");
						echo("<cell><![CDATA[".$rs->masa_pajak2."]]></cell>");
						echo("<cell><![CDATA[".$rs->omset."]]></cell>");
				echo("</row>");
				$i++;
			}
		}
		echo "</rows>";
	}
	
	public function load_nota($op="",$nilai="",$kode="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='0'){
			$sam = "and a.no_nota like '%".$nilai."%'";
		} else if($op=='1'){
			$sam = "and a.sptpd like '%".$nilai."%'";
		} else if($op=='2'){
			$sam = "and a.npwpd like '%".$nilai."%'";
		} else if($op=='3'){
			$sam = "and b.nama_perusahaan like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("select a.id, a.no_nota, a.sptpd, a.npwpd, a.cara_hitung, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, a.jumlah from nota_hitung where a.nama_sptpd = '".$kode."' $sam");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_nota."]]></cell>");
					echo("<cell><![CDATA[".$rs->sptpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->cara_hitung."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->masa_pajak1."]]></cell>");
					echo("<cell><![CDATA[".$rs->masa_pajak2."]]></cell>");
					echo("<cell><![CDATA[".$rs->tahun."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function child_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['sptpd'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota from nhp_child where no_nota = '".$_GET['nota']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota from nhp_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota");
		}
	}
	
	public function data_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['nota'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota from nhp_child where no_nota = '".$_GET['nota']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota from nhp_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota");
		}
	}
	
	public function dt_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("nhp_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, sptpd, no_nota");
	}
	
	public function data() {
		/* ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '700'); */
		
		$grid = new GridConnector($this->db->conn_id);
		/* $grid->render_sql("SELECT
nota_hitung.id,
nota_hitung.no_nota,
nota_hitung.sptpd,
nota_hitung.npwpd,
nota_hitung.cara_hitung,
identitas_pemilik.nama_pemilik,
identitas_pemilik.alamat_pemilik,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
nota_hitung.masa_pajak1,
nota_hitung.masa_pajak2,
nota_hitung.tahun,
DATE_FORMAT(nota_hitung.tgl,'%d/%m/%Y') AS tgl,
nota_hitung.sk,
nota_hitung.kep_proyek,
nota_hitung.jumlah,
nota_hitung.nama_sptpd,
nota_hitung.masa_pajak_1,
nota_hitung.masa_pajak_2,
nota_hitung.tgl_tempo,
nota_hitung.ket_nhp
FROM
identitas_pemilik INNER JOIN identitas_perusahaan ON identitas_pemilik.npwpd_pemilik = identitas_perusahaan.npwpd_pemilik
INNER JOIN nota_hitung ON identitas_perusahaan.npwpd_perusahaan = nota_hitung.npwpd 
WHERE nota_hitung.nama_sptpd = '".$_GET['kode']."' ORDER BY nota_hitung.no_nota DESC LIMIT 50",
"id","id, no_nota, sptpd, npwpd, cara_hitung, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, sk, kep_proyek, jumlah, nama_sptpd, masa_pajak_1, masa_pajak_2, tgl_tempo, ket_nhp"); */
$grid->render_sql("SELECT
nota_hitung.id,
nota_hitung.no_nota,
nota_hitung.sptpd,
nota_hitung.npwpd,
nota_hitung.cara_hitung,
identitas_perusahaan.nama_pemilik,
identitas_perusahaan.alamat_pemilik,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
nota_hitung.masa_pajak1,
nota_hitung.masa_pajak2,
nota_hitung.tahun,
DATE_FORMAT(nota_hitung.tgl,'%d/%m/%Y') AS tgl,
nota_hitung.sk,
nota_hitung.kep_proyek,
nota_hitung.jumlah,
nota_hitung.nama_sptpd,
nota_hitung.masa_pajak_1,
nota_hitung.masa_pajak_2,
nota_hitung.tgl_tempo,
nota_hitung.ket_nhp
FROM
nota_hitung LEFT JOIN identitas_perusahaan ON identitas_perusahaan.npwpd_perusahaan = nota_hitung.npwpd
WHERE nota_hitung.nama_sptpd = '".$_GET['kode']."' ORDER BY nota_hitung.no_nota DESC LIMIT 50",
"id","id, no_nota, sptpd, npwpd, cara_hitung, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, sk, kep_proyek, jumlah, nama_sptpd, masa_pajak_1, masa_pajak_2, tgl_tempo, ket_nhp");
	}
	
	public function simpan() {
		$pajak = strtoupper($this->input->post('kode'));
		if($pajak=='HTL'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_hotel', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='RES'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_restoran', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='REK'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_reklame', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='LIS'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_listrik', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='AIR'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_air_bawah_tanah', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='GAL'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_galianc', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='WLT'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_burung_walet', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='PKR'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_parkir', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='HIB'){
			$upd = array (
				'status' => 1
			);
			$this->db->update('sptpd_hiburan_bw', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		}
				
		$awal = $this->input->post('awal');
		if(strlen($awal)==1) {
			$awal = '0'.$awal;
		} else if(strlen($awal)==2) {
			$awal;
		}
		
		$akhir = $this->input->post('akhir');
		if(strlen($akhir)==1) {
			$akhir = '0'.$akhir;
		} else if(strlen($akhir)==2) {
			$akhir;
		}
		
		$jml = $this->input->post('jumlah');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$data = array (
			'sptpd' 			=> strtoupper($this->input->post('sptpd')),
			'nama_sptpd' 		=> strtoupper($this->input->post('kode')),
			'npwpd' 			=> strtoupper($this->input->post('npwpd')),
			'cara_hitung' 		=> strtoupper($this->input->post('cara')),
			'masa_pajak1' 		=> strtoupper($awal),
			'masa_pajak2'		=> strtoupper($akhir),
			'tahun' 			=> $this->input->post('tahun'),
			'tgl' 				=> strtoupper($this->input->post('tgl')),
			'sk' 				=> strtoupper($this->input->post('sk')),
			'kep_proyek' 		=> $this->input->post('kep'),
			'jumlah' 			=> $jml,
			'author' 			=> strtoupper($this->session->userdata('username')),			
			'ket_nhp' 			=> strtoupper($this->input->post('ket_nhp')),
			'tgl_tempo' 		=> strtoupper($this->input->post('tgl_tempo')),
			'tgl_terbit' 		=> strtoupper($this->input->post('tgl_terbit')),
			'masa_pajak_1' 		=> strtoupper($this->input->post('tg_masa1')),
			'masa_pajak_2' 		=> strtoupper($this->input->post('tg_masa2'))												
		);
		if($this->input->post('id')==0){
			$thn = substr($this->input->post('tgl'),0,4);
			$nota = $this->generateNo($thn,$_POST['kode']);
			$dataIns = array_merge($data,array('no_nota' => $nota,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('nota_hitung',$dataIns);
		} else {
			$nota = $this->input->post('nota');
			$this->db->delete('nhp_child',array('no_nota' => $nota));
			$dataUpd = array_merge($data,array('no_nota' => $nota,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('nota_hitung', $dataUpd, array('id' => $this->input->post('id')));
		}
		echo $nota;
	}
	
	public function generateNo($thn="",$kode="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_nota,'/',1)) as max from nota_hitung where nama_sptpd = '".$kode."' and LEFT(tgl,4) = '".$thn."'");
		$r = $sql->row();
		if($r==NULL){
			$no = '000000001/'.$kode.'/'.substr($thn,2,2);
		} else {
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
			$no = $jml.'/'.$kode.'/'.substr($thn,2,2);
		}
		return $no;
	}
	
	public function delete() {
		$sk = $this->input->post('sk');
		$s = $this->input->post('nota');
		if($sk==1){
			$q = "select count(nota_hitung) as jml from skpd where nota_hitung ='".$s."'";
		} else if($sk==2){
			$q = "select count(no_nota) as jml from skpdt where no_nota ='".$s."'";
		} else if($sk==3){
			$q = "select count(nota_hitung) as jml from stpd where nota_hitung ='".$s."'";
		} else if($sk==4){
			$q = "select count(nota) as jml from skpdkbt where nota ='".$s."'";	
		} else if($sk==5){
			$q = "select count(nota_hitung) as jml from skpdkb where nota_hitung ='".$s."'";
		} else if($sk==6){
			$q = "select count(nota_hitung) as jml from skpdn where nota_hitung ='".$s."'";
		} else if($sk==7){
			$q = "select count(nota_hitung) as jml from skpdlb where nota_hitung ='".$s."'";
		}
		
		$sql = $this->db->query("$q")->row();
		$we = $sql->jml;
		//fadil
		if($we==0){
			$pajak = strtoupper($this->input->post('kode'));
		if($pajak=='HTL'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_hotel', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='RES'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_restoran', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='REK'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_reklame', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='LIS'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_listrik', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='AIR'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_air_bawah_tanah', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='GAL'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_galianc', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='WLT'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_burung_walet', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='PKR'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_parkir', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		
		} else if($pajak=='HIB'){
			$upd = array (
				'status' => 0
			);
			$this->db->update('sptpd_hiburan_bw', $upd, array('no_sptpd' => $this->input->post('sptpd')));
		}
			$this->db->delete('nota_hitung',array('no_nota' => $this->input->post('nota')));
			$this->db->delete('nhp_child',array('no_nota' => $this->input->post('nota')));
			$result = "Data Nota Hitung berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data SKPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cetak(){
		//$s = $this->input->post('nota');
		
		$data = $this->db->query("SELECT a.no_nota, a.sptpd, a.npwpd, b.npwpd_lama, a.cara_hitung, b.nama_pemilik, b.alamat_pemilik,  
b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tgl, 
a.sk, a.kep_proyek, a.jumlah, a.nama_sptpd, a.author, c.masa_pajak_1, c.masa_pajak_2,
DATE_FORMAT(a.tgl_tempo ,'%d/%m/%Y') AS tgl_tempo,DATE_FORMAT(a.tgl_terbit,'%d/%m/%Y') AS tgl_terbit, a.ket_nhp
FROM nota_hitung a 
LEFT JOIN sptpd c ON c.no_sptpd = a.sptpd
LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan where a.no_nota='".$_GET['nota']."'")->row();
		$no 				= $data->no_nota;
		$npwpd 				= $data->npwpd;
		$npwpd_lama 		= $data->npwpd_lama;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$alper				= $data->alamat_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun;
		$ket				= '';
		$total				= number_format($data->jumlah,2,",",".");
		$huruf				= '';
		$ttd				= '......................';
		$jabatan			= '......................';
		$nip				= '......................';
		$tgl_tempo1			= $data->tgl_tempo;
		$tgl_terbit1		= $data->tgl_terbit;
		$ket_nhp		= $data->ket_nhp;
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		/*$tgl_t1 		= explode("/",$tgl_terbit1);
		$tgl_t1			= $tgl_t1[0];
		$tgl_t2			= $tgl_t1[1];
		$tgl_t3			= $tgl_t1[2];
		$tgl_t22		= $this->msistem->v_bln($tgl_t2);
		
		$tgl_buat		= 
		*/
		
		$re = $this->db->query("select nama,bagian,nip from admin where username ='".$this->session->userdata('username')."'")->row();
		$pembuat			= $re->nama;
		$pembuat_jab		= $re->bagian;
		$pembuat_nip		= $re->nip;
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd ='".$data->nama_sptpd."'")->row();
		$ms1="";
		$ms2="";
		
		if($data->masa_pajak_1==""){
			if($kd->nama_sptpd=="Hiburan"){
				$kd_masa = $this->db->query("select masa_pajak1,masa_pajak2 from sptpd_hiburan_bw where no_sptpd ='".$data->sptpd."'")->row();
				$ms1=$kd_masa->masa_pajak1;
				$ms2=$kd_masa->masa_pajak2;
			}
		}else{
			$ms1=$data->masa_pajak_1;
			$ms2=$data->masa_pajak_2;
		}		
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/nota');
		$pdf = new nota('P', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		$pdf->SetFont('times', '', 9.5);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$dday = explode("-",$ms1);
		$ddthn1 = $dday[0];
		$ddbln2 = $dday[1];
		$ddtgl3 = $dday[2];
		
		$dday2 = explode("-",$ms2);
		$ddthn = $dday2[0];
		$ddbln = $dday2[1];
		$ddtgl = $dday2[2];
		
		$report = '';
		$report .= 
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="200" align="center">
						PEMERINTAH KABUPATEN MELAWI<br />
						<b>BADAN PENDAPATAN DAERAH</b><br />
						Jl. Garuda No 1 Nanga Pinoh <br/> Telepon (0568) 2020545
					</td>
					<td width="222" align="center">
						<b>NOTA PERHITUNGAN PAJAK DAERAH</b><br />
						<b>PAJAK '.strtoupper($kd->nama_sptpd).'</b><br /><br/>
						Masa Pajak&nbsp;: '.$ddtgl3.'/'.$ddbln2.'/'.$ddthn1.' - '.$ddtgl.'/'.$ddbln.'/'.$ddthn.'
					</td>
					<td width="102" align="center">
						<br /><br />
						Nota Perhitungan<br />
						'.$no.'
					</td>
				</tr>
			</table>';/*570*/
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get=" ".$npwpd_lama." ";
			}
		
		$report .=
			'<table border="1">
				<tr>
				<td width="574">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="120">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="120">&nbsp;&nbsp;NPWPD LAMA</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$get.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="120">&nbsp;&nbsp;NAMA USAHA</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="120">&nbsp;&nbsp;ALAMAT</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="120">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="300">&nbsp;&nbsp;'.$namper.'</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="25" rowspan="2" align="center">No</td>
					<td width="82" rowspan="2" align="center">Kode Rek</td>
					<td width="118" rowspan="2" align="center">Uraian</td>
					<td width="85" rowspan="2" align="center">Ketetapan</td>
					<td width="160" align="center" colspan="3">Sanksi</td>
					<td width="104" rowspan="2" align="center">Jumlah</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px;">
					<td width="55" align="center">%</td>
					<td width="105" align="center">Denda Bunga</td>
				</tr>';
			
		$child = $this->db->query("select * from nhp_child where no_nota ='".$no."'");
		
        	$i = 1;
			foreach($child->result() as $ch) {
				$ketetapan = ($ch->tarif * $ch->dp)/100;
				$kenaikan = $ch->kenaikan;
                $uraian   = $ch->kenaikan;
				$denda = $ch->denda;
				$bunga = $ch->bunga;
				$jumlah = $ketetapan+$kenaikan+$denda+$bunga;
				$terbilang = $this->msistem->baca($data->jumlah); 
				$kenaikan2 = $denda/$ketetapan*100; 	
				
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.$i.'</td>
					  <td width="82" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.$ch->kd_rek.'&nbsp;</td>
					  <td width="118" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.number_format($ch->dp,2,',','.').' x '.$ch->tarif.'%&nbsp;</td>
					  <td width="85" height="25" align="right" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.number_format($ketetapan,2,',','.').'&nbsp;</td>
					  <td width="55" height="25" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.$kenaikan2.'&nbsp;</td>
					  <td width="105" height="25" align="right" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.number_format($denda,2,',','.').'&nbsp;</td>
					 
					  <td width="104" height="25" align="right" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">'.number_format($jumlah,2,',','.').'&nbsp;</td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					  <td colspan="3" height="25" width="470" align="right">Jumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="104" height="25" align="right">'.$total.'&nbsp;</td>
				</tr>
				</table>';
				
			$report .=
				'<table border="1">
					<tr>
						<td width="574" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
						<table border="0">					
							<tr>
								<td height="25" width="90">&nbsp;&nbsp;Dengan huruf</td>
								<td width="8" align="center">:</td>
								<td width="460"><i>'.$terbilang.'RUPIAH</i></td>
							</tr>
							<tr>
								<td height="25" width="90">&nbsp;&nbsp;K E T</td>
								<td width="8" align="center">:</td>
								<td width="460">Jatuh tempo tanggal: '.$tgl_tempo1.', '.$ket_nhp.'<br/>'.$data->kep_proyek.'</td>
							</tr>								
						</table>
						</td>
					</tr>
				</table>';
				
				$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='0'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
					$jab1 = '';
				} else {
					$nama1 = $s1->nama_ttd;
					$nip1 = $s1->nip_ttd;
					$jab1 = $s1->jabatan_ttd;
				}
				$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='3'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
					$jab2 = '';
				} else {
					$nama2 = $s2->nama_ttd;
					$nip2 = $s2->nip_ttd;
					$jab2 = $s2->jabatan_ttd;
				}
			
			$report .=
				'<table border="1">
					<tr>
						<td width="574" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
						<table border="0">
							<tr>
								<td colspan="3" width="572">&nbsp;</td>
							</tr>
							<tr>
							  <td width="191" align="center">Mengetahui</td>
							  <td width="191"><div align="center">Diperiksa oleh :</div></td>
							  <td width="190" align="center">
								Tanggal : '.$created.'</td>
							  </tr>
							<tr>
							  <td width="191"><div align="center">a.n Kepala Badan Pendapatan <br>Kabupaten Melawi</br> <br>'.$jab1.'</br></div></td>
							  <td width="191"><div align="center">'.$jab2.'</div></td>
							  <td width="190" align="center">
								Dibuat oleh : '.$pembuat_jab.'</td>
							  </tr>
							<tr>
							  <td width="191">&nbsp;</td>
							  <td width="191"><div align="center"></div></td>
							  <td width="190" align="center"></td>
							  </tr>
							<tr>
							  <td width="191" height="40">&nbsp;</td>
							  <td width="191"></td>
							  <td width="190" align="center">&nbsp;</td>
							  </tr>';
							  
				//kabid pendapatan
				$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='0'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
					$jab1 = '';
				} else {
					$nama1 = $s1->nama_ttd;
					$nip1 = $s1->nip_ttd;
					$jab1 = $s1->jabatan_ttd;
				}
				
				$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='3'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
					$jab2 = '';
				} else {
					$nama2 = $s2->nama_ttd;
					$nip2 = $s2->nip_ttd;
					$jab2 = $s2->jabatan_ttd;
				}							
							  
				$report .= '<tr>
							  <td width="191" align="center">'.$nama1.'</td>
							  <td width="191" align="center">'.$nama2.'</td>
							  <td width="190" align="center">'.$pembuat.'</td>
							  </tr>
							<tr>
							  <td width="191" align="center">NIP. '.$nip1.'</td>
							  <td width="191" align="center">NIP. '.$nip2.'</td>
							  <td width="190" align="center">NIP.'.$pembuat_nip.'</td>
							  </tr>
							<tr>
							  <td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_NHP'.'.pdf', 'I');	
	}
    public function cetak_rek(){
		//$s = $this->input->post('nota');
		
		$data = $this->db->query("SELECT a.no_nota, a.sptpd, a.npwpd, b.npwpd_lama, a.cara_hitung, b.nama_pemilik, b.alamat_pemilik, 
b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tgl, 
a.sk, a.kep_proyek, a.jumlah, a.nama_sptpd, a.author, c.masa_pajak_1, c.masa_pajak_2,
DATE_FORMAT(a.tgl_tempo ,'%d/%m/%Y') AS tgl_tempo,DATE_FORMAT(a.tgl_terbit,'%d/%m/%Y') AS tgl_terbit, a.ket_nhp
FROM nota_hitung a 
LEFT JOIN sptpd c ON c.no_sptpd = a.sptpd
LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan where a.no_nota='".$_GET['nota']."'")->row();
		$no 				= $data->no_nota;
		$npwpd 				= $data->npwpd;
		$npwpd_lama 		= $data->npwpd_lama;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$alper				= $data->alamat_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun;
		$tgl_tempo1			= $data->tgl_tempo;
		$tgl_terbit1		= $data->tgl_terbit;
		$ket_nhp			= $data->ket_nhp;
        $no_sptpd           = $data->sptpd;
		$ket				= '';
		$total				= number_format($data->jumlah,2,",",".");
		$huruf				= '';
		$ttd				= '......................';
		$jabatan			= '......................';
		$nip				= '......................';
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$re = $this->db->query("select nama from admin where username ='".$data->author."'")->row();
		$pembuat			= $re->nama;
		$re = $this->db->query("select nama,bagian,nip from admin where username ='".$this->session->userdata('username')."'")->row();
		$pembuat_nip		= $re->nip;
		$pembuat_jab		= $re->bagian;
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd ='".$data->nama_sptpd."'")->row();
		
		$ddndat1 = explode("-",$data->masa_pajak_1);
		$ddn1 = $ddndat1[0];
		$ddn2 = $ddndat1[1];
		$ddn3 = $ddndat1[2];
		
		$ddndat2 = explode("-",$data->masa_pajak_2);
		$ddn12 = $ddndat2[0];
		$ddn22 = $ddndat2[1];
		$ddn32 = $ddndat2[2];
		$c2			= $data->tgl;
		$arr2 = explode("/",$c2);
		$bln2 = $this->msistem->v_bln($arr2[1]);
		$created = $arr2[0].' '.$bln2.' '.$arr2[2];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/nota_rek');
		$pdf = new nota_rek('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .= 
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					<td width="80" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="300" align="center">
						PEMERINTAH KOTA JAMBI<br />
						<b>DINAS PENDAPATAN</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="288" align="center">
						<b>NOTA PERHITUNGAN PAJAK DAERAH</b><br />
						<b>PAJAK '.strtoupper($kd->nama_sptpd).'</b><br /><br/>
						Masa Pajak&nbsp;: '.$ddn3.'/'.$ddn2.'/'.$ddn1.' - '.$ddn32.'/'.$ddn22.'/'.$ddn12.'
					</td>
					<td width="152" align="center">
						<br /><br />
						Nota Perhitungan<br />
						'.$no.'
					</td>
				</tr>
			</table>';/*570*/
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get=" ".$npwpd_lama." ";
			}
		
		$report .=
			'<table border="1" width="100%">
				<tr>
				<td width="820" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NPWPD LAMA</td>
					<td width="12" align="center">:</td>
					<td width="180">&nbsp;&nbsp;'.$get.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NPWPD</td>
					<td width="12" align="center">:</td>
					<td width="180">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA</td>
					<td width="12" align="center">:</td>
					<td width="200">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT</td>
					<td width="12" align="center">:</td>
					<td width=180>&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="12" align="center">:</td>
					<td width="180">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT PEMILIK</td>
					<td width="12" align="center">:</td>
					<td width="180">&nbsp;&nbsp;'.$alper.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr> 
			</table>';
			
		$report .=
			'<table border="1" width="100%" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
				<tr>
					<td width="20" rowspan="2" align="center">No</td>		
					<td width="60" rowspan="2" align="center">Kode Rek</td>
					<td width="100" rowspan="2" align="center">Nama Rek</td>
					<td width="310" align="center" colspan="2">Dasar Pengenaan</td>
					<td width="40" rowspan="2" align="center">Tarif</td>
					<td width="100" rowspan="2" align="center">Ketetapan (Rp)</td>
					<td width="90" rowspan="2" align="center">Denda/Biaya Adm (Rp)</td>
					<td width="100" rowspan="2" align="center">Jumlah (Rp)</td>
				</tr>
				<tr>
					<td width="260" align="center">Uraian</td>
					<td width="50" align="center">Kawasan</td>
				</tr>';
			
			///$child = $this->db->query("select * from nhp_child where no_nota ='".$no."'");
			$child = $this->db->query("SELECT c.kd_rek,c.nm_rek,c.tema,c.lokasi AS lokasi1, c.kawasan, b.teks_reklame,c.panjang,c.lebar,c.jari,c.sisi,c.luas,
			c.unit,DATE_FORMAT(b.masa_pajak1,'%d/%m/%Y') AS masa_pajak1,DATE_FORMAT(b.masa_pajak2,'%d/%m/%Y') AS masa_pajak2,
			c.trf,c.ketetapan FROM nhp_child a LEFT JOIN sptpd_reklame b ON a.sptpd=b.no_sptpd LEFT JOIN sptpd_reklame_detail c ON b.no_sptpd=c.no_sptpd WHERE a.no_nota ='".$no."'");
		
			$i = 1;
			foreach($child->result() as $ch) {
				$ketetapan = $ch->ketetapan;
				$kenaikan = 0;
                $nmrek    = $ch->nm_rek;
				$denda = 0;
				$bunga = 0;
				$jumlah = $ketetapan+$kenaikan+$denda+$bunga;
				$terbilang = $this->msistem->baca($data->jumlah); 
				
					$report .= '<tr id='.$i.'>
					  <td width="20" height="50" align="center">'.$i.'</td>					  
                      <td width="60" height="50" align="center">'.$ch->kd_rek.'</td>
					  <td width="100" height="50" align="center">'.$ch->nm_rek.'</td>
                      <td width="260" height="50" align="left">Lokasi:'.$ch->lokasi1.', Ukuran panjang:'.$ch->luas.' m ;Lebar:'.$ch->lebar.' m ;sisi:'.$ch->sisi.'; Unit:'.$ch->unit.',Tema : '.$ch->tema.' Periode:'.$ch->masa_pajak1.' s/d '.$ch->masa_pajak2.'&nbsp;</td>
					  <td width="50" height="50" align="center">'.$ch->kawasan.'</td>
                      <td width="40" height="50" align="center">'.number_format($ch->trf,0,',','.').'&nbsp;%</td>
                      <td width="100" height="50" align="right">'.number_format($ketetapan,2,',','.').'&nbsp;</td>
                      <td width="90" height="50" align="right">'.number_format($denda,2,',','.').'&nbsp;</td>
                      <td width="100" height="50" align="right">'.number_format($jumlah,2,',','.').'&nbsp;</td>
                      
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
					  <td colspan="3" height="25" width="720" align="right">Jumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="100" height="25" align="right">'.$total.'&nbsp;</td>
				</tr>
				</table>';
				
			$report .=
				'<table border="1">
					<tr>
						<td width="820" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
						<table border="0">					
							<tr>
								<td height="25" width="90">&nbsp;&nbsp;Dengan huruf</td>
								<td width="8" align="center">:</td>
								<td width="460"><i>'.$terbilang.'RUPIAH</i></td>
							</tr>
							<tr>
								<td height="25" width="90">&nbsp;&nbsp;K E T</td>
								<td width="8" align="center">:</td>
								<td width="460">Jatuh tempo tanggal: '.$tgl_tempo1.' '.strtolower($ket_nhp).'</td>
							</tr>								
						</table>
						</td>
					</tr>
				</table>';
			//kabid pendapatan
				$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='2'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
					$jab1 = '';
				} else {
					$nama1 = $s1->nama_ttd;
					$nip1 = $s1->nip_ttd;
					$jab1 = $s1->jabatan_ttd;
				}
				
				$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='4'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
					$jab2 = '';
				} else {
					$nama2 = $s2->nama_ttd;
					$nip2 = $s2->nip_ttd;
					$jab2 = $s2->jabatan_ttd;
				}
			
			$report .=
				'<table border="0" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
					<tr>
						<td width="820">
						<table border="0">
							<tr>
								<td colspan="3" width="820">&nbsp;</td>
							</tr>
							<tr>
  							<td width="300" align="center">Mengetahui</td>
							  <td width="270"><div align="center">Diperiksa oleh :</div></td>
							  <td width="250" align="center">
								Tanggal : '.$created.'</td>
							  </tr>
						    <tr>
							  <td width="300"><div align="center">an. Kepala Dinas Pendapatan Kota Jambi <br/>'.$jab1.'</div></td>
							  <td width="270"><div align="center">'.$jab2.'</div></td>
							  <td width="250" align="center">
								Dibuat oleh : '.$pembuat_jab.'</td>
							  </tr>
							
							<tr>
							  <td width="300">&nbsp;</td>
							  <td width="309"><div align="center"></div></td>
							  <td width="250" align="center"></td>
							  </tr>
							<tr>
							  <td width="300" height="58">&nbsp;</td>
							  <td width="270"></td>
							  <td width="250" align="center">&nbsp;</td>
							  </tr>';
							  
			//kabid pendapatan
				$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='2'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
					$jab1 = '';
				} else {
					$nama1 = $s1->nama_ttd;
					$nip1 = $s1->nip_ttd;
					$jab1 = $s1->jabatan_ttd;
				}
				
				$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id='4'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
					$jab2 = '';
				} else {
					$nama2 = $s2->nama_ttd;
					$nip2 = $s2->nip_ttd;
					$jab2 = $s2->jabatan_ttd;
				}							
							  
				$report .= '<tr>
							  <td width="300" align="center">'.$nama1.'</td>
							  <td width="270" align="center">'.$nama2.'</td>
							  <td width="250" align="center">'.$pembuat.'</td>
							  </tr>
							<tr>
							  <td width="300" align="center">NIP. '.$nip1.'</td>
							  <td width="270" align="center">NIP. '.$nip2.'</td>
							  <td width="250" align="center">NIP.'.$pembuat_nip.'</td>
							  </tr>
							<tr>
							  <td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_NHP'.'.pdf', 'I');	
	} 
}
?>