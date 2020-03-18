<title>.: SIMPATDA DISPENDA :.</title>
    <script src="<?php echo base_url(); ?>/assets/dhtmlx.js" type="text/javascript"></script>
    <!-- dhtmlx.css contains styles definitions for all use components -->
    <link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>/assets/dhtmlx.css" />
	
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



<!-- Combo -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.css" />
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.js"></script>
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/ext/dhtmlxcombo_group.js"></script>
<!-- end of combo -->

<script src="<?php echo base_url(); ?>/assets/codebase_ajax/dhtmlxcommon.js"></script>


<div style="height:100%; overflow:auto;">
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	var kel = '';
	var kec = '';
	var kab = '';
    
	function statusLoading() {  
   		ModalPopups.Indicator("idIndicator2",  
			"Please wait",  
			"<div style=''>" +   
			"<div style='float:left;'><img src='<?php echo base_url();?>/assets/modal/spinner.gif'></div>" +   
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
	
	function simpan() {
		if(document.frmData.nama_perusahaan.value=="") {
			alert("Nama Perusahaan Tidak Boleh Kosong");
			document.frmData.nama_perusahaan.focus();
			return;
		}
		
		if(document.frmData.alamat_perusahaan.value=="") {
			alert("Alamat Perusahaan Tidak Boleh Kosong");
			document.frmData.alamat_perusahaan.focus();
			return;
		}
		
		if(document.frmData.kelurahan.value=="") {
			alert("Kelurahan Perusahaan Tidak Boleh Kosong");
			document.frmData.kelurahan.focus();
			return;
		}
		
		if(document.frmData.id_pemilik.value=="") {
			alert("NPWPD Pemilik Tidak Boleh Kosong");
			document.frmData.id_pemilik.focus();
			return;
		}
		
		if(document.frmData.nama_p.value=="") {
			alert("Nama Pemilik Tidak Boleh Kosong");
			document.frmData.nama_p.focus();
			return;
		}
		
		if(document.frmData.alamat_p.value=="") {
			alert("Alamat Pemilik Tidak Boleh Kosong");
			document.frmData.alamat_p.focus();
			return;
		}
		
		if(document.frmData.lokasi_p.value=="") {
			alert("Lokasi Tempat Tinggal Tidak Boleh Kosong");
			document.frmData.lokasi_p.focus();
			return;
		} else if(document.frmData.lokasi_p.value==1){
			if(document.frmData.kelurahan_p.value==""){
			alert("Kelurahan Dalam Kota Lahir Tidak Boleh Kosong");
			document.frmData.kelurahan_p.focus();
			return;
			}
		} else if(document.frmData.lokasi_p.value==2){
			if(document.frmData.kelurahan_p1.value==""){
			alert("Kelurahan Luar Kota Lahir Tidak Boleh Kosong");
			document.frmData.kelurahan_p1.focus();
			return;
			}
			
			if(document.frmData.kecamatan_p1.value==""){
			alert("Kecamatan Luar Kota Lahir Tidak Boleh Kosong");
			document.frmData.kecamatan_p1.focus();
			return;
			}
			
			if(document.frmData.kabupaten_p1.value==""){
			alert("Kabupaten Luar Kota Lahir Tidak Boleh Kosong");
			document.frmData.kabupaten_p1.focus();
			return;
			}
		}
		
		 if(document.frmData.lokasi_p.value==1){
			kel = document.frmData.kelurahan_p.value;
			kec = document.frmData.kecamatan_p.value;
			kab = document.frmData.kabupaten_p.value;
		} else if(document.frmData.lokasi.value==2){
			kel = document.frmData.kelurahan.value;
			kec = document.frmData.kecamatan.value;
			kab = document.frmData.kabupaten.value;
		}
		
		if(document.frmData.tlp_p.value==""){
			alert("No. Handphone Tidak Boleh Kosong");
			document.frmData.tlp_p.focus();
			return;
		}
		
		if(document.frmData.jenis_usaha.value==""){
			alert("Jenis Usaha Tidak Boleh Kosong");
			document.frmData.jenis_usaha.focus();
			return;
		}
		
		if(document.frmData.status.value==""){
			alert("Status Tidak Boleh Kosong");
			document.frmData.status.focus();
			return;
		}
		
		if(document.frmData.jenis_pajak.value==""){
			alert("Jenis Pajak Tidak Boleh Kosong");
			document.frmData.jenis_pajak.focus();
			return;
		}
		
		s = document.frmData.tanggal.value;
		arr = s.split("/");
		tanggal = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		w = document.frmData.tgl.value;
		arr = w.split("/");
		tgl_daftar = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		jp = document.frmData.jenis_pajak.value;
		if(jp==1||jp==2||jp==3||jp==4||jp==5||jp==6||jp==7||jp==8){
			jpd = document.frmData.omset.value;
		} else if(jp==9){
			//jpd = document.frmData.air_tanah.value;
            jpd = document.frmData.omset.value;
		}
		
		var postStr =
			"id=" + document.frmData.id.value +
			"&nama_perusahaan=" + document.frmData.nama_perusahaan.value +
			"&alamat_perusahaan=" + document.frmData.alamat_perusahaan.value +
			"&jalan=" + document.frmData.jalan.value +
			"&rt=" + document.frmData.rt.value +
			"&rw=" + document.frmData.rw.value +
			"&email=" + document.frmData.email.value +
			"&kelurahan=" + document.frmData.kelurahan.value +
			"&kecamatan=" + document.frmData.kecamatan.value +
			"&kabupaten=" + document.frmData.kabupaten.value +
			"&telp=" + document.frmData.tlp.value +
			"&kodepos=" + document.frmData.kodepos.value +
			"&id_pemilik=" + document.frmData.id_pemilik.value +
			"&nama_p=" + document.frmData.nama_p.value +
			"&alamat_p=" + document.frmData.alamat_p.value +
			"&jalan_p=" + document.frmData.jalan_p.value +
			"&rt_p=" + document.frmData.rt_p.value +
			"&rw_p=" + document.frmData.rw_p.value +
			"&email_p=" + document.frmData.email_p.value +
			"&lokasi_p=" + document.frmData.lokasi_p.value +
			"&kelurahan_p=" + kel +
			"&kecamatan_p=" + kec +
			"&kabupaten_p=" + kab +
			"&telp_p=" + document.frmData.tlp_p.value +
			"&kodepos_p=" + document.frmData.kodepos_p.value +
			"&jenis_usaha=" + document.frmData.jenis_usaha.value +
			"&status=" + document.frmData.status.value +
			"&kategori=" + document.frmData.kategori.value +
			"&jml_karyawan=" + document.frmData.jml_karyawan.value +
			"&ukuran_tempat=" + document.frmData.ukuran_tempat.value +
			"&izin=" + document.frmData.izin.value +
			"&nomor=" + document.frmData.nomor.value +
			"&tanggal=" + tanggal +
			"&jenis_pajak=" + jp +
			"&jns=" + jpd +
			"&tgl_daftar=" + tgl_daftar;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/home/simpan_register', postStr, responePOST);
        
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmData.daftar.value = result;
					disableButton();
					disabledData();
					statusEnding();
					var info = "No Pendaftaran anda adalah "+result+"."	
					alert(info);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmData() {
		document.frmData.id.value = "";
		document.frmData.nama_perusahaan.value = "";
		document.frmData.alamat_perusahaan.value = "";
		document.frmData.jalan.value = "";
		document.frmData.rt.value = "";
		document.frmData.rw.value = "";
		document.frmData.email.value = "";
		document.frmData.kelurahan.value = "";
		document.frmData.kecamatan.value = "";
		document.frmData.tlp.value = "";
		document.frmData.kodepos.value = "";
		document.frmData.id_pemilik.value = "";
		document.frmData.nama_p.value = "";
		document.frmData.alamat_p.value = "";
		document.frmData.jalan_p.value = "";
		document.frmData.rt_p.value = "";
		document.frmData.rw_p.value = "";
		document.frmData.email_p.value = "";
		document.frmData.tlp_p.value = "";
		document.frmData.kodepos_p.value = "";
		document.frmData.lokasi_p.value = "";
		document.frmData.kelurahan_p.value = "";
		document.frmData.kecamatan_p.value = "";
		document.frmData.kelurahan_p1.value = "";
		document.frmData.kecamatan_p1.value = "";
		document.frmData.kabupaten_p1.value = "";
		document.frmData.jenis_usaha.value = "";
		document.frmData.status.value = "";
		document.frmData.kategori.value = "";
		document.frmData.jml_karyawan.value = "";
		document.frmData.ukuran_tempat.value = "";
		document.frmData.izin.value = "";
		document.frmData.nomor.value = "";
		document.frmData.tanggal.value = "";
		document.frmData.jenis_pajak.value = "";
		document.frmData.omset.value = "";
		//document.frmData.air_tanah.value = "";
		document.frmData.tgl.value = "";
	}
	
	function disableButton() {
		document.frmData.tambah.disabled = true;
	}
		
	function enableButton() {
		document.frmData.tambah.disabled = false;
	}
	
	function ckelurahan() {
		var postStr =
			"kelurahan=" + document.frmData.kelurahan.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/home/ckel', postStr, wenePOST);
	}
	
	function wenePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmData.kecamatan.value = result;
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function ckel_pemilik() {
		var postStr =
			"kelurahan_p=" + document.frmData.kelurahan_p.value;
		statusLoading();
        //alert(postStr);
		dhtmlxAjax.post(base_url+'index.php/home/ckel_pemilik', postStr, wenePOST1);
	}
	
	function wenePOST1(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					document.frmData.kecamatan_p.value = result;
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
    
    function back(){       
        window.open('home','self');
    }
 
</script>

<style>
	.oval_big1 {
		width: 835px;
		margin:0px 5px 25px 250px;
		padding: 10px 10px 10px 10px;
		border:1px solid #CCC;
	}
</style>
<body style="background-image: -webkit-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #B5EBFF), color-stop(1, #00A3EF));
        background-image: -moz-linear-gradient(bottom, #B5EBFF 0%, #00A3EF 100%);">
        
<div style="margin:30px 0px 0px 30px;" >
	<img src="<?php echo base_url() ?>/images/LOGO KOTA PADANG.png" width="130" height="140" />
</div>

<h2 style="margin:-140px 5px 25px 250px;">Registrasi Pendaftaran Wajib Pajak</h2>

<div class="oval_big1" style="background-color: #FFF;">
<div style="background-color: #B3D9F0;">
<!---B3D9F0-->
	<br />
    <form name="frmData" id="frmData">
    	<table>
            <tr>
                <td width="250" style="padding-left:15px;"><strong>No. Registrasi</strong></td>
                <td><input type="text" name="daftar" id="daftar" size="45" style="background-color:#FFFFCC;" disabled/>
                <input type="hidden" name="id" id="id" size="45" style="background-color:#FFFFCC;"/></td>
           	</tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Nama Perusahaan</strong></td>
                <td><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Alamat Perusahaan</strong></td>
                <td><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Jalan</td>
                <td><input type="text" name="jalan" id="jalan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">RT 
                <input type="text" name="rt" id="rt" size="1" disabled/> RW 
                <input type="text" name="rw" id="rw" size="1" disabled/></td>
                <td>Alamat Email <input type="text" name="email" id="email" size="29" disabled/></td>
            </tr>
			<tr>
              	<td style="padding-left:35px;">Kecamatan</td>
                <td>
				 <div id="kecamatan"></div>
				<!--<input type="text" name="kecamatan" id="kecamatan" size="45" disabled="disabled">-->
				</td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kelurahan</td>
                <td>
				 <div id="kelurahan"></div>
				<!--<select name="kelurahan" id="kelurahan" onchange="ckelurahan();" disabled>
                <option value=""></option>
                <?php 
				//foreach($kelurahan->result() as $rs) {
				//		echo "<option value=".$rs->id.">".$rs->nama_kelurahan."</option>";
				//	}
				?>
                </select>-->
				</td>
            </tr>
           
            <tr>
              	<td style="padding-left:35px;">Kota</td>
                <td><input type="text" name="kabupaten" id="kabupaten" value="KOTA JAMBI" size="45" disabled="disabled" style="background-color:#FFFFCC;" /></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Telepon</td>
				<td><input type="text" name="tlp" id="tlp" disabled="disabled" size="45"/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kode Pos</td>
				<td><input type="text" name="kodepos" id="kodepos" disabled="disabled" size="45" /></td>
            </tr>
            <tr>
            	<td style="padding-left:15px;"><strong>NPWPD Pemilik</strong></td>
                <td><input type="text" name="id_pemilik" id="id_pemilik" size="45" style="text-transform:uppercase; background-color: #FFCC99;" disabled/></td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Nama Pemilik</strong></td>
                <td><input type="text" name="nama_p" id="nama_p" size="45" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Alamat Pemilik</strong></td>
                <td><input type="text" name="alamat_p" id="alamat_p" size="45" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Jalan</td>
                <td><input type="text" style="background-color:#FFFFCC;" name="jalan_p" id="jalan_p" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">RT 
                <input type="text" style="background-color:#FFFFCC;" name="rt_p" id="rt_p" size="1" disabled/> RW 
                <input type="text" style="background-color:#FFFFCC;" name="rw_p" id="rw_p" size="1" disabled/></td>
                <td>Alamat Email <input type="text" style="background-color:#FFFFCC;" name="email_p" id="email_p" size="29" disabled/></td>
            </tr>
            <tr>
            	<td style="padding-left:35px;">Lokasi Tempat Tinggal</td>
                <td colspan="3"><select name="lokasi_p" id="lokasi_p" onchange="clokasi()" disabled>
                <option value=""></option>
                <option value="1">Dalam Kota</option>
                <option value="2">Luar Kota</option>
                </select></td>
            </tr>
            </table>
            <table>
            <tr>
            	<td>
           <fieldset><legend>Dalam Kota</legend>
           <table>
            <tr>
              	<td width="170" style="padding-left:15px;"> Kelurahan</td>
                <td><select name="kelurahan_p" id="kelurahan_p" onchange="ckel_pemilik();" disabled>
                <option value=""></option>
                <?php 
				foreach($kelurahan->result() as $rs) {
						echo "<option value=".$rs->kode_kelurahan.">".$rs->nama_kelurahan."</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Kecamatan</td>
                <td><input type="text" name="kecamatan_p" id="kecamatan_p" size="30" disabled="disabled"></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Kota</td>
                <td><input type="text" name="kabupaten_p" id="kabupaten_p" value="KOTA JAMBI" size="30" style="background-color:#FFFFCC;" disabled="disabled" /></td>
            </tr>
            </table>
            </fieldset>
            </td>
            <td>
            	<fieldset><legend>Luar Kota</legend>
               <table>
                <tr>
                    <td width="170" style="padding-left:15px;"> Kelurahan</td>
                    <td><input type="text" name="kelurahan_p1" id="kelurahan_p1" size="30" style="background-color:#FFCC99;" disabled/></td>
                </tr>
                <tr>
                    <td style="padding-left:15px;"> Kecamatan</td>
                    <td><input type="text" name="kecamatan_p1" id="kecamatan_p1" size="30" style="background-color:#FFCC99;" disabled="disabled"></td>
                </tr>
                <tr>
                    <td style="padding-left:15px;"> Kota</td>
                    <td><input type="text" name="kabupaten_p1" id="kabupaten_p1" size="30" style="background-color:#FFCC99;" disabled="disabled" /></td>
                </tr>
                </table>
                </fieldset>
                </td>
                </tr>
                </table>
            <table>
            <tr>
              	<td width="230" style="padding-left:35px;">Telepon</td>
				<td><input type="text" style="background-color:#FFFFCC;"  name="tlp_p" id="tlp_p" disabled="disabled" size="45"/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kode Pos</td>
				<td><input type="text" style="background-color:#FFFFCC;"  name="kodepos_p" id="kodepos_p" disabled="disabled" size="45"/></td>
            </tr>            
            <tr>
              	<td style="padding-left:15px;"><strong>Jenis Usaha</strong></td>
                <td><select id="jenis_usaha" class="jenis_usaha" disabled="disabled" onchange="pilih()">
                <option value=""></option>
				<?php 
                foreach($usaha->result() as $rs) {
                        echo "<option value=".$rs->id_usaha.">".$rs->nm_usaha."</option>";
                    }
                ?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;"> Status</td>
                <td><select id="status" class="status" disabled>
                <option value=""></option>
				<?php 
                foreach($status->result() as $rs) {
                        echo "<option value=".$rs->id_status.">".$rs->nm_status."</option>";
                    }
                ?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kategori</td>
				<td>
                    <select id="kategori" name="kategori" disabled="disabled">
                        <option value=""></option>
                        <option value="Micro">Micro</option>
                        <option value="Kecil">Kecil</option>
                        <option value="Menenggah">Menenggah</option>
                        <option value="Besar">Besar</option>
                    </select>
                <!--<input type="text" name="kategori" id="kategori" disabled="disabled" size="45"/>-->                
                </td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Jumlah Karyawan</td>
				<td><input type="text" name="jml_karyawan" id="jml_karyawan" disabled="disabled" size="45"/></td>
            </tr>
			<tr>
              	<td style="padding-left:15px;"><strong>Ukuran Tempat Usaha</strong></td>
				<td><input type="text" name="ukuran_tempat" id="ukuran_tempat" disabled="disabled" size="45"/></td>
            </tr>
			<tr>
              	<td style="padding-left:15px;"><strong>Surat izin yang dimiliki</strong></td>
				<td><input type="text" name="izin" id="izin" disabled="disabled" size="45"/></td>
            </tr>
			<tr>
              	<td style="padding-left:35px;">Nomor</td>
				<td><input type="text" name="nomor" id="nomor" disabled="disabled" size="45" /></td>
            </tr>
			<tr>
              	<td style="padding-left:35px;">Tanggal</td>
				<td><input type="text" name="tanggal" id="tanggal" disabled="disabled" size="45" /></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Jenis Pajak</strong></td>
				<td>
					<input type="hidden" name="jenis_pajak" id="jenis_pajak" />						
                    <input type="text" name="nama_pajak" id="nama_pajak" disabled="disabled"/>
				</td>
            </tr>
            <tr>
            	<td colspan="2">
            	<table align="right" width="320px">
            	<tr>
            		<td>
                        <fieldset><legend><b>Pendapatan Usaha</b></legend>
                        <table>
                        <tr>
                            <td>Omset/Bulan</td>
                            <td><input type="text" size="28px" name="omset" id="omset" disabled="disabled"></td>
                        </tr>
                        </table>
                        </fieldset>
                        </td>
                    <!--<td>
                        <fieldset><legend>Air Tanah</legend>
                       	<table>
                        <tr>
                            <td>Pemakaian Air M3/Bulan</td>
                            <td><input type="text" name="air_tanah" id="air_tanah" disabled="disabled"/></td>
                        </tr>
                        </table>
                    	</fieldset>
                	</td>-->
                </tr>
                </table>
            	</td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Tanggal Pendaftaran</td>
                <td><input name="tgl" type="text" disabled="disabled" id="tgl" size="13" ></td>
            </tr>
            <tr>
            	<td style="padding-left:15px;" colspan="2"><input type="button" value="Baru" id="new1" name="new1" onclick="baru()" style="padding-left:20px; padding-right:20px" />
                <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>
                <input type="button" value="Kembali ke home" onclick="back()" name="kembali" style="padding-left:20px; padding-right:20px"/>
                <input type="button" value="Cetak Form Registrasi Kosong" onclick="cetak_form()" name="cetakform" id="cetakform" style="padding-lef:20px; padding-right:20px;"/>
                <!--<input type="button" value="Cetak registrasi" onclick="cetak()" name="cetak1" id="cetak1" style="padding-lef:20px; padding-right:20px;"/>-->
                </td>
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
    	</table>
    </form>
</div>
</div>
</body>

<script language="javascript">
	var dhx_globalImgPath="<?php echo base_url(); ?>/assets/codebase_combo/imgs/";
    var no_daftar='';

var z = new dhtmlXCombo("kecamatan", "kecamatan", 200);
z.enableFilteringMode(true);
z.loadXML("<?php echo base_url()."index.php/data_potensi/loadKec"; ?>");
z.attachEvent("onChange", getKelurahan);  

var z1 = new dhtmlXCombo("kelurahan", "kelurahan", 200);
function getKelurahan(){
	z1.loadXML("<?php echo base_url()."index.php/data_potensi/loadKel/"; ?>"+z.getSelectedValue());
}

	function clokasi(){
		if(document.frmData.lokasi_p.value == 1){
			document.frmData.kelurahan_p.disabled = false;
			
			document.frmData.kelurahan_p1.value = "";
			document.frmData.kecamatan_p1.value = "";
			document.frmData.kabupaten_p1.value = "";
			document.frmData.kelurahan_p1.disabled = true;
			document.frmData.kecamatan_p1.disabled = true;
			document.frmData.kabupaten_p1.disabled = true;
		
		} else if(document.frmData.lokasi_p.value == 2){
			document.frmData.kelurahan_p.disabled = true;
			document.frmData.kelurahan_p.value = "";
			document.frmData.kecamatan_p.value = "";
		
			document.frmData.kelurahan_p1.disabled = false;
			document.frmData.kecamatan_p1.disabled = false;
			document.frmData.kabupaten_p1.disabled = false;
			document.frmData.kelurahan_p1.focus();
		}
	}

	function baru() {
		kosongfrmData();
		enabledData();
		document.frmData.nama_perusahaan.focus();
		document.frmData.tambah.disabled = false;
	}
	
	function enabledData() {
		document.frmData.nama_perusahaan.disabled = false;
		document.frmData.alamat_perusahaan.disabled = false;
		document.frmData.jalan.disabled = false;
		document.frmData.rt.disabled = false;
		document.frmData.rw.disabled = false;
		document.frmData.email.disabled = false;
		document.frmData.kelurahan.disabled = false;
		document.frmData.tlp.disabled = false;
		document.frmData.kodepos.disabled = false;
		document.frmData.id_pemilik.disabled = false;
		document.frmData.nama_p.disabled = false;
		document.frmData.alamat_p.disabled = false;
		document.frmData.jalan_p.disabled = false;
		document.frmData.rt_p.disabled = false;
		document.frmData.rw_p.disabled = false;
		document.frmData.email_p.disabled = false;
		document.frmData.tlp_p.disabled = false;
		document.frmData.kodepos_p.disabled = false;
		document.frmData.lokasi_p.disabled = false;
		document.frmData.jenis_usaha.disabled = false;
		document.frmData.status.disabled = false;
		document.frmData.kategori.disabled = false;
		document.frmData.jml_karyawan.disabled = false;
		document.frmData.ukuran_tempat.disabled = false;
		document.frmData.izin.disabled = false;
		document.frmData.nomor.disabled = false;
		document.frmData.tanggal.disabled = false;
		document.frmData.jenis_pajak.disabled = false;
		document.frmData.tgl.disabled = false;
	}
	
	function disabledData() {
		document.frmData.nama_perusahaan.disabled = true;
		document.frmData.alamat_perusahaan.disabled = true;
		document.frmData.jalan.disabled = true;
		document.frmData.rt.disabled = true;
		document.frmData.rw.disabled = true;
		document.frmData.email.disabled = true;
		document.frmData.kelurahan.disabled = true;
		document.frmData.kecamatan.disabled = true;
		document.frmData.tlp.disabled = true;
		document.frmData.kodepos.disabled = true;
		document.frmData.id_pemilik.disabled = true;
		document.frmData.nama_p.disabled = true;
		document.frmData.alamat_p.disabled = true;
		document.frmData.jalan_p.disabled = true;
		document.frmData.rt_p.disabled = true;
		document.frmData.rw_p.disabled = true;
		document.frmData.email_p.disabled = true;
		document.frmData.tlp_p.disabled = true;
		document.frmData.kodepos_p.disabled = true;
		document.frmData.lokasi_p.disabled = true;
		document.frmData.kelurahan_p.disabled = true;
		document.frmData.kecamatan_p.disabled = true;
		document.frmData.kelurahan_p1.disabled = true;
		document.frmData.kecamatan_p1.disabled = true;
		document.frmData.kabupaten_p1.disabled = true;
		document.frmData.jenis_usaha.disabled = true;
		document.frmData.status.disabled = true;
		document.frmData.kategori.disabled = true;
		document.frmData.jml_karyawan.disabled = true;
		document.frmData.ukuran_tempat.disabled = true;
		document.frmData.izin.disabled = true;
		document.frmData.nomor.disabled = true;
		document.frmData.tanggal.disabled = true;
		document.frmData.jenis_pajak.disabled = true;
		document.frmData.omset.disabled = true;
		//document.frmData.air_tanah.disabled = true;
		document.frmData.tgl.disabled = true;
	}
	
	function pilih(){
		$pil=document.getElementById("jenis_usaha").value;
        if ($pil!='10'){
				document.frmData.omset.disabled = false;
                document.frmData.jenis_pajak.value = '1';
                document.frmData.nama_pajak.value = 'Pajak Daerah';
				//document.frmData.air_tanah.disabled = true;
				//document.frmData.air_tanah.value = "";
				}else 		
           {
                document.frmData.omset.disabled = true;
                document.frmData.omset.value = '0';
                document.frmData.jenis_pajak.value = '2';
                document.frmData.nama_pajak.value = 'Retribusi Daerah';				
		  }
	}
    
    function cetak(){
        window.open('<?php echo site_url(); ?>/home/cetak_registrasi?id='+document.frmData.id.value, '', 'height=700,width=1000,scrollbars=yes');
    }
    
    function cetak_form(){
        window.open('<?php echo base_url(); ?>images/FORM_PENDAFTARAN_PAJAK.pdf');
    }
    	
	cal1 = new dhtmlxCalendarObject('tanggal');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('tgl');
	cal2.setDateFormat('%d/%m/%Y');
	
	statusEnding();
</script>
</div>