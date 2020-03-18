<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=rekon_bank.xls');	
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
$d = explode('|',$data);
$bayar = $d[0];
$periode = $d[1];
$akhir = $d[2];
		
$t = explode('-',$periode);
$bln = $t[1];
$thn = $t[0];
$bulan = $this->msistem->v_bln($bln);
?>
<h2 align="center">LAPORAN REKONSILIASI PAJAK DAERAH <br />BULAN <?php echo strtoupper($bulan); ?> TAHUN <?php echo $thn; ?></h2>

<table border="1">
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>TANGGAL PEMBAYARAN</strong></td>
		<td align="center"><strong>TYPE PEMBAYARAN</strong></td>
		<td align="center"><strong>SETORAN</strong></td>
		<td align="center"><strong>SELISIH</strong></td>
		<td align="center"><strong>AKUMULASI</strong></td>
	</tr>
    <?php
		$akumulasi = 0;
		$a = 0;
		$b = 0;
		for($tgl=1;$tgl<=$akhir;$tgl++){
			if(strlen($tgl)=='1') { 
				$tgl1 = '0'.$tgl.'/'.$bln.'/'.$thn;
			} else {
				$tgl1 = $tgl.'/'.$bln.'/'.$thn;
			}
			
			$time = $periode.'-'.$tgl;
			$sql = $this->db->query("SELECT DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal, sspd.pembayaran, sum(sspd.setoran) as setoran FROM sspd where sspd.tanggal = '".$time."' and sspd.pembayaran = '".$bayar."' order by sspd.tanggal asc")->row();
			
			if($sql->setoran==NULL){
				$sql->setoran = 0;
			}
			
			if($bayar=='1'){
				$bay = 'LOKET';
			} else if($bayar=='200'){
				$bay = 'BANK NAGARI';
			} else if($bayar=='300'){
				$bay = 'BANK BTN';
			} else if($bayar=='0009'){
				$bay = 'BANK BNI';
			}
			
			$selisih = $sql->setoran;
			$akumulasi = $akumulasi + $sql->setoran;
			
			echo '<tr>
					<td align="center">'.$tgl.'</td>
					<td align="center">'.$tgl1.'</td>
					<td align="center">'.$bay.'</td>
					<td align="right">'.number_format($sql->setoran,2,",",".").'&nbsp;</td>
					<td align="right">'.number_format($selisih,2,",",".").'&nbsp;</td>
					<td align="right">'.number_format($akumulasi,2,",",".").'&nbsp;</td>
				</tr>';
				$a = $a + $sql->setoran;
				$b = $b + $selisih;
		}
	?>
    <tr>
		<td colspan="2" align="center"><strong>TOTAL</strong></td>
		<td align="right"><strong><?php echo number_format($a,2,",","."); ?>&nbsp;</strong></td>
		<td align="right"><strong><?php echo number_format($b,2,",","."); ?>&nbsp;</strong></td>
		<td align="right"></td>
	</tr>
</table>

</body>
</html>