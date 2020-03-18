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
		if(document.frmSKPDT.nota.value=="") {
			alert("No. SKPDT Tidak Boleh Kosong");
			document.frmSKPDT.nota.focus();
			return;
		}
		alert(document.frmSKPDT.nota.value);
		var postStr =
		"nota=" + document.frmSKPDT.nota.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdt/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSKPDT.tgl.value = arr[0];
					document.frmSKPDT.tempo.value = arr[1];
					//disableData();
					loadItem();
				} else {
					alert('Maaf No Nota Hitung tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function loadItem(){
		gride.clearAll();
		var poStr1 =
		"nota=" + document.frmSKPDT.nota.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdt/dataItemPajak1', poStr1, respePe);			
	}
	
	function respePe(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					cha = result.split(";");
					//alert(cha);
					var id = gride.uid();
					var posisi = gride.getRowsNum();
					// Split Array
					var row1= '';
					var row2= cha[0];
					var row3= cha[1];
					var row4= cha[2];
					var row5= cha[3];
					var row6= cha[4];
					var row7= cha[5];
					var row8= cha[6];
					var row9= cha[7];
					var row10= cha[8];
					gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10], posisi);
					gride.showRow(id);
				}
			}
		}
	}
	
	function kosongfrmSKPDT() {
		document.frmSKPDT.id.value = "";
		document.frmSKPDT.urut.value = "";
		document.frmSKPDT.skpdt.value = "";
		document.frmSKPDT.tgl.value = "";
		document.frmSKPDT.nota.value = "";
		document.frmSKPDT.sptpd.value = "";
		document.frmSKPDT.npwpd.value = "";
		document.frmSKPDT.nama.value = "";
		document.frmSKPDT.alamat.value = "";
		document.frmSKPDT.awal.value = "";
		document.frmSKPDT.akhir.value = "";
		document.frmSKPDT.tahun.value = "";
		document.frmSKPDT.tempo.value = "";
		document.frmSKPDT.kohir.value = "";
	}
	
	function simpan() {
		arr1 = document.frmSKPDT.urut.value;
		arr2 = document.frmSKPDT.skpdt.value;
		arrfull = arr1+'/'+arr2;
		
		t = document.frmSKPDT.tgl.value;
		s = t.split("/");
		tgl = s[2]+'-'+s[1]+'-'+s[0];
		
		p = document.frmSKPDT.tempo.value;
		q = p.split("/");
		tempo = q[2]+'-'+q[1]+'-'+q[0];
		
		rundpPO()
		var postStr =
			"id=" + document.frmSKPDT.id.value +
			"&kode=" + document.frmSKPDT.kode.value +
			"&skpdt=" + arrfull +
			"&nota=" + document.frmSKPDT.nota.value +
			"&sptpd=" + document.frmSKPDT.sptpd.value +
			"&npwpd=" + document.frmSKPDT.npwpd.value +
			"&kohir=" + document.frmSKPDT.kohir.value +
			"&nama=" + document.frmSKPDT.nama.value +
			"&alamat=" + document.frmSKPDT.alamat.value +
			"&tgl=" + tgl +
			"&tempo=" + tempo +
			"&awal=" + document.frmSKPDT.awal.value +
			"&akhir=" + document.frmSKPDT.akhir.value +
			"&tahun=" + document.frmSKPDT.tahun.value +
			"&jumlah=" + document.frmSKPDT.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdt/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					arrs = result.split("|");
					arr = arrs[0].split("/");
						document.frmSKPDT.urut.value = arr[0];
						document.frmSKPDT.skpdt.value = arr[1]+"/"+arr[2];
						document.frmSKPDT.no_skpdt.value = arrs[0];
					document.frmSKPDT.kohir.value = arrs[1];
					tmpRows();
					refreshData();
					disableButton();
					statusEnding();
					//gride.clearAll();
					alert("Done");
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	var dpps = "";
	function rundpPO(){
	dpps = new dataProcessor("<?php echo site_url(); ?>/skpdt/child_skpdt");
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
        var row1= document.frmSKPDT.no_skpdt.value; 
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
        var row6= arrs[5];
        var row7= arrs[6];
        var row8= arrs[7];
		var row9= arrs[8];
		var row10= arrs[9];
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
			//alert('1');
        //}
    }
	
	function disableButton() {
		document.frmSKPDT.edit1.disabled = true;
		document.frmSKPDT.delete1.disabled = true;
		document.frmSKPDT.cetak.disabled = true;
		document.frmSKPDT.tambah.disabled = true;
		document.frmSKPDT.cari1.disabled = true;
	}
</script>
<h2 style="margin:30px 5px 25px 30px;">SKPT - <?php echo $title; ?></h2>

<div id="a_tabbar" style="width:1000px; height:490px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPDT" id="frmSKPDT" action="<?php echo site_url(); ?>/skpdt/cetak" method="post" onSubmit="popupform(this, 'skpdt')" >
    <br /><input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>" />
   	  <table width="850" border="0">
      		<tr>
        		<td width="220" style="padding-left:15px;">No. SKPDT</td>
           	  	<td>
                <input type="hidden" name="id" id="id" size="35" /><input type="hidden" name="no_skpdt" id="no_skpdt" size="35" />
                <input type="text" name="urut" id="urut" size="22" disabled/>&nbsp;/&nbsp;
                <input type="text" name="skpdt" id="skpdt" size="15" disabled/></td>
                <td width="250" align="right">Tanggal &nbsp;<input type="text" name="tgl" id="tgl" size="10" disabled/></td>
        	</tr>
            <tr>
                <td style="padding-left:15px;">No. Nota Hitung</td>
                <td><input type="text" name="nota" id="nota" size="32" style="text-transform:uppercase;" disabled/>
                <input type="button" onclick="opens()" value="Cari" name="cari1" style="padding-left:20px; padding-right:20px" disabled/>
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
                <td colspan="2"><input type="text" name="nama" id="nama" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat</td>
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
    <div style="padding:10px 15px 0 15px;">
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
        <td colspan="3"><input type="button" value="Edit" onclick="ubah" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Hapus" onclick="deleteData" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Cetak" name="cetak" onclick="cetak1()" style="padding-left:20px; padding-right:20px" disabled/></td>
	</tr>
</table>
</form>
<br />
</div>

<div id="C2">
<div style="padding:0 25px 0 0px;">
   	<div id="gridContent" height="425px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
    <br />
</div>
</div>

<div id="objNota" style="display:none;">
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
<br />
<div style="padding:0 75px 0 15px;">
	<div id="gridCost" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<script language="javascript">
function cetak1() {
		var s = document.frmSKPDT.skpdt.value;
		var dua = document.frmSKPDT.urut.value;
		
		var gabung = dua+'/'+s;
		window.open('<?php echo site_url(); ?>/skpdt/cetak?no_skpdt='+gabung, '', 'height=700,width=1000,scrollbars=yes');
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
		gridq.loadXML(base_url+"index.php/skpdt/cariData/"+kata_kunci+"/"+document.cSPTPDt.fil.value+"/"+document.frmSKPDT.kode.value,function() {  statusEnding(); });
	}
	
	gridq = new dhtmlXGridObject('gridCost');
	gridq.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridq.setHeader("no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	gridq.setInitWidths("50,170,150,150,100,100,100,100,100");
	gridq.setColAlign("center,left,left,left,left,left,left,left,left");
	gridq.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridq.setColSorting("str,str,str,str,str,str,str,str,str");
	gridq.enablePaging(true,5,10,"pagingArea",true);
	gridq.setPagingSkin("bricks");
	
	gridq.setSkin("dhx_skyblue");
	gridq.attachEvent("onRowDblClicked", selectedOpenData2);
	gridq.init();
	
	function selectedOpenData2(id) {
		document.frmSKPDT.nota.value 	= gridq.cells(id,0).getValue();
		document.frmSKPDT.sptpd.value = gridq.cells(id,1).getValue();
		document.frmSKPDT.npwpd.value = gridq.cells(id,2).getValue();
		document.frmSKPDT.nama.value = gridq.cells(id,3).getValue();
		document.frmSKPDT.alamat.value = gridq.cells(id,4).getValue();
		document.frmSKPDT.awal.value = gridq.cells(id,5).getValue();
		document.frmSKPDT.akhir.value = gridq.cells(id,6).getValue();
		document.frmSKPDT.tahun.value = gridq.cells(id,7).getValue();
		document.frmSKPDT.jumlah.value = gridq.cells(id,8).getValue();
		lihat();
		batal();
	}
	
	cRs = dhxWins.createWindow("cRs",0,0,800,370);
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
		kosongfrmSKPDT();
		enabledData();
		document.frmSKPDT.tambah.disabled = false;
		document.frmSKPDT.cari1.disabled = false;
		document.frmSKPDT.nota.focus();
	}
	
	function enabledData(){
		document.frmSKPDT.nota.disabled = false;
		document.frmSKPDT.tgl.disabled = false;
		document.frmSKPDT.kohir.disabled = false;
	}
	
	function c() {
		alert(document.tmp_jml);
	}
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("SKPDT, Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gride.setInitWidths("50,100,100,120,100,100,70,70,90,70,100");
	gride.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
	gride.setColTypes("ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
	gride.setColSorting("str,str,str,str,str,str,str,str,str,str,str");
	gride.enablePaging(true,5,10,"pagingArea",true);
	gride.setPagingSkin("bricks");
	//gride.setColumnHidden(0,true);
	//gride.setColumnHidden(1,true);
	gride.setNumberFormat("0,000",3,",",".");
	gride.setNumberFormat("0,000",4,",",".");
	gride.setNumberFormat("0,000",5,",",".");
	gride.setNumberFormat("0,000",6,",",".");
	gride.setNumberFormat("0,000",7,",",".");
	gride.setNumberFormat("0,000",8,",",".");
	gride.setNumberFormat("0,000",9,",",".");
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.init();
	
	function cek(){
		gride.clearAll();
		gride.loadXML("<?php echo site_url(); ?>/skpdt/child_skpdt?skpdt="+document.frmSKPDT.no_skpdt.value);
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_skpdt, no_nota, no_sptpd, npwpd, nama, alamat, masa_pajak1, masa_pajak2, tahun, no_kohir, tgl, tgl_tempo, jumlah, kode",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,170,150,150,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/skpdt/data?kode="+document.frmSKPDT.kode.value);
	grid.init();
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/skpdt/data?kode="+document.frmSKPDT.kode.value);
	}
	
	function enableButton() {
		document.frmSKPDT.edit1.disabled = false;
		document.frmSKPDT.delete1.disabled = false;
		document.frmSKPDT.cetak.disabled = false;
		document.frmSKPDT.tambah.disabled = false;
		document.frmSKPDT.cari1.disabled = true;
		document.frmSKPDT.nota.disabled = true;
	}
	
	function selectedOpenData(id) {
		statusLoading();
		kosongfrmSKPDT();
		enableButton();
		tabbar.setTabActive("a1");
		document.frmSKPDT.id.value	= grid.cells(id,0).getValue();
		document.frmSKPDT.no_skpdt.value = grid.cells(id,1).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmSKPDT.urut.value = arr[0];
		document.frmSKPDT.skpdt.value = arr[1]+'/'+arr[2];
		document.frmSKPDT.nota.value = grid.cells(id,2).getValue();
		document.frmSKPDT.sptpd.value = grid.cells(id,3).getValue();
		document.frmSKPDT.npwpd.value 	= grid.cells(id,4).getValue();
		document.frmSKPDT.nama.value 	= grid.cells(id,5).getValue();
		document.frmSKPDT.alamat.value 	= grid.cells(id,6).getValue();
		document.frmSKPDT.awal.value	= grid.cells(id,7).getValue();
		document.frmSKPDT.akhir.value	= grid.cells(id,8).getValue();
		document.frmSKPDT.tahun.value = grid.cells(id,9).getValue();
		document.frmSKPDT.kohir.value = grid.cells(id,10).getValue();
		document.frmSKPDT.tgl.value = grid.cells(id,11).getValue();
		document.frmSKPDT.tempo.value = grid.cells(id,12).getValue();
		document.frmSKPDT.jumlah.value = format_number(grid.cells(id,13).getValue());
		document.frmSKPDT.kode.value = grid.cells(id,14).getValue();
		cek();
		//loadjml();
		statusEnding();
	}
	
	function deleteData() {
		confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"id=" + document.frmSKPDT.id.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/skpdt/delete', postStr, responeDel);	
		}
	}
	
	function responeDel(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmSKPDT();
					refreshData();
					enableButton();
					statusEnding();
					alert("Done");
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