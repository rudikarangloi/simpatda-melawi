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

<div style="height:100%; overflow:auto;">
  <script language="javascript">
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function lihat() {
		if(document.frmSKPD.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmSKPD.npwpd.focus();
			return;
		}
		
		var postStr =
		"npwpd=" + document.frmSKPD.npwpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/hotel/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSKPD.nama_perusahaan.value = arr[0];
					document.frmSKPD.alamat_perusahaan.value = arr[1];
					disableData();
				} else {
					alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function simpan() {
		if(document.frmSKPD.skpd_1.value=="") {
			document.frmSKPD.ttd_skpd.focus();
			alert("Nomor Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPD.tgl.value=="") {
			document.frmSKPD.tgl.focus();
			alert("Tanggal Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPD.ttd_skpd.value=="") {
			document.frmSKPD.ttd_skpd.focus();
			alert("Tanda Tangan Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSKPD.tgl_jth_tempo.value=="") {
			document.frmSKPD.tgl_jth_tempo.focus();
			alert("Tanggal Jatuh Tempo Tidak Boleh Kosong");
			return;
		}
					
		arrTgl = document.frmSKPD.tgl_jth_tempo.value.split("/");
		tgl_jth_tempo = arrTgl[2]+"-"+arrTgl[1]+"-"+arrTgl[0];
		
		arrTgl_1 = document.frmSKPD.tgl.value.split("/");
		tgl = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		//ms1
		t4 = document.frmSKPD.ket_ms1.value;
		s4 = t4.split("/");
		tgl_masa1 = s4[2]+'-'+s4[1]+'-'+s4[0];
		
		//ms2
		t5 = document.frmSKPD.ket_ms2.value;
		s5 = t5.split("/");
		tgl_masa2 = s5[2]+'-'+s5[1]+'-'+s5[0];	
		alert(tgl_masa1);
		alert(tgl_masa1);
		var postStr =
			"skpd_1=" + document.frmSKPD.skpd_1.value +
			"&npwpd=" + document.frmSKPD.npwpd.value +
			"&nama=" + document.frmSKPD.nama.value +
			"&alamat=" + document.frmSKPD.alamat.value +
			"&ttdid=" + document.frmSKPD.ttd_skpd.value +
			"&nm_pemilik=" + document.frmSKPD.nm_pemilik.value +
			"&awal=" + document.frmSKPD.awal.value +
			"&akhir=" + document.frmSKPD.akhir.value +
			"&tahun=" + document.frmSKPD.tahun.value +		
			"&ket_skpd=" + document.frmSKPD.ket_skpd.value +
			"&tgl_jth_tempo=" + tgl_jth_tempo +
			"&tgl=" + tgl +
			"&tg_masa1=" + tgl_masa1 +
			"&tg_masa2=" + tgl_masa2 +
			"&no_kohir=" + document.frmSKPD.no_kohir.value +
			"&gol=" + document.frmSKPD.gol.value +
			"&no_sptpd=" + document.frmSKPD.no_sptpd.value +
			"&jml=" + document.frmSKPD.txtjml.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpd/simpanSkpdLalu', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			arr = result.split("/");
			loadData();
			//tmpRows();
			disableData();
			statusEnding();
			alert("Berhasil");
		});
	}
	
	// get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows() {
		//alert('ok');
        var arr = gridData.getAllItemIds().split(',');
        for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gridData.cells(id,0).getValue()+'|'+
            gridData.cells(id,1).getValue()+'|'+
            gridData.cells(id,2).getValue()+'|'+
            gridData.cells(id,3).getValue()+'|'+
            gridData.cells(id,4).getValue()+'|'+
            gridData.cells(id,5).getValue()+'|'+
            gridData.cells(id,6).getValue()+'|'+
            gridData.cells(id,7).getValue()+'|'+
            gridData.cells(id,8).getValue()+'|'+
            gridData.cells(id,9).getValue();			                                   
        }
		
		gridData.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
        }
        
		r = new Array();
        dppa.sendData();  
    }
	
	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gridData.uid();
        var posisi = gridData.getRowsNum();
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
		var row10= document.frmSKPD.skpd.value;
        //if(arrs[0] != "") {
            gridData.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
			//alert('1');
        //}
    }
	
	function hapus() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				cnf = confirm("Apakah Anda Yakin ?")
				if(cnf) {
					var postStr =
						"&skpd_1=" + document.frmSKPD.skpd_1.value 
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/skpd/hapusLalu', postStr, responeDel);	
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
					gridData.clearAll();
					loadData();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function disableData() {
		document.frmSKPD.skpd_1.disabled = true;
		document.frmSKPD.npwpd.disabled = true;
		document.frmSKPD.nama.disabled = true;
		document.frmSKPD.alamat.disabled = true;
		document.frmSKPD.ttd_skpd.disabled = true;
		document.frmSKPD.nm_pemilik.disabled = true;
		document.frmSKPD.awal.disabled = true;
		document.frmSKPD.akhir.disabled = true;
		document.frmSKPD.tahun.disabled = true;
		document.frmSKPD.tgl_jth_tempo.disabled = true;
		document.frmSKPD.tgl.disabled = true;
		document.frmSKPD.no_sptpd.disabled = true;
		document.frmSKPD.no_kohir.disabled = true;
		document.frmSKPD.txtjml.disabled = true;
		document.frmSKPD.btnCari.disabled = true;
	}
	
	function enableData() {
		document.frmSKPD.skpd_1.disabled = false;
		document.frmSKPD.npwpd.disabled = false;
		document.frmSKPD.nama.disabled = false;
		document.frmSKPD.alamat.disabled = false;
		document.frmSKPD.ttd_skpd.disabled = false;
		document.frmSKPD.nm_pemilik.disabled = false;
		document.frmSKPD.awal.disabled = false;
		document.frmSKPD.akhir.disabled = false;
		document.frmSKPD.tahun.disabled = false;
		document.frmSKPD.tgl_jth_tempo.disabled = false;
		document.frmSKPD.tgl.disabled = false;
		document.frmSKPD.no_sptpd.disabled = false;
		document.frmSKPD.no_kohir.disabled = false;
		document.frmSKPD.txtjml.disabled = false;
		document.frmSKPD.btnCari.disabled = false;
	}
	
	function bersih() {
		document.frmSKPD.skpd_1.value = "";
		document.frmSKPD.npwpd.value = "";
		document.frmSKPD.nama.value = "";
		document.frmSKPD.alamat.value = "";
		document.frmSKPD.nm_pemilik.value = "";
		document.frmSKPD.awal.value = "";
		document.frmSKPD.akhir.value = "";
		document.frmSKPD.tahun.value = "";
		document.frmSKPD.ttd_skpd.value = "";
		document.frmSKPD.tgl_jth_tempo.value = "";
		document.frmSKPD.tgl.value = "";
		document.frmSKPD.no_kohir.value = "";
		document.frmSKPD.txtjml.value = "";
	}
	
	function newEntry() {
		enableData();
		bersih();
		document.frmSKPD.btnTambah.disabled = false;
		//document.frmSKPD.ubahkel.disabled = true;
		gridData.clearAll();
		document.frmSrc5.kataKunci.value=0;
		cariSKPD();
		document.frmSKPD.skpd_1.focus();
	}
	
	function getLastDate(){		
		var iThnVal		= document.frmSKPD.tahun.value;
		var iBln1Val	= document.frmSKPD.awal.value;		
		var iBln2Val	= document.frmSKPD.akhir.value;
			
		if(iBln2Val<iBln1Val){
			iBln2Val = iBln1Val;
			document.frmSKPD.akhir.value=iBln2Val;
		}
			
		var lastDate = new Date(iThnVal, iBln2Val, 0);
		var lastDateDay = lastDate.getDate();
			
		document.frmSKPD.ket_ms1.value = '01/' + iBln1Val + '/' + iThnVal;
		document.frmSKPD.ket_ms2.value = lastDateDay + '/' + iBln2Val + '/' + iThnVal;	
	}
	
</script>
<style>
body{
	background:#FFF;
}
</style>
  <h2 style="margin:30px 5px 25px 30px;">SKP</h2>
  <div id="a_tabbar" style="width:1000px; height:610px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPD" id="frmSKPD" action="<?php echo site_url(); ?>/skpd/cetak" method="post" onsubmit="popupform(this, 'skpd')" ><input name="skpd" type="hidden" id="skpd" size="8" /><br />
     <table width="888" cellspacing="0">
        <tr>
          <td style="padding-left:15px;">No. SKP</td>
          <td><input name="skpd_1" type="text" id="skpd_1" size="30" disabled="disabled" style="background-color:#FFFFCC;"  />
            
              <input type="hidden" name="id" id="id" size="35" /></td>
          <td width="138"><div align="right">Tanggal SKP</div></td>
          <td width="176"><input name="tgl" type="text" id="tgl" size="15" disabled="disabled" /></td>
        </tr>
        <tr>
          <td style="padding-left:15px;">NPWPD</td>
          <td width="316"><input type="text" size="32" name="npwpd" id="npwpd" style="text-transform:uppercase; background-color: #FFCC99;" disabled="disabled"/>
              <input name="btnCari" type="button" id="btnCari" style="padding-left:20px; padding-right:20px" onclick="showWinBrg()" value="Cari" /></td>
          <td><div align="right">No.SPTPD</div></td>
          <td><input type="text" name="no_sptpd" id="no_sptpd" disabled="disabled" /></td>
        </tr>
        <tr>
          <td width="238" style="padding-left:15px;"></td>
          <td></td>
          <td align="right">No. Kohir</td>
          <td><input type="text" name="no_kohir" id="no_kohir"  /></td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Nama Usaha</td>
          <td><input type="text" name="nama" id="nama" readonly="readonly" disabled="disabled" size="45" /></td>
          <td colspan="2" valign="top"><br /></td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Alamat</td>
          <td><input name="alamat" type="text" id="alamat" size="45" readonly="readonly" disabled="disabled" /></td>
          <td align="right">Tanda Tangan</td>
          <td>
			<select id="ttd_skpd" name="ttd_skpd">
                                	<option value=""></option>
                                    <?php 
									foreach($nama_ttd->result() as $rs) {
											echo "<option value=".$rs->id.">".$rs->nama_ttd."</option>";
										}
									?>
            </select>     
		  </td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Nama Pemilik</td>
          <td ><input type="text" name="nm_pemilik" id="nm_pemilik" disabled="disabled" size="45" /></td>
          <td colspan="1" valign="top"></td>
          <td colspan="1" valign="top">Keterangan</td>
        </tr>
        
        <tr>
          <td style="padding-left:15px;">Masa Pajak</td>
          <td colspan="2"><select name="awal" id="awal" onchange="getLastDate()" >
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
            s/d&nbsp;
            <select name="akhir" id="akhir" onchange="getLastDate()" >
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
            Tahun
            <select name="tahun" id="tahun" onchange="getLastDate()">
              <?php echo $tahun; ?>
            </select>		
			</td>
			<td rowspan="3"><textarea name="ket_skpd" id="ket_skpd" cols="25" rows="4"></textarea></td>
        </tr>
		<tr>
          <td style="padding-left:15px;">Keterangan Masa Pajak<br /></td>
          <td><input name="ket_ms1" type="text" id="ket_ms1" size="12"  /> s/d <input name="ket_ms2" type="text" id="ket_ms2" size="12"/></td>
          <td style="padding-left:15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
          <td colspan="2"><input name="tgl_jth_tempo" type="text" id="tgl_jth_tempo" size="15"  />
              </td>
        </tr>
		<tr>
           <td style="padding-left:15px;">Jenis Pajak </td>
            <td colspan="2"><select name="gol" id="gol">
            <option value=""></option>
            <?php 
			foreach($gresto->result() as $rs) {
					echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
				}
			?>
             </select></td>
         </tr>
        <tr>
          <td style="padding-left:15px;">Jumlah </td>
		  <td colspan="2"><input type="text" name="txtjml" id="txtjml" style="text-align:right;"  /></td>
        </tr>
        <tr>
          <td colspan="4" style="padding-left:15px; background-color:#FFCC99;"><input type="button" name="button" id="button" value="Baru" onclick="newEntry();" style="width:90px;" />
              <input type="button" value="Simpan" onclick="simpan()" name="btnTambah" disabled="disabled" style="width:90px;" />
              <!--<input type="button" value="Edit" onclick="edit()" name="btnEdit" disabled="disabled" style="width:90px;" />-->
              <input type="button" value="Hapus" onclick="hapus()" name="btnDel" id="btnDel" disabled="disabled" style="width:90px;"/>
              <!--<input type="button" value="UBAH KELURAHAN" name="ubahkel" id="ubahkel" disabled="disabled" onclick="ubahKel()" />-->
          <input type="button" value="Cetak" name="cetak" id="cetak" disabled="disabled" onclick="cet()" style="width:90px;"/>          </td>
        </tr>
      </table>
    </form>
    <br />
  </div>
  
 <div id="C2" style="background-color: #B3D9F0">
  <div id="tmpGrid" width="995px" height="470px" style="background-color:white;"></div>
  <div id="pagingArea" width="350px" style="background-color:white;"></div>
  </div>
  
  <div id="objSKPD" style="display:none;">
<form name="frmSrc5" id="frmSrc5" method="post" action="javascript:void(0);">
<br /><table width="790" border="0">
	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="parameter" id="parameter" >
        	<option value="1">No. NPWPD</option>
            <option value="2">Nama Usaha</option>
            <option value="3">Alamat Usaha</option>
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
  <script language="javascript">
  	function edit(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				document.frmSKPD.button.disabled = false;
				document.frmSKPD.btnTambah.disabled = false;
				//document.frmSKPD.ubahkel.disabled = false;
				document.frmSKPD.tgl_jth_tempo.disabled = false;
				document.frmSKPD.tgl.disabled = false;
				document.frmSKPD.ttd_skpd.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('tgl_jth_tempo');
	cal2.setDateFormat('%d/%m/%Y');
  	
	function ubahKel(){
		var npwpd = "";			
		npwpd = document.frmSKPD.npwpd.value;
		var win = window.open('../../../../pendataan/ubah_kelurahan/ubah_kelurahan.php?npwpd='+npwpd,'_blank');
		win.focus();
	}
	
  	function cet(){
		var gabung = document.frmSKPD.skpd_1.value+'/'+document.frmSKPD.skpd_2.value;
		window.open('<?php echo site_url(); ?>/skpd/cetak?skpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");

	function enabledButton(){
		document.frmSKPD.button.disabled = true;
		document.frmSKPD.btnTambah.disabled = false;
		//document.frmSKPD.ubahkel.disabled = false;
		//document.frmSKPD.btnEdit.disabled = false;
		document.frmSKPD.btnDel.disabled = false;
		document.frmSKPD.cetak.disabled = false;
	}
	
	wSKPD = dhxWins.createWindow("wSKPD",0,0,810,430);
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
		//document.frmSKPD.nmbarang.focus();
	}

	function closeSKPD() {
		wSKPD.hide();
		wSKPD.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("NPWPD,Nama Usaha,Alamat Usaha,Pemilik");
	gridWP.setInitWidths("120,200,200,180,180");
	gridWP.setColAlign("left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmSKPD.npwpd.value = gridWP.cells(id,0).getValue();
		document.frmSKPD.nama.value = gridWP.cells(id,1).getValue();
		document.frmSKPD.alamat.value = gridWP.cells(id,2).getValue();
		document.frmSKPD.nm_pemilik.value = gridWP.cells(id,3).getValue();
		//loadTgl();
		//loadItem();
		closeSKPD();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	//gridWP.loadXML(base_url+"index.php/skpd/cData?kode="+document.frmSKPD.kode_sptpd.value);
	
	function cariSKPD() {
		if(document.frmSrc5.kataKunci.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc5.kataKunci.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/skpd/cariDataWP/"+kata_kunci+"/"+document.frmSrc5.parameter.value,function() {  statusEnding(); });
	}
	
	function batal() {
		wBrg.hide();
		wBrg.setModal(false);
		document.frmSrc5.parameter.value = "0";
		document.frmSrc5.kataKunci.value = "";
		//grids.clearAll();
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
	
	
	
	/*function loadTgl(){
		var poStr =
		"tempo=" + document.frmSKPD.tgl_jth_tempo.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skpd/cektempo', poStr, respeP);			
	}
	
	function respeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSKPD.tgl.value = arr[0];
					document.frmSKPD.tgl_jth_tempo.value = arr[1];
				}
			}
		}
	}*/
	
	//loadData();
	
	function loadItemPajak() {
		gridData.clearAll();
		statusLoading();
		gridData.loadXML(base_url+"index.php/skpd/dataItemPajak?skpd="+document.frmSKPD.skpd.value,function() { statusEnding(); });
	}
	/*
	function loadItem(){
		b = document.frmSKPD.nota_hitung.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gridData.clearAll();
		gridData.loadXML(base_url+"index.php/skpd/dataItemPajak1/"+pasang,function() { statusEnding(); });			
	}
	*/
	// Wajib Pajak
	grid = new dhtmlXGridObject('tmpGrid');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("No.SKPD,Tanggal,Nama Usaha,Alamat Usaha,Nama Pemilik,NPWPD,Total,Bln Awal,Bln Akhir,Tahun,Tgl Tempo,NO.SPTPD,Nota Hitung,No Kohir,ID_ttd,ms1,ms2,ket");
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("left,left,left,left,left,left,right,right,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setNumberFormat("0,000",7,",",".");
	grid.enablePaging(true,5,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.enableMultiselect(true);
	grid.enableSmartRendering(true);
	grid.attachEvent("onRowDblClicked", function(id) {
		disableData();
		tabbar.setTabActive("a1");
		set = grid.cells(id,0).getValue();
		arr = set.split("/");
		document.frmSKPD.skpd_1.value = grid.cells(id,0).getValue();
		document.frmSKPD.skpd_1.value = arr[0];
		document.frmSKPD.npwpd.value = grid.cells(id,5).getValue();
		document.frmSKPD.no_sptpd.value = grid.cells(id,11).getValue();
		document.frmSKPD.nama.value = grid.cells(id,2).getValue();
		document.frmSKPD.alamat.value = grid.cells(id,3).getValue();
		document.frmSKPD.nm_pemilik.value = grid.cells(id,4).getValue();
		document.frmSKPD.awal.value = grid.cells(id,7).getValue();
		document.frmSKPD.akhir.value = grid.cells(id,8).getValue();
		document.frmSKPD.tahun.value = grid.cells(id,9).getValue();
		document.frmSKPD.tgl_jth_tempo.value = grid.cells(id,10).getValue();
		document.frmSKPD.tgl.value = grid.cells(id,1).getValue();
		document.frmSKPD.txtjml.value = format_number(grid.cells(id,6).getValue());
		document.frmSKPD.txtjml.value = grid.cells(id,6).getValue();
		document.frmSKPD.no_kohir.value = grid.cells(id,13).getValue();
		document.frmSKPD.ttd_skpd.value = grid.cells(id,14).getValue();
		document.frmSKPD.ket_ms1.value = grid.cells(id,15).getValue();
		document.frmSKPD.ket_ms2.value = grid.cells(id,16).getValue();
		document.frmSKPD.ket_skpd.value = grid.cells(id,17).getValue();
		enabledButton();
	});
	grid.init();
	grid.setSkin("dhx_skyblue");
	
	loadData();
	
	function loadData() {
		grid.clearAll();
		grid.loadXML(base_url+"index.php/skpd/mainDataLalu",function() { statusEnding(); });
	}
	statusEnding();
</script>
</div>
