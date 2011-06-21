<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Unsubscription!</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />

<style>
a {
color: #00aeff;
}
.form_{
width: 400px !important;
}
.form_ h1{
	margin-top: 0px;
}
</style>


</head>
<body>



<div id="unsubscribe_form" class="form_">
<div class="img_sign"></div>
<?php echo $name . ", Are your sure you want to unsubscribe ?" ?>

			<form name="unsubscribe_form" accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/unsubscription/ok/<?php echo $userid ?>">
      <br>
      <br>
	    	
	    <input 
			 type="submit" 
			 value="Confirm" 
			 name="submit">	
			 
</form>

</div>

</body>
</html>

