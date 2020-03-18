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

	<h2>Laporan SPTPD Belum Bayar (Self Assesment)</h2>
	<form name="tetap" id="tetap">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Tanggal</td>
                <td><input type="text" name="awal" id="awal" />&nbsp;&nbsp;s/d&nbsp;
                <input type="text" name="akhir" id="akhir" />&nbsp;</td>
            </tr>
            <tr>
            	<td style="padding-left:15px;">Jenis Pajak</td>
                <td><select name="jenis_pajak" id="jenis_pajak">
						<option value=""></option>
						<?php 
						foreach($pajak->result() as $rs) {
								echo "<option value=".$rs->kode_sptpd.">".$rs->nama_sptpd."</option>";
							}
						?>
					</select>
            	</td>
            </tr>
           	<tr align="center">
            	<td colspan="2"><input type="button" value="Display" onclick="tampil()" />&nbsp;<input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;<input type="button" name="xls" id="xls" onclick="txls();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1050px" height="490px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
function tpdf(){
	if(document.tetap.awal.value=="") {
		alert("Bulan Awal Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	if(document.tetap.akhir.value=="") {
		alert("Bulan Akhir Tidak Boleh Kosong");
		document.tetap.akhir.focus();
		return;
	}
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	t = document.tetap.akhir.value;
	s = t.split("/");
	akhir = s[2]+'-'+s[1]+'-'+s[0];
	
	full = awal+'|'+akhir+'|'+document.tetap.jenis_pajak.value;
	window.open('<?php echo site_url(); ?>/report_pajak/cetak_bsel?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function txls(){
	if(document.tetap.awal.value=="") {
		alert("Bulan Awal Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	if(document.tetap.akhir.value=="") {
		alert("Bulan Akhir Tidak Boleh Kosong");
		document.tetap.akhir.focus();
		return;
	}
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	t = document.tetap.akhir.value;
	s = t.split("/");
	akhir = s[2]+'-'+s[1]+'-'+s[0];
	
	full = awal+'|'+akhir+'|'+document.tetap.jenis_pajak.value;
	window.open('<?php echo site_url(); ?>/report_pajak/excel_bsel?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}
	
function tampil(){
	if(document.tetap.awal.value=="") {
		alert("Bulan Awal Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	if(document.tetap.akhir.value=="") {
		alert("Bulan Akhir Tidak Boleh Kosong");
		document.tetap.akhir.focus();
		return;
	}
	statusLoading();
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	t = document.tetap.akhir.value;
	s = t.split("/");
	akhir = s[2]+'-'+s[1]+'-'+s[0];
	
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak/data_bsel/"+awal+"/"+akhir+"/"+document.tetap.jenis_pajak.value,function() {
		document.tetap.pdf.disabled = false;
		document.tetap.xls.disabled = false;
		statusEnding();
	});
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');
	
cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%d/%m/%Y');
	
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("NO.,TANGGAL,NO. SPTPD,NAMA WAJIB PAJAK,ALAMAT,NPWPD,KETETAPAN,MASA PAJAK, KETERANGAN",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("40,70,100,180,200,100,100,150,100");
mygrid.setColAlign("center,center,center,left,left,center,right,center,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ron,ro,ro");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setColSorting("str,str,str,str,str,str,int,str,str");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>");
mygrid.init();
</script>