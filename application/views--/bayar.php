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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<style>
body {
	background:#FFF;
}
</style>
<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Surat Tanda Bukti Pembayaran (STBP) <br/>Wajib Pajak</h2>

<div id="a_tabbar" style="width:800px; height:260px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0;"><br />
    <form name="frmBayar" id="frmBayar">
    	<table border="0" id="tab_pengukuhan">
    		<tr>
                <td width="174" style="padding-left:15px;">No. Bukti Pembayaran</td>
                <td width="400"><input type="text" name="bayar" id="bayar" size="39px" style="text-transform:uppercase; background-color: #FFFFCC;" disabled="disabled"></td>
            </tr>
            <tr>
                <td width="174" style="padding-left:15px;">No. SSPD</td>
                <td width="400"><input type="text" name="sspd" id="sspd" size="25px" style="text-transform:uppercase; background-color: #FFCC99;" disabled="disabled"><input type="button" value="Cari" onclick="openData()" name="buka" style="padding-left:20px; padding-right:20px" disabled="disabled"/></td>
			</tr>
            <tr>
    			<td style="padding-left:15px;">NPWPD</td>
				<td><input type="text" name="npwpd" id="npwpd" disabled="disabled" size="39px" style="background-color:#FFFFCC;"/><input type="hidden" name="skpd" id="skpd" disabled="disabled" size="46px" style="background-color:#FFFFCC;"/></td>
         	</tr>
            <tr>
    			<td style="padding-left:15px;">Nama Usaha</td>
				<td><input type="text" name="nama" id="nama" disabled="disabled" size="39px" style="background-color:#FFFFCC;"/></td>
         	</tr>
            <tr>
              	<td style="padding-left:15px;">Alamat Usaha</td>
				<td><input type="text" name="alamat" id="alamat" disabled="disabled" size="39px" style="background-color:#FFFFCC;"/></td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Jumlah Setoran Pajak</td>
				<td><input type="text" name="jml" id="jml" disabled="disabled" size="35px" /></td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">Setoran Wajib Pajak</td>
				<td><input type="text" name="setor_wp" id="setor_wp" size="35px" onkeyup="hitung_wp()"/>
                <input type="hidden" name="no_sptpd" id="no_sptpd" /></td>
    		</tr>
			<tr>
				<td width="70" style="padding-left:15px;">Tanggal Terima</td>
                <td><input type="text" style="background-color:#FFCC99;" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>"  />
            </tr>
			<tr>
               <!-- <td style="padding-left:15px;">Kurang</td>-->
				<td><input type="hidden" name="kurang_wp" id="kurang_wp" disabled="disabled" size="35px" /></td>
    		</tr>
            <tr>
               <!-- <td style="padding-left:15px;">lebih</td> -->
				<td><input type="hidden" name="lebih_wp" id="lebih_wp" disabled="disabled" size="35px" /></td>
    		</tr>
            <tr>
            	<td style="padding-left:15px;">
                &nbsp;<input type="button" value="Baru" onclick="barus()" name="new1" style="padding-left:20px; padding-right:20px"/>
                </td>
                <td colspan="3"><input id="tambah" type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;<input id="delete1" type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;<input id="cetak1" type="button" value="Cetak" onclick="cetakData()" name="cetak1" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
            </tr>
    	</table>
    </form>
    <br />
</div>

<div id="C2">
<!--<br />
	<form name="frmBayar2" id="frmBayar2">
    <table>
    	<tr>
        	<td style="padding:0px 5px 0px 15px;">Cari data berdasarkan</td>
            <td><select nama="cek" id="cek">
            <option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Alamat Perusahaan</option>
           </select></td>
            <td style="padding:0px 5px 0px 15px;">Value</td>
            <td><input type="text" name="values" id="values" size="25" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
            <td><input type="button" onclick="lihat2()" name="filter" value="Cari" style="padding-left:20px; padding-right:20px"/></td>
        </tr>
    </table>
    </form>
<br />-->
    <div style="padding:0 75px 0 0px;">
   		<div id="gridContent" height="500px" width="800" style="margin-bottom:10px;"></div>
        <div id="pagingArea" width="450px" style="background-color:white;"></div>
	</div> 
</div>

</div>
<div id="objBrg21" style="display:none;">
<form name="frmSrc21" id="frmSrc21" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">No. SSPD</option>
            <option value="2">NPWPD Perusahaan</option>
            <option value="3">Nama Perusahaan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat21()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal21()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo21" width="750px" height="250px" style="margin-bottom:10px;"></div>
</div>
</div>
<script type="text/javascript">
	function cetakData() {
		window.open('<?php echo site_url(); ?>/buku/cetak_bayar?bayar='+document.frmBayar.bayar.value, '', 'height=700,width=1000,scrollbars=yes');
	}

	function deleteData(){
		/*confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"bayar=" + document.frmBayar.bayar.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/buku/deleteBayar', postStr, responeDel);	
		}*/
		
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				var postStr =
				"bayar=" + document.frmBayar.bayar.value+
				"&sspd=" + document.frmBayar.sspd.value ;
				statusLoading();
				dhtmlxAjax.post(base_url+'index.php/buku/deleteBayar', postStr, responeDel);	
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
					refreshData();
					kosongfrmData();
					disabledData();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function disabledData(){
		document.frmBayar.tambah.disabled = true;
		document.frmBayar.delete1.disabled = true;
		document.frmBayar.cetak1.disabled = true;
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_tbp, no_sspd, npwpd, skpd, nama_perusahaan, alamat_perusahaan, jumlah, setoran, kurang, lebih");
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,120,150,120,150,150,150,150,150,150,150");
	grid.setColAlign("center,center,center,center,center,center,center,center,center,center,center");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ron,ron");
	grid.setColSorting("str,str,str,str,str,str,str,int,int,int,int");
	grid.enablePaging(true,10,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setSkin("dhx_skyblue");
	grid.setColumnHidden(0,true);
	grid.setNumberFormat("0,000",6,",",".");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/buku/data_pembayaran");
	grid.init();
	
	function selectedOpenData(id){
		document.frmBayar.id.value = grid.cells(id,0).getValue();
		document.frmBayar.bayar.value = grid.cells(id,1).getValue();
		document.frmBayar.sspd.value = grid.cells(id,2).getValue();
		document.frmBayar.npwpd.value = grid.cells(id,3).getValue();
		document.frmBayar.skpd.value = grid.cells(id,4).getValue();
		document.frmBayar.nama.value = grid.cells(id,5).getValue();
		document.frmBayar.alamat.value = grid.cells(id,6).getValue();
		document.frmBayar.jml.value = format_number(grid.cells(id,7).getValue());
        document.frmBayar.setor_wp.value = format_number(grid.cells(id,8).getValue());
        document.frmBayar.kurang_wp.value = format_number(grid.cells(id,9).getValue());
        document.frmBayar.lebih_wp.value = format_number(grid.cells(id,10).getValue());
		tabbar.setTabActive("a1");
		enabledButton();
	}
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/buku/data_pembayaran");
	}
	
	cal1 = new dhtmlxCalendarObject(['tanggal']);
    cal1.setDateFormat('%d/%m/%Y');
	
	function simpan() {
		
		if(document.frmBayar.sspd.value=="") {
			alert("No.SSPD Tidak Boleh Kosong");
			document.frmBayar.sspd.focus();
			return;
		}
		
		tgl = document.frmBayar.tanggal.value;
		arr = tgl.split("/");
		tanggal = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		var postStr =
			"id=" + document.frmBayar.id.value +
			"&tbp=" + document.frmBayar.bayar.value +
			"&npwpd=" + document.frmBayar.npwpd.value +
			"&nama=" + document.frmBayar.nama.value +
			"&alamat=" + document.frmBayar.alamat.value +
			"&sspd=" + document.frmBayar.sspd.value +
			"&skpd=" + document.frmBayar.skpd.value +
			"&jml=" + document.frmBayar.jml.value +
            "&setor=" + document.frmBayar.setor_wp.value +
            "&tanggal=" + tanggal +
            "&kurang=" + document.frmBayar.kurang_wp.value +
            "&lebih=" + document.frmBayar.lebih_wp.value + 
            "&sptpd=" + document.frmBayar.no_sptpd.value;
            ;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/buku/simpan_bayar', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmBayar.bayar.value = result;
					refreshData();
					statusEnding();	
					enabledButton();
					alert("Done");
					return true;	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	} 
	
    function hitung_wp(){
        var jumlah = document.frmBayar.jml.value;
        var setor = document.frmBayar.setor_wp.value;
        if (setor >= jumlah && jumlah <= setor){
            //lebih
            var hasil_lebih = setor - jumlah;
            var hasil_kurang = 0;
        }else if(jumlah >= setor && setor <= jumlah){
            //kurang
            var hasil_kurang = jumlah - setor;
            var hasil_lebih = 0;            
        }
        document.frmBayar.kurang_wp.value = hasil_kurang;
        document.frmBayar.lebih_wp.value = hasil_lebih;
    }
    
	function enabledButton(){
		document.frmBayar.tambah.disabled = true;
		document.frmBayar.delete1.disabled = false;
		document.frmBayar.cetak1.disabled = false;
	}

	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.enableAutoSize(false, true);
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	wBrog21 = dhxWins.createWindow("wBrog21",0,0,800,370);
	wBrog21.setText("Pencarian Data Registrasi");
	wBrog21.button("park").hide();
	wBrog21.button("close").hide();
	wBrog21.button("minmax1").hide();
	wBrog21.hide();

	function openData() {
		wBrog21.show();
    	wBrog21.setModal(true);
		wBrog21.center();
		wBrog21.attachObject('objBrg21');
	}
	
	function batal21() {
		wBrog21.hide();
		wBrog21.setModal(false);
		document.frmSrc21.fil.value = "";
		document.frmSrc21.values.value = "";
		gridData.clearAll();
	}
	
	function lihat21() {
		op = document.frmSrc21.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmSrc21.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc21.values.focus();
			return;
			}
		}
		nilai = document.frmSrc21.values.value;
		gridData.clearAll();
		gridData.loadXML("<?php echo site_url(); ?>/buku/load_sspd/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	gridData = new dhtmlXGridObject('gridCo21');
	gridData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridData.setHeader("id,no_sspd,tanggal,no_skpd,npwpd,nama_perusahaan,alamat_perusahaan,ketetapan,setoran,sptpd");
	gridData.setInitWidths("50,150,100,100,100,100,100,100,100,100");
	gridData.setColAlign("left,left,left,left,left,left,left,left,left,left");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ron,ro");
	gridData.enableMultiselect(true);
	gridData.setNumberFormat("0,000",8,",",".");
	gridData.enablePaging(true,10,10,"pagingArea",true);
	gridData.setSkin("dhx_skyblue");
	gridData.setColumnHidden(0,true);
	gridData.attachEvent("onRowDblClicked", selectedOpenData21);
	gridData.init();
	
	function selectedOpenData21(id){
		document.frmBayar.sspd.value = gridData.cells(id,1).getValue();
		document.frmBayar.npwpd.value = gridData.cells(id,4).getValue();
		document.frmBayar.skpd.value = gridData.cells(id,3).getValue();
		document.frmBayar.nama.value = gridData.cells(id,5).getValue();
		document.frmBayar.alamat.value = gridData.cells(id,6).getValue();
		document.frmBayar.jml.value = gridData.cells(id,7).getValue();
        document.frmBayar.setor_wp.value = gridData.cells(id,8).getValue();
        document.frmBayar.no_sptpd.value = gridData.cells(id,9).getValue();
        //alert(gridData.cells(id,9).getValue());
        //document.frmBayar.kurang_wp.value = gridData.cells(id,9).getValue();
        //document.frmBayar.lebih_wp.value = gridData.cells(id,10).getValue();
		batal21();
	}
	
	function barus(){
		kosongfrmData();
		document.frmBayar.buka.disabled = false;
		document.frmBayar.sspd.disabled = false;
		document.frmBayar.sspd.focus();
		document.frmBayar.tambah.disabled = false;              
	}
	
	function kosongfrmData() {
		document.frmBayar.id.value = "";
		document.frmBayar.bayar.value = "";
		document.frmBayar.npwpd.value = "";
		document.frmBayar.nama.value = "";
		document.frmBayar.alamat.value = "";
		document.frmBayar.skpd.value = "";
		document.frmBayar.sspd.value = "";
		document.frmBayar.jml.value = "";
        document.frmBayar.setor_wp.value = "";
        document.frmBayar.kurang_wp.value = "";
        document.frmBayar.lebih_wp.value = "";
	}
	
	statusEnding();
</script>