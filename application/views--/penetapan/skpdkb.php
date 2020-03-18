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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
<script src="<?php echo base_url(); ?>assets/rumus.js" type="text/javascript"></script>

<div style="height:100%; overflow:auto;">
<script language="javascript">
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function lihat() {
		if(document.frmSKPDKB.sptpd.value=="") {
			alert("No. SPTPD Tidak Boleh Kosong");
			document.frmSKPDKB.sptpd.focus();
			return;
		}
		//alert(document.frmSKPDKB.nota.value);
		var postStr =
		"nota=" + document.frmSKPDKB.nota.value +
		"&sptpd=" + document.frmSKPDKB.sptpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdkb/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSKPDKB.dp.value = format_number(arr[0]);
					document.frmSKPDKB.setoran.value = format_number(arr[1]);
					document.frmSKPDKB.tgl.value = arr[2];
					document.frmSKPDKB.tempo.value = arr[3];
					//disableData();
					hasil = arr[4] - arr[1];
					document.frmSKPDKB.jumlah.value = format_number(hasil);
				} else {
					alert('Maaf No Nota Hitung tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function loadItem(){
		b = document.frmSKPDKB.nota.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gride.clearAll();
		gride.loadXML(base_url+"index.php/skpdkb/dataItemPajak1/"+pasang,function() { statusEnding(); });			
	}
	
	function kosongfrmSKPDKB() {
		document.frmSKPDKB.id.value = "";
		document.frmSKPDKB.urut.value = "";
		document.frmSKPDKB.skpdkb.value = "";
		document.frmSKPDKB.tgl.value = "";
		document.frmSKPDKB.nota.value = "";
		document.frmSKPDKB.sptpd.value = "";
		document.frmSKPDKB.npwpd.value = "";
		document.frmSKPDKB.nama.value = "";
		document.frmSKPDKB.alamat.value = "";
		document.frmSKPDKB.awal.value = "";
		document.frmSKPDKB.akhir.value = "";
		document.frmSKPDKB.tahun.value = "";
		document.frmSKPDKB.tempo.value = "";
		document.frmSKPDKB.dp.value = "";
		document.frmSKPDKB.setoran.value = "";
	}
	
	function simpan() {
		arr1 = document.frmSKPDKB.urut.value;
		arr2 = document.frmSKPDKB.skpdkb.value;
		arrfull = arr1+'/'+arr2;
		
		t = document.frmSKPDKB.tgl.value;
		s = t.split("/");
		tgl = s[2]+'-'+s[1]+'-'+s[0];
		
		p = document.frmSKPDKB.tempo.value;
		q = p.split("/");
		tempo = q[2]+'-'+q[1]+'-'+q[0];
		
		rundpPO()
		var postStr =
			"id=" + document.frmSKPDKB.id.value +
			"&kode=" + document.frmSKPDKB.kode.value +
			"&skpdkb=" + arrfull +
			"&nota=" + document.frmSKPDKB.nota.value +
			"&sptpd=" + document.frmSKPDKB.sptpd.value +
			"&npwpd=" + document.frmSKPDKB.npwpd.value +
			"&dp=" + document.frmSKPDKB.dp.value +
			"&setoran=" + document.frmSKPDKB.setoran.value +
			"&tgl=" + tgl +
			"&tempo=" + tempo +
			"&awal=" + document.frmSKPDKB.awal.value +
			"&akhir=" + document.frmSKPDKB.akhir.value +
			"&tahun=" + document.frmSKPDKB.tahun.value +
			"&jumlah=" + document.frmSKPDKB.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdkb/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					arr = result.split("/");
					document.frmSKPDKB.urut.value = arr[0];
					document.frmSKPDKB.skpdkb.value = arr[1]+"/"+arr[2];
					document.frmSKPDKB.no_skpdkb.value = result;
					tmpRows();
					refreshData();
					enableButton();
					alert("Done");
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function disableButton() {
		document.frmSKPDKB.edit1.disabled = true;
		document.frmSKPDKB.delete1.disabled = true;
		document.frmSKPDKB.cetak.disabled = true;
		document.frmSKPDKB.tambah.disabled = true;
		document.frmSKPDKB.cari1.disabled = true;
	}
	
	function enableButton() {
		document.frmSKPDKB.baru1.disabled = false;
		document.frmSKPDKB.edit1.disabled = false;
		document.frmSKPDKB.delete1.disabled = false;
		document.frmSKPDKB.cetak.disabled = false;
		document.frmSKPDKB.tambah.disabled = true;
		document.frmSKPDKB.cari1.disabled = true;
	}
</script>
<style>
body{
	background:#FFF;
}
</style>
<h2 style="margin:30px 5px 25px 30px;">Surat Ketetapan Pajak Kurang Bayar(SKPKB) - <?php echo $title; ?></h2>

<div id="a_tabbar" style="width:1000px; height:510px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPDKB" id="frmSKPDKB" method="post" >
    <br /><input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>" />
   	  <table width="870" border="0">
      		<tr>
        		<td width="234" style="padding-left:15px;">No. SKPKB</td>
           	  	<td width="367">
                <input type="hidden" name="id" id="id" size="35" /><input type="hidden" name="no_skpdkb" id="no_skpdkb" size="35" />
                <input type="text" name="urut" id="urut" size="22" style="background-color:#FFFFCC;" disabled/>&nbsp;/&nbsp;
                <input type="text" name="skpdkb" id="skpdkb" size="15" style="background-color:#FFFFCC;" disabled/></td>
                <td width="255" align="right">Tanggal &nbsp;<input type="text" name="tgl" id="tgl" size="10" disabled/></td>
        	</tr>
            <tr>
                <td style="padding-left:15px;">No. Nota Hitung</td>
                <td><input type="text" name="nota" id="nota" size="32" style="text-transform:uppercase; background-color:#FFCC99;" disabled/>
                <input type="button" onclick="opens()" value="Cari" name="cari1" style="padding-left:20px; padding-right:20px" disabled/>
              </td>
                <td align="right">No. SPTPD&nbsp;
                <input type="text" name="sptpd" id="sptpd" disabled/></td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">NPWPD</td>
                <td><input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase;" disabled/></td>
                <td>Dasar Pengenaan&nbsp;</td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Nama</td>
                <td><input type="text" name="nama" id="nama" size="45" disabled/></td>
                <td><input type="text" name="dp" id="dp" style="text-align:right" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat</td>
                <td><input type="text" name="alamat" id="alamat" size="45" disabled/></td>
                <td>Ketetapan Setoran&nbsp;</td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Masa Pajak</td>
                <td><select name="awal" id="awal" disabled>
                <option value=""></option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
                </select>
                &nbsp;s/d&nbsp;
                <select name="akhir" id="akhir" disabled>
                <option value=""></option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
                </select>&nbsp;&nbsp;&nbsp;Tahun &nbsp;
                <select name="tahun" id="tahun" disabled>
                <option value=""></option>
                <?php echo $tahun; ?>
                </select></td>
                <td><input type="text" name="setoran" id="setoran" style="text-align:right" disabled/></td>
             </tr>
             <tr>
              	<td style="padding-left:15px;"> Tanggal Jatuh Tempo</td>
                <td colspan="2"><input type="text" name="tempo" id="tempo" size="25" disabled/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <font color="red">Setoran Wajib Pajak</font>
                <input type="text" name="tempo" id="tempo" style="text-align:right" disabled/></td>
            </tr>
			<tr>
            	<td colspan="4">
    <div style="padding:10px 15px 0 15px;">
   		<div id="gridCo" height="150px" width="850px" style="margin-bottom:10px;"></div>
    </div>
		</td>
    </tr>
	<tr>
    	<td width="234" style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right">Jumlah &nbsp;<input type="text" name="jumlah" id="jumlah" style="text-align:right" disabled/></td>
    </tr>
    <tr>
       	<td style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="baru()" name="baru1" style="padding-left:20px; padding-right:20px"/>&nbsp;&nbsp;
        <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/></td>
        <td colspan="3" style="background-color:#FFCC99;"><input type="button" value="Edit" onclick="ubah" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Cetak" onclick="cetak1()" name="cetak" style="padding-left:20px; padding-right:20px" disabled/></td>
	</tr>
</table>
</form>
<br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="425px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
    <br />
</div>
</div>

<div id="objNota" style="display:none;">
<br />
<form name="cSPTPDt" id="cSPTPDt" method="post" action="javascript:void(0);">
<table width="790" border="0">
	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="no_nota">No. Nota Hitung</option>
        	<option value="sptpd">No. SPTPD</option>
            <option value="npwpd">NPWPD Perusahaan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCost" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<script language="javascript">
	function ubah(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dpkaskpkb1'){
				document.frmSKPDKB.baru1.disabled = false;
				document.frmSKPDKB.tambah.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
function cetak1() {
		var s = document.frmSKPDKB.skpdkb.value;
		var dua = document.frmSKPDKB.urut.value;
		
		var gabung = dua+'/'+s;
		//alert(gabung);
		window.open('<?php echo site_url(); ?>/skpdkb/cetak1?no_skpdkb='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	function lihat3() {
		if(document.cSPTPDt.values.value=="") { kata_kunci = 0; } else { kata_kunci = document.cSPTPDt.values.value; }
		statusLoading();
		gridq.clearAll();	
		gridq.loadXML(base_url+"index.php/skpdkb/cariData/"+kata_kunci+"/"+document.cSPTPDt.fil.value+"/"+document.frmSKPDKB.kode.value,function() {  statusEnding(); });
	}
	
	gridq = new dhtmlXGridObject('gridCost');
	gridq.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridq.setHeader("no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	gridq.setInitWidths("50,170,150,150,100,100,100,100,100");
	gridq.setColAlign("center,left,left,left,left,left,left,left,left");
	gridq.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridq.setColSorting("str,str,str,str,str,str,str,str,str");
	gridq.enablePaging(true,5,10,"pagingArea",true);
	gridq.setPagingSkin("bricks");
	gridq.setColumnHidden(0,true);
	
	gridq.setSkin("dhx_skyblue");
	gridq.attachEvent("onRowDblClicked", selectedOpenData2);
	gridq.init();
	
	function selectedOpenData2(id) {
		document.frmSKPDKB.nota.value 	= gridq.cells(id,0).getValue();
		document.frmSKPDKB.npwpd.value 	= gridq.cells(id,2).getValue();
		document.frmSKPDKB.nama.value 	= gridq.cells(id,3).getValue();
		document.frmSKPDKB.alamat.value 	= gridq.cells(id,4).getValue();
		document.frmSKPDKB.awal.value 	= gridq.cells(id,5).getValue();
		document.frmSKPDKB.akhir.value 	= gridq.cells(id,6).getValue();
		document.frmSKPDKB.tahun.value 	= gridq.cells(id,7).getValue();
		document.frmSKPDKB.sptpd.value 	= gridq.cells(id,1).getValue();
		lihat();
		loadItem();
		batal();
	}
	
	cRs = dhxWins.createWindow("cRs",0,0,800,390);
	cRs.setText("Pencarian Data Nota Perhitungan");
	cRs.button("park").hide();
	cRs.button("close").hide();
	cRs.button("minmax1").hide();
	cRs.hide();

	function opens() {
		cRs.show();
    	//cRs.setModal(true);
		cRs.center();
		cRs.attachObject('objNota');
	}
	
	function batal() {
		cRs.hide();
		cRs.setModal(false);
		document.cSPTPDt.fil.value = "";
		document.cSPTPDt.values.value = "";
		//grids.clearAll();
	}
	
	function baru(){
		enabledData();
		document.frmSKPDKB.tambah.disabled = false;
		document.frmSKPDKB.cari1.disabled = false;
		document.frmSKPDKB.nota.focus();
		document.frmSKPDKB.edit1.disabled = true;
		document.frmSKPDKB.delete1.disabled = true;
		document.frmSKPDKB.cetak.disabled = true;
		kosongfrmSKPDKB();
		jumchild();
		gride.clearAll();
	}
	
	function enabledData(){
		document.frmSKPDKB.nota.disabled = false;
		document.frmSKPDKB.tgl.disabled = false;
	}
	
	function c() {
		alert(document.tmp_jml);
	}
	
	function jumchild(){
		document.getElementById('tmpDp').innerHTML = "";
		document.getElementById('tmpTar').innerHTML = "";
		document.getElementById('tmpNaik').innerHTML = "";
		document.getElementById('tmpDen').innerHTML = "";
		document.getElementById('tmpSasi').innerHTML = "";
		document.getElementById('tmpBun').innerHTML = "";
		document.getElementById('tmpJml').innerHTML = "";
	}
	
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, SKPDKB",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gride.setInitWidths("100,100,100,120,100,100,70,70,90,70");
	gride.setColAlign("left,left,right,right,right,right,right,right,right,left");
	gride.setColTypes("ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
	gride.setColSorting("str,str,str,str,str,str,str,str,str,str");
	gride.enablePaging(true,5,10,"pagingArea",true);
	gride.setPagingSkin("bricks");
	gride.setColumnHidden(9,true);
	gride.setNumberFormat("0,000",2,",",".");
	gride.setNumberFormat("0,000",3,",",".");
	gride.setNumberFormat("0,000",4,",",".");
	gride.setNumberFormat("0,000",5,",",".");
	gride.setNumberFormat("0,000",6,",",".");
	gride.setNumberFormat("0,000",7,",",".");
	gride.setNumberFormat("0,000",8,",",".");
	gride.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.init();
	
	var dpps = "";
	function rundpPO(){
	dpps = new dataProcessor("<?php echo site_url(); ?>/skpdkb/child_skpdkb");
	dpps.setUpdateMode("off");
	dpps.init(gride);	
	//alert("DONE");
	dpps.attachEvent("onAfterUpdateFinish", function() {	
		statusEnding();
		//kosongfrmSKPDKB();
		//alert("DONE");
		return true;
	});
	}
	
	// get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows() {
		//alert('ok');
        var arr = gride.getAllItemIds().split(',');
        for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gride.cells(id,0).getValue()+'|'+
            gride.cells(id,1).getValue()+'|'+
            gride.cells(id,2).getValue()+'|'+
            gride.cells(id,3).getValue()+'|'+
            gride.cells(id,4).getValue()+'|'+
            gride.cells(id,5).getValue()+'|'+
            gride.cells(id,6).getValue()+'|'+
            gride.cells(id,7).getValue()+'|'+
            gride.cells(id,8).getValue()+'|'+
            gride.cells(id,9).getValue();
			                                    
        }
		
		gride.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
        }
        
		r = new Array();
        dpps.sendData();  
    }
	
	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gride.uid();
        var posisi = gride.getRowsNum();
        // Split Array
        var arrs = r[arrIndx].split('|');
		//alert(arr);       
        var row1= arrs[0];
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
        var row6= arrs[5];
        var row7= arrs[6];
        var row8= arrs[7];
		var row9= arrs[8];
		var row10= document.frmSKPDKB.no_skpdkb.value;
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
			//alert('1');
        //}
    }
	
	function cek(){
		gride.clearAll();
		gride.loadXML("<?php echo site_url(); ?>/skpdkb/child_skpdkb?skpdkb="+document.frmSKPDKB.no_skpdkb.value);
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_skpdkb, nota_hitung, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, no_sptpd, tgl_tempo, dp, setoran, jumlah",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,170,150,150,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/skpdkb/data?kode="+document.frmSKPDKB.kode.value);
	grid.init();
	
	function selectedOpenData(id) {
		statusLoading();
		kosongfrmSKPDKB();
		//enableButton();
		document.frmSKPDKB.baru1.disabled = true;
		document.frmSKPDKB.tambah.disabled = true;
		document.frmSKPDKB.edit1.disabled = false;
		document.frmSKPDKB.delete1.disabled = false;
		document.frmSKPDKB.cetak.disabled = false;
		
		tabbar.setTabActive("a1");
		document.frmSKPDKB.id.value	= grid.cells(id,0).getValue();
		document.frmSKPDKB.no_skpdkb.value = grid.cells(id,1).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmSKPDKB.urut.value = arr[0];
		document.frmSKPDKB.skpdkb.value = arr[1]+'/'+arr[2];
		document.frmSKPDKB.nota.value = grid.cells(id,2).getValue();
		document.frmSKPDKB.npwpd.value = grid.cells(id,3).getValue();
		document.frmSKPDKB.nama.value 	= grid.cells(id,4).getValue();
		document.frmSKPDKB.alamat.value 	= grid.cells(id,5).getValue();
		document.frmSKPDKB.awal.value 	= grid.cells(id,6).getValue();
		document.frmSKPDKB.akhir.value	= grid.cells(id,7).getValue();
		document.frmSKPDKB.tahun.value	= grid.cells(id,8).getValue();
		document.frmSKPDKB.tgl.value = grid.cells(id,9).getValue();
		document.frmSKPDKB.sptpd.value = grid.cells(id,10).getValue();
		document.frmSKPDKB.tempo.value = grid.cells(id,11).getValue();
		document.frmSKPDKB.dp.value = format_number(grid.cells(id,12).getValue());
		document.frmSKPDKB.setoran.value = format_number(grid.cells(id,13).getValue());
		document.frmSKPDKB.jumlah.value = format_number(grid.cells(id,14).getValue());
		cek();
		//loadjml();
		statusEnding();
	}
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/skpdkb/data?kode="+document.frmSKPDKB.kode.value);
	}
	
	function enableButton() {
		document.frmSKPDKB.edit1.disabled = false;
		document.frmSKPDKB.delete1.disabled = false;
		document.frmSKPDKB.cetak.disabled = false;
		document.frmSKPDKB.tambah.disabled = false;
		document.frmSKPDKB.cari1.disabled = true;
		document.frmSKPDKB.nota.disabled = true;
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
						"no=" + document.frmSKPDKB.urut.value+'/'+document.frmSKPDKB.skpdkb.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/skpdkb/delete', postStr, responeDel);	
				}
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function responeDel(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmSKPDKB();
					refreshData();
					enableButton();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	statusEnding();
</script>
</div>