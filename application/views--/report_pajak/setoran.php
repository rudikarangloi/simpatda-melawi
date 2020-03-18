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

	<h2>Laporan Surat Setoran Pajak Daerah ( SSPD ) Harian</h2>
	<form name="tetap" id="tetap">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Tanggal Setoran</td>
                <td><input type="text" name="awal" id="awal" size="15" /></td>
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
            	<td colspan="2"><input type="button" value="Display" onclick="tampil()" />&nbsp;
                <input type="button" name="tpdf" id="tpdf" onclick="pdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1300px" height="550px" style="margin-bottom:10px;"></div>
</div>

<script>
function pdf() {
	if(document.tetap.awal.value=="") {
		alert("Bulan Awal Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	full = awal+'|'+document.tetap.jenis_pajak.value;
	
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_setor?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.tetap.awal.value=="") {
		alert("Tanggal Setoran Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
		
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_setor/"+awal+"/"+document.tetap.jenis_pajak.value,function() {
		document.tetap.tpdf.disabled = false;
		//statusEnding();
	});
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No. ,No.SSPD, NPWPD, Nama Wajib Pajak, Alamat, Masa Pajak, Ketetapan, Denda, Setoran",//27
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("40,150,100,250,250,170,110,110,110");
mygrid.setColAlign("center,left,left,left,left,center,right,right,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ron");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setNumberFormat("0,000",7,",",".");
mygrid.setNumberFormat("0,000",8,",",".");
mygrid.setColSorting("str,str,str,str,str,str,int,int,int");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>");
mygrid.init();
</script>