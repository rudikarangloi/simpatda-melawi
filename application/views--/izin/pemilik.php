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
	
	function lihat2() {
		op = document.frmPemilik2.cek.value;
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmPemilik2.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmPemilik2.values.focus();
			return;
			}
		}
		nilai = document.frmPemilik2.values.value;
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/izin/search_pemilik/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	function simpan() {
		//alert(document.frmPemilik.kabupaten2.value);
		/*if(document.frmPemilik.jns.value=="") {
			alert("Jenis Identitas Tidak Boleh Kosong");
			document.frmPemilik.jns.focus();
			return;
		}
		
		if(document.frmPemilik.negara.value=="") {
			alert("Kewarganegaraan Tidak Boleh Kosong");
			document.frmPemilik.negara.focus();
			return;
		}
		
		if(document.frmPemilik.identitas.value=="") {
			alert("No. Identitas Tidak Boleh Kosong");
			document.frmPemilik.identitas.focus();
			return;
		}*/
		
		if(document.frmPemilik.nama.value=="") {
			alert("Nama Tidak Boleh Kosong");
			document.frmPemilik.nama.focus();
			return;
		}
		
		if(document.frmPemilik.alamat.value=="") {
			alert("Alamat Tidak Boleh Kosong");
			document.frmPemilik.alamat.focus();
			return;
		}
				
		/*if(document.frmPemilik.tempat_lahir.value=="") {
			alert("Tempat Lahir Tidak Boleh Kosong");
			document.frmPemilik.tempat_lahir.focus();
			return;
		}
		
		if(document.frmPemilik.tanggal_lahir.value=="") {
			alert("Tanggal Lahir Tidak Boleh Kosong");
			document.frmPemilik.tanggal_lahir.focus();
			return;
		}*/
		
		/* if(document.frmPemilik.hp.value=="") {
			alert("No. HP Tidak Boleh Kosong");
			document.frmPemilik.hp.focus();
			return;
		} */
		
		if(document.frmPemilik.lokasi.value==""){
			alert("Lokasi Dalam Kabupaten Tidak Boleh Kosong");
			document.frmPemilik.lokasi.focus();
			return;
		} else if(document.frmPemilik.lokasi.value==1){
			if(document.frmPemilik.kelurahan.value==""){
			alert("Kelurahan Dalam Kabupaten Tidak Boleh Kosong");
			document.frmPemilik.kelurahan.focus();
			return;
			}
		} else if(document.frmPemilik.lokasi.value==2){
			if(document.frmPemilik.kelurahan1.value==""){
			alert("Kelurahan Luar Kabupaten Tidak Boleh Kosong");
			document.frmPemilik.kelurahan1.focus();
			return;
			}
			
			if(document.frmPemilik.kecamatan1.value==""){
			alert("Kecamatan Luar Kabupaten Tidak Boleh Kosong");
			document.frmPemilik.kecamatan1.focus();
			return;
			}
			
			if(document.frmPemilik.kabupaten2.value==""){
			alert("Kabupaten Luar Kota Tidak Boleh Kosong");
			document.frmPemilik.kabupaten2.focus();
			return;
			}
		}
		
		if(document.frmPemilik.lokasi.value==1){
			kel_id = document.frmPemilik.kelurahan.value;
			kel = document.frmPemilik.kelurahan_hidden.value;
			kec = document.frmPemilik.kecamatan.value;
			kab = document.frmPemilik.kabupaten.value;
		} else if(document.frmPemilik.lokasi.value==2){
			kel = document.frmPemilik.kelurahan1.value;
			kec = document.frmPemilik.kecamatan1.value;
			kab = document.frmPemilik.kabupaten2.value;
		}
		
		s = document.frmPemilik.tanggal_lahir.value;
		arr = s.split("/");
		tgl = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		var postStr =
			"id=" + document.frmPemilik.id.value +
			"&reg=" + document.frmPemilik.reg.value +
			"&npwpd=" + document.frmPemilik.npwpd.value +
			"&jns=" + document.frmPemilik.jns.value +
			"&negara=" + document.frmPemilik.negara.value +
			"&identitas=" + document.frmPemilik.identitas.value +
			"&nama=" + document.frmPemilik.nama.value +
			"&alamat=" + document.frmPemilik.alamat.value +
			//"&jalan=" + document.frmPemilik.jalan.value +
			"&rt=" + document.frmPemilik.rt.value +
			"&rw=" + document.frmPemilik.rw.value +
			"&email=" + document.frmPemilik.email.value +
			"&hp=" + document.frmPemilik.hp.value +
			"&lokasi=" + document.frmPemilik.lokasi.value +
			"&kelurahan_id=" + kel_id +
			"&kelurahan=" + kel +
			"&kecamatan=" + kec +
			"&kabupaten=" + kab +
			"&tempat_lahir=" + document.frmPemilik.tempat_lahir.value +
			"&tanggal_lahir=" + tgl +
			"&jk=" + document.frmPemilik.jk.value;
		statusLoading();
		dhtmlxAjax.post('<?php echo base_url(); ?>index.php/izin/simpan_pemilik', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kosongfrmPemilik();
					refreshData();
					disableButton();
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
	
	function kosongfrmPemilik() {
		document.frmPemilik.id.value = "";
		document.frmPemilik.npwpd.value = "";
		document.frmPemilik.jns.value = "";
		document.frmPemilik.negara.value = "";
		document.frmPemilik.identitas.value = "";
		document.frmPemilik.nama.value = "";
		document.frmPemilik.alamat.value = "";
		//document.frmPemilik.jalan.value = "";
		document.frmPemilik.rt.value = "";
		document.frmPemilik.rw.value = "";
		document.frmPemilik.email.value = "";
		document.frmPemilik.lokasi.value = "";
		document.frmPemilik.kelurahan.value = "";
		document.frmPemilik.kecamatan.value = "";
        document.frmPemilik.kecamatan_nm.value = "";
		document.frmPemilik.kelurahan1.value = "";
		document.frmPemilik.kecamatan1.value = "";
		document.frmPemilik.kabupaten2.value = "";
		document.frmPemilik.kabupaten.value = "";
		document.frmPemilik.hp.value = "";
		//document.frmPemilik.dusun.value = "";
		document.frmPemilik.tempat_lahir.value = "";
		document.frmPemilik.tanggal_lahir.value = "";
		document.frmPemilik.jk.value = "";
	}
	
	function disableButton() {
		document.frmPemilik.delete1.disabled = true;
		document.frmPemilik.tambah.disabled = true;
	}
		
	function enableButton() {
		document.frmPemilik.delete1.disabled = false;
		document.frmPemilik.tambah.disabled = false;
	}
	
    function load_kec(){
        var postStr =
			"kecamatan=" + document.frmPemilik.kecamatan.value;
		statusLoading();                
		dhtmlxAjax.post(base_url+'index.php/izin/ckec2', postStr, kecPOST);
    }
    
    function kecPOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
				    var c = result.split("|");					                    		              
                    document.frmPemilik.kecamatan.value = c[0];
                    document.frmPemilik.kecamatan_nm.value = c[1];                    
					document.frmPemilik.kabupaten.value = 'Melawi';
			}
		}
	}
    }
    
	
	function ckelurahan() {
		var postStr =
			"kelurahan=" + document.frmPemilik.kelurahan.value;
		statusLoading();        
		dhtmlxAjax.post(base_url+'index.php/izin/ckec', postStr, wenePOST);
	}
	
	function wenePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
				    var c = result.split("|");					                    		              
                    document.frmPemilik.kecamatan.value = c[0];
                    document.frmPemilik.kecamatan_nm.value = c[1];     
					document.frmPemilik.kelurahan_hidden.value = c[2];	
					document.frmPemilik.kelurahan.value = c[3];	
					document.frmPemilik.kabupaten.value = 'Melawi';	
				statusEnding();	
			}
		}
	}
    }		
	
</script>

<style>
body{
		background:#FFF;
	}
	.oval_big {
		width: 775px;
		margin:0px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
		/*border-radius:10px;
		-moz-border-radius:10px;*/
	}
</style>
<div id="objBrg21" style="display:none;">
<form name="frmSrc21" id="frmSrc21" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">No. Registrasi</option>
            <option value="2">Nama</option>
            <option value="3">Alamat</option>
            <option value="4">No. Identitas</option>
            <option value="5">Alamat Email</option>
            <option value="6">Kewarganegaraan</option>
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

<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Pendaftaran Pemilik</h2>

<div id="a_tabbar" style="width:1250px; height:600px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0;"><br />
    <form name="frmPemilik" id="frmPemilik">
    	<table border="0">
    		<tr style="margin-top:10px;">
    			<td width="176" style="padding-left:15px;">ID Pemilik</td>
                <td colspan="3">
                <input type="hidden" name="reg" id="reg" size="35" />
                <input type="text" name="npwpd" id="npwpd" size="45" disabled="disabled" style="background-color:#FFFFCC;"/></td>
         	</tr>
            <tr>
                <td style="padding-left:15px;">Jenis Identitas</td>
                <td colspan="3"><input type="hidden" name="id" id="id" size="35" />
                <select name="jns" id="jns" disabled>
                <option value=""></option>
                <option value="KTP">KTP</option>
                <option value="E-KTP">E-KTP</option>
                <option value="PASSPORT">PASSPORT</option>
                <option value="SIM">SIM</option>
                <option value="DOMISILI">DOMISILI</option>
                </select></td>
                <!--<td align="center">Photo</td>-->
            </tr>
            <tr>
                <td style="padding-left:15px;">No. Identitas</td>
                <td colspan="3"><input type="text" name="identitas" id="pad" size="45" disabled/></td>
                <!--<td rowspan="6" bordercolor="#333"><div id="preview" style="border:medium; border-color:#000;"></div></td>-->
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Nama</td>
                <td colspan="3"><input type="text" name="nama" id="nama" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Tempat Lahir</td>
                <td colspan="3"><input type="text" name="tempat_lahir" id="tempat_lahir" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Tanggal Lahir</td>
                <td colspan="3"><input type="text" name="tanggal_lahir" id="tanggal_lahir" size="45" disabled/></td>
            </tr>
            <!--<tr>
              	<td style="padding-left:15px;"> Jalan</td>
                <td colspan="3"><input type="text" name="jalan" id="jalan" size="45" disabled/></td>
            </tr>-->
            <tr>
              	<td style="padding-left:15px;"> Jenis Kelamin</td>
                <td colspan="3"><select name="jk" id="jk" disabled>
                  <option value=""></option>
                  <option value="LAKI-LAKI">Laki-Laki</option>
                  <option value="PEREMPUAN">Perempuan</option>
                </select></td>
            </tr>
            <tr>
              	<td width="176" style="padding-left:15px;">Alamat</td>
                <td colspan="3"><input type="text" name="alamat" id="alamat" size="45" disabled/></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">RT
                <input type="text" name="rt" id="rt" size="1" disabled/>
&nbsp;&nbsp;RW&nbsp;
<input type="text" name="rw" id="rw" size="1" disabled/></td>
              <td colspan="3">Alamat Email
              <input type="text" name="email" id="email" size="29" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Lokasi Tempat Tinggal</td>
                <td colspan="3"><select name="lokasi" id="lokasi" onchange="clokasi()" disabled>
                  <option value=""></option>
                  <option value="1">Dalam Kabupaten</option>
                  <option value="2">Luar Kabupaten</option>
                </select></td>
            </tr>
            <tr>
              <td colspan="4" style="padding-left:15px;"><table>
                <tr>
                  <td><fieldset>
                    <legend>Dalam Kabupaten</legend>
                    <table>
                      <tr>
                        <td width="170" style="padding-left:15px;"> Kelurahan / Desa</td>
                        <td><input type="hidden" name="kelurahan_hidden" id="kelurahan_hidden"/>
                          <select name="kelurahan" id="kelurahan" onchange="ckelurahan()" disabled="disabled">
                            <option value=""></option>
                            <?php 
				foreach($kelurahan->result() as $rs) {
						echo "<option value=".$rs->id.">".$rs->nama_kelurahan."</option>";
					}
				?>
                          </select></td>
                      </tr>
                      <tr>
                        <td style="padding-left:15px;"> Kecamatan</td>
                        <td><input type="hidden" name="kecamatan" id="kecamatan" onkeyup="load_kec()"/>
                          <input type="text" name="kecamatan_nm" id="kecamatan_nm" style="background-color:#FFFFCC;" size="45" disabled="disabled" /></td>
                      </tr>
                      <tr>
                        <td style="padding-left:15px;"> Kabupaten / Kota</td>
                        <td><input type="text" name="kabupaten" id="kabupaten" size="45" style="background-color:#FFFFCC;" disabled="disabled" /></td>
                      </tr>
                    </table>
                  </fieldset></td>
                  <td><fieldset>
                    <legend>Luar Kabupaten</legend>
                    <table>
                      <tr>
                        <td width="170" style="padding-left:15px;"> Kelurahan / Desa</td>
                        <td><input type="text" name="kelurahan1" id="kelurahan1" size="35" style="background-color:#FFCC99;" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td style="padding-left:15px;"> Kecamatan</td>
                        <td><input type="text" name="kecamatan1" id="kecamatan1" size="35" style="background-color:#FFCC99;" disabled="disabled" /></td>
                      </tr>
                      <tr>
                        <td style="padding-left:15px;"> Kabupaten / Kota</td>
                        <td><input type="text" name="kabupaten2" id="kabupaten2" size="35" style="background-color:#FFCC99;" disabled="disabled" /></td>
                      </tr>
                    </table>
                  </fieldset></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Kewarganegaraan</td>
                <td colspan="3"><input type="text" name="negara" id="negara" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> No. HP</td>
                <td colspan="3"><input type="text" name="hp" id="hp" size="45" disabled/></td>
            </tr>
            </table>
    	<table>
<tr>
            	<td style="padding-left:15px;background-color:#FFCC99;">
                <!--<input type="button" value="OPEN DATA REGISTER" onclick="openData()" name="buka" style="padding-left:20px; padding-right:20px"/>-->
                &nbsp;<input type="button" value="BARU" onclick="baru()" name="new1" style="padding-left:20px; padding-right:20px"/>
                </td>
                <td colspan="3" style="background-color:#FFCC99;"><input type="button" value="SIMPAN" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>&nbsp;&nbsp;&nbsp;
				<input type="button" value="HAPUS" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
          </tr>
   	  </table>
    </form>
    <br />
</div>

<div id="C2">
<br />
	<form name="frmPemilik2" id="frmPemilik2">
    <table>
    	<tr>
        	<td style="padding:0px 5px 0px 15px;">Cari data berdasarkan</td>
            <td><select nama="cek" id="cek">
            <option value="1">ID Pemilik</option>
            <option value="2">Nama</option>
            <option value="3">Alamat</option>
            <option value="4">No. Identitas</option>
            <option value="5">Alamat Email</option>
            <option value="6">Kewarganegaraan</option>
            </select></td>
            <td style="padding:0px 5px 0px 15px;">Value</td>
            <td><input type="text" name="values" id="values" size="25" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
            <td><input type="button" onclick="lihat2()" name="filter" value="Cari" style="padding-left:20px; padding-right:20px"/></td>
        </tr>
    </table>
    </form>
    <div style="padding:0 0px 10px 0px;">
   		<div id="gridContent" height="450px" width="1230px" style="margin-bottom:10px;"></div>
        <div id="pagingArea" width="450px" style="background-color:white;"></div>
	</div> 
</div>

</div>
<script language="javascript">
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
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmSrc21.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc21.values.focus();
			return;
			}
		}
		nilai = document.frmSrc21.values.value;
		gridData.clearAll();
		gridData.loadXML("<?php echo site_url(); ?>/izin/load_registrasi/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	gridData = new dhtmlXGridObject('gridCo21');
	gridData.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridData.setHeader("id, no_daftar, nama_perusahaan, alamat_perusahaan, jalan, rt, rw, email, kode_kel, kelurahan, kode_kec, kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_pemilik, rt_pemilik, rw_pemilik, email_pemilik, telp_pemilik, lokasi_pemilik, kelurahan_pemilik, nama_kelurahan, kecamatan_pemilik, nama_kecamatan, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, perkiraan_omset, tgl_daftar");//36
	gridData.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");//19
	gridData.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,right,left");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ron,ro");
	gridData.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,int,str");
	gridData.setNumberFormat("0,000",40,",",".");
    gridData.setSkin("dhx_skyblue");
	gridData.setColumnHidden(0,true);
	gridData.attachEvent("onRowDblClicked", selectedOpenData21);
	gridData.init();
	
	function selectedOpenData21(id) {
	   document.frmPemilik.reg.value 	  	= gridData.cells(id,1).getValue();
		//document.frmPemilik.jns.value 	  	= gridData.cells(id,2).getValue();
		//document.frmPemilik.negara.value   	 = gridData.cells(id,3).getValue();
		//document.frmPemilik.identitas.value  = gridData.cells(id,4).getValue();
		document.frmPemilik.nama.value 	   = gridData.cells(id,16).getValue();
		document.frmPemilik.alamat.value     = gridData.cells(id,17).getValue();
		//document.frmPemilik.jalan.value 	  = gridData.cells(id,18).getValue();
		document.frmPemilik.rt.value 	     = gridData.cells(id,19).getValue();
		document.frmPemilik.rw.value 	     = gridData.cells(id,20).getValue();
		document.frmPemilik.email.value 	  = gridData.cells(id,21).getValue();
		document.frmPemilik.hp.value 	     = gridData.cells(id,22).getValue();
		
        //document.frmPemilik.nama.value 	   = gridData.cells(id,14).getValue();
		//document.frmPemilik.alamat.value     = gridData.cells(id,15).getValue();
		//document.frmPemilik.jalan.value 	  = gridData.cells(id,16).getValue();
		//document.frmPemilik.rt.value 	     = gridData.cells(id,17).getValue();
		//document.frmPemilik.rw.value 	     = gridData.cells(id,18).getValue();
		//document.frmPemilik.email.value 	  = gridData.cells(id,19).getValue();
		//document.frmPemilik.hp.value 	     = gridData.cells(id,24).getValue();		
        
        //document.frmPemilik.tempat_lahir.value  = gridData.cells(id,14).getValue();
		//document.frmPemilik.tanggal_lahir.value = gridData.cells(id,15).getValue();
		//document.frmPemilik.jk.value 	 		= gridData.cells(id,16).getValue();
		document.frmPemilik.lokasi.value 	 	= gridData.cells(id,23).getValue();
		if(document.frmPemilik.lokasi.value=='1'){
			document.frmPemilik.kelurahan.value = gridData.cells(id,24).getValue();
			document.frmPemilik.kecamatan.value = gridData.cells(id,26).getValue();
			document.frmPemilik.kabupaten.value = gridData.cells(id,28).getValue();
            load_kec();
		} else if(document.frmPemilik.lokasi.value=='2'){
			document.frmPemilik.kelurahan1.value = gridData.cells(id,25).getValue();
			document.frmPemilik.kecamatan1.value = gridData.cells(id,27).getValue();
			document.frmPemilik.kabupaten2.value = gridData.cells(id,28).getValue();
		}
        
    
    
    /*
    	document.frmPemilik.reg.value 	  	= gridData.cells(id,1).getValue();
		//document.frmPemilik.jns.value 	  	= gridData.cells(id,2).getValue();
		//document.frmPemilik.negara.value   	 = gridData.cells(id,3).getValue();
		//document.frmPemilik.identitas.value  = gridData.cells(id,4).getValue();
		document.frmPemilik.nama.value 	   = gridData.cells(id,14).getValue();
		document.frmPemilik.alamat.value     = gridData.cells(id,15).getValue();
		document.frmPemilik.jalan.value 	  = gridData.cells(id,16).getValue();
		document.frmPemilik.rt.value 	     = gridData.cells(id,17).getValue();
		document.frmPemilik.rw.value 	     = gridData.cells(id,18).getValue();
		document.frmPemilik.email.value 	  = gridData.cells(id,19).getValue();
		document.frmPemilik.hp.value 	     = gridData.cells(id,24).getValue();
		//document.frmPemilik.tempat_lahir.value  = gridData.cells(id,14).getValue();
		//document.frmPemilik.tanggal_lahir.value = gridData.cells(id,15).getValue();
		//document.frmPemilik.jk.value 	 		= gridData.cells(id,16).getValue();
		document.frmPemilik.lokasi.value 	 	= gridData.cells(id,22).getValue();
		if(document.frmPemilik.lokasi.value=='1'){
			document.frmPemilik.kelurahan.value = gridData.cells(id,23).getValue();
			document.frmPemilik.kecamatan.value = gridData.cells(id,24).getValue();
			document.frmPemilik.kabupaten.value = gridData.cells(id,25).getValue();
		} else if(document.frmPemilik.lokasi.value=='2'){
			document.frmPemilik.kelurahan1.value = gridData.cells(id,23).getValue();
			document.frmPemilik.kecamatan1.value = gridData.cells(id,24).getValue();
			document.frmPemilik.kabupaten2.value = gridData.cells(id,25).getValue();
		}*/
		batal21();
		document.frmPemilik.tambah.disabled = false;
	}
	
	function clokasi(){
		if(document.frmPemilik.lokasi.value == 1){
			document.frmPemilik.kelurahan.disabled = false;
			
			document.frmPemilik.kelurahan1.value = "";
			document.frmPemilik.kecamatan1.value = "";
			document.frmPemilik.kabupaten2.value = "";
			document.frmPemilik.kelurahan1.disabled = true;
			document.frmPemilik.kecamatan1.disabled = true;
			document.frmPemilik.kabupaten2.disabled = true;
		
		} else if(document.frmPemilik.lokasi.value == 2){
			document.frmPemilik.kelurahan.disabled = true;
			document.frmPemilik.kelurahan.value = "";
			document.frmPemilik.kecamatan.value = "";
		
			document.frmPemilik.kelurahan1.disabled = false;
			document.frmPemilik.kecamatan1.disabled = false;
			document.frmPemilik.kabupaten2.disabled = false;
			document.frmPemilik.kelurahan1.focus();
		}
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	function baru() {
		kosongfrmPemilik();
		enabledData();
		document.frmPemilik.jns.focus();
		document.frmPemilik.tambah.disabled = false;
		document.frmPemilik.delete1.disabled = true;
	}
	
	function enabledData() {
		document.frmPemilik.jns.disabled = false;
		document.frmPemilik.negara.disabled = false;
		document.frmPemilik.identitas.disabled = false;
		document.frmPemilik.nama.disabled = false;
		document.frmPemilik.alamat.disabled = false;
		//document.frmPemilik.jalan.disabled = false;
		document.frmPemilik.rt.disabled = false;
		document.frmPemilik.rw.disabled = false;
		document.frmPemilik.email.disabled = false;
		document.frmPemilik.lokasi.disabled = false;
		document.frmPemilik.hp.disabled = false;
		//document.frmPemilik.dusun.value = "";
		document.frmPemilik.tempat_lahir.disabled = false;
		document.frmPemilik.tanggal_lahir.disabled = false;
		document.frmPemilik.jk.disabled = false;
	}
	
	function disabledData() {
		document.frmPemilik.jns.disabled = true;
		document.frmPemilik.negara.disabled = true;
		document.frmPemilik.identitas.disabled = true;
		document.frmPemilik.nama.disabled = true;
		document.frmPemilik.alamat.disabled = true;
		//document.frmPemilik.jalan.disabled = true;
		document.frmPemilik.rt.disabled = true;
		document.frmPemilik.rw.disabled = true;
		document.frmPemilik.email.disabled = true;
		document.frmPemilik.kelurahan.disabled = true;
		document.frmPemilik.hp.disabled = true;
		//document.frmPemilik.dusun.value = "";
		document.frmPemilik.tempat_lahir.disabled = true;
		document.frmPemilik.tanggal_lahir.disabled = true;
		document.frmPemilik.jk.disabled = true;
	}
	
	cal1 = new dhtmlxCalendarObject('tanggal_lahir');
	cal1.setDateFormat('%d/%m/%Y');
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("ID,ID Pemilik,Jenis Identitas,Kewarganegaraan,No.Identitas,Nama,Alamat,RT,RW,Email,Kelurahan,Kecamatan,Kabupaten,Tempat Lahir, Tanggal Lahir,Jenis Kelamin,Lokasi,HP,Idc");
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,20,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setSkin("dhx_skyblue");
	grid.setColumnHidden(0,true);
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/izin/data_pemilik");
	grid.init();
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/izin/data_pemilik");
	}
	
	function selectedOpenData(id) {
		tabbar.setTabActive("a1");
		//statusLoading();
		kosongfrmPemilik();
		enableButton();
		enabledData();
		document.frmPemilik.id.value	 			= grid.cells(id,0).getValue();
		document.frmPemilik.npwpd.value 	 		= grid.cells(id,1).getValue();
		document.frmPemilik.jns.value 				= grid.cells(id,2).getValue();
		document.frmPemilik.negara.value 	 		= grid.cells(id,3).getValue();
		document.frmPemilik.identitas.value 	 	= grid.cells(id,4).getValue();
		document.frmPemilik.nama.value 	 		= grid.cells(id,5).getValue();
		document.frmPemilik.alamat.value 	 		= grid.cells(id,6).getValue();
		//document.frmPemilik.jalan.value 	 		= grid.cells(id,7).getValue();
		document.frmPemilik.rt.value 	 			= grid.cells(id,8).getValue();
		document.frmPemilik.rw.value 	 			= grid.cells(id,9).getValue();
		document.frmPemilik.email.value 	 		= grid.cells(id,10).getValue();
		document.frmPemilik.hp.value 	 		= grid.cells(id,18).getValue();
		document.frmPemilik.tempat_lahir.value 	= grid.cells(id,14).getValue();
		document.frmPemilik.tanggal_lahir.value	= grid.cells(id,15).getValue();
		document.frmPemilik.jk.value 	 			= grid.cells(id,16).getValue();
		document.frmPemilik.lokasi.value 	 		= grid.cells(id,17).getValue();	
		if(document.frmPemilik.lokasi.value=='1'){
			document.frmPemilik.kelurahan.value		= grid.cells(id,19).getValue();
			document.frmPemilik.kecamatan.value		= grid.cells(id,12).getValue();
			document.frmPemilik.kabupaten.value 	 	= grid.cells(id,13).getValue();
            load_kec();
		} else if(document.frmPemilik.lokasi.value=='2'){
			document.frmPemilik.kelurahan1.value		= grid.cells(id,11).getValue();
			document.frmPemilik.kecamatan1.value		= grid.cells(id,12).getValue();
			document.frmPemilik.kabupaten2.value 	 	= grid.cells(id,13).getValue();
		}
		statusEnding();
	}
	
	function deleteData() {		
		var enter=prompt("Please enter your password","");
		if (enter!=null){
			if(enter=='dispenda'){
				confrm = confirm("Apakah Anda Yakin Hapus Data Ini ?");
				if(confrm) {
					var postStr =
						"id=" + document.frmPemilik.id.value +
						"&npwpd=" + document.frmPemilik.npwpd.value;
						statusLoading();
						dhtmlxAjax.post(base_url+'index.php/izin/delete_pemilik', postStr, responeDel);		
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
					kosongfrmPemilik();
					refreshData();
					disableButton();
					statusEnding();	
					alert("Data pemilik berhasil dihapus.");
					return true;
				} else {
					kosongfrmPemilik();
					refreshData();
					disableButton();
					statusEnding();	
					alert("Silakan Menghapus Data Perusahaan Terlebih Dahulu.");
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
</script>