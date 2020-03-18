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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
<script src="<?php echo base_url(); ?>assets/rumus.js" type="text/javascript"></script>

<div style="height:100%; overflow:auto;">
  <script language="javascript">
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function lihat() {
		if(document.frmTegur.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmTegur.npwpd.focus();
			return;
		}
		
		var postStr =
		"npwpd=" + document.frmTegur.npwpd.value;
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
					document.frmTegur.nama_perusahaan.value = arr[0];
					document.frmTegur.alamat_perusahaan.value = arr[1];
					disableData();
				} else {
					alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function simpan() {
		
		if(document.frmTegur.tgl_sk.value=="") {
			document.frmTegur.tgl_sk.focus();
			alert("Tanggal SK Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmTegur.jml.value=="") {
			document.frmTegur.jml.focus();
			alert("Jumlah Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmTegur.denda.value=="") {
			document.frmTegur.denda.focus();
			alert("Denda Tidak Boleh Kosong");
			return;
		}
		
		sk = document.frmTegur.tgl_sk.value.split("/");
		tgl_sk = sk[2]+"-"+sk[1]+"-"+sk[0];
		
		
		arrTgl = document.frmTegur.tempo.value.split("/");
		tgl_jth_tempo = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		
		arrTgl_1 = document.frmTegur.tgl.value.split("/");
		tgl = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		
		var postStr =
			"tegur=" + document.frmTegur.no_teguran.value +
			"&id=" + document.frmTegur.id.value +
			"&tgl=" + tgl +
			"&ds=" + document.frmTegur.ds.value +
			"&npwpd=" + document.frmTegur.npwpd.value +
			"&nomor=" + document.frmTegur.nomor.value +
			"&tgl_sk=" + tgl_sk +
			"&tempo=" + tgl_jth_tempo +
			"&jumlah=" + document.frmTegur.jml.value +
			"&denda=" + document.frmTegur.denda.value +
			"&total=" + document.frmTegur.total.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/tegur_skpd/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			document.frmTegur.no_teguran.value = result;
			ref();
			disableData();
			alert('Done');
			statusEnding();
		});
	}
	
	function hapus() {
		cnf = confirm("Apakah Anda Yakin ?")
		if(cnf) {
			var postStr =
				"tegur=" + document.frmTegur.no_teguran.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/skpd/hapus', postStr, responeDel);	
		}
	}
	
	function responeDel(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					bersih();
					statusEnding();
					alert('Done');
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function disableData() {
		document.frmTegur.no_teguran.disabled = true;
		document.frmTegur.tgl.disabled = true;
		document.frmTegur.ds.disabled = true;
		document.frmTegur.nomor.disabled = true;
		document.frmTegur.tgl_sk.disabled = true;
		document.frmTegur.nama.disabled = true;
		document.frmTegur.npwpd.disabled = true;
		document.frmTegur.alamat.disabled = true;
		document.frmTegur.tempo.disabled = true;
		document.frmTegur.jml.disabled = true;
		document.frmTegur.denda.disabled = true;
		document.frmTegur.total.disabled = true;
	}
	
	function enableData() {
		document.frmTegur.no_teguran.disabled = false;
		document.frmTegur.tgl.disabled = false;
		document.frmTegur.ds.disabled = false;
		document.frmTegur.tgl_sk.disabled = false;
		document.frmTegur.nama.disabled = false;
		document.frmTegur.npwpd.disabled = false;
		document.frmTegur.alamat.disabled = false;
		document.frmTegur.tempo.disabled = false;
		document.frmTegur.jml.disabled = false;
		document.frmTegur.denda.disabled = false;
		document.frmTegur.total.disabled = false;
		
	}
	
	function bersih() {
		document.frmTegur.no_teguran.value = "";
		document.frmTegur.id.value = "";
		document.frmTegur.tgl.value = "";
		document.frmTegur.ds.value = "";
		document.frmTegur.nomor.value = "";
		document.frmTegur.npwpd.value = "";
		document.frmTegur.tgl_sk.value = "";
		document.frmTegur.nama.value = " ";
		document.frmTegur.alamat.value = "";
		document.frmTegur.tempo.value = "";
		document.frmTegur.jml.value = "";
		document.frmTegur.denda.value = "";
		document.frmTegur.total.value = "";
	}
	
	function newEntry() {
		enableData();
		bersih();
		document.frmTegur.ds.focus();
	}
	
	function pilih(){
		document.frmTegur.nomor.disabled = false;
		document.frmTegur.nomor.focus();
	}
</script>
<style>
body{
	background: #FFF;
}
</style>
<div style="height:100%; overflow:auto;">

  <h2 style="margin:30px 5px 25px 30px;">Surat Teguran</h2>
  <div id="a_tabbar" style="width:1000px; height:335px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmTegur" id="frmTegur" action="#" method="post" >
    <br /><input type="hidden" name="id" id="id" />
     	<table width="888" cellspacing="0">
        <tr>
        	<td style="padding-left:15px;">No. Teguran</td>
          	<td><input name="no_teguran" type="text" id="no_teguran" size="35" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly"/></td>
          	<td width="87" style="padding-left:15px;">Tanggal</td>
          	<td width="255"><input name="tgl" type="text" id="tgl" disabled="disabled" style="background-color:#FFFFFF"/></td>
        </tr>
        <tr>
          	<td style="padding-left:15px;">Dasar Setoran</td>
          	<td width="355">
		  		<select id="ds" name="ds" onchange="pilih()" disabled="disabled"  style="text-transform:uppercase; background-color: #FFCC99;">
					<option value=" "></option>
					<option value="1">SKPD</option>
					<option value="2">STPD</option>
					<option value="3">SKPDKBT</option>
					<option value="4">SKPDKB</option>
				</select>
		  	</td>
          	<td style="padding-left:15px;">Nomor</td>
          	<td><input type="text" name="nomor" id="nomor" disabled="disabled" style="background-color:#FFFFFF"/>
          	<input type="button" name="cari" id="cari" value="Cari" style="width:90px;" onclick="showWinBrg()" /></td>
        	</tr>
        	<tr>
          		<td width="181" style="padding-left:15px;" align="right"><div align="left">NPWPD</div></td>
          		<td><input type="text" name="npwpd" id="npwpd" size="35"  disabled="disabled" style="background-color:#FFFFCC"/></td>
			   <td style="padding-left:15px;">Tanggal SK</td>
			   <td><input type="text" name="tgl_sk" disabled="disabled" style="background-color:#FFFFFF" id="tgl_sk"></td>
        	</tr>
			<tr>
				<td style="padding-left:15px;">Nama</td>
				<td><input name="nama" type="text" disabled="disabled" id="nama"  style="background-color:#FFFFFF" size="35"/></td>
				<td colspan="2" valign="top"><br /></td>
			</tr>
        	<tr>
          		<td style="padding-left:15px;">Alamat</td>
          		<td><input name="alamat" type="text" disabled="disabled" id="nama2"  style="background-color:#FFFFFF" size="35"/></td>
          		<td colspan="2" valign="top">&nbsp;</td>
        	</tr>
        	<tr>
          		<td style="padding-left:15px;">Tanggal Jatuh Tempo</td> 
          		<td colspan="3">
					<input name="tempo" type="text" id="tempo" size="15" disabled="disabled" style="background-color:#FFFFFF">
				</td>
        	</tr>
        	<tr>
        	  <td style="padding-left:15px;">Jumlah</td>
        	  <td><input type="text" name="jml" id="jml" disabled="disabled" style="background-color:#FFFFCC" onblur="jumlah()" /></td>
				<td style="padding-left:15px;">&nbsp;</td>
				<td>&nbsp;</td>
        	</tr>
			<tr>
			  <td style="padding-left:15px;">Denda</td>
			  <td><input type="text" name="denda" id="denda" onkeyup="jumlah()" style="background-color:#FFFFCC" /></td>
				<td style="padding-left:15px;">&nbsp;</td>
				<td>&nbsp;</td>
        	</tr>
			<tr>
			  <td style="padding-left:15px;">Total</td>
			  <td><input name="total" type="text" disabled="disabled" id="total" style="background-color:#FFFFCC" readonly="readonly"/></td>
				<td style="padding-left:15px;">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
			<tr>
          		<td colspan="4" style="padding-left:15px;">
					<input type="button" name="button" id="button" value="Baru" onclick="newEntry()" style="width:90px;" />
					<input type="button" value="Simpan" onclick="simpan()" name="btnTambah" style="width:90px;" />
					<input type="button" value="Hapus" onclick="hapus()" name="btnDel" id="btnDel" disabled="disabled" style="width:90px;"/>          
			  	</td>
        	</tr>
      </table>
    </form>
    <br />
  	</div>
  
	<div id="C2" style="background-color: #B3D9F0">
  		<div id="dark" width="100%" height="300px" style="background-color:white;"></div>
  	</div>
    </div>
  	<div id="objSKPD" style="display:none;">
	<form name="frmSrc5" id="frmSrc5" method="post" action="javascript:void(0);">	<br />
		<table width="790" border="0">
		<tr>
			<td style="padding-left:15px;">Cari data berdasarkan 
			<select name="parameter" id="parameter" >
				<option value="npwpd">No. NPWPD</option>
				<option value="no_nota">Nota Hitung</option>
			</select></td>
			<td><input type="text" name="kataKunci" id="kataKunci" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
			<td><input type="button" onclick="cariSKPD()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
			<input type="button" onclick="closeSKPD()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
		</tr>
		</table>
	</form>
	<div style="padding:0 75px 0 15px;">
		<div id="tmpGridWP" width="750px" height="270px" style="margin-bottom:10px;"></div>
	</div>
	</div> 
  <script language="javascript">
  	gridxx = new dhtmlXGridObject('dark');
	gridxx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridxx.setHeader("id_surat_tegur, no_teguran, tgl_surat, no_skpd, npwpd, nama_perusahaan, alamat_perusahaan, dasar_setoran, tgl_sk, tahun, tgl_jatuh_tempo,jumlah,denda,total");
	gridxx.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridxx.setColAlign("left,left,left,left,left,left,left,right,right,left,left,right,left,left");
	gridxx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ro,ro,ron,ron,ron");
	//grid.setNumberFormat("0,000",7,",",".");
	//grid.setNumberFormat("0,000",8,",",".");
	gridxx.enableMultiselect(true);
	gridxx.enableSmartRendering(true);
	gridxx.attachEvent("onRowDblClicked", function(id) {
		document.frmTegur.id.value = gridxx.cells(id,0).getValue();
		document.frmTegur.no_teguran.value = gridxx.cells(id,1).getValue();
		document.frmTegur.tgl.value = gridxx.cells(id,2).getValue();
		document.frmTegur.ds.value = gridxx.cells(id,7).getValue();
		document.frmTegur.nomor.value = gridxx.cells(id,3).getValue();
		document.frmTegur.tgl_sk.value = gridxx.cells(id,8).getValue();
		document.frmTegur.npwpd.value = gridxx.cells(id,4).getValue();
		document.frmTegur.nama.value = gridxx.cells(id,5).getValue();
		document.frmTegur.alamat.value = gridxx.cells(id,6).getValue();
		document.frmTegur.tempo.value = gridxx.cells(id,10).getValue();
		document.frmTegur.jml.value = gridxx.cells(id,11).getValue();
		document.frmTegur.denda.value = gridxx.cells(id,12).getValue();
		document.frmTegur.total.value = gridxx.cells(id,13).getValue();
		tabbar.setTabActive("a1");
		enableData();
	});
	gridxx.setSkin("dhx_skyblue");
	gridxx.loadXML("<?php echo site_url(); ?>/tegur_skpd/loadData");
	gridxx.init();
  
  function ref(){
	  gridxx.clearAll()
  	gridxx.loadXML("<?php echo site_url(); ?>/tegur_skpd/loadData");
  }
  
  function jumlah(){
	  var jumlah = document.frmTegur.jml.value;
	  var denda = document.frmTegur.denda.value;
  	document.frmTegur.total.value = parseInt(jumlah)+parseInt(denda);
  }
  	function cariSKPD() {
		if(document.frmTegur.ds.value=="") {
			alert("Dasar Setoran Tidak Boleh Kosong");
			closeSKPD();
			document.frmTegur.ds.focus();
			return;
		}
		
		if(document.frmSrc5.kataKunci.value=="") {
			alert("Pencarian data Tidak Boleh Kosong");
			closeSKPD();
			document.frmSrc5.kataKunci.focus();
			return;
		}
		
		var kunci = document.frmSrc5.kataKunci.value;
		var ds = document.frmTegur.ds.value;
		var key = document.frmSrc5.parameter.value;
		
		//if(document.frmSrc5.kataKunci.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc5.kataKunci.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/tegur_skpd/cariData/"+ds+"/"+kunci+"/"+key,function() {  statusEnding(); });
	}
  
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl_sk');
	cal1.setDateFormat('%d/%m/%Y');
	
	
	function enabledButton(){
		document.frmTegur.btnDel.disabled = false;
		document.frmTegur.cetak.disabled = false;
	}
	
	wSKPD = dhxWins.createWindow("wSKPD",0,0,800,400);
	wSKPD.setText("Pencarian Data");
	wSKPD.button("park").hide();
	wSKPD.button("close").hide();
	wSKPD.button("minmax1").hide();
	wSKPD.hide();

	function showWinBrg() {
		wSKPD.show();
    	wSKPD.setModal(true);
		wSKPD.center();
		wSKPD.attachObject('objSKPD');
		//document.frmTegur.nmbarang.focus();
	}

	function closeSKPD() {
		wSKPD.hide();
		wSKPD.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("nomor, no_nota, npwpd, nama_perusahaan, alamat_perusahaan, tgl_jatuh_tempo, jumlah");
	gridWP.setInitWidths("120,120,120,200,200,180, jumlah");
	gridWP.setColAlign("left,left,left,left,left,left, left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmTegur.nomor.value = gridWP.cells(id,0).getValue();
		document.frmTegur.nama.value = gridWP.cells(id,3).getValue();
		document.frmTegur.alamat.value = gridWP.cells(id,4).getValue();
		document.frmTegur.npwpd.value = gridWP.cells(id,2).getValue();
		document.frmTegur.jml.value = gridWP.cells(id,6).getValue();
		loadItem();
		closeSKPD();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	
	function loadItem(){
		var poStr1 =
		"nomor=" + document.frmTegur.nomor.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/tegur_skpd/dataItemPajak1', poStr1, respePe);			
	}
	
	function respePe(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split(';');
					document.frmTegur.tgl.value = arr[0];
					document.frmTegur.tempo.value = arr[1];
				}
			}
		}
	}
	
	// Grid Data
	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridData.setHeader("Nomor,Kode Rekening,Nama Rekening,Jumlah");
	gridData.setInitWidths("120,120,80,80");
	gridData.setColAlign("left,left,right,right");
	gridData.setColTypes("ro,ro,ron,ron");
	gridData.setNumberFormat("0,000",3,",",".");
	gridData.enableMultiselect(true);
	gridData.enableSmartRendering(true);
	gridData.setSkin("dhx_skyblue");	
	gridData.init();

	statusEnding();
</script>
</div>
