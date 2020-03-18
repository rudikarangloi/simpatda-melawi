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
<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
<script src="<?php echo base_url();?>assets/grid2pdf/client/dhtmlxgrid_export.js"></script>

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

<style>
body{
	background:#FFF;
}
</style>
<div align="center">

	<h2>Laporan Realisasi Pajak Daerah</h2>
	<form name="bln" id="bln">
    	<table width="300" border="0">
        	<tr>
            	<td width="150" style="padding-left:15px;">Bulan Pajak</td>
                <td width="150"><select name="bulan" id="bulan" >
                    <option value=""></option>
                    <?php echo $bulan; ?>
                </select></td>
            </tr>
            <tr>
            	<td width="150" style="padding-left:15px;">Tahun Pajak</td>
                <td width="150"><select name="tahun" id="tahun" >
                    <option value=""></option>
                    <?php echo $tahun; ?>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2" align="center">
                <input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;
                <input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>

<div id="gridbox" width="1160px" height="450px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
function tpdf(){
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	var lastDateDay = lastDate.getDate();
	
	full = periode+'|'+lastDateDay;
	window.open('<?php echo site_url(); ?>/report_pajak/ttd_bln?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.bln.bulan.value=="") {
		alert("Bulan Pajak Tidak Boleh Kosong");
		document.bln.bulan.focus();
		return;
	}
	
	if(document.bln.tahun.value=="") {
		alert("Tahun Pajak Tidak Boleh Kosong");
		document.bln.tahun.focus();
		return;
	}
	
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	var lastDateDay = lastDate.getDate();
	
	full = periode+'|'+lastDateDay;
	
	statusLoading();
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak/bln_data/"+periode+"/"+lastDateDay,function() {
		document.bln.pdf.disabled = false;
		statusEnding();
	});
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');
	
cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%d/%m/%Y');

function pasif(){
	document.bln.excel.disabled = true;
}
	
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url();?>assets/codebase_excel/imgs/");
mygrid.setHeader("NO. ,TANGGAL PENERIMAAN ,HOTEL ,RESTORAN ,REKLAME ,HIBURAN ,PPJ ,MBLB ,PARKIR ,BURUNG WALET ,AIR TANAH, TOTAL",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,100,100,100,100,100,100,100,100,100,100,100")
mygrid.setColAlign("center,center,right,right,right,right,right,right,right,right,right,right")
mygrid.setColTypes("ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron")
mygrid.setNumberFormat("0,000",2,",",".")
mygrid.setNumberFormat("0,000",3,",",".")
mygrid.setNumberFormat("0,000",4,",",".")
mygrid.setNumberFormat("0,000",5,",",".")
mygrid.setNumberFormat("0,000",6,",",".")
mygrid.setNumberFormat("0,000",7,",",".")
mygrid.setNumberFormat("0,000",8,",",".")
mygrid.setNumberFormat("0,000",9,",",".")
mygrid.setNumberFormat("0,000",10,",",".")
mygrid.setNumberFormat("0,000",11,",",".")
mygrid.setColSorting("str,str,int,int,int,int,int,int,int,int,int,int");
mygrid.enableMultiline(true)
mygrid.setSkin("dhx_skyblue")
mygrid.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>")
mygrid.init();
</script>