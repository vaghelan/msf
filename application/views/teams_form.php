  	</div><!--END dashboard -->

	  <ul id="menu" class="fix">
			<li><?php echo anchor('scores', 'Report my scores'); ?></li>
	  		<li class="active"><?php echo anchor('teams', 'Build my team'); ?></li>
			<li><?php echo anchor('story_report', 'Report my story'); ?></li>
			<li><?php echo anchor('profile', 'Profile'); ?></li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>


<div class="wrapper" id="team">
<h2>Invite my friends</h2> 
<p>You can easily invite your friends, family members or any one else. Just list email(s) and write your encouraging message</p>

    
    
		<textarea cols="30" rows="3" value="" name="email_list" id="email_list">Please enter the email ids, separated by comas, of all those you want to invite...</textarea>
    <textarea cols="55" rows="3"  name="message" type="text" id="message" value="Invite">Enter your message....</textarea>
		<button class="b_btn" type="button" onclick="SendInvite()">Invite</button>



    <h2>My network</h2> 

    <div id="teams-form" style="width:90%;margin-left:auto;margin-right:auto;"></div>
    <script type="text/javascript" src="<?php echo base_url();?>application/views/js/team.js"></script>
    
</div>