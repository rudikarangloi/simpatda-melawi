<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_penerangan where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;	
	$jenisPenerangan = $rs->jenis_penerangan;	
	$daya = $rs->daya;	
	$rata2Pakai = $rs->rata2_pakai;	
	$rata2Omset = $rs->rata2_omset;	
	$ketPen = $rs->ket;	
endif;
?>
<div id="C1" style="background-color: #B3D9F0; width:100%; height:100%;">
      <table width="644" border="0">
        <tr>
          <td><div align="left"><span style="padding-left:15px;">NO Record</span></div></td>
          <td><input type="text" name="no_trx" id="no_trx" size="22" style="background-color:#FFFFCC;" value="<?php if(isset($strNoUrut)): echo $strNoUrut; endif; ?>" readonly="readonly"/> <input type="hidden" name="txtUsername" id="txtUsername" value="<?php if(isset($username)): echo $username; endif; ?>" /> </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="left"><span style="padding-left:15px;">Tanggal</span></div></td>
          <td><input type="text" name="tgl" id="tgl" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="156" style="padding-left:15px;">Daya</td>
          <td width="291"><input type="text" name="daya" id="daya" value="<?php if(isset($daya)): echo $daya; endif; ?>" /></td>
          <td width="10">&nbsp;</td>
          <td width="176">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Jenis Penerangan</td>
          <td><input type="text" name="jenis_penerangan" id="jenis_penerangan" value="<?php if(isset($jenisPenerangan)): echo $jenisPenerangan; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Rata2 Pemakaian</td>
          <td><input type="text" name="rata2_pemakaian" id="rata2_pemakaian" value="<?php if(isset($rata2Pakai)): echo $rata2Pakai; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Rata2 Omzet</td>
          <td><input name="omset" type="text" id="omset" size="8" value="<?php if(isset($rata2Omset)): echo $rata2Omset; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Keterangan</td>
          <td><input type="text" name="ket" id="ket" value="<?php if(isset($ketPen)): echo $ketPen; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
</div>