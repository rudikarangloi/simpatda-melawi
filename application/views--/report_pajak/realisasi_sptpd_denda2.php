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

	<h2>Laporan Realisasi Penerimaan Denda Pajak Berdasarkan SSPD</h2>
	<form name="tetap" id="tetap">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Jenis Pajak</td>
                <td><select name="jenis_pajak" id="jenis_pajak">
						<option value=""></option>
						<option value="1">Hotel</option>
						<option value="2">Restoran</option>
						<option value="3">Reklame</option>
						<option value="4">Hiburan</option>
						<option value="5">Penerangan Jalan</option>
						<option value="6">Mineral Bukan Logam dan Batuan</option>
						<option value="7">Burung Walet</option>
						<option value="8">Parkir</option>
						<option value="9">Air Tanah</option>
					</select></td>
            </tr>
            <tr align="center">
            	<td colspan="2">Tahun &nbsp;
                <select name="tahun" id="tahun">
                <option value=""></option>
					<?php echo $tahun; ?>
                </select>&nbsp;                    
                <input type="button" value="Display" onclick="tampil()" />&nbsp;
                <input type="button" name="tpdf" id="tpdf" onclick="pdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1740px" height="390px" style="margin-bottom:10px;"></div>
</div>

<script>
function pdf() {
	full = document.tetap.jenis_pajak.value+'-'+document.tetap.tahun.value;
	window.open('<?php echo site_url(); ?>/report_pajak/cetak_realisasi_sptpd_denda2?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.tetap.jenis_pajak.value=="") {
		alert("Jenis Pajak Tidak Boleh Kosong");
		document.tetap.jenis_pajak.focus();
		return;
	}
	
	if(document.tetap.tahun.value=="") {
		alert("Tahun Tidak Boleh Kosong");
		document.tetap.tahun.focus();
		return;
	}

	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak/data_realisasi_sptpd_denda2/"+document.tetap.jenis_pajak.value+"/"+document.tetap.tahun.value,function() {
		document.tetap.tpdf.disabled = false;
		statusEnding();
	});
}


mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No. ,Nama Wajib Pajak, Alamat, Tahun Lalu,Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember",//27
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader(["#rspan", "#rspan", "#rspan", "#rspan", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi", "Realisasi"]);
mygrid.setInitWidths("40,200,300,100,100,100,100,100,100,100,100,100,100,100,100,100");
mygrid.setColAlign("center,left,left,right,right,right,right,right,right,right,right,right,right,right,right,right");
mygrid.setColTypes("ro,ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
mygrid.setNumberFormat("0,000",3,",",".");
mygrid.setNumberFormat("0,000",4,",",".");
mygrid.setNumberFormat("0,000",5,",",".");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setNumberFormat("0,000",7,",",".");
mygrid.setNumberFormat("0,000",8,",",".");
mygrid.setNumberFormat("0,000",9,",",".");
mygrid.setNumberFormat("0,000",10,",",".");
mygrid.setNumberFormat("0,000",11,",",".");
mygrid.setNumberFormat("0,000",12,",",".");
mygrid.setNumberFormat("0,000",13,",",".");
mygrid.setNumberFormat("0,000",14,",",".");
mygrid.setNumberFormat("0,000",15,",",".");

mygrid.setColSorting("str,str,str,int,int,int,int,int,int,int,int,int,int,int,int,int");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Total,#cspan,#cspan,<div style=text-align:right id=s0>{#stat_total}</div>,<div style=text-align:right id=s1>{#stat_total}</div>,<div style=text-align:right id=s2>{#stat_total}</div>,<div style=text-align:right id=s3>{#stat_total}</div>,<div style=text-align:right id=s4>{#stat_total}</div>,<div style=text-align:right id=s5>{#stat_total}</div>,<div style=text-align:right id=s6>{#stat_total}</div>,<div style=text-align:right id=s7>{#stat_total}</div>,<div style=text-align:right id=s8>{#stat_total}</div>,<div style=text-align:right id=s9>{#stat_total}</div>,<div style=text-align:right id=s10>{#stat_total}</div>,<div style=text-align:right id=s11>{#stat_total}</div>,<div style=text-align:right id=s12>{#stat_total}</div>");
mygrid.init();
</script>