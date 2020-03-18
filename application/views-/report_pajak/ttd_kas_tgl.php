<?php
error_reporting(0);
list($ttd,$jmlOL) = explode("|",$ttd);
?>
<form name="ttd" id="ttd">
	<table align="center">
    	<tr>
        	<td>
            <fieldset><legend>Tanda Tangan</legend>
            <table>
            	<tr>
                	<td colspan="2" style="padding-left:15px;">
                        <div style="overflow:auto; height:120px; width:400px; border:2px inset #999; margin-left:0px;"><?php echo $ttd; ?></div>
                    </td>
                </tr>
            </table>
            </fieldset>
          	</td>
		</tr>
	</table>
    <table align="center">
    	<tr>
        	<td style="padding-left:15px;" width="400" align="right" colspan="2">
            	<input type="hidden" name="data" id="data" value="<?php echo $data; ?>" />
                <input type="button" value="Cetak" onclick="cetak()" name="new1" style="padding-left:20px; padding-right:20px"/>&nbsp;
            </td>
        </tr>
  	</table>
</form>
<script language="javascript">
	function cetak(){
		var ttd = "";
		<?php for($n=1;$n<=$jmlOL;$n++) { ?>
			if(document.ttd.O<?php echo $n; ?>.checked==true) { 
				ttd = document.ttd.O<?php echo $n; ?>.value+","+ttd; 
			}
		<?php } ?>
		
		full = document.ttd.data.value+'|'+ttd;
		//alert(full);
		window.location.assign('<?php echo site_url(); ?>/report_pajak2/cetak_ktgl?full='+full);
	}
</script>