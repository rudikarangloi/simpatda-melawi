<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../pendataan/js/themes/base/ui.all.css" rel="stylesheet" type="text/css"></link>
<script src="../../pendataan/js/jquery-1.3.2.js" type="text/javascript"></script>
<script src="../../pendataan/js/ui.core.js" type="text/javascript"></script>
<script src="../../pendataan/js/ui.datepicker.js" type="text/javascript"></script>
<script type="text/javascript">
      $(document).ready(function(){
        $("#tanggal").datepicker({
        dateFormat  : "dd-mm-yy",
          changeMonth : true,
          changeYear  : true
         
        });
      });
function ubah_tanggal(){
	tanggal = document.getElementById('tanggal').value;
	array_tanggal = tanggal.split("-");
	tanggal = array_tanggal[0];
	bulan = array_tanggal[1];
	tahun = array_tanggal[2];
	document.getElementById('bulan').value = bulan;
	document.getElementById('tahun').value = tahun;
}
function ubah(id){
	document.getElementById('id_penerimaan').value = id;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			data = this.responseText;
			data_array = data.split("|");
			tanggal = data_array[5];
			tanggal_array = tanggal.split("-");
			no_sts = data_array[4];
			no_bukti_1 = data_array[2];
			no_bukti_2 = data_array[3];
			id_pembukuan = data_array[0];
			id_penerima = data_array[1];
			document.getElementById('tanggal').value = tanggal_array[2]+"-"+tanggal_array[1]+"-"+tanggal_array[0];
			document.getElementById('no_sts').value = no_sts;
			document.getElementById('no_bukti_1').value = no_bukti_1;
			document.getElementById('no_bukti_2').value = no_bukti_2;
			document.getElementById('id_mengetahui').value = id_pembukuan;
			document.getElementById('id_penerima').value = id_penerima;
		}
	};
	xmlhttp.open("GET","getdata.php?id_penerimaan="+id,true);
	xmlhttp.send();		
}
function cetak(id){
	window.location.href = "cetak.php?id_penerimaan="+id;
}
</script>
</head>

<body>
<?php
//koneksi database
$db_pendataan = mysqli_connect("localhost","root","","pendapatan");
$db_sopd = mysqli_connect("localhost","root","","sopd_jambi");



//get nomor sts baru
$nomor_sts_lama = mysqli_fetch_assoc(mysqli_query($db_pendataan, "select max(no_sts) as no_sts from penerimaan where date_format(tanggal, '%Y-%m') = date_format(CURDATE(),'%Y-%m')"));
$nomor_sts_baru = $nomor_sts_lama['no_sts'] + 1;

//simpan
if(isset($_GET['button'])){
	//data baru
	$id_penerimaan = $_GET['id_penerimaan'];
	$tanggal = $_GET['tanggal'];
	$no_sts = $_GET['no_sts'];
	$no_bukti_1 = $_GET['no_bukti_1'];
	$no_bukti_2 = $_GET['no_bukti_2'];
	$id_bid_pembukuan = $_GET['id_mengetahui'];
	$id_bendahara = $_GET['id_penerima'];
	$array_tanggal = explode("-", $tanggal);
	$tanggal_db = $array_tanggal[2]."-".$array_tanggal[1]."-".$array_tanggal[0];
	if($id_penerimaan == ""){
		//cek data lama
		
		$sts_lama = mysqli_fetch_assoc(mysqli_query($db_pendataan, "select * from penerimaan where tanggal = '$tanggal_db'"));
		if(!$sts_lama){
			mysqli_query($db_pendataan, "insert into penerimaan (no_bukti_1, no_bukti_2, no_sts, tanggal, id_bendahara, id_bid_pembukuan) values ('$no_bukti_1', '$no_bukti_2', '$no_sts', '$tanggal_db', '$id_bendahara', '$id_bid_pembukuan')");
		}
	}else{
		mysqli_query($db_pendataan, "update penerimaan set no_bukti_1 = '$no_bukti_1', no_bukti_2 = '$no_bukti_2', no_sts = '$no_sts', tanggal = '$tanggal_db', id_bendahara = '$id_bendahara', id_bid_pembukuan = '$id_bid_pembukuan' where id_penerimaan = '$id_penerimaan'");
	}
}
?>
<form id="form1" name="form1" method="get" action="" >
  <table align="center">
    <tr>
      <td colspan="2" align="center"><h3>Formulir Surat Tanda Setoran (STS)</h3></td>
    </tr>
    <tr>
      <td>Tanggal
      <input type="hidden" name="id_penerimaan" id="id_penerimaan" /></td>
      <td><input name="tanggal" type="text" id="tanggal" onchange="ubah_tanggal();" value="<?php echo date("d-m-Y"); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Nomor STS</td>
      <td><input name="no_sts" type="text" id="no_sts" value="<?php echo $nomor_sts_baru; ?>" size="2" />/BPPRD/
        <input name="bulan" type="text" id="bulan" value="<?php echo date("m"); ?>" size="2" readonly="readonly" />
      /
      <input name="tahun" type="text" id="tahun" value="<?php echo date("Y"); ?>" size="3" readonly="readonly" /></td>
    </tr>
    <tr>
      <td>Nomor Bukti Penerimaan</td>
      <td><input name="no_bukti_1" type="text" id="no_bukti_1" size="3" />
        s/d
        <input name="no_bukti_2" type="text" id="no_bukti_2" size="3" /></td>
    </tr>
    <tr>
      <td>Mengetahui</td>
      <td><select name="id_mengetahui" id="id_mengetahui">
        <?php
		$query_pejabat = mysqli_query($db_pendataan, "select id_pejabat, nama from pejabat where id_bidang = '1' order by nama");
		while($pejabat = mysqli_fetch_assoc($query_pejabat)){
		?>
        <option value="<?php echo $pejabat['id_pejabat']; ?>"><?php echo $pejabat['nama']; ?></option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>Bendahara Penerima</td>
      <td><select name="id_penerima" id="id_penerima">
        <?php
		$query_pejabat = mysqli_query($db_pendataan, "select id_pejabat, nama from pejabat where id_bidang = '2'");
		while($pejabat = mysqli_fetch_assoc($query_pejabat)){
		?>
        <option value="<?php echo $pejabat['id_pejabat']; ?>"><?php echo $pejabat['nama']; ?></option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Simpan" />
      <input type="reset" name="button2" id="button2" value="Reset" /></td>
    </tr>
  </table>
  <br />
  <table border="1" align="center">
    <tr>
      <td colspan="6" align="center"><h4>DAFTAR SURAT TANDA SETORAN (STS)</h4></td>
    </tr>
    <tr>
      <th>No. STS</th>
      <th>Tanggal</th>
      <th>Nomor Bukti Penerimaan</th>
      <th>Mengetahui</th>
      <th>Bendahara</th>
      <td>&nbsp;</td>
    </tr>
    <?php
	$query_daftar_sts = mysqli_query($db_pendataan, "select * from penerimaan order by tanggal desc, no_sts desc");
	while($daftar_sts = mysqli_fetch_assoc($query_daftar_sts)){
		$id_penerimaan = $daftar_sts['id_penerimaan'];
		$no_sts = $daftar_sts['no_sts'];
		$tanggal = date("d-m-Y",strtotime($daftar_sts['tanggal']));
		$nomor_bukti = $daftar_sts['no_bukti_1']." s/d ".$daftar_sts['no_bukti_2'];
		$mengetahui = mysqli_fetch_assoc(mysqli_query($db_pendataan, "select nama from pejabat where id_pejabat = '".$daftar_sts['id_bid_pembukuan']."'"));
		$mengetahui = $mengetahui['nama'];
		$bendahara = mysqli_fetch_assoc(mysqli_query($db_pendataan, "select nama from pejabat where id_pejabat = '".$daftar_sts['id_bendahara']."'"));
		$bendahara = $bendahara['nama'];
	?>
    <tr>
      <td align="center"><?php echo $no_sts; ?></td>
      <td align="center"><?php echo $tanggal; ?></td>
      <td align="center"><?php echo $nomor_bukti; ?></td>
      <td><?php echo $mengetahui; ?></td>
      <td><?php echo $bendahara; ?></td>
      <td><input type="button" name="button3" id="button3" value="Ubah" onclick="ubah(<?php echo $id_penerimaan; ?>);" />
      <input type="button" name="button4" id="button4" value="Cetak" onclick="cetak(<?php echo $id_penerimaan; ?>);" /></td>
    </tr>
    <?php
	}
	

	?>
  </table>
</form>
</body>
</html>