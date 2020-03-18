<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=data_potensi_reklame.xls');	
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
<p align="center"><strong>DAFTAR POTENSI WAJIB PAJAK KOTA PADANG</strong></p>
<p align="center"><strong>REKLAME</strong></p>
<table width="1255" border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <td bgcolor="#99CCFF"><div align="center">NO</div></td>
    <td bgcolor="#99CCFF"><div align="center">WAJIB PAJAK</div></td>
    <td bgcolor="#99CCFF"><div align="center">NPWPD</div></td>
    <td bgcolor="#99CCFF"><div align="center">JENIS REKLAME</div></td>
    <td bgcolor="#99CCFF"><div align="center">JUMLAH
    <br />
    REKLAME</div></td>
    <td bgcolor="#99CCFF"><div align="center">PANJANG
    <br/>
    (METER)
    </div></td>
    <td bgcolor="#99CCFF"><div align="center">LEBAR
    <br/>
    (METER)
    </div></td>
    <td bgcolor="#99CCFF"><div align="center">TINGGI
    <br/>
    (METER)
    </div></td>
    <td bgcolor="#99CCFF"><div align="center">RATA-RATA
        <br />
    OMSET</div></td>
  </tr>
  

 
  
  <?php 
  $wr = "";
  $no = 1; 
  //$T1 = 0; $T2 = 0; $T3 = 0; $T4 = 0; $T5 = 0;
  $strkel = '';
  $bSubTotal = 0;
  $jml_jumlah_reklame = 0;
  $jml_panjang = 0;
  $jml_lebar = 0;
  $jml_tinggi = 0;
  $rata2_omset = 0;
  
  $ttl_jumlah_reklame = 0;
  $ttl_panjang = 0;
  $ttl_lebar = 0;
  $ttl_tinggi = 0;
  $ttl_rata2_omset = 0;
  
  if($kec!="null"){
  	$wr = " where kecamatan.kode_kecamatan = $kec ";
  	if($kel!="null"){
		$wr = $wr." and kelurahan.id = $kel ";	
	}
	
  }    	
	
	$query = $this->db->query("select identitas_perusahaan.npwpd_perusahaan, identitas_perusahaan.nama_perusahaan, mp_reklame.jenis_reklame, mp_reklame.jumlah_reklame, mp_reklame.panjang
, mp_reklame.lebar, mp_reklame.tinggi, mp_reklame.rata2_omset 
, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan, kelurahan.id, kecamatan.kode_kecamatan
from identitas_perusahaan 
left join mp_reklame on identitas_perusahaan.npwpd_perusahaan = mp_reklame.npwpd 
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.id
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan $wr ");
	
	foreach($query->result() as $d){
		if($no%2==0) {
			$bg = "#CCC";
		 } else {
			$bg = "#FFF";  
		}
				
		if($strkel !=  $d->nama_kelurahan){
			$strkel =  $d->nama_kelurahan; 	
			
			if($bSubTotal == 1){
			?>
				<tr>
                    <td colspan="4" bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>            
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_jumlah_reklame ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_panjang ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_lebar ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_tinggi ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $rata2_omset ?></td>
                  </tr>
			<?php
				$ttl_jumlah_reklame = $ttl_jumlah_reklame + $jml_jumlah_reklame;
				 $ttl_panjang = $ttl_panjang + $jml_panjang;
				 $ttl_lebar = $ttl_lebar + $jml_lebar;
				 $ttl_tinggi = $ttl_tinggi + $jml_tinggi;
				 $ttl_rata2_omset = $ttl_rata2_omset + $rata2_omset;
				  
				$jml_jumlah_reklame = 0;
				$jml_panjang = 0;
				$jml_lebar = 0;
				$jml_tinggi = 0;
				$rata2_omset = 0;
            }
			?>
               <tr>
                <td colspan="9" align="left" style="background-color:#FFFFCC;"><?php echo $d->nama_kecamatan ?> - <?php echo $d->nama_kelurahan ?></td>
              </tr>
              <tr>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $no ?></td>
                <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->nama_perusahaan ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->npwpd_perusahaan ?></td>
                <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->jenis_reklame ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jumlah_reklame ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->panjang ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->lebar ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->tinggi ?></td>
                <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $d->rata2_omset ?></td>
              </tr>
            <?php
			$bSubTotal = 1;
			$jml_jumlah_reklame = $jml_jumlah_reklame + $d->jumlah_reklame;
		    $jml_panjang = $jml_panjang + $d->panjang;
		    $jml_lebar = $jml_lebar + $d->lebar;
		    $jml_tinggi = $jml_tinggi + $d->tinggi;
		    $rata2_omset = $rata2_omset + $d->rata2_omset;
			
		} else{
			?>
            	<tr>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $no ?></td>
                    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->nama_perusahaan ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->npwpd_perusahaan ?></td>
                    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->jenis_reklame ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jumlah_reklame ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->panjang ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->lebar ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->tinggi ?></td>
                    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $d->rata2_omset ?></td>
                  </tr>
			
            <?php
			$jml_jumlah_reklame = $jml_jumlah_reklame + $d->jumlah_reklame;
		    $jml_panjang = $jml_panjang + $d->panjang;
		    $jml_lebar = $jml_lebar + $d->lebar;
		    $jml_tinggi = $jml_tinggi + $d->tinggi;
		    $rata2_omset = $rata2_omset + $d->rata2_omset;
		}
		
  $no++; 
  
  
  } 
  
  if($bSubTotal == 1){
	?>
		<tr>
			<td colspan="4" bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>            
			<td align="center" bgcolor="#FF99FF"><?php echo $jml_jumlah_reklame ?></td>
			<td align="center" bgcolor="#FF99FF"><?php echo $jml_panjang ?></td>
			<td align="center" bgcolor="#FF99FF"><?php echo $jml_lebar ?></td>
			<td align="center" bgcolor="#FF99FF"><?php echo $jml_tinggi ?></td>
			<td align="right" bgcolor="#FF99FF"><?php echo $rata2_omset ?></td>
		  </tr>
	<?php
		$ttl_jumlah_reklame = $ttl_jumlah_reklame + $jml_jumlah_reklame;
		 $ttl_panjang = $ttl_panjang + $jml_panjang;
		 $ttl_lebar = $ttl_lebar + $jml_lebar;
		 $ttl_tinggi = $ttl_tinggi + $jml_tinggi;
		 $ttl_rata2_omset = $ttl_rata2_omset + $rata2_omset;
		 
		$jml_jumlah_reklame = 0;
		$jml_panjang = 0;
		$jml_lebar = 0;
		$jml_tinggi = 0;
		$rata2_omset = 0;
	}
  
  
  ?>
  
  <tr>
    <td colspan="4" bgcolor="#99CCFF"><div align="center">TOTAL</div></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_jumlah_reklame ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_panjang ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_lebar ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $jml_tinggi ?></td>
    <td align="right" bgcolor="#99CCFF"><?php echo $ttl_rata2_omset ?></td>
  </tr>  
</table>
</body>
