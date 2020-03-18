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
	<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
    <script src="<?php echo base_url();?>assets/grid2pdf/client/dhtmlxgrid_export.js"></script>
	
	<!-- calendar begin-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
	
    <!-- layout -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>
    
    <!-- Ajax -->
	<script src="<?php echo base_url(); ?>assets/codebase_ajax/dhtmlxcommon.js"></script>

    <!-- Window -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/skins/dhtmlxwindows_dhx_skyblue.css">
    <script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.js"></script>
    <script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxcontainer.js"></script>
    
    <!-- Modal -->
    <link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>

<style>
body{
	background:#FFF;
}
</style>
<div align="center">

	<h2>REKAPITULASI PENERIMAAN HARIAN</h2>
	<form name="bln" id="bln">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Periode</td>
                <td><input type="text" name="tgl" id="tgl"></td>
            </tr>
            <tr>
            	<td style="padding-left:15px;">Type Pembayaran</td>
                <td><select name="bayar" id="bayar">
                <option value=""></option>
                <option value="1">Bank</option>
                <!--<option value="200">Bank Nagari</option>
                <option value="300">Bank BTN</option>
                <option value="0009">Bank BNI</option>-->
                </select></td>
            </tr>
            <tr>
            	<td colspan="2">
                <input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;
                <input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px"/>&nbsp;
                <input type="button" name="xls" id="xls" onclick="txls();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px"/>
                </td>
            </tr>
        </table>
    </form>

<script type="text/javascript">
cal1 = new dhtmlxCalendarObject('tgl');
cal1.setDateFormat('%d/%m/%Y');

function tpdf(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
	if(document.bln.bayar.value=="") {
		alert("Type Pembayaran Tidak Boleh Kosong");
		document.bln.bayar.focus();
		return;
	}
	
	bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	full = bayar+'|'+periode;
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_rekap?full='+full, '', 'width=500,height=400,scrollbars=1');
}

function txls(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
	if(document.bln.bayar.value=="") {
		alert("Type Pembayaran Tidak Boleh Kosong");
		document.bln.bayar.focus();
		return;
	}
	
	bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	full = bayar+'|'+periode;
	window.open('<?php echo site_url(); ?>/report_pajak2/excel_rekap?full='+full, '', 'width=500,height=400,scrollbars=1');
}

function tampil(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
	if(document.bln.bayar.value=="") {
		alert("Type Pembayaran Tidak Boleh Kosong");
		document.bln.bayar.focus();
		return;
	}
	
	bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	//full = bayar+'|'+periode;
	window.open("<?php echo site_url(); ?>/report_pajak2/display_rekap/"+bayar+"/"+periode,'width=500,height=400,scrollbars=1');
}
</script>