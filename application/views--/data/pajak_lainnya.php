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

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	
	function popupform(myform, windowname){
		if (! window.focus)return true;
		window.open('', windowname, 'height=700,width=1000,scrollbars=yes');
		myform.target=windowname;
		return true;
	}
	
	function lihat() {
		if(document.frmSKPDHotel.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmSKPDHotel.npwpd.focus();
			return;
		}
		
		var postStr =
		"npwpd=" + document.frmSKPDHotel.npwpd.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/pajak_lainnya/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					//document.frmSKPDHotel.nama_perusahaan.value = arr[0];
					//document.frmSKPDHotel.alamat_perusahaan.value = arr[1];
					document.frmSKPDHotel.tambah.disabled = false;
					disableData1();
				} else {
					alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function getLastDate(iThn, iBln1, iBln2, iTgl1, iTgl2){			
        var iThnVal	= document.getElementById(iThn).value;
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
	
	function disableData1() {
		//document.frmSKPDHotel.nama_perusahaan.disabled = false;
		//document.frmSKPDHotel.subjenis.disabled = false;
		//document.frmSKPDHotel.perhitungan.disabled = false;
		//document.frmSKPDHotel.alamat_perusahaan.disabled = true;
		/* document.frmSKPDHotel.karcis1.disabled = false;
		document.frmSKPDHotel.karcis2.disabled = false; */
	 	//document.frmSKPDHotel.penagih.disabled = false;
	/*	document.frmSKPDHotel.txtblnmasapajak2.disabled = false;*/
		document.frmSKPDHotel.txtthnmasapajak.disabled = false;	 
		document.frmSKPDHotel.txttglmasapajak2.disabled = false;		
		document.frmSKPDHotel.txttglmasapajak1.disabled = false;		
		//document.frmSKPDHotel.cara.disabled = false;
		document.frmSKPDHotel.gol.disabled = false;		
		//document.frmSKPDHotel.ket_inap.disabled = false;
		document.frmSKPDHotel.tgl.disabled = false;
		document.frmSKPDHotel.petugas.disabled = false;
		document.frmSKPDHotel.jumlah.disabled = false;
		document.frmSKPDHotel.tarif.disabled = false;
		document.frmSKPDHotel.npwpd.disabled = false;
		/* document.frmSKPDHotel.SPTR.disabled = false;
		document.frmSKPDHotel.SPTI.disabled = false; */
		//document.frmSKPDHotel.SPTT.disabled = false;
		//document.frmSKPDHotel.ket_insidentil.disabled = false;
	}
	
	function enableData1() {
		//document.frmSKPDHotel.nama_perusahaan.disabled = true;
		//document.frmSKPDHotel.subjenis.disabled = true;
		//document.frmSKPDHotel.perhitungan.disabled = true;
		/* document.frmSKPDHotel.karcis1.disabled = true;
		document.frmSKPDHotel.karcis2.disabled = true; */
		//document.frmSKPDHotel.penagih.disabled = true;
		/*document.frmSKPDHotel.txtblnmasapajak2.disabled = true;*/
		document.frmSKPDHotel.txtthnmasapajak.disabled = true;	 
		document.frmSKPDHotel.txttglmasapajak2.disabled = true;		
		document.frmSKPDHotel.txttglmasapajak1.disabled = true;				
		//document.frmSKPDHotel.cara.disabled = true;
		document.frmSKPDHotel.gol.disabled = true;
		//document.frmSKPDHotel.ket_inap.disabled = true;
		document.frmSKPDHotel.tgl.disabled = true;
		document.frmSKPDHotel.jumlah.disabled = true;
		document.frmSKPDHotel.tarif.disabled = true;
		document.frmSKPDHotel.petugas.disabled = true;
		/* document.frmSKPDHotel.SPTR.disabled = true;
		document.frmSKPDHotel.SPTI.disabled = true; */
		//document.frmSKPDHotel.SPTT.disabled = true;
		//document.frmSKPDHotel.ket_insidentil.disabled = true;
	}
	
	function simpan() {
		/*if(document.frmSKPDHotel.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmSKPDHotel.npwpd.focus();
			return;
		}
		
		 if(document.frmSKPDHotel.ket_inap.value=="") {
			alert("Keterangan Gol. Kamar tidak boleh kosong.");
			document.frmSKPDHotel.ket_inap.focus();
			return;
		} 
		
		if(document.frmSKPDHotel.txttglmasapajak1.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			document.frmSKPDHotel.txttglmasapajak1.focus();
			return;
		}
		
		if(document.frmSKPDHotel.txttglmasapajak2.value=="") {
			alert("Tanggal Tidak Boleh Kosong");
			document.frmSKPDHotel.txttglmasapajak2.focus();
			return;
		}
		
		if(document.frmSKPDHotel.txtthnmasapajak.value=="") {
			alert("Tahun Pajak Tidak Boleh Kosong");
			document.frmSKPDHotel.txtthnmasapajak.focus();
			return;
		}*/				
		
		jml_bayar2 = ($('#jumlah').unmask());		
		/*if(jml_bayar2 < 5000000){
			alert("Maaf Dasar Pengenaan Kurang dari 5 Juta");
			document.frmSKPDHotel.jumlah.focus();
			return;
		}*/
		
		/* if(document.frmSKPDHotel.jnsSPT.checked==false) {
			alert("Jenis SPT Tidak Boleh Kosong");
			document.frmSKPDHotel.jnsSPT.focus();
			return;
		} */
		
		if(document.frmSKPDHotel.urut.value=="") {
			//cek();
			simpan2();
		} else {
			simpan2();
		}
	}	
	
	function cek(){
	  /*  if(document.frmSKPDHotel.SPTR.checked==true) {
			jnsSPT = "REGULAR";
		}
		if(document.frmSKPDHotel.SPTI.checked==true) {
			jnsSPT = "INSIDENTIL";
		} */
		/*if(document.frmSKPDHotel.SPTT.checked==true) {
			jnsSPT = "TUNGGAKAN";
		}*/
        
		var postCek =
			"npwpd=" + document.frmSKPDHotel.npwpd.value +
			/* "&awal=" + document.frmSKPDHotel.txtblnmasapajak1.value +
			"&akhir=" + document.frmSKPDHotel.txtblnmasapajak2.value + */
			"&tahun=" + document.frmSKPDHotel.txtthnmasapajak.value ;
            //"&jnsSPT=" + jnsSPT;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/pajak_lainnya/ricek', postCek, resPOST);
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
		/* if(document.frmSKPDHotel.SPTR.checked==true) {
			jnsSPT = "REGULAR";
		}
		if(document.frmSKPDHotel.SPTI.checked==true) {
			jnsSPT = "INSIDENTIL";
		} */
		/*if(document.frmSKPDHotel.SPTT.checked==true) {
			jnsSPT = "TUNGGAKAN";
		}
		//if(document.frmSKPDHotel.sen1.checked==true) {
		//	sen = "TERMASUK PAJAK";
		//}
		if(document.frmSKPDHotel.sen2.checked==true) {
			sen = "BELUM TERMASUK PAJAK";
		}*/	
		arr01 = document.frmSKPDHotel.urut.value;
		arr02 = document.frmSKPDHotel.hotel.value;
		arrfull = arr01+'/'+arr02;
		
		tgl = document.frmSKPDHotel.tgl.value;
		arr = tgl.split("/");
		skrg = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		tgl1 = document.frmSKPDHotel.txttglmasapajak1.value;
		arr1 = tgl1.split("/");
		awal = arr1[2]+'-'+arr1[1]+'-'+arr1[0];
		
		tgl2 = document.frmSKPDHotel.txttglmasapajak2.value
		arr2 = tgl2.split("/");
		akhir = arr2[2]+'-'+arr2[1]+'-'+arr2[0];
		
		
		
		var postStr =
			"id=" + document.frmSKPDHotel.id.value +
			"&npwpd=" + document.frmSKPDHotel.npwpd.value +
			"&sptpd=" + arrfull +
			//"&jns=" + jnsSPT +
			/*"&ket_pajak=" + sen +
			 "&awal=" + document.frmSKPDHotel.txtblnmasapajak1.value +
			"&akhir=" + document.frmSKPDHotel.txtblnmasapajak2.value +*/
			"&tahun=" + document.frmSKPDHotel.txtthnmasapajak.value + 
			//"&ket=" + document.frmSKPDHotel.ket_insidentil.value +
			//"&nama=" + document.frmSKPDHotel.nama_perusahaan.value +
			//"&subjenis=" + document.frmSKPDHotel.subjenis.value +
			//"&perhitungan=" + document.frmSKPDHotel.perhitungan.value +
			//"&alamat=" + document.frmSKPDHotel.alamat_perusahaan.value +
			/* "&karcis1=" + document.frmSKPDHotel.karcis1.value +
			"&karcis2=" + document.frmSKPDHotel.karcis2.value + */
			//"&penagih=" + document.frmSKPDHotel.penagih.value +
			//"&cara=" + document.frmSKPDHotel.cara.value +
			"&tgl=" + skrg +
			//"&petugas=" + document.frmSKPDHotel.petugas.value +
			"&gol=" + document.frmSKPDHotel.gol.value +
			//"&ket_inap=" + document.frmSKPDHotel.ket_inap.value +			
			//"&tgl1=" + awal +
			"&tarif=" + document.frmSKPDHotel.tarif.value  +
			"&jumlah=" + document.frmSKPDHotel.jumlah.value +
			"&setoran=" + document.frmSKPDHotel.setoran.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/pajak_lainnya/simpan', postStr, responePOST);
	}
	
	function responePOST(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result) {
					r = result.split("/");
					document.frmSKPDHotel.urut.value = r[0];
					document.frmSKPDHotel.hotel.value = r[1]+'/'+r[2];
					refreshData();
					enableData1();	
					enableButton();
					statusEnding();
					alert('Simpan Berhasil');
					document.frmSKPDHotel.tambah.disabled = true;
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	function kosongfrmSKPDHotel1() {
		document.frmSKPDHotel.id.value = "";
		document.frmSKPDHotel.urut.value = "";
		document.frmSKPDHotel.hotel.value = "";
		document.frmSKPDHotel.npwpd.value = "";
		//document.frmSKPDHotel.nama_perusahaan.value = "";
		//document.frmSKPDHotel.subjenis.value = "";
		//document.frmSKPDHotel.perhitungan.value = "";
		//document.frmSKPDHotel.alamat_perusahaan.value = "";
		/* document.frmSKPDHotel.karcis1.value = "";
		document.frmSKPDHotel.karcis2.value = ""; */
		/* document.frmSKPDHotel.txtblnmasapajak1.value='';
		document.frmSKPDHotel.txtblnmasapajak2.value=''; */
		document.frmSKPDHotel.txttglmasapajak1.value='';
		document.frmSKPDHotel.txttglmasapajak2.value='';
		document.frmSKPDHotel.txtthnmasapajak.value='';
		//document.frmSKPDHotel.penagih.value = "";
		//document.frmSKPDHotel.cara.value = "";
		document.frmSKPDHotel.gol.value = "";		
		//document.frmSKPDHotel.ket_inap.value = "";		
		document.frmSKPDHotel.jumlah.value = "";
		document.frmSKPDHotel.setoran.value = "";
		/* document.frmSKPDHotel.SPTR.value = "";
		document.frmSKPDHotel.SPTI.value = ""; */
		//document.frmSKPDHotel.SPTT.value = "";
		//document.frmSKPDHotel.ket_insidentil.value = "";
	}	
		
	function enableButton() {
		document.frmSKPDHotel.edit1.disabled = false;
		document.frmSKPDHotel.delete1.disabled = false;
		document.frmSKPDHotel.cetak.disabled = false;
	}
	
	function disableButton() {
		document.frmSKPDHotel.edit1.disabled = true;
		document.frmSKPDHotel.delete1.disabled = true;
		document.frmSKPDHotel.cetak.disabled = true;
	}
	
	function baru() {
		kosongfrmSKPDHotel1();
		disableButton();
		document.frmSKPDHotel.cari1.disabled = false;
		document.frmSKPDHotel.tambah.disabled = false;
		disableData1();
		document.frmSKPDHotel.npwpd.focus();
		document.frmSKPDHotel.jumlah.value = 0;
		document.frmSKPDHotel.setoran.value = 0;
	}
	
	function ubah() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				disableData1();
				/* document.frmSKPDHotel.txtblnmasapajak1.disabled = true;
				document.frmSKPDHotel.txtblnmasapajak2.disabled = true;*/
				document.frmSKPDHotel.txtthnmasapajak.disabled = true; 
				document.frmSKPDHotel.baru1.disabled = false;
				document.frmSKPDHotel.tambah.disabled = false;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
</script>
<style>
		body {
			background:#FFF;
		}
	</style>
<div style="height:100%; overflow:auto;">
<h2 style="margin:30px 5px 25px 30px;">Penginputan Pajak Lainnya</h2>

<div id="a_tabbar" style="width:1000px; height:530px; margin-left:30px;"></div>
  <div id="C1" style="background-color: #B3D9F0">
    <form name="frmSKPDHotel" id="frmSKPDHotel" action="<?php echo site_url(); ?>/pajak_lainnya/cetak" method="post" onSubmit="popupform(this, 'iui')" >
    <br />
   	  <table width="787" border="0">
      		<tr>
        		<td width="198" style="padding-left:15px;">No. SPTRD </td>
            	<td width="471" colspan="2"><input type="text" name="urut" id="urut" size="22" style="background-color:#FFFFCC;" disabled/>&nbsp;/&nbsp;<input type="text" name="hotel" id="hotel" style="background-color:#FFFFCC;" size="15" disabled/></td>
        	</tr>
           <!-- <tr>
              	<td style="padding-left:15px;">Bulan</td>
                <td colspan="2"><?php echo $ctl_masapajak1; ?> s/d <?php echo $ctl_masapajak2; ?></td>
            </tr>-->
            <tr>
              	<td style="padding-left:15px;">Tahun</td>
                <td><?php echo $ctl_tahunpajak; ?></td>
           <!-- <td rowspan="3"><fieldset><legend>Jenis SPT</legend>
                <table width="200" border="0">
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTR" value="0" disabled></td>
                    <td>SPT Regular</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTI" value="0" disabled></td>
                    <td>Insidentil</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="jnsSPT" id="SPTT" value="0" disabled></td>
                    <td>Tunggakan</td>
                  </tr>
                </table>
              </fieldset></td>-->
            </tr>
            <tr>
                <!--<td style="padding-left:15px;">NPWPD Usaha</td>-->
                <td><input type="hidden" name="id" id="id" size="35" /><input type="hidden" name="sptpd" id="sptpd" size="35" />
                <input type="hidden" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase; background-color: #FFCC99;" />
                <input type="hidden" onclick="opens()" value="Cari" id="cari1" name="cari1" style="padding-left:20px; padding-right:20px" disabled/>
                </td>
    		</tr>
           <!-- <tr>
              	<td style="padding-left:15px;"> SKPD Pengelola</td>
                <td><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45"  disabled/></td>
            </tr>-->
            <!--<tr>
              	<td style="padding-left:15px;"> Alamat Usaha</td>
                <td><input type="hidden" name="alamat_perusahaan" id="alamat_perusahaan" style="background-color:#FFFFCC;" size="45" disabled/></td>
                <!--<td rowspan="3" valign="top" align="center">Keterangan Insidentil<br>
              <textarea name="ket_insidentil" id="ket_insidentil" cols="25" rows="2" disabled></textarea></td>
            </tr>-->
            <!-- <tr>
                <td style="padding-left:15px;" colspan="2">Cara perhitungan dan penetapan yang dikehendaki</td>
            </tr>
            <tr>
                <td style="padding-left:15px;" colspan="2"><select name="cara" id="cara" disabled>
                   <option value="1">Official Assesment(Dihitung dan ditetapkan oleh Pejabat Dispenda)</option>
                    <option value="2" selected="selected">Self Assesment(Menghitung dan Menetapkan Pajak Sendiri)</option>
              </select></td>
            </tr>
            <tr>
              <td style="padding-left:15px;">&nbsp;</td>
              <td colspan="2"><input type="hidden" name="kasda" id="kasda" onchange="set_tanggal_kasda();" />
               </td>
            </tr>-->
            <tr>
              	<td style="padding-left:15px;">Tanggal Terima</td>
                <td colspan="2"><input name="tgl" type="text" disabled id="tgl" value="<?php echo $tanggal; ?>" size="30"/></td>
            </tr>
			<!--<tr>
                          <td style="padding-left:15px;">Kriteria Perhitungan</td>
                          <td>
                          <select id="perhitungan" name="perhitungan" disabled="disabled">
                            <option value="hari">Harian</option>
                            <option value="bulan">Bulanan</option>
                            <option value="insidentil">Insidentil</option>
                          </select>
                    
             </tr>-->
            <tr>
           	  <td style="padding-left:15px;">Petugas Input</td>
           	  <td colspan="2"><select name="petugas" id="petugas" disabled>
              <option value="<?php echo $userPetugas; ?>" selected="selected"><?php echo $namaPetugas; ?></option>
         	  </select></td>
   	    	</tr>
			<!--<tr>
              	<td style="padding-left:15px;">Petugas Penagih</td>
                <td><input type="text" name="penagih" id="penagih" size="13" disabled/></td>
            </tr>-->
           	<tr>
              	<td style="padding-left:15px;">Rekening</td>
                <td colspan="2"><select name="gol" id="gol" onchange="tarif_pajak();" disabled="disabled">
                <option value=""></option>
                <?php 
				foreach($gresto->result() as $rs) {
						echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
					}
				?>
                </select></td>
            </tr>
			 <!--<tr>
              	<td style="padding-left:15px;">Sub Jenis Retribusi</td>
                <td><input type="text" name="subjenis" id="subjenis" size="45" disabled/></td>
            </tr>
           <tr>
              	<td style="padding-left:15px;">Masa Pajak</td>
                <td colspan="2"><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12" readonly />&nbsp;
			 <i>s.d</i> <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12" readonly /></td>
            </tr>-->
			<tr>
              	<td style="padding-left:15px;"></td>
                <td colspan="2"><input type="hidden" name="txttglmasapajak1" id="txttglmasapajak1" size="12" disabled/>&nbsp;
			 <input type="hidden" name="txttglmasapajak2" id="txttglmasapajak2" size="12" disabled/></td>
            </tr>
			<!--<tr>
              	<td style="padding-left:15px;">No Seri Karcis</td>
                <td colspan="2"><input type="text" name="karcis1" id="karcis1" size="10" disabled/>&nbsp;
			 <i>s.d</i> <input type="text" name="karcis2" id="karcis2" size="10" disabled/></td>
            </tr>-->
            <tr>
                <td style="padding-left:15px;">Jumlah Karcis</td>
                <td><input style="text-align:right" type="text" name="jumlah" id="jumlah" size="22" onkeyup="hitung();" disabled/></td>
				<!--<td rowspan="3" valign="top" align="center"> Gol. Kamar : Tarif = Jlh Kamar,<br />
				  ex: (Deluxe : Rp.100.000 = 12, ...)<br>
              <textarea name="ket_inap" id="ket_inap" cols="25" rows="2" disabled></textarea></td>-->
            </tr>
            <tr>
                <td style="padding-left:15px;">Harga Satuan</td>
                <td><input style="text-align:right" type="text" name="tarif" id="tarif" size="20" onkeyup="hitung();" disabled/>&nbsp;
                <!--&nbsp;<input type="radio" name="sen" id="sen1" />Termasuk Pajak
                &nbsp;<input type="hidden" name="sen" id="sen2" /></td>-->
            </tr>
            <tr>
                <td style="padding-left:15px;">Realisasi Penerimaan</td>
                <td><input style="text-align:right" type="text" name="setoran" id="setoran" size="22" disabled/></td>
            </tr>
	<tr>       	
        <td colspan="3" style="background-color:#FFCC99;"><input type="button" value="Baru" onclick="baru()" name="baru1" style="padding-left:20px; padding-right:20px"/>
		<input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px" disabled/>
		<input type="button" value="Edit" onclick="ubah()" name="edit1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" value="Hapus" onclick="deleteData()" name="delete1" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="button" onclick="cetak1()" value="Cetak" name="cetak" style="padding-left:20px; padding-right:20px" disabled/>
        <input type="hidden" value="SPTPD Kosong" onclick="kosong()" name="null" id="null" /></td>
	</tr>
</table>
</form>
<br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="460px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="349px" style="background-color:white;"></div>
</div>
</div>

<div id="objsBrg" style="display:none;">
<br />
<form name="frmSrc2" id="frmSrc2" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Usaha</option>
            <option value="2">Nama Usaha</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>
</div>
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";

	/*function tarif_pajak(){
		 if(document.frmSKPDHotel.gol.value=="") {
			alert("Golongan Hotel Tidak Boleh Kosong");
			document.frmSKPDHotel.gol.focus();
			return;
		} 
		var postGol =
			"gol=" + document.frmSKPDHotel.gol.value;
		
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/sptrdnew/tarif', postGol, respJns);			
	}*/
        
        function get_bln_blm_bayar(){
            var npwpd = "npwpd="+document.frmSKPDHotel.npwpd.value;
            dhtmlxAjax.post(base_url+'index.php/pajak_lainnya/get_bayar_terakhir', npwpd, respBulan);
        }
        
        function respBulan(loader){
            if (loader.xmlDoc.readyState == 4) {
                if (loader.xmlDoc.status == 200) {
                    result = loader.xmlDoc.responseText;
                    var array_tanggal = result.split("|");
                    tahun = parseInt(array_tanggal[0]);
                    bulan = parseInt(array_tanggal[1])+1;
                    //ket_inap = array_tanggal[2];
                    if(bulan == 13 ){
                        bulan = 1;
                        if(bulan<10) bulan = "0"+bulan;
                        tahun = tahun + 1;
                    }
                    document.frmSKPDHotel.txtthnmasapajak.value = tahun;
                    document.frmSKPDHotel.txtblnmasapajak1.value = bulan;
                    document.frmSKPDHotel.txtblnmasapajak2.value = bulan;
                    //document.frmSKPDHotel.ket_inap.value = ket_inap.trim();
                    getLastDate('txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2');
                }else{
                    alert("Ada masalah sedikit.");
                }
            }
        }
        	
	/* function respJns(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					document.frmSKPDHotel.tarif.value = result;
					document.frmSKPDHotel.sen2.checked = true;
				} else {
					alert("Silakan Pilih Jenis Kategori Tarif");
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	} 

	$(function() {         
    	$('#jumlah').priceFormat({
        	prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
			centsLimit: 0
         });
		 $("#jumlah").keyup(function(){
			 hitung($('#jumlah').unmask());
		});
	});*/
	
	function hitung(jumlahDP){
		
		/* if(jumlahDP=="0") { return; }
			if(jumlahDP=="") {
				nilai_pot = 0;
				document.frmSKPDHotel.jumlah.value = 0;
			} else {
				nilai_pot = parseInt(jumlahDP);	
			} */
			total = (document.frmSKPDHotel.jumlah.value*document.frmSKPDHotel.tarif.value);
			document.frmSKPDHotel.setoran.value = format_number(total);
		}
	
	function kosong(){
		window.open('<?php echo site_url(); ?>/hotel_pdf', '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function cetak1() {
		var gabung = document.frmSKPDHotel.urut.value+'/'+document.frmSKPDHotel.hotel.value;
		window.open('<?php echo site_url(); ?>/pajak_lainnya/cetak?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
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
	
	wBrg = dhxWins.createWindow("wBrg",0,0,800,400);
	wBrg.setText("Pencarian Data Usaha");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function opens() {
		wBrg.show();
    	//wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objsBrg');
	}
	
	function batal() {
		wBrg.hide();
		wBrg.setModal(false);
		document.frmSrc2.fil.value = "0";
		document.frmSrc2.values.value = "";
		//grids.clearAll();
	}
	
	function lihat3() {
		op = document.frmSrc2.fil.value;
		if(op==1||op==2||op==3){
			if(document.frmSrc2.values.value=="") {
			alert("Value Pencarian Tidak Boleh Kosong");
			document.frmSrc2.values.focus();
			return;
			}
		}
		nilai = document.frmSrc2.values.value;
		gridx.clearAll();
		gridx.loadXML("<?php echo site_url(); ?>/pajak_lainnya/load_perusahaan4/"+op+"/"+nilai,function() {
			statusEnding();
		});
	}
	
	gridx= new dhtmlXGridObject('gridCo');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("id, npwpd_usaha, nama_usaha, alamat_usaha, Nama Rekening, Telp, id_pemilik, nama_pemilik, alamat_pemilik, telp_pemilik");

	gridx.setInitWidths("50,120,200,200,150,100,100,100,100,100");
	gridx.setColAlign("center,left,left,left,left,left,left,left,left,left");
	gridx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridx.setColSorting("str,str,str,str,str,str,str,str,str,str");
	gridx.enablePaging(true,1000,1000,"pagingArea",true);
	gridx.setPagingSkin("bricks");
	gridx.setSkin("dhx_skyblue");
	gridx.setColumnHidden(0,true);
	gridx.attachEvent("onRowDblClicked", selectedOpenData2);
	gridx.init();
	
	function selectedOpenData2(id) {
		document.frmSKPDHotel.npwpd.value 	= gridx.cells(id,1).getValue();		
		//document.frmSKPDHotel.nama_perusahaan.value		= gridx.cells(id,2).getValue();
		//document.frmSKPDHotel.alamat_perusahaan.value 	= gridx.cells(id,3).getValue();
		
		//Otomatis milih golongan hotel
		/* var arrayNPWPD = document.frmSKPDHotel.npwpd.value.split(".");
		document.frmSKPDHotel.gol.value = "4.1.1.01."+arrayNPWPD[2];
		
		//Otomatis tentukan persentase pajak
		tarif_pajak();
		get_bln_blm_bayar(); */
		batal();
                
	}
        
        
	
	grid = new dhtmlXGridObject('gridContent');
	grid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grid.setHeader("id, No SPTRD, Tahun, Kriteria Hitung, Jumlah Karcis, SKPD Pengelola, Tanggal Terima, No Karcis 1, No Karcis 2, JNS Retribusi, SUB JNS Retribusi, Jumlah,Petuga Input, Petugas Penagih"); //13
	grid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	grid.setInitWidths("50,100,100,100,100,170,100,100,100,100,100,100,100,100");
	grid.setColAlign("center,left,center,center,center,left,left,center,center,left,left,left,left,left");
	grid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro,ro");
	grid.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str");
	grid.enablePaging(true,25,10,"pagingArea",true);
	grid.setPagingSkin("bricks");
	grid.setColumnHidden(0,true);
	/* grid.setNumberFormat("0,000",13,",",".");
	grid.setNumberFormat("0,000",14,",","."); */
	grid.setSkin("dhx_skyblue");
	grid.attachEvent("onRowDblClicked", selectedOpenData);
	grid.loadXML("<?php echo site_url(); ?>/pajak_lainnya/data");
	grid.init();
        baru();
	
	function refreshData() {
		grid.clearAll();
		grid.loadXML("<?php echo site_url(); ?>/pajak_lainnya/data");
	}
	
	function selectedOpenData(id) {
		tabbar.setTabActive("a1");
		statusLoading();
		kosongfrmSKPDHotel1();
		enableData1();
		enableButton();
		document.frmSKPDHotel.baru1.disabled = true;
		document.frmSKPDHotel.tambah.disabled = true;
		document.frmSKPDHotel.npwpd.disabled = true;
		document.frmSKPDHotel.id.value	= grid.cells(id,0).getValue();
		document.frmSKPDHotel.sptpd.value = grid.cells(id,1).getValue();
		reg = grid.cells(id,1).getValue();
		arr = reg.split("/");
		document.frmSKPDHotel.urut.value = arr[0];
		document.frmSKPDHotel.hotel.value = arr[1]+'/'+arr[2];
		document.frmSKPDHotel.txtthnmasapajak.value	= grid.cells(id,2).getValue();
		//document.frmSKPDHotel.perhitungan.value	= grid.cells(id,3).getValue();
		document.frmSKPDHotel.jumlah.value	= grid.cells(id,4).getValue();
		//document.frmSKPDHotel.nama_perusahaan.value	= grid.cells(id,5).getValue();
		document.frmSKPDHotel.tgl.value 	 	= grid.cells(id,6).getValue();
		/* document.frmSKPDHotel.karcis1.value 	 	= grid.cells(id,7).getValue();
		document.frmSKPDHotel.karcis2.value 	 	= grid.cells(id,8).getValue(); */
		document.frmSKPDHotel.gol.value 	 	= grid.cells(id,9).getValue();
		//document.frmSKPDHotel.subjenis.value 	 	= grid.cells(id,10).getValue();
		document.frmSKPDHotel.setoran.value 	 	= grid.cells(id,11).getValue();
		//document.frmSKPDHotel.penagih.value 	 	= grid.cells(id,13).getValue();
		statusEnding();
	}
	
	function deleteData() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				confrm = confirm("Apakah Anda Yakin");
				if(confrm) {
					var postStr =
						"sptpd=" + document.frmSKPDHotel.sptpd.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/pajak_lainnya/delete', postStr, responeDel);	
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
					refreshData();
					enableButton();
					statusEnding();
					alert(result);
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
	
	statusEnding();
	function set_tanggal_kasda(){
		var cek_kasda = document.getElementById('kasda').checked;
		if(cek_kasda){
			document.getElementById('tgl').value = "";
		}
		else{
			document.getElementById('tgl').value = "<?php echo $tanggal; ?>";
		}
	}
</script>