<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_penerimaan_air_tanah.xls');	
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
/* if($pajak == NULL){
	$nm_pajak = 'Semua Pajak';
} else {
	$cari = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$pajak."'")->row();
	$nm_pajak = $cari->nama_sptpd; 
} */
?>
<h2 align="center">LAPORAN DAFTAR PEENERIMAAN PAJAK</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>NAMA WAJIB PAJAK</strong></td>
		<td align="center"><strong>NAMA/MERK USAHA</strong></td>
		<td align="center"><strong>ALAMAT USAHA</strong></td>
		<td align="center"><strong>JENIS PAJAK</strong></td>
		<td align="center"><strong>MERK USAHA</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>VOLUME AIR</strong></td>
		<td align="center"><strong>NO. SSPD</strong></td>
		<td align="center"><strong>KET/TMT</strong></td>
		<td align="center"><strong>TANGGAL SSPD</strong></td>
		<td align="center"><strong>JUMLAH</strong></td>
		<td align="center"><strong>TANGGAL BAYAR</strong></td>
		
		
	</tr>
	<tr>
		<td align="center"><strong>1</strong></td>
		<td align="center"><strong>2</strong></td>
		<td align="center"><strong>3</strong></td>
		<td align="center"><strong>4</strong></td>
		<td align="center"><strong>5</strong></td>
		<td align="center"><strong>6</strong></td>
		<td align="center"><strong>7</strong></td>
		<td align="center"><strong>8</strong></td>
		<td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		
	</tr>
	
    <?php
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
				
		$rc = $this->db->query("SELECT b.nama_pemilik,b.alamat_perusahaan,a.npwpd,b.nama_perusahaan,
a.masa_pajak1,a.masa_pajak2,a.no_sspd,
c.dp,c.denda,c.jumlah,a.setoran,a.status,DATE_FORMAT(d.tgl_bayar,'%d/%m/%Y') AS tgl_bayar,
c.kode_rekening,c.nama_rekening,DATE_FORMAT(a.tanggal,'%d/%m/%Y') AS tanggal,f.volume
FROM sspd a LEFT JOIN view_perusahaan b ON b.npwpd_perusahaan = a.npwpd
LEFT JOIN sspd_detail c ON c.no_sspd = a.no_sspd INNER JOIN pembayaran d ON a.no_sspd=d.no_sspd
INNER JOIN view_no e ON a.no_sspd=e.no_sspd
LEFT JOIN sptpd_air_bawah_tanah f ON e.sptpd=f.no_sptpd
WHERE $qr2 AND $qr AND d.tgl_bayar>='".$awal."' AND d.tgl_bayar<='".$akhir."' AND a.status='1' ORDER BY d.tgl_bayar ASC
");
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
				
			echo
				'<tr>
					<td align="center" valign="top">'.$i.'</td>
					<td align="left">'.$rs->nama_pemilik.'</td>
					<td align="left">'.$rs->nama_perusahaan.'</td>
					<td align="left">'.$rs->alamat_perusahaan.'</td>
					<td align="left">PJK.'.$rs->nama_rekening.'</td>
					<td align="left">'.$rs->nama_perusahaan.'</td>
					<td align="left">'.$rs->npwpd.'&nbsp;</td>
					<td align="center">'.$rs->volume.'M<sup>3</sup>&nbsp;</td>
					<td align="left">'.$rs->no_sspd.'&nbsp;</td>
					<td align="center">'.$this->msistem->c_bln($rs->masa_pajak1)." - ".$this->msistem->c_bln($rs->masa_pajak2).' </td>
					<td align="center">'.$rs->tanggal.'&nbsp;</td>
					<td align="right">'.number_format($rs->jumlah,2,",",".").'</td>
					<td align="center">'.$rs->tgl_bayar.'&nbsp;</td>
					
					
					
				</tr>';
			$total = $total+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		
		echo
			'<tr>
				<td align="center" colspan="11"><strong>Jumlah</strong></td>
				<td align="right"><strong>'.number_format($total,2,",",".").'</strong></td>
				<td align="right"></td>
			</tr>';
		?>
	</table>
	
</body>
</html>