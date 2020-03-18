<!DOCTYPE HTML>
<html>
<head>
<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/modules/exporting.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
						text: 'Registrasi, Pendaftaran Pemilik dan Perusahaan'
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
-->
</script>
<body>
<div style="height:100%; overflow:auto;">
	<div id="container" class="oval_big2" style="width: 1370px; height: 580px; border:1px solid #CCCCCC;"></div>
</div>
</body>
</html>