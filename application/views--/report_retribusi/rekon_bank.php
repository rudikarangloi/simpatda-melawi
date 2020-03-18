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

	<h2>Daftar Penerimaan Harian</h2>
	<form name="bln" id="bln">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">Periode</td>
                <td><input type="text" name="tgl" id="tgl"></td>
            </tr>
            <!--<tr>
            	<td style="padding-left:15px;">Type Pembayaran</td>
                <td><select name="bayar" id="bayar">
                <option value=""></option>
                <option value="1">Loket</option>
                <option value="200">Bank Nagari</option>
                <option value="300">Bank BTN</option>
                <option value="0009">Bank BNI</option>
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
					</select>&nbsp;</td>
            </tr>
            <tr>!-->
            	<td colspan="2" align="center">
                <input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;
                <!--<input type="button" name="pdf" id="pdf" onclick="tpdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/>--><input type="button" name="excel" id="excel" onclick="texcel();" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>

<div id="gridbox" width="2050px" height="550px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
cal1 = new dhtmlxCalendarObject('tgl');
cal1.setDateFormat('%d/%m/%Y');

function tpdf(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
//	if(document.bln.bayar.value=="") {
//		alert("Type Pembayaran Tidak Boleh Kosong");
//		document.bln.bayar.focus();
//		return;
//	}
	
	bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	pajak = document.bln.jenis_pajak.value;
	full = bayar+'|'+periode+'|'+pajak;
	window.open("<?php echo site_url(); ?>/report_pajak2/pdf_bank?full="+full,'width=500,height=400,scrollbars=1');
}

function texcel(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
	if(document.bln.bayar.value=="") {
		alert("Type Pembayaran Tidak Boleh Kosong");
		document.bln.bayar.focus();
		return;
	}
	
	bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	pajak = document.bln.jenis_pajak.value;
	//full = bayar+'|'+periode;
	window.open("<?php echo site_url(); ?>/report_pajak2/excel_bank/"+bayar+"/"+periode+"/"+pajak,'width=500,height=400,scrollbars=1');
}

function tampil(){
	if(document.bln.tgl.value=="") {
		alert("Tanggal Tidak Boleh Kosong");
		document.bln.tgl.focus();
		return;
	}
	
//	if(document.bln.bayar.value=="") {
//		alert("Type Pembayaran Tidak Boleh Kosong");
//		document.bln.bayar.focus();
//		return;
//	}

	//var bayar = document.bln.bayar.value;
	var p = document.bln.tgl.value;
	//alert(p);
	var o = p.split('/');
	periode = o[2]+'-'+o[1]+'-'+o[0];
	//pajak = document.bln.jenis_pajak.value;
	
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_retribusi2/data_bank/"+periode,function() {
		document.bln.excel.disabled = false;
		//statusEnding();
	});
}

function pasif(){
	document.bln.excel.disabled = true;
}
	
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url();?>assets/codebase_excel/imgs/");
mygrid.setHeader("No.,No. SPTRD, Tgl SPTRD, No. SSRD, Tgl SSRD, Nama Perusahaan, Alamat Perusahaan, NPWPD, Jenis Retribusi, Gol. Jenis Retribusi, Masa Retribusi, Tahun Retribusi, Pajak Tahun Berjalan, Piutang Retribusi, Denda, Total Bayar",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:left","text-align:left","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("50,120,80,120,80,200,200,100,190,190,130,90,130,120,120,120")
mygrid.setColAlign("center,center,center,center,center,left,left,center,left,left,center,center,right,right,right,right")
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ron,ron,ron")
mygrid.setNumberFormat("0,000",12,",",".")
mygrid.setNumberFormat("0,000",13,",",".")
mygrid.setNumberFormat("0,000",14,",",".")
mygrid.setNumberFormat("0,000",15,",",".")
mygrid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,int,int,int,int");
mygrid.enableMultiline(true)
mygrid.setSkin("dhx_skyblue")
mygrid.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>")
mygrid.init();
</script>