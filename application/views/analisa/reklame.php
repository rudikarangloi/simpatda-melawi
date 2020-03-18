<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_reklame where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;	
	$jenisReklame = $rs->jenis_reklame;	
	$jumlahReklame = $rs->jumlah_reklame;	
	$panjang = $rs->panjang;	
	$lebar = $rs->lebar;	
	$tinggi = $rs->tinggi;	
	$rata2Omset = $rs->rata2_omset;	
	$ketRek = $rs->ket;	
endif;
?>
<div id="C1" style="background-color: #B3D9F0; width:100%; height:100%;">
      <table width="644" border="0">
        <tr>
          <td><div align="left"><span style="padding-left:15px;">NO Record</span></div></td>
          <td><input type="text" name="no_trxreklame" id="no_trxreklame" size="22" style="background-color:#FFFFCC;" value="<?php if(isset($strNoUrut)): echo $strNoUrut; endif; ?>" readonly="readonly"/> <input type="hidden" name="txtUsername" id="txtUsername" value="<?php if(isset($username)): echo $username; endif; ?>" /> </td>
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
          <td width="156" style="padding-left:15px;">Jenis Reklame</td>
          <td width="291"><input type="text" name="jenis_reklame" id="jenis_reklame" value="<?php if(isset($jenisReklame)): echo $jenisReklame; endif; ?>" /></td>
          <td width="10">&nbsp;</td>
          <td width="176">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Jumlah Reklame</td>
          <td><input name="jumlah_reklame" type="text" id="jumlah_reklame" size="8" value="<?php if(isset($jumlahReklame)): echo $jumlahReklame; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Dimensi</td>
          <td>P 
          <input name="panjang" type="text" id="panjang" size="3" value="<?php if(isset($panjang)): echo $panjang; endif; ?>" /> 
          L 
          <input name="lebar" type="text" id="lebar" size="3" value="<?php if(isset($lebar)): echo $lebar; endif; ?>" /> 
          T 
          <input name="tinggi" type="text" id="tinggi" size="3" value="<?php if(isset($tinggi)): echo $tinggi; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Rata2 Omzet</td>
          <td><input name="rata2_omset" type="text" id="rata2_omset" size="8" value="<?php if(isset($rata2Omset)): echo $rata2Omset; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Keterangan</td>
          <td><input type="text" name="ket" id="ket" value="<?php if(isset($ketRek)): echo $ketRek; endif; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
</div>