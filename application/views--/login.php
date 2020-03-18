<!-- Modal -->
<link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>

<html>
<head>
    <title>FORM LOGIN SIMPADA </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>

<style>
	body {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size : 12px;
		background-image: url(../../images/Untitled-11.png);
        background-image: -webkit-linear-gradient(bottom, #FFFFA0 0%, #FFA500 100%); 
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #FFFFA0), color-stop(1, #FFA500));
        background-image: -moz-linear-gradient(bottom, #FFFFA0 0%, #FFA500 100%);
		/*background-repeat: no-repeat;*/
	}
	
	.oval3 {
		width: 60px;
		/*background-color: #FFF;*/
		margin:-15px 5px 5px 5px;
		padding:5px 5px 5px 15px;
		border:1px solid #CCC;
		border-radius:10px;
		-moz-border-radius:10px;
	}
	
	.oval_big2 {
		width: 370px;
		background-color: #FFF;
		margin:-10px 5px 25px 480px;
		padding-left: 20px;
		padding-right: 20px;
		padding-bottom: 5px;
		border:1px solid #CCC;
		border-radius:10px;
		-moz-border-radius:10px;
	}
	
	.logo {
		margin: 90px 0 30px 475px;
		/*background: url(../../images/PEMDA_copy.jpg) no-repeat ;
		width: 110px;
		height: 122px;*/
	}
</style>

<script type="text/javascript">
	function doLoad() {
		document.frmLogin.name.focus();
	}
</script>

</head>
<body onLoad="doLoad()">

<div class="logo">
	<img src="<?php echo base_url(); ?>images/Logo melawi22.png" width="220" height="140">
    <!--<img src="../../images/SOPD.png" width="450" height="120">&nbsp;&nbsp;&nbsp;-->
    <h1>SIMPADA KABUPATEN MELAWI</h1>
</div>
<div class="oval_big2">
	<!--<div class="oval3">LOG IN</div>
	<img src="<?php echo base_url(); ?>css_new/images/icon/error.png" width="21" height="19">
	<form name="frmLogin" id="frmLogin" action="<?php echo site_url(); ?>/home/processlogin" method="post">-->
	<form action="<?php echo site_url(); ?>/home/processlogin" method="post">
    <table>
    	<tr>
        	<td colspan="2" align="center" style='color:red;padding:5px;text-align:right;font-size:12px;'>&nbsp;<?php echo $msg; ?></td>
        </tr>
    	<tr>
        	<td style="padding-left:15px;"><font size="2">Username</font></td>
            <td><input type="text" name="username" id="username" size="25" style="text-transform:lowercase;background-color:#FFCC99;" /></td>
        </tr>
        <tr>
        	<td style="padding-left:15px;"><font size="2">Password</font></td>
            <td><input type="password" name="password" id="password" size="25" style="text-transform:lowercase;background-color:#FFCC99;" /></td>
        </tr>
        <tr>
        	<td colspan="2" style="padding-left:15px;"><input type="submit" value="Login"></td>
        </tr>
    </table>
    </form>
    <!--<p align="center">Registrasi online pendaftaran wajib pajak <a href="<?php echo site_url(); ?>/home/registrasi">Klik disini</a><br/>-->
    Formulir registrasi pendaftaran wajib pajak <a href="<?php echo base_url(); ?>images/FORM_PENDAFTARAN_PAJAK1.pdf" target="_blank">Download</a></p>
</div>

</body>
<script language="javascript">		
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
	
	statusEnding();
</script>
</html>
