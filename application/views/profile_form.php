  	</div><!--END dashboard -->

	  <ul id="menu" class="fix">
			<li><?php echo anchor('scores', 'Report my scores'); ?></li>
	  		<li><?php echo anchor('teams', 'View my team'); ?></li>
			<li><?php echo anchor('story_report', 'Report my story'); ?></li>
			<li class="active"><?php echo anchor('profile', 'Profile'); ?></li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>



<div class="wrapper fix" id="profile"><!--          START profile -->
		<h2> Profile</h2>

<div class="left">
		<div id="error_msg"></div>
<p>Change your password</p>
		<label for="firstname">New Password: </label>
			<input type="password" id="new_password1" name="new_password1" tabindex="1"  title="New Password">
		<label for="firstname">Confirm: </label>
			<input type="password" id="new_password2" name="new_password2" tabindex="1" title="New Password">
	        <button type="button" onclick="SavePassword()">Change</button>

	<br><br><br>
		
		
		<label for="name">Full Name: </label>
			<input type="text" id="name" name="name" tabindex="1" value="<?php echo $userdata->name ?>" title="name">
			<button type="button" onclick="SaveName()">Change</button>    
				
			<!--
		<label for="icq">ICQ:</label>
				<input type="text" id="icq" name="icq" tabindex="1" value="<?php echo $userdata->icq ?>" title="icq">
				</br>
		<label for="icq">Skype:</label>
				<input type="text" id="skype" name="skype" tabindex="1" value="<?php echo $userdata->skype ?>" title="skype">
         -->
	<br><br><br>
		
		<div class="qa">
			<select name="q_books">
			  <option value="1">I have my own books</option>
			  <option value="2">I need books, please assist me</option>
			</select>
			</br>
			<select name="q_community">
			  <option value="3">I am part of an ISKCON community</option>
			  <option value="4">I am not a part of an ISKCON community</option>
			</select>
			<button type="button" onclick="SaveAnswers()">Change</button>
		</div>

</div>

<div class="right">
	 	<label for="address">Contact Information:</label>
		    <label for="address">Street1:</label>
			<input type="text" id="street1" name="street1" tabindex="1" value="<?php echo $addrinfo->street1 ?>" title="address_line_1">
			<label for="address">Street2:</label>
	        <input type="text" id="street2" name="street2" tabindex="1" value="<?php echo $addrinfo->street2 ?>" title="address_line_2">
		    <label for="address">City:</label>
       		<input type="text" id="city" name="city" tabindex="1" value="<?php echo $addrinfo->city ?>" title="city">
	        <label for="address">State:</label>
			<input type="text" id="state" name="state" tabindex="1" value="<?php echo $addrinfo->state ?>" title="state">
			<label for="address">Zip Code:</label>
			<input type="text" id="zip" name="zip" tabindex="1" value="<?php echo $addrinfo->zip ?>" title="zip">
			<label for="address">Country:</label>
			<input type="text" id="country" name="country" tabindex="1" value="<?php echo $addrinfo->country ?>" title="country">
		    <label for="phone">Phone:</label>
			<input type="text" id="residential_phone" name="residential_phone" tabindex="1" value="<?php echo $userdata->residential_phone ?>" title="phone1">
	        <label for="phone">Work Phone:</label>
			<input type="text" id="business_phone" name="business_phone" tabindex="1" value="<?php echo $userdata->business_phone ?>" title="phone2">
   			<button type="button" onclick="SaveAddress()">Change</button> 
</div>


		
</div><!--     END profile -->

<script type="text/javascript" src="<?php echo base_url();?>application/views/js/profile.js"></script>      