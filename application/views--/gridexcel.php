 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Demo</title>
	<link rel='STYLESHEET' type='text/css' href='<?php echo base_url();?>assets/codebase_grid/dhtmlxgrid.css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/codebase_grid/skins/dhtmlxgrid_dhx_blue.css">
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxcommon.js'></script>
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxgrid.js'></script>
	<script src='<?php echo base_url();?>assets/codebase_grid/dhtmlxgridcell.js'></script>
	
	
	<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
	
</head>

<body>
<input type="button" name="" value="Get as Excel" style="width:300px; font-weight:bold;" 
onclick="mygrid.toExcel('<?php echo base_url();?>assets/grid2excel/server/generate.php');"><br><br>
	
	<div id="gridbox" style="width:650px; height:350px"></div>
<script>
		mygrid = new dhtmlXGridObject('gridbox');
		mygrid.setImagePath("<?php echo base_url();?>javascript/codebase_excel/imgs/");
		mygrid.setHeader("Shop,#cspan,#cspan,#cspan,Delivery,#cspan");
		mygrid.attachHeader("Sales,Book,#cspan,Price,Is available,Date");
		mygrid.attachHeader("#rspan,Title,Author,#rspan,#rspan,#rspan");
		mygrid.setInitWidths("50,150,150,100,70,*")
		mygrid.enableMultiline(true)
		mygrid.setColAlign("right,left,left,right,center,center")
		mygrid.setColTypes("ro,ed,ed,price,ch,ro");
		
		mygrid.setSkin("light")
		mygrid.init();
		
		mygrid.loadXML("<?php echo base_url();?>/data/grid_text.xml");
</script>
</body>
</html>
