<?php
error_reporting(0);
list($pajak,$jmlOL) = explode("|",$pajak);
?>

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

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	
	function simpan() {
		
		if(document.frmPengukuhan.npwpd.value=="") {
			alert("Nama Bidang Tidak Boleh Kosong");
			document.frmPengukuhan.npwpd.focus();
			return;
		}
		
		var pajak = "";
		<?php for($n=1;$n<=$jmlOL;$n++) { ?>
			if(document.frmPengukuhan.O<?php echo $n; ?>.checked==true) { pajak = document.frmPengukuhan.O<?php echo $n; ?>.value+"|"+pajak; }
		<?php } ?>
		var postStr =
			"id=" + document.frmPengukuhan.id.value +
			"&ukuh=" + document.frmPengukuhan.ukuh.value +
			"&npwpd=" + document.frmPengukuhan.npwpd.value +
			"&nama=" + document.frmPengukuhan.nama.value +
			"&alamat=" + document.frmPengukuhan.alamat.value +
			"&pemilik=" + document.frmPengukuhan.pemilik.value +
			"&tunggakan=" + document.frmPengukuhan.tunggakan.value +
			"&pajak=" + pajak;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/tegur_skpd/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmPengukuhan.ukuh.value = result;
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
	
	function kosongfrmData() {
		document.frmPengukuhan.id.value = "";
		document.frmPengukuhan.ukuh.value = "";
		document.frmPengukuhan.npwpd.value = "";
		document.frmPengukuhan.nama.value = "";
		document.frmPengukuhan.alamat.value = "";
		document.frmPengukuhan.pemilik.value = "";
		document.frmPengukuhan.tunggakan.value = "";
		document.frmPengukuhan.usaha.value = "";
		<?php for($i=1;$i<=$jmlOL;$i++) { ?>
			document.frmPengukuhan.O<?php echo $i; ?>.checked = false;
		<?php } ?>
	}
	
	function barus(){
		kosongfrmData();
		document.frmPengukuhan.buka.disabled = false;
		document.frmPengukuhan.npwpd.disabled = false;
		document.frmPengukuhan.npwpd.focus();
		document.frmPengukuhan.tambah.disabled = false;
		document.frmPengukuhan.pemilik.disabled = false;
		document.frmPengukuhan.tunggakan.disabled = false;
	}
</script>
<style>
body{
		background:#FFF;
	}
	</style>
<div id="objBrg21" style="display:none;">
<form name="frmSrc21" id="frmSrc21" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Usaha</option>
            <option value="2">Nama Usaha</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat21()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal21()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo21" width="750px" height="250px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="450px" style="background-color:white;"></div>
</div>
</div>

<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Surat Pemberitahuan</h2>

<div id="a_tabbar" style="width:1000px; height:490px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0;"><br />
    <form name="frmPengukuhan" id="frmPengukuhan">
    	<table border="0" id="tab_pengukuhan">
    		<tr>
                <td width="174" style="padding-left:15px;">No. Pemberitahuan</td>
                <td width="400"><input type="hidden" name="id" id="id" size="35px" style="text-transform:uppercase; background-color: #FFFFCC;" disabled="disabled"><input type="text" name="ukuh" id="ukuh" size="35px" style="text-transform:uppercase; background-color: #FFFFCC;" disabled="disabled"></td>
            </tr>
            <tr>
                <td width="174" style="padding-left:15px;">NPWPD</td>
                <td width="400"><input type="text" name="npwpd" id="npwpd" size="35px" style="text-transform:uppercase; background-color: #FFCC99;" disabled="disabled"><input type="button" value="Cari" onclick="openData()" name="buka" style="padding-left:20px; padding-right:20px" disabled="disabled"/></td>
            </tr>
            <tr>
    			<td style="padding-left:15px;">Nama Usaha</td>
				<td><input type="text" name="nama" id="nama" disabled="disabled" size="46px" style="background-color:#FFFFCC;"/></td>
         	</tr>
            <tr>
              	<td style="padding-left:15px;">Alamat</td>
				<td><input type="text" name="alamat" id="alamat" disabled="disabled" size="46px" style="background-color:#FFFFCC;"/></td>
            </tr>
			<tr>
              	<td style="padding-left:15px;">Pemilik/Pimpinan</td>
				<td>
					<select name="pemilik" disabled="disabled" id="pemilik">
						<option value=""></option>
                        <option value="1">Pemilik</option>
                        <option value="2">Pimpinan</option>
					</select>
				</td>
            </tr>
			<tr>
              	<td style="padding-left:15px;">Tunggakan</td>
				<td><input type="text" name="tunggakan" id="tunggakan"  disabled="disabled" size="46px" style="background-color:#white;"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Pengajuan Jenis Usaha</td>
				<td><input type="hidden" name="usaha" id="usaha" disabled="disabled" size="46px" style="background-color:#FFFFCC;"/></td>
            </tr>
            </table>
            <table>
            <tr>
            	<td>
           <fieldset><legend>Kewajiban</legend>
           <table>
            <tr>
            	<td colspan="2" style="padding-left:15px;">
                	<div style="overflow:auto; height:220px; width:400px; border:2px inset #999; margin-left:0px;"><?php echo $pajak; ?></div>
                </td>
            </tr>
            </table>
            </fieldset>
            </td>
            </tr>
            </table>
            <table>
            <tr>
            	<td style="padding-left:15px; background-color:#FFCC99;">
                &nbsp;<input type="button" value="Baru" onclick="barus()" name="new1" style="padding-left:20px; padding-right:20px"/>
                </td>
                <td colspan="3" style="background-color:#FFCC99;"><input id="tambah" type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;<input id="delete1" type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;<input id="cetak1" type="button" value="Cetak" onclick="cetakData()" name="cetak1" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
            </tr>
    	</table>
    </form>
    <br />
</div>

<div id="C2">
<!--<br />
	<form name="frmPengukuhan2" id="frmPengukuhan2">
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
    </form>-->
    <div style="padding:0 0px 0px 0px;">
   		<div id="gridContent" height="500px" width="995px" style="margin-bottom:10px;"></div>
        <div id="pagingArea" width="450px" style="background-color:white;"></div>
	</div> 
</div>

</div>
<script language="javascript">
	function cetakData(){
		window.open('<?php echo site_url(); ?>/tegur_skpd/cetak?npwpd='+document.frmPengukuhan.npwpd.value, '', 'height=700,width=1000,scrollbars=yes');
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
	wBrog21.setText("Pencarian Data Perusahaan");
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
		gridData.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	gridData = new dhtmlXGridObject('gridCo21');
	gridData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridData.setHeader("id, NPWPD Perusahaan, nama_perusahaan, alamat_perusahaan, jalan, rt, rw, email, id_kel, kelurahan, id_kec, kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_pemilik, rt_pemilik, rw_pemilik, email_pemilik, lokasi_pemilik, kelurahan_pemilik, kecamatan_pemilik, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, jenis_pajak_detail, tgl_daftar,kode_kec,kode_kel");//36
	gridData.setInitWidths("50,150,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");//19
	gridData.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridData.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridData.enablePaging(true,1000,1000,"pagingArea",true);
	gridData.setSkin("dhx_skyblue");
	gridData.setColumnHidden(0,true);
	gridData.attachEvent("onRowDblClicked", selectedOpenData21);
	gridData.init();
	
	function selectedOpenData21(id){
		document.frmPengukuhan.npwpd.value = gridData.cells(id,1).getValue();
		document.frmPengukuhan.nama.value = gridData.cells(id,2).getValue();
		document.frmPengukuhan.alamat.value = gridData.cells(id,3).getValue();        
		document.frmPengukuhan.usaha.value = gridData.cells(id,28).getValue();        		
		batal21();
	}
	
	cal1 = new dhtmlxCalendarObject('tanggal_lahir');
	cal1.setDateFormat('%d/%m/%Y');
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID, No. Pemberitahuan, NPWPD Perusahaan, Nama Perusahaan, Alamat Perusahaan, Kewajiban, Pemilik/Pimpinan, Tunggakan, Jenis_usaha");
	grid.setInitWidths("50,110,120,150,300,80,100,150,120");
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setColAlign("center,center,left,left,left,left,center,center,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,20,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setSkin("dhx_skyblue");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.enableMultiselect(true);
	grid.enableSmartRendering(true);
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/tegur_skpd/data");
	grid.init();
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/tegur_skpd/data");
	}
	
	function enabledButton(){
		document.frmPengukuhan.tambah.disabled = false;
		document.frmPengukuhan.delete1.disabled = false;
		document.frmPengukuhan.cetak1.disabled = false;
	}
	
	function disabledButton(){
		document.frmPengukuhan.delete1.disabled = true;
		document.frmPengukuhan.cetak1.disabled = true;
	}
	
	function selectedOpenData(id) {
		tabbar.setTabActive("a1");
		statusLoading();
		kosongfrmData();
		enabledButton();
		//enabledData();
		document.frmPengukuhan.id.value	= grid.cells(id,0).getValue();
		document.frmPengukuhan.ukuh.value = grid.cells(id,1).getValue();
		document.frmPengukuhan.npwpd.value = grid.cells(id,2).getValue();
		document.frmPengukuhan.nama.value = grid.cells(id,3).getValue();
		document.frmPengukuhan.alamat.value = grid.cells(id,4).getValue();
		menu = grid.cells(id,5).getValue();
        document.frmPengukuhan.usaha.value = grid.cells(id,6).getValue();
		document.frmPengukuhan.pemilik.value = grid.cells(id,6).getValue();
		document.frmPengukuhan.tunggakan.value = grid.cells(id,7).getValue();
		arr_menu = menu.split('|');
		jml = <?php echo $jmlOL; ?>;
		for(p=0;p<jml;p++) {
			<?php for($i=1;$i<=$jmlOL;$i++) { ?>
			if(document.frmPengukuhan.O<?php echo $i; ?>.value==arr_menu[p]) { document.frmPengukuhan.O<?php echo $i; ?>.checked=true; }
			<?php } ?>
		}
		statusEnding();
	}
	
	function deleteData() {
		/*confrm = confirm("Apakah Anda Yakin");
		if(confrm) {
			var postStr =
				"id=" + document.frmPengukuhan.id.value +
				"&npwpd=" + document.frmPengukuhan.npwpd.value;
			statusLoading();
			dhtmlxAjax.post(base_url+'index.php/izin/delete_pemilik', postStr, responeDel);	
		}*/
		
		var enter=prompt("Please enter your password","");
		if (enter!=null){
			if(enter=='dispenda'){
				confrm = confirm("Apakah Anda Yakin Hapus Data Ini ?");
				if(confrm) {					
						var postStr =
							"id=" + document.frmPengukuhan.id.value +
							"&npwpd=" + document.frmPengukuhan.npwpd.value;		
								//alert(postStr);
							statusLoading();
							dhtmlxAjax.post(base_url+'index.php/tegur_skpd/delete', postStr, responeDel);	
				}
			} else {
				alert("Password anda salah");
			}
		}	
		
	}
	
	function responeDel(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result==1) {					
					refreshData();
					//disableButton();
					statusEnding();
					alert("Data pemilik berhasil dihapus.");
					kosongfrmData();	
					document.frmPengukuhan.tambah.disabled = true;
					document.frmPengukuhan.delete1.disabled = true;
					document.frmPengukuhan.cetak1.disabled = true;					
					return true;
				}else{
					refreshData();
					//disableButton();		
					statusEnding();						
					alert("Silakan Menghapus Data Perusahaan Terlebih Dahulu.");					
					kosongfrmData();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	statusEnding();
</script>