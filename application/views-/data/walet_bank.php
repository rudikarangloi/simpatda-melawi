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
	var iSaveClass	= iBaseUrl + 'index.php' + '/sptpd_burung_walet/simpan_sptpd';
	var iDelClass	= iBaseUrl + 'index.php' + '/sptpd_burung_walet/delete_sptpd';
	var iViewClass	= iBaseUrl + 'index.php' + '/sptpd_burung_walet/data_bank';
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

<h2 style="margin:30px 5px 25px 30px;">SPTPD Burung Walet ( Bank )</h2>
	
<div id="a_tabbar" style="width:1000px; height:525px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
			<form name="frmData" id="frmData" method="post">
			    <input type="hidden" name="id" id="id" size="35" />
                <input type="hidden" name="sptpd" id="sptpd" size="35" />
				<table>
					<tr>
						<td width="120" style="padding-left:15px;">No SPTPD</td>
						<td><input type="text" name="txtnosptpd_a" id="txtnosptpd_a" size="20" maxlength=10  style="background-color:#FFFFCC;" disabled/>&nbsp;<input type="text" name="txtnosptpd_b" id="txtnosptpd_b" size="10" style="background-color:#FFFFCC;" disabled/></td>
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
						<td><input type="text" name="txtnpwpd_nama" style="background-color:#FFFFCC;" id="txtnpwpd_nama" size=50/></td>
					</tr>
					<tr>
						<td style="padding-left:15px;">Alamat Perusahaan</td>
						<td><input type="text" name="txtnpwpd_alamat" style="background-color:#FFFFCC;" id="txtnpwpd_alamat" size=50/></td>
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
						<td colspan=2><b><i>&nbsp;Data Obyek Pajak</i></b></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">1. Golongan Sarang Burung Walet&nbsp;</td>
						<td><input type="text" name="txtgolhotel" id="txtgolhotel" value="<?php echo $kd_rek; ?>" req="true" disabled/>&nbsp;</td>
					</tr>
					<tr>
						<td colspan=2><b><i><u>Data Masa Pajak Burung Walet& Dasar Pengenaan</u></i></b></td>
					</tr>
					<tr>

						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;a. Masa Pajak</td>
						<td><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12" readonly disabled/>&nbsp; <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12" readonly disabled/>&nbsp;</td>
					</tr>
					<tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;b. Dasar Pengenaan</td>
						<td nowrap><input type="text" name="txtpajakditerima" id="txtpajakditerima" size="15" style="text-align:right" /> </td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;c. Tarif Pajak</td>
						<td nowrap><input type="text" name="tarif" id="tarif" size="10" value="<?php echo $tarif; ?>" disabled="disabled" style="text-align:right"/>&nbsp;%</td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;d. Pajak Terhutang</td>
						<td nowrap><input type="text" name="txtpajakterutang" id="txtpajakterutang" size="15" disabled="disabled" style="text-align:right"/> </td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="addNew()" name="btnaddnew" id="btnaddnew" style="width:90px;"/>&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpanData()" name="btnsimpan" id="btnsimpan" style="width:90px;" disabled/>&nbsp;&nbsp;<!--<input type="button" value="Edit" onclick="editData()" name="btnedit" id="btnedit" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Hapus" onclick="deleteData()" name="btndel" style="width:90px;" id="btndel" disabled/>&nbsp;&nbsp;--><input type="button" value="Cetak" onclick="cetak()" name="btncetak" style="width:90px;" id="btncetak" disabled/>&nbsp;&nbsp;<input type="button" value="SPTPD Kosong" onclick="kosong()" name="null" id="null" /></td>
					</tr>
					
				</table>
			<select name="ctl_req" id="ctl_req" style="visibility:hidden">
				<option value="txtnosptpd_a">No SPTPD</option>
				<option value="txtnpwpd">NPWPD</option>
				<option value="txttglditerima">Tanggal Diterima</option>
				<option value="txtgolhotel">Golongan</option>
				<option value="txtpajakditerima">Pajak Diterima</option>
			</select>
			
			</form>
<br />
</div>

<!--<div id="C2">
<div style="padding:0 1px 0 0px;">
	<div id="gridContent" height="400px" width="995px" style="margin-bottom:10px;"></div>
	<div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>	
</div>-->  

<div id="objWLT" style="display:none;">
<br />
<form name="frmWLT" id="frmWLT" method="post" action="javascript:void(0);">
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
	<div id="gridsWLT" width="750px" height="250px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
<script language="javascript">
	function kosong(){
		window.open('<?php echo site_url(); ?>/walet_pdf', '', 'height=700,width=1000,scrollbars=yes');
	}
	
	$(function() {         
    	$('#txtpajakditerima').priceFormat({
        	prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
			centsLimit: 0
         });
		 $("#txtpajakditerima").keyup(function(){
			 hitung($('#txtpajakditerima').unmask());
		});
	});

	function hitung(jumlahDP){
		document.frmData.txtpajakterutang.value = format_number((jumlahDP*document.frmData.tarif.value)/100);
	}
	
	function cetak() {
		var gabung = document.frmData.txtnosptpd_a.value+'/'+document.frmData.txtnosptpd_b.value;
		window.open('<?php echo site_url(); ?>/sptpd_burung_walet/cetak?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	//tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	//tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	disabledData1();
	
	cal1 = new dhtmlxCalendarObject('txttglditerima');
	cal1.setDateFormat('%d/%m/%Y');
	
	wWLT = dhxWins.createWindow("wWLT",0,0,800,400);
	wWLT.setText("Pencarian Data Perusahaan");
	wWLT.button("park").hide();
	wWLT.button("close").hide();
	wWLT.button("minmax1").hide();
	wWLT.hide();

	function cariNpwpd() {
		wWLT.show();
    	//wWLT.setModal(true);
		wWLT.center();
		wWLT.attachObject('objWLT');
	}
	
	function batal() {
		wWLT.hide();
		wWLT.setModal(false);
		document.frmWLT.fil.value = "0";
		document.frmWLT.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmWLT.fil.value;
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmWLT.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmWLT.values.focus();
			return;
			}
		}
		nilai = document.frmWLT.values.value;
		gridWLT.clearAll();
		gridWLT.loadXML("<?php echo site_url(); ?>/sptpd_burung_walet/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridWLT= new dhtmlXGridObject('gridsWLT');
	gridWLT.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridWLT.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridWLT.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridWLT.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridWLT.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridWLT.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridWLT.enablePaging(true,1000,1000,"pagingArea",true);
	gridWLT.setPagingSkin("bricks");
	gridWLT.setSkin("dhx_skyblue");
	gridWLT.setColumnHidden(0,true);
	gridWLT.attachEvent("onRowDblClicked", selectedOpenData2);
	gridWLT.init();
	
	function selectedOpenData2(id) {
		document.frmData.txtnpwpd.value 	= gridWLT.cells(id,1).getValue();
		document.frmData.txtnpwpd_nama.value	= gridWLT.cells(id,2).getValue();
		document.frmData.txtnpwpd_alamat.value  = gridWLT.cells(id,3).getValue();
		batal();
		enableData1();
		document.frmData.txtblnmasapajak1.disabled=false;
		document.frmData.txtblnmasapajak2.disabled=false;
		document.frmData.txtthnmasapajak.disabled=false;
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID,NPWPD, No SPTPD,Nama Perusahaan, Alamat, Cara Hitung, Golongan, Masa Pajak1, Masa Pajak2, Diterima Tgl, Jumlah Bayar, Petugas, Omset, Tarif",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,150,150,170,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,right,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ron,ron");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,date,int,str,int,int");
	grid.setSkin("dhx_skyblue");

	grid.setNumberFormat("0,000",10,",","."); 
	grid.setNumberFormat("0,000",12,",","."); 
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/sptpd_burung_walet/data_bank");
	grid.init();
	

	function addNew() {
		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		/*document.frmData.btnedit.disabled=true;
		document.frmData.btndel.disabled=true;*/
		document.frmData.btncetak.disabled=true;
		document.frmData.txtnpwpd.disabled=false;
		document.frmData.btncarinpwpd.disabled=false;
		document.frmData.txtnpwpd.focus();
		kosongfrmData1();
	}
	
	function editData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				document.frmData.btnaddnew.disabled=false;
				document.frmData.btnsimpan.disabled=false;
				/*document.frmData.btnedit.disabled=false;
				document.frmData.btndel.disabled=false;*/
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
		//document.frmData.txtgolhotel.disabled=false;
		document.frmData.txttglmasapajak1.readonly=true;
		document.frmData.txttglmasapajak2.readonly=true;
		document.frmData.txtpajakditerima.disabled=false;
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
		document.frmData.txtgolhotel.disabled=true;
		document.frmData.txttglmasapajak1.readonly=true;
		document.frmData.txttglmasapajak2.readonly=true;
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
		//document.frmData.txtgolhotel.value='';
		//txttglmasapajak1
		document.frmData.txttglmasapajak1.value='';
		document.frmData.txttglmasapajak2.value='';
		document.frmData.txtpajakditerima.value=0;
		document.frmData.txtpajakterutang.value=0;
		document.frmData.txtblnmasapajak1.value='';
		document.frmData.txtblnmasapajak2.value='';
		document.frmData.txtthnmasapajak.value='';
	}
	
	function selectedOpenData(id) {
		disabledData1();
		document.frmData.id.value = grid.cells(id,0).getValue();
		document.frmData.txtnpwpd.value = grid.cells(id,1).getValue();
		var gabung = grid.cells(id,2).getValue().split('/');
		 document.frmData.txtnosptpd_a.value = gabung[0];
		  document.frmData.txtnosptpd_b.value = gabung[1]+'/'+gabung[2];
		document.frmData.sptpd.value = grid.cells(id,2).getValue();
		document.frmData.txtnpwpd_nama.value = grid.cells(id,3).getValue();
		document.frmData.txtnpwpd_alamat.value = grid.cells(id,4).getValue();
		document.frmData.txtcarahitung.value = grid.cells(id,5).getValue();
		document.frmData.txtgolhotel.value = grid.cells(id,6).getValue();
		
		document.frmData.txttglmasapajak1.value = konversiTgl(grid.cells(id,7).getValue());
		document.frmData.txttglmasapajak2.value = konversiTgl(grid.cells(id,8).getValue());
		document.frmData.txttglditerima.value = konversiTgl(grid.cells(id,9).getValue());
		
		document.frmData.txtthnmasapajak.value = getTgl(grid.cells(id,7).getValue(), "THN");
		document.frmData.txtblnmasapajak1.value = getTgl(grid.cells(id,7).getValue(), "BLN");
		document.frmData.txtblnmasapajak2.value = getTgl(grid.cells(id,8).getValue(), "BLN");
		
		document.frmData.txtpajakditerima.value = format_number(grid.cells(id,10).getValue());
		document.frmData.petugas.value = grid.cells(id,11).getValue();
		document.frmData.txtpajakterutang.value = format_number(grid.cells(id,12).getValue());
		document,frmData.tarif.value = grid.cells(id,13).getValue();
		tabbar.setTabActive("a1");
		
		statusLoading();
		statusEnding();
		document.frmData.btnaddnew.disabled=true;
		document.frmData.btnsimpan.disabled=true;
		/*document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;*/
		document.frmData.btncetak.disabled=false;
			
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
		
		jml_bayar2 = ($('#txtpajakditerima').unmask());		
		/*if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmData.txtpajakditerima.focus();
			return;
		}*/
		
		if(document.frmData.txtnosptpd_a.value==''){
			cek();
		} else {
			simpan2();
		}
	}
	
	function cek(){
		var postCek =
			"npwpd=" + document.frmData.txtnpwpd.value +
			"&awal=" + document.getElementById("txtblnmasapajak1").value +
			"&akhir=" + document.getElementById("txtblnmasapajak2").value +
			"&tahun=" + document.getElementById("txtthnmasapajak").value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/sptpd_burung_walet/ricek', postCek, resPOST);
	}
	
	function resPOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result!=0) {
					alert(result);
					statusEnding();
					return true;
				} else {
					simpan2();
					statusEnding();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function simpan2(){
		var ctlreq = document.frmData.ctl_req;
		
		var postStr = "id=" + document.frmData.id.value;
		postStr = postStr + "&txtthnmasapajak"  + "=" + document.getElementById("txtthnmasapajak").value;
		postStr = postStr + "&txtblnmasapajak1"  + "=" + document.getElementById("txtblnmasapajak1").value;
		postStr = postStr + "&txtblnmasapajak2"  + "=" + document.getElementById("txtblnmasapajak2").value;
		postStr = postStr + "&txttglmasapajak1"  + "=" + document.getElementById("txttglmasapajak1").value;
		postStr = postStr + "&txttglmasapajak2"  + "=" + document.getElementById("txttglmasapajak2").value;
		postStr = postStr + "&txtnpwpd"  + "=" + document.getElementById("txtnpwpd").value;
		postStr = postStr + "&no_sptpd"  + "=" + document.frmData.sptpd.value;
		postStr = postStr + "&txtnpwpd_nama"  + "=" + document.getElementById("txtnpwpd_nama").value;
		postStr = postStr + "&txtnpwpd_alamat"  + "=" + document.getElementById("txtnpwpd_alamat").value;
		postStr = postStr + "&txtcarahitung"  + "=" + document.getElementById("txtcarahitung").value;
		postStr = postStr + "&txttglditerima"  + "=" + document.getElementById("txttglditerima").value;
		postStr = postStr + "&txtpetugasinput"  + "=" + document.getElementById("petugas").value;
		postStr = postStr + "&txtgolhotel"  + "=" + document.getElementById("txtgolhotel").value;
		postStr = postStr + "&txtpajakditerima"  + "=" + document.getElementById("txtpajakditerima").value;
		postStr = postStr + "&txtpajakterutang"  + "=" + document.getElementById("txtpajakterutang").value;
		statusLoading();
		dhtmlxAjax.post(iSaveClass, postStr, responePOST);
		disabledData1();

		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		/*document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;*/
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
					statusLoading(iBaseUrl);
					dhtmlxAjax.post(iDelClass, postStr, responePOST2);	
				}
				document.frmData.btnaddnew.disabled=false;
				document.frmData.btnsimpan.disabled=true;
				/*document.frmData.btnedit.disabled=true;
				document.frmData.btndel.disabled=true;*/
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
					//alert(result);			
					var potong = result.split('/');
					document.frmData.txtnosptpd_a.value = potong[0];
					document.frmData.txtnosptpd_b.value = potong[1]+'/'+potong[2];
					document.frmData.sptpd.value = result;
					//refreshData();
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