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
<script type="text/javascript">
	function barus(){
		kosongfrm();
		enabledfrm();
		enabledButton();
		gride.clearAll();
		document.frmKAS.tambah.disabled = false;
	}
	
	function kosongfrm(){
		document.frmKAS.id.value = "";
		document.frmKAS.kas.value = "";
		document.frmKAS.tgl.value = "";
		document.frmKAS.ket.value = "";
		document.frmKAS.petugas.value = "";
		document.frmKAS.jumlah.value = "";
	}
	
	function enabledfrm(){
		document.frmKAS.tgl.disabled = false;
		document.frmKAS.ket.disabled = false;
	}
	
	function disabledfrm(){
		document.frmKAS.kas.disabled = true;
		document.frmKAS.tgl.disabled = true;
		document.frmKAS.ket.disabled = true;
		document.frmKAS.petugas.disabled = true;
		document.frmKAS.jumlah.disabled = true;
	}
	
	function enabledButton(){
		document.frmKAS.tambah1.disabled = false;
		document.frmKAS.kurang.disabled = false;
		document.frmKAS.tambah.disabled = false;
		document.frmKAS.edit1.disabled = false;
		document.frmKAS.delete1.disabled = false;
		document.frmKAS.cetak.disabled = false;
	}
	
	function disabledButton(){
		document.frmKAS.tambah1.disabled = true;
		document.frmKAS.kurang.disabled = true;
		document.frmKAS.edit1.disabled = true;
		document.frmKAS.delete1.disabled = true;
		document.frmKAS.cetak.disabled = true;
	}
	
	function simpan(){
		if(document.frmKAS.tgl.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			document.frmSrc.tgl.focus();
			return;
		}
		
		if(document.frmKAS.jumlah.value=="") {
			alert("Jumlah Tidak Boleh Kosong");
			document.frmKAS.jumlah.focus();
			return;
		}
		
		t = document.frmKAS.tgl.value;
		s = t.split("/");
		tgl = s[2]+'-'+s[1]+'-'+s[0];
		
		rundpPO();
		var kirimData = 
			"id=" + document.frmKAS.id.value +
			"&no_kas=" + document.frmKAS.kas.value +
			"&petugas=" + document.frmKAS.petugas.value +
			"&tgl=" + tgl +
			"&ket=" + document.frmKAS.ket.value +
			"&jumlah=" + document.frmKAS.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/buku/simpan', kirimData, ponePOST);
	}
	
	function ponePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmKAS.kas.value = result;
                   	tmpRows();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
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
            gride.cells(id,4).getValue();
			                                    
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
        var row5= document.frmKAS.kas.value;
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5],posisi);
			//alert('1');
        //}
	}
</script>
<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Penerimaan Kas</h2>

<div id="a_tabbar" style="width:1000px; height:550px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmKAS" id="frmKAS" method="post" onSubmit="popupform1(this, 'Nhp')">
    <br />
   	  <table width="650" border="0">
      		<tr>
        		<td width="150" style="padding-left:15px;">No. Kas</td>
            	<td><input type="hidden" name="id" id="id" size="35"  />
                <input type="text" name="kas" id="kas" size="32" style="background-color:#FFFFCC;" disabled/></td>
                <td width="150" align="center" valign="top" rowspan="3">Keterangan</td>
              	<td valign="top" rowspan="3"><textarea cols="20" rows="2" name="ket" id="ket"></textarea></td>
        	</tr>
            <tr>
           	  	<td style="padding-left:15px;">Tanggal</td>
              	<td><input type="text" name="tgl" id="tgl" size="10" disabled/></td>
            <tr>
           	  <td style="padding-left:15px;">Petugas</td>
           	  <td><select name="petugas" id="petugas"  valign="top" disabled>
              <option value="<?php echo $username; ?>"><?php echo $namaPetugas; ?></option>
         	  </select></td>
   	    	</tr>
            <tr>
            	<td colspan="4">
                <div style="padding:10px 15px 0 15px;">
                    <div id="gridCo" width="670px" height="320px" style="margin-bottom:10px;"></div>
                    <input type="button" onclick="tmbh()" name="tambah1" id="tambah1" value="Tambah Data" style="padding-left:20px; padding-right:20px" disabled>&nbsp;<input type="button" onclick="krg()" id="kurang" name="kurang" value="Delete Data" style="padding-left:20px; padding-right:20px" disabled>
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah&nbsp;&nbsp;&nbsp;<input type="text" name="jumlah" id="jumlah" />
                </div>
				</td>
			</tr>
            <tr>
                <td style="padding-left:15px;"><input type="button" value="Baru" onclick="barus()" name="baru1" style="padding-left:20px; padding-right:20px" /></td>
                <td colspan="3"><input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>
                <input type="button" value="Edit" onclick="ubah()" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
                <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
	</form>
<br />
</div>
<div id="C2">
<div style="padding:0 25px 10px 0px;">
   	<div id="gridContent" height="480px"></div>
    <div id="pagingArea" width="350px" style="background-color: white;"></div>
</div>
</div>

<div id="obejBrg" style="display:none;">
<form name="frmSrc" id="frmSrc" method="post" action="javascript:void(0);"><table width="590" border="0">
  	<tr>
		<td width="150" style="padding-left:15px;">Kode Rekening</td>
        <td colspan="3">
        <input type="hidden" name="id" id="id" size="15" /><input type="hidden" name="kas" id="kas" size="15" />
        <select name="gols" id="gols" onchange="cgol()" >
        	<option value=""></option>
            <?php 
			foreach($gresto->result() as $rs) {
				echo "<option value=".$rs->kd_rek.">".$rs->kd_rek."</option>";
			}
			?>
        </select>
        </td>
	</tr>
    <tr>
		<td style="padding-left:15px;">Nama Rekening</td>
        <td colspan="3"><input type="text" name="nama" id="nama" size="55" /></td>
	</tr>
    <tr>
		<td style="padding-left:15px;">Nilai</td>
        <td colspan="3"><input type="text" name="nilai" id="nilai" size="20" /></td>
	</tr>
    <tr>
		<td style="padding-left:15px;">Keterangan </td>
        <td colspan="3"><input type="text" name="ket" id="ket" size="20" /></td>
	</tr>
    <tr>
       	<td colspan="4" style="padding-left:15px;"><input type="button" value="Simpan" name="sav" onclick="tam()" />&nbsp;&nbsp;<input type="button" value="Keluar" onclick="batal()" /></td>
	</tr>
</table>
  </form>
</div>
</div>
<script type="text/javascript">
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
	
	function cgol() {
		var poStr =
		"gol=" + document.frmSrc.gols.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/buku/cgol', poStr, responePOS);			
	}
	
	function responePOS(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					document.frmSrc.nama.value = result;
				}
			}
		}
	}
	
	cRsa = dhxWins.createWindow("cRsa",0,0,550,190);
	cRsa.setText("Pendataan Kas");
	cRsa.button("park").hide();
	cRsa.button("close").hide();
	cRsa.button("minmax1").hide();
	cRsa.hide();

	function tmbh() {
		cRsa.show();
    	//cRsa.setModal(true);
		cRsa.center();
		cRsa.attachObject('obejBrg');
		var id = gride.uid();
		//alert(id);
		document.frmSrc.id.value = id;
	}
	
	function batal() {
		cRsa.hide();
		cRsa.setModal(false);
		kosongChild();
		//grids.clearAll();
	}
	
	function tam(){
		if(document.frmSrc.gols.value=="") {
			alert("Kode Rekening Tidak Boleh Kosong");
			document.frmSrc.gols.focus();
			return;
		}
		
		if(document.frmSrc.nama.value=="") {
			alert("Nama Rekening Tidak Boleh Kosong");
			document.frmSrc.nama.focus();
			return;
		}
		
		if(document.frmSrc.nilai.value=="") {
			alert("Nilai Tidak Boleh Kosong");
			document.frmSrc.nilai.focus();
			return;
		}
		
		var posisi = gride.getRowsNum();
		var row1= document.frmSrc.gols.value;
		var row2= document.frmSrc.nama.value;
		var row3= document.frmSrc.nilai.value;
		var row4= document.frmSrc.ket.value;
		var row5= '';
		gride.addRow(id,[row1,row2,row3,row4,row5], posisi);
		gride.showRow(id);
		kosongChild();
		cekk();
		document.frmKAS.kurang.disabled = false;
	}
	
	function kosongChild(){
		document.frmSrc.id.value = "";
		document.frmSrc.kas.value = "";
		document.frmSrc.gols.value = "";
		document.frmSrc.nama.value = "";
		document.frmSrc.nilai.value = "";
		document.frmSrc.ket.value = "";
	}
	
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("Kode Rekening, Nama Rekening, Jumlah, Ket,No Kas");
	gride.setInitWidths("130,230,120,190,150");
	gride.setColAlign("left,left,left,left,left");
	gride.setColTypes("ron,ron,ron,ron,ron");
	gride.setColSorting("str,str,str,str,str");
	gride.setColumnHidden(4,true);
	gride.setNumberFormat("0,000",2,",",".");
	gride.enableSmartRendering(true);
	gride.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpJml>{#stat_total}</div>,<div style=text-align:right></div>,<div style=text-align:right></div>");
	gride.attachEvent("onRowDblClicked", selectedOpenData3);
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.init();
		
	var dpps = "";
	function rundpPO(){
		dpps = new dataProcessor("<?php echo site_url(); ?>/buku/buku_child");
		dpps.setUpdateMode("off");
		dpps.init(gride);       
		dpps.attachEvent("onAfterUpdateFinish", function() {        
			loadData();
			disabledfrm();	
			statusEnding();
			alert("Done");
			return true;
		});
	}
	
	function cekk(){
		document.frmKAS.jumlah.value = document.getElementById('tmpJml').innerHTML;
	}
	
	function selectedOpenData3(id){
		tampil();
		document.frmSrc.kas.value = gride.cells(id,0).getValue();
		document.frmSrc.no_rek.value = gride.cells(id,1).getValue();
		document.frmSrc.nm_rek.value = gride.cells(id,2).getValue();
		document.frmSrc.jumlah.value = gride.cells(id,3).getValue();
		document.frmSrc.ket.value = gride.cells(id,4).getValue();
	}
	
	function loadChild() {
		gride.clearAll();
		gride.loadXML("<?php echo site_url(); ?>/buku/buku_child?kas="+document.frmKAS.kas.value);
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_kas, tgl, petugas, jumlah, ket",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	grid.setInitWidths("50,170,150,150,100,100");
	grid.setColAlign("center,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	grid.setNumberFormat("0,000",4,",",".");
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/buku/mainData");
	grid.init();
	
	function selectedOpenData(id){
		document.frmKAS.id.value = grid.cells(id,0).getValue();
		document.frmKAS.kas.value = grid.cells(id,1).getValue();
		document.frmKAS.tgl.value = grid.cells(id,2).getValue();
		document.frmKAS.petugas.value = grid.cells(id,3).getValue();
		document.frmKAS.jumlah.value = grid.cells(id,4).getValue();
		document.frmKAS.ket.value = grid.cells(id,5).getValue();
		loadChild();
		enabledButton();
		tabbar.setTabActive("a1");
	}
	
	function loadData(){
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/buku/mainData");
	}
	
	statusEnding();
</script>