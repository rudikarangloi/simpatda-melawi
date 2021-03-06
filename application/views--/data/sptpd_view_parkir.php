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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>

<script type="text/javascript" language="javascript">
	var iBaseUrl	= '<?php echo base_url();?>';
	var iSaveClass	= iBaseUrl + 'index.php' + '/sptpd_parkir/simpan_sptpd';
	var iDelClass	= iBaseUrl + 'index.php' + '/sptpd_parkir/delete_sptpd';
	var iViewClass	= iBaseUrl + 'index.php' + '/sptpd_parkir/data_sptpd';
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

<h2 style="margin:30px 5px 25px 30px;">SPTPD Parkir</h2>
	
<div id="a_tabbar" style="width:1000px; height:850px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
			<form name="frmData" id="frmData" method="post">
			    <input type="hidden" name="id" id="id" size="35" />
                <input type="hidden" name="sptpd" id="sptpd" size="35" />
                <table>
					<tr>
						<td width="120" style="padding-left:15px;">No SPTPD</td>
						<td><input type="text" name="txtnosptpd_a" id="txtnosptpd_a" size="20" maxlength=10  style="background-color:#FFFFCC;" disabled/>
						&nbsp;/&nbsp;
						<input type="text" name="txtnosptpd_b" id="txtnosptpd_b" size="10"style="background-color:#FFFFCC;" disabled/></td>
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
						<td style="padding-left:15px;" >NPWPD</td>
						<td><input type="text" name="txtnpwpd" id="txtnpwpd" style="text-transform:uppercase; background-color: #FFCC99;"/>&nbsp;<input type="button" value="Cari" onclick="cariNpwpd()" name="btncarinpwpd" /></td>
					</tr>
					<tr>
						<td style="padding-left:15px;">Nama Perusahaan</td>
						<td><input type="text" name="txtnpwpd_nama" id="txtnpwpd_nama" style="background-color:#FFFFCC;" size=50/></td>
					</tr>
					<tr>
                    	<td style="padding-left:15px;">Alamat Perusahaan</td>
						<td><input type="text" name="txtnpwpd_alamat" id="txtnpwpd_alamat" style="background-color:#FFFFCC;" size=50/></td>
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
						<td style="padding-left:15px;" valign="top">1. Golongan Parkir</td>
						<td><input type="text" name="txtgolhotel" id="txtgolhotel" value="<?php echo $kd_rek; ?>" disabled/>&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">2. Tipe Tarif</td>
						<td><select id="dtarif" name="dtarif" onchange="getTipe();">
							<option></option>
							<option value="1">Tarif A</option>							
							<option value="2">Tarif B</option>
							<option value="3">Tarif Progresif</option>							
						</select></td>
					<tr>
						<td style="padding-left:15px;" valign="top">3. Parkir yang diselenggarakan </td>
						<td><select id="jenis_parkir" name="jenis_parkir" onchange="getTipe();">
							<option></option>
							<option value="1">Gedung parkir</option>							
							<option value="2">Lingkungan parkir</option>	
							<option value="3">Pelataran parkir</option>
							<option value="2">Garasi yang disewakan</option>
						</select></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">4. Harga tanda masuk</td>
						 <td>Mobil &nbsp;<input type="text" name="hrg_mobil" id="hrg_mobil" size="12" /> /
						 &nbsp;  Motor &nbsp;<input type="text" name="hrg_motor" id="hrg_motor" size="12"/> /
						 &nbsp;  Garasi &nbsp;<input type="text" name="hrg_garasi" id="hrg_garasi" size="12"/></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">5. - Jumlah kendaraan rata-rata pada hari biasa</td>
						<td nowrap><input type="text" name="jum_hr_biasa" id="jum_hr_biasa" size="15" style="text-align:left"/> </td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top"> &nbsp;&nbsp;&nbsp; - Jumlah kendaraan rata-rata pada hari libur/ minggu</td>
						<td nowrap><input type="text" name="jum_hr_minggu" id="jum_hr_minggu" size="15" style="text-align:left"/> </td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">6. - Luas Area Parkir</td> 
						<td nowrap><input type="text" name="luas_area" id="luas_area" size="15" style="text-align:left"/> M2 </td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;&nbsp; - Jumlah Garasi</td>
						<td nowrap><input type="text" name="jum_area" id="jum_garasi" size="15" style="text-align:left"/> Buah </td>
					</tr>
					</tr>
					</tr>
					<tr>
						<td colspan=2><b><i><u>Data Masa Pajak Parkir & Dasar Pengenaan</u></i></b></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;a. Masa Pajak</td>
						<td><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12"  /> &nbsp;
			 <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12"  /></td>
					</tr>
					<tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;b. Dasar Pengenaan</td>
						<td nowrap><input type="text" name="txtpajakditerima" id="txtpajakditerima" size="15" style="text-align:right"/> </td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;c. Tarif</td>
						<td nowrap><input type="text" name="tarif" id="tarif" size="10" disabled="disabled" style="text-align:right"/>&nbsp;%</td>
					</tr>
                    <tr>
						<td nowrap style="padding-left:15px;" valign="top">&nbsp;&nbsp;d. Pajak Terutang</td>
						<td nowrap><input type="text" name="txtpajakterutang" id="txtpajakterutang" size="15" disabled="disabled" style="text-align:right"/> </td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="addNew()" name="btnaddnew" id="btnaddnew" style="width:90px;"/>&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpanData()" name="btnsimpan" id="btnsimpan" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Edit" onclick="editData()" name="btnedit" id="btnedit" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Hapus" onclick="deleteData()" name="btndel" id="btndel" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Cetak" onclick="cetak()" name="btncetak" style="width:90px;" id="btncetak" disabled/>&nbsp;&nbsp;<input type="button" value="SPTPD Kosong" onclick="kosong()" name="null" id="null" /></td>
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

<div id="C2">
<div style="padding:0 1px 0 0;">
	<div id="gridContent" height="390px" width="995px" style="margin-bottom:10px;"></div>
	<div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>  

<div id="objPKR" style="display:none;">
<br />
<form name="frmPKR" id="frmPKR" method="post" action="javascript:void(0);">
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
	<div id="gridsPKR" width="750px" height="250px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
<script language="javascript">
	function kosong(){
		window.open('<?php echo site_url(); ?>/parkir_pdf', '', 'height=700,width=1000,scrollbars=yes');
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
	
	function hitung(jumlahDP) {
		document.frmData.txtpajakterutang.value = format_number((jumlahDP*document.frmData.tarif.value)/100);
	}
	
	function getTipe(){
			var cek = document.frmData.dtarif.value;
			if(cek!=""){
				document.frmData.txtpajakditerima.value='';
				document.frmData.txtpajakterutang.value='';
				if(cek=="1"){
					document.frmData.tarif.value = "25";
				}else if(cek=="2"){
					document.frmData.tarif.value = "35";
				}else if(cek=="3"){
					document.frmData.tarif.value = "30";
				}
			}else{
				alert("Tipe Belum dipilih");
			}
	}		
	
	function cetak() {
		var gabung = document.frmData.txtnosptpd_a.value+'/'+document.frmData.txtnosptpd_b.value;
		window.open('<?php echo site_url(); ?>/sptpd_parkir/cetak?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	var base_url = "<?php echo base_url(); ?>";

	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	disabledData1();

	var cal1 = new dhtmlxCalendarObject('txttglditerima');
	cal1.setDateFormat('%d/%m/%Y');
	
	wPKR = dhxWins.createWindow("wPKR",0,0,800,400);
	wPKR.setText("Pencarian Data Perusahaan");
	wPKR.button("park").hide();
	wPKR.button("close").hide();
	wPKR.button("minmax1").hide();
	wPKR.hide();

	function cariNpwpd() {
		wPKR.show();
    	//wPKR.setModal(true);
		wPKR.center();
		wPKR.attachObject('objPKR');
	}
	
	function batal() {
		wPKR.hide();
		wPKR.setModal(false);
		document.frmPKR.fil.value = "0";
		document.frmPKR.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmPKR.fil.value;
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmPKR.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmPKR.values.focus();
			return;
			}
		}
		nilai = document.frmPKR.values.value;
		gridPKR.clearAll();
		gridPKR.loadXML("<?php echo site_url(); ?>/sptpd_parkir/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridPKR= new dhtmlXGridObject('gridsPKR');
	gridPKR.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridPKR.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridPKR.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridPKR.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridPKR.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridPKR.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridPKR.enablePaging(true,1000,1000,"pagingArea",true);
	gridPKR.setPagingSkin("bricks");
	gridPKR.setSkin("dhx_skyblue");
	gridPKR.setColumnHidden(0,true);
	gridPKR.attachEvent("onRowDblClicked", selectedOpenData2);
	gridPKR.init();
	
	function selectedOpenData2(id) {
		document.frmData.txtnpwpd.value 	= gridPKR.cells(id,1).getValue();
		document.frmData.txtnpwpd_nama.value	= gridPKR.cells(id,2).getValue();
		document.frmData.txtnpwpd_alamat.value  = gridPKR.cells(id,3).getValue();
		batal();
		enableData1();
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID,NPWPD, No SPTPD,Nama Perusahaan, Alamat, Cara Hitung, Golongan, Masa Pajak1, Masa Pajak2, Diterima Tgl, Jumlah Bayar, Petugas, Omset,Tarif, Jenis Parkir,Harga Tiket Mobil, Harga Tiket Motor, Harga Garasi, Jumlah Hari Biasa, Jumlah Hari Libur, Luas Area, Jumlah Garasi",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,150,150,170,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,right,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,date,int,int,int,str,int,int,int,int,int,int,int,int");
	grid.setSkin("dhx_skyblue");
	grid.setColumnHidden(0,true);
	grid.enablePaging(true,15,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/sptpd_parkir/data_sptpd");
	grid.init();
	
	function selectedOpenData(id) {
		kosongfrmData1();
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
		document.frmData.dtarif.value = grid.cells(id,13).getValue();
		document.frmData.jenis_parkir.value = grid.cells(id,14).getValue();
		document.frmData.hrg_mobil.value = grid.cells(id,15).getValue();
		document.frmData.hrg_motor.value = grid.cells(id,16).getValue();
		document.frmData.hrg_garasi.value = grid.cells(id,17).getValue();
		document.frmData.jum_hr_biasa.value = grid.cells(id,18).getValue();
		document.frmData.jum_hr_minggu.value = grid.cells(id,19).getValue();
		document.frmData.luas_area.value = grid.cells(id,20).getValue();
		document.frmData.jum_garasi.value = grid.cells(id,21).getValue();
		
		
		document.frmData.txttglmasapajak1.value = konversiTgl(grid.cells(id,7).getValue());
		document.frmData.txttglmasapajak2.value = konversiTgl(grid.cells(id,8).getValue());
		document.frmData.txttglditerima.value = konversiTgl(grid.cells(id,9).getValue());
		
		document.frmData.txtthnmasapajak.value = getTgl(grid.cells(id,7).getValue(), "THN");
		document.frmData.txtblnmasapajak1.value = getTgl(grid.cells(id,7).getValue(), "BLN");
		document.frmData.txtblnmasapajak2.value = getTgl(grid.cells(id,8).getValue(), "BLN");
		
		document.frmData.txtpajakditerima.value = format_number(grid.cells(id,12).getValue());
		document.frmData.petugas.value = grid.cells(id,11).getValue();
		document.frmData.txtpajakterutang.value = format_number(grid.cells(id,10).getValue());
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
		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		document.frmData.btnedit.disabled=true;
		document.frmData.btndel.disabled=true;
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
		document.frmData.txtblnmasapajak1.disabled=false;
		document.frmData.txtblnmasapajak2.disabled=false;
		document.frmData.txtthnmasapajak.disabled=false;
		document.frmData.txtnpwpd_nama.disabled=false;
		document.frmData.txtnpwpd_alamat.disabled=false;
		document.frmData.txtcarahitung.disabled=false;
		document.frmData.txttglditerima.disabled=false;
		document.frmData.petugas.disabled=false;
		document.frmData.txtgolhotel.disabled=false;
		document.frmData.txttglmasapajak1.disabled=false;
		document.frmData.txttglmasapajak2.disabled=false;
		document.frmData.txtpajakditerima.disabled=false;
		document.frmData.dtarif.disabled=false;
		document.frmData.jenis_parkir.disabled=false;
		document.frmData.hrg_mobil.disabled=false;
		document.frmData.hrg_motor.disabled=false;
		document.frmData.hrg_garasi.disabled=false;		
		document.frmData.jum_hr_biasa.disabled=false;		
		document.frmData.jum_hr_minggu.disabled=false;
		document.frmData.luas_area.disabled=false;
		document.frmData.jum_garasi.disabled=false;
		
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
		document.frmData.txttglmasapajak1.disabled=true;
		document.frmData.txttglmasapajak2.disabled=true;
		document.frmData.txtpajakditerima.disabled=true;
		document.frmData.dtarif.disabled=true;
		document.frmData.hrg_mobil.disabled=true;
		document.frmData.hrg_motor.disabled=true;
		document.frmData.hrg_garasi.disabled=true;
		document.frmData.jum_hr_biasa.disabled=true;
		document.frmData.jum_hr_minggu.disabled=true;
		document.frmData.luas_area.disabled=true;
		document.frmData.jum_garasi.disabled=true;
		document.frmData.jenis_parkir.disabled=true;
		
	}

	function kosongfrmData1(){
		document.frmData.id.value='';
		document.frmData.txtnosptpd_a.value='';
		document.frmData.txtnosptpd_b.value='';
		document.frmData.txtnpwpd.value='';
		document.frmData.txtnpwpd_nama.value='';
		document.frmData.txtnpwpd_alamat.value='';
		document.frmData.txttglditerima.value='';
		document.frmData.txttglmasapajak1.value='';
		document.frmData.txttglmasapajak2.value='';
		document.frmData.txtpajakditerima.value='';
		document.frmData.txtpajakterutang.value='';
		document.frmData.txtblnmasapajak1.value='';
		document.frmData.txtblnmasapajak2.value='';
		document.frmData.txtthnmasapajak.value='';
		document.frmData.dtarif.value='';
		document.frmData.jenis_parkir.value='';
		document.frmData.hrg_mobil.value='';
		document.frmData.hrg_motor.value='';
		document.frmData.hrg_garasi.value='';
		document.frmData.jum_hr_biasa.value='';
		document.frmData.jum_hr_minggu.value='';
		document.frmData.luas_area.value='';
		document.frmData.jum_garasi.value='';
		
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
		
		if(document.frmData.jenis_parkir.value==""){
			alert("Jenis Parkir Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.hrg_mobil.value==""){
			alert("Harga Mobil Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.hrg_motor.value==""){
			alert("Harga Motor Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.hrg_garasi.value==""){
			alert("Harga Garasi Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.jum_hr_biasa.value==""){
			alert("Jumlah kendaraan hari biasa Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.jum_hr_minggu.value==""){
			alert("Jumlah kendaraan hari libur Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.luas_area.value==""){
			alert("Luas Area Tidak Boleh Kosong");
			document.frmData.txttglmasapajak2.focus();
			return;
		}
		if(document.frmData.jum_garasi.value==""){
			alert("Luas Area Tidak Boleh Kosong");
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
			//simpan2();
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
		dhtmlxAjax.post(base_url+'index.php/sptpd_parkir/ricek', postCek, resPOST);
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
		postStr = postStr + "&jenis_parkir"  + "=" + document.getElementById("jenis_parkir").value;
		postStr = postStr + "&hrg_mobil"  + "=" + document.getElementById("hrg_mobil").value;
		postStr = postStr + "&hrg_motor"  + "=" + document.getElementById("hrg_motor").value;
		postStr = postStr + "&hrg_garasi"  + "=" + document.getElementById("hrg_garasi").value;
		postStr = postStr + "&jum_hr_biasa"  + "=" + document.getElementById("jum_hr_biasa").value;
		postStr = postStr + "&hrg_mobil"  + "=" + document.getElementById("hrg_mobil").value;
		postStr = postStr + "&jum_hr_minggu"  + "=" + document.getElementById("jum_hr_minggu").value;
		postStr = postStr + "&luas_area"  + "=" + document.getElementById("luas_area").value;
		postStr = postStr + "&jum_garasi"  + "=" + document.getElementById("jum_garasi").value;
		
		
		
		
		
		
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
			if(name=='dispenda'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr = 
						"sptpd_1=" + document.frmData.txtnosptpd_a.value +
						"&sptpd_2=" + document.frmData.txtnosptpd_b.value;
					    statusLoading(iBaseUrl);
						dhtmlxAjax.post(base_url+'index.php/sptpd_parkir/delete_sptpd', postStr, responePOST);	
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
					//document.frmData.sptpd.value = result;	
					document.frmData.sptpd.value = "";		
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
	
	statusEnding();
</script>
</div>