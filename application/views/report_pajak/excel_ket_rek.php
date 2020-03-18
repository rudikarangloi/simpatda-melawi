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
<h2 align="center">LAPORAN DAFTAR REALISASI</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>NAMA</strong></td>
		<td align="center"><strong>ALAMAT</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>NO SKPD</strong></td>
		<td align="center"><strong>MEREK</strong></td>
		<td align="center"><strong>TEMA</strong></td>
		<td align="center"><strong>TGL SKP</strong></td>
		<td align="center"><strong>TGL BAYAR</strong></td>
		<td align="center"><strong>MASA PAJAK</strong></td>
		<td align="center"><strong>POKOK</strong></td>
		<td align="center"><strong>DENDA</strong></td>
		<td align="center"><strong>JUMLAH</strong></td>
	</tr>
	
    <?php
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
				
			echo
				'<tr>
					<td  align="center">'.$i.'</td>
					<td  align="center">'.$rs->nama_pemilik.'</td>
					<td  align="center">'.$rs->alamat_perusahaan.'</td>
					<td  align="left">'.$rs->npwpd.'&nbsp;</td>
					<td  align="left">'.$rs->no_skpd.'&nbsp;</td>
					<td  align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td  align="center">'.$rs->tema.'&nbsp;</td>
					<td  align="center">'.$rs->tanggal.'&nbsp;</td>
					<td  align="center">'.$rs->tgl_sspd.'&nbsp;</td>
					<td  align="center">'.$cetak_masa.'</td>
					<td  align="right">Rp.&nbsp;'.number_format($ketetapan,0,",",".").'&nbsp;</td>
					<td  align="right">Rp.&nbsp;'.number_format($rs->denda,0,",",".").'&nbsp;</td>
					<td  align="right">Rp.&nbsp;'.number_format($rs->jumlah,0,",",".").'&nbsp;</td>
					
				</tr>';
			$tot_pok = $tot_pok + $ketetapan;
			$tot_den = $tot_den + $rs->denda;
			$total = $total+$rs->jumlah;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		echo
			'<tr>
				<td align="center" colspan="10"><strong>Jumlah</strong></td>
				<td align="right"><strong>Rp. '.number_format($tot_pok,0,",",".").'&nbsp;</strong></td>
				<td align="right"><strong>Rp. '.number_format($tot_den,0,",",".").'&nbsp;</strong></td>
				<td align="right"><strong>Rp. '.number_format($total,0,",",".").'&nbsp;</strong></td>
			</tr>';
		?>
	</table>
	
</body>
</html>