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

<div style="height:100%; overflow:auto;">
<?php
error_reporting(0);
list($menu,$jmlOL) = explode("|",$menu);
?>

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	
	function simpan() {
		
		if(document.frmData.nm_modul.value=="") {
			alert("Nama Bidang Tidak Boleh Kosong");
			document.frmData.nm_modul.focus();
			return;
		}
		
		var menu = "";
		<?php for($n=1;$n<=$jmlOL;$n++) { ?>
			if(document.frmData.O<?php echo $n; ?>.checked==true) { menu = document.frmData.O<?php echo $n; ?>.value+"|"+menu; }
		<?php } ?>
		var postStr =
			"id=" + document.frmData.id.value +
			"&nm_modul=" + document.frmData.nm_modul.value +
			"&menu=" + menu;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/master/simpan_group', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmData();
					refreshData();
					statusEnding();	
					disableButton();
					alert("Done");
					return true;	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmData() {
		document.frmData.id.value = "";
		document.frmData.nm_modul.value = "";
		<?php for($i=1;$i<=$jmlOL;$i++) { ?>
			document.frmData.O<?php echo $i; ?>.checked = false;
		<?php } ?>
	}
	
	function enableButton() {
		document.frmData.delete1.disabled = false;
		document.frmData.tambah.disabled = false;
	}
	
	function disableButton() {
		document.frmData.delete1.disabled = true;
		document.frmData.tambah.disabled = true;
	}
</script>

<style>
	body {
        background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);
	}
	.oval_big {
		width: 900px;
		margin:0px 5px 25px 30px;
		padding-right: 20px;
		padding-bottom: 10px;
		border:1px solid #CCC;
		font-size: 12px;
        background-color: #FFF;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>

<h2 style="margin:30px 5px 25px 30px;">Master User Group</h2>

<div class="oval_big">
	<br/>
    <form name="frmData" id="frmData" action="<?php echo site_url(); ?>master/simpan_group" method="post">
    	<table border="0">
    		<tr style="padding:10px 0 10px 0;">
    			<td width="131" style="padding-left:15px;">Nama Bidang</td>
                <td width="228"><input type="hidden" name="id" id="id" size="35" />
                <input type="text" name="nm_modul" id="nm_modul" size="35" style="text-transform:uppercase;" disabled/></td>
                <td rowspan="4" width="450" valign="top" style="padding-left:15px;"><br />
                	<div style="padding:0 5px 0 15px;">
    	<div id="gridContent" height="500px" style="margin-bottom:10px; margin-right:5px;"></div>
        <div id="pagingArea" width="250px" style="background-color:white;"></div>
	</div>
                </td>
            </tr>
            <tr>
            	<td colspan="2" style="padding-left:15px;" height="25">Menu User</td>
            </tr>
           	<tr>
            	<td colspan="2" style="padding-left:15px;">
                	<div style="overflow:auto; height:450px; width:400px; border:2px inset #999; margin-left:0px;"><?php echo $menu; ?></div>
                </td>
            </tr>
            <tr height="25">
            	<td width="39" style="padding-left:15px;"><input type="button" value="Baru" onclick="baru()" name="new" style="padding-left:20px; padding-right:20px"/></td>
                <td width="52">
                <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;
                <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
    	</table>
    </form>
    <br/>
</div>

<script language="javascript">
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID,Bagian Bidang,Menu",null,["text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter");
	grid.setInitWidths("70,350,100");
	grid.setColAlign("center,left,left");
	grid.setColTypes("ro,ro,ro");
	grid.setColSorting("str,str,str");
	grid.setColumnHidden(2,true);
	grid.enablePaging(true,20,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/master/data_group");
	grid.init();

	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/master/data_group");
	}
	
	function selectedOpenData(id) {
		statusLoading();
		kosongfrmData();
		enableButton();
		document.frmData.id.value = grid.cells(id,0).getValue();
		document.frmData.nm_modul.value = grid.cells(id,1).getValue();
		menu = grid.cells(id,2).getValue();
		arr_menu = menu.split('|');
		jml = <?php echo $jmlOL; ?>;
		for(p=0;p<jml;p++) {
			<?php for($i=1;$i<=$jmlOL;$i++) { ?>
			if(document.frmData.O<?php echo $i; ?>.value==arr_menu[p]) { document.frmData.O<?php echo $i; ?>.checked=true; }
			<?php } ?>
		}
		document.frmData.nm_modul.disabled = false;
		statusEnding();
	}
	
	function deleteData() {
		confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"id=" + document.frmData.id.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/master/delete_group', postStr, responeDel);	
		}
		
	}
	
	function responeDel(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result==0) {
					alert("Data Berhasil dihapus");
					kosongfrmData();
					disableButton();
					refreshData();
					statusEnding();
					return true;
				} else {
					alert("Silahkan hapus data user terlebih dahulu");
					kosongfrmData();
					disableButton();
					refreshData();
					statusEnding();
					return true;
				}	
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function baru() {
		kosongfrmData();
		document.frmData.nm_modul.disabled = false;
		enableButton();
		document.frmData.nm_modul.focus();
	}
	statusEnding();
</script>