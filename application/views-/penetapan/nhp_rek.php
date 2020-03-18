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
<script language="javascript">	
	function lihat() {
		if(document.frmNHP.sptpd.value=="") {
			alert("SPTPD Tidak Boleh Kosong");
			document.frmNHP.sptpd.focus();
			return;
		}
		//alert(document.frmNHP.sptpd.value);
		var postStr =
		"sptpd=" + document.frmNHP.sptpd.value +
		"&kode=" + document.frmNHP.kode.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/nhp/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					cha = result.split(";");
					//alert(cha);
					var id = gride.uid();
					var posisi = gride.getRowsNum();
					// Split Array
					var row1= cha[0];
					var row2= cha[1];
					var row3= cha[2];
					var row4= cha[3];
					var row5= cha[4];
					var row6= cha[5];
					var row7= cha[6];
					var row8= cha[7];
					var row9= cha[8];
					var row10= cha[9];
					var row11= '';
						gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10,row11], posisi);
						gride.showRow(id);
				} else {
					alert('Maaf No SPTPD tersebut sudah terdaftar');	
				}
				loadtotal();
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function loadtotal() {
		document.frmNHP.jumlah.value = document.getElementById('tmpJml').innerHTML;
	}
	
	function jumchild(){
		/*document.getElementById('tmpDp').innerHTML = "";
		document.getElementById('tmpTar').innerHTML = "";
		document.getElementById('tmpNaik').innerHTML = "";
		document.getElementById('tmpDen').innerHTML = "";
		document.getElementById('tmpSasi').innerHTML = "";
		document.getElementById('tmpBun').innerHTML = "";
		document.getElementById('tmpJml').innerHTML = "";
*/	}
	
	function disableData2() {
		document.frmNHP.tgl.disabled = false;
		document.frmNHP.sk.disabled = false;
		document.frmNHP.kep_proyek.disabled = false;
		document.frmNHP.baru1.disabled = false;
		document.frmNHP.tambah.disabled = false;
	}
	
	function enableData() {
		document.frmNHP.tgl.disabled = true;
		document.frmNHP.kep_proyek.disabled = true;
		document.frmNHP.sk.disabled = true;
		document.frmNHP.tambah.disabled = true;
	}
	
	function buttonEnable1() {
		document.frmNHP.tambah1.disabled = false;
		document.frmNHP.kurang.disabled = false;
	}
	
	function buttonDisable1() {
		document.frmNHP.tambah1.disabled = true;
		document.frmNHP.kurang.disabled = true;
	}
	
	function simpan() {
		if(document.frmNHP.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmNHP.npwpd.focus();
			return;
		}
		
		if(document.frmNHP.sk.value=="") {
			alert("SK Tidak Boleh Kosong");
			document.frmNHP.sk.focus();
			return;
		}
		
		if(document.frmNHP.tgl_jth_tempo.value=="") {
			alert("Tanggal Jth Tempo Tidak Boleh Kosong");
			document.frmNHP.tgl_jth_tempo.focus();
			return;
		}		
		
		t = document.frmNHP.tgl.value;
		s = t.split("/");
		tgl = s[2]+'-'+s[1]+'-'+s[0];
		
		arr1 = document.frmNHP.urut.value;
		arr2 = document.frmNHP.hotel.value;
		arrfull = arr1+'/'+arr2;						
		var fg = "";
		
		t2 = document.frmNHP.ket_ms1.value;
		s2 = t2.split("/");
		tgl2 = s2[2]+'-'+s2[1]+'-'+s2[0];
		
		t3 = document.frmNHP.ket_ms2.value;
		s3 = t3.split("/");
		tgl3 = s3[2]+'-'+s3[1]+'-'+s3[0];
		
		t4 = document.frmNHP.tgl_jth_tempo.value;
		s4 = t4.split("/");
		tgl4 = s4[2]+'-'+s4[1]+'-'+s4[0];
		
		rundpPO();
		var postStr =
			"id=" + document.frmNHP.id.value +
			"&kode=" + document.frmNHP.kode.value +
			"&nota=" + arrfull +
			"&sptpd=" + document.frmNHP.sptpd.value +
			"&npwpd=" + document.frmNHP.npwpd.value +
			"&tgl=" + tgl +
			"&sk=" + document.frmNHP.sk.value +
			"&cara=" + document.frmNHP.cara.value +
			"&ket_nhp=" + fg +
			"&tgl_tempo=" + tgl4 +
			"&tgl_terbit=" + tgl +
			"&tg_masa1=" + tgl2 +
			"&tg_masa2=" + tgl3 +
			"&kep=" + document.frmNHP.kep_proyek.value +
			"&nama=" + document.frmNHP.nama.value +
			"&alamat=" + document.frmNHP.alamat.value +
			"&np=" + document.frmNHP.nama_perusahaan.value +
			"&ap=" + document.frmNHP.alamat_perusahaan.value +
			"&awal=" + document.frmNHP.awal.value +
			"&akhir=" + document.frmNHP.akhir.value +
			"&tahun=" + document.frmNHP.tahun.value +
			"&jumlah=" + document.frmNHP.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/nhp/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					kode = document.frmNHP.kode.value;
					if(kode=='HTL'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
						
					} else if(kode=='AIR'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
						
					} else if(kode=='RES'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
						
					} else if(kode=='REK'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
						
					} else if(kode=='LIS'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
						
					} else if(kode=='WLT'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
						tmpRows();
						return true;
						
					} else if(kode=='PKR'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
						tmpRows();
						return true;
						
					} else if(kode=='GAL'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
						tmpRows();
						return true;
						
					} else if(kode='HIB'){
						res = result.split("/");
						document.frmNHP.urut.value = res[0];
						document.frmNHP.hotel.value = res[1]+"/"+res[2]; 
						document.frmNHP.nota.value = result;
                   		tmpRows();
						return true;
					}
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	// get data mygrid dan disimpan ke temporary array
    var r = new Array();
    function tmpRows() {
		//alert('ok');
        var arr = gride.getAllItemIds().split(',');
        for(i=0;i < arr.length;i++) {
    		id = arr[i];
            r[i] =  gride.cells(id,0).getValue()+'|'+
            gride.cells(id,1).getValue()+'|'+
            gride.cells(id,2).getValue()+'|'+
            gride.cells(id,3).getValue()+'|'+
            gride.cells(id,4).getValue()+'|'+
            gride.cells(id,5).getValue()+'|'+
            gride.cells(id,6).getValue()+'|'+
            gride.cells(id,7).getValue()+'|'+
            gride.cells(id,8).getValue()+'|'+
			gride.cells(id,9).getValue()+'|'+
			gride.cells(id,10).getValue();			                                   
        }
		
		gride.clearAll();
        for(i=0;i<r.length;i++) {
        	addRowItem(i);
        }
        
		r = new Array();
        dpps.sendData();  
    }
	
	// set gridPO sesuai value dari temporary
    function addRowItem(arrIndx) {       
        var id = gride.uid();
        var posisi = gride.getRowsNum();
        // Split Array
        var arrs = r[arrIndx].split('|');
		//alert(arrs);       
        var row1= arrs[0];
		var row2= arrs[1];
        var row3= arrs[2];
        var row4= arrs[3];
        var row5= arrs[4];
        var row6= arrs[5];
        var row7= arrs[6];
        var row8= arrs[7];
		var row9= arrs[8];
		var row10= arrs[9];
		var row11= document.frmNHP.nota.value; 
        //if(arrs[0] != "") {
            gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10,row11],posisi);
			//alert('1');
        //}
    }
	
	function kosongfrmNHP2() {
		document.frmNHP.id.value = "";
		document.frmNHP.urut.value = "";
		document.frmNHP.hotel.value = "";
		//document.frmNHP.tgl.value = "";
		//document.frmNHP.sk.value = "";
		document.frmNHP.sptpd.value = "";
		document.frmNHP.npwpd.value = "";
		document.frmNHP.nama.value = "";
		document.frmNHP.alamat.value = "";
		document.frmNHP.nama_perusahaan.value = "";
		document.frmNHP.alamat_perusahaan.value = "";
		document.frmNHP.tgl_jth_tempo.value = "";		
		document.frmNHP.awal.value = "";
		document.frmNHP.akhir.value = "";
		document.frmNHP.ket_ms1.value = "";
		document.frmNHP.ket_ms2.value = "";
		document.frmNHP.tahun.value = "";
		document.frmNHP.cara.value = "";
		document.frmNHP.jumlah.value = "";
		document.frmNHP.kep_proyek.value = "";
	}	
		
	function enableButton() {
		document.frmNHP.edit1.disabled = false;
		document.frmNHP.delete1.disabled = false;
		document.frmNHP.cetak.disabled = false;
		document.frmNHP.tambah.disabled = true;
		document.frmNHP.cari1.disabled = true;
		document.frmNHP.baru1.disabled = true;
		document.frmNHP.sptpd.disabled = true;
	}
	
	function disableButton() {
		document.frmNHP.edit1.disabled = true;
		document.frmNHP.delete1.disabled = true;
		document.frmNHP.cetak.disabled = true;
		document.frmNHP.tambah.disabled = true;
		document.frmNHP.cari1.disabled = true;
	}
	
	function ubah() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				disableData2();
				buttonEnable1();
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	wNHP2 = dhxWins.createWindow("wNHP2",0,0,620,220);
	wNHP2.setText("Entri Perhitungan");
	wNHP2.button("park").hide();
	wNHP2.button("close").hide();
	wNHP2.button("minmax1").hide();
	wNHP2.hide();
	
	function childForm(){
		document.frmSrc.id.value = "";
		document.frmSrc.gols.value = "";
		document.frmSrc.nama.value = "";
		document.frmSrc.dp.value = "";
		document.frmSrc.tarif.value = "";
		document.frmSrc.naik.value = "";
		document.frmSrc.denda.value = "";
		document.frmSrc.sasi.value = "";
		document.frmSrc.bunga.value = "";
		document.frmSrc.sav.disabled = false;
	}

	function tmbh() {
		wNHP2.show();
    	wNHP2.setModal(true);
		wNHP2.center();
		wNHP2.attachObject('objBrg');
		var id = gride.uid();
		//alert(id);
		document.frmSrc.id.value = id;
		childForm();
	}
	
	function tampil() {
		wNHP2.show();
    	wNHP2.setModal(true);
		wNHP2.center();
		wNHP2.attachObject('objBrg');
		document.frmSrc.sav.disabled = false;
	}
	
	function kel() {
		wNHP2.hide();
		wNHP2.setModal(false);
	}

	function krg() {
		ya = confirm("Are You Sure ?");
		if(ya) {
			gride.deleteSelectedRows();
		}
	}
	
	function tam() {
		if(document.frmSrc.gols.value=="") {
			alert("Kode Rekening Tidak Boleh Kosong");
			document.frmSrc.gols.focus();
			return;
		}
		
		if(document.frmSrc.nama.value=="") {
			alert("Nama Rekening Tidak Boleh Kosong");
			document.frmSrc.nama.focus();
			return;
		}
		
		if(document.frmSrc.dp.value=="") {
			alert("DP Tidak Boleh Kosong");
			document.frmSrc.dp.focus();
			return;
		}
		
		if(document.frmSrc.tarif.value=="") {
			alert("Tarif Tidak Boleh Kosong");
			document.frmSrc.tarif.focus();
			return;
		}
		
		if(document.frmSrc.naik.value=="") {
			alert("Kenaikan Tidak Boleh Kosong");
			document.frmSrc.naik.focus();
			return;
		}
		
		if(document.frmSrc.denda.value=="") {
			alert("Denda Tidak Boleh Kosong");
			document.frmSrc.denda.focus();
			return;
		}
		
		if(document.frmSrc.sasi.value=="") {
			alert("Kompensasi Tidak Boleh Kosong");
			document.frmSrc.sasi.focus();
			return;
		}
		
		if(document.frmSrc.bunga.value=="") {
			alert("Bunga Tidak Boleh Kosong");
			document.frmSrc.bunga.focus();
			return;
		}
		
		gride.deleteSelectedRows();	
		var posisi = gride.getRowsNum();
		dp = document.frmSrc.dp.value;
		denda = document.frmSrc.denda.value;
		tarif = document.frmSrc.tarif.value+'%';
		bunga = document.frmSrc.bunga.value;
		naik = document.frmSrc.naik.value;
		sasi = document.frmSrc.sasi.value;
		jml  = document.frmSrc.jml.value;
		//jml = (dp * document.frmSrc.tarif.value)/100;
		jumlah = parseInt(jml)+parseInt(denda)-parseInt(sasi);
		//gridPOS.addRow(id,'',0); 
		var row1= document.frmSrc.gols.value;
		var row2= document.frmSrc.nama.value;
		var row3= dp;
		var row4= tarif;
		var row5= naik;
		var row6= denda;
		var row7= sasi;
		var row8= bunga;
		var row9= jumlah;
		var row10= document.frmNHP.sptpd.value;
		var row11= '';
		gride.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10,row11], posisi);
		gride.showRow(id);
		loadtotal();
		kosongChild();
	}
	
	function kosongChild(){
		document.frmSrc.gols.value = "";
		document.frmSrc.nama.value = "";
		document.frmSrc.dp.value = "";
		document.frmSrc.denda.value = "";
		document.frmSrc.tarif.value = "";
		document.frmSrc.bunga.value = "";
		document.frmSrc.naik.value = "";
		document.frmSrc.sasi.value = "";
	}
	
	function cgol() {
		var poStr =
		"gol=" + document.frmSrc.gols.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/nhp/cgol', poStr, responePOS);			
	}
	
	function responePOS(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result) {
					document.frmSrc.nama.value = result;
				}
			}
		}
	}
	
	function popupform1(myform, windowname){
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
</style>
<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Nota Hitung Pajak - <?php echo $title; ?></h2>

<div id="a_tabbar" style="width:1000px; height:600px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmNHP" id="frmNHP" action="<?php echo site_url(); ?>/nhp/cetak" method="post" onSubmit="popupform1(this, 'Nhp')">
    <br /><input type="hidden" name="kode" id="kode" value="<?php echo $kode; ?>" />
    <input type="hidden" name="nota" id="nota" size="35"  />
   	  <table width="850" border="0">
      		<tr>
        		<td width="220" style="padding-left:15px;">No. Nota Hitung</td>
            	<td colspan="2">
                <input type="hidden" name="id" id="id" size="35"  />
                <input type="text" name="urut" id="urut" size="22" style="background-color:#FFFFCC;" disabled/>&nbsp;/&nbsp;
                <input type="text" name="hotel" id="hotel" size="15" style="background-color:#FFFFCC;" disabled/></td>
                <td width="150">Tanggal Terbit&nbsp;<input type="text" name="tgl" id="tgl" size="10" value="<?php echo $tgl; ?>" disabled/></td>
        	</tr>
            <tr>
                <td style="padding-left:15px;">No. SPTPD</td>
                <td colspan="2"><input type="text" name="sptpd" id="sptpd" size="32" style="text-transform:uppercase; background-color: #FFCC99;" disabled/>
                <input type="button" onclick="opens()" value="Cari" name="cari1" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
                <td>SK &nbsp;<select name="sk" id="sk" disabled>
                <option value=""></option>
                <option value="1" selected="selected">SKP</option>
                <option value="3">STP</option>
                <option value="4">SKPKBT</option>
                <option value="5">SKPKB</option>
              </select></td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">NPWPD</td>
                <td colspan="2"><input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase;" disabled/></td>
                <td>Keperluan Proyek</td>
    		</tr>
            <tr>
                <td style="padding-left:15px;">Cara Hitung</td>
            	<td><select name="cara" id="cara" disabled>
                    <option value=""></option>
                    <option value="1">Official Assesment</option>
                    <option value="2">Self Assesment</option>
                </select><br /></td>
                <td width="70" rowspan="3">&nbsp;</td>
                <td rowspan="3" valign="top"><textarea name="kep_proyek" id="kep_proyek" cols="25" rows="4" disabled></textarea></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Nama</td>
                <td><input type="text" name="nama" id="nama" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat</td>
                <td><input type="text" name="alamat" id="alamat" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Nama Perusahaan</td>
                <td colspan="3"><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45" disabled/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;"> Alamat Perusahaan</td>
                <td colspan="2"><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" size="45" disabled/></td>
				<td>Tanggal Jatuh Tempo <input type="text" name="tgl_jth_tempo" id="tgl_jth_tempo" value="<?php echo $tgl; ?>" size="20" /></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">Masa Pajak</td>
                <td colspan="3"><select name="awal" id="awal" disabled>
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
                &nbsp;s/d&nbsp;
                <select name="akhir" id="akhir" disabled>
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
                </select>&nbsp;&nbsp;&nbsp;Tahun &nbsp;
                <select name="tahun" id="tahun" >
                <option value=""></option>
                <?php echo $tahun; ?>
                </select></td>
             </tr>
			 <tr>
              	<td style="padding-left:15px;">Keterangan Masa Pajak</td>
                <td colspan="3"><input type="text" name="ket_ms1" id="ket_ms1" size="15" disabled/> s/d <input type="text" name="ket_ms2" id="ket_ms2" size="15" disabled/></td>
            </tr>
			<tr>
            	<td colspan="4">
    <div style="padding:10px 15px 0 15px;">
   		<div id="gridCo" width="820px" height="150px" style="margin-bottom:10px;"></div>
    </div>
</td>
</tr>
	<tr>
    	<td colspan="2" style="padding-left:15px;"><input type="button" onclick="tmbh()" name="tambah1" id="tambah1" value="Tambah Data" style="padding-left:20px; padding-right:20px" disabled>&nbsp;<input type="button" onclick="krg()" id="kurang" name="kurang" value="Delete Data" style="padding-left:20px; padding-right:20px" disabled></td>
        <td colspan="2" align="right">Jumlah &nbsp;<input type="text" name="jumlah" id="jumlah" disabled="disabled" /></td>
    </tr>
    <tr>
       	<td style="padding-left:15px; background-color:#FFCC99;"><input type="button" value="Baru" onclick="barus()" name="baru1" style="padding-left:20px; padding-right:20px" />&nbsp;&nbsp;<input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/></td>
        <td colspan="3" style="background-color:#FFCC99;"><input type="button" value="Edit" onclick="ubah()" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Cetak" name="cetak" onclick="cetak1()" style="padding-left:20px; padding-right:20px" disabled/></td>
	</tr>
</table>
</form>
<br />

</div>
<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="480px"></div>
    <div id="pagingArea" width="350px" style="background-color: white;"></div>
</div>
</div>


<div id="obejBrg" style="display:none;">
<br />
<form name="frmSrc3" id="frmSrc3" method="post" action="javascript:void(0);">
<table width="790" border="0">
	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil_nhp" id="fil_nhp" >
        	<option value="1">No. SPTPD</option>
            <option value="2">NPWPD Usaha</option>
            <option value="3">Nama Usaha</option>
            <option value="4">Alamat Usaha</option>
        </select></td>
        <td><input type="text" name="values_nhp" id="values_nhp" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihatNHP()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCos" width="750px" height="270px" style="margin-bottom:10px;"></div>
</div>
</div>

<div id="objBrg" style="display:none;">
<form name="frmSrc" id="frmSrc" method="post" action="javascript:void(0);"><table width="590" border="0">
  	<tr>
		<td width="220" style="padding-left:15px;">Kode Rekening</td>
        <td colspan="3">
        <input type="hidden" name="id" id="id" size="15" />
        <select name="gols" id="gols" onchange="cgol()" >
        	<option value=""></option>
            <?php 
			foreach($gresto->result() as $rs) {
				echo "<option value=".$rs->kd_rek.">".$rs->kd_rek."</option>";
			}
			?>
        </select>
        </td>
	</tr>
    <tr>
		<td style="padding-left:15px;">Nama Rekening</td>
        <td colspan="3"><input type="text" name="nama" id="nama" size="55" /></td>
	</tr>
    <tr>
		<td style="padding-left:15px;">DP</td>
        <td><input type="text" name="dp" id="dp" size="20" /></td>
        <td>Tarif</td><td><input type="text" name="tarif" id="tarif" size="20" /></td>
	</tr>
    <tr>
		<td style="padding-left:15px;">Kenaikan </td>
        <td><input type="text" name="naik" id="naik" size="20" /></td>
        <td>Denda</td><td><input type="text" name="denda" id="denda" size="20" /></td>
	</tr>
    <tr>
		<td style="padding-left:15px;"> Kompensasi</td>
        <td><input type="text" name="sasi" id="sasi" size="20" /></td>
        <td>Bunga</td><td><input type="text" name="bunga" id="bunga" size="20" /></td>
	</tr>
	<tr>
		<td style="padding-left:15px;"> Jumlah</td>
        <td><input type="text" name="jml" id="jml" size="20" /></td>
	</tr>
    <tr>
       	<td colspan="4" style="padding-left:15px;"><input type="button" value="Simpan" name="sav" onclick="tam()" />&nbsp;&nbsp;<input type="button" value="Keluar" onclick="kel()" /></td>
	</tr>
</table>
  </form>
</div>
</div>
<script language="javascript">
	function cetak1(){
		var gabung = document.frmNHP.urut.value+'/'+document.frmNHP.hotel.value;
		window.open('<?php echo site_url(); ?>/nhp/cetak_rek?nota='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}

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
	
	cal1 = new dhtmlxCalendarObject('tgl_jth_tempo');
	cal1.setDateFormat('15/%m/%Y');
		
	cRsa = dhxWins.createWindow("cRsa",0,0,800,390);
	cRsa.setText("Pencarian Data SPTPD");
	cRsa.button("park").hide();
	cRsa.button("close").hide();
	cRsa.button("minmax1").hide();
	cRsa.hide();

	function opens() {
		cRsa.show();
    	//cRsa.setModal(true);
		cRsa.center();
		cRsa.attachObject('obejBrg');
		document.frmSrc3.values_nhp.focus();
	}
	
	function batal() {
		cRsa.hide();
		cRsa.setModal(false);
		document.frmSrc3.fil_nhp.value = "";
		document.frmSrc3.values_nhp.value = "";
		//grids.clearAll();
	}
	
	function barus() {
		kosongfrmNHP2();
		document.frmNHP.tambah.disabled = false;
		document.frmNHP.cari1.disabled = false;
		document.frmNHP.sptpd.disabled = false;
		document.frmNHP.sptpd.focus();
		document.frmNHP.edit1.disabled = true;
		document.frmNHP.delete1.disabled = true;
		document.frmNHP.cetak.disabled = true;
		gride.clearAll();
		buttonDisable1();
		jumchild();	
		opens();
		document.frmSrc3.values_nhp.value = 0;
		lihatNHP();
	}
	
	function bar() {
		document.frmNHP.sptpd.focus();
	}
	
	function lihatNHP() {
		op = document.frmSrc3.fil_nhp.value;
		if(op==1||op==2||op==3||op==4){
			if(document.frmSrc3.values_nhp.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc3.values_nhp.focus();
			return;
			}
		}
		kode = document.frmNHP.kode.value;
		
		if(kode=='HTL'){
			nm_tbl = 'hotel';
		} else if(kode=='AIR'){
			nm_tbl = 'air_bawah_tanah';
		} else if(kode=='RES'){
			nm_tbl = 'restoran';
		} else if(kode=='REK'){
			nm_tbl = 'reklame';
		} else if(kode=='LIS'){
			nm_tbl = 'listrik';
		} else if(kode=='WLT'){
			nm_tbl = 'burung_walet';
		} else if(kode=='PKR'){
			nm_tbl = 'parkir';
		} else if(kode=='GAL'){
			nm_tbl = 'galianc';
		} else if(kode='HIB'){
			nm_tbl = 'hiburan';
		}
		
		nilai = document.frmSrc3.values_nhp.value;
		grids.clearAll();
		grids.loadXML("<?php echo site_url(); ?>/nhp/load_cnhp/"+op+"/"+nilai+"/"+nm_tbl,function() {
			statusEnding();
		});
	}
	
	grids = new dhtmlXGridObject('gridCos');
	grids.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grids.setHeader("id, npwpd, no_sptpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, cara_hitung, tgl_terima, masa_pajak1, masa_pajak2, jml_bayar, insidentil");
	//grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grids.setInitWidths("50,170,150,150,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grids.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grids.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ro,ro,ro,ro");
	grids.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	//grids.enablePaging(true,5,10,"pagingArea",true);
	grids.setPagingSkin("bricks");
	grids.setColumnHidden(0,true);
	grids.setNumberFormat("0,000",13,",",".");
	grids.setSkin("dhx_skyblue");
	grids.attachEvent("onRowDblClicked", selectedOpenData2);
	//grids.loadXML("<?//php echo site_url(); ?>/nhp/cariData?kode="+document.frmNHP.kode.value);
	grids.init();
	
	function selectedOpenData2(id) {
		document.frmNHP.npwpd.value 			= grids.cells(id,1).getValue();
		document.frmNHP.sptpd.value 			= grids.cells(id,2).getValue();
		document.frmNHP.cara.value 				= grids.cells(id,7).getValue();
		document.frmNHP.nama.value 	= grids.cells(id,5).getValue();
		document.frmNHP.alamat.value = grids.cells(id,6).getValue();
		document.frmNHP.nama_perusahaan.value 	= grids.cells(id,3).getValue();
		document.frmNHP.alamat_perusahaan.value = grids.cells(id,4).getValue();
		document.frmNHP.jumlah.value = format_number(grids.cells(id,11).getValue());
                var insidentil = format_number(grids.cells(id,12).getValue());
                
		mp1										= grids.cells(id,9).getValue();
		arr1 	= mp1.split("/");
		document.frmNHP.awal.value = arr1[1];
		mp2										= grids.cells(id,10).getValue();
		arr2 	= mp2.split("/");
		document.frmNHP.akhir.value = arr2[1];
		document.frmNHP.tahun.value = arr1[2];
		
		document.frmNHP.ket_ms1.value = mp1;
		document.frmNHP.ket_ms2.value = mp2;
                if(insidentil == 1) document.frmNHP.tgl_jth_tempo.value = "00/00/0000";
		else document.frmNHP.tgl_jth_tempo.value = mp2;            
		var kode = document.frmNHP.kode.value;
		//alert(kode);
		if(kode=='HTL'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='AIR'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='RES'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='REK'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='LIS'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='WLT'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='PKR'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode=='GAL'){
			child();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		} else if(kode='HIB'){
			lihat();
			document.frmNHP.cari1.disabled = true;
			batal();
			buttonEnable1();
			disableData2();
		}
	}
	
	function child(){
		bongkar = document.frmNHP.sptpd.value.split('/');
		pasang = bongkar[0]+'-'+bongkar[1]+'-'+bongkar[2];
		
		gride.clearAll()
		gride.loadXML("<?php echo site_url(); ?>/nhp/child_galian/"+pasang,function() {
			loadtotal();
			statusEnding();
		});
	}
	
	function rek(){
		bongkar = document.frmNHP.sptpd.value.split('/');
		pasang = bongkar[0]+'-'+bongkar[1]+'-'+bongkar[2];
		
		gride.clearAll()
		gride.loadXML("<?php echo site_url(); ?>/nhp/child_rek/"+pasang,function() {
			loadtotal();
			statusEnding();
		});
	}
	
	gride = new dhtmlXGridObject('gridCo');
	gride.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gride.setHeader("Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, SPTPD, No Nota");
	gride.setInitWidths("100,100,100,100,100,70,70,80,100,100,100");
	gride.setColAlign("left,left,right,right,right,right,right,right,right,right,left");
	gride.setColTypes("ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
	gride.setColSorting("str,str,int,int,int,int,int,int,int,str,str");
	gride.setColumnHidden(9,true);
	gride.setColumnHidden(10,true);
	gride.setNumberFormat("0,000",2,",",".");
	//gride.setNumberFormat("0,000",3,",",".");
	//gride.setNumberFormat("0,000",4,",",".");
	//gride.setNumberFormat("0,000",5,",",".");
	//gride.setNumberFormat("0,000",6,",",".");
	//gride.setNumberFormat("0,000",7,",",".");
	gride.setNumberFormat("0,000",8,",",".");
	gride.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpNaik>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpSasi>{#stat_total}</div>,<div style=text-align:right id=tmpBun>{#stat_total}</div>,<div style=text-align:right id=tmpJml>{#stat_total}</div>");
	gride.attachEvent("onRowDblClicked", selectedOpenData3);
	gride.setSkin("dhx_skyblue");
	gride.enableMultiselect(true);
	gride.init();
		
	var dpps = "";
	function rundpPO(){
		dpps = new dataProcessor("<?php echo site_url(); ?>/nhp/dt_rekening");
		dpps.setUpdateMode("off");
		dpps.init(gride);       
		dpps.attachEvent("onAfterUpdateFinish", function() {        
			refreshData();
			enableData();	
			//enableButton();
			document.frmNHP.edit1.disabled = false;
			document.frmNHP.delete1.disabled = false;
			document.frmNHP.cetak.disabled = false;
			statusEnding();
			alert("Done");
			return true;
		});
	}
	
	function selectedOpenData3(id){
		tampil();
		document.frmSrc.gols.value = gride.cells(id,0).getValue();
		document.frmSrc.nama.value = gride.cells(id,1).getValue();
		document.frmSrc.dp.value = gride.cells(id,2).getValue();
		document.frmSrc.tarif.value = gride.cells(id,3).getValue();
		document.frmSrc.naik.value = gride.cells(id,4).getValue();
		document.frmSrc.denda.value = gride.cells(id,5).getValue();
		document.frmSrc.sasi.value = gride.cells(id,6).getValue();
		document.frmSrc.bunga.value = gride.cells(id,7).getValue();
		document.frmSrc.jml.value = gride.cells(id,8).getValue();
		
	}
	
	function cek(){
		gride.clearAll();
		gride.loadXML("<?php echo site_url(); ?>/nhp/data_rekening?nota="+document.frmNHP.nota.value);
	}
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, no_nota, sptpd, npwpd, cara_hitung, nama, alamat, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, sk, kep_proyek, jumlah, kode, masa_pajak_1, masa_pajak_2", //19
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,170,150,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,20,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	grid.setNumberFormat("0,000",15,",",".");
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/nhp/data?kode="+document.frmNHP.kode.value);
	grid.init();
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/nhp/data?kode="+document.frmNHP.kode.value);
	}
	
	function selectedOpenData(id) {
		statusLoading();
		kosongfrmNHP2();
		enableButton();
		document.frmNHP.tgl.disabled = true;
		document.frmNHP.sk.disabled = true;
		document.frmNHP.kep_proyek.disabled = true;
		
		document.frmNHP.nota.value = grid.cells(id,1).getValue();
		document.frmNHP.id.value	= grid.cells(id,0).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmNHP.urut.value = arr[0];
		document.frmNHP.hotel.value = arr[1]+'/'+arr[2];
		document.frmNHP.sptpd.value = grid.cells(id,2).getValue();
		document.frmNHP.npwpd.value = grid.cells(id,3).getValue();
		document.frmNHP.cara.value 	= grid.cells(id,4).getValue();
		document.frmNHP.nama.value 	= grid.cells(id,5).getValue();
		document.frmNHP.alamat.value 	= grid.cells(id,6).getValue();
		document.frmNHP.nama_perusahaan.value	= grid.cells(id,7).getValue();
		document.frmNHP.alamat_perusahaan.value	= grid.cells(id,8).getValue();
		document.frmNHP.awal.value = grid.cells(id,9).getValue();
		document.frmNHP.akhir.value = grid.cells(id,10).getValue();
		document.frmNHP.tahun.value = grid.cells(id,11).getValue();
		document.frmNHP.tgl.value = grid.cells(id,12).getValue();
		document.frmNHP.sk.value = grid.cells(id,13).getValue();
		document.frmNHP.kep_proyek.value = grid.cells(id,14).getValue();
		document.frmNHP.jumlah.value = format_number(grid.cells(id,15).getValue());
		document.frmNHP.kode.value = grid.cells(id,16).getValue();
		document.frmNHP.ket_ms1.value = grid.cells(id,17).getValue();
		document.frmNHP.ket_ms2.value = grid.cells(id,18).getValue();
		cek();
		//buttonEnable1();
		tabbar.setTabActive("a1");
		//loadtotal();
		statusEnding();
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
						"sptpd=" + document.frmNHP.sptpd.value +
						"&kode=" + document.frmNHP.kode.value +
						"&nota=" + document.frmNHP.nota.value +
						"&sk=" + document.frmNHP.sk.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/nhp/delete', postStr, responeDel);	
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
					kosongfrmNHP2();
					refreshData();					
					statusEnding();
					alert(result);
					kosongChild();
					
		document.frmNHP.edit1.disabled = true;
		document.frmNHP.delete1.disabled = true;
		document.frmNHP.cetak.disabled = true;
		document.frmNHP.tambah.disabled = true;
		document.frmNHP.cari1.disabled = true;
		document.frmNHP.baru1.disabled = false;
		document.frmNHP.sptpd.disabled = true;
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	statusEnding();
</script>