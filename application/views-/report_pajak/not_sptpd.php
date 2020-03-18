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

	<h2>Laporan Data Belum Pendataan SPTPD</h2>
	<form name="tetap" id="tetap">
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
            	<td style="padding-left:15px;">Jenis Pajak</td>
                <td><select name="jenis_usaha" id="jenis_usaha">
						<option value=""></option>
						<?php 
						foreach($pajak->result() as $rs) {
								echo "<option value=".$rs->id.">".$rs->nama_sptpd."</option>";
							}
						?>
					</select>&nbsp;                    
                <input type="button" value="Display" onclick="tampil()" /></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><input type="button" name="tpdf" id="tpdf" onclick="pdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;<input type="button" name="txls" id="txls" onclick="xls();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1260px" height="550px" style="margin-bottom:10px;"></div>
</div>

<script>
function pdf() {
	if(document.tetap.bulan.value=="") {
		alert("Bulan Tidak Boleh Kosong");
		document.tetap.bulan.focus();
		return;
	}
	
	if(document.tetap.tahun.value=="") {
		alert("Tahun Tidak Boleh Kosong");
		document.tetap.tahun.focus();
		return;
	}
	
	bln = document.tetap.bulan.value;
	thn = document.tetap.tahun.value;
	pajak = document.tetap.jenis_usaha.value;
	
	full = bln+'_'+thn+'_'+pajak;
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_not_sptpd?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function xls() {
	if(document.tetap.bulan.value=="") {
		alert("Bulan Tidak Boleh Kosong");
		document.tetap.bulan.focus();
		return;
	}
	
	if(document.tetap.tahun.value=="") {
		alert("Tahun Tidak Boleh Kosong");
		document.tetap.tahun.focus();
		return;
	}
	
	bln = document.tetap.bulan.value;
	thn = document.tetap.tahun.value;
	pajak = document.tetap.jenis_usaha.value;
	
	full = bln+'_'+thn+'_'+pajak;
	window.open('<?php echo site_url(); ?>/report_pajak2/excel_not_sptpd?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.tetap.bulan.value=="") {
		alert("Bulan Tidak Boleh Kosong");
		document.tetap.bulan.focus();
		return;
	}
	
	if(document.tetap.tahun.value=="") {
		alert("Tahun Tidak Boleh Kosong");
		document.tetap.tahun.focus();
		return;
	}
	
	bln = document.tetap.bulan.value;
	thn = document.tetap.tahun.value;
	pajak = document.tetap.jenis_usaha.value;
	
	full = bln+'_'+thn+'_'+pajak;
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_not_sptpd/"+full,function() {
		document.tetap.tpdf.disabled = false;
		document.tetap.txls.disabled = false;
		//statusEnding();
	});
}

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No., NPWPD, Nama Wajib Pajak, Alamat, Kecamatan, Kelurahan, Jenis Pajak,",//27
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("40,100,250,250,150,200,250");
mygrid.setColAlign("center,left,left,left,left,left,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");

mygrid.setColSorting("str,str,str,str,str,str,str");
mygrid.setSkin("dhx_skyblue");
mygrid.init();
</script>