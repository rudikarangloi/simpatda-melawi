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
<p align="center"><strong>HIBURAN</strong></p>
<table width="1255" border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <td bgcolor="#99CCFF"><div align="center">NO</div></td>
    <td bgcolor="#99CCFF"><div align="center">WAJIB PAJAK</div></td>
    <td bgcolor="#99CCFF"><div align="center">NPWPD</div></td>
    <td bgcolor="#99CCFF"><div align="center">KAMAR</div></td>
    <td bgcolor="#99CCFF"><div align="center">MEJA</div></td>
    <td bgcolor="#99CCFF"><div align="center">MESIN</div></td>
    <td bgcolor="#99CCFF"><div align="center">STUDIO</div></td>
    <td bgcolor="#99CCFF"><div align="center">KURSI</div></td>
    <td bgcolor="#99CCFF"><div align="center">TARIF</div></td>
    <td bgcolor="#99CCFF"><div align="center">JUMLAH
    <br/>
    PEGAWAI
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
  $jml_kamar = 0;
  $jml_meja = 0;
  $jml_mesin = 0;
  $jml_studio = 0;
  $jml_kursi = 0;
  $jml_tarif = 0;
  $jml_pegawai = 0;  
  $rata2_omset = 0;
  
  $ttl_kamar = 0;
  $ttl_meja = 0;
  $ttl_mesin = 0;
  $ttl_studio = 0;
  $ttl_kursi = 0;
  $ttl_tarif = 0;
  $ttl_pegawai = 0; 
  $ttl_rata2_omset = 0;
  $bg = '';
  
  if($kec!="null"){
  	$wr = " where kecamatan.kode_kecamatan = $kec ";
  	if($kel!="null"){
		$wr = $wr." and kelurahan.id = $kel ";	
	}
	
  }    	
	
	$query = $this->db->query("select identitas_perusahaan.npwpd_perusahaan, identitas_perusahaan.nama_perusahaan, mp_hiburan.jml_kamar, mp_hiburan.jml_meja, mp_hiburan.jml_mesin
, mp_hiburan.jml_studio, mp_hiburan.jml_kursi, mp_hiburan.tarif, mp_hiburan.jml_pegawai, mp_hiburan.rata2omset 
, kelurahan.nama_kelurahan, kecamatan.nama_kecamatan, kelurahan.id, kecamatan.kode_kecamatan
from identitas_perusahaan 
left join mp_hiburan on identitas_perusahaan.npwpd_perusahaan = mp_hiburan.npwpd 
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
                    <td colspan="3" bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>            
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_kamar ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_meja ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_mesin ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_studio ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_kursi ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_tarif ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $jml_pegawai ?></td>
                    <td align="center" bgcolor="#FF99FF"><?php echo $rata2_omset ?></td>
                  </tr>
			<?php				 
				 $ttl_kamar = $ttl_kamar + $jml_kamar;
				 $ttl_meja = $ttl_meja + $jml_meja;
				 $ttl_mesin = $ttl_mesin + $jml_mesin;
				 $ttl_studio = $ttl_studio + $jml_studio;
				 $ttl_kursi = $ttl_kursi + $jml_kursi;
				 $ttl_tarif = $ttl_tarif + $jml_tarif;
				 $ttl_pegawai = $ttl_pegawai + $jml_pegawai;  
				 $ttl_rata2_omset = $ttl_rata2_omset + $rata2_omset;
				  
				 $jml_kamar = 0;
				  $jml_meja = 0;
				  $jml_mesin = 0;
				  $jml_studio = 0;
				  $jml_kursi = 0;
				  $jml_tarif = 0;
				  $jml_pegawai = 0;  
				$rata2_omset = 0;
            }
			?>
               <tr>
                <td colspan="11" align="left" style="background-color:#FFFFCC;"><?php echo $d->nama_kecamatan ?> - <?php echo $d->nama_kelurahan ?></td>
              </tr>
              <tr>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $no ?></td>
                <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->nama_perusahaan ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->npwpd_perusahaan ?></td>
                <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_kamar ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_meja ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_mesin ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_studio ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_kursi ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->tarif ?></td>
                <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_pegawai ?></td>                
                <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $d->rata2omset ?></td>
              </tr>
            <?php
			$bSubTotal = 1;
			$jml_kamar = $jml_kamar + $d->jml_kamar;
		    $jml_meja = $jml_meja + $d->jml_meja;
		    $jml_mesin = $jml_mesin + $d->jml_mesin;
		    $jml_studio = $jml_studio + $d->jml_studio;
			$jml_kursi = $jml_kursi + $d->jml_kursi;
			$jml_tarif = $jml_tarif + $d->tarif;
			$jml_pegawai = $jml_pegawai + $d->jml_pegawai;			
		    $rata2_omset = $rata2_omset + $d->rata2omset;
			
		} else{
			?>
            	<tr>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $no ?></td>
                    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->nama_perusahaan ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->npwpd_perusahaan ?></td>
                    <td align="left" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_kamar ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_meja ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_mesin ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_studio ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_kursi ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->tarif ?></td>
                    <td align="center" style="background-color:<?php echo $bg; ?>"><?php echo $d->jml_pegawai ?></td>                
                    <td align="right" style="background-color:<?php echo $bg; ?>"><?php echo $d->rata2omset ?></td>
                  </tr>
			
            <?php
			$jml_kamar = $jml_kamar + $d->jml_kamar;
		    $jml_meja = $jml_meja + $d->jml_meja;
		    $jml_mesin = $jml_mesin + $d->jml_mesin;
		    $jml_studio = $jml_studio + $d->jml_studio;
			$jml_studio = $jml_studio + $d->jml_kursi;
			$jml_studio = $jml_studio + $d->tarif;
			$jml_studio = $jml_studio + $d->jml_pegawai;
		    $rata2_omset = $rata2_omset + $d->rata2omset;
		}
		
  $no++; 
  
  
  } 
  
  if($bSubTotal == 1){
	?>
		<tr>
			<td colspan="3" bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>            
			<td align="center" bgcolor="#FF99FF"><?php echo $jml_kamar ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_meja ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_mesin ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_studio ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_kursi ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_tarif ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_pegawai ?></td>
			<td align="right" bgcolor="#FF99FF"><?php echo $rata2_omset ?></td>
		  </tr>
	<?php
		$ttl_kamar = $ttl_kamar + $jml_kamar;
		 $ttl_meja = $ttl_meja + $jml_meja;
		 $ttl_mesin = $ttl_mesin + $jml_mesin;
		 $ttl_studio = $ttl_studio + $jml_studio;
		 $ttl_kursi = $ttl_kursi + $jml_kursi;
		 $ttl_tarif = $ttl_tarif + $jml_tarif;
		 $ttl_pegawai = $ttl_pegawai + $jml_pegawai; 
		 $ttl_rata2_omset = $ttl_rata2_omset + $rata2_omset;
		 
		 $jml_kamar = 0;
		  $jml_meja = 0;
		  $jml_mesin = 0;
		  $jml_studio = 0;
		  $jml_kursi = 0;
		  $jml_tarif = 0;
		  $jml_pegawai = 0; 
		$rata2_omset = 0;
	}
  
  
  ?>
  
  <tr>
    <td colspan="3" bgcolor="#99CCFF"><div align="center">TOTAL</div></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_kamar ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_meja ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_mesin ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_studio ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_kursi ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_tarif ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_pegawai ?></td>
    <td align="right" bgcolor="#99CCFF"><?php echo $ttl_rata2_omset ?></td>
  </tr>  
</table>
</body>
