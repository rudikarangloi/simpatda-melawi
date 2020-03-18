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
		
		if(document.frmSKPD.tgl.value=="") {
			document.frmSKPD.tgl.focus();
			alert("Tanggal Tidak Boleh Kosong");
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
		var jum_ret = document.frmSKPD.txtjml.value;
        var jum = jum_ret.split(".");
		rundpPO();
		var postStr =
			"skrd_1=" + document.frmSKPD.skpd_1.value +
			"&skrd_2=" + document.frmSKPD.skpd_2.value +
			//"&nota_hitung=" + document.frmSKPD.nota_hitung.value +
			"&npwpd=" + document.frmSKPD.npwpd.value +
			"&nama=" + document.frmSKPD.nama.value +
			"&alamat=" + document.frmSKPD.alamat.value +
			"&nm_pemilik=" + document.frmSKPD.nm_pemilik.value +
			"&alamat_pemilik=" + document.frmSKPD.alamat_pemilik.value +
			"&awal=" + document.frmSKPD.awal.value +
			"&akhir=" + document.frmSKPD.akhir.value +
			"&tahun=" + document.frmSKPD.tahun.value +
            "&tahun2=" + document.frmSKPD.tahun2.value + 
            "&lokasi=" + document.frmSKPD.lokasi.value +
            "&kawasan=" + document.frmSKPD.txt_keperluan.value +
            "&gangguan=" + document.frmSKPD.op.value +
            "&vol=" + document.frmSKPD.qty.value +
			"&tgl_jth_tempo=" + tgl_jth_tempo +
			"&tgl=" + tgl +
			"&no_sptrd=" + document.frmSKPD.kode_sptrd.value +
			"&no_kohir=" + document.frmSKPD.no_kohir.value +
			"&jmlh=" + document.frmSKPD.jml.value +
			"&kode_sptpd=" + document.frmSKPD.kode_sptpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skrd/simpan', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			arr = result.split("/");
			document.frmSKPD.skpd_1.value = arr[0];
			document.frmSKPD.skpd_2.value = arr[1]+"/"+arr[2];
			document.frmSKPD.skpd.value = arr[0]+"/"+arr[1]+"/"+arr[2];
			document.frmSKPD.no_kohir.value = arr[0];            
			loadData();
			//alert(result);
            tmpRows();
			disableData();
			statusEnding();
		});
	}
	
	// get data mygrid dan disimpan ke temporary array
//    var r = new Array();
//    function tmpRows() {
//		//alert('ok');
//        var arr = gridData.getAllItemIds().split(',');
//        for(i=0;i < arr.length;i++) {
//    		id = arr[i];
//            r[i] =  gridData.cells(id,0).getValue()+'|'+
//            gridData.cells(id,1).getValue()+'|'+
//            gridData.cells(id,2).getValue()+'|'+
//            gridData.cells(id,3).getValue(); 
            //gridData.cells(id,4).getValue()+'|'+
//            gridData.cells(id,5).getValue()+'|'+
//            gridData.cells(id,6).getValue()+'|'+
//            gridData.cells(id,7).getValue()+'|'+
//            gridData.cells(id,8).getValue()+'|'+
//            gridData.cells(id,9).getValue();
//			                                    
//        }
//		
//		gridData.clearAll();
//        for(i=0;i<r.length;i++) {
//        	addRowItem(i);
//        }
//        
//		r = new Array();
//        dppa.sendData();  
//    }
	
	// set gridPO sesuai value dari temporary
 //   function addRowItem(arrIndx) {       
//        var id = gridData.uid();
//        var posisi = gridData.getRowsNum();
//        // Split Array
//        var arrs = r[arrIndx].split('|');
//		//alert(arr);       
//        var row1= arrs[0];
//		var row2= arrs[1];
//        var row3= arrs[2];
//        var row4= arrs[3];
//        var row5= arrs[4];
//        var row6= arrs[5];
//        var row7= arrs[6];
//        var row8= arrs[7];
//		var row9= arrs[8];
//		var row5= document.frmSKPD.skpd.value;
        //if(arrs[0] != "") {
            //gridData.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
           // gridData.addRow(id,[row1,row2,row3,row4,row5],posisi);
			//alert('1');
        //}
 //   }
	
	function hapus() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dppkasigi'){
				cnf = confirm("Apakah Anda Yakin ?")
				if(cnf) {				   
					var postStr =                        
						"skrd_1=" + document.frmSKPD.skpd_1.value +
						"&skrd_2=" + document.frmSKPD.skpd_2.value +
                        "&no_sptrd=" + document.frmSKPD.no_sptpd.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/skrd/hapus', postStr, responeDel);	
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
    
   	function cari_skpd() {
		var postStr =
			"skpd_p=" + document.frmData.skpd_p.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/home/cek_skpd', wenePOST1);
	}

	
	function disableData() {
		document.frmSKPD.skpd_1.disabled = true;
		document.frmSKPD.skpd_2.disabled = true;
		//document.frmSKPD.nota_hitung.disabled = true;
		document.frmSKPD.npwpd.disabled = true;
		document.frmSKPD.nama.disabled = true;
		document.frmSKPD.alamat.disabled = true;
		document.frmSKPD.nm_pemilik.disabled = true;
		document.frmSKPD.alamat_pemilik.disabled = true;
		document.frmSKPD.awal.disabled = true;
		document.frmSKPD.akhir.disabled = true;
		document.frmSKPD.tahun.disabled = true;
        document.frmSKPD.tahun2.disabled = true;
		document.frmSKPD.tgl_jth_tempo.disabled = true;
		document.frmSKPD.tgl.disabled = true;
		//document.frmSKPD.no_sptpd.disabled = true;
		document.frmSKPD.no_kohir.disabled = true;
		document.frmSKPD.jml.disabled = true;
		//document.frmSKPD.btnCari.disabled = true;
        document.frmSKPD.lokasi.disabled = true;
        document.frmSKPD.txt_keperluan.disabled = true;
        document.frmSKPD.op.disabled = true;
        document.frmSKPD.qty.disabled = true;
        document.frmSKPD.harga.disabled = true;
        document.frmSKPD.tambah.disabled = true;
        document.frmSKPD.hapus.disabled = true;
	}
	
	function enableData() {
		//document.frmSKPD.nota_hitung.disabled = false;
		/*document.frmSKPD.npwpd.disabled = false;
		document.frmSKPD.nama.disabled = false;
		document.frmSKPD.alamat.disabled = false;
		document.frmSKPD.nm_pemilik.disabled = false;
		document.frmSKPD.alamat_pemilik.disabled = false; 		
		document.frmSKPD.no_sptpd.disabled = false;
		document.frmSKPD.jml.disabled = false;
		document.frmSKPD.btnCari.disabled = false;*/
        //document.frmSKPD.skpd_p.disabled = false;        
        document.frmSKPD.btncarinpwpd.disabled = false;
        document.frmSKPD.tgl_jth_tempo.disabled = false;
        //document.frmSKPD.awal.disabled = false;
		//document.frmSKPD.akhir.disabled = false;
		//document.frmSKPD.tahun.disabled = false;
        //document.frmSKPD.tahun2.disabled = false;
        document.frmSKPD.tgl.disabled = false;
        //document.frmSKPD.lokasi.disabled = false;
        //document.frmSKPD.txt_keperluan.disabled = false;        
        //document.frmSKPD.op.disabled = false;
        //document.frmSKPD.qty.disabled = false;
        //document.frmSKPD.harga.disabled = false;
        document.frmSKPD.tambah.disabled = false;
        document.frmSKPD.hapus.disabled = false;
	}
	
	function bersih() {
		document.frmSKPD.skpd_1.value = "";
		document.frmSKPD.skpd_2.value = "";
		//document.frmSKPD.nota_hitung.value = "";
		document.frmSKPD.npwpd.value = "";
		document.frmSKPD.nama.value = "";
		document.frmSKPD.alamat.value = "";
		document.frmSKPD.nm_pemilik.value = "";
		document.frmSKPD.alamat_pemilik.value = "";
		document.frmSKPD.awal.value = "";
		document.frmSKPD.akhir.value = "";
		document.frmSKPD.tahun.value = "";        
		document.frmSKPD.tgl_jth_tempo.value = "";
		document.frmSKPD.tgl.value = "";
		//document.frmSKPD.no_sptpd.value = "";
		document.frmSKPD.no_kohir.value = "";
		document.frmSKPD.jml.value = "";
		document.frmSKPD.txtjml.value = "";
	}
	
	function newEntry() {
		enableData();
		bersih();
		document.frmSKPD.btnTambah.disabled = false;
		gridData.clearAll();
		document.frmSKPD.nota_hitung.focus();
	}
</script>
<style>
body{
	background:#FFF;
}
</style>
  <h2 style="margin:30px 5px 25px 30px;">SKRD <?php echo $nama_sptpd; ?></h2>
  <div id="a_tabbar" style="width:1000px; height:690px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPD" id="frmSKPD" action="<?php echo site_url(); ?>/skpd/cetak" method="post" onsubmit="popupform(this, 'skpd')" ><input name="skpd" type="hidden" id="skpd" size="8" /><br />
     <table width="888" cellspacing="0">
        <!--<tr>
              	<td width="170" style="padding-left:15px;"> Nama SKPD / Dinas</td>
                <td><select name="skpd_p" id="skpd_p" disabled>                
                <option value=""></option>
                    <option value="1.20.05.00">Dinas Pendapatan, Pengelolaan Keuangan dan Aset Daerah</option>
                    <option value="1.20.05.01">Dinas ESDM</option>
                    <option value="1.20.05.02">Dinas Pekerjaan Umum</option>
                    <option value="1.20.05.03">Dinas Kesehatan</option>                                                
                    <option value="1.20.05.04">RSUD</option>
                    <option value="1.20.05.05">Dinas Perhubungan, Komunikasi dan Informatika</option>
                    <option value="1.20.05.06">Dinas Kebudayaan dan Pariwisata</option>
                    <option value="1.20.05.07">Dinas Pertanian, Peternakan dan Perikanan</option>
                    <option value="1.20.05.08">Dinas Koperasi, UMKM, Perindustrian dan Perdagangan</option>
                    <option value="1.20.05.09">Kantor Pelayanan Perizinan Terpadu</option>
                </select></td>                
            </tr>-->                                                    
        <tr>
          <td style="padding-left:15px;">No. SKRD</td>
          <td><input name="skpd_1" type="text" id="skpd_1" size="22" readonly="readonly" style="background-color:#FFFFCC;" disabled="disabled" />
            /
            <input name="skpd_2" type="text" id="skpd_2" size="15" readonly="readonly" style="background-color:#FFFFCC;" disabled="disabled" />
              <input type="hidden" name="id" id="id" size="35" /></td>
          <td width="138"><div align="right">Tanggal</div></td>
          <td width="176"><input name="tgl" type="text" id="tgl" size="15" disabled="disabled" /></td>
       </tr>
       <!--<tr>
          <td style="padding-left:15px;">No.SPTRD</td>
          <td width="316"><input type="text" size="32" name="nota_hitung" id="nota_hitung" style="text-transform:uppercase; background-color: #FFCC99;"/>
              <input name="btnCari" type="button" id="btnCari" style="padding-left:20px; padding-right:20px" onclick="showWinBrg()" value="Cari" disabled="disabled" /></td>
          <td><div align="right">No.SPTRD</div></td>
          <td><input type="text" name="no_sptpd" id="no_sptpd" disabled="disabled" /></td>
        </tr>!-->
        <tr>
          <td width="238" style="padding-left:15px;">NPWPD</td>
          <td><input type="text" name="npwpd" id="npwpd" size="32" disabled="disabled"  />&nbsp;<input type="button" value="Cari" style="padding-left:20px; padding-right:20px" onclick="getDataNPWPD()" name="btncarinpwpd" disabled="disabled" /></td>
          <td align="right">No. Kohir</td>
          <td><input type="text" name="no_kohir" id="no_kohir" disabled="disabled" /></td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Nama Perusahaan</td>
          <td><input type="text" name="nama" id="nama" readonly="readonly" disabled="disabled" size="45" /></td>
          <td colspan="2" valign="top"><br /></td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Alamat</td>
          <td><input name="alamat" type="text" id="alamat" size="45" readonly="readonly" disabled="disabled" /></td>
          <td colspan="2" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Nama Pemilik</td>
          <td ><input type="text" name="nm_pemilik" id="nm_pemilik" disabled="disabled" size="45" /></td>
          <td colspan="2" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Alamat<br /></td>
          <td><input name="alamat_pemilik" type="text" id="alamat_pemilik" size="45" disabled="disabled" /></td>
          <td colspan="2" style="padding-left:15px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Masa Pajak</td>
          <td colspan="3"><select name="awal" id="awal" onchange="cmo()" disabled="disabled">
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
            <select name="akhir" id="akhir" onchange="cmp()" disabled="disabled">
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
            <select name="tahun" id="tahun" onchange="cmp()" disabled="disabled">
              <?php echo $tahun; ?>
            </select> s/d <input type="text" name="tahun2" id="tahun2" size="7" disabled="disabled"/>              
            </td>
        </tr>
        <tr>
          <td style="padding-left:15px;">Tanggal Jatuh Tempo</td>
          <td colspan="3"><input name="tgl_jth_tempo" type="text" id="tgl_jth_tempo" size="15" disabled="disabled" />
          <input type="hidden" name="kode_sptpd" id="kode_sptpd" value="<?php echo $kode_sptpd; ?>" /><input type="hidden" name="nama_sptpd" id="nama_sptpd" value="<?php echo $nama_sptpd; ?>" /></td>
        </tr>
        <tr>
                    <td style="padding-left:15px;" valign="top">Indeks Izin Usaha</td>
                    <td colspan="3" width="50" ><select name="lokasi" id="lokasi" disabled="disabled" onchange="getPasar();">
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
                    <td style="padding-left:15px;">Indeks Lokasi</td>
					<td><select name="txt_keperluan" id="txt_keperluan" disabled="disabled" onchange="getLokasi();" >
                         <option value=""></option>
                        <?php
                                foreach($lok_kawa->result() as $data){
                                echo '<option value="'.$data->id_kawasan.'">'.$data->nm_kawasan.'</option>';
                                }
                            ?>
                    </select></td>
         </tr>
         <tr>
                	<td colspan="4">Data Objek Pajak</td>
         <tr>
                	<td colspan="4" style="padding-left:15px;">Indeks Gangguan 
                    <select name="op" id="op" disabled="disabled" onchange="getGangguan();">
                         <option value=""></option>
                        <?php
                                foreach($dop->result() as $data){                                    
                                echo '<option value="'.$data->id_izin.'">'.$data->nm_izin.'</option>';
                                }
                            ?>
                    </select>&nbsp;&nbsp;Luas Ruang Tempat Usaha&nbsp;&nbsp;<input type="text" id="qty" name="qty" disabled="disabled" size="10" /> m<sup>2</sup>&nbsp;                    
                    &nbsp;Tarif&nbsp;&nbsp;<input type="text" id="harga" name="harga" disabled="disabled" size="18" /><br />
                    <input type="button" value="tambah rekening" onclick="add()" name="tambah" id="tambah" disabled="disabled" style="padding-left:10px; padding-right:10px" />
                        <input type="button" value="hapus" onclick="krg()" name="hapus" disabled="disabled" id="hapus" style="padding-left:20px; padding-right:20px" /></td>
                </tr>
        <tr>
          <td colspan="4"><div id="gridData" width="100%" height="200px" style="background-color:white;"></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">Jumlah</td>
          <td align="right"><input type="text" name="txtjml" id="txtjml" style="text-align:right;" disabled="disabled" />
          <input type="hidden" name="jml" id="jml" /><input type="hidden" name="kode_sptrd" id="kode_sptrd" /></td>
        </tr>
        
        <tr>
          <td colspan="4" style="padding-left:15px; background-color:#FFCC99;">
              <input type="button" name="button" id="button" value="Baru" onclick="newEntry();" style="width:90px;" />
              <input type="button" value="Simpan" onclick="simpan()" name="btnTambah" disabled="disabled" style="width:90px;" />
              <input type="button" value="Edit" onclick="edit()" name="btnEdit" disabled="disabled" style="width:90px;" />
              <input type="button" value="Hapus" onclick="hapus()" name="btnDel" id="btnDel" disabled="disabled" style="width:90px;"/>
              <input type="button" value="Cetak" name="cetak" id="cetak" disabled="disabled" onclick="cet()" style="width:90px;"/>  
           </td>
        </tr>
        
        <!-- <tr>
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
         </tr>!-->
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
        	<option value="npwpd">No. NPWPD</option>
            <option value="no_sptrd">No.SPTRD</option>
            <option value="3">Nama Perusahaan</option>
            <option value="4">Alamat Perusahaan</option>
        </select></td>
        <td><input type="text" name="kataKunci" id="kataKunci" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="cariSKRD()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="closeSKPD()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="tmpGridWP" width="750px" height="270px" style="margin-bottom:10px;"></div>
</div>
</div> 

<div id="objNPWPD" style="display:none;">
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
  	function edit(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dppkasigi'){
			     
               	document.frmSKPD.button.disabled = false;
				document.frmSKPD.btnTambah.disabled = false;
				document.frmSKPD.tgl_jth_tempo.disabled = false;
				document.frmSKPD.tgl.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
    
    function add(){
		var op = document.frmSKPD.op.value;
		//var qty = document.frmData.qty.value;
		//var tarif = document.frmSKPD.tar.value;
        var harga = document.frmSKPD.harga.value;
        var kode = document.frmSKPD.kode_sptrd.value;
        
		//a = op.split('|');
		var id = gridData.uid();
		var posisi = gridData.getRowsNum();
		//var jml = a[2]*qty;
        //var jml = qty*harga;
        //var Tot = qty*harga;
		//var setor = (jml*tarif)/100;
		// Split Array
		var row1= '4.1.2.03.03';
		var row2= 'Retribusi Izin Gangguan';
		var row3= harga;
		
        //var row4= harga;
		var row4= kode;
        document.frmSKPD.jml.value = row3;
		//var row6= harga;
		//var row7= qty*harga;
        //var row7= qty;
		//var row8= '';
		gridData.addRow(id,[row1,row2,row3,row4], posisi);
		gridData.showRow(id);
		var stage = 2;
		loadtotal(stage, id);
		//document.frmSKPD.op.value="";
		//document.frmSKPD.qty.value="";
        //document.frmSKPD.harga.value="";
		document.frmSKPD.sum.value=1;
	}
    
   	function krg() {
		ya = confirm("Are You Sure ?");
		if(ya) {
			gridData.deleteSelectedRows();
		}
	}
    
   	function loadtotal(stage, id) {
		document.frmSKPD.txtjml.value = document.getElementById('tmpJml').innerHTML;        		
        //document.frmSKPD.tarif.value = document.getElementById('tmpJum').innerHTML;
		//document.frmSKPD.setoran.value = document.getElementById('tmpJum').innerHTML;
	}    
    
    	// get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows() {
		
        var arr = gridData.getAllItemIds().split(',');
        //alert(arr);
		for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gridData.cells(id,0).getValue()+'|'+
            gridData.cells(id,1).getValue()+'|'+
            gridData.cells(id,2).getValue()+'|'+
            gridData.cells(id,3).getValue();
            //+'|'+
            //gridData.cells(id,4).getValue();//+'|'+
			//gridData.cells(id,5).getValue();		                                    
        }
		
		gridData.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
			//alert(addRowItem(i));
        }
        
		r = new Array();
        dppa.sendData();  
    }
    
    	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gridData.uid();
        var posisi = gridData.getRowsNum();
        var arrs = r[arrIndx].split('|');
		
		var skpd = document.frmSKPD.kode_sptrd.value;
		var row1= arrs[0];
		var row2= arrs[1];
        var row3= arrs[2];
        //var row4= arrs[3];
        var row4= skpd;
       
		 
        //if(arrs[0] != "") {
            gridData.addRow(id,[row1,row2,row3,row4],posisi);
			//alert('1');
        //}
    }
    
    	// Grid Data
	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridData.setHeader("Kode Rekening,Nama Rekening,Jumlah,SKRD");
    gridData.setInitWidths("100,400,80,80");
	gridData.setColAlign("left,left,right,left");
    gridData.setColTypes("ro,ro,ron,ro");
	gridData.setColumnHidden(3,true);
	gridData.setNumberFormat("0,000",2,",",".");
	//gridData.setNumberFormat("0,000",3,",",".");
	gridData.enableMultiselect(true);
	gridData.enableSmartRendering(true);
    //gridData.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
    gridData.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpJml>{#stat_total}</div>,#cspan");
	gridData.setSkin("dhx_skyblue");
	gridData.init();
	
	var dppa = "";
	function rundpPO(){
		dppa = new dataProcessor("<?php echo site_url(); ?>/skrd/dt_rekening");
		dppa.setUpdateMode("off");
		dppa.init(gridData);       
		dppa.attachEvent("onAfterUpdateFinish", function() {        
			loadData();
			enableData();
			enabledButton();
			document.frmSKPD.button.disabled = false;	
			statusEnding();
			alert("Done");
			return true;
		});
	}

	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	cal2 = new dhtmlxCalendarObject('tgl_jth_tempo');
	cal2.setDateFormat('%d/%m/%Y');
  
  	function cet(){  	 
        var kd1 = document.frmSKPD.skpd_1.value;
        
        if (kd1 == ""){
            var gabung = document.frmSKPD.skpd_1.value+'/'+document.frmSKPD.skpd_2.value;        
		    window.open('<?php echo site_url(); ?>/skrd/cetak?skrd='+gabung, '', 'height=700,width=1000,scrollbars=yes');    
        }else{
            var kode_sptrd1 = document.frmSKPD.skpd.value;
            var gabung = document.frmSKPD.skpd_1.value+'/'+document.frmSKPD.skpd_2.value;          
            window.open('<?php echo site_url(); ?>/skrd/cetak?skrd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
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

	function enabledButton(){
		document.frmSKPD.button.disabled = true;
		document.frmSKPD.btnTambah.disabled = true;
		document.frmSKPD.btnEdit.disabled = false;
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
    
    wNPWPD = dhxWins.createWindow("wNPWPD",0,0,800,400);
	wNPWPD.setText("Pencarian Data Perusahaan");
	wNPWPD.button("park").hide();
	wNPWPD.button("close").hide();
	wNPWPD.button("minmax1").hide();
	wNPWPD.hide();
    
   	function getDataNPWPD() {
		wNPWPD.show();
    	wNPWPD.setModal(true);
		wNPWPD.center();
		wNPWPD.attachObject('objNPWPD');
	}
    
   	function batal() {
		wNPWPD.hide();
		wNPWPD.setModal(false);
		document.frmGAL.fil.value = "0";
		document.frmGAL.values.value = "";
		grids.clearAll();
	}
    
   	function lihat3() {
		op = document.frmGAL.fil.value;
		if(op==1||op==2||op==3||op==4){
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
	gridGAL.setHeader("id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, jenis_pajak, jenis_pajak_detail, nm_rek, nm_lokasi, tgl_daftar, masa_pajak1, masa_pajak2, lokasi_pasar, indeks_lokasi, indeks_gangguan, volume, jml_bayar, sptrd");
	gridGAL.setInitWidths("50,100,150,100,100,100,100,100,100,100,100,100,100,100,100,100,200,400,100,100,100,100,100,100,100");
	gridGAL.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridGAL.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridGAL.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	gridGAL.enablePaging(true,1000,1000,"pagingArea",true);
	gridGAL.setPagingSkin("bricks");
	gridGAL.setSkin("dhx_skyblue");
	gridGAL.setColumnHidden(0,true);
	gridGAL.attachEvent("onRowDblClicked", function (id) {
		document.frmSKPD.npwpd.value 	 = gridGAL.cells(id,1).getValue();
		document.frmSKPD.nama.value	= gridGAL.cells(id,2).getValue();
		document.frmSKPD.alamat.value  	= gridGAL.cells(id,3).getValue();
        document.frmSKPD.nm_pemilik.value  	= gridGAL.cells(id,6).getValue();
        document.frmSKPD.alamat_pemilik.value = gridGAL.cells(id,7).getValue();
        var m_awal = gridGAL.cells(id,18).getValue();
        var m_akhir = gridGAL.cells(id,19).getValue();        
        document.frmSKPD.awal.value = m_awal.substr(5,2);
        document.frmSKPD.akhir.value = m_akhir.substr(5,2);
        document.frmSKPD.tahun.value = m_awal.substr(0,4);
        document.frmSKPD.tahun2.value = m_akhir.substr(0,4);
        document.frmSKPD.lokasi.value = gridGAL.cells(id,20).getValue();
        document.frmSKPD.txt_keperluan.value = gridGAL.cells(id,21).getValue();
        document.frmSKPD.op.value = gridGAL.cells(id,22).getValue();
        document.frmSKPD.qty.value = gridGAL.cells(id,23).getValue();
        document.frmSKPD.harga.value = gridGAL.cells(id,24).getValue();
        document.frmSKPD.kode_sptrd.value = gridGAL.cells(id,25).getValue();        
        batal();
		enableData1();

	});
	gridGAL.init();
    
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("No.SPTRD,SPTRD,NPWPD,Nama Perusahaan,Alamat Perusahaan,Pemilik,Alamat Pemilik,masa_pajak_1,masa_pajak_2,tahun,jml");
	gridWP.setInitWidths("120,120,120,200,200,180,180,80,80,80,0");
	gridWP.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmSKPD.nota_hitung.value = gridWP.cells(id,0).getValue();		                
        document.frmSKPD.npwpd.value = gridWP.cells(id,2).getValue();
		document.frmSKPD.no_sptpd.value = gridWP.cells(id,1).getValue();
        document.frmSKPD.kode_sptrd.value = gridWP.cells(id,1).getValue();
		document.frmSKPD.nama.value = gridWP.cells(id,3).getValue();
		document.frmSKPD.alamat.value = gridWP.cells(id,4).getValue();
		document.frmSKPD.nm_pemilik.value = gridWP.cells(id,5).getValue();
		document.frmSKPD.alamat_pemilik.value = gridWP.cells(id,6).getValue();
		document.frmSKPD.awal.value = gridWP.cells(id,7).getValue();
		document.frmSKPD.akhir.value = gridWP.cells(id,8).getValue();
		document.frmSKPD.tahun.value = gridWP.cells(id,9).getValue();
		document.frmSKPD.txtjml.value = format_number(gridWP.cells(id,10).getValue());
		document.frmSKPD.jml.value = gridWP.cells(id,10).getValue();
		loadTgl();
		//loadItem();
		closeSKPD();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	//gridWP.loadXML(base_url+"index.php/skpd/cData?kode="+document.frmSKPD.kode_sptpd.value);
	
	function cariSKRD() {
		if(document.frmSrc5.kataKunci.value=="") { kata_kunci = 0; } else { kata_kunci = document.frmSrc5.kataKunci.value; }
		statusLoading();
		gridWP.clearAll();	
		//gridWP.loadXML(base_url+"index.php/skrd/cariData/"+kata_kunci+"/"+document.frmSrc5.parameter.value+"/"+document.frmSKPD.kode_sptpd.value,function() {  statusEnding(); });
        gridWP.loadXML(base_url+"index.php/skrd/cariData/"+kata_kunci+"/"+document.frmSrc5.parameter.value,function() {  statusEnding(); });
	}
	
	function jumchild(){
		//document.getElementById('tmpDp').innerHTML = "";
		//document.getElementById('tmpTar').innerHTML = "";
		//document.getElementById('tmpNaik').innerHTML = "";
		//document.getElementById('tmpDen').innerHTML = "";
		//document.getElementById('tmpSasi').innerHTML = "";
		//document.getElementById('tmpBun').innerHTML = "";
		document.getElementById('tmpJml').innerHTML = "";
	}
	
	function loadTgl(){
		var poStr =
		"tempo=" + document.frmSKPD.tgl_jth_tempo.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/skrd/cektempo', poStr, respeP);			
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
	}
	
	//loadData();    
    	function getPasar(){
	   		if(document.frmData.lokasi.value!=""){
			poststr = 'pasar=' + document.frmData.txt_keperluan.value;			           
			dhtmlxAjax.post(base_url+"/index.php/sptrd/getPasar", encodeURI(poststr), outputPasar);
			}
	}
    
    function outputPasar(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {                                 
                //document.frmData.harga.value = result;
                indeks_usaha = result;
                //alert(result);                                                           
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }
    
    function getLokasi(){
			if(document.frmData.txt_keperluan.value!=""){
			poststr = 'lokasi=' + document.frmData.txt_keperluan.value;			           
			dhtmlxAjax.post(base_url+"/index.php/sptrd/getLokasi", encodeURI(poststr), outputLokasi);
			}
		}
        
         function outputLokasi(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {                                 
                //document.frmData.harga.value = result;
                indeks_lokasi = result;
                //alert(result);                                                           
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }
    
    
    function getGangguan(){
        	if(document.frmData.op.value!=""){
			poststr = 'gangguan=' + document.frmData.op.value;			           
			dhtmlxAjax.post(base_url+"/index.php/sptrd/getGangguan", encodeURI(poststr), outputGangguan);
			}
    }
        
        function outputGangguan(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {                                 
                //document.frmData.harga.value = result;
                indeks_gangguan = result;
                //alert(indeks_lokasi + ' :lokasi , gangguan: ' + indeks_gangguan + ','+result);
                
                document.frmData.hitung_ret.disabled = false;
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }

	
	function loadItemPajak() {
		gridData.clearAll();
		statusLoading();
		gridData.loadXML(base_url+"index.php/skrd/dataItemPajak?skrd="+document.frmSKPD.skpd.value,function() { statusEnding(); });
	}
	
	function loadItem(){
		b = document.frmSKPD.nota_hitung.value.split('/');
		pasang = b[0]+'-'+b[1]+'-'+b[2]; 
		gridData.clearAll();
		gridData.loadXML(base_url+"index.php/skrd/dataItemPajak1/"+pasang,function() { statusEnding(); });			
	}
	
	// Wajib Pajak
	grid = new dhtmlXGridObject('tmpGrid');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("No.SKPD,Tanggal,Nama Usaha,Alamat Usaha,Nama Pemilik,Alamat,NPWPD,Total,Bln Awal,Bln Akhir,Tahun,Tgl Tempo,lokasi_pasar, indeks_kawasan, indeks_gangguan, volume");
	grid.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("left,left,left,left,left,left,left,right,right,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ron,ron,ro,ro,ro,ro,ro,ro,ro");
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
		document.frmSKPD.skpd.value = grid.cells(id,0).getValue();
		document.frmSKPD.skpd_1.value = arr[0];
		document.frmSKPD.skpd_2.value = arr[1]+'/'+arr[2];
		
        var thn = grid.cells(id,10).getValue();
        var thn2 = parseFloat(thn) + 3;
        
        //document.frmSKPD.nota_hitung.value = grid.cells(id,13).getValue();
		document.frmSKPD.npwpd.value = grid.cells(id,6).getValue();
		//document.frmSKPD.no_sptpd.value = grid.cells(id,12).getValue();
		document.frmSKPD.nama.value = grid.cells(id,2).getValue();
		document.frmSKPD.alamat.value = grid.cells(id,3).getValue();
		document.frmSKPD.nm_pemilik.value = grid.cells(id,4).getValue();
		document.frmSKPD.alamat_pemilik.value = grid.cells(id,5).getValue();
		document.frmSKPD.awal.value = grid.cells(id,8).getValue();
		document.frmSKPD.akhir.value = grid.cells(id,9).getValue();
		document.frmSKPD.tahun.value = grid.cells(id,10).getValue();
        document.frmSKPD.tahun2.value = thn2;
		document.frmSKPD.tgl_jth_tempo.value = grid.cells(id,11).getValue();        
        document.frmSKPD.lokasi.value = grid.cells(id,12).getValue();
        document.frmSKPD.txt_keperluan.value = grid.cells(id,13).getValue();
        document.frmSKPD.op.value = grid.cells(id,14).getValue();
        document.frmSKPD.qty.value = grid.cells(id,15).getValue();
        document.frmSKPD.harga.value = grid.cells(id,7).getValue();        
		document.frmSKPD.tgl.value = grid.cells(id,1).getValue();
		document.frmSKPD.txtjml.value = format_number(grid.cells(id,7).getValue());
		//document.frmSKPD.jml.value = grid.cells(id,7).getValue();
		//document.frmSKPD.no_kohir.value = grid.cells(id,14).getValue();
		loadItemPajak();
		enabledButton();
        
	});
	grid.init();
	grid.setSkin("dhx_skyblue");
	
	loadData();
	
	function loadData() {
		grid.clearAll();
		grid.loadXML(base_url+"index.php/skrd/mainData?kode="+document.frmSKPD.kode_sptpd.value,function() { statusEnding(); });
	}
	statusEnding();
</script>
</div>
