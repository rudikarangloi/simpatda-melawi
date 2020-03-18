<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=data_potensi_hotel.xls');	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>

<style type="text/css">
/*    .tabel td{        
        border: 1px #000 solid;
        font-family:Arial, Helvetica, sans-serif; font-size:11px;
    }    */
body table tr {
	font-weight: bold;
}
.style_border{
            border: 1px solid #000;            
            border-collapse: collapse;
        }
</style>
</head>

<body>
<p align="center"><strong>DAFTAR POTENSI WAJIB PAJAK</strong></p>
<p align="center"><strong>HOTEL</strong></p>
<table width="1255" border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <td bgcolor="#99CCFF"><div align="center">NO</div></td>
    <td bgcolor="#99CCFF"><div align="center">WAJIB PAJAK</div></td>
    <td bgcolor="#99CCFF"><div align="center">NPWPD</div></td>
    <td bgcolor="#99CCFF"><div align="center">ALAMAT</div></td>
    <td bgcolor="#99CCFF"><div align="center">JENIS KAMAR</div></td>
    <td bgcolor="#99CCFF"><div align="center">JUMLAH KAMAR</div></td>
    <td bgcolor="#99CCFF"><div align="center">TARIF</div></td>
    <td bgcolor="#99CCFF"><div align="center">POTENSI</div></td>
    <td bgcolor="#99CCFF"><div align="center">ASUMSI PAJAK
        <br />
    PER BULAN</div></td>
    <td bgcolor="#99CCFF"><div align="center">ASUMSI PAJAK
        <br />
    PER TAHUN</div></td>
  </tr>
  

 
  
  <?php 
  $wr = "";
  $no = 1; 
  $T1 = 0; $T2 = 0; $T3 = 0; $T4 = 0; $T5 = 0;
  if($kel!="null" || $kec!="null"){
  	$wr .= "and kelurahan='".$kel."'";
  }
  	$query = $this->db->query("SELECT a.*,b.nama_perusahaan,b.alamat_perusahaan,d.kode_kecamatan,d.nama_kecamatan,d.kode_kelurahan,d.nama_kelurahan
	FROM mp_hotel_detail a 
	LEFT JOIN identitas_perusahaan b ON a.npwpd=b.npwpd_perusahaan 
LEFT JOIN (SELECT z.kode_kelurahan,z.nama_kelurahan,z.kode_kecamatan,x.nama_kecamatan FROM kelurahan z LEFT JOIN kecamatan x ON z.kode_kecamatan=x.kode_kecamatan) d ON b.kelurahan=d.kode_kelurahan AND b.kecamatan=d.kode_kecamatan		
	WHERE a.npwpd IS NOT NULL $wr group by d.kode_kelurahan");
	foreach($query->result() as $d){
		
  ?>
   <tr>
    <td colspan="10" align="left" style="background-color:#FFFFCC;"><?php echo $d->nama_kecamatan ?> - <?php echo $d->nama_kelurahan ?></td>
  </tr>
  
    <?php 
  $J1 = 0; $J2 = 0; $J3 = 0; $J4 = 0; $J5 = 0;  
  	$query = $this->db->query("SELECT a.*,b.nama_perusahaan,b.alamat_perusahaan,d.kode_kecamatan,d.nama_kecamatan,d.kode_kelurahan,d.nama_kelurahan
	FROM mp_hotel_detail a 
	LEFT JOIN identitas_perusahaan b ON a.npwpd=b.npwpd_perusahaan 
LEFT JOIN (SELECT z.kode_kelurahan,z.nama_kelurahan,z.kode_kecamatan,x.nama_kecamatan FROM kelurahan z LEFT JOIN kecamatan x ON z.kode_kecamatan=x.kode_kecamatan) d ON b.kelurahan=d.kode_kelurahan AND b.kecamatan=d.kode_kecamatan		
	WHERE a.npwpd IS NOT NULL AND d.kode_kelurahan='".$d->kode_kelurahan."' AND d.kode_kecamatan='".$d->kode_kecamatan."'");
	foreach($query->result() as $r){
		if($no%2==0) {
		  		$bg = "#CCC";
	 		 } else {
		  		$bg = "#FFF";  
	  		}
  ?>
  <tr>
    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $no ?></td>
    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $r->nama_perusahaan ?></td>
    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $r->npwpd ?></td>
    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $r->alamat_perusahaan ?></td>
    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $r->jenis_kamar ?></td>
    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $r->jumlah_kamar ?></td>
    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($r->tarif) ?></td>
    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($r->potensi) ?></td>
    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($r->asumsi_pajak_bulan) ?></td>
    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $this->msistem->format_angka($r->asumsi_pajak_tahun) ?></td>
  </tr>
  <?php $no++; 
  		$J1 = $J1 + $r->jumlah_kamar; 
		$J2 = $J2 + $r->tarif;
		$J3 = $J3 + $r->potensi; 
		$J4 = $J4 + $r->asumsi_pajak_bulan; 
		$J5 = $J5 + $r->asumsi_pajak_tahun;
  } ?>
  <tr>
    <td bgcolor="#FF99FF">&nbsp;</td>
    <td bgcolor="#FF99FF">&nbsp;</td>
    <td bgcolor="#FF99FF">&nbsp;</td>
    <td bgcolor="#FF99FF">&nbsp;</td>
    <td bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>
    <td bgcolor="#FF99FF" align="center"><?php echo $this->msistem->format_angka($J1) ?></td>
    <td bgcolor="#FF99FF" align="right"><?php echo $this->msistem->format_angka($J2) ?></td>
    <td bgcolor="#FF99FF" align="right"><?php echo $this->msistem->format_angka($J3) ?></td>
    <td bgcolor="#FF99FF" align="right"><?php echo $this->msistem->format_angka($J4) ?></td>
    <td bgcolor="#FF99FF" align="right"><?php echo $this->msistem->format_angka($J5) ?></td>
  </tr>
  
  <?php 
  		$T1 = $T1 + $J1; 
		$T2 = $T2 + $J2;
		$T3 = $T3 + $J3; 
		$T4 = $T4 + $J4; 
		$T5 = $T5 + $J5;
  } ?>
  <tr>
    <td bgcolor="#99CCFF">&nbsp;</td>
    <td bgcolor="#99CCFF">&nbsp;</td>
    <td bgcolor="#99CCFF">&nbsp;</td>
    <td bgcolor="#99CCFF">&nbsp;</td>
    <td bgcolor="#99CCFF"><div align="center">TOTAL</div></td>
    <td bgcolor="#99CCFF" align="center"><?php echo $this->msistem->format_angka($T1) ?></td>
    <td bgcolor="#99CCFF" align="right"><?php echo $this->msistem->format_angka($T2) ?></td>
    <td bgcolor="#99CCFF" align="right"><?php echo $this->msistem->format_angka($T3) ?></td>
    <td bgcolor="#99CCFF" align="right"><?php echo $this->msistem->format_angka($T4) ?></td>
    <td bgcolor="#99CCFF" align="right"><?php echo $this->msistem->format_angka($T5) ?></td>
  </tr>  
</table>
</body>
