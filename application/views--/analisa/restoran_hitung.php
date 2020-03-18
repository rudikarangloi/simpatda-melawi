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
		dhtmlxAjax.post(base_url+'index.php/hotel/lihat', postStr, responeP);			
	}
	
	function responeP(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				statusEnding();
				if(result!=0) {
					arr = result.split('|');
					document.frmSKPDHotel.nama_perusahaan.value = arr[0];
					document.frmSKPDHotel.alamat_perusahaan.value = arr[1];
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
	
	function disableData1() {
		document.frmSKPDHotel.nama_perusahaan.disabled = true;
		document.frmSKPDHotel.alamat_perusahaan.disabled = true;
		document.frmSKPDHotel.awal.disabled = false;
		document.frmSKPDHotel.akhir.disabled = false;
		document.frmSKPDHotel.tahun.disabled = false;
		document.frmSKPDHotel.cara.disabled = false;
		document.frmSKPDHotel.gol.disabled = false;
		document.frmSKPDHotel.tgl.disabled = false;
		document.frmSKPDHotel.petugas.disabled = false;
		document.frmSKPDHotel.jumlah.disabled = false;
		document.frmSKPDHotel.npwpd.disabled = false;
		document.frmSKPDHotel.SPTR.disabled = false;
		document.frmSKPDHotel.SPTI.disabled = false;
		document.frmSKPDHotel.SPTT.disabled = false;
		document.frmSKPDHotel.ket_insidentil.disabled = false;
	}
	
	function enableData1() {
		document.frmSKPDHotel.awal.disabled = true;
		document.frmSKPDHotel.akhir.disabled = true;
		document.frmSKPDHotel.tahun.disabled = true;
		document.frmSKPDHotel.cara.disabled = true;
		document.frmSKPDHotel.gol.disabled = true;
		document.frmSKPDHotel.tgl.disabled = true;
		document.frmSKPDHotel.jumlah.disabled = true;
		document.frmSKPDHotel.petugas.disabled = true;
		document.frmSKPDHotel.SPTR.disabled = true;
		document.frmSKPDHotel.SPTI.disabled = true;
		document.frmSKPDHotel.SPTT.disabled = true;
		document.frmSKPDHotel.ket_insidentil.disabled = true;
	}
	
	function simpan() {
		if(document.frmSKPDHotel.npwpd.value=="") {
			alert("NPWPD Tidak Boleh Kosong");
			document.frmSKPDHotel.npwpd.focus();
			return;
		}
		
		if(document.frmSKPDHotel.jnsSPT.checked==false) {
			alert("Jenis SPT Tidak Boleh Kosong");
			document.frmSKPDHotel.jnsSPT.focus();
			return;
		}
		
		if(document.frmSKPDHotel.SPTR.checked==true) {
			jnsSPT = "REGULAR";
		}
		if(document.frmSKPDHotel.SPTI.checked==true) {
			jnsSPT = "INSIDENTIL";
		}
		if(document.frmSKPDHotel.SPTT.checked==true) {
			jnsSPT = "TUNGGAKAN";
		}
		
		arr01 = document.frmSKPDHotel.urut.value;
		arr02 = document.frmSKPDHotel.hotel.value;
		arrfull = arr01+'/'+arr02;
		
		tgl = document.frmSKPDHotel.tgl.value;
		arr = tgl.split("/");
		skrg = arr[2]+'-'+arr[1]+'-'+arr[0];
		
		tgl1 = document.frmSKPDHotel.tgl1.value;
		arr1 = tgl1.split("/");
		awal = arr1[2]+'-'+arr1[1]+'-'+arr1[0];
		
		tgl2 = document.frmSKPDHotel.tgl2.value
		arr2 = tgl2.split("/");
		akhir = arr2[2]+'-'+arr2[1]+'-'+arr2[0];
		
		var postStr =
			"id=" + document.frmSKPDHotel.id.value +
			"&npwpd=" + document.frmSKPDHotel.npwpd.value +
			"&sptpd=" + arrfull +
			"&jns=" + jnsSPT +
			"&tahun=" + document.frmSKPDHotel.tahun.value +
			"&ket=" + document.frmSKPDHotel.ket_insidentil.value +
			"&nama=" + document.frmSKPDHotel.nama_perusahaan.value +
			"&alamat=" + document.frmSKPDHotel.alamat_perusahaan.value +
			"&cara=" + document.frmSKPDHotel.cara.value +
			"&tgl=" + skrg +
			"&petugas=" + document.frmSKPDHotel.petugas.value +
			"&gol=" + document.frmSKPDHotel.gol.value +
			"&tgl1=" + awal +
			"&tgl2=" + akhir +
			"&jumlah=" + document.frmSKPDHotel.jumlah.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/hotel/simpan', postStr, responePOST);
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
					alert('Done');
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
		document.frmSKPDHotel.nama_perusahaan.value = "";
		document.frmSKPDHotel.alamat_perusahaan.value = "";
		document.frmSKPDHotel.awal.value = "";
		document.frmSKPDHotel.akhir.value = "";
		document.frmSKPDHotel.tahun.value = "";
		document.frmSKPDHotel.tgl.value = "";
		document.frmSKPDHotel.cara.value = "";
		document.frmSKPDHotel.gol.value = "";
		document.frmSKPDHotel.tgl1.value = "";
		document.frmSKPDHotel.tgl2.value = "";
		document.frmSKPDHotel.jumlah.value = "";
		document.frmSKPDHotel.SPTR.value = "";
		document.frmSKPDHotel.SPTI.value = "";
		document.frmSKPDHotel.SPTT.value = "";
		document.frmSKPDHotel.ket_insidentil.value = "";
	}	
		
	function enableButton() {
		document.frmSKPDHotel.edit1.disabled = false;
		document.frmSKPDHotel.tambah.disabled = false;
		document.frmSKPDHotel.delete1.disabled = false;
		document.frmSKPDHotel.cetak.disabled = false;
		document.frmSKPDHotel.cari1.disabled = false;
	}
	
	function disableButton() {
		document.frmSKPDHotel.edit1.disabled = true;
		document.frmSKPDHotel.delete1.disabled = true;
		document.frmSKPDHotel.cetak.disabled = true;
		document.frmSKPDHotel.tambah.disabled = true;
		document.frmSKPDHotel.cari1.disabled = true;
	}
	
	function baru() {
		kosongfrmSKPDHotel1();
		document.frmSKPDHotel.cari1.disabled = false;
		document.frmSKPDHotel.tambah.disabled = false;
		disableData1();
		document.frmSKPDHotel.npwpd.focus();
	}
	
	function ubah() {
		disableData1();
	}
</script>

<div style="height:100%; overflow:auto;">
<!--<h2 style="margin:30px 5px 25px 30px;">SPTPD Restoran</h2>-->

<!--<div id="a_tabbar" style="width:1000px; height:470px; margin-left:30px; overflow:auto;"></div>-->
  <div id="C1" style="background-color: #B3D9F0; height:100%;">
    <form name="frmSKPD" id="frmSKPD" action="<?php echo site_url(); ?>/hotel/cetak" method="post" onSubmit="popupform(this, 'iui')" >
    <br />
   	  <table width="787" border="0">
      		<tr>
        		<td width="198" style="padding-left:15px;">Peningkatan pad dalam setahun</td>
           	  <td width="471"> Percetage : <input type="text" name="no_trx" id="no_trx" size="22" style="background-color:#FFFFCC;" value="<?php echo $strNoUrut;?>" readonly="readonly"/></td>
      		</tr>
            <tr>
              <td style="padding-left:15px;">Peningkatan rata-rata</td>
              <td>WP : <input type="text" name="tgl" id="tgl" size="20" readonly="readonly" value="<?php echo $dtTgl; ?>"/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-left:15px;">Peningkatan WP</td>
                <td>Rata-rata Omset : <input type="text" name="txtjml_meja" id="txtjml_meja" size="15" style="background-color:#FFF;" onkeypress="return checknumeric(event)" maxlength='11'/>&nbsp;Unit                </td>
    		</tr>
            <tr>
              	<td style="padding-left:15px;"> Peningkatan Custumize</td>
                <td>WP : <input type="text" name="txtjml_kursi" id="txtjml_kursi" size="15" style="background-color:#FFF;"  onkeypress="return checknumeric(event)" maxlength='11'/>
                &nbsp;Rata-rata Omset : <input type="text" name="txtjml_kursi" id="txtjml_kursi" size="15" style="background-color:#FFF;"  onkeypress="return checknumeric(event)" maxlength='11'/></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" style="padding-left:15px;">
              	<div id="gridAnalisa" style="background-color:#FFFFFF;"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding-left:15px;">
              	<!--<div id="gridAnalisa" style="background-color:#FFFFFF;"></div>-->
              </td>
            </tr>
            <tr>
                <td style="padding-left:15px;" colspan="2">&nbsp;</td>
            </tr>
	
</table>
</form>
<br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
   	<div id="gridContent" height="400px" style="margin-bottom:10px;"></div>
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
        	<option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onClick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onClick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
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
	//function cetak1() {
//		var gabung = document.frmSKPDHotel.urut.value+'/'+document.frmSKPDHotel.hotel.value;
//		window.open('<?php echo site_url(); ?>/hotel/cetak?sptpd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
//	}
	
	//tabbar = new dhtmlXTabBar("a_tabbar", "top");
//	tabbar.setSkin('dhx_skyblue');
//	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
//	tabbar.addTab("a1", "Input Data", "300px");
//	tabbar.addTab("a2", "Listing Data", "300px");
//	tabbar.setContent("a1", "C1"); 
//	tabbar.setContent("a2", "C2");
//	tabbar.setTabActive("a1");
	
	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');
	
	wBrg = dhxWins.createWindow("wBrg",0,0,800,400);
	wBrg.setText("Pencarian Data Perusahaan");
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
	
//	function batal() {
//		wBrg.hide();
//		wBrg.setModal(false);
//		document.frmSrc2.fil.value = "0";
//		document.frmSrc2.values.value = "";
//		//grids.clearAll();
//	}
	
	//function lihat3() {
//		op = document.frmSrc2.fil.value;
//		if(op==1||op==2||op==3){
//			if(document.frmSrc2.values.value=="") {
//			alert("Value Pencarian Tidak Boleh Kosong");
//			document.frmSrc2.values.focus();
//			return;
//			}
//		}
//		nilai = document.frmSrc2.values.value;
//		gridx.clearAll();
//		gridx.loadXML("<?php echo site_url(); ?>/izin/load_perusahaan/"+op+"/"+nilai,function() {
//			statusEnding();
//		});
//	}
	
	gridx = new dhtmlXGridObject('gridAnalisa');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("koderec, npwpd, Jenis Kamar, Jumlah Kamar, Tarif, Potensi, Asumsi Pajak Perbulan, Asumsi Pajak Pertahun");

	gridx.setInitWidths("50,100,150,100,100,100,150,150");
	gridx.setColAlign("center,left,center,center,right,right,right,right");
	gridx.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro");
	gridx.setColSorting("str,str,str,int,int,int,int,int");
	gridx.setSkin("dhx_skyblue");
	//gridx.setColumnHidden(0,true);
	gridx.init();
	
	function addRowItem(arrIndx) {
		
		var id = gridx.uid();
		var posisi = gridx.getRowsNum();
		// Split Array
		var arr = r[arrIndx].split('|');
		
		var row1= arr[0];
		var row2= arr[1];
		var row3= arr[2];
		var row4= arr[3];
		var row5= arr[4];
		var row6= arr[5];
		var row7= arr[6];
		var row8= arr[7];
		var row9= document.frmData.no_ro.value;
		var row10= arr[8];
		if(arr[0] != "") {
			gridfrmData.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10], posisi);
		}
	}
	
	function checknumeric(evt){
		if(window.event) // IE
		{
			var charCode = evt.keyCode
			if ((charCode >= 48) & (charCode <= 57) || charCode == 8 ){
				return true;
			}else{
				return false;
			}
		}
		else if(evt.which) // Netscape/Firefox/Opera
		{
			var charCode = evt.which
			if ((charCode >= 48) & (charCode <= 57) || charCode == 8 ){
				return true;
			}else{
				return false;
			}
		}						
		
	}
	
	function checkThis(str){
		var num = new Number(str);
		if(/^[0-9]{0,3}(\.[0-9]{0,2})?$/.test(str) && num > 0){
		} else {
		   
		   alert('input is invalid');
		   document.frmSKPD.txtrata2.value = '';
		}
	}
				  
	statusEnding();
</script>
