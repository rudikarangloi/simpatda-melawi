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
                text: 'Wajib Pajak Tingkat Kelurahan'
            },
			subtitle: {
                text: 'Tahun <?php echo date("Y"); ?> '
            },
            xAxis: {
                categories: [<?php echo $kec; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Wajib Pajak'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +'';
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [{
                name: 'Hotel',
                data: [<?php echo $HTL; ?>]
            }, {
                name: 'Restoran',
                data: [<?php echo $RES; ?>]
            }, {
                name: 'Hiburan',
                data: [<?php echo $HIB; ?>]
			}, {
                name: 'Reklame',
                data: [<?php echo $REK; ?>]
			}, {
                name: 'Penerangan Jalan',
                data: [<?php echo $LIS; ?>]
			}, {
                name: 'Mineral Bukan Logam dan Batuan',
                data: [<?php echo $GAL; ?>]
			}, {
                name: 'Burung Walet',
                data: [<?php echo $WLT; ?>]
			}, {
                name: 'Parkir',
                data: [<?php echo $PKR; ?>]
			}, {
                name: 'Air Tanah',
                data: [<?php echo $AIR; ?>]
            }]
        });
    });

	
	</script>
<body>
<div style="height:100%; overflow:auto;">
<center>
	<div id="container" class="oval_big2" style="width: 1370px; height: 3580px; border:1px solid #CCCCCC;"></div>
</div>
</center>
</body>
</html>

