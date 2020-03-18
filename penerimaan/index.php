<?php
$koneksi = mysqli_connect("localhost","root","","sopd_jambi");
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
function form_cetak(){
	tanggal = document.getElementById('tanggal').value;
	window.location.href = "/sopd_jambi/penerimaan/form_cetak.php";
}
</script>
</head>

<body>
<table align="center">
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="get" action="">
      Tanggal
      <input name="tanggal" type="text" id="tanggal" value="<?php echo $tanggal; ?>" />
      <input type="submit" name="button" id="button" value="Tampilkan" />
      <input type="button" name="button2" id="button2" value="Daftar STS" onclick="form_cetak();" />
    </form></td>
  </tr>
  <tr>
    <th colspan="2">DIPENDA KOTA JAMBI<br />
      ( VIA BENDAHARA PENERIMAAN)</th>
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
	  $query_rekening = mysqli_query($koneksi, "SELECT * FROM master_rekening where substr(kd_rek,10,2) = '' ORDER BY kd_rek ASC");
$total_setoran = 0;
	  while($rekening = mysqli_fetch_assoc($query_rekening)){
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
	  $query_rekening_detail = mysqli_query($koneksi, "SELECT kd_rek, nm_rek FROM master_rekening WHERE kd_rek like '4.1.1.".$kode_jenis."%'");
	  while($rekening_detail = mysqli_fetch_assoc($query_rekening_detail)){
		  $kode_rekening_detail = substr($rekening_detail['kd_rek'],9,2);
		  if($kode_rekening_detail == ""){
			  $nama_rekening_utama = $rekening_detail['nm_rek'];
			  continue;
		  }
		  $nama_rekening = $rekening_detail['nm_rek'];
		  
		  
		  //ambil data dari sspd
		 $sspd = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(denda) AS denda, SUM(ketetapan) AS ketetapan FROM sspd WHERE kode_bank = '2' AND tanggal = '$tanggal' AND SUBSTR(npwpd,1,1) = '".(int)$kode_jenis."' AND SUBSTR(npwpd,9,2) = '$kode_rekening_detail'"));
		 $denda += $sspd['denda'];
		 $total_setoran = $total_setoran + $sspd['ketetapan'] + $sspd['denda'];
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
<?php
function terbilang($x){
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
  elseif ($x < 1000000000000)
    return Terbilang($x / 1000000000) . " milyar" . Terbilang($x % 1000000000);
}
function getTanggalIndo($tanggal){
	$arrayTanggal = explode("-",$tanggal);
	$bulan = "";
	$bulan = getNamaBulan($arrayTanggal[1]);
	return $arrayTanggal[2]." ".$bulan." ".$arrayTanggal[0];
}
function getNamaBulan($bulan){
	switch($bulan){
		case 1:
		$bulan = "Januari";
		break;
		case 2:
		$bulan = "Februari";
		break;
		case 3:
		$bulan = "Maret";
		break;
		case 4:
		$bulan = "April";
		break;
		case 5:
		$bulan = "Mei";
		break;
		case 6:
		$bulan = "Juni";
		break;
		case 7:
		$bulan = "Juli";
		break;
		case 8:
		$bulan = "Agustus";
		break;
		case 9:
		$bulan = "September";
		break;
		case 10:
		$bulan = "Oktober";
		break;
		case 11:
		$bulan = "Nopember";
		break;
		case 12:
		$bulan = "Desember";
		break;
	}
	return $bulan;
}
?>
