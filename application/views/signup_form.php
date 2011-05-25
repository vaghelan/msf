<div id="content"><div id="signup_form">
<div class="img_sign"></div>

	<h1>Registration</h1>
			<?php 
			if (isset($username) && $username != "")
			{ 
			?>
			<p> Referer: <?php echo $username ?></p>
			<?php  
			}   
			?> 
			 

			<form accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/login/create_member"><br><br><h5>Login name:</h5>

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
			value="Login Name" 
			name="username"
    	    onblur="if(value=='') value = 'Login Name'" 
    	    onfocus="if(value=='Login Name') value = ''"
			><br><br><h5>Password</h5>
			
			<input 
			type="password" 
			value="Password" 
			name="password"
  	    	onblur="if(value=='') value = 'Password'" 
	    	onfocus="if(value=='Password') value = ''"
			><br><br><h5>Password Confirm</h5>
			
			<input 
			type="password" 
			value="Password Confirm" 
			name="password2"
  	    	onblur="if(value=='') value = 'Password Confirm'" 
	    	onfocus="if(value=='Password Confirm') value = ''"
			><br><br>
			<?php echo form_hidden('recruit_id', $recruit_id); ?>
<br>			
			 
			<h5>Full Name</h5>
			<input type="text" 
			value="Full Name" 
			name="name"
  	    	onblur="if(value=='') value = 'Full Name'" 
	    	onfocus="if(value=='Full Name') value = ''"
			><br><br>
			
			<h5>Email Address</h5>
			<input 
			type="text"
			 value="Email Address" 
			 name="email_address"
  	    	onblur="if(value=='') value = 'Email Address'" 
	    	onfocus="if(value=='Email Address') value = ''"
			 
			 ><br><br>
			 
			 <input 
			 type="submit" 
			 value="Register" 
			 name="submit">
			 
			 <a href="<?php echo base_url();?>index.php/login">Sign in</a>
</form></div>
<a class="admin m_form" href="mailto:admin@7thgoswami.com?subject=7thgoswami Application
&body=HARI BOL! Please describe your issue">Technical Support</a>

<span class="ver">&reg 2011 copyright ISV Silicon Valley. Book Management System <?php echo APP_VERSION; ?></span>

</div>
