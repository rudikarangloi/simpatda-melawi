<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_perusahaan.xls');	
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
		
		$s = explode('-',$akhir);
		$d = $this->msistem->v_bln($s[1]);
		$tgl2 = $s[2].' '.strtoupper($d).' '.$s[0];

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

		if($p==NULL){
			$qr = "";
		} else {
			$qr = "left(a.npwpd_perusahaan,2)='".$p."'";
		} 
?>
<h2 align="center">LAPORAN DATA WAJIB PAJAK</h2>
<h2 align="center"><?php echo $nm_pjk; ?></h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>TMT</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>NPWPD LAMA</strong></td>
		<td align="center"><strong>NAMA PEMILIK</strong></td>
		<td align="center"><strong>NAMA USAHA</strong></td>
		<td align="center"><strong>ALAMAT</strong></td>
		<td align="center"><strong>KECAMATAN</strong></td>
		<td align="center"><strong>KELURAHAN</strong></td>
		
		
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
		
		
	</tr>
	<?php
	$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tanggal,  a.npwpd_perusahaan, a.npwpd_lama,c.nama_pemilik,a.nama_perusahaan, 
					a.jalan, b.nama_kecamatan, b.nama_kelurahan FROM identitas_perusahaan a LEFT JOIN view_kelurahan b ON a.kecamatan=b.kode_kecamatan 
					AND a.kelurahan=b.kode_kelurahan LEFT JOIN identitas_pemilik c ON a.npwpd_pemilik = c.npwpd_pemilik WHERE $qr AND a.tgl_daftar>='".$awal."' AND a.tgl_daftar<='".$akhir."' GROUP BY a.npwpd_perusahaan ORDER BY a.tgl_daftar ASC");
		
		$i=1;
		foreach($query->result() as $rs) {
				
			echo
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px">
					<td align="center">'.$i.'</td>
					<td align="center">'.$rs->tanggal.'</td>
					<td align="center">'.$rs->npwpd_perusahaan.'</td>
					<td align="left">&nbsp;&nbsp;'.$rs->npwpd_lama.'&nbsp;</td>
					<td  align="left">&nbsp;&nbsp;'.$rs->nama_pemilik.'&nbsp;</td>
					<td  align="left">&nbsp;&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td  align="left">'.$rs->jalan.'&nbsp;</td>
					<td  align="left">&nbsp;&nbsp;'.$rs->nama_kecamatan.'&nbsp;</td>
					<td  align="left">&nbsp;&nbsp;'.$rs->nama_kelurahan.'&nbsp;</td>
				</tr>';
			$i++;
		}
		?>
	</table>
	
</body>
</html>