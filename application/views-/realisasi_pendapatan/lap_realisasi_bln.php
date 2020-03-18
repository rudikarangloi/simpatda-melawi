<!-- layout -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/codebase_layout/skins/dhtmlxlayout_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxlayout.js"></script>
<script src="<?php echo base_url(); ?>/assets/codebase_layout/dhtmlxcontainer.js"></script>

<!-- tabbar -->
<link rel="STYLESHEET" type="text/css" href="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.css">
<script  src="<?php echo base_url(); ?>assets/codebase_tabbar/dhtmlxtabbar.js"></script>

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
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_editor/skins/dhtmlxeditor_dhx_skyblue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/codebase_toolbar/skins/dhtmlxtoolbar_dhx_skyblue.css">
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxcommon.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/dhtmlxeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_editor/ext/dhtmlxeditor_ext.js"></script>
<script src="<?php echo base_url(); ?>assets/codebase_toolbar/dhtmlxtoolbar.js"></script>

<style>
body{
    background:#FFF;
}
</style>
<div align="center">

    <h2>Laporan Realisasi Penerimaan Pendapatan Bulanan</h2>
    <form name="bln" id="bln">
        <table width="600" border="0">
            <tr>
                <td align="right" width="150" style="padding-left:15px;">Bulan Penerimaan &nbsp;:&nbsp;</td>                
                <td align="left" width="150">
                <select name="bulan" id="bulan" >
                    <option value=""></option>
                    <?php echo $bulan; ?>
                </select></td>
            </tr>
            <tr>
                <td align="right" width="150" style="padding-left:15px;">Tahun Penerimaan &nbsp;:&nbsp;</td>                
                <td align="left" width="150">
                <select name="tahun" id="tahun" >
                    <option value=""></option>
                    <?php echo $tahun; ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Display" onclick="tampil()" style="padding-left:20px; padding-right:20px" />&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center">                
                <input type="button" name="pdf1" id="pdf1" onclick="tpdf();" value="Cetak LRP Jenis Pendapatan" style="padding-left:20px; padding-right:20px" disabled/> 
                <input type="button" name="pdf2" id="pdf2" onclick="tpdf_2();" value="Cetak LRP Jenis Pendapatan per SKPD" style="padding-left:20px; padding-right:20px" disabled/></td>
            </tr>
        </table>
    </form>
<div id="gridbox" width="1260" height="450px" style="margin-bottom:10px;"></div>
</div>

<script type="text/javascript">
function tpdf(){
    periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
    //var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
    //var lastDateDay = lastDate.getDate();
    
    window.open('<?php echo site_url(); ?>/realisasi_pendapatan/ttd_lpr_pendapatan_bln?full='+periode, '', 'height=700,width=1000,scrollbars=yes');
}

function tpdf_2(){
    periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
    //var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
    //var lastDateDay = lastDate.getDate();
        
    window.open('<?php echo site_url(); ?>/realisasi_pendapatan/ttd_lpr_pendapatan?full='+periode, '', 'height=700,width=1000,scrollbars=yes');
}

function tampil(){
    if(document.bln.bulan.value=="") {
        alert("Bulan Penerimaan Tidak Boleh Kosong");
        document.bln.bulan.focus();
        return;
    }
    
    if(document.bln.tahun.value=="") {
        alert("Tahun Penerimaan Tidak Boleh Kosong");
        document.bln.tahun.focus();
        return;
    }
    
    periode = document.bln.tahun.value+'-'+document.bln.bulan.value;
    //var lastDate = new Date(document.bln.tahun.value, document.bln.bulan.value, 0);
    //var lastDateDay = lastDate.getDate();
    
    //full = periode
    
    statusLoading();
    mygrid.clearAll();
    mygrid.loadXML("<?php echo site_url(); ?>/realisasi_pendapatan/data_realisasi_bln/"+periode,function() {
        document.bln.pdf1.disabled = false;
        document.bln.pdf2.disabled = false;
        statusEnding();
    });
}

cal1 = new dhtmlxCalendarObject('awal');
cal1.setDateFormat('%d/%m/%Y');
    
cal2 = new dhtmlxCalendarObject('akhir');
cal2.setDateFormat('%d/%m/%Y');

function pasif(){
    document.bln.excel.disabled = true;
}

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("Kode Rekening,Uraian,Jumlah Anggaran,Bulan ini,#cspan,Sampai dengan Bulan Lalu,#cspan,Sampai dengan Bulan ini,#cspan,#cspan,Sisa Anggaran yang Belum Terealisasi / Pelampauan Anggaran",
    null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader(["#rspan", "#rspan", "#rspan", "Penerimaan", "Penyetoran", "Penerimaan", "Penyetoran", "Jumlah Anggaran yang Terealisasi", "Jumlah Anggaran yang Telah Disetor", "Persentase (%)", "#rspan"]);
mygrid.attachHeader(["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11"],
["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.setInitWidths("60,330,100,100,100,100,100,100,100,70,100");
mygrid.setColAlign("left,left,right,right,right,right,right,right,right,right,center");
mygrid.setColTypes("ro,ro,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron,ron");
mygrid.setNumberFormat("0,000",2,",",".")
mygrid.setNumberFormat("0,000",3,",",".")
mygrid.setNumberFormat("0,000",4,",",".")
mygrid.setNumberFormat("0,000",5,",",".")
mygrid.setNumberFormat("0,000",6,",",".")
mygrid.setNumberFormat("0,000",7,",",".")
mygrid.setNumberFormat("0,000",8,",",".")
mygrid.setNumberFormat("0,000",9,",",".")
mygrid.setNumberFormat("0,000",10,",",".")
mygrid.setNumberFormat("0,000",11,",",".")
mygrid.setColSorting("str,str,int,int,int,int,int,int,int,int,int,int,int,int,int,int")
mygrid.enableMultiline(true)
mygrid.setSkin("dhx_skyblue")
mygrid.attachFooter("Jumlah Realisasi Penerimaan Pendapatan Daerah,#cspan,<div style=text-align:right id=s0>{#stat_total}</div>,<div style=text-align:right id=s1>{#stat_total}</div>,<div style=text-align:right id=s2>{#stat_total}</div>,<div style=text-align:right id=s3>{#stat_total}</div>,<div style=text-align:right id=s4>{#stat_total}</div>,<div style=text-align:right id=s5>{#stat_total}</div>,<div style=text-align:right id=s6>{#stat_total}</div>,<div style=text-align:right id=s7>{#stat_total}</div>,<div style=text-align:center id=s8>{#stat_total}</div>")
mygrid.loadXML("<?php echo site_url(); ?>/realisasi_pendapatan/data_realisasi_bln");
mygrid.init();
</script>
