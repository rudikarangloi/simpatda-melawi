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
<style>
body{
	background:#FFF;
}
</style>
<div style="height:100%; overflow:auto;">
<script language="javascript">
	function lihat() {
		if(document.frmSTPD.nota.value=="") {
			alert("No. SKPD Tidak Boleh Kosong");
			document.frmSTPD.nota.focus();
			return;
		}
		alert(document.frmSTPD.nota.value);
		var postStr =
		"nota=" + document.frmSTPD.nota.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/stpd/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSTPD.sptpd.value = arr[0];
					document.frmSTPD.npwpd.value = arr[1];
					document.frmSTPD.nama.value = arr[2];
					document.frmSTPD.alamat.value = arr[3];
					document.frmSTPD.awal.value = arr[4];
					document.frmSTPD.akhir.value = arr[5];
					document.frmSTPD.tahun.value = arr[6];
					document.frmSTPD.jumlah.value = arr[7];
					document.frmSTPD.tgl.value = arr[8];
					document.frmSTPD.tempo.value = arr[9];
					//disableData();
					cek();
				} else {
					alert('Maaf No Nota Hitung tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmSTPD() {
		document.frmSTPD.id.value = "";
		document.frmSTPD.urut.value = "";
		document.frmSTPD.skpdt.value = "";
		document.frmSTPD.tgl.value = "";
		document.frmSTPD.skpd.value = "";
		document.frmSTPD.sptpd.value = "";
		document.frmSTPD.npwpd.value = "";
		document.frmSTPD.nama_perusahaan.value = "";
		document.frmSTPD.alamat_perusahaan.value = "";
		document.frmSTPD.nama.value = "";
		document.frmSTPD.alamat.value = "";
		document.frmSTPD.awal.value = "";
		document.frmSTPD.akhir.value = "";
		document.frmSTPD.tahun.value = "";
		document.frmSTPD.tempo.value = "";
		document.frmSTPD.kohir.value = "";
		document.frmSTPD.jumlah.value = "";
	}
	
	function simpan() {
		arr1 = document.frmSTPD.urut.value;
		arr2 = document.frmSTPD.skpdt.value;
		arrfull = arr1+'/'+arr2;
		
		t = document.frmSTPD.tgl.value;
		s = t.split("/");
		tgl = s[2]+'-'+s[1]+'-'+s[0];
		
		p = document.frmSTPD.tempo.value;
		q = p.split("/");
		tempo = q[2]+'-'+q[1]+'-'+q[0];
		
		rundpPO()
		var postStr =
			"id=" + document.frmSTPD.id.value +
			"&kode=" + document.frmSTPD.kode.value +
			"&stpd=" + arrfull +
			"&skpd=" + document.frmSTPD.skpd.value +
			"&sptpd=" + document.frmSTPD.sptpd.value +
			"&npwpd=" + document.frmSTPD.npwpd.value +
			"&kohir=" + document.frmSTPD.kohir.value +
			"&nama=" + document.frmSTPD.nama.value +
			"&alamat=" + document.frmSTPD.alamat.value +
			"&tgl=" + tgl +
			"&tempo=" + tempo +
			"&awal=" + document.frmSTPD.awal.value +
			"&akhir=" + document.frmSTPD.akhir.value +
			"&tahun=" + document.frmSTPD.tahun.value +
			"&jumlah=" + document.frmSTPD.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/stpd/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					arrs = result.split("|");
					arr = arrs[0].split("/");
					document.frmSTPD.urut.value = arr[0];
					document.frmSTPD.skpdt.value = arr[1]+"/"+arr[2];
					document.frmSTPD.kohir.value = arrs[1];
					tmpRows();
					refreshData();
					document.frmSTPD.edit1.disabled = false;
					document.frmSTPD.delete1.disabled = false;
					document.frmSTPD.cetak.disabled = false;
					alert("Done");
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
</script>
<h2 style="margin:30px 5px 25px 30px;">Surat Tagihan Pajak Daerah (STPD) - <?php echo $title; ?></h2>

<div id="a_tabbar" style="width:1000px; height:550px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSTPD" id="frmSTPD" action="<?php echo site_url(); ?>/stpd/cetak_html" method="post" onSubmit="popupform(this, 'iui')" >
    <br /><input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>" />
   	  <table width="850" border="0">
      		<tr>
        		<td width="220" style="padding-left:15px;">No. STP</td>
           	  	<td>
                <input type="hidden" name="id" id="id" size="35" />
                <input type="text" name="urut" id="urut" size="22" disabled/>&nbsp;/&nbsp;
                <input type="text" name="skpdt" id="skpdt" size="15" disabled/></td>
                <td width="250" align="right">Tanggal &nbsp;<input type="text" name="tgl" id="tgl" size="10" disabled/></td>
        	</tr>
            <tr>
                <td style="padding-left:15px;">No. SKP</td>
                <td><input type="text" name="skpd" id="skpd" size="32" style="text-transform:uppercase; background-color: #FFCC99;" disabled/>
                <input type="button" onclick="openSTPD()" value="Cari" name="cari1" style="padding-left:20px; padding-right:20px" disabled/>
              </td>
                <td align="right">No. SPTPD&nbsp;
                <input type="text" name="sptpd" id="sptpd" disabled/></td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">NPWPD</td>
                <td><input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase;" disabled/></td>
                <td align="right">No. Kohir&nbsp;
                <input type="text" name="kohir" id="kohir" disabled/></td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Nama</td>
                <td colspan="2"><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat</td>
                <td colspan="2"><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Nama Pemilik</td>
                <td colspan="2"><input type="text" name="nama" id="nama" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat Pemilik</td>
                <td colspan="2"><input type="text" name="alamat" id="alamat" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Masa Pajak</td>
                <td colspan="3"><select name="awal" id="awal" disabled>
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
             </tr>
             <tr>
              	<td style="padding-left:15px;"> Tanggal Jatuh Tempo</td>
                <td colspan="2"><input type="text" name="tempo" id="tempo" size="25" disabled/></td>
            </tr>
		<tr>
        <td colspan="4">
    <div style="padding:10px 10px 0 15px;">
   		<div id="gridCo" height="150px" style="margin-bottom:10px;"></div>
    </div>
		</td>
    </tr>
	<tr>
    	<td width="200" style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right">Jumlah &nbsp;<input type="text" name="jumlah" id="jumlah" disabled/></td>
    </tr>
    <tr>
       	<td style="padding-left:15px;"><input type="button" value="Baru" onclick="baru()" name="baru1" style="padding-left:20px; padding-right:20px"/>&nbsp;&nbsp;
        <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/></td>
        <td colspan="3"><input type="button" value="Edit" onclick="ubah()" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Cetak" name="cetak" onclick="cetak1()" style="padding-left:20px; padding-right:20px" disabled/></td>
	</tr>
</table>
</form>
<br />

</div>
<div id="C2">
<div style="padding:0 0px 10px 0px;">
   	<div id="gridContent" height="480px" width="995px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<div id="objSTPD" style="display:none;">
<form name="cSPTPD" id="cSPTPD" method="post" action="javascript:void(0);"><br />
<table width="790" border="0">
	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="nota_hitung">No. Nota Hitung</option>
        	<option value="no_sptpd">No. SKPD</option>
            <option value="npwpd">NPWPD Perusahaan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihatSPTPD()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batalSTPD()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
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
			if(name=='dpkastp1'){
				document.frmSTPD.baru1.disabled = false;
				document.frmSTPD.tambah.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function cetak1() {
		var gabung = document.frmSTPD.urut.value+'/'+document.frmSTPD.skpdt.value;
		window.open('<?php echo site_url(); ?>/stpd/cetak_report?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
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
	
	function lihatSPTPD() {
		if(document.cSPTPD.values.value=="") { kata_kunci = 0; } else { kata_kunci = document.cSPTPD.values.value; }
		statusLoading();
		gridq.clearAll();	
		gridq.loadXML(base_url+"index.php/stpd/cariData/"+kata_kunci+"/"+document.cSPTPD.fil.value+"/"+document.frmSTPD.kode.value,function() {  statusEnding(); });
	}
	
	gridq = new dhtmlXGridObject('gridCost');
	gridq.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridq.setHeader("no_skpd, nota_hitung, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1,masa_pajak2, akhir, tahun, jumlah"); //12
	gridq.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100");
	gridq.setColAlign("left,left,left,left,left,left,left,right,right,left,left,left");
	gridq.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ro,ro,ro");
	//gridq.setNumberFormat("0,000",7,",",".");
	//gridq.setNumberFormat("0,000",8,",",".");
	gridq.setPagingSkin("bricks");
	
	gridq.setSkin("dhx_skyblue");
	gridq.attachEvent("onRowDblClicked", selectedOpenData2);
	gridq.init();
	
	function selectedOpenData2(id) {
		document.frmSTPD.skpd.value = gridq.cells(id,0).getValue();
		document.frmSTPD.sptpd.value = gridq.cells(id,2).getValue();
		document.frmSTPD.npwpd.value = gridq.cells(id,3).getValue();
		document.frmSTPD.nama.value = gridq.cells(id,6).getValue();
		document.frmSTPD.alamat.value = gridq.cells(id,7).getValue();
		document.frmSTPD.nama_perusahaan.value = gridq.cells(id,4).getValue();
		document.frmSTPD.alamat_perusahaan.value = gridq.cells(id,5).getValue();
		document.frmSTPD.awal.value = gridq.cells(id,8).getValue();
		document.frmSTPD.akhir.value = gridq.cells(id,9).getValue();
		document.frmSTPD.tahun.value = gridq.cells(id,10).getValue();
		document.frmSTPD.jumlah.value = gridq.cells(id,11).getValue();
		
		loadItem();
		loadchild();
		batalSTPD();
	}
	
	function loadchild(){
		b = document.frmSTPD.skpd.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gride.clearAll();
		gride.loadXML(base_url+"index.php/stpd/dataItemPajak12/"+pasang,function() { statusEnding(); });			
	}
	
	function loadItem(){
		gride.clearAll();
		var poStr1 =
		"skpd=" + document.frmSTPD.skpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/stpd/dataItemPajak1', poStr1, respePe);			
	}
	
	function respePe(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					ars = result.split('|');
					document.frmSTPD.tgl.value = ars[0];
					document.frmSTPD.tempo.value = ars[1];
				}
			}
		}
	}
	
	wSTPD = dhxWins.createWindow("wSTPD",0,0,800,370);
	wSTPD.setText("Pencarian Data SKPD");
	wSTPD.button("park").hide();
	wSTPD.button("close").hide();
	wSTPD.button("minmax1").hide();
	wSTPD.hide();

	function openSTPD() {
		wSTPD.show();
    	wSTPD.setModal(true);
		wSTPD.center();
		wSTPD.attachObject('objSTPD');
	}
	
	function batalSTPD() {
		wSTPD.hide();
		wSTPD.setModal(false);
		document.cSPTPD.fil.value = "";
		document.cSPTPD.values.value = "";
		//grids.clearAll();
	}
	
	function baru(){
		kosongfrmSTPD();
		enabledData();
		document.frmSTPD.tambah.disabled = false;
		document.frmSTPD.cari1.disabled = false;
		document.frmSTPD.edit1.disabled = true;
		document.frmSTPD.delete1.disabled = true;
		document.frmSTPD.cetak.disabled = true;
		document.frmSTPD.skpd.focus();
		gride.clearAll();
		jumchild();
	}
	
	function enabledData(){
		document.frmSTPD.skpd.disabled = false;
		document.frmSTPD.tgl.disabled = false;
		document.frmSTPD.kohir.disabled = false;
	}
	
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, stpd",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gride.setInitWidths("100,100,120,100,100,70,70,90,70,50");
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
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.enableSmartRendering(true);
	gride.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
	gride.init();
	
	var dpps = "";
	function rundpPO(){
	dpps = new dataProcessor("<?php echo site_url(); ?>/stpd/child_stpd");
	dpps.setUpdateMode("off");
	dpps.init(gride);	
	//alert("DONE");
	dpps.attachEvent("onAfterUpdateFinish", function() {	
		statusEnding();
		//kosongfrmSKPDKB();
		alert("DONE");
		return true;
	});
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
		var gabung = document.frmSTPD.urut.value+"/"+document.frmSTPD.skpdt.value;      
        var row1= arrs[0]
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
        var row6= arrs[5];
        var row7= arrs[6];
        var row8= arrs[7];
		var row9= arrs[8];
		var row10= gabung;
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
			//alert('1');
        //}
    }
	
	function cek(){
		gride.clearAll();
		gride.loadXML("<?php echo site_url(); ?>/stpd/child_stpd?stpd="+document.frmSTPD.urut.value+'/'+document.frmSTPD.skpdt.value);
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_stpd, no_skpd, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, no_kohir, tanggal, tanggal_tempo, jumlah");
	grid.setInitWidths("50,170,150,150,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/stpd/data?kode="+document.frmSTPD.kode.value);
	grid.init();
	
	function selectedOpenData(id) {
		statusLoading();
		kosongfrmSTPD();
		enableButton();
		document.frmSTPD.id.value	= grid.cells(id,0).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmSTPD.urut.value = arr[0];
		document.frmSTPD.skpdt.value = arr[1]+'/'+arr[2];
		document.frmSTPD.skpd.value = grid.cells(id,2).getValue();
		document.frmSTPD.sptpd.value = grid.cells(id,3).getValue();
		document.frmSTPD.npwpd.value 	= grid.cells(id,4).getValue();
		document.frmSTPD.nama_perusahaan.value 	= grid.cells(id,5).getValue();
		document.frmSTPD.alamat_perusahaan.value 	= grid.cells(id,6).getValue();
		document.frmSTPD.nama.value 	= grid.cells(id,7).getValue();
		document.frmSTPD.alamat.value 	= grid.cells(id,8).getValue();
		document.frmSTPD.awal.value	= grid.cells(id,9).getValue();
		document.frmSTPD.akhir.value	= grid.cells(id,10).getValue();
		document.frmSTPD.tahun.value = grid.cells(id,11).getValue();
		document.frmSTPD.kohir.value = grid.cells(id,12).getValue();
		document.frmSTPD.tgl.value = grid.cells(id,13).getValue();
		document.frmSTPD.tempo.value = grid.cells(id,14).getValue();
		document.frmSTPD.jumlah.value = grid.cells(id,15).getValue();
		cek();
		tabbar.setTabActive("a1");
		statusEnding();
	}
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/stpd/data?kode="+document.frmSTPD.kode.value);
	}
	
	function enableButton() {
		document.frmSTPD.edit1.disabled = false;
		document.frmSTPD.delete1.disabled = false;
		document.frmSTPD.cetak.disabled = false;
		document.frmSTPD.tambah.disabled = false;
		document.frmSTPD.cari1.disabled = true;
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dpkastp1'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
						"id=" + document.frmSTPD.urut.value+'/'+document.frmSTPD.skpdt.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/stpd/delete', postStr, responeDel);	
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
					//kosongfrmSTPD();
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