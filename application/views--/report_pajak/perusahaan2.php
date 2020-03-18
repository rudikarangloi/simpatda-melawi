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

	<h2>Laporan Data Wajib Pajak</h2>
	<form name="tetap" id="tetap">
    	<table>
			<tr>
            	<td style="padding-left:15px;">Tanggal</td>
                <td><input type="text" name="awal" id="awal" size="15" />&nbsp;                <input type="text" name="akhir" id="akhir" size="15" />
                </td>
            </tr>
        	<tr>
            	<td style="padding-left:15px;">Jenis Pajak</td>
                <td><select name="jenis_pajak" id="jenis_pajak">
						<option value=""></option>
						<?php 
						foreach($pajak->result() as $rs) {
								echo "<option value=".$rs->kode_pajak.">".$rs->nama_sptpd."</option>";
							}
						?>
					</select>&nbsp;                    
                <input type="button" value="Display" onclick="tampil()" />&nbsp;				
                <input type="button" name="tpdf" id="tpdf" onclick="pdf();" value="Cetak to PDF 1" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;
				<input type="button" value="Display All" onclick="tampil_all()" />&nbsp;
				<input type="button" name="tpdf2" id="tpdf2" onclick="pdf_all();" value="Cetak to PDF 2" style="padding-left:20px; padding-right:20px" disabled/>
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
	
	if(document.tetap.akhir.value=="") {
		alert("Bulan Akhir Tidak Boleh Kosong");
		document.tetap.akhir.focus();
		return;
	}
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	o = document.tetap.akhir.value;
	p = o.split("/");
	akhir = p[2]+'-'+p[1]+'-'+p[0];
	
	pajak = document.tetap.jenis_pajak.value;
	full = awal+'|'+akhir+'|'+pajak;
	window.open('<?php echo site_url(); ?>/report_pajak2/cetak_usaha?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function pdf_all() {
	full = document.tetap.jenis_pajak.value;
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_usaha2?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){	
	if(document.tetap.awal.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	if(document.tetap.akhir.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		document.tetap.akhir.focus();
		return;
	}
	
	t = document.tetap.awal.value;
	s = t.split("/");
	awal = s[2]+'-'+s[1]+'-'+s[0];
	
	q = s[0]-1;
	akhir2 = s[2]+'-'+s[1]+'-'+q;
	
	o = document.tetap.akhir.value;
	p = o.split("/");
	akhir = p[2]+'-'+p[1]+'-'+p[0];
	pajak = document.tetap.jenis_pajak.value;	
		
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_usaha/"+awal+"/"+akhir+"/"+pajak,function() {
		document.tetap.tpdf.disabled = false;
		statusEnding();
	});
}

function tampil_all(){	
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_usaha_all",function() {
		document.tetap.tpdf2.disabled = false;
		statusEnding();
	});
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');

cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%d/%m/%Y');

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No. , TMT, Tanggal, NPWPD Baru, NPWPD Lama, Nama Pemilik , Nama Usaha, Alamat, Kecamatan, Kelurahan",//7
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("40,90,90,140,140,230,230,230,150,150");
mygrid.setColAlign("left,left,left,left,left,left,left,left,left,left");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.setColSorting("str,str,str,str,str,str,str,str,str,str");
mygrid.setSkin("dhx_skyblue");
mygrid.init();
</script>