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
<p align="center"><strong>REKAPITULASI POTENSI PAJAK</strong></p>
<p align="center"><strong>KOTA PADANG</strong></p>
<table width="1255" border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <td bgcolor="#99CCFF"><div align="center">NO <?php echo $kec; ?></div></td>
    <td bgcolor="#99CCFF"><div align="center">JENIS PAJAK <?php echo $kel; ?></div></td>
    <td bgcolor="#99CCFF"><div align="center">JUMLAH <BR/> WAJIB PAJAK</div></td>
    <td bgcolor="#99CCFF"><div align="center">RATA-RATA <BR/> OMSET</div></td>
  </tr>
  

 
  
  <?php 
  $wr = "";
  $no = 1; 
  //$T1 = 0; $T2 = 0; $T3 = 0; $T4 = 0; $T5 = 0;
  $strkel = '';
  $bSubTotal = 0;
    
  $jml_wajib_pajak = 0;
  $rata2 =0;
  $jml_wp_wilayah = 0;
  $jml_rata_wilayah = 0;
  $ttl_wp_wilayah = 0;
  $ttl_rata_wilayah = 0;
  
  if($kec!="null"){
  	$wr = " where kecamatan.kode_kecamatan = $kec ";
  	if($kel!="null"){
		$wr = $wr." and kelurahan.kode_kelurahan = $kel ";	
	}
	
  }    	
	
	$query = $this->db->query("select kelurahan.kode_kelurahan, kelurahan.nama_kelurahan, kelurahan.kode_kecamatan, kecamatan.nama_kecamatan 
from kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan $wr ");
	
	foreach($query->result() as $d){
		$jml_wp_wilayah = 0;
  		$jml_rata_wilayah = 0;
  
		?>
        <tr>
            <td colspan="4" align="left" style="background-color:#FFFFCC;"><?php echo $d->nama_kecamatan ?> - <?php echo $d->nama_kelurahan ?></td>
        </tr>
                
        <?php	
		
		$queryReklame = $this->db->query("select count(mp_reklame.id) as wajib_pajak, sum(mp_reklame.rata2_omset) as rata2
from mp_reklame
left join identitas_perusahaan on mp_reklame.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryReklame->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 1 ?></td>
            <td align="left" >REKLAME</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		$queryAir_Tanah = $this->db->query("select count(mp_airtanah.id) as wajib_pajak, sum(mp_airtanah.rata2pemakaian) as rata2
from mp_airtanah
left join identitas_perusahaan on mp_airtanah.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryAir_Tanah->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 2 ?></td>
            <td align="left" >AIR BAWAH TANAH</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryHiburan = $this->db->query("select count(mp_hiburan.id) as wajib_pajak, sum(mp_hiburan.rata2omset) as rata2
from mp_hiburan
left join identitas_perusahaan on mp_hiburan.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryHiburan->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 3 ?></td>
            <td align="left" >HIBURAN</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryMineral = $this->db->query("select count(mp_mineral.id) as wajib_pajak, sum(mp_mineral.rata2omset) as rata2
from mp_mineral
left join identitas_perusahaan on mp_mineral.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");		
		$rs = $queryMineral->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 4 ?></td>
            <td align="left" >MINERAL</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryParkir = $this->db->query("select count(mp_parkir.id) as wajib_pajak, sum(mp_parkir.rata2omzet) as rata2
from mp_parkir
left join identitas_perusahaan on mp_parkir.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryParkir->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 5 ?></td>
            <td align="left" >PARKIR</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryPenerangan = $this->db->query("select count(mp_penerangan.id) as wajib_pajak, sum(mp_penerangan.rata2_omset) as rata2
from mp_penerangan
left join identitas_perusahaan on mp_penerangan.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryPenerangan->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 6 ?></td>
            <td align="left" >PENERANGAN JALAN</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryRestoran = $this->db->query("select count(mp_restoran.id) as wajib_pajak, sum(mp_restoran.rata2omset) as rata2
from mp_restoran
left join identitas_perusahaan on mp_restoran.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryRestoran->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 7 ?></td>
            <td align="left" >RESTORAN</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>        
        <?php
		
		
		$queryWalet = $this->db->query("select count(mp_walet.id) as wajib_pajak, sum(mp_walet.rata2omset) as rata2
from mp_walet
left join identitas_perusahaan on mp_walet.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryWalet->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 8 ?></td>
            <td align="left" >SARANG BURUNG WALET</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>
        
        <?php	
		
		$queryHotel = $this->db->query("select count(mp_hotel.id) as wajib_pajak, sum(mp_hotel_detail.rata2omset) as rata2
from mp_hotel
left join mp_hotel_detail on mp_hotel.npwpd = mp_hotel_detail.npwpd
left join identitas_perusahaan on mp_hotel.npwpd = identitas_perusahaan.npwpd_perusahaan
left join kelurahan on identitas_perusahaan.kelurahan = kelurahan.kode_kelurahan
left join kecamatan on kelurahan.kode_kecamatan = kecamatan.kode_kecamatan
where kelurahan.kode_kelurahan = ".$d->kode_kelurahan." and kecamatan.kode_kecamatan = ".$d->kode_kecamatan." ");
		$rs = $queryHotel->row();
		$jml_wajib_pajak = $rs->wajib_pajak;
		$rata2 = $rs->rata2;
		$jml_wp_wilayah = $jml_wp_wilayah + $jml_wajib_pajak;
		$jml_rata_wilayah = $jml_rata_wilayah + $rata2;
		?>
        <tr>
            <td align="center"><?php echo 9 ?></td>
            <td align="left" >HOTEL</td>
            <td align="center" ><?php echo $jml_wajib_pajak ?></td>
            <td align="center" ><?php echo $rata2 ?></td>
      	</tr>  
        <tr>
            <td colspan="2" bgcolor="#FF99FF"><div align="center">JUMLAH</div></td>            
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_wp_wilayah ?></td>
            <td align="center" bgcolor="#FF99FF"><?php echo $jml_rata_wilayah ?></td>
          </tr>      
        <?php
		$ttl_wp_wilayah = $ttl_wp_wilayah + $jml_wp_wilayah;
  		$ttl_rata_wilayah = $ttl_rata_wilayah + $jml_rata_wilayah;	
		
  $no++; 
  
  
  } 
  
    
  
  ?>
   <tr>
    <td colspan="2" bgcolor="#99CCFF"><div align="center">TOTAL</div></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_wp_wilayah ?></td>
    <td align="center" bgcolor="#99CCFF"><?php echo $ttl_rata_wilayah ?></td>
  </tr>  
  
</table>
</body>
