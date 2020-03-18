<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=blm_sptpd.xls');	
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
$dt = explode('_',$data);
$bln = $dt[0];
$thn = $dt[1];
$pajak = $dt[2];
		
if($pajak==NULL){
	$qr = "";
} else {
	$qr = "and a.jenis_usaha='".$pajak."'";
}

$bulan = $this->msistem->v_bln($bln);
?>
<h2 align="center">Laporan Data Belum Pendataan SPTPD</h2>
<p align="center">Bulan <?php echo $bulan; ?> Tahun <?php echo $thn; ?></p>

<table border="1">
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>NAMA WAJIB PAJAK</strong></td>
		<td align="center"><strong>ALAMAT</strong></td>
		<td align="center"><strong>KECAMATAN</strong></td>
		<td align="center"><strong>KELURAHAN</strong></td>
		<td align="center"><strong>JENIS PAJAK</strong></td>
	</tr>
    <?php
		$query = $this->db->query("select a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kecamatan, b.nama_kelurahan, c.nama_sptpd from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan and a.kecamatan=b.kode_kecamatan left join master_sptpd c on a.jenis_usaha=c.id where a.npwpd_perusahaan NOT IN (SELECT npwpd FROM sptpd where masa_pajak1 = '".$bln."' and tahun = '".$thn."') $qr");
		
		$i=1;
		foreach($query->result() as $rs) {
				
			echo
				'<tr>
					<td align="center">'.$i.'</td>
					<td align="center">'.$rs->npwpd_perusahaan.'</td>
					<td align="left">&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td align="left">&nbsp;'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td align="left">&nbsp;'.$rs->nama_kecamatan.'&nbsp;</td>
					<td align="left">&nbsp;'.$rs->nama_kelurahan.'&nbsp;</td>
					<td align="center">'.$rs->nama_sptpd.'</td>
				</tr>';
			$i++;
		}
		?>
	</table>

</body>
</html>