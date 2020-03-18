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
            if(document.frmSSPD.npwpd.value=="") {
                alert("NPWPD Tidak Boleh Kosong");
                document.frmSSPD.npwpd.focus();
                return;
            }
		
            var postStr =
                "npwpd=" + document.frmSSPD.npwpd.value;
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
                        document.frmSSPD.nama_perusahaan.value = arr[0];
                        document.frmSSPD.alamat_perusahaan.value = arr[1];
                        disableData();
                    } else {
                        alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
                    }
                } else {
                    alert('There was a problem with the request.');
                }
            }
        }
	
       
        
        function statusLoading() {  
            ModalPopups.Indicator("idIndicator",  
            "Please wait",  
            "<div style=''>" +   
                "<div style='float:left;'><img src='<?php echo base_url(); ?>/assets/modal/spinner.gif'></div>" +   
                "<div style='float:left; padding-left:10px;'>" +   
                "Permintaan Anda Sedang Diproses... <br/>" +   
                "Tunggu Beberapa Saat..." +   
                "<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
                "</div>",   
            {  
                okButtonText: "Close", 
                width: 300,  
                height: 100  
            }  
        );                  
        }

        function statusEnding() {
            ModalPopups.Close("idIndicator");
        }

        function pesan() {  
            ModalPopups.Alert("jsAlert1",  
            "Informasi Proses Data",  
            "<div style='padding:25px;'>Data telah berhasil disimpan<br/>" +  
                "ke dalam database...<br/></div>",   
            {  
                okButtonText: "Close"
            }  
        );  
        }  
    </script>
   	<style>
		body {
			background:#FFF;
		}
	</style>
    <body>
    <div style="height:100%; overflow:auto;">
        <div id="content" style="overflow: auto;">
            <h2 style="margin:30px 5px 25px 30px;">SSRD - Surat Setoran Retribusi Daerah</h2>
			<div id="a_tabbar" style="width:900px; height:830px; margin-left:30px"></div>
            <div id="C1" style="background-color: #B3D9F0">
                <form name="frmSSPD" id="frmSSPD" action="<?php echo site_url(); ?>/ssrd/cetak" method="post" onSubmit="popupform(this, 'ssrd')" >
                    <br />
                  <table width="897" border="0" cellspacing="0">
<tr>
                          <td style="padding-left:15px;">No. SSRD</td>
                          <td><input name="sspd_1" type="text" id="sptpd_1" size="15" readonly style="background-color:#FFFFCC;" disabled>
/
  <input name="sptpd_2" disabled type="text" id="sspd_2" size="8" readonly style="background-color:#FFFFCC;"></td>
                          <td>Type Pembayaran</td>
                          <td><select id="pembayaran" name="pembayaran" disabled>
                          <option value=""></option>
                          <option value="1">via Loket</option>
                          <option value="2">via Bank</option>
                         <!--<option value="200">via Bank Nagari</option>
                          <option value="300">via Bank BTN</option>
                          <option value="009">via Bank BNI</option>!--> 
                          </select></td>
                        </tr>
                        <tr>
                            <td width="168" style="padding-left:15px;">Dasar Setoran</td>
                      <td width="319"><?php echo form_dropdown('dasar_setoran', array(NULL => ':: PILIH ::') + config_item('dasar_setoran'), isset($dasar)? $dasar : '', 'tabindex=""  onChange="ty()" disabled')?></td>
                          <td>Tanggal</td>
                                <td><input type="text" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>"  />
                                <input type="hidden" name="sptpd" id="sptpd" disabled />
                                <input type="hidden" name="nota" id="nota" disabled />
                                <input type="hidden" name="sspd" id="sspd" />
                                <input type="hidden" name="tgl" id="tgl" />
                          <input type="hidden" name="edit" id="edit" size="1" /></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">NPWPD</td>
                          <td><input type="hidden" name="id" id="id" size="35" />
                          <input type="text" name="npwpd" id="npwpd" size="32" style="text-transform:uppercase;" disabled/></td>
                          <td>No. <span id="nomor"></span></td>
                          <td><input type="text" name="no_skpd" id="no_skpd" onFocus="cariSKRD()" disabled>
                          <input type="button" name="cari" id="cari" style="padding-left:20px; padding-right:20px;" value="Cari" onClick="cariSKRD()" disabled /></td>
                        </tr>
                        <tr>
                            <td width="168" style="padding-left:15px;">Nama Perusahaan</td>
                  <td width="319"><input type="text" name="nama_perusahaan" id="nama_perusahaan" size="45" disabled/></td>
                          <td width="123">&nbsp;</td>
                          <td width="269">&nbsp;</td>
                    </tr>
                        <tr>
                            <td style="padding-left:15px;">Alamat Perusahaan</td>
                            <td><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" size="45" disabled/></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Nama Pemilik</td>
                            <td><input type="text" name="nama_pemilik" id="nama_pemilik" size="45" disabled/></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>                        
                        <tr>
                          <td style="padding-left:15px;">Alamat Pemilik</td>
                          <td style=""><input type="text" name="alamat_pemilik" id="alamat_pemilik" size="45" disabled/></td>
                          <td style="">&nbsp;</td>
                          <td style="">&nbsp;</td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">Masa Retribusi</td>
                          <td style=""><select name="awal" id="awal" onChange="" disabled>
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
<select name="akhir" id="akhir" onChange="" disabled>
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
</select></td>
                        <td style="">&nbsp;</td>
                        <td style="">&nbsp;</td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">Tahun Retribusi</td>
                          <td style=""><select name="tahun" id="tahun" onChange="cmp()" disabled>
                            <?php echo $tahun; ?>
                          </select> s/d <input type="text" name="tahun2" id="tahun2" size="6" disabled/></td>
                          <td style="">&nbsp;</td>
                          <td style="">&nbsp;</td>
                        </tr>
                        <tr>
                        <td colspan="4">Data Objek Pajak</td>
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
                	<td colspan="4" style="padding-left:15px;">Indeks Gangguan &nbsp; 
                    <select name="op" id="op" disabled="disabled" onchange="getGangguan();">
                         <option value=""></option>
                        <?php
                                foreach($dop->result() as $data){                                    
                                echo '<option value="'.$data->id_izin.'">'.$data->nm_izin.'</option>';
                                }
                            ?>
                    </select>&nbsp;&nbsp;Luas Ruang Tempat Usaha&nbsp;&nbsp;<input type="text" id="qty" name="qty" disabled="disabled" size="10" /> m<sup>2</sup>&nbsp;                    
                    &nbsp;Tarif&nbsp;&nbsp;<input type="text" id="harga" name="harga" disabled="disabled" size="18" /><br />
                     </tr>   
                        <tr>
                            <td colspan="4" style=""><div id="gridData" width="100%" height="150px" style="background-color:white;"></div></td>
                        </tr>
                    </table>
                <table width="875" border="0" cellspacing="0">
                <tr>
                            <td rowspan="4" width="40%" style="padding-left:15px;">Keterangan<br /><textarea name="keterangan" id="keterangan" rows="5" cols="50" disabled></textarea>
                            </td>
                            <td width="10%">&nbsp;</td>
                            <td width="10%">&nbsp;</td>
                            <td width="30%" align="right" style="padding-right:15px;">
                                Jumlah Ketetapan
                                  <input type="text" name="ketetapan" id="ketetapan" size="15"  disabled="disabled" style="text-align: right;background-color:#FFFFCC;" onKeyUp="hitung()" />
                            </td>
                      </tr>
                      <tr>
                          <td style="">&nbsp;</td>
                          <td style="">&nbsp;</td>
                          <td align="right" valign="top" style="padding-right:15px;">Denda                          
                          <input type="text" name="kurang" id="kurang" size="12" disabled="disabled" style="text-align: right;background-color:#FFFFCC;" readonly /> %<input type="hidden" name="nom_denda" id="nom_denda" />
                          <input type="hidden" name="denda" id="denda" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" valign="top" style="padding-right:15px;">Jumlah Setoran
                              <input type="text" name="setoran" id="setoran" size="15" onkeyup="getHitung();" disabled="disabled" style="text-align: right;background-color:#FFFFCC;"/>
                            </td>
                        </tr>
                      <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" valign="top" style="padding-right:15px;">Kurang
                              <input type="text" name="kurangnya" id="kurangnya" size="15" disabled="disabled" style="text-align: right;background-color:#FFFFCC;" />
                            </td>
                        </tr>                       
                        
                        <tr>
                          <td style="">&nbsp;</td>
                          <td style="">&nbsp;</td>
                          <td style="">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="background-color:#FFCC99;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" name="button" id="button" value="BARU" onClick="newEntry();" style="width:90px;">
                                <input type="button" value="SIMPAN" onClick="simpan()" id="tambah" name="tambah" style="width:90px;" disabled>
                                <input type="button" value="EDIT" onClick="edit1()" name="ubah1" id="ubah1" style="width:90px;" disabled>
                                <input type="button" value="HAPUS" onClick="deleteData()" name="delete1" id="delete1" style="width:90px;" disabled>
                                <input type="button" onClick="cetak12()" value="CETAK" name="cetak1" id="cetak1" style="width:90px;" disabled></td>
                        
                        </tr>
                  </table>
              </form>
              <br/>
            <div id="C2" style="background-color: #B3D9F0">
				<div id="mygridSSPD" width="896px" height="560px" style="background-color:white;"></div>
                <div id="pagingArea" width="350px" style="background-color: white;"></div>
            </div>
            </div>            
        </div>
        
         <div id="objSSPD" style="display:none;background-color: #e3effd;">
  <form name="frmSrc4" id="frmSrc4" method="post" action="javascript:void(0);">
  <table width="700" border="0">
  <tr>
  	<td width="100" style="padding-left:15px;">Parameter</td>
    <td width="250"><select name="parameter" id="parameter">
      <option value="4">No. SKRD</option>
      <option value="1">NPWPD Perusahaan</option>
      <option value="2">Nama Pemilik</option>
      <option value="3">Nama Perusahaan</option>      
    </select>
    </td>
	    <td width="200" rowspan="2" align="right" >
    <input type="button" name="button2" id="button2" value="CARI" style="height:50px; width:100px;" onClick="cariDataWP()">
      <input type="button" name="button3" id="button3" value="TUTUP" style="height:50px; width:100px;" onClick="closeBrg()"></td>

  </tr>
  <tr>
    <td style="padding-left:15px;">Kata Kunci</td>
    <td><input type="text" name="keyword" id="keyword"></td>
	<!--<td width="">&nbsp;</td>-->
  </tr>
  <tr>
    <td colspan="3" style="padding-left:15px;"><div id="tmpGridWP" width="100%" height="320px" style="background-color:white;"></div></td>
    </tr>
</table>
  </form>
</div>
</div>
    </body>
    
   
    <script language="javascript">
	function ty(){
		var s = document.frmSSPD.dasar_setoran.value;
		if(s==1){
			document.getElementById('nomor').innerHTML='SKRD';
		} else if(s==2){
			document.getElementById('nomor').innerHTML='SPTRD';
		} else if(s==3){
			document.getElementById('nomor').innerHTML='STRD';
		} else if(s==4){
			document.getElementById('nomor').innerHTML='SKRDKBT';
		} else if(s==5){
			document.getElementById('nomor').innerHTML='SKRDKB';
		}
	}
	
	function cetak12() {
		var gabung = document.frmSSPD.sspd_1.value+'/'+document.frmSSPD.sspd_2.value;
		window.open('<?php echo site_url(); ?>/ssrd/cetak?ssrd='+gabung, '', 'height=700,width=1000,scrollbars=yes');
	}
		tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
        cal1 = new dhtmlxCalendarObject(['tanggal']);
        cal1.setDateFormat('%d/%m/%Y');                        		        
        
        function newEntry(){
            aktif();
            bersih();
        }
		
		function deleteData(){
			confrm = confirm("Apakah Anda Yakin");
			if(confrm) {
				var poStr = 
					"ssrd=" + document.frmSSPD.sspd.value + 
                    "&dasar_setoran=" + document.frmSSPD.dasar_setoran.value +
                    "&no_skrd=" + document.frmSSPD.no_skpd.value;
                    
				statusLoading();
				dhtmlxAjax.post(base_url+'index.php/ssrd/delete', poStr, respeDel);
			}
		}
		
		function respeDel(loader) {
			if (loader.xmlDoc.readyState == 4) {
				if (loader.xmlDoc.status == 200) {
					result = loader.xmlDoc.responseText;
					if(result){
						bersih();
						statusEnding();
						alert(result);
						return true;
					}
				} else {
					 alert('There was a problem with the request.');
				}
			}
		}
        
		function hitung(){
			var ketetapan = document.frmSSPD.ketetapan.value;
			var setoran = document.frmSSPD.setoran.value;
            
            
            //var kurang =ketetapan - setoran;
			if(setoran <= ketetapan && ketetapan >= setoran){
				var kurang = setoran-ketetapan;
			} else if(setoran >= ketetapan && ketetapan <= setoran){
				var kurang = ketetapan-setoran;
			}
			document.frmSSPD.kurang.value = kurang;
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
        
        function bersih(){
            document.frmSSPD.sspd_1.value = "";
            document.frmSSPD.sspd_2.value = "";
            document.frmSSPD.dasar_setoran.value = "";
            document.frmSSPD.npwpd.value = "";
            document.frmSSPD.nama_perusahaan.value = "";
            document.frmSSPD.alamat_perusahaan.value = "";
            document.frmSSPD.nama_pemilik.value = "";
            document.frmSSPD.alamat_pemilik.value = "";
            document.frmSSPD.awal.value = "";
            document.frmSSPD.akhir.value = "";
            document.frmSSPD.tahun.value = "";
			document.frmSSPD.tgl.value = "";
            
			document.frmSSPD.no_skpd.value = "";
			document.frmSSPD.nota.value = "";
			document.frmSSPD.pembayaran.value = "";
            document.frmSSPD.keterangan.value = "";
			document.frmSSPD.ketetapan.value = "";
			document.frmSSPD.setoran.value = "";
			document.frmSSPD.kurang.value = "";
            document.frmSSPD.tahun2.value = "";            
            document.frmSSPD.lokasi.value = "";
            document.frmSSPD.txt_keperluan.value = "";
            document.frmSSPD.op.value = "";
            document.frmSSPD.qty.value = "";
            document.frmSSPD.harga.value = "";
			//document.frmSSPD.denda.value = "";
			//document.frmSSPD.nom_denda.value = "";
			document.frmSSPD.sspd.value = "";
			document.frmSSPD.sptpd.value = "";
			document.frmSSPD.edit.value = "";
            document.frmSSPD.kurangnya.value = "";
			gridData.clearAll();
        }
        
        function aktif(){
            document.frmSSPD.dasar_setoran.disabled = false;
            document.frmSSPD.no_skpd.disabled = false;
			document.frmSSPD.pembayaran.disabled = false;
            document.frmSSPD.keterangan.disabled = false;
            document.frmSSPD.setoran.disabled = false;
			
			document.frmSSPD.cari.disabled = false;
			document.frmSSPD.ubah1.disabled = true;
			document.frmSSPD.delete1.disabled = true;
			document.frmSSPD.cetak1.disabled= true;
        }
        
        function disable(){
            document.frmSSPD.sspd_1.disabled = true;
            document.frmSSPD.sspd_2.disabled = true;
            document.frmSSPD.dasar_setoran.disabled = true;
            document.frmSSPD.npwpd.disabled = true;
            document.frmSSPD.nama_perusahaan.disabled = true;
            document.frmSSPD.alamat_perusahaan.disabled = true;
            document.frmSSPD.nama_pemilik.disabled = true;
            document.frmSSPD.alamat_pemilik.disabled = true;
            document.frmSSPD.awal.disabled = true;
            document.frmSSPD.akhir.disabled = true;
            document.frmSSPD.tahun.disabled = true;
            
			document.frmSSPD.tanggal.disabled = true;
			document.frmSSPD.no_skpd.disabled = true;
			document.frmSSPD.pembayaran.checked = true;
            document.frmSSPD.keterangan.disabled = true;
			document.frmSSPD.ketetapan.disabled = true;
			document.frmSSPD.setoran.disabled = true;
			document.frmSSPD.kurang.disabled = true;
        }
		
		function edit1(){
			aktif();
		}
        
        function simpan(){
		if(document.frmSSPD.dasar_setoran.value=="") {
			document.frmSSPD.dasar_setoran.focus();
			alert("Dasar Setoran Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSSPD.pembayaran.value=="") {
			document.frmSSPD.pembayaran.focus();
			alert("Type Pembayaran Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSSPD.no_skpd.value=="") {
			document.frmSSPD.no_skpd.focus();
			alert("Nomor Tidak Boleh Kosong");
			return;
		}
		
		if(document.frmSSPD.setoran.value=="") {
			document.frmSSPD.setoran.focus();
			alert("Setoran Tidak Boleh Kosong");
			return;
		}
		
		tgl = document.frmSSPD.tanggal.value;
		arr = tgl.split("/");
		tanggal = arr[2]+'-'+arr[1]+'-'+arr[0];
            
			statusLoading();  
		
			initDP();
			sendNota();
			sendSkpd();
            var poststr =
                'ssrd_1=' + document.frmSSPD.sspd_1.value +
                '&ssrd_2=' + document.frmSSPD.sspd_2.value +
                '&dasar_setoran=' + document.frmSSPD.dasar_setoran.value +
                '&npwpd=' + document.frmSSPD.npwpd.value +
                '&nama_perusahaan=' + document.frmSSPD.nama_perusahaan.value +
                '&alamat_perusahaan=' + document.frmSSPD.alamat_perusahaan.value +
                '&nama_pemilik=' + document.frmSSPD.nama_pemilik.value +
                '&alamat_pemilik=' + document.frmSSPD.alamat_pemilik.value +
                '&awal=' + document.frmSSPD.awal.value +
                '&akhir=' + document.frmSSPD.akhir.value +
                '&tahun=' + document.frmSSPD.tahun.value +    
                '&tahun2=' + document.frmSSPD.tahun2.value +                                                   
                '&tanggal=' + tanggal +
                '&no_skrd=' + document.frmSSPD.no_skpd.value +
				'&nota=' + document.frmSSPD.nota.value +
                '&pembayaran=' + document.frmSSPD.pembayaran.value +
                '&keterangan=' + document.frmSSPD.keterangan.value +
                '&ketetapan=' + document.frmSSPD.ketetapan.value +
                '&setoran=' + document.frmSSPD.setoran.value +
				'&edit=' + document.frmSSPD.edit.value +                
                '&lokasi=' + document.frmSSPD.lokasi.value +
                '&kawasan=' + document.frmSSPD.txt_keperluan.value +
				'&gangguan=' + document.frmSSPD.op.value +
                '&volume=' + document.frmSSPD.qty.value +				                
				'&denda=' + document.frmSSPD.nom_denda.value +
                '&kurang=' + document.frmSSPD.kurangnya.value ;                        
            dhtmlxAjax.post(base_url+"index.php/ssrd/simpan", encodeURI(poststr), outputResponse);
        }
        
        function outputResponse(loader) {        
            result = loader.xmlDoc.responseText;
            if(result) {                 
                arr = result.split("/");
                document.frmSSPD.sspd_1.value = arr[0];
                document.frmSSPD.sspd_2.value = arr[1]+"/"+arr[2];
				tmpRows();	
                statusEnding();
                pesan();
				loadData();
				document.frmSSPD.ubah1.disabled = false;
				document.frmSSPD.delete1.disabled = false;
				document.frmSSPD.cetak1.disabled = false;
				//smsgateway();           
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }
        
	function smsgateway(){
		var bon = document.frmSSPD.no_skpd.value.split('/');
		var cek = bon[1];
		
		if(cek=='HTL'){
			jp = 'Pajak Hotel';
		} else if(cek=='RES'){
			jp = 'Pajak Restoran';
		} else if(cek=='REK'){
			jp = 'Pajak Reklame';
		} else if(cek=='HIB'){
			jp = 'Pajak Hiburan';
		} else if(cek=='LIS'){
			jp = 'Pajak Penerangan Jalan';
		} else if(cek=='GAL'){
			//alert('ok');
			jp = 'Pajak Mineral Bukan Logam dan Batuan';
		} else if(cek=='PKR'){
			jp = 'Pajak Parkir';
		} else if(cek=='AIR'){
			//alert('ok');
			jp = 'Pajak Air Bawah Tanah';
		} else if(cek=='WLT'){
			jp = 'Pajak Burung Walet';
		} else if(cek=='RET'){
			jp = 'Retribusi';
		}
			
		
		var postStr =
			"npwpd=" + document.frmSSPD.npwpd.value +
			"&jp=" + jp +
			"&awal=" + document.frmSSPD.awal.value +
			"&akhir=" + document.frmSSPD.akhir.value +
			"&tahun=" + document.frmSSPD.tahun.value +
			"&setor=" + document.frmSSPD.setoran.value;
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/ssrd/smsgateway', postStr, function(loader) {
			result = loader.xmlDoc.responseText;
			//alert(result);
			statusEnding();
		});
	}

    // Terpakai
	var r = new Array();
	function tmpRows() {
		var arr = gridData.getAllItemIds().split(',');
		for(i=0;i < arr.length;i++) {
				id = arr[i];
				r[i] = gridData.cells(id,0).getValue()+'|'+
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
			addRowIR(i);
		}
		r = new Array();
		dpps.sendData();
	}
	
	function addRowIR(arrIndx) {
		
		var id = gridData.uid();
		var posisi = gridData.getRowsNum();
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
		var row9= arr[8];
		var row10= document.frmSSPD.sspd_1.value+'/'+document.frmSSPD.sspd_2.value;
		if(arr[0] != "") {
			gridData.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10], posisi);
		}
	}    

	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridData.setHeader("Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Ketetapan,no_ssrd",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);
	gridData.setInitWidths("100,400,100,100,100,100,100,100,100,100");
	gridData.setColAlign("center,left,right,right,right,right,right,right,right,left");
	gridData.setColTypes("ro,ro,ron,ron,ron,ron,ron,ron,ron,ro");
	gridData.enableMultiselect(true); 
	gridData.setNumberFormat("0,000",3,".",",");
    gridData.setColumnHidden(2,true);
	gridData.setColumnHidden(4,true);
	gridData.setColumnHidden(5,true);
	gridData.setColumnHidden(6,true);
	gridData.setColumnHidden(7,true);
	gridData.setNumberFormat("0,000",8,".",",");
	gridData.setColumnHidden(9,true);
	gridData.init();
	gridData.setSkin("dhx_skyblue");
	
    var dpps = "";
	function initDP() {
		//dpps = new dataProcessor(base_url+"index.php/ssrd/item_ssrd");
        dpps = new dataProcessor("<?php echo site_url(); ?>/ssrd/item_ssrd");
		//dpps = new dataProcessor(base_url+"index.php/sspd/item_nota");
		//dpps = new dataProcessor(base_url+"index.php/sspd/item_skpd");
		dpps.setUpdateMode("off");
		dpps.init(gridData);	
		dpps.attachEvent("onAfterUpdateFinish", function() {	
			statusEnding();
			//alert("Data berhasil disimpan");
			loadData();
   			return true;
		});
	}
	
	var dpps1 = "";
	function sendNota() {
		dpps1 = new dataProcessor(base_url+"index.php/ssrd/item_nota");
		dpps1.setUpdateMode("off");
		dpps1.init(gridData);	
		dpps1.attachEvent("onAfterUpdateFinish", function() {	
			//statusEnding();
			//alert("Data berhasil disimpan");
			//loadData();
   			return true;
		});
	}

	var dpps2 = "";
	function sendSkpd() {
		dpps2 = new dataProcessor(base_url+"index.php/ssrd/item_skrd");
		dpps2.setUpdateMode("off");
		dpps2.init(gridData);	
		dpps2.attachEvent("onAfterUpdateFinish", function() {	
			//statusEnding();
			//alert("Data berhasil disimpan");
			//loadData();
   			return true;
		});
	}    
//  statusEnding();

	dhxWins= new dhtmlXWindows();
	dhxWins.setImagePath("<?php echo base_url(); ?>/assets/codebase_windows/imgs/");
	wSSPD = dhxWins.createWindow("wSSPD",0,0,770,450);
	wSSPD.setText("Daftar SKPD");
	wSSPD.button("park").hide();
	wSSPD.button("close").hide();
	wSSPD.button("minmax1").hide();
	wSSPD.hide();

	function closeBrg() {
		wSSPD.hide();
		wSSPD.setModal(false);
	}
        
	// grid data skpd
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("No.,NPWPD,Nama Perusahaan,Alamat Perusahaan,Nama Pemilik,Alamat Pemilik,Bulan 1,Bulan 2,Tahun,Tahun2,Jumlah,SPTPD,No Nota,Tanggal,lokasi_pasar,indeks_kawasan,indeks_gangguan,volume");
	gridWP.setInitWidths("120,120,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridWP.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmSSPD.no_skpd.value = gridWP.cells(id,0).getValue();
		document.frmSSPD.npwpd.value = gridWP.cells(id,1).getValue();
		document.frmSSPD.awal.value = gridWP.cells(id,6).getValue();
		document.frmSSPD.akhir.value = gridWP.cells(id,7).getValue();
		document.frmSSPD.tahun.value = gridWP.cells(id,8).getValue();
        document.frmSSPD.tahun2.value = gridWP.cells(id,9).getValue();
		document.frmSSPD.ketetapan.value = format_number(gridWP.cells(id,10).getValue());
        //document.frmSSPD.ketetapan.value = gridWP.cells(id,5).getValue();
		document.frmSSPD.nama_pemilik.value = gridWP.cells(id,4).getValue();
		document.frmSSPD.alamat_pemilik.value = gridWP.cells(id,5).getValue();
		document.frmSSPD.nama_perusahaan.value = gridWP.cells(id,2).getValue();
		document.frmSSPD.alamat_perusahaan.value = gridWP.cells(id,3).getValue();
		document.frmSSPD.sptpd.value = gridWP.cells(id,11).getValue();
		document.frmSSPD.nota.value = gridWP.cells(id,12).getValue();
		document.frmSSPD.tgl.value = gridWP.cells(id,13).getValue();
        document.frmSSPD.lokasi.value = gridWP.cells(id,14).getValue();
        document.frmSSPD.txt_keperluan.value = gridWP.cells(id,15).getValue();
        document.frmSSPD.op.value = gridWP.cells(id,16).getValue();
        document.frmSSPD.qty.value = gridWP.cells(id,17).getValue();
        document.frmSSPD.harga.value = gridWP.cells(id,10).getValue();
        openGRIDsspd();                        
        document.frmSSPD.tambah.disabled= false;        
		var utang = gridWP.cells(id,5).getValue();
		var denda = 2;
		var bln = document.frmSSPD.tgl.value.split('/');
		var bln1 = gridWP.cells(id,3).getValue();
		var thn1 = gridWP.cells(id,4).getValue();
		
		var den = document.frmSSPD.tanggal.value.split('/');
		var bln2 = den[1];
		var thn2 = den[2];
        
        document.frmSSPD.setoran.value = 0;
		//document.frmSSPD.setoran.focus();

        if(thn1==thn2){
  			tbln = bln2-bln1;
  	//		alert(bln2);
  	//		alert(bln1);
  	//		alert(tbln);
  			if(tbln<=1){				
  				document.frmSSPD.kurang.value = '0';
  				document.frmSSPD.nom_denda.value = '0';
  				document.frmSSPD.setoran.value = format_number(utang);
  			
  			} else if(tbln>1){
  		//		alert(tbln);
  				tbln = tbln - 1;
  				document.frmSSPD.kurang.value = denda*tbln;
  				var den = (utang*document.frmSSPD.kurang.value)/100;
  				document.frmSSPD.nom_denda.value = format_number(den);
  				document.frmSSPD.setoran.value = format_number(parseInt(utang)+parseInt(den));
  			}
  		} else if(thn1<thn2){
  			tthn = thn2-thn1;
  			//alert(tthn);
  			if(tthn==1){
  				awal_thn = 12-bln1;
  				akhir_thn = bln2-0;
  				t_thn = parseInt(awal_thn)+parseInt(akhir_thn);
  				alert(bln1);
 				alert(bln2);
  				alert(awal_thn);
  				alert(akhir_thn);
  				alert(t_thn);
  				t_thn = t_thn - 1;
  				document.frmSSPD.kurang.value = denda*t_thn;
  				var den = (utang*document.frmSSPD.kurang.value)/100;
  				alert(document.frmSSPD.kurang.value);
  				
  				document.frmSSPD.nom_denda.value = format_number(den);
  				document.frmSSPD.setoran.value = format_number(parseInt(utang)+parseInt(den));
  			
  			} else if(tthn>1){
  				awal_thn = 12-bln1;
  				akhir_thn = bln2-0;
  				t_thn = parseInt(awal_thn)+parseInt(akhir_thn);
  				t_hit = parseInt(t_thn)+12;
  				t_hit = t_hit - 1;
  				
  				if(t_hit>24){
  					t_hit = 24;
  				}
  				document.frmSSPD.kurang.value = denda*t_hit;
  				var den = (utang*document.frmSSPD.kurang.value)/100;
  				document.frmSSPD.nom_denda.value = format_number(den);
  				document.frmSSPD.setoran.value = format_number(parseInt(utang)+parseInt(den));
  			}
  		}

		getDataItem();
		closeBrg();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
    
    
    function openGRIDsspd(){
		var no = document.frmSSPD.no_skpd.value;		
		gridData.clearAll();
		gridData.loadXML(base_url+"index.php/ssrd/load_GRIDssrd/"+no);
	}
    
	function getHitung(){
			if(document.frmSSPD.ketetapan.value!="" && document.frmSSPD.setoran.value!=""){
			poststr = 'ketetapan=' + document.frmSSPD.ketetapan.value +
			'&setoran=' + document.frmSSPD.setoran.value  ;			           
			dhtmlxAjax.post(base_url+"/index.php/ssrd/getHitung", encodeURI(poststr), outputhitung);
			}
		}
        
          function outputhitung(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {                                 
                document.frmSSPD.kurangnya.value = format_number(result);
                      
            }           
            else
            {
                alert("Ada kesalahan pada program");
            }
        }

    
	function getDataItem(){
		var sp = document.frmSSPD.no_skpd.value.split('/');
		var no = sp[0]+'-'+sp[1]+'-'+sp[2];
		var gabung = document.frmSSPD.dasar_setoran.value+"-"+no;
		gridData.clearAll();
		gridData.loadXML(base_url+"index.php/ssrd/load_rekening/"+gabung,function() {
			//loadtotal();
			statusEnding();
		});
	}
	
	function cariSKRD() {
		wSSPD.show();
    	wSSPD.setModal(true);
		wSSPD.center();
		wSSPD.attachObject('objSSPD');
		gridWP.clearAll();
	}
	
	function cariDataWP() {
		if(document.frmSSPD.dasar_setoran.value=="") {
			alert("Dasar Setoran Tidak Boleh Kosong");
			closeBrg();
			document.frmSSPD.dasar_setoran.focus();
			return;
		}
		
		if(document.frmSrc4.keyword.value=="") {
			alert("Kata Kunci Tidak Boleh Kosong");
			document.frmSrc4.keyword.focus();
			return;
		}
			
		statusLoading();
		var keyword = document.frmSrc4.keyword.value;
		var parameter = document.frmSrc4.parameter.value;
		var dasar = document.frmSSPD.dasar_setoran.value;
		//alert(dasar);
//		alert(jenis+"|"+keyword+"|"+parameter);
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/ssrd/cariData/"+dasar+"/"+parameter+"/"+keyword,function(id) {  								
		statusEnding();
		if(gridWP.getRowsNum()==""){
			alert("Data yang anda cari tidak ditemukan");
		}
		
});
//		+kata_kunci+"/"+document.frmSrc4.parameter.value
	}
	
		
	gridDatas = new dhtmlXGridObject('mygridSSPD');
	gridDatas.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridDatas.setHeader("id,no_ssrd,dasar_setoran,pembayaran,tanggal,no_skpd,npwpd,nama_perusahaan,alamat_perusahaan,nama_pemilik,alamat_pemilik,masa_pajak1,masa_pajak2,tahun_pajak,keterangan,ketetapan,setoran,persen,created,modified,user_created,user_modified,nota_hitung,denda,kurang");
	gridDatas.setInitWidths("50,150,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridDatas.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	gridDatas.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");//24
	gridDatas.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ron,ron,ro,ro,ro,ro,ro,ro,ro");
	gridDatas.enableMultiselect(true);
	gridDatas.setColumnHidden(0,true);
	gridDatas.setColumnHidden(18,true);
	gridDatas.setColumnHidden(19,true);
	gridDatas.setColumnHidden(20,true);
	gridDatas.setColumnHidden(21,true);
	gridDatas.setColumnHidden(22,true);
	gridDatas.setNumberFormat("0,000",15,",",".");
	gridDatas.setNumberFormat("0,000",16,",",".");
	gridDatas.setNumberFormat("0,000",17,",","."); 
	gridDatas.attachEvent("onRowSelect", selectData);
	gridDatas.init();
	gridDatas.enablePaging(true,15,10,"pagingArea",true);
	gridDatas.setPagingSkin("bricks");
	gridDatas.setSkin("dhx_skyblue");
	loadData();
	
	function loadData(){
	gridDatas.clearAll();	
	gridDatas.loadXML(base_url+"index.php/ssrd/load_data",function() { 
           // statusEnding(); 
        });
		
	}
	
		function selectData(id){
			tabbar.setTabActive("a1");
			arr = gridDatas.cells(id,1).getValue().split("/");
			document.frmSSPD.sspd_1.value = arr[0];
			document.frmSSPD.sspd_2.value = arr[1]+"/"+arr[2];
					
            document.frmSSPD.dasar_setoran.value = gridDatas.cells(id,2).getValue();
            document.frmSSPD.npwpd.value = gridDatas.cells(id,6).getValue();
            document.frmSSPD.nama_perusahaan.value = gridDatas.cells(id,7).getValue();
            document.frmSSPD.alamat_perusahaan.value = gridDatas.cells(id,8).getValue();
            document.frmSSPD.nama_pemilik.value = gridDatas.cells(id,9).getValue();
            document.frmSSPD.alamat_pemilik.value = gridDatas.cells(id,10).getValue();
            document.frmSSPD.awal.value = gridDatas.cells(id,11).getValue();
            document.frmSSPD.akhir.value = gridDatas.cells(id,12).getValue();
            document.frmSSPD.tahun.value = gridDatas.cells(id,13).getValue();
            
			document.frmSSPD.tanggal.value = gridDatas.cells(id,4).getValue();
			document.frmSSPD.no_skpd.value = gridDatas.cells(id,5).getValue();
			
			document.frmSSPD.pembayaran.value = gridDatas.cells(id,3).getValue();
			
            document.frmSSPD.keterangan.value = gridDatas.cells(id,14).getValue();
			document.frmSSPD.ketetapan.value = format_number(gridDatas.cells(id,15).getValue());
			document.frmSSPD.setoran.value = format_number(gridDatas.cells(id,16).getValue());
			document.frmSSPD.kurang.value = format_number(gridDatas.cells(id,17).getValue());
			document.frmSSPD.sspd.value = gridDatas.cells(id,1).getValue();
			document.frmSSPD.edit.value = "1";
			document.frmSSPD.nota.value = gridDatas.cells(id,22).getValue();
			document.frmSSPD.nom_denda.value = gridDatas.cells(id,23).getValue();
            document.frmSSPD.kurangnya.value = gridDatas.cells(id,24).getValue();
			openChildsspd();
			disable();
			document.frmSSPD.ubah1.disabled = false;
			document.frmSSPD.delete1.disabled = false;
			document.frmSSPD.cetak1.disabled = false;
	}
	
	function openChildsspd(){
		var no = document.frmSSPD.sspd.value.split('/');
		var data = no[0]+'-'+no[1]+'-'+no[2];
		gridData.clearAll();
		gridData.loadXML(base_url+"index.php/ssrd/load_childssrd/"+data);
	}
	
function setRadio(radio, value){
   for(i=0; i<radio.length; i++){
      if(radio[i].value == value){
         radio[i].checked = true;
      } else {
         radio[i].checked = false;
      }
   }
 
}
	
    </script>