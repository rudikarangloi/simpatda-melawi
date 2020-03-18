<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_walet where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;	
	
	$jml_wilayah = $rs->jml_wilayah;	
	$jml_sarang = $rs->jml_sarang;
	
	$tarif = $rs->tarif;
	$rata2omset = $rs->rata2omset;
	$ket = $rs->ket;
endif;
?>



<div style="height:100%; overflow:auto;">
<!--<h2 style="margin:30px 5px 25px 30px;">SPTPD Hiburan</h2>-->

<!--<div id="a_tabbar" style="width:1000px; height:470px; margin-left:30px; overflow:auto;"></div>-->
  <div id="C1" style="background-color: #B3D9F0; height:100%;">
    <br />
   	  <table width="787" border="0">
      		<tr>
        		<td width="198" style="padding-left:15px;">No.Record</td>
            	<td width="471"><input type="text" name="no_trx_walet" id="no_trx_walet" size="22" style="background-color:#FFFFCC;" readonly="readonly" value="<?php echo $strNoUrut;?>"/> <input type="hidden" name="txtUsername" id="txtUsername" value="<?php echo $username; ?>" />            	</td>
      		</tr>
            <tr>
              <td style="padding-left:15px;">Tanggal</td>
              <td><input type="text" name="txttgl_walet" id="txttgl_walet" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Luas Wilayah</td>
                <td><input type="text" name="txtjml_wilayah_walet" id="txtjml_wilayah_walet" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_wilayah)): echo $jml_wilayah; endif; ?>" />&nbsp;m2                </td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Jumlah Sarang</td>
                <td><input type="text" name="txtjml_sarang_walet" id="txtjml_sarang_walet" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_sarang)): echo $jml_sarang; endif; ?>"/>&nbsp;</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Tarif</td>
              <td><input type="text" name="txttarif_walet" id="txttarif_walet" style="background-color:#FFF;" size="15" maxlength='11'  onkeypress="return checknumeric(event)" value="<?php if(isset($tarif)): echo $tarif; endif; ?>"/>
              &nbsp;Rp.</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Rata-rata Omzet</td>
              <td><input type="text" name="txtrata2_walet" id="txtrata2_walet" style="background-color:#FFF;" size="20" maxlength='15' onblur="checkThis(this.value);" value="<?php if(isset($rata2omset)): echo $rata2omset; endif; ?>"/>&nbsp; / Bulan</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Keterangan</td>
              <td><input type="text" name="txtket_walet" id="txtket_walet" style="background-color:#FFF;" size="100" maxlength='100' value="<?php if(isset($ket)): echo $ket; endif; ?>" /></td>
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

<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
</div>
