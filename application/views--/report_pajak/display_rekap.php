<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
</head>

<body bgcolor="#FFFFFF">
<?php
$t = explode('-',$tgl);
$time = $t[2].'-'.$t[1].'-'.$t[0];

/*if($bank=='200'){
	$nm = 'BANK NAGARI';
} else if($bank=='300'){
	$nm = 'BANK BTN';
} else if($bank=='0009'){
	$nm = 'BANK BNI';
} else {
    $nm = 'Loket';
}*/

if($bank=='1'){
    $nm = 'BANK';
}

?>
<table width="1300">
	<tr>
    	<td align="center"><h2 align="center">REKAPITULASI PENERIMAAN HARIAN<br />
TANGGAL <?php echo $time; ?><br /> PEMBAYARAN VIA
<?php echo $nm; ?></h2></td>
	</tr>
    <tr>
    	<td height="20">&nbsp;</td>
    </tr>
</table>

<table border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <th width="50">NO.</th>
    <th width="300">JENIS PAJAK</th>
    <th width="350">GOLONGAN JENIS PAJAK</th>
    <th width="150">PAJAK TAHUN <br/> BERJALAN</th>
    <th width="150">PIUTANG PAJAK</th>
    <th width="150">DENDA</th>
    <th width="150">TOTAL BAYAR</th>
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
	?>
    
    	<tr>
    		<td align="center"><strong><?php echo $ro; ?></strong></td>
            <td colspan="6"><strong>&nbsp;<?php echo strtoupper('Pajak '.$nama); ?></strong></td>
        </tr>
    
    <?php
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
SUM(pembayaran.setoran_wp) as setoran,
SUM(sspd.denda) as denda
FROM
sspd
LEFT JOIN pembayaran ON pembayaran.no_sspd=sspd.no_sspd
WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'")->row();
			} else {
				$nop = $q->kode_rekening;
				$nm = $q->nama_rekening;
				$spt = $this->db->query("SELECT
SUM(sspd.ketetapan) as ketetapan,
SUM(pembayaran.setoran_wp) as setoran,
SUM(sspd.denda) as denda
FROM
sspd
INNER JOIN sspd_detail ON sspd.no_sspd = sspd_detail.no_sspd 
LEFT JOIN pembayaran ON pembayaran.no_sspd=sspd.no_sspd WHERE sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and kode_rekening = '".$nop."'")->row();
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
	?>    
    
    	<tr>
        	<td></td>
            <td></td>
            <td>&nbsp;<?php echo $nop.' - '.strtoupper($nm); ?></td>
            <td align="right"><?php echo number_format($spt->ketetapan,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($piu,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($spt->denda,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($spt->setoran,2,",","."); ?>&nbsp;</td>
        </tr>
    
    <?php
			$jumlah = $jumlah + $spt->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $spt->denda;
			$setoran = $setoran + $spt->setoran;
			
			$no++;
		}
	?>
    <tr>
    	<td colspan="3" align="center"><strong>JUMLAH</strong></td>
        <td align="right"><strong><?php echo number_format($jumlah,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($tetap,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($denda,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($setoran,2,",","."); ?>&nbsp;</strong></td>
    </tr>    
    <?php
		$tjumlah = $tjumlah + $jumlah;
		$ttetap = $ttetap + $tetap;
		$tdenda = $tdenda + $denda;
		$tsetoran = $tsetoran + $setoran;
			
		$ro++;
	}
  ?>
  	<tr>
    	<td bgcolor="#DDD" colspan="3" align="center"><strong>TOTAL</strong></td>
        <td bgcolor="#DDD" align="right"><strong><?php echo number_format($tjumlah,2,",","."); ?>&nbsp;</strong></td>
        <td bgcolor="#DDD" align="right"><strong><?php echo number_format($ttetap,2,",","."); ?>&nbsp;</strong></td>
        <td bgcolor="#DDD" align="right"><strong><?php echo number_format($tdenda,2,",","."); ?>&nbsp;</strong></td>
        <td bgcolor="#DDD" align="right"><strong><?php echo number_format($tsetoran,2,",","."); ?>&nbsp;</strong></td>
    </tr>
</table>
</body>
</html>