<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_penerimaan_pbb_bphtb.xls');	
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
<h2 align="center">LAPORAN DAFTAR PEENERIMAAN PBB dan BPHTB</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>KODE REKENING</strong></td>
		<td align="center"><strong>NAMA REKENING</strong></td>
		<td align="center"><strong>NO INPUTAN</strong></td>
		<td align="center"><strong>URAIAN</strong></td>
		<td align="center"><strong>TANGGAL INPUT</strong></td>		
		<td align="center"><strong>PENERIMAAN</strong></td>		
		
	</tr>
	<tr>
		<td align="center"><strong>1</strong></td>
		<td align="center"><strong>2</strong></td>
		<td align="center"><strong>3</strong></td>
		<td align="center"><strong>4</strong></td>
		<td align="center"><strong>5</strong></td>
		<td align="center"><strong>6</strong></td>
		<td align="center"><strong>7</strong></td>
	
	</tr>
	
    <?php
		/* if($pajak==NULL){
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
		} */
				
		$rc = $this->db->query("SELECT a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') AS tgl_diterima,a.jml_dibayar,a.uraian,b.kd_rek,b.nm_rek
								FROM dt_pbb_bphtb a LEFT JOIN dt_detail_pbb_bphtb b ON a.no_sptpd=b.no_sptpd
								WHERE a.tgl_diterima>='".$awal."' AND a.tgl_diterima<='".$akhir."' ORDER BY a.tgl_diterima ASC");
		
		$i=1;
		$tot_pok=0;
		$tot_den=0;
		$total=0;
		$keluar=0;
		foreach($rc->result() as $rs){
			/* $jumlah = $rs->jumlah;
			$denda = $rs->denda;
			$ketetapan = $jumlah - $denda;
			
			if($rs->status =='1'){
				$rs->status = 'Sudah Bayar';
			} else{	
				$rs->status = 'Belum Bayar';
				  } */
				
			echo
				'<tr>
					<td align="center" valign="top">'.$i.'</td>
					<td align="center" valign="top">'.$rs->kd_rek.'</td>
					<td align="left">'.$rs->nm_rek.'</td>
					<td align="left" valign="top">'.$rs->no_sptpd.'</td>
					<td align="left" valign="top">'.$rs->uraian.'</td>
					<td align="center" valign="top">'.$rs->tgl_diterima.'</td>
					<td align="right" valign="top">'.number_format($rs->jml_dibayar,2,",",".").'&nbsp;</td>
					
					
					
				</tr>';
			$total = $total+$rs->jml_dibayar;
			//$keluar = $keluar+$null;
			$i++;
		}
		
		
		echo
			'<tr>
				<td align="center" colspan="6"><strong>Jumlah</strong></td>
				<td align="right"><strong>'.number_format($total,2,",",".").'</strong></td>
			</tr>';
		?>
	</table>
	
</body>
</html>