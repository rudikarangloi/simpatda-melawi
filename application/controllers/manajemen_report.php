<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class report_pajak extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	function realisasi(){
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/realisasi', $data);		
	}
    
    function realisasi_sptpd(){
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/realisasi_sptpd', $data);
    }
    
    function realisasi_sptpd_denda(){
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/realisasi_sptpd_denda', $data);
    }
    function realisasi_denda(){
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/realisasi_denda', $data);
    }
	
    function laporan_tunggakan(){
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/laporan_tunggakan', $data);
    }
    

    	
	function cetak_realisasi(){
		$p = $_GET['full'];
		$b = explode('-',$p);
		$pajak = $b[0];
		$tahun = $b[1];
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
			$p = 'HOTEL';
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
			$p = 'RESTORAN';
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
			$p = 'REKLAME';
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
			$p = 'HIBURAN';
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
			$p = 'PENERANGAN JALAN';
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
			$p = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
			$p = 'BURUNG WALET';
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
			$p = 'PARKIR';
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
			$p = 'AIR TANAH';
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(0,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN REALISASI PENERIMAAN PAJAK '.$p.' TAHUN '.$b[1].'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td rowspan="2" width="20" height="10" align="center"><strong>NO.</strong></td>
					<td rowspan="2" width="80" height="10" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td rowspan="2" width="100" height="12" align="center"><strong>ALAMAT WAJIB PAJAK</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td colspan="6" width="540" height="12" align="center"><strong>BULAN</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>
				<tr>
					<td width="45" height="12" align="center"><strong>JANUARI</strong></td>
					<td width="45" height="12" align="center"><strong>FEBRUARI</strong></td>
					<td width="45" height="12" align="center"><strong>MARET</strong></td>
					<td width="45" height="12" align="center"><strong>APRIL</strong></td>
					<td width="45" height="12" align="center"><strong>MEI</strong></td>
					<td width="45" height="12" align="center"><strong>JUNI</strong></td>
					<td width="45" height="12" align="center"><strong>JULI</strong></td>
					<td width="45" height="12" align="center"><strong>AGUSTUS</strong></td>
					<td width="45" height="12" align="center"><strong>SEPTEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>OKTOBER</strong></td>
					<td width="45" height="12" align="center"><strong>NOVEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>DESEMBER</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_transaksi = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan ");
		
		$i=1;
		$piutang = 0;
		$s1 = 0;
		$s2 = 0;
		$s3 = 0;
		$s4 = 0;
		$s5 = 0;
		$s6 = 0;
		$s7 = 0;
		$s8 = 0;
		$s9 = 0;
		$s10 = 0;
		$s11 = 0;
		$s12 = 0;
		$st = 0;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT (SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_transaksi < '".$tahun."' $qr) as piutang,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '01' AND tahun_transaksi = '".$tahun."' $qr) as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '02' AND tahun_transaksi = '".$tahun."' $qr) as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '03' AND tahun_transaksi = '".$tahun."' $qr) as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '04' AND tahun_transaksi = '".$tahun."' $qr) as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '05' AND tahun_transaksi = '".$tahun."' $qr) as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '06' AND tahun_transaksi = '".$tahun."' $qr) as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '07' AND tahun_transaksi = '".$tahun."' $qr) as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '08' AND tahun_transaksi = '".$tahun."' $qr) as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '09' AND tahun_transaksi = '".$tahun."' $qr) as s_9,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '10' AND tahun_transaksi = '".$tahun."' $qr) as s_10,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '11' AND tahun_transaksi = '".$tahun."' $qr) as s_11,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '12' AND tahun_transaksi = '".$tahun."' $qr) as s_12
FROM sspd")->row();
			$jum = $detail->piutang+$detail->s_1+$detail->s_2+$detail->s_3+$detail->s_4+$detail->s_5+$detail->s_6+$detail->s_7+$detail->s_8+$detail->s_9+$detail->s_10+$detail->s_11+$detail->s_12;
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="10" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="45" height="12" align="right">'.number_format($detail->piutang,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_1,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_2,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_3,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_4,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_5,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_6,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_7,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_8,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_9,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_10,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_11,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_12,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($jum,2,",",".").'&nbsp;</td>
				</tr>';
				
				$piutang = $piutang + $detail->piutang;
				$s1 = $s1 + $detail->s_1;
				$s2 = $s2 + $detail->s_2;
				$s3 = $s3 + $detail->s_3;
				$s4 = $s4 + $detail->s_4;
				$s5 = $s5 + $detail->s_5;
				$s6 = $s6 + $detail->s_6;
				$s7 = $s7 + $detail->s_7;
				$s8 = $s8 + $detail->s_8;
				$s9 = $s9 + $detail->s_9;
				$s10 = $s10 + $detail->s_10;
				$s11 = $s12 + $detail->s_11;
				$s12 = $s12 + $detail->s_12;
				$st = $st + $jum;
			$i++;
		}
			$report .=
				'<tr>
					<td width="200" height="12" align="center"><strong>TOTAL</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($piutang,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s1,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s2,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s3,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s4,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s5,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s6,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s7,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s8,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s9,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s10,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s11,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s12,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($st,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>';
			
		$report .=
			'<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Realisasi'.'.pdf', 'I');
	}
	

    function cetak_realisasi_sptpd(){
			$p = $_GET['full'];
		$b = explode('-',$p);
		$pajak = $b[0];
		$tahun = $b[1];
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
			$p = 'HOTEL';
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
			$p = 'RESTORAN';
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
			$p = 'REKLAME';
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
			$p = 'HIBURAN';
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
			$p = 'PENERANGAN JALAN';
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
			$p = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
			$p = 'BURUNG WALET';
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
			$p = 'PARKIR';
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
			$p = 'AIR TANAH';
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(0,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
		'<h2 align="center">LAPORAN REALISASI PENERIMAAN PAJAK '.$p.' TAHUN '.$b[1].' BERDASARKAN SPTPD</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td rowspan="2" width="20" height="10" align="center"><strong>NO.</strong></td>
					<td rowspan="2" width="80" height="10" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td rowspan="2" width="100" height="12" align="center"><strong>ALAMAT WAJIB PAJAK</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td colspan="6" width="540" height="12" align="center"><strong>BULAN</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>
				<tr>
					<td width="45" height="12" align="center"><strong>JANUARI</strong></td>
					<td width="45" height="12" align="center"><strong>FEBRUARI</strong></td>
					<td width="45" height="12" align="center"><strong>MARET</strong></td>
					<td width="45" height="12" align="center"><strong>APRIL</strong></td>
					<td width="45" height="12" align="center"><strong>MEI</strong></td>
					<td width="45" height="12" align="center"><strong>JUNI</strong></td>
					<td width="45" height="12" align="center"><strong>JULI</strong></td>
					<td width="45" height="12" align="center"><strong>AGUSTUS</strong></td>
					<td width="45" height="12" align="center"><strong>SEPTEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>OKTOBER</strong></td>
					<td width="45" height="12" align="center"><strong>NOVEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>DESEMBER</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_pajak = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan ");
		
		$i=1;
		$piutang = 0;
		$s1 = 0;
		$s2 = 0;
		$s3 = 0;
		$s4 = 0;
		$s5 = 0;
		$s6 = 0;
		$s7 = 0;
		$s8 = 0;
		$s9 = 0;
		$s10 = 0;
		$s11 = 0;
		$s12 = 0;
		$st = 0;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT (SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_pajak < '".$tahun."' $qr) as piutang,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun_pajak = '".$tahun."' $qr) as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun_pajak = '".$tahun."' $qr) as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun_pajak = '".$tahun."' $qr) as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun_pajak = '".$tahun."' $qr) as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun_pajak = '".$tahun."' $qr) as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun_pajak = '".$tahun."' $qr) as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun_pajak = '".$tahun."' $qr) as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun_pajak = '".$tahun."' $qr) as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun_pajak = '".$tahun."' $qr) as s_9,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun_pajak = '".$tahun."' $qr) as s_10,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun_pajak = '".$tahun."' $qr) as s_11,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun_pajak = '".$tahun."' $qr) as s_12
FROM sspd")->row();
			$jum = $detail->piutang+$detail->s_1+$detail->s_2+$detail->s_3+$detail->s_4+$detail->s_5+$detail->s_6+$detail->s_7+$detail->s_8+$detail->s_9+$detail->s_10+$detail->s_11+$detail->s_12;
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="10" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="45" height="12" align="right">'.number_format($detail->piutang,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_1,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_2,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_3,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_4,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_5,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_6,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_7,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_8,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_9,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_10,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_11,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_12,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($jum,2,",",".").'&nbsp;</td>
				</tr>';
				
				$piutang = $piutang + $detail->piutang;
				$s1 = $s1 + $detail->s_1;
				$s2 = $s2 + $detail->s_2;
				$s3 = $s3 + $detail->s_3;
				$s4 = $s4 + $detail->s_4;
				$s5 = $s5 + $detail->s_5;
				$s6 = $s6 + $detail->s_6;
				$s7 = $s7 + $detail->s_7;
				$s8 = $s8 + $detail->s_8;
				$s9 = $s9 + $detail->s_9;
				$s10 = $s10 + $detail->s_10;
				$s11 = $s12 + $detail->s_11;
				$s12 = $s12 + $detail->s_12;
				$st = $st + $jum;
			$i++;
		}
			$report .=
				'<tr>
					<td width="200" height="12" align="center"><strong>TOTAL</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($piutang,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s1,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s2,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s3,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s4,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s5,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s6,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s7,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s8,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s9,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s10,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s11,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s12,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($st,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>';
			
		$report .=
			'<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Realisasi'.'.pdf', 'I');
	}
    
    function cetak_realisasi_sptpd_denda(){
			$p = $_GET['full'];
		$b = explode('-',$p);
		$pajak = $b[0];
		$tahun = $b[1];
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
			$p = 'HOTEL';
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
			$p = 'RESTORAN';
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
			$p = 'REKLAME';
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
			$p = 'HIBURAN';
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
			$p = 'PENERANGAN JALAN';
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
			$p = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
			$p = 'BURUNG WALET';
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
			$p = 'PARKIR';
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
			$p = 'AIR TANAH';
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(0,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
		'<h2 align="center">LAPORAN REALISASI PENERIMAAN DENDA PAJAK '.$p.' TAHUN '.$b[1].' Berdasarkan SPTPD </h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td rowspan="2" width="20" height="10" align="center"><strong>NO.</strong></td>
					<td rowspan="2" width="80" height="10" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td rowspan="2" width="100" height="12" align="center"><strong>ALAMAT WAJIB PAJAK</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td colspan="6" width="540" height="12" align="center"><strong>BULAN</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>
				<tr>
					<td width="45" height="12" align="center"><strong>JANUARI</strong></td>
					<td width="45" height="12" align="center"><strong>FEBRUARI</strong></td>
					<td width="45" height="12" align="center"><strong>MARET</strong></td>
					<td width="45" height="12" align="center"><strong>APRIL</strong></td>
					<td width="45" height="12" align="center"><strong>MEI</strong></td>
					<td width="45" height="12" align="center"><strong>JUNI</strong></td>
					<td width="45" height="12" align="center"><strong>JULI</strong></td>
					<td width="45" height="12" align="center"><strong>AGUSTUS</strong></td>
					<td width="45" height="12" align="center"><strong>SEPTEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>OKTOBER</strong></td>
					<td width="45" height="12" align="center"><strong>NOVEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>DESEMBER</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_pajak = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan ");
		
		$i=1;
		$piutang = 0;
		$s1 = 0;
		$s2 = 0;
		$s3 = 0;
		$s4 = 0;
		$s5 = 0;
		$s6 = 0;
		$s7 = 0;
		$s8 = 0;
		$s9 = 0;
		$s10 = 0;
		$s11 = 0;
		$s12 = 0;
		$st = 0;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT (SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_pajak < '".$tahun."' $qr) as piutang,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun_pajak = '".$tahun."' $qr) as s_1,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun_pajak = '".$tahun."' $qr) as s_2,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun_pajak = '".$tahun."' $qr) as s_3,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun_pajak = '".$tahun."' $qr) as s_4,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun_pajak = '".$tahun."' $qr) as s_5,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun_pajak = '".$tahun."' $qr) as s_6,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun_pajak = '".$tahun."' $qr) as s_7,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun_pajak = '".$tahun."' $qr) as s_8,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun_pajak = '".$tahun."' $qr) as s_9,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun_pajak = '".$tahun."' $qr) as s_10,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun_pajak = '".$tahun."' $qr) as s_11,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun_pajak = '".$tahun."' $qr) as s_12
FROM sspd")->row();
			$jum = $detail->piutang+$detail->s_1+$detail->s_2+$detail->s_3+$detail->s_4+$detail->s_5+$detail->s_6+$detail->s_7+$detail->s_8+$detail->s_9+$detail->s_10+$detail->s_11+$detail->s_12;
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="10" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="45" height="12" align="right">'.number_format($detail->piutang,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_1,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_2,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_3,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_4,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_5,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_6,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_7,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_8,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_9,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_10,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_11,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_12,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($jum,2,",",".").'&nbsp;</td>
				</tr>';
				
				$piutang = $piutang + $detail->piutang;
				$s1 = $s1 + $detail->s_1;
				$s2 = $s2 + $detail->s_2;
				$s3 = $s3 + $detail->s_3;
				$s4 = $s4 + $detail->s_4;
				$s5 = $s5 + $detail->s_5;
				$s6 = $s6 + $detail->s_6;
				$s7 = $s7 + $detail->s_7;
				$s8 = $s8 + $detail->s_8;
				$s9 = $s9 + $detail->s_9;
				$s10 = $s10 + $detail->s_10;
				$s11 = $s12 + $detail->s_11;
				$s12 = $s12 + $detail->s_12;
				$st = $st + $jum;
			$i++;
		}
			$report .=
				'<tr>
					<td width="200" height="12" align="center"><strong>TOTAL</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($piutang,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s1,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s2,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s3,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s4,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s5,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s6,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s7,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s8,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s9,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s10,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s11,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s12,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($st,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>';
			
		$report .=
			'<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Realisasi'.'.pdf', 'I');
	}
    
     function cetak_laporan_tunggakan(){
		$p = $_GET['full'];
		$b = explode('-',$p);
		$pajak = $b[0];
		$tahun = $b[1];
		
		if($pajak==1){
			$qr = " and substring(no_sptpd,11,3) = 'HTL'";
			$p = 'HOTEL';
		} else if($pajak==2){
			$qr = " and substring(no_sptpd,11,3) = 'RES'";
			$p = 'RESTORAN';
		} else if($pajak==3){
			$qr = " and substring(no_sptpd,11,3) = 'REK'";
			$p = 'REKLAME';
		} else if($pajak==4){
			$qr = " and substring(no_sptpd,11,3) = 'HIB'";
			$p = 'HIBURAN';
		} else if($pajak==5){
			$qr = " and substring(no_sptpd,11,3) = 'LIS'";
			$p = 'PENERANGAN JALAN';
		} else if($pajak==6){
			$qr = " and substring(no_sptpd,11,3) = 'GAL'";
			$p = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($pajak==7){
			$qr = " and substring(no_sptpd,11,3) = 'WLT'";
			$p = 'BURUNG WALET';
		} else if($pajak==8){
			$qr = " and substring(no_sptpd,11,3) = 'PKR'";
			$p = 'PARKIR';
		} else if($pajak==9){
			$qr = " and substring(no_sptpd,11,3) = 'AIR'";
			$p = 'AIR TANAH';
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(0,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN TUNGGAKAN / PIUTANG PAJAK BERDASARKAN SPTPD '.$p.' TAHUN '.$b[1].'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td rowspan="2" width="20" height="10" align="center"><strong>NO.</strong></td>
					<td rowspan="2" width="80" height="10" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td rowspan="2" width="100" height="12" align="center"><strong>ALAMAT WAJIB PAJAK</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td colspan="6" width="540" height="12" align="center"><strong>BULAN</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>
				<tr>
					<td width="45" height="12" align="center"><strong>JANUARI</strong></td>
					<td width="45" height="12" align="center"><strong>FEBRUARI</strong></td>
					<td width="45" height="12" align="center"><strong>MARET</strong></td>
					<td width="45" height="12" align="center"><strong>APRIL</strong></td>
					<td width="45" height="12" align="center"><strong>MEI</strong></td>
					<td width="45" height="12" align="center"><strong>JUNI</strong></td>
					<td width="45" height="12" align="center"><strong>JULI</strong></td>
					<td width="45" height="12" align="center"><strong>AGUSTUS</strong></td>
					<td width="45" height="12" align="center"><strong>SEPTEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>OKTOBER</strong></td>
					<td width="45" height="12" align="center"><strong>NOVEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>DESEMBER</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN SPTPD ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE year(sptpd.tanggal) = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan ");
		
		$i=1;
		$piutang = 0;
		$s1 = 0;
		$s2 = 0;
		$s3 = 0;
		$s4 = 0;
		$s5 = 0;
		$s6 = 0;
		$s7 = 0;
		$s8 = 0;
		$s9 = 0;
		$s10 = 0;
		$s11 = 0;
		$s12 = 0;
		$st = 0;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT (SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' AND tahun < '".$tahun."' and status=0 $qr) as piutang,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun = '".$tahun."' and status=0 $qr) as s_1,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun = '".$tahun."' and status=0 $qr) as s_2,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun = '".$tahun."' and status=0 $qr) as s_3,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun = '".$tahun."' and status=0 $qr) as s_4,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun = '".$tahun."' and status=0 $qr) as s_5,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun = '".$tahun."' and status=0 $qr) as s_6,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun = '".$tahun."' and status=0 $qr) as s_7,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun = '".$tahun."' and status=0 $qr) as s_8,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun = '".$tahun."' and status=0 $qr) as s_9,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun = '".$tahun."' and status=0 $qr) as s_10,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun = '".$tahun."' and status=0 $qr) as s_11,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun = '".$tahun."' and status=0 $qr) as s_12
FROM sptpd")->row();
			$jum = $detail->piutang+$detail->s_1+$detail->s_2+$detail->s_3+$detail->s_4+$detail->s_5+$detail->s_6+$detail->s_7+$detail->s_8+$detail->s_9+$detail->s_10+$detail->s_11+$detail->s_12;
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="10" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="45" height="12" align="right">'.number_format($detail->piutang,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_1,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_2,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_3,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_4,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_5,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_6,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_7,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_8,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_9,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_10,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_11,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_12,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($jum,2,",",".").'&nbsp;</td>
				</tr>';
				
				$piutang = $piutang + $detail->piutang;
				$s1 = $s1 + $detail->s_1;
				$s2 = $s2 + $detail->s_2;
				$s3 = $s3 + $detail->s_3;
				$s4 = $s4 + $detail->s_4;
				$s5 = $s5 + $detail->s_5;
				$s6 = $s6 + $detail->s_6;
				$s7 = $s7 + $detail->s_7;
				$s8 = $s8 + $detail->s_8;
				$s9 = $s9 + $detail->s_9;
				$s10 = $s10 + $detail->s_10;
				$s11 = $s11 + $detail->s_11;
				$s12 = $s12 + $detail->s_12;
				$st = $st + $jum;
			$i++;
		}
			$report .=
				'<tr>
					<td width="200" height="12" align="center"><strong>TOTAL</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($piutang,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s1,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s2,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s3,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s4,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s5,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s6,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s7,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s8,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s9,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s10,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s11,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s12,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($st,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>';
			
		$report .=
			'<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Realisasi'.'.pdf', 'I');
	}


    function cetak_realisasi_denda(){
		$p = $_GET['full'];
		$b = explode('-',$p);
		$pajak = $b[0];
		$tahun = $b[1];
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
			$p = 'HOTEL';
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
			$p = 'RESTORAN';
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
			$p = 'REKLAME';
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
			$p = 'HIBURAN';
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
			$p = 'PENERANGAN JALAN';
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
			$p = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
			$p = 'BURUNG WALET';
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
			$p = 'PARKIR';
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
			$p = 'AIR TANAH';
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(0,30,0);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN REALISASI PENERIMAAN DENDA PAJAK '.$p.' TAHUN '.$b[1].'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td rowspan="2" width="20" height="10" align="center"><strong>NO.</strong></td>
					<td rowspan="2" width="80" height="10" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td rowspan="2" width="100" height="12" align="center"><strong>ALAMAT WAJIB PAJAK</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td colspan="6" width="540" height="12" align="center"><strong>BULAN</strong></td>
					<td rowspan="2" width="45" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>
				<tr>
					<td width="45" height="12" align="center"><strong>JANUARI</strong></td>
					<td width="45" height="12" align="center"><strong>FEBRUARI</strong></td>
					<td width="45" height="12" align="center"><strong>MARET</strong></td>
					<td width="45" height="12" align="center"><strong>APRIL</strong></td>
					<td width="45" height="12" align="center"><strong>MEI</strong></td>
					<td width="45" height="12" align="center"><strong>JUNI</strong></td>
					<td width="45" height="12" align="center"><strong>JULI</strong></td>
					<td width="45" height="12" align="center"><strong>AGUSTUS</strong></td>
					<td width="45" height="12" align="center"><strong>SEPTEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>OKTOBER</strong></td>
					<td width="45" height="12" align="center"><strong>NOVEMBER</strong></td>
					<td width="45" height="12" align="center"><strong>DESEMBER</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_transaksi = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan ");
		
		$i=1;
		$piutang = 0;
		$s1 = 0;
		$s2 = 0;
		$s3 = 0;
		$s4 = 0;
		$s5 = 0;
		$s6 = 0;
		$s7 = 0;
		$s8 = 0;
		$s9 = 0;
		$s10 = 0;
		$s11 = 0;
		$s12 = 0;
		$st = 0;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT (SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_transaksi < '".$tahun."' $qr) as piutang,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '01' AND tahun_transaksi = '".$tahun."' $qr) as s_1,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '02' AND tahun_transaksi = '".$tahun."' $qr) as s_2,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '03' AND tahun_transaksi = '".$tahun."' $qr) as s_3,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '04' AND tahun_transaksi = '".$tahun."' $qr) as s_4,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '05' AND tahun_transaksi = '".$tahun."' $qr) as s_5,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '06' AND tahun_transaksi = '".$tahun."' $qr) as s_6,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '07' AND tahun_transaksi = '".$tahun."' $qr) as s_7,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '08' AND tahun_transaksi = '".$tahun."' $qr) as s_8,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '09' AND tahun_transaksi = '".$tahun."' $qr) as s_9,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '10' AND tahun_transaksi = '".$tahun."' $qr) as s_10,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '11' AND tahun_transaksi = '".$tahun."' $qr) as s_11,
(SELECT sum(DENDA) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '12' AND tahun_transaksi = '".$tahun."' $qr) as s_12
FROM sspd")->row();
			$jum = $detail->piutang+$detail->s_1+$detail->s_2+$detail->s_3+$detail->s_4+$detail->s_5+$detail->s_6+$detail->s_7+$detail->s_8+$detail->s_9+$detail->s_10+$detail->s_11+$detail->s_12;
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="10" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="45" height="12" align="right">'.number_format($detail->piutang,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_1,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_2,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_3,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_4,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_5,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_6,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_7,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_8,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_9,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_10,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_11,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($detail->s_12,2,",",".").'&nbsp;</td>
					<td width="45" height="12" align="right">'.number_format($jum,2,",",".").'&nbsp;</td>
				</tr>';
				
				$piutang = $piutang + $detail->piutang;
				$s1 = $s1 + $detail->s_1;
				$s2 = $s2 + $detail->s_2;
				$s3 = $s3 + $detail->s_3;
				$s4 = $s4 + $detail->s_4;
				$s5 = $s5 + $detail->s_5;
				$s6 = $s6 + $detail->s_6;
				$s7 = $s7 + $detail->s_7;
				$s8 = $s8 + $detail->s_8;
				$s9 = $s9 + $detail->s_9;
				$s10 = $s10 + $detail->s_10;
				$s11 = $s11 + $detail->s_11;
				$s12 = $s12 + $detail->s_12;
				$st = $st + $jum;
			$i++;
		}
			$report .=
				'<tr>
					<td width="200" height="12" align="center"><strong>TOTAL</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($piutang,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s1,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s2,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s3,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s4,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s5,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s6,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s7,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s8,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s9,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s10,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s11,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($s12,2,",",".").'&nbsp;</strong></td>
					<td width="45" height="12" align="right"><strong>'.number_format($st,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>';
			
		$report .=
			'<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Realisasi'.'.pdf', 'I');
	}
	

    
	function data_realisasi($pajak="",$tahun=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}

        
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
		} else if($pajak==NULL){
			$qr = '';
		}
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_transaksi = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT 
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_transaksi < '".$tahun."' $qr) as piutang,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '01' AND tahun_transaksi = '".$tahun."' $qr) as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '02' AND tahun_transaksi = '".$tahun."' $qr) as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '03' AND tahun_transaksi = '".$tahun."' $qr) as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '04' AND tahun_transaksi = '".$tahun."' $qr) as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '05' AND tahun_transaksi = '".$tahun."' $qr) as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '06' AND tahun_transaksi = '".$tahun."' $qr) as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '07' AND tahun_transaksi = '".$tahun."' $qr) as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '08' AND tahun_transaksi = '".$tahun."' $qr) as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '09' AND tahun_transaksi = '".$tahun."' $qr) as s_9,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '10' AND tahun_transaksi = '".$tahun."' $qr) as s_10,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '11' AND tahun_transaksi = '".$tahun."' $qr) as s_11,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '12' AND tahun_transaksi = '".$tahun."' $qr) as s_12
FROM sspd")->row();

			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$detail->piutang."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_1."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_2."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_3."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_4."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_5."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_6."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_7."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_8."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_9."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_10."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_11."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_12."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
    
     function data_laporan_tunggakan($pajak="",$tahun=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}

        
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==1){
			$qr = " and substring(no_sptpd,11,3) = 'HTL'";
		} else if($pajak==2){
			$qr = " and substring(no_sptpd,11,3) = 'RES'";
		} else if($pajak==3){
			$qr = " and substring(no_sptpd,11,3) = 'REK'";
		} else if($pajak==4){
			$qr = " and substring(no_sptpd,11,3) = 'HIB'";
		} else if($pajak==5){
			$qr = " and substring(no_sptpd,11,3) = 'LIS'";
		} else if($pajak==6){
			$qr = " and substring(no_sptpd,11,3) = 'GAL'";
		} else if($pajak==7){
			$qr = " and substring(no_sptpd,11,3) = 'WLT'";
		} else if($pajak==8){
			$qr = " and substring(no_sptpd,11,3) = 'PKR'";
		} else if($pajak==9){
			$qr = " and substring(no_sptpd,11,3) = 'AIR'";
		} else if($pajak==NULL){
			$qr = '';
		}
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE year(sptpd.tanggal) = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT 
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' AND tahun < '".$tahun."' $qr and status = 0 ) as piutang,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun = '".$tahun."' and status = 0 $qr  ) as s_1,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun = '".$tahun."' and status = 0 $qr) as s_2,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun = '".$tahun."' and status = 0 $qr) as s_3,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun = '".$tahun."' and status = 0 $qr) as s_4,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun = '".$tahun."' and status = 0 $qr) as s_5,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun = '".$tahun."' and status = 0 $qr) as s_6,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun = '".$tahun."' and status = 0 $qr) as s_7,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun = '".$tahun."' and status = 0 $qr) as s_8,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun = '".$tahun."' and status = 0 $qr) as s_9,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun = '".$tahun."' and status = 0 $qr) as s_10,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun = '".$tahun."' and status = 0 $qr) as s_11,
(SELECT sum(jumlah) FROM sptpd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun = '".$tahun."' and status = 0 $qr) as s_12
FROM sptpd")->row();

			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$detail->piutang."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_1."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_2."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_3."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_4."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_5."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_6."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_7."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_8."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_9."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_10."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_11."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_12."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}

    
    function data_realisasi_denda($pajak="",$tahun=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}

        
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
		} else if($pajak==NULL){
			$qr = '';
		}
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_transaksi = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT 
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_transaksi < '".$tahun."' $qr) as piutang,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '01' AND tahun_transaksi = '".$tahun."' $qr) as s_1,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '02' AND tahun_transaksi = '".$tahun."' $qr) as s_2,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '03' AND tahun_transaksi = '".$tahun."' $qr) as s_3,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '04' AND tahun_transaksi = '".$tahun."' $qr) as s_4,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '05' AND tahun_transaksi = '".$tahun."' $qr) as s_5,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '06' AND tahun_transaksi = '".$tahun."' $qr) as s_6,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '07' AND tahun_transaksi = '".$tahun."' $qr) as s_7,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '08' AND tahun_transaksi = '".$tahun."' $qr) as s_8,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '09' AND tahun_transaksi = '".$tahun."' $qr) as s_9,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '10' AND tahun_transaksi = '".$tahun."' $qr) as s_10,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '11' AND tahun_transaksi = '".$tahun."' $qr) as s_11,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and month(tanggal) = '12' AND tahun_transaksi = '".$tahun."' $qr) as s_12
FROM sspd")->row();

			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$detail->piutang."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_1."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_2."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_3."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_4."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_5."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_6."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_7."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_8."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_9."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_10."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_11."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_12."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
    
    function data_realisasi_sptpd($pajak="",$tahun=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
       
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
        
        
        	if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
		} else if($pajak==NULL){
			$qr = '';
		}
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_pajak = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT 
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_pajak < '".$tahun."' $qr) as piutang,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun_pajak = '".$tahun."' $qr) as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun_pajak = '".$tahun."' $qr) as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun_pajak = '".$tahun."' $qr) as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun_pajak = '".$tahun."' $qr) as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun_pajak = '".$tahun."' $qr) as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun_pajak = '".$tahun."' $qr) as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun_pajak = '".$tahun."' $qr) as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun_pajak = '".$tahun."' $qr) as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun_pajak = '".$tahun."' $qr) as s_9,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun_pajak = '".$tahun."' $qr) as s_10,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun_pajak = '".$tahun."' $qr) as s_11,
(SELECT sum(ketetapan) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun_pajak = '".$tahun."' $qr) as s_12
FROM sspd")->row();

			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$detail->piutang."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_1."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_2."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_3."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_4."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_5."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_6."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_7."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_8."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_9."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_10."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_11."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_12."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
    
        function data_realisasi_sptpd_denda($pajak="",$tahun=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
       
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
        
        
        	if($pajak==1){
			$qr = " and kode_pajak = 'HTL'";
		} else if($pajak==2){
			$qr = " and kode_pajak = 'RES'";
		} else if($pajak==3){
			$qr = " and kode_pajak = 'REK'";
		} else if($pajak==4){
			$qr = " and kode_pajak = 'HIB'";
		} else if($pajak==5){
			$qr = " and kode_pajak = 'LIS'";
		} else if($pajak==6){
			$qr = " and kode_pajak = 'GAL'";
		} else if($pajak==7){
			$qr = " and kode_pajak = 'WLT'";
		} else if($pajak==8){
			$qr = " and kode_pajak = 'PKR'";
		} else if($pajak==9){
			$qr = " and kode_pajak = 'AIR'";
		} else if($pajak==NULL){
			$qr = '';
		}
		
		$sql = $this->db->query("SELECT DISTINCT(view_perusahaan.npwpd_perusahaan) AS npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan FROM view_perusahaan LEFT JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd WHERE sspd.tahun_pajak = '".$tahun."' $qr order by view_perusahaan.nama_perusahaan");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$npwpd = $rs->npwpd_perusahaan;
		
		$detail = $this->db->query("SELECT 
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' AND tahun_pajak < '".$tahun."' $qr) as piutang,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '01' AND tahun_pajak = '".$tahun."' $qr) as s_1,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '02' AND tahun_pajak = '".$tahun."' $qr) as s_2,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '03' AND tahun_pajak = '".$tahun."' $qr) as s_3,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '04' AND tahun_pajak = '".$tahun."' $qr) as s_4,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '05' AND tahun_pajak = '".$tahun."' $qr) as s_5,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '06' AND tahun_pajak = '".$tahun."' $qr) as s_6,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '07' AND tahun_pajak = '".$tahun."' $qr) as s_7,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '08' AND tahun_pajak = '".$tahun."' $qr) as s_8,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '09' AND tahun_pajak = '".$tahun."' $qr) as s_9,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '10' AND tahun_pajak = '".$tahun."' $qr) as s_10,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '11' AND tahun_pajak = '".$tahun."' $qr) as s_11,
(SELECT sum(denda) FROM sspd WHERE npwpd = '".$npwpd."' and masa_pajak1 = '12' AND tahun_pajak = '".$tahun."' $qr) as s_12
FROM sspd")->row();

			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$detail->piutang."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_1."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_2."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_3."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_4."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_5."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_6."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_7."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_8."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_9."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_10."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_11."]]></cell>");
					echo("<cell><![CDATA[".$detail->s_12."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}

    
	function rekon(){
		$data['bulan'] = $this->msistem->bulan();
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/rekon',$data);
	}
	
	function data_rekon($bayar="",$periode="",$akhir=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$p = explode('-',$periode);
		
		$akumulasi = 0;
		for($tgl=1;$tgl<=$akhir;$tgl++){
			if(strlen($tgl)=='1') { 
				$tgl1 = '0'.$tgl.'/'.$p[1].'/'.$p[0];
			} else {
				$tgl1 = $tgl.'/'.$p[1].'/'.$p[0];
			}
			
			$time = $periode.'-'.$tgl;
			$sql = $this->db->query("SELECT DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.pembayaran, sum(sspd.setoran) as setoran FROM sspd where sspd.tanggal = '".$time."' and sspd.pembayaran = '".$bayar."' order by sspd.tanggal asc")->row();
			
			if($sql->setoran==NULL){
				$sql->setoran = 0;
			}
			
			if($bayar=='1'){
				$bay = 'LOKET';
			} else if($bayar=='200'){
				$bay = 'BANK NAGARI';
			} else if($bayar=='300'){
				$bay = 'BANK BTN';
			} else if($bayar=='0009'){
				$bay = 'BANK BNI';
			}			
			// cair
			echo ("<row id='".$tgl."'>");
				echo("<cell><![CDATA[".$tgl1."]]></cell>");
				echo("<cell><![CDATA[".$bay."]]></cell>");
				echo("<cell><![CDATA[".$sql->setoran."]]></cell>");
				$selisih = $sql->setoran;
				$akumulasi = $akumulasi + $sql->setoran;
				echo("<cell><![CDATA[".$selisih."]]></cell>");
				echo("<cell><![CDATA[".$akumulasi."]]></cell>");
			echo("</row>");
		}
		echo "</rows>";
	}
	
	function excel_rekon(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_rekon',$data);
	}
	
	function cetak_rekon(){
		$p = $_GET['full'];
		$d = explode('|',$p);
		$bayar = $d[0];
		$periode = $d[1];
		$akhir = $d[2];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->msistem->v_bln($bln);
		
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
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(120,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2>LAPORAN REKONSILIASI PAJAK DAERAH BULAN '.strtoupper($bulan).' TAHUN '.$thn.'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="65" height="10" align="center"><strong>TANGGAL PEMBAYARAN</strong></td>
					<td width="65" height="12" align="center"><strong>TYPE PEMBAYARAN</strong></td>
					<td width="70" height="12" align="center"><strong>SETORAN</strong></td>
					<td width="70" height="12" align="center"><strong>SELISIH</strong></td>
					<td width="70" height="12" align="center"><strong>AKUMULASI</strong></td>
				</tr>';
		
		$akumulasi = 0;
		$a = 0;
		$b = 0;
		for($tgl=1;$tgl<=$akhir;$tgl++){
			if(strlen($tgl)=='1') { 
				$tgl1 = '0'.$tgl.'/'.$bln.'/'.$thn;
			} else {
				$tgl1 = $tgl.'/'.$bln.'/'.$thn;
			}
			
			$time = $periode.'-'.$tgl;
			$sql = $this->db->query("SELECT DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.pembayaran, sum(sspd.setoran) as setoran FROM sspd where sspd.tanggal = '".$time."' and sspd.pembayaran = '".$bayar."' order by sspd.tanggal asc")->row();
			
			if($sql->setoran==NULL){
				$sql->setoran = 0;
			}
			
			if($bayar=='1'){
				$bay = 'LOKET';
			} else if($bayar=='200'){
				$bay = 'BANK NAGARI';
			} else if($bayar=='300'){
				$bay = 'BANK BTN';
			} else if($bayar=='0009'){
				$bay = 'BANK BNI';
			}
			
			$selisih = $sql->setoran;
			$akumulasi = $akumulasi + $sql->setoran;
				
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$tgl.'</td>
					<td width="65" height="10" align="center">'.$tgl1.'</td>
					<td width="65" height="12" align="center">'.$bay.'</td>
					<td width="70" height="12" align="right">'.number_format($sql->setoran,2,",",".").'&nbsp;</td>
					<td width="70" height="12" align="right">'.number_format($selisih,2,",",".").'&nbsp;</td>
					<td width="70" height="12" align="right">'.number_format($akumulasi,2,",",".").'&nbsp;</td>
				</tr>';
				$a = $a + $sql->setoran;
				$b = $b + $selisih;
		}
		
		$report .=
				'<tr>
					<td width="150" height="10" colspan="2" align="center"><strong>TOTAL</strong></td>
					<td width="70" height="12" align="right"><strong>'.number_format($a,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="right"><strong>'.number_format($b,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="right"></td>
				</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Rekonsiliasi'.'.pdf', 'I');
	}
	
	function bsel(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd NOT IN ('REK','AIR')");
		$this->load->view('report_pajak/bsel',$data);
	}
	
	function data_bsel($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sptpd.no_sptpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl, sptpd.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sptpd.jumlah, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd where sptpd.status = '0' and sptpd.tanggal >= '".$awal."' and sptpd.tanggal <= '".$akhir."' $qr");
		
		$i=1;
		foreach($sql->result() as $rs) {
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			$ket = 'TUNGGAKAN';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$awal." - ".$akhir." ".$rs->tahun."]]></cell>");
					echo("<cell><![CDATA[".$ket."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function excel_bsel(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_bsel',$data);
	}
	
	public function cetak_bsel(){
		$full = $_GET['full'];
		$p = explode('|',$full);
		$awal = $p[0];
		$t = explode('-',$awal);
		$tgl1 = $t[2].'/'.$t[1].'/'.$t[0];
		
		$akhir = $p[1];
		$s = explode('-',$akhir);
		$tgl2 = $s[2].'/'.$s[1].'/'.$s[0];
		
		$pajak = $p[2];
		if($pajak == NULL){
			$nm_pajak = 'Semua Pajak';
		} else {
			$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
			$nm_pajak = $cari->nama_sptpd;
		}
			
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(15,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<table>
				<tr>
					<td><h2 align="center">Laporan SPTPD Belum Bayar (Self Assesment)</h2>
						<p align="center">Periode : '.$tgl1.' s/d '.$tgl2.'</p>
						<p align="center">Jenis Pajak : '.$nm_pajak.'</p></td>
				</tr>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="20" height="15" align="center"><strong>NO.</strong></td>
					<td width="55" height="15" align="center"><strong>TANGGAL</strong></td>
					<td width="80" height="15" align="center"><strong>NO. SPTPD</strong></td>
					<td width="80" height="15" align="center"><strong>NPWPD</strong></td>
					<td width="140" height="15" align="center"><strong>WAJIB PAJAK</strong></td>
					<td width="160" height="15" align="center"><strong>ALAMAT</strong></td>
					<td width="105" height="15" align="center"><strong>MASA PAJAK</strong></td>
					<td width="105" height="15" align="center"><strong>KETETAPAN</strong></td>
					<td width="70" height="15" align="center"><strong>KETERANGAN</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sptpd.no_sptpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl, sptpd.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sptpd.jumlah, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd where sptpd.status = '0' and sptpd.tanggal >= '".$awal."' and sptpd.tanggal <= '".$akhir."' $qr");
		$no = 1;
		$tsetor = 0;
		foreach($sql->result() as $rs){
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			$ket = 'TUNGGAKAN';
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
					<td width="55" height="15" align="center">'.$rs->tgl.'</td>
					<td width="80" height="15" align="center">'.$rs->no_sptpd.'</td>
					<td width="80" height="15" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="140" height="15" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="160" height="15" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="105" height="15" align="center">'.$awal.'-'.$akhir.' '.$rs->tahun.'</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->jumlah,2,",",".").'&nbsp;</td>
					<td width="70" height="15" align="center">'.$ket.'</td>
				</tr>';
				$tsetor = $tsetor + $rs->jumlah;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="640" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($tsetor,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="15" align="right"><strong></strong></td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD_Belum_Bayar'.'.pdf', 'I');
	}
	
	function ssel(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd NOT IN ('REK','AIR')");
		$this->load->view('report_pajak/ssel', $data);
	}
	
	function data_sself($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sptpd.no_sptpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl, sptpd.no_sptpd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.no_sspd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sspd.ketetapan, sspd.setoran, sspd.denda FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd INNER JOIN sspd ON sptpd.no_sptpd = sspd.nomor where sptpd.tanggal >= '".$awal."' and sptpd.tanggal <= '".$akhir."' and sptpd.status = '1' $qr");
	
		$i=1;
		foreach($sql->result() as $rs) {
			
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
					echo("<cell><![CDATA[".$rs->denda."]]></cell>");
					echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function excel_ssel(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ssel',$data);
	}
	
	public function cetak_ssel(){
		$full = $_GET['full'];
		$p = explode('|',$full);
		$awal = $p[0];
		$t = explode('-',$awal);
		$tgl1 = $t[2].'/'.$t[1].'/'.$t[0];
		
		$akhir = $p[1];
		$s = explode('-',$akhir);
		$tgl2 = $s[2].'/'.$s[1].'/'.$s[0];
		
		$pajak = $p[2];
		if($pajak == NULL){
			$nm_pajak = 'Semua Pajak';
		} else {
			$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
			$nm_pajak = $cari->nama_sptpd;
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<table>
				<tr>
					<td><h2 align="center">Laporan SPTPD Sudah Bayar (Self Assesment)</h2>
					<p align="center">Periode : '.$tgl1.' s/d '.$tgl2.'</p>
					<p align="center">Jenis Pajak : '.$nm_pajak.'</p></td>
				</tr>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td rowspan="2" width="20" height="15" align="center"><strong>NO.</strong></td>
					<td colspan="4" width="255" height="15" align="center"><strong>TANGGAL & NO. BUKTI</strong></td>
					<td rowspan="2" width="70" height="15" align="center"><strong>NPWPD</strong></td>
					<td rowspan="2" width="90" height="15" align="center"><strong>WAJIB PAJAK</strong></td>
					<td rowspan="2" width="150" height="15" align="center"><strong>ALAMAT</strong></td>
					<td rowspan="2" width="85" height="15" align="center"><strong>KETETAPAN</strong></td>
					<td rowspan="2" width="65" height="15" align="center"><strong>DENDA</strong></td>
					<td rowspan="2" width="85" height="15" align="center"><strong>REALISASI</strong></td>
				</tr>
				<tr>
					<td width="45" height="15" align="center">TGL SPTPD</td>
					<td width="80" height="15" align="center">NO. SPTPD</td>
					<td width="45" height="15" align="center">TGL SETOR</td>
					<td width="85" height="15" align="center">NO. SSPD</td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sptpd.no_sptpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl, sptpd.no_sptpd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.no_sspd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sspd.ketetapan, sspd.setoran, sspd.denda FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd INNER JOIN sspd ON sptpd.no_sptpd = sspd.nomor where sptpd.tanggal >= '".$awal."' and sptpd.tanggal <= '".$akhir."' and sptpd.status ='1' $qr");
		$no = 1;
		$tetap = 0;
		$tdenda = 0;
		$setor = 0;
		foreach($sql->result() as $rs){
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
		
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
					<td width="45" height="15" align="center">'.$rs->tgl.'</td>
					<td width="80" height="15" align="center">'.$rs->no_sptpd.'</td>
					<td width="45" height="15" align="center">'.$rs->tanggal.'</td>
					<td width="85" height="15" align="center">'.$rs->no_sspd.'</td>
					<td width="70" height="15" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="90" height="15" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="150" height="15" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="85" height="15" align="right">Rp. '.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
					<td width="65" height="15" align="right">Rp. '.number_format($rs->denda,2,",",".").'&nbsp;</td>
					<td width="85" height="15" align="right">Rp. '.number_format($rs->setoran,2,",",".").'&nbsp;</td>
				</tr>';
				$tetap = $tetap + $rs->ketetapan;
				$tdenda = $tdenda + $rs->denda;
				$setor = $setor + $rs->setoran;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="585" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="85" height="15" align="right"><strong>Rp. '.number_format($tetap,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="15" align="right"><strong>Rp. '.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
					<td width="85" height="15" align="right"><strong>Rp. '.number_format($setor,2,",",".").'&nbsp;</strong></td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD_Sudah_Bayar'.'.pdf', 'I');
	}
	
	function boff(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd where kode_sptpd in ('REK','AIR')");
		$this->load->view('report_pajak/boff', $data);
	}
	
	function data_belum($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and skpd.no_skpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(skpd.tgl,'%d/%m/%Y') as tgl, skpd.no_skpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, skpd.jumlah, DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') as tempo, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd where skpd.status = '0' and skpd.tgl_jth_tempo >= '".$awal."' and skpd.tgl_jth_tempo <= '".$akhir."' $qr");
	
		$i=1;
		foreach($sql->result() as $rs) {
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			$ket = 'TUNGGAKAN';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$rs->tempo."]]></cell>");
					echo("<cell><![CDATA[".$awal." - ".$akhir." ".$rs->tahun."]]></cell>");
					echo("<cell><![CDATA[".$ket."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function excel_belum(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_belum',$data);
	}
	
	public function cetak_belum(){
		$full = $_GET['full'];
		$p = explode('|',$full);
		$awal = $p[0];
		$t = explode('-',$awal);
		$tgl1 = $t[2].'/'.$t[1].'/'.$t[0];
		
		$akhir = $p[1];
		$s = explode('-',$akhir);
		$tgl2 = $s[2].'/'.$s[1].'/'.$s[0];
		
		$pajak = $p[2];
		if($pajak == NULL){
			$nm_pajak = 'Semua Pajak';
		} else {
			$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
			$nm_pajak = $cari->nama_sptpd;
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">Laporan SKP Belum Bayar (Official Assesment)</h2>
			<p align="center">Periode : '.$tgl1.' s/d '.$tgl2.'</p>
			<p align="center">Jenis Pajak : '.$nm_pajak.'</p>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="20" height="15" align="center"><strong>NO.</strong></td>
					<td width="55" height="15" align="center"><strong>TANGGAL</strong></td>
					<td width="80" height="15" align="center"><strong>NO. SKP</strong></td>
					<td width="80" height="15" align="center"><strong>NPWPD</strong></td>
					<td width="110" height="15" align="center"><strong>WAJIB PAJAK</strong></td>
					<td width="150" height="15" align="center"><strong>ALAMAT</strong></td>
					<td width="105" height="15" align="center"><strong>MASA PAJAK</strong></td>
					<td width="55" height="15" align="center"><strong>TANGGAL TEMPO</strong></td>
					<td width="95" height="15" align="center"><strong>KETETAPAN</strong></td>
					<td width="70" height="15" align="center"><strong>KETERANGAN</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and skpd.no_skpd like '%".$pajak."%'";
		}
		$sql = $this->db->query("SELECT DATE_FORMAT(skpd.tgl,'%d/%m/%Y') as tgl, skpd.no_skpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, skpd.jumlah, DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') as tempo, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd where skpd.status = '0' and skpd.tgl_jth_tempo >= '".$awal."' and skpd.tgl_jth_tempo <= '".$akhir."' $qr");
		$no = 1;
		$tsetor = 0;
		foreach($sql->result() as $rs){
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			$ket = 'TUNGGAKAN';
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
					<td width="55" height="15" align="center">'.$rs->tgl.'</td>
					<td width="80" height="15" align="center">'.$rs->no_skpd.'</td>
					<td width="80" height="15" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="110" height="15" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="150" height="15" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="105" height="15" align="center">'.$awal.'-'.$akhir.' '.$rs->tahun.'</td>
					<td width="55" height="15" align="center">'.$rs->tempo.'</td>
					<td width="95" height="15" align="right">Rp. '.number_format($rs->jumlah,2,",",".").'&nbsp;</td>
					<td width="70" height="15" align="center">'.$ket.'</td>
				</tr>';
				$tsetor = $tsetor + $rs->jumlah;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="655" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="95" height="15" align="right"><strong>Rp. '.number_format($tsetor,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="15" align="right"><strong></strong></td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKP_Belum_Bayar'.'.pdf', 'I');
	}
	
	function ketetapan(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd where kode_sptpd in ('REK','AIR')");
		$this->load->view('report_pajak/ketetapan', $data);
	}
	
	function data_tetap($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and skpd.no_skpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(skpd.tgl,'%d/%m/%Y') as tgl, skpd.no_skpd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.no_sspd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sspd.ketetapan, sspd.setoran, sspd.denda FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd INNER JOIN sspd ON skpd.no_skpd = sspd.nomor where skpd.tgl >= '".$awal."' and skpd.tgl <= '".$akhir."' $qr");
	
		$i=1;
		foreach($sql->result() as $rs) {
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
			
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
					echo("<cell><![CDATA[".$rs->denda."]]></cell>");
					echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function excel_tetap(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_tetap',$data);
	}
	
	public function cetak_tetap(){
		$full = $_GET['full'];
		$p = explode('|',$full);
		$awal = $p[0];
		$t = explode('-',$awal);
		$tgl1 = $t[2].'/'.$t[1].'/'.$t[0];
		
		$akhir = $p[1];
		$s = explode('-',$akhir);
		$tgl2 = $s[2].'/'.$s[1].'/'.$s[0];
		
		$pajak = $p[2];
		if($pajak == NULL){
			$nm_pajak = 'Semua Pajak';
		} else {
			$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
			$nm_pajak = $cari->nama_sptpd;
		}
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">Laporan SKP Sudah Bayar (Official Assesment)</h2>
			<p align="center">Periode : '.$tgl1.' s/d '.$tgl2.'</p>
			<p align="center">Jenis Pajak : '.$nm_pajak.'</p>';
			
		$report .=
			'<table border=1>
				<tr>
					<td rowspan="2" width="20" height="15" align="center"><strong>NO.</strong></td>
					<td colspan="4" width="255" height="15" align="center"><strong>TANGGAL & NO. BUKTI</strong></td>
					<td rowspan="2" width="70" height="15" align="center"><strong>NPWPD</strong></td>
					<td rowspan="2" width="90" height="15" align="center"><strong>WAJIB PAJAK</strong></td>
					<td rowspan="2" width="150" height="15" align="center"><strong>ALAMAT</strong></td>
					<td rowspan="2" width="85" height="15" align="center"><strong>KETETAPAN</strong></td>
					<td rowspan="2" width="65" height="15" align="center"><strong>DENDA</strong></td>
					<td rowspan="2" width="85" height="15" align="center"><strong>REALISASI</strong></td>
				</tr>
				<tr>
					<td width="45" height="15" align="center">TGL SKP</td>
					<td width="80" height="15" align="center">NO. SKP</td>
					<td width="45" height="15" align="center">TGL SETOR</td>
					<td width="85" height="15" align="center">NO. SSPD</td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and skpd.no_skpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(skpd.tgl,'%d/%m/%Y') as tgl, skpd.no_skpd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.no_sspd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sspd.ketetapan, sspd.setoran, sspd.denda FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd INNER JOIN sspd ON skpd.no_skpd = sspd.nomor where skpd.tgl >= '".$awal."' and skpd.tgl <= '".$akhir."' $qr");
		$no = 1;
		$tetap = 0;
		$tdenda = 0;
		$setor = 0;
		foreach($sql->result() as $rs){
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
		
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
					<td width="45" height="15" align="center">'.$rs->tgl.'</td>
					<td width="80" height="15" align="center">'.$rs->no_skpd.'</td>
					<td width="45" height="15" align="center">'.$rs->tanggal.'</td>
					<td width="85" height="15" align="center">'.$rs->no_sspd.'</td>
					<td width="70" height="15" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="90" height="15" align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td width="150" height="15" align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td width="85" height="15" align="right">Rp. '.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
					<td width="65" height="15" align="right">Rp. '.number_format($rs->denda,2,",",".").'&nbsp;</td>
					<td width="85" height="15" align="right">Rp. '.number_format($rs->setoran,2,",",".").'&nbsp;</td>
				</tr>';
				$tetap = $tetap + $rs->ketetapan;
				$tdenda = $tdenda + $rs->denda;
				$setor = $setor + $rs->setoran;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="585" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="85" height="15" align="right"><strong>Rp. '.number_format($tetap,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="15" align="right"><strong>Rp. '.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
					<td width="85" height="15" align="right"><strong>Rp. '.number_format($setor,2,",",".").'&nbsp;</strong></td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKP_Sudah_Bayar'.'.pdf', 'I');
	}
	
	public function kartu_data() {
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/kartu_data',$data);
	}
    
    public function kartu_data_berdasarkan_sptpd() {
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('report_pajak/kartu_data_berdasarkan_sptpd',$data);
	}

	
	public function data_card(){
		$npwpd = $this->input->post('npwpd');
		$sql = $this->db->query('select * from view_perusahaan where npwpd_perusahaan = "'.$npwpd.'"')->row();
		$gabung = $sql->npwpd_perusahaan.'|'.$sql->nama_perusahaan.'|'.$sql->alamat_perusahaan.'|'.$sql->nama_pemilik.'|'.$sql->alamat_pemilik.'|'.$sql->hp;
		echo $gabung;
	}
	
	public function data_kartu($npwpd="",$awal="",$akhir=""){
		//$aw = explode('-',$awal);
		//$awal = $aw[2].'-'.$aw[1].'-'.$aw[0];
		
		//$ak = explode('-',$akhir);
		//$akhir = $ak[2].'-'.$ak[1].'-'.$ak[0];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("SELECT sspd.no_sspd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.masa_pajak1, sspd.masa_pajak2, sspd.tahun_pajak, sspd.ketetapan, sspd.denda, sspd.setoran, sspd.keterangan FROM view_perusahaan INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where view_perusahaan.npwpd_perusahaan = '".$npwpd."' and sspd.tahun_pajak >= '".$awal."' and sspd.tahun_pajak <= '".$akhir."' order by sspd.tahun_pajak asc");
	
		$i=1;
		foreach($sql->result() as $rs) {
			
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
			$bulan1 = $this->msistem->v_bln($rs->masa_pajak1);		
			$bulan2 = $this->msistem->v_bln($rs->masa_pajak2);
			// cair
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$bulan1." - ".$bulan2."]]></cell>");
				echo("<cell><![CDATA[".$rs->tahun_pajak."]]></cell>");
				echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
				echo("<cell><![CDATA[".$rs->keterangan."]]></cell>");
			echo ("</row>");
			$i++;
		}
		echo "</rows>";
	}
    
    public function data_kartu_sptpd($npwpd="",$awal="",$akhir=""){
		//$aw = explode('-',$awal);
		//$awal = $aw[2].'-'.$aw[1].'-'.$aw[0];
		
		//$ak = explode('-',$akhir);
		//$akhir = $ak[2].'-'.$ak[1].'-'.$ak[0];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		//$sql = $this->db->query("SELECT sptpd.no_sptpd, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tanggal, sptpd.masa_pajak1, sptpd.masa_pajak2, sspd.tahun, sspd.ketetapan, sspd.denda, sspd.setoran, sspd.keterangan FROM view_perusahaan INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where view_perusahaan.npwpd_perusahaan = '".$npwpd."' and sspd.tahun_pajak >= '".$awal."' and sspd.tahun_pajak <= '".$akhir."' order by sspd.tahun_pajak asc");
	    $sql = $this->db->query("SELECT sptpd.no_sptpd,sspd.no_sspd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal, sptpd.masa_pajak1, 
sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah AS ketetapan, sspd.denda, sspd.setoran, IF(sptpd.status=1,'Sudah bayar','Belum Bayar') AS keterangan FROM view_perusahaan
INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd
LEFT OUTER JOIN sspd ON sptpd.no_sptpd=sspd.nomor  WHERE view_perusahaan.npwpd_perusahaan = '".$npwpd."'
AND sptpd.tahun >= '".$awal."' AND sptpd.tahun <= '".$akhir."' ORDER BY sptpd.tahun,sptpd.masa_pajak1 ASC
");   
		$i=1;
		foreach($sql->result() as $rs) {
			
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
			$bulan1 = $this->msistem->v_bln($rs->masa_pajak1);		
			$bulan2 = $this->msistem->v_bln($rs->masa_pajak2);
			// cair
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
                echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$bulan1." - ".$bulan2."]]></cell>");
				echo("<cell><![CDATA[".$rs->tahun."]]></cell>");
				echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
				echo("<cell><![CDATA[".$rs->keterangan."]]></cell>");
			echo ("</row>");
			$i++;
		}
		echo "</rows>";
	}
    
	public function cetak_kartu_sptpd(){
		$full = $_GET['full'];
		$p = explode('-',$full);
		$npwpd = $p[0];
		$awal = $p[1];
		$akhir = $p[2];
		
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
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$data = $this->db->query("select * from view_perusahaan where npwpd_perusahaan = '".$npwpd."'")->row();
        
		$report = '';
		$report .=
			'<h2 align="center">KARTU DATA WAJIB PAJAK BERDASARKAN SPTPD</h2>
			<p align="center"><font size="11">'.$data->nama_perusahaan.'<br>'.$data->alamat_perusahaan.'</font></p>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="20" height="15" align="center"><strong>NO.</strong></td>
                    <td width="90" height="15" align="center"><strong>NO. SPTPD</strong></td>
					<td width="90" height="15" align="center"><strong>NO. SSPD</strong></td>
					<td width="55" height="15" align="center"><strong>TGL</strong></td>
					<td width="85" height="15" align="center"><strong>MASA PAJAK</strong></td>
					<td width="45" height="15" align="center"><strong>TAHUN</strong></td>
					<td width="105" height="15" align="center"><strong>JUMLAH PAJAK</strong></td>
					<td width="105" height="15" align="center"><strong>DENDA</strong></td>
					<td width="105" height="15" align="center"><strong>REALISASI</strong></td>
					<td width="95" height="15" align="center"><strong>KET</strong></td>
				</tr>';
		
		//$sql = $this->db->query("SELECT sspd.no_sspd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.masa_pajak1, sspd.masa_pajak2, sspd.tahun_pajak, sspd.ketetapan, sspd.denda, sspd.setoran, sspd.keterangan FROM view_perusahaan INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where view_perusahaan.npwpd_perusahaan = '".$npwpd."' and sspd.tahun_pajak >= '".$awal."' and sspd.tahun_pajak <= '".$akhir."' order by sspd.tahun_pajak asc");
		  $sql = $this->db->query("SELECT sptpd.no_sptpd,sspd.no_sspd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal, sptpd.masa_pajak1, 
sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah AS ketetapan, sspd.denda, sspd.setoran, IF(sptpd.status=1,'Sudah bayar','Belum Bayar') AS keterangan FROM view_perusahaan
INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd
LEFT OUTER JOIN sspd ON sptpd.no_sptpd=sspd.nomor  WHERE view_perusahaan.npwpd_perusahaan = '".$npwpd."'
AND sptpd.tahun >= '".$awal."' AND sptpd.tahun <= '".$akhir."' ORDER BY sptpd.tahun,sptpd.masa_pajak1 ASC");   
      
        $no = 1;
		$tetap = 0;
		$tdenda = 0;
		$setor = 0;
		foreach($sql->result() as $rs){
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
		
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
                    <td width="90" height="15" align="center">'.$rs->no_sptpd.'</td>
					<td width="90" height="15" align="center">'.$rs->no_sspd.'</td>
					<td width="55" height="15" align="center">'.$rs->tanggal.'</td>
					<td width="85" height="15" align="center">'.$awal.' - '.$akhir.'</td>
					<td width="45" height="15" align="center">'.$rs->tahun.'</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->denda,2,",",".").'&nbsp;</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->setoran,2,",",".").'&nbsp;</td>
					<td width="95" height="15" align="center">'.$rs->keterangan.'</td>
				</tr>';
				$tetap = $tetap + $rs->ketetapan;
				$tdenda = $tdenda + $rs->denda;
				$setor = $setor + $rs->setoran;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="385" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($tetap,2,",",".").'&nbsp;</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($setor,2,",",".").'&nbsp;</strong></td>
					<td width="95" height="15" align="center">&nbsp;</td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" width="705" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Kartu_Data'.'.pdf', 'I');
	}

	
	public function cetak_kartu(){
		$full = $_GET['full'];
		$p = explode('-',$full);
		$npwpd = $p[0];
		$awal = $p[1];
		$akhir = $p[2];
		
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
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(10,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$data = $this->db->query("select * from view_perusahaan where npwpd_perusahaan = '".$npwpd."'")->row();
		$report = '';
		$report .=
			'<h2 align="center">KARTU DATA WAJIB PAJAK</h2>
			<p align="center"><font size="11">'.$data->nama_perusahaan.'<br>'.$data->alamat_perusahaan.'</font></p>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="20" height="15" align="center"><strong>NO.</strong></td>
					<td width="90" height="15" align="center"><strong>NO. SSPD</strong></td>
					<td width="55" height="15" align="center"><strong>TGL</strong></td>
					<td width="85" height="15" align="center"><strong>MASA PAJAK</strong></td>
					<td width="45" height="15" align="center"><strong>TAHUN</strong></td>
					<td width="105" height="15" align="center"><strong>JUMLAH PAJAK</strong></td>
					<td width="105" height="15" align="center"><strong>DENDA</strong></td>
					<td width="105" height="15" align="center"><strong>REALISASI</strong></td>
					<td width="95" height="15" align="center"><strong>KET</strong></td>
				</tr>';
		
		$sql = $this->db->query("SELECT sspd.no_sspd, DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.masa_pajak1, sspd.masa_pajak2, sspd.tahun_pajak, sspd.ketetapan, sspd.denda, sspd.setoran, sspd.keterangan FROM view_perusahaan INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where view_perusahaan.npwpd_perusahaan = '".$npwpd."' and sspd.tahun_pajak >= '".$awal."' and sspd.tahun_pajak <= '".$akhir."' order by sspd.tahun_pajak asc");
		$no = 1;
		$tetap = 0;
		$tdenda = 0;
		$setor = 0;
		foreach($sql->result() as $rs){
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			//$denda = ($rs->ketetapan*$rs->kurang)/100;
		
		$report .=
				'<tr>
					<td width="20" height="15" align="center">'.$no.'</td>
					<td width="90" height="15" align="center">'.$rs->no_sspd.'</td>
					<td width="55" height="15" align="center">'.$rs->tanggal.'</td>
					<td width="85" height="15" align="center">'.$awal.' - '.$akhir.'</td>
					<td width="45" height="15" align="center">'.$rs->tahun_pajak.'</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->denda,2,",",".").'&nbsp;</td>
					<td width="105" height="15" align="right">Rp. '.number_format($rs->setoran,2,",",".").'&nbsp;</td>
					<td width="95" height="15" align="center">'.$rs->keterangan.'</td>
				</tr>';
				$tetap = $tetap + $rs->ketetapan;
				$tdenda = $tdenda + $rs->denda;
				$setor = $setor + $rs->setoran;
			$no++;
		}
		
		$report .=
				'<tr>
					<td width="295" height="15" align="center"><strong>Jumlah</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($tetap,2,",",".").'&nbsp;</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
					<td width="105" height="15" align="right"><strong>Rp. '.number_format($setor,2,",",".").'&nbsp;</strong></td>
					<td width="95" height="15" align="center">&nbsp;</td>
				</tr>';
				
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		
		$s2 = $this->db->query("select nama, nip from admin where id_modul = '5'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama;
			$nip2 = $s2->nip;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
		if($s3==NULL){
			$nama3 = '';
			$nip3 = '';
			$bagian3 = '';
		} else {
			$nama3 = $s3->nama;
			$nip3 = $s3->nip;
			$bagian3 = $s3->bagian;
		}
		
		$t = date('d');
		$b = $this->msistem->v_bln(date('m'));
		$y = date('Y');
		
		$report .=
			'<table border="0" width="705" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
					<td>Meulaboh, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>Kepala Bidang Pendapatan</td>
					<td>Kasi Penagihan</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td>'.$nama1.'</td>
					<td>'.$nama2.'</td>
					<td>'.$nama3.'</td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
			</table>';
			
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Kartu_Data'.'.pdf', 'I');
	}
	
	public function realisasi_bln(){
		$data['tahun'] = $this->msistem->tahun();
		$data['bulan'] = $this->msistem->bulan();
		$this->load->view('report_pajak/tetap_self',$data);
	}
	
	public function bln_data($periode="",$akhir=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$p = explode('-',$periode);
		
		$akumulasi = 0;
		for($tgl=1;$tgl<=$akhir;$tgl++){
			if(strlen($tgl)=='1') { 
				$tgl1 = '0'.$tgl.'/'.$p[1].'/'.$p[0];
			} else {
				$tgl1 = $tgl.'/'.$p[1].'/'.$p[0];
			}
			
			$time = $periode.'-'.$tgl;
		
			$sql = $this->db->query("SELECT
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'HTL') as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'RES') as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'REK') as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'HIB') as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'LIS') as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'GAL') as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'PKR') as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'WLT') as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'AIR') as s_9
FROM sspd")->row();
			$s_1 = $sql->s_1;
			if($s_1==0){
				$s_1 = 0;
			}
			
			$s_2 = $sql->s_2;
			if($s_2==0){
				$s_2 = 0;
			}
			
			$s_3 = $sql->s_3;
			if($s_3==0){
				$s_3 = 0;
			}
			
			$s_4 = $sql->s_4;
			if($s_4==0){
				$s_4 = 0;
			}
			
			$s_5 = $sql->s_5;
			if($s_5==0){
				$s_5 = 0;
			}
			
			$s_6 = $sql->s_6;
			if($s_6==0){
				$s_6 = 0;
			}
			
			$s_7 = $sql->s_7;
			if($s_7==0){
				$s_7 = 0;
			}
			
			$s_8 = $sql->s_8;
			if($s_8==0){
				$s_8 = 0;
			}
			
			$s_9 = $sql->s_9;
			if($s_9==0){
				$s_9 = 0;
			}
			
			$t = $sql->s_1+$sql->s_2+$sql->s_3+$sql->s_4+$sql->s_5+$sql->s_6+$sql->s_7+$sql->s_8+$sql->s_9;
			echo ("<row id='".$tgl."'>");
				echo("<cell><![CDATA[".$tgl."]]></cell>");
				echo("<cell><![CDATA[".$tgl1."]]></cell>");
				echo("<cell><![CDATA[".$s_1."]]></cell>");
				echo("<cell><![CDATA[".$s_2."]]></cell>");
				echo("<cell><![CDATA[".$s_3."]]></cell>");
				echo("<cell><![CDATA[".$s_4."]]></cell>");
				echo("<cell><![CDATA[".$s_5."]]></cell>");
				echo("<cell><![CDATA[".$s_6."]]></cell>");
				echo("<cell><![CDATA[".$s_7."]]></cell>");
				echo("<cell><![CDATA[".$s_8."]]></cell>");
				echo("<cell><![CDATA[".$s_9."]]></cell>");
				echo("<cell><![CDATA[".$t."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_bln(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_bln',$data);
	}
	
	function cetak_self(){
		$p = $_GET['full'];
		$o = explode('|',$p);
		$periode = $o[0];
		$akhir = $o[1];
		$ttd = $o[2];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->msistem->v_bln($bln);
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(50,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN REALISASI PAJAK DAERAH BULAN '.strtoupper($bulan).' TAHUN '.$thn.'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="65" height="10" align="center"><strong>TANGGAL</strong></td>
					<td width="65" height="12" align="center"><strong>HOTEL</strong></td>
					<td width="65" height="12" align="center"><strong>RESTORAN</strong></td>
					<td width="65" height="12" align="center"><strong>REKLAME</strong></td>
					<td width="65" height="12" align="center"><strong>HIBURAN</strong></td>
					<td width="65" height="12" align="center"><strong>PPJ</strong></td>
					<td width="65" height="12" align="center"><strong>MBLB</strong></td>
					<td width="65" height="12" align="center"><strong>PARKIR</strong></td>
					<td width="65" height="12" align="center"><strong>WALET</strong></td>
					<td width="65" height="12" align="center"><strong>AIR TANAH</strong></td>
					<td width="65" height="12" align="center"><strong>TOTAL</strong></td>
				</tr>';
		
		$a = 0;
		$b = 0;
		$c = 0;
		$d = 0;
		$e = 0;
		$f = 0;
		$g = 0;
		$h = 0;
		$i = 0;
		$j = 0;
		for($tgl=1;$tgl<=$akhir;$tgl++){
			if(strlen($tgl)=='1') { 
				$tgl1 = '0'.$tgl.'/'.$bln.'/'.$thn;
			} else {
				$tgl1 = $tgl.'/'.$bln.'/'.$thn;
			}
			
			$time = $periode.'-'.$tgl;
			$sql = $this->db->query("SELECT
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'HTL') as s_1,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'RES') as s_2,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'REK') as s_3,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'HIB') as s_4,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'LIS') as s_5,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'GAL') as s_6,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'PKR') as s_7,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'WLT') as s_8,
(SELECT sum(ketetapan) FROM sspd WHERE tanggal = '".$time."' and kode_pajak = 'AIR') as s_9
FROM sspd")->row();
			
			$s_1 = $sql->s_1;
			if($s_1==0){
				$s_1 = 0;
			}
			
			$s_2 = $sql->s_2;
			if($s_2==0){
				$s_2 = 0;
			}
			
			$s_3 = $sql->s_3;
			if($s_3==0){
				$s_3 = 0;
			}
			
			$s_4 = $sql->s_4;
			if($s_4==0){
				$s_4 = 0;
			}
			
			$s_5 = $sql->s_5;
			if($s_5==0){
				$s_5 = 0;
			}
			
			$s_6 = $sql->s_6;
			if($s_6==0){
				$s_6 = 0;
			}
			
			$s_7 = $sql->s_7;
			if($s_7==0){
				$s_7 = 0;
			}
			
			$s_8 = $sql->s_8;
			if($s_8==0){
				$s_8 = 0;
			}
			
			$s_9 = $sql->s_9;
			if($s_9==0){
				$s_9 = 0;
			}
			
			$t = $sql->s_1+$sql->s_2+$sql->s_3+$sql->s_4+$sql->s_5+$sql->s_6+$sql->s_7+$sql->s_8+$sql->s_9;	
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$tgl.'</td>
					<td width="65" height="10" align="center">'.$tgl1.'</td>
					<td width="65" height="12" align="right">'.number_format($s_1,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_2,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_3,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_4,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_5,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_6,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_7,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_8,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($s_9,2,",",".").'&nbsp;</td>
					<td width="65" height="12" align="right">'.number_format($t,2,",",".").'&nbsp;</td>
				</tr>';
				$a = $a + $s_1;
				$b = $b + $s_2;
				$c = $c + $s_3;
				$d = $d + $s_4;
				$e = $e + $s_5;
				$f = $f + $s_6;
				$g = $g + $s_7;
				$h = $h + $s_8;
				$i = $i + $s_9;
				$j = $j + $t;
		}
		
		$report .=
				'<tr>
					<td width="85" height="10" align="center"><strong>TOTAL</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($a,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($b,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($c,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($d,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($e,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($f,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($g,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($h,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($i,2,",",".").'&nbsp;</strong></td>
					<td width="65" height="12" align="right"><strong>'.number_format($j,2,",",".").'&nbsp;</strong></td>
				</tr>
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$t = explode(",",$ttd);
		$countttd = count($t);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 785/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="785">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
					 <td width="'.$wid.'" align="center">Meulaboh, '.$day.' '.$mon.' '.$year.'</td>
				</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->jabatan_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select bagian from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">'.$us->bagian.'</td>
					</tr><tr>
						<td colspan="'.$countttd.'" height="30">&nbsp;</td>
					</tr><tr>';
			
			$t = explode(",",$ttd);
			$countttd = count($t);
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select nama from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">'.$us->nama.'</td>
					</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nip_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">NIP. '.$rs->nip_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select nip from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
				'<td width="'.$wid.'" height="10" align="center">NIP. '.$us->nip.'</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Penerimaan'.'.pdf', 'I');
	}
}
?>