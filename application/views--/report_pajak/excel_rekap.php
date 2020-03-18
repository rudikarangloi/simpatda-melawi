<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=rekap_bank.xls');	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
</head>

<body bgcolor="#FFFFFF">
<?php
$dt = explode('|',$data);
$bank = $dt[0];
$tgl = $dt[1];
	
$t = explode('-',$tgl);
$time = $t[2].'-'.$t[1].'-'.$t[0];
		
if($bank=='200'){
	$nm = 'BANK NAGARI';
} else if($bank=='300'){
	$nm = 'BANK BTN';
} else if($bank=='0009'){
	$nm = 'BANK BNI';
}
?>
<h2 align="center">REKAPITULASI PENERIMAAN HARIAN<br />TANGGAL <?php echo $time; ?><br /><?php echo $nm; ?></h2>

<table border="1">
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>JENIS PAJAK</strong></td>
		<td align="center"><strong>GOLONGAN JENIS PAJAK</strong></td>
		<td align="center"><strong>PAJAK TAHUN <br/> BERJALAN</strong></td>
		<td align="center"><strong>PIUTANG PAJAK</strong></td>
		<td align="center"><strong>DENDA</strong></td>
		<td align="center"><strong>TOTAL BAYAR</strong></td>
	</tr>
    <?php
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
	
    
    	echo 
		'<tr>
    		<td align="center" width="20"><strong>'.$ro.'</strong></td>
            <td colspan="6" width="770">&nbsp;&nbsp;<strong>'.strtoupper('Pajak '.$nama).'</strong></td>
        </tr>';
    	if($kode=='GAL'){
			$spt = $this->db->query("SELECT
kode_pajak
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
SUM(sspd.setoran) as setoran,
SUM(sspd.denda) as denda
FROM
sspd
WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'")->row();
			} else {
				$nop = $q->kode_rekening;
				$nm = $q->nama_rekening;
				$spt = $this->db->query("SELECT
SUM(sspd.ketetapan) as ketetapan,
SUM(sspd.setoran) as setoran,
SUM(sspd.denda) as denda
FROM
sspd
INNER JOIN sspd_detail ON sspd.no_sspd = sspd_detail.no_sspd WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and kode_rekening = '".$nop."'")->row();
			}
			
			$thn = date('Y');
			//pajak tahun berjalan
			/*$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			$ptb = $setor->jumlah;
			if($ptb==NULL){*/
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("select sum(a.ketetapan) as tetap, sum(a.denda) as denda, sum(a.setoran) as jumlah from sspd a left join sspd_detail b on a.no_sspd=b.no_sspd where b.kode_rekening = '".$nop."' and a.tahun_pajak != '".$thn."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL||$piu<0){
				$piu = 0;
			}
	
	echo
		'<tr>
        	<td></td>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;'.$nop.' - '.strtoupper($nm).'</td>
            <td align="right">'.number_format($spt->ketetapan,2,",",".").'&nbsp;</td>
        	<td align="right">'.number_format($piu,2,",",".").'&nbsp;</td>
        	<td align="right">'.number_format($spt->denda,2,",",".").'&nbsp;</td>
        	<td align="right">'.number_format($spt->setoran,2,",",".").'&nbsp;</td>
        </tr>';
    
    		$jumlah = $jumlah + $spt->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $spt->denda;
			$setoran = $setoran + $spt->setoran;
			
			$no++;
		}
		
	echo
	'<tr>
    	<td colspan="3" align="center"><strong>JUMLAH</strong></td>
        <td align="right"><strong>'.number_format($jumlah,2,",",".").'&nbsp;</strong></td>
        <td align="right"><strong>'.number_format($tetap,2,",",".").'&nbsp;</strong></td>
        <td align="right"><strong>'.number_format($denda,2,",",".").'&nbsp;</strong></td>
        <td align="right"><strong>'.number_format($setoran,2,",",".").'&nbsp;</strong></td>
    </tr>';    
    
		$tjumlah = $tjumlah + $jumlah;
		$ttetap = $ttetap + $tetap;
		$tdenda = $tdenda + $denda;
		$tsetoran = $tsetoran + $setoran;
			
		$ro++;
	}
	?>
    <tr>
    	<td colspan="3" align="center" width="310"><strong>TOTAL</strong></td>
        <td align="right" width="120"><strong><?php echo number_format($tjumlah,2,",","."); ?>&nbsp;</strong></td>
        <td align="right" width="120"><strong><?php echo number_format($ttetap,2,",","."); ?>&nbsp;</strong></td>
        <td align="right" width="120"><strong><?php echo number_format($tdenda,2,",","."); ?>&nbsp;</strong></td>
        <td align="right" width="120"><strong><?php echo number_format($tsetoran,2,",","."); ?>&nbsp;</strong></td>
    </tr>
</table>

</body>
</html>