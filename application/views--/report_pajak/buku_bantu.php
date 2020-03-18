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

	<h2>Laporan Buku Pembantu Bulanan</h2>
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
    
<div id="gridbox" width="1050px" height="550px" style="margin-bottom:10px;"></div>
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
	
	full = document.tetap.bulan.value+'|'+document.tetap.tahun.value+'|'+document.tetap.jenis_pajak.value;
	
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_buku?full='+full, '', 'height=700,width=1000,scrollbars=yes');
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
		
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_buku/"+document.tetap.bulan.value+"/"+document.tetap.tahun.value+"/"+document.tetap.jenis_pajak.value,function() {
		document.tetap.tpdf.disabled = false;
		//statusEnding();
	});
}

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No. ,No.SSPD, Rekening, Diterima dari, NPWPD, JUMLAH",//27
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,120,290,350,100,140");
mygrid.setColAlign("center,center,left,left,center,right");
mygrid.setColTypes("ro,ro,ro,ro,ro,ron");
mygrid.setNumberFormat("0,000",5,",",".");
mygrid.setColSorting("str,str,str,str,str,int");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpTar>{#stat_total}</div>");
mygrid.init();
</script>