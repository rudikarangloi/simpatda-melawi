<script src="<?php echo base_url(); ?>assets/dhtmlx.js" type="text/javascript"></script>
<!-- dhtmlx.css contains styles definitions for all use components -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/dhtmlx.css" />

<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css"/>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css"/>
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>


<!--link easui -->
<!-- Buat combobox -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/icon.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css"/>
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>


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

<!-- Combo -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.css" />
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.js"></script>
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/ext/dhtmlxcombo_group.js"></script>
<!-- end of combo -->

<style>
  body{
   background:#FFF;
 }
</style>

<script src="<?php echo base_url(); ?>/assets/codebase_ajax/dhtmlxcommon.js"></script>
<div style="height:100%; overflow:auto;">
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	var kel = '';
	var kec = '';
	var kab = '';
	lcstatus = 'tambah';
	
	
	
	
	$(function(){
		$('#cmb_skpd').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_skpd',
			idField: 'kd_skpd',
			panelWidth:400,
			textField:'kd_skpd',
			mode:'remote',
			
			columns:[[
			{field:'kd_skpd',title:'Kode',width:70},
			{field:'nama_skpd',title:'Nama SKPD',width:300}
			]],
			onSelect:function(rowIndex,rowData){
                kd_skpd = rowData.kd_skpd;
                $("#nama_skpd").attr("value",rowData.nama_skpd.toUpperCase());
                $("#cmb_skpd").attr("value",rowData.kd_skpd);
                
            }
		})
		
	})
	
	
	
	$(function(){
		$('#cmb_kegiatan').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_kegiatan',
			idField: 'kd_kegiatan',
			panelWidth:370,
			textField:'kd_kegiatan',
			mode:'remote',
			
			columns:[[
			{field:'kd_kegiatan',title:'Kode',width:100},
			{field:'nm_kegiatan',title:'Nama Kegiatan',width:260}
			]],
			onSelect:function(rowIndex,rowData){
                kd_kegiatan = rowData.kd_kegiatan;
                $("#nm_kegiatan").attr("value",rowData.nm_kegiatan.toUpperCase());
                $("#cmb_kegiatan").attr("value",rowData.kd_kegiatan);
                
            }
		})
		
	})
	
	
	
	$(function(){
		$('#cmb_rek4').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_rek5',
			idField: 'kd_rek5',
			panelWidth:400,
			textField:'kd_rek5',
			mode:'remote',
			
			columns:[[
			{field:'kd_rek5',title:'Kode',width:70},
			{field:'nm_rek5',title:'Nama Rekening',width:300}
			]],
			onSelect:function(rowIndex,rowData){
                kd_rek5 = rowData.kd_rek5;
                $("#nm_rek4").attr("value",rowData.nm_rek5.toUpperCase());
                $("#cmb_rek4").attr("value",rowData.kd_rek5);
                
            }
		})
		
	})
	
	
	$(function(){
		$('#sdana').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_dana',
			idField: 'sdana',
			panelWidth:210,
			textField:'sdana',
			mode:'remote',
			
			columns:[[
			//{field:'kd_dana',title:'Kode',width:70},
			{field:'sdana',title:'Sumber Dana',width:200}
			]],
			onSelect:function(rowIndex,rowData){
                sdana = rowData.sdana;
                $("#sdana").attr("value",rowData.sdana.toUpperCase());
                //$("#cmb_dana").attr("value",rowData.sdana);
                
            }
		})
		
	})
	
	
	
$(function(){
    $('#dg').datagrid({
     url:' <?php echo site_url()?>/realisasi_pendapatan/load_realisasi',
     idField:'no_trdrka',
     nowrap: false,
     pagination: true,
     rownumbers : true,
     fitColumms: true,
     singleSelect : true,
     remoteSort : true,

     columns:[[
     {field: 'no_trdrka',title:'no_trdrka',width:220, sortable:true},
     {field: 'kd_skpd',title:'kd_skpd',width:80, sortable:true},
     {field: 'nm_skpd',title:'nm_skpd',width:250, sortable:true},
     {field: 'kd_kegiatan',title:'kd_kegiatan',width:120, sortable:true},
     {field: 'nm_kegiatan',title:'nm_kegiatan',width:150, sortable:true},
     {field: 'kd_rek4',title:'kode Rek4',width:60, sortable:true},
     {field: 'nm_rek4',title:'Rekening Jenis',width:150, sortable:true},     
	 {field: 'kd_rek5',title:'kode Rek5',width:60, sortable:true},
     {field: 'nm_rek5',title:'Rekening Rincian',width:150, sortable:true},
     {field: 'sumber',title:'sumber',width:50, sortable:true},
     {field: 'nilai',title:'nilai',width:90, align:'right', sortable:true},
     ]],

     onSelect:function(rowIndex,rowData){
	 //row data ambil dari field tabel
       cno_trdrka = rowData.no_trdrka;
       ccmb_skpd  = rowData.kd_skpd;
       cnama_skpd  = rowData.nm_skpd;
       ccmb_kegiatan  = rowData.kd_kegiatan;
       cnm_kegiatan = rowData.nm_kegiatan;
       ccmb_rek4  = rowData.kd_rek5;
       cnm_rek4  = rowData.nm_rek5;	   
       csdana  = rowData.sumber;
       cnilai  = rowData.nilai;
       get(cno_trdrka,ccmb_skpd,cnama_skpd,ccmb_kegiatan,cnm_kegiatan,ccmb_rek4,cnm_rek4,csdana,cnilai);
     },

     onDblClickRow:function(rowIndex,rowData){
      lcidx = rowIndex;
      edit();
    }

  });
});

function get(cno_trdrka,ccmb_skpd,cnama_skpd,ccmb_kegiatan,cnm_kegiatan,ccmb_rek4,cnm_rek4,csdana,cnilai){
		//value ambil id form nya bukan field !!!
		
		$("#no_trdrka").attr("value",cno_trdrka);
		$("#cmb_skpd").combogrid("setValue",ccmb_skpd);
		$("#nama_skpd").attr("value",cnama_skpd);
		$("#cmb_kegiatan").combogrid("setValue",ccmb_kegiatan);
		$("#nm_kegiatan").attr("value",cnm_kegiatan);
		$("#cmb_rek4").combogrid("setValue",ccmb_rek4);
		$("#nm_rek4").attr("value",cnm_rek4);
		$("#sdana").combogrid("setValue",csdana);		
		$("#nilai").attr("value",cnilai);
  }
    
	 function kirim(){
			//alert('tes');
			//yg dalam kurung itu ambil dari id bukan field
			var cno_trdrka = document.getElementById('no_trdrka').value
			var ccmb_skpd  = $("#cmb_skpd").combogrid("getValue");
			var cnama_skpd = document.getElementById('nama_skpd').value;
			var ccmb_kegiatan = $("#cmb_kegiatan").combogrid("getValue");
			var cnm_kegiatan = document.getElementById('nm_kegiatan').value
			var ccmb_rek4 = $("#cmb_rek4").combogrid("getValue");
			var cnm_rek4  = document.getElementById('nm_rek4').value
			var csdana = $("#sdana").combogrid("getValue");			
			var cnilai = document.getElementById('nilai').value
            
            //var left_trdrka = substr(cno_trdrka,0,4);
            
				/*if(cno_trdrka == ''){
					alert('NO TRDRKA tidak boleh kosong');
					exit();
				}*/
				if(ccmb_skpd == ''){
					alert('SKPD tidak boleh kosong');
					exit();
				}
				if(ccmb_kegiatan == ''){
					alert('Kode Kegiatan tidak boleh kosong');
					exit();
				}
				if(ccmb_rek4 == ''){
					alert('Kode Rekening tidak boleh kosong');
					exit();
				}				
				if(cnilai == ''){
					alert('Nilai tidak boleh kosong');
					exit();
				}
				
	if(lcstatus=='tambah'){	                           
            
            var a = ccmb_skpd.substr(0,4);
            var b = ccmb_kegiatan.substr(11,5);
            var gab = ccmb_skpd + '.' + a + '.' + ccmb_skpd + '.' + b + '.' + ccmb_rek4;
                        
             <?php             
            $tanggal=date("Y-m-d");                                             
             echo "var tgl = $tanggal;";   	            
            ?>                                 
            var input_tgl = tgl;             
                
			lcfield = "no_trdrka,kd_skpd,nm_skpd,kd_kegiatan,nm_kegiatan,kd_rek5,nm_rek5,sumber,nilai,nilai_ubah,input";
			lcvalue = "'"+gab+"','"+ccmb_skpd+"','"+cnama_skpd+"','"+ccmb_kegiatan+"','"+cnm_kegiatan+"','"+ccmb_rek4+"','"+cnm_rek4+"','"+csdana+"','"+cnilai+"','"+cnilai+"','"+input_tgl+"'";
			
			//alert(lcvalue);
		
			 $(document).ready(function(){
		$.ajax({
           type: "POST",
           url: '<?php echo site_url(); ?>/realisasi_pendapatan/save',
                data:({tabel:'trdrka',kolom:lcfield,isi:lcvalue}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else if (status=='1'){
							alert('Data Tersimpan..!!');
						}else{
                            alert('Data Sudah Ada..!!');
                            exit();
                        }
                    }
				});
            });
            	   		                      
    $('#dg').datagrid('reload');
                   
	} else{
     lcquery = "UPDATE trdrka SET kd_skpd='"+ccmb_skpd+"',nm_skpd='"+cnama_skpd+"',kd_kegiatan='"+ccmb_kegiatan+"',nm_kegiatan='"+cnm_kegiatan+"',kd_rek5='"+ccmb_rek4+"',nm_rek5='"+cnm_rek4+"',sumber='"+csdana+"',nilai='"+cnilai+"' where no_trdrka='"+cno_trdrka+"'";
	 
     $(document).ready(function(){
        $.ajax({
           type: "POST",
           url: '<?php echo site_url(); ?>/realisasi_pendapatan/update_anggaran',
               data: ({st_query:lcquery}),
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else{
                            alert('Data Tersimpan..!!');
                            exit();
                        }
                    }
            });
            });
		   $('#dg').datagrid('reload');
		}
			//alert(lcvalue);
			kosong()		
}
	
function kosong(){
	$("#no_trdrka").attr("value",'');
	$("#cmb_skpd").combogrid("setValue",'');
	$("#nama_skpd").attr("value",'');
	$("#cmb_kegiatan").combogrid("setValue",'');	
	$("#nm_kegiatan").attr("value",'');
	$("#cmb_rek4").combogrid("setValue",'');
	$("#nm_rek4").attr("value",'');
	$("#sdana").combogrid("setValue",'');	
	$("#nilai").attr("value",'');
}		


function tambah(){
	lcstatus = 'tambah';
	tabbar.setTabActive("a1");
	document.getElementById("no_trdrka").disabled=false;
 kosong();
}


function edit(){
lcstatus = 'edit';
tabbar.setTabActive("a1");
document.getElementById("no_trdrka").disabled=true;
}


function hapus(){
//alert('hey');
	var a=confirm("Apakah Data Akan Dihapus..?");
if (a==true){	
    var cno_trdrka = document.getElementById('no_trdrka').value;
    var urll = '<?php echo site_url(); ?>/realisasi_pendapatan/hapus_anggaran';
	
    $(document).ready(function(){
       $.post(urll,({tabel:'trdrka',cnid:cno_trdrka}),
	   function(data){
        status = data;
        if (status=='0'){
            alert('Gagal Hapus..!!');
            exit();
        } else {
            $('#dg').datagrid('deleteRow',lcidx);
            alert('Data Berhasil Dihapus..!!');
            exit();
        }
    });
   });
   $('#dg').datagrid('reload');
   }else{
	exit();
   } 
}


function cari(){
    var kriteria = document.getElementById("txtcari").value;
    $(function(){
     $('#dg').datagrid({
		url: '<?php echo site_url(); ?>/realisasi_pendapatan/load_cari',
        queryParams:({cari:kriteria})
        });
     });
    }
</script>


<style>
	.oval_big1 {
		width: 950px;		
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

<h2 style="margin:-140px 5px 25px 250px; font-size:16px;">RENCANA KEGIATAN ANGGARAN</h2>
<div id="a_tabbar" class="oval_big1" style="background-color: #FFF;">
<div id="C1" style="background-color: #B3D9F0;">
<!---B3D9F0-->
	<br />
    <form name="frmData" id="frmData">
    	<table>
			
			<tr>
              	<td style="padding-left:35px;">No TRDRKA</td>
				<td><input type="text" size="45" name="no_trdrka" id="no_trdrka" disabled="true" placeholder="Auto Generate"/></td>
			</tr>
			
			<tr>
                <td style="padding-left:35px;"><strong>S K P D</strong></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <td><input type="text" name="kd_skpd" id="cmb_skpd" size="45" style="background-color:#FFFFCC;"/>
                <input type="text" name="nama_skpd" id="nama_skpd" style="width:450px;" /></td>
           	</tr>
			
			<tr>
                <td style="padding-left:35px;">Kegiatan</td>
                <td><input type="text" name="kd_kegiatan" id="cmb_kegiatan" size="45" style="background-color:#FFFFCC;" />
                <input type="text" name="nm_kegiatan" id="nm_kegiatan" style="width:450px;" /></td>
           	</tr>
		</table>
		<hr/>
		<table>
            <tr>
              	<td style="padding-left:15px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Rekening Anggaran</strong></td>
            </tr>
		</table>
		<hr/>
		<table>
		
			<tr>
                <td style="padding-left:35px;">Rekening</td>
                <td><input type="text" name="kd_rek4" id="cmb_rek4" size="45" style="background-color:#FFFFCC;" />
                <input type="text" name="nm_rek4" id="nm_rek4" style="width:450px;" /></td>
           	</tr>
			
			
			
			<tr>
                <td style="padding-left:35px;">Sumber Dana</td>
                <td><input type="text" name="sdana" id="sdana" size="45" style="background-color:#FFFFCC;" /> 
                <!--<input type="text" name="sdana" id="sdana" style="width:310px;" /></td>-->
           	</tr>
			
            <tr>
              	<td style="padding-left:35px;">Nilai</td>
				<td><input type="text" size="45" id="nilai" name="nilai" placeholder="Nilai Rupiah" /></td>
			</tr>
            </table>
			<table width="50%">
            <tr>
            <td colspan="3">&nbsp;</td>
            </tr> 
            <tr>
				<td align="center" style="padding-left:15px;"><input type="button" value="Simpan" onclick="kirim()" name="tambah" style="padding-left:20px; padding-right:20px" /></td>                
            </tr>
            <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
    	</table>
    </form>	
	
</div>
</div>

<div id="C2"style="width:950px;">
          <div style="padding:0 2px 10px 0px;">
            <div id="gridContent" height="480px"></div>
            <div id="pagingArea" width="350px" style="background-color: white;"></div>
          </div>




<table style="width:100%;" border="0">
        <tr style="border-style:hidden;">
        <td width="8%" style="border-style:hidden;">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a></td>

        <td width="6%" style="border-style:hidden;">
        <a class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="javascript:edit()">Edit</a></td>
		
		<td> <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a></td>		        

        <td width="6%" style="border-style:hidden;"><a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a></td>
        <td width="73%"><input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
</table>
          
		  <div id="container">
            <table id="dg"> </table>
          </div>
</div>
</body>

<script language="javascript">
	var dhx_globalImgPath="<?php echo base_url(); ?>/assets/codebase_combo/imgs/";
</script>
</div>
<script language="javascript">
       tabbar = new dhtmlXTabBar("a_tabbar", "top");
       tabbar.setSkin('dhx_skyblue');
       tabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
       tabbar.addTab("a1", "Input Data", "300px");
       tabbar.addTab("a2", "Listing", "300px");
       tabbar.setContent("a1", "C1");
       tabbar.setContent("a2", "C2");
       tabbar.setTabActive("a1");

       cal1 = new dhtmlxCalendarObject('tgl');
       cal1.setDateFormat('%d/%m/%Y');

       cRsa = dhxWins.createWindow("cRsa",0,0,900,390);
       cRsa.setText("Pencarian Data SPTPD");
       cRsa.button("park").hide();
       cRsa.button("close").hide();
       cRsa.button("minmax1").hide();
       cRsa.hide();
</script>
