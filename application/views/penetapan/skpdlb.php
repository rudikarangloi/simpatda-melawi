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
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function detailLB() {
		var postStr =
		"skpd=" + document.frmSKPDLB.skpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdlb/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					arr = result.split('|');
					//tanggal jatuh tempo
					document.frmSKPDLB.tgl.value = arr[0];
					document.frmSKPDLB.tgl_terima.value = arr[0];
					document.frmSKPDLB.tgl_terima2.value = arr[1];
					lihat_child();
				} else {
					alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function lihat_child(){
		b = document.frmSKPDLB.skpd.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gride.clearAll();
		gride.loadXML(base_url+"index.php/skpdlb/lihat_child/"+pasang,function() { statusEnding(); });
	}
	
	function simpan() {
		if(document.frmSKPDLB.skpd.value=="") {
			document.frmSKPDLB.skpd.focus();
			alert("No SKP Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPDLB.awal2.value=="") {
			document.frmSKPDLB.awal2.focus();
			alert("Bulan Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPDLB.sk_bupati.value=="") {
			document.frmSKPDLB.sk_bupati.focus();
			alert("SK Bupati Tidak Boleh Kosong");
			return;
		}
		
		arrTgl = document.frmSKPDLB.tgl.value.split("/");
		tglTerima = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		//alert(tglTerima);
		
		arrTgl_1 = document.frmSKPDLB.tgl_terima.value.split("/");
		tgl1 = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		//alert(tgl1);
		
		arrTgl_2 = document.frmSKPDLB.tgl_terima2.value.split("/");
		tgl2 = arrTgl_2[2]+"-"+arrTgl_2[1]+"-"+arrTgl_2[0];
		//alert(tgl2);
		rundpPO();
		var postStr =
			"skpdlb=" + document.frmSKPDLB.skpdlb.value +
			"&id=" + document.frmSKPDLB.id.value +
			"&skpd=" + document.frmSKPDLB.skpd.value +
			"&tgl=" + tglTerima +
			"&npwpd=" + document.frmSKPDLB.npwpd.value +
			"&sspd=" + document.frmSKPDLB.sspd.value +
			"&awal2=" + document.frmSKPDLB.awal2.value +
			"&sk_bupati=" + document.frmSKPDLB.sk_bupati.value +
			"&tgl_sk=" + tgl1 +
			"&utang=" + document.frmSKPDLB.utang.value +
			"&awal=" + document.frmSKPDLB.awal.value +
			"&akhir=" + document.frmSKPDLB.akhir.value +
			"&tahun=" + document.frmSKPDLB.tahun.value +
			"&tempo=" + tgl2 +
			"&jumlah=" + document.frmSKPDLB.jumlah.value +
            "&jumlah_setoran=" + document.frmSKPDLB.jumlah_setoran.value +
            "&setoran_wp=" + document.frmSKPDLB.setoran_wp.value +
			"&lebihbayar=" + document.frmSKPDLB.lebihbayar.value + 
            "&kurangbayar=" + document.frmSKPDLB.kurangbayar.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdlb/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			document.frmSKPDLB.skpdlb.value = result;
			tmpRows();
			loadData();
			document.frmSKPDLB.btnEdit.disabled =false;
			document.frmSKPDLB.btnDel.disabled =false;
			document.frmSKPDLB.cetak.disabled =false;
			statusEnding();
		});
	}
	
	function hapus() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dpkaskplb1'){
				cnf = confirm("Apakah Anda Yakin ?")
				if(cnf) {
					var postStr =
						"skpdlb=" + document.frmSKPDLB.skpdlb.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/skpdlb/hapus', postStr, function(loader) {
						result = loader.xmlDoc.responseText;
						gridData.clearAll();
						loadData();
						statusEnding();
					});
				}
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function disableData() {
		document.frmSKPDLB.skpd.disabled = true;
		document.frmSKPDLB.awal2.disabled = true;
		document.frmSKPDLB.sk_bupati.disabled = true;
	}
	
	function enableData() {
		document.frmSKPDLB.skpd.disabled = false;
		document.frmSKPDLB.awal2.disabled = false;
		document.frmSKPDLB.sk_bupati.disabled = false;
	}
	
	function bersih() {
		document.frmSKPDLB.id.value = "";
		document.frmSKPDLB.skpdlb.value = "";
		document.frmSKPDLB.tgl.value = "";
		document.frmSKPDLB.skpd.value = "";
		document.frmSKPDLB.sspd.value = "";
		document.frmSKPDLB.npwpd.value = "";
		document.frmSKPDLB.awal2.value = "";
		document.frmSKPDLB.nama.value = "";
		document.frmSKPDLB.alamat.value = "";
		document.frmSKPDLB.nama2.value = "";
		document.frmSKPDLB.alamat2.value = "";
		document.frmSKPDLB.sk_bupati.value = "";
		document.frmSKPDLB.tgl_terima.value = "";
		document.frmSKPDLB.utang.value = "";
		document.frmSKPDLB.tgl_terima2.value = "";
		document.frmSKPDLB.awal.value = "";
		document.frmSKPDLB.akhir.value = "";
		document.frmSKPDLB.tahun.value = "";
		document.frmSKPDLB.lebihbayar.value = "";
        document.frmSKPDLB.kurangbayar.value = "";
		document.frmSKPDLB.jumlah.value = "";
        document.frmSKPDLB.jumlah_setoran.value = "";
        document.frmSKPDLB.setoran_wp.value = "";
	}
	
	function newEntry() {
		enableData();
		bersih();
		gride.clearAll();
		document.frmSKPDLB.btnTambah.disabled = false;
		document.frmSKPDLB.skpd.focus();
		document.frmSKPDLB.btnCari.disabled = false;
	}
</script>
<h2 style="margin:30px 5px 25px 30px;">SKPLB</h2>
<div id="a_tabbar" style="width:1000px; height:680px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPDLB" id="frmSKPDLB" action="<?php echo site_url(); ?>/skpdlb/cetak" method="post" onSubmit="popupform(this, 'iui')" >
    <table width="888">
  <tr>
    <td style="padding-left:15px;">No. SKPLB</td>
    <td width="300"><input name="skpdlb" type="text" disabled="disabled" id="skpdlb" size="25"></td>
    <td width="154"><div align="right">Tanggal</div></td>
    <td width="176"><input name="tgl" type="text" disabled="disabled" id="tgl" size="8" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">No. SKPD</td>
    <td><input name="skpd" type="text" disabled="disabled" id="skpd" size="25" style="text-transform:uppercase; background-color: #FFCC99;" />
      <input type="hidden" name="id" id="id" size="25" />
  <input name="btnCari" type="button" id="btnCari" style="padding-left:20px; padding-right:20px" onclick="showSKPDLB()" value="Cari" disabled="disabled" /></td>
    <td><div align="right">No.SSPD</div></td>
    <td><input name="sspd" type="text" disabled="disabled" id="sspd" /></td>
  </tr>  
  <tr>
    <td width="238" style="padding-left:15px;">NPWPD</td>
    <td><input type="text" name="npwpd" id="npwpd" size="25" style="text-transform:uppercase; background-color: #FFFFCC;" disabled="disabled"  /></td>
    <td><div align="right">Bulan</div></td>
    <td><select name="awal2" id="awal2" disabled="disabled">
      <option value=""></option>
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maret</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Agustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
      </select></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Nama</td>
    <td colspan="3"><input name="nama" type="text" disabled="disabled" id="nama" style="background-color:#FFFFCC; text-transform:uppercase;" size="25" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Alamat</td>
    <td colspan="3"><input name="alamat" type="text" disabled="disabled" id="alamat" style="background-color:#FFFFCC; text-transform:uppercase;" size="25" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Nama Perusahaan</td>
    <td colspan="3"><input name="nama2" type="text" disabled="disabled" id="nama2" style="background-color:#FFFFCC; text-transform:uppercase;" size="25" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Alamat Perusahaan</td>
    <td colspan="3"><input name="alamat2" type="text" disabled="disabled" id="alamat2" style="background-color:#FFFFCC; text-transform:uppercase;" size="25" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">SK Bupati</td>
    <td colspan="3"><input name="sk_bupati" type="text" size="25" disabled="disabled" id="sk_bupati"></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Tanggal SK</td>
    <td colspan="3"><input name="tgl_terima" type="text" size="25" disabled="disabled" id="tgl_terima" /></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Pajak Terhutang</td>
    <td colspan="3"><input name="utang" type="text" disabled="disabled" size="25" id="utang"></td>
  </tr>
  <tr>
    <td style="padding-left:15px;">Masa Pajak</td>
    <td colspan="3"><select name="awal" id="awal" disabled="disabled">
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
s/d&nbsp;
<select name="akhir" id="akhir" disabled="disabled">
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
Tahun
<select name="tahun" id="tahun" disabled="disabled">
  <?php echo $tahun; ?>
</select></td>
  </tr>
  
  <tr>
    <td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
    <td colspan="3"><input name="tgl_terima2" size="25" type="text" disabled="disabled" id="tgl_terima2" /></td>
  </tr>
  <tr>
            	<td colspan="4">
    <div style="padding:10px 15px 0 15px;">
   		<div id="gridCo" height="150px" style="margin-bottom:10px;"></div>
    </div>
		</td>
    </tr>
	<tr>    	
        <td colspan="4" align="right">Surat Ketetapan &nbsp;<input type="text" name="jumlah" id="jumlah" disabled/></td>
    </tr>
    <tr>    	
        <td colspan="4" align="right">Jumlah Setoran&nbsp;<input type="text" name="jumlah_setoran" id="jumlah_setoran" disabled/></td>
    </tr>
    <tr>    	
        <td colspan="4" align="right">Setoran Wajib Pajak &nbsp;<input type="text" name="setoran_wp" id="setoran_wp" disabled/></td>
    </tr>
    <tr>
        <td width="238" colspan="2" align="right" style="padding-left:15px;">Jumlah Kurang Bayar &nbsp;<input type="text" name="kurangbayar" id="kurangbayar" disabled/></td>
        <td width="238" colspan="2" align="right" style="padding-left:15px;">Jumlah Lebih Bayar &nbsp;<input type="text" name="lebihbayar" id="lebihbayar" disabled/></td>
    </tr>
  <tr>
    <td colspan="4" style="padding-left:15px;">
      <input type="button" name="button" id="button" value="Baru" onClick="newEntry();" style="width:90px;" />&nbsp;&nbsp;
      <input type="button" value="Simpan" onClick="simpan()" name="btnTambah" style="width:90px;" disabled="disabled" />&nbsp;&nbsp;
      <input type="button" value="Edit" onClick="edit()" name="btnEdit" disabled="disabled" style="width:90px;" />&nbsp;&nbsp;
      <input type="button" value="Hapus" onClick="hapus()" name="btnDel" disabled="disabled" style="width:90px;"/>&nbsp;&nbsp;
      <input type="button" value="Cetak" name="cetak" onclick="cetak1()" disabled="disabled" style="width:90px;"/>    </td>
  </tr>
</table>
    </form>
<br />

</div>
<div id="C2">
<div style="padding:0 25px 10px 0px;">
   	<div id="gridData" height="440px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

</div>
<div id="ojBrg" style="display:none;">
  <form name="frmeSrc" method="post" action="javascript:void(0);"><table width="752" border="0">
  <tr>
    <td width="97">Kata Kunci</td>
    <td width="216"><input type="text" name="keyword" id="keyword"></td>
    <td width="417" rowspan="2"><input type="button" name="button2" id="button2" value="CARI" style="height:50px; width:100px;" onClick="cariDataWP();">
      <input type="button" name="button3" id="button3" value="TUTUP" style="height:50px; width:100px;" onClick="closeBrg();"></td>
  </tr>
  <tr>
    <td>Parameter</td>
    <td><select name="parameter" id="parameter">
    	<option value="nomor">NO.SKPD</option>
      	<option value="npwpd">NO.NPWPD</option>
      	</select></td>
    </tr>
  <tr>
    <td colspan="3"><div id="tmpGridWP" width="100%" height="320px" style="background-color:white;"></div></td>
    </tr>
</table>
  </form>
</div>

<script language="javascript">
	function edit(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dppkadsigi'){
				document.frmSKPDLB.button.disabled = false;
				document.frmSKPDLB.btnTambah.disabled = false;
				document.frmSKPDLB.tgl_terima2.disabled = false;
				document.frmSKPDLB.tgl.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal1 = new dhtmlxCalendarObject('tgl_terima2');
	cal1.setDateFormat('%d/%m/%Y');
	
	function cetak1() {
		window.open('<?php echo site_url(); ?>/skpdlb/cetak?no_skpdlb='+document.frmSKPDLB.skpdlb.value, '', 'height=700,width=1000,scrollbars=yes');
	}
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl_terima');
	cal1.setDateFormat('%d/%m/%Y');
	
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("Kode Rekening, Nama Rekening, Ketetapan, Kenaikan, Denda, Bunga, Kompensasi,SKPDLB");
	gride.setInitWidths("100,130,100,120,100,100,100,70");
	gride.setColAlign("left,left,left,left,left,left,left,left");
	gride.setColTypes("ron,ron,ron,ron,ron,ron,ron,ron");
	gride.setColSorting("str,str,str,str,str,str,str,str");
	gride.enablePaging(true,5,10,"pagingArea",true);
	gride.setPagingSkin("bricks");
	//gride.setColumnHidden(3,true);
	//gride.setColumnHidden(4,true);
	//gride.setColumnHidden(5,true);
	//gride.setColumnHidden(6,true);
	gride.setColumnHidden(7,true);
	gride.setNumberFormat("0,000",2,",",".");
    gride.setNumberFormat("0,000",3,",",".");	
    gride.setNumberFormat("0,000",4,",",".");
	gride.setNumberFormat("0,000",5,",",".");
	gride.setNumberFormat("0,000",6,",",".");	
	gride.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>");
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.init();
	
	var dpps = "";
	function rundpPO(){
		dpps = new dataProcessor("<?php echo site_url(); ?>/skpdlb/detail_skpdlb");
		dpps.setUpdateMode("off");
		dpps.init(gride);       
		dpps.attachEvent("onAfterUpdateFinish", function() {        
			/*refreshData();
			enableData();	
			disableButton();*/
			statusEnding();
			loadData();
			alert("Done");
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
            gride.cells(id,7).getValue();
			                                    
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
		//alert(arrs);       
        var row1= arrs[0];
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
        var row6= arrs[5];
        var row7= arrs[6];
        var row8= document.frmSKPDLB.skpdlb.value; 
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8],posisi);
			//alert('1');
        //}
    }
	
	wBrg = dhxWins.createWindow("wBrg",0,0,770,450);
	wBrg.setText("Daftar Barang");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function showSKPDLB() {
		wBrg.show();
    	wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('ojBrg');
		//document.frmSKPDLB.nmbarang.focus();
	}

	function closeBrg() {
		wBrg.hide();
		wBrg.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("nomor, npwpd, no_sspd, masa_pajak1, masa_pajak2, tahun_pajak, ketetapan, setoran, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, setoran_wp, kurang, lebih");
	gridWP.setInitWidths("150,150,150,150,150,150,150,150,150,150,150,150,150,150,150");
	gridWP.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmSKPDLB.skpd.value = gridWP.cells(id,0).getValue();
		document.frmSKPDLB.npwpd.value = gridWP.cells(id,1).getValue();
		document.frmSKPDLB.sspd.value = gridWP.cells(id,2).getValue();
		document.frmSKPDLB.awal.value = gridWP.cells(id,3).getValue();
		document.frmSKPDLB.akhir.value = gridWP.cells(id,4).getValue();
		document.frmSKPDLB.tahun.value = gridWP.cells(id,5).getValue();
		document.frmSKPDLB.utang.value = format_number(gridWP.cells(id,13).getValue());
		document.frmSKPDLB.nama.value = gridWP.cells(id,8).getValue();
		document.frmSKPDLB.alamat.value = gridWP.cells(id,9).getValue();
		document.frmSKPDLB.nama2.value = gridWP.cells(id,10).getValue();
		document.frmSKPDLB.alamat2.value = gridWP.cells(id,11).getValue();                
		document.frmSKPDLB.jumlah.value = format_number(gridWP.cells(id,6).getValue());
        document.frmSKPDLB.jumlah_setoran.value = format_number(gridWP.cells(id,7).getValue());
        document.frmSKPDLB.setoran_wp.value = format_number(gridWP.cells(id,12).getValue());       
        document.frmSKPDLB.kurangbayar.value = format_number(gridWP.cells(id,13).getValue());                                                
		document.frmSKPDLB.lebihbayar.value = format_number(gridWP.cells(id,14).getValue());
		detailLB();
		closeBrg();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	
	function cariDataWP() {
	
		if(document.frmeSrc.keyword.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmeSrc.keyword.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/skpdlb/cariSKPDLB/"+kata_kunci+"/"+document.frmeSrc.parameter.value,function() {  statusEnding(); });
	}
	
	// Wajib Pajak
	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridData.setHeader("id, no_skpdlb, no_skpd, tgl, no_sspd, npwpd, nama, alamat, nama_perusahaan, alamat_perusahaan, sk_bupati, bulan, tgl_sk, pajak_terhutang, masa_pajak1, masa_pajak2, tahun, tgl_tempo, jumlah_lebih, jumlah, jumlah_kurang, jumlah_setoran, setoran_wp");
	gridData.setInitWidths("120,120,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80,80");
	gridData.setColAlign("left,left,right,right,right,right,right,left,left,right,right,right,right,right,right,right,right,right,right,right,right,right,right");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridData.enableMultiselect(true);
	gridData.enableSmartRendering(true);
	gridData.init();
	gridData.setSkin("dhx_skyblue");
	gridData.attachEvent("onRowDblClicked", function(id) {
		gride.clearAll();
		document.frmSKPDLB.id.value = gridData.cells(id,0).getValue();
		document.frmSKPDLB.skpdlb.value = gridData.cells(id,1).getValue();
		document.frmSKPDLB.skpd.value = gridData.cells(id,2).getValue();
		document.frmSKPDLB.tgl.value = gridData.cells(id,3).getValue();
		document.frmSKPDLB.sspd.value = gridData.cells(id,4).getValue();
		document.frmSKPDLB.npwpd.value = gridData.cells(id,5).getValue();
		document.frmSKPDLB.nama.value = gridData.cells(id,6).getValue();
		document.frmSKPDLB.alamat.value = gridData.cells(id,7).getValue();
		document.frmSKPDLB.nama2.value = gridData.cells(id,8).getValue();
		document.frmSKPDLB.alamat2.value = gridData.cells(id,9).getValue();
		document.frmSKPDLB.sk_bupati.value = gridData.cells(id,10).getValue();
		document.frmSKPDLB.awal2.value = gridData.cells(id,11).getValue();
		document.frmSKPDLB.tgl_terima.value = gridData.cells(id,12).getValue();
		document.frmSKPDLB.utang.value = format_number(gridData.cells(id,13).getValue());
		document.frmSKPDLB.awal.value = gridData.cells(id,14).getValue();
		document.frmSKPDLB.akhir.value = gridData.cells(id,15).getValue();
		document.frmSKPDLB.tahun.value = gridData.cells(id,16).getValue();
		document.frmSKPDLB.tgl_terima2.value = gridData.cells(id,17).getValue();
		document.frmSKPDLB.jumlah.value = format_number(gridData.cells(id,19).getValue());
		document.frmSKPDLB.lebihbayar.value = format_number(gridData.cells(id,18).getValue());
        document.frmSKPDLB.kurangbayar.value = format_number(gridData.cells(id,20).getValue());
        document.frmSKPDLB.jumlah_setoran.value = format_number(gridData.cells(id,21).getValue());
        document.frmSKPDLB.setoran_wp.value = format_number(gridData.cells(id,22).getValue());
		dSKPDLB();
		document.frmSKPDLB.button.disabled =true;
		document.frmSKPDLB.btnTambah.disabled =true;
		document.frmSKPDLB.cetak.disabled = false;
		document.frmSKPDLB.btnEdit.disabled = false;
		document.frmSKPDLB.btnDel.disabled = false;
		tabbar.setTabActive("a1");
	});
	
	loadData();
	
	function dSKPDLB() {
		gride.clearAll();	
		gride.loadXML(base_url+"index.php/skpdlb/dSKPDLB?skpdlb="+document.frmSKPDLB.skpdlb.value);
	}
	
	function loadData() {
		gridData.loadXML(base_url+"index.php/skpdlb/mainData",function() { statusEnding(); });
	}
	statusEnding();
</script>
</div>