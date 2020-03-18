<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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

<!-- chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/modules/exporting.js"></script>

<script>
	function tes(){
		document.frm.action = "<?php echo base_url(); ?>index.php/proyeksi_realisasi/view";
		document.frm.target = "tmpLoad";
		document.frm.submit();	
	}
</script>
</head>

<body bgcolor="#99CCFF">
<form action="javascript:void(0)" method="post" name="frm">
	<fieldset>
    	Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;     
    	<select name="tahun" id="tahun" onchange="" style="width:100px;">
                <option value="" selected="selected"></option>
                <?php echo $tahun; ?>
		</select>
        <input type="button" id="lihat" value="LIHAT" onclick="tes();loadPR()" />
        <input type="hidden" id="hiddentahun" name="hiddentahun" />
    </fieldset>
</form>
<br />

<iframe id="tmpLoad" name="tmpLoad" width="100%" height="700px"></iframe>
<!--<div align="center">
<fieldset>
<div id="gridP" style="height:220px;width:900px" align="left"></div>
<br />
<div id="chartPR" style="width:1000px;"></div>
</fieldset>
</div>-->

</body>
<script language="javascript">

	
	gridP= new dhtmlXGridObject('gridP');
	gridP.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridP.setHeader("JENIS PAJAK,PROYEKSI,REALISASI",null,["text-align:center","text-align:center","text-align:center"]);
	gridP.setInitWidths("300,250,250");
	gridP.setColAlign("left,right,right");
	gridP.setColTypes("ro,edn,edn");
	gridP.setNumberFormat("0,000.00", 1, ",",".");
	gridP.setNumberFormat("0,000.00", 2, ",",".");
	gridP.setSkin("dhx_skyblue");
	gridP.init();
	
	function getTahun(){
		var tahun = document.frm.tahun.value;
		return tahun;
	}
	
	
	
	function loadPR(){
		gridP.clearAll()
		
		//add pajak hotel
		<?php 
		$thn = '<script language="javascript">';
		$thn .= 'document.write(2012);';
		$thn .= '</script>';
		$q = $this->db->query("SELECT sum(setoran) as jmlSetoran FROM sspd WHERE tahun_pajak='".$thn."' AND kode_pajak = 'HTL'")->row(); 
		?>
		
		gridP.addRow(1,['HOTEL','50000000','<?php echo $q->jmlSetoran; ?>'],1); 
		
		//add pajak restoran
		gridP.addRow(2,['RESTORAN','50000000','45000000'],2);
		
		//add pajak reklame
		gridP.addRow(3,['REKLAME','50000000','45000000'],3);
		
		//add pajak hiburan
		gridP.addRow(4,['HIBURAN','50000000','45000000'],4);
		
		//add pajak Mineral bukan logam dan batuan
		gridP.addRow(5,['MINERAL BUKAN LOGAM DAN BATUAN','50000000','45000000'],5);
		
		//add pajak penerangan
		gridP.addRow(6,['PENERANGAN','50000000','45000000'],6);
		
		//add pajak walet
		gridP.addRow(7,['WALET','50000000','45000000'],7);
		
		//add pajak parkir
		gridP.addRow(8,['PARKIR','50000000','45000000'],8);
		
		//add pajak air bawah tanah
		gridP.addRow(9,['AIR BAWAH TANAH','50000000','45000000'],9);
														
		chartPR();
	}
	
function chartPR(){
var tahun = document.frm.tahun.value;
 
var ket1 = gridP.cells(1,0).getValue();
var ket2 = gridP.cells(2,0).getValue();
var ket3 = gridP.cells(3,0).getValue();
var ket4 = gridP.cells(4,0).getValue();
var ket5 = gridP.cells(5,0).getValue();
var ket6 = gridP.cells(6,0).getValue();
var ket7 = gridP.cells(7,0).getValue();
var ket8 = gridP.cells(8,0).getValue();
var ket9 = gridP.cells(9,0).getValue();

var p1 = parseInt(gridP.cells(1,1).getValue());
var p2 = parseInt(gridP.cells(2,1).getValue());
var p3 = parseInt(gridP.cells(3,1).getValue());
var p4 = parseInt(gridP.cells(4,1).getValue());
var p5 = parseInt(gridP.cells(5,1).getValue());
var p6 = parseInt(gridP.cells(6,1).getValue());
var p7 = parseInt(gridP.cells(7,1).getValue());
var p8 = parseInt(gridP.cells(8,1).getValue());
var p9 = parseInt(gridP.cells(9,1).getValue());

var r1 = parseInt(gridP.cells(1,2).getValue());
var r2 = parseInt(gridP.cells(2,2).getValue());
var r3 = parseInt(gridP.cells(3,2).getValue());
var r4 = parseInt(gridP.cells(4,2).getValue());
var r5 = parseInt(gridP.cells(5,2).getValue());
var r6 = parseInt(gridP.cells(6,2).getValue());
var r7 = parseInt(gridP.cells(7,2).getValue());
var r8 = parseInt(gridP.cells(8,2).getValue());
var r9 = parseInt(gridP.cells(9,2).getValue());

//	$(function () {	
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chartPR',
                type: 'column'
            },
            title: {
                text: 'PROYEKSI & REALISASI'
            },
            subtitle: {
                text: 'TAHUN '+tahun
            },
            xAxis: {			
				categories: [ket1, ket2, ket3, ket4, ket5, ket6, ket7, ket8, ket9],
                title: {
                    text: '',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
                
            },
            yAxis: {
                min:0,
                title: {
                    text: "TOTAL"
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +'';
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
                 backgroundColor: '#FFFFFF',
                reversed: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Proyeksi',
                data: [
				    p1
				,p2
				,p3
				,p4
				,p5
				,p6
				,p7
				,p8
				,p9
				]
            },{
                name: 'Realisasi',
                data: [
				    r1
				,r2
				,r3
				,r4
				,r5
				,r6
				,r7
				,r8
				,r9
				]
            }]
        });
    });   
}	



function tahunChange(){        
        var id = document.frm.tahun.value();
        var poststr =
            'tahunnya=' + id;
	dhtmlxAjax.post(BASE_URL+"index.php/proyeksi_realisasi/returntahun", encodeURI(poststr), outputSJ);
    }

    function outputSJ(loader) {
     	window.parent.progressOff();
        result = loader.xmlDoc.responseText;
        if(result) {
            var resultFormat = number_format(result);
            document.frmData.hiddentahun.value = resultFormat;	                
        }
        else
        {
            alert("Ada kesalahan dalam pemrosesan data");
        }
		
</script>
</html>
