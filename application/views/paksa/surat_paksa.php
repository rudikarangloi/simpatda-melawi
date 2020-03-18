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
	
	function simpan() {
		
		if(document.frmPaksa.tgl.value=="") {
			document.frmPaksa.tgl.focus();
			alert("Tanggal Tidak Boleh Kosong");
			return;
		}
		
		arrTgl = document.frmPaksa.tgl_st.value.split("/");
		tgl_st = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		
		arrTgl_1 = document.frmPaksa.tgl.value.split("/");
		tgl = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		
		var postStr =
			"nomor=" + document.frmPaksa.nom.value +
		"&tgl=" + tgl +
		"&no_teguran=" + document.frmPaksa.no_teguran.value +
		"&tgl_st=" + tgl_st +
		"&no_sk=" + document.frmPaksa.no_sk.value +
		"&npwpd=" + document.frmPaksa.npwpd.value +
		"&penerima=" + document.frmPaksa.penerima.value +
		"&alamat2=" + document.frmPaksa.alamat2.value +
		"&biaya=" + document.frmPaksa.biaya_juru_sita.value +
		"&cost=" + document.frmPaksa.cost_perjalanan.value +
		"&ket=" + document.frmPaksa.ket.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/surat_paksa/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			document.frmPaksa.nomor.value = result;
			disabledData();
			alert('Done');
			statusEnding();
		});
	}
	
	function hapus() {
		cnf = confirm("Apakah Anda Yakin ?")
		if(cnf) {
			var postStr =
				"skpd_1=" + document.frmPaksa.skpd_1.value +
				"&skpd_2=" + document.frmPaksa.skpd_2.value;
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
					gridData.clearAll();
					loadData();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function disabledData() {
		document.frmPaksa.nom.disabled = true;
		document.frmPaksa.tgl.disabled = true;
		document.frmPaksa.no_teguran.disabled = true;
		document.frmPaksa.tgl_st.disabled = true;
		document.frmPaksa.no_sk.disabled = true;
		document.frmPaksa.pemilik.disabled = true;
		document.frmPaksa.perusahaan.disabled = true;
		document.frmPaksa.npwpd.disabled = true;
		document.frmPaksa.alamat.disabled = true;
		document.frmPaksa.penerima.disabled = true;
		document.frmPaksa.alamat2.disabled = true;
		document.frmPaksa.biaya_juru_sita.disabled = true;
		document.frmPaksa.cost_perjalanan.disabled = true;
		document.frmPaksa.ket.disabled = true;
	}
	
	function enabledData() {
		document.frmPaksa.nom.disabled = false;
		document.frmPaksa.tgl.disabled = false;
		document.frmPaksa.no_teguran.disabled = false;
		document.frmPaksa.tgl_st.disabled = false;
		document.frmPaksa.no_sk.disabled = false;
		document.frmPaksa.pemilik.disabled = false;
		document.frmPaksa.perusahaan.disabled = false;
		document.frmPaksa.npwpd.disabled = false;
		document.frmPaksa.alamat.disabled = false;
		document.frmPaksa.penerima.disabled = false;
		document.frmPaksa.alamat2.disabled = false;
		document.frmPaksa.biaya_juru_sita.disabled = false;
		document.frmPaksa.cost_perjalanan.disabled = false;
		document.frmPaksa.ket.disabled = false;
	}
	
	function bersih() {
		document.frmPaksa.id.value = "";
		document.frmPaksa.nom.value = "";
		document.frmPaksa.tgl.value = "";
		document.frmPaksa.no_teguran.value = "";
		document.frmPaksa.tgl_st.value = "";
		document.frmPaksa.no_sk.value = "";
		document.frmPaksa.pemilik.value = "";
		document.frmPaksa.perusahaan.value = "";
		document.frmPaksa.npwpd.value = "";
		document.frmPaksa.alamat.value = "";
		document.frmPaksa.penerima.value = "";
		document.frmPaksa.alamat2.value = "";
		document.frmPaksa.biaya_juru_sita.value = "";
		document.frmPaksa.cost_perjalanan.value = "";
		document.frmPaksa.ket.value = "";
	}
	
	function newEntry() {
		enabledData();
		bersih();
		document.frmPaksa.cari.disabled = false;
		document.frmPaksa.no_teguran.focus();
	}
</script>
<style>
body{
	background:#FFF;
}
</style>
<div style="height:100%; overflow:auto;">

  <h2 style="margin:30px 5px 25px 30px;">Surat Paksa</h2>
  <div id="a_tabbar" style="width:1000px; height:335px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0"><br />
    <form name="frmPaksa" id="frmPaksa" action="#" method="post" >
    <input type="hidden" id="id" name="id" />
     	<table width="888" cellspacing="0">
        <tr>
        	<td style="padding-left:15px;">Nomor</td>
          	<td><input type="text" name="nom" id="nom" disabled="disabled" style="background-color:#FFFFCC;" /></td>
          	<td width="183" style="padding-left:15px;">Tanggal</td>
          	<td width="263"><input type="text" name="tgl" disabled="disabled" style="background-color:#FFFFFF" size="26" id="tgl"></td>
        </tr>
		 <tr>
          	<td style="padding-left:15px;">No Surat Teguran</td>
       	   <td width="275"><input name="no_teguran" type="text" id="nomor" size="26" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly"/>&nbsp;&nbsp;&nbsp;
           <input type="button" value="Cari" disabled="disabled" style="padding-left:20px; padding-right:20px" name="cari" onclick="opens()" id="cari"></td>
          	<td></td>
          	<td></td>
        </tr>
        <tr>
          	<td width="157" style="padding-left:15px;">Tanggal ST</td>
          	<td><input type="text" name="tanggal_st" size="26" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly" id="tgl_st"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td width="183" style="padding-left:15px;">No SK</td>
			<td><input name="no_sk" type="text" disabled="disabled" id="no_sk" style="background-color:#FFFFCC" size="30" /></td>
        </tr>
		<tr>
				<td style="padding-left:15px;">Nama Pemilik</td>
				<td><input type="text" name="pemilik" id="pemilik" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly" size="40"/></td>
				<td style="padding-left:15px;">NPWPD</td>
          		<td><input type="text" name="npwpd" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly" size="40" id="npwpd"></td>
			</tr>
        	<tr>
          		<td style="padding-left:15px;">Nama Perusahaan</td>
          		<td><input name="perusahaan" type="text" id="perusahaan" style="background-color:#FFFFCC; text-transform:uppercase;" size="40" disabled="disabled" readonly="readonly"/></td>
          		<td style="padding-left:15px;">Alamat</td>
          		<td><input type="text" name="alamat" disabled="disabled" style="background-color:#FFFFCC" readonly="readonly" size="40" id="alamat"></td>
        	</tr>
        	<tr>
          		<td style="padding-left:15px;">Diserahkan kepada</td>
          		<td><input type="text" name="penerima" disabled="disabled" style="background-color:#FFFFCC" size="40" id="penerima"></td>
                <td style="padding-left:15px;">Biaya harian juru sita</td>
          		<td><input type="text" name="biaya_juru_sita" disabled="disabled" style="background-color:#FFFFFF" size="26" id="biaya_juru_sita"></td>
        	</tr>
			<tr>
          		<td style="padding-left:15px;">Alamat</td>
          		<td><input type="text" name="alamat2" disabled="disabled" style="background-color:#FFFFCC" size="40" id="alamat2"></td>
                <td style="padding-left:15px;">Biaya perjalanan</td>
          		<td><input type="text" name="cost_perjalanan" disabled="disabled" style="background-color:#FFFFFF" size="26" id="cost_perjalanan"></td>
        	</tr>
			<tr>
          		<td style="padding-left:15px;">keterangan</td>
          		<td colspan="3"><textarea name="ket" cols="40" rows="3" disabled="disabled" style="background-color:#FFFFFF" id="ket"></textarea></td>
        	</tr>
			<tr>
          		<td colspan="4" style="padding-left:15px;">
					<input type="button" name="button" id="button" value="Baru" onclick="newEntry()" style="width:90px;" />
					<input type="button" value="Simpan" onclick="simpan()" name="btnTambah" style="width:90px;" />
					<input type="button" value="Hapus" onclick="hapus()" name="btnDel" id="btnDel" disabled="disabled" style="width:90px;"/>
					       
			  	</td>
        	</tr>
      </table>
      <br />
    </form>
  	</div>
	<div id="C2" style="background-color: #B3D9F0">
  		<div id="tmpGrid" width="960px" height="400px" style="background-color:white;"></div>
  	</div>
  	<div id="objSKPD" style="display:none;">
	<form name="frmSrc5" id="frmSrc5" method="post" action="javascript:void(0);">
		<table width="790" border="0">
		<tr>
			<td style="padding-left:15px;">Cari data berdasarkan 
			<select name="parameter" id="parameter" >
				<option value="no_teguran">No. Surat Teguran</option>
				<option value="npwpd">NPWPD</option>
			</select></td>
			<td><input type="text" name="kataKunci" id="kataKunci" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
			<td><input type="button" onclick="cariSKPD()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
			<input type="button" onclick="closeSKPD()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
		</tr>
		</table>
	</form>
	<br />
	<div style="padding:0 75px 0 15px;">
		<div id="tmpGridWP" width="750px" height="270px" style="margin-bottom:10px;"></div>
	</div>
	</div> 
  <script language="javascript">
  function cariSKPD() {
		
		if(document.frmSrc5.kataKunci.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc5.kataKunci.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/surat_paksa/cariData/"+kata_kunci+"/"+document.frmSrc5.parameter.value,function() {  statusEnding(); });
	}
  
  // Wajib Pajak
	grid = new dhtmlXGridObject('tmpGrid');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id_surat_paksa, nomor, tanggal, no_surat_tegur, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, tanggal_st, no_sk, penerima, alamat_penerima,biaya_harian,biaya_perjalanan,keterangan");
	grid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("left,left,left,left,left,left,left,right,right,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ro,ro,ro,ro,ro,ro,ro");
	//grid.setNumberFormat("0,000",7,",",".");
	//grid.setNumberFormat("0,000",8,",",".");
	grid.loadXML("<?php echo site_url(); ?>/surat_paksa/loadData");
	grid.enableMultiselect(true);
	grid.enableSmartRendering(true);
	grid.attachEvent("onRowDblClicked", function(id) {
		tabbar.setTabActive("a1");
		document.frmPaksa.id.value = grid.cells(id,0).getValue();
		document.frmPaksa.nom.value = grid.cells(id,1).getValue();
		document.frmPaksa.tgl.value = grid.cells(id,2).getValue();
		document.frmPaksa.no_teguran.value = grid.cells(id,3).getValue();
		document.frmPaksa.tgl_st.value = grid.cells(id,9).getValue();
		document.frmPaksa.no_sk.value = grid.cells(id,10).getValue();
		document.frmPaksa.pemilik.value = grid.cells(id,7).getValue();
		document.frmPaksa.perusahaan.value = grid.cells(id,5).getValue();
		document.frmPaksa.npwpd.value = grid.cells(id,4).getValue();
		document.frmPaksa.alamat.value = grid.cells(id,6).getValue();
		document.frmPaksa.penerima.value = grid.cells(id,11).getValue();
		document.frmPaksa.alamat2.value = grid.cells(id,12).getValue();
		document.frmPaksa.biaya_juru_sita.value = grid.cells(id,13).getValue();
		document.frmPaksa.cost_perjalanan.value = grid.cells(id,14).getValue();
		document.frmPaksa.ket.value = grid.cells(id,15).getValue();
		//enabledButton();
		enabledData();
	});
	grid.init();
	grid.setSkin("dhx_skyblue");
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	wSKPD = dhxWins.createWindow("wSKPD",0,0,850,400);
	wSKPD.setText("Pencarian Data Nota Hitung");
	wSKPD.button("park").hide();
	wSKPD.button("close").hide();
	wSKPD.button("minmax1").hide();
	wSKPD.hide();

	function opens() {
		wSKPD.show();
    	wSKPD.setModal(true);
		wSKPD.center();
		wSKPD.attachObject('objSKPD');
		//document.skpdn.nmbarang.focus();
	}

	function closeSKPD() {
		wSKPD.hide();
		wSKPD.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("No.Teguran,tanggal,NPWPD,Nama Perusahaan, Alamat Perusahaan, Nama Pemilik, Alamat Pemilik");
	gridWP.setInitWidths("120,120,120,200,200,180,180");
	gridWP.setColAlign("left,left,left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmPaksa.no_teguran.value = gridWP.cells(id,0).getValue();
		document.frmPaksa.tgl_st.value = gridWP.cells(id,1).getValue();
		document.frmPaksa.pemilik.value = gridWP.cells(id,5).getValue();
		document.frmPaksa.perusahaan.value = gridWP.cells(id,3).getValue();
		document.frmPaksa.npwpd.value = gridWP.cells(id,2).getValue();
		document.frmPaksa.alamat.value = gridWP.cells(id,4).getValue();
		closeSKPD();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	
	statusEnding();
</script>
</div>
