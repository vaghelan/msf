<div id="content"><div id="signup_form" class="form_">
<div class="img_sign"></div>

<script type="text/javascript">
function validateRegistrationForm()
{

var x1=document.forms["reg_form"]["password"].value;
var x2=document.forms["reg_form"]["password2"].value;

if (x1 != x2)
  {
  Ext.MessageBox.alert('Error', 'Password do not match!!');  
  return false;
  }


x1=document.forms["reg_form"]["email_address"].value;
x2=document.forms["reg_form"]["email_address_1"].value;

if (x1 != x2)
  {
  Ext.MessageBox.alert('Error', 'Emails do not match!!');  
  return false;
  }
  
  var atpos=x1.indexOf("@");
  var dotpos=x1.lastIndexOf(".");
  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x1.length)
  {
    Ext.MessageBox.alert('Error:', "Not a valid e-mail address: " + x1);
    return false;
  }  

  return true;


  
}
</script>


	<h1>Registration</h1>
			<?php 
			if (isset($username) && $username != "")
			{ 
			?>
			<p> Referer: <?php echo $username ?></p>
			<?php  
			}   
			?> 
			 

			<form name="reg_form" accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/login/create_member" onsubmit="return validateRegistrationForm()"><br><br><h5>Login:</h5>

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

			
			<input 
			type="text" 
			value="" 
			name="username"
			><br><br><h5>Password</h5>
			
			<input 
			type="password" 
			value="" 
			name="password"
			><br><br><h5>Password Confirm</h5>
			
			<input 
			type="password" 
			value="" 
			name="password2"
			><br><br>
			<?php echo form_hidden('recruit_id', $recruit_id); ?>
<br>			
			 
			<h5>Full Name</h5>
			<input type="text" 
			value="" 
			name="name"
			><br><br>
			
			<h5>Email Address</h5>
			<input 
			type="text"
			 value="" 
			 name="email_address"
			 
			 ><br><br>
			<h5>Email Address Confirmation</h5>
			<input 
			type="text"
			 value="" 
			 name="email_address_1"
			 
			 ><br><br>			 
			 
			 <input 
			 type="submit" 
			 value="Register" 
			 name="submit">
			 
			 <a class="reg_log_tbn" href="<?php echo base_url();?>index.php/login">Sign in</a>
</form></div>
<a class="admin m_form" href="mailto:admin@7thgoswami.com?subject=7thgoswami Application
&body=HARI BOL! Please describe your issue">Technical Support</a>

<span class="ver">&reg 2011 copyright ISV Silicon Valley. Sankirtan Book Distribution Management System <?php echo APP_VERSION; ?></span>

</div>

<script type="text/javascript" src="<?php echo base_url();?>extjs/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>extjs/ext-all.js"></script>

