
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


<!-- Toolbar -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/codebase_toolbar/dhtmlxcommon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/codebase_toolbar/dhtmlxtoolbar.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css"></link>
<!-- end of toolbar -->

<!-- chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chart/js/modules/exporting.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
<script src="<?php echo base_url(); ?>assets/rumus.js" type="text/javascript"></script>
<body style="background-color: #B3D9F0">

<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;margin:0 6px"  src="http://cdn.printfriendly.com/pf-print-icon.gif" width="16" height="15" alt="Print Friendly Version of this page" />Print <img style="border:none;margin:0 6px"  src="http://cdn.printfriendly.com/pf-pdf-icon.gif" width="12" height="12" alt="Get a PDF version of this webpage" />PDF</a>

<form name="frmAns" method="post" action="javascript:void(0);">

<fieldset><legend>Data Perhitungan</legend>
<table width="900" border="0">
  <tr>
    <td width="189">Jenis Pajak</td>
    <td width="565" colspan="4"><select name="cmbJenisPajak" id="cmbJenisPajak" onChange="tampil_pilihan(this.value);">
          <option value="P0"></option>
          <option value="X1">.:: DEMO DATA::. </option>
          <option value="P1">Hotel </option>
          <option value="P2">Restoran</option>
          <option value="P3">Reklame</option>
          <option value="P4">Hiburan</option>
          <option value="P5">Penerangan Jalan</option>
          <option value="P6">Mineral Bukan Logam dan Batuan</option>
          <option value="P7">Burung Walet</option>
          <option value="P8">Parkir</option>
          <option value="P9">Air Bawah Tanah</option>
      </select>
      
      <!--<input name="button" type="button" id="button" value="CARI" onclick="opens();" />
      <input type="button" name="button2" id="button2" value="OPEN DATA" onclick="openDataAnalisa();" />--></td>
  </tr>
  <tr>
  	<td colspan="5">
    	<div id="gridCo" style="height:150px;width:100%"></div>
    </td>
  </tr>  
  <tr>
  	<td width="50px"><input type="button" onClick="result()" value="HASIL" /></td>
  	<td><div id="wp"></div></td>
  	<td><div id="rata2"></div></td>    
	<td><div id="pad"></div></td>    
	<td><div id="persen"></div></td>    
  </tr>
  <tr>
 	<td>&nbsp;</td>
  	<td align="center"><div id="nilaiwp" align="center"></div></td>
  	<td align="center"><div id="nilairata2" align="center"></div></td>
	<td align="center"><div id="nilaipad" align="center"></div></td>    
	<td align="center"><div id="nilaipersen" align="center"></div></td>
  </tr>
</table>
</fieldset>
<!--<div id="a_tabbar" style="width:100%; height:400px;"></div>
<div style="width:100%; height:30px; background-color:#FFCC99">
  <span style="padding-left:15px;">
  <input type="button" value="Baru" onclick="baru()" name="baru1" style="padding-left:20px; padding-right:20px"/>
  <input type="button" value="Simpan" onclick="simpan()" name="tambah" style="padding-left:20px; padding-right:20px"/>
  </span>
  <input type="button" value="Edit" onclick="ubah" name="edit1" style="padding-left:20px; padding-right:20px"/>
  <input type="button" value="Hapus" onclick="deleteData" name="delete1" style="padding-left:20px; padding-right:20px"/>
</div>-->
</form>
<!--<div id="objsBrg" style="display:none;">
<br />
<form name="frmSrc2" id="frmSrc2" method="post" action="javascript:void(0);">
<table width="790" border="0">
  	<tr>
		<td style="padding-left:15px;">Cari data berdasarkan 
      	<select name="fil" id="fil" >
        	<option value="1">NPWPD Perusahaan</option>
            <option value="2">Nama Perusahaan</option>
            <option value="3">Nama Pemilik</option>
        </select></td>
        <td><input type="text" name="values" id="values" size="35" style="text-transform:uppercase; background-color: #FFCC99;" /></td>
        <td><input type="button" onclick="lihat3()" name="filter3" value="Cari" style="padding-left:20px; padding-right:20px"/>&nbsp;
        <input type="button" onclick="batal()" name="can" value="Keluar" style="padding-left:20px; padding-right:20px"/></td>
	</tr>
</table>
</form>
<div style="padding:0 75px 0 15px;">
	<div id="gridCo" width="750px" height="270px" style="margin-bottom:10px;"></div>
    <div id="pagingArea" width="350px" style="background-color:white;"></div>
</div>
</div>-->
<!--<iframe id="tmpLoad" name="tmpLoad" width="500px" height="100px"></iframe>-->
<table border="0" cellpadding="10px">
<tr>
<td>
<div id="chartWP" style="width:500px;height:350px;"></div>
</td>
<td>
<div id="chartrata2" style="width:500px;height:350px;"></div>
</td>
</tr>

<tr>
<td>
<div id="chartpad" style="width:500px;height:350px;"></div>
</td>
<td>
<div id="chartpersen" style="width:500px;height:350px;"></div>
</td>
</tr>
</table>
</body>
<script language="javascript">
var base_url = "<?php echo base_url(); ?>";

	gridx= new dhtmlXGridObject('gridCo');
	gridx.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	gridx.setHeader("Keterangan,Wajib Pajak,Rata - Rata,Total Pad/Tahun,Persentase");
	gridx.setInitWidths("200,80,150,150,100");
	gridx.setColAlign("left,center,right,right,right");
	gridx.setColTypes("ro,ed,edn,edn,ed");
	gridx.setNumberFormat("0,000.00", 2, ",",".");
	gridx.setNumberFormat("0,000.00", 3, ",",".");
	gridx.setSkin("dhx_skyblue");
	gridx.attachEvent("onEditCell", editCell);	
	//gridx.attachEvent("onRowDblClicked", selectedOpenData2);
	gridx.init();
	
	function editCell(stage, rId, cId){
		if(stage=='2' && rId=='2' && cId=='4')
        { 
			// r2 c3 totalpad/tahun
			var r1c3 = gridx.cells(1,3).getValue();
			var r2c4 = gridx.cells(2,4).getValue();
			var r2c3 = r1c3*r2c4;
			gridx.cells(2,3).setValue(r2c3/100);
			
			// r3 c3 totalpad/tahun
			gridx.cells(3,3).setValue(r2c3/100);	
			
			// r4 c3 totalpad/tahun
			var r3c3 = 	gridx.cells(3,3).getValue();	
			gridx.cells(4,3).setValue(r3c3);			
			
			// r3 c2 rata2
			var r3c1 = gridx.cells(3,1).getValue();	
			var r3c2 = r3c3/12/r3c1;
			gridx.cells(3,2).setValue(r3c2);	
			
			//r3c4 persentase
			var r1c3 = gridx.cells(1,3).getValue();
			gridx.cells(3,4).setValue(r3c3/r1c3*100);
			
			//r4c1 wp
			var r4c3 = gridx.cells(4,3).getValue();
			var r4c2 = gridx.cells(4,2).getValue();
			var r4c1 = r4c3/12/r4c2;
			gridx.cells(4,1).setValue(r4c1);
			
			//r4c4 persentase
			gridx.cells(4,4).setValue(r4c3/r1c3*100);
			
		} else if(stage=='2' && rId=='5' && cId=='1' || cId=='2') {
			var r5c1 = gridx.cells(5,1).getValue();
			var r5c2 = gridx.cells(5,2).getValue();
			var r5c3 = r5c2*12*r5c1;
			gridx.cells(5,3).setValue(r5c3);
			
			// r5c4 persentase
			var r1c3 = gridx.cells(1,3).getValue();
			gridx.cells(5,4).setValue(r5c3/r1c3*100);
		}
		
		return true;
		
	}
	
	function tampil_pilihan(pajak){
		gridx.clearAll();
		

//		alert(pajak);
		gridx.addRow(1,['Current','','','',''],1);
		
		if(pajak=='P1'){ // hotel
			<?php
				$P1 = $this->db->query("SELECT koderec FROM mp_hotel GROUP BY koderec")->result();
				$P1S = count($P1);
				$rataP1 = $this->db->query("SELECT AVG(potensi) as omset FROM mp_hotel_detail GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php echo $P1S; ?>");
			gridx.cells(1,2).setValue('<?php echo $rataP1->omset*10/100; ?>');
			gridx.cells(1,4).setValue('100');
		} 
		else if(pajak=='P2'){ // restoran
			<?php
				$P2 = $this->db->query("SELECT koderec FROM mp_restoran GROUP BY koderec")->result();
				$P2S = count($P2);
				$rataP2 = $this->db->query("SELECT AVG(rata2omset) as omset FROM mp_restoran GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P2S)): echo $P2S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP2->omset)): echo $rataP2->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P3'){ //reklame
			<?php
				$P3 = $this->db->query("SELECT koderec FROM mp_reklame GROUP BY koderec")->result();
				$P3S = count($P3);
				$rataP3 = $this->db->query("SELECT AVG(rata2_omset) as omset FROM mp_reklame GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P3S)): echo $P3S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP3->omset)): echo $rataP3->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P4'){ //hiburan
			<?php
				$P4 = $this->db->query("SELECT koderec FROM mp_hiburan GROUP BY koderec")->result();
				$P4S = count($P4);
				$rataP4 = $this->db->query("SELECT AVG(rata2omset) as omset FROM mp_hiburan GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P4S)): echo $P4S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP4->omset)): echo $rataP4->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P5'){ //penerangan jalan
			<?php
				$P5 = $this->db->query("SELECT koderec FROM mp_penerangan GROUP BY koderec")->result();
				$P5S = count($P5);
				$rataP5 = $this->db->query("SELECT AVG(rata2_omset) as omset FROM mp_penerangan GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P5S)): echo $P5S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP5->omset)): echo $rataP5->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P6'){ //mineral bukan logam
			<?php
				$P6 = $this->db->query("SELECT koderec FROM mp_mineral GROUP BY koderec")->result();
				$P6S = count($P6);
				$rataP6 = $this->db->query("SELECT AVG(rata2omset) as omset FROM mp_mineral GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P6S)): echo $P6S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP6->omset)): echo $rataP6->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P7'){ //burung walet
			<?php
				$P7 = $this->db->query("SELECT koderec FROM mp_walet GROUP BY koderec")->result();
				$P7S = count($P7);
				$rataP7 = $this->db->query("SELECT AVG(rata2omset) as omset FROM mp_walet GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P7S)): echo $P7S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP7->omset)): echo $rataP7->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P8'){ //parkir
			<?php
				$P8 = $this->db->query("SELECT koderec FROM mp_parkir GROUP BY koderec")->result();
				$P8S = count($P8);
				$rataP8 = $this->db->query("SELECT AVG(rata2omzet) as omset FROM mp_parkir GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P8S)): echo $P8S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP8->omset)): echo $rataP8->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else if(pajak=='P9'){ //air bawah tanah
			<?php
				$P9 = $this->db->query("SELECT koderec FROM mp_airtanah GROUP BY koderec")->result();
				$P9S = count($P9);
				$rataP9 = $this->db->query("SELECT AVG(rata2pemakaian) as omset FROM mp_airtanah GROUP BY koderec")->row();				
			?>
			gridx.cells(1,1).setValue("<?php if(isset($P9S)): echo $P9S; endif; ?>");
			gridx.cells(1,2).setValue("<?php if(isset($rataP9->omset)): echo $rataP9->omset*10/100; endif; ?>");
			gridx.cells(1,4).setValue('100');
		}
		else {
			gridx.cells(1,1).setValue('10');
			gridx.cells(1,2).setValue('1000000');
			gridx.cells(1,4).setValue('100');
		}	


		var wp = gridx.cells(1,1).getValue();
		var rata = gridx.cells(1,2).getValue();
		var total_pad_cur = gridx.cells(1,1).getValue()*gridx.cells(1,2).getValue()*12;
		gridx.cells(1,3).setValue(total_pad_cur);
		var persen = gridx.cells(1,4).getValue();
		
		gridx.addRow(2,['Peningkatan Pad dalam setahun','','','',''],2);
		gridx.cells(2,1).setValue(wp);
		gridx.cells(2,2).setValue(rata);
		gridx.cells(2,3).setValue(total_pad_cur);
		gridx.cells(2,4).setValue(persen);
		
		gridx.addRow(3,['Peningkatan Rata Rata','','','',''],3);
		gridx.cells(3,1).setValue(wp);
		gridx.cells(3,2).setValue(rata);
		gridx.cells(3,3).setValue(total_pad_cur);
		gridx.cells(3,4).setValue(persen);
		
		gridx.addRow(4,['Peningkatan WP','','','',''],4);
		gridx.cells(4,1).setValue(wp);
		gridx.cells(4,2).setValue(rata);
		gridx.cells(4,3).setValue(total_pad_cur);
		gridx.cells(4,4).setValue(persen);
		
		gridx.addRow(5,['Penigkatan Customize','','','',''],5);	
		gridx.cells(5,1).setValue(wp);
		gridx.cells(5,2).setValue(rata);
		gridx.cells(5,3).setValue(total_pad_cur);
		gridx.cells(5,4).setValue(persen);
		
		gridx.cells(2,4).setBgColor('yellow');
		gridx.cells(5,1).setBgColor('yellow');
		gridx.cells(5,2).setBgColor('yellow');
		
		//gridx.addRow(6,['','','','',''],6);
//		gridx.addRow(7,['','Penurunan WP','peningkatan','',''],7); //kata-katanya
//		gridx.addRow(8,['','5','10','',''],8);
	}
	
	function result(){
		var r5c1 = gridx.cells(5,1).getValue();
		var r1c1 = gridx.cells(1,1).getValue();
		var nilaiwp = r5c1-r1c1;
		
		document.getElementById('nilaiwp').innerHTML = nilaiwp;
		if(nilaiwp > 0){
			document.getElementById('wp').innerHTML = "Peningkatan WP";
		} else {
			document.getElementById('wp').innerHTML = "Penurunan WP";
		}
		
		var r5c2 = gridx.cells(5,2).getValue();
		var r1c2 = gridx.cells(1,2).getValue();
		var nilairata2 = r5c2-r1c2;
		
		document.getElementById('nilairata2').innerHTML = format_number(nilairata2);
		if(nilairata2 > 0){
			document.getElementById('rata2').innerHTML = "Peningkatan rata rata/bln pad";
		} else {
			document.getElementById('rata2').innerHTML = "Penurunan rata rata/bln pad";
		}
		
		var r5c3 = gridx.cells(5,3).getValue();
		var r1c3 = gridx.cells(1,3).getValue();
		var padtahun = r5c3-r1c3;
		
		document.getElementById('nilaipad').innerHTML = format_number(padtahun);
		if(padtahun > 0){
			document.getElementById('pad').innerHTML = "Peningkatan Total pad/tahun";
		} else {
			document.getElementById('pad').innerHTML = "Penurunan Total pad/tahun";
		}
		
		var r5c4 = gridx.cells(5,4).getValue();
		var r1c4 = gridx.cells(1,4).getValue();
		var persen = r5c4-r1c4;
		
		document.getElementById('nilaipersen').innerHTML = format_number(persen)+" %";
		if(persen > 0){
			document.getElementById('persen').innerHTML = "Peningkatan Total pad/tahun";
		} else {
			document.getElementById('persen').innerHTML = "Penurunan Total pad/tahun";
		}
		
		chartpersen();
		chartWP();
		rata2();
		pad();
		
	}

function chartWP(){
var ket1 = gridx.cells(1,0).getValue();
var ket2 = gridx.cells(2,0).getValue();
var ket3 = gridx.cells(3,0).getValue();
var ket4 = gridx.cells(4,0).getValue();
var ket5 = gridx.cells(5,0).getValue();

var wp1 = parseInt(gridx.cells(1,1).getValue());
var wp2 = parseInt(gridx.cells(2,1).getValue());
var wp3 = parseInt(gridx.cells(3,1).getValue());
var wp4 = parseInt(gridx.cells(4,1).getValue());
var wp5 = parseInt(gridx.cells(5,1).getValue());

//	$(function () {	
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chartWP',
                type: 'column'
            },
            title: {
                text: 'Analisa data Wajib Pajak'
            },
            subtitle: {
                text: ''
            },
            xAxis: {			
				categories: [ket1, ket2, ket3, ket4, ket5],
                title: {
                    text: 'Keterangan',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
                
            },
            yAxis: {
                min:0,
                title: {
                    text: null
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' wajib pajak';
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
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Wajib Pajak',
                data: [
				wp1
				,{y:wp2, color:'#FFFF33'}
				,{y:wp3, color:'#99FF33'}
				,{y:wp4, color:'#993399'}
				,{y:wp5, color:'#FF3333'}
				]
            }]
        });
    });   
}	




function rata2(){
var ket1 = gridx.cells(1,0).getValue();
var ket2 = gridx.cells(2,0).getValue();
var ket3 = gridx.cells(3,0).getValue();
var ket4 = gridx.cells(4,0).getValue();
var ket5 = gridx.cells(5,0).getValue();

var rt1 = parseInt(gridx.cells(1,2).getValue());
var rt2 = parseInt(gridx.cells(2,2).getValue());
var rt3 = parseInt(gridx.cells(3,2).getValue());
var rt4 = parseInt(gridx.cells(4,2).getValue());
var rt5 = parseInt(gridx.cells(5,2).getValue());



    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chartrata2',
                type: 'column'
            },
            title: {
                text: 'Analisa Data PAD Rata-Rata / Bulan'
            },
            subtitle: {
                text: ''
            },
            xAxis: {			
				categories: [ket1, ket2, ket3, ket4, ket5],
                title: {
                    text: 'Keterangan',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
                
            },
            yAxis: {
                min:0,
                title: {
                    text: null
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' juta';
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
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Rata - Rata',
                data: [
					rt1
				,{y:rt2, color:'#FFFF33'}
				,{y:rt3, color:'#99FF33'}
				,{y:rt4, color:'#993399'}
				,{y:rt5, color:'#FF3333'}
				]
            }]
        });
    });    
}	


function pad(){
var ket1 = gridx.cells(1,0).getValue();
var ket2 = gridx.cells(2,0).getValue();
var ket3 = gridx.cells(3,0).getValue();
var ket4 = gridx.cells(4,0).getValue();
var ket5 = gridx.cells(5,0).getValue();

var pad1 = parseInt(gridx.cells(1,3).getValue());
var pad2 = parseInt(gridx.cells(2,3).getValue());
var pad3= parseInt(gridx.cells(3,3).getValue());
var pad4= parseInt(gridx.cells(4,3).getValue());
var pad5= parseInt(gridx.cells(5,3).getValue());



    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chartpad',
                type: 'column'
            },
            title: {
                text: 'Analisa data PAD / Tahun'
            },
            subtitle: {
                text: ''
            },
            xAxis: {			
				categories: [ket1, ket2, ket3, ket4, ket5],
                title: {
                    text: 'Keterangan',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
                
            },
            yAxis: {
                min:0,
                title: {
                    text: null
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' juta';
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
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Total pad/tahun',
                data: [
					pad1
				,{y:pad2, color:'#FFFF33'}
				,{y:pad3, color:'#99FF33'}
				,{y:pad4, color:'#993399'}
				,{y:pad5, color:'#FF3333'}
				]
            }]
        });
    });    
}	


function chartpersen(){
var ket1 = gridx.cells(1,0).getValue();
var ket2 = gridx.cells(2,0).getValue();
var ket3 = gridx.cells(3,0).getValue();
var ket4 = gridx.cells(4,0).getValue();
var ket5 = gridx.cells(5,0).getValue();

var per1 = parseInt(gridx.cells(1,4).getValue());
var per2 = parseInt(gridx.cells(2,4).getValue());
var per3= parseInt(gridx.cells(3,4).getValue());
var per4= parseInt(gridx.cells(4,4).getValue());
var per5= parseInt(gridx.cells(5,4).getValue());

    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chartpersen',
                type: 'column'
            },
            title: {
                text: 'Analisa data Persentase'
            },
            subtitle: {
                text: ''
            },
            xAxis: {			
				categories: [ket1, ket2, ket3, ket4, ket5],
                title: {
                    text: 'Keterangan',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
                
            },
            yAxis: {
                min:0,
                title: {
                    text: null
                }
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ this.y +' %';
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
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Persentase',
                data: [
					per1
				,{y:per2, color:'#FFFF33'}
				,{y:per3, color:'#99FF33'}
				,{y:per4, color:'#993399'}
				,{y:per5, color:'#FF3333'}
				]
            }]
        });
    });    
}

</script>


