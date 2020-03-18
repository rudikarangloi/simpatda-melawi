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
	
	function lihat() {
		if(document.frmPerusahaan.id_pemilik.value=="") {
			alert("ID Pemilik/NPWPD Tidak Boleh Kosong");
			document.frmPerusahaan.id_pemilik.focus();
			return;
		}
		document.frmPerusahaan.nama.value = "";
		document.frmPerusahaan.alamat.value = "";
		
		var postStr =
		"id_pemilik=" + document.frmPerusahaan.id_pemilik.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/izin/lihat_pemilik', postStr, responeP);			
	}
	
	function responeP(loader) {
		statusEnding();
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result==0) {
					alert("Maaf ID Pemilik tidak terdaftar");
				} else {
					arr = result.split(',');
					document.frmPerusahaan.nama.value = arr[0];
					document.frmPerusahaan.alamat.value = arr[1];
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function lihat2() {
		op = document.frmPerusahaan2.cek.value;
		if(op==1||op==2||op==3|op==4|op==5){
			if(document.frmPerusahaan2.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmPerusahaan2.values.focus();
			return;
			}
		}
		nilai = document.frmPerusahaan2.values.value;
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	function simpan() {
		if(document.frmPerusahaan.nama_perusahaan.value=="") {
			alert("Nama Perusahaan Tidak Boleh Kosong");
			document.frmPerusahaan.nama_perusahaan.focus();
			return;
		}
		
		if(document.frmPerusahaan.jenis_spt.value=="") {
			alert("Jenis SPT Tidak Boleh Kosong");
			document.frmPerusahaan.jenis_spt.focus();
			return;
		}
		
		if(document.frmPerusahaan.alamat_perusahaan.value=="") {
			alert("Alamat Perusahaan Tidak Boleh Kosong");
			document.frmPerusahaan.alamat_perusahaan.focus();
			return;
		}
		
		if(document.frmPerusahaan.kelurahan.value=="") {
			alert("Kelurahan Perusahaan Tidak Boleh Kosong");
			document.frmPerusahaan.kelurahan.focus();
			return;
		}
		
		if(document.frmPerusahaan.id_pemilik.value=="") {
			alert("NPWPD Pemilik Tidak Boleh Kosong");
			document.frmPerusahaan.id_pemilik.focus();
			return;
		}
		
		if(document.frmPerusahaan.tgl.value=="") {
			alert("Tanggal Pendaftaran Tidak Boleh Kosong");
			document.frmPerusahaan.tgl.focus();
			return;
		}
		
		/*if(document.frmPerusahaan.nama_p.value=="") {
			alert("Nama Pemilik Tidak Boleh Kosong");
			document.frmPerusahaan.nama_p.focus();
			return;
		}
		
		if(document.frmPerusahaan.alamat_p.value=="") {
			alert("Alamat Pemilik Tidak Boleh Kosong");
			document.frmPerusahaan.alamat_p.focus();
			return;
		}
		
		if(document.frmPerusahaan.lokasi_p.value=="") {
			alert("Lokasi Tempat Tinggal Tidak Boleh Kosong");
			document.frmPerusahaan.lokasi_p.focus();
			return;
		} else if(document.frmPerusahaan.lokasi_p.value==1){
			if(document.frmPerusahaan.kelurahan_p.value==""){
			alert("Kelurahan Dalam Kota Lahir Tidak Boleh Kosong");
			document.frmPerusahaan.kelurahan_p.focus();
			return;
			}
		} else if(document.frmPerusahaan.lokasi_p.value==2){
			if(document.frmPerusahaan.kelurahan_p1.value==""){
			alert("Kelurahan Luar Kota Lahir Tidak Boleh Kosong");
			document.frmPerusahaan.kelurahan_p1.focus();
			return;
			}
			
			if(document.frmPerusahaan.kecamatan_p1.value==""){
			alert("Kecamatan Luar Kota Lahir Tidak Boleh Kosong");
			document.frmPerusahaan.kecamatan_p1.focus();
			return;
			}
			
			if(document.frmPerusahaan.kabupaten_p1.value==""){
			alert("Kabupaten Luar Kota Lahir Tidak Boleh Kosong");
			document.frmPerusahaan.kabupaten_p1.focus();
			return;
			}
		}
		
		if(document.frmPerusahaan.lokasi_p.value==1){
			kel = document.frmPerusahaan.kelurahan_p.value;
			kec = document.frmPerusahaan.kecamatan_p.value;
			kab = document.frmPerusahaan.kabupaten_p.value;
		} else if(document.frmPerusahaan.lokasi_p.value==2){
			kel = document.frmPerusahaan.kelurahan_p1.value;
			kec = document.frmPerusahaan.kecamatan_p1.value;
			kab = document.frmPerusahaan.kabupaten_p1.value;
		}
		
		if(document.frmPerusahaan.tlp_p.value==""){
			alert("No. Handphone Tidak Boleh Kosong");
			document.frmPerusahaan.tlp_p.focus();
			return;
		}
		
		if(document.frmPerusahaan.jenis_usaha.value==""){
			alert("Jenis Usaha Tidak Boleh Kosong");
			document.frmPerusahaan.jenis_usaha.focus();
			return;
		}
		
		if(document.frmPerusahaan.status.value==""){
			alert("Status Tidak Boleh Kosong");
			document.frmPerusahaan.status.focus();
			return;
		}*/
		
		if(document.frmPerusahaan.jenis_pajak.value==""){
			alert("Jenis Pajak Tidak Boleh Kosong");
			document.frmPerusahaan.jenis_pajak.focus();
			return;
		}
        
        if(document.frmPerusahaan.gol_pajak.value==""){
			alert("Golongan Pajak Tidak Boleh Kosong");
			document.frmPerusahaan.gol_pajak.focus();
			return;
		}
		if(document.frmPerusahaan.sptpd1.value==""){
			alert("Jenis Pajak Tidak Boleh Kosong");
			document.frmPerusahaan.sptpd1.focus();
			return;
		} 
		
		var pemStr = 
			"id_pemilik=" + document.frmPerusahaan.id_pemilik.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/izin/cek_pemilik', pemStr, pemPOST);
	}
	
	function pemPOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result==0) {
					alert('NPWPD Pemilik Belum Terdaftar');
					statusEnding();
				} else {
					simpan_perusahaan();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
		
	function simpan_perusahaan(){
		s = document.frmPerusahaan.tanggal.value;
		arr = s.split("/");
		tanggal = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		w = document.frmPerusahaan.tgl.value;
		arr = w.split("/");
		tgl_daftar = arr[2]+'-'+arr[1]+'-'+arr[0];
		var nama = document.frmPerusahaan.nama_perusahaan.value;
		nama = nama.replace(/&/g,"%26");
		//jp = document.frmPerusahaan.jenis_pajak.value;
//		if(jp==1||jp==2||jp==3||jp==4||jp==5||jp==6||jp==7||jp==8){
//			jpd = document.frmPerusahaan.omset.value;
//		} else if(jp==9){
//			jpd = document.frmPerusahaan.air_tanah.value;
//		}
		
		var postStr =
			"id=" + document.frmPerusahaan.id.value +
			"&id_perusahaan=" + document.frmPerusahaan.id_perusahaan.value +
			"&id_perusahaan_lama=" + document.frmPerusahaan.id_perusahaan_lama.value +
			"&no_daftar=" + document.frmPerusahaan.no_daftar.value +
			"&nama_perusahaan=" + nama +
			"&alamat_perusahaan=" + document.frmPerusahaan.alamat_perusahaan.value +
			//"&jalan=" + document.frmPerusahaan.jalan.value +
			"&rt=" + document.frmPerusahaan.rt.value +
			"&rw=" + document.frmPerusahaan.rw.value +
			"&email=" + document.frmPerusahaan.email.value +
			"&kelurahan=" + document.frmPerusahaan.kelurahan.value +
			"&kecamatan=" + document.frmPerusahaan.kecamatan2.value +
			"&kabupaten=" + document.frmPerusahaan.kabupaten.value +
			"&telp=" + document.frmPerusahaan.tlp.value +
			"&kodepos=" + document.frmPerusahaan.kodepos.value +
			"&jenis_spt=" + document.frmPerusahaan.jenis_spt.value +
			"&id_pemilik=" + document.frmPerusahaan.id_pemilik.value +
			/*"&nama_p=" + document.frmPerusahaan.nama_p.value +
			"&alamat_p=" + document.frmPerusahaan.alamat_p.value +
			"&jalan_p=" + document.frmPerusahaan.jalan_p.value +
			"&rt_p=" + document.frmPerusahaan.rt_p.value +
			"&rw_p=" + document.frmPerusahaan.rw_p.value +
			"&email_p=" + document.frmPerusahaan.email_p.value +
			"&lokasi_p=" + document.frmPerusahaan.lokasi_p.value +
			"&kelurahan_p=" + kel +
			"&kecamatan_p=" + kec +
			"&kabupaten_p=" + kab +
			"&telp_p=" + document.frmPerusahaan.tlp_p.value +
			"&kodepos_p=" + document.frmPerusahaan.kodepos_p.value +
			*/
			"&sptpd=" + document.frmPerusahaan.idsptpd.value +
			"&sptpd1=" + document.frmPerusahaan.sptpd1.value +
			"&status=" + document.frmPerusahaan.status.value +
			//"&kategori=" + document.frmPerusahaan.kategori.value +
			"&jml_karyawan=" + document.frmPerusahaan.jml_karyawan.value +
			"&ukuran_tempat=" + document.frmPerusahaan.ukuran_tempat.value +
			"&izin=" + document.frmPerusahaan.izin.value +
			"&nomor=" + document.frmPerusahaan.nomor.value +
			"&tanggal=" + tanggal +
			"&jenis_pajak=" + document.frmPerusahaan.jenis_pajak.value +
            "&gol_pajak=" + document.frmPerusahaan.gol_pajak.value +
			//"&jns=" + jpd +
			"&tgl_daftar=" + tgl_daftar;
		dhtmlxAjax.post(base_url+'index.php/izin/simpan_perusahaan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result==0) {
					alert('Proses Update Data Gagal');
				} else {
					document.frmPerusahaan.id_perusahaan.value = result;
					//kosongfrmPerusahaan();
					statusEnding();
					refreshData();
					disabledData();
					enableButton();
					alert('Proses Berhasil');
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmPerusahaan() {
		document.frmPerusahaan.id.value = "";
		document.frmPerusahaan.id_perusahaan.value = "";
		document.frmPerusahaan.id_perusahaan_lama.value = "";
		document.frmPerusahaan.no_daftar.value = "";
		document.frmPerusahaan.nama_perusahaan.value = "";
		document.frmPerusahaan.alamat_perusahaan.value = "";
		//document.frmPerusahaan.jalan.value = "";
		document.frmPerusahaan.rt.value = "";
		document.frmPerusahaan.rw.value = "";
		document.frmPerusahaan.email.value = "";
		document.frmPerusahaan.kelurahan.value = "";
		document.frmPerusahaan.kecamatan2.value = "";
		document.frmPerusahaan.nm_kec.value = "";
		document.frmPerusahaan.tlp.value = "";
		document.frmPerusahaan.kodepos.value = "";
		document.frmPerusahaan.id_pemilik.value = "";
		document.frmPerusahaan.nama_p.value = "";
		document.frmPerusahaan.alamat_p.value = "";
		//document.frmPerusahaan.jalan_p.value = "";
		document.frmPerusahaan.rt_p.value = "";
		document.frmPerusahaan.rw_p.value = "";
		document.frmPerusahaan.email_p.value = "";
		document.frmPerusahaan.tlp_p.value = "";
		document.frmPerusahaan.kodepos_p.value = "";
		document.frmPerusahaan.lokasi_p.value = "";
		document.frmPerusahaan.kelurahan_p.value = "";
		document.frmPerusahaan.kecamatan_p.value = "";
		document.frmPerusahaan.kelurahan_p1.value = "";
		document.frmPerusahaan.kecamatan_p1.value = "";
		document.frmPerusahaan.kabupaten_p1.value = "";
		document.frmPerusahaan.sptpd.value = "";
		document.frmPerusahaan.sptpd1.value = "";
		document.frmPerusahaan.status.value = "";
		//document.frmPerusahaan.kategori.value = "";
		document.frmPerusahaan.jml_karyawan.value = "";
		document.frmPerusahaan.ukuran_tempat.value = "";
		document.frmPerusahaan.izin.value = "";
		document.frmPerusahaan.nomor.value = "";
		document.frmPerusahaan.tanggal.value = "";
		document.frmPerusahaan.jenis_pajak.value = "1";
		//document.frmPerusahaan.omset.value = "";
		//document.frmPerusahaan.air_tanah.value = "";
		document.frmPerusahaan.tgl.value = "";
		document.frmPerusahaan.jenis_spt.value = "";
        document.frmPerusahaan.gol_pajak.value = "";
	}
	
	function enabledData() {
		document.frmPerusahaan.nama_perusahaan.disabled = false;
		document.frmPerusahaan.id_perusahaan_lama.disabled = false;
		document.frmPerusahaan.alamat_perusahaan.disabled = false;
		//document.frmPerusahaan.jalan.disabled = false;
		document.frmPerusahaan.rt.disabled = false;
		document.frmPerusahaan.rw.disabled = false;
		document.frmPerusahaan.email.disabled = false;
		document.frmPerusahaan.kelurahan.disabled = false;
		document.frmPerusahaan.tlp.disabled = false;
		document.frmPerusahaan.kodepos.disabled = false;
		document.frmPerusahaan.id_pemilik.disabled = false;
		document.frmPerusahaan.cari.disabled = false;
		
		document.frmPerusahaan.sptpd.disabled = false;
		document.frmPerusahaan.sptpd1.disabled = false;
		document.frmPerusahaan.status.disabled = false;
		//document.frmPerusahaan.kategori.disabled = false;
		document.frmPerusahaan.jml_karyawan.disabled = false;
		document.frmPerusahaan.ukuran_tempat.disabled = false;
		document.frmPerusahaan.izin.disabled = false;
		document.frmPerusahaan.nomor.disabled = false;
		document.frmPerusahaan.tanggal.disabled = false;
		//document.frmPerusahaan.jenis_pajak.disabled = false;
        document.frmPerusahaan.gol_pajak.disabled = false;
		document.frmPerusahaan.tgl.disabled = false;
 
     
   	}
	
	function enabledPemilik(){
		document.frmPerusahaan.nama_p.disabled = false;
		document.frmPerusahaan.alamat_p.disabled = false;
		//document.frmPerusahaan.jalan_p.disabled = false;
		document.frmPerusahaan.rt_p.disabled = false;
		document.frmPerusahaan.rw_p.disabled = false;
		document.frmPerusahaan.email_p.disabled = false;
		document.frmPerusahaan.tlp_p.disabled = false;
		document.frmPerusahaan.kodepos_p.disabled = false;
		document.frmPerusahaan.lokasi_p.disabled = false;
	}
	
	function disabledData() {
		document.frmPerusahaan.id_perusahaan_lama.disabled = true;
		document.frmPerusahaan.nama_perusahaan.disabled = true;
		document.frmPerusahaan.alamat_perusahaan.disabled = true;
		//document.frmPerusahaan.jalan.disabled = true;
		document.frmPerusahaan.rt.disabled = true;
		document.frmPerusahaan.rw.disabled = true;
		document.frmPerusahaan.email.disabled = true;
		document.frmPerusahaan.kelurahan.disabled = true;
		document.frmPerusahaan.tlp.disabled = true;
		document.frmPerusahaan.kodepos.disabled = true;
		document.frmPerusahaan.id_pemilik.disabled = true;
		document.frmPerusahaan.nama_p.disabled = true;
		document.frmPerusahaan.alamat_p.disabled = true;
		//document.frmPerusahaan.jalan_p.disabled = true;
		document.frmPerusahaan.rt_p.disabled = true;
		document.frmPerusahaan.rw_p.disabled = true;
		document.frmPerusahaan.email_p.disabled = true;
		document.frmPerusahaan.tlp_p.disabled = true;
		document.frmPerusahaan.kodepos_p.disabled = true;
		document.frmPerusahaan.lokasi_p.disabled = true;
		document.frmPerusahaan.sptpd.disabled = true;
		document.frmPerusahaan.sptpd1.disabled = true;
		document.frmPerusahaan.status.disabled = true;
		//document.frmPerusahaan.kategori.disabled = true;
		document.frmPerusahaan.jml_karyawan.disabled = true;
		document.frmPerusahaan.ukuran_tempat.disabled = true;
		document.frmPerusahaan.izin.disabled = true;
		document.frmPerusahaan.nomor.disabled = true;
		document.frmPerusahaan.tanggal.disabled = true;
		document.frmPerusahaan.jenis_pajak.disabled = true;
		document.frmPerusahaan.tgl.disabled = true;
        document.frmPerusahaan.gol_pajak.disabled = true;
	}
	
	function disabledButton() {
		document.frmPerusahaan.tambah.disabled = true;
		document.frmPerusahaan.delete1.disabled = true;
		document.frmPerusahaan.cetak.disabled = true;
		//document.frmPerusahaan.cetak_f.disabled = true;
	
	}	
		
	function enableButton() {
		document.frmPerusahaan.tambah.disabled = false;
		document.frmPerusahaan.delete1.disabled = false;
		document.frmPerusahaan.cetak.disabled = false;
		//document.frmPerusahaan.cetak_f.disabled = false;
	
	}
	
	function ckelurahan() {
		var postStr =
			"kelurahan=" + document.frmPerusahaan.kelurahan.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/izin/ckel', postStr, wenePOST);
	}
	
	function wenePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					//res = result.split('|');
					//document.frmPerusahaan.kecamatan.value = res[0];
					document.frmPerusahaan.nm_kec.value = result;
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function ckecamatan() {
		var postStr =
			"kelurahan=" + document.frmPerusahaan.kelurahan.value;            
		statusLoading();
		//alert(postStr);
		dhtmlxAjax.post(base_url+'index.php/izin/ckec', postStr, wenePOST);
	}
	
	function wenePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {					
					res = result.split('|');
					document.frmPerusahaan.kecamatan2.value = res[0];					
					document.frmPerusahaan.nm_kec.value = res[1];
					document.frmPerusahaan.kelurahan_hide.value = res[2];
                    document.frmPerusahaan.kelurahan.value = res[3];                    					                   
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
    function ckecamatan_pemilik() {
		var postStr2 =
			"kelurahan=" + document.frmPerusahaan.kelurahan_p.value;            			
		statusLoading();				
		dhtmlxAjax.post(base_url+'index.php/izin/ckec_2', postStr2, pemilikPOST);
	}
	
	function pemilikPOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {									
					res = result.split('|');					
					var dkec = res[0];
					var dkel = res[2];
					document.frmPerusahaan.kecamatan_p.value = res[0];
					document.frmPerusahaan.nm_kecamatan_p.value = res[1];					
                    document.frmPerusahaan.kelurahan_p_hide.value = res[2];  					
					document.frmPerusahaan.kelurahan_p.value = dkec+"-"+dkel;   	
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
    
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
</script>

<style>
body{
		background:#FFF;
	}
	.oval_big {
		width: 875px;
		margin:0px 5px 25px 30px;
		padding: 10px;
		border:1px solid #CCC;
		border-radius:10px;
		-moz-border-radius:10px;
	}
</style>
<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Pendaftaran Usaha</h2>

<div id="a_tabbar" style="width:1280px; height:810px; margin-left:30px;"></div>
  <div id="C1" style="width:1280px; background-color: #B3D9F0; padding-bottom:10px;"><br />
    <form name="frmPerusahaan" id="frmPerusahaan" action="<?php echo site_url(); ?>/izin/cetak_perusahaan" method="post" onSubmit="popupform(this, 'Perusahaan')">
    	<table>
		 <tr>
            	<td style="padding-left:15px;"><strong>ID Pemilik</strong></td>
                <td><input type="text" name="id_pemilik" id="id_pemilik" size="35" style="text-transform:uppercase; background-color: #FFCC99;" disabled/><input type="button" name="cari" id="cari" onclick="opens()" style="padding-left:20px; padding-right:20px" value="Cari" disabled/></td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Nama Pemilik</strong></td>
                <td><input type="text" name="nama_p" id="nama_p" size="45" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Alamat Pemilik</strong></td>
                <td><input type="text" name="alamat_p" id="alamat_p" size="45" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
            <!--<tr>
              	<td style="padding-left:35px;">Jalan</td>
                <td><input type="text" style="background-color:#FFFFCC;" name="jalan_p" id="jalan_p" size="45" disabled/></td>
            </tr>-->
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
              	<td width="170" style="padding-left:15px;"> Kelurahan / Desa</td>
                <td><input type="hidden" name="kelurahan_p_hide" id="kelurahan_p_hide" />
				<select name="kelurahan_p" id="kelurahan_p" onchange="ckecamatan_pemilik()" disabled>
                <option value=""></option>
                <?php 
				foreach($kelurahan->result() as $rs) {
						echo "<option value=".$rs->kode_kecamatan."-".$rs->kode_kelurahan.">".$rs->nama_kelurahan."</option>";
					}
				?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Kecamatan</td>
                <td><input type="hidden" name="kecamatan_p" id="kecamatan_p" />
                <input type="text" name="nm_kecamatan_p" id="nm_kecamatan_p" size="45" disabled>
                </td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Kabupaten / Kota</td>
                <td><input type="text" name="kabupaten_p" id="kabupaten_p" value="Kabupaten Melawi" size="45" style="background-color:#FFFFCC;" disabled="disabled" /></td>
            </tr>
            </table>
            </fieldset>
            </td>
            <td>
            	<fieldset><legend>Luar Kota</legend>
               <table>
                <tr>
                    <td width="170" style="padding-left:15px;"> Kelurahan</td>
                    <td><input type="text" name="kelurahan_p1" id="kelurahan_p1" size="35" style="background-color:#FFCC99;" disabled/></td>
                </tr>
                <tr>
                    <td style="padding-left:15px;"> Kecamatan</td>
                    <td><input type="text" name="kecamatan_p1" id="kecamatan_p1" size="35" style="background-color:#FFCC99;" disabled="disabled"></td>
                </tr>
                <tr>
                    <td style="padding-left:15px;"> Kabupaten / Kota</td>
                    <td><input type="text" name="kabupaten_p1" id="kabupaten_p1" size="35" style="background-color:#FFCC99;" disabled="disabled" /></td>
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
				<td style="padding-left:15px;"><strong>Alamat Usaha</strong></td>
                <td><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kode Pos</td>
				<td><input type="text" style="background-color:#FFFFCC;"  name="kodepos_p" id="kodepos_p" disabled="disabled" size="45"/></td>
				<td style="padding-left:35px;">RT 
                <input type="text" name="rt" id="rt" size="1" disabled/> RW 
                <input type="text" name="rw" id="rw" size="1" disabled/></td>
                <td>Alamat Email <input type="text" name="email" id="email" size="29" disabled/></td>
            </tr> 
            <tr>
                <td width="250" style="padding-left:15px;"><strong>NPWPD Usaha</strong></td>
                <td><input type="text" name="id_perusahaan" id="id_perusahaan" size="45" style="background-color:#FFFFCC;" disabled/>
                <input type="hidden" name="id" id="id" size="45" style="background-color:#FFFFCC;"/>
                <input type="hidden" name="no_daftar" id="no_daftar" size="45" style="background-color:#FFFFCC;"/></td>
				<td style="padding-left:35px;">Kelurahan / Desa</td>
                <td><input type="hidden" name="kelurahan_hide" id="kelurahan_hide" size="4" disabled="disabled" />
				<select name="kelurahan" id="kelurahan" onchange="ckecamatan();" disabled>
                <option value=""></option>
                <?php 
				foreach($kelurahan->result() as $rs) {
						echo "<option value=".$rs->id.">".$rs->nama_kelurahan."</option>";
					}
				?>
                </select></td>
           	</tr>
             <tr>
              	<td style="padding-left:15px;"><strong>NPWPD Usaha Lama</strong></td>
                <td><input type="text" name="id_perusahaan_lama" id="id_perusahaan_lama" size="45" disabled/></td>
				<td style="padding-left:35px;">Kecamatan</td>
                <td><input type="hidden" name="kecamatan2" id="kecamatan2" size="4" disabled="disabled" />
              <input type="text" name="nm_kec" id="nm_kec" size="45" disabled="disabled"></td>
            </tr>
			<tr>
              	<td style="padding-left:15px;"><strong>Nama Usaha</strong></td>
                <td><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45" disabled/></td>
				<td style="padding-left:35px;">Kabupaten / Kota</td>
                <td><input type="text" name="kabupaten" id="kabupaten" value="Kabupaten Melawi" size="45" disabled="disabled" style="background-color:#FFFFCC;" /></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Telepon</td>
				<td><input type="text" name="tlp" id="tlp" disabled="disabled" size="45"/></td>
				<td style="padding-left:15px;"><strong>Rekening Pajak</strong></td>
                <td><select id="sptpd1" class="sptpd1" onchange="crek_pajak()" disabled>
                <option value=""></option>
				<?php 
                foreach($reke->result() as $rs1) {
                        echo "<option value=".$rs1->pajak.">".$rs1->nm_rek."</option>";
                    }
                ?>
                </select></td>
            </tr>
            <tr>
              	<td style="padding-left:35px;">Kode Pos</td>
				<td><input type="text" name="kodepos" id="kodepos" disabled="disabled" size="45" /></td>
				<td style="padding-left:35px;">Status</td>
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
              	<!--<td style="padding-left:15px;"><strong>Jenis Usaha</strong></td>-->
                <td><input type="hidden" name="sptpd" id="sptpd" disabled="disabled" size="30"/>
				<input type="hidden" name="idsptpd" id="idsptpd" disabled="disabled" size="30"/>
				</td>
            </tr>
			<tr>
              	<td style="padding-left:15px;"><strong>Ukuran Tempat Usaha</strong></td>
				<td><input type="text" name="ukuran_tempat" id="ukuran_tempat" disabled="disabled" size="45"/></td>
				<td style="padding-left:35px;">Jumlah Karyawan</td>
				<td><input type="text" name="jml_karyawan" id="jml_karyawan" disabled="disabled" size="45"/></td>
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
            <!--<tr>
              	<td style="padding-left:15px;"><strong>Jenis Pajak</strong></td>
				<td>
					<select name="jenis_pajak" disabled="disabled" id="jenis_pajak" onchange="pilih()">
						<option value=""></option>
						//<?php
//						foreach($sptpd->result() as $dt){
//							echo "<option value='".$dt->id."'>".$dt->nama_sptpd."</option>";
//						}
//						?>
					</select>
				</td>
            </tr>!-->
            <tr>
              <td style="padding-left:15px;"><strong>Jenis SPT</strong></td>
              <td><select name="jenis_spt" id="jenis_spt">
                <option value=""> </option>
                <option value="0">Reguler</option>
                <option value="1">Insidentil</option>
              </select></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Jenis Pajak</strong></td>
				<td>
					<select name="jenis_pajak" disabled="disabled" id="jenis_pajak">
						<option value=""></option>
                        <?php 
                        foreach($jenis_pajak->result() as $rs) {
                        echo "<option value=".$rs->id.">".$rs->nama_pajak."</option>";
                        }
                        ?>
                        <!--<option value="1">Pajak Daerah</option>
                        <option value="2">Retribusi Daerah</option>-->
					</select>
				</td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"><strong>Golongan Wajib Pajak</strong></td>
				<td>
					<select name="gol_pajak" disabled="disabled" id="gol_pajak">
						<option value=""></option>
                        <option value="1">Umum</option>
                        <option value="2">Instansi</option>
					</select>
				</td>
            </tr>
                
            <!--<tr>
            	<td colspan="2">
            	<table>
            	<tr>
            		<td>
                        <fieldset><legend>Usaha</legend>
                        <table>
                        <tr>
                            <td>Omset/Bulan</td>
                            <td><input type="text" nama="omset" id="omset" disabled="disabled"></td>
                        </tr>
                        </table>
                        </fieldset>
                        </td>
                    <td>
                        <fieldset><legend>Air Tanah</legend>
                       	<table>
                        <tr>
                            <td>Pemakaian Air M3/Bulan</td>
                            <td><input type="text" name="air_tanah" id="air_tanah" disabled="disabled"/></td>
                        </tr>
                        </table>
                    	</fieldset>
                	</td>
                </tr>
                </table>
            	</td>
            </tr>!-->
            <tr>
              	<td style="padding-left:15px;"> Tanggal Pendaftaran</td>
                <td><input name="tgl" type="text" disabled="disabled" id="tgl" size="45" ></td>
            </tr>
            <tr>
            	<td style="padding-left:15px; background-color:#FFCC99;" colspan="2"><!--<input type="button" value="Open Data Register" id="reg" name="reg" onclick="openData()" style="padding-left:20px; padding-right:20px" />--><input type="button" value="Baru" id="new1" name="new1" onclick="baru()" style="padding-left:20px; padding-right:20px" />
                <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/> <!---->
                <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
                <input type="button" onclick="cetak1()" value="Cetak" id="cetak" name="cetak" style="padding-left:20px; padding-right:20px" disabled/>
               <!-- <input type="button" onclick="cetak2()" value="Cetak Formulir" id="cetak_f" name="cetak_f" style="padding-left:20px; padding-right:20px" disabled/>-->
                </td>
            </tr>
    	</table>
    </form>
    <br />
</div>

<div id="C2" style="width:1300px;">
<br />
    <form name="frmPerusahaan2" id="frmPerusahaan2">
    <table>
    	<tr>
        	<td style="padding-left:15px;">Cari data berdasarkan</td>
            <td><select nama="cek" id="cek">
            <option value="1">NPWPD Usaha</option>
            <option value="2">Nama Usaha</option>
            <option value="3">Nama Pemilik</option>			
            </select></td>
            <td>Value</td>
            <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
            <td><input type="button" onclick="lihat2()" name="filter" value="Cari" style="padding-left:20px; padding-right:20px"/></td>
			<td>&nbsp;</td>
			<td><select id="sptpd2" class="sptd2" onchange="cari2()" >
                <option value="">Semua</option>
				<?php 
                foreach($reke->result() as $rs1) {
                        echo "<option value=".$rs1->pajak.">".$rs1->nm_rek."</option>";
                    }
                ?>
                </select></td>
			
        </tr>
    </table>
    </form>
    <div style="padding:0 0px 10px 0px;">
   		<div id="gridContent" height="620px" width="1270px" style="margin-bottom:10px;"></div>
        <div id="pagingArea" width="350px" style="background-color:white;"></div>
	</div>
</div>

<div id="objBrg" style="display:none;">
<form name="frmSrc1" id="frmSrc1" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="0">Tidak di filter</option>
            <option value="1">ID</option>
            <option value="2">Nama Pemilik</option>
            <option value="3">Alamat</option>
            <option value="4">No. Identitas</option>
            <option value="5">Alamat Email</option>
            <option value="6">Kewarganegaraan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="250px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>

<div id="objBrg21" style="display:none;">
<form name="frmSrc21" id="frmSrc21" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">No. Registrasi</option>
            <option value="2">Nama Usaha</option>
            <option value="3">ID Pemilik</option>
            <option value="4">Nama Pemilik</option>
            <option value="5">Jenis Usaha</option>
            <option value="6">Jenis Pajak</option>
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

<div id="objPem" style="display:none;">
<form name="frmPem" id="frmPem" method="post" action="javascript:void(0);">
<br />
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">No. NPWPD</option>
            <option value="2">Nama Pemilik</option>
            <option value="3">Alamat Pemilik</option>
            <option value="4">No. Identitas</option>
            <option value="5">Email</option>
            <option value="6">Kewarganegaraan</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihatPem()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batalPem()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="250px" style="margin-bottom:10px;"></div>
</div>
</div>


</div>
<script language="javascript">
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('tanggal');
	cal2.setDateFormat('%d/%m/%Y');
	
	//Window Pemilik
	wPem21 = dhxWins.createWindow("wPem21",0,0,1000,370);
	wPem21.setText("Pencarian Data Pemilik");
	wPem21.button("park").hide();
	wPem21.button("close").hide();
	wPem21.button("minmax1").hide();
	wPem21.hide();

	function opens() {
		wPem21.show();
    	wPem21.setModal(true);
		wPem21.center();
		wPem21.attachObject('objPem');
	}
	
	function batalPem() {
		wPem21.hide();
		wPem21.setModal(false);
		document.frmPem.fil.value = "";
		document.frmPem.values.value = "";
		grids.clearAll();
	}
	
	function lihatPem() {
		op = document.frmPem.fil.value;
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmPem.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmPem.values.focus();
			return;
			}
		}
		nilai = document.frmPem.values.value;
		grids.clearAll();
		grids.loadXML("<?php echo site_url(); ?>/izin/load_pemilik/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	grids = new dhtmlXGridObject('gridCo');
	grids.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grids.setHeader("ID, ID_Pemilik, Jenis Identitas, Kewarganegaraan, No.Identitas, Nama, Alamat, Jalan, RT, RW, Email, Kelurahan, Kecamatan, Kabupaten, Tempat Lahir, Tanggal Lahir,Jenis Kelamin,Lokasi,HP,Nama Kecamatan");//19
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grids.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grids.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grids.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grids.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grids.enablePaging(true,50,10,"pagingArea",true);
	grids.setPagingSkin("bricks");
	grids.setSkin("dhx_skyblue");
	grids.setColumnHidden(0,true);
	grids.attachEvent("onRowDblClicked", selectedOpenData2);
	//grids.loadXML("<?//php echo site_url(); ?>/izin/data_pemilik");
	grids.init();
	baru();
	
	function selectedOpenData2(id) {
		document.frmPerusahaan.id_pemilik.value 	= grids.cells(id,1).getValue();
		document.frmPerusahaan.nama_p.value		= grids.cells(id,5).getValue();
		document.frmPerusahaan.alamat_p.value 	= grids.cells(id,6).getValue();
		//document.frmPerusahaan.jalan_p.value 	= grids.cells(id,7).getValue();
		document.frmPerusahaan.rt_p.value 	= grids.cells(id,8).getValue();
		document.frmPerusahaan.rw_p.value 	= grids.cells(id,9).getValue();
		document.frmPerusahaan.email_p.value 	= grids.cells(id,10).getValue();
		document.frmPerusahaan.lokasi_p.value = grids.cells(id,17).getValue();
		document.frmPerusahaan.tlp_p.value = grids.cells(id,18).getValue();
		if(document.frmPerusahaan.lokasi_p.value=='1'){
			//alert(grids.cells(id,11).getValue());
			var dkel = grids.cells(id,11).getValue();
			var dkec = grids.cells(id,12).getValue();
			document.frmPerusahaan.kelurahan_p.value = dkec+"-"+dkel;
			document.frmPerusahaan.kelurahan_p_hide.value = grids.cells(id,11).getValue();
			document.frmPerusahaan.kecamatan_p.value = grids.cells(id,12).getValue();
			document.frmPerusahaan.nm_kecamatan_p.value = grids.cells(id,19).getValue();
			document.frmPerusahaan.kabupaten_p.value = grids.cells(id,13).getValue();
		} else if(document.frmPerusahaan.lokasi_p.value=='2'){
			document.frmPerusahaan.kelurahan_p1.value = grids.cells(id,11).getValue();
			document.frmPerusahaan.kecamatan_p1.value = grids.cells(id,12).getValue();
			document.frmPerusahaan.kabupaten_p1.value = grids.cells(id,13).getValue();
		}
		batal();
	}
	
	//Window Register
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
	gridData.setHeader("id, no_daftar, nama_usaha, alamat_usaha, jalan, rt, rw, email, kode_kel, kelurahan, kode_kec, kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_pemilik, rt_pemilik, rw_pemilik, email_pemilik, telp_pemilik, lokasi_pemilik, kelurahan_pemilik, nama_kelurahan, kecamatan_pemilik, nama_kecamatan, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, perkiraan_omset, tgl_daftar");//36
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
		document.frmPerusahaan.no_daftar.value = gridData.cells(id,1).getValue();
		document.frmPerusahaan.nama_perusahaan.value = gridData.cells(id,2).getValue();
		document.frmPerusahaan.alamat_perusahaan.value = gridData.cells(id,3).getValue();
		//document.frmPerusahaan.jalan.value = gridData.cells(id,4).getValue();
		document.frmPerusahaan.rt.value = gridData.cells(id,5).getValue();
		document.frmPerusahaan.rw.value = gridData.cells(id,6).getValue();
		document.frmPerusahaan.email.value = gridData.cells(id,7).getValue();
		document.frmPerusahaan.kelurahan.value = gridData.cells(id,8).getValue();        
		document.frmPerusahaan.kecamatan2.value = gridData.cells(id,10).getValue();		
		document.frmPerusahaan.nm_kec.value = gridData.cells(id,11).getValue();		
		document.frmPerusahaan.kabupaten.value = gridData.cells(id,12).getValue();
		document.frmPerusahaan.tlp.value = gridData.cells(id,13).getValue();
		document.frmPerusahaan.kodepos.value = gridData.cells(id,14).getValue();
		document.frmPerusahaan.id_pemilik.value = gridData.cells(id,15).getValue();
		document.frmPerusahaan.nama_p.value = gridData.cells(id,16).getValue();
		document.frmPerusahaan.alamat_p.value = gridData.cells(id,17).getValue();
		//document.frmPerusahaan.jalan_p.value = gridData.cells(id,18).getValue();
		document.frmPerusahaan.rt_p.value = gridData.cells(id,19).getValue();
		document.frmPerusahaan.rw_p.value = gridData.cells(id,20).getValue();
		document.frmPerusahaan.email_p.value = gridData.cells(id,21).getValue();		                
		document.frmPerusahaan.lokasi_p.value = gridData.cells(id,23).getValue();
		if(document.frmPerusahaan.lokasi_p.value=='1'||document.frmPerusahaan.lokasi_p.value=='Dalam Kota'){		   
			document.frmPerusahaan.kelurahan_p.value = gridData.cells(id,24).getValue();
			document.frmPerusahaan.kecamatan_p.value = gridData.cells(id,26).getValue();
			document.frmPerusahaan.kabupaten_p.value = gridData.cells(id,28).getValue();
            ckecamatan_pemilik();
		} else if(document.frmPerusahaan.lokasi_p.value=='2'){
			document.frmPerusahaan.kelurahan_p1.value = gridData.cells(id,25).getValue();
			document.frmPerusahaan.kecamatan_p1.value = gridData.cells(id,27).getValue();
			document.frmPerusahaan.kabupaten_p1.value = gridData.cells(id,28).getValue();
		}
		document.frmPerusahaan.tlp_p.value = gridData.cells(id,22).getValue();
		document.frmPerusahaan.kodepos_p.value = gridData.cells(id,14).getValue();
		document.frmPerusahaan.sptpd.value = gridData.cells(id,31).getValue();
		document.frmPerusahaan.status.value = gridData.cells(id,32).getValue();
		//document.frmPerusahaan.kategori.value = gridData.cells(id,33).getValue();
		document.frmPerusahaan.jml_karyawan.value = gridData.cells(id,34).getValue();
		document.frmPerusahaan.ukuran_tempat.value = gridData.cells(id,35).getValue();
		document.frmPerusahaan.izin.value = gridData.cells(id,36).getValue();
		document.frmPerusahaan.nomor.value = gridData.cells(id,37).getValue();
		document.frmPerusahaan.tanggal.value = gridData.cells(id,38).getValue();
		document.frmPerusahaan.jenis_pajak.value = gridData.cells(id,39).getValue();
        //document.frmPerusahaan.gol_pajak.value = gridData.cells(id,39).getValue();
		//jp = gridData.cells(id,36).getValue();
//		if(jp=='1'||jp=='2'||jp=='3'||jp=='4'||jp=='5'||jp=='6'||jp=='7'||jp=='8'){
//			document.frmPerusahaan.omset.value = gridData.cells(id,37).getValue();
//		} else if (jp=='9'){
//			document.frmPerusahaan.air_tanah.value = gridData.cells(id,37).getValue();
//		}
		document.frmPerusahaan.tgl.value = gridData.cells(id,38).getValue();
		
		batal21();
		document.frmPerusahaan.tambah.disabled = false;
		document.frmPerusahaan.cari.disabled = false;
	}
	
	function pilih(){
		pil=document.getElementById("sptpd").value;
		//alert(pil);
		if(pil!=10){
			//document.frmPerusahaan.omset.disabled = false;
			//document.frmPerusahaan.air_tanah.disabled = true;            
            document.frmPerusahaan.jenis_pajak.value='1';
			//statusLoading();
			//dhtmlxAjax.post(base_url+'index.php/izin/ckel', postStr, wenePOST);
		}else{
			//document.frmPerusahaan.air_tanah.disabled = false;
			//document.frmPerusahaan.omset.disabled = true;
            document.frmPerusahaan.jenis_pajak.value='2';
		}
	}
	
	function crek_pajak() {
		var pil = document.frmPerusahaan.sptpd1.value;   
		var postStr =
			"crek_pajak_rin=" + pil;  
		if(pil<50){            
            document.frmPerusahaan.jenis_pajak.value='1';
		}else{
            document.frmPerusahaan.jenis_pajak.value='2';
		}
		
		statusLoading();
		//alert(postStr);
		dhtmlxAjax.post(base_url+'index.php/izin/crek_pajak', postStr, wenePOST_rek);
	} 
	
	
	function wenePOST_rek(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					res = result.split('|');
					document.frmPerusahaan.idsptpd.value = res[0];
					document.frmPerusahaan.sptpd.value = res[1];                                        
					statusEnding();
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function crinci() {
		var postStr =
			"kelurahan=" + document.frmData.kelurahan.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/home/ckel', postStr, wenePOST);
	}

	wBrog = dhxWins.createWindow("wBrog",0,0,800,370);
	wBrog.setText("Pencarian Data Pemilik");
	wBrog.button("park").hide();
	wBrog.button("close").hide();
	wBrog.button("minmax1").hide();
	wBrog.hide();

	function opens() {
		wBrog.show();
    	wBrog.setModal(true);
		wBrog.center();
		wBrog.attachObject('objBrg');
	}
	
	function batal() {
		wBrog.hide();
		wBrog.setModal(false);
		document.frmSrc1.fil.value = "";
		document.frmSrc1.values.value = "";
		grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmSrc1.fil.value;
		if(op==1||op==2||op==3|op==4|op==5|op==6){
			if(document.frmSrc1.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc1.values.focus();
			return;
			}
		}
		nilai = document.frmSrc1.values.value;
		grids.clearAll();
		grids.loadXML("<?php echo site_url(); ?>/izin/load_pemilik/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}

	function cari2() {
		var pil = document.frmPerusahaan2.sptpd2.value;   
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan_rek/"+pil);
	
	} 
	
	function baru() {
		kosongfrmPerusahaan();
		enabledData();
		document.frmPerusahaan.tambah.disabled = false;
		document.frmPerusahaan.delete1.disabled = true;
		document.frmPerusahaan.cetak.disabled = true;
		//document.frmPerusahaan.cetak_f.disabled = true;
		//document.frmPerusahaan.cek.disabled = false;
		//document.frmPerusahaan.id_pemilik.focus();
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, NPWPD Usaha Baru, NPWPD Usaha Lama,Nama Usaha, Alamat_Usaha, RT, RW, Email,Kode Desa, Nama Desa,Kode Kecamatan, Nama Kecamatan, Kabupaten, Telp, Kodepos, Id Pemilik, Nama Pemilik, Alamat Pemilik, Jalan Pemilik, RT Pemilik, RW Pemilik, Email Pemilik, Lokasi Pemilik, Desa Pemilik, Kecamatan Pemilik, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, gol_pajak, tgl_daftar,idx,idauto,insidentil");//36
	grid.setInitWidths("50,150,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,50");//19
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,41,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setSkin("dhx_skyblue");
	grid.setColumnHidden(0,true);
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/izin/data_perusahaan");
	grid.init();
	
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/izin/data_perusahaan");
	}
	
	function cetak1() {
		if(document.frmPerusahaan.tgl.value=="") {
			alert("Tanggal Pendaftaran Tidak Boleh Kosong");
			document.frmPerusahaan.tgl.focus();
			return;
		}else{
		window.open('<?php echo site_url(); ?>/izin/cetak_peru?npwpd='+document.frmPerusahaan.id_perusahaan.value, '', 'height=700,width=1000,scrollbars=yes');
		}
	}
	
	function cetak2() {
		window.open('<?php echo site_url(); ?>/izin/cetak_peru2?npwpd='+document.frmPerusahaan.id_perusahaan.value, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function selectedOpenData(id) {
		tabbar.setTabActive("a1");
		statusLoading();
		kosongfrmPerusahaan();
		enableButton();
		enabledData();
		document.frmPerusahaan.id.value = grid.cells(id,0).getValue();
		document.frmPerusahaan.id_perusahaan.value = grid.cells(id,1).getValue();
		document.frmPerusahaan.id_perusahaan_lama.value = grid.cells(id,2).getValue();
		document.frmPerusahaan.nama_perusahaan.value = grid.cells(id,3).getValue();
		document.frmPerusahaan.alamat_perusahaan.value = grid.cells(id,4).getValue();
		//document.frmPerusahaan.jalan.value = grid.cells(id,4).getValue();
		document.frmPerusahaan.rt.value = grid.cells(id,5).getValue();
		document.frmPerusahaan.rw.value = grid.cells(id,6).getValue();
		document.frmPerusahaan.email.value = grid.cells(id,7).getValue();
		document.frmPerusahaan.kelurahan.value = grid.cells(id,39).getValue();
		document.frmPerusahaan.nm_kec.value = grid.cells(id,11).getValue();
		document.frmPerusahaan.kecamatan2.value = grid.cells(id,10).getValue();
		document.frmPerusahaan.kabupaten.value = grid.cells(id,12).getValue();
		document.frmPerusahaan.tlp.value = grid.cells(id,13).getValue();
		document.frmPerusahaan.kodepos.value = grid.cells(id,14).getValue();
		document.frmPerusahaan.id_pemilik.value = grid.cells(id,15).getValue();
		document.frmPerusahaan.nama_p.value = grid.cells(id,16).getValue();
		document.frmPerusahaan.alamat_p.value = grid.cells(id,17).getValue();
		//document.frmPerusahaan.jalan_p.value = grid.cells(id,18).getValue();
		document.frmPerusahaan.rt_p.value = grid.cells(id,19).getValue();
		document.frmPerusahaan.rw_p.value = grid.cells(id,20).getValue();
		document.frmPerusahaan.email_p.value = grid.cells(id,21).getValue();		
		document.frmPerusahaan.lokasi_p.value = grid.cells(id,22).getValue();		
		var xkel = grid.cells(id,23).getValue();
		var xkec = grid.cells(id,24).getValue();		
		if(document.frmPerusahaan.lokasi_p.value=='1'){
			document.frmPerusahaan.kelurahan_p.value =  xkec+"-"+xkel;
			document.frmPerusahaan.kecamatan_p.value = grid.cells(id,24).getValue();
			document.frmPerusahaan.kabupaten_p.value = grid.cells(id,25).getValue();
			 ckecamatan_pemilik(); 	
		} else if(document.frmPerusahaan.lokasi_p.value=='2'){
			document.frmPerusahaan.kelurahan_p1.value = grid.cells(id,23).getValue();
			document.frmPerusahaan.kecamatan_p1.value = grid.cells(id,24).getValue();
			document.frmPerusahaan.kabupaten_p1.value = grid.cells(id,25).getValue();
		}
		document.frmPerusahaan.tlp_p.value = grid.cells(id,26).getValue();
		document.frmPerusahaan.kodepos_p.value = grid.cells(id,27).getValue();
		document.frmPerusahaan.sptpd.value = grid.cells(id,28).getValue();
		document.frmPerusahaan.status.value = grid.cells(id,29).getValue();
		document.frmPerusahaan.sptpd1.value = grid.cells(id,40).getValue();//jenis_detail
		//crek_pajak();
		document.frmPerusahaan.jml_karyawan.value = grid.cells(id,31).getValue();
		document.frmPerusahaan.ukuran_tempat.value = grid.cells(id,32).getValue();
		document.frmPerusahaan.izin.value = grid.cells(id,33).getValue();
		document.frmPerusahaan.nomor.value = grid.cells(id,34).getValue();
		document.frmPerusahaan.tanggal.value = grid.cells(id,35).getValue();
		document.frmPerusahaan.jenis_pajak.value = grid.cells(id,36).getValue();
        document.frmPerusahaan.gol_pajak.value = grid.cells(id,37).getValue();		
		//jp = grid.cells(id,36).getValue();
//		if(jp=='1'||jp=='2'||jp=='3'||jp=='4'||jp=='5'||jp=='6'||jp=='7'||jp=='8'){
//			document.frmPerusahaan.omset.value = grid.cells(id,37).getValue();
//		} else if (jp=='9'){
//			document.frmPerusahaan.air_tanah.value = grid.cells(id,37).getValue();
//		}
		document.frmPerusahaan.tgl.value = grid.cells(id,38).getValue();
                document.frmPerusahaan.jenis_spt.value = grid.cells(id,41).getValue();
		statusEnding();
	}
	
	function deleteData() {
		
		var enter=prompt("Please enter your password","");
		if (enter!=null){
			if(enter=='dispenda'){
				confrm = confirm("Apakah Anda Yakin Hapus Data Ini ?");
				if(confrm) {
					var postStr =
						"id_perusahaan=" + document.frmPerusahaan.id_perusahaan.value;
						statusLoading();
						dhtmlxAjax.post('<?php echo site_url(); ?>/izin/delete_perusahaan', postStr, responeDel);			
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
				if(result) {
					kosongfrmPerusahaan();
					disabledData();
					statusEnding();
					refreshData();
					alert(result);
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	statusEnding();
</script>