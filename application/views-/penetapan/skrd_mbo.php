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
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>

<style>
		body {
			background:#FFF;
		}
	</style>
<div style="height:100%; overflow:auto;">

<h2 style="margin:30px 5px 25px 30px;">SKRD3</h2>
	
<div id="a_tabbar" style="width:1200px; height:730px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
  <br />
			<form name="frmData" id="frmData" method="post">
			    <input type="hidden" name="id" id="id" size="35" /><input type="hidden" name="sptpd" id="sptpd" size="35" />
				<table>
					<tr valign="top">
					<td width="25%" style="padding-left:15px;">No SKRD</td>
					<td width="25%"><input type="text" name="txtnosptpd_a" id="txtnosptpd_a" size="20" maxlength=10 style="background-color:#FFFFCC;" disabled/>&nbsp;<input type="text" name="txtnosptpd_b" id="txtnosptpd_b" size="10" style="background-color:#FFFFCC;" disabled /></td>
					<!--<td>Tata Cara Perhitungan</td>
					<td><?php echo $ctl_carahitung; ?></td>!-->
				</tr>
				<tr valign="top">
					<td style="padding-left:15px;" rowspan=2>Masa Retribusi</td>
					<td><?php echo $ctl_masapajak1; ?> s.d <?php echo $ctl_masapajak2; ?></td>
				</tr>
				<tr valign="top">
					<td><input type="text" name="txt_tgl_masa_pajak3" id="txt_tgl_masa_pajak3" size="12" readonly />&nbsp; <i>s.d</i> <input type="text" name="txt_tgl_masa_pajak4" id="txt_tgl_masa_pajak4" size="12" readonly />&nbsp;</td>
				
				</tr>
				<tr valign="top">
					<td style="padding-left:15px;">Tahun Retribusi</td>
					<td><?php echo $ctl_tahunpajak; ?></td>
					
				</tr>
                 <tr>
                    <td style="padding-left:15px;">Diterima Tanggal</td>
					<td><input type="text" name="txt_tgl_diterima" id="txt_tgl_diterima" size="12" /></td>
                </tr>
				<tr valign="top">	
					<td style="padding-left:15px;" valign="top">NPWPD Perusahaan</td>
					<td><input type="text" name="txt_npwpd" id="txt_npwpd" style="text-transform:uppercase; background-color: #FFCC99;"/>&nbsp;<input type="button" value="Cari" onclick="getDataNPWPD()" name="btncarinpwpd" /></td>
                    <!--<td style="padding-left:15px;">&nbsp;Jenis Galian</td>
					<td>&nbsp;<?php echo $ctl_jenisgalian; ?></td>!-->
				</tr>
				<tr valign="top">
					<td style="padding-left:15px;" valign="top">Nama Perusahaan</td>
					<td><input type="text" name="txt_nama_perusahaan" id="txt_nama_perusahaan" size=30 style="background-color:#FFFFCC;" disabled/></td>
					<td style="padding-left:15px;">&nbsp;&nbsp;&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr valign="top">
					<td style="padding-left:15px;" valign="top">Alamat Perusahaan</td>
					<td><input type="text" name="txt_alamat" id="txt_alamat" size=30 style="background-color:#FFFFCC;" disabled/></td>
					<td style="padding-left:15px;">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
                <tr>
                	<td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
					<td><input type="text" name="jatuhtempo" id="jatuhtempo" size="12" /></td>
		
                </tr>
                 <tr>
                	<td style="padding-left:15px;">Petugas Input</td>
					<td><select name="petugas" id="petugas">
              		<option value="<?php echo $ctl_petugasinput; ?>"><?php echo $ctl_petugasinput; ?></option>
         	  		</select></td>
                </tr>
                
                <tr>
                    <td style="padding-left:15px;" valign="top">Lokasi pasar</td>
                    <td width="50" ><select name="lokasi" id="lokasi" onchange="getLokasi();">
                         <option value=""></option>
                        <?php
                                foreach($lokasi_pasar->result() as $data){
                                echo '<option value="'.$data->kode.'">'.$data->nm_lokasi.'</option>';
                                }
                            ?>
                    </select></td>
                    <td style="padding-left:15px;">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding-left:15px;">Keperluan</td>
					<td><textarea id="txt_keperluan" name="txt_keperluan"></textarea></td>
                </tr>
                <tr>
                	<td colspan="4">Data Objek Pajak</td>
                </tr>
                <tr>
                	<td colspan="4" style="padding-left:15px;">Objek Pajak 
                    <select name="op" id="op" >
                         <option value=""></option>
                        <?php
                                foreach($dop->result() as $data){
//                                    if(isset($reklame)) { $opt="selected"; } else { $opt=""; }
								//echo '<option value="'.$data->id.'|'.$data->keterangan.'|'.$data->harga_pasar.'">'.$data->keterangan.'</option>';
                                echo '<option value="'.$data->kd_rek.'|'.$data->nm_rek.'">'.$data->nm_rek.'</option>';
                                }
                            ?>
                    </select>&nbsp;&nbsp;Jumlah&nbsp;&nbsp;<input type="text" id="qty" name="qty" size="10" />&nbsp;&nbsp;Tarif&nbsp;&nbsp;<input type="text" id="harga" name="harga" size="10" />
                    <input type="button" value="tambah" onclick="add()" name="tambah" id="tambah" disabled="disabled" style="padding-left:10px; padding-right:10px" />
                        <input type="button" value="Delete Data" onclick="krg()" name="hapus" disabled="disabled" id="hapus" style="padding-left:20px; padding-right:20px" /></td>
                </tr>
                <tr>
                	<td colspan="4">
                    	<div id="gridCos" height="150px" style="margin-bottom:10px;"></div>
                    </td>				
                </tr>
                    <tr>
                    	<td style="padding-left:15px;">Jumlah Dasar Pengenaan</td>
                        <td colspan="3"><input type="hidden" size="5" name="sum" id="sum" /><input type="text" name="jumlah" id="jumlah" style="text-align:right" disabled/></td>
                    </tr>
                    <tr>
                    	<td style="padding-left:15px;">Jumlah Tarif Retribusi</td>
                        <td colspan="3"><input type="hidden" name="tar" id="tar" />
                        <input type="text" name="tarif" id="tarif" style="text-align:right" disabled/>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td style="padding-left:15px;">Retribusi Terhutang</td>
                        <td colspan="3"><input type="text" name="setoran" id="setoran" style="text-align:right" disabled/></td>
                    </tr>
                  	<tr>
						<td colspan="4" style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="addNew()" name="btnaddnew" id="btnaddnew" style="width:90px;"/>&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpanData()" name="btnsimpan" id="btnsimpan" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Edit" onclick="editData()" name="btnedit" id="btnedit" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Hapus" onclick="deleteData()" name="btndel" style="width:90px;" id="btndel" disabled/>&nbsp;&nbsp;<input type="button" value="Cetak" onclick="cetak()" style="width:90px;" name="btncetak" id="btncetak" disabled/>&nbsp;&nbsp;</td>
					</tr>
					
				</table>
			<select name="ctl_req" id="ctl_req" style="visibility:hidden">
				<option value="txtnosptpd_a">No SPTPD</option>
				<option value="txt_npwpd">NPWPD</option>
				<option value="txt_tgl_diterima">Tanggal Diterima</option>
				<option value="txt_jml_bayar">Pajak Diterima</option>
			</select>
			
			</form>
<br />
</div>

<div id="C2">
			<div style="padding:0 2px 10px 0px;">
				<div id="gridContent" height="540px" style="margin-bottom:10px;"></div>
				<div id="pagingArea" width="350px" style="background-color:white;"></div>
			</div>    
</div>
  
<div id="objGAL" style="display:none;">
<br />
<form name="frmGAL" id="frmGAL" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
            <option value="4">Nota Hitung</option>
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
var base_url = "<?php echo base_url(); ?>";
	function kosong(){
		window.open('<?php echo site_url(); ?>/galianc_pdf', '', 'height=700,width=1000,scrollbars=yes');
	}

	function cetak() {
		var gabung = document.frmData.txtnosptpd_a.value+'/'+document.frmData.txtnosptpd_b.value;
		window.open('<?php echo site_url(); ?>/sptrd/cetak?sptrd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function add(){
		var op = document.frmData.op.value;
		var qty = document.frmData.qty.value;
		var tarif = document.frmData.tar.value;
        var harga = document.frmData.harga.value;
        
		a = op.split('|');
		var id = gride1.uid();
		var posisi = gride1.getRowsNum();
		//var jml = a[2]*qty;
        var jml = qty*harga;
        var Tot = qty*harga;
		var setor = (jml*tarif)/100;
		// Split Array
		var row1= a[0];
		var row2= a[1];
		var row3= qty;
		//var row4= a[2];
        var row4= harga;
		var row5= '';
		var row6= harga;
		//var row7= qty*harga;
        var row7= qty;
		var row8= '';
		gride1.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8], posisi);
		gride1.showRow(id);
		var stage = 2;
		loadtotal(stage, id);
		document.frmData.op.value="";
		document.frmData.qty.value="";
        document.frmData.harga.value="";
		document.frmData.sum.value=1;
	}
	
	function sumColumn(ind) {
		var out = 0;
		for (var i = 0; i < gride1.getRowsNum(); i++) {
			out += parseFloat(gride1.cells2(i, ind).getValue());
		}
		return out;
	}
	
	function loadtotal(stage, id) {
		document.frmData.jumlah.value = document.getElementById('tmpJum').innerHTML;
		document.frmData.tarif.value = document.getElementById('tmpJum').innerHTML;
		document.frmData.setoran.value = document.getElementById('tmpJum').innerHTML;
	}
	
	// get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows() {
		
        var arr = gride1.getAllItemIds().split(',');
        //alert(arr);
		for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gride1.cells(id,0).getValue()+'|'+
            gride1.cells(id,1).getValue()+'|'+
            gride1.cells(id,2).getValue()+'|'+
            gride1.cells(id,3).getValue()+'|'+
            gride1.cells(id,4).getValue()+'|'+
			gride1.cells(id,5).getValue()+'|'+
			gride1.cells(id,6).getValue()+'|'+
			gride1.cells(id,7).getValue();		                                    
        }
		
		gride1.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
			//alert(addRowItem(i));
        }
        
		r = new Array();
        dpps.sendData();  
    }
	
	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gride1.uid();
        var posisi = gride1.getRowsNum();
        // Split Array
        var arrs = r[arrIndx].split('|');
		//alert(arrs);
		var skrd = document.frmData.sptpd.value; 
		var row1= arrs[0];
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
		var row6= arrs[5];
		var row7= arrs[6];
		var row8= skrd;
		 
        //if(arrs[0] != "") {
            gride1.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8],posisi);
			//alert('1');
        //}
    }

	// Grid Data
	gride1 = new dhtmlXGridObject('gridCos');
	gride1.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gride1.setHeader("Kode,Nama Rekening,Jumlah,Harga Tarif,Dasar Pengenaan,Tarif,Total Jumlah,SKRD");
	gride1.setInitWidths("100,400,120,100,120,80,80,80,100");
	gride1.setColAlign("left,left,right,right,right,right,right,right,right");
	gride1.setColTypes("ro,ro,ron,ron,ron,ron,ron,ron,ron");
    gride1.setNumberFormat("0,000",2,",",".");
	gride1.setNumberFormat("0,000",3,",",".");
	gride1.setNumberFormat("0,000",4,",",".");
	gride1.setNumberFormat("0,000",6,",",".");
	gride1.setColumnHidden(7,true);
    //gride1.setColumnHidden(2,true);
    //gride1.setColumnHidden(3,true);
    gride1.setColumnHidden(4,true);
    gride1.setColumnHidden(5,true);
	gride1.enableMultiselect(true);
	gride1.enableSmartRendering(true);
	gride1.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpVol>{#stat_total}</div>,<div style=text-align:right id=tmpHar>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpJum>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>");
	//gride1.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpHar>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpJum>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>");
    gride1.setSkin("dhx_skyblue");
	gride1.init();

	var dpps = "";
	function rundpPO(){
		dpps = new dataProcessor("<?php echo site_url(); ?>/skrd_mbo/detail");
		dpps.setUpdateMode("off");
		dpps.init(gride1);       
		dpps.attachEvent("onAfterUpdateFinish", function() {        
			statusEnding();
			alert("Done");
			return true;
		});
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
	
	cal1 = new dhtmlxCalendarObject('txt_tgl_diterima');
	cal1.setDateFormat('%d/%m/%Y');
	
    cal2 = new dhtmlxCalendarObject('jatuhtempo');
	cal2.setDateFormat('%d/%m/%Y');
	
	wGAL = dhxWins.createWindow("wGAL",0,0,800,400);
	wGAL.setText("Pencarian Data Perusahaan");
	wGAL.button("park").hide();
	wGAL.button("close").hide();
	wGAL.button("minmax1").hide();
	wGAL.hide();

	function getDataNPWPD() {
		wGAL.show();
    	//wPKR.setModal(true);
		wGAL.center();
		wGAL.attachObject('objGAL');
	}
	
	function batal() {
		wGAL.hide();
		wGAL.setModal(false);
		document.frmGAL.fil.value = "0";
		document.frmGAL.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmGAL.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmGAL.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmGAL.values.focus();
			return;
			}
		}
		nilai = document.frmGAL.values.value;
		gridGAL.clearAll();
		gridGAL.loadXML("<?php echo site_url(); ?>/skrd/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridGAL= new dhtmlXGridObject('gridsPKR');
	gridGAL.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridGAL.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridGAL.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridGAL.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridGAL.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridGAL.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridGAL.enablePaging(true,1000,1000,"pagingArea",true);
	gridGAL.setPagingSkin("bricks");
	gridGAL.setSkin("dhx_skyblue");
	gridGAL.setColumnHidden(0,true);
	gridGAL.attachEvent("onRowDblClicked", selectedOpenData2);
	gridGAL.init();
	
	function selectedOpenData2(id) {
		document.frmData.txt_npwpd.value 	 = gridGAL.cells(id,1).getValue();
		document.frmData.txt_nama_perusahaan.value	= gridGAL.cells(id,2).getValue();
		document.frmData.txt_alamat.value  	= gridGAL.cells(id,3).getValue();
		batal();
		enableData1();
		document.frmData.txt_bln_masa_pajak1.disabled=false;
		document.frmData.txt_bln_masa_pajak2.disabled=false;
		document.frmData.txt_thn_masa_pajak.disabled=false;
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	
	grid.setHeader("id, no_skrd, npwpd, nama_perusahaan, alamat, cara_hitung, tgl_diterima, keperluan, Omset, petugas_input, masa_pajak1, masa_pajak2, Jumlah bayar,tarif,kode_pasar",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,150,150,170,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,right,left,right,right,left,right");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ro,ron,ron,ron");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.setSkin("dhx_skyblue");
	grid.setColumnHidden(0,true);
	grid.setNumberFormat("0,000",8,",","."); 
	grid.setNumberFormat("0,000",12,",","."); 
	grid.enablePaging(true,20,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/skrd/data_skrd");
	grid.init();
	
	
	
    
	function hitungDasarPengenaan(iRow){
		var vol = parseFloat(document.getElementById('txt_d1_volume['+iRow+']').value);
		var hrg = parseFloat(document.getElementById('txt_d1_harga_pasar['+iRow+']').value);
		var dsrPengenaan = vol * hrg;
		document.getElementById('txt_d1_dasar_pengenaan['+iRow+']').value=dsrPengenaan;
		return;
	}

	
	function selectedOpenData(id) {
		kosongfrmData1();
		disabledData1();
			
		var postStr='id='+id;
		//alert(postStr);
		//return;
		//statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skrd_mbo/get_data_by_id', postStr, responePOST3);
		var skrd = grid.cells(id,1).getValue();
		document.frmData.sptpd.value = grid.cells(id,1).getValue();
        document.frmData.txt_tgl_diterima.value = konversiTgl(grid.cells(id,6).getValue());
        document.frmData.txt_keperluan.value = grid.cells(id,7).getValue();
		document.frmData.txt_thn_masa_pajak.value = getTgl(grid.cells(id,10).getValue(), "THN");
		document.frmData.txt_bln_masa_pajak1.value = getTgl(grid.cells(id,10).getValue(), "BLN");
		document.frmData.txt_bln_masa_pajak2.value = getTgl(grid.cells(id,11).getValue(), "BLN");
		document.frmData.txt_tgl_masa_pajak3.value = konversiTgl(grid.cells(id,10).getValue());
        document.frmData.txt_tgl_masa_pajak4.value = konversiTgl(grid.cells(id,11).getValue());
		document.frmData.jumlah.value = format_number(grid.cells(id,8).getValue());
		document.frmData.setoran.value = format_number(grid.cells(id,12).getValue());
		document.frmData.tarif.value = format_number(grid.cells(id,13).getValue());
        document.frmData.lokasi.value = grid.cells(id,14).getValue();
        
		//alert(sptpd);
		gride1.clearAll();
		gride1.loadXML("<?php echo site_url(); ?>/skrd_mbo/d_data?skrd="+skrd);
		//loadtotal();
		document.frmData.btnaddnew.disabled=true;
		document.frmData.btnsimpan.disabled=true;
		document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;
		document.frmData.btncetak.disabled=false;
		tabbar.setTabActive("a1");
	}
	
	function responePOST3(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				//alert(result);
				if(result!="") {			
					eval(result);		
				}
				statusEnding();
				
				return true;
			} else {
				alert(loader.xmlDoc.status);
				
				//alert('There was a problem with the request.');
			}
		}
	}

	function addNew() {
		gride1.clearAll();
		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		document.frmData.btnedit.disabled=true;
		document.frmData.btndel.disabled=true;
		document.frmData.btncetak.disabled=true;
		document.frmData.txt_npwpd.disabled=false;
		document.frmData.btncarinpwpd.disabled=false;
		document.frmData.txt_bln_masa_pajak1.disabled=false;
		document.frmData.txt_bln_masa_pajak2.disabled=false;
		document.frmData.txt_thn_masa_pajak.disabled=false;
		document.frmData.txt_npwpd.focus();
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
		document.frmData.tambah.disabled=false;
		document.frmData.hapus.disabled=false;
		document.frmData.txtnosptpd_a.readonly=true;
		document.frmData.txtnosptpd_b.readonly=true;
		document.frmData.txt_keperluan.disabled=false;
		//document.frmData.txt_cara_hitung.disabled=false;
		document.frmData.txt_tgl_diterima.disabled=false;
		document.frmData.jatuhtempo.disabled=false;
		document.frmData.lokasi.disabled=false;
		document.frmData.txt_npwpd.disabled=false;
		document.frmData.btncarinpwpd.disabled=false;
		document.frmData.op.disabled=false;
		document.frmData.qty.disabled=false;
		
		//document.frmData.jumlah.disabled=false;
	}
	
	function disabledData1(){
		document.frmData.tambah.disabled=true;
		document.frmData.hapus.disabled=true;
		document.frmData.txtnosptpd_a.readonly=true;
		document.frmData.txtnosptpd_b.readonly=true;
		document.frmData.txt_bln_masa_pajak1.disabled=true;
		document.frmData.txt_bln_masa_pajak2.disabled=true;
		document.frmData.txt_tgl_masa_pajak3.disabled=true;
		document.frmData.txt_tgl_masa_pajak4.disabled=true;
		document.frmData.txt_thn_masa_pajak.disabled=true;
		document.frmData.txt_keperluan.disabled=true;
		//document.frmData.txt_cara_hitung.disabled=true;
		document.frmData.txt_tgl_diterima.disabled=true;
		document.frmData.jatuhtempo.disabled=true;
		
		document.frmData.txt_npwpd.disabled=true;
		document.frmData.btncarinpwpd.disabled=true;
		document.frmData.lokasi.disabled=true;
		document.frmData.txt_nama_perusahaan.disabled=true;
		document.frmData.txt_alamat.disabled=true;
		document.frmData.op.disabled=true;
		document.frmData.qty.disabled=true;
		document.frmData.jumlah.disabled=true;
	}

	function kosongfrmData1(){
		document.frmData.id.value='';
		document.frmData.txtnosptpd_a.value='';
		document.frmData.txtnosptpd_b.value='';
		document.frmData.txt_bln_masa_pajak1.value='';
		document.frmData.txt_bln_masa_pajak2.value='';
		document.frmData.txt_tgl_masa_pajak3.value='';
		document.frmData.txt_tgl_masa_pajak4.value='';
		document.frmData.txt_thn_masa_pajak.value='';
		document.frmData.txt_keperluan.value='';
		//document.frmData.txt_cara_hitung.value='';
		document.frmData.txt_tgl_diterima.value='';
		document.frmData.petugas.value='';
		
		document.frmData.txt_npwpd.value='';

        document.frmData.lokasi.value='';
		document.frmData.txt_nama_perusahaan.value='';
		document.frmData.txt_alamat.value='';
		document.frmData.op.value='';
		document.frmData.qty.value='';
		document.frmData.jumlah.value='';
		document.frmData.setoran.value='';
	}
	
	function krg() {
		ya = confirm("Are You Sure ?");
		if(ya) {
			gride1.deleteSelectedRows();
		}
	}

	function simpanData() {
		if(document.frmData.txt_npwpd.value==""){
			alert("NPWPD Tidak Boleh Kosong");
			document.frmData.txt_npwpd.focus();
			return;
		}
		
		jml_bayar2 = ($('#jumlah').unmask());		
		/*if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmData.jumlah.focus();
			return;
		}*/
		
		if(document.frmData.txt_tgl_diterima.value==""){
			alert("Tanggal Penerimaan Tidak Boleh Kosong");
			document.frmData.txt_tgl_diterima.focus();
			return;
		}
		
//		if(document.frmData.sum.value==""){
//			alert("Data Objek Pajak Tidak Boleh Kosong");
//			return;
//		}
        
        if(document.frmData.lokasi.value==""){
			alert("Data Lokasi Pasar Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmData.txtnosptpd_a.value==''){
			cek();
		} else {
			simpan2();
		}
	}
	
	function cek(){
		var postCek =
			"npwpd=" + document.frmData.txt_npwpd.value +
			"&awal=" + document.getElementById("txt_bln_masa_pajak1").value +
			"&akhir=" + document.getElementById("txt_bln_masa_pajak2").value +
			"&tahun=" + document.getElementById("txt_thn_masa_pajak").value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skrd_mbo/ricek', postCek, resPOST);
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
		rundpPO();
		var postStr = "id=" + document.frmData.id.value +
		"&sptrd=" + document.frmData.sptpd.value +
		"&jumlah=" + document.frmData.jumlah.value +
		"&tarif=" + document.frmData.tarif.value +
		"&setoran=" + document.frmData.setoran.value +		
		"&txt_thn_masa_pajak"  + "=" + document.getElementById("txt_thn_masa_pajak").value
		+ "&txt_bln_masa_pajak1"  + "=" + document.getElementById("txt_bln_masa_pajak1").value
		+ "&txt_bln_masa_pajak2"  + "=" + document.getElementById("txt_bln_masa_pajak2").value		
		+ "&txt_tgl_masa_pajak1=" + document.frmData.txt_tgl_masa_pajak3.value
		+ "&txt_tgl_masa_pajak2=" + document.frmData.txt_tgl_masa_pajak4.value
		+ "&txt_thn_masa_pajak=" + document.frmData.txt_thn_masa_pajak.value
		+ "&lokasi=" + document.frmData.lokasi.value
		+ "&tgl_diterima=" + document.frmData.txt_tgl_diterima.value
        + "&tgl_jatuhtempo=" + document.frmData.jatuhtempo.value
		+ "&petugas_input=" + document.frmData.petugas.value
		//alert('1...');
		//+ "&txtnosptpd_a=" + document.frmData.txtnosptpd_a.value
		+ "&npwpd=" + document.frmData.txt_npwpd.value
		+ "&keperluan=" + document.frmData.txt_keperluan.value
	//	+ "&jenis_galian=" + document.frmData.txt_jenis_galian.value
		+ "&txt_nama_perusahaan=" + document.frmData.txt_nama_perusahaan.value
		+ "&txt_alamat=" + document.frmData.txt_alamat.value;
        
		
		//alert('2...');
		
		alert(postStr);
		//return;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skrd_mbo/simpan_skrd', postStr, responePOST2);
		
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
		"<div style='float:left;'><img src='"+base_url+"/assets/modal/spinner.gif'></div>" +   
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
		grid.loadXML(base_url+'index.php/skrd_mbo/data_skrd');
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
					"sptrd_1=" + document.frmData.txtnosptpd_a.value +
					"&sptrd_2=" + document.frmData.txtnosptpd_b.value;
					statusLoading(base_url);
					dhtmlxAjax.post(base_url+'index.php/skrd_mbo/delete_skrd', postStr, responePOST);
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

					refreshData();
					statusEnding();
					alert(result);
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
				//alert(result);
				if(result!=0) {
					document.frmData.sptpd.value = result;
					pot = result.split('/');
					document.frmData.txtnosptpd_a.value = pot[0];
					document.frmData.txtnosptpd_b.value = pot[1]+'/'+pot[2];
					tmpRows();
					refreshData();
					//gride1.clearAll();			
					//alert("Done");
					statusEnding();
				}
				statusEnding();
				return true;
			} else {
				alert(loader.xmlDoc.status);
				statusEnding();
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
    
	function getLokasi(){
			if(document.frmData.lokasi.value!=""){
			poststr = 'lokasi=' + document.frmData.lokasi.value;			           
			dhtmlxAjax.post(base_url+"/index.php/sptrd/getLokasi", encodeURI(poststr), outputLokasi);
			}
		}
        
         function outputLokasi(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {                                 
                document.frmData.harga.value = result;
                                  
            }
            else
            {
                alert("Ada kesalahan pada program");
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