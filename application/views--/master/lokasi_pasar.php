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

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	function addRowList() {
		var id = gridfrmData.uid(); 
		var posisi = gridfrmData.getRowsNum(); //gridPOS.uid(); 
		//gridPOS.addRow(id,'',0); 
		var row1= '';
		var row2= '';
		var row3= '';
        var row4= '';
		gridfrmData.addRow(id,[row1,row2,row3,row4],posisi);
		gridfrmData.selectRow(posisi)
		gridfrmData.showRow(id);
	}
	
	function deleterowsfrmData() {
		ya = confirm("Are You Sure ?");
		if(ya) {
			gridfrmData.deleteSelectedItem()	
		}
	}
</script>

<style>
	body {
        background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);
	}
	.oval_big2 {
		width: 700px;
		margin:0px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
        background-color: #FFF;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>

<h2 style="margin:30px 5px 25px 30px;">Jenis Usaha Retribusi</h2>
<div class="oval_big2">

<div id="topnav" style="width: auto;"></div>
<div id="gridboxfrmData" style="width:700px; height:400px;"></div><br />
<input type="button" value="Tambah" onclick="addRowList()" />
<input type="button" value="Hapus" onclick="deleterowsfrmData()" />
</div>
<script language="javascript">
	gridfrmData = new dhtmlXGridObject('gridboxfrmData');
	gridfrmData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridfrmData.setHeader("Id,Kode, Nama Lokasi");
	gridfrmData.setInitWidths("50,50,580")
	gridfrmData.setColAlign("center,left,left")
	gridfrmData.setColTypes("ed,ed,ed");
	gridfrmData.enableMultiselect(true);
    gridfrmData.setNumberFormat("0,000",3,",",".");
	gridfrmData.init();
	gridfrmData.setSkin("dhx_skyblue");
	gridfrmData.loadXML("<?php echo site_url(); ?>/master_setting/data_lokasi_pasar");
	initDP();

	var dpps = "";
	function initDP() {
		dpps = new dataProcessor("<?php echo site_url(); ?>/master_setting/data_lokasi_pasar");
		//dpps.setUpdateMode("off");
		dpps.init(gridfrmData);	
	
		dpps.attachEvent("onAfterUpdateFinish", function() {	
			//toolbar.disableItem('save');
			statusEnding();
			alert("Done");
   			return true;
		});
	}	
	statusEnding();
</script>
