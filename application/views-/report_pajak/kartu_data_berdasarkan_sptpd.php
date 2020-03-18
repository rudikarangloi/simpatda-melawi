<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>

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

<!-- connector -->
<script src="<?php echo base_url(); ?>assets/codebase_connector/common/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/codebase_connector/connector.js" type="text/javascript" charset="utf-8"></script>

<!-- calendar begin-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<style>
body{
	background:#FFF;
}
</style>
<div align="center">

	<h2>Kartu Data Wajib Pajak Berdasarkan SPTPD<br />Surat Pemberitahuan Terhutang Pajak Daerah</h2>
	<form name="kartu" id="kartu">
    	<table>
        	<tr>
            	<td style="padding-left:15px;">NPWPD Perusahaan</td>
                <td><input type="text" name="npwpd" id="npwpd" />&nbsp;
                <input type="button" id="cari" name="cari" value="Cari" style="padding-left:20px; padding-right:20px"  onclick="opens();" /></td>
            </tr>
        	<tr>
            	<td style="padding-left:15px;">Tahun Setoran</td>
                <td><input type="text" name="awal" id="awal" size="7" />&nbsp;s/d&nbsp;<input type="text" name="akhir" id="akhir" size="7" />&nbsp;
                <input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;&nbsp;<input type="button" name="bpdf" id="bpdf" onclick="pdf();" value="Cetak to PDF" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>
    
    <table>
    	<tr>
        	<td style="padding-left:15px;">NPWPD Perusahaan</td>
            <td width="5">:</td>
            <td width="350"><span id="npwpd_perusahaan"></span></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">Nama Perusahaan</td>
            <td width="5">:</td>
            <td><span id="nama_perusahaan"></span></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">Alamat Perusahaan</td>
            <td width="5">:</td>
            <td><span id="alamat_perusahaan"></span></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">Nama Pemilik</td>
            <td width="5">:</td>
            <td><span id="nama_pemilik"></span></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">Alamat Pemilik</td>
            <td width="5">:</td>
            <td><span id="alamat_pemilik"></span></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;">No. Handphone</td>
            <td width="5">:</td>
            <td><span id="hp"></span></td>
        </tr>
    </table>
    <br />
<div id="gridbox" width="1200px" height="300px" style="margin-bottom:10px;"></div>
</div>

<div id="objsBrg" style="display:none;">
<br />
<form name="frmSrc2" id="frmSrc2" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<script type="text/javascript">
function pdf(){
	var npwpd = document.kartu.npwpd.value;
	var awal = document.kartu.awal.value;
	var akhir = document.kartu.akhir.value;
	var full = npwpd+'-'+awal+'-'+akhir;
	
	window.open('<?php echo site_url(); ?>/report_pajak/cetak_kartu_sptpd?full='+full, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
	if(document.kartu.npwpd.value=="") {
		alert("NPWPD Tidak Boleh Kosong");
		document.kartu.npwpd.focus();
		return;
	}
	
	if(document.kartu.awal.value=="") {
		alert("Tanggal Awal Tidak Boleh Kosong");
		document.kartu.awal.focus();
		return;
	}
	
	if(document.kartu.akhir.value=="") {
		alert("Tanggal Akhir Tidak Boleh Kosong");
		document.kartu.akhir.focus();
		return;
	}
	
	aw = document.kartu.awal.value;
	//awal = aw[0]+'-'+aw[1]+'-'+aw[2];
	
	ak = document.kartu.akhir.value;
	//akhir = ak[0]+'-'+ak[1]+'-'+ak[2];
	
	statusLoading();
	mygrid.clearAll();
	mygrid.loadXML("<?php echo site_url(); ?>/report_pajak/data_kartu_sptpd/"+document.kartu.npwpd.value+"/"+aw+"/"+ak,function() {
		cariData();
		statusEnding();
	});
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%Y');
	
cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%Y');

function cariData(){
	var postr = 
		'npwpd=' + document.kartu.npwpd.value;
	dhtmlxAjax.post(base_url+'index.php/report_pajak/data_card', postr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					//alert(result);
					r = result.split("|");
					document.getElementById('npwpd_perusahaan').innerHTML=r[0];
					document.getElementById('nama_perusahaan').innerHTML=r[1];
					document.getElementById('alamat_perusahaan').innerHTML=r[2];
					document.getElementById('nama_pemilik').innerHTML=r[3];
					document.getElementById('alamat_pemilik').innerHTML=r[4];
					document.getElementById('hp').innerHTML=r[5];
					document.kartu.bpdf.disabled = false;
					statusEnding();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}

	wBrg = dhxWins.createWindow("wBrg",0,0,800,450);
	wBrg.setText("Pencarian Data Perusahaan");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function opens() {
		document.kartu.bpdf.disabled = true;
		wBrg.show();
    	//wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objsBrg');
	}
	
	function batal() {
		wBrg.hide();
		wBrg.setModal(false);
		document.frmSrc2.fil.value = "0";
		document.frmSrc2.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmSrc2.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmSrc2.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc2.values.focus();
			return;
			}
		}
		nilai = document.frmSrc2.values.value;
		statusLoading();
		gridx.clearAll();
		gridx.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridx= new dhtmlXGridObject('gridCo');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridx.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridx.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridx.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridx.enablePaging(true,10,10,"pagingArea",true);
	gridx.setPagingSkin("bricks");
	gridx.setSkin("dhx_skyblue");
	gridx.setColumnHidden(0,true);
	gridx.attachEvent("onRowDblClicked", selectedOpenData2);
	gridx.init();
	
	function selectedOpenData2(id) {
		document.kartu.npwpd.value 	= gridx.cells(id,1).getValue();
		batal();
	}
	
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("NO.,NO SPTPD, NO. SSPD, TGL PEMBAYARAN, MASA PAJAK, TAHUN, JUMLAH PAJAK, DENDA, REALISASI, KET",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("40,150,150,160,140,80,140,100,140,100");
mygrid.setColAlign("center,center,center,center,center,center,right,right,right,left");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ron,ro");
mygrid.setNumberFormat("0,000",6,",",".");
mygrid.setNumberFormat("0,000",7,",",".");
mygrid.setNumberFormat("0,000",8,",",".");
mygrid.setColSorting("str,str,str,str,str,int,int,int,int,str");
mygrid.setSkin("dhx_skyblue");
mygrid.attachFooter("Jumlah,#cspan,#cspan,#cspan,#cspan,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>");
mygrid.init();
</script>