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

//function data(){
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'bar'
            },
            title: {
                text: 'Realisasi Pajak Daerah'
            },
            subtitle: {
                text: 'Tahun <?php echo $tahun; ?>'
            },
            xAxis: {
                categories: [<?php echo $thn; ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rupiah',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' Rupiah';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
            	name: 'Total SPTPD Hotel',
				data: [<?php echo $hotel; ?>]
			}, {
				name: 'Total SPTPD Restoran',
				data: [<?php echo $restoran; ?>]
			}, {
				name: 'Total SPTPD Reklame',
				data: [<?php echo $reklame; ?>]
			}, {
				name: 'Total SPTPD Penerangan Jalan',
				data: [<?php echo $listrik; ?>]
			}, {
				name: 'Total SPTPD Mineral Bukan Logam & Batuan',
				data: [<?php echo $galian; ?>]
			}, {
				name: 'Total SPTPD Hiburan',
				data: [<?php echo $hiburan; ?>]
			}, {
				name: 'Total SPTPD Parkir',
				data: [<?php echo $parkir; ?>]
			}, {
				name: 'Total SPTPD Air Bawah Tanah',
				data: [<?php echo $air; ?>]
			}, {
				name: 'Total SPTPD Burung Walet',
				data: [<?php echo $walet; ?>]
			}]
        });
    });

	
	</script>
<body>
<div style="height:100%; overflow:auto;">
<center>
<h2>Realisasi Pajak Daerah Tahun <?php echo $tahun; ?> </h2>

	<div id="container" class="oval_big2" style="width: 1370px; height: 480px; border:1px solid #CCCCCC;"></div>
</div>
</center>
</body>
</html>

