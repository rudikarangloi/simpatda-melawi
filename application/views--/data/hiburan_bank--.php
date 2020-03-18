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

<script type="text/javascript" language="javascript">
	var iBaseUrl	= '<?php echo base_url();?>';
	var iSaveClass	= iBaseUrl + 'index.php' + '/sptpd_hiburan/simpan_sptpd';
	var iDelClass	= iBaseUrl + 'index.php' + '/sptpd_hiburan/delete_sptpd';
	var iViewClass	= iBaseUrl + 'index.php' + '/sptpd_hiburan/data_sptpd';
	var iGetNPWPDClass	= iBaseUrl + 'index.php' + '/sptpd_hiburan/get_npwpd';
	var iGetKelasClass	= iBaseUrl + 'index.php' + '/sptpd_hiburan/get_kelas';
</script>
<style>
		body {
			background:#FFF;
		}
	</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxcalendar.css"></link>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_grid/skins/dhtmlxgrid_dhx_skyblue.css">

<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.price_format.js"></script>

<div style="height:100%; overflow:auto;">

<h2 style="margin:30px 5px 25px 30px;">SPTPD Pajak Hiburan ( Bank )</h2>
	
<div id="a_tabbar" style="width:1200px; height:930px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
			<form name="frmData" id="frmData" method="post">
			    <input type="hidden" name="id" id="id" size="35" />
                <input type="hidden" name="sptpd" id="sptpd" size="35" />
				<table border="0">
					<tr valign="top">
						<td width="25%" style="padding-left:15px;">No SPTPD</td>
						<td width="25%"><input type="text" name="txtnosptpd_a" id="txtnosptpd_a" size="20" maxlength=10 style="background-color:#FFFFCC;" disabled/>&nbsp;<input type="text" name="txtnosptpd_b" id="txtnosptpd_b" size="10" style="background-color:#FFFFCC;" disabled/></td>
						<td width="15%">Jenis Pajak Hiburan</td>
						<td width="30%"><fieldset class="oval2">
							<table width="200" border="0" >
							  <tr>
								<td><input type="radio" name="jnsSPT" id="SPTR" value="0" disabled></td>
								<td>Regular</td>
								<td><input type="radio" name="jnsSPT" id="SPTI" value="0" disabled></td>
								<td>Insidentil</td>
								<td><input type="radio" name="jnsSPT" id="SPTT" value="0" disabled></td>
								<td>Tunggakan</td>
							  </tr>
							</table>
						  </fieldset></td>
					</tr>
					<tr valign="top">
						<td style="padding-left:15px;">Masa Pajak</td>
						<td><?php echo $ctl_masapajak1; ?> s.d <?php echo $ctl_masapajak2; ?></td>
						<td rowspan=2>Keterangan Insidentil</td>
						<td rowspan=2><textarea id="txtketinsidentil" name="txtketinsidentil" cols=30 rows=3></textarea></td>
					</tr>
					<tr valign="top">
						<td style="padding-left:15px;">Tahun Pajak</td>
						<td><?php echo $ctl_tahunpajak; ?></td>
					</tr>
					<tr valign="top">	
						<td style="padding-left:15px;" valign="top">NPWPD</td>
						<td><input type="text" name="txtnpwpd" id="txtnpwpd" style="text-transform:uppercase; background-color: #FFCC99;"/>&nbsp;<input type="button" value="Cari" onclick="getDataNPWPD()" name="btncarinpwpd" style="width:90px;"/></td>
						<td>Tata Cara Perhitungan</td>
						<td><?php echo $ctl_carahitung; ?></td>
					</tr>
					<tr valign="top">
						<td style="padding-left:15px;" >Nama Perusahaan</td>
						<td><input type="text" name="txtnpwpd_nama" id="txtnpwpd_nama" size=30 style="background-color:#FFFFCC;"/></td>
						<td>Diterima Tanggal</td>
						<td><input type="text" name="txttglditerima" id="txttglditerima" size="12" /></td>
					</tr>
					<tr valign="top">
						<td style="padding-left:15px;" >Alamat Perusahaan</td>
                        <td><input type="text" name="txtnpwpd_alamat" id="txtnpwpd_alamat" size=30 style="background-color:#FFFFCC;"/></td>
						<td>Petugas Input</td>
						<td><select name="petugas" id="petugas" disabled>
              			<option value="<?php echo $ctl_petugasinput; ?>"><?php echo $ctl_petugasinput; ?></option>
         	  			</select></td>
					</tr>
					<tr>
						<td colspan=4><b><i><u>A. Data Obyek Pajak</u></i></b></td>
					</tr>
					<tr>
						<td style="padding-left:10px;" valign="top"><font size="-1">1. Hiburan yang diselenggarakan</font></td>
						<td colspan=3><select name="txtjenishiburan" id="txtjenishiburan" onchange="jenishiburan()" disabled>
                        <option value=""></option>
						<?php 
						foreach($ctl_jenishiburan->result() as $rs) {
								echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
						}
						?></select></td>
					</tr>
					<tr>
						<td colspan=4 style="padding-left:10px;" valign="top"><font size="-1">2. Harga Tanda Masuk yang berlaku</font></td>
					</tr>
					<tr>
						<td style="padding-left:35px;" valign="top" colspan=4><font size="-1">- Kelas</font>
                        &nbsp;&nbsp;<input type="text" name="txtkelas_a" id="txtkelas_a" size="10" />
						&nbsp;&nbsp;<font size="-1">Rp.</font>
						<input type="text" name="txtrpkelas_a" id="txtrpkelas_a" size="15" />&nbsp;&nbsp;
                    <input type="button" value="Tambah Data" onclick="add()" name="tambah" id="tambah" disabled="disabled" style="padding-left:20px; padding-right:20px" />
                        <input type="button" value="Delete Data" onclick="krg()" name="hapus" disabled="disabled" id="hapus" style="padding-left:20px; padding-right:20px" /></td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:30px;">
                    		<div id="gridCos" height="150px" width="300" style="margin-bottom:10px;"></div>
                   		</td><td colspan="2">&nbsp;<input type="hidden" name="sum" id="sum" /></td>
					</tr>
					<tr>
						<td colspan=2 style="padding-left:10px;" valign="top"><font size="-1">3. Jumlah Pertunjukan Rata-rata pada hari biasa</font></td>
						<td colspan=2  valign="top"><input type="text" name="txtjmlbiasa" id="txtjmlbiasa" size="5" /><i><font size="-1">(Khusus untuk pertunjukan Film, Kesenian</font></i></td>
					</tr>
					<tr>
						<td colspan=2 style="padding-left:28px;" valign="top"><font size="-1">Jumlah Pertunjukan Rata-rata pada hari libur/minggu</font></td>
						<td colspan=2 valign="top"><input type="text" name="txtjmllibur" id="txtjmllibur" size="5" /><i><font size="-1">dan Sejenisnya, Pagelaran Musik dan Tari)</font></i></td>
					</tr>
					<tr>
						<td colspan=2 style="padding-left:10px;" valign="top"><font size="-1">4. Jumlah Pengunjung Rata-rata pada : &nbsp;&nbsp;&nbsp;Hari Biasa</font>&nbsp;&nbsp;&nbsp;<input type="text" name="txtrata2biasa" id="txtrata2biasa" size="5" /></td>
						<td valign="top"><font size="-1">Hari Libur/Minggu</font></td>
						<td valign="top"><input type="text" name="txtrata2libur" id="txtrata2libur" size="5" /></td>
					</tr>
					<tr>
						<td style="padding-left:10px;" valign="top"><font size="-1">5. Jumlah Meja/mesin</font></td>
						<td colspan=3  valign="top"><input type="text" name="txtjmlmejamesin" id="txtjmlmejamesin" size="5" /><font size="-1"> buah (Khusus untuk permainan Bilyard/ Permainan Ketangkasan)</font></td>
					</tr>
					<tr>
						<td style="padding-left:10px;" valign="top"><font size="-1">6. Jumlah Kamar/Ruangan</font></td>
						<td colspan=3  valign="top"><input type="text" name="txtjmlruangan" id="txtjmlruangan" size="5" /><font size="-1"> buah (Khusus Panti Pijat, Mandi Uap/ Karaoke)</font></td>
					</tr>
					<tr>
						<td colspan=3 style="padding-left:10px;" valign="top"><font size="-1">7. Apakah Perusahaan menyediakan karcis bebas(free) kepada orang-orang tertentu </font></td>
						<td valign="top"><input type="radio" name="txtkarcisbebas" id="txtkarcisbebas_ya" value="1" onchange="karcis()"/><font size="-1"> Ya</font><input type="radio" name="txtkarcisbebas" id="txtkarcisbebas_no" value="0" onchange="karcis()"/><font size="-1"> Tidak</font></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top"><font size="-1">Jika YA berapa yang beredar</font></td>
						<td colspan=3  valign="top"><input type="text" name="txtjmlkarcis" id="txtjmlkarcis" size="5" /><font size="-1"></font></td>
					</tr>
					<tr>
						<td colspan=2 style="padding-left:10px;" valign="top"><font size="-1">8. Penjualan karcis dengan mesin tiket </font></td>
						<td colspan=2><input type="radio" name="txtmesintiket" id="txtmesintiket_ya" value="1"/><font size="-1"> Ya</font><input type="radio" name="txtmesintiket" id="txtmesintiket_no" value="0"/><font size="-1"> Tidak</font></td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:10px;" valign="top"><font size="-1">9. Mengadakan Pembukuan/Pencatatan </font>
						<td colspan=2><input type="radio" name="txtpembukuan" id="txtpembukuan_ya" value="1"/><font size="-1"> Ya</font><input type="radio" name="txtpembukuan" id="txtpembukuan_no" value="0"/><font size="-1"> Tidak</font></td>
					</tr>
					<tr>
						<td colspan=4><b><i><u>B. Data Masa Pajak Hiburan (Official Assesment) </u></i></b></td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;a. Masa Pajak</td>
						<td colspan=3><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12" disabled="disabled" readonly />&nbsp; <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12" disabled="disabled" readonly />&nbsp;</td>
					</tr>
					<tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;b. Dasar Pengenaan ( Omset )</td>
						<td colspan=3><input type="text" style="text-align:right" name="txtpajakditerima" id="txtpajakditerima" size="15" /> </td>
					</tr>
                    <tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;c. Tarif</td>
						<td colspan=3><input type="text" style="text-align:right" name="tarif" id="tarif" size="7" disabled="disabled" />
						%</td>
					</tr>
                    <tr>
						<td style="padding-left:15px;" valign="top">&nbsp;&nbsp;d. Pajak Terutang</td>
						<td colspan=3><input type="text" style="text-align:right" name="txtpajakterutang" id="txtpajakterutang" size="15" disabled="disabled" /> </td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="addNew()" name="btnaddnew" id="btnaddnew" style="width:90px;"/>&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpanData()" name="btnsimpan" id="btnsimpan" style="width:90px;" disabled/>&nbsp;&nbsp;<!--<input type="button" value="Edit" onclick="editData()" name="btnedit" id="btnedit" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="Hapus" onclick="deleteData()" name="btndel" id="btndel" style="width:90px;" disabled/>&nbsp;&nbsp;--><input type="button" value="Cetak" onclick="cetak()" name="btncetak" id="btncetak" style="width:90px;" disabled/>&nbsp;&nbsp;<input type="button" value="SPTPD Kosong" onclick="kosong()" name="null" id="null" />
                        </td>
					</tr>
				</table>
			<select name="ctl_req" id="ctl_req" style="visibility:hidden">
			  <option value="txtnosptpd_a">No SPTPD</option>
				<option value="txtnpwpd">NPWPD</option>
				<option value="txttglditerima">Tanggal Diterima</option>
				<option value="txtpajakditerima">Pajak Diterima</option>
			</select>
			
			</form>
<br />
</div>

<!--<div id="C2">
<div style="padding:0 1px 0 0px;">
	<div id="gridContent" height="830px" width="1195px" style="margin-bottom:10px;"></div>
	<div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>-->  

<div id="objHBR" style="display:none;">
<br />
<form name="frmHBR" id="frmHBR" method="post" action="javascript:void(0);">
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
	<div id="gridsHBR" width="750px" height="250px" style="margin-bottom:10px;"></div>
</div>
</div>
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	
	function kosong(){
		window.open('<?php echo site_url(); ?>/hiburan_pdf', '', 'height=700,width=1000,scrollbars=yes');
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
		if(jumlahDP=="0") { return; }
		if(jumlahDP=="") {
			nilai_pot = 0;
			document.frmData.txtpajakditerima.value = 0;
		} else {
			nilai_pot = parseInt(jumlahDP);	
		}
		total = (nilai_pot*document.frmData.tarif.value)/100;
		document.frmData.txtpajakterutang.value = format_number(total);
	}
	
	function tarif() {
		if(document.frmData.txtjenishiburan.value=="") {
			alert("Jenis Hiburan Tidak Boleh Kosong");
			document.frmData.txtjenishiburan.focus();
			return;
		}
			
		var postJns =
			"jns=" + document.frmData.txtjenishiburan.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/sptpd_hiburan/tarif', postJns, respJns);			
	}
	
	function respJns(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					document.frmData.tarif.value = result;
					document.frmData.txtpajakditerima.disabled = false;
				} else {
					alert("Silakan Pilih Jenis Hiburan");
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function cetak() {
		var gabung = document.frmData.txtnosptpd_a.value+'/'+document.frmData.txtnosptpd_b.value;
		window.open('<?php echo site_url(); ?>/sptpd_hiburan/cetak?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function add(){
		var op = document.frmData.txtkelas_a.value;
		var qty = document.frmData.txtrpkelas_a.value;
		var id = gride1.uid();
		var posisi = gride1.getRowsNum();
		// Split Array
		var row1= op;
		var row2= qty;
		var row3= '';
		var row4= '';
		gride1.addRow(id,[row1,row2,row3,row4], posisi);
		gride1.showRow(id);
		//loadtotal();
		document.frmData.txtkelas_a.value="";
		document.frmData.txtrpkelas_a.value="";
		document.frmData.sum.value=1;
	}
	
	function loadtotal() {
		document.frmData.txtpajakditerima.value = document.getElementById('tmpNom').innerHTML;
	}
	
	function krg() {
		ya = confirm("Are You Sure ?");
		if(ya) {
			gride1.deleteSelectedRows();
		}
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
            gride1.cells(id,3).getValue();			                                    
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
		var sptpd = document.frmData.sptpd.value; 
		var row1= arrs[0];
		var row2= arrs[1];
        var row3= sptpd;
        var row4= arrs[3];
		 
        //if(arrs[0] != "") {
            gride1.addRow(id,[row1,row2,row3,row4],posisi);
			//alert('1');
        //}
    }
	
	// Grid Data
	gride1 = new dhtmlXGridObject('gridCos');
	gride1.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gride1.setHeader("Kelas,Nominal,sptpd,id");
	gride1.setInitWidths("70,120,120,80");
	gride1.setColAlign("center,right,left,right");
	gride1.setColTypes("ro,ron,edn,ro");
	gride1.setNumberFormat("0,000",1,",",".");
	gride1.enableMultiselect(true);
	gride1.setColumnHidden(2,true);
	gride1.setColumnHidden(3,true);
	gride1.enableSmartRendering(true);
	gride1.attachFooter("Jumlah,<div style=text-align:right id=tmpNom>{#stat_total}</div>,<div style=text-align:right id=tmpHar>{#stat_total}</div>,<div style=text-align:right id=tmpDp>{#stat_total}</div>");
	gride1.setSkin("dhx_skyblue");
	gride1.init();
	
	var dpps = "";
	function rundpPO(){
		dpps = new dataProcessor("<?php echo site_url(); ?>/sptpd_hiburan/detail");
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
	//tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	//tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	disabledData1();
	
	function jenishiburan() {
		jns = document.frmData.txtjenishiburan.value;
		if(jns==0){
			document.frmData.txtjmlmejamesin.disabled = true;
			document.frmData.txtjmlruangan.disabled = true;
		} else if(jns=='4.1.1.03.10'||jns=='4.1.1.03.15'){
			document.frmData.txtjmlmejamesin.disabled = false;
			document.frmData.txtjmlruangan.disabled = true;
		} else {
			document.frmData.txtjmlmejamesin.disabled = true;
			document.frmData.txtjmlruangan.disabled = false;
		}
		tarif();
	}
	
	function karcis() {
		if(document.frmData.txtkarcisbebas_ya.checked){
			document.frmData.txtjmlkarcis.disabled = false;
		} else {
			document.frmData.txtjmlkarcis.disabled = true;
		}
	}
	
	cal1 = new dhtmlxCalendarObject('txttglditerima');
	cal1.setDateFormat('%d/%m/%Y');
	
	wHBR = dhxWins.createWindow("wHBR",0,0,800,400);
	wHBR.setText("Pencarian Data Perusahaan");
	wHBR.button("park").hide();
	wHBR.button("close").hide();
	wHBR.button("minmax1").hide();
	wHBR.hide();

	function getDataNPWPD() {
		wHBR.show();
    	//wHBR.setModal(true);
		wHBR.center();
		wHBR.attachObject('objHBR');
	}
	
	function batal() {
		wHBR.hide();
		wHBR.setModal(false);
		document.frmHBR.fil.value = "0";
		document.frmHBR.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmHBR.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmHBR.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmHBR.values.focus();
			return;
			}
		}
		nilai = document.frmHBR.values.value;
		gridHBR.clearAll();
		gridHBR.loadXML("<?php echo site_url(); ?>/sptpd_hiburan/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridHBR= new dhtmlXGridObject('gridsHBR');
	gridHBR.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridHBR.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar");

	gridHBR.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridHBR.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridHBR.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridHBR.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridHBR.setSkin("dhx_skyblue");
	gridHBR.setColumnHidden(0,true);
	gridHBR.attachEvent("onRowDblClicked", selectedOpenData2);
	gridHBR.init();
	
	function selectedOpenData2(id) {
		document.frmData.txtnpwpd.value 	= gridHBR.cells(id,1).getValue();
		document.frmData.txtnpwpd_nama.value	= gridHBR.cells(id,2).getValue();
		document.frmData.txtnpwpd_alamat.value  = gridHBR.cells(id,3).getValue();
		batal();
		enableData1();
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_sptpd, npwpd, nama_perusahaan, alamat, jenis_pajak, ket_insidentil, cara_hitung, tgl_diterima, jenis_hiburan, jml_biasa, jml_libur, rata2_biasa, rata2_libur, jml_meja_mesin, jml_ruangan, karcis_bebas, jml_karcis, mesin_tiket, pembukuan, masa_pajak1, masa_pajak2, jml_bayar, author, created, modified, petugas_input,omset, tarif",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	//grid.attachHeader("#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,150,150,170,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,right,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.setSkin("dhx_skyblue");
	grid.enableSmartRendering(true);
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/sptpd_hiburan/data_bank");
	grid.init();
	
	
	function selectedOpenData(id) {
		kosongfrmData1();
		document.frmData.id.value = grid.cells(id,0).getValue();
		document.frmData.txtnpwpd.value = grid.cells(id,2).getValue();
		//getKelas(grid.cells(id,2).getValue());
		document.frmData.sptpd.value = grid.cells(id,1).getValue();
		var gabung = grid.cells(id,1).getValue().split('/');
		document.frmData.txtnosptpd_a.value = gabung[0];
		document.frmData.txtnosptpd_b.value = gabung[1]+'/'+gabung[2];
		document.frmData.txtnpwpd_nama.value = grid.cells(id,3).getValue();
		document.frmData.txtnpwpd_alamat.value = grid.cells(id,4).getValue();
		//document.frmData.txtjenispajakhiburan.value = grid.cells(id,5).getValue();
		
		if(grid.cells(id,5).getValue() == 'REGULAR') {
			document.frmData.SPTR.checked = true;
		} else if(grid.cells(id,5).getValue()=='INSIDENTIL') {
			document.frmData.SPTI.checked = true;
		} else if(grid.cells(id,5).getValue()=='TUNGGAKAN') {
			document.frmData.SPTT.checked = true;
		}
		//setRadioChecked(document.frmData.txtjenispajakhiburan, grid.cells(id,5).getValue(),0);
		document.frmData.txtketinsidentil.value = grid.cells(id,6).getValue();
		document.frmData.txtcarahitung.value = grid.cells(id,7).getValue();
		document.frmData.txttglditerima.value = konversiTgl(grid.cells(id,8).getValue());
		document.frmData.txtjenishiburan.value = grid.cells(id,9).getValue();
		document.frmData.txtjmlbiasa.value = grid.cells(id,10).getValue();
		document.frmData.txtjmllibur.value = grid.cells(id,11).getValue();
		document.frmData.txtrata2biasa.value = grid.cells(id,12).getValue();
		document.frmData.txtrata2libur.value = grid.cells(id,13).getValue();
		document.frmData.txtjmlmejamesin.value = grid.cells(id,14).getValue();
		document.frmData.txtjmlruangan.value = grid.cells(id,15).getValue();
		if(grid.cells(id,16).getValue() == '1') {
			document.frmData.txtkarcisbebas_ya.checked = true;
		}else{
			document.frmData.txtkarcisbebas_no.checked = true;
		}
		
		document.frmData.txtjmlkarcis.value = grid.cells(id,17).getValue();
		if(grid.cells(id,18).getValue() == '1') {
			document.frmData.txtmesintiket_ya.checked = true;
		}else{
			document.frmData.txtmesintiket_no.checked = true;
		}
		if(grid.cells(id,19).getValue() == '1') {
			document.frmData.txtpembukuan_ya.checked = true;
		}else{
			document.frmData.txtpembukuan_no.checked = true;
		}
		
		document.frmData.txttglmasapajak1.value = konversiTgl(grid.cells(id,20).getValue());
		document.frmData.txttglmasapajak2.value = konversiTgl(grid.cells(id,21).getValue());
				
		document.frmData.txtthnmasapajak.value = getTgl(grid.cells(id,20).getValue(), "THN");
		document.frmData.txtblnmasapajak1.value = getTgl(grid.cells(id,20).getValue(), "BLN");
		document.frmData.txtblnmasapajak2.value = getTgl(grid.cells(id,21).getValue(), "BLN");
		
		document.frmData.txtpajakditerima.value = format_number(grid.cells(id,27).getValue());
		document.frmData.txtpajakterutang.value = format_number(grid.cells(id,22).getValue());
		document.frmData.petugas.value = grid.cells(id,26).getValue();
		document.frmData.tarif.value = grid.cells(id,28).getValue();
		tabbar.setTabActive("a1");
		var sptpd = grid.cells(id,1).getValue();
		gride1.clearAll();
		gride1.loadXML("<?php echo site_url(); ?>/sptpd_hiburan/de_data?sptpd="+sptpd);
		statusLoading();
		
		statusEnding();
		//postStr="id=" + grid.cells(id,2).getValue();
		//dhtmlxAjax.post(iGetKelasClass, postStr, responePOST2);

		document.frmData.btnaddnew.disabled=true;
		document.frmData.btnsimpan.disabled=true;
		/*document.frmData.btnedit.disabled=false;
		document.frmData.btndel.disabled=false;*/
		document.frmData.btncetak.disabled=false;
	}

	function addNew() {
		document.frmData.tambah.disabled=false;
		document.frmData.hapus.disabled=false;
		document.frmData.txtblnmasapajak1.disabled = false;
		document.frmData.txtblnmasapajak2.disabled = false;
		document.frmData.txtthnmasapajak.disabled = false;
		document.frmData.btnaddnew.disabled=false;
		document.frmData.btnsimpan.disabled=false;
		/*document.frmData.btnedit.disabled=true;
		document.frmData.btndel.disabled=true;*/
		document.frmData.btncetak.disabled=true;
		document.frmData.txtnpwpd.disabled=false;
		document.frmData.btncarinpwpd.disabled=false;
		kosongfrmData1();
		gride1.clearAll();
		document.getElementById('tmpNom').value = "";
		document.getElementById('tmpHar').value = "";
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
				document.frmData.tambah.disabled = false;
				document.frmData.hapus.disabled = false;
				document.frmData.txtpajakditerima.disabled=false;
				document.frmData.sum.value=1;
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
		document.frmData.SPTR.disabled=false;
		document.frmData.SPTI.disabled=false;
		document.frmData.SPTT.disabled=false;
		document.frmData.txtketinsidentil.disabled=false;
		document.frmData.txtnpwpd_nama.disabled=false;
		document.frmData.txtnpwpd_alamat.disabled=false;
		document.frmData.txtcarahitung.disabled=false;
		document.frmData.txttglditerima.disabled=false;
		document.frmData.petugas.disabled=false;
		document.frmData.txtjenishiburan.disabled = false;
		document.frmData.txtkelas_a.disabled = false;
		document.frmData.txtrpkelas_a.disabled = false;
		document.frmData.txtjmlbiasa.disabled = false;
		document.frmData.txtjmllibur.disabled = false;
		document.frmData.txtrata2biasa.disabled = false;
		document.frmData.txtrata2libur.disabled = false;
		document.frmData.txtkarcisbebas_ya.disabled = false;
		document.frmData.txtkarcisbebas_no.disabled = false;
		document.frmData.txtmesintiket_ya.disabled = false;
		document.frmData.txtmesintiket_no.disabled = false;
		document.frmData.txtpembukuan_ya.disabled = false;
		document.frmData.txtpembukuan_no.disabled = false;
		document.frmData.txttglmasapajak1.readonly=true;
		document.frmData.txttglmasapajak2.readonly=true;
		//document.frmData.txtpajakditerima.disabled=false;
	}
	
	function disabledData1(){
		document.frmData.txtnosptpd_a.readonly=true;
		document.frmData.txtnosptpd_b.readonly=true;
		document.frmData.txtblnmasapajak1.disabled=true;
		document.frmData.txtblnmasapajak2.disabled=true;
		document.frmData.txtthnmasapajak.disabled=true;
		document.frmData.SPTR.disabled=true;
		document.frmData.SPTI.disabled=true;
		document.frmData.SPTT.disabled=true;
		document.frmData.txtjmlmejamesin.disabled = true;
		document.frmData.txtjmlruangan.disabled = true;
		document.frmData.txtketinsidentil.disabled=true;
		document.frmData.txtnpwpd.disabled=true;
		document.frmData.btncarinpwpd.disabled=true;
		document.frmData.txtnpwpd_nama.disabled=true;
		document.frmData.txtnpwpd_alamat.disabled=true;
		document.frmData.txtcarahitung.disabled=true;
		document.frmData.txttglditerima.disabled=true;
		document.frmData.petugas.disabled=true;
		document.frmData.txtjenishiburan.disabled = true;
		document.frmData.txtkelas_a.disabled = true;
		document.frmData.txtrpkelas_a.disabled = true;
		document.frmData.txtjmlbiasa.disabled = true;
		document.frmData.txtjmllibur.disabled = true;
		document.frmData.txtrata2biasa.disabled = true;
		document.frmData.txtrata2libur.disabled = true;
		document.frmData.txtjmlkarcis.disabled = true;
		document.frmData.txtkarcisbebas_ya.disabled = true;
		document.frmData.txtkarcisbebas_no.disabled = true;
		document.frmData.txtmesintiket_ya.disabled = true;
		document.frmData.txtmesintiket_no.disabled = true;
		document.frmData.txtpembukuan_ya.disabled = true;
		document.frmData.txtpembukuan_no.disabled = true;
		document.frmData.txttglmasapajak1.readonly=true;
		document.frmData.txttglmasapajak2.readonly=true;
		document.frmData.txtpajakditerima.disabled=true;
		
	}

	function kosongfrmData1(){
		document.frmData.id.value='';
		document.frmData.txtnosptpd_a.value='';
		document.frmData.txtnosptpd_b.value='';
		document.frmData.txtblnmasapajak1.value='';
		document.frmData.txtblnmasapajak2.value='';
		document.frmData.txtthnmasapajak.value='';
		document.frmData.SPTR.checked = false;
		document.frmData.SPTI.checked = false;
		document.frmData.SPTT.checked = false;
		document.frmData.txtketinsidentil.value='';
		document.frmData.txtnpwpd.value='';
		document.frmData.txtnpwpd_nama.value='';
		document.frmData.txtnpwpd_alamat.value='';
		document.frmData.txtcarahitung.value='';
		document.frmData.txttglditerima.value='';
		document.frmData.petugas.value='';
		document.frmData.txtjenishiburan.value = '';
		document.frmData.txtkelas_a.value = '';
		document.frmData.txtrpkelas_a.value = '';
		document.frmData.txtjmlbiasa.value = '';
		document.frmData.txtjmllibur.value = '';
		document.frmData.txtrata2biasa.value = '';
		document.frmData.txtrata2libur.value = '';
		document.frmData.txtjmlmejamesin.value = '';
		document.frmData.txtjmlruangan.value = '';
		document.frmData.txtkarcisbebas_ya.checked = false;
		document.frmData.txtkarcisbebas_no.checked = false;
		document.frmData.txtjmlkarcis.value = '';
		document.frmData.txtmesintiket_ya.checked = false;
		document.frmData.txtmesintiket_no.checked = false;
		document.frmData.txtpembukuan_ya.checked = false;
		document.frmData.txtpembukuan_no.checked = false;
		document.frmData.txttglmasapajak1.value='';
		document.frmData.txttglmasapajak2.value='';
		document.frmData.txtpajakditerima.value=0;
		document.frmData.tarif.value='';
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
		
		if(document.frmData.sum.value==""){
			alert("Harga Tanda Masuk Tidak Boleh Kosong");
			//document.frmData.sum.focus();
			return;
		}
		
		jml_bayar2 = ($('#txtpajakditerima').unmask());		
		/*if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmData.txtpajakditerima.focus();
			return;
		}*/
		
		if(document.frmData.txtnosptpd_a.value==""){
			cek();
		} else {
			simpan2();
		}
	}
	
	function cek(){
		var postCek =
			"npwpd=" + document.frmData.txtnpwpd.value +
			"&awal=" + document.frmData.txttglmasapajak1.value +
			"&akhir=" + document.frmData.txttglmasapajak2.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/sptpd_hiburan/ricek', postCek, resPOST);
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
		rundpPO();
		var postStr = "id=" + document.frmData.id.value;
		postStr = postStr + "&txtthnmasapajak"  + "=" + document.getElementById("txtthnmasapajak").value;
		postStr = postStr + "&txtblnmasapajak1"  + "=" + document.getElementById("txtblnmasapajak1").value;
		postStr = postStr + "&txtblnmasapajak2"  + "=" + document.getElementById("txtblnmasapajak2").value;
		postStr = postStr + "&txttglmasapajak1"  + "=" + document.getElementById("txttglmasapajak1").value;
		postStr = postStr + "&txttglmasapajak2"  + "=" + document.getElementById("txttglmasapajak2").value;
		
		if(document.frmData.jnsSPT.checked==false) {
			alert("Jenis SPT Tidak Boleh Kosong");
			document.frmData.jnsSPT.focus();
			return;
		}
		
		if(document.frmData.SPTR.checked==true) {
			jnsSPT = "REGULAR";
		}
		if(document.frmData.SPTI.checked==true) {
			jnsSPT = "INSIDENTIL";
		}
		if(document.frmData.SPTT.checked==true) {
			jnsSPT = "TUNGGAKAN";
		}
		
		postStr = postStr + "&sptpd"  + "=" + document.frmData.sptpd.value;
		
		postStr = postStr + "&txtjenispajakhiburan"  + "=" + jnsSPT;
		postStr = postStr + "&txtketinsidentil"  + "=" + document.frmData.txtketinsidentil.value;
		postStr = postStr + "&txtnpwpd"  + "=" + document.frmData.txtnpwpd.value;
		postStr = postStr + "&txtnpwpd_nama"  + "=" + document.frmData.txtnpwpd_nama.value;
		postStr = postStr + "&txtnpwpd_alamat"  + "=" + document.frmData.txtnpwpd_alamat.value;
		postStr = postStr + "&txtcarahitung"  + "=" + document.frmData.txtcarahitung.value;
		postStr = postStr + "&txttglditerima"  + "=" + document.frmData.txttglditerima.value;
		postStr = postStr + "&txtpetugasinput"  + "=" + document.frmData.petugas.value;
		postStr = postStr + "&txtjenishiburan"  + "=" + document.frmData.txtjenishiburan.value ;
		postStr = postStr + "&txtkelas_a"  + "=" + document.frmData.txtkelas_a.value ;
		postStr = postStr + "&txtrpkelas_a"  + "=" + document.frmData.txtrpkelas_a.value ;
		postStr = postStr + "&txtjmlbiasa"  + "=" + document.frmData.txtjmlbiasa.value ;
		postStr = postStr + "&txtjmllibur"  + "=" + document.frmData.txtjmllibur.value ;
		postStr = postStr + "&txtrata2biasa"  + "=" + document.frmData.txtrata2biasa.value ;
		postStr = postStr + "&txtrata2libur"  + "=" + document.frmData.txtrata2libur.value ;
		postStr = postStr + "&txtjmlmejamesin"  + "=" + document.frmData.txtjmlmejamesin.value ;
		postStr = postStr + "&txtjmlruangan"  + "=" + document.frmData.txtjmlruangan.value ;
		karcisBebas="0";
		if(document.frmData.txtkarcisbebas_ya.checked){
			karcisBebas="1";
		}
		postStr = postStr + "&txtkarcisbebas"  + "=" + karcisBebas ;
		postStr = postStr + "&txtjmlkarcis"  + "=" + document.frmData.txtjmlkarcis.value ;
		mesinTiket="0";
		if(document.frmData.txtmesintiket_ya.checked){
			mesinTiket="1";
		}
		postStr = postStr + "&txtmesintiket"  + "=" + mesinTiket ;
		pembukuan="0";
		if(document.frmData.txtpembukuan_ya.checked){
			pembukuan="1";
		}
		
		postStr = postStr + "&txtpembukuan"  + "=" + pembukuan ;
		postStr = postStr + "&txttglmasapajak1"  + "=" + document.frmData.txttglmasapajak1.value;
		postStr = postStr + "&txttglmasapajak2"  + "=" + document.frmData.txttglmasapajak2.value;
		postStr = postStr + "&txtpajakditerima"  + "=" + document.frmData.txtpajakditerima.value;
		postStr = postStr + "&tarif"  + "=" + document.frmData.tarif.value;
		postStr = postStr + "&txtpajakterutang"  + "=" + document.frmData.txtpajakterutang.value;
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
				cnf = confirm("Apakah Anda Yakin ?")
				if(cnf) {
					var postStr =
						"sptpd_1=" + document.frmData.txtnosptpd_a.value +
						"&sptpd_2=" + document.frmData.txtnosptpd_b.value;
						statusLoading(iBaseUrl);
					dhtmlxAjax.post(iDelClass, postStr, responePOST1);
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
					no = result.split('/');
					document.frmData.txtnosptpd_a.value = no[0];
					document.frmData.txtnosptpd_b.value = no[1]+'/'+no[2];
					document.frmData.sptpd.value = result;
					tmpRows();
					//refreshData();
					statusEnding();
					alert('Done');
					return true;	
				}
			} else {
				alert(loader.xmlDoc.responseText);
				//alert('There was a problem with the request.');
			}
		}
	}
	
	function responePOST1(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					refreshData();
					statusEnding();
					alert('Done');
					return true;	
				}
			} else {
				alert(loader.xmlDoc.responseText);
				//alert('There was a problem with the request.');
			}
		}
	}
	
	function tbl_child(){
		document.getElementById('tmpNom').value='';
		document.getElementById('tmpHar').value='';
		document.getElementById('tmpDp').value='';
	}

	function responePOST2(loader) {
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