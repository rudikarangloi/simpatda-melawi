<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_penetapan.xls');	
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
<h2 align="center">LAPORAN TRANSAKSI PENETAPAN</h2>
<!--<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>-->


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>TANGGAL</strong></td>
		<td align="center"><strong>NO. SKPD</strong></td>
		<td align="center"><strong>SUMBER</strong></td>
		<td align="center"><strong>BULAN/TAHUN</strong></td>
		<td align="center"><strong>TMT</strong></td>
		<td align="center"><strong>URAIAN</strong></td>
		<td align="center"><strong>JUMLAH</strong></td>
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
	</tr>
	
    <?php
		if($pajak==NULL){
			$qq="";
		} else {
			$qq="and c.kode_sptpd='".$pajak."'";
		}
				
		$query1 = $this->db->query("SELECT
DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
c.no_skpd,
a.nama_perusahaan,
c.masa_pajak1,
c.tahun,
c.masa_pajak_1,
c.masa_pajak_2,
c.jumlah,
b.nm_rek,
b.kd_rek
FROM
identitas_perusahaan a
INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan INNER JOIN skpd_child b ON c.no_skpd=b.skpd WHERE  c.tgl>='".$awal."' AND c.tgl<='".$akhir."' $qq GROUP BY c.no_skpd ORDER BY c.no_skpd ASC")->row();
	
			if($pajak=="HTL"){
				$kd_rek = "4.1.1.01";
				$nm_rek = "Pajak Hotel";
			}else if($pajak=="RES"){
				$kd_rek = "4.1.1.02";
				$nm_rek = "Pajak Restoran";
			}else if($pajak=="HIB"){
				$kd_rek = "4.1.1.03";
				$nm_rek = "Pajak Hiburan";
			}else if($pajak=="REK"){
				$kd_rek = "4.1.1.04";
				$nm_rek = "Pajak Reklame";
			}else if($pajak=="LIS"){
				$kd_rek = "4.1.1.05";
				$nm_rek = "Pajak Penerangan Jalan";
			}else if($pajak=="PKR"){
				$kd_rek = "4.1.1.07";
				$nm_rek = "Pajak Parkir";
			}else if($pajak=="AIR"){
				$kd_rek = "4.1.1.08";
				$nm_rek = "Pajak Air Tanah";
			}else if($pajak=="09"){
				$kd_rek = "4.1.1.09";
				$nm_rek = "Pajak Burung Walet";
			}else if($pajak=="GAL"){
				$kd_rek = "4.1.1.11";
				$nm_rek = "Pajak Mineral Bukan Logam Dan Batuan";
			}else{
				$kd_rek = " ";
				$nm_rek = " ";
			}

	
		$report = '';
		$report .=
			'<table borde="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
								<td width="50" height="5" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>PEMERINTAH KABUPATEN MELAWI</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="25" align="center" valign="middle">&nbsp;</td>
								<td width="130" align="center"></td>
								<td width="210" align="center">
									<b>DAFTAR TRANSAKSI PENETAPAN</b>
								</td>
					
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">SKPD</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;1.20.05 : BADAN PENDAPATAN DAERAH</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="150" height="15" align="left" valign="middle">Jenis Pajak / Retribusi</td>
								<td width="22" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$kd_rek.' : '.$nm_rek.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="15" align="left" valign="middle">Dari Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl1.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="70" height="25" align="left" valign="middle">S/D Tanggal</td>
								<td width="102" align="center"></td>
								<td width="5" align="center">:</td>
								<td width="210" align="left">&nbsp;'.$tgl2.'</td>
							</tr>
			</table>';
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and c.kode_sptpd='".$pajak."'";
		}
				
		$query = $this->db->query("SELECT
DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
c.no_skpd,
a.nama_perusahaan,
c.masa_pajak1,
c.tahun,
c.masa_pajak_1,
c.masa_pajak_2,
c.jumlah,
c.kode_sptpd
FROM
identitas_perusahaan a
INNER JOIN skpd c ON c.npwpd = a.npwpd_perusahaan WHERE  c.tgl>='".$awal."' AND c.tgl<='".$akhir."' $qr GROUP BY c.no_skpd ORDER BY c.no_skpd ASC");



	$query2 = $this->db->query("SELECT
SUM(c.jumlah) AS jl
FROM
identitas_perusahaan a
INNER JOIN skpd c ON a.npwpd_perusahaan = c.npwpd WHERE c.tgl>='".$awal."' and c.tgl<='".$akhir."' $qr")->row();

$terima2 = $query2->jl;
		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		$keluar=0;
		foreach($query->result() as $rs){
			$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  WHERE skpd = '".$rs->no_skpd."'")->row();
			$kode = $rs->kode_sptpd;
			$no_rek = $rc->kd_rek;
			$nm_rek = $rc->nm_rek;
			$bln = $this->msistem->v_bln($rs->masa_pajak1); 
			$a = explode("-",$rs->masa_pajak_1);
			$a0 = $a[0];
			$a1 = $a[1];
			$a2 = $a[2];
			$awal	= $this->msistem->c_bln($a1);
			$b = explode("-",$rs->masa_pajak_2);
			$b0 = $b[0];
			$b1 = $b[1];
			$b2 = $b[2];
			$akhir 	= $this->msistem->c_bln($b1);
			if($kode=="HTL"){
				$pajak1 = "Hotel";
			}else if($kode=="RES"){
				$pajak1 = "Restoran";
			}else if($kode=="HIB"){
				$pajak1 = "Hiburan";
			}else if($kode=="REK"){
				$pajak1 = "Reklame";
			}else if($kode=="LIS"){
				$pajak1 = "PPJ";
			}else if($kode=="PKR"){
				$pajak1 = "Parkir";
			}else if($kode=="AIR"){
				$pajak1 = "Air Tanah";
			}else if($kode=="09"){
				$pajak1 = "WALET";
			}else if($kode=="GAL"){
				$pajak1 = "Mineral Bukan Logam Dan Batuan";
			}else{
				$pajak1 = "KESELURUHAN";
			}
			
			if($no_rek == '4.1.1.04.01'){
				$nm_rek = 'Reklame Papan / Billboard / Videotron / Megatron';
			}
			
			if($no_rek == '4.1.1.03.16'){
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
			if($no_rek == '4.1.1.03.16.'){
				$no_rek = '4.1.1.03.16';
				$nm_rek = 'Panti Pijat dan Refleksi';
			}
			
				
			echo
				'<tr>
					<td align="center">'.$i.'</td>
					<td align="center">'.$rs->tgl.'</td>
					<td align="center">'.$rs->no_skpd.'</td>
					<td align="left">&nbsp;'.$rs->nama_perusahaan.'&nbsp;</td>
					<td align="center">'.$bln.'&nbsp;'.$rs->tahun.'</td>
					<td align="left">'.$a2.' '.$awal.' '.$a0.' s/d '.$b2.' '.$akhir.' '.$b0.'</td>
					<td align="left">&nbsp;Penetapan Pajak '.$pajak1.'&nbsp;Tahun '.$rs->tahun.'<br/>&nbsp;Sumber : '.$rs->nama_perusahaan.'</td>
					<td align="right">&nbsp;'.number_format($rs->jumlah,0,",",".").'</td>
					
				</tr>';
			$terima = $terima+$rs->jumlah;
			$i++;
		}
		
		echo
			'<tr>
				<td align="center" colspan="7"><strong>Jumlah</strong></td>
				<td align="right"><strong>'.number_format($terima,0,",",".").'</strong></td>
			</tr>';
		?>
	</table>
	
</body>
</html>