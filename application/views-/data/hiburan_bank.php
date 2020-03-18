
<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>

<!-- dhtmlxGrid -->
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgridcell.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid_filter.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_pgn.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_splt.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_group.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_pgn_bricks.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">

<!-- Ajax -->
<script src="<?php echo base_url(); ?>assets/codebase_ajax/dhtmlxcommon.js"></script>

<!-- Window -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/skins/dhtmlxwindows_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxcontainer.js"></script>
<script src="<?php echo base_url(); ?>/assets/window.js"></script>

<!-- Modal -->
<link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>

<!-- connector -->
<script src="<?php echo base_url(); ?>assets/codebase_connector/common/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/codebase_connector/connector.js" type="text/javascript" charset="utf-8"></script>

<!-- calendar begin-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>

<div style="height:100%; overflow:auto;">
<script language="javascript">

	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function lihat() {
		if(document.frmData.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.npwpd.focus();
			return;
		}
		
		var postStr =
		"npwpd=" + document.frmData.npwpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/hotel/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmData.nama_perusahaan.value = arr[0];
					document.frmData.alamat_perusahaan.value = arr[1];
					disableData();
				} else {
					alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function getLastDate(iThn, iBln1, iBln2, iTgl1, iTgl2){		
		var iThnVal		= document.getElementById(iThn).value;
		var iBln1Val	= document.getElementById(iBln1).value;		
		var iBln2Val	= document.getElementById(iBln2).value;
			
		if(iBln2Val<iBln1Val){
			iBln2Val = iBln1Val;
			document.getElementById(iBln2).value=iBln2Val;
		}
			
		var lastDate = new Date(iThnVal, iBln2Val, 0);
		var lastDateDay = lastDate.getDate();
			
		document.getElementById(iTgl1).value = '01/' + iBln1Val + '/' + iThnVal;
		document.getElementById(iTgl2).value = lastDateDay + '/' + iBln2Val + '/' + iThnVal;	
	}
	
	function simpan() {
		jml_bayar2 = ($('#jumlah').unmask());		
		if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmData.jumlah.focus();
			return;
		}
		
		if(document.frmData.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.npwpd.focus();
			return;
		}
		
		if(document.frmData.txttglmasapajak1.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.txttglmasapajak1.focus();
			return;
		}
		
		if(document.frmData.txttglmasapajak2.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		
		if(document.frmData.jnsSPT.checked==false) {
			alert("Jenis SPT Tidak Boleh Kosong");
			document.frmData.jnsSPT.focus();
			return;
		}
		
		if(document.frmData.sptpd_1.value==""){
			cek();
		} else {
			simpan2();
		}
	}
	
	function cek(){
		var postCek =
			"npwpd=" + document.frmData.npwpd.value +
			"&awal=" + document.frmData.txtblnmasapajak1.value +
			"&akhir=" + document.frmData.txtblnmasapajak2.value +
			"&tahun=" + document.frmData.txtthnmasapajak.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/restoran/ricek', postCek, resPOST);
	}
	
	function resPOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result!=0) {
					alert(result);
					statusEnding();
					return true;
				} else {
					simpan2();
					statusEnding();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function simpan2(){
		if(document.frmData.SPTR.checked==true) {
			jnsSPT = "REGULAR";
		}
		if(document.frmData.SPTI.checked==true) {
			jnsSPT = "INSIDENTIL";
		}
		if(document.frmData.SPTT.checked==true) {
			jnsSPT = "TUNGGAKAN";
		}
		
		if(document.frmData.sen1.checked==true) {
			sen = "TERMASUK PAJAK";
		}
		if(document.frmData.sen2.checked==true) {
			sen = "BELUM TERMASUK PAJAK";
		}
		arrTgl = document.frmData.tgl_terima.value.split("/");
		tglTerima = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		
		arrTgl_1 = document.frmData.txttglmasapajak1.value.split("/");
		tgl1 = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		arrTgl_2 = document.frmData.txttglmasapajak2.value.split("/");
		tgl2 = arrTgl_2[2]+"-"+arrTgl_2[1]+"-"+arrTgl_2[0];
		
		var postStr =
			"sptpd_1=" + document.frmData.sptpd_1.value +
			"&sptpd_2=" + document.frmData.sptpd_2.value +
			"&awal=" + document.frmData.txtblnmasapajak1.value +
			"&akhir=" + document.frmData.txtblnmasapajak2.value +
			"&tahun=" + document.frmData.txtthnmasapajak.value +
			"&npwpd=" + document.frmData.npwpd.value +
			"&nama=" + document.frmData.nama.value +
			"&alamat=" + document.frmData.alamat.value +
			"&cara=" + document.frmData.cara.value +
			"&tgl_terima=" + tglTerima +
			"&petugas=" + document.frmData.petugas.value +
			"&gol=" + document.frmData.gol.value +
			"&tgl1=" + tgl1 +
			"&tgl2=" + tgl2 +
			"&jumlah=" + document.frmData.jumlah.value +
			"&setoran=" + document.frmData.setoran.value +
			"&jnsSPT=" + jnsSPT +
			"&ket_pajak=" + sen +
			"&ket_insidentil=" + document.frmData.ket_insidentil.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/restoran/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			arr = result.split("/");
			document.frmData.sptpd_1.value = arr[0];
			document.frmData.sptpd_2.value = arr[1]+"/"+arr[2];
			//document.frmData.btnEdit.disabled = false;
			//document.frmData.btnDel.disabled = false;
			document.frmData.cetak.disabled = false;
			alert('Done');
			//loadData();
			statusEnding();
		});
	}
	
	function hapus() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				cnf = confirm("Apakah Anda Yakin ?")
				if(cnf) {
					var postStr =
						"sptpd_1=" + document.frmData.sptpd_1.value +
						"&sptpd_2=" + document.frmData.sptpd_2.value;
					dhtmlxAjax.post(base_url+'index.php/restoran/hapus', postStr, function(loader) {
						result = loader.xmlDoc.responseText;
						alert(result);
						gridData.clearAll();
						loadData();
					});
				}
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function disableData() {
		document.frmData.sptpd_1.disabled = true;
		document.frmData.sptpd_2.disabled = true;
		document.frmData.txtblnmasapajak1.disabled = true;
		document.frmData.txtblnmasapajak2.disabled = true;
		document.frmData.txtthnmasapajak.disabled = true;
		document.frmData.npwpd.disabled = true;
		document.frmData.btnCari.disabled = true;
		document.frmData.nama.disabled = true;
		document.frmData.alamat.disabled = true;
		document.frmData.cara.disabled = true;
		document.frmData.tgl_terima.disabled = true;
		document.frmData.petugas.disabled = true;
		document.frmData.gol.disabled = true;
		document.frmData.jumlah.disabled = true;
		document.frmData.btnCari.disabled = true;
		document.frmData.SPTR.disabled = true;
		document.frmData.SPTI.disabled = true;
		document.frmData.SPTT.disabled = true;
		document.frmData.ket_insidentil.disabled = true;
	}
	
	function enableData() {
		document.frmData.npwpd.disabled = false;
		document.frmData.btnCari.disabled = false;
		document.frmData.cara.disabled = false;
		document.frmData.tgl_terima.disabled = false;
		document.frmData.petugas.disabled = false;
		document.frmData.gol.disabled = false;
		document.frmData.jumlah.disabled = false;
		document.frmData.btnCari.disabled = false;
		document.frmData.SPTR.disabled = false;
		document.frmData.SPTI.disabled = false;
		document.frmData.SPTT.disabled = false;
		document.frmData.ket_insidentil.disabled = false;
	}
	
	function bersih() {
		document.frmData.sptpd.value = "";
		document.frmData.sptpd_1.value = "";
		document.frmData.sptpd_2.value = "";
		document.frmData.txtblnmasapajak1.value='';
		document.frmData.txtblnmasapajak2.value='';
		document.frmData.txttglmasapajak1.value='';
		document.frmData.txttglmasapajak2.value='';
		document.frmData.txtthnmasapajak.value='';
		document.frmData.npwpd.value = "";
		document.frmData.nama.value = "";
		document.frmData.alamat.value = "";
		document.frmData.cara.value = "";
		document.frmData.tgl_terima.value = "";
		document.frmData.petugas.value = "";
		document.frmData.gol.value = "";
		document.frmData.jumlah.value = "";
		document.frmData.setoran.value = "";
		document.frmData.SPTR.value = "";
		document.frmData.SPTI.value = "";
		document.frmData.SPTT.value = "";
		document.frmData.sen1.value = "";
		document.frmData.sen2.value = "";
		document.frmData.ket_insidentil.value = "";
	}
	
	function newEntry() {
		enableData();
		bersih();
		document.frmData.txtblnmasapajak1.disabled = false;
		document.frmData.txtblnmasapajak2.disabled = false;
		document.frmData.txtthnmasapajak.disabled = false;
		document.frmData.btnTambah.disabled = false;
		//document.frmData.btnEdit.disabled = true;
		//document.frmData.btnDel.disabled = true;
		document.frmData.cetak.disabled = true;
		document.frmData.jumlah.value = 0;
		document.frmData.setoran.value = 0;
	}
</script>
<style>
		body {
			background:#FFF;
		}
	</style>
	<h2 style="margin:30px 5px 25px 30px;">SPTPD Restoran ( Bank )</h2>

    <div id="a_tabbar" style="width:1000px; height:530px; margin-left:30px;"></div>
  				<div id="C1" style="background-color: #B3D9F0">
    <form name="frmData" id="frmData" action="<?php echo site_url(); ?>/iui/cetak_iui" method="post" onSubmit="popupform(this, 'iui')" >
    <br />
   	  <table width="888">
            <tr>
              <td style="padding-left:15px;">No. SPTPD</td>
              <td colspan="2"><input name="sptpd_1" disabled="disabled" type="text" id="sptpd_1" size="10" readonly style="background-color:#FFFFCC;"> 
                / 
                <input name="sptpd_2" disabled="disabled" type="text" id="sptpd_2" size="5" readonly style="background-color:#FFFFCC;"></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">Masa Pajak</td>
              <td width="319"><?php echo $ctl_masapajak1; ?> s/d <?php echo $ctl_masapajak2; ?></td>
            <td width="325" rowspan="3"><fieldset><legend>JENIS SPT</legend>
                <table width="200" border="0">
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTR" value="0" disabled></td>
                    <td>SPT Regular</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTI" value="0" disabled></td>
                    <td>Insidentil</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTT" value="0" disabled></td>
                    <td>Tunggakan</td>
                  </tr>
                </table>
              </fieldset></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">Tahun Pajak</td>
              <td><?php echo $ctl_tahunpajak; ?></td>
            </tr>
            <tr>
                <td width="228" style="padding-left:15px;">NPWPD Perusahaan</td>
                <td><input type="hidden" name="id" id="id" size="35" /><input type="hidden" name="sptpd" id="sptpd" size="35" />
                <input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase; background-color: #FFCC99;" disabled  />
                <input name="btnCari" type="button" id="btnCari" style="padding-left:20px; padding-right:20px" onClick="showWinBrg()" value="Cari" disabled /></td>
   		    </tr>
            <tr>
              <td style="padding-left:15px;">Nama Perusahaan</td>
              <td><input type="text" name="nama" id="nama" readonly style="background-color:#FFFFCC; text-transform:uppercase;" disabled="disabled"/></td>
              <td rowspan="3" valign="top">Keterangan Insidentil<br>
              <textarea name="ket_insidentil" id="ket_insidentil" cols="25" rows="2" disabled style="text-transform:uppercase;"></textarea></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">Alamat Perusahaan</td>
              <td><input type="text" name="alamat" id="alamat" readonly style="background-color:#FFFFCC; text-transform:uppercase;" disabled="disabled"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left:15px;">Cara perhitungan dan penetapan yang dikehendaki</td>
            </tr>
            <tr>
                <td style="padding-left:15px;" colspan="3"><select name="cara" id="cara" disabled>
                    <!--<option value="1">Official Assesment(Dihitung dan ditetapkan oleh Pejabat Dispenda)</option>-->
                    <option value="2">Self Assesment(Menghitung dan Menetapkan Pajak Sendiri)</option>
                </select><br /></td>
            </tr>
           	<tr>
           	  <td style="padding-left:15px;">Diterima Tanggal</td>
           	  <td colspan="2"><input name="tgl_terima" type="text" id="tgl_terima" size="8" disabled="disabled"></td>
   	    </tr>
           	<tr>
           	  <td style="padding-left:15px;">Petugas Input</td>
           	  <td colspan="2"><select name="petugas" id="petugas" disabled>
              <option value="<?php echo $userPetugas; ?>"><?php echo $namaPetugas; ?></option>
         	    </select>           	  </td>
   	    </tr>
           	<tr>
              	<td style="padding-left:15px;">Golongan Restoran</td>
                <td colspan="2"><select name="gol" id="gol" onChange="cgol()" disabled="disabled">
                <option value=""></option>
                <?php 
				foreach($gresto->result() as $rs) {
						echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Masa Pajak</td>
                <td colspan="2"><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12" readonly disabled/>&nbsp;
			 <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12" readonly disabled/></td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Dasar Pengenaan ( Omset )</td>
                <td colspan="2"><input type="text" name="jumlah" id="jumlah" size="22" onkeyup="hitung();" style="text-align:right" disabled/></td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Tarif Pajak</td>
                <td colspan="2"><input style="text-align:right" type="text" name="tarif" id="tarif" size="20" disabled/>&nbsp;%
                &nbsp;<input type="radio" name="sen" id="sen1" />Termasuk Pajak
                &nbsp;<input type="radio" name="sen" id="sen2" />Belum Termasuk Pajak</td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Pajak Terhutang</td>
                <td colspan="2"><input style="text-align:right" type="text" name="setoran" id="setoran" size="22" disabled/></td>
            </tr>
	<tr>
       	<td colspan="3" style="background-color:#FFCC99;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       	  <input type="button" name="btnnew" id="button" value="Baru" onClick="newEntry();" style="width:90px;">
   	    <input type="button" value="Simpan" onClick="simpan()" name="btnTambah" style="width:90px;" disabled/>
   	    <!--<input type="button" value="Edit" onClick="edit1()" name="btnEdit" disabled style="width:90px;" />
   	    <input type="button" value="Hapus" onClick="hapus()" name="btnDel" disabled style="width:90px;"/>-->
        <input type="button" value="Cetak" onclick="cetak1()" name="cetak" disabled style="width:90px;"/>
        <input type="button" value="SPTPD Kosong" onclick="kosong()" name="null" /></td>
        </tr>
</table>
</form>
<br />
</div>

<!--<div id="C2">
	<div id="gridData" width="100%" height="460px" style="background-color:white;"></div>
    <div id="pagingArea" width="349px" style="background-color:white;"></div>
</div>-->
</div>
<div id="objBrg" style="display:none;">
  <form name="frmSrc" method="post" action="javascript:void(0);"><table width="752" border="0">
  <tr>
    <td width="97">Parameter</td>
    <td width="216"><select name="parameter" id="parameter">
      <option value="no_npwpd">NPWPD Perusahaan</option>
      <option value="nama_perusahaan">Nama Perusahaan</option>
    </select>    </td>
    
    <td width="417" rowspan="2"><input type="button" name="button2" id="button2" value="CARI" style="height:50px; width:100px;" onClick="cariDataWP();">
      <input type="button" name="button3" id="button3" value="TUTUP" style="height:50px; width:100px;" onClick="closeBrg();"></td>
  </tr>
  <tr>
    	<td>Kata Kunci</td>
    	<td><input type="text" name="keyword" id="keyword"></td>
    </tr>
  <tr>
    <td colspan="3"><div id="tmpGridWP" width="100%" height="320px" style="background-color:white;"></div></td>
    </tr>
</table>
  </form>
</div>

<script language="javascript">	
	function cgol(){
		if(document.frmData.gol.value=="") {
			alert("Golongan Restoran Tidak Boleh Kosong");
			document.frmData.gol.focus();
			return;
		}
		var postGol =
			"gol=" + document.frmData.gol.value;
		
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/restoran/tarif', postGol, respJns);			
	}
	
	function respJns(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					document.frmData.tarif.value = result;
					document.frmData.sen2.checked = true;
				} else {
					alert("Silakan Pilih Jenis Kategori Tarif");
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}

	function kosong(){
		window.open('<?php echo site_url(); ?>/restoran_pdf', '', 'height=700,width=1000,scrollbars=yes');
	}
	
	$(function() {         
    	$('#jumlah').priceFormat({
        	prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
			centsLimit: 0
         });
		 $("#jumlah").keyup(function(){
			 hitung($('#jumlah').unmask());
		});
	});
	
	function hitung(jumlahDP){
		if(document.frmData.sen1.checked == true){
			//alert('1');
			if(jumlahDP=="0") { return; }
			if(jumlahDP=="") {
				nilaiDP = 0;
				document.frmData.jumlah.value = 0;
			} else {
				nilaiDP = parseInt(jumlahDP);	
			}
			total = (nilaiDP*document.frmData.tarif.value)/110;
			document.frmData.setoran.value = format_number(total);
		}
		
		if(document.frmData.sen2.checked == true){
			//alert('2');
			if(jumlahDP=="0") { return; }
			if(jumlahDP=="") {
				nilaiDP = 0;
				document.frmData.jumlah.value = 0;
			} else {
				nilaiDP = parseInt(jumlahDP);	
			}
			total = (nilaiDP*document.frmData.tarif.value)/100;
			document.frmData.setoran.value = format_number(total);
		}
	}
	
	function edit1(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				enableData();
				document.frmData.btnnew.disabled = false;
				document.frmData.btnTambah.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function cetak1() {
		var a = document.frmData.sptpd_1.value;
		var b = document.frmData.sptpd_2.value;
		var c = a+'/'+b;
		window.open('<?php echo site_url(); ?>/restoran/cetak?sptpd='+c, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	//tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	//tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl_terima');
	cal1.setDateFormat('%d/%m/%Y');
	
	function cmo() {
		document.frmData.akhir.value = document.frmData.awal.value;
		tgl1 = '01/'+document.frmData.awal.value+'/'+document.frmData.tahun.value;
		tgl2 = '31/'+document.frmData.akhir.value+'/'+document.frmData.tahun.value;
		document.frmData.tgl1.value = tgl1;
		document.frmData.tgl2.value = tgl2;
	}
	function cmp() {
		if(document.frmData.akhir.value < document.frmData.awal.value) {
			alert("Bulan tidak boleh kurang dari bulan Awal");
			document.frmData.akhir.value = document.frmData.awal.value;
			document.frmData.akhir.focus();
			return;	
		}
		tgl1 = '01/'+document.frmData.awal.value+'/'+document.frmData.tahun.value;
		tgl2 = '31/'+document.frmData.akhir.value+'/'+document.frmData.tahun.value;
		document.frmData.tgl1.value = tgl1;
		document.frmData.tgl2.value = tgl2;
	}
	
	wBrg = dhxWins.createWindow("wBrg",0,0,770,450);
	wBrg.setText("Daftar Barang");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function showWinBrg() {
		wBrg.show();
    	wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objBrg');
		//document.frmData.nmbarang.focus();
	}

	function closeBrg() {
		wBrg.hide();
		wBrg.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("NPWPD,Nama Badan Usaha,Alamat,Pemilik");
	gridWP.setInitWidths("120,200,200,180");
	gridWP.setColAlign("left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmData.npwpd.value = gridWP.cells(id,0).getValue();
		document.frmData.nama.value = gridWP.cells(id,1).getValue();
		document.frmData.alamat.value = gridWP.cells(id,2).getValue();
		closeBrg();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	
	function cariDataWP() {
	
		if(document.frmSrc.keyword.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc.keyword.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/restoran/cariDataWP/"+kata_kunci+"/"+document.frmSrc.parameter.value,function() {  statusEnding(); });
	}
	
	// Wajib Pajak
	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridData.setHeader("No.SPTPD,Masa Pajak,Masa Pajak,Tahun,NPWPD,Nama,Alamat,Tgl Terima,Petugas,Dasar Pengenaan,cara,masa1,masa2,jenis,insidentil,gol,setoran,tarif,ket pajak");
	gridData.setInitWidths("120,80,80,80,100,150,200,100,100,100,100,100,100,100,100,100,100,100,100");
	gridData.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ro,ro,ro,ro,ro,ron,ron,ro");
	gridData.setNumberFormat("0,000",9,",","."); 
	gridData.setNumberFormat("0,000",16,",","."); 
	gridData.attachEvent("onRowSelect", function(id) {
		disableData();
		document.frmData.SPTR.checked = false;
		document.frmData.SPTI.checked = false;
		document.frmData.SPTT.checked = false;
		// Nomor
		document.frmData.sptpd.value = gridData.cells(id,0).getValue();
		arr = gridData.cells(id,0).getValue().split("/");
		document.frmData.sptpd_1.value = arr[0];
		document.frmData.sptpd_2.value = arr[1]+"/"+arr[2];
		// Tanggal 1
		var awal = gridData.cells(id,1).getValue().split('/');
		document.frmData.txtblnmasapajak1.value = awal[1];
		var akhir = gridData.cells(id,2).getValue().split('/');
		document.frmData.txtblnmasapajak2.value = akhir[1];
		document.frmData.txtthnmasapajak.value = gridData.cells(id,3).getValue();
		document.frmData.npwpd.value = gridData.cells(id,4).getValue();
		document.frmData.nama.value = gridData.cells(id,5).getValue();
		document.frmData.alamat.value = gridData.cells(id,6).getValue();
		document.frmData.cara.value = gridData.cells(id,10).getValue();
		document.frmData.tgl_terima.value = gridData.cells(id,7).getValue();
		document.frmData.petugas.value = gridData.cells(id,8).getValue();
		document.frmData.gol.value = gridData.cells(id,15).getValue();
		document.frmData.txttglmasapajak1.value = gridData.cells(id,1).getValue();
		document.frmData.txttglmasapajak2.value = gridData.cells(id,2).getValue();
		document.frmData.jumlah.value = format_number(gridData.cells(id,16).getValue());
		if(gridData.cells(id,13).getValue() == 'REGULAR') {
			document.frmData.SPTR.checked = true;
		} else if(gridData.cells(id,13).getValue()=='INSIDENTIL') {
			document.frmData.SPTI.checked = true;
		} else if(gridData.cells(id,13).getValue()=='TUNGGAKAN') {
			document.frmData.SPTT.checked = true;
		}
		document.frmData.ket_insidentil.value = gridData.cells(id,14).getValue();
		document.frmData.setoran.value = format_number(gridData.cells(id,9).getValue());
		document.frmData.tarif.value = format_number(gridData.cells(id,17).getValue());
		if(gridData.cells(id,18).getValue() == 'TERMASUK PAJAK') {
			document.frmData.sen1.checked = true;
		} else if(gridData.cells(id,18).getValue()=='BELUM TERMASUK PAJAK') {
			document.frmData.sen2.checked = true;
		}
		document.frmData.btnnew.disabled = true;
		document.frmData.btnTambah.disabled = true;
		//document.frmData.btnEdit.disabled = false;
		//document.frmData.btnDel.disabled = false;
		document.frmData.cetak.disabled = false;
		tabbar.setTabActive("a1");
	});
	gridData.enableSmartRendering(true);
	gridData.enablePaging(true,25,10,"pagingArea",true);
	gridData.setPagingSkin("bricks");
	gridData.setSkin("dhx_skyblue");
	gridData.init();
	
	loadData();
	
	function loadData() {
		gridData.loadXML(base_url+"index.php/restoran/mainData_bank",function() { statusEnding(); });
	}
	statusEnding();
</script>
</div>