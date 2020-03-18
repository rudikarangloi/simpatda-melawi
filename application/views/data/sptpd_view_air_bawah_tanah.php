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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>
<script type="text/javascript" language="javascript">
	var iBaseUrl	= '<?php echo base_url();?>';
	var iSaveClass	= iBaseUrl + 'index.php' + '/sptpd_air_bawah_tanah/simpan_sptpd';
	var iDelClass	= iBaseUrl + 'index.php' + '/sptpd_air_bawah_tanah/delete_sptpd';
	var iViewClass	= iBaseUrl + 'index.php' + '/sptpd_air_bawah_tanah/data_sptpd';
</script>
<style>
		body {
			background:#FFF;
		}
	</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxcalendar.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">

<div style="height:100%; overflow:auto;">

<h2 style="margin:30px 5px 25px 30px;">Dasar Perhitungan Air Tanah</h2>
	
<div id="a_tabbar" style="width:1000px; height:730px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
			<form name="frmData" id="frmData" method="post">
			    <input type="hidden" name="id" id="id" size="35" />
                <input type="hidden" name="sptpd" id="sptpd" size="35" />
				<table>
					<tr>
						<td width="120" style="padding-left:15px;">No SPTPD</td>
						<td><input type="text" name="txtnosptpd_a" id="txtnosptpd_a" size="20" maxlength=10  style="background-color:#FFFFCC;" disabled/>&nbsp;<input type="text" name="txtnosptpd_b" id="txtnosptpd_b" size="10" style="background-color:#FFFFCC;" disabled /></td>
					</tr>
					<tr>
						<td width="120" style="padding-left:15px;">Masa Pajak</td>
						<td><?php echo $ctl_masapajak1; ?> s.d <?php echo $ctl_masapajak2; ?></td>
					</tr>
					<tr>
						<td width="120" style="padding-left:15px;">Tahun Pajak</td>
						<td><?php echo $ctl_tahunpajak; ?></td>
					</tr>
					<tr>	
						<td style="padding-left:15px;">NPWPD</td>
						<td><input type="text" name="txtnpwpd" id="txtnpwpd" style="text-transform:uppercase; background-color: #FFCC99;"/>&nbsp;<input type="button" value="Cari" onclick="cariNpwpd()" name="btncarinpwpd" /></td>
					</tr>
					<tr>
						<td style="padding-left:15px;">Nama Perusahaan</td>
						<td><input type="text" name="txtnpwpd_nama" id="txtnpwpd_nama" size=50 style="background-color:#FFFFCC;" disabled/></td>
					</tr>
					<tr>
						<td style="padding-left:15px;">Alamat Perusahaan</td>
						<td><input type="text" name="txtnpwpd_alamat" id="txtnpwpd_alamat" size=50 style="background-color:#FFFFCC;" disabled/></td>
					</tr>
					<tr>
						<td colspan=2><b>Cara penghitungan dan penetapan yang dikehendaki</b></td>
					</tr>
					<tr>
						<td colspan=2><?php echo $ctl_carahitung; ?></td>
					</tr>
					<tr>
						<td width="120" style="padding-left:15px;">Diterima Tanggal</td>
						<td><input type="text" name="txttglditerima" id="txttglditerima" size="12" /></td>
					</tr>
					<tr>
						<td width="120" style="padding-left:15px;">&nbsp;&nbsp;&nbsp;Petugas Input</td>
						<td><select name="petugas" id="petugas" disabled>
              			<option value="<?php echo $ctl_petugasinput; ?>"><?php echo $ctl_petugasinput; ?></option>
         	  			</select></td>
					</tr>
					<tr>
						<td colspan=2><b><i><u>Data Obyek Pajak</u></i></b></td>
					</tr>
                    <tr>
                    	<td style="padding-left:15px;" valign="top">Rekening Air Tanah</td>
						<td><input type="text" name="gol" id="gol" size="12" value="<?php echo $kd_rek; ?>" disabled="disabled" /></td>
                    </tr>
					<tr>
						<td style="padding-left:15px;" valign="top">Jenis Sumber Air</td>
						<td><?php echo $ctl_golonganair; ?>&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">Lokasi Sumber Air</td>
						<td><?php echo $ctl_lokasisumberair; ?>&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">Tujuan Pemanfaatan</td>
						<td><?php echo $ctl_tujuanpemanfaatan; ?>&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">Kualitas Air</td>
						<td><?php echo $ctl_kualitasair; ?>&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">Tingkat Kerusakan Lingkungan</td>
						<td><?php echo $ctl_tingkatkerusakanlingkungan; ?>&nbsp;</td>
					</tr>
					<tr>
						<td nowrap style="padding-left:15px;" valign="top">Volume</td>
						<td nowrap><input type="text" name="txtvolume" id="txtvolume" size="8" style="text-align:right"/> m<sup>3</sup>&nbsp;<input type="button" onclick="hitung_tarif();" value="Hitung" /></td>
					</tr>
					<tr>
						<td nowrap style="padding-left:15px;" valign="top">Harga Dasar</td>
						<td nowrap>Rp. <input type="text" name="txthargadasar" id="txthargadasar" size="8" value="0" disabled="disabled" readonly style="text-align:right"/> m<sup>3</sup> </td>
					</tr>
					<tr>
						<td colspan=2><b><i><u>Data Masa Pajak Air Bawah Tanah& Dasar Pengenaan</u></i></b></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;a. Masa Pajak</td>
						<td><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12" disabled/>&nbsp;
			 <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12" disabled/>&nbsp;
		</td>
					</tr>
					<tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;b. Dasar Pengenaan ( Omset )</td>
						<td nowrap><input type="text" name="txtpajakditerima" id="txtpajakditerima" size="15" disabled="disabled" style="text-align:right"/> </td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;c. Tarif Pajak</td>
						<td nowrap><input type="text" name="tarif" id="tarif" size="10" value="<?php echo $tarif_pajak; ?>" disabled="disabled" style="text-align:right"/>&nbsp;%</td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;d. Pajak Terhutang</td>
						<td nowrap><input type="text" name="txtpajakterutang" id="txtpajakterutang" size="15" disabled="disabled" style="text-align:right"/> </td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="addNew()" name="btnaddnew" id="btnaddnew" style="width:90px;"/>&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpanData()" name="btnsimpan" id="btnsimpan" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Edit" onclick="editData()" name="btnedit" id="btnedit" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Hapus" onclick="deleteData()" name="btndel" id="btndel" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Cetak" onclick="cetak()" name="btncetak" style="width:90px;" id="btncetak" disabled/>&nbsp;&nbsp;</td>
					</tr>
					
				</table>
				<select name="ctl_req" id="ctl_req" style="visibility:hidden">
					<option value="txtnosptpd_a">No SPTPD</option>
					<option value="txtnpwpd">NPWPD</option>
					<option value="txttglditerima">Tanggal Diterima</option>
					<option value="txtgolonganair">Golongan Air</option>
					<option value="txtpajakditerima">Pajak Diterima</option>
				</select>
			</form>
<br />
</div>

<div id="C2">
<div style="padding:0 1px 0 0px;">
	<div id="gridContent" height="540px" width="995px" style="margin-bottom:10px;"></div>
	<div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>  

<div id="objAIR" style="display:none;">
<br />
<form name="frmAIR" id="frmAIR" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridsAIR" width="750px" height="250px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
<script language="javascript">
	
	$(function() {         
    	$('#txtvolume').priceFormat({
        	prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
			centsLimit: 0
         });
		 //$("#txtvolume").keyup(function(){
			// hitung($('#txtvolume').unmask());
		//});
	});
	
	function hitung_tarif(){
		if(document.frmData.txtlokasisumberair.value==""){
			alert("Lokasi Sumber Air Tidak Boleh Kosong");
			document.frmData.txtlokasisumberair.focus();
			return;
		}
		
		if(document.frmData.txttujuanpemanfaatan.value==""){
			alert("Tujuan Pemanfaatan Air Tidak Boleh Kosong");
			document.frmData.txttujuanpemanfaatan.focus();
			return;
		}
		
		if(document.frmData.txtkualitasair.value==""){
			alert("Kualitas Air Tidak Boleh Kosong");
			document.frmData.txtkualitasair.focus();
			return;
		}
		
		if(document.frmData.txtvolume.value==""){
			alert("Volume Air Tidak Boleh Kosong");
			document.frmData.txtvolume.focus();
			return;
		}
		
		/*txtvolume = ($('#txtvolume').unmask());		
		if(txtvolume > 3000){
			alert("Maaf Volume Air Tidak Boleh Lebih dari 3.000");
			document.frmData.txtvolume.focus();
			return;
		}*/
		
		var volume = document.frmData.txtvolume.value;
		//alert(volume);
		var postAir = 
			"lokasi=" + document.frmData.txtlokasisumberair.value +
			"&tujuan=" + document.frmData.txttujuanpemanfaatan.value +
			"&volume=" + document.frmData.txtvolume.value + 
			"&tarif=" + document.frmData.tarif.value;
			statusLoading();
		//alert(postAir);
		dhtmlxAjax.post('<?php echo site_url(); ?>/sptpd_air_bawah_tanah/hitung_tarif', postAir, respeAir);
	}
	
	function respeAir(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result){
					//alert(result);
					b = result.split('-');
					document.frmData.txthargadasar.value = format_number(b[0]);
					document.frmData.txtpajakditerima.value = format_number(b[1]);
					document.frmData.txtpajakterutang.value = format_number(b[2]);
					statusEnding();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function cetak() {
		window.open('<?php echo site_url(); ?>/sptpd_air_bawah_tanah/cetak?sptpd='+document.frmData.sptpd.value, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	disabledData1();
	
	cal1 = new dhtmlxCalendarObject('txttglditerima');
	cal1.setDateFormat('%d/%m/%Y');

	wAIR = dhxWins.createWindow("wAIR",0,0,800,400);
	wAIR.setText("Pencarian Data Perusahaan");
	wAIR.button("park").hide();
	wAIR.button("close").hide();
	wAIR.button("minmax1").hide();
	wAIR.hide();

	function cariNpwpd() {
		wAIR.show();
    	//wAIR.setModal(true);
		wAIR.center();
		wAIR.attachObject('objAIR');
	}
	
	function batal() {
		wAIR.hide();
		wAIR.setModal(false);
		document.frmAIR.fil.value = "0";
		document.frmAIR.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmAIR.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmAIR.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmAIR.values.focus();
			return;
			}
		}
		nilai = document.frmAIR.values.value;
		gridAIR.clearAll();
		gridAIR.loadXML("<?php echo site_url(); ?>/sptpd_air_bawah_tanah/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridAIR= new dhtmlXGridObject('gridsAIR');
	gridAIR.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridAIR.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridAIR.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridAIR.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridAIR.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridAIR.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridAIR.enablePaging(true,1000,1000,"pagingArea",true);
	gridAIR.setPagingSkin("bricks");
	gridAIR.setSkin("dhx_skyblue");
	gridAIR.setColumnHidden(0,true);
	gridAIR.attachEvent("onRowDblClicked", selectedOpenData2);
	gridAIR.init();
	
	function selectedOpenData2(id) {
		document.frmData.txtnpwpd.value 	= gridAIR.cells(id,1).getValue();
		document.frmData.txtnpwpd_nama.value	= gridAIR.cells(id,2).getValue();
		document.frmData.txtnpwpd_alamat.value  = gridAIR.cells(id,3).getValue();
		batal();
		enableData1();
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID,NPWPD, No SPTPD,Nama Perusahaan, Alamat, Cara Hitung, Rekening Air, Golongan Air, Lokasi Sumber Air, Tujuan Pemanfaatan Air, Kualitas Air,Tingkat kerusakan Lingkungan, Masa Pajak1, Masa Pajak2, Diterima Tgl, Harga Dasar, Volume, Jumlah Bayar, Petugas, Pajak Terutang");
	grid.setInitWidths("50,150,150,170,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,right,right,left,left,right,left,right,left,right,left,right");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ron");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.setSkin("dhx_skyblue");
	grid.setNumberFormat("0,000",17,",","."); 
	grid.setNumberFormat("0,000",19,",","."); 
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/sptpd_air_bawah_tanah/data_sptpd");
	grid.init();
	
	
	function selectedOpenData(id) {
		kosongfrmData1();
		disabledData1();

		document.frmData.id.value = grid.cells(id,0).getValue();
		document.frmData.txtnpwpd.value = grid.cells(id,1).getValue();
		document.frmData.sptpd.value = grid.cells(id,2).getValue();
		var gabung = grid.cells(id,2).getValue().split('/');
		 document.frmData.txtnosptpd_a.value = gabung[0];
		 document.frmData.txtnosptpd_b.value = gabung[1]+'/'+gabung[2];
		document.frmData.txtnpwpd_nama.value = grid.cells(id,3).getValue();
		document.frmData.txtnpwpd_alamat.value = grid.cells(id,4).getValue();
		document.frmData.txtcarahitung.value = grid.cells(id,5).getValue();
		document.frmData.gol.value = grid.cells(id,6).getValue();
		document.frmData.txtgolonganair.value = grid.cells(id,7).getValue();
		document.frmData.txtlokasisumberair.value = grid.cells(id,8).getValue();
		document.frmData.txttujuanpemanfaatan.value = grid.cells(id,9).getValue();
		document.frmData.txtkualitasair.value = grid.cells(id,10).getValue();
		document.frmData.txttingkatkerusakanlingkungan.value = grid.cells(id,11).getValue();
		
		document.frmData.txttglmasapajak1.value = konversiTgl(grid.cells(id,12).getValue());
		document.frmData.txttglmasapajak2.value = konversiTgl(grid.cells(id,13).getValue());
		document.frmData.txttglditerima.value = konversiTgl(grid.cells(id,14).getValue());
		
		document.frmData.txtthnmasapajak.value = getTgl(grid.cells(id,12).getValue(), "THN");
		document.frmData.txtblnmasapajak1.value = getTgl(grid.cells(id,12).getValue(), "BLN");
		document.frmData.txtblnmasapajak2.value = getTgl(grid.cells(id,13).getValue(), "BLN");
		
		document.frmData.txtvolume.value = format_number(grid.cells(id,16).getValue());
		document.frmData.txthargadasar.value = format_number(grid.cells(id,15).getValue());
		document.frmData.txtpajakditerima.value = format_number(grid.cells(id,17).getValue());
		document.frmData.petugas.value = format_number(grid.cells(id,18).getValue());
		document.frmData.txtpajakterutang.value = format_number(grid.cells(id,19).getValue());
		tabbar.setTabActive("a1");
		statusLoading();
		statusEnding();

		document.frmData.btnaddnew.disabled=true;
		document.frmData.btnsimpan.disabled=true;
		document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;
		document.frmData.btncetak.disabled=false;
	}
	
	function addNew() {
		document.frmData.txttglmasapajak1.disabled=false;
		document.frmData.txttglmasapajak2.disabled=false;
		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		document.frmData.btnedit.disabled=true;
		document.frmData.btndel.disabled=true;
		document.frmData.btncetak.disabled=true;
		document.frmData.txtblnmasapajak1.disabled=false;
		document.frmData.txtblnmasapajak2.disabled=false;
		document.frmData.txtthnmasapajak.disabled=false;
		
		
		enableData1();
		kosongfrmData1();
	}
	
	function editData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				document.frmData.btnaddnew.disabled=false;
				document.frmData.btnsimpan.disabled=false;
				document.frmData.btnedit.disabled=false;
				document.frmData.btndel.disabled=false;
				document.frmData.btncetak.disabled=false;
				enableData1();
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}

	function enableData1(){
		document.frmData.txtnosptpd_a.readonly=true;
		document.frmData.txtnosptpd_b.readonly=true;
		document.frmData.txtnpwpd.disabled=false;
		document.frmData.btncarinpwpd.disabled=false;
		document.frmData.txtcarahitung.disabled=false;
		document.frmData.txttglditerima.disabled=false;
		document.frmData.petugas.disabled=false;
		document.frmData.txtgolonganair.disabled = false;
		document.frmData.txtlokasisumberair.disabled = false;
		document.frmData.txttujuanpemanfaatan.disabled = false;
		document.frmData.txtkualitasair.disabled = false;
		document.frmData.txtvolume.disabled = false;
		document.frmData.txttingkatkerusakanlingkungan.disabled = false;
		document.frmData.txtpajakditerima.disabled=true;
		document.frmData.tarif.disabled=true;
		document.frmData.txtpajakterutang.disabled=true;			
				
	}
	
	function disabledData1(){
		document.frmData.txtnosptpd_a.readonly=true;
		document.frmData.txtnosptpd_b.readonly=true;
		document.frmData.txtblnmasapajak1.disabled=true;
		document.frmData.txtblnmasapajak2.disabled=true;
		document.frmData.txtthnmasapajak.disabled=true;
		document.frmData.txtnpwpd.disabled=true;
		document.frmData.btncarinpwpd.disabled=true;
		document.frmData.txtnpwpd_nama.disabled=true;
		document.frmData.txtnpwpd_alamat.disabled=true;
		document.frmData.txtcarahitung.disabled=true;
		document.frmData.txttglditerima.disabled=true;
		document.frmData.petugas.disabled=true;
		document.frmData.txtgolonganair.disabled = true;
		
		document.frmData.txtlokasisumberair.disabled = true;
		document.frmData.txttujuanpemanfaatan.disabled = true;
		document.frmData.txtkualitasair.disabled = true;
		document.frmData.txtvolume.disabled = true;
		document.frmData.txttingkatkerusakanlingkungan.disabled = true;
		document.frmData.txttglmasapajak1.disabled=true;
		document.frmData.txttglmasapajak2.disabled=true;
		document.frmData.txtpajakditerima.disabled=true;
		
	}

	function kosongfrmData1(){
		document.frmData.id.value='';
		document.frmData.txtnosptpd_a.value='';
		document.frmData.txtnosptpd_b.value='';
		document.frmData.txtnpwpd.value='';
		document.frmData.txtnpwpd_nama.value='';
		document.frmData.txtnpwpd_alamat.value='';
		document.frmData.txttglditerima.value='';
		//document.frmData.txthargadasar.value='';
		document.frmData.txtvolume.value=0;
		document.frmData.sptpd.value='';

		document.frmData.txtgolonganair.value = '';
		document.frmData.txtlokasisumberair.value = '';
		document.frmData.txttujuanpemanfaatan.value = '';
		document.frmData.txtkualitasair.value = '';
		document.frmData.txttingkatkerusakanlingkungan.value = '';

		document.frmData.txttglmasapajak1.value="";
		document.frmData.txttglmasapajak2.value="";
		document.frmData.txtpajakditerima.value=0;
		document.frmData.txtblnmasapajak1.value='';
		document.frmData.txtblnmasapajak2.value='';
		document.frmData.txtthnmasapajak.value='';
		document.frmData.txtpajakterutang.value=0;
	}

	function simpanData() {
		if(document.frmData.txtnpwpd.value==""){
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.txtnpwpd.focus();
			return;
		}
		
		if(document.frmData.txttglditerima.value==""){
			alert("Tanggal Penerimaan Tidak Boleh Kosong");
			document.frmData.txttglditerima.focus();
			return;
		}
		
		if(document.frmData.txtvolume.value==""){
			alert("Volume Tidak Boleh Kosong");
			document.frmData.txtvolume.focus();
			return;
		}
		
		if(document.frmData.txttglmasapajak1.value==""){
			alert("Masa Pajak Tidak Boleh Kosong");
			document.frmData.txttglmasapajak1.focus();
			return;
		}
		
		if(document.frmData.txttglmasapajak2.value==""){
			alert("Masa Pajak Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		
		if(document.frmData.txtgolonganair.value==""){
			alert("Jenis Sumber Air Tidak Boleh Kosong");
			document.frmData.txtgolonganair.focus();
			return;
		}
		
		if(document.frmData.txtlokasisumberair.value==""){
			alert("Lokasi Sumber Air Tidak Boleh Kosong");
			document.frmData.txtlokasisumberair.focus();
			return;
		}
		
		if(document.frmData.txttujuanpemanfaatan.value==""){
			alert("Tujuan Pemanfaatan Air Tidak Boleh Kosong");
			document.frmData.txttujuanpemanfaatan.focus();
			return;
		}
		
		if(document.frmData.txtkualitasair.value==""){
			alert("Kualitas Air Tidak Boleh Kosong");
			document.frmData.txtkualitasair.focus();
			return;
		}
		
		if(document.frmData.txttingkatkerusakanlingkungan.value==""){
			alert("Tingkat Kerusakan Lingkungan Tidak Boleh Kosong");
			document.frmData.txttingkatkerusakanlingkungan.focus();
			return;
		}
		
		jml_bayar2 = ($('#txtpajakditerima').unmask());		
		/*if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmData.txtpajakditerima.focus();
			return;
		}
*/		
		var ctlreq = document.frmData.ctl_req;
		
		var postStr = "id=" + document.frmData.id.value;
		postStr = postStr + "&sptpd"  + "=" + document.frmData.sptpd.value;
		postStr = postStr + "&txtthnmasapajak"  + "=" + document.getElementById("txtthnmasapajak").value;
		postStr = postStr + "&txtblnmasapajak1"  + "=" + document.getElementById("txtblnmasapajak1").value;
		postStr = postStr + "&txtblnmasapajak2"  + "=" + document.getElementById("txtblnmasapajak2").value;
		postStr = postStr + "&txttglmasapajak1"  + "=" + document.getElementById("txttglmasapajak1").value;
		postStr = postStr + "&txttglmasapajak2"  + "=" + document.getElementById("txttglmasapajak2").value;
		postStr = postStr + "&txtnpwpd"  + "=" + document.getElementById("txtnpwpd").value;
		postStr = postStr + "&txtnpwpd_nama"  + "=" + document.getElementById("txtnpwpd_nama").value;
		postStr = postStr + "&txtnpwpd_alamat"  + "=" + document.getElementById("txtnpwpd_alamat").value;
		postStr = postStr + "&txtcarahitung"  + "=" + document.getElementById("txtcarahitung").value;
		postStr = postStr + "&txttglditerima"  + "=" + document.getElementById("txttglditerima").value;
		postStr = postStr + "&txtpetugasinput"  + "=" + document.getElementById("petugas").value;
		postStr = postStr + "&gol"  + "=" + document.frmData.gol.value;
		postStr = postStr + "&txtgolonganair"  + "=" + document.frmData.txtgolonganair.value;
		postStr = postStr + "&txtlokasisumberair"  + "=" + document.frmData.txtlokasisumberair.value;
		postStr = postStr + "&txttujuanpemanfaatan"  + "=" + document.frmData.txttujuanpemanfaatan.value;
		postStr = postStr + "&txtkualitasair"  + "=" + document.frmData.txtkualitasair.value;
		postStr = postStr + "&txttingkatkerusakanlingkungan"  + "=" + document.frmData.txttingkatkerusakanlingkungan.value;
		postStr = postStr + "&txthargadasar"  + "=" + document.getElementById("txthargadasar").value;
		postStr = postStr + "&txtvolume"  + "=" + document.getElementById("txtvolume").value;
		postStr = postStr + "&txtpajakditerima"  + "=" + document.getElementById("txtpajakditerima").value;
		postStr = postStr + "&txtpajakterutang"  + "=" + document.getElementById("txtpajakterutang").value;
		statusLoading();
		dhtmlxAjax.post(iSaveClass, postStr, responePOST);
		disabledData1();

		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;
		document.frmData.btncetak.disabled=false;
		//kosongfrmData1();
	}
	
	statusEnding();

	function statusLoading() {  
	
	   ModalPopups.Indicator("idIndicator2",  
		"Please wait",  
		"<div style=''>" +   
		"<div style='float:left;'><img src='"+iBaseUrl+"/assets/modal/spinner.gif'></div>" +   
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
			  
		//setTimeout('ModalPopups.Close(\"idIndicator2\");', 3000);  
	}

	function statusEnding() {
		ModalPopups.Close("idIndicator2");
	}
	 
	function refreshData() {
		grid.clearAll();
		grid.loadXML(iViewClass);
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr = 
						"sptpd_1=" + document.frmData.txtnosptpd_a.value +
						"&sptpd_2=" + document.frmData.txtnosptpd_b.value;
					alert(postStr);
					statusLoading(iBaseUrl);
					dhtmlxAjax.post(iDelClass, postStr, responePOST2);	
				}
				document.frmData.btnaddnew.disabled=false;
				document.frmData.btnsimpan.disabled=true;
				document.frmData.btnedit.disabled=true;
				document.frmData.btndel.disabled=true;
				document.frmData.btncetak.disabled=true;
				disabledData1();
				kosongfrmData1();
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}

	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {			
					pot = result.split('/');
					document.frmData.txtnosptpd_a.value = pot[0];
					document.frmData.txtnosptpd_b.value = pot[1]+'/'+pot[2];
					document.frmData.sptpd.value = result;
					refreshData();
					statusEnding();
					alert("Done");
					return true;	
				}
			} else {
				alert(loader.xmlDoc.responseText);
				//alert('There was a problem with the request.');
			}
		}
	}

	function responePOST2(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {			
					refreshData();
					statusEnding();
					alert(result);
					return true;	
				}
			} else {
				alert(loader.xmlDoc.status);
				//alert('There was a problem with the request.');
			}
		}
	}


	function AddLeadingZero(currentField)
	{
		
		//Check if the value length hasn't reach its max length yet
		if (currentField.value.length != currentField.maxLength)
		{
			//Add leading zero(s) in front of the value
			var numToAdd = currentField.maxLength - currentField.value.length;
			var value ="";
			for (var i = 0; i < numToAdd;i++)
			{
			value += "0";
			}
			currentField.value = value + currentField.value;
		}
	}


	function konversiTgl(iTgl){
		var thn = iTgl.substr(0,4);
		var bln = iTgl.substr(5,2);
		var tgl = iTgl.substr(8,2);
		return tgl + "/" + bln + "/" + thn;
	}

	function getTgl(iTgl, retType){
		var thn = iTgl.substr(0,4);
		var bln = iTgl.substr(5,2);
		var tgl = iTgl.substr(8,2);
		
		if(retType=="THN"){
			return thn;
		}
		if(retType=="BLN"){
			return bln;
		}
		if(retType=="TGL"){
			return tgl;
		}
	}

	function getLastDate(iThn, iBln1, iBln2, iTgl1, iTgl2){		
		
		var iThnVal		= document.getElementById(iThn).value;
		var iBln1Val	= document.getElementById(iBln1).value;		
		var iBln2Val	= document.getElementById(iBln2).value;
		
		if(iBln2Val<iBln1Val){
			iBln2Val = iBln1Val;
			document.getElementById(iBln2).value=iBln2Val;
		}
		
		var lastDate = new Date(iThnVal, iBln2Val, 0);
		var lastDateDay = lastDate.getDate();
		
		document.getElementById(iTgl1).value = '01/' + iBln1Val + '/' + iThnVal;
		document.getElementById(iTgl2).value = lastDateDay + '/' + iBln2Val + '/' + iThnVal;	
	}
</script>
</div>