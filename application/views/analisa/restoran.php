<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_restoran where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;
	$rata2omset = $rs->rata2omset;
	$ket = $rs->ket;
	
	$jml_meja = $rs->jml_meja;
	$jml_kursi = $rs->jml_kursi;
	$jml_pegawai = $rs->jml_pegawai;
endif;
?>
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	
	
</script>

<div style="height:100%; overflow:auto;">
<!--<h2 style="margin:30px 5px 25px 30px;">SPTPD Restoran</h2>-->

<!--<div id="a_tabbar" style="width:1000px; height:470px; margin-left:30px; overflow:auto;"></div>-->
  <div id="C1" style="background-color: #B3D9F0; height:100%;">
    <br />
   	  <table width="787" border="0">
      		<tr>
        		<td width="198" style="padding-left:15px;">No.Record</td>
           	  <td width="471"><input type="text" name="no_trx_resto" id="no_trx_resto" size="22" style="background-color:#FFFFCC;" value="<?php echo $strNoUrut;?>" readonly="readonly"/> <input type="hidden" name="txtUsername" id="txtUsername" value="<?php echo $username; ?>" /> </td>
      		</tr>
            <tr>
              <td style="padding-left:15px;">Tanggal</td>
              <td><input type="text" name="txttgl_resto" id="txttgl_resto" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Jumlah Meja</td>
                <td><input type="text" name="txtjml_meja_resto" id="txtjml_meja_resto" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_meja)): echo $jml_meja; endif; ?>" />&nbsp;Unit                </td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Jumlah Kursi</td>
                <td><input type="text" name="txtjml_kursi_resto" id="txtjml_kursi_resto" size="15" style="background-color:#FFF;"  onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_kursi)): echo $jml_kursi; endif; ?>"/>&nbsp;Unit</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Jumlah Pegawai</td>
              <td><input type="text" name="txtjml_pegawai_resto" id="txtjml_pegawai_resto" style="background-color:#FFF;" size="15"  onkeypress="return checknumeric(event)" maxlength='11' value="<?php if(isset($jml_pegawai)): echo $jml_pegawai; endif; ?>"/>&nbsp;Orang</td>
            </tr>
            <tr>
              <td style="padding-left:15px;"> Rata-rata Omset</td>
              <td><input type="text" name="txtrata2_resto" id="txtrata2_resto" style="background-color:#FFF;" size="20" maxlength='15' onblur="checkThis(this.value);" value="<?php if(isset($rata2omset)): echo $rata2omset; endif; ?>"/>&nbsp; / Bulan</td>
            </tr>
             <tr>
              <td style="padding-left:15px;"> Keterangan</td>
              <td><input type="text" name="txtket_resto" id="txtket_resto" style="background-color:#FFF;" size="100" maxlength='100' value="<?php if(isset($ket)): echo $ket; endif; ?>"/></td>
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

