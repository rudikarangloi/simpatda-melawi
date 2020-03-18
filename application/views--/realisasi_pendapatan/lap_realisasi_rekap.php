<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css"/>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css"/>
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>

<!-- dhtmlxGrid -->
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgridcell.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid_filter.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_pgn.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_splt.js"></script>
<script  src="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_group.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/ext/dhtmlxgrid_pgn_bricks.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css"/>
<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
<script src="<?php echo base_url();?>assets/grid2pdf/client/dhtmlxgrid_export.js"></script>

<!-- Ajax -->
<script src="<?php echo base_url(); ?>assets/codebase_ajax/dhtmlxcommon.js"></script>

<!-- Window -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/skins/dhtmlxwindows_dhx_skyblue.css"/>
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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css"/>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<div align="center">
	<h2>Laporan Realisasi Penerimaan Rekapitulasi Pendapatan</h2>
	<!--<button><a href="<?php echo site_url();?>/realisasi_pendapatan/lap_rekapitulasi">Refresh (UNTUK SEMENTARA NGEDIT)</a></button><hr>-->
		<form name="bln" id="bln">
			<table>
				<tr>
					<td style="padding-left:6px;">Periode :</td>
					<td>
						<select name="bulan" id="bulan">
							<option value="">Pilih bulan :</option>
							<?php echo $bulan; ?>
						</select>
						&nbsp;
						<select name="tahun" id="tahun">
							<option value="">Pilih tahun :</option>
							<?php echo $tahun; ?>
						</select>
					</td>
				</tr>
			<tr align="center">
                <td colspan="2" align="center">
                <input type="button" value="Display" onclick="tampil()" style="padding-left:24px; padding-right:20px" />
                <input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>
<div id="gridbox" width="1338px" height="390px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
function tpdf(){
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	//var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	//var lastDateDay = lastDate.getDate();
	
	full = periode;
	window.open('<?php echo site_url();?>/realisasi_pendapatan/tanda_tangan?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.bln.bulan.value=="") {
		alert("Bulan rekapitulasi belum di pilih !");
		document.bln.bulan.focus();
		return;
	}
	
	if(document.bln.tahun.value=="") {
		alert("Tahun rekapitulasi belum di pilih !");
		document.bln.tahun.focus();
		return;
	}
	
	periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
	//var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
	//var lastDateDay = lastDate.getDate();
	
	//full = periode;
	
	statusLoading();
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/realisasi_pendapatan/data_periode_lap_rekapitulasi/"+periode,function() {
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
mygrid.setHeader("No., Kode<br>Rekening, Uraian, Jumlah Anggaran,Penerimaan<br>Bulan Ini,Penerimaan<br>Bulan Lalu,Penerimaan<br>Sampai Bulan Ini,Presentase<br>Penerimaan,Sisa Target<br>Tahun Anggaran",//27
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("1, 2, 3, 4, 5, 6, 7, 8, 9",
	["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,70,320,140,170,170,170,80,160");
mygrid.setColAlign("center,center,left,right,right,right,right,center,right");
mygrid.setColTypes("ro,ro,ro,ron,ron,ron,ron,ron,ron");
mygrid.setNumberFormat("0,000",3,",",".");
mygrid.setNumberFormat("0,000",4,",",".");
mygrid.setNumberFormat("0,000",5,",",".");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setNumberFormat("0,000",7,",",".");
mygrid.setNumberFormat("0,000",8,",",".");
mygrid.setNumberFormat("0,000",9,",",".");
mygrid.setColSorting("int,str,str,int,int,int,int,int,int");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("<div style=text-align:center>JUMLAH PENDAPATAN DAERAH</div>,#cspan,#cspan,<div style=text-align:right id=s1>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>,<div style=text-align:right>{#stat_total}</div>");
mygrid.init();
</script>