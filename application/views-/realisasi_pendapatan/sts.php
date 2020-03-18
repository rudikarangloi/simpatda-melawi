<script src="<?php echo base_url(); ?>assets/dhtmlx.js" type="text/javascript"></script>
<!-- dhtmlx.css contains styles definitions for all use components -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/dhtmlx.css" />

<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>

<!--link easui -->
<!-- Buat combobox -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/icon.css"/>
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery.easyui.min.js"></script>
	
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
<script src="<?php echo base_url(); ?>/assets/codebase_ajax/dhtmlxcommon.js"></script>


<div style="height:100%; overflow:auto;">
<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";
	var kel = '';
	var kec = '';
	var kab = '';
    var lcstatus = '';

// ini function buat list data sts
	$(function(){
			
    $('#dg').datagrid({
     url:' <?php echo site_url()?>/realisasi_pendapatan/load_sts',
     idField:'no_sts',
     nowrap: false,
     pagination: true,
     rownumbers : true,
     fitColumms: true,
     singleSelect : true,
     remoteSort : true,
     columns:[[
     {field: 'no_sts',title:'Nomor STS',width:100, sortable:true},
     {field: 'kd_skpd',title:'SKPD',width:70, sortable:true},
     {field: 'nama_skpd',title:'Nama SKPD',width:200, sortable:true},
     {field: 'tgl_sts',title:'Tanggal',width:70, sortable:true},
     {field: 'nama_rek',title:'Nama Rekening',width:180, sortable:true},
	 {field: 'keterangan',title:'Uraian',width:200, sortable:true},
     {field: 'rupiah2',title:'Rupiah',align:'right',width:80, sortable:true}     
     ]],

     onSelect:function(rowIndex,rowData){
       cnokas = rowData.no_sts;
       ctgl_kas  = rowData.tgl_sts;
       cskpd  = rowData.kd_skpd;
       cnmskpd  = rowData.nama_skpd;
       cnobukti  = rowData.no_bukti;
       ctglbukti = rowData.tgl_kas;
       curaian  = rowData.keterangan;
       ckegiatan  = rowData.kd_kegiatan;
       crekening  = rowData.kd_rek5;
       cnmrek = rowData.nama_rek;
       crupiah  = rowData.rupiah;
       cjenis  = rowData.jns_trans;	   
       get(cnokas,ctgl_kas,cskpd,cnmskpd,cnobukti,ctglbukti,curaian,ckegiatan,crekening,cnmrek,crupiah,cjenis);              
     },

     onDblClickRow:function(rowIndex,rowData){        
      get(cnokas,ctgl_kas,cskpd,cnmskpd,cnobukti,ctglbukti,curaian,ckegiatan,crekening,cnmrek,crupiah,cjenis);  
      lcidx = rowIndex;
      //judul = 'Edit Data';
      //edit();            
    }

  });
});
		

function get(cnokas,ctgl_kas,cskpd,cnmskpd,cnobukti,ctglbukti,curaian,ckegiatan,crekening,cnmrek,crupiah,cjenis){
		//value ngambil dari id
		// $("#nama").combogrid("setValue",ctgl_kas);                        
    $("#no_kas").attr("value",cnokas);
    $("#tgl_kas").attr("value",ctgl_kas);
    $("#cmb_skpd").combogrid("setValue",cskpd);
    $("#nama_skpd").attr("value",cnmskpd);
    $("#no_bukti").attr("value",cnobukti);
    $("#tgl_bukti").attr("value",ctglbukti);
    $("#uraian").attr("value",curaian);
    $("#jns_transaksi").attr("value",cjenis);
	$("#cmb_giat").combogrid("setValue",ckegiatan);
	$("#cmb_rekening").combogrid("setValue",crekening);
	$("#rupiah").attr("value",crupiah);
	//$("#nm_kegiatan").attr("value",'');
	$("#nm_rek4").attr("value",cnmrek);        
  }

// ini itu buat fungsi validasi data gaboleh kosong harus selalu diisi
function kirim(){
		
		var cnokas = document.getElementById('no_kas').value;
		var ctglkas = $("#tgl_kas").datebox('getValue');        
		var cskpd = $("#cmb_skpd").combogrid("getValue");
		var cnobukti = document.getElementById('no_bukti').value;
		var ctglbukti = $("#tgl_bukti").datebox('getValue');
		var curaian = document.getElementById('uraian').value;
		var ckegiatan = $("#cmb_giat").combogrid("getValue");
		var crekening = $("#cmb_rekening").combogrid("getValue");
		var crupiah = document.getElementById('rupiah').value;
		//var cjenis = document.getElementById('jns_transaksi').value;
		        
		if (cnokas == ''){
			alert ('No Kas Tidak Boleh Kosong');
			document.form_sts.no_kas.focus();
			return;
			exit();
		}
		if (ctglkas == ''){
			alert ('Tanggal Kas Tidak Boleh Kosong');
			document.form_sts.tgl_kas.focus();
			return;
			exit();
		}
		if (cskpd == ''){
			alert ('SKPD Tidak Boleh Kosong');
			document.form_sts.cmb_skpd.focus();
			return;
			exit();
		}
		if (cnobukti == ''){
			alert ('No Bukti Harus Diisi');
			document.form_sts.no_bukti.focus();
			return;
			exit();
		}
		if (ctglbukti == ''){
			alert ('Tanggal Bukti Harus Diisi');
			document.form_sts.tgl_bukti.focus();
			return;
			exit();
		}
		if (curaian == ''){
			alert ('Uraian Harus Diisi');
			document.form_sts.uraian.focus();
			return;
			exit();
		}	
        
        //alert(cnokas+'-'+ctglkas+'-'+cskpd+'-'+cnobukti+'-'+ctglbukti+'-'+curaian+'-'+ckegiatan+'-'+crekening+'-'+crupiah);

		/*$.post('<?php echo site_url(); ?>/realisasi_pendapatan/save_sts',
		{no_kas:cnokas,tgl_kas:ctglkas,cmb_skpd:cskpd,no_bukti:cnobukti,tgl_bukti:ctglbukti,uraian:curaian,cmb_giat:ckegiatan,cmb_rekening:crekening,rupiah:crupiah},		
		function (data){		 
			sts = data;
			if (sts == '1'){
				alert ('Simpan Data Berhasil');
				//document.form_sts.no_kas.focus();
				$('#dg').datagrid('reload');
			}else{
				alert ('Simpan Data Gagal');
			}			
		});
		
        // 
        /*    kosong = "";               
            pad ="4";
			lcfield = "kd_skpd,no_sts,kd_rek5,rupiah,kd_kegiatan";
            lcfield2 = "no_sts,no_bukti,kd_skpd,tgl_sts,keterangan,total,kd_bank,kd_kegiatan,jns_trans,rek_bank,no_kas,tgl_kas,no_cek,status,sumber";			
            lcvalue = "'"+cskpd+"','"+cnokas+"','"+crekening+"','"+crupiah+"','"+ckegiatan+"'";
            lcvalue2 = "'"+cnokas+"','"+cnobukti+"','"+cskpd+"','"+curaian+"','"+crupiah+"','"+kosong+"','"+ckegiatan+"','"+pad+"','"+ckegiatan+"','"+cnokas+"','"+ctglbukti+"','"+kosong+"','"+kosong+"','"+kosong+"'";
			
			//alert(lcvalue);
		*/
        /*
		$(document).ready(function(){
		//event.preventDefault();  
		dataString = $("#form_sts").serialize();
		$.ajax({
           type: "POST",
           url: '<?php echo site_url(); ?>/realisasi_pendapatan/save_sts',
                data:dataString,
                dataType:"json",
                success:function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        }else if (status=='1'){
							alert('Data Tersimpan..!!');
                            kosong();
						}else{
                            alert('Data Sudah Ada..!!');
                            exit();
                        }
                    }
				});
            });
            	   		                                                 
        
        //
       */
       $('#form_sts').submit(function(event) {
		event.preventDefault();
		dataString = $("#form_sts").serialize();
        curl = "<?php echo site_url(); ?>/realisasi_pendapatan/save_sts";
		$.ajax({
		   type: "POST",
		   url: curl,
		   data: dataString,
		   success: function(data){
				//var sts = $.parseJSON(data);
                var sts = data;
                var nilai = sts.nilai;
                //var iduser = sts.iduser;                
                    if (nilai == "0"){
                        alert('Simpan STS Gagal');                        
                    }else{                        
                        alert('Simpan STS Berhasil');
                        kosong();
                        $('#dg').datagrid('reload');
                    }								
			},dataType: 'json'
		  });				
	});            		        		
	}
	
	
	
    function back(){       
        window.open('home','self');
    }
	
	//ini buat kombo box skpd
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
	
	//ini function buat combo box kegiatan
	$(function(){		
		$('#cmb_giat').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_kegiatan',
			idField: 'kd_kegiatan',
			panelWidth:400,
			textField:'kd_kegiatan',
			mode:'remote',
			
			columns:[[
			{field:'kd_kegiatan',title:'Kode',width:70},
			{field:'nm_kegiatan',title:'Nama Kegiatan',width:300}
			]],
			onSelect:function(rowIndex,rowData){
                kd_kegiatan = rowData.kd_kegiatan;
                $("#nm_kegiatan").attr("value",rowData.nm_kegiatan.toUpperCase());
                $("#cmb_giat").attr("value",rowData.kd_kegiatan);      
            }
		})	
	})
	
	//ini function buat kosongin textbox
 	function kosong(){
    $("#no_kas").attr("value",'');    
    $("#tgl_kas").datebox('setValue',''); 
    $("#cmb_skpd").combogrid("setValue",'');
    $("#nama_skpd").attr("value",'');
    $("#no_bukti").attr("value",'');
    $("#tgl_bukti").datebox('setValue',''); 
    $("#uraian").attr("value",'');
    $("#jns_transaksi").attr("value",'PENDAPATAN');
	$("#cmb_giat").combogrid("setValue",'');
	$("#cmb_rekening").combogrid("setValue",'');
	$("#rupiah").attr("value",'');
	$("#nm_kegiatan").attr("value",'');
	$("#nm_rek4").attr("value",'');
  }
		
	//ini buat combo box rekening
	$(function(){	
		$('#cmb_rekening').combogrid({
			url:'<?php echo site_url();?>/realisasi_pendapatan/ambil_rek5',
			idField: 'kd_rek5',
			panelWidth:400,
			textField:'kd_rek5',
			mode:'remote',
			
			columns:[[
			{field:'kd_rek5',title:'Kode Rekening',width:70},
			{field:'nm_rek5',title:'Nama Rekenig',width:300}
			]],
			onSelect:function(rowIndex,rowData){
                kd_rek5 = rowData.kd_rek5;
                $("#nm_rek4").attr("value",rowData.nm_rek5.toUpperCase());
                $("#cmb_rekening").attr("value",rowData.kd_rek5);      
            }
		})	
	})

	//ini fungsi buat cari data
	function cari(){
  // alert('testtt');
   
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').datagrid({
		url: '<?php echo base_url(); ?>/index.php/master/load_sts',
        queryParams:({cari:kriteria})
        });        
     });
    }
	
	 //ini buat function tambah
	 function tambah(){
        lcstatus = 'tambah';
		tabbar.setTabActive("a1");
        kosong();
        //document.form_sts.no_kas.focus();
        } 

 //ini buat function edit
	 //function edit(){
	   //var dg = $('#dg').datagrid('getSelected');       
	   //alert(dg.cnobukti);
      //  lcstatus = 'edit';
	//	tabbar.setTabActive("a1");
      //  document.form_sts.no_kas.focus();
       // get();
       // } 
		

		
	function hapus(){
//alert('hey');
	var a=confirm("Apakah Data Akan Dihapus..?");
if (a==true){	
    var cno_kas = document.getElementById('no_kas').value;
    var urll = '<?php echo site_url(); ?>/realisasi_pendapatan/hapus_sts';
	
    $(document).ready(function(){
       $.post(urll,({tabel:'trdkasin_pkd',cnid:cno_kas}),
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

function tanggal(date){
	var x = new Date();   
	var y = x.getFullYear();
	var m = x.getMonth()+1;
	var d = x.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);		
    }


</script>

<style>
	.oval_big1 {
		width: 935px;
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

<h2 style="margin:-140px 5px 25px 250px;">SURAT TANDA SETORAN - LRA</h2>

<div id="a_tabbar"  class="oval_big1" style="background-color: #FFF;">
<div id="C1" style="background-color: #B3D9F0;">
<!---B3D9F0-->
	<br />
    <form id="form_sts">
    	<table>
		
			 <tr>
            	<td style="padding-left:15px;"><strong>No. SSPD</strong></td>
                <td><input type="text" name="no_kas" id="no_kas" size="45" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
    		</tr>
			
             <tr>
              	<td style="padding-left:15px;"><strong>Tanggal Kas</strong></td>
                <td><input type="text" id="tgl_kas" name="tgl_kas" size="20" maxlength="2" class="easyui-datebox textbox" data-options="showSeconds:false, formatter:tanggal"/></td>                
            </tr>
			
            <tr>
              	<td width="170" style="padding-left:15px;">SKPD</td>
                 <td> <input type="text" id="cmb_skpd" name="cmb_skpd"/>	
				<input type="text" id="nama_skpd" name="nama_skpd" style="width:450px;"/></td>
             </tr>
			 
			 <tr>
              	<td style="padding-left:15px;"><strong>No. Bukti</strong></td>
                <td><input type="text" name="no_bukti" id="no_bukti" size="45" /></td>
            </tr>
			 
			 <tr>
              	<td style="padding-left:15px;"><strong>Tanggal Bukti</strong></td>                
                <td><input type="text" id="tgl_bukti" name="tgl_bukti" size="20" maxlength="2" class="easyui-datebox textbox" data-options="showSeconds:true, formatter:tanggal"/></td>                
            </tr>
		
            <tr>
            	<td style="padding-left:15px;"><strong>Uraian</strong></td>
                <td><input type="text" name="uraian" id="uraian" style="width:580px; text-transform:uppercase; background-color: #FFCC99;" /></td>
    		</tr>
			
            <tr>
              	<td style="padding-left:15px;"><strong>Jenis Transaksi</strong></td>
                <td><input type="text" value="PENDAPATAN" name="jns_transaksi" id="jns_transaksi" size="45" style="background-color:#FFFFCC;" disabled/></td>
            </tr>
			
              <tr>
              	<td width="170" style="padding-left:15px;">Kegiatan</td>
                 <td> <input type="text" id="cmb_giat" name="cmb_giat"/>	
				<input type="text" id="nm_kegiatan" name="nm_kegiatan" style="width:450px;"/></td>
             </tr>
			 <tr>
              	<td width="170" style="padding-left:15px;">Rekening</td>
                 <td> <input type="text" id="cmb_rekening" name="cmb_rekening"/>	
				<input type="text" id="nm_rek4" name="nm_rek4" style="width:450px;"/></td>
             </tr>
			 
			  <tr>
            	<td style="padding-left:15px;"><strong>Rupiah</strong></td>
                <td><input type="text" name="rupiah" id="rupiah" size="45" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
    		</tr>             
			<tr>
				<td style="padding-left:15px;"></td>
				<td style="padding-left:15px;"><input type="submit" value="Simpan" onclick="kirim()" name="tambah" style="padding-left:20px; padding-right:20px" /></td>                
			</tr>
       </table>   
    </form>
</div>
</div>

<div id="C2">
          <div style="padding:0 2px 10px 0px;">
            <div id="gridContent" height="480px"></div>
            <div id="pagingArea" width="350px" style="background-color: white;"></div>
          </div>

<table style="width:100%;" border="0">
        <tr style="border-style:hidden;">
        <td width="8%" style="border-style:hidden;">
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah()">Tambah</a>
		<a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();">Hapus</a>        
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari" style="width:300px;"/></td>
        </tr>
</table>
          
		  <div id="container">
            <table id="dg"></table>
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
       tabbar.addTab("a2", "Listing Data", "300px");
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
</div>