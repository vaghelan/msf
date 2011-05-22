<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Scores Report!</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>extjs/resources/css/ext-all.css"/>

<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
</head>
<body>

<div id="container">

<div class="h_wrap"> 

    <div class="dashboard fix">
    
	    <img src="http://7thgoswami.com/images/img.png"/>
	    	 <div class="logout"><?php echo anchor('login/logout', 'LogOut'); ?></div>
   			 <h1><?php echo $current_event ?> </h1>    
<!--
Rank_ID My Score By Event  Team Score By Event  My Total Score  Team Total Score 
-->
	<ul class="dbord_info">
			<li class="username"><?php echo $userdata->name ?>
			<div id="rank"></div> 
		</li>
        <li><h2 id="myscore_eventid">...</h2><em>my score</em> </li> 
	    <li><h2 id="teamscore_eventid"> ...</h2><em>my team score</em> </li>
	    <li><h2 id="myscore_total"> ...</h2><em>my total score </em></li>
	    <li><h2 id="totalscore_total"> ...</h2><em>total</em></li>
</ul>

    <script type="text/javascript" src="<?php echo base_url();?>extjs/adapter/ext/ext-base.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>extjs/ext-all.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>application/views/js/load_scores.js"></script>

<!--
<div id="prompt" class="transparent" style="display: none;">
<a onclick="javascript:document.getElementById('prompt').style.display = 'none';" href="#">Close</a>
	<p>Please go to My Profile Page and <b>update your passowrd</b></p>
</div>
-->

</div><!--END dashboard -->

	  <ul id="menu" class="fix tabs">
			<li><a href="#tab1">Manage Scores</li>
	  		<li><a href="#tab2">View Team</li>
			<li><a href="#tab3">Profile</li>
			<li><a href="#tab4">Report my Story</li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>


<div class="tab_container"> <!-- TABS CONTENNER -->

	<!-- SCORES TAB -->
	<div id="tab1" class="tab_content">
			<div id="scores-form"></div>
			<script type="text/javascript" src="<?php echo base_url();?>application/views/js/scores_ext_js.js"></script>
	</div><!--END SCORES TAB -->
	
	<!-- View TEAM TAB -->
	<div id="tab2" class="tab_content">
			<div class="wrapper" id="team">
				<h2>Build my team</h2> 
				<p> Send this link to your friends to subscribe to participate in book distribution </p>
			
				<textarea cols="30" rows="2" value="" name="email_list" id="email_list">Please enter your friend email(s). use coma </textarea>
				<textarea cols="55" rows="2"  name="message" type="text" id="message" value="Invite">Enter your Message....</textarea>
				<button class="b_btn" type="button" onclick="SendInvite()">Invite</button>
			<h2> My team listing </h2> 
				<div id="teams-form" style="width:90%;margin-left:auto;margin-right:auto;"></div>
				<script type="text/javascript" src="<?php echo base_url();?>application/views/js/team.js"></script>
			</div>
	</div><!--END View TEAM TAB -->
	
	<!-- View PROFILE TAB -->
	<div id="tab3" class="tab_content">
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
			</div>
			<button type="button" onclick="SaveAnswers()">Change</button>
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
	</div><!--END View PROFILE TAB -->
	
	<!-- View REPRT TAB -->
	<div id="tab4" class="tab_content">
			<div class="wrapper" id="report">
			<h2> My Report</h2>
			<p>Please post your stories .... </p>
			
				<input type="text" id="subject" name="subject" tabindex="1" value="Title" title="Subject">				
				<br>
			<textarea id="post_mail" name="story" COLS=100 ROWS=10></textarea>
			<button class="b_btn" type="button" onclick="SendPost()">Post</button>
			
			
			</div>    
			
			
			<script type="text/javascript" src="<?php echo base_url();?>application/views/js/story_report.js"></script>   
	</div><!-- END View REPRT TAB -->
	
	
</div><!--  END TABS CONTENT -->
