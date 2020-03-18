<?php
include "../../pendataan/koneksi.php";
if(isset($_GET['tanggal'])){
	$tanggal = $_GET['tanggal'];
}
else $tanggal = date("Y-m-d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Penerimaan</title>
<link href="../../pendataan/js/themes/base/ui.all.css" rel="stylesheet" type="text/css"></link>
<script src="../../pendataan/js/jquery-1.3.2.js" type="text/javascript"></script>
<script src="../../pendataan/js/ui.core.js" type="text/javascript"></script>
<script src="../../pendataan/js/ui.datepicker.js" type="text/javascript"></script>
<script type="text/javascript">
      $(document).ready(function(){
        $("#tanggal").datepicker({
        dateFormat  : "yy-mm-dd",
          changeMonth : true,
          changeYear  : true
         
        });
      });
     
    </script>
</head>

<body>
<table align="center">
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="get" action="">
      Tanggal
      <input name="tanggal" type="text" id="tanggal" value="<?php echo $tanggal; ?>" />
      <input type="submit" name="button" id="button" value="Tampilkan" />
    </form></td>
  </tr>
  <tr>
    <th colspan="2">DIPENDA KOTA JAMBI<br />
      ( VIA KAS DAERAH)</th>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1">
      <tr>
        <th colspan="6">KODE REKENING</th>
        <th>URAIAN PENERIMAAN</th>
        <th>JUMLAH HARI INI</th>
      </tr>
      <?php
	  $nomor = 0;
	  $query_rekening = mysql_query("SELECT * FROM master_rekening where substr(kd_rek,10,2) = '' ORDER BY kd_rek ASC");
$total_setoran = 0;
	  while($rekening = mysql_fetch_assoc($query_rekening)){
		 $nomor++;
		 $kode_jenis = substr($rekening['kd_rek'],6,2);
		 $nama_rekening = $rekening['nm_rek'];
		 
		 
	  ?>
      <tr>
        <td align="center" valign="top"><?php echo $nomor; ?></td>
        <td align="center">4</td>
        <td align="center">1</td>
        <td align="center">1</td>
        <td align="center"><?php echo $kode_jenis; ?></td>
        <td align="center">&nbsp;</td>
        <td colspan="2"><?php echo $nama_rekening; ?></td>
        </tr>
      <?php
	  $denda = 0;
	  $query_rekening_detail = mysql_query("SELECT kd_rek, nm_rek FROM master_rekening WHERE kd_rek like '4.1.1.".$kode_jenis."%'");
	  while($rekening_detail = mysql_fetch_assoc($query_rekening_detail)){
		  $kode_rekening_detail = substr($rekening_detail['kd_rek'],9,2);
		  if($kode_rekening_detail == ""){
			  $nama_rekening_utama = $rekening_detail['nm_rek'];
			  continue;
		  }
		  $nama_rekening = $rekening_detail['nm_rek'];
		  
		  
		  //ambil data dari skpd
		  $eskiel = "SELECT SUM(skpd.jumlah) AS setoran, SUM(skpd.jumlah - skpd_child.denda) AS ketetapan, SUM(skpd_child.denda) AS denda FROM skpd, skpd_child where skpd.tgl = '$tanggal' AND skpd.ket_skpd LIKE '%kasda%' AND SUBSTR(skpd.npwpd,1,1) = '".(int)$kode_jenis."' AND SUBSTR(skpd.npwpd,9,2) = '$kode_rekening_detail' AND skpd_child.skpd = skpd.no_skpd";
		 $sspd = mysql_fetch_assoc(mysql_query($eskiel));
		 $denda += $sspd['denda'];
		 $total_setoran = $total_setoran + $sspd['SETORAN'];
	  ?>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center">4</td>
        <td align="center">1</td>
        <td align="center">1</td>
        <td align="center"><?php echo $kode_jenis; ?></td>
        <td align="center"><?php echo $kode_rekening_detail; ?></td>
        <td><?php echo $nama_rekening; ?></td>
        <td align="right"><?php echo number_format($sspd['ketetapan']); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center">4</td>
        <td align="center">1</td>
        <td align="center">4</td>
        <td align="center">07</td>
        <td align="center"><?php echo $kode_jenis; ?></td>
        <td>Denda <?php echo $nama_rekening_utama; ?></td>
        <td align="right"><?php echo number_format($denda); ?></td>
      </tr>
     <?php
	  }
	  ?>
      <tr>
        <td colspan="7" align="center" valign="top">JUMLAH</td>
        <td align="right"><?php echo number_format($total_setoran); ?></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td width="65%"><p>Nomor :</p>
    <p>Tunai : Rp. </p></td>
    <td width="35%" align="center">Jambi, <?php echo getTanggalIndo($tanggal); ?><br />
      BENDAHARA PENERIMAAN<br />
      DIPENDA KOTA JAMBI<br />
      <br />
      <br />
      DINA HERMINA, SE<br />
      NIP.19691225 199303 2 006</td>
  </tr>
</table>
</body>
</html>