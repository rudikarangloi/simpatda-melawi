<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Data Belum Pendataan SPTPD</title>
</head>

<meta http-equiv=refresh content=60;url=real_not_sptpd>
<body>

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
	<h2>Laporan SPTPD<br/>Surat Pemberitahuan Terhutang Pajak Daerah Belum Pendataan</h2>
    <table border="1" cellpadding="5" cellspacing="3">
		<tr>
        	<th>No. NPWPD</th>
            <th>Nama Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>Nama Kecamatan</th>
            <th>Nama Kelurahan</th>
            <th>Jenis Pajak</th>
        </tr>
<?php
$thn = date('Y');
for($bln=1;$bln<=12;$bln++){
	if(strlen($bln)==1){
		$bln = '0'.$bln;
	}
		
	$sql = $this->db->query("select a.npwpd_perusahaan as npwpd, a.nama_perusahaan as nama, a.alamat_perusahaan as alamat, b.nama_kecamatan as kecamatan, b.nama_kelurahan as kelurahan, c.nama_sptpd as pajak from identitas_perusahaan a left join view_kelurahan b on a.kelurahan=b.kode_kelurahan left join master_sptpd c on a.jenis_pajak=c.id where a.npwpd_perusahaan NOT IN (select npwpd FROM sptpd where tanggal like '%".$bln."%' and tahun = '".$thn."')");

	foreach($sql->result() as $rs){
		$skrg = date('m');
		if($bln<=$skrg){
?>
	<tr style="color:#00F;">
    	<td align="center"><?php echo $rs->npwpd; ?></td>
        <td><?php echo $rs->nama; ?></td>
        <td><?php echo $rs->alamat; ?></td>
        <td align="center"><?php echo $rs->kecamatan; ?></td>
        <td align="center"><?php echo $rs->kelurahan; ?></td>
        <td align="center"><?php echo $rs->pajak; ?></td>
    </tr>
<?php
		} else {
?>
	<tr style="color:#F00;">
    	<td align="center"><?php echo $rs->npwpd; ?></td>
        <td><?php echo $rs->nama; ?></td>
        <td><?php echo $rs->alamat; ?></td>
        <td align="center"><?php echo $rs->kecamatan; ?></td>
        <td align="center"><?php echo $rs->kelurahan; ?></td>
        <td align="center"><?php echo $rs->pajak; ?></td>
    </tr>
<?php
		}
	}
}
?>
</table>
    <!--<div id="gridbox" width="1220px" height="550px" style="margin-bottom:10px;"></div>-->
    
</div>

<script>
	function statusLoading() {  
	   ModalPopups.Indicator("idIndicator2",  
			"Please wait",  
			"<div style=''>" +   
			"<div style='float:left;'><img src='<?php echo base_url();?>/assets/modal/spinner.gif'></div>" +   
			"<div style='float:left; padding-left:10px;'>" +   
			"Permintaan Anda Sedang Diproses... <br/>" +   
			"Tunggu Beberapa Saat." +  
			"<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
			"</div>",   
			{  
				width: 300,  
				height: 100  
			}  
		);
	}
	
	function statusEnding() {
		ModalPopups.Close("idIndicator2");
	}
	
/*mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?//php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("NPWPD, Nama Wajib Pajak, Alamat, Kecamatan, Kelurahan, Jenis Pajak",
	null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter",["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("100,250,250,150,200,250");
mygrid.setColAlign("left,left,left,left,left,center");
//mygrid.setRowColor("row1","red");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro");

mygrid.setColSorting("str,str,str,str,str,str");
mygrid.setSkin("dhx_skyblue");
mygrid.init();

//refresh_data();

function refresh_data(){
	//mygrid = new dhtmlXGridObject('gridbox');
	statusLoading();
	bln = <?//php echo date('m'); ?>;
	thn = <?//php echo date('Y'); ?>;
	pajak = '';
	
	full = bln+'_'+thn+'_'+pajak;
	mygrid.loadXML("<?//php echo site_url(); ?>/report_pajak2/real_nots_sptpd", function(){
		mygrid.setRowColor("red");
		statusEnding();
	});
}*/

</script>

</body>
</html>