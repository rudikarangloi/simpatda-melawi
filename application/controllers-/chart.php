<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class chart extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
	}
	
	public function pendaftaran(){
		//Data Chart
		$tgl = "";
		$register = "";
		$pemilik = "";
		$perusahaan = "";
		$n = 31;
		for($i=1;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$tgl .= "'".$i."'";
			if($i != $n):
				$tgl .= ",";
			endif;
			$tanggal = date("Y-m").'-'.$i;
			// Data Jumlah Register
			$sql = $this->db->query("select count(*) as jml from register where created like '".$tanggal."%'");
			$rs = $sql->row();
	
			$register .= $rs->jml;
			if($i != $n):
				$register .= ",";
			endif;
				
			// Data Jumlah Pemilik
			$sql = $this->db->query("select count(*) as jml from identitas_pemilik where created like '".$tanggal."%'");
			$rs = $sql->row();
	
			$pemilik .= $rs->jml;
			if($i != $n):
				$pemilik .= ",";
			endif;
				
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from identitas_perusahaan where tgl_daftar like'".$tanggal."'");
			$rs = $sql->row();
	
			$perusahaan .= $rs->jml;
			if($i != $n):
				$perusahaan .= ",";
			endif;
		}
		$data['tgl'] = $tgl;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['register'] = $register;
		$data['pemilik'] = $pemilik;
		$data['perusahaan'] = $perusahaan;
		$this->load->view('chart/pendaftaran',$data);
	}
	
	public function sptpd() {
		$tgl = "";
		$hotel = "";
		$restoran = "";
		$reklame = "";
		$hiburan = "";
		$listrik = "";
		$parkir = "";
		$galian = "";
		$air = "";
		$walet = "";
		$n = 31;
		for($i=1;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$tgl .= "'".$i."'";
			if($i != $n):
				$tgl .= ",";
			endif;
			$tanggal = date("Y-m").'-'.$i;
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select count(*) as jml from sptpd_hotel where tgl_diterima = '".$tanggal."'");
			$rs = $sql->row();

			$hotel .= $rs->jml;
			if($i != $n):
				$hotel .= ",";
			endif;
			
			// Data setoran Pemilik
			$sql = $this->db->query("select count(*) as jml from sptpd_restoran where tgl_diterima ='".$tanggal."'");
			$rs2 = $sql->row();

			$restoran .= $rs2->jml;
			if($i != $n):
				$restoran .= ",";
			endif;
			
			// Data setoran Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_reklame where tgl_diterima  = '".$tanggal."'");
			$rs3 = $sql->row();

			$reklame .= $rs3->jml;
			if($i != $n):
				$reklame .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_hiburan where tgl_diterima  = '".$tanggal."'");
			$rs4 = $sql->row();

			$hiburan .= $rs4->jml;
			if($i != $n):
				$hiburan .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_parkir where tgl_diterima  = '".$tanggal."'");
			$rs5 = $sql->row();

			$parkir .= $rs5->jml;
			if($i != $n):
				$parkir .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_listrik where tgl_diterima  = '".$tanggal."'");
			$rs6 = $sql->row();

			$listrik .= $rs6->jml;
			if($i != $n):
				$listrik .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_galianc where tgl_diterima  = '".$tanggal."'");
			$rs7 = $sql->row();

			$galian .= $rs7->jml;
			if($i != $n):
				$galian .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_air_bawah_tanah where tgl_diterima  = '".$tanggal."'");
			$rs8 = $sql->row();

			$air .= $rs8->jml;
			if($i != $n):
				$air .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from sptpd_burung_walet where tgl_diterima  = '".$tanggal."'");
			$rs9 = $sql->row();

			$walet .= $rs9->jml;
			if($i != $n):
				$walet .= ",";
			endif;
		}
		$data['tgl'] = $tgl;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['hotel'] = $hotel;
		$data['restoran'] = $restoran;
		$data['reklame'] = $reklame;
		$data['hiburan'] = $hiburan;
		$data['parkir'] = $parkir;
		$data['listrik'] = $listrik;
		$data['galian'] = $galian;
		$data['air'] = $air;
		$data['walet'] = $walet;
		$this->load->view('chart/sptpd',$data);
	}
	
	function nota(){
		$tgl = "";
		$hotel = "";
		$restoran = "";
		$reklame = "";
		$hiburan = "";
		$listrik = "";
		$parkir = "";
		$galian = "";
		$air = "";
		$walet = "";
		$n = 12;
		for($i=1;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$tgl .= "'".$i."'";
			if($i != $n):
				$tgl .= ",";
			endif;
			$tanggal = date("Y").'-'.$i;
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'HTL'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hotel .= $rs;
			if($i != $n):
				$hotel .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'RES'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$restoran .= $rs;
			if($i != $n):
				$restoran .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'REK'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$reklame .= $rs;
			if($i != $n):
				$reklame .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'HIB'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hiburan .= $rs;
			if($i != $n):
				$hiburan .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'LIS'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$listrik .= $rs;
			if($i != $n):
				$listrik .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'PKR'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$parkir .= $rs;
			if($i != $n):
				$parkir .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'GAL'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$galian .= $rs;
			if($i != $n):
				$galian .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'WLT'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$walet .= $rs;
			if($i != $n):
				$walet .= ",";
			endif;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(jumlah) as jml from nota_hitung where tgl like '".$tanggal."%' and nama_sptpd = 'AIR'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$air .= $rs;
			if($i != $n):
				$air .= ",";
			endif;
		}
		$data['tgl'] = $tgl;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['hotel'] = $hotel;
		$data['restoran'] = $restoran;
		$data['reklame'] = $reklame;
		$data['hiburan'] = $hiburan;
		$data['parkir'] = $parkir;
		$data['listrik'] = $listrik;
		$data['galian'] = $galian;
		$data['air'] = $air;
		$data['walet'] = $walet;
		$this->load->view('chart/nota',$data);
	}
	
	/*function realisasi_tahunan(){
		$data['tahun'] = $this->msistem->tahun();
		$data['thn'] = 0;
		$this->load->view('chart/realisasi',$data);
	}*/
	
	function realisasi_tahunan(){
		$x = date('Y');
		$n = date('Y');
		
		$thn = "";
		$hotel = "";
		$restoran = "";
		$reklame = "";
		$hiburan = "";
		$listrik = "";
		$parkir = "";
		$galian = "";
		$air = "";
		$walet = "";
		
		for($i=$x;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$thn .= "'".$i."'";
			if($i != $n):
				$thn .= ", ";
			endif;
			$tahun = $i;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%HTL%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hotel .= $rs;
			if($i != $n):
				$hotel .= ", ";
			endif;
			
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%RES%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$restoran .= $rs;
			if($i != $n):
				$restoran .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%REK%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$reklame .= $rs;
			if($i != $n):
				$reklame .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%HIB%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hiburan .= $rs;
			if($i != $n):
				$hiburan .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%LIS%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$listrik .= $rs;
			if($i != $n):
				$listrik .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%PKR%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$parkir .= $rs;
			if($i != $n):
				$parkir .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%GAL%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$galian .= $rs;
			if($i != $n):
				$galian .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%WLT%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$walet .= $rs;
			if($i != $n):
				$walet .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%AIR%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$air .= $rs;
			if($i != $n):
				$air .= ", ";
			endif;

		}
		$data['tahun'] = date('Y');
		$data['thn'] = $thn;
		$data['hotel'] = $hotel;
		$data['restoran'] = $restoran;
		$data['reklame'] = $reklame;
		$data['hiburan'] = $hiburan;
		$data['parkir'] = $parkir;
		$data['listrik'] = $listrik;
		$data['galian'] = $galian;
		$data['air'] = $air;
		$data['walet'] = $walet;
		
		$this->load->view('chart/realisasi',$data);

	}
	
	function count_sptpd(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$sptpd = "";
		$nihil = "";
		$belum = "";
		$sudah = "";
		
		$n = 9;
		$que = $this->db->query('select id, kode_sptpd, nama_sptpd from master_sptpd where id NOT IN ("4","7") order by id asc');
		foreach($que->result() as $rs) {
			$i = $rs->id;
			$kode = $rs->kode_sptpd;
			
			$sptpd .= "'".$rs->nama_sptpd."'";
			if($i != $n):
				$sptpd .= ",";
			endif;
			
			//Data Jumlah sptpd belum input
			$sql = $this->db->query("select COUNT(a.npwpd_perusahaan) AS jml from identitas_perusahaan a left join master_sptpd c on a.jenis_pajak=c.id where a.npwpd_perusahaan NOT IN (SELECT npwpd FROM sptpd where tanggal LIKE '".$tgl."%') AND c.kode_sptpd='".$kode."'")->row();
			
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
				
			$nihil .= $rs;
			if($i != $n):
				$nihil .= ",";
			endif;
			
			//Data Jumlah sptpd belum bayar
			$sql = $this->db->query("SELECT COUNT(no_sptpd) as jml FROM sptpd where status = '0' AND no_sptpd LIKE '%".$kode."%' AND tanggal LIKE '".$tgl."%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			
			$belum .= $rs;
			if($i != $n):
				$belum .= ", ";
			endif;
			
			//Data Jumlah sptpd sudah bayar
			$sql2 = $this->db->query("SELECT COUNT(no_sptpd) as jml FROM sptpd where status = '1' AND no_sptpd LIKE '%".$kode."%' AND tanggal LIKE '".$tgl."%'")->row();
			$rs2 = $sql2->jml;
			if($rs2==NULL){
				$rs2 = 0;
			}
			
			$sudah .= $rs2;
			if($i != $n):
				$sudah .= ",";
			endif;

		}
		$data['sptpd'] = $sptpd;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['nihil'] = $nihil;
		$data['belum'] = $belum;
		$data['sudah'] = $sudah;
		
		$this->load->view('chart/c_sptpd',$data);

	}
	
	function count_skp(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$sptpd = "";
		$nihil = "";
		$sudah = "";
		$belum = "";
		
		$n = 9;
		$que = $this->db->query('select id, kode_sptpd, nama_sptpd from master_sptpd where id IN ("4","7") order by id asc');
		foreach($que->result() as $rs) {
			$i = $rs->id;
			$kode = $rs->kode_sptpd;
			
			$sptpd .= "'".$rs->nama_sptpd."'";
			if($i != $n):
				$sptpd .= ",";
			endif;
			
			//Data Jumlah sptpd belum input
			$sql = $this->db->query("select COUNT(a.npwpd_perusahaan) AS jml from identitas_perusahaan a left join master_sptpd c on a.jenis_pajak=c.id where a.npwpd_perusahaan NOT IN (SELECT npwpd FROM skpd where tgl_jth_tempo LIKE '".$tgl."%') AND c.kode_sptpd='".$kode."'")->row();
			
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
				
			$nihil .= $rs;
			if($i != $n):
				$nihil .= ",";
			endif;
			
			//Data Jumlah skpd belum bayar
			$sql1 = $this->db->query("SELECT COUNT(no_skpd) as jml FROM skpd where status = '0' AND no_skpd LIKE '%".$kode."%' AND tgl_jth_tempo LIKE '".$tgl."%'")->row();
			$rs1 = $sql1->jml;
			if($rs1==NULL){
				$rs1 = 0;
			}
			
			$belum .= $rs1;
			if($i != $n):
				$belum .= ", ";
			endif;
			
			//Data Jumlah skpd sudah bayar
			$sql2 = $this->db->query("SELECT COUNT(no_skpd) as jml FROM skpd where status = '1' AND no_skpd LIKE '%".$kode."%' AND tgl_jth_tempo LIKE '".$tgl."%'")->row();
			$rs2 = $sql2->jml;
			if($rs2==NULL){
				$rs2 = 0;
			}
			
			$sudah .= $rs2;
			if($i != $n):
				$sudah .= ",";
			endif;

		}
		$data['sptpd'] = $sptpd;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['nihil'] = $nihil;
		$data['belum'] = $belum;
		$data['sudah'] = $sudah;
		
		$this->load->view('chart/c_skpd',$data);
	}
	
	function count_kec(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$kec = "";
		$HTL = "";
		$RES = "";
		$REK = "";
		$HIB = "";
		$LIS = "";
		$GAL = "";
		$WLT = "";
		$AIR = "";
		$PKR = "";
		
		$n = $this->db->query('select count(kode_kecamatan) as jml from kecamatan')->row();
		$count_kec = $n->jml;
		//$count_kec = 11;
		
		$que = $this->db->query('select id, kode_kecamatan, nama_kecamatan from kecamatan order by id asc');
		foreach($que->result() as $rs) {
			$i = $rs->id;
			$kode = $rs->kode_kecamatan;
			
			$kec .= "'".$rs->nama_kecamatan."'";
			if($i != $count_kec):
				$kec .= ",";
			endif;
			
			//Data Hotel
			$sql = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 1 and kecamatan ='".$kode."'")->row();
			
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
				
			$HTL .= $rs;
			if($i != $count_kec):
				$HTL .= ",";
			endif;
			
			//Data Restoran
			$sql2 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 2 and kecamatan ='".$kode."'")->row();
			
			$rs2 = $sql2->jml;
			if($rs2==NULL){
				$rs2 = 0;
			}
				
			$RES .= $rs2;
			if($i != $count_kec):
				$RES .= ",";
			endif;
			
			//Data Hiburan
			$sql3 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 3 and kecamatan ='".$kode."'")->row();
			
			$rs3 = $sql3->jml;
			if($rs3==NULL){
				$rs3 = 0;
			}
				
			$HIB .= $rs3;
			if($i != $count_kec):
				$HIB .= ",";
			endif;
			
			//Data Reklame
			$sql4 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 4 and kecamatan ='".$kode."'")->row();
			
			$rs4 = $sql4->jml;
			if($rs4==NULL){
				$rs4 = 0;
			}
				
			$REK .= $rs4;
			if($i != $count_kec):
				$REK .= ",";
			endif;
		
			//Data Reklame
			$sql5 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 5 and kecamatan ='".$kode."'")->row();
			
			$rs5 = $sql5->jml;
			if($rs5==NULL){
				$rs5 = 0;
			}
				
			$LIS .= $rs5;
			if($i != $count_kec):
				$LIS .= ",";
			endif;
			
			//Data Reklame
			$sql6 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 6 and kecamatan ='".$kode."'")->row();
			
			$rs6 = $sql6->jml;
			if($rs6==NULL){
				$rs6 = 0;
			}
				
			$PKR .= $rs6;
			if($i != $count_kec):
				$PKR .= ",";
			endif;
			
			//Data Reklame
			$sql7 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 7 and kecamatan ='".$kode."'")->row();
			
			$rs7 = $sql7->jml;
			if($rs7==NULL){
				$rs7 = 0;
			}
				
			$AIR .= $rs7;
			if($i != $count_kec):
				$AIR .= ",";
			endif;
			
			//Data Reklame
			$sql8 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 8 and kecamatan ='".$kode."'")->row();
			
			$rs8 = $sql8->jml;
			if($rs8==NULL){
				$rs8 = 0;
			}
				
			$WLT .= $rs8;
			if($i != $count_kec):
				$WLT .= ",";
			endif;
			
			//Data Reklame
			$sql9 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 9 and kecamatan ='".$kode."'")->row();
			
			$rs9 = $sql9->jml;
			if($rs9==NULL){
				$rs9 = 0;
			}
				
			$GAL .= $rs9;
			if($i != $count_kec):
				$GAL .= ",";
			endif;

		}
		$data['kec'] = $kec;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['HTL'] = $HTL;
		$data['RES'] = $RES;
		$data['HIB'] = $HIB;
		$data['REK'] = $REK;
		$data['LIS'] = $LIS;
		$data['PKR'] = $PKR;
		$data['AIR'] = $AIR;
		$data['WLT'] = $WLT;
		$data['GAL'] = $GAL;
		
		$this->load->view('chart/count_kec',$data);
	}
	
	function count_kel(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$kec = "";
		$HTL = "";
		$RES = "";
		$REK = "";
		$HIB = "";
		$LIS = "";
		$GAL = "";
		$WLT = "";
		$AIR = "";
		$PKR = "";
		
		$n = $this->db->query('select count(kode_kelurahan) as jml from kelurahan')->row();
		$count_kec = $n->jml;
		//$count_kec = 11;
		
		$que = $this->db->query('select id, kode_kelurahan, nama_kelurahan from kelurahan order by id asc');
		foreach($que->result() as $rs) {
			$i = $rs->id;
			$kode = $rs->kode_kelurahan;
			
			$kec .= "'".$rs->nama_kelurahan."'";
			if($i != $count_kec):
				$kec .= ",";
			endif;
			
			//Data Hotel
			$sql = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 1 and kelurahan ='".$kode."'")->row();
			
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
				
			$HTL .= $rs;
			if($i != $count_kec):
				$HTL .= ",";
			endif;
			
			//Data Restoran
			$sql2 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 2 and kelurahan ='".$kode."'")->row();
			
			$rs2 = $sql2->jml;
			if($rs2==NULL){
				$rs2 = 0;
			}
				
			$RES .= $rs2;
			if($i != $count_kec):
				$RES .= ",";
			endif;
			
			//Data Hiburan
			$sql3 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 3 and kelurahan ='".$kode."'")->row();
			
			$rs3 = $sql3->jml;
			if($rs3==NULL){
				$rs3 = 0;
			}
				
			$HIB .= $rs3;
			if($i != $count_kec):
				$HIB .= ",";
			endif;
			
			//Data Reklame
			$sql4 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 4 and kelurahan ='".$kode."'")->row();
			
			$rs4 = $sql4->jml;
			if($rs4==NULL){
				$rs4 = 0;
			}
				
			$REK .= $rs4;
			if($i != $count_kec):
				$REK .= ",";
			endif;
		
			//Data Reklame
			$sql5 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 5 and kelurahan ='".$kode."'")->row();
			
			$rs5 = $sql5->jml;
			if($rs5==NULL){
				$rs5 = 0;
			}
				
			$LIS .= $rs5;
			if($i != $count_kec):
				$LIS .= ",";
			endif;
			
			//Data Reklame
			$sql6 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 6 and kelurahan ='".$kode."'")->row();
			
			$rs6 = $sql6->jml;
			if($rs6==NULL){
				$rs6 = 0;
			}
				
			$PKR .= $rs6;
			if($i != $count_kec):
				$PKR .= ",";
			endif;
			
			//Data Reklame
			$sql7 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 7 and kelurahan ='".$kode."'")->row();
			
			$rs7 = $sql7->jml;
			if($rs7==NULL){
				$rs7 = 0;
			}
				
			$AIR .= $rs7;
			if($i != $count_kec):
				$AIR .= ",";
			endif;
			
			//Data Reklame
			$sql8 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 8 and kelurahan ='".$kode."'")->row();
			
			$rs8 = $sql8->jml;
			if($rs8==NULL){
				$rs8 = 0;
			}
				
			$WLT .= $rs8;
			if($i != $count_kec):
				$WLT .= ",";
			endif;
			
			//Data Reklame
			$sql9 = $this->db->query("select COUNT(npwpd_perusahaan) AS jml from identitas_perusahaan where jenis_pajak = 9 and kelurahan ='".$kode."'")->row();
			
			$rs9 = $sql9->jml;
			if($rs9==NULL){
				$rs9 = 0;
			}
				
			$GAL .= $rs9;
			if($i != $count_kec):
				$GAL .= ",";
			endif;

		}
		$data['kec'] = $kec;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['HTL'] = $HTL;
		$data['RES'] = $RES;
		$data['HIB'] = $HIB;
		$data['REK'] = $REK;
		$data['LIS'] = $LIS;
		$data['PKR'] = $PKR;
		$data['AIR'] = $AIR;
		$data['WLT'] = $WLT;
		$data['GAL'] = $GAL;
		
		$this->load->view('chart/count_kel',$data);
	}
	
	function target(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$kec = "";
		$target = "";
		$setoran = "";
		$sptpd = "";
		
		$sql = $this->db->query("SELECT master_sptpd.nama_sptpd, master_sptpd.kode_sptpd, target_pajak.target FROM master_sptpd INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak");

		$i=1;
		$count=9;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_sptpd;
			
			$sptpd .= "'".$rs->nama_sptpd."'";
			if($i != $count):
				$sptpd .= ",";
			endif;
			
			$rs = $rs->target;
			if($rs==NULL){
				$rs = 0;
			}
				
			$target .= $rs;
			if($i != $count):
				$target .= ",";
			endif;
		
			$realisasi = $this->db->query("select sum(setoran) as jumlah from sspd where nomor like '%".$kode."%' and tahun_pajak ='".date('Y')."' and tanggal <= '".date('Y-m-d')."'")->row();
			
			$rs1 = $realisasi->jumlah;
			if($rs1==NULL){
				$rs1 = 0;
			}
				
			$setoran .= $rs1;
			if($i != $count):
				$setoran .= ",";
			endif;

		}
		$data['sptpd'] = $sptpd;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['target'] = $target;
		$data['setoran'] = $setoran;
		
		$this->load->view('chart/target',$data);
	}
	
	function rincian(){
		$tgl = date('Y-m');
		//$n = date('Y');
		
		$kec = "";
		$target = "";
		$setoran = "";
		$sptpd = "";
		
		$sql = $this->db->query("select a.id,a.kode_rekening,b.nm_rek,a.target_pajak from target_rincian a left join master_rekening b on a.kode_rekening=b.kd_rek where status_child = '1'");

		$i=1;
		$count=9;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_rekening;
			
			$sptpd .= "'".$rs->nm_rek."'";
			if($i != $count):
				$sptpd .= ",";
			endif;
			
			$rs = $rs->target_pajak;
			if($rs==NULL){
				$rs = 0;
			}
				
			$target .= $rs;
			if($i != $count):
				$target .= ",";
			endif;
		
			$realisasi = $this->db->query("select sum(a.jumlah) as jumlah from sspd_detail a left join sspd b on a.no_sspd=b.no_sspd where a.kode_rekening = '".$kode."' and b.tahun_pajak ='".date('Y')."' and b.tanggal <= '".date('Y-m-d')."'")->row();
			
			$rs1 = $realisasi->jumlah;
			if($rs1==NULL){
				$rs1 = 0;
			}
				
			$setoran .= $rs1;
			if($i != $count):
				$setoran .= ",";
			endif;

		}
		$data['sptpd'] = $sptpd;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['target'] = $target;
		$data['setoran'] = $setoran;
		
		$this->load->view('chart/rincian',$data);
	}
}
			
?>