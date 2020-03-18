<?php
$koneksi = mysqli_connect("localhost","root","","sopd_jambi");
$db_pendapatan = mysqli_connect("localhost","root","","pendapatan");
include "../../pendataan/tcpdf/tcpdf.php";
$id_penerimaan = $_GET['id_penerimaan'];
$data_sts = mysqli_fetch_assoc(mysqli_query($db_pendapatan, "select * from penerimaan where id_penerimaan = '$id_penerimaan'"));
$id_mengetahui = $data_sts['id_bid_pembukuan'];
$id_bendahara = $data_sts['id_bendahara'];
$no_bukti_1 = $data_sts['no_bukti_1'];
$no_bukti_2 = $data_sts['no_bukti_2'];
$no_sts = sprintf("%02d",$data_sts['no_sts']);
$tanggal = $data_sts['tanggal'];
$array_tanggal = explode("-",$tanggal);
$bulan = $array_tanggal[1];
$tahun = $array_tanggal[0];

//pejabat
$mengetahui = mysqli_fetch_assoc(mysqli_query($db_pendapatan, "select nama, nip, jabatan from pejabat where id_pejabat = '$id_mengetahui'"));
$bendahara = mysqli_fetch_assoc(mysqli_query($db_pendapatan, "select nama, nip, jabatan from pejabat where id_pejabat = '$id_bendahara'"));
$jabatan_mengetahui = $mengetahui['jabatan'];
$jabatan_bendahara = $bendahara['jabatan'];
$nama_mengetahui = $mengetahui['nama'];
$nama_bendahara = $bendahara['nama'];
$nip_mengetahui = $mengetahui['nip'];
$nip_bendahara = $bendahara['nip'];

$total_setoran = mysqli_fetch_assoc(mysqli_query($koneksi, "select sum(setoran) as setoran from sspd where tanggal = '$tanggal' and keterangan not like '%kasda%'"));
$total_setoran = $total_setoran['setoran'];

//rekening retribusi				
//4.1.2.01.02
$ketetapan_kebersihan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(sspd_detail.jumlah) AS ketetapan FROM sspd, sspd_detail WHERE sspd.tanggal = '$tanggal' AND sspd.npwpd LIKE '4.%' AND SUBSTR(sspd.npwpd,9,2) = '01' AND sspd.no_sspd = sspd_detail.no_sspd AND sspd_detail.kode_rekening = '4.1.2.01.02'"));
$ketetapan_kebersihan = $ketetapan_kebersihan['ketetapan'];
//Denda Ret. Jasa Umum
//4.1.4.08.01
$denda_situ = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(sspd_detail.jumlah) AS denda FROM sspd, sspd_detail WHERE sspd.tanggal = '$tanggal' AND sspd.npwpd LIKE '4.%' AND SUBSTR(sspd.npwpd,9,2) = '01' AND sspd.no_sspd = sspd_detail.no_sspd AND sspd_detail.kode_rekening = '4.1.4.08.01'"));
$denda_situ = $denda_situ['denda'];
//tambah total retribusi + denda
$total_setoran = $total_setoran + $ketetapan_kebersihan + $denda_situ;

//extend class
class REPORT extends TCPDF{
	//header
	public function Header(){}
	
	//footer
	public function Footer(){}
}
// create new pdf
$pdf = new REPORT('P', 'mm', 'FOLIO');

//margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(false, 10);

//tambah halaman
$pdf->AddPage();


$pdf->SetFont("","B",16);
$pdf->Cell(0,0,"PEMERINTAH KOTA JAMBI",0,true,"C");
$pdf->SetFont("","",14);
$pdf->Cell(0,0,"SURAT TANDA SETORAN (STS)",0,1,"C");

$pdf->Ln(5,0);
$pdf->SetFont("","B",11);
$pdf->Cell(125,0,"STS No. ".$no_sts."/BPPRD/$bulan/$tahun");
$pdf->Cell(15,0,"Bank :");
$pdf->MultiCell(0,0,"PT. BPD JAMBI Cab. Sutomo Jl. Dr. Sutomo\n",0,"J",false,true);
$pdf->Ln(-5,0);
$pdf->SetFont("","B",14);
$pdf->Cell(0,0,"No. Rekening : 701500024",false,true);
$pdf->SetFont("","",10);
$pdf->Cell(0,0,"Harap diterima uang sebesar : Rp. ".str_replace(",",".",number_format($total_setoran)).",-",false,true);
$pdf->Cell(30,0,"(Dengan Huruf) :");
$pdf->MultiCell(0,0,ucfirst(trim(terbilang($total_setoran)))." rupiah.\n",false,"J",false,true);
$pdf->Ln(0,0);
$pdf->Cell(11,0,"Yaitu :");
$pdf->MultiCell(0,0,"Set Uang Pajak, Ret Daerah Untuk Penerimaan Tgl. ".getTanggalIndo($tanggal)." Bukti Penerimaan No. $no_bukti_1 s.d $no_bukti_2, Dgn rincian sbb :\n",false,"J",false,true);

//rincian
$lebar_uraian = 90;

$pdf->SetFont("","B",9);

$pdf->Ln(0,0);
$pdf->Cell(7,0,"No.",1,false,"C");
$pdf->Cell(40,0,"Kode Rekening",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Uraian Rincian Objek",true,false,"C");
$pdf->Cell(48,0,"Jumlah",true,false,"C");
$pdf->Cell(0,0,"",true,true);

$pdf->SetFont("","",9.5);
$jarak_baris_satuan = 4.4;
//isi
for($no=1;$no<=5;$no++){
	$ada_angka = true;
	if($no == 5){
		$query_pajak = mysqli_query($koneksi, "select kd_rek, nm_rek from master_rekening where kd_rek like '4.1.1.11%' order by kd_rek");
	}else{
	$query_pajak = mysqli_query($koneksi, "select kd_rek, nm_rek from master_rekening where kd_rek like '4.1.1.0$no%' order by kd_rek");
	}
	$jumlah_pajak = mysqli_num_rows($query_pajak);
	$jumlah_denda = 0;
	while($pajak = mysqli_fetch_assoc($query_pajak)){
		$array_kode_rekening = explode(".", $pajak['kd_rek']);
		if(empty($array_kode_rekening[4])){
			$kode_rekening = "";
			$pdf->Cell(7,$jumlah_pajak*$jarak_baris_satuan,$no,true,false,"C",false,false,false,false,false,"T");
			$nama_pajak = $pajak['nm_rek'];
			$paragraf_baru = true;
			continue;
		}else{
		$nama_pajak = $pajak['nm_rek'];
                if($nama_pajak == "Refleksi") continue;
                if($nama_pajak == "Panti Pijat") $nama_pajak = "Pajak Panti Pijat / Refleksi";
                    if(!$paragraf_baru) $pdf->Cell(7,0,"",false,false,"C");
                    $paragraf_baru = false;
                    $kode_rekening = $array_kode_rekening[4];
		}
		
		if($no == 5){
			$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '6.%' and substr(npwpd,9,2) = '$kode_rekening' and keterangan not like '%kasda%'"));
		}elseif($no == 4){
			$jumlah_sspd_detail = array();
			if($kode_rekening == "01"){
				//rekening papan merek
				//4.1.1.04.01
				$ketetapan_papan_merek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(sspd_detail.jumlah) AS ketetapan FROM sspd, sspd_detail WHERE sspd.tanggal = '$tanggal' AND sspd.npwpd LIKE '4.%' AND SUBSTR(sspd.npwpd,9,2) = '01' AND sspd.no_sspd = sspd_detail.no_sspd AND sspd_detail.kode_rekening = '4.1.1.04.01' and sspd.keterangan not like '%kasda%'"));
				//rekening denda reklame
				//4.1.4.07.04
				$denda_papan_merek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '4.%' AND SUBSTR(npwpd,9,2) = '01' and keterangan not like '%kasda%'"));
				$denda_papan_merek_situ = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(sspd_detail.jumlah) AS denda FROM sspd, sspd_detail WHERE sspd.tanggal = '$tanggal' AND sspd.npwpd LIKE '4.%' AND SUBSTR(sspd.npwpd,9,2) = '01' AND sspd.no_sspd = sspd_detail.no_sspd AND sspd_detail.kode_rekening = '4.1.4.07.04'"));
				
				$ketetapan_papan_merek = $ketetapan_papan_merek['ketetapan'];
				$denda_papan_merek = $denda_papan_merek['denda'] + $denda_papan_merek_situ['denda'];
				$jumlah = array("ketetapan" => $ketetapan_papan_merek, "denda" => $denda_papan_merek);
				
			}else{
				$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '$no.%' AND SUBSTR(npwpd,9,2) = '$kode_rekening' and keterangan not like '%kasda%'"));
			}
		}elseif($no == 3){
                    //pisahkan pijat sama refleksi
                    
                    $jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '$no.%' AND SUBSTR(npwpd,9,2) = '$kode_rekening' and keterangan not like '%kasda%'"));
                }
                else{
			$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '$no.%' AND SUBSTR(npwpd,9,2) = '$kode_rekening' and keterangan not like '%kasda%'"));
		}
                $denda = $jumlah['denda'];
		$jumlah = $jumlah['ketetapan'];                
		$jumlah_denda += $denda;
		
		$pdf->Cell(8,0,"4",true,false,"C");
		$pdf->Cell(8,0,"1",true,false,"C");
		$pdf->Cell(8,0,"1",true,false,"C");
		$pdf->Cell(8,0,$array_kode_rekening[3],true,false,"C");
		$pdf->Cell(8,0,$kode_rekening,true,false,"C");
		$pdf->Cell($lebar_uraian,0,$nama_pajak,true,false);
		$pdf->Cell(48,0,"Rp. ".number_format($jumlah),true,false,"J");
		$pdf->Cell(0,0,"",true,true);
	}
	$pdf->Cell(7,0,"",false,false,"C");
	$pdf->Cell(8,0,"4",true,false,"C");
	$pdf->Cell(8,0,"1",true,false,"C");
	$pdf->Cell(8,0,"1",true,false,"C");
	$pdf->Cell(8,0,"07",true,false,"C");
	$pdf->Cell(8,0,$array_kode_rekening[3],true,false,"C");
	
	$pdf->Cell($lebar_uraian,0,"Denda ".$nama_pajak,true,false);
	$pdf->Cell(48,0,"Rp. ".number_format($jumlah_denda),true,false,"J");
	$pdf->Cell(0,0,"",true,true);
}

//parkir 
$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '7.%' and keterangan not like '%kasda%'"));
$denda = $jumlah['denda'];
$jumlah = $jumlah['ketetapan'];

$pdf->Cell(7,4*$jarak_baris_satuan,"6",true,false,"C",false,false,false,false,false,"T");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"07",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Pajak Parkir",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($jumlah),true,false,"J");
$pdf->Cell(0,0,"",true,true);

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Denda Pajak Parkir",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($denda),true,false,"J");
$pdf->Cell(0,0,"",true,true);

//air tanah
$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '8.%' and keterangan not like '%kasda%'"));
$denda = $jumlah['denda'];
$jumlah = $jumlah['ketetapan'];

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"08",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Pajak Air Tanah",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($jumlah),true,false,"J");
$pdf->Cell(0,0,"",true,true);

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Denda Pajak Air Tanah",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($denda),true,false,"J");
$pdf->Cell(0,0,"",true,true);

//walet
$jumlah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(ketetapan) AS ketetapan, SUM(denda) AS denda FROM sspd WHERE tanggal = '$tanggal' AND npwpd LIKE '9.%' and keterangan not like '%kasda%'"));
$denda = $jumlah['denda'];
$jumlah = $jumlah['ketetapan'];

$pdf->Cell(7,2*$jarak_baris_satuan,"7",true,false,"C",false,false,false,false,false,"T");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"01",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Pajak Sarang Burung Walet",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($jumlah),true,false,"J");
$pdf->Cell(0,0,"",true,true);

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Denda Pajak Sarang Burung Walet",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($denda),true,false,"J");
$pdf->Cell(0,0,"",true,true);

//sewa tanah
$pdf->Cell(7,2*$jarak_baris_satuan,"8",true,false,"C",false,false,false,false,false,"T");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"01",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Sewa Tanah",true,false);
$pdf->Cell(48,0,"Rp. 0",true,false,"J");
$pdf->Cell(0,0,"",true,true);

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"01",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Sewa Gedung Simp. IV Sipin",true,false);
$pdf->Cell(48,0,"Rp. 0",true,false,"J");
$pdf->Cell(0,0,"",true,true);

//sampah
$pdf->Cell(7,2*$jarak_baris_satuan,"9",true,false,"C",false,false,false,false,false,"T");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"01",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Pelayanan Persampahan/Kebersihan",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($ketetapan_kebersihan),true,false,"J");
$pdf->Cell(0,0,"",true,true);

$pdf->Cell(7,0,"",false,false,"C");
$pdf->Cell(8,0,"4",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"1",true,false,"C");
$pdf->Cell(8,0,"01",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"Denda Retribusi Jasa Umum (Kebersihan)",true,false);
$pdf->Cell(48,0,"Rp. ".number_format($denda_situ),true,false,"J");
$pdf->Cell(0,0,"",true,true);



//Total
$pdf->Cell(7,0,"",true,false,"C",false,false,false,false,false,"T");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell(8,0,"",true,false,"C");
$pdf->Cell($lebar_uraian,0,"JUMLAH",true,false,"C");
$pdf->Cell(48,0,"Rp. ".number_format($total_setoran),true,false,"J");
$pdf->Cell(0,0,"",true,true);

$kolom1 = 70;
$kolom2 = 70;

$pdf->Cell($kolom1,0,"Mengetahui",false,false,"C");
$pdf->Cell(70,0,"Jambi, Tgl ".getTanggalIndo($tanggal),false,true,"C");

$pdf->Cell($kolom1,0,$jabatan_mengetahui,false,false,"C");
$pdf->Cell(70,0,$jabatan_bendahara,false,false,"C");
$pdf->Cell(0,0,"Uang Tersebut diatas",false,true,"C");

$pdf->Cell($kolom1,0,"BPPRD Kota Jambi",false,false,"C");
$pdf->Cell($kolom2,0,"BPPRD Kota Jambi",false,false,"C");
$pdf->Cell(0,0,"Diterima",false,true,"C");

$pdf->Ln(10,0);
$pdf->Cell($kolom1,0,"($nama_mengetahui)",false,false,"C");
$pdf->Cell($kolom2,0,"($nama_bendahara)",false,false,"C");
$pdf->Cell(0,0,"(...............................)",false,true,"C");

$pdf->Cell($kolom1,0,"NIP. $nip_mengetahui",false,false,"C");
$pdf->Cell($kolom2,0,"NIP. $nip_bendahara",false,false,"C");
$pdf->Cell(0,0,"NIP.");

//set header line
//garis
$pdf->SetLineWidth(0);
$pdf->Line(10.5,25,205,25);
$pdf->SetLineWidth(1);
$pdf->Line(10.5,24,205,24);

// pdf end
$pdf->output("STS $tanggal.pdf", 'I');

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