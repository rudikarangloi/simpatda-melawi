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
		
		$data['title'] = $cek;
		$data['kode'] = $kode;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening");
		$data['tgl'] = date('d/m/Y');
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
	
	public function lihat() {
		$s = $this->input->post('sptpd');
		$kode = $this->input->post('kode');
			
		if($kode=='HTL'){
		$w = $this->db->query("SELECT no_sptpd AS sptpd, gol_hotel AS gol, omset AS jumlah FROM sptpd_hotel WHERE no_sptpd = '".$s."'")->row();
				$sptpd = $w->sptpd;
				$gol = $w->gol;
				$jml = $w->jumlah;
				$cari = $this->db->query("select nm_rek from master_rekening where kd_rek ='".$gol."'")->row();
				$tarif = '10';
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
				
			$query = $this->db->query("SELECT sptpd_reklame_detail.no_sptpd AS sptpd, sptpd_reklame_detail.kd_rek, sptpd_reklame_detail.nm_rek, sptpd_reklame_detail.tarif, (select sum(sptpd_reklame_detail.ketetapan) from 
			sptpd_reklame_detail where sptpd_reklame_detail.no_sptpd = '".$s."') AS jumlah FROM sptpd_reklame_detail WHERE sptpd_reklame_detail.no_sptpd = '".$s."'")->row();		
				$sptpd = $query->sptpd;
				$kdrek = $query->kd_rek;
				$nmrek = $query->nm_rek;
				$tarif = $query->tarif;
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
			$w = $this->db->query("SELECT sptpd_listrik.no_sptpd AS sptpd, sptpd_listrik.gol_tarif as gol, sptpd_listrik.tarif_pajak2 AS tarif, sptpd_listrik.omset, sptpd_listrik.pajak_terutang2 AS jumlah FROM sptpd_listrik WHERE sptpd_listrik.no_sptpd = '".$s."'")->row();				
			$sptpd = $w->sptpd;
			$gol = $w->gol;
			$tarif = $w->tarif;
			$jml = $w->omset;
			$jumlah = $w->jumlah;
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
				echo("</row>");
				$i++;
			}
		} else {
			
			if($nm_tbl=='hiburan'){
				$nm_tbl='hiburan_bw';
			}
		
			if($op=='1'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and a.no_sptpd like '%".$nilai."%'");
			} else if($op=='2'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and a.npwpd like '%".$nilai."%'");
			} else if($op=='3'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and b.nama_perusahaan like '%".$nilai."%'");
			} else if($op=='4'){
				$qr = $this->db->query("select a.id, a.npwpd, a.no_sptpd, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, a.cara_hitung, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, a.omset from sptpd_".$nm_tbl." a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status='0' and b.alamat_perusahaan like '%".$nilai."%'");
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
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
nota_hitung.id,
nota_hitung.no_nota,
nota_hitung.sptpd,
nota_hitung.npwpd,
nota_hitung.cara_hitung,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
nota_hitung.masa_pajak1,
nota_hitung.masa_pajak2,
nota_hitung.tahun,
DATE_FORMAT(nota_hitung.tgl,'%d/%m/%Y') as tgl,
nota_hitung.sk,
nota_hitung.kep_proyek,
nota_hitung.jumlah,
nota_hitung.nama_sptpd
FROM
view_perusahaan
INNER JOIN nota_hitung ON view_perusahaan.npwpd_perusahaan = nota_hitung.npwpd where nota_hitung.nama_sptpd = '".$_GET['kode']."'","id","id, no_nota, sptpd, npwpd, cara_hitung, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, sk, kep_proyek, jumlah, nama_sptpd");
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
			$this->db->update('sptpd_hiburan', $upd, array('no_sptpd' => $this->input->post('sptpd')));
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
			'kep_proyek' 		=> strtoupper($this->input->post('kep')),
			'jumlah' 			=> $jml,
			'author' 			=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$thn = date('Y');
			$nota = $this->generateNo($_POST['tahun'],$_POST['kode']);
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
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_nota,'/',1)) as max from nota_hitung where nama_sptpd = '".$kode."' and tahun = '".$thn."'");
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
		if($we==0){
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
		
		$data = $this->db->query("select a.no_nota, a.sptpd, a.npwpd, a.cara_hitung, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, a.sk, a.kep_proyek, a.jumlah, a.nama_sptpd, a.author from nota_hitung a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_nota='".$_GET['nota']."'")->row();
		$no 				= $data->no_nota;
		$npwpd 				= $data->npwpd;
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
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$re = $this->db->query("select nama from admin where username ='".$data->author."'")->row();
		$pembuat			= $re->nama;
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd ='".$data->nama_sptpd."'")->row();
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/nota');
		$pdf = new nota('P', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		$pdf->SetFont('times', '', 9.5);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .= 
			'<table border=1>
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KOTA JAMBI<br />
						<b>DINAS PENDAPATAN</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="222" align="center">
						<b>NOTA PERHITUNGAN PAJAK DAERAH</b><br />
						<b>PAJAK '.strtoupper($kd->nama_sptpd).'</b><br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="82" align="center">
						<br /><br />
						Nota Perhitungan<br />
						'.$no.'
					</td>
				</tr>
			</table>';/*570*/
		
		$report .=
			'<table border="1">
				<tr>
				<td width="574">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT</td>
					<td width="10" align="center">:</td>
					<td width=140>&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$alper.'</td>
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
					<td width="15" rowspan="2" align="center">No</td>
					<td width="67" rowspan="2" align="center">Kode Rekening</td>
					<td width="72" rowspan="2" align="center">Omset</td>
					<td width="28" rowspan="2" align="center">Tarif</td>
					<td width="105" rowspan="2" align="center">Uraian</td>
					<td width="72" rowspan="2" align="center">Ketetapan</td>
					<td width="141" align="center" colspan="3">Sanksi</td>
					<td width="74" rowspan="2" align="center">Jumlah</td>
				</tr>
				<tr>
					<td width="47" align="center">Kenaikan</td>
					<td width="47" align="center">Denda</td>
					<td width="47" align="center">Bunga</td>
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
				
					$report .= '<tr id='.$i.'>
					  <td width="15" height="25" align="center"><font size="8">'.$i.'</font></td>
					  <td width="67" height="25" align="center"><font size="8">'.$ch->kd_rek.'</font></td>
					  <td width="72" height="25" align="right"><font size="8">'.number_format($ch->dp,2,',','.').'&nbsp;</font></td>
					  <td width="28" height="25" align="right"><font size="8">'.$ch->tarif.'%&nbsp;</font></td>
					  <td width="105" height="25" align="center"><font size="8">'.number_format($ch->dp,2,',','.').' x '.$ch->tarif.'%&nbsp;</font></td>
					  <td width="72" height="25" align="right"><font size="8">'.number_format($ketetapan,2,',','.').'&nbsp;</font></td>
					  <td width="47" height="25" align="right"><font size="8">'.number_format($kenaikan,2,',','.').'&nbsp;</font></td>
					  <td width="47" height="25" align="right"><font size="8">'.number_format($denda,2,',','.').'&nbsp;</font></td>
					  <td width="47" height="25" align="right"><font size="8">'.number_format($bunga,2,',','.').'&nbsp;</font></td>
					  <td width="74" height="25" align="right"><font size="8">'.number_format($jumlah,2,',','.').'&nbsp;</font></td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="500" align="right">Jumlah Hitung Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="74" height="25" align="right"><font size="8">'.$total.'&nbsp;</font></td>
				</tr>
				</table>';
				
			$report .=
				'<table border="1">
					<tr>
						<td width="574">
						<table border="0">
							<tr>
								<td width="572" colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="110">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="395">'.$terbilang.'RUPIAH</td>
							</tr>
							<tr>
								<td width="572" colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
			
			$report .=
				'<table border="1">
					<tr>
						<td width="574">
						<table border="0">
							<tr>
								<td colspan="3" width="572">&nbsp;</td>
							</tr>
							<tr>
							  <td width="191" align="center">Mengetahui</td>
							  <td width="191"><div align="center">Diperiksa oleh :</div></td>
							  <td width="190" align="center">
								Tanggal : '.$tanggal.'</td>
							  </tr>
							<tr>
							  <td width="191"><div align="center">Kepala Bidang Pendapatan</div></td>
							  <td width="191"><div align="center">Kepala Seksi Penetapan</div></td>
							  <td width="190" align="center">
								Dibuat oleh : '.$pembuat.'</td>
							  </tr>
							<tr>
							  <td width="191">&nbsp;</td>
							  <td width="191"><div align="center"></div></td>
							  <td width="190" align="center"></td>
							  </tr>
							<tr>
							  <td width="191" height="58">&nbsp;</td>
							  <td width="191"></td>
							  <td width="190" align="center">&nbsp;</td>
							  </tr>';
							  
				//kabid pendapatan
				$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
				} else {
					$nama1 = $s1->nama;
					$nip1 = $s1->nip;
				}
				
				$s2 = $this->db->query("select nama, nip from admin where id_modul = '4'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
				} else {
					$nama2 = $s2->nama;
					$nip2 = $s2->nip;
				}
				
				$s3 = $this->db->query("select nama, nip from admin where username = '".$this->session->userdata('username')."'")->row();
				if($s3==NULL){
					$nama3 = '';
					$nip3 = '';
				} else {
					$nama3 = $s3->nama;
					$nip3 = $s3->nip;
				}
							  
				$report .= '<tr>
							  <td width="191" align="center">'.$nama1.'</td>
							  <td width="191" align="center">'.$nama2.'</td>
							  <td width="190" align="center">'.$nama3.'</td>
							  </tr>
							<tr>
							  <td width="191" align="center">NIP. '.$nip1.'</td>
							  <td width="191" align="center">NIP. '.$nip2.'</td>
							  <td width="190" align="center">NIP.'.$nip3.'</td>
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
		
		$data = $this->db->query("select a.no_nota, a.sptpd, a.npwpd, a.cara_hitung, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, a.sk, a.kep_proyek, a.jumlah, a.nama_sptpd, a.author from nota_hitung a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_nota='".$_GET['nota']."'")->row();
		$no 				= $data->no_nota;
		$npwpd 				= $data->npwpd;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$alper				= $data->alamat_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun;
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
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd ='".$data->nama_sptpd."'")->row();
		
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
			'<table border=1 width="100%">
				<tr>
					
					<td width="300" align="center">
						PEMERINTAH KOTA JAMBI<br />
						<b>DINAS PENDAPATAN</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="270" align="center">
						NOTA PERHITUNGAN PAJAK DAERAH<br />
						PAJAK '.strtoupper($kd->nama_sptpd).'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="250" align="left">
						Nota Perhitungan     :'.$no.'<br />
                        No. Kohir sekarang   : <br/>
                        No. Kohir Sebelumnya : <br/>
                        No. SPT yang dikirim :'.$no_sptpd.'
                        
					</td>
				</tr>
			</table>';/*570*/
		
		$report .=
			'<table border="1" width="100%">
				<tr>
				<td width="820">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT</td>
					<td width="10" align="center">:</td>
					<td width=140>&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="120">&nbsp;&nbsp;ALAMAT PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$alper.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1" width="100%">
				<tr>
					<td width="20" rowspan="2" align="center">No</td>
					<td width="100" rowspan="2" align="center">Jenis Pajak</td>
					<td width="60" rowspan="2" align="center">ayat</td>
					<td width="300" align="center" colspan="2">Dasar Pengenaan</td>
					<td width="50" rowspan="2" align="center">Tarif</td>
					<td width="100" rowspan="2" align="center">Ketetapan</td>
					<td width="90" rowspan="2" align="center">Denda/Biaya Adm (Rp)</td>
					<td width="100" rowspan="2" align="center">Jumlah</td>
				</tr>
				<tr>
					<td width="200" align="center">Uraian</td>
					<td width="100" align="center">Kawasan</td>
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
					  <td width="20" height="50" align="center"><font size="10">'.$i.'</font></td>
					  <td width="100" height="50" align="center"><font size="10">'.$ch->nm_rek.'</font></td>
                      <td width="60" height="50" align="center"><font size="10">'.$ch->kd_rek.'</font></td>
                      <td width="200" height="50" align="left"><font size="10">Lokasi:'.$ch->lokasi1.', Ukuran : panjang:'.$ch->panjang.' m ;Lebar:'.$ch->lebar.' m ;sisi:'.$ch->sisi.'; Unit:'.$ch->unit.',<br/>Tema : '.$ch->tema.'<br/>Periode:'.$ch->masa_pajak1.' s/d '.$ch->masa_pajak2.'&nbsp;</font></td>
					  <td width="100" height="50" align="center"><font size="10">'.$ch->kawasan.'</font></td>
                      <td width="50" height="50" align="center"><font size="10">'.number_format($ch->trf,0,',','.').'&nbsp;%</font></td>
                      <td width="100" height="50" align="right"><font size="10">'.number_format($ketetapan,2,',','.').'&nbsp;</font></td>
                      <td width="90" height="50" align="right"><font size="10">'.number_format($denda,2,',','.').'&nbsp;</font></td>
                      <td width="100" height="50" align="right"><font size="10">'.number_format($jumlah,2,',','.').'&nbsp;</font></td>
                      
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="720" align="right">Jumlah Hitung Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="100" height="25" align="right"><font size="10">'.$total.'&nbsp;</font></td>
				</tr>
				</table>';
				
			$report .=
				'<table border="0">
					<tr>
						<td width="820">
						<table border="0">
							<tr>
								<td width="572" colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="110">&nbsp;&nbsp;Jumlah dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="395">'.$terbilang.'</td>
							</tr>
							<tr>
								<td width="572" colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
			
			$report .=
				'<table border="0">
					<tr>
						<td width="820">
						<table border="0">
							<tr>
								<td colspan="3" width="820">&nbsp;</td>
							</tr>
							<tr>
  							<td width="300" align="center"></td>
							  <td width="270"><div align="center"></div></td>
							  <td width="250" align="center">
								Tanggal : '.$tanggal.'</td>
							  </tr>
							<tr>
							  <td width="300"><div align="center"></div></td>
							  <td width="270"><div align="center"></div></td>
							  <td width="250" align="center">
								Dibuat oleh : '.$pembuat.'</td>
							  </tr>
							<tr>
							  <td width="300">&nbsp;</td>
							  <td width="270"><div align="center"></div></td>
							  <td width="250" align="center"></td>
							  </tr>
							<tr>
							  <td width="300" height="58">&nbsp;</td>
							  <td width="270"></td>
							  <td width="250" align="center">&nbsp;</td>
							  </tr>';
							  
				//kabid pendapatan
				$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
				if($s1==NULL){
					$nama1 = '';
					$nip1 = '';
				} else {
					$nama1 = $s1->nama;
					$nip1 = $s1->nip;
				}
				
				$s2 = $this->db->query("select nama, nip from admin where id_modul = '4'")->row();
				if($s2==NULL){
					$nama2 = '';
					$nip2 = '';
				} else {
					$nama2 = $s2->nama;
					$nip2 = $s2->nip;
				}
				
				$s3 = $this->db->query("select nama, nip from admin where username = '".$this->session->userdata('username')."'")->row();
				if($s3==NULL){
					$nama3 = '';
					$nip3 = '';
				} else {
					$nama3 = $s3->nama;
					$nip3 = $s3->nip;
				}
							  
				$report .= '<tr>
  							<td width="300" align="center"></td>
							  <td width="270" align="center"></td>
							  <td width="250" align="center">'.$nama3.'</td>
							  </tr>
							<tr>
  							<td width="300" align="center"></td>
							  <td width="270" align="center"></td>
							  <td width="250" align="center">NIP.'.$nip3.'</td>
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