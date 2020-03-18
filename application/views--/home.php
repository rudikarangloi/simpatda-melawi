<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>
<!-- Menu -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_menu/skins/dhtmlxmenu_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_menu/dhtmlxmenu.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_menu/ext/dhtmlxmenu_ext.js"></script>
<!-- toolbar -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>
<link href="<?php echo base_url(); ?>css/style_doc.css" rel="stylesheet" type="text/css" />

<!-- chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/modules/exporting.js"></script>

<!-- Modal -->
<link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>

<!--<script type="text/javascript">
		// CUSTOMER PENGGUNA PRODUK
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'column'
					},
					title: {
						text: 'Pendaftaran Registrasi, Pemilik dan Perusahaan1'
					},
					subtitle: {
						text: 'Bulan <?php echo $bulan; ?> - <?php echo $thn; ?>',
					},
					xAxis: {
						categories: [<?php echo $tgl; ?>]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Jumlah Pendaftaran'
						}
					},
					legend: {
						layout: 'vertical',
						backgroundColor: '#FFFFFF',
						align: 'left',
						verticalAlign: 'top',
						x: 100,
						y: 70,
						floating: true,
						shadow: true
					},
					tooltip: {
						formatter: function() {
							return ''+
								this.y +' Orang';
						}
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						}
					},
					   series: [{
						name: 'Total Registrasi',
						data: [<?php echo $register; ?>]
					}, {
						name: 'Total Pemilik',
						data: [<?php echo $pemilik; ?>]
					}, {
						name: 'Total Perusahaan',
						data: [<?php echo $perusahaan; ?>]				
			}]
        });
    });
</script>-->

 <script language="javascript">		
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
	}
	
	function statusEnding() {
		ModalPopups.Close("idIndicator2");
	}		
	

</script>
    <style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0px;
			padding: 0px;
			overflow: hidden;
		}
		
		.tag {
			padding: 15px;
			padding-top: 40px;
			<!--.width: 2000px;-->
		}
		
		.content {
			margin-left: 340px;
			margin-top: -245px;
			padding-top: 30px;
			<!--.width: 150px;-->			
		}
	</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SIMPADA MELAWI :.</title>
</head>
<!--#BAE4E5-->
<body onload="" > <!--mengubah background luar-->
<form id="frmhome" name="frmhome" method="post" action="javascript:void(0);">
  <input type="hidden" name="idmenu" id="idmenu" />
</form>
<!--<div id="info" style="background-color: #FFF; height:100%;">-->
<!--<div id="info" style="background-color: #0C9BCF; height:100%;">-->
<div id="info" style="background-image: -webkit-linear-gradient(bottom, #FFA500 0%, #FFA500 100%); 
background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #FFFFA0), color-stop(1, #FFA500));
background-image: -moz-linear-gradient(bottom, #FFFFA0 0%, #FFA500 100%);
height: 100%;">

	<div class="tag">
    	<center><img src="<?php echo base_url();?>images/Logo melawi.png" width="1200" height="135" /></center>
        <h3 align="center"><b>Selamat Datang<br /><?php echo $username;?></b></h3>
    </div>
    
    <div class="content">
    	<div id="container" class="oval_big2" style=" height: 555px; border:0px solid #CCCCCC;">
		
		
				<table border="0">
  <tr >
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	
    <!--<td width="800" valign="top" align="center">
    <a href="<?php echo base_url();?>index.php/home/registrasi">
            <img src="<?php echo base_url();?>images/slide_img/3.png" width="100" height="86" alt=""/>
    </a>
    </td>-->
	
    <td width="100" valign="top" align="center">
     <a <?php
	$hotel = strpos($list_pajak, "1");	
	$restoran = strpos($list_pajak, "2");	
	$hiburan = strpos($list_pajak, "3");
	$parkir = strpos($list_pajak, "7");
	
	if($hotel > 0){
	
	?>href="<?php echo base_url();?>index.php/hotel/index"<?php } ?>>
            <img src="<?php echo base_url();?>images/slide_img/htl2.png" width="100" height="86" alt=""/>
     </a>
    </td>
    <td width="100" valign="top" align="center">
		<a <?php
	
	if($restoran > 0){
	?>href="<?php echo base_url();?>index.php/restoran/index"<?php } ?>>
            <img src="<?php echo base_url();?>images/slide_img/res.png" width="100" height="86" alt=""/>
        </a>
    </td>
	
	
    <td width="100" valign="top" align="center">
        <a <?php
	if($hiburan > 0){
	?>href="<?php echo base_url();?>index.php/sptpd_hiburan/index"<?php }?>>
            <img src="<?php echo base_url();?>images/slide_img/hib.png" width="100" height="86" alt=""/>
    </a>
    </td>
	
	<td width="100" valign="top" align="center">
     <a <?php
	if($parkir > 0){
	?>href="<?php echo base_url();?>index.php/sptpd_parkir/index"<?php }?>>
     <img src="<?php echo base_url();?>images/slide_img/pkr2.png" width="100" height="86" alt=""/>
    </a>      
    </td>
  </tr>
  
  <tr >
    <!--<td width="250" valign="top" align="center">R E G I S T E R A S I
    </td>-->
	
    <td width="200" valign="top" align="center"><b>PENDATAAN<br>PAJAK  HOTEL</b> 
    </td>
    <td width="200" valign="top" align="center"><b>PENDATAAN<br>PAJAK  RESTORAN</b> 
    </td>
    <td width="200" valign="top" align="center"><b>PENDATAAN<br>PAJAK  HIBURAN</b>
    </td>
	<td width="200" valign="top" align="center"><b>PENDATAAN<br>PAJAK  PARKIR</b>
	</td>
	<!--<td width="200" valign="top" align="center"><b>PENDATAAN<br>PAJAK  AIR TANAH</b>
	</td>-->
  </tr>
  
</table>
		
		
		</div>
        <!--<center><img src="<?//php echo base_url(); ?>images/sopd.png" width="900" height="200" /></center>-->
    </div>
</div>
<div id="my_logo" style="height: 74px; display:none;"><div style="background-color:#FFF; width:100%; height:auto;">
        Selamat Datang, <?=$username?>&nbsp;
        |&nbsp;<a href="#">Change Password</a> 
| <a href="<?php echo site_url()."/home/logout" ?>" onclick="return confirm('Apakah anda yakin ingin melakukan logout ?')">Logout</a></div></div>
<script>
	statusLoading();
		var base_url = "<?php echo base_url(); ?>";
		var pengguna = "<?php echo $this->session->userdata('username'); ?>";
		var dhxLayoutData = {
			parent: document.body,
			pattern: "1C",
			skin: "dhx_skyblue",
			cells: [{
				 id: "a",
            	text: "Navigation",
				header: false,
				fix_size: [true, null]
			}]
        };
		
		var dhxLayout = new dhtmlXLayoutObject(dhxLayoutData);
		//dhxLayout.attachHeader("my_logo");
        //dhxLayout.cells("b").attachURL("http://www.inprasegroup.co.id/index.php");
		//dhxLayout.cells("a").attachObject("info");
		dhxTabbar = dhxLayout.cells("a").attachTabbar();
		dhxTabbar.setSkin('dhx_skyblue');
		dhxTabbar.setImagePath(base_url+"assets/codebase_tabbar/imgs/");
		dhxTabbar.enableTabCloseButton(true);
		dhxTabbar.addTab("a1", "Home", "100px");
		dhxTabbar.setTabActive("a1");
		dhxTabbar.enableAutoReSize(false);
		dhxTabbar.setContent("a1", "info");
		dhxTabbar.setHrefMode("iframes-on-demand");
		statusBar = dhxLayout.attachStatusBar();
   		//statusBar.setText("PT. Murfa Surya Mahardika copyright &copy; 2012");
		
		dhxMenu = dhxLayout.attachMenu();
		//dhxMenu = new dhtmlXMenuObject("menuObj");
		dhxMenu.setIconsPath("<?php echo base_url(); ?>/assets/codebase_menu/common/imgs/");
		dhxMenu.loadXML("<?php echo base_url(); ?>index.php/home/mainMenu/<?php echo $this->session->userdata('id_modul'); ?>", function(){ statusEnding(); });
		
		dhxMenu.attachEvent("onClick", function(id) {
			var arr = id.split("|");
			document.frmhome.idmenu.value =  arr[0];
			var randomnumber=Math.floor((Math.random()*1000)+1);
			var text = dhxMenu.getItemText(id);
			var textLength = text.length;
			if(parseInt(textLength) >= 12) {  
				var panjang = parseInt(textLength) * 9;
			} else {
				var panjang = 100;
			}
			dhxTabbar.addTab(randomnumber,text, panjang+"px");
			dhxTabbar.setTabActive(randomnumber);
			dhxTabbar.enableTabCloseButton(true);
			dhxTabbar.setContentHref(randomnumber,"<?php echo base_url(); ?>index.php/"+arr[1]);
		});  	
		
		
		function createTab(text,url) {
			var randomnumber=Math.floor((Math.random()*1000)+1);
			var textLength = text.length;
			if(parseInt(textLength) >= 12) {  
				var panjang = parseInt(textLength) * 9;
			} else {
				var panjang = 100;
			}
			dhxTabbar.addTab(randomnumber,text, panjang+"px");
			dhxTabbar.setTabActive(randomnumber);
			dhxTabbar.enableTabCloseButton(true);
			dhxTabbar.setContentHref(randomnumber,"<?php echo base_url(); ?>index.php/"+url);	
		}
		
		
		function goHome() {
			window.location = base_url; 
		}

	</script>
</body>
</html>