<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>/assets/dhtmlx.css" />
   
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/dhtmlx.js"></script>


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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.css" /> 
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.js"></script>

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
            if(document.frmData.npwpd.value=="") {
                alert("NPWPD Tidak Boleh Kosong");
                document.frmData.npwpd.focus();
                return;
            }
		
            var postStr =
                "npwpd=" + document.frmData.npwpd.value;
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
                        document.frmData.nama_perusahaan.value = arr[0];
                        document.frmData.alamat_perusahaan.value = arr[1];
                        disableData();
                    } else {
                        alert('Maaf No Pendaftaran tersebut tidak terdaftar');	
                    }
                } else {
                    alert('There was a problem with the request.');
                }
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
            "<div style='padding:25px;'>Data telah berhasil disimpan</div>",   
            {  
                okButtonText: "Close"
            }  
        );  
        }  
    </script>
    <style>
		body {
			background:#f8f8f8;
		}
	</style>

    <div style="height:100%; overflow:auto;">

        <div id="content" style="overflow: auto;">
            <h2 style="margin:30px 5px 25px 30px;">Dasar Perhitungan SITU</h2>

            <div id="a_tabbar" style="width:1250px; height:880px; margin-left:30px;"></div>
  				<div id="C1" style="background-color: #B3D9F0">
                <form name="frmData" id="frmData" action="" method="post" onSubmit="" >
                    <table width="1000px" border="0">
                        <tr>
                            <td width="441" style="padding-left:15px;">No. SPTPD</td>
                            <td width="331"><input name="sptpd_1" type="text" id="sptpd_1" size="15" readonly style="background-color:#FFFFCC;" > 
                                / 
                          <input name="sptpd_2" type="text" id="sptpd_2" size="10" readonly style="background-color:#FFFFCC;" ></td>
                          <td width="100">&nbsp;</td>
                          <td width="300">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Masa Pajak</td>
                            <td><?php echo $ctl_masapajak1; ?> s.d <?php echo $ctl_masapajak2; ?></td> 
                            <td width="100">&nbsp;</td>
                            <td width="300">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Masa Tanggal Pajak</td>
                            <td><input type="text" name="tgl_ms_pajak1" id="tgl_ms_pajak1" size="12" onchange="getSelama();" />
                            &nbsp; <i>s.d</i> 
                            <input type="text" name="tgl_ms_pajak2" id="tgl_ms_pajak2" size="12" onchange="getSelama();"/></td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Tahun Pajak</td>
                            <td><?php echo $ctl_tahunpajak; ?></td>
                            
                            <td width="100">&nbsp;</td>
                            <td width="300">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="441" style="padding-left:15px;">NPWPD</td>
                            <td width="331"><input type="hidden" name="id" id="id" size="35" disabled />
                                <input type="text" name="npwpd" id="npwpd" size="32" style="background-color:#FFCC99; text-transform:uppercase;" />
                                <input name="btnCari" id="btnCari" type="button" onClick="searchNPWPD()" value="Cari" style="padding-left:20px; padding-right:20px" disabled/>                            </td>
                            <td width="100">&nbsp;</td>
                            <td width="300">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Nama Usaha</td>
                            <td><input type="text" name="nama_perusahaan" id="nama_perusahaan" style="background-color:#FFFFCC;" size="45" disabled/></td>
                            <td>Petugas</td>
                            <td><input type="text" name="petugas" id="petugas" size="" value="<?php echo $username?>" readonly disabled/></td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px;">Alamat Usaha</td>
                            <td><input type="text" name="alamat_perusahaan" id="alamat_perusahaan" style="background-color:#FFFFCC;" size="45" disabled/></td>
                            <td>Diterima Tanggal</td>
                            <td><input name="tgl_terima" type="text" disabled id="tgl_terima" value="<?php echo $tgl; ?>" size=""/></td>
                        </tr>                        
                        <tr>
                            <td style="padding-left:15px;">Tata Cara Perhitungan</td>
                        	<td colspan="3">
                                <select name="cara" id="cara" disabled="disabled">
                                    <option value="1">Official Assesment(Dihitung dan ditetapkan oleh Pejabat Dispenda)</option>
                                    <!--<option value="2">Self Assesment(Menghitung dan Menetapkan Pajak Sendiri)</option>-->
                                </select>                            </td>
                        </tr>
                        <tr>
                          <td colspan="4" style="padding-left:15px;"><hr /></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">Tgl. Permohonan</td>
                          <td><input name="tgl_permohonan" type="text" disabled="disabled" id="tgl_permohonan" value="<?php echo $tgl; ?>" size=""/></td>
                          <td>Tgl. Diperiksa</td>
                          <td><input name="tgl_diperiksa" type="text" disabled="disabled" id="tgl_diperiksa" value="<?php echo $tgl; ?>" size=""/></td>
                        </tr>
						<tr>
                            <td style="padding-left:15px;">Sifat Pemasangan</td>
                            <td>
                                <select id="sifatp" name="sifatp" style="width:300px;" disabled="disabled" onchange="getSifat();">
                                	<option value=""></option>
                                    <option value="SITU">Paket SITU</option>									
                                   <!-- <option value="Insidentil">Bersifat Insidentil</option>-->                                
                                </select></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
						<tr>
                            <td style="padding-left:15px;">Paket SITU</td>
                            <td>
                                <select id="gjenisrek" name="gjenisrek" style="width:300px;" disabled="disabled" onchange="getTipe();">
                                	<option value=""></option>
                                    <option value="1">Reklame Papan Merek</option>									
									<option value="2">Pelayanan Persampahan / Kebersihan</option>									
                                    <option value="3">Denda Pajak Reklame</option>									
									<option value="4">Denda Ret. Jasa Umum</option>								                                    
                                </select></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
						<!--<tr>
                            <td style="padding-left:15px;">Jenis Reklame Insidentil</td>
                            <td>
                                <select id="gjenisrek2" name="gjenisrek2" style="width:300px;" disabled="disabled" onchange="getTipe();">
                                	<option value=""></option>
                                    <option value="7">Kain, Cover Baliho, Spanduk, Umbul-umbul, Tenda, Baner</option>									
                                    <option value="8">Reklame Gantung, Sticker, Poster</option>                                    
									<option value="9">Reklame Selebaran</option>                                    
									<option value="10">Reklame Udara</option>                                    
                                </select></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>-->
						<tr>
                            <td style="padding-left:15px;"></td>
                            <td><input type="hidden" name="kode_rek1" id="kode_rek1" /><input type="hidden" name="nama_rek1" id="nama_rek1" /></td>															
                            <td><input type="hidden" name="buatidx" id="buatidx" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td style="padding-left:15px;">Jenis Reklame</td>
                            <td>
                                <select id="jenis" name="jenis" style="width:300px;" disabled="disabled" onchange="getType();">
                                	<option value=""></option>
                                    <?php 
									foreach($dReklame->result() as $rs) {
											echo "<option value=".$rs->kd_rek.">".$rs->nm_rek."</option>";
										}
									?>
                                </select>                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>-->
                        <tr>
                          <td style="padding-left:15px;">Tema Reklame</td>
                          <td colspan="2"><input type="text" name="teks_reklame" id="teks_reklame" size="80" disabled="disabled"/></td>                          
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">Waktu Pasang</td>
                          <td><select id="waktu_pasang" name="waktu_pasang" disabled="disabled" onchange="getSelama();">
                            <option value="hari">Harian</option>
                            <option value="bulan">Bulanan</option>
                            <option value="tahun">Tahunan</option>
                                                                                </select>
                          Selama
                          <input name="selama" type="text" id="selama" size="3" style="text-align:center;" disabled="disabled"/></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>                        
                        <!--<tr>
                          <td style="padding-left:15px;">Posisi Pasang </td>
                          <td><select id="posisi" name="posisi" disabled="disabled">
                              <option value=""></option>
                              <option value="1">Diatas Gedung</option>
                              <option value="1">Diatas Tanah</option>
                              <option value="1">Diatas Air</option>
                            </select>                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>-->
                        <tr>
                          <td style="padding-left:15px;">Lokasi pasang</td>
                          <td colspan="3"><input type="text" name="lokasi_pasang1" id="lokasi_pasang1" size="80" disabled="disabled"/></td>
                          <!--<td colspan="2"><input type="text" name="lokasi_pasang6" id="lokasi_pasang6" size="50" disabled="disabled"/></td>-->
                        </tr>
                        <!--<tr>
                          <td style="padding-left:15px;">&nbsp;</td>
                          <td><input type="text" name="lokasi_pasang2" id="lokasi_pasang2" size="50" disabled="disabled"/></td>
                          <td colspan="2"><input type="text" name="lokasi_pasang7" id="lokasi_pasang7" size="50" disabled="disabled"/></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">&nbsp;</td>
                          <td><input type="text" name="lokasi_pasang3" id="lokasi_pasang3" size="50" disabled="disabled"/></td>
                          <td colspan="2"><input type="text" name="lokasi_pasang8" id="lokasi_pasang8" size="50" disabled="disabled"/></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">&nbsp;</td>
                          <td><input type="text" name="lokasi_pasang4" id="lokasi_pasang4" size="50" disabled="disabled"/></td>
                          <td colspan="2"><input type="text" name="lokasi_pasang9" id="lokasi_pasang9" size="50" disabled="disabled"/></td>
                        </tr>
                        <tr>
                          <td style="padding-left:15px;">&nbsp;</td>
                          <td><input type="text" name="lokasi_pasang5" id="lokasi_pasang5" size="50" disabled="disabled"/></td>
                          <td colspan="2"><input type="text" name="lokasi_pasang10" id="lokasi_pasang10" size="50" disabled="disabled"/></td>
                        </tr>-->
                       <!-- <tr>
                        <td style="padding-left:15px;">Masa Pajak</td>
                          <td><input type="text" name="txttglmasapajak1" id="txttglmasapajak1" size="12"/>
  &nbsp; <i>s.d</i>
  <input type="text" name="txttglmasapajak2" id="txttglmasapajak2" size="12"/></td>--!> 
                         <!-- <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>--!>
 <!--                       <tr>
                          <td style="padding-left:15px;">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>-->
                        <tr>
                          <td colspan="4" style="padding-left:15px;"><table width="200" border="0">
                            <tr>
                              <td><div align="center">Kawasan</div></td>
                              <td><div align="center">P</div></td>
                              <td><div align="center">L</div></td>
                              <td><div align="center"><!--Jari<sup>2</sup>--></div></td>
                              <td><div align="center">Sisi</div></td>
                              <td><div align="center">Luas</div></td>
                              <td><div align="center">Unit</div></td>
                              <td><div align="center">Tarif %</div></td>
							  <td><div align="center">N S L</div></td>
                              <td><div align="center">Harga Dasar</div></td>
                              <td><div align="center">Ketetapan</div></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td style="width:250px;"><select name="kawasan" id="kawasan" onchange="getnsl()" disabled="disabled">
                                <option>:: Kawasan ::</option>
								<option value="X">Kelas Khusus</option>
                                <option value="A">Kelas A</option>
                                <option value="B">Kelas B</option>
                                <option value="C">Kelas C</option>
                              </select>                              </td>
                              <td><input name="pjg" type="text" id="pjg" size="3" onkeyup="luasNya();" style="text-align:center" disabled="disabled" /></td>
                              <td><input name="lbr" type="text" id="lbr" size="3" onkeyup="luasNya();" style="text-align:center" disabled="disabled" /></td>
                              <td><input type="text" name="jari" id="jari" size="5" style="text-align:center" disabled="disabled" /></td><td>
                              <select name="sisi" id="sisi" disabled="disabled">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								
								
                              </select>      
                              <!--<input name="sisi" type="text" id="sisi" size="3" style="text-align:center" disabled="disabled" />-->
                              </td>
                              <td><input name="luas" type="text" id="luas" size="3" style="text-align:center" disabled="disabled" /></td>
                              <td><input name="unt" type="text" id="unt" size="3" style="text-align:center" disabled="disabled" /></td>
                              <td><input name="trf" type="text" id="trf" size="3" style="text-align:center" disabled="disabled" /></td>
							  <td><input name="cnsl" type="text" id="cnsl" size="3" style="text-align:center" disabled="disabled" /></td>
                              <td><input name="tarif" type="text" id="tarif" size="15" style="text-align:right" disabled="disabled" /></td>
                              <td><input name="ketetapan" type="text" id="ketetapan" size="15" style="text-align:right" disabled="disabled" /></td>
                              <td><input type="button" name="htg2" id="htg2" value="HITUNG" onclick="getTarif()" disabled="disabled" /></td>
                              <td><input type="button" name="tmbh" id="tmbh" value="TAMBAH" onclick="tambahRow()" disabled="disabled" /></td>
                              <td><input type="button" name="ubah" id="ubah" value="UBAH REKLAME" onclick="ubahReklame()" disabled="disabled" /></td>
                              <td><input type="button" name="krg" id="krg" onclick="hapusData();" disabled="disabled" value="HAPUS"></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                        	<td colspan="4">
                            <!--<div style="height: 30px;width:100%"><div id="toolbar"></div></div>-->
                            <div id="gridbox" style="height:200px;width:100%"></div>
                            
                            </td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        	<td style="">Jumlah Dipasang 
                       	    <input name="jml_dipasang" type="text" disabled="disabled" id="jml_dipasang" style="text-align: center;background-color:#FFFFCC;" size="3" readonly="readonly" /> Unit<!--&nbsp;&nbsp;Jumlah Tarif&nbsp;<input name="tarif_reklame" type="text" disabled="disabled" id="tarif_reklame" style="text-align: center;background-color:#FFFFCC;" size="10" readonly="readonly" />--></td>
                        	
                        	<td colspan="2"><span style="float:right">Jumlah Pembayaran
                       	        <input type="text" name="sub_jumlah" id="sub_jumlah" disabled="disabled" style="text-align: right;background-color:#FFFFCC;" />
                        	</span></td>
                       	</tr>
                        <!--<tr>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td colspan="2"><span style="float:right">Denda 
                       	        <input type="text" name="denda" id="denda" disabled="disabled" style="text-align: right;background-color:#FFFFCC;" onkeyup="hitungJumlahDibayar()" />
                        	</span></td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td colspan="2"><span style="float:right">Sewa Tanah 
                       	        <input type="text" name="sewa_tanah" id="sewa_tanah" disabled="disabled" style="text-align: right;background-color:#FFFFCC;" onkeyup="hitungJumlahDibayar()" />
                        	</span></td>
                        </tr>
                        <tr>-->
                        	<td>&nbsp;</td>
                        	<td>&nbsp;</td>
                        	<td colspan="2"><span style="float:right">
                                <input type="hidden" name="jml_dibayar" id="jml_dibayar" />
                        	</span></td>
                        </tr>
                        <tr>
                        	<td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-left:15px; background-color:#FFCC99;">
                                <input type="button" name="btnnew" id="button" value="BARU" onClick="newEntry();" style="width:90px;">
                                <input type="button" value="SIMPAN" onClick="simpan()" name="tambah" disabled style="width:90px;">
                                <!--<input type="button" value="EDIT" onClick="editRek()" name="edit1" disabled style="width:90px;">-->
                                <input type="button" value="HAPUS" onClick="hapus()" name="delete1" disabled="" style="width:90px;">
                                <input type="button" value="CETAK" onclick="cetak1()" name="cetak" disabled="" style="width:90px;"><!--<input type="button" value="STIKER" onclick="stiker()" name="stiker1" disabled="" style="width:90px;">--></td>
                        <input type="hidden" name="edit" id="edit" size="1" />
                        </tr>
                    </table>
                </form>
                <br />
</div>

<div id="C2">
<div style="padding:0 2px 10px 0px;">
                <div id="gridData" width="100%" height="530px" style="background-color:white;"></div>
                <div id="pagingArea" width="349px" style="background-color:white;"></div>
            </div>
            </div>            
        </div>
        
        <div id="objBrg" style="display:none;">
  <form name="frmSrc" method="post" action="javascript:void(0);"><table width="752" border="0">
  <tr>
    <td width="97">Parameter</td>
    <td width="216"><select name="parameter" id="parameter">
      <option value="1">NPWPD Usaha</option>
      <option value="2">Nama Usaha</option>
    </select></td><td width="417" rowspan="2"><input type="button" name="button2" id="button2" value="CARI" style="height:50px; width:100px;" onClick="cariDataWP();">
      <input type="button" name="button3" id="button3" value="TUTUP" style="height:50px; width:100px;" onClick="closeBrg();"></td>
    </tr>
    <tr>
    <td>Kata Kunci</td>
    <td><input type="text" name="keyword" id="keyword"></td>
  </tr>
  <tr>
    <td colspan="3"><div id="tmpGridWP" width="100%" height="320px" style="background-color:white;"></div></td>
    </tr>
</table>
  </form>
</div>
</div>
    <script language="javascript">
	//toolbar = new dhtmlXToolbarObject("toolbar");
//    toolbar.setIconsPath("<?php echo base_url(); ?>/assets/codebase_toolbar/imgs/btn/");
//    //toolbar.addButton("new", 0, "TAMBAH", "new.gif", "new_dis.gif");
//    //toolbar.addSeparator("sep1", 1);    
//    toolbar.addButton("del", 2, "HAPUS", "delete.png", "dis_delete.png");
//    toolbar.attachEvent("onclick", doTopClick);
//    toolbar.addSpacer("del");     
//
//    function doTopClick(id){
//        //if(id=="new"){
////            addRow();
////        }
////        else 
//		if(id=="del"){
//			conf = confirm("Apakah anda yakin ?");
//			if(conf){
//            	mygrid.deleteSelectedRows();
//			}
//        }        
//    }
	
function luasNya(){
	var pjg = document.frmData.pjg.value;
	var lbr = document.frmData.lbr.value;
	document.frmData.luas.value =  pjg*lbr;
//	alert('tesss');
}

function luasNya2(){
	var jari = document.frmData.jari.value;
	document.frmData.luas.value = (jari*jari)*3.14;
}
  
function bersihFormRow(){
document.frmData.kawasan.value = "";
document.frmData.pjg.value = "";
document.frmData.lbr.value = "";
document.frmData.jari.value = "";
document.frmData.sisi.value = "";
document.frmData.cnsl.value = "";
document.frmData.luas.value = "";
document.frmData.unt.value = "";
document.frmData.tarif.value = "";
document.frmData.trf.value = "";
document.frmData.ketetapan.value = "";	
document.frmData.teks_reklame.value = "";
document.frmData.waktu_pasang.value = "";
document.frmData.selama.value = "";
document.frmData.lokasi_pasang1.value = "";
document.frmData.gjenisrek.value = "";			
//document.frmData.gjenisrek2.value = "";			
document.frmData.sifatp.value = "";			
}

function hapusData(){
	conf = confirm("Apakah anda yakin ?");
			if(conf){
            	mygrid.deleteSelectedRows();
			}
}
	
	function addRow(){
		var id = mygrid.uid();
		var posisi = mygrid.getRowsNum();
		mygrid.addRow(id,['','','','','','','','','','','','','','','','',''],posisi);
		mygrid.selectRowById(id);
	}
	
	function tambahRow(){
		if(document.frmData.ketetapan.value!=""){
			var grek = document.frmData.kode_rek1.value;
			var grekn= document.frmData.nama_rek1.value;	
			var lok  = document.frmData.lokasi_pasang1.value;
			var kws = document.frmData.kawasan.value;
			var tema = document.frmData.teks_reklame.value;
			var pjg = document.frmData.pjg.value;
			var lbr = document.frmData.lbr.value;
			var jari = document.frmData.jari.value;
			var sisi = document.frmData.sisi.value;
			var luas = document.frmData.luas.value;
			var unt = document.frmData.unt.value;
			var tarif = document.frmData.tarif.value;
            var trf   = document.frmData.trf.value;
			var cnsl   = document.frmData.cnsl.value;
			var ktp = document.frmData.ketetapan.value;	
			var btid = document.frmData.buatidx.value;	
			//var kwsnm = document.getElementById('kawasan');	
			//var kwsx = kwsnm.options[kwsnm.selectedIndex].text								
			var id = mygrid.uid();			
			var posisi = mygrid.getRowsNum();						
			mygrid.addRow(id,[btid,kws,grek,grekn,tema,kws,lok,pjg,lbr,jari,sisi,luas,unt,trf,cnsl,tarif,ktp],posisi);			
			mygrid.selectRowById(id);
			
			//bersihFormRow();
			var stage = 2;
			HitungTotal(stage, id);			
			
		}else{
			alert("Klik HITUNG untuk mendapatkan nilai ketetapan reklame");
		}
	}
	
	mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
    mygrid.setHeader("btid,KawasanID, Kode Rekening, Nama Rekening, Tema, Kawasan, Lokasi, Panjang (m),Lebar (m),Jari-jari (m),Sisi,Luas (m2),Unit,tarif %,N S L,Harga Dasar,Ketetapan,no_sptpd",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);    
    mygrid.setInitWidths("100,100,90,220,120,90,200,75,75,75,75,75,75,75,75,120,150,100");
    mygrid.setColAlign("center,center,center,left,left,center,left,center,center,center,center,center,center,center,center,right,right,left");
    mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ron,ro");
    //mygrid.setColSorting("str,str,str,str,str,int,int,int,int,str");
    mygrid.setSkin("dhx_skyblue");  
	mygrid.setColumnHidden(0, true);	
	mygrid.setColumnHidden(17, true);
	mygrid.setColumnHidden(1, true);
	mygrid.setNumberFormat("0,000",16,".",",");
	mygrid.setNumberFormat("0,000",15,".",",");	
	//mygrid.attachEvent("onEditCell", editCell);
    mygrid.init();
	//runmdp();
	
	
var mdp = "";
function runmdp(){
mdp = new dataProcessor("<?php echo base_url()."index.php/reklame/reklame_detail"; ?>");
mdp.setUpdateMode("off");
mdp.init(mygrid);
mdp.attachEvent("onAfterUpdate", function(){
	loadData();
	//document.frmData.edit1.disabled = false;
	document.frmData.delete1.disabled = false;
	document.frmData.ubah.disabled = false;
	document.frmData.cetak.disabled = false;
	//document.frmData.stiker1.disabled = false;
    statusEnding();
	pesan(); 
})
}
	
	function editCell(stage, rId, cId){
		if (stage==2 && cId==5){
			HitungTotal(stage, rId);		
		} else if (stage==2 && cId==6){ // tarif
			HitungTotal(stage, rId);	
		}
		return true;
	}	
	
//	function pilih(){
//		pil=document.getElementById("jenis").value;
//		document.frmData.panjang.value = "";
//		document.frmData.lebar.value = "";
//		document.frmData.jari.value = "";
//		document.frmData.muka.value = "";
//		document.frmData.luas.value = "";
//		document.frmData.jumlah.value = "";
//		document.frmData.tarif.value = "";
//		document,frmData.dasar_pengenaan = "";
//		if(pil=='4.1.1.04.06'){
//			document.frmData.panjang.disabled = true;
//			document.frmData.lebar.disabled = true;
//			document.frmData.muka.disabled = true;
//			document.frmData.jari.disabled = false;
//		} else {
//			document.frmData.panjang.disabled = false;
//			document.frmData.lebar.disabled = false;
//			document.frmData.muka.disabled = false;
//			document.frmData.jari.disabled = true;
//		}
//	}
	
//	function hitung(){
//		if(document.frmData.jenis.value==''){
//			alert("Jenis Reklame Tidak Boleh Kosong");
//			document.frmData.jenis.focus();
//			return;
//		}
//		
//		if(document.frmData.posisi.value==''){
//			alert("Posisi Tidak Boleh Kosong");
//			document.frmData.posisi.focus();
//			return;
//		}
//		
//		if(document.frmData.kawasan.value==''){
//			alert("Kawasan Tidak Boleh Kosong");
//			document.frmData.kawasan.focus();
//			return;
//		}
//		
//		if(document.frmData.waktu.value==''){
//			alert("Waktu Pasang Tidak Boleh Kosong");
//			document.frmData.waktu.focus();
//			return;
//		}
//		
//		if(document.frmData.jumlah.value==''){
//			alert("Jumlah Tidak Boleh Kosong");
//			document.frmData.jumlah.focus();
//			return;
//		}
//		
//		var gabung =
//			"jenis=" + document.frmData.jenis.value +
//			"&posisi=" + document.frmData.posisi.value +
//			"&kawasan=" + document.frmData.kawasan.value +
//			"&waktu=" + document.frmData.waktu.value +
//			"&panjang=" + document.frmData.panjang.value +
//			"&lebar=" + document.frmData.lebar.value +
//			"&jari=" + document.frmData.jari.value +
//			"&muka=" + document.frmData.muka.value +
//			"&jumlah=" + document.frmData.jumlah.value;
//			//alert(gabung);
//			statusLoading();
//			dhtmlxAjax.post(base_url+'index.php/reklame/hitung', gabung, resPone);
//	}
	
//	function resPone(loader) {
//		if (loader.xmlDoc.readyState == 4) {
//			if (loader.xmlDoc.status == 200) {
//				result = loader.xmlDoc.responseText;
//				if(result) {
//					res = result.split('|');
//					document.frmData.tarif.value = format_number(res[0]);
//					document.frmData.dasar_pengenaan.value = format_number(res[1]);
//					document.frmData.luas.value = format_number(res[2]);
//					statusEnding();
//					return true;
//				}
//			} else {
//				 alert('There was a problem with the request.');
//			}
//		}
//	}
	
	function stiker(){
		var a = document.frmData.sptpd_1.value;
		var b = document.frmData.sptpd_2.value;
		var c = a+'/'+b;
		window.open('<?php echo site_url(); ?>/reklame/stiker?sptpd='+c, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	function cetak1() {
		var a = document.frmData.sptpd_1.value;
		var b = document.frmData.sptpd_2.value;
		var c = a+'/'+b;
		window.open('<?php echo site_url(); ?>/reklame/cetak?sptpd='+c, '', 'height=700,width=1000,scrollbars=yes');
	}
	
	tabbar = new dhtmlXTabBar("a_tabbar", "top");
	tabbar.setSkin('dhx_skyblue');
	tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
	tabbar.addTab("a1", "Input Data", "300px");
	tabbar.addTab("a2", "Listing Data", "300px");
	tabbar.setContent("a1", "C1"); 
	tabbar.setContent("a2", "C2");
	tabbar.setTabActive("a1");
	
		var base_url = "<?php echo base_url()?>";
        cal1 = new dhtmlxCalendarObject(['tgl_terima','tgl_permohonan','tgl_diperiksa','tgl_ms_pajak1','tgl_ms_pajak2']);
        cal1.setDateFormat('%d/%m/%Y');                
        
//		function getData(){
//			var s = document.frmData.rek_reklame.value;			
//			//alert(s);
//			var d = s.split("|");
//			document.frmData.harga_dasar.value = (d[1]);
//			document.frmData.tarif_kawasan.value = d[2];
//			document.frmData.jangka_waktu.value = d[3];
//			document.frmData.posisi_pasang.value = d[4];
//			document.frmData.kawasan_pasang.value = d[5];
//			document.frmData.posisi_pasang.disabled = true;
//			document.frmData.kawasan_pasang.disabled = true;
//			if(d[6]==2){
//				document.frmData.muka.disabled = false;
//				document.frmData.panjang.disabled = true;
//				document.frmData.lebar.disabled = true;
//				document.frmData.muka.disabled = true;
//				//document.frmData.jari2.value = format_number_desimal('0');
////				document.frmData.panjang.value = format_number_desimal('0');
////				document.frmData.lebar.value = format_number_desimal('0');
////				document.frmData.muka.value = format_number_desimal('0');
//				document.frmData.jari2.value = 0;
//				document.frmData.panjang.value = 0;
//				document.frmData.lebar.value = 0;
//				document.frmData.muka.value = 0;
//			} else {
//				document.frmData.jari2.disabled = true;
//				document.frmData.panjang.disabled = false;
//				document.frmData.lebar.disabled = false;
//				document.frmData.muka.disabled = false;	
//				//document.frmData.panjang.value = format_number_desimal('0');
////				document.frmData.lebar.value = format_number_desimal('0');
////				document.frmData.muka.value = format_number_desimal('0');
////				document.frmData.jari2.value = format_number_desimal('0');
//				document.frmData.panjang.value = 0;
//				document.frmData.lebar.value = 0;
//				document.frmData.muka.value = 0;
//				document.frmData.jari2.value = 0;
//			}
//		}
        
        function newEntry(){			
            bersih();
            aktif();
			document.frmData.txtblnmasapajak1.disabled = false;
			document.frmData.txtblnmasapajak2.disabled = false;
			document.frmData.txtthnmasapajak.disabled = false;
			document.frmData.tambah.disabled = false;
			//document.frmData.edit1.disabled = true;
			document.frmData.delete1.disabled = true;
			document.frmData.ubah.disabled = true;
			document.frmData.cetak.disabled = true;
			//document.frmData.stiker1.disabled = true;
			document.frmData.sub_jumlah.value = 0;
			//document.frmData.denda.value = 0;
			//document.frmData.sewa_tanah.value = 0;
			//document.frmData.jml_dibayar.value = 0;
			buat_id();						
        }
		
	function buat_id(){
		var postCek =
			"cek_baru=" + "baru";
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/reklame/buatid', postCek, resPOSTid);
	}
	
	function resPOSTid(loader) {
		if (loader.xmlDoc.readyState == 4) {
			if (loader.xmlDoc.status == 200) {
				result = loader.xmlDoc.responseText;
				if(result!=0) {
					//alert(result);
					document.frmData.buatidx.value = result;
					statusEnding();
					return true;
				}
			} else {
				 alert('There was a problem with the request.');
			}
		}
	}
		
        function bersih(){
            document.frmData.sptpd_1.value = "";
            document.frmData.sptpd_2.value = "";           

			document.frmData.npwpd.value = "";
			document.frmData.nama_perusahaan.value = "";
			document.frmData.alamat_perusahaan.value = "";
			//document.frmData.petugas.value = "";
			//document.frmData.tgl_terima.value = "";
			document.frmData.cara.value = "";
			//document.frmData.tgl_permohonan.value = "";
			//document.frmData.tgl_diperiksa.value = "";
			//document.frmData.jenis.value = "";
			document.frmData.teks_reklame.value = "";
			document.frmData.waktu_pasang.value = "";
			document.frmData.selama.value = "";
			//document.frmData.posisi.value = "";
			
			document.frmData.lokasi_pasang1.value = "";
			//document.frmData.lokasi_pasang2.value = "";
			//document.frmData.lokasi_pasang3.value = "";
			//document.frmData.lokasi_pasang4.value = "";
			//document.frmData.lokasi_pasang5.value = "";
			//document.frmData.lokasi_pasang6.value = "";
			//document.frmData.lokasi_pasang7.value = "";
			//document.frmData.lokasi_pasang8.value = "";
			//document.frmData.lokasi_pasang9.value = "";
			//document.frmData.lokasi_pasang10.value = "";
			
			//document.frmData.txttglmasapajak1.value = "";
			//document.frmData.txttglmasapajak2.value = "";
			
			document.frmData.jml_dipasang.value = "";
			//document.frmData.tarif_reklame.value = "";
			document.frmData.sub_jumlah.value = "";
			//document.frmData.denda.value = "";
			//document.frmData.sewa_tanah.value = "";
			//document.frmData.jml_dibayar.value = "";
			document.frmData.sifatp.value = "";						
			document.frmData.gjenisrek.value = "";						
			//document.frmData.gjenisrek2.value = "";						
            document.frmData.edit.value = "";
			
			bersihFormRow();
			mygrid.clearAll();
        }
        
        function aktif(){
            /*document.frmData.sptpd_1.disabled = false;
            document.frmData.sptpd_2.disabled = false;*/            
			document.frmData.npwpd.disabled = false;
			document.frmData.btnCari.disabled = false;
			/*document.frmData.nama_perusahaan.disabled = false;
			document.frmData.alamat_perusahaan.disabled = false;
			*///document.frmData.petugas.disabled = false;
			document.frmData.tgl_terima.disabled = false;
			document.frmData.cara.disabled = false;
			document.frmData.tgl_permohonan.disabled = false;
			document.frmData.tgl_diperiksa.disabled = false;
			//document.frmData.jenis.disabled = false;
			//document.frmData.teks_reklame.disabled = false;
			//document.frmData.waktu_pasang.disabled = false;
			//document.frmData.selama.disabled = false;
			//document.frmData.posisi.disabled = false;
			document.frmData.sifatp.disabled = false;
			//document.frmData.lokasi_pasang1.disabled = false;
			//document.frmData.lokasi_pasang2.disabled = false;
			//document.frmData.lokasi_pasang3.disabled = false;
			//document.frmData.lokasi_pasang4.disabled = false;
			//document.frmData.lokasi_pasang5.disabled = false;
			//document.frmData.lokasi_pasang6.disabled = false;
			//document.frmData.lokasi_pasang7.disabled = false;
			//document.frmData.lokasi_pasang8.disabled = false;
			//document.frmData.lokasi_pasang9.disabled = false;
			//document.frmData.lokasi_pasang10.disabled = false;
		
			//document.frmData.jml_dipasang.disabled = false;
			//document.frmData.sub_jumlah.disabled = false;
			//document.frmData.denda.disabled = false;
			//document.frmData.sewa_tanah.disabled = false;
			//document.frmData.jml_dibayar.disabled = false;
			
			//document.frmData.kawasan.disabled = false;
			//document.frmData.pjg.disabled = false;
			//document.frmData.lbr.disabled = false;
			//document.frmData.cnsl.disabled = false;
			//document.frmData.sisi.disabled = false;
			//document.frmData.luas.disabled = false;
			//document.frmData.unt.disabled = false;
			//document.frmData.trf.disabled = false;
			//document.frmData.tarif.disabled = false;
			document.frmData.ketetapan.disabled = false;

			document.frmData.tmbh.disabled = false;
			document.frmData.krg.disabled = false;
			
			document.frmData.htg2.disabled = false;						
        }
        
        function disable(){
            document.frmData.sptpd_1.disabled = true;
            document.frmData.sptpd_2.disabled = true;
            document.frmData.sifatp.disabled = true;
			document.frmData.npwpd.disabled = true;
			document.frmData.btnCari.disabled = true;
			document.frmData.nama_perusahaan.disabled = true;
			document.frmData.alamat_perusahaan.disabled = true;
			//document.frmData.petugas.disabled = true;
			document.frmData.tgl_terima.disabled = true;
			document.frmData.cara.disabled = true;
			document.frmData.tgl_permohonan.disabled = true;
			document.frmData.tgl_diperiksa.disabled = true;
			//document.frmData.jenis.disabled = true;
			document.frmData.teks_reklame.disabled = true;
			document.frmData.waktu_pasang.disabled = true;
			document.frmData.selama.disabled = true;
			//document.frmData.posisi.disabled = true;
			
			document.frmData.lokasi_pasang1.disabled = true;
			//document.frmData.lokasi_pasang2.disabled = true;
			//document.frmData.lokasi_pasang3.disabled = true;
			//document.frmData.lokasi_pasang4.disabled = true;
			//document.frmData.lokasi_pasang5.disabled = true;
			//document.frmData.lokasi_pasang6.disabled = true;
			//document.frmData.lokasi_pasang7.disabled = true;
			//document.frmData.lokasi_pasang8.disabled = true;
			//document.frmData.lokasi_pasang9.disabled = true;
			//document.frmData.lokasi_pasang10.disabled = true;
			
			document.frmData.txtblnmasapajak1.disabled = true;
			document.frmData.txtblnmasapajak2.disabled = true;
			document.frmData.txtthnmasapajak.disabled = true;
			
			document.frmData.jml_dipasang.disabled = true;
			document.frmData.sub_jumlah.disabled = true;
			//document.frmData.denda.disabled = true;
			//document.frmData.sewa_tanah.disabled = true;
			//document.frmData.jml_dibayar.disabled = true;
			
			document.frmData.kawasan.disabled = true;
			document.frmData.pjg.disabled = true;
			document.frmData.lbr.disabled = true;
			document.frmData.sisi.disabled = true;
			document.frmData.luas.disabled = true;
			document.frmData.unt.disabled = true;
			document.frmData.cnsl.disabled = true;
			document.frmData.trf.disabled = true;
			document.frmData.tarif.disabled = true;
			document.frmData.ketetapan.disabled = true;

			document.frmData.tmbh.disabled = true;
			document.frmData.krg.disabled = true;
			document.frmData.htg2.disabled = true;			
        }
        
        function simpan(){
			
			if(document.frmData.npwpd.value==''){
				alert("NPWPD Perusahaan Tidak Boleh Kosong");
				document.frmData.npwpd.focus();
				return;
			}			
			
			//if(document.frmData.txttglmasapajak1.value==''){
//				alert("Masa Pajak Tidak Boleh Kosong");
//				document.frmData.txttglmasapajak1.focus();
//				return;
//			}
//			
//			if(document.frmData.txttglmasapajak2.value==''){
//				alert("Masa Pajak Tidak Boleh Kosong");
//				document.frmData.txttglmasapajak2.focus();
//				return;
//			}
            if(document.frmData.tgl_ms_pajak1.value==''){
				alert("Masa Pajak Tidak Boleh Kosong");
				document.frmData.tgl_ms_pajak1.focus();
				return;
			}
			
			if(document.frmData.tgl_ms_pajak2.value==''){
				alert("Masa Pajak Tidak Boleh Kosong");
				document.frmData.tgl_ms_pajak2.focus();
				return;
			}
			
			if(document.frmData.txtthnmasapajak.value==''){
				alert("Tahun Pajak Tidak Boleh Kosong");
				document.frmData.txtthnmasapajak.focus();
				return;
			}
			
			if(document.frmData.tgl_permohonan.value==''){
				alert("Tanggal Permohonan Tidak Boleh Kosong");
				document.frmData.tgl_permohonan.focus();
				return;
			}
			
			if(document.frmData.tgl_diperiksa.value==''){
				alert("Tanggal Diperiksa Tidak Boleh Kosong");
				document.frmData.tgl_diperiksa.focus();
				return;
			}
			
			if(document.frmData.jml_dibayar.value==''){
				alert("Jumlah Pembayaran Tidak Boleh Kosong");	
				return;
			}
			
			jml_bayar2 = document.frmData.jml_dibayar.value;
						
			if(document.frmData.sptpd_1.value=="") {
			//cek();
			simpan2();
		} else {
			simpan2();
		}
	}	
	
	function cek(){
		var postCek =
			"npwpd=" + document.frmData.npwpd.value +
			"&awal=" + document.frmData.txtblnmasapajak1.value +
			"&akhir=" + document.frmData.txtblnmasapajak2.value +
			"&tahun=" + document.frmData.txtthnmasapajak.value +
			"&sifat_reklame=" + document.frmData.sifatp.value;
			
		statusLoading();
		dhtmlxAjax.post(base_url+'index.php/reklame/ricek', postCek, resPOST);
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
			runmdp(); // exe grid detail
            statusLoading();
			
        //arrTgl_1 = document.frmData.txttglmasapajak1.value.split("/");
//		tgl1 = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
//		
//		arrTgl_2 = document.frmData.txttglmasapajak2.value.split("/");
//		tgl2 = arrTgl_2[2]+"-"+arrTgl_2[1]+"-"+arrTgl_2[0];
//		

        arrTgl_1 = document.frmData.tgl_ms_pajak1.value.split("/");
		tgl1 = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];
		
		arrTgl_2 = document.frmData.tgl_ms_pajak2.value.split("/");
		tgl2 = arrTgl_2[2]+"-"+arrTgl_2[1]+"-"+arrTgl_2[0];

		arrTgl_3 = document.frmData.tgl_terima.value.split("/");
		terima = arrTgl_3[2]+"-"+arrTgl_3[1]+"-"+arrTgl_2[0];
		
		arrTgl_3 = document.frmData.tgl_permohonan.value.split("/");
		tgl_permohonan = arrTgl_3[2]+"-"+arrTgl_3[1]+"-"+arrTgl_2[0];
		
		arrTgl_3 = document.frmData.tgl_diperiksa.value.split("/");
		tgl_diperiksa = arrTgl_3[2]+"-"+arrTgl_3[1]+"-"+arrTgl_2[0];
		
		    var poststr =
                'sptpd_1=' + document.frmData.sptpd_1.value +
                '&sptpd_2=' + document.frmData.sptpd_2.value +
                '&npwpd=' + document.frmData.npwpd.value +
			'&nama_perusahaan=' + document.frmData.nama_perusahaan.value +
			'&alamat_perusahaan=' + document.frmData.alamat_perusahaan.value +
			'&petugas=' + document.frmData.petugas.value +
			'&tgl_terima=' + terima +
			'&cara=' + document.frmData.cara.value +
			'&tgl_permohonan=' + tgl_permohonan +
			'&tgl_diperiksa=' + tgl_diperiksa +
			'&buatidd=' + document.frmData.buatidx.value +
			'&sifat_reklame=' + document.frmData.sifatp.value +
			//'&waktu_pasang=' + document.frmData.waktu_pasang.value +
			//'&selama=' + document.frmData.selama.value +
			//'&posisi=' + document.frmData.posisi.value +
			
			//'&lokasi_pasang1=' + document.frmData.lokasi_pasang1.value +
			//'&lokasi_pasang2=' + document.frmData.lokasi_pasang2.value +
			//'&lokasi_pasang3=' + document.frmData.lokasi_pasang3.value +
			//'&lokasi_pasang4=' + document.frmData.lokasi_pasang4.value +
			//'&lokasi_pasang5=' + document.frmData.lokasi_pasang5.value +
			//'&lokasi_pasang6=' + document.frmData.lokasi_pasang6.value +
			//'&lokasi_pasang7=' + document.frmData.lokasi_pasang7.value +
			//'&lokasi_pasang8=' + document.frmData.lokasi_pasang8.value +
			//'&lokasi_pasang9=' + document.frmData.lokasi_pasang9.value +
			//'&lokasi_pasang10=' + document.frmData.lokasi_pasang10.value +
			
//			'&txttglmasapajak1=' + tgl1 +
//			'&txttglmasapajak2=' + tgl2 +
            '&tgl_ms_pajak1=' + tgl1 +
            '&tgl_ms_pajak2=' + tgl2 +    
			
			'&jml_dipasang=' + document.frmData.jml_dipasang.value +
			//'&tarif_reklame=' + document.frmData.tarif_reklame.value +
			//'&sub_jumlah=' + document.frmData.sub_jumlah.value +
			//'&denda=' + document.frmData.denda.value +
			//'&sewa_tanah=' + document.frmData.sewa_tanah.value +
			'&trf=' + document.frmData.trf.value +
			'&jml_dibayar=' + document.frmData.jml_dibayar.value +
			
			'&txtthnmasapajak=' + document.frmData.txtthnmasapajak.value +
			'&txtblnmasapajak1=' + document.frmData.txtblnmasapajak1.value +
			'&txtblnmasapajak2=' + document.frmData.txtblnmasapajak2.value +						
                
            '&edit=' + document.frmData.edit.value ;           
            dhtmlxAjax.post("reklame/simpan", encodeURI(poststr), outputResponse);
        }
        
        function outputResponse(loader) {        
            result = loader.xmlDoc.responseText;
            if(result) {                 
                arr = result.split("/");
                document.frmData.sptpd_1.value = arr[0];
                document.frmData.sptpd_2.value = arr[1]+"/"+arr[2];
                
				tmpRows();          
            }
            else
            {
                alert("Ada kesalahan pada program");
            }
        }
        
        

        
        // Wajib Pajak
	gridData = new dhtmlXGridObject('gridData');
	gridData.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridData.setHeader("no_sptpd,npwpd,nama_perusahaan,alamat_perusahaan,tgl_diterima,cara_hitung,masa_pajak1,masa_pajak2,tahun_pajak,bulan1,bulan2,petugas,tgl_permohonan,tgl_diperiksa,Jmlh_pasang,Jmlh_bayar,Id_reklame");//17
	gridData.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
	gridData.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100");
	gridData.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,right,left");
	gridData.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ron,ro");
	//gridData.setColumnHidden(0,true);
	gridData.setNumberFormat("0,000",15,",",".");
	gridData.enableMultiselect(true); 
	gridData.attachEvent("onRowSelect", selectData);
	gridData.enableSmartRendering(true);
	gridData.enablePaging(true,5,10,"pagingArea",true);
	gridData.setPagingSkin("bricks");
	gridData.init();
	gridData.setSkin("dhx_skyblue");
	loadData();
	
	function loadData(){
	gridData.clearAll();	
	gridData.loadXML(base_url+"index.php/reklame/load_data",function() { 
        });
		
	}
        
	function selectData(id){
		disable();
		document.frmData.tambah.disabled = true;
		document.frmData.btnnew.disabled = true;
		// Nomor
		arr = gridData.cells(id,0).getValue().split("/");
		document.frmData.sptpd_1.value = arr[0];
		document.frmData.sptpd_2.value = arr[1]+"/"+arr[2];
        document.frmData.npwpd.value = gridData.cells(id,1).getValue();
		
		document.frmData.nama_perusahaan.value = gridData.cells(id,2).getValue(); //nama_perusahaan
		document.frmData.alamat_perusahaan.value = gridData.cells(id,3).getValue(); //alamat_perusahaan
		document.frmData.tgl_terima.value = gridData.cells(id,4).getValue(); //tgl-diterima
		document.frmData.cara.value = gridData.cells(id,5).getValue(); //cara_hitung
		document.frmData.tgl_ms_pajak1.value = gridData.cells(id,6).getValue(); //masa_pajak1
		document.frmData.tgl_ms_pajak2.value = gridData.cells(id,7).getValue(); //masa_pajak2
		document.frmData.txtthnmasapajak.value = gridData.cells(id,8).getValue(); //tahun_pajak
		document.frmData.txtblnmasapajak1.value = gridData.cells(id,9).getValue(); //bulan1
		document.frmData.txtblnmasapajak2.value = gridData.cells(id,10).getValue(); //bulan2
		document.frmData.petugas.value = gridData.cells(id,11).getValue(); //petugas
		document.frmData.tgl_permohonan.value = gridData.cells(id,12).getValue(); //tgl_permohonan
		document.frmData.tgl_diperiksa.value = gridData.cells(id,13).getValue(); //tgl_diperiksa	
		document.frmData.jml_dipasang.value = gridData.cells(id,14).getValue();
		document.frmData.sub_jumlah.value = format_number(gridData.cells(id,15).getValue()); //sub_jumlah	
		document.frmData.jml_dibayar.value = gridData.cells(id,15).getValue(); //jml_dibayar								
		document.frmData.buatidx.value = gridData.cells(id,16).getValue(); //jml_dibayar		
		           
            document.frmData.edit.value = "1";
		
		var no = gridData.cells(id,0).getValue().split('/').join('.');
		mygrid.clearAll();
		mygrid.loadXML("<?php echo base_url()."index.php/reklame/load_detail_edit/"?>"+no);	
		

							
			//document.frmData.edit1.disabled = false;
			document.frmData.delete1.disabled = false;
			document.frmData.ubah.disabled = false;
			//document.frmData.stiker1.disabled = false;
			document.frmData.cetak.disabled = false;
			tabbar.setTabActive("a1");
	}
	
	function editRek(){
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='passwordnyadpka'){
				aktif();
				document.frmData.tambah.disabled = false;
				document.frmData.btnnew.disabled = false;				
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	function hapus() {
		var name=prompt("Please enter your password","");
		if (name!=null){
			if(name=='dispenda'){
				cnf = confirm("Apakah anda yakin akan menghapus data ini ?")
				if(cnf) {
					var postStr =
						"sptpd_1=" + document.frmData.sptpd_1.value +
						"&sptpd_2=" + document.frmData.sptpd_2.value;
					statusLoading();
					dhtmlxAjax.post(base_url+'index.php/reklame/hapus', postStr, function(loader) {
						result = loader.xmlDoc.responseText;
						alert(result);
						gridData.clearAll();
						loadData();
						bersih();
						disable();
						statusEnding();
					});
				}
				document.frmData.ubah.disabled = true;
			} else {
				alert("Password anda salah");
			}
		} else {
			alert("Password anda salah");
		}
	}
	
	dhxWins= new dhtmlXWindows();
	dhxWins.setImagePath("<?php echo base_url(); ?>/assets/codebase_windows/imgs/");
	wBrg = dhxWins.createWindow("wBrg",0,0,770,450);
	wBrg.setText("Daftar NPWPD");
	wBrg.button("park").hide();
	wBrg.button("close").hide();
	wBrg.button("minmax1").hide();
	wBrg.hide();

	function searchNPWPD() {
		wBrg.show();
    	wBrg.setModal(true);
		wBrg.center();
		wBrg.attachObject('objBrg');
	}

	function closeBrg() {
		wBrg.hide();
		wBrg.setModal(false);
	}
	
	// Wajib Pajak
	gridWP = new dhtmlXGridObject('tmpGridWP');
	gridWP.setImagePath(base_url+"assets/codebase_grid/imgs/");
	gridWP.setHeader("NPWPD,Nama Badan Usaha,Alamat,Pemilik");
	gridWP.setInitWidths("120,200,200,180");
	gridWP.setColAlign("left,left,left,left");
	gridWP.setColTypes("ro,ro,ro,ro");
	gridWP.enableMultiselect(true); 
	gridWP.attachEvent("onRowDblClicked", function(id) {
		document.frmData.npwpd.value = gridWP.cells(id,0).getValue();
		document.frmData.nama_perusahaan.value = gridWP.cells(id,1).getValue();
		document.frmData.alamat_perusahaan.value = gridWP.cells(id,2).getValue();
		closeBrg();
	});
	gridWP.enableSmartRendering(true);
	gridWP.init();
	gridWP.setSkin("dhx_skyblue");
	
	function cariDataWP() {	
		//if(document.frmSrc.keyword.value=="") { var kata_kunci = '0'; } else { var kata_kunci = document.frmSrc.keyword.value; }
		statusLoading();
		gridWP.clearAll();	
		gridWP.loadXML(base_url+"index.php/reklame/cariDataWP/"+document.frmSrc.keyword.value+"/"+document.frmSrc.parameter.value,function() {  								
		statusEnding();
		if(gridWP.getRowsNum()==""){
			alert("Data yang anda cari tidak ditemukan");
		}
		
});
//		+kata_kunci+"/"+document.frmSrc.parameter.value
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

// get data mygrid dan disimpan ke temporary array
var r = new Array();
function tmpRows() {
		var arr = mygrid.getAllItemIds().split(',');
		for(i=0;i < arr.length;i++) {
				id = arr[i];				
				r[i] =  mygrid.cells(id,0).getValue()+'|'+
                        mygrid.cells(id,1).getValue()+'|'+
                        mygrid.cells(id,2).getValue()+'|'+
                        mygrid.cells(id,3).getValue()+'|'+
                        mygrid.cells(id,4).getValue()+'|'+
                        mygrid.cells(id,5).getValue()+'|'+
                        mygrid.cells(id,6).getValue()+'|'+
						mygrid.cells(id,7).getValue()+'|'+
						mygrid.cells(id,8).getValue()+'|'+
						mygrid.cells(id,9).getValue()+'|'+	
                        mygrid.cells(id,10).getValue()+'|'+					
						mygrid.cells(id,11).getValue()+'|'+
						mygrid.cells(id,12).getValue()+'|'+	
						mygrid.cells(id,13).getValue()+'|'+		
                        mygrid.cells(id,14).getValue()+'|'+		
						mygrid.cells(id,15).getValue()+'|'+	
						mygrid.cells(id,16).getValue()+'|'+							
						mygrid.cells(id,17).getValue();                                       
		}	
                    mygrid.clearAll();
                    for(i=0;i<r.length;i++) {
                            addRowItem(i);
                    }
                    r = new Array();					
                    mdp.sendData();
            }
            
// set mygrid sesuai value dari temporary
function addRowItem(arrIndx) { 
		
		var id = mygrid.uid();

		var posisi = mygrid.getRowsNum();
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
		var row10= arr[9];					               
		var row11= arr[10];
		var row12= arr[11];					               
		var row13= arr[12];
		var row14= arr[13];
		var row15= arr[14];
		var row16= arr[15];
		var row17= arr[16];
        var row18= document.frmData.sptpd_1.value+"/"+document.frmData.sptpd_2.value;		
//		if(arr[0] != "") {
			mygrid.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10,row11,row12,row13,row14,row15,row16,row17,row18],posisi);
//		}
	}	

function HitungTotal(stage, rId) {
			
    //document.frmData.jml_dipasang.value = sumColumn(7);
	//document.frmData.tarif_reklame.value = sumColumn(9);
	var sub_jumlah = sumColumn(16);	
	//alert(sub_jumlah);
	document.frmData.sub_jumlah.value = format_number(sub_jumlah);
	document.frmData.jml_dibayar.value = sub_jumlah;
	
	var sub_unt = sumColumn(12);
	//alert(sub_unt);
	document.frmData.jml_dipasang.value = sub_unt;
	/*document.frmData.denda.value = 0;
	document.frmData.sewa_tanah.value = 0;
	
	if(document.frmData.denda.value==""){
		var denda = 0;
	} else {
		var denda = document.frmData.denda.value;
	}
	if(document.frmData.sewa_tanah.value==""){
		sewa_tanah = 0;
	} else {
		var sewa_tanah = document.frmData.sewa_tanah.value;
	}
	
	var jml_dibayar = parseInt(sub_jumlah)+parseInt(denda)+parseInt(sewa_tanah);
	document.frmData.sub_jumlah.value = format_number(sub_jumlah);
	document.frmData.jml_dibayar.value = format_number(jml_dibayar);
	*/
}

function sumColumn(ind) {
    var out = 0;
    for (var i = 0; i < mygrid.getRowsNum(); i++) {
        out += parseFloat(mygrid.cells2(i, ind).getValue());
    }
    return out;
}
	
	function getSifat(){
		if(document.frmData.sifatp.value == 'SITU'){			
			document.frmData.gjenisrek.disabled=false;
			//document.frmData.gjenisrek2.disabled=true;
			//document.frmData.gjenisrek2.value="";
		} else {			
			document.frmData.gjenisrek.disabled=true;
			//document.frmData.gjenisrek2.disabled=false;
			document.frmData.gjenisrek.value="";
		}
	}
	
	/*function getType(){
		disabled_child();
		if(document.frmData.jenis.value == '4.1.1.04.06'){
			document.frmData.pjg.value = "";
			document.frmData.lbr.value = "";
			document.frmData.jari.value = "";
			document.frmData.trf.value = "20";
            
			document.frmData.jari.disabled = false;
			document.frmData.pjg.disabled = true;
			document.frmData.lbr.disabled = true;
		} else {
			document.frmData.pjg.value = "";
			document.frmData.lbr.value = "";
			document.frmData.jari.value = "";
			document.frmData.trf.value = "20";
			document.frmData.pjg.disabled = false;
			document.frmData.lbr.disabled = false;
			document.frmData.jari.disabled = true;			
		}
		
		//getTarif();
	}*/
		/* function getnsl(){
			var kawasan = document.frmData.kawasan.value;			
			
			if(kawasan=="X" || kawasan=="x"){
				nsl = "6";				
			}else if(kawasan=="A" || kawasan=="a"){
				nsl = "5.4";				
			}else if(kawasan=="B" || kawasan=="b"){
				nsl = "4.8";				
			}else if(kawasan=="C" || kawasan=="c"){
				nsl = "4.2";				
			}
			document.frmData.cnsl.value = nsl;						
		} */
		
		function getTipe(){
			var cek = document.frmData.gjenisrek.value;
			//var cek2 = document.frmData.gjenisrek2.value;
			
			if (cek!=""){
				if(cek=="1"){
					document.frmData.kode_rek1.value = "4.1.1.04.01";
					document.frmData.nama_rek1.value = "Reklame Papan Merek";
					document.frmData.tarif.value = "";
					document.frmData.trf.value = "";
				}else
				if(cek=="2"){
					document.frmData.kode_rek1.value = "4.1.2.01.02";
					document.frmData.nama_rek1.value = "Pelayanan Persampahan / Kebersihan";
					document.frmData.tarif.value = "";
					document.frmData.trf.value = "";
				}else
				if(cek=="3"){
					document.frmData.kode_rek1.value = "4.1.4.07.04";
					document.frmData.nama_rek1.value = "Denda Pajak Reklame";
					document.frmData.tarif.value = "";
					document.frmData.trf.value = "";
				}else
				if(cek=="4"){
					document.frmData.kode_rek1.value = "4.1.4.08.01";
					document.frmData.nama_rek1.value = "Denda Ret. Jasa Umum";
					document.frmData.tarif.value = "";
					document.frmData.trf.value = "";
				}														
			}else{
				if (cek2!=""){
				if(cek2=="7"){
					document.frmData.kode_rek1.value = "4.1.1.04.02";
					document.frmData.nama_rek1.value = "Reklame Kain";
					document.frmData.tarif.value = "1250";
					document.frmData.trf.value = "20";
				}else
				if(cek2=="8"){
					document.frmData.kode_rek1.value = "4.1.1.04.03";
					document.frmData.nama_rek1.value = "Reklame Melekat / Stiker";
					document.frmData.tarif.value = "5";
					document.frmData.trf.value = "20";
				}else
				if(cek2=="9"){
					document.frmData.kode_rek1.value = "4.1.1.04.04";
					document.frmData.nama_rek1.value = "Reklame Selebaran";
					document.frmData.tarif.value = "5";
					document.frmData.trf.value = "20";
				}else
				if(cek2=="10"){
					document.frmData.kode_rek1.value = "4.1.1.04.06";
					document.frmData.nama_rek1.value = "Reklame Udara";
					document.frmData.tarif.value = "3000";
					document.frmData.trf.value = "20";
				}														
			}
			}						
		}
	
		function getTarif(){
			
			var wkt_psg = document.frmData.waktu_pasang.value;			           
			var selama = document.frmData.selama.value;			
			var kawasan = document.frmData.kawasan.value;			
			var luas = document.frmData.luas.value;			
			var sisi = document.frmData.sisi.value;
			var tarif = document.frmData.tarif.value;
			var trf = document.frmData.trf.value;
			var unt = document.frmData.unt.value;						
			var nsl = 0;
			var hi = 0;
			var hitungan1 = 0;
			var hitungan2 = 0;
			var hitungan3 = 0;			
			var hitungan4 = 0;			
			
			if(wkt_psg=="" || selama=="" || kawasan=="" || luas=="" || sisi=="" || tarif=="" || trf=="" || unt==""){
				alert("Indikator Perhitungan Belum Lengkap, Silahkan Melengkapi Kembali")
			}else{
			
			if(kawasan=="X" || kawasan=="x"){
				nsl = "6";				
			}else if(kawasan=="A" || kawasan=="a"){
				nsl = "5.4";				
			}else if(kawasan=="B" || kawasan=="b"){
				nsl = "4.8";				
			}else if(kawasan=="C" || kawasan=="c"){
				nsl = "4.2";				
			}
			
			if(wkt_psg=="tahun"){
				hitungan1 = (luas * sisi) * unt;
				hitungan2 = (tarif * hitungan1) * nsl;
				hitungan3 = (hitungan2 * trf)/100;				
				hitungan4 = hitungan3 * selama;				
			}else if(wkt_psg=="bulan"){
				hitungan1 = (luas * sisi) * unt;
				hitungan2 = (tarif * hitungan1) * nsl;
				hitungan3 = (hitungan2 * trf)/100;				
				hitungan4 = (hitungan3 * selama)/12;				
			}else if(wkt_psg=="hari"){
				hitungan1 = (luas * sisi) * unt;
				hitungan2 = (tarif * hitungan1) * nsl;
				hitungan3 = (hitungan2 * trf)/100;				
				hitungan4 = hitungan3 * selama;	
			} 
			//hasil	
			document.frmData.ketetapan.value = hitungan4;
			}			
		}
        
        /*function outputTarif(loader) {        
            result = loader.xmlDoc.responseText;
            
            if(result) {       
				document.frmData.cnsl.value = result;
                //document.frmData.tarif.value = result;
                document.frmData.trf.value = "20";
				getType();                      
            }
            
            
            else
            {
                alert("Ada kesalahan pada program");
            }
        }        		
		
		function hitungPajak(){
									
			var selama = document.frmData.selama.value;
			var luas = document.frmData.luas.value;
			var sisi = document.frmData.sisi.value;
			var tarif = document.frmData.tarif.value;
			var unt = document.frmData.unt.value;
			var cnsl = document.frmData.cnsl.value;
			
			var ketetapan = selama*luas*sisi*tarif*unt*cnsl;
			document.frmData.ketetapan.value = ketetapan;									
			
		}*/
		
		function hitungJumlahDibayar(){
			var subjumlah = document.frmData.sub_jumlah.value;
			var denda = document.frmData.denda.value;
			var sewa_tanah = document.frmData.sewa_tanah.value;
			var jml_dibayar = parseInt(subjumlah)+parseInt(denda)+parseInt(sewa_tanah);
			document.frmData.jml_dibayar.value = format_number(jml_dibayar);
		}
		
		function ubahReklame(){
			var no_sptpd = "";
			var tipe_rekening = "";
			no_sptpd = document.frmData.sptpd_1.value;
			var win = window.open('../../defri/ubah_data_reklame/?no_sptpd='+no_sptpd,'_blank');
			win.focus();
		}
		
		function getSelama(){
			arrTgl_1 = document.frmData.tgl_ms_pajak1.value.split("/");
			tgl1 = arrTgl_1[2]+"-"+arrTgl_1[1]+"-"+arrTgl_1[0];

			arrTgl_2 = document.frmData.tgl_ms_pajak2.value.split("/");
			tgl2 = arrTgl_2[2]+"-"+arrTgl_2[1]+"-"+arrTgl_2[0];
			
			var tanggal1 = new Date(tgl1);
			var tanggal2 = new Date(tgl2);
			var tglPertama = Date.parse(tanggal1);
			var tglKedua = Date.parse(tanggal2);
			var selisihHari = (tglKedua - tglPertama) / 1000;
			var selisih = 0;
			waktuPasang = document.frmData.waktu_pasang.value;
			
			switch(waktuPasang){
				case "hari":
					selisih = selisihHari / (60*60*24) + 1;
				break;
				case "bulan":
					selisih = Math.round(selisihHari/(60*60*24*30.42));
				break;
				case "tahun":
					selisih = Math.round(selisihHari/(60*60*24*30.42*12));
				break;
			}
			
			document.frmData.selama.value = selisih;
		}
				
    </script>
	