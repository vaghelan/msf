<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Scores Report!</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />

</head>
<body>

<script>
function validateForgotPasswordForm()
{

var x1=document.forms["forgot_pwd_form"]["email_address"].value;


  
  var atpos=x1.indexOf("@");
  var dotpos=x1.lastIndexOf(".");
  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x1.length)
  {
    //Ext.MessageBox.alert('Error:', "Not a valid e-mail address: " + x1);
    alert('Error: Not a valid e-mail address: ' + x1);
    return false;
  }  

  return true;


  
}
</script>

<div id="forgot_pwd_form">

			<form name="forgot_pwd_form" accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/login/forgot_password" onsubmit="return validateForgotPasswordForm()">
      

			<?php 
			if (isset($error_message))
			{ 
			?>
			<br><p class="error"><?php echo $error_message ?></p><br>
			<?php  
			}   
			else
			{
			  echo validation_errors('<p class="error">');
			}                 
			?> 		 

      <h5>User Name</h5>
      <input 
			type="text" 
			value="Login Name" 
			name="username"
    	    onblur="if(value=='') value = 'Login Name'" 
    	    onfocus="if(value=='Login Name') value = ''"
			><br><br>

  		<h5>Email Address</h5>
			<input 
			type="text"
			 value="Email Address" 
			 name="email_address"
  	    onblur="if(value=='') value = 'Email Address'" 
	    	onfocus="if(value=='Email Address') value = ''"
	    >	
	    <br><br>	
	    	
	    <input 
			 type="submit" 
			 value="Reset Password" 
			 name="submit">	
			 

</form>

<a href="<?php echo base_url();?>index.php/login">Sign in</a>

</div>



</div>


</body>
</html>