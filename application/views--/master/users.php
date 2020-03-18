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

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
			
	function simpan2() {
		
		if(document.frmData2.username.value=="") {
			alert("Username Tidak Boleh Kosong");
			document.frmData2.username.focus();
			return;
		}
		if(document.frmData2.nama.value=="") {
			alert("Nama Tidak Boleh Kosong");
			document.frmData2.nama.focus();
			return;
		}
		if(document.frmData2.telp.value=="") {
			alert("No.Telp Tidak Boleh Kosong");
			document.frmData2.telp.focus();
			return;
		}
		if(document.frmData2.password.value=="") {
			alert("Password Tidak Boleh Kosong");
			document.frmData2.password.focus();
			return;
		}
		if(document.frmData2.nip.value=="") {
			alert("NIP Tidak Boleh Kosong");
			document.frmData2.nip.focus();
			return;
		}
		if(document.frmData2.bagian.value=="") {
			alert("Bagian Tidak Boleh Kosong");
			document.frmData2.bagian.focus();
			return;
		}
		
		if(document.frmData2.app.value=="") {
			alert("Modul Aplikasi Tidak Boleh Kosong");
			document.frmData2.app.focus();
			return;
		}
		
		var postStr =
			"id=" + document.frmData2.id.value +
			"&username=" + document.frmData2.username.value +
			"&nama=" + document.frmData2.nama.value +
			"&telp=" + document.frmData2.telp.value +
			"&email=" + document.frmData2.email.value +
			"&password=" + document.frmData2.password.value +
			"&nip=" + document.frmData2.nip.value +
			"&bagian=" + document.frmData2.bagian.value +
			"&app=" + document.frmData2.app.value +
            "&skpd_p=" + document.frmData2.skpd_load.value +
			"&group=" + document.frmData2.group.value;
			
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/master/simpan_user', postStr, responePOST2);
	}
	
	function responePOST2(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmData2();
					refreshData2();
					disableButton2();
					statusEnding();	
					alert("Done");
					return true;	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmData2() {
		document.frmData2.id.value = "";
		document.frmData2.username.value = "";
		document.frmData2.nama.value = "";
		document.frmData2.telp.value = "";
		document.frmData2.email.value = "";
		document.frmData2.password.value = "";
		document.frmData2.group.value = "";
		document.frmData2.nip.value = "";
		document.frmData2.bagian.value = "";
        document.frmData2.skpd_load.value = "";
		document.frmData2.app.value = "";
	}
	
	function enabledData() {
		document.frmData2.id.disabled = false;
		document.frmData2.username.disabled = false;
		document.frmData2.nama.disabled = false;
		document.frmData2.telp.disabled = false;
		document.frmData2.email.disabled = false;
		document.frmData2.password.disabled = false;
		document.frmData2.group.disabled = false;
		document.frmData2.nip.disabled = false;
		document.frmData2.bagian.disabled = false;      
        document.frmData2.skpd_load.disabled = false;		
		document.frmData2.app.disabled = false;
	}
	
	function enableButton2() {
		document.frmData2.delete2.disabled = false;
		document.frmData2.tambah2.disabled = false;
		document.frmData2.password.disabled = true;
	}
	
	function disableButton2() {
		document.frmData2.delete2.disabled = true;
		document.frmData2.tambah2.disabled = true;
		document.frmData2.password.disabled = false;
	}
	
</script>
<style>
	body{
        background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);
	}
</style>

<h2 style="margin:30px 5px 25px 30px;">Master User Account</h2>

<div id="a_tabbar" style="width:1000px; height:250px; margin-left:30px"></div>
  <div id="C1" style="background-color: #B3D9F0;">
	<br/>
    <form name="frmData2" id="frmData2" action="<?php echo site_url(); ?>master/simpan_user" method="post">
    	<table>
    		<tr style="padding-top:10px;">
    			<td width="100" style="padding-left:15px;">Username</td>
                <td><input type="hidden" name="id" id="id" size="35" />
                <input type="text" name="username" id="username" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">Password</td>
                <td><input type="password" name="password" id="password" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">Nama Lengkap</td>
                <td><input type="text" name="nama" id="nama" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">NIP</td>
                <td><input type="text" name="nip" id="nip" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">Bagian</td>
                <td><input type="text" name="bagian" id="bagian" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">No.Telp</td>
                <td><input type="text" name="telp" id="telp" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">Email</td>
                <td><input type="text" name="email" id="email" size="35" disabled/></td>
            </tr>
            <tr>
    			<td width="100" style="padding-left:15px;">Group</td>
                <td><select name="group" id="group" disabled>
                <option value=""></option>
                <?php 
				foreach($modul->result() as $rs) {
						echo "<option value=".$rs->id_modul.">".$rs->nm_modul."</option>";
					}
				?>
                </select></td>
            </tr>                        
            <tr>
    			<td width="100" style="padding-left:15px;">Nama SKPD</td>
                <td><select name="skpd_load" id="skpd_load" disabled>
                <option value=""></option>
                <?php 
				foreach($skpd_load->result() as $ap) {
						echo "<option value=".$ap->kd_skpd.">".$ap->nama_skpd."</option>";					    
                    }
				?>
                </select></td>
            </tr>                
            <tr>
    			<td width="100" style="padding-left:15px;">Modul </td>
                <td><select name="app" id="app" disabled>
                <option value=""></option>
                <?php 
				foreach($app->result() as $ap) {
						echo "<option value=".$ap->id_modul.">".$ap->nama_modul."</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;"><input type="button" value="Baru" onclick="baru()" name="new" style="padding-left:20px; padding-right:20px"/></td>
                <td><input type="button" value="Simpan" onclick="simpan2()" name="tambah2" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="Hapus" onclick="deleteData2()" name="delete2" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
    	</table>
<br />
</form>
</div>

<div id="C2">
<div style="padding:0 0px 10px 0px;">
   	<div id="gridContent2" width="995px" height="450px" style="margin-bottom:10px;"></div>
    <div id="pagingArea2" width="349px" style="background-color:white;"></div>
</div>
</div>

<script language="javascript">
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.enableAutoSize(false, true);
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	function baru() {
		kosongfrmData2();
		enabledData();
		document.frmData2.delete2.disabled = true;
		document.frmData2.tambah2.disabled = false;
		document.frmData2.username.focus();
	}

	grid2 = new dhtmlXGridObject('gridContent2');
	grid2.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid2.setHeader("ID,Username,Nama/Identitas,Telp,Email,Group,NIP,Bagian,Modul",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid2.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid2.setInitWidths("70,150,150,100,100,150,100,100,100");
	grid2.setColAlign("center,left,left,left,left,left,left,left,left");
	grid2.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid2.setColSorting("str,str,str,str,str,str,str,str,str");
	grid2.enablePaging(true,15,100,"pagingArea2",true);
	grid2.setPagingSkin("bricks");
	grid2.setSkin("dhx_skyblue");
	grid2.setColumnHidden(0,true);
	grid2.attachEvent("onRowDblClicked", selectedOpenData2);
	grid2.loadXML("<?php echo site_url(); ?>/master/data_user");
	grid2.init();
	
	function refreshData2() {
		grid2.clearAll();
		grid2.loadXML("<?php echo site_url(); ?>/master/data_user");
	}
	
	function selectedOpenData2(id) {
		kosongfrmData2();
		enabledData()
		enableButton2();
		document.frmData2.id.value 			= grid2.cells(id,0).getValue();
		document.frmData2.username.value 	= grid2.cells(id,1).getValue();
		document.frmData2.nama.value 		= grid2.cells(id,2).getValue();
		document.frmData2.telp.value 		= grid2.cells(id,3).getValue();
		document.frmData2.email.value 		= grid2.cells(id,4).getValue();
		document.frmData2.password.disabled = false;
		document.frmData2.group.value 		= grid2.cells(id,5).getValue();
		document.frmData2.nip.value 		= grid2.cells(id,6).getValue();
        document.frmData2.bagian.value 		= grid2.cells(id,7).getValue();		        
		document.frmData2.app.value 		= grid2.cells(id,8).getValue();
        //document.frmData2.skpd_load.value 	= grid2.cells(id,9).getValue();        
		statusLoading();
		tabbar.setTabActive("a1");
		statusEnding();
	}
	
	function deleteData2() {
		confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"id=" + document.frmData2.id.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/master/delete_user', postStr, responeDel2);	
		}
		
	}
	
	function responeDel2(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmData2();
					refreshData2();
					disableButton2();
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