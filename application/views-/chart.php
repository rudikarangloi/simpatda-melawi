<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- Menu -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_menu/skins/dhtmlxmenu_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_menu/dhtmlxmenu.js"></script>

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

<script type="text/javascript">
		// CUSTOMER PENGGUNA PRODUK
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'column'
					},
					title: {
						text: 'Pendaftaran Registrasi, Pemilik dan Perusahaan'
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
			padding-top: 30px;
			width: 150px;
		}
		
		.content {
			margin-left: 200px;
			margin-top: -230px;
			width:auto;			
		}
	</style>
    
	<div class="tag">
    	<center><img src="<?php echo base_url();?>images/Logo melawi.png" width="" height="123" /></center>
        <p align="center">Selamat Datang<br /><?php echo $username;?></p>
    </div>
    
    <div class="content">
    	<div id="container" class="oval_big2" style="width: 1150px; height: 585px; border:1px solid #CCCCCC;"></div>
    </div>
