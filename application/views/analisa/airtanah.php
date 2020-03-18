<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_airtanah where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$jml_titik_sumur = $rs->jml_titik_sumur;
	$dtTgl = $rs->created;
	$meteran = $rs->meteran;
	$tarif_air = $rs->tarif_air;
	$rata2pemakaian = $rs->rata2pemakaian;
	$jns_air = $rs->jns_air;
	$ket = $rs->ket;
	
	echo '<script>document.frmAns.jns_sumur.value = "'.$jns_air.'"</script>';
endif;
?>
<div id="C1" style="background-color: #B3D9F0; width:100%; height:100%;">
      <table width="644" border="0">
        <tr>
          <td><span style="padding-left:15px;">NO Transaksi</span></td>
          <td><input type="text" name="no_trxAirTanah" id="no_trxAirTanah" size="22" style="background-color:#FFFFCC;" value="<?php echo $strNoUrut;?>" readonly="readonly"/>
            <input type="hidden" name="txtUsername" id="txtUsername" value="<?php echo $username; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span style="padding-left:15px;">Tanggal</span></td>
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
          <td width="129">Jumlah Titik Sumur</td>
          <td width="174"><input type="text" name="titik_sumur" id="titik_sumur" value="<?php if(isset($jml_titik_sumur)): echo $jml_titik_sumur; endif; ?>" ></td>
          <td width="163">Rata-rata Pemakaian Air</td>
          <td width="160"><input type="text" name="rata2pemakaianAir" id="rata2pemakaianAir" value="<?php if(isset($rata2pemakaian)): echo $rata2pemakaian; endif; ?>"></td>
        </tr>
        <tr>
          <td>Meteran</td>
          <td><input type="text" name="meteran" id="meteran" value="<?php if(isset($meteran)): echo $meteran; endif; ?>"></td>
          <td>Air Dangkal / Dalam</td>
          <td><select name="jns_sumur" id="jns_sumur">
            <option value="DANGKAL">Dangkal</option>
            <option value="DALAM">Dalam</option>
          </select>          </td>
        </tr>
        <tr>
          <td>Tarif Air</td>
          <td><input type="text" name="tarif_air" id="tarif_air" value="<?php if(isset($tarif_air)): echo $tarif_air; endif; ?>"></td>
          <td>Keterangan</td>
          <td><input type="text" name="ket" id="ket" value="<?php if(isset($ket)): echo $ket; endif; ?>"></td>
        </tr>
      </table>
</div>