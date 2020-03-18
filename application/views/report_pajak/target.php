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
	<script src="<?php echo base_url();?>assets/grid2excel/client/dhtmlxgrid_export.js"></script>
    <script src="<?php echo base_url();?>assets/grid2pdf/client/dhtmlxgrid_export.js"></script>
	
	<!-- calendar begin-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_calendar/skins/dhtmlxcalendar_dhx_skyblue.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase_calendar/dhtmlxcalendar.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
	
    <!-- layout -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
    <script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>
    
    <!-- Ajax -->
	<script src="<?php echo base_url(); ?>assets/codebase_ajax/dhtmlxcommon.js"></script>

    <!-- Window -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_windows/skins/dhtmlxwindows_dhx_skyblue.css">
    <script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxwindows.js"></script>
    <script src="<?php echo base_url(); ?>assets/codebase_windows/dhtmlxcontainer.js"></script>
    
    <!-- Modal -->
    <link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>
<style>
body{
	background:#FFF;
}
</style>
<div align="center">
	
  <form id="form1" name="form1" method="post" action=""><h2>
	  Target Dan Realisasi Pajak Daerah<br/>
	  <div id="tahun_realisasi">Tahun <?php echo date("Y"); ?></div></h2>
      <h4>Sampai Tanggal
        <input name="tanggal" type="text" id="tanggal" value="<?php echo date("d/m/Y"); ?>" size="9" />
      <input type="button" name="button" id="button" value="Tampilkan" onclick="change_tanggal();" />
  </h4>
  </form>
  <div id="gridbox" width="1050px" height="250px" style="margin-bottom:10px;"></div>
    
    <div style="width:750">
    	<p align="right">
    	  <input type="button" name="button2" id="button2" value="Cetak" onclick="cetak_pdf();" />
    	</p>
    </div>
</div>

<script language="javascript">
function pdf(){
    tahun = document.getElementById('tahun').value;
    window.open('<?php echo site_url(); ?>/report_pajak2/ttd_target/'+tahun, '', 'height=700,width=1000,scrollbars=yes');
}

function cetak_pdf(){
	tanggal = document.getElementById('tanggal').value;
	window.open('<?php echo site_url(); ?>/report_pajak2/ttd_target/'+tanggal, '', 'height=700,width=1000,scrollbars=yes');
}

var tahun = "2017";
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url();?>assets/codebase_excel/imgs/");
mygrid.setHeader("No.,Jenis Pajak Daerah,Target,Realisasi(sampai saat ini),Persen (%),Denda,Jumlah,Total Persen (%)",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:left,text-align:center"]);
mygrid.setInitWidths("40,250,100,160,100,120,140,100")
mygrid.setColAlign("center,left,right,right,right,right,right,right")
mygrid.setColTypes("ro,ro,ron,ron,ron,ron,ron,ron")
mygrid.setNumberFormat("0,000",2,",",".")
mygrid.setNumberFormat("0,000",5,",",".")
mygrid.setNumberFormat("0,000",6,",",".")



mygrid.setNumberFormat("0,000",3,",",".")
mygrid.setColSorting("int,str,int,int,int,int,int,int");
mygrid.enableMultiline(true)
mygrid.setSkin("dhx_skyblue")
mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_target/"+tahun);

 
/* for(var i=0;i<mygrid.getRowsNum();i++){
	total+=parseFloat(mygrid.cells2(i,2).getValue().split(".").join());
}  */
mygrid.attachFooter("Jumlah,#cspan,<div style=text-align:right id=tmpDp>{#stat_total}</div>,<div style=text-align:right id=tmpTar>{#stat_total}</div>,<div style=text-align:right id=tmpDen></div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>,<div style=text-align:right id=tmpDen>{#stat_total}</div>")
mygrid.init();

cal1 = new dhtmlxCalendarObject('tanggal');
cal1.setDateFormat('%d/%m/%Y');


function change_tanggal(){
	tanggal = document.getElementById('tanggal').value;
	array_tanggal = tanggal.split("/");
	mygrid.clearAll();
    mygrid.loadXML("<?php echo site_url(); ?>/report_pajak2/data_target_tanggal/"+tanggal);
	document.getElementById('tahun_realisasi').innerHTML = "Tahun "+array_tanggal[2];
}
</script>