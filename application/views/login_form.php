	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$(".iframe_pop_up").colorbox({width:"460px;", height:"430px", iframe:true});
			});
	
		</script>


<div id="content">

<div id="login_form" class="form_">
	<div class="img_sign"></div>
    	<h1>Sign in</h1>
	    <br><br>
    	<form class="login_input" accept-charset="utf-8" method="post" action="<?php echo base_url();?>index.php/login/validate_credentials"><br>
 	<?php if (isset($error_message)) 
       { 
          echo "<p class=\"error\"> " . $error_message . "</p>"; 
       } 
  ?>
   <h5>Login</h5>
    <input 
    	type="text"
    	value="Login" 
    	name="username"
    	onblur="if(value=='') value = 'Login'" 
    	onfocus="if(value=='Login Name') value = ''"
    ><br><br>
    <h5>Password</h5>
    <input 
    	type="password" 
    	value="Password" 
    	name="password"
     	onblur="if(value=='') value = 'Password'" 
    	onfocus="if(value=='Password') value = ''"
    >
    <br><br><input type="submit" value="Sign in" name="submit">
    
    <a class="reg_log_tbn" href="<?php echo base_url();?>index.php/login/signup/<?php echo $rid ?>">Register</a></form>    
    <a class="restore iframe_pop_up"  href="<?php echo base_url();?>index.php/login/load_forgot_password">Forgot password</a></form>
	</div><!-- end login_form-->

<div class="clear"></div>
<a class="admin m_form" href="mailto:admin@7thgoswami.com?subject=7thgoswami Application
&body=HARI BOL! Please describe your issue">Technical Support</a>
</div>
<span class="ver">&reg 2011 copyright ISV Silicon Valley. Sankirtan Book Distribution Management System <?php echo APP_VERSION; ?></span>

</body></html>
