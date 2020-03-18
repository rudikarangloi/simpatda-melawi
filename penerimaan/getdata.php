<?php
$db_pendapatan = mysqli_connect("localhost","root","","pendapatan");
$id_penerimaan = intval($_GET['id_penerimaan']);
$hasil = mysqli_fetch_assoc(mysqli_query($db_pendapatan, "select * from penerimaan where id_penerimaan = '$id_penerimaan'"));
echo $hasil['id_bid_pembukuan']."|".$hasil['id_bendahara']."|".$hasil['no_bukti_1']."|".$hasil['no_bukti_2']."|".$hasil['no_sts']."|".$hasil['tanggal'];
?>