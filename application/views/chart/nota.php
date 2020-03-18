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
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Ketetapan Pajak - Nota Hitung',
                x: -20 //center
            },
            subtitle: {
                text: 'Tahun <?php echo $thn; ?>',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
					   series: [{
						name: 'Total Hotel',
						data: [<?php echo $hotel; ?>]
					}, {
						name: 'Total Restoran',
						data: [<?php echo $restoran; ?>]
					}, {
						name: 'Total Reklame',
						data: [<?php echo $reklame; ?>]
					}, {
						name: 'Total Hiburan',
						data: [<?php echo $hiburan; ?>]
					}, {
						name: 'Total Penerangan Jalan',
						data: [<?php echo $listrik; ?>]
					}, {
						name: 'Total Mineral Bukan Logam dan Batuan',
						data: [<?php echo $galian; ?>]
					}, {
						name: 'Total Parkir',
						data: [<?php echo $parkir; ?>]
					}, {
						name: 'Total Burung Walet',
						data: [<?php echo $walet; ?>]
					}, {
						name: 'Total Air Bawah Tanah',
						data: [<?php echo $air; ?>]
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