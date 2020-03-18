<?php
/*
 * Programmer : Knightly
 */
?>
<!DOCTYPE html>
<html lang="en">
  <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="user-scalable=no" />
    
    <title>.: SIMPADA MELAWI :.</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url();?>css_log/reset.css" />
    <!-- <link rel="stylesheet" href="<?//php echo base_url();?>css_log/icons.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url();?>css_log/formalize.css" />
    <!-- <link rel="stylesheet" href="<?//php echo base_url();?>css_log/fonts.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url();?>css_log/main.css" />
    <!-- <link rel="stylesheet" media="all and (orientation:portrait)" href="<?php echo base_url();?>css_log/portrait.css" />-->
    <!-- <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" /> -->
    <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> -->
    
    <style>
	.logo {
		margin: 140px 0 230px 5px;
	}
	
	#logo{
		margin: 140px 0 230px 300px;
	}
	</style>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  
  <body class="login">
  
<div style="margin:0px 0px 40px 20px;">

<div id="logo">
<!--<img src="<?php echo base_url(); ?>images/Logo melawi.png" width="120" height="130" />
<img src="<?php echo base_url(); ?>images/sopd_lg merah.png" width="650" height="100" style="margin:-50px 0 0 0;" />-->
</div>
  <div id="login_form" style="margin-top:170px;  margin-left:400px">
    <form action="<?php echo site_url(); ?>/home/processlogin" method="post">
      <p align="center" style="color:#F00;"><center><?php echo $msg; ?></center></p><br>
      <tr>
	  <td>
        <input type="text" id="username" name="username" placeholder="Username" class="{validate: {required: true}}" />
      </td>
	  </tr>
	  <tr>
      <td>
        <input type="password" id="password" name="password" placeholder="Password" class="{validate: {required: true}}" />
      </td>
	  </tr>
	  <tr>
		<td>
		 <button type="submit" class="button blue"> Login</button>
		</td>
	  </tr>
     
    </form>
  </div>
</div>
    
    <!-- JavaScript -->
    <script src="<?php echo base_url();?>js_log/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js_log/jqueryui.min.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.pjax.js"></script>
    <!--<script src="<?php echo base_url();?>js_log/jquery.metadata.js"></script>-->
    <!--<script src="<?php echo base_url();?>js_log/jquery.validate.js"></script>-->
    <!--<script src="<?php echo base_url();?>js_log/jquery.checkboxes.js"></script>-->
    <script src="<?php echo base_url();?>js_log/jquery.selectskin.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.fileinput.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.datatables.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.tipsy.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.inputtags.min.js"></script>
    <script src="<?php echo base_url();?>js_log/jquery.livequery.js"></script>
      
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-11172759-15']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>