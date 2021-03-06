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

	<h2>Daftar Wajib Pajak Reklame</h2>
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
								echo "<option value=".$rs->kd_rek.">".$rs->kd_rek." || ".$rs->nm_rek."</option>";
							}
						?>
					</select>&nbsp;   
                <input type="button" value="Display" onclick="tampil()" />&nbsp;
                <input type="button" name="tpdf" id="tpdf" onclick="pdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" />&nbsp;<input type="button" name="xls" id="xls" onclick="txls();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" />
                </td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1115px" height="550px" style="margin-bottom:10px;"></div>
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
	
	window.open('<?php echo site_url(); ?>/report_pajak2/cetak_rek?full='+full, '', 'height=700,width=1000,scrollbars=yes');
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
	window.open('<?php echo site_url(); ?>/report_pajak2/excel_rek?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.tetap.awal.value=="") {
		alert("Tanggal Setoran Tidak Boleh Kosong");
		document.tetap.awal.focus();
		return;
	}
	
	if(document.tetap.akhir.value=="") {
		alert("Tanggal Setoran Tidak Boleh Kosong");
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
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_rek/"+awal+"/"+akhir+"/"+pajak,function() {
		awal2 = s[2]+'-01-01';
		if(akhir2<awal2){
			document.getElementById('tmpSDp').innerHTML=0;
			document.getElementById('tmpSTar').innerHTML=0;
		} else {
			lastDay(awal2,akhir2,pajak);
		}
		document.tetap.tpdf.disabled = false;
		//statusEnding();
	});
}

function lastDay(awal2,akhir2,pajak){
	var postr = 
		'awal=' + awal2 +
		'&akhir=' + akhir2 +
		'&pajak=' + pajak;
	dhtmlxAjax.post('<?php echo site_url(); ?>/report_pajak2/data_sktgl', postr, responePOST);
}
	
function responePOST(loader) {
	if (loader.xmlDoc.readyState == 4) {
		if (loader.xmlDoc.status == 200) {
			result = loader.xmlDoc.responseText;
			if(result) {
				r = result.split("|");
				document.getElementById('tmpSDp').innerHTML=r[0];
				document.getElementById('tmpSTar').innerHTML=r[1];
			}
		} else {
			alert('There was a problem with the request.');
		}
	}
}


cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');

cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%d/%m/%Y');

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("No. ,Nama, Alamat Usaha, NPWPD, Tema Reklame, Lokasi, Nama Usaha, Ukuran, TMT, TGL Bayar",//12 --> //9
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,200,200,150,320,450,200,110,160,110");
mygrid.setColAlign("center,left,left,center,left,center,center,center,center,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
/* mygrid.setNumberFormat("0,000",8,",",".");
mygrid.setNumberFormat("0,000",9,",",".");
mygrid.setNumberFormat("0,000",10,",","."); */
mygrid.setColSorting("str,str,str,str,str,str,str,int,str,str");
mygrid.setSkin("dhx_skyblue");
//mygrid.attachFooter("Jumlah Penerimaan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp1>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>");
//mygrid.attachFooter("Jumlah Penerimaan sampai dengan hari sebelumnya,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpSDp></div>,<div style=text-align:right id=tmpSTar></div>");
mygrid.init();
</script>