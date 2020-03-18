<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Demo</title>
	<link rel='STYLESHEET' type='text/css' href='<?php echo base_url();?>assets/codebase_grid/dhtmlxgrid.css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxcommon.js'></script>
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxgrid.js'></script>
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxgridcell.js'></script>
	<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
	
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
	.oval_big2 {
		width: 900px;
		margin:30px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>
</head>
<body>
<div style="height:100%; overflow:auto;">

  <h2 style="margin:30px 5px 25px 30px;">Report Register dan Pemilik</h2>
  <div class="oval_big2">
    <form name="frmReport" id="frmReport" action="#" method="post" >
     	<table width="888" cellspacing="0">
		<tr>
			<td height="20"></td>
		</tr>
        <tr>
        	<td width="146" style="padding-left:15px;">Data Pendaftaran</td>
          	<td width="736">
				<select name="opt" id="opt">
                	<option value=""></option>
					<option value="register">Register</option>
					<option value="pemilik">Pemilik</option>
				</select>
		  	</td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">Tanggal</td>
			<td><input type="text" name="awal" id="awal"> s/d <input type="text" name="akhir" id="akhir"></td>
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="2" style="padding-left:15px;">
            <input type="button" name="display" id="display" onclick="tampil()" value="Display" />&nbsp;&nbsp;<input type="button" name="excel" id="excel" onclick="mygri.toExcel('<?php echo base_url();?>assets/grid2excel/server/generate.php');" value="Cetak to Excel" style="padding-left:20px; padding-right:20px" />&nbsp;&nbsp;<!--<input type="button" name="pdf" id="pdf" onclick="toPdf()" value="Cetak to Pdf" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;--></td>
        <tr>
        	<td colspan="2">
            <br /><div id="gridbox" style="width:100%; height:380px"></div></td>
        </tr>
      </table>
    </form>
    <br />
</div>
</div>
<script type="text/javascript">
	mygri = new dhtmlXGridObject('gridbox');
	mygri.setImagePath("<?php echo base_url();?>assets/codebase_excel/imgs/");
	mygri.setHeader("ID,ID_Pemilik,Jenis Identitas,Kewarganegaraan,No.Identitas,Nama,Alamat,Jalan,RT,RW,Email,Kelurahan,Kecamatan,Kabupaten,Tempat Lahir, Tanggal Lahir,Jenis Kelamin,Lokasi,HP");
	mygri.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100")
	mygri.enableMultiline(true)
	mygri.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left")
	mygri.setColTypes("ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
	mygri.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
	mygri.setSkin("dhx_skyblue")
	mygri.init();
	
  function enabledButton(){
  	document.frmReport.excel.disabled = false;
	//document.frmReport.pdf.disabled = false;
  }
  
  	cal1 = new dhtmlxCalendarObject('awal');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('akhir');
	cal2.setDateFormat('%d/%m/%Y');
	
	function tampil(){
		if(document.frmReport.opt.value=="") {
			alert("Data Pendaftaran Tidak Boleh Kosong");
			document.frmReport.opt.focus();
			return;
		}
		
		if(document.frmReport.awal.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			document.frmReport.awal.focus();
			return;
		}
		
		if(document.frmReport.akhir.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			document.frmReport.akhir.focus();
			return;
		}
		
		awal_1 = document.frmReport.awal.value;
		awal_2 = awal_1.split("/");
		awal = awal_2[2]+'-'+awal_2[1]+'-'+awal_2[0];
		
		akhir_1 = document.frmReport.akhir.value;
		akhir_2 = akhir_1.split("/");
		akhir = akhir_2[2]+'-'+akhir_2[1]+'-'+akhir_2[0];
		
		mygri.clearAll();
		mygri.loadXML("<?php echo site_url(); ?>/izin/data_report?opt="+document.frmReport.opt.value+"&awal="+awal+"&akhir="+akhir);
		enabledButton();
	}
		
	
</script>
</body>
</html>
