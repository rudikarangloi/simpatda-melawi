<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=lap_piutang.xls');	
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
<h2 align="center">LAPORAN DAFTAR PIUTANG PAJAK DAERAH</h2>
<p align="center">Periode : <?php echo $tgl1; ?> s/d <?php echo $tgl2; ?></p>


<table border=1>
	<tr>
		<td align="center"><strong>NO.</strong></td>
		<td align="center"><strong>TANGGAL</strong></td>
		<td align="center"><strong>NO. SKPD</strong></td>
		<td align="center"><strong>SUMBER</strong></td>
		<td align="center"><strong>ALAMAT WP</strong></td>
		<td align="center"><strong>ALAMAT OP</strong></td>
		<td align="center"><strong>NPWPD</strong></td>
		<td align="center"><strong>BULAN/TAHUN</strong></td>
		<td align="center"><strong>TMT</strong></td>
		<td align="center"><strong>URAIAN</strong></td>
		<td align="center"><strong>PENETAPAN</strong></td>
		<td align="center"><strong>TANGGAL SETOR</strong></td>
		<td align="center"><strong>JML SETOR</strong></td>
		<td align="center"><strong>PETUGAS</strong></td>
		<td align="center"><strong>PIUTANG PAJAK</strong></td>
		
		
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
		<td align="center"><strong>14</strong></td>
		
		
	</tr>
	
    <?php
		if($pajak==NULL){
			$qq="";
		} else {
			$qq="and c.kode_sptpd='".$pajak."'";
		}
				
		
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

	if($kd_rek=="4.1.1.04"){
		$xxx ="Alamat Pemasangan";
	}else{
		$xxx ="Alamat OP";	
	}
		
		
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and c.kode_sptpd='".$pajak."'";
		}
				
		$query = $this->db->query("SELECT * FROM(SELECT
DATE_FORMAT(c.tgl,'%d/%m/%Y') AS tgl,
c.no_skpd AS nomor,
a.nama_perusahaan,
a.alamat_perusahaan,
c.alamat_pemilik,
c.npwpd,
c.masa_pajak1,
c.tahun,
c.masa_pajak_1,
c.masa_pajak_2,
c.jumlah,
c.kode_sptpd,
b.status
FROM
identitas_perusahaan a INNER JOIN sspd b ON a.npwpd_perusahaan=b.npwpd
INNER JOIN skpd c ON c.no_skpd = b.nomor WHERE c.tgl>='".$awal."' AND c.tgl<='".$akhir."'
$qr GROUP BY c.no_skpd  ORDER BY c.tgl ASC, c.no_skpd ASC 
)a
LEFT JOIN (SELECT author,tgl_bayar,setoran_wp,no_skpd FROM pembayaran)b
ON a.nomor=b.no_skpd");



	/* $query2 = $this->db->query("SELECT
SUM(c.jumlah) AS jl
FROM
identitas_perusahaan a
INNER JOIN skpd c ON a.npwpd_perusahaan = c.npwpd WHERE c.tgl>='".$awal."' and c.tgl<='".$akhir."' $qr")->row(); */

//$terima2 = $query2->jl;
		$i=1;
		$ketetapan=0;
		$denda=0;
		$terima=0;
		$total_setoran=0;
		$total_piutang=0;
		foreach($query->result() as $rs){
			//$rc = $this->db->query("SELECT kd_rek, nm_rek,denda, SUM(DISTINCT jumlah) AS jumlah FROM skpd_child  WHERE skpd = '".$rs->no_skpd."'")->row();
			$kode = $rs->kode_sptpd;
			//$no_rek = $rc->kd_rek;
			//$nm_rek = $rc->nm_rek;
			$stat = $rs->status;
			$bln = $this->msistem->v_bln($rs->masa_pajak1); 
			if($rs->tgl_bayar==Null){
				$rs->tgl_bayar="0000-00-00";
			}else{
				$rs->tgl_bayar=$rs->tgl_bayar;
			}
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
			$c = explode("-",$rs->tgl_bayar);
			$c0 = $c[0];
			$c1 = $c[1];
			$c2 = $c[2];
			$nm_bln	= $this->msistem->v_bln($c1);
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
			
			if($stat==1){
				$tgl_str=$c2.' '.$nm_bln.' '.$c0;
				$piutang=0;
				$petugas=$rs->author;
				$str=$rs->setoran_wp;
			}else{
				$tgl_str='-';
				$piutang=$rs->jumlah-$rs->setoran_wp;
				$petugas='-';
				$str=0;
			}
				
			echo
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px">
					<td align="center">'.$i.'</td>
					<td align="center">'.$rs->tgl.'</td>
					<td align="center">'.$rs->nomor.'</td>
					<td align="left">'.$rs->nama_perusahaan.'&nbsp;</td>
					<td align="left">&nbsp;'.$rs->alamat_pemilik.'&nbsp;</td>
					<td align="left">&nbsp;'.$rs->alamat_perusahaan.'&nbsp;</td>
					<td align="center">&nbsp;'.$rs->npwpd.'&nbsp;</td>
					<td align="center">'.$bln.'&nbsp;'.$rs->tahun.'</td>
					<td align="left">'.$a2.' '.$awal.' '.$a0.' s/d '.$b2.' '.$akhir.' '.$b0.'</td>
					<td align="left">&nbsp;Penetapan Pajak '.$pajak1.'&nbsp;Tahun '.$rs->tahun.'<br/>&nbsp;Sumber : '.$rs->nama_perusahaan.'</td>
					<td align="right">'.number_format($rs->jumlah,2,",",".").'</td>
					<td align="center">&nbsp;'.$tgl_str.'&nbsp;</td>
					<td align="right">'.number_format($str,2,",",".").'</td>
					<td align="center">'.$petugas.'</td>
					<td align="right">'.number_format($piutang,2,",",".").'</td>
					
				</tr>';
			
			//$ketetapan = $ketetapan+$rs->ketetapan;
			//$denda = $denda+$rs->denda;
			$terima = $terima+$rs->jumlah;
			$total_setoran = $total_setoran+$str;
			$total_piutang = $total_piutang+$piutang;
			$i++;
		}
		
		if($pajak==NULL){
			$qr2="";
		} else {
			$qr2="and kode_pajak='".$pajak."'";
		}
		//$qu = $this->db->query("select sum(setoran) as jml2 from sspd where tanggal>='".$awal2."' and tanggal<='".$akhir2."'")-row();
		//$terima2 = $qu->jml2;

		echo
				'<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:11px">
					<td align="center" colspan="10"><strong>TOTAL PENETAPAN</strong></td>
					<td align="right"><strong>'.number_format($terima,2,",",".").'</strong></td>
					<td align="center"><strong>&nbsp;TOTAL PENERIMAAN&nbsp;</strong></td>
					<td align="right"><strong>'.number_format($total_setoran,2,",",".").'</strong></td>
					<td align="right"><strong>&nbsp;&nbsp;</strong></td>
					<td align="right"><strong>'.number_format($total_piutang,2,",",".").'</strong></td>
				
				</tr>';
		?>
	</table>
	
</body>
</html>