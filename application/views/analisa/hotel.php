<?php 
if(isset($npwpd)):
	$sql = $this->db->query("select * from mp_hotel where npwpd = '".$npwpd."'");
	$rs = $sql->row();
	$strNoUrut = $rs->koderec;
	$username = $rs->createdby;
	$dtTgl = $rs->created;	
	$ket = $rs->ket;	
endif;
?>

<script language="javascript">
	var base_url = "<?php echo base_url(); ?>";	
	
	// get data grido dan disimpan ke temporary array
            var r = new Array();
            function tmpRows() {
		var arr = grido.getAllItemIds().split(',');
		for(i=0;i < arr.length;i++) {
				id = arr[i];				
				r[i] =  grido.cells(id,0).getValue()+'|'+
                        grido.cells(id,1).getValue()+'|'+
                        grido.cells(id,2).getValue()+'|'+
                        grido.cells(id,3).getValue()+'|'+
                        grido.cells(id,4).getValue()+'|'+
                        grido.cells(id,5).getValue()+'|'+
                        grido.cells(id,6).getValue()+'|'+
						grido.cells(id,7).getValue()+'|'+
						grido.cells(id,8).getValue()+'|'+
                        grido.cells(id,9).getValue();                                       
		}	
                    grido.clearAll();
                    for(i=0;i<r.length;i++) {
                            addRowItem(i);
                    }
                    r = new Array();					
                    mdp.sendData();

            }
            
            // set grido sesuai value dari temporary
            function addRowItem(arrIndx) {
		
		var id = grido.uid();

		var posisi = grido.getRowsNum();
		// Split Array
		var arr = r[arrIndx].split('|');
		
		var row1= document.frmAns.no_trxhtl.value;
		var row2= document.frmAns.npwpd.value;
		var row3= arr[2];
		var row4= arr[3];
		var row5= arr[4];
		var row6= arr[5];
		var row7= arr[6];
		var row8= arr[7];			               
		var row9= arr[8];
		var row10= arr[9];
//		if(arr[0] != "") {
			grido.addRow(id,[row1,row2,row3,row4,row5,row6,row7,row8,row9,row10],posisi);
//		}
	}	
</script>


<!--<h2 style="margin:30px 5px 25px 30px;">SPTPD Hotel</h2>-->

<!--<div id="a_tabbar" style="width:1000px; height:470px; margin-left:30px; overflow:auto;"></div>-->
  <div id="C1" style="background-color: #B3D9F0">
    <br />
   	  <table width="500" border="0">
      		<tr>
        		<td width="100" style="padding-left:15px;">NO RECORD</td>
            	<td width="100"> 
                <input type="text" name="no_trxhtl" id="no_trxhtl" size="20" style="background-color:#FFFFCC;" readonly="readonly" value="<?php if(isset($strNoUrut)): echo $strNoUrut; endif; ?>"/>            	
                <input type="hidden" name="txtUsername" id="txtUsername" value="<?php if(isset($username)): echo $username; endif; ?>" />
                </td>
      		</tr>
            <tr>
              <td style="padding-left:15px;">TANGGAL</td>
              <td><input type="text" name="tgl" id="tgl" size="20" value="<?php echo $dtTgl; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
              	<td style="padding-left:15px;">KETERANGAN</td>
                <td><input type="text" name="ket" id="ket" size="30" value="<?php if(isset($ket)): echo $ket; endif; ?>" /></td>
            </tr>          
            <tr>
              <td colspan="2" style="padding-left:15px;">
              	<div style="height: 30px;"><div id="topnav"></div></div>
              	<div id="gridHotel" style="background-color:#FFFFFF;height:150px;width:1000px;;"></div>
              </td>
            </tr>
            <tr>
                <td style="padding-left:15px;" colspan="2">&nbsp;</td>
            </tr>
</table>
<br />
</div>




<script language="javascript">

	
//Top Nav
topnav = new dhtmlXToolbarObject("topnav");
topnav.setIconsPath("<?php echo base_url(); ?>/assets/codebase_toolbar/imgs/btn/");
topnav.addButton("new", 0, "TAMBAH", "new.gif", "new_dis.gif");
topnav.addButton("del", 1, "HAPUS", "delete.png", "dis_delete.png");
topnav.attachEvent("onclick", doTopClick);


function doTopClick(id){
	if(id=="new"){
		addRow();
	} else if(id=="del"){
		grido.deleteSelectedRows();
		HitungTotal();  
	}
}

	cal1 = new dhtmlxCalendarObject('tgl');
	cal1.setDateFormat('%d/%m/%Y');


	
	grido = new dhtmlXGridObject('gridHotel');
	grido.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
	grido.setHeader("koderec, NPWPD, Jenis Kamar, Jumlah Kamar, Tarif, Potensi, Persentase (%), Total Potensi, Asumsi Pajak Perbulan, Asumsi Pajak Pertahun"
	,null
	,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
	grido.setInitWidths("80,100,150,100,100,100,100,100,150,150");
	grido.setColAlign("center,left,center,center,right,right,center,right,right,right");
	grido.setColTypes("ro,ro,ed,ed,edn,ron,edn,ron,ron,ron");
	grido.setColSorting("str,str,str,int,int,int,int,int,int,int");
	grido.setSkin("dhx_skyblue");
	grido.attachEvent("onEditCell", doOnCellEdit);	
	grido.setNumberFormat("0,000",4,".",",");
	grido.setNumberFormat("0,000",5,".",",");
	grido.setNumberFormat("0,000",7,".",",");		
	grido.setNumberFormat("0,000",8,".",","); //asumsi pajak perbulan
	grido.setNumberFormat("0,000",9,".",","); //asumsi pajak pertahun
	grido.setColumnHidden(0,true);
	grido.setColumnHidden(1,true);
	grido.attachFooter("&nbsp;,&nbsp;,&nbsp;,TOTAL,#cspan,<div id='jml_kamar' align='center'>0</div>,&nbsp;,<div id='pot' align='right'>0</div>,&nbsp;,<div id='total_potensi' align='right'>0</div>,<div id='bln' align='right'>0</div>,<div id='thn' align='right'>0</div>");
	grido.init();
	
var mdp = "";
function runmdp(){
mdp = new dataProcessor("<?php echo base_url()."index.php/analisa/hotelDetail"; ?>");
mdp.setUpdateMode("off");
mdp.init(grido);
//mdp.attachEvent("onAfterUpdateFinish", function() {                
//        alert("berhasil");
//		return true;
//});
}
	
	function addRow(){
		var id = grido.uid();
		var posisi = grido.getRowsNum();
		grido.addRow(id,['','','','','','','',''],posisi);
		grido.selectRowById(id);
	}
	
	function loadData(){
		grido.loadXML("<?php echo base_url()."index.php/analisa/LoadHotelDetail/".$strNoUrut; ?>",function(){
			HitungTotal();
		});
	}
	
	function doOnCellEdit(stage, rowId, cellInd) {
            if(stage=='2' && cellInd=='3' || cellInd=='4' || cellInd=='6')
            {                
               var jml_kamar = grido.cells(rowId,3).getValue();
			   var tarif =  grido.cells(rowId,4).getValue();
			   var potensi = jml_kamar*tarif;
			   var persentase = grido.cells(rowId,6).getValue();
			   grido.cells(rowId,5).setValue(potensi);
			   var totalpotensi = potensi*persentase/100;
			   grido.cells(rowId,7).setValue(totalpotensi);
			   var asumsi_pajak_bulan = totalpotensi*30*10/100;
			   grido.cells(rowId,8).setValue(asumsi_pajak_bulan);
			   var asumsi_pajak_tahun = asumsi_pajak_bulan*12;
   			   grido.cells(rowId,9).setValue(asumsi_pajak_tahun);
			   HitungTotal();          
            } 
			
    return true;    
}

function HitungTotal(stage) {
	var pot = document.getElementById("pot");
    pot.innerHTML = '<b>'+format_number(sumColumn(5))+'</b>';
    var tp = document.getElementById("total_potensi");
    tp.innerHTML = '<b>'+format_number(sumColumn(7))+'</b>';
	var bln = document.getElementById("bln");
    bln.innerHTML = '<b>'+format_number(sumColumn(8))+'</b>';
	var thn = document.getElementById("thn");
    thn.innerHTML = '<b>'+format_number(sumColumn(9))+'</b>';	
	var jml_kamar = document.getElementById("jml_kamar");
    jml_kamar.innerHTML = '<b>'+sumColumn(3)+'</b>';
}

function sumColumn(ind) {
    var out = 0;
    for (var i = 0; i < grido.getRowsNum(); i++) {
        out += parseFloat(grido.cells2(i, ind).getValue());
    }
    return out;
}

 
if(document.frmAns.no_trxhtl.value!=""){
		loadData();
}	
		
	//statusEnding();
</script>
