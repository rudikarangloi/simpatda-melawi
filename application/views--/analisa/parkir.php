<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_parkir where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;
	$luas_p = $rs->luas_area_p;
	$luas_l = $rs->luas_area_l;
	$tingkat_kunjungan = $rs->tingkat_kunjungan;
	$vol_mobil = $rs->vol_mobil;
	$vol_motor = $rs->vol_motor;
	$tarif = $rs->tarif;
	$jml_pegawai = $rs->jml_pegawai;
	$rata2omzet = $rs->rata2omzet;
	$ketParkir = $rs->ket;
endif;
?>
<div id="C1" style="background-color: #B3D9F0; width:100%; height:100%;">
      <table width="644" border="0">
        <tr>
          <td><span style="padding-left:15px;">NO Transaksi</span></td>
          <td><input type="text" name="no_trxParkir" id="no_trxParkir" size="22" style="background-color:#FFFFCC;" value="<?php echo $strNoUrut; ?>" readonly="readonly"/>
          <input type="hidden" name="txtUsername" id="txtUsername" value="<?php echo $username; ?>" /> </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span style="padding-left:15px;">Tanggal</span></td>
          <td><input type="text" name="tgl" id="tgl" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>" /></td>
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
          <td width="171">Luas Area Parkir (P x L)</td>
         <td width="169"><input name="luas_p" type="text" id="luas_p" size="2" value="<?php if(isset($luas_p)): echo $luas_p; endif; ?>" onkeypress='return checknumeric(event)'/> 
             x 
          <input name="luas_l" type="text" id="luas_l" size="2" value="<?php if(isset($luas_l)): echo $luas_l; endif; ?>" onkeypress='return checknumeric(event)' /> 
          Meter</td>
          <td width="122">Tingkat Kunjungan</td>
          <td width="164"><input name="tingkat_kunjungan" type="text" id="tingkat_kunjungan" size="8" value="<?php if(isset($tingkat_kunjungan)): echo $tingkat_kunjungan; endif; ?>" onkeypress='return checknumeric(event)' /></td>
        </tr>
        <tr>
          <td>Vol Parkir Mobil</td>
          <td><input name="vol_mobil" type="text" id="vol_mobil" size="5" value="<?php if(isset($vol_mobil)): echo $vol_mobil; endif; ?>" onkeypress='return checknumeric(event)' /></td>
          <td>Jml Pegawai</td>
          <td><input name="jml_pegawai" type="text" id="jml_pegawai" size="8" value="<?php if(isset($jml_pegawai)): echo $jml_pegawai; endif; ?>" onkeypress='return checknumeric(event)' /></td>
        </tr>
        <tr>
          <td>Vol Parkir Motor</td>
          <td><input name="vol_motor" type="text" id="vol_motor" size="5" value="<?php if(isset($vol_motor)): echo $vol_motor; endif; ?>" onkeypress='return checknumeric(event)' /></td>
          <td>Rata2 Omzet</td>
          <td><input name="rata2omzet" type="text" id="rata2omzet" size="8" value="<?php if(isset($rata2omzet)): echo $rata2omzet; endif; ?>" onkeypress='return checknumeric(event)' /></td>
        </tr>
        <tr>
          <td>Tarif</td>
          <td><input name="tarif" type="text" id="tarif" size="8" value="<?php if(isset($tarif)): echo $tarif; endif; ?>" onkeypress='return checknumeric(event)' /></td>
          <td>Keterangan</td>
          <td><input type="text" name="ket" id="ket" value="<?php if(isset($ketParkir)): echo $ketParkir; endif; ?>" /></td>
        </tr>
      </table>
</div>