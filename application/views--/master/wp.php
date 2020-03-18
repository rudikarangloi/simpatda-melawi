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

<script type="text/javascript">
	function simpan2(){
		if(document.wp.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.wp.npwpd.focus();
			return;
		}
		if(document.wp.username.value=="") {
			alert("Username Tidak Boleh Kosong");
			document.wp.username.focus();
			return;
		}
		if(document.wp.pass2.value==""){
			if(document.wp.password.value=="") {
				alert("Password Tidak Boleh Kosong");
				document.wp.password.focus();
				return;
			}
		}
		
		var postStr =
			"id=" + document.wp.id.value +
			"&user=" + document.wp.username.value +
			"&pass=" + document.wp.password.value +
			"&pass2=" + document.wp.pass2.value +
			"&npwpd=" + document.wp.npwpd.value;
			
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/master/simpan_wp', postStr, responePOST2);
	}
	
	function responePOST2(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					refreshData2();
					statusEnding();	
					alert("Done");
					return true;	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
</script>
<style>
	body{
	    background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);
	}
</style>
<h2 style="margin:30px 5px 25px 30px;">Master Wajib Pajak</h2>

<div id="a_tabbar" style="width:1070px; height:100px; margin-left:30px"></div>
  <div id="C1" style="background-color: #B3D9F0;">
	<br/>
    <form name="wp" id="wp" action="<?php echo site_url(); ?>master/simpan_user" method="post">
    	<table>
    		<tr style="padding-top:10px;">
    			<td width="150" style="padding-left:15px;">NPWPD</td>
                <td><input type="text" name="npwpd" id="npwpd" size="25" disabled/>&nbsp;
                <input type="button" onClick="openData()" name="opens" id="opens" value="Cari" disabled></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">Username</td>
                <td><input type="hidden" name="id" id="id" size="35" />
                <input type="text" name="username" id="username" size="35" disabled/></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">Password</td>
                <td><input type="password" name="password" id="password" size="35" disabled/>
                <input type="hidden" name="pass2" id="pass2" size="35" disabled/></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">Nama Perusahaan</td>
                <td><input type="text" name="perusahaan" id="perusahaan" size="35" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">Nama Pemilik</td>
                <td><input type="text" name="pemilik" id="pemilik" size="35" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">No. Handphone</td>
                <td><input type="text" name="hp" id="hp" size="35" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;background-color:#FFCC99;""><input type="button" value="Baru" onclick="baru()" name="new" style="padding-left:20px; padding-right:20px"/></td>
                <td style="background-color:#FFCC99;"><input type="button" value="Simpan" onclick="simpan2()" name="tambah2" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="Hapus" onclick="deleteData2()" name="delete2" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
    	</table>
</form>
<br />
</div>

<div id="C2" style="background-color: #FFF;">
<div style="padding:0 0px 10px 0px;">
   	<div id="gridContent2" width="1070px" height="500px" style="margin-bottom:10px;"></div>
    <div id="pagingArea2" width="349px"></div>
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
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
<script type="text/javascript">
	wBrg = dhxWins.createWindow("wBrg",0,0,800,400);
	wBrg.setText("Pencarian Data Perusahaan");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function openData() {
		wBrg.show();
    	//wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objsBrg');
	}
	
	function batal() {
		wBrg.hide();
		wBrg.setModal(false);
		document.frmSrc2.fil.value = "0";
		document.frmSrc2.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmSrc2.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmSrc2.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc2.values.focus();
			return;
			}
		}
		nilai = document.frmSrc2.values.value;
		gridx.clearAll();
		gridx.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridx= new dhtmlXGridObject('gridCo');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("id, NPWPD Perusahaan, nama_perusahaan, alamat_perusahaan, jalan, rt, rw, email, kelurahan, kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_pemilik, rt_pemilik, rw_pemilik, email_pemilik, lokasi_pemilik, kelurahan_pemilik, kecamatan_pemilik, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, jenis_pajak_detail, tgl_daftar,kode_kec,kode_kel");//36
	gridx.setInitWidths("50,150,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");//19
	gridx.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridx.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridx.enablePaging(true,10,10,"pagingArea",true);
	gridx.setPagingSkin("bricks");
	gridx.setSkin("dhx_skyblue");
	gridx.setColumnHidden(0,true);
	gridx.attachEvent("onRowDblClicked", selectedOpenData);
	gridx.init();
	
	function selectedOpenData(id) {
		document.wp.npwpd.value 	= gridx.cells(id,1).getValue();
		document.wp.perusahaan.value 	= gridx.cells(id,2).getValue();
		document.wp.pemilik.value 	= gridx.cells(id,14).getValue();
		document.wp.hp.value 	= gridx.cells(id,24).getValue();
		batal();
	}
	
	function baru(){
		bersih();
		aktif();
		document.wp.tambah2.disabled = false;
		document.wp.delete2.disabled = true;
	}
	
	function bersih(){
		document.wp.id.value = "";
		document.wp.npwpd.value = "";
		document.wp.username.value = "";
		document.wp.password.value = "";
		document.wp.pass2.value = "";
		document.wp.perusahaan.value = "";
		document.wp.pemilik.value = "";
		document.wp.hp.value = "";
	}
	
	function aktif(){
		document.wp.npwpd.disabled = false;
		document.wp.username.disabled = false;
		document.wp.password.disabled = false;
		document.wp.opens.disabled = false;
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.enableAutoSize(false, true);
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	grid2 = new dhtmlXGridObject('gridContent2');
	grid2.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid2.setHeader("ID,NPWPD Perusahaan, Username, Password, Nama Pemilik, Nama Perusahaan, HP, Jenis Pajak",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	grid2.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid2.setInitWidths("70,150,150,100,150,200,150,150");
	grid2.setColAlign("center,left,left,left,left,left,left,left");
	grid2.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro");
	grid2.setColSorting("str,str,str,str,str,str,str,str");
	grid2.enablePaging(true,30,10,"pagingArea2",true);
	grid2.setPagingSkin("bricks");
	grid2.setSkin("dhx_skyblue");
	grid2.setColumnHidden(0,true);
	grid2.attachEvent("onRowDblClicked", selectedOpenData2);
	grid2.loadXML("<?php echo site_url(); ?>/master/data_wp");
	grid2.init();
	
	function refreshData2() {
		grid2.clearAll();
		grid2.loadXML("<?php echo site_url(); ?>/master/data_wp");
	}
	
	function selectedOpenData2(id) {
		document.wp.id.value 		= grid2.cells(id,0).getValue();
		document.wp.npwpd.value 	 = grid2.cells(id,1).getValue();
		document.wp.username.value 	 = grid2.cells(id,2).getValue();
		document.wp.pass2.value 	 = grid2.cells(id,3).getValue();
		document.wp.perusahaan.value  = grid2.cells(id,5).getValue();
		document.wp.pemilik.value 	  = grid2.cells(id,4).getValue();
		document.wp.hp.value 	  = grid2.cells(id,6).getValue();
		statusLoading();
		document.wp.tambah2.disabled = false;
		document.wp.delete2.disabled = false;
		aktif();
		tabbar.setTabActive("a1");
		statusEnding();
	}
	
	function deleteData2() {
		confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"id=" + document.wp.id.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/master/delete_wp', postStr, responeDel2);	
		}
		
	}
	
	function responeDel2(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					bersih();
					refreshData2();
					//disableButton2();
					statusEnding();
					alert("Done");
					return true;	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	statusEnding();
</script>