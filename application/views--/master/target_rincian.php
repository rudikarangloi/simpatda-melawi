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
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	function addRowList() {
		var id = gridfrmData.uid(); 
		var posisi = gridfrmData.getRowsNum(); //gridPOS.uid(); 
		//gridPOS.addRow(id,'',0); 
		var row1= '';
		var row2= '';
		var row3= '';
		gridfrmData.addRow(id,[row1,row2,row3],posisi);
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
		background:#FFF;
	}
	.oval_big2 {
		width: 740px;
		margin:0px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>

<h2 style="margin:30px 5px 25px 30px;">Master Target Realisasi</h2>
<div class="oval_big2">

<div id="topnav" style="width: auto;">
<form name="rincian" id="rincian">
	<table>
    	<tr>
        	<td>Kode Rekening</td>
            <td>Nama Rekening</td>
            <td>Target Realisasi</td>
            <td>Tahun Anggaran</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td><input type="text" name="kode" id="kode" /></td>
            <td><input type="text" name="nama" id="nama" /></td>
            <td><input type="text" name="target" id="target" style="text-align:right;" /></td>
            <td><input type="text" name="tahun" id="tahun" style="text-align:right; width:80px;" /></td>
            <td><input type="button" value="Tambah" name="btn_upd" id="btn_upd" onclick="update_data();" /></td>
        </tr>
    </table>
</form>
</div>
<div id="gridboxfrmData" style="width:740px; height:500px;"></div><br />
</div>
<script language="javascript">
	$(function() {         
    	$('#target').priceFormat({
        	prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
			centsLimit: 0
         });
	});
	
	gridfrmData = new dhtmlXGridObject('gridboxfrmData');
	gridfrmData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridfrmData.setHeader("Kode Rekening, Nama Rekening,Tahun Anggaran,Target Realisasi,ID");
	gridfrmData.setInitWidths("150,250,100,150,90")
	gridfrmData.setColAlign("left,left,center,left,right")
	gridfrmData.setColTypes("ed,ed,ed,ron,ro");
	gridfrmData.setColumnHidden(4,true);
	gridfrmData.setNumberFormat("0,000",3,",",".");
	gridfrmData.enableMultiselect(true);
	//gridfrmData.attachEvent("onRowDblClicked", selectedOpenData);
	gridfrmData.setSkin("dhx_skyblue");
	gridfrmData.attachFooter("Jumlah,#cspan,#cspan,<div style=text-align:right>{#stat_total}</div>,#cspan");
	gridfrmData.loadXML("<?php echo site_url(); ?>/master_setting/data_rincian");
	gridfrmData.init();
	
	initDP();
	disabledForm();
	kosong();
	
	function disabledForm(){
		//document.rincian.kode.disabled = true;
		//document.rincian.tahun.disabled = true;
		//document.rincian.target.disabled = true;
		//document.rincian.btn_upd.disabled = true;
	}
	
	function enabledForm(){
		//document.rincian.kode.disabled = false;
		//document.rincian.tahun.disabled = false;
		//document.rincian.target.disabled = false;
		//document.rincian.btn_upd.disabled = false;
	}
	
	function kosong(){
		document.rincian.kode.value = "";
		document.rincian.nama.value = "";
		document.rincian.target.value = "";
		document.rincian.tahun.value = "";
		
	}
	
	function selectedOpenData(id){
		kosong();
		enabledForm();
		document.rincian.kode.value = gridfrmData.cells(id,0).getValue();
		document.rincian.nama.value = gridfrmData.cells(id,1).getValue();
		document.rincian.target.value = format_number(gridfrmData.cells(id,2).getValue());
	}
	
	function reloadData(){
		gridfrmData.clearAll();
		gridfrmData.loadXML("<?php echo site_url(); ?>/master_setting/data_rincian");
	}
	
	function update_data(){
		if(document.rincian.target.value=="") {
			alert("Target Pajak Tidak Boleh Kosong");
			document.rincian.target.focus();
			return;
		}
		
		var postStr =
			"kode=" + document.rincian.kode.value +
			"&target=" + document.rincian.target.value+
			"&tahun=" + document.rincian.tahun.value;
			
		statusLoading();
		dhtmlxAjax.post('<?php echo base_url(); ?>index.php/master_setting/simpan_data_rincian', postStr, function(){
			statusEnding();
			alert("Done");
			reloadData();
			kosong();
			disabledForm();
   			return true;	
		});
	}

	var dpps = "";
	function initDP() {
		dpps = new dataProcessor("<?php echo site_url(); ?>/master_setting/data_rincian");
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
