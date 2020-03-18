<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_skpd.xls');	
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
<h2 align="center">DAFTAR WAJIB PAJAK REKLAME</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>NAMA<br>NPWPD</br></strong></td>
		<td align="center"><strong>TEMA REKLAME</strong></td>
		<td align="center"><strong>NAMA USAHA</strong></td>
		<td align="center"><strong>ALAMAT USAHA</strong></td>
		<td align="center"><strong>LOKASI PEMASANGAN</strong></td>
		<td align="center"><strong>UKURAN</strong></td>
		<td align="center"><strong>JUMLAH</strong></td>
		<td align="center"><strong>T.M.T</strong></td>
		<td align="center"><strong>TGL BAYAR</strong></td>
	</tr>
	
    <?php
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
				
			echo 
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

		
		
		
		echo
				'<tr>
					<td align="center" colspan="7"><strong>JUMLAH ........</strong></td>
					<td width="40" height="12" align="center">'.$unit2.'<strong>&nbsp;</strong></td>
					<td width="55" height="12" align="right"><strong></strong></td>
					<td width="45" height="12" align="right"><strong></strong></td>
				
				</tr>
				
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>';
		?>
	</table>
	
</body>
</html>