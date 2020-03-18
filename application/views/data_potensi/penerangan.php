<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
    <script src="<?php echo base_url(); ?>/assets/dhtmlx.js" type="text/javascript"></script>
    <!-- dhtmlx.css contains styles definitions for all use components -->
    <link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>/assets/dhtmlx.css" />

<!-- Combo -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.css" />
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/dhtmlxcombo.js"></script>
<script  src="<?php echo base_url(); ?>/assets/codebase_combo/ext/dhtmlxcombo_group.js"></script>
<!-- end of combo -->

<script src="<?php echo base_url(); ?>/assets/codebase_ajax/dhtmlxcommon.js"></script>

<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>
</head>

<body bgcolor="#99CCFF">
<strong>DATA POTENSI PENERANGAN JALAN</strong>
<form action="javascript:void(0)" method="post" name="frm">
<table width="200" border="0">
  <tr>
    <td>Kecamatan</td>
    <td>:</td>
    <td colspan="2">
    <div id="kecamatan"></div>
</td>
  </tr>
  <tr>
    <td>Kelurahan</td>
    <td>:</td>
    <td colspan="2">
     <div id="kelurahan"></div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="PREVIEW" onclick="preview()" /></td>
    <td>    
    <input type="submit" name="excel" id="excel" value="EXPORT TO EXCEL" onclick="toExcel()" />
    </td>
  </tr>
</table>
</form>
</body>
<script language="javascript">
var dhx_globalImgPath="<?php echo base_url(); ?>/assets/codebase_combo/imgs/";

var z = new dhtmlXCombo("kecamatan", "kecamatan", 200);
z.enableFilteringMode(true);
z.loadXML("<?php echo base_url()."index.php/data_potensi/loadKec"; ?>");
z.attachEvent("onChange", getKelurahan);  
z.attachEvent("onKeyPressed", function(keyCode){		
		if(keyCode==46){			
			z.setComboValue('');			
		}
}); 

var z1 = new dhtmlXCombo("kelurahan", "kelurahan", 200);
function getKelurahan(){
	z1.loadXML("<?php echo base_url()."index.php/data_potensi/loadKel/"; ?>"+z.getSelectedValue());
}
z1.attachEvent("onKeyPressed", function(keyCode){		
		if(keyCode==46){			
			z1.setComboValue('');			
		}
}); 

	function preview() {	
		var kec = z.getSelectedValue();
		var kel = z1.getSelectedValue();	
		window.open(base_url+"index.php/data_potensi/potensi/penerangan/"+kec+"/"+kel,'width=500,height=400,scrollbars=1');
	}
	
	function toExcel(){
		var kec = z.getSelectedValue();
		var kel = z1.getSelectedValue();
		window.location = base_url+"index.php/data_potensi/toexcel/penerangan/"+kec+"/"+kel,'Report','width=500,height=400';
	}

</script>
