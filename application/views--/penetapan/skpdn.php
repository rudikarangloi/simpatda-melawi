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
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function simpan(){
		arrTgl = document.skpdn.tempo.value.split("/");
		tgl_jth_tempo = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		
		arrTgl_1 = document.skpdn.tgl.value.split("/");
		tgl = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		var postStr =
			"skpdn=" + document.skpdn.no_teguran.value +
			"&tgl=" + tgl +
			"&id=" + document.skpdn.id.value +
			"&nota=" + document.skpdn.no_nota.value +
			"&npwpd=" + document.skpdn.npwpd.value +
			"&kd_rek=" + document.skpdn.no_rekening.value +
			"&nm_rek=" + document.skpdn.nm_rekening.value +
			"&dasar_pengenaan=" + document.skpdn.dp.value +
			"&pajak_terhutang=" + document.skpdn.hutang.value +
			"&tempo=" + tgl_jth_tempo +
			"&kompensasi=" + document.skpdn.kompensasi.value +
			"&setoran=" + document.skpdn.setoran.value +
			"&lain=" + document.skpdn.lain.value +
			"&pokok=" + document.skpdn.pokok.value +
			"&bunga=" + document.skpdn.bunga.value +
			"&kenaikan=" + document.skpdn.kenaikan.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpdn/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			document.skpdn.no_teguran.value = result;
			statusEnding();
			alert('Done')
		});
	}
	
	function pasif() {
		document.skpdn.skpd_1.disabled = true;
		document.skpdn.skpd_2.disabled = true;
		document.skpdn.nota_hitung.disabled = true;
		document.skpdn.npwpd.disabled = true;
		document.skpdn.nama.disabled = true;
		document.skpdn.alamat.disabled = true;
		document.skpdn.nm_pemilik.disabled = true;
		document.skpdn.alamat_pemilik.disabled = true;
		document.skpdn.awal.disabled = true;
		document.skpdn.akhir.disabled = true;
		document.skpdn.tahun.disabled = true;
		document.skpdn.tempo.disabled = true;
		document.skpdn.tgl.disabled = true;
		document.skpdn.no_sptpd.disabled = true;
		document.skpdn.no_kohir.disabled = true;
		document.skpdn.jml.disabled = true;
		document.skpdn.btnCari.disabled = true;
	}
	
	function aktif() {
		document.skpdn.no_teguran.disabled = false;
		document.skpdn.tgl.disabled = false;
		document.skpdn.no_nota.disabled = false;
		document.skpdn.npwpd.disabled = false;
		document.skpdn.no_rekening.disabled = false;
		document.skpdn.nm_rekening.disabled = false;
		document.skpdn.nama.disabled = false; 
		document.skpdn.alamat.disabled = false;
		document.skpdn.dp.disabled = false;
		document.skpdn.hutang.disabled = false;
		document.skpdn.tempo.disabled = false;
		document.skpdn.kompensasi.disabled = false;
		document.skpdn.setoran.disabled = false;
		document.skpdn.lain.disabled = false;
		document.skpdn.pokok.disabled = false;
		document.skpdn.bunga.disabled = false;
		document.skpdn.kenaikan.disabled = false;
		document.skpdn.btncari.disabled = false;
	}
	
	function bersih() {
		document.skpdn.id.value = "";
		document.skpdn.no_teguran.value = "";
		document.skpdn.tgl.value = "";
		document.skpdn.no_nota.value = "";
		document.skpdn.npwpd.value = "";
		document.skpdn.no_rekening.value = "";
		document.skpdn.nm_rekening.value = "";
		document.skpdn.nama.value = "";
		document.skpdn.alamat.value = "";
		document.skpdn.dp.value = "";
		document.skpdn.hutang.value = "";
		document.skpdn.tempo.value = "";
		document.skpdn.kompensasi.value = "";
		document.skpdn.setoran.value = "";
		document.skpdn.lain.value = "";
		document.skpdn.pokok.value = "";
		document.skpdn.bunga.value = "";
		document.skpdn.kenaikan.value = "";
	}
	
	function newEntry() {
		aktif();
		bersih();
		document.skpdn.no_nota.focus();
	}
</script>
<div style="height:100%; overflow:auto;">

<h2 style="margin:30px 5px 25px 30px;">SKPDN</h2>
  <div id="a_tabbar" style="width:1000px; height:460px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="skpdn" id="skpdn" action="#" method="post" onsubmit="popupform(this, 'skpdn')">
    <br /><input type="hidden" id="id" name="id" />
     	<table width="888" cellspacing="0">
        <tr>
        	<td width="259" style="padding-left:15px;">No. SKPDN</td>
          	<td width="250"><input name="no_teguran" type="text" id="no_teguran" size="35" disabled="disabled" style="background-color:#FFFFCC" readonly/></td>
          	<td width="147" style="padding-left:15px;">Tanggal</td>
          	<td width="222"><input name="tgl" type="text" disabled="disabled" id="tgl" style="background-color:#FFFFFF" size="25" /></td>
       	  </tr>
        <tr>
          <td style="padding-left:15px;">No. Nota</td>
          <td colspan="3"><input name="no_nota" type="text" disabled="disabled" id="no_nota" style="text-transform:uppercase; background-color: #FFCC99;" size="25"/>
          <input type="button" style="padding-left:10px; padding-right:10px" onclick="showWinBrg()" value="Cari" id="btncari" disabled="disabled" /></td>
        </tr>
			<tr>
			  <td style="padding-left:15px;">NPWPD</td>
			  <td><input type="text" name="npwpd" id="npwpd" size="35" disabled="disabled" style="background-color:#FFFFCC"/></td>
          	<td style="padding-left:15px;">Nomor Rekening</td>
          	<td><input name="no_rekening" type="text" disabled="disabled" id="no_rekening" style="background-color:#FFFFCC" size="35" /></td>
       	  </tr>
        	<tr>
        	  <td style="padding-left:15px;">Nama</td>
        	  <td><input name="nama" type="text" disabled="disabled" id="nama" style="background-color:#FFFFCC" size="35" /></td>
        	  <td><span style="padding-left:15px;">Nama Rekening</span></td>
			<td><input name="nm_rekening" type="text" disabled="disabled" id="nm_rekening" style="background-color:#FFFFCC" size="35" /></td>
        </tr>
        	<tr>
        	  <td style="padding-left:15px;">Alamat</td>
        	  <td><input name="alamat" type="text" disabled="disabled" id="alamat" style="background-color:#FFFFCC" size="35" /></td>
              <td style="padding-left:15px;">Pajak Terhutang</td>
        	  <td><input name="hutang" type="text" disabled="disabled" id="hutang" style="background-color:#FFFFCC" size="35" /></td>
       	    </tr>
        	<tr>
        	  <td style="padding-left:15px;">Dasar Pengenaan</td>
        	  <td><input name="dp" type="text" disabled="disabled" id="dp" style="background-color:#FFFFCC" size="35" /></td>
        	  <td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
			  <td><input name="tempo" type="text" disabled="disabled" id="tempo" style="background-color:#FFFFCC" size="35"/></td>
       		</tr>
     <tr>
     	<td colspan="4" style="padding-left:15px;" height="50" valign="bottom"><strong>Kredit Pajak</strong></td>
	 </tr>
	  		<tr>
				<td style="padding-left:15px;">Kompensasi kelebihan tahun sebelumnya</td>
			  <td><input name="kompensasi" type="text" disabled="disabled" id="kompensasi"style="background-color:#FFFFCC" size="35"></td>
				<td style="padding-left:15px;">Setoran</td>
				<td><input name="setoran" type="text" disabled="disabled" id="setoran" style="background-color:#FFFFCC" size="35"></td>
			</tr>
			<tr>
				<td style="padding-left:15px;">Lain-lain</td>
				<td><input name="lain" type="text" disabled="disabled" id="lain" style="background-color:#FFFFFF" size="35"></td>
				<td width="147" style="padding-left:15px;">Pokok</td>
			  <td width="222" colspan="3"><input name="pokok" type="text" disabled="disabled" id="pokok" style="background-color:#FFFFCC" size="35"></td>
			</tr>
            <tr>
     	<td colspan="4" style="padding-left:15px;" height="50" valign="bottom"><strong>Sanksi Administrasi</strong></td>
	 </tr>
	  	<tr>
			<td style="padding-left:15px;">Bunga</td>
		  <td ><input name="bunga" type="text" disabled="disabled" id="bunga" style="background-color:#FFFFCC" size="35" ></td>
			<td style="padding-left:15px;">Kenaikan</td>
			<td><input name="kenaikan" type="text" disabled="disabled" id="kenaikan" style="background-color:#FFFFCC" size="35" ></td>
		</tr>
        <tr>
        	<td colspan="4">&nbsp;</td>
        </tr>
		<tr>
          		<td style="padding-left:15px;" colspan="4">
					<input type="button" name="button" id="button" value="Baru" onclick="newEntry()" style="width:90px;"/>
					<input type="button" value="Simpan" onclick="simpan()" name="btnTambah" style="width:90px;" />
					<input type="button" value="Hapus" onclick="hapus()" name="btnDel" id="btnDel" disabled="disabled" style="width:90px;"/>
					<input type="button" value="Cetak" onclick="cetak1()" name="cetak" id="cetak" disabled="disabled" style="width:90px;"/>          
			  	</td>
       	</tr>
	  </table>
      <br />
    </form>
  	</div>
	<div id="C2" style="background-color: #B3D9F0">
			<div style="padding:0 35px 0 15px;">
				<div id="tmpGrid" width="100%" height="440px" style="background-color:white;"></div>
				<div id="pagingArea" width="350px" style="background-color:white;"></div>
			</div>    
	</div>
  	
    <div id="objSKPD" style="display:none;">
	<form name="frmSrc5" id="frmSrc5" method="post" action="javascript:void(0);">
    <br />
		<table width="790" border="0">
		<tr>
			<td style="padding-left:15px;">Cari data berdasarkan 
			<select name="parameter" id="parameter" >
				<option value="npwpd">NPWPD Perusahaan</option>
				<option value="no_nota">Nota Hitung</option>
			</select></td>
			<td><input type="text" name="kataKunci" id="kataKunci" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
			<td><input type="button" onclick="cariSKPD()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
			<input type="button" onclick="closeSKPD()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
		</tr>
		</table>
	</form>
	<div style="padding:0 75px 0 15px;">
		<div id="tmpGridWP" width="750px" height="270px" style="margin-bottom:10px;"></div>
	</div>
	</div>
    
</div>
<script language="javascript">
  function cetak1() {
		window.open('<?php echo site_url(); ?>/skpdn/cetak?no_skpdn='+document.skpdn.no_teguran.value, '', 'height=700,width=1000,scrollbars=yes');
	}
	
  function cariSKPD() {
		if(document.frmSrc5.kataKunci.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc5.kataKunci.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/skpdn/cariData/"+kata_kunci+"/"+document.frmSrc5.parameter.value,function() {  statusEnding(); });
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
		document.skpdn.no_nota.value = gridWP.cells(id,0).getValue();
		document.skpdn.npwpd.value = gridWP.cells(id,2).getValue();
		document.skpdn.nama.value = gridWP.cells(id,3).getValue();
		document.skpdn.alamat.value = gridWP.cells(id,4).getValue();
		//document.frmSKPDKBT.dasar_pajak.value = gridWP.cells(id,12).getValue();
		closeSKPD();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	gridWP.clearAll();
  
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	function enabledButton(){
		document.skpdn.btnDel.disabled = false;
		document.skpdn.cetak.disabled = false;
	}
	
	wSKPD = dhxWins.createWindow("wSKPD",0,0,800,430);
	wSKPD.setText("Pencarian Data Nota Hitung");
	wSKPD.button("park").hide();
	wSKPD.button("close").hide();
	wSKPD.button("minmax1").hide();
	wSKPD.hide();

	function showWinBrg() {
		wSKPD.show();
    	wSKPD.setModal(true);
		wSKPD.center();
		wSKPD.attachObject('objSKPD');
		//document.skpdn.nmbarang.focus();
	}

	function closeSKPD() {
		wSKPD.hide();
		wSKPD.setModal(false);
	}
	
	// Wajib Pajak
	grid = new dhtmlXGridObject('tmpGrid');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, nota_hitung, nomor, tgl, npwpd, nama_perusahaan, alamat_perusahaan, kd_rek, nm_rek, dasar_pengenaan,pajak_terhutang,tgl_tempo, kompensasi,setoran,lain2,pokok,bunga,kenaikan");
	grid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("left,left,left,left,left,left,left,right,right,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
	grid.setNumberFormat("0,000",9,",",".");
	grid.setNumberFormat("0,000",10,",",".");
	grid.setNumberFormat("0,000",12,",",".");
	grid.setNumberFormat("0,000",13,",",".");
	grid.setNumberFormat("0,000",17,",",".");
	grid.enableMultiselect(true);
	grid.enableSmartRendering(true);
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", function(id) {
		tabbar.setTabActive("a1");
		document.skpdn.id.value = grid.cells(id,0).getValue();
		document.skpdn.no_nota.value = grid.cells(id,1).getValue();
		document.skpdn.no_teguran.value = grid.cells(id,2).getValue();
		document.skpdn.tgl.value = grid.cells(id,3).getValue();
		document.skpdn.npwpd.value = grid.cells(id,4).getValue();
		document.skpdn.no_rekening.value = grid.cells(id,7).getValue();
		document.skpdn.nm_rekening.value = grid.cells(id,8).getValue();
		document.skpdn.nama.value = grid.cells(id,5).getValue();
		document.skpdn.alamat.value = grid.cells(id,6).getValue();
		document.skpdn.dp.value = grid.cells(id,9).getValue();
		document.skpdn.hutang.value = grid.cells(id,10).getValue();
		document.skpdn.tempo.value = grid.cells(id,11).getValue();
		document.skpdn.kompensasi.value = grid.cells(id,12).getValue();
		document.skpdn.setoran.value = grid.cells(id,13).getValue();
		document.skpdn.lain.value = grid.cells(id,14).getValue();
		document.skpdn.pokok.value = grid.cells(id,15).getValue();
		document.skpdn.bunga.value = grid.cells(id,16).getValue();
		document.skpdn.kenaikan.value = grid.cells(id,17).getValue();
		document.skpdn.cetak.disabled = false;
	});
	grid.loadXML(base_url+"index.php/skpdn/mainData/");
	grid.init();
	grid.setSkin("dhx_skyblue");
	
	statusEnding();
</script>
