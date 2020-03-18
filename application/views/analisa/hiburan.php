<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_hiburan where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;
	
	$jml_kamar = $rs->jml_kamar;
	$jml_meja = $rs->jml_meja;
	$jml_mesin = $rs->jml_mesin;
	$jml_studio = $rs->jml_studio;
	$jml_kursi = $rs->jml_kursi;
	
	$tarif = $rs->tarif;
	$jml_pegawai = $rs->jml_pegawai;
	$rata2omzet = $rs->rata2omset;
	$ket = $rs->ket;
endif;
?>

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
		
</script>

<div style="height:100%; overflow:auto;">
<!--<h2 style="margin:30px 5px 25px 30px;">SPTPD Hiburan</h2>-->

<!--<div id="a_tabbar" style="width:1000px; height:470px; margin-left:30px; overflow:auto;"></div>-->
  <div id="C1" style="background-color: #B3D9F0">
    <br />
   	  <table width="787" border="0">
      		<tr>
        		<td width="198" style="padding-left:15px;">No.Record</td>
            	<td width="471"><input type="text" name="no_trx_hiburan" id="no_trx_hiburan" size="22" style="background-color:#FFFFCC;" readonly="readonly" value="<?php  echo $strNoUrut; ?>"/> <input type="hidden" name="txtUsername" id="txtUsername" value="<?php echo $username; ?>" />            	</td>
      		</tr>
            <tr>
              <td style="padding-left:15px;">Tanggal</td>
              <td><input type="text" name="txttgl_hiburan" id="txttgl_hiburan" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Jumlah Kamar</td>
                <td><input type="text" name="txtjml_kamar_hiburan" id="txtjml_kamar_hiburan" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_kamar)): echo $jml_kamar; endif; ?>"/>&nbsp;Kamar                </td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Jumlah Meja</td>
                <td><input type="text" name="txtjml_meja_hiburan" id="txtjml_meja_hiburan" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_meja)): echo $jml_meja; endif; ?>"/>&nbsp;Unit</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Jumlah Mesin</td>
              <td><input type="text" name="txtjml_mesin_hiburan" id="txtjml_mesin_hiburan" style="background-color:#FFF;" size="15" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_mesin)): echo $jml_mesin; endif; ?>"/>&nbsp;Unit</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Jumlah Studio</td>
              <td><input type="text" name="txtjml_studio_hiburan" id="txtjml_studio_hiburan" style="background-color:#FFF;" size="11" maxlength='11' value="<?php if(isset($jml_studio)): echo $jml_studio; endif; ?>" />&nbsp; Studio</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Jumlah Kursi</td>
              <td><input type="text" name="txtjml_kursi_hiburan" id="txtjml_kursi_hiburan" style="background-color:#FFF;" size="15"  onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_kursi)): echo $jml_kursi; endif; ?>"/>&nbsp;Unit</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Tarif</td>
              <td><input type="text" name="txttarif_hiburan" id="txttarif_hiburan" style="background-color:#FFF;" size="15" maxlength='11'  onkeypress="return checknumeric(event)" value="<?php if(isset($tarif)): echo $tarif; endif; ?>"/>
              &nbsp;Rp.</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Jumlah Pegawai</td>
              <td><input type="text" name="txtjml_pegawai_hiburan" id="txtjml_pegawai_hiburan" style="background-color:#FFF;" size="15"  onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_pegawai)): echo $jml_pegawai; endif; ?>"/>&nbsp;Orang</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Rata-rata Omzet</td>
              <td><input type="text" name="txtrata2_hiburan" id="txtrata2_hiburan" style="background-color:#FFF;" size="20" maxlength='15' value="<?php if(isset($rata2omzet)): echo $rata2omzet; endif; ?>" />&nbsp; / Bulan</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Keterangan</td>
              <td><input type="text" name="txtket_hiburan" id="txtket_hiburan" style="background-color:#FFF;" size="100" maxlength='100' value="<?php if(isset($ket)): echo $ket; endif; ?>" /></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
           
            <tr>
              <td colspan="2" style="padding-left:15px;">
              	<!--<div id="gridHotel" style="background-color:#FFFFFF;"></div>-->
              </td>
            </tr>
            <tr>
                <td style="padding-left:15px;" colspan="2">&nbsp;</td>
            </tr>
	
</table>

<br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="400px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="349px" style="background-color:white;"></div>
</div>
</div>

<div id="objsBrg" style="display:none;">
<br />
<form name="frmSrc2" id="frmSrc2" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onClick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onClick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
</div>
<script language="javascript">
	
</script>
