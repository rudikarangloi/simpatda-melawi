<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class report_pajak2 extends MY_Controller {
	
	function __construct() {
    	parent::__construct();
        $this->load->model('msistem');
    }
	
	function rekap_bank(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd order by id asc");
		$this->load->view('report_pajak/rekap_bank',$data);
	}
	
	function display_rekap($bank="",$tgl=""){
		$data['bank'] = $bank;
		$data['tgl'] = $tgl;
		$this->load->view('report_pajak/display_rekap',$data);
	}
	
	function excel_rekap(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_rekap',$data);
	}
	
	function ttd_rekap(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_rekap',$data);
	}
	
	function pdf_rekap(){
		$p = $_GET['full'];
		$dt = explode('|',$p);
		$bank = $dt[0];
		$tgl = $dt[1];
		$ttd = $dt[2];
		
		$t = explode('-',$tgl);
		$time = $t[2].'-'.$t[1].'-'.$t[0];
		
		if($bank=='1'){
			$nm = 'BANK';
		}
        
        /*if($bank=='200'){
			$nm = 'BANK NAGARI';
		} else if($bank=='300'){
			$nm = 'BANK BTN';
		} else if($bank=='0009'){
			$nm = 'BANK BNI';
		}*/
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMPATDA_JAMBI');
		$pdf->SetKeywords('SIMPATDA_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(5,20,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">REKAPITULASI PENERIMAAN HARIAN<br />TANGGAL '.$time.'<br />PEMBAYARAN VIA '.$nm.'</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="120" height="12" align="center"><strong>JENIS PAJAK</strong></td>
					<td width="170" height="12" align="center"><strong>GOLONGAN JENIS PAJAK</strong></td>
					<td width="120" height="12" align="center"><strong>PAJAK TAHUN <br/> BERJALAN</strong></td>
					<td width="120" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					<td width="120" height="12" align="center"><strong>DENDA</strong></td>
					<td width="120" height="10" align="center"><strong>TOTAL BAYAR</strong></td>
				</tr>';
		
		$qr = "";
		$tjumlah = 0;
		$ttetap = 0;
		$tdenda = 0;
		$tsetoran = 0;
		
		$pajak = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd order by id asc");
		$ro = 1;
		foreach($pajak->result() as $p){
			$kode = $p->kode_sptpd;
			$nama = $p->nama_sptpd;
	
    
    	$report .= 
		'<tr>
    		<td align="center" width="20"><strong>'.$ro.'</strong></td>
            <td colspan="6" width="770">&nbsp;&nbsp;<strong>'.strtoupper('Pajak '.$nama).'</strong></td>
        </tr>';
    	if($kode=='GAL'){
			$spt = $this->db->query("SELECT kode_pajak
FROM
sspd
WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'");
		} else {		
			$spt = $this->db->query("SELECT
DISTINCT(sspd_detail.kode_rekening) as kode_rekening,
sspd_detail.nama_rekening
FROM
sspd
INNER JOIN sspd_detail ON sspd.no_sspd = sspd_detail.no_sspd 
INNER JOIN master_rekening ON master_rekening.kd_rek = sspd_detail.kode_rekening
LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd
WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'");
		}
				
		$no = 1;
		$jumlah = 0;
		$tetap = 0;
		$denda = 0;
		$setoran = 0;
		
		foreach($spt->result() as $q){
			if($kode=='GAL'){
				$nop = '4.1.1.11.06';
				$nm = 'Mineral Bukan Logam dan Batuan';
				$spt = $this->db->query("SELECT
SUM(sspd.ketetapan) as ketetapan,
SUM(pembayaran.setoran_wp) as setoran,
SUM(sspd.denda) as denda
FROM
sspd
LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd
WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'")->row();
			} else {
				$nop = $q->kode_rekening;
				$nm = $q->nama_rekening;
				$spt = $this->db->query("SELECT
SUM(sspd.ketetapan) AS ketetapan,
SUM(pembayaran.setoran_wp) AS setoran,
SUM(sspd.denda) AS denda
FROM
sspd
INNER JOIN sspd_detail ON sspd.no_sspd = sspd_detail.no_sspd
LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and kode_rekening = '".$nop."'")->row();
			}
			
			$thn = date('Y');
			//pajak tahun berjalan
			/*$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			$ptb = $setor->jumlah;
			if($ptb==NULL){*/
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("SELECT SUM(a.ketetapan) AS tetap, SUM(a.denda) AS denda, SUM(c.setoran_wp) AS jumlah FROM sspd a 
LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd
LEFT JOIN pembayaran c ON c.no_sspd=a.no_sspd where b.kode_rekening = '".$nop."' and a.tahun_pajak != '".$thn."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL||$piu<0){
				$piu = 0;
			}
	
	$report .=
		'<tr>
        	<td width="20"></td>
            <td width="120"></td>
            <td width="170">&nbsp;&nbsp;&nbsp;'.$nop.' - '.strtoupper($nm).'</td>
            <td align="right" width="120">'.number_format($spt->ketetapan,2,",",".").'&nbsp;</td>
        	<td align="right" width="120">'.number_format($piu,2,",",".").'&nbsp;</td>
        	<td align="right" width="120">'.number_format($spt->denda,2,",",".").'&nbsp;</td>
        	<td align="right" width="120">'.number_format($spt->setoran,2,",",".").'&nbsp;</td>
        </tr>';
    
    		$jumlah = $jumlah + $spt->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $spt->denda;
			$setoran = $setoran + $spt->setoran;
			
			$no++;
		}
	$report .=
	'<tr>
    	<td bgcolor="#EEE" colspan="3" align="center" width="310"><strong>JUMLAH</strong></td>
        <td bgcolor="#EEE" align="right" width="120"><strong>'.number_format($jumlah,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#EEE" align="right" width="120"><strong>'.number_format($tetap,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#EEE" align="right" width="120"><strong>'.number_format($denda,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#EEE" align="right" width="120"><strong>'.number_format($setoran,2,",",".").'&nbsp;</strong></td>
    </tr>';    
    
		$tjumlah = $tjumlah + $jumlah;
		$ttetap = $ttetap + $tetap;
		$tdenda = $tdenda + $denda;
		$tsetoran = $tsetoran + $setoran;
			
		$ro++;
	}
  
  $report .=
  	'<tr>
    	<td bgcolor="#BBB" colspan="3" align="center" width="310"><strong>TOTAL</strong></td>
        <td bgcolor="#BBB" align="right" width="120"><strong>'.number_format($tjumlah,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#BBB" align="right" width="120"><strong>'.number_format($ttetap,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#BBB" align="right" width="120"><strong>'.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
        <td bgcolor="#BBB" align="right" width="120"><strong>'.number_format($tsetoran,2,",",".").'&nbsp;</strong></td>
    </tr>
</table>';

$report .=
	'<table>
		<tr>
			<td height="20">&nbsp;</td>
		</tr>
	</table>';

		$t = explode(",",$ttd);
		$countttd = count($t);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 805/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="805">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
					 <td width="'.$wid.'" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
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
						<td colspan="'.$countttd.'" height="50">&nbsp;</td>
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
		$pdf->Output('Report_Rekap_Bank'.'.pdf', 'I');
	}  
	
	function rekon_bank(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/rekon_bank', $data);
	}
	
	function data_bank($bank="",$tgl="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT
sspd.nomor,
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tgl2,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sspd.npwpd,
sspd.tahun_pajak,
sspd.ketetapan,
sspd.denda,
pembayaran.setoran_wp,
sspd.kode_pajak
FROM
sspd
INNER JOIN view_perusahaan ON sspd.npwpd = view_perusahaan.npwpd_perusahaan
INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' $qr");
	
		$i = 1;
		foreach($query->result() as $rs){
			$no = $rs->nomor;
			$kode = $rs->kode_pajak;
			
			if($kode=='REK'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_reklame as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_reklame a left join master_rekening b on a.rek_reklame=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Reklame';
				
			} else if($kode=='AIR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_air as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_air_bawah_tanah a left join master_rekening b on a.rek_air=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Air Tanah';
				
			} else if($kode=='HTL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_hotel as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hotel a left join master_rekening b on a.gol_hotel=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hotel';
				
			} else if($kode=='RES'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_restoran as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_restoran a left join master_rekening b on a.gol_restoran=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Restoran';
				
			} else if($kode=='HIB'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.jenis_hiburan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hiburan a left join master_rekening b on a.jenis_hiburan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hiburan';
				
			} else if($kode=='LIS'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_tarif as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_listrik a left join master_rekening b on a.gol_tarif=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Penerangan Jalan';
				
			} else if($kode=='GAL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rekening as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_galianc a left join master_rekening b on a.rekening=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Mineral Bukan Logam dan Batuan';
				
			} else if($kode=='WLT'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_burung_walet a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Sarang Burung Walet';
				
			} else if($kode=='PKR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_parkir a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Parkir';		
			}
			
			$thn = date('Y');
			//$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			//$ptb = $setor->jumlah;
			//if($ptb==NULL){
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("SELECT SUM(sspd.ketetapan) AS tetap, SUM(sspd.denda) AS denda, SUM(pembayaran.setoran_wp) AS jumlah FROM sspd 
            LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where nomor = '".$no."' and tahun_pajak != '".$thn."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL){
				$piu = 0;
			}			
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$spt->no_sptpd."]]></cell>");
				echo("<cell><![CDATA[".$spt->tgl."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl2."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$pajak."]]></cell>");
				echo("<cell><![CDATA[".$spt->kd_rek." - ".$spt->nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$spt->masa1." - ".$spt->masa2."]]></cell>");
				echo("<cell><![CDATA[".$rs->tahun_pajak."]]></cell>");
				echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$piu."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran_wp."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function pdf_bank(){
		$q = $_GET['full'];
		$d = explode('|',$q);
		$pajak = $d[2];
		$bank = $d[0];
		$tgl = $d[1];
		
		$t = explode('-',$tgl);
		$time = $t[2].'-'.$t[1].'-'.$t[0];
		
		if($bank=='1'){
			$nm = 'BANK';
		} else if($bank=='2'){
			$nm = 'LOKET';
		} 
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMPATDA_JAMBI');
		$pdf->SetKeywords('SIMPATDA_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(20,20,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">Laporan Daftar Penerimaan Harian</h2>
			<p align="center">Tanggal '.$time.'<br/>'.$nm.'</p>
';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="80" height="12" align="center"><strong>No. SPTPD</strong></td>
					<td width="170" height="12" align="center"><strong>Tgl SPTPD</strong></td>
					<td width="200" height="12" align="center"><strong>No. SSPD</strong></td>
					<td width="120" height="12" align="center"><strong>Tgl. SSPD</strong></td>
					<td width="150" height="12" align="center"><strong>Nama WP</strong></td>
					<td width="65" height="10" align="center"><strong>Alamat WP</strong></td>
					<td width="65" height="10" align="center"><strong>NPWPD</strong></td>
					<td width="65" height="10" align="center"><strong>Jenis Pajak</strong></td>
					<td width="65" height="10" align="center"><strong>Golongan Jenis Pajak</strong></td>
					<td width="65" height="10" align="center"><strong>Masa Pajak</strong></td>
					<td width="65" height="10" align="center"><strong>Tahun Pajak</strong></td>
					<td width="65" height="10" align="center"><strong>Tahun Pajak Berjalan</strong></td>
					<td width="65" height="10" align="center"><strong>Piutang Pajak</strong></td>
					<td width="65" height="10" align="center"><strong>Denda</strong></td>
					<td width="65" height="10" align="center"><strong>Total Bayar</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT
sspd.nomor,
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tgl2,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sspd.npwpd,
sspd.tahun_pajak,
sspd.ketetapan,
sspd.denda,
pembayaran.setoran_wp,
sspd.kode_pajak
FROM
sspd
INNER JOIN view_perusahaan ON sspd.npwpd = view_perusahaan.npwpd_perusahaan
LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' $qr");
	
		$i = 1;
		$jumlah = 0;
		$tetap = 0;
		$denda = 0;
		$setoran = 0;
		foreach($query->result() as $rs){
			$no = $rs->nomor;
			$kode = $rs->kode_pajak;
			
			if($kode=='REK'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_reklame as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_reklame a left join master_rekening b on a.rek_reklame=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Reklame';
				
			} else if($kode=='AIR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_air as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_air_bawah_tanah a left join master_rekening b on a.rek_air=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Air Tanah';
				
			} else if($kode=='HTL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_hotel as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hotel a left join master_rekening b on a.gol_hotel=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hotel';
				
			} else if($kode=='RES'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_restoran as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_restoran a left join master_rekening b on a.gol_restoran=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Restoran';
				
			} else if($kode=='HIB'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.jenis_hiburan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hiburan a left join master_rekening b on a.jenis_hiburan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hiburan';
				
			} else if($kode=='LIS'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_tarif as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_listrik a left join master_rekening b on a.gol_tarif=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Penerangan Jalan';
				
			} else if($kode=='GAL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rekening as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_galianc a left join master_rekening b on a.rekening=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Mineral Bukan Logam dan Batuan';
				
			} else if($kode=='WLT'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_burung_walet a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Sarang Burung Walet';
				
			} else if($kode=='PKR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_parkir a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Parkir';		
			}
			
			$thn = date('Y');
			//$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			//$ptb = $setor->jumlah;
			//if($ptb==NULL){
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("SELECT SUM(sspd.ketetapan) AS tetap, SUM(sspd.denda) AS denda, SUM(pembayaran.setoran_wp) AS jumlah FROM sspd 
            LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where nomor = '".$no."' and tahun_pajak != '".$thn."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL){
				$piu = 0;
			}
			
		$report .= 
			'<tr>
				<td align="center">'.$i.'</td>
				<td align="center">'.$spt->no_sptpd.'</td>
				<td align="center">'.$spt->tgl.'</td>
				<td align="center">'.$rs->no_sspd.'</td>
				<td align="center">'.$rs->tgl2.'</td>
				<td align="left">'.$rs->nama_perusahaan.'</td>
				<td align="left">'.$rs->alamat_perusahaan.'</td>
				<td align="left">'.$rs->npwpd.'</td>
				<td align="left">'.$pajak.'</td>
				<td align="left">'.$spt->kd_rek.' - '.$spt->nm_rek.'</td>
				<td align="center">'.$spt->masa1." - ".$spt->masa2.'</td>
				<td align="center">'.$rs->tahun_pajak.'</td>
				<td align="right">'.number_format($rs->ketetapan,2,",",".").'</td>
				<td align="right">'.number_format($piu,2,",",".").'</td>
				<td align="right">'.number_format($rs->denda,2,",",".").'</td>
				<td align="right">'.number_format($rs->setoran_wp,2,",",".").'</td>
			</tr>';
			
			$jumlah = $jumlah + $rs->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $rs->denda;
			$setoran = $setoran + $rs->setoran;
			
			$i++;
		}
		
		$report .=
			'<tr>
				<td colspan="12" align="center"><strong>Jumlah</strong></td>
				<td align="right"><strong>'.number_format($jumlah,2,",",".").'</strong></td>
				<td align="right"><strong>'.number_format($tetap,2,",",".").'</strong></td>
				<td align="right"><strong>'.number_format($denda,2,",",".").'</strong></td>
				<td align="right"><strong>'.number_format($setoran,2,",",".").'</strong></td>
			</tr>
		</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Daftar_Penerimaan_Harian'.'.pdf', 'I');
	}
	
	function excel_bank($bank="",$tgl="",$pajak=""){
		$data['type'] = 'excel';
		$data['bank'] = $bank;
		$data['tgl'] = $tgl;
		$data['pajak'] = $pajak;
		$this->load->view('report_pajak/excel_bank',$data);
	}
	
	function real_nots_sptpd(){
		$bln = date('m');
		$thn = date('Y');
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd
FROM identitas_perusahaan a 
INNER JOIN view_kelurahan b ON a.kelurahan=b.kode_kelurahan 
LEFT JOIN master_sptpd c ON a.jenis_usaha=c.id WHERE a.npwpd_perusahaan   NOT IN (select npwpd FROM sptpd where masa_pajak1 = '".$bln."' and tahun = '".$thn."')","npwpd_perusahaan","npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, nama_kecamatan, nama_kelurahan, nama_sptpd");
	}
	
	function not_sptpd(){
		$data['bulan'] = $this->msistem->bulan();
		$data['tahun'] = $this->msistem->tahun();
		$data['pajak'] = $this->db->query("select id, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/not_sptpd',$data);
	}
	
	function data_not_sptpd($full=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$f = explode('_',$full);
		$bln = $f[0];
		$thn = $f[1];
		$pajak = $f[2];
		
		if($pajak==NULL){
			$qr = "";
		} else {
			$qr = "and a.jenis_usaha = '".$pajak."'";
		}
		
		$query = $this->db->query("SELECT a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd
FROM identitas_perusahaan a 
INNER JOIN view_kelurahan b ON a.kelurahan=b.kode_kelurahan AND a.kecamatan=b.kode_kecamatan
LEFT JOIN master_sptpd c ON a.jenis_usaha=c.id WHERE a.npwpd_perusahaan  NOT IN (SELECT npwpd FROM sptpd where masa_pajak1 = '".$bln."' and tahun = '".$thn."') $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
		
		echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_sptpd."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_not_sptpd(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_not_sptpd',$data);
	}
	
	function excel_not_sptpd(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_not_sptpd',$data);
	}	
	
	function cetak_not_sptpd(){
		$p = $_GET['full'];
		$ro = explode('|',$p);
		$b = $ro[0];
		$ttd = $ro[1];
		
		$dt = explode('_',$b);
		$bln = $dt[0];
		$thn = $dt[1];
		$pajak = $dt[2];
		
		if($pajak==NULL){
			$qr = "";
		} else {
			$qr = "and a.jenis_usaha='".$pajak."'";
		}
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
		$pdf->SetMargins(20,20,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">Laporan Data Belum Pendataan SPTPD</h2>
			<p align="center">Bulan '.$bulan.' Tahun '.$thn.'</p>
';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="170" height="12" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td width="200" height="12" align="center"><strong>ALAMAT</strong></td>
					<td width="120" height="12" align="center"><strong>KECAMATAN</strong></td>
					<td width="150" height="12" align="center"><strong>KELURAHAN</strong></td>
					<td width="65" height="10" align="center"><strong>JENIS PAJAK</strong></td>
				</tr>';
		
		$query = $this->db->query("select a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan and a.kecamatan=b.kode_kecamatan left join master_sptpd c on a.jenis_usaha=c.id where a.npwpd_perusahaan NOT IN (SELECT npwpd FROM sptpd where masa_pajak1 = '".$bln."' and tahun = '".$thn."') $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
				
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="80" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="170" height="12" align="left">&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="200" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="120" height="12" align="left">&nbsp;'.$rs->nama_kecamatan.'&nbsp;</td>
					<td width="150" height="12" align="left">&nbsp;'.$rs->nama_kelurahan.'&nbsp;</td>
					<td width="65" height="10" align="center">'.$rs->nama_sptpd.'</td>
				</tr>';
			$i++;
		}
		
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$t = explode(",",$ttd);
		$countttd = count($t);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 805/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="805">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
					 <td width="'.$wid.'" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
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
						<td colspan="'.$countttd.'" height="50">&nbsp;</td>
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
		$pdf->Output('Report_Belum_Pendataan_SPTPD'.'.pdf', 'I');
	}
	
	function rincian(){
		$this->load->view('report_pajak/rincian');
	}
	
	function data_rincian(){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("select a.id,a.kode_rekening,b.nm_rek,a.target_pajak from target_rincian a left join master_rekening b on a.kode_rekening=b.kd_rek where b.status_aktif = '1'");

		$i=1;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_rekening;
		
			$realisasi = $this->db->query("SELECT SUM(b.setoran) AS jumlah FROM sspd_detail a LEFT JOIN sspd b ON a.no_sspd=b.no_sspd 
             WHERE a.kode_rekening = '".$kode."' AND DATE_FORMAT(b.tanggal,'%Y')=DATE_FORMAT(CURDATE(),'%Y')")->row();
			
			$persen = $realisasi->jumlah*100/$rs->target_pajak;
			$persen = number_format($persen,2,",",".");
			
			if($realisasi->jumlah==0){
				$setor = 0;
			} else {
				$setor = $realisasi->jumlah;
			}
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[Pajak ".$rs->nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->target_pajak."]]></cell>");
				echo("<cell><![CDATA[".$setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function target(){
		$this->load->view('report_pajak/target');
	}
        
        function data_target_tanggal($tanggal,$bulan,$tahun){
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
        
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("SELECT
master_sptpd.nama_sptpd, master_sptpd.kode_sptpd,
target_pajak.target
FROM
master_sptpd
INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak where target_pajak.tahun = '$tahun'");

		$i=1;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_sptpd;
		
			//$realisasi = $this->db->query("SELECT SUM(pembayaran.setoran_wp) AS jumlah FROM sspd INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_pajak ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();
			$realisasi = $this->db->query("SELECT SUM(sspd.ketetapan) AS jumlah, SUM(sspd.denda) AS denda, SUM(sspd.setoran) AS setoran FROM sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tanggal <= '$tahun-$bulan-$tanggal' AND sspd.tanggal >= '$tahun-01-01'")->row();						
			//$realisasi = $this->db->query("SELECT SUM(sspd.ketetapan) AS jumlah, SUM(sspd.denda) AS denda, SUM(sspd.setoran) AS setoran FROM sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_transaksi ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();						
			
			/* $persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
			$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,5); */
			
			if($realisasi->jumlah==0){
				$setor = 0;
			}else{
				$setor = $realisasi->jumlah;
			}
			
			if($realisasi->denda==0){
				$denda = 0;
			}else{
				$denda = $realisasi->denda;
			}
			
			if($realisasi->setoran==0){
				$setoran = 0;
			}else{
				$setoran = $realisasi->setoran;
			}
			
			if($kode=="AIR"){
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,6);
				$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,6);
			}else{
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
				$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,5);
			}
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[Pajak ".$rs->nama_sptpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->target."]]></cell>");
				echo("<cell><![CDATA[".$setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."%]]></cell>");
				echo("<cell><![CDATA[".$denda."]]></cell>");
				echo("<cell><![CDATA[".$setoran."]]></cell>");
				echo("<cell><![CDATA[".$persen1."%]]></cell>");
			
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function data_target($tahun){
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
        
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("SELECT
master_sptpd.nama_sptpd, master_sptpd.kode_sptpd,
target_pajak.target
FROM
master_sptpd
INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak where target_pajak.tahun = '$tahun'");

		$i=1;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_sptpd;
		
			//$realisasi = $this->db->query("SELECT SUM(pembayaran.setoran_wp) AS jumlah FROM sspd INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_pajak ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();
			$realisasi = $this->db->query("SELECT SUM(sspd.ketetapan) AS jumlah, SUM(sspd.denda) AS denda, SUM(sspd.setoran) AS setoran FROM sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tanggal >= '$tahun-01-01' and sspd.tanggal <= '".date("Y-m-d")."'")->row();						
			//$realisasi = $this->db->query("SELECT SUM(sspd.ketetapan) AS jumlah, SUM(sspd.denda) AS denda, SUM(sspd.setoran) AS setoran FROM sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_transaksi ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();						
			
			/* $persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
			$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,5); */
			
			if($realisasi->jumlah==0){
				$setor = 0;
			}else{
				$setor = $realisasi->jumlah;
			}
			
			if($realisasi->denda==0){
				$denda = 0;
			}else{
				$denda = $realisasi->denda;
			}
			
			if($realisasi->setoran==0){
				$setoran = 0;
			}else{
				$setoran = $realisasi->setoran;
			}
			
			if($kode=="AIR"){
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,4);
				$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,4);
			}else{
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
				$persen1 = substr(($realisasi->setoran/$rs->target)*100,0,5);
			}
			
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[Pajak ".$rs->nama_sptpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->target."]]></cell>");
				echo("<cell><![CDATA[".$setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."%]]></cell>");
				echo("<cell><![CDATA[".$denda."]]></cell>");
				echo("<cell><![CDATA[".$setoran."]]></cell>");
				echo("<cell><![CDATA[".$persen1."%]]></cell>");
			
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_target($tanggal,$bulan,$tahun){
		$data['ttd'] = $this->model_user->ttd();
                $data['tahun'] = $tahun;
                $data['bulan'] = $bulan;
                $data['tanggal'] = $tanggal;
		$this->load->view('report_pajak/ttd_target',$data);
	}
	
	function cetak_target(){
		$ttd = $_GET['full'];
		$tahun = $_GET['tahun'];                
		$bulan = $_GET['bulan'];                
		$tanggal = $_GET['tanggal'];
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'FOLIO', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMPATDA_JAMBI');
		$pdf->SetKeywords('SIMPATDA_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(100,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
		
		$pdf->AddPage('L','FOLIO',false);
		//set data
		$report = '';
		$report .=
			'<table width="670">
				<tr>
					<td><h2 align="center">Target Dan Realisasi Pajak Daerah</h2></td>
				</tr>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1" align="left">
				<tr>
					<td width="20" height="12" align="center"><strong>No.</strong></td>
					<td width="170" height="12" align="center"><strong>Jenis Pajak Daerah</strong></td>
					<td width="95" height="12" align="center"><strong>Target</strong></td>
					<td width="120" height="12" align="center"><strong>Realisasi (sampai saat ini)</strong></td>
					<td width="50" height="12" align="center"><strong>Persen (%)</strong></td>
					<td width="90" height="12" align="center"><strong>Denda(sampai saat ini)</strong></td>
					<td width="90" height="12" align="center"><strong>Jumlah</strong></td>
					<td width="50" height="12" align="center"><strong>Total Persen(%)</strong></td>
				</tr>';
		
		$query = $this->db->query("SELECT
master_sptpd.nama_sptpd, master_sptpd.kode_sptpd,
target_pajak.target
FROM
master_sptpd
INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak where tahun = '$tahun'");
		$i=1;
		$target=0;
		$terima=0;
		$keluar=0;
		$denda2=0;
		$setoran2=0;
		foreach($query->result() as $rs) {
			$kode = $rs->kode_sptpd;
		
			//$realisasi = $this->db->query("SELECT SUM(pembayaran.setoran_wp) AS jumlah FROM sspd INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_pajak ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();
			$realisasi = $this->db->query("SELECT SUM(sspd.ketetapan) AS jumlah, SUM(sspd.denda) AS denda, SUM(sspd.setoran) AS setoran FROM sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tanggal >= '$tahun-01-01' and sspd.tanggal <= '$tahun-$bulan-$tanggal'")->row();	
			
			//$persen = substr(($realisasi->jumlah/$rs->target)*100,0,4);
			//$persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
			
			//$persen2 = substr(($realisasi->setoran/$rs->target)*100,0,5);
			//$persen1 = number_format($persen,0,",",".");
			
			if($realisasi->jumlah==0){
				$setor = 0;
			} else {
				$setor = $realisasi->jumlah;
			}
			
			if($realisasi->denda==0){
				$denda = 0;
			} else {
				$denda = $realisasi->denda;
			}
			
			if($realisasi->setoran==0){
				$setoran = 0;
			} else {
				$setoran = $realisasi->setoran;
			}
					
			if($kode=="AIR"){
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,4);
				$persen2 = substr(($realisasi->setoran/$rs->target)*100,0,4);
			}else{
				$persen = substr(($realisasi->jumlah/$rs->target)*100,0,5);
				$persen2 = substr(($realisasi->setoran/$rs->target)*100,0,5);
			}
			
			$report .=
				'<tr>
					<td width="20" height="12" align="center">'.$i.'</td>
					<td width="170" height="12" align="left">&nbsp; Pajak '.$rs->nama_sptpd.'</td>
					<td width="95" height="12" align="right">'.number_format($rs->target,2,",",".").'&nbsp;</td>
					<td width="120" height="12" align="right">'.number_format($setor,2,",",".").'&nbsp;</td>
					<td width="50" height="12" align="right">'.$persen.'%&nbsp;</td>
					<td width="90" height="12" align="right">'.number_format($denda,2,",",".").'&nbsp;</td>
					<td width="90" height="12" align="right">'.number_format($setoran,2,",",".").'&nbsp;</td>
					<td width="50" height="12" align="right">'.$persen2.'%&nbsp;</td>	
				</tr>';
			$target = $target+$rs->target;
			$terima = $terima+$setor;
			$keluar = $keluar+$persen;
			$denda2 = $denda2+$denda;
			$setoran2 = $setoran2+$setoran;
			$total =  substr(($terima/$target)*100,0,5);
			$total2 =  substr(($setoran2/$target)*100,0,5);
			$i++;
		}
		
		$report .=
				'<tr>
					<td width="190" align="center"><strong>JUMLAH</strong></td>
					<td width="95" height="12" align="right"><strong>Rp.&nbsp;'.number_format($target,2,",",".").'&nbsp;</strong></td>
					<td width="120" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima,2,",",".").'&nbsp;</strong></td>
					<td width="50" height="12" align="right"><strong>'.$total.'%&nbsp;</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($denda2,2,",",".").'&nbsp;</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($setoran2,2,",",".").'&nbsp;</strong></td>
					<td width="50" height="12" align="right"><strong>'.$total2.'%&nbsp;</strong></td>
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
		
		$wid = 690/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="500">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = $tanggal;
			$mon = $this->msistem->v_bln($bulan);
			$year = $tahun;
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
					 <td width="'.$wid.'" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
				</tr><tr>';
			
			for($i=$countttd-2;$i>=0;$i--){
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
			
			for($i=$countttd-2;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center"><u>'.$rs->nama_ttd.'</u></td>';
				//	}
				}
			}
			
			$us = $this->db->query("select nama from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">'.$us->nama.'</td>
					</tr><tr>';
			
			for($i=$countttd-2;$i>=0;$i--){
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
		$pdf->Output('Report_Target'.'.pdf', 'I');
	}
	
	function kas_tgl(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/kas_tgl', $data);
	}
	
	function data_ktgl($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		$query = $this->db->query("SELECT
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal,
DATE_FORMAT(skpd.tgl,'%d/%m/%Y') AS tgl,
identitas_perusahaan.nama_perusahaan,
sspd.nomor,
sspd.kode_pajak,
sspd.ketetapan,
sspd.denda,
sspd.setoran AS setoran_wp
FROM
identitas_perusahaan
INNER JOIN sspd ON identitas_perusahaan.npwpd_perusahaan = sspd.npwpd 
INNER JOIN skpd ON skpd.no_skpd = sspd.nomor where  sspd.tanggal>='".$awal."' and sspd.tanggal<='".$akhir."' $qr GROUP BY sspd.no_sspd ORDER BY sspd.tanggal ASC");
		$i=1;
		foreach($query->result() as $rs){
			$rc = $this->db->query("select kode_rekening, nama_rekening, sum(DISTINCT jumlah) as jumlah from sspd_detail where no_sspd = '".$rs->no_sspd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kode_rekening;
			$nm_rek = $rc->nama_rekening;
			$null = "0";
			if($no_rek=='4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($kode=='GAL'){
				$nm_rek = 'Pajak Mineral Bukan Logam Dan Batuan';
				$no_rek = '4.1.1.11';
			}
			
			/* if($no_rek=='4.1.1.03.16'){
				$nm_rek = 'Panti Pijat dan Refleksi ';
			}
			if($no_rek=='4.1.1.03.16.'){
				$no_rek = '4.1.1.03.16';
				$nm_rek = 'Panti Pijat dan Refleksi ';
			} */
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
				echo("<cell><![CDATA[Diterima dari ".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$no_rek."]]></cell>");
				echo("<cell><![CDATA[".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran_wp."]]></cell>");
				//echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			//$muncul = "</rows>";
			$i++;	
		}
		echo "</rows>";
	}
	
	//surat ketetapan pajak
	function lap_ket(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$data['pajak'] = $this->db->query("SELECT kd_rek, nm_rek FROM master_rekening WHERE jns_pajak<>0");
		$this->load->view('report_pajak/lap_ket', $data);
	}
	
	public function excel_ket(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ket',$data);
	}
	
	function data_ket($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
		
		
		$i=1;
		
			$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,a.masa_pajak_1,a.masa_pajak_2,
c.dp,d.denda,c.kompensasi,d.ketetapan,a.jumlah,a.status,DATE_FORMAT(d.tanggal,'%d/%m/%Y') AS tgl_sspd,d.setoran
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN sspd d ON d.nomor=a.no_skpd
WHERE $qr2 AND $qr AND d.tanggal>='".$awal."' AND d.tanggal<='".$akhir."' GROUP BY a.no_skpd ORDER BY d.tanggal ASC
");
foreach($rc->result() as $rs){
			$kode = $rs->kode_pajak;
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$kompensasi = $rs->kompensasi;
			$ketetapan = $rs->ketetapan;
			
			if($kompensasi !=0){
				$denda2= $denda - $kompensasi;				
			}else{
				$denda2= $denda;
			}
			
			//$ketetapan = $jumlah - $denda2;
			$jumlah2 = $ketetapan + $denda2;
			
			$no_rek = $rs->kode_rekening;
			$nm_rek = $rs->nama_rekening;
			$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			
			$masaPajak = "";
			if($pajak1=="REK"){
				$masaPajak = $this->msistem->tanggal_format_indonesia($rs->masa_pajak_1)." - ".$this->msistem->tanggal_format_indonesia($rs->masa_pajak_2);
			}else{
				$masaPajak = $this->msistem->format_bulan_tahun($rs->masa_pajak_1)." - ".$this->msistem->format_bulan_tahun($rs->masa_pajak_2);
			}
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  }
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_kohir."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl_sspd."]]></cell>");
				echo("<cell><![CDATA[".$masaPajak." ]]></cell>");
				echo("<cell><![CDATA[".$ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$denda2."]]></cell>");
				echo("<cell><![CDATA[".$jumlah2."]]></cell>");
				//echo("<cell><![CDATA[".$rs->status."]]></cell>");
				echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function cetak_ket(){
		$p = $_GET['full'];
		$t = explode('|',$p);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">SURAT KETETAPAN PAJAK DAERAH</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="15" height="12" align="center"><strong>NO.</strong></td>
					<td width="90" height="12" align="center"><strong>NAMA</strong></td>
					<td width="100" height="12" align="center"><strong>ALAMAT USAHA</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="80" height="12" align="center"><strong>NO SKP</strong></td>
					<td width="90" height="12" align="center"><strong>MEREK USAHA</strong></td>
					<td width="55" height="12" align="center"><strong>NO KHOHIR</strong></td>
					<td width="50" height="12" align="center"><strong>TGL SKP</strong></td>
					<td width="55" height="12" align="center"><strong>MASA PAJAK</strong></td>
					<td width="68" height="12" align="center"><strong>POKOK</strong></td>
					<td width="55" height="12" align="center"><strong>DENDA</strong></td>
					<td width="68" height="12" align="center"><strong>JUMLAH</strong></td>
					
				
				
				
				
				</tr>';
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
				
		$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,a.masa_pajak_1,a.masa_pajak_2,
c.dp,d.denda,c.kompensasi,d.ketetapan,a.jumlah,a.status,DATE_FORMAT(d.tanggal,'%d/%m/%Y') AS tgl_sspd,d.setoran
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN sspd d ON d.nomor=a.no_skpd
WHERE $qr2 AND $qr AND d.tanggal>='".$awal."' AND d.tanggal<='".$akhir."' GROUP BY a.no_skpd ORDER BY d.tanggal ASC
");

	/* $query2 = $this->db->query("SELECT
SUM(sspd.setoran) AS jl
FROM
sspd 
LEFT JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
LEFT JOIN sspd_detail ON sspd_detail.no_sspd = sspd.no_sspd where $qr2 AND $qr AND sspd.tanggal>='".$awal."' AND sspd.tanggal<='".$akhir."'
")->row(); */

//$terima2 = $query2->jl;
		$i=1;
		$tot_pok=0;
		$tot_den=0;
		$total=0;
		$keluar=0;
		foreach($rc->result() as $rs){
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$kompensasi = $rs->kompensasi;
			$ketetapan = $rs->ketetapan;
			
			if($kompensasi!= 0){
				$denda2= $denda-$kompensasi;				
			}else{
				$denda2 = $denda;
			}
			
			
			$masaPajak = "";
			if($pajak1=="REK"){
				$masaPajak = $this->msistem->tanggal_format_indonesia($rs->masa_pajak_1)." - ".$this->msistem->tanggal_format_indonesia($rs->masa_pajak_2);
			}else{
				$masaPajak = $this->msistem->format_bulan_tahun($rs->masa_pajak_1)." - ".$this->msistem->format_bulan_tahun($rs->masa_pajak_2);
			}
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  }
				
			$report .=
				'<tr>
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->nama_pemilik.'</td>
					<td width="100" height="12" align="center">'.$rs->alamat_perusahaan.'</td>
					<td width="80" height="12" align="left">'.$rs->npwpd.'&nbsp;</td>
					<td width="80" height="12" align="left">'.$rs->no_skpd.'&nbsp;</td>
					<td width="90" height="12" align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$rs->no_kohir.'&nbsp;</td>
					<td width="50" height="12" align="center">'.$rs->tanggal.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$masaPajak.' </td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($ketetapan,0,",",".").'&nbsp;</td>
					<td width="55" height="12" align="right">Rp.&nbsp;'.number_format($denda2,0,",",".").'&nbsp;</td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($rs->jumlah,0,",",".").'&nbsp;</td>
					
				</tr>';
			$tot_pok = $tot_pok + $ketetapan;
			$tot_den = $tot_den + $rs->denda;
			$total = $total+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		 if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		} 
		
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr>
					<td width="615" align="center"><strong>JUMLAH</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_pok,0,",",".").'&nbsp;</strong></td>
					<td width="55" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_den,0,",",".").'&nbsp;</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($total,0,",",".").'&nbsp;</strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		$s4 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1'")->row();
		if($s4==NULL){
			$nama4 = '';
			$nip4 = '';
		} else {
			$nama4 = $s4->nama_ttd;
			$nip4 = $s4->nip_ttd;
			$jab4 = $s4->jabatan_ttd;
		
		}	
			
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		
		}
		
		$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '4'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama_ttd;
			$nip2 = $s2->nip_ttd;
			$jab2 = $s2->jabatan_ttd;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where username = '".$this->session->userdata('username')."'")->row();
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
					<td colspan="3">&nbsp;</td>
					<td>Jambi, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Diketahui, </td>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>'.$jab4.' Kota Jambi</td>
					<td>'.$jab1.'</td>
					<td>'.$jab2.'</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td><b><u>'.$nama4.'</u></b></td>
					<td><b><u>'.$nama1.'</u></b></td>
					<td><b><u>'.$nama2.'</u></b></td>
					<td><b><u>'.$nama3.'</u></b></td>
				</tr>
				<tr>
					<td>NIP. '.$nip4.'</td>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
				
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Data_Ketetapan'.'.pdf', 'I');		
	}
	
	//laporan penerimaan pajak
	function lap_ket2(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$data['pajak'] = $this->db->query("SELECT kd_rek, nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='11' AND SUBSTR(jns_pajak,1,3) !='4.2' AND SUBSTR(jns_pajak,1,2) !='00' AND status_aktif =1");
		$this->load->view('report_pajak/lap_ket2', $data);
	}
	
	public function excel_ket2(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ket2',$data);
	}
	
	public function excel_ket22(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ket22',$data);
	}
	public function excel_ket222(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ket222',$data);
	}
	
	public function excel_ketpbb(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ketpbb',$data);
	}
	
	function data_ket2($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kode_rekening ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_pajak='".$pajak1."'";
		}
		
		
		$i=1;
		
			$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,b.nama_perusahaan,
a.masa_pajak1,a.masa_pajak2,a.no_sspd,a.tahun_pajak,
c.dp,c.denda,c.jumlah,a.setoran,a.status,DATE_FORMAT(d.tgl_bayar,'%d/%m/%Y') AS tgl_bayar,
c.kode_rekening,c.nama_rekening,DATE_FORMAT(a.tanggal,'%d/%m/%Y') AS tanggal,c.dp
FROM sspd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN sspd_detail c ON c.no_sspd = a.no_sspd INNER JOIN pembayaran d ON a.no_sspd=d.no_sspd
WHERE $qr2 AND $qr AND d.tgl_bayar>='".$awal."' AND d.tgl_bayar<='".$akhir."' AND a.status='1' ORDER BY d.tgl_bayar ASC
");
foreach($rc->result() as $rs){
			$kode = $rs->kode_pajak;
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			$no_rek = $rs->kode_rekening;
			$nm_rek = $rs->nama_rekening;
			$thn = substr($rs->tahun_pajak,2,2);
			$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  }
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl_bayar."]]></cell>");
				echo("<cell><![CDATA[".$this->msistem->c_bln($rs->masa_pajak1)." - ".$this->msistem->c_bln($rs->masa_pajak2)." ".$thn."]]></cell>");
				echo("<cell><![CDATA[".$ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
				echo("<cell><![CDATA[".$rs->status."]]></cell>");
				echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function cetak_ket2(){
		$p = $_GET['full'];
		$t = explode('|',$p);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">SURAT KETETAPAN PAJAK DAERAH</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="15" height="12" align="center"><strong>NO.</strong></td>
					<td width="90" height="12" align="center"><strong>NAMA</strong></td>
					<td width="100" height="12" align="center"><strong>ALAMAT USAHA</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="80" height="12" align="center"><strong>NO SKP</strong></td>
					<td width="90" height="12" align="center"><strong>MEREK USAHA</strong></td>
					<td width="55" height="12" align="center"><strong>NO KHOHIR</strong></td>
					<td width="50" height="12" align="center"><strong>TGL SKP</strong></td>
					<td width="55" height="12" align="center"><strong>MASA PAJAK</strong></td>
					<td width="68" height="12" align="center"><strong>POKOK</strong></td>
					<td width="55" height="12" align="center"><strong>DENDA</strong></td>
					<td width="68" height="12" align="center"><strong>JUMLAH</strong></td>
					
				
				
				
				
				</tr>';
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
				
		$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,a.masa_pajak1,a.masa_pajak2,a.masa_pajak_1,
c.dp,c.denda,a.jumlah,a.status,DATE_FORMAT(d.tanggal,'%d/%m/%Y') AS tgl_sspd
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN sspd d ON d.nomor=a.no_skpd
WHERE $qr2 AND $qr AND a.tgl>='".$awal."' AND a.tgl<='".$akhir."' GROUP BY a.no_skpd ORDER BY d.tanggal ASC
");

	/* $query2 = $this->db->query("SELECT
SUM(sspd.setoran) AS jl
FROM
sspd 
LEFT JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
LEFT JOIN sspd_detail ON sspd_detail.no_sspd = sspd.no_sspd where $qr2 AND $qr AND sspd.tanggal>='".$awal."' AND sspd.tanggal<='".$akhir."'
")->row(); */

//$terima2 = $query2->jl;
		$i=1;
		$tot_pok=0;
		$tot_den=0;
		$total=0;
		$keluar=0;
		foreach($rc->result() as $rs){
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  }
				
			$report .=
				'<tr>
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->nama_pemilik.'</td>
					<td width="100" height="12" align="center">'.$rs->alamat_perusahaan.'</td>
					<td width="80" height="12" align="left">'.$rs->npwpd.'&nbsp;</td>
					<td width="80" height="12" align="left">'.$rs->no_skpd.'&nbsp;</td>
					<td width="90" height="12" align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$rs->no_kohir.'&nbsp;</td>
					<td width="50" height="12" align="center">'.$rs->tanggal.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$this->msistem->c_bln($rs->masa_pajak1).'-'.$this->msistem->c_bln($rs->masa_pajak2).' '.substr($rs->masa_pajak_1,2,2).' </td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($ketetapan,0,",",".").'&nbsp;</td>
					<td width="55" height="12" align="right">Rp.&nbsp;'.number_format($rs->denda,0,",",".").'&nbsp;</td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($rs->jumlah,0,",",".").'&nbsp;</td>
					
				</tr>';
			$tot_pok = $tot_pok + $ketetapan;
			$tot_den = $tot_den + $rs->denda;
			$total = $total+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		 if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		} 
		
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr>
					<td width="615" align="center"><strong>JUMLAH</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_pok,0,",",".").'&nbsp;</strong></td>
					<td width="55" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_den,0,",",".").'&nbsp;</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($total,0,",",".").'&nbsp;</strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		$s4 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1'")->row();
		if($s4==NULL){
			$nama4 = '';
			$nip4 = '';
		} else {
			$nama4 = $s4->nama_ttd;
			$nip4 = $s4->nip_ttd;
			$jab4 = $s4->jabatan_ttd;
		
		}	
			
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		
		}
		
		$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '4'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama_ttd;
			$nip2 = $s2->nip_ttd;
			$jab2 = $s2->jabatan_ttd;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where username = '".$this->session->userdata('username')."'")->row();
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
					<td colspan="3">&nbsp;</td>
					<td>Jambi, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Diketahui, </td>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>'.$jab4.' Kota Jambi</td>
					<td>'.$jab1.'</td>
					<td>'.$jab2.'</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td><b><u>'.$nama4.'</u></b></td>
					<td><b><u>'.$nama1.'</u></b></td>
					<td><b><u>'.$nama2.'</u></b></td>
					<td><b><u>'.$nama3.'</u></b></td>
				</tr>
				<tr>
					<td>NIP. '.$nip4.'</td>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
				
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Data_Ketetapan'.'.pdf', 'I');		
	}
	
	
	//laporan ketetapan pajak reklame
	function lap_ket_rek(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$data['pajak'] = $this->db->query("SELECT kd_rek, nm_rek FROM master_rekening WHERE jns_pajak='04'");
		$this->load->view('report_pajak/lap_ket_rek', $data);
	}
	
	public function excel_ket_rek(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_ket_rek',$data);
	}
	
	function data_ket_rek($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
		
		
		$i=1;
                        $rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,DATE_FORMAT(a.masa_pajak_1,'%d-%m-%y')AS masa_pajak1,DATE_FORMAT(a.masa_pajak_2,'%d-%m-%y')AS masa_pajak2,
c.dp,c.denda,a.jumlah,a.status,DATE_FORMAT(d.tanggal,'%d/%m/%Y') AS tgl_sspd,
DATE_FORMAT(e.ms_pajak1,'%d-%m-%y') AS ms_pajak1,DATE_FORMAT(e.ms_pajak2,'%d-%m-%y')AS ms_pajak2,e.tema
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN sspd d ON d.nomor=a.no_skpd LEFT JOIN sptpd_reklame_detail e ON e.no_sptpd = a.no_sptpd
WHERE $qr2 AND $qr AND d.tanggal>='".$awal."' AND d.tanggal<='".$akhir."' GROUP BY a.no_skpd ORDER BY d.tanggal ASC
");
                        
foreach($rc->result() as $rs){
			$kode = $rs->kode_pajak;
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			$no_rek = $rs->kode_rekening;
			$nm_rek = $rs->nama_rekening;
			$null = "0";
			$masa = $rs->masa_pajak1;
			$masa2 = $rs->masa_pajak2;
			$masa3 = $rs->ms_pajak1;
			$masa4 = $rs->ms_pajak2;
			
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
			}
				  
				  
			if(substr($rs->npwpd,8,2)=="02"){
				//$cetak_masa= $masa3. " s/d " .$masa4;
				$cetak_masa= $masa. " s/d " .$masa2;
			}else{
				$cetak_masa= $masa. " s/d " .$masa2;
			}
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->tema."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl_sspd."]]></cell>");
				echo("<cell><![CDATA[".$cetak_masa."]]></cell>");
				echo("<cell><![CDATA[".$ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
				echo("<cell><![CDATA[".$rs->status."]]></cell>");
				echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function cetak_ket_rek(){
		$p = $_GET['full'];
		$t = explode('|',$p);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">SURAT KETETAPAN PAJAK DAERAH</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="15" height="12" align="center"><strong>NO.</strong></td>
					<td width="90" height="12" align="center"><strong>NAMA</strong></td>
					<td width="100" height="12" align="center"><strong>ALAMAT USAHA</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="80" height="12" align="center"><strong>NO SKP</strong></td>
					<td width="90" height="12" align="center"><strong>MEREK USAHA</strong></td>
					<td width="55" height="12" align="center"><strong>TEMA</strong></td>
					<td width="50" height="12" align="center"><strong>TGL SKP</strong></td>
					<td width="55" height="12" align="center"><strong>MASA PAJAK</strong></td>
					<td width="68" height="12" align="center"><strong>POKOK</strong></td>
					<td width="55" height="12" align="center"><strong>DENDA</strong></td>
					<td width="68" height="12" align="center"><strong>JUMLAH</strong></td>
					
				
				
				
				
				</tr>';
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,6,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
				
		$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,DATE_FORMAT(a.masa_pajak_1,'%d-%m-%y')AS masa_pajak1,DATE_FORMAT(a.masa_pajak_2,'%d-%m-%y')AS masa_pajak2,
c.dp,c.denda,a.jumlah,a.status,DATE_FORMAT(d.tanggal,'%d/%m/%Y') AS tgl_sspd,
DATE_FORMAT(e.ms_pajak1,'%d-%m-%y') AS ms_pajak1,DATE_FORMAT(e.ms_pajak2,'%d-%m-%y')AS ms_pajak2,e.tema
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN sspd d ON d.nomor=a.no_skpd LEFT JOIN sptpd_reklame_detail e ON e.no_sptpd = a.no_sptpd
WHERE $qr2 AND $qr AND d.tanggal>='".$awal."' AND d.tanggal<='".$akhir."' GROUP BY a.no_skpd ORDER BY d.tanggal ASC
");

	/* $query2 = $this->db->query("SELECT
SUM(sspd.setoran) AS jl
FROM
sspd 
LEFT JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
LEFT JOIN sspd_detail ON sspd_detail.no_sspd = sspd.no_sspd where $qr2 AND $qr AND sspd.tanggal>='".$awal."' AND sspd.tanggal<='".$akhir."'
")->row(); */

//$terima2 = $query2->jl;
		$i=1;
		$tot_pok=0;
		$tot_den=0;
		$total=0;
		$keluar=0;
		foreach($rc->result() as $rs){
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			$masa = $rs->masa_pajak1;
			$masa2 = $rs->masa_pajak2;
			$masa3 = $rs->ms_pajak1;
			$masa4 = $rs->ms_pajak2;
			
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
			}
				  
				  
			if(substr($rs->npwpd,8,2)=="02"){
				/* $cetak_masa= $masa3. " s/d " .$masa4; */
				$cetak_masa= $masa. " s/d " .$masa2;
				
			}else{
				$cetak_masa= $masa. " s/d " .$masa2;
			}
			
			$report .=
				'<tr>
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->nama_pemilik.'</td>
					<td width="100" height="12" align="center">'.$rs->alamat_perusahaan.'</td>
					<td width="80" height="12" align="left">'.$rs->npwpd.'&nbsp;</td>
					<td width="80" height="12" align="left">'.$rs->no_skpd.'&nbsp;</td>
					<td width="90" height="12" align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$rs->tema.'&nbsp;</td>
					<td width="50" height="12" align="center">'.$rs->tanggal.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$cetak_masa.' </td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($ketetapan,0,",",".").'&nbsp;</td>
					<td width="55" height="12" align="right">Rp.&nbsp;'.number_format($rs->denda,0,",",".").'&nbsp;</td>
					<td width="68" height="12" align="right">Rp.&nbsp;'.number_format($rs->jumlah,0,",",".").'&nbsp;</td>
					
				</tr>';
			$tot_pok = $tot_pok + $ketetapan;
			$tot_den = $tot_den + $rs->denda;
			$total = $total+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		 if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		} 
		
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr>
					<td width="615" align="center"><strong>JUMLAH</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_pok,0,",",".").'&nbsp;</strong></td>
					<td width="55" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tot_den,0,",",".").'&nbsp;</strong></td>
					<td width="68" height="12" align="right"><strong>Rp.&nbsp;'.number_format($total,0,",",".").'&nbsp;</strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		$s4 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1'")->row();
		if($s4==NULL){
			$nama4 = '';
			$nip4 = '';
		} else {
			$nama4 = $s4->nama_ttd;
			$nip4 = $s4->nip_ttd;
			$jab4 = $s4->jabatan_ttd;
		
		}	
			
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		
		}
		
		$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '4'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama_ttd;
			$nip2 = $s2->nip_ttd;
			$jab2 = $s2->jabatan_ttd;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where username = '".$this->session->userdata('username')."'")->row();
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
					<td colspan="3">&nbsp;</td>
					<td>Jambi, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Diketahui, </td>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>'.$jab4.' Kota Jambi</td>
					<td>'.$jab1.'</td>
					<td>'.$jab2.'</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td><b><u>'.$nama4.'</u></b></td>
					<td><b><u>'.$nama1.'</u></b></td>
					<td><b><u>'.$nama2.'</u></b></td>
					<td><b><u>'.$nama3.'</u></b></td>
				</tr>
				<tr>
					<td>NIP. '.$nip4.'</td>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
				
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Data_Ketetapan'.'.pdf', 'I');		
	}
	
	//laporan WAJIB PAJAK REKLAMES
	function lap_rek(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$data['pajak'] = $this->db->query("SELECT kd_rek, nm_rek FROM master_rekening WHERE jns_pajak='04'");
		$this->load->view('report_pajak/lap_rek', $data);
	}
	
	public function excel_rek(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_rek',$data);
	}
	
	function data_rek($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,7,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
		
		
		$i=1;
		
			/* $rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_pemilik,a.npwpd,a.no_skpd,b.nama_perusahaan,
a.no_kohir,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tanggal,masa_pajak1,masa_pajak2,
c.dp,c.denda, a.jumlah AS jumlah,a.status
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd
WHERE $qr2 AND $qr AND a.tgl>='".$awal."' AND a.tgl<='".$akhir."' GROUP BY a.no_skpd ORDER BY a.tgl ASC
"); */
$rc = $this->db->query("SELECT e.id,b.nama_pemilik,b.alamat_perusahaan,a.npwpd,b.nama_perusahaan,e.tema,e.lokasi,e.panjang,e.lebar,e.sisi,e.unit,DATE_FORMAT(a.masa_pajak_1,'%d/%m/%Y') AS masa_pajak_1,
DATE_FORMAT(a.masa_pajak_2,'%d/%m/%Y') AS masa_pajak_2,DATE_FORMAT(f.tanggal,'%d/%m/%Y') AS tanggal
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN nota_hitung d ON d.no_nota = a.nota_hitung LEFT JOIN sptpd_reklame_detail e ON e.no_sptpd = d.sptpd LEFT JOIN sspd f ON f.nomor = a.no_skpd
WHERE $qr2 AND $qr AND a.tgl>='".$awal."' AND a.tgl<='".$akhir."' GROUP BY e.id
");
foreach($rc->result() as $rs){
			$kode = $rs->kode_pajak;
			$jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			$no_rek = $rs->kode_rekening;
			$nm_rek = $rs->nama_rekening;
			$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			
			/* if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  } */
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tema."]]></cell>");
				echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->panjang."x".$rs->lebar."x".$rs->sisi."SISI x".$rs->unit."]]></cell>");
				echo("<cell><![CDATA[".$rs->masa_pajak_1." s/d ".$rs->masa_pajak_2."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function cetak_rek(){
		$p = $_GET['full'];
		$t = explode('|',$p);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">DAFTAR WAJIB PAJAK REKLAME</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="15" height="12" align="center"><strong>NO.</strong></td>
					<td width="80" height="12" align="center"><strong>NAMA<br>NPWPD</br></strong></td>
					<td width="100" height="12" align="center"><strong>TEMA REKLAME</strong></td>
					<td width="100" height="12" align="center"><strong>NAMA USAHA</strong></td>
					<td width="100" height="12" align="center"><strong>ALAMAT USAHA</strong></td>
					<td width="170" height="12" align="center"><strong>LOKASI PEMASANGAN</strong></td>
					<td width="60" height="12" align="center"><strong>UKURAN</strong></td>
					<td width="40" height="12" align="center"><strong>JUMLAH</strong></td>
					<td width="55" height="12" align="center"><strong>T.M.T</strong></td>
					<td width="45" height="12" align="center"><strong>TGL BAYAR</strong></td>
					
					
				
				
				
				
				</tr>';
		
		if($pajak==NULL){
			$kd_pjk="";
			$qr2 ="";
		} else {
			$kd_pjk = substr($pajak,7,2);
			$qr2 ="c.kd_rek ='".$pajak."'";
		}
				
		
		if($kd_pjk=="01"){
			$pajak1 = "HTL";
		}else if($kd_pjk=="02"){
			$pajak1 = "RES";
		}else if($kd_pjk=="03"){
			$pajak1 = "HIB";
		}else if($kd_pjk=="04"){
			$pajak1 = "REK";
		}else if($kd_pjk=="05"){
			$pajak1 = "LIS";
		}else if($kd_pjk=="07"){
			$pajak1 = "PKR";
		}else if($kd_pjk=="08"){
			$pajak1 = "AIR";
		}else if($kd_pjk=="09"){
			$pajak1 = "WLT";
		}else if($kd_pjk=="11"){
			$pajak1 = "GAL";
		}else{
			$pajak1 = "";
		}
		
		if($pajak1==""){
			$qr="";
		} else {
			$qr="a.kode_sptpd='".$pajak1."'";
		}
				
		$rc = $this->db->query("SELECT e.id,b.nama_pemilik,b.alamat_perusahaan,a.npwpd,b.nama_perusahaan,e.tema,e.lokasi,e.panjang,e.lebar,e.sisi,e.unit,DATE_FORMAT(a.masa_pajak_1,'%d/%m/%Y') AS masa_pajak_1,
DATE_FORMAT(a.masa_pajak_2,'%d/%m/%Y') AS masa_pajak_2,DATE_FORMAT(f.tanggal,'%d/%m/%Y') AS tanggal
FROM skpd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN skpd_child c ON c.skpd = a.no_skpd LEFT JOIN nota_hitung d ON d.no_nota = a.nota_hitung LEFT JOIN sptpd_reklame_detail e ON e.no_sptpd = d.sptpd LEFT JOIN sspd f ON f.nomor = a.no_skpd
WHERE $qr2 AND $qr AND a.tgl>='".$awal."' AND a.tgl<='".$akhir."' GROUP BY e.id
");

	/* $query2 = $this->db->query("SELECT
SUM(sspd.setoran) AS jl
FROM
sspd 
LEFT JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
LEFT JOIN sspd_detail ON sspd_detail.no_sspd = sspd.no_sspd where $qr2 AND $qr AND sspd.tanggal>='".$awal."' AND sspd.tanggal<='".$akhir."'
")->row(); */

//$terima2 = $query2->jl;
		$i=1;
		$tot_pok=0;
		$tot_den=0;
		$total=0;
		$keluar=0;
		$unit2 = 0;
		 foreach($rc->result() as $rs){
			/* $jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda; */
			
			/*if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  } */
				  $unit2+=$rs->unit;
				
			$report .=
				'<tr>
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="80" height="12" align="left">'.$rs->nama_pemilik.'<br>'.$rs->npwpd.'</br></td>
					<td width="100" height="12" align="center">'.$rs->tema.'</td>
					<td width="100" height="12" align="center">'.$rs->nama_perusahaan.'</td>
					<td width="100" height="12" align="left">'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="170" height="12" align="left">'.$rs->lokasi.'&nbsp;</td>
					<td width="60" height="12" align="center">'.$rs->panjang.' X '.$rs->lebar.' X '.$rs->sisi.' SISI&nbsp;</td>
					<td width="40" height="12" align="center">'.$rs->unit.'&nbsp;</td>
					<td width="55" height="12" align="center">'.$rs->masa_pajak_1.' s/d '.$rs->masa_pajak_2.'&nbsp;</td>
					<td width="45" height="12" align="center">'.$rs->tanggal.'&nbsp;</td>
					
				</tr>';
			/* $tot_pok = $tot_pok + $ketetapan;
			$tot_den = $tot_den + $rs->denda;
			$total = $total+$rs->jumlah; */
			//$keluar = $keluar+$null;
			$i++;
		}
	
		  /* if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		}  */ 
		
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		
		
		
		$report .=
				'<tr>
					<td width="625" align="center"><strong>JUMLAH ........</strong></td>
					<td width="40" height="12" align="center">'.$unit2.'<strong>&nbsp;</strong></td>
					<td width="55" height="12" align="right"><strong></strong></td>
					<td width="45" height="12" align="right"><strong></strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama_ttd;
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		
		}
		
		$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '4'")->row();
		if($s2==NULL){
			$nama2 = '';
			$nip2 = '';
		} else {
			$nama2 = $s2->nama_ttd;
			$nip2 = $s2->nip_ttd;
			$jab2 = $s2->jabatan_ttd;
		}
				
		$s3 = $this->db->query("select nama, nip, bagian from admin where username = '".$this->session->userdata('username')."'")->row();
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
					<td>Jambi, '.$t.' '.$b.' '.$y.'</td>
				</tr>
				<tr>
					<td>Mengetahui, </td>
					<td>Diperiksa Oleh :</td>
					<td>Dibuat Oleh :</td>
				</tr>
				<tr>
					<td>'.$jab1.'</td>
					<td>'.$jab2.'</td>
					<td>'.$bagian3.'</td>
				</tr>
				<tr>
					<td colspan="3" height="50"></td>
				</tr>
				<tr>
					<td><b><u>'.$nama1.'</u></b></td>
					<td><b><u>'.$nama2.'</u></b></td>
					<td><b><u>'.$nama3.'</u></b></td>
				</tr>
				<tr>
					<td>NIP. '.$nip1.'</td>
					<td>NIP. '.$nip2.'</td>
					<td>NIP. '.$nip3.'</td>
				</tr>
				
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Data_Reklame'.'.pdf', 'I');		
	}
	
	function buku_bantu(){
		$data['bulan'] = $this->msistem->bulan();
		$data['tahun'] = $this->msistem->tahun();
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/buku_bantu',$data);
	}
	
	function data_buku($bln="",$thn="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		$bulan = $thn.'-'.$bln;
		
		$query = $this->db->query("SELECT
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal,
view_perusahaan.npwpd_perusahaan,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sspd.nomor,
sspd.kode_pajak,
sspd.total_setoran
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where month(sspd.tanggal)='".$bln."' and sspd.tahun_transaksi='".$thn."' $qr");
		$i=1;
		foreach($query->result() as $rs){
			$rc = $this->db->query("select kode_rekening, nama_rekening, sum(DISTINCT jumlah) as jumlah from sspd_detail where no_sspd = '".$rs->no_sspd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kode_rekening;
			$nm_rek = $rc->nama_rekening;
			$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$no_rek." - ".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan." - ".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->total_setoran."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function sts($bln="",$thn=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		$bulan = $thn.'-'.$bln;
		
		$query = $this->db->query("SELECT
		sspd.no_sspd,
		DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal,
		view_perusahaan.npwpd_perusahaan,
		view_perusahaan.nama_perusahaan,
		view_perusahaan.alamat_perusahaan,
		sspd.nomor,
		sspd.kode_pajak,
		sspd.setoran
		FROM
		view_perusahaan
		INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where month(sspd.tanggal)='".$bln."' and sspd.tahun_transaksi='".$thn."' $qr");
		$i=1;
		foreach($query->result() as $rs){
			$rc = $this->db->query("select kode_rekening, nama_rekening, sum(DISTINCT jumlah) as jumlah from sspd_detail where no_sspd = '".$rs->no_sspd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kode_rekening;
			$nm_rek = $rc->nama_rekening;
			$null = "0";
			if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			}
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$no_rek." - ".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan." - ".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
	}
	
	function ttd_buku(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_buku',$data);
	}
	
	function cetak_buku(){
		$p = $_GET['full'];
		$t = explode('|',$p);
		$bln = $t[0];
		$thn = $t[1];
		$pajak = $t[2];
		$ttd = $t[3];
		
		$bln2 = $thn.'-'.$bln;
		$bulan = $this->msistem->v_bln($bln);
	
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMPATDA_JAMBI');
		$pdf->SetKeywords('SIMPATDA_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(35,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN BUKU KAS UMUM</h2>
			<p align="center">PERIODE : '.$bulan.' '.$thn.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="12" align="center"><strong>NO.</strong></td>
					<td width="90" height="12" align="center"><strong>NO. SSPD</strong></td>
					<td width="210" height="12" align="center"><strong>REKENING</strong></td>
					<td width="200" height="12" align="center"><strong>DITERIMA DARI</strong></td>
					<td width="105" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="145" height="12" align="center"><strong>JUMLAH</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal,
view_perusahaan.npwpd_perusahaan,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sspd.nomor,
sspd.kode_pajak,
sspd.total_setoran
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where tanggal like '".$bln2."%' $qr");
		$i=1;
		$terima=0;
		$keluar=0;
		foreach($query->result() as $rs){
			$rc = $this->db->query("select kode_rekening, nama_rekening, sum(DISTINCT jumlah) as jumlah from sspd_detail where no_sspd = '".$rs->no_sspd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kode_rekening;
			$nm_rek = $rc->nama_rekening;
			$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
				
			$report .=
				'<tr>
					<td width="20" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->no_sspd.'</td>
					<td width="210" height="12" align="left">&nbsp;'.$no_rek." - ".$nm_rek.'</td>
					<td width="200" height="12" align="left">&nbsp;'.$rs->nama_perusahaan." - ".$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="105" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="145" height="12" align="right">Rp.&nbsp;'.number_format($rs->total_setoran,2,",",".").'&nbsp;</td>
				</tr>';
			
			$terima = $terima+$rc->jumlah;
			$keluar = $keluar+$null;
			$i++;
		}
		
		$report .=
				'<tr>
					<td width="625" align="center"><strong>JUMLAH</strong></td>
					<td width="145" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima,2,",",".").'&nbsp;</strong></td>
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
					 <td width="'.$wid.'" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
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
		$pdf->Output('Report_Buku_Pembantu'.'.pdf', 'I');		
	}
	
	function ttd_ktgl(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_kas_tgl',$data);
	}
	
	function data_sktgl(){
		$pajak = $this->input->post('pajak');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT
sum(sspd.setoran) as jml
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where sspd.tanggal>='".$awal."' and sspd.tanggal<='".$akhir."' $qr")->row();
		$last = number_format($query->jml);
		$null = "0";
		$gb = $last.'|'.$null;
		echo $gb;
	}
	
	function cetak_ktgl(){
			$p = $_GET['full'];
		$t = explode('|',$p);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
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
		$pdf->SetAutoPageBreak(true,25);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN PENERIMAAN</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="15" height="12" align="center"><strong>NO.</strong></td>
					<td width="80" height="12" align="center"><strong>NO. SSPD</strong></td>
					<td width="60" height="12" align="center"><strong>TANGGAL</strong></td>
					<td width="170" height="12" align="center"><strong>URAIAN</strong></td>
					<td width="70" height="12" align="center"><strong>NAMA PEMILIK</strong></td>
					<td width="60" height="12" align="center"><strong>KODE REKENING</strong></td>
					<td width="135" height="12" align="center"><strong>NAMA REKENING</strong></td>
					<td width="70" height="12" align="center"><strong>POKOK</strong></td>
					<td width="70" height="12" align="center"><strong>DENDA</strong></td>
					<td width="70" height="12" align="center"><strong>PENERIMAAN</strong></td>
					
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
				
		$query = $this->db->query("SELECT
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal,
identitas_perusahaan.nama_perusahaan,
identitas_pemilik.nama_pemilik,
sspd.nomor,
sspd.kode_pajak,
sspd.ketetapan,
sspd.denda,
sspd.setoran
FROM
identitas_perusahaan
INNER JOIN sspd ON identitas_perusahaan.npwpd_perusahaan = sspd.npwpd
INNER JOIN identitas_pemilik ON identitas_pemilik.npwpd_pemilik = identitas_perusahaan.npwpd_pemilik where sspd.tanggal>='".$awal."' and sspd.tanggal<='".$akhir."' $qr GROUP BY sspd.no_sspd ORDER BY sspd.tanggal ASC");

	$query2 = $this->db->query("SELECT
sum(sspd.setoran) as jl
FROM
identitas_perusahaan
INNER JOIN sspd ON identitas_perusahaan.npwpd_perusahaan = sspd.npwpd where sspd.tanggal>='".$awal2."' and sspd.tanggal<='".$akhir2."' $qr")->row();

$terima2 = $query2->jl;
		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		$keluar=0;
		foreach($query->result() as $rs){
			$rc = $this->db->query("select kode_rekening, nama_rekening, sum(DISTINCT jumlah) as jumlah from sspd_detail where no_sspd = '".$rs->no_sspd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kode_rekening;
			$nm_rek = $rc->nama_rekening;
			//$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			if($no_rek == '4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($no_rek == '4.1.1.03.16'){
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
			if($no_rek == '4.1.1.03.16.'){
				$no_rek = '4.1.1.03.16';
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
				
			$report .=
				'<tr>
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="80" height="12" align="center">'.$rs->no_sspd.'</td>
					<td width="60" height="12" align="center">'.$rs->tanggal.'</td>
					<td width="170" height="12" align="left">&nbsp;Diterima dari '.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="70" height="12" align="left">'.$rs->nama_pemilik.'&nbsp;</td>
					<td width="60" height="12" align="center">&nbsp;'.$no_rek.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;'.$nm_rek.'&nbsp;</td>
					<td width="70" height="12" align="right">Rp.&nbsp;'.number_format($rs->ketetapan,0,",",".").'&nbsp;</td>
					<td width="70" height="12" align="right">Rp.&nbsp;'.number_format($rs->denda,0,",",".").'&nbsp;</td>
					<td width="70" height="12" align="right">Rp.&nbsp;'.number_format($rs->setoran,0,",",".").'&nbsp;</td>
					
				</tr>';
			
			$ketetapan = $ketetapan+$rs->ketetapan;
			$denda = $denda+$rs->denda;
			$terima = $terima+$rs->setoran;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		}
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr>
					<td width="590" align="center"><strong>JUMLAH</strong></td>
					<td width="70" height="12" align="right"><strong>Rp.&nbsp;'.number_format($ketetapan,0,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="right"><strong>Rp.&nbsp;'.number_format($denda,0,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima,0,",",".").'&nbsp;</strong></td>
					
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
					 <td width="'.$wid.'" align="center">Nanga Pinoh, '.$day.' '.$mon.' '.$year.'</td>
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
							'<td width="'.$wid.'" height="10" align="center"><b><u>'.$rs->nama_ttd.'</b></u></td>';
				//	}
				}
			}
			
			$us = $this->db->query("select nama from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center"><b><u>'.$us->nama.'</b></u></td>
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
		$pdf->Output('Report_Buku_Kas'.'.pdf', 'I');		
	}

	function penetapan_ret(){
		$data['pajak'] = $this->db->query("SELECT kd_skpd,nama_skpd FROM master_skpd");
		$this->load->view('report_pajak/penetapan_ret', $data);
	}
	
	function data_penetapan_ret($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else{
			$qr="and c.kd_skpd='$pajak'";
		}
		/*$query = $this->db->query("SELECT
			DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
			c.no_skpd,
			a.nama_perusahaan,
			c.masa_pajak1,
			c.tahun,
			c.masa_pajak_1,
			c.masa_pajak_2,
			c.jumlah
			FROM
			identitas_perusahaan a
			INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan WHERE  c.tgl>='".$awal."' and c.tgl<='".$akhir."' $qr GROUP BY c.no_skpd ORDER BY c.no_skpd ASC 34");
					*/
		$aaa	= "SELECT DATE_FORMAT(a.tgl_terima,'%d/%m/%Y') AS tgl,
					a.skpd_pengelola,b.nm_rek,c.sub_jns_retribusi,c.petugas_penagih,c.jml_buku,b.dp,a.jumlah,a.no_karcis1,a.no_karcis2 
					FROM skrd a INNER JOIN skrd_child b ON a.no_skrd=b.skrd
					INNER JOIN sptrd c ON a.no_sptrd=c.no_sptrd
					WHERE  a.tgl_terima>='$awal' and a.tgl_terima<='$akhir' $qr";
		$query	= $this->db->query($aaa);
		$i=1;
		foreach($query->result() as $rs){
			$no_rek = $rs->kd_rek;
			$nm_rek = $rs->nm_rek;
			$pokok	= $rs->jumlah - $rs->denda;
			$null = "0";
			if($no_rek=='4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($rs->status=1){
				$status="Sudah Bayar";
			}else{
				$status="Belum Bayar";
			}
			
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->skpd_pengelola."]]></cell>");
				echo("<cell><![CDATA[".$rs->nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->petugas_penagih."]]></cell>");
				echo("<cell><![CDATA[".$rs->jml_buku."]]></cell>");
				echo("<cell><![CDATA[".$rs->dp."]]></cell>");
				echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_karcis1." - ".$rs->no_karcis2."]]></cell>");
				//echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			//$muncul = "</rows>";
			$i++;	
		}
		echo "</rows>";
	}
	
	function cetak_penetapan_ret(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$awal1 = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		$marginBawah = $t[3];
		$cetak = $t[4];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal1);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$pp = $s[0];
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'LEGAL', true, 'UTF-8', false); 
			
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('P','LEGAL',false);
		//set data
		
		
			//$kode_pajak = $this->db->query("SELECT nm_rek FROM master_rekening WHERE kd_rek='$pajak'")->row();
			/* $kd_rek	= $pajak2;
			$nm_rek = $kode_pajak->nm_rek; */	
			if($pajak==NULL){
			$qr="";
			} else{
			$qr="and c.kd_skpd='$pajak'";
			}
			
	
		$report = '';
		$report .=
			'<table borde="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="7" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="7" align="center">
									<b>BADAN PENDAPATAN DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="7" align="center">
									<b></b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td colspan="7" align="center">
									<b>DAFTAR SURAT KETETAPAN DAN REGISTER RETRIBUSI DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td colspan="7" align="center">
									TAHUN '.$pp.'
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td colspan="7" align="center">
									
								</td>
					
							</tr>
					
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="18" rowspan="2" align="center"><strong>NO</strong></td>
					<td width="130" rowspan="2" align="center"><strong>SKPD</strong></td>
					<td width="130" rowspan="2" align="center"><strong>JENIS KARCIS</strong></td>
					<td width="280" colspan="4" align="center"><strong>PENGEMBALIAN KARCIS</strong></td>
				</tr>
			
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="50" align="center" align="center"><strong>BUKU</strong></td>
					<td width="65" align="center" align="center"><strong>NOMINAL (Rp)</strong></td>
					<td width="65" align="center" align="center"><strong>TOTAL (Rp)</strong></td>
					<td width="100" align="center" align="center"><strong>NO SERI KARCIS</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
			} else{
			$qr="and c.kd_skpd='$pajak'";
			}
		
		$aaa	= "SELECT DATE_FORMAT(a.tgl_terima,'%d/%m/%Y') AS tgl, a.skpd_pengelola,b.nm_rek,b.kd_rek,c.sub_jns_retribusi,c.petugas_penagih,d.nm_rek AS rincian,
					c.jml_buku,b.dp,a.jumlah,a.no_karcis1,a.no_karcis2 
					FROM skrd a 
					INNER JOIN skrd_child b ON a.no_skrd=b.skrd 
					INNER JOIN sptrd c ON a.no_sptrd=c.no_sptrd 
					LEFT JOIN master_rekening_rincian d ON c.sub_jns_retribusi = d.kd_rek 
					WHERE  a.tgl_terima>='$awal1' and a.tgl_terima<='$akhir' $qr";
		$query = $this->db->query($aaa);

		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		//$sub_jns=0;
		$keluar=0;
		foreach($query->result() as $rs){
			
			/* 
			$rc = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening_rincian WHERE header = '".$rs->kd_rek."'")->row(); */
			$sub_jns = $rs->rincian;
			$nm_rek = $rs->nm_rek; 
			/*$bln = $this->msistem->v_bln($rs->masa_pajak1); 
			$a = explode("-",$rs->masa_pajak_1);
			$a0 = $a[0];
			$a1 = $a[1];
			$a2 = $a[2];
			$awal	= $this->msistem->c_bln($a1);
			$b = explode("-",$rs->masa_pajak_2);
			$b0 = $b[0];
			$b1 = $b[1];
			$b2 = $b[2];
			$akhir 	= $this->msistem->c_bln($b1);*/
			if($sub_jns==null){
				$muncul=$nm_rek;
			}else{
				$muncul=$sub_jns;
			}
			
				
			$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="18"  align="center">'.$i.' </td>
					<td width="130" align="left">'.$rs->skpd_pengelola.'</td>
					<td width="130" align="center">'.$muncul.'</td>
					<td width="50" align="center">'.$rs->jml_buku.'&nbsp;</td>
					<td width="65" align="right">'.number_format($rs->dp,2,",",".").'</td>
					<td width="65" align="right">'.number_format($rs->jumlah,2,",",".").'</td>
					<td width="100" align="center">'.$rs->no_karcis1.' - '.$rs->no_karcis2.'</td>
					
				</tr>';
			
			//$ketetapan = $ketetapan+$rs->ketetapan;
			//$denda = $denda+$rs->denda;
			$terima = $terima+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		}
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="393" colspan="5" align="center"><strong>JUMLAH</strong></td>
					<td width="65"  align="right"><strong>'.number_format($terima,2,",",".").'</strong></td>
					<td width="100"  align="right"></td>	
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$us = $this->db->query("SELECT nama,nip FROM admin where username = '".$this->session->userdata('username')."'")->row();
			$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
			$s11 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '0' ")->row();
			if($awal1>='2018-01-19'){
				$nama1 = strtoupper($s11->nama_ttd);;
				$nip1 = $s11->nip_ttd;
				$jab1 = $s11->jabatan_ttd;
				$muncul = '202';
			} else {
				$nama1 = strtoupper($s1->nama_ttd);
				$nip1 = $s1->nip_ttd;
				$jab1 = $s1->jabatan_ttd;
				$muncul = '232';
			}
			$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '3' ")->row();
			if($s2==NULL){
				$nama2 = '';
				$nip2 = '';
			} else {
				$nama2 = strtoupper($s2->nama_ttd);
				$nip2 = $s2->nip_ttd;
				$jab2 = $s2->jabatan_ttd;
			}
			if($us->nip=='-'){
				$nip_us = "";
			}else{
				$nip_us = 'NIP. '.$us->nip;
			}
		$report .=
			'<!--<table border="0">
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
									<td width="262">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$day.' '.$mon.' '.$year.'</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
									<td width="30">&nbsp;</td>
									<td width="120" align="center">&nbsp; Petugas SIMPADA</td>
									<td width="120"></td>
									<td width="300" align="center">'.$jab2.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="26">&nbsp;</td>
									<td width="130" align="center">&nbsp; <u>'.strtoupper($us->nama).'</u></td>
									<td width="174"></td>
									<td width="200" align="center"><u>'.$nama2.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="25">&nbsp;</td>
									<td width="140">&nbsp;'.$nip_us.'</td>
									<td width="165"></td>
									<td width="200" align="center">NIP. '.$nip2.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="250">&nbsp;</td>
									<td width="130" font-size:10px>&nbsp;Mengetahui,</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="195">&nbsp;</td>
									<td width="170" font-size:10px>&nbsp;An. Kepala BAPENDA Kab. Melawi</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="175">&nbsp;</td>
									<td width="210" font-size:10px>&nbsp;'.$jab1.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="'.$muncul.'">&nbsp;</td>
									<td width="140"><u>'.$nama1.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="202">&nbsp;</td>
									<td width="160">&nbsp;NIP. '.$nip1.'</td>
								</tr>
								
			</table>-->';
		$data['prev']= $report;
			
			 
			 
	switch($cetak) {       
        case 1;
			$pdf->writeHTML($report, true, false, true, false);
			$pdf->lastPage();
			$pdf->Output('Report_Transaksi_Penetapan'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_penetapan_retribusi";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}	 
	}
	
function lap_pad(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd !='RET' AND kode_sptpd !='PLL'");
		$this->load->view('report_pajak/lap_pad', $data);
	}
	
	function cetak_lap_pad(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$tgl_awal = $t[0];
		$b = explode('-',$tgl_awal);
		$b1 = $b[1];
		$b1_1 = $b1-1;
		$b2 = $b[0];
		$awal 				= $this->msistem->v_bln($b1);
		$tgl_akhir = $t[1];
		$b = explode('-',$tgl_akhir);
		$c1 = $b[1];
		$c1_1 = $b1-1;
		$c2 = $b[0];
		$akhir 				= $this->msistem->v_bln($c1);
		$marginBawah = $t[2];
		$cetak = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','LEGAL',false);
		//set data
		
		$tahun		= date("Y");
		$tahun_l	= $tahun-1;
		
		if($awal==$akhir){
			$bulan=strtoupper($awal);
		}else{
			$bulan= strtoupper($awal).' - '.strtoupper($akhir).'';
		}
	
		$report = '';
		$report .=
			'<table borde="0">
					
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="6" align="center" >
									<b>DAFTAR PAJAK DAN RETRIBUSI YANG TELAH DI STOR PADA KAS DAERAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								
								<td colspan="6" align="center">
									<b>BULAN '.$bulan.' '.$b2.'</b>
								</td>
							</tr>
							<tr>
								<td></td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1" cellpadding="2" cellspacing="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" rowspan="2" valign="center" align="center"><strong>KODE REK</strong></td>
					<td width="280" rowspan="2" valign="center" align="center"><strong>Uraian</strong></td>
					<td width="140" rowspan="2" valign="center" align="center"><strong>Target</strong></td>
					<td width="200" colspan="2" valign="center" align="center"><strong>Realisasi Penerimaan</strong></td>
					<td width="90" rowspan="2" valign="center" align="center"><strong>Jumlah</strong></td>
					<td width="120" rowspan="2" valign="center" align="center"><strong>Bertambah/Berkurang</strong></td>
					<td width="50" rowspan="2" valign="center" align="center"><strong>%</strong></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="100"  valign="center" align="center"><strong>Bulan Lalu</strong></td>
					<td width="100" valign="center" align="center"><strong>Bulan Ini</strong></td>
				</tr>
				';
				
		$query2 =  $this->db->query("SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.bln_lalu,b.bln_ini FROM(
					SELECT LEFT(a.kd_rek,3) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE SUBSTR(kd_rek,1,3) ='4.1' AND a.status_aktif='1')a
					LEFT JOIN (SELECT IFNULL(LEFT(b.kode_rekening,3),0) AS kode_rekening,
					SUM(CASE WHEN MONTH(tanggal) <='$b1_1'  THEN setoran ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tanggal) ='$b1'  THEN setoran ELSE 0 END) AS bln_ini 
					FROM sspd a
					LEFT JOIN sspd_detail b ON a.no_sspd = b.no_sspd
					GROUP BY LEFT(b.kode_rekening,3))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='3') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='3'")->row();
		
		$query = "SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE LENGTH(kd_rek)='11' AND LEFT(kd_rek,5)='4.1.1' AND status_aktif='1' AND jns_pajak!='12')a
					LEFT JOIN (SELECT b.kode_rekening,
					SUM(CASE WHEN MONTH(tanggal) <='$b1_1'  THEN setoran ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tanggal) ='$b1'  THEN setoran ELSE 0 END) AS bln_ini 
					FROM sspd a
					LEFT JOIN sspd_detail b ON a.no_sspd = b.no_sspd
					GROUP BY kode_rekening)b
					ON a.kd_rek=b.kode_rekening
					UNION ALL
					SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE LENGTH(kd_rek)='11' AND LEFT(kd_rek,5)='4.1.1' AND status_aktif='1' AND jns_pajak='12')a
					LEFT JOIN (SELECT b.kd_rek,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN jml_dibayar ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN jml_dibayar ELSE 0 END) AS bln_ini 
					FROM dt_pbb_bphtb a
					LEFT JOIN dt_detail_pbb_bphtb b ON a.no_sptpd = b.no_sptpd
					GROUP BY kd_rek)b
					ON a.kd_rek=b.kd_rek
					UNION ALL
					SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE LENGTH(kd_rek)='11' AND LEFT(kd_rek,5)='4.1.2' AND status_aktif='1')a
					LEFT JOIN (SELECT b.kode_rekening,
					SUM(CASE WHEN MONTH(tanggal) <='$b1_1'  THEN a.jumlah ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tanggal) ='$b1'  THEN a.jumlah ELSE 0 END) AS bln_ini 
					FROM ssrd a
					LEFT JOIN ssrd_detail b ON a.no_ssrd = b.no_ssrd
					GROUP BY kode_rekening)b
					ON a.kd_rek=b.kode_rekening
					ORDER BY kd_rek";
					
		$i=1;
		$tot_target 	= $query2->target_realisasi;
		$tot_bln_lalu 	= $query2->bln_lalu;
		$tot_bn_ini 	= $query2->bln_ini;
		$tot_jml 		= $tot_bn_ini+$tot_bln_lalu;
		//$tot_sisa 		= $tot_jml-$tot_target;
		$tot_sisa 		= $this->msistem->rp_minus($tot_jml-$tot_target);
		
		 if($tot_target==0){
				$tot_persen=0;
		}else{
				$tot_persen = $tot_jml/$tot_target*100;
			}
			
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$kd_rek 	= $rs->kd_rek;
			$nm_rek 	= $rs->nm_rek;
			$target 	= $rs->target_realisasi;
			//$tahun_pajak 	= $rs->tahun_pajak;
			$bln_ini 		= $rs->bln_ini;
			$bln_lalu 		= $rs->bln_lalu;
			$jml			= $bln_ini+$bln_lalu;
			$tambah_kurang	= $jml-$target;
			$tambah_kurang1	= $this->msistem->rp_minus($tambah_kurang);
			
			
			
			 if($target==0){
				$persen=0;
			}else{
				$persen = $jml/$target*100;
			}

			if(strlen($kd_rek)>=5){
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left">'.$kd_rek.'</td>
					<td width="280" valign="center" align="left">'.$nm_rek.'</td>
					<td width="140" valign="center" align="right">'.number_format($target,2,",",".").'</td>
					<td width="100" valign="center" align="right">'.number_format($bln_lalu,2,",",".").'</td>
					<td width="100" valign="center" align="right">'.number_format($bln_ini,2,",",".").'</td>
					<td width="90" valign="center" align="right">'.number_format($jml,2,",",".").'</td>
					<td width="120" valign="center" align="right">'.$tambah_kurang1.'</td>
					<td width="50" valign="center" align="center">'.number_format($persen,2,",",".").'</td>
				</tr>';
			}else{
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left"><strong>'.$kd_rek.'</strong></td>
					<td width="280" valign="center" align="left"><strong>'.$nm_rek.'</strong></td>
					<td width="140" valign="center" align="right"><strong>'.number_format($target,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong>'.number_format($bln_lalu,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong>'.number_format($bln_ini,2,",",".").'</strong></td>
					<td width="90" valign="center" align="right"><strong>'.number_format($jml,2,",",".").'</strong></td>
					<td width="120" valign="center" align="right"><strong>'.$tambah_kurang1.'</strong></td>
					<td width="50" valign="center" align="center"><strong>'.number_format($persen,2,",",".").'</strong></td>
				</tr>';
			}
		
				$report .=$muncul;

				
			//$tot_total 		= $tot_total+$target;
			$i++;	
		}
		$report .='<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
					<td colspan="2" width="350" align="center"><strong>JUMLAH</strong></td>
					<td width="140" align="right"><strong>'.number_format($tot_target,2,",",".").'</strong></td>
					<td width="100" align="right"><strong>'.number_format($tot_bln_lalu,2,",",".").'</strong></td>
					<td width="100" align="right"><strong>'.number_format($tot_bn_ini,2,",",".").'</strong></td>
					<td width="90" align="right"><strong>'.number_format($tot_jml,2,",",".").'</strong></td>
					<td width="120" align="right"><strong>'.$tot_sisa.'</strong></td>
					<td width="50" align="center"><strong>'.number_format($tot_persen,2,",",".").'</strong></td>
				</tr>
				</table>';
		
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
			$pdf->Output('Report_Target_realisasi_pajaklainya'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_target_realisasi_pajaklainnya";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}		 
	}
	
	
function penetapan(){
		$data['pajak'] = $this->db->query("SELECT kd_rek,nm_rek FROM master_rekening WHERE status_child ='0'");
		$this->load->view('report_pajak/penetapan', $data);
	}
	public function excel_penetapan(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_penetapan',$data);
	}
	

function data_penetapan($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else if($pajak=='4.1.1.04.01'){
			$qr="and d.kd_rek ='$pajak'";
		} else if($pajak=='4.1.1.04.02'){
			$qr=" and LEFT(d.kd_rek,8)=LEFT('$pajak',8) and d.kd_rek !='4.1.1.04.01'";
		} else{
			$qr="and LEFT(d.kd_rek,8)='$pajak'";
		}
		/*$query = $this->db->query("SELECT
			DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
			c.no_skpd,
			a.nama_perusahaan,
			c.masa_pajak1,
			c.tahun,
			c.masa_pajak_1,
			c.masa_pajak_2,
			c.jumlah
			FROM
			identitas_perusahaan a
			INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan WHERE  c.tgl>='".$awal."' and c.tgl<='".$akhir."' $qr GROUP BY c.no_skpd ORDER BY c.no_skpd ASC 34");
					*/
		$aaa	= "SELECT
					DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
					c.no_skpd,
					a.nama_perusahaan,
					c.masa_pajak1,
					c.tahun,
					c.masa_pajak_1,
					c.masa_pajak_2,
					d.jumlah,
					d.denda,
					kd_rek,
					nm_rek,
					b.status
					FROM
					identitas_perusahaan a
					INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan 
					LEFT JOIN skpd_child d ON c.no_skpd=d.skpd LEFT JOIN
					sspd b ON c.no_skpd=b.nomor
					WHERE  c.tgl>='$awal'  and c.tgl<='$akhir' $qr  ORDER BY c.no_skpd ASC";
		$query	= $this->db->query($aaa);
		$i=1;
		foreach($query->result() as $rs){
			/*$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  where skpd = '".$rs->no_skpd."'")->row();
			$no_rek = $rc->kd_rek;
			$nm_rek = $rc->nm_rek;
			$pokok	= $rs->jumlah - $rc->denda;*/
			//$kode = $rs->kode_pajak;
			$no_rek = $rs->kd_rek;
			$nm_rek = $rs->nm_rek;
			$pokok	= $rs->jumlah - $rs->denda;
			$null = "0";
			if($no_rek=='4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			/* if($kode=='GAL'){
				$nm_rek = 'Pajak Mineral Bukan Logam Dan Batuan';
				$no_rek = '4.1.1.11';
			} */
			if($rs->status=="1"){
				$status="Sudah Bayar";
			}else{
				$status="Belum Bayar";
			}
			
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$no_rek."]]></cell>");
				echo("<cell><![CDATA[".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$pokok."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
				echo("<cell><![CDATA[".$status."]]></cell>");
				//echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			//$muncul = "</rows>";
			$i++;	
		}
		echo "</rows>";
	}

function cetak_penetapan(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$awal1 = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		$marginBawah = $t[3];
		$cetak = $t[4];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal1);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'LEGAL', true, 'UTF-8', false); 
			
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('P','LEGAL',false);
		//set data
		
		
			$kode_pajak = $this->db->query("SELECT nm_rek FROM master_rekening WHERE kd_rek='$pajak'")->row();
			$kd_rek	= $pajak2;
			$nm_rek = $kode_pajak->nm_rek;	
			if($pajak2=='4.1.1.04.01'){
				$kd_rek = "4.1.1.01.01";
				$nm_rek = "Pajak Reklame Permanen";
			}
			if($pajak2=='4.1.1.04.02'){
				$kd_rek = "4.1.1.01.02";
				$nm_rek = "Pajak Reklame Insidentil";
			}
			
	
		$report = '';
		$report .=
			'<table borde="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td width="50" height="5" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>DAFTAR TRANSAKSI PENETAPAN</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">SKPD</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;1.20.05 : BADAN PENDAPATAN DAERAH</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="150" height="15" align="left" valign="middle">Jenis Pajak / Retribusi</td>
								<td width="22" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$kd_rek.' : '.$nm_rek.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">Dari Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl1.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="25" align="left" valign="middle">S/D Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl2.'</td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="18" align="center"><strong>NO</strong></td>
					<td width="48" align="center"><strong>TANGGAL</strong></td>
					<td width="73" align="center"><strong>NOMOR</strong></td>
					<td width="100" align="center"><strong>SUMBER</strong></td>
					<td width="70" align="center"><strong>BULAN/TAHUN</strong></td>
					<td width="50" align="center"><strong>TMT</strong></td>
					<td width="145" align="center"><strong>URAIAN</strong></td>
					<!--<td width="70" height="12" align="center"><strong>POKOK</strong></td>
					<td width="70" height="12" align="center"><strong>DENDA</strong></td>-->
					<td width="70" align="center"><strong>JUMLAH</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else if($pajak=='4.1.1.04.01'){
			$qr="and d.kd_rek ='$pajak'";
		} else if($pajak=='4.1.1.04.02'){
			$qr=" and LEFT(d.kd_rek,8)=LEFT('$pajak',8) and d.kd_rek !='4.1.1.04.01'";
		} else{
			$qr="and LEFT(d.kd_rek,8)='$pajak'";
		}
		
		$aaa	= "SELECT
					DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
					c.no_skpd,
					a.nama_perusahaan,
					c.masa_pajak1,
					c.tahun,
					c.masa_pajak_1,
					c.masa_pajak_2,
					d.jumlah,
					d.denda,
					c.kode_sptpd,
					kd_rek,
					nm_rek
					FROM
					identitas_perusahaan a
					INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan 
					LEFT JOIN skpd_child d ON c.no_skpd=d.skpd
					WHERE  c.tgl>='$awal1'  and c.tgl<='$akhir' $qr  ORDER BY c.no_skpd ASC";
		$query = $this->db->query($aaa);

		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		$keluar=0;
		foreach($query->result() as $rs){
			//$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  WHERE skpd = '".$rs->no_skpd."'")->row();
			$kode = $rs->kode_sptpd;
			$no_rek = $rs->kd_rek;
			$nm_rek = $rs->nm_rek;
			$bln = $this->msistem->v_bln($rs->masa_pajak1); 
			$a = explode("-",$rs->masa_pajak_1);
			$a0 = $a[0];
			$a1 = $a[1];
			$a2 = $a[2];
			$awal	= $this->msistem->c_bln($a1);
			$b = explode("-",$rs->masa_pajak_2);
			$b0 = $b[0];
			$b1 = $b[1];
			$b2 = $b[2];
			$akhir 	= $this->msistem->c_bln($b1);
			if($kode=="HTL"){
				$pajak1 = "Hotel";
			}else if($kode=="RES"){
				$pajak1 = "Restoran";
			}else if($kode=="HIB"){
				$pajak1 = "Hiburan";
			}else if($kode=="REK"){
				$pajak1 = "Reklame";
			}else if($kode=="LIS"){
				$pajak1 = "PPJ";
			}else if($kode=="PKR"){
				$pajak1 = "Parkir";
			}else if($kode=="AIR"){
				$pajak1 = "Air Tanah";
			}else if($kode=="09"){
				$pajak1 = "WALET";
			}else if($kode=="GAL"){
				$pajak1 = "Mineral Bukan Logam Dan Batuan";
			}else{
				$pajak1 = "KESELURUHAN";
			}
			//$null = "0";
			/* if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			} */
			if($no_rek == '4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($no_rek == '4.1.1.03.16'){
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
			if($no_rek == '4.1.1.03.16.'){
				$no_rek = '4.1.1.03.16';
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
				
			$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="18" height="12" align="center">'.$i.'</td>
					<td width="48" height="12" align="center">'.$rs->tgl.'</td>
					<td width="73" height="12" align="center">'.$rs->no_skpd.'</td>
					<td width="100" height="12" align="left">&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="70" height="12" align="center">'.$bln.'&nbsp;'.$rs->tahun.'</td>
					<td width="50" height="12" align="left">'.$a2.' '.$awal.' '.$a0.' s/d '.$b2.' '.$akhir.' '.$b0.'</td>
					<td width="145" height="12" align="left">&nbsp;Penetapan '.$pajak1.'&nbsp;Tahun '.$rs->tahun.'<br/>&nbsp;Sumber : '.$rs->nama_perusahaan.'</td>
					<td width="70" height="12" align="right">&nbsp;'.number_format($rs->jumlah,2,",",".").'&nbsp;</td>
					
				</tr>';
			
			//$ketetapan = $ketetapan+$rs->ketetapan;
			//$denda = $denda+$rs->denda;
			$terima = $terima+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		}
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="504" colspan="7" align="center"><strong>JUMLAH</strong></td>
					<td width="70"  align="right"><strong>'.number_format($terima,2,",",".").'</strong></td>
					
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$us = $this->db->query("SELECT nama,nip FROM admin where username = '".$this->session->userdata('username')."'")->row();
			$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
			$s11 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '0' ")->row();
			if($awal1>='2018-01-19'){
				$nama1 = strtoupper($s11->nama_ttd);;
				$nip1 = $s11->nip_ttd;
				$jab1 = $s11->jabatan_ttd;
				$muncul = '202';
			} else {
				$nama1 = strtoupper($s1->nama_ttd);
				$nip1 = $s1->nip_ttd;
				$jab1 = $s1->jabatan_ttd;
				$muncul = '232';
			}
			$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '3' ")->row();
			if($s2==NULL){
				$nama2 = '';
				$nip2 = '';
			} else {
				$nama2 = strtoupper($s2->nama_ttd);
				$nip2 = $s2->nip_ttd;
				$jab2 = $s2->jabatan_ttd;
			}
			if($us->nip=='-'){
				$nip_us = "";
			}else{
				$nip_us = 'NIP. '.$us->nip;
			}
		$report .=
			'<table border="0">
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
									<td width="262">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$day.' '.$mon.' '.$year.'</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
									<td width="30">&nbsp;</td>
									<td width="120" align="center">&nbsp; Petugas SIMPADA</td>
									<td width="120"></td>
									<td width="300" align="center">'.$jab2.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="26">&nbsp;</td>
									<td width="130" align="center">&nbsp; <u>'.strtoupper($us->nama).'</u></td>
									<td width="174"></td>
									<td width="200" align="center"><u>'.$nama2.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="25">&nbsp;</td>
									<td width="140">&nbsp;'.$nip_us.'</td>
									<td width="165"></td>
									<td width="200" align="center">NIP. '.$nip2.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="250">&nbsp;</td>
									<td width="130" font-size:10px>&nbsp;Mengetahui,</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="195">&nbsp;</td>
									<td width="170" font-size:10px>&nbsp;An. Kepala BAPENDA Kab. Melawi</td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
									<td width="175">&nbsp;</td>
									<td width="210" font-size:10px>&nbsp;'.$jab1.'</td>
								</tr>
								<br/>
								<br/>
								<br/>
								<br/>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="'.$muncul.'">&nbsp;</td>
									<td width="140"><u>'.$nama1.'</u></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="202">&nbsp;</td>
									<td width="160">&nbsp;NIP. '.$nip1.'</td>
								</tr>
								
			</table>';
		$data['prev']= $report;
			
			 
			 
	switch($cetak) {       
        case 1;
			$pdf->writeHTML($report, true, false, true, false);
			$pdf->lastPage();
			$pdf->Output('Report_Transaksi_Penetapan'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_penetapan";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}	 
	}
	
	
function penetapan2(){
		$data['pajak'] = $this->db->query("SELECT kode_sptpd, nama_sptpd FROM master_sptpd WHERE kode_pajak !='00'");
		$this->load->view('report_pajak/penetapan2', $data);
	}
	

function data_penetapan2($awal="",$akhir="",$nilai="",$op=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$qr = "and a.npwpd_perusahaan like '%".$nilai."%'";
		}else{
			$qr = "and a.nama_perusahaan like '%".$nilai."%'";
		} 
		$query = $this->db->query("SELECT
DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
c.no_skpd,
a.nama_perusahaan,
c.masa_pajak1,
c.masa_pajak2,
c.tahun,
c.masa_pajak_1,
c.masa_pajak_2,
c.jumlah
FROM
identitas_perusahaan a
INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan WHERE  c.tgl>='".$awal."' and c.tgl<='".$akhir."' $qr GROUP BY c.no_skpd ORDER BY c.no_skpd ASC");
		$i=1;
		foreach($query->result() as $rs){
			$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  where skpd = '".$rs->no_skpd."'")->row();
			$kode = $rs->kode_pajak;
			$no_rek = $rc->kd_rek;
			$nm_rek = $rc->nm_rek;
			$pokok	= $rs->jumlah - $rc->denda;
			$null = "0";
			if($no_rek=='4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($kode=='GAL'){
				$nm_rek = 'Pajak Mineral Bukan Logam Dan Batuan';
				$no_rek = '4.1.1.11';
			}
			
			$tmt = $this->msistem->c_bln($rs->masa_pajak1);
			$tmt2 = $this->msistem->c_bln($rs->masa_pajak2);
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_skpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
				echo("<cell><![CDATA[".$tmt." ".$rs->tahun."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$no_rek."]]></cell>");
				echo("<cell><![CDATA[".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$pokok."]]></cell>");
				echo("<cell><![CDATA[".$rc->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
				//echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			//$muncul = "</rows>";
			$i++;	
		}
		echo "</rows>";
	}
	
	function setor(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/setoran',$data);
	}
	
	function data_setor($tgl="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and a.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT a.no_sspd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, 
        a.masa_pajak1, a.masa_pajak2, a.tahun_pajak, a.ketetapan, a.denda, a.setoran FROM sspd a 
        LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan
        where a.tanggal = '".$tgl."' $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$awal."-".$akhir." ".$rs->tahun_pajak."]]></cell>");
				echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
				echo("<cell><![CDATA[".$rs->denda."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_setor(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_setor',$data);
	}
	
	function cetak_setor(){
		$p = $_GET['full'];
		$po = explode('|',$p);
		$ttd = $po[2];
		$gl = $po[0];
		$t = explode('-',$gl);
		$b = $this->msistem->v_bln($t[1]);
		$tgl = $t[2].' '.strtoupper($b).' '.$t[0];		
		
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
		$pdf->SetMargins(20,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 7);
		
		$pdf->AddPage('L','A4',false);
		
		$pajak = $po[1];
		if($pajak == NULL){
			$nm_pajak = 'Semua Pajak';
		} else {
			$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
			$nm_pajak = $cari->nama_sptpd;
		}
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN SURAT SETORAN PAJAK DAERAH ( SSPD ) HARIAN</h2>
			<p align="center">PERIODE : '.$tgl.'</p>
			<p align="center">JENIS PAJAK : '.strtoupper($nm_pajak).'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="70" height="10" align="center"><strong>NO. SSPD</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="150" height="12" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td width="150" height="12" align="center"><strong>ALAMAT</strong></td>
					<td width="100" height="12" align="center"><strong>MASA PAJAK</strong></td>
					<td width="75" height="12" align="center"><strong>KETETAPAN</strong></td>
					<td width="75" height="12" align="center"><strong>DENDA</strong></td>
					<td width="75" height="12" align="center"><strong>SETORAN</strong></td>
				</tr>';
		
		$pajak = $po[1];
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and a.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT a.no_sspd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, 
        a.masa_pajak1, a.masa_pajak2, a.tahun_pajak, a.ketetapan, a.denda, a.setoran FROM sspd a 
        LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan
        INNER JOIN pembayaran c ON c.no_sspd = a.no_sspd where a.tanggal = '".$gl."' $qr");
		
		$i=1;
		$tetap = 0;
		$denda = 0;
		$setor = 0;
		foreach($query->result() as $rs) {
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
				
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="70" height="10" align="center">'.$rs->no_sspd.'</td>
					<td width="80" height="12" align="center">'.$rs->npwpd.'</td>
					<td width="150" height="12" align="left">&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="150" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="100" height="12" align="center">&nbsp;'.$awal.'-'.$akhir.' '.$rs->tahun_pajak.'&nbsp;</td>
					<td width="75" height="12" align="right">Rp.&nbsp;'.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
					<td width="75" height="12" align="right">Rp.&nbsp;'.number_format($rs->denda,2,",",".").'&nbsp;</td>
					<td width="75" height="12" align="right">Rp.&nbsp;'.number_format($rs->setoran,2,",",".").'&nbsp;</td>
				</tr>';
			
			$tetap = $tetap+$rs->ketetapan;
			$denda = $denda+$rs->denda;
			$setor = $setor+$rs->setoran;
			$i++;
		}
		
		$report .=
				'<tr>
					<td width="570" align="center"><strong>JUMLAH</strong></td>
					<td width="75" height="12" align="right"><strong>Rp.&nbsp;'.number_format($tetap,2,",",".").'&nbsp;</strong></td>
					<td width="75" height="12" align="right"><strong>Rp.&nbsp;'.number_format($denda,2,",",".").'&nbsp;</strong></td>
					<td width="75" height="12" align="right"><strong>Rp.&nbsp;'.number_format($setor,2,",",".").'&nbsp;</strong></td>
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
		
		$wid = 795/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="795">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
					 <td width="'.$wid.'" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
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
		$pdf->Output('Report_SSPD_Harian'.'.pdf', 'I');
	}
	
	function perusahaan(){
		$data['pajak'] = $this->db->query("SELECT id, nama_sptpd,kode_pajak FROM master_sptpd ORDER BY id");
		$this->load->view('report_pajak/perusahaan2', $data);		
				
	}
	
	function data_usaha($awal="",$akhir="",$pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr = "";
		} else {
			$qr = "left(a.npwpd_perusahaan,2) = '".$pajak."'";
		}
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tanggal, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') AS terdaftar,  a.npwpd_perusahaan, a.npwpd_lama,c.nama_pemilik,a.nama_perusahaan, 
							a.jalan, b.nama_kecamatan, b.nama_kelurahan FROM identitas_perusahaan a LEFT JOIN view_kelurahan b ON a.kecamatan=b.kode_kecamatan 
							AND a.kelurahan=b.kode_kelurahan LEFT JOIN identitas_pemilik c ON a.npwpd_pemilik = c.npwpd_pemilik WHERE $qr AND a.tgl_daftar>='".$awal."' AND a.tgl_daftar<='".$akhir."' GROUP BY a.npwpd_perusahaan ORDER BY  a.tgl_daftar ASC"); 
		
			
		$i=1;
		foreach($query->result() as $rs) {
		
		echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$rs->terdaftar."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_lama."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function data_usaha_all(){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
				
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tanggal, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') AS terdaftar, a.npwpd_perusahaan, a.npwpd_lama,c.nama_pemilik,a.nama_perusahaan, 
							a.jalan, b.nama_kecamatan, b.nama_kelurahan FROM identitas_perusahaan a LEFT JOIN view_kelurahan b ON a.kecamatan=b.kode_kecamatan 
							AND a.kelurahan=b.kode_kelurahan LEFT JOIN identitas_pemilik c ON a.npwpd_pemilik = c.npwpd_pemilik WHERE LEFT(a.npwpd_perusahaan,2)!= '61' GROUP BY a.npwpd_perusahaan ORDER BY a.npwpd_perusahaan ASC");
		//$query = $this->db->query("select DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tanggal, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_usaha=c.id $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
		
		$peru = $rs->nama_kecamatan;
		if($peru==null){
			$f="LUAR KOTA";
		}else{
			$f=$peru;
		}
		
		$peru2 = $rs->nama_kelurahan;
		if($peru2==null){
			$f2="LUAR KOTA";
		}else{
			$f2=$peru2;
		}
		
		echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[".$rs->terdaftar."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_lama."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
				echo("<cell><![CDATA[".$f."]]></cell>");
				echo("<cell><![CDATA[".$f2."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_usaha(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_usaha',$data);
	}
	
	function ttd_usaha2(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_usaha2',$data);
	}
	
	function cetak_usaha(){
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60'); 
		
		$r = $_GET['full'];
		$l = explode('|',$r);
		$p = $l[2];
		//$ttd = $l[3];
		$nm_pjk="";
		$awal = $l[0];
		$akhir = $l[1];
		
		
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		/* $awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q; */
				
		$s = explode('-',$akhir);
		$d = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($d).' '.$s[0]; 
		
		
		if($p==NULL){
			$qr = "";
		} else {
			$qr = "left(a.npwpd_perusahaan,2)='".$p."'";
		}
		
		if($p=='1'){
			$nm_pjk="PAJAK HOTEL";
		}else if($p=='2'){
			$nm_pjk="PAJAK RESTORAN";
		}else if($p=='3'){
			$nm_pjk="PAJAK HIBURAN";
		}else if($p=='4'){
			$nm_pjk="PAJAK REKLAME";
		}else if($p=='5'){
			$nm_pjk="PAJAK PENERANGAN JALAN";
		}else if($p=='11'){
			$nm_pjk="PAJAK MINERAL BUKAN LOGAM DAN BATUAN";
		}else if($p=='6'){
			$nm_pjk="PAJAK PARKIR";
		}else if($p=='8'){
			$nm_pjk="PAJAK AIR TANAH";
		}    
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'FOLIO', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(20,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
		$pdf->SetAutoPageBreak(true,30);
		$pdf->AddPage('L','FOLIO',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN DATA WAJIB PAJAK <br/> '.$nm_pjk.'</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="47" height="10" align="center"><strong>TMT</strong></td>
					<td width="80" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="85" height="12" align="center"><strong>NPWPD LAMA</strong></td>
					<td width="135" height="12" align="center"><strong>NAMA PEMILIK</strong></td>
					<td width="135" height="12" align="center"><strong>NAMA USAHA</strong></td>
					<td width="140" height="12" align="center"><strong>ALAMAT</strong></td>
					<td width="120" height="12" align="center"><strong>KECAMATAN</strong></td>
					<td width="120" height="12" align="center"><strong>KELURAHAN</strong></td>
				</tr>';
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tanggal,  a.npwpd_perusahaan, a.npwpd_lama,c.nama_pemilik,a.nama_perusahaan, 
					a.jalan, b.nama_kecamatan, b.nama_kelurahan FROM identitas_perusahaan a LEFT JOIN view_kelurahan b ON a.kecamatan=b.kode_kecamatan 
					AND a.kelurahan=b.kode_kelurahan LEFT JOIN identitas_pemilik c ON a.npwpd_pemilik = c.npwpd_pemilik WHERE $qr AND a.tgl_daftar>='".$awal."' AND a.tgl_daftar<='".$akhir."' GROUP BY a.npwpd_perusahaan ORDER BY a.tgl_daftar ASC");
		//$query = $this->db->query("select DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tanggal, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_pajak=c.id $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
				
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="47" height="10" align="center">'.$rs->tanggal.'</td>
					<td width="80" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="85" height="12" align="left">&nbsp;&nbsp;'.$rs->npwpd_lama.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_pemilik.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="140" height="12" align="left">'.$rs->jalan.'&nbsp;</td>
					<td width="120" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_kecamatan.'&nbsp;</td>
					<td width="120" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_kelurahan.'&nbsp;</td>
				</tr>';
			$i++;
		}
		
		$report .=
			'</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		/* $t = explode(",",$ttd);
		$countttd = count($t);
		$jmlh = $countttd;
		$kura = $countttd-1; 
		
		$wid = 885/$jmlh;
		$cols = $kura*$wid;*/
		
		/* $report .=
			'<table>
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'">&nbsp;</td>
					 <td align="center">Nanga Pinoh, '.$day.' '.$mon.' '.$year.'</td>
				</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td height="10" align="center">'.$rs->jabatan_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select bagian from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td height="10" align="center">'.$us->bagian.'</td>
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
							'<td height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select nama from admin where username = '".$this->session->userdata('username')."'")->row();
			$report .=
					'<td height="10" align="center">'.$us->nama.'</td>
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
			</table>'; */
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Perusahaan'.'.pdf', 'I');
	}
	
	function cetak_usaha2(){
		$r = $_GET['full'];
		$l = explode('|',$r);
		$p = $l[0];
		$ttd = $l[1];
		$nm_pjk="";				   
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(30);
		$pdf->SetMargins(20,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN DATA WAJIB PAJAK KESELURUHAN</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="47" height="10" align="center"><strong>TMT</strong></td>
					<td width="85" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="85" height="12" align="center"><strong>NPWPD LAMA</strong></td>
					<td width="135" height="12" align="center"><strong>NAMA PEMILIK</strong></td>
					<td width="135" height="12" align="center"><strong>NAMA USAHA</strong></td>
					<td width="135" height="12" align="center"><strong>ALAMAT</strong></td>
					<td width="85" height="12" align="center"><strong>KECAMATAN</strong></td>
					<td width="85" height="12" align="center"><strong>KELURAHAN</strong></td>
				</tr>';
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tanggal,  a.npwpd_perusahaan, a.npwpd_lama,c.nama_pemilik,a.nama_perusahaan, 
						a.jalan, b.nama_kecamatan, b.nama_kelurahan FROM identitas_perusahaan a LEFT JOIN view_kelurahan b ON a.kecamatan=b.kode_kecamatan 
						AND a.kelurahan=b.kode_kelurahan LEFT JOIN identitas_pemilik c ON a.npwpd_pemilik = c.npwpd_pemilik GROUP BY a.npwpd_perusahaan order by SUBSTR(a.npwpd_perusahaan,3,5) ASC");
		//$query = $this->db->query("select DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tanggal, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_pajak=c.id $qr");
		
		
		
		$i=1;
		foreach($query->result() as $rs) {
				
		$peru = $rs->nama_kecamatan;
		if($peru==null){
			$f="LUAR KOTA";
		}else{
			$f=$peru;
		}
		
		$peru2 = $rs->nama_kelurahan;
		if($peru2==null){
			$f2="LUAR KOTA";
		}else{
			$f2=$peru2;
		}
		
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="47" height="10" align="center">'.$rs->tanggal.'</td>
					<td width="85" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="85" height="12" align="left">&nbsp;&nbsp;'.$rs->npwpd_lama.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_pemilik.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="135" height="12" align="left">&nbsp;&nbsp;'.$rs->jalan.'&nbsp;</td>
					<td width="85" height="12" align="left">&nbsp;&nbsp;'.$f.'&nbsp;</td>
					<td width="85" height="12" align="left">&nbsp;&nbsp;'.$f2.'&nbsp;</td>
				</tr>';
			$i++;
		}
		
		$report .=
			'</table>
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
					 <td width="675" align="center">Jambi, '.$day.' '.$mon.' '.$year.'</td>
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
					'<td width="675" height="10" align="center">'.$us->bagian.'</td>
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
					'<td width="675" height="10" align="center">'.$us->nama.'</td>
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
				'<td width="675" height="10" align="center">NIP. '.$us->nip.'</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Perusahaan'.'.pdf', 'I');
	}
	
	function real_nots(){
		$this->load->view('report_pajak/real_nots');
	}
	
	function real_not_sptpd(){
		//$data['bln'] = date('m');
		//$data['thn'] = date('Y');
		$this->load->view('report_pajak/real_not_sptpd');
	}
	
	function real_bsel(){
		$this->load->view('report_pajak/real_bsel');
	}
	
	function real_dbsel(){
		//$data['bln'] = date('m');
		//$data['thn'] = date('Y');
		$this->load->view('report_pajak/real_by_sptpd');
	}
	
	function real_boff(){
		$this->load->view('report_pajak/real_boff');
	}
	
	function real_dboff(){
		//$data['bln'] = date('m');
		//$data['thn'] = date('Y');
		$this->load->view('report_pajak/real_by_skp');
	}
	function piutang(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd !='RET' AND kode_sptpd !='PLL'");
		$this->load->view('report_pajak/piutang', $data);
	}

public function excel_piutang(){
		$data['type'] = 'excel';
		$data['data'] = $_GET['full'];
		$this->load->view('report_pajak/excel_piutang',$data);
	}

function cetak_piutang(){
			$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$awal = $t[0];
		$akhir = $t[1];
		$pajak = $t[2];
		$pajak2 = $t[2];
		$marginBawah = $t[3];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		$t = explode('-',$awal);
		$o = $this->msistem->v_bln($t[1]);
		$tgl1 = $t[2].' '.strtoupper($o).' '.$t[0];
		
		$awal2 = $t[0].'-01-01';
		$i = '1';
		$q = $t[2]-$i;
		$akhir2 = $t[0].'-'.$t[1].'-'.$q;
				
		$s = explode('-',$akhir);
		$p = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($p).' '.$s[0];
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','LEGAL',false);
		//set data
		
		if($pajak2==NULL){
			$qq="";
		} else {
			$qq="and c.kode_sptpd='".$pajak2."'";
		}
				
	if($pajak2=="HTL"){
				$kd_rek = "4.1.1.01";
				$nm_rek = "Pajak Hotel";
			}else if($pajak2=="RES"){
				$kd_rek = "4.1.1.02";
				$nm_rek = "Pajak Restoran";
			}else if($pajak2=="HIB"){
				$kd_rek = "4.1.1.03";
				$nm_rek = "Pajak Hiburan";
			}else if($pajak2=="REK"){
				$kd_rek = "4.1.1.04";
				$nm_rek = "Pajak Reklame";
			}else if($pajak2=="LIS"){
				$kd_rek = "4.1.1.05";
				$nm_rek = "Pajak Penerangan Jalan";
			}else if($pajak2=="PKR"){
				$kd_rek = "4.1.1.07";
				$nm_rek = "Pajak Parkir";
			}else if($pajak2=="AIR"){
				$kd_rek = "4.1.1.08";
				$nm_rek = "Pajak Air Tanah";
			}else if($pajak2=="09"){
				$kd_rek = "4.1.1.09";
				$nm_rek = "Pajak Burung Walet";
			}else if($pajak2=="GAL"){
				$kd_rek = "4.1.1.11";
				$nm_rek = "Pajak Mineral Bukan Logam Dan Batuan";
			}else{
				$kd_rek = " ";
				$nm_rek = " ";
			}

	if($kd_rek=="4.1.1.04"){
		$xxx ="Alamat Pemasangan";
	}else{
		$xxx ="Alamat OP";	
	}
	
		$report = '';
		$report .=
			'<table borde="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td width="50" height="5" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="610" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="610" align="center">
									<b>DAFTAR PIUTANG PAJAK DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">SKPD</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;1.20.05 : BADAN PENDAPATAN DAERAH</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="150" height="15" align="left" valign="middle">Jenis Pajak / Retribusi</td>
								<td width="22" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$kd_rek.' : '.$nm_rek.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">Dari Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl1.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="25" align="left" valign="middle">S/D Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl2.'</td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:8px">
					<td width="15" height="12" align="center"><strong>NO</strong></td>
					<td width="43" height="12" align="center"><strong>TANGGAL</strong></td>
					<td width="70" height="12" align="center"><strong>NO. SKPD</strong></td>
					<td width="70" height="12" align="center"><strong>SUMBER</strong></td>
					<td width="80" height="12" align="center"><strong>ALAMAT WP</strong></td>
					<td width="80" height="12" align="center"><strong>'.$xxx.'</strong></td>
					<td width="75" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="70" height="12" align="center"><strong>BULAN/TAHUN</strong></td>
					<td width="50" height="12" align="center"><strong>TMT</strong></td>
					<td width="120" height="12" align="center"><strong>URAIAN</strong></td>
					<td width="60" height="12" align="center"><strong>PENETAPAN</strong></td>
					<td width="70" height="12" align="center"><strong>TANGGAL SETOR</strong></td>
					<td width="58" height="12" align="center"><strong>JML SETOR</strong></td>
					<td width="50" height="12" align="center"><strong>PETUGAS</strong></td>
					<td width="50" height="12" align="center"><strong>PIUTANG PAJAK</strong></td>
					
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and c.kode_sptpd='".$pajak."'";
		}
				
		$query = $this->db->query("SELECT * FROM(SELECT
DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
c.no_skpd AS nomor,
a.nama_perusahaan,
a.alamat_perusahaan,
c.alamat_pemilik,
c.npwpd,
c.masa_pajak1,
c.tahun,
c.masa_pajak_1,
c.masa_pajak_2,
c.jumlah,
c.kode_sptpd,
b.status
FROM
identitas_perusahaan a INNER JOIN sspd b ON a.npwpd_perusahaan=b.npwpd
INNER JOIN skpd c ON c.no_skpd = b.nomor WHERE c.tgl>='".$awal."' AND c.tgl<='".$akhir."'
$qr GROUP BY c.no_skpd  ORDER BY c.tgl ASC, c.no_skpd ASC
)a
LEFT JOIN (SELECT author,tgl_bayar,setoran_wp,no_skpd FROM pembayaran)b
ON a.nomor=b.no_skpd");



	/* $query2 = $this->db->query("SELECT
SUM(c.jumlah) AS jl
FROM
identitas_perusahaan a
INNER JOIN skpd c ON a.npwpd_perusahaan = c.npwpd WHERE c.tgl>='".$awal2."' and c.tgl<='".$akhir2."' $qr")->row();

$terima2 = $query2->jl; */
		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		$total_setoran=0;
		$total_piutang=0;
		foreach($query->result() as $rs){
			//$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  WHERE skpd = '".$rs->no_skpd."'")->row();
			$kode = $rs->kode_sptpd;
			//$no_rek = $rc->kd_rek;
			//$nm_rek = $rc->nm_rek;
			$stat = $rs->status;
			$bln = $this->msistem->v_bln($rs->masa_pajak1);
			if($rs->tgl_bayar==Null){
				$rs->tgl_bayar="0000-00-00";
			}else{
				$rs->tgl_bayar=$rs->tgl_bayar;
			}
			$a = explode("-",$rs->masa_pajak_1);
			$a0 = $a[0];
			$a1 = $a[1];
			$a2 = $a[2];
			$awal	= $this->msistem->c_bln($a1);
			$b = explode("-",$rs->masa_pajak_2);
			$b0 = $b[0];
			$b1 = $b[1];
			$b2 = $b[2];
			$akhir 	= $this->msistem->c_bln($b1);
			$c = explode("-",$rs->tgl_bayar);
			$c0 = $c[0];
			$c1 = $c[1];
			$c2 = $c[2];
			$nm_bln	= $this->msistem->v_bln($c1);
			if($kode=="HTL"){
				$pajak1 = "Hotel";
			}else if($kode=="RES"){
				$pajak1 = "Restoran";
			}else if($kode=="HIB"){
				$pajak1 = "Hiburan";
			}else if($kode=="REK"){
				$pajak1 = "Reklame";
			}else if($kode=="LIS"){
				$pajak1 = "PPJ";
			}else if($kode=="PKR"){
				$pajak1 = "Parkir";
			}else if($kode=="AIR"){
				$pajak1 = "Air Tanah";
			}else if($kode=="09"){
				$pajak1 = "WALET";
			}else if($kode=="GAL"){
				$pajak1 = "Mineral Bukan Logam Dan Batuan";
			}else{
				$pajak1 = "KESELURUHAN";
			}
			
			if($stat==1){
				$tgl_str=$c2.' '.$nm_bln.' '.$c0;
				$piutang=0;
				$petugas=$rs->author;
				$str=$rs->setoran_wp;
			}else{
				$tgl_str='-';
				$piutang=$rs->jumlah-$rs->setoran_wp;
				$petugas='-';
				$str=0;
			}
				
			$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:8px">
					<td width="15" height="12" align="center">'.$i.'</td>
					<td width="43" height="12" align="center">'.$rs->tgl.'</td>
					<td width="70" height="12" align="center">'.$rs->nomor.'</td>
					<td width="70" height="12" align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="80" height="12" align="left">&nbsp;'.$rs->alamat_pemilik.'&nbsp;</td>
					<td width="80" height="12" align="left">&nbsp;'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="75" height="12" align="center">&nbsp;'.$rs->npwpd.'&nbsp;</td>
					<td width="70" height="12" align="center">'.$bln.'&nbsp;'.$rs->tahun.'</td>
					<td width="50" height="12" align="left">'.$a2.' '.$awal.' '.$a0.' s/d '.$b2.' '.$akhir.' '.$b0.'</td>
					<td width="120"height="12" align="left">&nbsp;Penetapan Pajak '.$pajak1.'&nbsp;Tahun '.$rs->tahun.'<br/>&nbsp;Sumber : '.$rs->nama_perusahaan.'</td>
					<td width="60" height="12" align="right">&nbsp;'.number_format($rs->jumlah,2,",",".").'&nbsp;</td>
					<td width="70" height="12" align="center">&nbsp;'.$tgl_str.'&nbsp;</td>
					<td width="58" height="12" align="right">&nbsp;'.number_format($str,2,",",".").'&nbsp;</td>
					<td width="50" height="12" align="center">'.$petugas.'</td>
					<td width="50" height="12" align="right">'.number_format($piutang,2,",",".").'</td>
					
				</tr>';
			
			//$ketetapan = $ketetapan+$rs->ketetapan;
			//$denda = $denda+$rs->denda;
			$terima = $terima+$rs->jumlah;
			$total_setoran = $total_setoran+$str;
			$total_piutang = $total_piutang+$piutang;
			$i++;
		}
		
		if($pajak2==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak2."'";
		}
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		$report .=
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:8px">
					<td width="673" align="center"><strong>TOTAL PENETAPAN</strong></td>
					<td width="60" height="12" align="right"><strong>&nbsp;'.number_format($terima,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="center"><strong>&nbsp;TOTAL PENERIMAAN&nbsp;</strong></td>
					<td width="58" height="12" align="right"><strong>&nbsp;'.number_format($total_setoran,2,",",".").'&nbsp;</strong></td>
					<td width="50" height="12" align="right"><strong>&nbsp;&nbsp;</strong></td>
					<td width="50" height="12" align="right"><strong>&nbsp;'.number_format($total_piutang,2,",",".").' &nbsp;</strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
			$day = date("d");
			$mon = $this->msistem->v_bln(date("m"));
			$year = date("Y");
			$us = $this->db->query("SELECT nama,nip FROM admin where username = '".$this->session->userdata('username')."'")->row();
			$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
			if($s1==NULL){
				$nama1 = '';
				$nip1 = '';
			} else {
				$nama1 = strtoupper($s1->nama_ttd);
				$nip1 = $s1->nip_ttd;
				$jab1 = $s1->jabatan_ttd;
			}
			$s2 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '3' ")->row();
			if($s2==NULL){
				$nama2 = '';
				$nip2 = '';
			} else {
				$nama2 = strtoupper($s2->nama_ttd);
				$nip2 = $s2->nip_ttd;
				$jab2 = $s2->jabatan_ttd;
			}
			if($us->nip=='-'){
				$nip_us = "";
			}else{
				$nip_us = 'NIP. '.$us->nip;
			}
		
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Piutang_Pajak'.'.pdf', 'I');		
	}

	function cetak_piutang_rekap(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$marginBawah = $t[0];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
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
								<td colspan="7" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td colspan="7" align="center">
									<b>REKAPITULASI PIUTANG PAJAK DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" align="left" valign="middle">SKPD</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;1.20.07 : BADAN PENDAPATAN DAERAH</td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1" cellpadding="2" cellspacing="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"><strong>No</strong></td>
					<td width="170" valign="center" align="center"><strong>Jenis Pajak</strong></td>
					<td width="70" 	valign="center" align="center"><strong>Tahun Pajak</strong></td>
					<td width="170" valign="center" align="center"><strong>Nilai Piutang Pertahun</strong></td>
					<td width="150" valign="center" align="center"><strong>Pembayaran Piutang s/d Tahun '.$tahun_l.'</strong></td>
					<td width="150" valign="center" align="center"><strong>Pembayaran Piutang Pada Tahun '.$tahun.'</strong></td>
					<td width="150" valign="center" align="center"><strong>Jumlah Piutang</strong></td>
				</tr>';
		
		$query = "SELECT '1' as urut, a.kode_pajak, nama_sptpd,a.tahun_pajak,
						a.total, IFNULL(thn_lalu,0) as thn_lalu, IFNULL(thn_ini,0) thn_ini
						FROM (select a.kode_pajak as kode_pajak,nama_sptpd, a.tahun_pajak, SUM(b.jumlah) as total 
						FROM sspd a 
						LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd
						LEFT JOIN master_sptpd c ON a.kode_pajak=c.kode_sptpd
						GROUP BY a.kode_pajak , tahun_pajak
						ORDER BY c.kode_pajak ASC,tahun_pajak DESC)a
						LEFT JOIN 
						(select kode_pajak,tahun_pajak,
						SUM(CASE WHEN YEAR(tgl_bayar) <='$tahun_l'  THEN setoran_wp ELSE 0 END) as thn_lalu ,
						SUM(CASE WHEN YEAR(tgl_bayar) ='$tahun'  THEN setoran_wp ELSE 0 END) as thn_ini 
						FROM pembayaran a
						LEFT JOIN sspd b ON a.no_sspd = b.no_sspd
						GROUP BY kode_pajak,tahun_pajak)b 
						on a.kode_pajak=b.kode_pajak AND a.tahun_pajak=b.tahun_pajak
					UNION ALL
						SELECT '2' as urut, a.kode_pajak, nama_sptpd, '' as tahun_pajak,
						SUM(a.total) total, SUM(IFNULL(thn_lalu,0)) as thn_lalu, SUM(IFNULL(thn_ini,0)) thn_ini
						FROM (select a.kode_pajak as kode_pajak,nama_sptpd, a.tahun_pajak, SUM(b.jumlah) as total 
						FROM sspd a 
						LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd
						LEFT JOIN master_sptpd c ON a.kode_pajak=c.kode_sptpd
						GROUP BY a.kode_pajak , tahun_pajak
						ORDER BY c.kode_pajak ASC,tahun_pajak DESC)a
						LEFT JOIN 
						(select kode_pajak,tahun_pajak,
						SUM(CASE WHEN YEAR(tgl_bayar) <='$tahun_l'  THEN setoran_wp ELSE 0 END) as thn_lalu ,
						SUM(CASE WHEN YEAR(tgl_bayar) ='$tahun'  THEN setoran_wp ELSE 0 END) as thn_ini 
						FROM pembayaran a
						LEFT JOIN sspd b ON a.no_sspd = b.no_sspd
						GROUP BY kode_pajak,tahun_pajak)b 
						on a.kode_pajak=b.kode_pajak AND a.tahun_pajak=b.tahun_pajak
						GROUP BY a.kode_pajak, nama_sptpd
					ORDER BY kode_pajak ASC, urut ASC,tahun_pajak DESC";
		$nama='';
		$tot_total 		= 0;
		$tot_thn_lalu 	= 0;
		$tot_thn_ini 	= 0;
		$tot_sisa 		= 0;
		$no =0;
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$urut 	= $rs->urut;
			$kode_pajak 	= $rs->kode_pajak;
			$nama_sptpd 	= $rs->nama_sptpd;
			$tahun_pajak 	= $rs->tahun_pajak;
			$total 			= $rs->total;
			$thn_lalu 		= $rs->thn_lalu;
			$thn_ini 		= $rs->thn_ini;
			$sisa 			= $total - $thn_lalu - $thn_ini; 
			
			if($urut=='2'){
				$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"></td>
					<td colspan="2" width="240" valign="center" align="center"> <strong>JUMLAH</strong></td>
					<td width="170" valign="center" align="right"><strong>'.number_format($total,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($thn_lalu,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($thn_ini,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($sisa,2,",",".").'</strong></td>
				</tr>';
				$tot_total 		= $tot_total+$total;
				$tot_thn_lalu 	= $tot_thn_lalu+$thn_lalu;
				$tot_thn_ini 	= $tot_thn_ini+$thn_ini;
				$tot_sisa 		= $tot_total-$tot_thn_lalu-$tot_thn_ini;
			}else{
				if($nama != $nama_sptpd){
						$no = $no+1;
						$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
						<td width="30" 	valign="center" align="center">'.$no.'</td>
						<td width="170" valign="center" align="left">'.$nama_sptpd.'</td>
						<td width="70" 	valign="center" align="center">'.$tahun_pajak.'</td>
						<td width="170" valign="center" align="right">'.number_format($total,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($thn_lalu,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($thn_ini,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($sisa,2,",",".").'</td>
					</tr>';
				}else{
						$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
						<td width="30" 	valign="center" align="center"></td>
						<td width="170" valign="center" align="left"></td>
						<td width="70" 	valign="center" align="center">'.$tahun_pajak.'</td>
						<td width="170" valign="center" align="right">'.number_format($total,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($thn_lalu,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($thn_ini,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($sisa,2,",",".").'</td>
					</tr>';
				}
			}
			$nama = $nama_sptpd;
		}
		
		$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"></td>
					<td colspan="2" width="240" valign="center" align="center"> <strong>TOTAL</strong></td>
					<td width="170" valign="center" align="right"><strong>'.number_format($tot_total,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($tot_thn_lalu,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($tot_thn_ini,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($tot_sisa,2,",",".").'</strong></td>
				</tr>';
		$report .='	</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
		$data['prev']= $report;
			
		/* $pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Piutang_Pajak'.'.pdf', 'I');	 */	
			$judul ="lap_piutang_rekap";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
	}
	
	

	function cetak_piutang_penyisihan(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$marginBawah = $t[0];
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
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
								<td colspan="8" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td colspan="8" align="center">
									<b>REKAPITULASI PIUTANG PAJAK DAERAH</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" align="left" valign="middle">SKPD</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;1.20.07 : BADAN PENDAPATAN DAERAH</td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1" cellpadding="2" cellspacing="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"><strong>No</strong></td>
					<td width="170" valign="center" align="center"><strong>Jenis Pajak</strong></td>
					<td width="70" 	valign="center" align="center"><strong>Tahun Pajak</strong></td>
					<td width="170" valign="center" align="center"><strong>Nilai Piutang</strong></td>
					<td width="100" valign="center" align="center"><strong>Kualitas Piutang</strong></td>
					<td width="70"  valign="center" align="center"><strong>Persentase Faktor Pengali</strong></td>
					<td width="150" valign="center" align="center"><strong>Penyisihan Pajak Tidak Tertagih</strong></td>
					<td width="150" valign="center" align="center"><strong>Nilai Piutang Tidak Tertagih Setelah Disisihkan</strong></td>
				</tr>';
		
		$query = "SELECT '1' as urut, a.kode_pajak, nama_sptpd,a.tahun_pajak,
						a.total, IFNULL(setor,0) as setor
						FROM (select a.kode_pajak as kode_pajak,nama_sptpd, a.tahun_pajak, SUM(b.jumlah) as total 
						FROM sspd a 
						LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd
						LEFT JOIN master_sptpd c ON a.kode_pajak=c.kode_sptpd
						GROUP BY a.kode_pajak , tahun_pajak
						ORDER BY c.kode_pajak ASC,tahun_pajak DESC)a
						LEFT JOIN 
						(select kode_pajak,tahun_pajak,
						SUM(setoran_wp) as setor 
						FROM pembayaran a
						LEFT JOIN sspd b ON a.no_sspd = b.no_sspd
						GROUP BY kode_pajak,tahun_pajak)b 
						on a.kode_pajak=b.kode_pajak AND a.tahun_pajak=b.tahun_pajak
					UNION ALL
						SELECT '2' as urut, a.kode_pajak, nama_sptpd, '' as tahun_pajak,
						SUM(a.total) total, SUM(IFNULL(setor,0)) as setor
						FROM (select a.kode_pajak as kode_pajak,nama_sptpd, a.tahun_pajak, SUM(b.jumlah) as total 
						FROM sspd a 
						LEFT JOIN sspd_detail b ON a.no_sspd=b.no_sspd
						LEFT JOIN master_sptpd c ON a.kode_pajak=c.kode_sptpd
						GROUP BY a.kode_pajak , tahun_pajak
						ORDER BY c.kode_pajak ASC,tahun_pajak DESC)a
						LEFT JOIN 
						(select kode_pajak,tahun_pajak,
						SUM(setoran_wp) as setor
						FROM pembayaran a
						LEFT JOIN sspd b ON a.no_sspd = b.no_sspd
						GROUP BY kode_pajak,tahun_pajak)b 
						on a.kode_pajak=b.kode_pajak AND a.tahun_pajak=b.tahun_pajak
						GROUP BY a.kode_pajak, nama_sptpd
					ORDER BY kode_pajak ASC, urut ASC,tahun_pajak DESC";
		$nama='';
		$tot_total 		= 0;
		$tot_sisih	 	= 0;
		$tot_sisa 		= 0;
		$total_sisih 	= 0;
		$total_akhir 	= 0;
		$no =0;
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$urut 	= $rs->urut;
			$kode_pajak 	= $rs->kode_pajak;
			$nama_sptpd 	= $rs->nama_sptpd;
			$tahun_pajak 	= $rs->tahun_pajak;
			$total 			= $rs->total;
			$setor 			= $rs->setor;
			$sisa 			= $total - $setor; 
			$selisih		= $tahun-$tahun_pajak;
			switch($selisih) {       
				case 0;
					$persen = 0.5;
					$kualitas = 'Lancar';	
				break;
				case 1;        
					$persen = 10;
					$kualitas = 'Kurang Lancar';	
				break;
				case 2;        
					$persen = 10;
					$kualitas = 'Kurang Lancar';	
				break;
				case 3;        
					$persen = 50;
					$kualitas = 'Diragukan';	
				break;
				case 4;        
					$persen = 50;
					$kualitas = 'Diragukan';	
				break;
				case 5;        
					$persen = 50;
					$kualitas = 'Diragukan';	
				break;
				default;
					$persen = 100;
					$kualitas = 'Macet';
				break;
			}
			$nilai_sisih = ($sisa*$persen)/100;
			$nil_akhir	 = $sisa-$nilai_sisih;
			

			if($urut=='1'){
				if($nama != $nama_sptpd){
						$tot_sisih	 = $nilai_sisih;
						$no = $no+1;
						$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
						<td width="30" 	valign="center" align="center">'.$no.'</td>
						<td width="170" valign="center" align="left">'.$nama_sptpd.'</td>
						<td width="70" 	valign="center" align="center">'.$tahun_pajak.'</td>
						<td width="170" valign="center" align="right">'.number_format($sisa,2,",",".").'</td>
						<td width="100" valign="center" align="left">'.$kualitas.'</td>
						<td width="70"  valign="center" align="right">'.$persen.'%</td>
						<td width="150" valign="center" align="right">'.number_format($nilai_sisih,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($nil_akhir,2,",",".").'</td>
					</tr>';
				}else{
						$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
						<td width="30" 	valign="center" align="center"></td>
						<td width="170" valign="center" align="left"></td>
						<td width="70" 	valign="center" align="center">'.$tahun_pajak.'</td>
						<td width="170" valign="center" align="right">'.number_format($sisa,2,",",".").'</td>
						<td width="100" valign="center" align="left">'.$kualitas.'</td>
						<td width="70"  valign="center" align="right">'.$persen.'%</td>
						<td width="150" valign="center" align="right">'.number_format($nilai_sisih,2,",",".").'</td>
						<td width="150" valign="center" align="right">'.number_format($nil_akhir,2,",",".").'</td>
					</tr>';
					$tot_sisih = $tot_sisih+$nilai_sisih;
				}
				$nama = $nama_sptpd;
			}else{
				$tot_akhir = $sisa-$tot_sisih;
				$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"></td>
					<td colspan="2" width="240" valign="center" align="center"> <strong>JUMLAH</strong></td>
					<td width="170" valign="center" align="right"><strong>'.number_format($sisa,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong></strong></td>
					<td width="70"  valign="center" align="right"><strong></strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($tot_sisih,2,",",".").' </strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($tot_akhir,2,",",".").'</strong></td>
				</tr>';
				$tot_total = $tot_total+$sisa;
				$total_sisih = $total_sisih+$tot_sisih;
				$total_akhir = $total_akhir+$tot_akhir;
			}
			
		}
		
		$report .='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="30" 	valign="center" align="center"></td>
					<td colspan="2" width="240" valign="center" align="center"> <strong>TOTAL</strong></td>
					<td width="170" valign="center" align="right"><strong>'.number_format($tot_total,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong> </strong></td>
					<td width="70"  valign="center" align="right"><strong> </strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($total_sisih,2,",",".").'</strong></td>
					<td width="150" valign="center" align="right"><strong>'.number_format($total_akhir,2,",",".").'</strong></td>
				</tr>';
		$report .='	</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			$data['prev']= $report;
			
		/* $pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_penyisihan_Piutang_Pajak'.'.pdf', 'I'); */
			$judul ="lap_piutang_penyisihan";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);		
	}

	function lap_pajaklain(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd !='RET' AND kode_sptpd !='PLL'");
		$this->load->view('report_pajak/lap_pajaklain', $data);
	}
	
	function cetak_lap_pajaklain(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$tgl_awal = $t[0];
		$b = explode('-',$tgl_awal);
		$b1 = $b[1];
		$b1_1 = $b1-1;
		$b2 = $b[0];
		$awal 				= $this->msistem->v_bln($b1);
		$tgl_akhir = $t[1];
		$b = explode('-',$tgl_akhir);
		$c1 = $b[1];
		$c1_1 = $b1-1;
		$c2 = $b[0];
		$akhir 				= $this->msistem->v_bln($c1);
		$marginBawah = $t[2];
		$cetak = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','LEGAL',false);
		//set data
		
		$tahun		= date("Y");
		$tahun_l	= $tahun-1;
		
		if($awal==$akhir){
			$bulan=strtoupper($awal);
		}else{
			$bulan= strtoupper($awal).' - '.strtoupper($akhir).'';
		}
	
		$report = '';
		$report .=
			'<table borde="0">
					
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="6" align="center" >
									<b>LAPORAN REALISASI BULANAN DANA PERIMBANGAN, BAGI HASIL</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td colspan="6" align="center" >
									<b> DAN PENERIMAAN LAIN-LAIN KABUPATEN MELAWI </b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								
								<td colspan="6" align="center">
									<b>BULAN '.$bulan.' '.$b2.'</b>
								</td>
							</tr>
							<tr>
								<td></td>
							</tr>
			</table>';
			
		$report .=
			'<table border="1" cellpadding="2" cellspacing="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" rowspan="2" valign="center" align="center"><strong>KODE REK</strong></td>
					<td width="280" rowspan="2" valign="center" align="center"><strong>Uraian</strong></td>
					<td width="140" rowspan="2" valign="center" align="center"><strong>Target</strong></td>
					<td width="200" colspan="2" valign="center" align="center"><strong>Realisasi Penerimaan</strong></td>
					<td width="90" rowspan="2" valign="center" align="center"><strong>Jumlah</strong></td>
					<td width="120" rowspan="2" valign="center" align="center"><strong>Bertambah/Berkurang</strong></td>
					<td width="50" rowspan="2" valign="center" align="center"><strong>%</strong></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="100"  valign="center" align="center"><strong>Bulan Lalu</strong></td>
					<td width="100" valign="center" align="center"><strong>Bulan Ini</strong></td>
				</tr>
				';
				
		$query2 =  $this->db->query("SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.bln_lalu,b.bln_ini FROM(
					SELECT LEFT(a.kd_rek,3) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE SUBSTR(jns_pajak,1,3) ='4.2' AND a.status_aktif='1')a
					LEFT JOIN (SELECT IFNULL(LEFT(a.kd_rek,3),0) AS kode_rekening,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN penerimaan ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN penerimaan ELSE 0 END) AS bln_ini 
					FROM dt_detail_pajaklain a
					LEFT JOIN dt_pajaklain b ON a.no_sptpd = b.no_sptpd GROUP BY LEFT(a.kd_rek,3))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='3') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='3'")->row();
		
		$query = "SELECT * FROM(
					SELECT kd_rek, nm_rek,target_realisasi FROM master_rekening 
					WHERE LENGTH(kd_rek)='14' AND status_aktif='1')a
					LEFT JOIN (SELECT a.kd_rek kode_rekening,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN penerimaan ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN penerimaan ELSE 0 END) AS bln_ini 
					FROM dt_detail_pajaklain a
					LEFT JOIN dt_pajaklain b ON a.no_sptpd = b.no_sptpd
					GROUP BY kd_rek)b
					ON a.kd_rek=b.kode_rekening
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.bln_lalu,b.bln_ini FROM(
					SELECT LEFT(a.kd_rek,11) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE SUBSTR(jns_pajak,1,3) ='4.2' AND a.status_aktif='1' GROUP BY LEFT(a.kd_rek,11))a
					LEFT JOIN (SELECT IFNULL(LEFT(a.kd_rek,11),0) AS kode_rekening,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN penerimaan ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN penerimaan ELSE 0 END) AS bln_ini 
					FROM dt_detail_pajaklain a
					LEFT JOIN dt_pajaklain b ON a.no_sptpd = b.no_sptpd GROUP BY LEFT(a.kd_rek,11))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='11') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='11'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.bln_lalu,b.bln_ini FROM(
					SELECT LEFT(a.kd_rek,5) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE SUBSTR(jns_pajak,1,3) ='4.2' AND a.status_aktif='1' GROUP BY LEFT(a.kd_rek,5))a
					LEFT JOIN (SELECT IFNULL(LEFT(a.kd_rek,5),0) AS kode_rekening,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN penerimaan ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN penerimaan ELSE 0 END) AS bln_ini 
					FROM dt_detail_pajaklain a
					LEFT JOIN dt_pajaklain b ON a.no_sptpd = b.no_sptpd GROUP BY LEFT(a.kd_rek,5))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='5') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='5'
					UNION ALL
					SELECT a.kd_rek,c.nm_rek,a.target_realisasi,b.kode_rekening,b.bln_lalu,b.bln_ini FROM(
					SELECT LEFT(a.kd_rek,3) AS kd_rek ,SUM(target_realisasi) target_realisasi FROM master_rekening a
					WHERE SUBSTR(jns_pajak,1,3) ='4.2' AND a.status_aktif='1' GROUP BY LEFT(a.kd_rek,3))a
					LEFT JOIN (SELECT IFNULL(LEFT(a.kd_rek,3),0) AS kode_rekening,
					SUM(CASE WHEN MONTH(tgl_diterima) <='$b1_1'  THEN penerimaan ELSE 0 END) AS bln_lalu ,
					SUM(CASE WHEN MONTH(tgl_diterima) ='$b1'  THEN penerimaan ELSE 0 END) AS bln_ini 
					FROM dt_detail_pajaklain a
					LEFT JOIN dt_pajaklain b ON a.no_sptpd = b.no_sptpd GROUP BY LEFT(a.kd_rek,3))b
					ON a.kd_rek=b.kode_rekening 
					LEFT JOIN(
					SELECT kd_rek,nm_rek FROM master_rekening WHERE LENGTH(kd_rek)='3') c
					ON a.kd_rek=c.kd_rek
					WHERE LENGTH(a.kd_rek)='3'
					ORDER BY kd_rek";
					
		$i=1;
		$tot_target 		= $query2->target_realisasi;
		$tot_bln_lalu 	= $query2->bln_lalu;
		$tot_bn_ini 	= $query2->bln_ini;
		$tot_jml 		= $tot_bn_ini+$tot_bln_lalu;
		//$tot_sisa 		= $tot_jml-$tot_target;
		$tot_sisa 		= $this->msistem->rp_minus($tot_jml-$tot_target);
		
		 if($tot_target==0){
				$tot_persen=0;
		}else{
				$tot_persen = $tot_jml/$tot_target*100;
			}
			
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$kd_rek 	= $rs->kd_rek;
			$nm_rek 	= $rs->nm_rek;
			$target 	= $rs->target_realisasi;
			//$tahun_pajak 	= $rs->tahun_pajak;
			$bln_ini 		= $rs->bln_ini;
			$bln_lalu 		= $rs->bln_lalu;
			$jml			= $bln_ini+$bln_lalu;
			$tambah_kurang	= $jml-$target;
			$tambah_kurang1	= $this->msistem->rp_minus($tambah_kurang);
			
			
			
			 if($target==0){
				$persen=0;
			}else{
				$persen = $jml/$target*100;
			}

			if(strlen($kd_rek)>=12){
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left">'.$kd_rek.'</td>
					<td width="280" valign="center" align="left">'.$nm_rek.'</td>
					<td width="140" valign="center" align="right">'.number_format($target,2,",",".").'</td>
					<td width="100" valign="center" align="right">'.number_format($bln_lalu,2,",",".").'</td>
					<td width="100" valign="center" align="right">'.number_format($bln_ini,2,",",".").'</td>
					<td width="90" valign="center" align="right">'.number_format($jml,2,",",".").'</td>
					<td width="120" valign="center" align="right">'.$tambah_kurang1.'</td>
					<td width="50" valign="center" align="center">'.number_format($persen,2,",",".").'</td>
				</tr>';
			}else{
				$muncul='<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9px">
					<td width="70" valign="center" align="left"><strong>'.$kd_rek.'</strong></td>
					<td width="280" valign="center" align="left"><strong>'.$nm_rek.'</strong></td>
					<td width="140" valign="center" align="right"><strong>'.number_format($target,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong>'.number_format($bln_lalu,2,",",".").'</strong></td>
					<td width="100" valign="center" align="right"><strong>'.number_format($bln_ini,2,",",".").'</strong></td>
					<td width="90" valign="center" align="right"><strong>'.number_format($jml,2,",",".").'</strong></td>
					<td width="120" valign="center" align="right"><strong>'.$tambah_kurang1.'</strong></td>
					<td width="50" valign="center" align="center"><strong>'.number_format($persen,2,",",".").'</strong></td>
				</tr>';
			}
		
				$report .=$muncul;

				
			//$tot_total 		= $tot_total+$target;
			$i++;	
		}
		$report .='<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:10px">
					<td colspan="2" width="350" align="center"><strong>DANA PERIMBANGAN + LAIN-LAIN PENDAPATAN YANG SAH</strong></td>
					<td width="140" align="right"><strong>'.number_format($tot_target,2,",",".").'</strong></td>
					<td width="100" align="right"><strong>'.number_format($tot_bln_lalu,2,",",".").'</strong></td>
					<td width="100" align="right"><strong>'.number_format($tot_bn_ini,2,",",".").'</strong></td>
					<td width="90" align="right"><strong>'.number_format($tot_jml,2,",",".").'</strong></td>
					<td width="120" align="right"><strong>'.$tot_sisa.'</strong></td>
					<td width="50" align="center"><strong>'.number_format($tot_persen,2,",",".").'</strong></td>
				</tr>
				</table>';
		
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
			$pdf->Output('Report_Target_realisasi_pajaklainya'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_target_realisasi_pajaklainnya";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}		 
	}
	
	function jurnal(){
		$data['pajak'] = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd WHERE kode_sptpd !='RET' AND kode_sptpd !='PLL'");
		$this->load->view('report_pajak/jurnal', $data);
	}
	
	function cetak_jurnal(){
		$p2 = $_GET['full'];
		$t = explode('|',$p2);
		$tgl_awal = $t[0];
		$tgl_akhir = $t[1];
		$b = explode('-',$tgl_awal);
		$b1 = $b[1];
		$b1_1 = $b1-1;
		$b2 = $b[0];
		$awal 				= $this->msistem->v_bln($b1);
		$b = explode('-',$tgl_akhir);
		$c1 = $b[1];
		$c1_1 = $b1-1;
		$c2 = $b[0];
		$akhir 				= $this->msistem->v_bln($c1);
		$tgl_akhir = $t[1];
		$marginBawah = $t[2];
		$cetak = $t[3];
		
		//$ttd = $t[3];
		
		ini_set('memory_limit', '10000M'); 
		ini_set('max_execution_time', '60');
		
		
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
		$pdf->SetAutoPageBreak(true,$marginBawah);
		// set font yang digunakan
		//$pdf->SetFont('times', '', 8);
		
		$pdf->AddPage('L','LEGAL',false);
		//set data
		
		$tahun		= date("Y");
		$tahun_l	= $tahun-1;
		
		if($awal==$akhir){
			$bulan=strtoupper($awal);
		}else{
			$bulan= strtoupper($awal).' - '.strtoupper($akhir).'';
		}
	
		$report = '';
		$report .=
			'<table border="0">
							<tr style="font-family: Calibri; font-weight:bold; font-size:18px">
								<td colspan="5" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Calibri; font-weight:bold; font-size:18px">
								<td colspan="5" align="center">
									<b>BADAN PENDAPATAN DAERAH</b>
								</td>
					
							</tr>
							<tr>
								<td>
								</td>
							</tr>
							<tr style="font-family: Calibri; font-size:18px">
								<td colspan="5" align="center">
									JURNAL PENERIMAAN KAS
								</td>
					
							</tr>
							<tr style="font-family: Calibri; font-size:18px">
								<td colspan="5" align="center">
									DANA PERIMBANGAN DAN LAIN-LAIN PENDAPATAN DAERAH YANG SAH
								</td>
					
							</tr>
							<tr style="font-family: Calibri; font-size:18px">
								<td colspan="5" align="center">
									BULAN '.$bulan.' '.$b2.'
								</td>
					
							</tr>
							<tr>
								<td></td>
							</tr>
		
			</table>';
			$sql = $this->db->query("SELECT * FROM(SELECT a.tgl_diterima,a.uraian,a.jml_dibayar,SUM(IFNULL(a.jml_dibayar,0)) AS saldo  FROM dt_pajaklain a 
					INNER JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd WHERE SUBSTR(a.tgl_diterima,7,1)='$b1_1')b")->row();
			
		$report .=
			'<table border="1" cellpadding="1" cellspacing="0">
				<tr style="font-family: Calibri; font-size:16px">
					<td width="30" bgcolor="#DEDEDE"  align="center"><strong>NO</strong></td>
					<td width="120" bgcolor="#DEDEDE" align="center"><strong>TANGGAL</strong></td>
					<td width="350" bgcolor="#DEDEDE" align="center"><strong>URAIAN</strong></td>
					<td width="150" bgcolor="#DEDEDE" align="center"><strong>NOMOR BUKTI TRANSFER</strong></td>
					<td width="150" bgcolor="#DEDEDE" align="center"><strong>KAS MASUK (Rp)</strong></td>
					<td width="150" bgcolor="#DEDEDE" align="center"><strong>AKUMULASI (Rp)</strong></td>
				</tr>
				<tr style="font-family: Calibri; font-weight:bold; font-size:16px">
					<td colspan="5" width="800" align="center"><strong>SALDO AWAL/SALDO BULAN SEBELUMNYA</strong></td>
					<td width="150" align="right">'.number_format($sql->saldo,2,",",".").'</td>
				</tr>';
				
		
		$query = "SELECT * FROM (
					SELECT a.tgl_diterima,a.uraian,a.jml_dibayar,a.no_bukti FROM dt_pajaklain a 
					INNER JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd WHERE SUBSTR(a.tgl_diterima,6,2)=$b1)a
					UNION ALL
					SELECT * FROM(SELECT a.tgl_diterima,a.uraian,a.jml_dibayar,a.no_bukti FROM dt_pajaklain a 
					INNER JOIN dt_detail_pajaklain b ON a.no_sptpd=b.no_sptpd WHERE SUBSTR(a.tgl_diterima,6,2)='$b1_1')b";
		
		
		
		
		$saldo 			= $sql->saldo;
		$total 			= 0;
		$no =0;
		$query2 = $this->db->query($query);
		foreach($query2->result() as $rs){
			$no=$no+1;
			$tgl 	= $rs->tgl_diterima;
			$pisah = explode('-',$tgl);
			$thn = $pisah[0];
			$blm = $pisah[1];
			$hr = $pisah[2];
			$gabung = $hr.'/'.$blm.'/'.$thn;
			$uraian 	= $rs->uraian;
			$bukti 	= $rs->no_bukti;
			$terima 	= $rs->jml_dibayar;
			$saldo	 	= $saldo+$terima;
			$total 			= $total+$terima;
			/*$thn_lalu 		= $rs->thn_lalu;
			$thn_ini 		= $rs->thn_ini;
			$sisa 			= $total - $thn_lalu - $thn_ini; */ 
			
			$report .='<tr style="font-family: Calibri; font-size:16px">
					<td width="30" 	align="center">'.$no.'</td>
					<td width="120" align="center">'.$gabung.'</td>
					<td width="350" align="left">'.$uraian.'</td>
					<td width="150" align="right">'.$bukti.'</td>
					<td width="150" align="right">'.number_format($terima,2,",",".").'</td>
					<td width="150" align="right">'.number_format($saldo,2,",",".").'</td>
				</tr>';
				
			
		}
	 $report .='<table border="1">
				<tr style="font-family: Calibri; font-weight:bold; font-size:16px">
					<td colspan="4" width="650" align="center">JUMLAH</td>
					<td width="150" align="right">'.number_format($total,2,",",".").'</td>
					<td width="150" align="right">'.number_format($saldo,2,",",".").'</td>
				</tr>
				</table>';
	 $report .='<table border="0">
				<tr>
					<td></td>
				</tr>
				<tr style="font-family: Calibri; font-size:16px">
					<td width="800" colspan="5" align="right">JUMLAH BULAN INI</td>
					<td width="150" align="right">'.number_format($total,2,",",".").'</td>
				</tr>
				<tr style="font-family: Calibri; font-size:16px">
					<td width="800" colspan="5" align="right">JUMLAH SAMPAI BULAN LALU</td>
					<td width="150"  align="right"><u>'.number_format($sql->saldo,2,",",".").'</u></td>
				</tr>
				<tr style="font-family: Calibri; font-weight:bold; font-size:16px">
					<td width="800" colspan="5" align="right">JUMLAH S/D BULAN '.strtoupper($awal).' '.$b2.'</td>
					<td width="150"  align="right">'.number_format($saldo,2,",",".").'</td>
				</tr>
				</table>
				</table>';
				
		$data['prev']= $report;
			
		switch($cetak) {       
        case 1;
			$pdf->writeHTML($report, true, false, true, false);
			$pdf->lastPage();
			$pdf->Output('Report_Jurnal'.'.pdf', 'I');	
        break;
        case 2;        
            $judul ="lap_jurnal";
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('report_pajak/all_excel', $data);
        break;
		}
	}
}
?>