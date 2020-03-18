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
<!-- calendar begin-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>

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
		var row5= '';
		var row6= '1';
		gridfrmData.addRow(id,[row1,row2,row3,row4,row5,row6],posisi);
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
		/*background:#FFF;*/
        background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);
	}
	.oval_big2 {
		background:#FFF;
        width: 680px;
		margin:0px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>

<h2 style="margin:30px 5px 25px 30px;">Master Rekening</h2>

<div class="oval_big2">
<form name="thn" id="thn">
	<input type="button" value="Tambah" onclick="addRowList()" />
	<input type="button" value="Hapus" onclick="deleterowsfrmData()" />
	<input type="button" name="xls" id="xls" onclick="cetak(1);" value="Cetak ke PDF" style="padding-left:20px; padding-right:20px" />&nbsp;
	<input type="button" name="xls" id="xls" onclick="cetak(2);" value="Cetak ke Excel" style="padding-left:20px; padding-right:20px" />&nbsp;<br>
	<td>Tanggal &nbsp;<input type="text" name="awal" id="awal" size="15" />&nbsp;<input type="text" name="akhir" id="akhir" size="15" /></td>
</form>
<div id="gridboxfrmData" style="width:680px; height:450px;"></div><br>
<div id="topnav" style="width: auto;">
</div>
</div>


<script language="javascript">
function cetak(pilih) {
	if(document.thn.awal.value=="") {
		alert("Taggal Awal Tidak Boleh Kosong");
		document.thn.awal.focus();
		return;
	}
	
	if(document.thn.akhir.value=="") {
		alert("Taggal Akhir Tidak Boleh Kosong");
		document.thn.akhir.focus();
		return;
	}
	t = document.thn.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	o = document.thn.akhir.value;
	p = o.split("/");
	akhir = p[2]+'-'+p[1]+'-'+p[0];
	//var thn = document.thn.tahun.value;
	full = awal+'|'+akhir+'|'+pilih;
	window.open('<?php echo site_url(); ?>/master_setting/cetak_rekening?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

	cal1 = new dhtmlxCalendarObject('awal');
	cal1.setDateFormat('%d/%m/%Y');

	cal2 = new dhtmlxCalendarObject('akhir');
	cal2.setDateFormat('%d/%m/%Y');

	gridfrmData = new dhtmlXGridObject('gridboxfrmData');
	gridfrmData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridfrmData.setHeader("Kode Rekening, Nama Rekening,Target Realisasi, Jenis Pajak, Tarif Pajak, Status Aktif");
	gridfrmData.setInitWidths("100,380,150,50,50,50")
	gridfrmData.setColAlign("left,left,left,center,center,center")
	gridfrmData.setColTypes("ed,ed,ed,ed,ed,ed");
	gridfrmData.enableMultiselect(true);
	gridfrmData.setNumberFormat("0,000",2,",",".");
	//gridfrmData.setColumnHidden(0,true);
	gridfrmData.init();
	gridfrmData.setSkin("dhx_skyblue");
	gridfrmData.loadXML("<?php echo site_url(); ?>/master_setting/data_rekening");
	initDP();

	var dpps = "";
	function initDP() {
		dpps = new dataProcessor("<?php echo site_url(); ?>/master_setting/data_rekening");
		//dpps.setUpdateMode("off");
		dpps.init(gridfrmData);	
	
		dpps.attachEvent("onAfterUpdateFinish", function() {	
			statusEnding();
			alert("Done");
   			return true;
		});
	}
	cal1 = new dhtmlxCalendarObject('awal');
	cal1.setDateFormat('%d/%m/%Y');

	cal2 = new dhtmlxCalendarObject('akhir');
	cal2.setDateFormat('%d/%m/%Y');	
	statusEnding();
</script>
