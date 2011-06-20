<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Scores Report!</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />

<style>
a {
color: #00aeff;
}
.form_ h1{
	margin-top: 20px;
}

</style>

</head>
<body>



<div id="forgot_pwd_form" class="form_">
<div class="img_sign"></div>
<h1><?php echo $name ?> Please confirm!</h1>

			<form name="forgot_pwd_form" accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/one_click_score/report_confirm/<?php echo $url ?>">
      

	    	
	    <input 
			 type="submit" 
			 value="Confirm" 
			 name="submit">	
			 
</form>

<p>Back to <a href="http://www.7thgoswami.com">7thgoswami.com</a></p>
</div>

</div>

</body>
</html>
