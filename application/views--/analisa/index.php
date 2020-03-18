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


<!-- Toolbar -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/codebase_toolbar/dhtmlxcommon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css"></link>
<!-- end of toolbar -->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
<script src="<?php echo base_url(); ?>assets/rumus.js" type="text/javascript"></script>

<script language="javascript">		
	function statusLoading() {  
	   ModalPopups.Indicator("idIndicator2",  
			"Please wait",  
			"<div style=''>" +   
			"<div style='float:left;'><img src='<?php echo base_url();?>/assets/modal/spinner.gif'></div>" +   
			"<div style='float:left; padding-left:10px;'>" +   
			"Permintaan Anda Sedang Diproses... <br/>" +   
			"Tunggu Beberapa Saat." +  
			"<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
			"</div>",   
			{  
				width: 300,  
				height: 100  
			}  
		);
	}
	
	function statusEnding() {
		ModalPopups.Close("idIndicator2");
	}		
		
</script>

<body style="background-color: #B3D9F0">
<form name="frmAns" method="post" action="javascript:void(0);">

<fieldset><legend>Data Wajib Pajak</legend>
<table width="764" border="0">
<tr>
    <td>TAHUN</td>
    <td>
		<select id="tahun" name="tahun" style="width:100px;">			
			<?php
					for($i=2005;$i<=2030;$i++){
						if($i == $thn){
							$sel = "selected";
						} else {
							$sel = "";
						}
						echo "<option value='$i' ".$sel.">$i</option>";
					}
			?>
		</select>
	</td>
  </tr>
  <tr>
    <td width="189">NPWPD</td>
    <td width="565"><input type="text" name="npwpd" id="npwpd">
      <input name="button" type="button" id="button" value="CARI" onClick="opens();" />
      <input type="button" name="button2" id="button2" value="OPEN DATA" onClick="openDataAnalisa();" /></td>
  </tr>
  <tr>
    <td>NAMA PERUSAHAAN</td>
    <td><input name="nama_perusahaan" type="text" id="nama_perusahaan" size="40"></td>
  </tr>
  
  <tr>
    <td>JENIS PAJAK</td>
    <td><input name="C1" type="checkbox" id="C1" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C1|0'); }" value="C1|Hotel">
      Hotel
        <input type="checkbox" name="C2" id="C2" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C2|0'); }" value="C2|Restoran">
        Restoran
        <input type="checkbox" name="C3" id="C3" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C3|0'); }" value="C3|Reklame">
      Reklame 
      <input type="checkbox" name="C4" id="C4" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C4|0'); }" value="C4|Hiburan">
      Hiburan 
      <input type="checkbox" name="C5" id="C5" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C5|0'); }" value="C5|P.Jalan">
      Penerangan Jalan
      <br />
      <input type="checkbox" name="C6" id="C6" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C6|0'); }" value="C6|Mineral">
      Mineral Bukan Logam dan Batuan 
      <input type="checkbox" name="C7" id="C7" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C7|0'); }" value="C7|B.Walet">
      Burung Walet 
      <input type="checkbox" name="C8" id="C8" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C8|0'); }" value="C8|Parkir">
      Parkir 
      <input type="checkbox" name="C9" id="C9" onClick="if(this.checked==true) { createTab(this.value); } else { createTab('C9|0'); }" value="C9|Air Tanah">
      Air Bawah Tanah</td>
  </tr>
</table>
</fieldset>
<div id="a_tabbar" style="width:100%; height:400px;"></div>
<div style="width:100%; height:30px; background-color:#FFCC99">
  <span style="padding-left:15px;">
  <input type="button" value="BARU" onClick="baru()" name="baru1" style="padding-left:20px; padding-right:20px"/>
  <input type="button" value="SIMPAN" onClick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px"/>
  </span>
  <!--<input type="button" value="Edit" onClick="ubah()" name="edit1" style="padding-left:20px; padding-right:20px"/>-->
  <input type="button" value="HAPUS" onClick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px"/>
</div>
</form>
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
        <td><input type="button" onClick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onClick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
<iframe id="tmpLoad" name="tmpLoad" width="500px" height="100px"></iframe>
</body>
<script language="javascript">
var base_url = "<?php echo base_url(); ?>";
tabbar = new dhtmlXTabBar("a_tabbar", "top");
tabbar.setSkin('dhx_skyblue');
tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
/* tabbar.addTab("a1", "Input Data", "100px");
tabbar.addTab("a2", "Listing Data", "100px");
tabbar.setContent("a1", "C1"); 
tabbar.setContent("a2", "C2");
tabbar.setTabActive("a1"); */

function createTab(isi) {
		var arr = isi.split("|");
		if(arr[1] != 0) {
			tabbar.addTab(arr[0],arr[1],"100px");
			tabbar.setTabActive(arr[0]);
			tabbar.setHrefMode("ajax-html");
			tabbar.setContentHref(arr[0],"<?php echo base_url(); ?>index.php/analisa/"+arr[0]);	
			tabbar.setTabActive(arr[0]);
		} else {
			tabbar.removeTab(arr[0],true);
		}
}

function createTabEdit(isi) {
		var arr = isi.split("|");
		if(arr[1] != 0) {
			tabbar.addTab(arr[0],arr[1],"100px");
			tabbar.setTabActive(arr[0]);
			tabbar.setHrefMode("ajax-html");
			tabbar.setContentHref(arr[0],"<?php echo base_url(); ?>index.php/analisa/editData/"+arr[0]+"/"+document.frmAns.npwpd.value);	
			tabbar.setTabActive(arr[0]);
		} else {
			tabbar.removeTab(arr[0],true);
		}
}

function simpan() {
		statusLoading();
		//if(window.tmpRows){
			//tmpRows();
		//}
		if(window.runmdp){
			runmdp();
		}
		
		document.frmAns.action = "<?php echo base_url(); ?>index.php/analisa/simpan";
		document.frmAns.target = "tmpLoad";
		document.frmAns.submit();		
	}

function baru(){
	document.frmAns.tahun.value = "";
	document.frmAns.npwpd.value = "";
	document.frmAns.nama_perusahaan.value = "";	
	document.frmAns.C1.checked = false;
	document.frmAns.C2.checked = false;
	document.frmAns.C3.checked = false;
	document.frmAns.C4.checked = false;
	document.frmAns.C5.checked = false;
	document.frmAns.C6.checked = false;
	document.frmAns.C7.checked = false;
	document.frmAns.C8.checked = false;
	document.frmAns.C9.checked = false;
	tabbar.clearAll();
}	
// Mencari Data NPWPD
wBrg = dhxWins.createWindow("wBrg",0,0,800,400);
wBrg.setText("Pencarian Data Perusahaan");
wBrg.button("park").hide();
wBrg.button("close").hide();
wBrg.button("minmax1").hide();
wBrg.hide();

function opens() {
	gridx.clearAll();
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

	gridx= new dhtmlXGridObject('gridCo');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("NPWPD,Nama Perusahaan,Alamat,Pemilik,C1,C2,C3,C4,C5,C6,C7,C8,C9,Tahun");
	gridx.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
	gridx.setInitWidths("110,200,250,100,0,0,0,0,0,0,0,0,0,0");
	gridx.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,center");
	gridx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridx.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
	gridx.setSkin("dhx_skyblue");
	gridx.attachEvent("onRowDblClicked", selectedOpenData2);
	gridx.init();
	
	function selectedOpenData2(id) {
		document.frmAns.reset();
		document.frmAns.npwpd.value 	= gridx.cells(id,0).getValue();
		document.frmAns.nama_perusahaan.value = gridx.cells(id,1).getValue();
		document.frmAns.tahun.value = gridx.cells(id,13).getValue();
		 for(i=4;i<=12;i++) {
				 if(gridx.cells(id,i).getValue() != "") {
				 	tabbar.removeTab(gridx.cells(id,i).getValue(),true);
					document.getElementById(gridx.cells(id,i).getValue()).checked = true;
					createTabEdit(document.getElementById(gridx.cells(id,i).getValue()).value);
				 }
			}
		batal();
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
		gridx.clearAll();
		gridx.loadXML("<?php echo site_url(); ?>/analisa/dataPerusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	// MEMBUKA DATA INPUTAN ANALISA
	function openDataAnalisa() {
		wOpen = dhxWins.createWindow("wOpenAnalisa",0,0,800,400);
		wOpen.setText("Pencarian Data Perusahaan");
		wOpen.center();
		gridOpen = wOpen.attachGrid();
		gridOpen.setImagePath("<?php echo base_url(); ?>assets/codebase_tabbar/imgs/");
		gridOpen.setHeader("NPWPD,Nama Perusahaan,Alamat,C1,C2,C3,C4,C5,C6,C7,C8,C9,Tahun");
		gridOpen.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
		gridOpen.setInitWidths("110,200,250,0,0,0,0,0,0,0,0,0,100");
		gridOpen.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,center");
		gridOpen.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
		gridOpen.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
		gridOpen.setSkin("dhx_skyblue");
		gridOpen.attachEvent("onRowDblClicked", function(id) {
			document.frmAns.reset();
			document.frmAns.npwpd.value = gridOpen.cells(id,0).getValue();
			document.frmAns.nama_perusahaan.value = gridOpen.cells(id,1).getValue();
			document.frmAns.tahun.value = gridOpen.cells(id,12).getValue();
			 for(i=3;i<=11;i++) {
				 if(gridOpen.cells(id,i).getValue() != "") {
				 	tabbar.removeTab(gridOpen.cells(id,i).getValue(),true);
					document.getElementById(gridOpen.cells(id,i).getValue()).checked = true;
					createTabEdit(document.getElementById(gridOpen.cells(id,i).getValue()).value);
				 }
			}
		});
		gridOpen.init();
		gridOpen.loadXML("<?php echo base_url(); ?>index.php/analisa/openData",function() { statusEnding(); });
	}
	
	function checknumeric(evt)
	{
		if(window.event) // IE
		{
			var charCode = evt.keyCode
			if ((charCode >= 48) & (charCode <= 57) || charCode == 8 ){
				return true;
			}else{
				return false;
			}
		}
		else if(evt.which) // Netscape/Firefox/Opera
		{
			var charCode = evt.which
			if ((charCode >= 48) & (charCode <= 57) || charCode == 8 ){
				return true;
			}else{
				return false;
			}
		}		
	}
	
</script>

