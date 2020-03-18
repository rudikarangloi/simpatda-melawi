<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=sptpd_blm_bayar.xls');	
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
<h2 align="center">Laporan SPTPD Belum Bayar (Self Assesment)</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>
<p align="center">Jenis Pajak : <?php echo $nm_pajak; ?></p>

<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>TANGGAL</strong></td>
		<td align="center"><strong>NO. SPTPD</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>WAJIB PAJAK</strong></td>
		<td align="center"><strong>ALAMAT</strong></td>
		<td align="center"><strong>MASA PAJAK</strong></td>
		<td align="center"><strong>KETETAPAN</strong></td>
		<td align="center"><strong>KETERANGAN</strong></td>
	</tr>
    <?php
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sptpd.no_sptpd like '%".$pajak."%'";
		}
		
		$sql = $this->db->query("SELECT DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl, sptpd.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.npwpd_perusahaan, sptpd.jumlah, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd where sptpd.status = '0' and sptpd.tanggal >= '".$awal."' and sptpd.tanggal <= '".$akhir."' $qr");
		$no = 1;
		$tsetor = 0;
		foreach($sql->result() as $rs){
			$awal = $this->msistem->v_bln($rs->masa_pajak1);
			$akhir = $this->msistem->v_bln($rs->masa_pajak2);
			$ket = 'TUNGGAKAN';
			
			echo
				'<tr>
					<td align="center">'.$no.'</td>
					<td align="center">'.$rs->tgl.'</td>
					<td align="center">'.$rs->no_sptpd.'</td>
					<td align="center">'.$rs->npwpd_perusahaan.'</td>
					<td align="left">&nbsp;'.$rs->nama_perusahaan.'</td>
					<td align="left">&nbsp;'.$rs->alamat_perusahaan.'</td>
					<td align="center">'.$awal.'-'.$akhir.' '.$rs->tahun.'</td>
					<td align="right">Rp. '.number_format($rs->jumlah,2,",",".").'&nbsp;</td>
					<td align="center">'.$ket.'</td>
				</tr>';
				$tsetor = $tsetor + $rs->jumlah;
			$no++;
		}
	?>	
		<tr>
			<td align="center" colspan="7"><strong>Jumlah</strong></td>
			<td align="right"><strong>Rp. <?php echo number_format($tsetor,2,",","."); ?>&nbsp;</strong></td>
			<td align="right"><strong></strong></td>
		</tr>
	</table>

</body>
</html>