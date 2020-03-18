<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=skp_sudah_bayar.xls');	
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
$p = explode('|',$data);
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
?>
<h2 align="center">Laporan SKP Sudah Bayar (Official Assesment)</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>
<p align="center">Jenis Pajak : <?php echo $nm_pajak; ?></p>

<table border=1>
	<tr>
		<td rowspan="2" align="center"><strong>NO.</strong></td>
		<td colspan="4" align="center"><strong>TANGGAL & NO. BUKTI</strong></td>
		<td rowspan="2" align="center"><strong>NPWPD</strong></td>
		<td rowspan="2" align="center"><strong>WAJIB PAJAK</strong></td>
		<td rowspan="2" align="center"><strong>ALAMAT</strong></td>
		<td rowspan="2" align="center"><strong>KETETAPAN</strong></td>
		<td rowspan="2" align="center"><strong>DENDA</strong></td>
		<td rowspan="2" align="center"><strong>REALISASI</strong></td>
	</tr>
	<tr>
		<td align="center"><strong>TGL SKP</strong></td>
		<td align="center"><strong>NO. SKP</strong></td>
		<td align="center"><strong>TGL SETOR</strong></td>
		<td align="center"><strong>NO. SSPD</strong></td>
	</tr>
    <?php
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
		
		echo
			'<tr>
				<td align="center">'.$no.'</td>
				<td align="center">'.$rs->tgl.'</td>
				<td align="center">'.$rs->no_skpd.'</td>
				<td align="center">'.$rs->tanggal.'</td>
				<td align="center">'.$rs->no_sspd.'</td>
				<td align="center">'.$rs->npwpd_perusahaan.'</td>
				<td align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
				<td align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
				<td align="right">Rp. '.number_format($rs->ketetapan,2,",",".").'&nbsp;</td>
				<td align="right">Rp. '.number_format($rs->denda,2,",",".").'&nbsp;</td>
				<td align="right">Rp. '.number_format($rs->setoran,2,",",".").'&nbsp;</td>
			</tr>';
				$tetap = $tetap + $rs->ketetapan;
				$tdenda = $tdenda + $rs->denda;
				$setor = $setor + $rs->setoran;
			$no++;
		}
		
		echo
			'<tr>
				<td align="center" colspan="8"><strong>Jumlah</strong></td>
				<td align="right"><strong>Rp. '.number_format($tetap,2,",",".").'&nbsp;</strong></td>
				<td align="right"><strong>Rp. '.number_format($tdenda,2,",",".").'&nbsp;</strong></td>
				<td align="right"><strong>Rp. '.number_format($setor,2,",",".").'&nbsp;</strong></td>
			</tr>';
		?>
	</table>
	
</body>
</html>