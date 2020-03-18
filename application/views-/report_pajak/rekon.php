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

	<h2>Laporan Rekonsiliasi Pajak Daerah</h2>
	<form name="bln" id="bln">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Periode</td>
                <td><select name="bulan" id="bulan">
                <option value=""></option>
                <?php echo $bulan; ?>
                </select>&nbsp;<select name="tahun" id="tahun">
                <option value=""></option>
                <?php echo $tahun; ?>
                </select></td>
            </tr>
            <tr>
            	<td style="padding-left:15px;">Type Pembayaran</td>
                <td><select name="bayar" id="bayar">
                <option value=""></option>
                <option value="1">BANK</option>
                <option value="2">LOKET</option>
                <!--<option value="300">Bank BTN</option>
                <option value="0009">Bank BNI</option>-->
                </select>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;<input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;<input type="button" name="xls" id="xls" onclick="txls();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>

<div id="gridbox" width="670px" height="550px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
function tpdf(){
	bayar = document.bln.bayar.value;
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	var lastDateDay = lastDate.getDate();
	
	full = bayar+'|'+periode+'|'+lastDateDay;
	window.open('<?php echo site_url(); ?>/report_pajak/cetak_rekon?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function txls(){
	bayar = document.bln.bayar.value;
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	var lastDateDay = lastDate.getDate();
	
	full = bayar+'|'+periode+'|'+lastDateDay;
	window.open('<?php echo site_url(); ?>/report_pajak/excel_rekon?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.bln.bayar.value=="") {
		alert("Type Pembayaran Tidak Boleh Kosong");
		document.bln.bayar.focus();
		return;
	}
	
	if(document.bln.bulan.value=="") {
		alert("Bulan Tidak Boleh Kosong");
		document.bln.bulan.focus();
		return;
	}
	
	if(document.bln.tahun.value=="") {
		alert("Tahun Tidak Boleh Kosong");
		document.bln.tahun.focus();
		return;
	}
	
	bayar = document.bln.bayar.value;
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	var lastDateDay = lastDate.getDate();
	
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak/data_rekon/"+bayar+"/"+periode+"/"+lastDateDay,function() {
		document.bln.pdf.disabled = false;
		document.bln.xls.disabled = false;
		//statusEnding();
	});
}

function pasif(){
	document.bln.excel.disabled = true;
}
	
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url();?>assets/codebase_excel/imgs/");
mygrid.setHeader("TANGGAL,TYPE,SETORAN,SELISIH,AKUMULASI",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("100,100,150,150,150")
mygrid.setColAlign("center,left,right,right,right")
mygrid.setColTypes("ro,ro,ron,ron,ron")
mygrid.setNumberFormat("0,000",2,",",".")
mygrid.setNumberFormat("0,000",3,",",".")
mygrid.setColumnHidden(3,true);
mygrid.setNumberFormat("0,000",4,",",".")
mygrid.setColSorting("str,str,int,int,int");
mygrid.enableMultiline(true)
mygrid.setSkin("dhx_skyblue")
mygrid.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>")
mygrid.init();
</script>