<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_setting extends MY_Controller {
	
	public function index() {
	}
	
	public function ttd(){
		$this->load->view('master/ttd');
	}
	
	public function data_ttd(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,nama_ttd,nip_ttd,jabatan_ttd from master_tanda_tangan","id","id,nama_ttd,nip_ttd,jabatan_ttd");
	}
	
	public function galianc(){
		$this->load->view('master/galianc');
	}
	
	public function data_galianc(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,keterangan,harga_pasar from tb_galianc_objek_pajak","keterangan","id,keterangan,harga_pasar");
	}
	
	public function air_tanah(){
		$this->load->view('master/air_tanah');
	}
	
	public function data_air(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,lokasi,tujuan,volume,tarif from tarif_air_tanah","id","lokasi,tujuan,volume,tarif");
	}
	
	public function lokasi(){
		$this->load->view('master/lokasi');
	}
	
    public function lokasi_pasar(){
		$this->load->view('master/lokasi_pasar');
	}

	public function tarif_retribusi(){
		$this->load->view('master/tarif_retribusi');
	}
    
	public function data_lokasi(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_lokasi,nama_lokasi from lokasi_air_tanah","id","kode_lokasi,nama_lokasi");
	}
    
   	public function data_lokasi_pasar(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode,nm_lokasi from lokasi_pasar","id","id,kode,nm_lokasi");
	}
	
    public function data_tarif_retribusi(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id_luas,nm_luas,tarif from tarif_retribusi","id_luas","id_luas,nm_luas,tarif");
	}	
    
	public function tujuan(){
		$this->load->view('master/tujuan');
	}
	
	public function data_tujuan(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_tujuan,nama_tujuan from tujuan_air_tanah","id","kode_tujuan,nama_tujuan");
	}
	
	public function volume(){
	
		$this->load->view('master/volume');

	}
	
	public function data_volume(){
		$grid = new GridConnector($this->db->conn_id);		
		$grid->render_sql("select id,kode_volume,range_volume from volume_air_tanah ","id", "kode_volume,range_volume ");
	
	
	}
	
	public function target() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/target',$data);
	}
	
	public function data_target() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,nama_pajak,apbd,target,tahun from target_pajak","id","nama_pajak,apbd,target,tahun,id");		
	}
	
	public function target_rincian() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/target_rincian',$data);
	}
	
	public function simpan_data_rincian(){
		$target = $this->input->post('target');
		$kode = $this->input->post('kode');
		$tahun = $this->input->post('tahun');
		if(strpos($target, '.')){
			$target = str_replace('.', '', $target);
		} else {
			$target;
		}
		
		$data = array (
			'target_pajak' => $target,
			'kode_rekening' => $kode,
			'tahun' => $tahun
		);
		$hasil = $this->db->insert('target_rincian', $data, array('kode_rekening' => $this->input->post('kode')));
		echo $hasil;
	}
	
	public function data_rincian() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT  id,kd_rek, nm_rek,target_realisasi, jns_pajak, tarif_pajak, status_aktif,tahun FROM master_rekening 
						  WHERE status_aktif = '1'","id","kd_rek,nm_rek,tahun,target_realisasi,id");		
	}
	
	public function kecamatan() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/kecamatan',$data);
	}
	
	public function data_kecamatan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_kecamatan,nama_kecamatan from kecamatan","id","id,kode_kecamatan,nama_kecamatan");		
	}
	
	public function kelurahan() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/kelurahan',$data);
	}
	
	public function data_kelurahan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_kelurahan,nama_kelurahan,kode_kecamatan from kelurahan","id","id,kode_kelurahan,nama_kelurahan,kode_kecamatan");		
	}
	
	public function hotel() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/hotel',$data);
	}
	
	public function data_hotel() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_hotel,golongan_hotel from master_hotel","id","id,kode_hotel,golongan_hotel");		
	}
        
        public function reklame() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/m_reklame',$data);
	}
        
        public function data_reklame() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
tarif_reklame.id,
tarif_reklame.kd_rek_reklame,
tarif_reklame.lokasi,
tarif_reklame.waktu,
tarif_reklame.tarif
FROM
tarif_reklame","id","id,kd_rek_reklame,lokasi,waktu,tarif");		
	}
        
        public function sptpd() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/sptpd',$data);
	}
        
        public function data_sptpd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_sptpd,nama_sptpd from master_sptpd","id","id,kode_sptpd,nama_sptpd");		
	}
	
	public function rekening() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/rekening',$data);
	}
        
    public function data_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT  id,kd_rek, nm_rek,target_realisasi, jns_pajak, tarif_pajak, status_aktif FROM master_rekening WHERE status_aktif = '1' ORDER BY kd_rek ASC","id"," kd_rek, nm_rek, target_realisasi, jns_pajak, tarif_pajak, status_aktif");		
	}
	
	function cetak_rekening(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		//$marginBawah = $t[0];
		$awal = $t[0];
		$akhir = $t[1];
		$cetak = $t[2];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		$tgl12 = $t[2].' '.$t[1].' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		$tgl22 = $s[2].' '.$s[1].' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'LEGAL', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD');
		$pdf->SetKeywords('SOPD');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(25,30,10);
		$pdf->SetAutoPageBreak(true);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','LEGAL',false);
		//set data
		
		$tahun		= date("Y");
		$tahun_l	= $tahun-1;
	
		$report = '';
		$report .=
			'<table borde="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="6" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="6" align="center" >
									<b>LAPORAN REALISASI PENDAPATAN DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								
								<td colspan="6" align="center">
									<b>TAHUN ANGGARAN '.$t[0].'</b>
								</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								
								<td colspan="6" align="center">
									<b>PERIODE  '.$tgl1.' S/D '.$tgl2.'</b>
								</td>
							</tr>
							<tr>
								<td></td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1" cellpadding="2" cellspacing="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="center"><strong>KODE REK</strong></td>
					<td width="380" valign="center" align="center"><strong>Uraian</strong></td>
					<td width="140" valign="center" align="center"><strong>Target</strong></td>
					<td width="140" valign="center" align="center"><strong>Realisasi</strong></td>
					<td width="140" valign="center" align="center"><strong>Lebih / Kurang</strong></td>
					<td width="90" valign="center" align="center"><strong>%</strong></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="center"><strong>1</strong></td>
					<td width="380" valign="center" align="center"><strong>2</strong></td>
					<td width="140" valign="center" align="center"><strong>3</strong></td>
					<td width="140" valign="center" align="center"><strong>4</strong></td>
					<td width="140" valign="center" align="center"><strong>5 = 3 - 4</strong></td>
					<td width="90" valign="center" align="center"><strong>6</strong></td>
				</tr>
				';
		
		$query = "SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE jns_pajak !='0' AND LEFT(kd_rek,5)='4.1.1' AND jns_pajak !='12' AND status_aktif='1')a
					LEFT JOIN (SELECT IFNULL(b.kode_rekening,0) AS kode_rekening,SUM(IFNULL(b.jumlah,0)) AS realisasi FROM sspd a LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd 
					LEFT JOIN master_rekening c ON b.kode_rekening=c.kd_rek	WHERE a.status='1' AND a.tanggal>='$awal' AND a.tanggal<='$akhir' GROUP BY c.kd_rek)b
					ON a.kd_rek=b.kode_rekening
					UNION ALL
					SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE LENGTH(kd_rek)>='12' AND status_aktif='1')a
					LEFT JOIN (SELECT IFNULL(b.kd_rek,0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pajaklain a LEFT JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir' GROUP BY c.kd_rek)b
					ON a.kd_rek=b.kode_rekening
					UNION ALL
					SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE status_child ='12' AND status_aktif='1')a
					LEFT JOIN (SELECT IFNULL(b.kd_rek,0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pbb_bphtb a LEFT JOIN dt_detail_pbb_bphtb b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir' GROUP BY c.kd_rek)b
					ON a.kd_rek=b.kode_rekening
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,5) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)='4.1' GROUP BY LEFT(a.kd_rek,5))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kode_rekening,5),0) AS kode_rekening,SUM(IFNULL(b.jumlah,0)) AS realisasi FROM sspd a LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd 
					WHERE a.status='1' AND a.tanggal>='$awal' AND a.tanggal<='$akhir'  GROUP BY LEFT(b.kode_rekening,5))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='5') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='5'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,5) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)!='4.1' GROUP BY LEFT(a.kd_rek,5))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kd_rek,5),0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pajaklain a LEFT JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir'  GROUP BY LEFT(b.kd_rek,5))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='5') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='5'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,8) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)='4.1' GROUP BY LEFT(a.kd_rek,8))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kode_rekening,8),0) AS kode_rekening,SUM(IFNULL(b.jumlah,0)) AS realisasi FROM sspd a LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd 
					WHERE a.status='1' AND a.tanggal>='$awal' AND a.tanggal<='$akhir'  GROUP BY LEFT(b.kode_rekening,8))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='8') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='8'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,8) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)!='4.1' GROUP BY LEFT(a.kd_rek,8))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kd_rek,8),0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pajaklain a LEFT JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir'  GROUP BY LEFT(b.kd_rek,8))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='8') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='8'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,11) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)!='4.1' GROUP BY LEFT(a.kd_rek,11))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kd_rek,11),0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pajaklain a LEFT JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir'  GROUP BY LEFT(b.kd_rek,11))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='11') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='11'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,3) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND LEFT(a.kd_rek,3)='4.1' GROUP BY LEFT(a.kd_rek,3))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kode_rekening,3),0) AS kode_rekening,SUM(IFNULL(b.jumlah,0)) AS realisasi FROM sspd a LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd 
					WHERE a.status='1' AND a.tanggal>='$awal' AND a.tanggal<='$akhir'  GROUP BY LEFT(b.kode_rekening,3))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='3') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='3'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,3) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' AND jns_pajak ='4.2' GROUP BY LEFT(a.kd_rek,3))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kd_rek,3),0) AS kode_rekening,SUM(IFNULL(a.jml_dibayar,0)) AS realisasi FROM dt_pajaklain a LEFT JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd 
					LEFT JOIN master_rekening c ON b.kd_rek=c.kd_rek WHERE a.tgl_diterima>='$awal' AND a.tgl_diterima<='$akhir'  GROUP BY LEFT(b.kd_rek,3))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='3') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='3'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.realisasi FROM(
					SELECT LEFT(a.kd_rek,2) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE a.status_aktif='1' GROUP BY LEFT(a.kd_rek,2))a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kode_rekening,2),0) AS kode_rekening,SUM(IFNULL(b.jumlah,0)) AS realisasi FROM sspd a LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd 
					WHERE a.status='1' AND a.tanggal>='$awal' AND a.tanggal<='$akhir'  GROUP BY LEFT(b.kode_rekening,2))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='2') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='2'
					ORDER BY kd_rek  
";
		$nama='';
		$tot_total 		= 0;
		$tot_thn_lalu 	= 0;
		$tot_thn_ini 	= 0;
		$tot_sisa 		= 0;
		$no =0;
		$urut =0;
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$kd_rek 	= $rs->kd_rek;
			$nm_rek 	= $rs->nm_rek;
			$target 	= $rs->target_realisasi;
			//$tahun_pajak 	= $rs->tahun_pajak;
			$realisasi 		= $rs->realisasi;
			$lebkur 		= $target-$realisasi;
			
			
			if($realisasi==Null){
				$realisasi=0;
			}else{
				$realisasi;
			}
			
			if($target==0){
				$persen=0;
			}else{
				$persen=$realisasi/$target*100;
			}
			
			if(strlen($kd_rek)>=10){
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left">'.$kd_rek.'</td>
					<td width="380" valign="center" align="left">'.$nm_rek.'</td>
					<td width="140" valign="center" align="right">'.number_format($target,2,",",".").'</td>
					<td width="140" valign="center" align="right">'.number_format($realisasi,2,",",".").'</td>
					<td width="140" valign="center" align="right">'.number_format($lebkur,2,",",".").'</td>
					<td width="90" valign="center" align="center">'.number_format($persen,2,",",".").'%</td>
				</tr>';
			}else{
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left"><strong>'.$kd_rek.'</strong></td>
					<td width="380" valign="center" align="left"><strong>'.$nm_rek.'</strong></td>
					<td width="140" valign="center" align="right"><strong>'.number_format($target,2,",",".").'</strong></td>
					<td width="140" valign="center" align="right"><strong>'.number_format($realisasi,2,",",".").'</strong></td>
					<td width="140" valign="center" align="right"><strong>'.number_format($lebkur,2,",",".").'</strong></td>
					<td width="90" valign="center" align="center"><strong>'.number_format($persen,2,",",".").'%</strong></td>
				</tr>';
			}
		
				$report .=$muncul;
				
		}
		
		$report .='	</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		/* $pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Piutang_Pajak'.'.pdf', 'I'); */
		$data['prev']= $report;
			
			 
			 
	switch($cetak) {       
        case 1;
			$pdf->writeHTML($report, true, false, true, false);
			$pdf->lastPage();
			$pdf->Output('Report_Target_realisasi'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_target_realisasi";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}		 
	}
	
}