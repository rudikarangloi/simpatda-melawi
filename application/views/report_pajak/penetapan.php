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
	<script src="<?php echo base_url(); ?>/assets/window.js"></script>
    
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

	<h2>Laporan Register Penetapan</h2>
	<form name="tetap" id="tetap">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Tanggal</td>
                <td><input type="text" name="awal" id="awal" size="15" />&nbsp;                <input type="text" name="akhir" id="akhir" size="15" />
                <input name="marginBawah" type="text" id="marginBawah" value="10" size="1" />
				Margin Bawah</td>
            </tr>
            <tr>
            	<td style="padding-left:15px;">Jenis Pajak</td>
                <td><select name="jenis_pajak" id="jenis_pajak">
						<option value="">Keseluruhan</option>
						<?php 
						foreach($pajak->result() as $rs) {
								echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
							}
						?>
						<option value="4.1.1.04.01">Reklame Permanen</option>
						<option value="4.1.1.04.02">Reklame Insidentil</option>
					</select>&nbsp;   
                <input type="button" value="Display" onclick="tampil()" />&nbsp;
                <input type="button" name="tpdf" id="tpdf" onclick="cetak(1);" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" />
				&nbsp;<input type="button" name="xls" id="xls" onclick="cetak(2);" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" />
                </td>
            </tr>
        </table>
    </form>
    
<div id="gridbox" width="1255px" height="550px" style="margin-bottom:10px;"></div>
</div>

<script>

function cetak(pilih) {
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
	var marginBawah = document.tetap.marginBawah.value;
	full = awal+'|'+akhir+'|'+pajak+'|'+marginBawah+'|'+pilih;
	
	window.open('<?php echo site_url(); ?>/report_pajak2/cetak_penetapan?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}


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
	var marginBawah = document.tetap.marginBawah.value;
	full = awal+'|'+akhir+'|'+pajak+'|'+marginBawah;
	
	window.open('<?php echo site_url(); ?>/report_pajak2/cetak_penetapan?full='+full, '', 'height=700,width=1000,scrollbars=yes');
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
	window.open('<?php echo site_url(); ?>/report_pajak2/excel_penetapan?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

/* function statusLoading() {  
            ModalPopups.Indicator("idIndicator",  
            "Please wait",  
            "<div style=''>" +   
                "<div style='float:left;'><img src='<?php echo base_url(); ?>/assets/modal/spinner.gif'></div>" +   
                "<div style='float:left; padding-left:10px;'>" +   
                "Permintaan Anda Sedang Diproses... <br/>" +   
                "Tunggu Beberapa Saat..." +   
                "<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
                "</div>",   
            {  
                okButtonText: "Close", 
                width: 300,  
                height: 100  
            }  
        );                  
       }

function statusEnding() {
            ModalPopups.Close("idIndicator");
        } */

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
	statusLoading();	
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_penetapan/"+awal+"/"+akhir+"/"+pajak,function() {
		/* awal2 = s[2]+'-01-01';
		if(akhir2<awal2){
			document.getElementById('tmpSDp').innerHTML=0;
			document.getElementById('tmpSTar').innerHTML=0;
		} else {
			lastDay(awal2,akhir2,pajak);
		} */
		document.tetap.tpdf.disabled = false;
		statusEnding();
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
mygrid.setHeader("No. ,No.SKPD, Tanggal SKP, Uraian, Kode Rekening, Nama Rekening, Pokok, Denda, Penerimaan,Status",//9
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,120,100,250,110,250,110,110,110,110");
mygrid.setColAlign("center,center,center,center,left,left,right,right,right,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ron,ro");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setNumberFormat("0,000",7,",",".");
mygrid.setNumberFormat("0,000",8,",",".");
//mygrid.setNumberFormat("0,000",9,",",".");
mygrid.setColSorting("str,str,str,str,str,str,int,int,int,str");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Jumlah Penerimaan,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpDp2>{#stat_total}</div>");
//mygrid.attachFooter("Jumlah Penerimaan sampai dengan hari sebelumnya,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpSDp></div>,<div style=text-align:right id=tmpSTar></div>");
mygrid.init();
</script>