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
		
			$realisasi = $this->db->query("SELECT SUM(c.setoran_wp) AS jumlah FROM sspd_detail a LEFT JOIN sspd b ON a.no_sspd=b.no_sspd 
            LEFT JOIN pembayaran c ON c.no_sspd=a.no_sspd WHERE a.kode_rekening = '".$kode."' AND b.tahun_pajak ='".date('Y')."' AND b.tanggal <= '".date('Y-m-d')."'")->row();
			
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
	
	function data_target(){
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
INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak");

		$i=1;
		foreach($sql->result() as $rs) {
			$kode = $rs->kode_sptpd;
		
			$realisasi = $this->db->query("SELECT SUM(pembayaran.setoran_wp) AS jumlah FROM sspd INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_pajak ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();
			
			$persen = $realisasi->jumlah*100/$rs->target;
			$persen = number_format($persen,2,",",".");
			
			if($realisasi->jumlah==0){
				$setor = 0;
			} else {
				$setor = $realisasi->jumlah;
			}
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[Pajak ".$rs->nama_sptpd."]]></cell>");
				echo("<cell><![CDATA[".$rs->target."]]></cell>");
				echo("<cell><![CDATA[".$setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ttd_target(){
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('report_pajak/ttd_target',$data);
	}
	
	function cetak_target(){
		$ttd = $_GET['full'];
		
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
		$pdf->SetMargins(180,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
		
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<table width="500">
				<tr>
					<td><h2 align="center">Target Dan Realisasi Pajak Daerah</h2></td>
				</tr>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1" align="center">
				<tr>
					<td width="20" height="12" align="center"><strong>No.</strong></td>
					<td width="170" height="12" align="center"><strong>Jenis Pajak Daerah</strong></td>
					<td width="120" height="12" align="center"><strong>Target</strong></td>
					<td width="120" height="12" align="center"><strong>Realisasi ( sampai saat ini )</strong></td>
					<td width="70" height="12" align="center"><strong>Persen (%)</strong></td>
				</tr>';
		
		$query = $this->db->query("SELECT
master_sptpd.nama_sptpd, master_sptpd.kode_sptpd,
target_pajak.target
FROM
master_sptpd
INNER JOIN target_pajak ON master_sptpd.kode_sptpd = target_pajak.jenis_pajak");
		$i=1;
		$target=0;
		$terima=0;
		$keluar=0;
		foreach($query->result() as $rs) {
			$kode = $rs->kode_sptpd;
		
			$realisasi = $this->db->query("SELECT SUM(pembayaran.setoran_wp) AS jumlah FROM sspd INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd WHERE sspd.kode_pajak = '".$kode."' AND sspd.tahun_pajak ='".date('Y')."' AND sspd.tanggal <= '".date('Y-m-d')."'")->row();
			
			$persen = $realisasi->jumlah*100/$rs->target;
			$persen1 = number_format($persen,2,",",".");
			
			if($realisasi->jumlah==0){
				$setor = 0;
			} else {
				$setor = $realisasi->jumlah;
			}
				
			$report .=
				'<tr>
					<td width="20" height="12" align="center">'.$i.'</td>
					<td width="170" height="12" align="left">&nbsp; Pajak '.$rs->nama_sptpd.'</td>
					<td width="120" height="12" align="right">'.number_format($rs->target,2,",",".").'&nbsp;</td>
					<td width="120" height="12" align="right">'.number_format($setor,2,",",".").'&nbsp;</td>
					<td width="70" height="12" align="right">'.$persen1.'&nbsp;</td>
				</tr>';
			$target = $target+$rs->target;
			$terima = $terima+$setor;
			$keluar = $keluar+$persen;
			$i++;
		}
		
		$report .=
				'<tr>
					<td width="190" align="center"><strong>JUMLAH</strong></td>
					<td width="120" height="12" align="right"><strong>Rp.&nbsp;'.number_format($target,2,",",".").'&nbsp;</strong></td>
					<td width="120" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima,2,",",".").'&nbsp;</strong></td>
					<td width="70" height="12" align="right"><strong>'.number_format($keluar,2,",",".").'&nbsp;</strong></td>
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
		
		$wid = 500/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="500">
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
view_perusahaan.nama_perusahaan,
sspd.nomor,
sspd.kode_pajak,
pembayaran.setoran_wp
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where sspd.tanggal>='".$awal."' and sspd.tanggal<='".$akhir."' $qr");
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
				echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
				echo("<cell><![CDATA[Diterima dari ".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$no_rek."]]></cell>");
				echo("<cell><![CDATA[".$nm_rek."]]></cell>");
				echo("<cell><![CDATA[".$rs->setoran_wp."]]></cell>");
				echo("<cell><![CDATA[".$null."]]></cell>");
			echo("</row>");
			$i++;	
		}
		echo "</rows>";
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
pembayaran.setoran_wp
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
LEFT JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd where month(sspd.tanggal)='".$bln."' and sspd.tahun_transaksi='".$thn."' $qr");
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
				echo("<cell><![CDATA[".$rs->setoran_wp."]]></cell>");
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
sspd.setoran
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
			if($kode=='GAL'){
				$no_rek = '4.1.1.11.06';
				$nm_rek = 'Mineral Bukan Logam dan Batuan';
			}
				
			$report .=
				'<tr>
					<td width="20" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->no_sspd.'</td>
					<td width="210" height="12" align="left">&nbsp;'.$no_rek." - ".$nm_rek.'</td>
					<td width="200" height="12" align="left">&nbsp;'.$rs->nama_perusahaan." - ".$rs->alamat_perusahaan.'&nbsp;</td>
					<td width="105" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="145" height="12" align="right">Rp.&nbsp;'.number_format($rs->setoran,2,",",".").'&nbsp;</td>
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
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
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
			'<h2 align="center">LAPORAN BUKU KAS UMUM</h2>
			<p align="center">PERIODE : '.$tgl1.' s/d '.$tgl2.'</p>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="12" align="center"><strong>NO.</strong></td>
					<td width="90" height="12" align="center"><strong>NO. SSPD</strong></td>
					<td width="80" height="12" align="center"><strong>TANGGAL</strong></td>
					<td width="170" height="12" align="center"><strong>URAIAN</strong></td>
					<td width="100" height="12" align="center"><strong>KODE REKENING</strong></td>
					<td width="145" height="12" align="center"><strong>NAMA REKENING</strong></td>
					<td width="90" height="12" align="center"><strong>PENERIMAAN</strong></td>
					<td width="90" height="12" align="center"><strong>PENGELUARAN</strong></td>
				</tr>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
				
		$query = $this->db->query("SELECT
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal,
view_perusahaan.nama_perusahaan,
sspd.nomor,
sspd.kode_pajak,
sspd.setoran
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where sspd.tanggal>='".$awal."' and sspd.tanggal<='".$akhir."' $qr");

	$query2 = $this->db->query("SELECT
sum(sspd.setoran) as jl
FROM
view_perusahaan
INNER JOIN sspd ON view_perusahaan.npwpd_perusahaan = sspd.npwpd where sspd.tanggal>='".$awal2."' and sspd.tanggal<='".$akhir2."' $qr")->row();

$terima2 = $query2->jl;
		$i=1;
		$terima=0;
		$keluar=0;
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
				
			$report .=
				'<tr>
					<td width="20" height="12" align="center">'.$i.'</td>
					<td width="90" height="12" align="center">'.$rs->no_sspd.'</td>
					<td width="80" height="12" align="center">'.$rs->tanggal.'</td>
					<td width="170" height="12" align="left">&nbsp;Diterima dari '.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="100" height="12" align="center">&nbsp;'.$no_rek.'&nbsp;</td>
					<td width="145" height="12" align="left">&nbsp;'.$nm_rek.'&nbsp;</td>
					<td width="90" height="12" align="right">Rp.&nbsp;'.number_format($rs->setoran,2,",",".").'&nbsp;</td>
					<td width="90" height="12" align="right">Rp.&nbsp;'.number_format($null,2,",",".").'&nbsp;</td>
				</tr>';
			
			$terima = $terima+$rs->setoran;
			$keluar = $keluar+$null;
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
					<td width="605" align="center"><strong>JUMLAH</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima,2,",",".").'&nbsp;</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($keluar,2,",",".").'&nbsp;</strong></td>
				</tr>
				<tr>
					<td width="605" align="center"><strong>JUMLAH PENERIMAAN SAMPAI DENGAN HARI SEBELUMNYA</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($terima2,2,",",".").'&nbsp;</strong></td>
					<td width="90" height="12" align="right"><strong>Rp.&nbsp;'.number_format($keluar,2,",",".").'&nbsp;</strong></td>
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
		$pdf->Output('Report_Buku_Kas'.'.pdf', 'I');		
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
        INNER JOIN pembayaran c ON c.no_sspd = a.no_sspd where a.tanggal = '".$tgl."' $qr");
		
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
		$data['pajak'] = $this->db->query("select id, nama_sptpd from master_sptpd");
		$this->load->view('report_pajak/perusahaan', $data);		
	}
	
	function data_usaha($pajak=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($pajak==NULL){
			$qr = "";
		} else {
			$qr = "where a.jenis_usaha = '".$pajak."'";
		}
		$query = $this->db->query("SELECT a.npwpd_perusahaan, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') AS tanggal,  a.nama_perusahaan, a.jalan, b.nama_kecamatan
							       FROM identitas_perusahaan a 
								   JOIN kecamatan b ON a.kecamatan=b.kode_kecamatan $qr");
		//$query = $this->db->query("select DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tanggal, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_usaha=c.id $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
		
		echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$i."]]></cell>");
				echo("<cell><![CDATA[".$rs->terdaftar."]]></cell>");
				echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
				echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
				echo("<cell><![CDATA[".$rs->nama_sptpd."]]></cell>");
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
	
	function cetak_usaha(){
		$r = $_GET['full'];
		$l = explode('|',$r);
		$p = $l[0];
		$ttd = $l[1];
		
		if($p==NULL){
			$qr = "";
		} else {
			$qr = "where a.jenis_usaha='".$p."'";
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
		$pdf->SetMargins(20,30,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 9);
	
		$pdf->AddPage('L','A4',false);
		//set data
		$report = '';
		$report .=
			'<h2 align="center">LAPORAN DATA WAJIB PAJAK</h2>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="20" height="10" align="center"><strong>NO.</strong></td>
					<td width="55" height="10" align="center"><strong>TANGGAL</strong></td>
					<td width="100" height="12" align="center"><strong>NPWPD</strong></td>
					<td width="150" height="12" align="center"><strong>NAMA WAJIB PAJAK</strong></td>
					<td width="210" height="12" align="center"><strong>ALAMAT</strong></td>
					<td width="100" height="12" align="center"><strong>KECAMATAN</strong></td>
					<td width="80" height="12" align="center"><strong>KELURAHAN</strong></td>
					<td width="80" height="12" align="center"><strong>JENIS PAJAK</strong></td>
				</tr>';
		$query = $this->db->query("SELECT a.npwpd_perusahaan, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') AS tanggal,  a.nama_perusahaan, a.jalan, b.nama_kecamatan
							       FROM identitas_perusahaan a 
								   JOIN kecamatan b ON a.kecamatan=b.kode_kecamatan $qr");
		//$query = $this->db->query("select DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tanggal, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_pajak=c.id $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
				
			$report .=
				'<tr>
					<td width="20" height="10" align="center">'.$i.'</td>
					<td width="55" height="10" align="center">'.$rs->tanggal.'</td>
					<td width="100" height="12" align="center">'.$rs->npwpd_perusahaan.'</td>
					<td width="150" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td width="210" height="12" align="left">&nbsp;&nbsp;'.$rs->jalan.'&nbsp;</td>
					<td width="100" height="12" align="left">&nbsp;&nbsp;'.$rs->nama_kecamatan.'&nbsp;</td>
					<td width="80" height="12" align="left">&nbsp;&nbsp;&nbsp;</td>
					<td width="80" height="12" align="left">&nbsp;&nbsp;&nbsp;</td>
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
}
?>