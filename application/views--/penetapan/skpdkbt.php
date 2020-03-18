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
<h2 style="margin:30px 5px 25px 30px;">SKPKBT - <?php echo $title; ?></h2>
<div id="a_tabbar" style="width:1000px; height:640px; margin-left:30px"></div>
<div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPDKBT" id="frmSKPDKBT" action="javascript:void(0)" method="post" onSubmit="" >
    <br /><input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>" />
   	  <table width="1000" border="0">
      		<tr>
        		<td width="242" style="padding-left:15px;">No. SKPKBT</td>
           	  	<td width="429">
                <input type="hidden" name="id" id="id" size="35" />
                <input type="text" name="skpdkbt_1" id="skpdkbt_1" size="22" style="background-color:#FFFFCC;" disabled readonly="readonly"/>&nbsp;/&nbsp;
                <input type="text" name="skpdkbt_2" id="skpdkbt_2" size="15" style="background-color:#FFFFCC;" disabled="disabled" readonly="readonly" /></td>
                <td width="315" align="right" style="padding-right:15px;">Tanggal &nbsp;<input type="text" name="tgl" id="tgl" size="10" disabled="disabled" /></td>
        	</tr>
            <tr>
                <td style="padding-left:15px;">No. Nota Hitung</td>
                <td><input type="text" name="nota" id="nota" size="32" style="text-transform:uppercase; background-color:#FFCC99;" disabled="disabled" />
                <input type="button" onclick="cari()" value="Cari" name="cari1" disabled="disabled" style="padding-left:20px; padding-right:20px" />
              </td>
                <td align="right" style="padding-right:15px;">No. SPTPD&nbsp;
                <input type="text" name="no_sptpd" id="no_sptpd" disabled="disabled" /></td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">NPWPD</td>
                <td><input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase;" disabled readonly="readonly" /></td>
                <td align="right" style="padding-right:15px;">Dasar Pengenaan&nbsp;
<input type="text" name="dasar_pajak" id="dasar_pajak" disabled="disabled" style="text-align:right"></td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Nama</td>
                <td colspan="2"><input type="text" name="nama" id="nama" size="45" disabled readonly="readonly"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat</td>
                <td colspan="2"><input type="text" name="alamat" id="alamat" size="45" disabled readonly="readonly"/></td>
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
               <td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
               <td colspan="2"><input type="text" name="tempo" id="tempo" size="25" disabled="disabled"/></td>
             </tr>
             <tr>
              	<td style="padding-left:15px;">Setoran yang telah dilakukan</td>
                <td colspan="2"><input type="text" name="setoran" id="setoran" style="text-align:right" disabled="disabled"></td>
            </tr>
		</table>
    <div style="padding:10px 35px 0 15px;">
   		<div id="gridItem" height="150px" style="margin-bottom:10px;"></div>
    </div>
<table width="1000" border="0">
	<tr>
    	<td width="200" style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right" style="padding-right:15px;">Jumlah &nbsp;<input type="text" name="jumlah" id="jumlah" disabled style="text-align:right"/></td>
    </tr>
    <tr>
    	<td style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right" style="padding-right:15px;">Kenaikan &nbsp;<input type="text" name="kenaikan" id="kenaikan" disabled style="text-align:right"/></td>
    </tr>
    <tr>
    	<td style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right" style="padding-right:15px;">Denda/Sanksi &nbsp;<input type="text" name="denda" id="denda" disabled style="text-align:right"/></td>
    </tr>
    <tr>
    	<td style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right" style="padding-right:15px;">Kompensasi &nbsp;<input type="text" name="kompensasi" id="kompensasi" disabled style="text-align:right"/></td>
    </tr>
    <tr>
    	<td style="padding-left:15px;">&nbsp;</td>
        <td colspan="3" align="right" style="padding-right:15px;">Total &nbsp;<input type="text" name="total" id="total" disabled style="text-align:right"/></td>
    </tr>
    <tr>
       <td colspan="5" style="background-color:#FFCC99;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" name="baru" id="baru" value="BARU" onClick="baru1()" style="width:90px;">
                                <input type="button" value="SIMPAN" onClick="simpan1()" name="simpan" id="simpan" style="width:90px;">
                                <input type="button" value="EDIT" onClick="edit21()" name="edit1" id="edit1" style="width:90px;" disabled="disabled">
                                <input type="button" value="HAPUS" onClick="deleteData()" name="hapus" id="hapus" disabled="disabled" style="width:90px;">
                                <input type="button" value="CETAK" name="cetak" id="cetak" onclick="cetak1()" disabled="disabled" style="width:90px;"></td>
                        <input type="hidden" name="edit" id="edit" size="1" />
	</tr>
</table>
</form>
<br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="550px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<!--window data skpd-->
 <div id="objBrg" style="display:none;background-color: #e3effd;">
  <form name="frmSrc3" method="post" action="javascript:void(0);">
  <table width="100%" border="0">
  <tr>
  	<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="no_nota">No. Nota Hitung</option>
        	<option value="sptpd">No. SPTPD</option>
            <option value="npwpd">NPWPD Perusahaan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="cariDataWP()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="closeBrg()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
  </tr>
  <tr>
    <td colspan="4"><div id="tmpGridWP" width="850px" height="340px" style="background-color:white;"></div></td>
    </tr>
</table>
  </form>
</div>

<script language="javascript">
function cetak1() {
		var s = document.frmSKPDKBT.skpdkbt_2.value;
		var dua = document.frmSKPDKBT.skpdkbt_1.value;
		
		var gabung = dua+'/'+s;
		window.open('<?php echo site_url(); ?>/skpdkbt/cetak?no_skpdkbt='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function enabledButton(){
		document.frmSKPDKBT.simpan.disabled = false;
		document.frmSKPDKBT.edit1.disabled = false;
		document.frmSKPDKBT.hapus.disabled = false;
		document.frmSKPDKBT.cetak.disabled = false;
	}
	
	function disabledButton(){
		document.frmSKPDKBT.edit1.disabled = true;
		document.frmSKPDKBT.hapus.disabled = true;
		document.frmSKPDKBT.cetak.disabled = true;
	}
	
	function cariDataWP() {
		if(document.frmSrc3.values.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc3.values.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/skpdkbt/cariData/"+kata_kunci+"/"+document.frmSrc3.fil.value+"/"+document.frmSKPDKBT.kode.value,function() {  statusEnding(); });
	}

	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
cal1 = new dhtmlxCalendarObject(['tgl']);
cal1.setDateFormat('%d/%m/%Y');

cal2 = new dhtmlxCalendarObject(['tempo']);
cal2.setDateFormat('%d/%m/%Y');

	function edit21(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dpkaskpkbt1'){
				aktif();
				document.frmSKPDKBT.baru.disabled = false;
				document.frmSKPDKBT.simpan.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
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
	
	gride1 = new dhtmlXGridObject('gridItem');
	gride1.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride1.setHeader("Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah,skpdkbt",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	gride1.setInitWidths("100,100,120,100,100,70,70,90,70,100");
	gride1.setColAlign("left,left,left,left,left,left,left,left,left,left");
	gride1.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gride1.setColSorting("str,str,str,str,str,str,str,str,str,str");
	gride1.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
	gride1.setColumnHidden(9,true);
	//gride1.setColumnHidden(1,true);
	gride1.setSkin("dhx_skyblue");
	gride1.enableMultiselect(true);
	gride1.init();
	
  var dpps1 = "";
	function initDP() {
		dpps1 = new dataProcessor(base_url+"index.php/skpdkbt/child2");
		dpps1.setUpdateMode("off");
		dpps1.init(gride1);	
		dpps1.attachEvent("onAfterUpdateFinish", function() {	
			alert("Data berhasil disimpan");
			loadData();
			enabledButton()
   			return true;
		});
	}
	
	function cek(){
		gride1.clearAll();
		gride1.loadXML("<?php echo site_url(); ?>/nhp/data_rekening?sptpd="+document.frmSKPDKBT.sptpd.value);
	}
	
	// grid data skpdkbt
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("no,no_skpdkbt,nota,npwpd,masa_pajak1,masa_pajak2,tahun,jatuh_tempo,setoran,dasar_pajak,no_sptpd,tanggal,jumlah,kenaikan,denda,kompensasi,total,nama_perusahaan,alamat_perusahaan",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,50,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	//grid.setColumnHidden(0,true);
	
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);	
	grid.init();
	loadData();
	
	function selectedOpenData(id) {
		statusLoading();
		//kosongfrmSKPDKBT();
		//enableButton();
		document.frmSKPDKBT.id.value	= grid.cells(id,0).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmSKPDKBT.skpdkbt_1.value = arr[0];
		document.frmSKPDKBT.skpdkbt_2.value = arr[1]+'/'+arr[2];
		document.frmSKPDKBT.nota.value = grid.cells(id,2).getValue();
		document.frmSKPDKBT.npwpd.value = grid.cells(id,3).getValue();
		document.frmSKPDKBT.awal.value 	= grid.cells(id,4).getValue();
		document.frmSKPDKBT.akhir.value 	= grid.cells(id,5).getValue();
		document.frmSKPDKBT.tahun.value 	= grid.cells(id,6).getValue();
		document.frmSKPDKBT.setoran.value = grid.cells(id,8).getValue();
		document.frmSKPDKBT.tempo.value = grid.cells(id,7).getValue();
			document.frmSKPDKBT.dasar_pajak.value = grid.cells(id,9).getValue();
			document.frmSKPDKBT.no_sptpd.value = grid.cells(id,10).getValue();
			document.frmSKPDKBT.tgl.value = grid.cells(id,11).getValue();
			document.frmSKPDKBT.jumlah.value = grid.cells(id,12).getValue();
			document.frmSKPDKBT.kenaikan.value = grid.cells(id,13).getValue();
			document.frmSKPDKBT.denda.value = grid.cells(id,14).getValue();
			document.frmSKPDKBT.kompensasi.value = grid.cells(id,15).getValue();
			document.frmSKPDKBT.total.value = grid.cells(id,16).getValue();
			document.frmSKPDKBT.nama.value = grid.cells(id,17).getValue();
			document.frmSKPDKBT.alamat.value = grid.cells(id,18).getValue();
			document.frmSKPDKBT.edit.value = 1;
		loadChild();
		document.frmSKPDKBT.baru.disabled = true;
		document.frmSKPDKBT.simpan.disabled = true;
		document.frmSKPDKBT.cetak.disabled = false;
		document.frmSKPDKBT.edit1.disabled = false;
		document.frmSKPDKBT.hapus.disabled = false;
		tabbar.setTabActive("a1");
		statusEnding();
	}
	
	function loadChild(){
		var no_skpdkbt = document.frmSKPDKBT.skpdkbt_1.value+'/'+document.frmSKPDKBT.skpdkbt_2.value;
		gride1.clearAll();
		gride1.loadXML("<?php echo site_url(); ?>/skpdkbt/child_skpdkbt?skpdkbt="+no_skpdkbt);
	}
	
	function loadData() {
		grid.clearAll();
		grid.loadXML(base_url+"index.php/skpdkbt/LoadData/"+document.frmSKPDKBT.kode.value, function(){
			noUrut();	
		});
	}
	
	function noUrut(){
    var RowsNum = grid.getRowsNum();                 
    for(var i=1;i<=RowsNum;i++){        
        for(var j=0;j<i;j++){        
            var id = grid.getRowId(j);                                                 
        }
        grid.cells(id,0).setValue(i);   
    }
}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dpkaskpkbt1'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
						"id=" + document.frmSKPDKBT.skpdkbt_1.value+'/'+document.frmSKPDKBT.skpdkbt_2.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/skpdkbt/delete', postStr, responeDel);	
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
					bersih();
					loadData();
					disabledButton();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function bersih(){
            document.frmSKPDKBT.skpdkbt_1.value = "";
            document.frmSKPDKBT.skpdkbt_2.value = "";            
			document.frmSKPDKBT.nota.value = "";
			document.frmSKPDKBT.npwpd.value = "";
			document.frmSKPDKBT.nama.value = "";
			document.frmSKPDKBT.alamat.value = "";
			document.frmSKPDKBT.awal.value = "";
			document.frmSKPDKBT.akhir.value = "";
			document.frmSKPDKBT.tahun.value = "";
			document.frmSKPDKBT.tempo.value = "";
			document.frmSKPDKBT.setoran.value = "";
			document.frmSKPDKBT.dasar_pajak.value = "";
			document.frmSKPDKBT.no_sptpd.value = "";
			document.frmSKPDKBT.tgl.value = "";
			document.frmSKPDKBT.jumlah.value = "";
			document.frmSKPDKBT.kenaikan.value = "";
			document.frmSKPDKBT.denda.value = "";
			document.frmSKPDKBT.kompensasi.value = "";
			document.frmSKPDKBT.total.value = "";
			document.frmSKPDKBT.edit.value = "";
        }
		
	function aktif(){
            document.frmSKPDKBT.nota.disabled = false;
			document.frmSKPDKBT.tempo.disabled = false;
			document.frmSKPDKBT.tgl.disabled = false;
			document.frmSKPDKBT.kenaikan.disabled = false;
			document.frmSKPDKBT.denda.disabled = false;
			document.frmSKPDKBT.kompensasi.disabled = false;
			document.frmSKPDKBT.simpan.disabled = false; //button
			document.frmSKPDKBT.cari1.disabled = false;
    }
	
	function pasif(){
            document.frmSKPDKBT.skpdkbt_1.disabled = true;
            document.frmSKPDKBT.skpdkbt_2.disabled = true;
			document.frmSKPDKBT.nota.disabled = true;
			document.frmSKPDKBT.npwpd.disabled = true;
			document.frmSKPDKBT.nama.disabled = true;
			document.frmSKPDKBT.alamat.disabled = true;
			document.frmSKPDKBT.awal.disabled = true;
			document.frmSKPDKBT.akhir.disabled = true;
			document.frmSKPDKBT.tahun.disabled = true;
			document.frmSKPDKBT.tempo.disabled = true;
			document.frmSKPDKBT.setoran.disabled = true;
			document.frmSKPDKBT.dasar_pajak.disabled = true;
			document.frmSKPDKBT.no_sptpd.disabled = true;
			document.frmSKPDKBT.tgl.disabled = true;
			document.frmSKPDKBT.jumlah.disabled = true;
			document.frmSKPDKBT.kenaikan.disabled = true;
			document.frmSKPDKBT.denda.disabled = true;
			document.frmSKPDKBT.kompensasi.disabled = true;
			document.frmSKPDKBT.total.disabled = true;
			document.frmSKPDKBT.simpan.disabled = true; //button
			document.frmSKPDKBT.cari1.disabled = true; //cari
    }
	
	function baru1(){
		bersih();
		aktif();
		document.frmSKPDKBT.simpan.disabled = false;
		disabledButton();
		gride1.clearAll();
		jumchild();	
	}
	
	 function simpan1(){
		 if(document.frmSKPDKBT.npwpd.value=="") {
			document.frmSKPDKBT.npwpd.focus();
			alert("NPWPD Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPDKBT.tgl.value=="") {
			document.frmSKPDKBT.tgl.focus();
			alert("Tanggal Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPDKBT.tempo.value=="") {
			document.frmSKPDKBT.tempo.focus();
			alert("Tanggal Jatuh Tempo Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPDKBT.total.value=="") {
			document.frmSKPDKBT.total.focus();
			alert("Total Tidak Boleh Kosong");
			return;
		}
            statusLoading();  			
			initDP();
            var poststr =
                'skpdkbt_1=' + document.frmSKPDKBT.skpdkbt_1.value +
                '&skpdkbt_2=' + document.frmSKPDKBT.skpdkbt_2.value +
                '&nota=' + document.frmSKPDKBT.nota.value +
                '&npwpd=' + document.frmSKPDKBT.npwpd.value +
                '&nama=' + document.frmSKPDKBT.nama.value +
                '&alamat=' + document.frmSKPDKBT.alamat.value +
                '&awal=' + document.frmSKPDKBT.awal.value +
                '&akhir=' + document.frmSKPDKBT.akhir.value +
                '&tahun=' + document.frmSKPDKBT.tahun.value +
                '&tempo=' + document.frmSKPDKBT.tempo.value +
                '&setoran=' + document.frmSKPDKBT.setoran.value +                                       
                '&dasar_pajak=' + document.frmSKPDKBT.dasar_pajak.value +
                '&no_sptpd=' + document.frmSKPDKBT.no_sptpd.value +
                '&tgl=' + document.frmSKPDKBT.tgl.value +
                '&jumlah=' + document.frmSKPDKBT.jumlah.value +
                '&kenaikan=' + document.frmSKPDKBT.kenaikan.value +
                '&denda=' + document.frmSKPDKBT.denda.value+
				'&kompensasi=' + document.frmSKPDKBT.kompensasi.value+
				'&total=' + document.frmSKPDKBT.total.value+          
				'&edit=' + document.frmSKPDKBT.edit.value+
		       '&kode=' + document.frmSKPDKBT.kode.value;
            dhtmlxAjax.post(base_url+"index.php/skpdkbt/simpan", encodeURI(poststr), outputResponse);
        }
        
        function outputResponse(loader) {        
            statusEnding();
            result = loader.xmlDoc.responseText;
            if(result) {                 
                arr = result.split("/");
                document.frmSKPDKBT.skpdkbt_1.value = arr[0];
                document.frmSKPDKBT.skpdkbt_2.value = arr[1]+"/"+arr[2];
				tmpRows1();	          
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }
        

    // get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows1() {
		//alert('ok');
        var arr = gride1.getAllItemIds().split(',');
        for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gride1.cells(id,0).getValue()+'|'+
            gride1.cells(id,1).getValue()+'|'+
            gride1.cells(id,2).getValue()+'|'+
            gride1.cells(id,3).getValue()+'|'+
            gride1.cells(id,4).getValue()+'|'+
            gride1.cells(id,5).getValue()+'|'+
            gride1.cells(id,6).getValue()+'|'+
            gride1.cells(id,7).getValue()+'|'+
            gride1.cells(id,8).getValue()+'|'+
            gride1.cells(id,9).getValue();
			                                    
        }
		
		gride1.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
        }
        
		r = new Array();
        dpps1.sendData();  
    }
	
	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gride1.uid();
        var posisi = gride1.getRowsNum();
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
		var row10= document.frmSKPDKBT.skpdkbt_1.value+'/'+document.frmSKPDKBT.skpdkbt_2.value;
        //if(arrs[0] != "") {
            gride1.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
			//alert('1');
        //}
    } 
	
	dhxWins= new dhtmlXWindows();
	dhxWins.setImagePath("<?php echo base_url(); ?>/assets/codebase_windows/imgs/");
	wBrg = dhxWins.createWindow("wBrg",0,0,850,445);
	wBrg.setText("Daftar Nota Hitung <?php echo $title; ?>");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function closeBrg() {
		wBrg.hide();
		wBrg.setModal(false);
	}
	
	// grid data skpd
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	gridWP.setInitWidths("50,170,150,150,100,100,100,100,100");
	gridWP.setColAlign("center,left,left,left,left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridWP.setColSorting("str,str,str,str,str,str,str,str,str");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmSKPDKBT.nota.value = gridWP.cells(id,0).getValue();
		document.frmSKPDKBT.npwpd.value = gridWP.cells(id,2).getValue();
		document.frmSKPDKBT.nama.value = gridWP.cells(id,3).getValue();
		document.frmSKPDKBT.alamat.value = gridWP.cells(id,4).getValue();
		document.frmSKPDKBT.awal.value = gridWP.cells(id,5).getValue();
		document.frmSKPDKBT.akhir.value = gridWP.cells(id,6).getValue();
		document.frmSKPDKBT.tahun.value = gridWP.cells(id,7).getValue();
		document.frmSKPDKBT.no_sptpd.value = gridWP.cells(id,1).getValue();
		//document.frmSKPDKBT.dasar_pajak.value = gridWP.cells(id,12).getValue();
		loadItem();
		loadchild1();
		closeBrg();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	gridWP.clearAll();
	
	function loadchild1(){
		b = document.frmSKPDKBT.nota.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gride1.clearAll();
		gride1.loadXML(base_url+"index.php/skpdkbt/dataItemPajak1/"+pasang,function() { statusEnding(); });			
	}
	
	function loadItem(){
		gride1.clearAll();
		var poStr1 =
		"nota=" + document.frmSKPDKBT.nota.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdkbt/getDataItem', poStr1, respePe);			
	}
	
	function respePe(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					chas = result.split("|");
					document.frmSKPDKBT.dasar_pajak.value = chas[0];
					document.frmSKPDKBT.setoran.value = chas[1];
					document.frmSKPDKBT.tgl.value = chas[2];
					document.frmSKPDKBT.tempo.value = chas[3];
					
					document.frmSKPDKBT.jumlah.value = chas[4];
					document.frmSKPDKBT.kenaikan.value = 0;
					document.frmSKPDKBT.denda.value = 0;
					document.frmSKPDKBT.kompensasi.value = 0;
					document.frmSKPDKBT.total.value = chas[4]-chas[1];
					
				} else {
					alert('Terjadi kesalahan pada System');
				}
			}
		}
	}
	
	function cari() {
		wBrg.show();
    	wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objBrg');
		gridWP.clearAll();
	}
	
	statusEnding();
</script>
</div>